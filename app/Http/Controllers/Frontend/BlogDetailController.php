<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\Frontend\StoreCommentRequest;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\Rate;


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

        // Lấy comments khi load trang
        $comments = Comment::where('blog_id', $data->id)
            ->whereNull('parent_id')       // chỉ lấy cmt cha
            ->with(['user', 'replies.user']) // eager load user + replies kèm user của reply
            ->orderBy('created_at', 'desc')
            ->get();

        return view('frontend.blog.detail', compact('data', 'prev', 'next', 'avgRate', 'userRate', 'totalRaters', 'comments'));
    }

    // ============= RATE =============
    public function rate(Request $request)
    {
        // user chưa login mà đánh giá sẽ báo lỗi cần phải login
        if (!Auth::guard('member')->check()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Vui lòng đăng nhập để đánh giá bài viết'
            ], 401);
        }

        // ================= phần này dùng cho user vote 1 lần =================
        $userId = Auth::guard('member')->id();
        $blogId = $request->blog_id;
        $checkRate = Rate::where('user_id', $userId)
            ->where('blog_id', $blogId)
            ->first();
        if ($checkRate) {
            return response()->json([
                'status' => 'already_rated',
                'message' => 'Bạn đã đánh giá bài viết này rồi!'
            ], 400);
        } else {
            Rate::create([
                'blog_id' => $blogId,
                'user_id' => $userId,
                'score' => $request->score,
            ]);
        }
        // ======================================================================

        // Nếu đã rate rồi thì UPDATE, chưa thì CREATE === phần này dùng cho user vote nhiều lần
        // Rate::updateOrCreate(
        //     [
        //         'blog_id' => $request->blog_id,
        //         'user_id' => Auth::guard('member')->id(),
        //     ],
        //     [
        //         'score' => $request->score,
        //     ]
        // );

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

    // ============= COMMENT =============
    // Gửi comment cha
    public function storeComment(StoreCommentRequest $request, Blog $blog)
    {
        // Kiểm tra login (middleware đã chặn nhưng check thêm cho chắc)
        if (!Auth::guard('member')->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Vui lòng đăng nhập để bình luận!'
            ], 401);
        }

        $comment = Comment::create([
            'blog_id' => $blog->id,
            'user_id' => Auth::guard('member')->id(),
            'parent_id' => null,
            'content' => $request->validated('content'),
        ]);

        // Load thêm thông tin user để trả về
        $comment->load('user');

        return response()->json([
            'success' => true,
            'comment' => [
                'id' => $comment->id,
                'content' => $comment->content,
                'created_at' => $comment->created_at->diffForHumans(),
                'user' => [
                    'name' => $comment->user->name,
                    'avatar' => $comment->user->avatar
                        ? asset('uploads/avatars/' . $comment->user->avatar)
                        : asset('frontend/images/default-avatar.png'),
                ],
            ],
        ]);
    }

    // Gửi reply (comment con)
    public function storeReply(StoreCommentRequest $request, Comment $comment)
    {
        if (!Auth::guard('member')->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Vui lòng đăng nhập để bình luận'
            ], 401);
        }

        $reply = Comment::create([
            'blog_id' => $comment->blog_id,
            'user_id' => Auth::guard('member')->id(),
            'parent_id' => $comment->id,
            'content' => $request->validated('content'),
        ]);

        $reply->load('user');

        return response()->json([
            'success' => true,
            'reply' => [
                'id' => $reply->id,
                'content' => $reply->content,
                'created_at' => $reply->created_at->diffForHumans(),
                'parent_id' => $reply->parent_id,
                'user' => [
                    'name' => $reply->user->name,
                    'avatar' => $reply->user->avatar
                        ? asset('uploads/avatars/' . $reply->user->avatar)
                        : asset('frontend/images/default-avatar.png'),
                ],
            ],
        ]);
    }
}
