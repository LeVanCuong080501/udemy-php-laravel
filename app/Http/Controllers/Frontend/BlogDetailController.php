<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogDetailController extends Controller
{
    public function index()
    {
        $posts = Blog::latest()->paginate(3);
        return view('frontend.blog.index', compact('posts'));
    }

    public function detail($id)
    {
        // lấy bài viết theo id ra
        $data = Blog::findOrFail($id);

        $prev = Blog::where('created_at', '<', $data->created_at)
            ->orderBy('created_at', 'desc')
            ->first();

        $next = Blog::where('created_at', '>', $data->created_at)
            ->orderBy('created_at', 'asc')
            ->first();

        return view('frontend.blog.detail', compact('data', 'prev', 'next'));
    }

    // ============= RATE =============
    public function rate(Request $request)
    {
        // user chưa login mà đánh giá sẽ báo lỗi cần phải login
        if (!Auth::check()) {
            return back()->withErrors(['auth' => 'bạn cần phải đăng nhập để đánh giá bài viết']);
        }
        
    }
}
