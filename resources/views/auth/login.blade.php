<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email or Username -->
        <div>
            <x-input-label for="input_type" :value="__('Email/Username')" />
            <x-text-input id="input_type" class="block mt-1 w-full" type="text" name="input_type" :value="old('input_type')" autofocus />

            <x-input-error :messages="$errors->get('email')" class="mt-2" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                             autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <input type="hidden" id="onesignal_player_id" name="onesignal_player_id">
        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>
        <div class="form-group mb-3">

            {!! NoCaptcha::renderJs() !!}
            {!! NoCaptcha::display() !!}
            <x-input-error :messages="$errors->get('g-recaptcha-response')" class="mt-2" />
        </div>
        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
    <script src="https://cdn.onesignal.com/sdks/web/v16/OneSignalSDK.js" defer></script>
    <script>
        async function sendPushNotification(event) {
            event.preventDefault(); // Prevent the form from submitting immediately

            // OneSignal initialization
            OneSignal.push(function() {
                OneSignal.getUserId().then(function(userId) {
                    console.log("OneSignal User ID:", userId);

                    // Send push notification via OneSignal's REST API
                    fetch('https://onesignal.com/api/v1/notifications', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Authorization': 'Basic N2M4Njg5MjgtNGQxMi00NmQyLWJjNDUtNDU0MDNlODU4ZmMw' // Replace with your OneSignal REST API key
                        },
                        body: JSON.stringify({
                            app_id: "f815d9fe-2803-44f4-886d-0ede2d40ba52", // Your OneSignal App ID
                            include_player_ids: [userId], // Send notification to this user
                            contents: { en: "Welcome back! You have logged in successfully." }, // Notification content
                            headings: { en: "Login Notification" }, // Notification title
                            url: "https://127.0.0.1:8000/dashboard" // URL to open when notification is clicked
                        })
                    }).then(response => {
                        console.log('Notification sent:', response);
                        // Optionally, redirect user after successful login
                        window.location.href = "{{ route('dashboard') }}";
                    }).catch(error => {
                        console.error('Error sending notification:', error);
                    });
                });
            });
        }
        @if (!empty($onesignal_player_id))
            console.log('Received OneSignal Player ID:', {!! json_encode($onesignal_player_id) !!});
        @endif
    </script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</x-guest-layout>
