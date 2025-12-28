<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class GoogleAuthController extends Controller
{
    /**
     * Redirect to Google OAuth
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle Google OAuth callback
     */
    public function handleGoogleCallback()
    {
        try {
            /** @var \Laravel\Socialite\Two\User $googleUser */
            $googleUser = Socialite::driver('google')->user();
            
            // Find or create user
            $user = User::where('email', $googleUser->email)->first();
            
            if ($user) {
                // User exists, update Google info if needed
                $user->update([
                    'provider_login' => 'google',
                    'email_verified_at' => now(), // Google emails are verified
                ]);
            } else {
                // Create new user
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'provider_login' => 'google',
                    'email_verified_at' => now(),
                    'password' => null, // No password for Google login
                ]);
            }
            
            // Login the user
            Auth::login($user);
            
            return redirect()->route('dashboard')->with('status', 'Berhasil masuk dengan Google!');
            
        } catch (Exception $e) {
            return redirect()->route('login')->with('error', 'Gagal login dengan Google. Silakan coba lagi.');
        }
    }
}
