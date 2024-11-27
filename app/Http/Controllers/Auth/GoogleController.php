<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                $user = $this->createNewUser($googleUser);
            }

            Auth::login($user);

            return redirect()->route('user.home');
        } catch (\Exception $e) {

            return redirect()->route('user.login')
                             ->with('error', 'Lỗi đăng nhập bằng Google.');
        }
    }

    private function createNewUser($googleUser)
    {
        $defaultRoleId = 3; 

        return User::create([
            'name'              => $googleUser->getName(),
            'email'             => $googleUser->getEmail(),
            'google_id'         => $googleUser->getId(),
            'password'          => bcrypt('Luu@customer2003'), 
            'phone_number'      => '0889347459', 
            'role_id'           => $defaultRoleId,
            'email_verified_at' => now(),
        ]);
    }
}
