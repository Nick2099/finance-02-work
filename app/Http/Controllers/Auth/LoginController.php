<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle the login request.
     */
    public function login(Request $request)
    {
        // Validate the login credentials
        $request->validate([
            'email' => 'required|string',
            'password' => 'required',
        ]);

        // Attempt to log the user in using email and password
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Regenerate the session to prevent session fixation attacks
            $request->session()->regenerate();

            // Set the session locale to the user's preferred language
            $user = Auth::user();
            $language = $user->details->language ?? config('app.locale');
            $request->session()->put('locale', $language);

            // Redirect to the intended page or dashboard
            return redirect()->route('home');
        }

        // If login fails, redirect back with an error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records. ' . $request->email . ' ' . $request->password,
        ])->onlyInput('email');
    }
    /**
     * Handle the logout request.
     */
    public function logout(Request $request)   
    {
        // Log the user out
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the CSRF token
        $request->session()->regenerateToken();

        // Redirect to the login page or home page
        return redirect()->route('home');
    }

    public function send_recovery_email(Request $request)
    {
        // Validate the email address
        $request->validate([
            'email' => 'required|email',
        ]);

        // Check if the user exists
        if (User::where('email', $request->email)->exists()) {

            Mail::raw('This is a test email from Mailtrap!', function ($message) use ($request) {
                $message->to($request->email)
                        ->subject('Test Email');
            });
            return view('auth.email-sent');
        }

        // If login fails, redirect back with an error message
        return back()->withErrors([
            'email' => __('messages.password_recovery.email_not_found'),
        ])->onlyInput('email');
        return back()->with('status', 'Recovery link sent to your email address.');
    }
}
