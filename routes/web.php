<?php

// This file is part of the Laravel framework.
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\SetLocale;


Route::middleware([SetLocale::class])->group(function () {

    // welcome is the name of the view file located in resources/views
    // This route will act as a homepage for the application
    Route::get('/', function () {
        return view('home');
    })->name('home');

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.store');
    Route::post('/login/send-recovery-email', [LoginController::class, 'sendRecoveryEmail'])->name('login.send-recovery-email');
    Route::post('/login/reset-password', [LoginController::class, 'resetPassword'])->name('login.reset-password');

    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

    Route::get('/entry', function () {
        return 'Entry Page';
    })->middleware('auth')->name('entry');

    Route::get('/profile', [ProfileController::class, 'show'])->middleware('auth')->name('profile');

    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/lang/{locale}', function ($locale) {
        if (in_array($locale, ['en', 'de', 'fr', 'es', 'hr'])) {
            Session::put('locale', $locale);
            App::setLocale(Session::get('locale', config('app.locale')));
        }
        Log::info('routes/web.php => Session::put=:' . Session::get('locale'));
        Log::info('routes/web.php => App::setLocale=:' . App::getLocale());
        return redirect()->back()->with('locale_changed', true);
    })->name('lang.switch');

    Route::get('/password-recovery', function () {
        return view('auth.password-recovery');
    })->name('password-recovery');

    Route::get('/reset-password/{email}/{token}', [LoginController::class, 'showResetPasswordForm'])->name('reset-password');

    Route::fallback(function () {
        return ('Page not found');
    })->name('404');
});

Auth::routes(['verify' => true]);
