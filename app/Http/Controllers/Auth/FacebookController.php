<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FacebookController extends Controller
{
    public function redirectToFacebook()
    {
        echo "Hello";
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        echo "Sao rồi";
        try {
            $facebookUser = Socialite::driver('facebook')->user();

            $user = User::where('email', $facebookUser->getEmail())->first();

            if (!$user) {
                $user = $this->createNewUser($facebookUser);
            }

            Auth::login($user);

            return redirect()->route('user.home');
        } catch (\Exception $e) {
            return redirect()->route('user.login')
                             ->with('error', 'Lỗi đăng nhập bằng Facebook.');
        }
    }

    
    private function createNewUser($facebookUser)
    {
        $defaultRoleId = 3; 

        return User::create([
            'name'              => $facebookUser->getName(),
            'email'             => $facebookUser->getEmail(),
            // 'facebook_id'       => $facebookUser->getId(),
            'password'          => bcrypt('Luu@customer2003'), 
            'phone_number'      => '0889347459', 
            'role_id'           => $defaultRoleId,
            'email_verified_at' => now(),
        ]);
    }
}
