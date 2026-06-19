@extends('layouts.app')

@section('content')
    <!-- <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-md-8">
                                            <div class="card">
                                                <div class="card-header">{{ __('Login') }}</div>

                                                <div class="card-body">
                                                    <form method="POST" action="{{ route('login') }}">
                                                        @csrf

                                                        <div class="row mb-3">
                                                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                                            <div class="col-md-6">
                                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                                                @error('email')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                                            <div class="col-md-6">
                                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                                                @error('password')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <div class="col-md-6 offset-md-4">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                                    <label class="form-check-label" for="remember">
                                                                        {{ __('Remember Me') }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-0">
                                                            <div class="col-md-8 offset-md-4">
                                                                <button type="submit" class="btn btn-primary">
                                                                    {{ __('Login') }}
                                                                </button>

                                                                @if (Route::has('password.request'))
                                                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                                                        {{ __('Forgot Your Password?') }}
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login - Card</title>
        <link href="{{ asset('admin/css/style.min.css') }}" rel="stylesheet">
        <style>
            body {
                margin: 0;
                font-family: 'Rubik', sans-serif;
                min-height: 100vh;
                background: linear-gradient(135deg, #7460ee 0%, #233242 100%);
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 20px;
            }

            .login-card {
                background: #fff;
                border-radius: 8px;
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
                width: 100%;
                max-width: 400px;
                overflow: hidden;
            }

            .card-top {
                background: #233242;
                padding: 30px;
                text-align: center;
            }

            .card-top .avatar {
                width: 70px;
                height: 70px;
                border-radius: 50%;
                background: rgba(116, 96, 238, 0.3);
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 15px;
            }

            .card-top .avatar img {
                width: 35px;
            }

            .card-top h4 {
                color: #fff;
                margin: 0;
                font-weight: 400;
            }

            .card-body-custom {
                padding: 30px;
            }

            .form-control {
                height: 42px;
                border-radius: 2px;
                background: #f6fafe;
                border-color: #e9ecef;
            }

            .form-control:focus {
                background: #fff;
            }

            label {
                font-size: 12px;
                font-weight: 500;
                color: #afb5c1;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .btn-login {
                background: #7460ee;
                border: none;
                border-radius: 2px;
                height: 44px;
                width: 100%;
                color: #fff;
                font-weight: 500;
                font-size: 14px;
                letter-spacing: 0.5px;
                box-shadow: 0 4px 15px rgba(116, 96, 238, 0.4);
                transition: all 0.2s;
            }

            .btn-login:hover {
                background: #563dea;
                color: #fff;
                box-shadow: 0 6px 20px rgba(116, 96, 238, 0.5);
                transform: translateY(-1px);
            }

            .forgot-link {
                color: #7460ee;
                font-size: 13px;
            }

            .divider {
                text-align: center;
                color: #afb5c1;
                font-size: 12px;
                margin: 20px 0;
                position: relative;
            }

            .divider::before {
                content: '';
                position: absolute;
                top: 50%;
                left: 0;
                right: 0;
                height: 1px;
                background: #e9ecef;
            }

            .divider span {
                background: #fff;
                padding: 0 10px;
                position: relative;
            }
        </style>
    </head>

    <body>
        <div class="login-card">
            <div class="card-top">
                <div class="avatar">
                    <img src="{{ asset('admin/assets/images/logo-icon.png') }}" alt="Logo">
                </div>
                <h4>Admin Panel</h4>
            </div>

            <div class="card-body-custom">
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror" placeholder="example@gmail.com"
                            required autofocus>
                        @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                            placeholder="••••••••" required>
                        @error('password') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="remember"
                                style="font-size:13px; text-transform:none; letter-spacing:0; color:#6a7a8c;">
                                Remember Me
                            </label>
                        </div>
                        @if(Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="forgot-link">Forgot Your Password?</a>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-login">Login</button>
                </form>
            </div>
        </div>
        <script src="{{ asset('admin/assets/libs/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('admin/assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    </body>
    </html>
@endsection