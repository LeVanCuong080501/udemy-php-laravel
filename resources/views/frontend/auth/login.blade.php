@extends('frontend.layouts.login')

@section('content')

    <section style="margin-top: 0px" id="form"><!--form-->
        <div class="container">
            <div class="row">
                <div style="margin-left: 33.333333%;" class="col-sm-4 col-sm-offset-1">
                    <div class="login-form"><!--login form-->
                        <h2>Login to your account</h2>
                        <form action="{{ route('member.login.post') }}" method="POST">
                            @csrf

                            <input value="{{ old('email') }}" name="email" type="text" placeholder="Email" />
                            @error('email')
                                <p style="color:red">{{ $message }}</p>
                            @enderror
                            <br>

                            <input name="password" type="password" placeholder="Password" />
                            @error('password')
                                <p style="color:red">{{ $message }}</p>
                            @enderror
                            <br>

                            <span>
                                <input type="checkbox" name="remember" class="checkbox">
                                Keep me signed in
                            </span>

                            @if(session('success'))
                                <p style="color:green">{{ session('success') }}</p>
                            @endif

                            @error('login_failed')
                                <p style="color:red">{{ $message }}</p>
                            @enderror

                            <button type="submit" class="btn btn-default">Sign In</button>
                        </form>
                    </div><!--/login form-->
                </div>

                <div style="margin-left: 33.333333%;" class="col-sm-4 col-sm-offset-1">
                    <div class="signup-form">
                        <button
                            style="margin-top: 23px; width: 92px; background: #FE980F; border: medium none;border-radius: 0;color: #FFFFFF;display: block;font-family: 'Roboto', sans-serif;padding: 6px 25px;"
                            onclick="window.location.href='{{ route('member.register') }}'" type="button"
                            class="btn btn-default signup-form">Sign Up</button>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/form-->
@endsection