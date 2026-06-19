<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBlogRequest;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        // Blog::all()Lấy tất cả, không sắp xếp
        // Blog::latest()->get()Lấy tất cả, mới nhất lên đầu
        // Blog::latest()->first()Chỉ lấy 1 bài mới nhất
        // Blog::latest()->paginate(10)Phân trang, 10 bài/trang
        // Blog::where('active', 1)->get()Lấy theo điều kiện

        $blogs = Blog::latest()->paginate(5);
        return view('admin.blog.index', compact('blogs'));
    }

    public function add()
    {
        return view('admin.blog.add');
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blog.edit', compact('blog'));
    }

    public function update(StoreBlogRequest $rq, $id)
    {
        // tìm blog theo id trong DB -> nếu tìm thấy thì trả về object $blog / nếu không thì trả về lỗi 404
        $blog = Blog::findOrFail($id);

        // lấy all dữ liệu từ form trừ trường 'image' vì 'image' xử lý riêng
        $data = $rq->except(['image']);

        // xử lý image
        if ($rq->hasFile('image')) {    // nếu user up ảnh mới 
            $file = $rq->file('image'); // lấy file ảnh
            if ($file->isValid()) {     // kiểm tra file ảnh có hợp lệ không
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('upload/blog'), $fileName);
                $data['image'] = $fileName;  // gán tên file mới vào DB
            }
        } else {
            $data['image'] = $blog->image;  // nếu user không up ảnh mới thì giữ nguyên ảnh cũ
        }

        $blog->update($data);
        return redirect()->route('blog.index')->with('success', 'Article updated successfully!');
    }

    public function delete($id)
    {
        Blog::findOrFail($id)->delete();
        return redirect()->route('blog.index')->with('success', 'Article deleted successfully!');
    }

    public function store(StoreBlogRequest $rq)
    {
        $data = $rq->except(['image']);

        if ($rq->hasFile('image')) {
            $file = $rq->file('image');
            if ($file->isValid()) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('upload/blog'), $fileName);
                $data['image'] = $fileName;
            }
        }

        Blog::create($data);
        return redirect()->route('blog.index')->with('success', 'Article added successfully!');
    }
}