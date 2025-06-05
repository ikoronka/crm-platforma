<?php
// File: app/Http/Controllers/Auth/GoogleController.php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    /**
     * Redirect the user to Google's OAuth page.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle the callback from Google.
     */
    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();
        $user = Student::where('email', $googleUser->getEmail())->first();
        if (!$user) {
            $user = Student::create([
                'name'  => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                // Assign other necessary default values here
                // If you store a password, consider generating a random one or leaving it null for OAuth
                'password' => bcrypt(str_random(16)), // or null if allowed
            ]);
        }

        // Using the 'student' guard as an example:
        Auth::guard('student')->login($user);
        // Log the user in.
        Auth::login($user, true);

        // Redirect to a desired location (e.g., dashboard)
        return redirect()->intended(route('student.dashboard'));
    }
}
