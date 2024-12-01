@extends('layouts.client')
@section('content-client')
<div class="container_fullwidth content-page">
  <div class="container">
    <div class="auth-container" style="margin:0px;">
      <h2>ĐĂNG KÝ THÀNH VIÊN MỚI</h2>
      <div id="form-data" hidden data-rules="{{ json_encode($rules) }}" data-messages="{{ json_encode($messages) }}">
      </div>
      <form action="{{ route('user.register') }}" method="POST" id="form__js">
        @csrf
        <div class="form-group">
          <div class="input-group">
            <i class="fas fa-user"></i>
            <input type="text" value="{{ old('name') }}" id="name" name="name" aria-describedby="emailHelp"
              placeholder="Nhập họ và tên">
            <span class="required">*</span>
          </div>
          @if ($errors->get('name'))
        <span id="name-error" class="error invalid-feedback" style="display: block">
        {{ implode(", ", $errors->get('name')) }}
        </span>
      @endif
        </div>
        <div class="form-group">
          <div class="input-group">
            <i class="fas fa-envelope"></i>
            <input type="email" value="{{ old('email') }}" id="email" name="email" aria-describedby="emailHelp"
              placeholder="Nhập email">
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
            <input type="password" value="{{ old('password') }}" id="password" name="password"
              placeholder="Nhập mật khẩu">
            <span class="required">*</span>
          </div>
          @if ($errors->get('password'))
        <span id="password-error" class="error invalid-feedback" style="display: block">
        {{ implode(", ", $errors->get('password')) }}
        </span>
      @endif
        </div>
        <div class="form-group">
          <div class="input-group">
            <i class="fas fa-lock"></i>
            <input type="password" value="{{ old('password_confirmation') }}" id="password_confirm"
              name="password_confirm" placeholder="Xác nhận mật khẩu">
            <span class="required">*</span>
          </div>
          @if ($errors->get('password_confirm'))
        <span id="password_confirm-error" class="error invalid-feedback" style="display: block">
        {{ implode(", ", $errors->get('password_confirm')) }}
        </span>
      @endif
        </div>
        <div class="form-group">
          <div class="input-group">
            <i class="fas fa-phone"></i>
            <input type="text" value="{{ old('phone_number') }}" id="phone_number" name="phone_number"
              aria-describedby="emailHelp" placeholder="Nhập số điện thoại">
            <span class="required">*</span>
          </div>
          @if ($errors->get('phone_number'))
        <span id="phone_number-error" class="error invalid-feedback" style="display: block">
        {{ implode(", ", $errors->get('phone_number')) }}
        </span>
      @endif
        </div>
        <div class="form-group">
          <div class="input-group">
            <i class="fas fa-map-marker-alt"></i>
            <select id="city" name="city">
              @foreach ($citys as $city)
          <option value="{{ $city['ProvinceID'] }}" @if ($city['ProvinceID'] == old('city')) selected @endif>
          {{ $city['NameExtension'][1] }}
          </option>
        @endforeach
            </select>
          </div>
          @if ($errors->get('city'))
        <span id="city-error" class="error invalid-feedback" style="display: block">
        {{ implode(", ", $errors->get('city')) }}
        </span>
      @endif
        </div>
        <div class="form-group">
          <div class="input-group">
            <i class="fas fa-map-marker-alt"></i>
            <select id="district" name="district">
              @foreach ($districts as $district)
          <option value="{{ $district['DistrictID'] }}" @if ($district['DistrictID'] == old('district')) selected
      @endif>{{ $district['DistrictName'] }}</option>
        @endforeach
            </select>
          </div>
          @if ($errors->get('district'))
        <span id="district-error" class="error invalid-feedback" style="display: block">
        {{ implode(", ", $errors->get('district')) }}
        </span>
      @endif
        </div>
        <div class="form-group">
          <div class="input-group">
            <i class="fas fa-map-marker-alt"></i>
            <select id="ward" name="ward">
              @foreach ($wards as $ward)
          <option value="{{ $ward['WardCode'] }}" @if ($ward['WardCode'] == old('ward')) selected @endif>
          {{ $ward['WardName'] }}
          </option>
        @endforeach
            </select>
          </div>
          @if ($errors->get('ward'))
        <span id="ward-error" class="error invalid-feedback" style="display: block">
        {{ implode(", ", $errors->get('ward')) }}
        </span>
      @endif
        </div>
        <div class="form-group">
          <div class="input-group">
            <i class="fas fa-home"></i>
            <input type="text" value="{{ old('apartment_number') }}" id="apartment_number" name="apartment_number"
              aria-describedby="emailHelp" placeholder="Nhập địa chỉ nhà">
            <span class="required">*</span>
          </div>
          @if ($errors->get('apartment_number'))
        <span id="apartment_number-error" class="error invalid-feedback" style="display: block">
        {{ implode(", ", $errors->get('apartment_number')) }}
        </span>
      @endif
        </div>
        <button class="auth-button" type="submit">Đăng ký</button>
      </form>
      <div class="login">
        <span>Bạn đã có tài khoản?</span>
        <a href="{{ route('user.login') }}">Đăng nhập</a>
      </div>
    </div>
  </div>
</div>
@vite(['resources/client/js/register.js'])
@endsection