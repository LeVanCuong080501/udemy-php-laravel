@extends('frontend.layouts.register')

@section('content')
    <section><!--form-->
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="login-form">

                        <h2>New User Signup!</h2>
                        <p>Already have an account? <a href="{{ route('member.login') }}">Login here</a></p>

                        {{-- Thông báo lỗi --}}
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form style="margin-bottom: 100px" action="{{ route('member.register.post') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            {{-- Avatar preview --}}
                            <div class="text-center" style="margin-bottom: 20px;">
                                <img id="avatarPreview" src="{{ asset('frontend/images/home/default-avatar.png') }}"
                                    class="img-circle" width="120" height="120"
                                    style="cursor:pointer; border: 3px solid #eee; object-fit: cover;"
                                    onclick="document.getElementById('avatarInput').click()"
                                    title="Click để chọn ảnh đại diện" />
                                <p style="margin-top: 8px; color: #999; font-size: 13px;">
                                    Click vào ảnh để thay đổi
                                </p>
                                <input type="file" id="avatarInput" name="avatar" accept="image/*" style="display: none"
                                    onchange="previewAvatar(this)">
                            </div>

                            {{-- Full Name --}}
                            <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}" />

                            {{-- Email --}}
                            <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" />

                            {{-- Password --}}
                            <input type="password" name="password" placeholder="Password" />

                            {{-- Confirm Password --}}
                            <input type="password" name="password_confirmation" placeholder="Confirm Password" />

                            {{-- Phone --}}
                            <input type="text" name="phone" placeholder="Phone Number" value="{{ old('phone') }}" />

                            {{-- Address --}}
                            <input type="text" name="address" placeholder="Address" value="{{ old('address') }}" />

                            {{-- Select Country --}}
                            <select name="id_country"
                                style="width:100%; padding: 8px; margin-bottom: 15px; border: 1px solid #ddd;">
                                <option value="">-- Select Country --</option>
                                @forelse($countries as $country)
                                    <option value="{{ $country->id }}" {{ old('id_country') == $country->id ? 'selected' : '' }}>
                                        {{ $country->name }}
                                    </option>
                                @empty
                                    <option value="">No countries available</option>
                                @endforelse
                            </select>

                            <button type="submit" class="btn btn-default">Signup</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/form-->

    <script>
        function previewAvatar(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('avatarPreview').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection