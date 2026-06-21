<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    //     $this->middleware('auth')->only('logout');
    // }

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    // Dùng guard 'admin'
    protected function guard()
    {
        return Auth::guard('admin');
    }

    // Sau khi login - check thêm level = 1
    protected function authenticated($request, $user)
    {
        if ($user->level !== 1) {
            $this->guard()->logout();
            return redirect()->route('login')
                ->withErrors(['email' => 'Tài khoản không đủ quyền truy cập.']);
        }
    }
}
