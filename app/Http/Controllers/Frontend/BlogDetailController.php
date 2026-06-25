<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Rate;
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

        // tính TBC (mở trang và lấy điểm hiện tại để hiển thị điểm)
        $avgRate = Rate::where('blog_id', $id)->avg('score');
        $avgRate = round($avgRate, 1); // 0-5

        // giữ nguyên điểm rate khi reload
        $userRate = 0;
        if (Auth::guard('member')->check()) {
            $myRate = Rate::where('blog_id', $id)
                ->where('user_id', Auth::guard('member')->id())
                ->first();
            $userRate = $myRate ? $myRate->score : 0;
        }

        $totalRaters = Rate::where('blog_id', $id)->count();

        return view('frontend.blog.detail', compact('data', 'prev', 'next', 'avgRate', 'userRate', 'totalRaters'));
    }

    // ============= RATE =============
    public function rate(Request $request)
    {
        // user chưa login mà đánh giá sẽ báo lỗi cần phải login
        if (!Auth::guard('member')->check()) {
            // return back()->withErrors(['auth' => 'bạn cần phải đăng nhập để đánh giá bài viết']);
            return response()->json([
                'status' => 'error',
                'message' => 'Vui lòng đăng nhập để đánh giá bài viết'
            ], 401);
        }

        // Nếu đã rate rồi thì UPDATE, chưa thì CREATE
        Rate::updateOrCreate(
            [
                'blog_id' => $request->blog_id,
                'user_id' => Auth::guard('member')->id(),
            ],
            [
                'score' => $request->score,
            ]
        );

        // Tính TBC tất cả điểm của bài viết này
        $avg = Rate::where('blog_id', $request->blog_id)->avg('score');

        // round() tính TBC và show số sao tương ứng
        // sau khi click rate và tính lại TBC để trả ajax
        $roundedAvg = round($avg, 1);
        $totalRaters = Rate::where('blog_id', $request->blog_id)->count();

        return response()->json([
            'status' => 'success',
            'avg' => $roundedAvg,   // số sao hiển thị (đã làm tròn)
            'total_raters' => $totalRaters,
            'message' => 'Đánh giá thành công!'
        ]);
    }
}
