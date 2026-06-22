@extends('frontend.layouts.main')

@section('content')
    <section>
        <div class="container">
            <div class="row">

                {{-- Nội dung chi tiết bài viết --}}
                <div class="col-sm-9">
                    <div class="blog-post-area">

                        <div class="single-blog-post">

                            {{-- Tiêu đề --}}
                            <h3>{{ $data->title }}</h3>

                            {{-- Meta --}}
                            <div class="post-meta">
                                <ul>
                                    <li><i class="fa fa-user"></i> {{ $data->user->name ?? 'Admin' }}</li>
                                    <li><i class="fa fa-clock-o"></i> {{ $data->created_at->format('g:i a') }}</li>
                                    <li><i class="fa fa-calendar"></i> {{ $data->created_at->format('M j, Y') }}</li>
                                </ul>
                            </div>

                            {{-- Ảnh bài viết --}}
                            @if($data->image)
                                <img src="{{ asset('upload/blog/' . $data->image) }}" alt="{{ $data->title }}"
                                    style="width:100%; max-height:400px; object-fit:cover; margin-bottom:15px;">
                            @endif

                            {{-- Nội dung đầy đủ (render HTML từ CKEditor) --}}
                            <div class="blog-content">
                                {!! $data->description !!}
                                {!! $data->content !!}
                            </div>

                            {{-- Phân trang Prev / Next --}}
                            <div class="pager-area" style="margin-top: 20px;">
                                <ul class="pager">
                                    {{--
                                    $prev: bài viết CŨ HƠN (created_at nhỏ hơn)
                                    Nếu $prev = null → không có bài trước → ẩn nút
                                    --}}
                                    @if($prev)
                                        <li class="previous">
                                            <a href="{{ route('blog.detail', $prev->id) }}">
                                                <i class="fa fa-angle-left"></i> Prev
                                            </a>
                                        </li>
                                    @endif

                                    {{--
                                    $next: bài viết MỚI HƠN (created_at lớn hơn)
                                    Nếu $next = null → không có bài sau → ẩn nút
                                    --}}
                                    @if($next)
                                        <li class="next">
                                            <a href="{{ route('blog.detail', $next->id) }}">
                                                Next <i class="fa fa-angle-right"></i>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </div>

                        </div>
                    </div><!--/blog-post-area-->

                    {{-- Nút quay lại danh sách --}}
                    <div style="margin-bottom: 20px;">
                        <a href="{{ route('blog.index') }}" class="btn btn-default">
                            <i class="fa fa-arrow-left"></i> Back to Blog
                        </a>
                    </div>

                </div>
                {{-- /col-sm-9 --}}

            </div>
        </div>
    </section>
@endsection