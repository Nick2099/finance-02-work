<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'confirmed',
                Password::min(10) // Minimum 10 characters
                    ->mixedCase() // At least one uppercase and one lowercase letter
                    ->letters()   // At least one letter
                    ->numbers()   // At least one number
                    ->symbols(),  // At least one symbol
            ],
            'timezone' => 'nullable|string|max:50',
            'language' => 'required|string|in:en,hr,de,fr,es',
        ]);

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Create default user details
        $user->details()->create([
            'main_user' => true, // Default value
            'main_user_no' => null, // Default value
            'custom_groups' => false, // Default value
            'custom_groups_id' => null, // Default value
            'level' => 1, // Default value
            'admin_level' => 1, // Default value
            'timezone' => $request->timezone ?? 'UTC', // Save the selected timezone
            'language' => $request->language ?? 'en',
        ]);

        // Log the user in
        Auth::login($user);

        // Redirect to the home page
        return redirect()->route('home');
    }
}
