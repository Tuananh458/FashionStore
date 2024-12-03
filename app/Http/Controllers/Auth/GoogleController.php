<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\Address;  // Import model Address
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

            // Kiểm tra xem người dùng có thông tin địa chỉ chưa, nếu chưa thì tạo mới
            if (!$user->address) {
                $this->createDefaultAddress($user);  // Tạo thông tin địa chỉ mặc định
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

    // Hàm tạo thông tin địa chỉ mặc định cho người dùng
    private function createDefaultAddress($user)
    {
        Address::create([
            'user_id'          => $user->id,
            'city'             => 'Hà Nội',   // Địa chỉ mặc định
            'district'         => 'Quận Hoàn Kiếm',
            'ward'             => 'Phường Hàng Bông',
            'apartment_number' => 'Số 1, Phố Hàng Bông', // Địa chỉ mặc định
        ]);
    }
}
