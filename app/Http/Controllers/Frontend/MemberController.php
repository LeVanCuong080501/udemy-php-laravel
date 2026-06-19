<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\LoginRequest;
use App\Http\Requests\Frontend\RegisterRequest;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    // ==================== LOGIN ====================

    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('frontend.auth.login');
    }

    public function postLogin(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            // Chỉ cho member (level = 0) login frontend
            if (Auth::user()->level === 0) {
                return redirect()->route('home');
            }

            // Nếu là admin (level = 1) thì đăng xuất, không cho login frontend
            Auth::logout();
            return back()->withErrors(['email' => 'Tài khoản không hợp lệ.']);
        }

        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không đúng.',
        ])->withInput($request->only('email'));
    }

    // ==================== REGISTER ====================

    public function register()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        $countries = Country::orderBy('name')->get();
        return view('frontend.auth.register', compact('countries'));
    }

    public function postRegister(RegisterRequest $request)
    {
        // Xử lý upload avatar
        $avatarName = null;
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = time() . '_' . $avatar->getClientOriginalName();
            $avatar->move(public_path('upload/user/avatar'), $avatarName);
        }

        // Tạo user với level = 0 (member)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'id_country' => $request->id_country,
            'avatar' => $avatarName,
            'level' => 0, // member
        ]);

        // Tự động login sau khi đăng ký
        Auth::login($user);

        return redirect()->route('home')
            ->with('success', 'Đăng ký thành công! Chào mừng ' . $user->name);
    }

    // ==================== LOGOUT ====================

    public function logout()
    {
        Auth::logout();
        return redirect()->route('member.login')
            ->with('success', 'Đã đăng xuất thành công.');
    }
}
