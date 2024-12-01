@extends('layouts.client')
@section('content-client')
<div class="container_fullwidth content-page">
  <div class="container">
    <div class="auth-container">
      <h2>ĐĂNG NHẬP</h2>
      <form action="{{ route('user.login') }}" method="POST" id="login-form__js">
        @csrf
        <div class="form-group">
          <div class="input-group">
            <i class="fas fa-envelope"></i>
            <input type="text" value="{{ old('email') }}" id="email" name="email" placeholder="Email của bạn">
            <span class="required">*</span>
          </div>
          @if ($errors->get('email'))
        <span id="email-error" class="error invalid-feedback" style="display: block">
        {{ implode(", ", $errors->get('email')) }}
        </span>
      @endif
        </div>
        <div class="form-group">
          <div class="input-group">
            <i class="fas fa-lock"></i>
            <input type="password" id="password" name="password" placeholder="Nhập mật khẩu">
            <span class="required">*</span>
          </div>
          @if ($errors->get('password'))
        <span id="password-error" class="error invalid-feedback" style="display: block">
        {{ implode(", ", $errors->get('password')) }}
        </span>
      @endif
        </div>
        <button class="auth-button" type="submit">Đăng nhập</button>
      </form>
      <div class="text-center">
        <a href="{{ route('auth.google') }}" class="btn btn-google">
          <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png"
            alt="Đăng nhập bằng Google">
        </a>
        <a href="{{ route('auth.facebook') }}" class="btn btn-facebook">
          <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg"
            alt="Đăng nhập bằng Facebook" style="height: 24px; margin-right: 10px;">
          Đăng nhập bằng Facebook
        </a>
      </div>
      <a href="{{ route('user.forgot_password_create') }}" class="forgot-password">Quên mật khẩu?</a>
      <a href="{{ route('user.register') }}" class="register">Đăng ký tài khoản</a>
    </div>
  </div>
</div>
@vite(['resources/common/js/login.js'])
@endsection