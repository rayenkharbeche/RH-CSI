<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

use App\Rules\Recaptcha;
class LoginRequest extends FormRequest
{

    protected $inputType;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {

        return [
            'email' => ['required_without:username', 'string', 'email', 'exists:users,email'],
            'username' => ['required_without:email', 'string', 'exists:users,username'],
            'password' => ['required', 'string'],
            'onesignal_player_id' => ['nullable', 'string'],
            'g-recaptcha-response' => 'required|captcha',
        ];

    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        $onesignal_player_id = $this->input('onesignal_player_id');
        Log::info('Received OneSignal Player ID: ' . $onesignal_player_id);
        if (! Auth::attempt($this->only($this->inputType, 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                $this->inputType => trans('auth.failed'),
            ]);
        }
        Auth::user()->update(['onesignal_player_id' => $onesignal_player_id]);
        $this->sendPushNotification();
        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->input('email')).'|'.$this->ip());
    }
    /**
     * Validate reCAPTCHA response if required.
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    protected function prepareForValidation()
    {
        $this->inputType = filter_var($this->input('input_type'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $this->merge([$this->inputType => $this->input('input_type')]);
    }
    protected function sendPushNotification(): void
    {
        $onesignal_app_id = config('services.onesignal.app_id');
        $onesignal_api_key = config('services.onesignal.rest_api_key');

        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . $onesignal_api_key,
            'Content-Type' => 'application/json',
        ])->post("https://onesignal.com/api/v1/notifications", [
            'app_id' => $onesignal_app_id,
            'include_player_ids' => [Auth::user()->onesignal_player_id],
            'data' => [
                'foo' => 'bar', // Add custom data if needed
            ],
            'contents' => [
                'en' => 'Welcome back! You have successfully logged in.', // Notification message
            ],
        ]);

        // Log response for debugging
        Log::info('OneSignal push notification response: ' . $response->body());
    }
}
