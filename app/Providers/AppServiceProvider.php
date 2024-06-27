<?php

namespace App\Providers;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Opis\Closure\SerializableClosure;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
     //   Schema::defaultStringLength(191);
        // Définir la clé secrète pour SerializableClosure
        SerializableClosure::setSecretKey(config('app.key'));
        Schema::defaultStringLength(191);
    }
}
