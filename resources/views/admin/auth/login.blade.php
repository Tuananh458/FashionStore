@extends('layouts.admin-auth')
@section('content-auth')
<div class="auth-container">
  <h1><b>ADMIN</b></h1>
  <h2>ĐĂNG NHẬP HỆ THỐNG</h2>
  @if ($errors->get('disable_reason'))
      <span class="error invalid-feedback" style="display: block">
      {{ implode(", ", $errors->get('disable_reason')) }}
      </span>
    @endif
  <form action="{{ route('admin.login') }}" method="post" id="login-form__js">
    @csrf
    <div class="form-group">
      <div class="input-group">
        <i class="fas fa-envelope"></i>
        <input id="email" type="text" value="{{ old('email') }}" name="email" placeholder="Email" />
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
        <input id="password" type="password" value="{{ old('password') }}" name="password"
            placeholder="Mật khẩu" />
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
</div>
@vite(['resources/common/js/login.js'])
@endsection