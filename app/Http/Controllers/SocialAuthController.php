<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class SocialAuthController extends Controller
{
    // Redirect user to Google login
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Handle Google callback
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Find user by email or create a new one
            $user = User::updateOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => bcrypt(uniqid()), // Random password
                ]
            );

            Auth::login($user);

            return redirect()->route('home');
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['error' => 'Google authentication failed']);
        }
    }
}
