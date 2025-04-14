<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

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

    public function sendRecoveryEmail(Request $request)
    {
        // Validate the email address
        $request->validate([
            'email' => 'required|email',
        ]);

        // Check if the user exists
        $user = User::where('email', $request->email)->first();

        if ($user) {
            // Generate a token
            $token = Str::random(60);

            // Save the token and email in the password_reset_tokens table
            DB::table('password_reset_tokens')->updateOrInsert(
                ['email' => $user->email],
                ['token' => $token, 'created_at' => now()]
            );

            // Generate the reset password link
            $resetLink = route('reset-password', ['email' => $user->email, 'token' => $token]);

            // Send the recovery email
            Mail::raw(__('messages.password_recovery.email_text') . $resetLink, function ($message) use ($user) {
                $message->to($user->email)
                        ->subject('Password Recovery');
            });

            return view('auth.email-sent');
        }

        // If user does not exist, redirect back with an error message
        return back()->withErrors([
            'email' => __('messages.password_recovery.email_not_found'),
        ])->onlyInput('email');
    }

    public function showResetPasswordForm($email, $token)
    {
        // Validate the email and token
        $passwordReset = DB::table('password_reset_tokens')->where([
            'email' => $email,
            'token' => $token,
        ])->first();

        if (!$passwordReset) {
            return redirect()->route('password-recovery')->withErrors(['token' => 'Invalid or expired token.']);
        }

        return view('auth.reset-password', ['email' => $email, 'token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => [
                'required',
                'confirmed',
                Password::min(10) // Minimum 10 characters
                    ->mixedCase() // At least one uppercase and one lowercase letter
                    ->letters()   // At least one letter
                    ->numbers()   // At least one number
                    ->symbols(),  // At least one symbol
            ],
        ]);

        // Check if the token is valid (you may need to implement token validation logic)
        $passwordReset = DB::table('password_reset_tokens')->where([
            'email' => $request->email,
            'token' => $request->token,
        ])->first();

        if (!$passwordReset) {
            return back()->withErrors(['token' => 'Invalid or expired token.']);
        }

        // Update the user's password
        $user = User::where('email', $request->email)->first();

        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();

            // Delete the token after successful password reset
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();

            return redirect()->route('login')->with('status', 'Password reset successfully.');
        }

        return back()->withErrors(['email' => 'No user found with this email address.']);
    }
}
