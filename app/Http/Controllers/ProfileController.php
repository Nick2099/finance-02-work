<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user(); // Get the authenticated user
        return view('profile', compact('user'));
    }
}