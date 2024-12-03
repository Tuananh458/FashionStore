<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function logout(Request $request)
    {
        Auth::logout(); // Đăng xuất người dùng hiện tại

        $request->session()->invalidate(); // Xóa session
        $request->session()->regenerateToken(); // Tạo CSRF token mới

        return redirect('/login'); // Điều hướng về trang login
    }
}
