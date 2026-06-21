<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateProfileRequest;
use App\Models\Country;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function user()
    {
        $user = Auth::user();
        $countries = Country::all();

        return view('admin.user.profile', compact('user', 'countries'));
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        // request()->session()->invalidate();
        // request()->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function update(UpdateProfileRequest $rq)
    {
        // lấy id của user ra
        $userId = Auth::id();

        // hàm sql lấy all thông tin của user vừa lấy id
        $user = User::findOrFail($userId);

        // lấy all thông tin từ form nhập vào
        $data = $rq->all();

        // lấy thông tin của file uploads
        // if ($rq->hasFile('filesTest')) {
        //     echo "aaa";
        //     $file = $rq->filesTest;

        //     //Lấy Tên files
        //     echo 'Tên Files: ' . $file->getClientOriginalName();
        //     echo '<br/>';

        //     //Lấy Đuôi File
        //     echo 'Đuôi file: ' . $file->getClientOriginalExtension();
        //     echo '<br/>';

        //     //Lấy đường dẫn tạm thời của file
        //     echo 'Đường dẫn tạm: ' . $file->getRealPath();
        //     echo '<br/>';

        //     //Lấy kích cỡ của file đơn vị tính theo bytes
        //     echo 'Kích cỡ file: ' . $file->getSize();
        //     echo '<br/>';

        //     //Lấy kiểu file
        //     echo 'Kiểu files: ' . $file->getMimeType();

        //     $file->move('upload', $file->getClientOriginalName());
        // }


        // Xử lý avatar
        if ($rq->hasFile('avatar')) {
            $file = $rq->file('avatar');
            $data['avatar'] = time() . '_' . $file->getClientOriginalName();
        } else {
            $data['avatar'] = $user->avatar;
        }

        // kiểm tra nếu có nhập pass mới 
        if ($data['password']) {
            $data['password'] = bcrypt($data['password']);   //thì mã hoá và đưa vào mảng data
        } else {
            $data['password'] = $user->password;    //nếu không thì lấy lại pass cũ
        }

        // dd($data);
        // dd($user->update($data));

        // update all thông tin có trong mảng data vào table user có id vừa lấy ra
        if ($user->update($data)) {
            if (!empty($file)) {
                $file->move(public_path('upload/user/avatar'), $data['avatar']);
            }
            // dd(Auth::user());
            return redirect()->back()->with('success', __('Update profile success.'));
        } else {
            return redirect()->back()->withErrors('Update profile error.');
        }
    }
}
