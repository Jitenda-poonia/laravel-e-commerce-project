<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialAuthController extends Controller
{
    public function redirectToGoogle()
    {
        try {
            return Socialite::driver('google')->redirect();
        } catch (\Exception $e) {
            return back()->with('error', 'We are unable to process Google login. Please try again.');
        }
    }


    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $user = User::where('email', $googleUser->email)->first();

            if ($user) {
                // If user exists, update the google_id and any other necessary information
                $user->update([
                    'google_id' => $googleUser->id,
                    'is_admin' => 1,
                    'email_verified_at' => now(),
                ]);
            } else {
                // If user does not exist, create a new user
                $user = User::create([
                    'google_id' => $googleUser->id,
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'is_admin' => 1,
                    'email_verified_at' => now(),
                    'password' => Hash::make(Str::random(16)),
                ]);
            }

            // Store the user avatar from Google
            if ($googleUser->avatar) {
                $user->addMediaFromUrl($googleUser->avatar)->toMediaCollection('profile_photos');
            }

            // Log the user in
            Auth::login($user, true);

            // Continue with your logic...
            return redirect()->route('dashboard')->with('success', 'User Login Successfully');

        } catch (\Exception $e) {
            return redirect('login')->with('error', 'Unable to login using Google. Please try again.');
        }
    }

}
