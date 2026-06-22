@extends('frontend.layouts.main')

@section('content')
    <section>
        <div class="container">
            <div class="row">
                {{-- Nội dung chính: danh sách blog --}}
                <div class="col-sm-9">
                    <div class="blog-post-area">
                        <h2 class="title text-center">Latest From our Blog</h2>
                        
                        {{-- Lặp qua từng bài viết --}}
                        @forelse($posts as $post)
                            <div class="single-blog-post">

                                {{-- Tiêu đề bài viết --}}
                                <h3>{{ $post->title }}</h3>

                                {{-- Meta: tác giả, giờ, ngày --}}
                                <div class="post-meta">
                                    <ul>
                                        <li><i class="fa fa-user"></i> {{ $post->user->name ?? 'Admin' }}</li>
                                        <li><i class="fa fa-clock-o"></i> {{ $post->created_at->format('g:i a') }}</li>
                                        <li><i class="fa fa-calendar"></i> {{ $post->created_at->format('M j, Y') }}</li>
                                    </ul>
                                </div>

                                {{-- Ảnh bài viết (click vào ảnh → sang trang detail) --}}
                                <a href="{{ route('blog.detail', $post->id) }}">
                                    @if($post->image)
                                        <img src="{{ asset('upload/blog/' . $post->image) }}" alt="{{ $post->title }}"
                                            style="width:33%; max-height:300px; object-fit:cover;">
                                    @else
                                        <img src="{{ asset('frontend/images/blog/blog-one.jpg') }}" alt="{{ $post->title }}">
                                    @endif
                                </a>

                                {{-- Mô tả ngắn (strip HTML nếu content là CKEditor) --}}
                                <p>{{ Str::limit(strip_tags($post->description), 200) }}</p>

                                {{-- Nút đọc thêm → sang trang detail --}}
                                <a class="btn btn-primary" href="{{ route('blog.detail', $post->id) }}">Read More</a>
                            </div>
                        @empty
                            <p class="text-center">Chưa có bài viết nào.</p>
                        @endforelse

                        {{-- Phân trang Bootstrap 4 --}}
                        <div class="pagination-area">
                            {!! $posts->links('pagination::bootstrap-4') !!}
                        </div>

                    </div>
                </div>
                {{-- /col-sm-9 --}}

            </div>
        </div>
    </section>
@endsection
