@extends('layouts.admin-auth')
@section('content-auth')
<div class="login-box">
    <div class="card card-outline card-primary shadow-lg">
        <div class="card-header text-center bg-primary text-white py-4">
            <a href="#" class="h1"><b>Admin</b></a>
        </div>
        <div class="card-body">
            <p class="login-box-msg text-center text-dark"><b>Đăng Nhập Hệ Thống</b></p>

            @if ($errors->get('disable_reason'))
                <div class="alert alert-danger text-center mb-4">
                    {{ implode(", ", $errors->get('disable_reason')) }}
                </div>
            @endif

            <form action="{{ route('admin.login') }}" method="post" id="login-form__js">
                @csrf
                <div class="form-group mb-3">
                    <x-admin-input 
                        id="email" 
                        type="text" 
                        value="{{ old('email') }}" 
                        name="email" 
                        placeholder="Email" 
                        class="form-control form-control-lg rounded-pill shadow-sm"
                    />
                    @if ($errors->get('email'))
                        <div class="invalid-feedback d-block">
                            {{ implode(", ", $errors->get('email')) }}
                        </div>
                    @endif
                </div>

                <div class="form-group mb-4">
                    <x-admin-input 
                        id="password" 
                        type="password" 
                        value="{{ old('password') }}" 
                        name="password" 
                        placeholder="Mật khẩu" 
                        class="form-control form-control-lg rounded-pill shadow-sm"
                    />
                    @if ($errors->get('password'))
                        <div class="invalid-feedback d-block">
                            {{ implode(", ", $errors->get('password')) }}
                        </div>
                    @endif
                </div>

                <div class="form-group mb-3 text-center">
                    <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 py-3 w-100">
                        Đăng Nhập
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Add custom CSS --}}
<style>
    /* Custom background color for login box */
    .login-box {
        width: 360px;
        margin: 80px auto;
    }

    /* Card styling */
    .card {
        border-radius: 15px;
        border: none;
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
    }

    /* Card header styling */
    .card-header {
        background-color: #007bff;
        color: white;
    }

    /* Title of the form */
    .login-box-msg {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 30px;
    }

    /* Input field styling */
    .form-control {
        height: 45px;
        border-radius: 30px;
        font-size: 16px;
    }

    /* Custom button style */
    .btn-primary {
        background-color: #007bff;
        border: none;
        color: white;
        font-size: 16px;
        font-weight: bold;
        padding: 12px 30px;
        width: 100%;
        border-radius: 30px;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        transition: background-color 0.3s ease-in-out;
    }

    /* Error message styling */
    .invalid-feedback {
        font-size: 14px;
        color: #e74c3c;
    }

    /* Custom shadow on form controls */
    .form-control-lg {
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Align the input fields and button */
    .form-group {
        margin-bottom: 20px;
    }
</style>
@endsection
