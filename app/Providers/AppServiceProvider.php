<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Set default password rules
        Password::defaults(function () {
            return Password::min(10) // Minimum 10 characters
                ->mixedCase()       // At least one uppercase and one lowercase letter
                ->letters()         // At least one letter
                ->numbers()         // At least one number
                ->symbols();        // At least one symbol
        });
    }
}
