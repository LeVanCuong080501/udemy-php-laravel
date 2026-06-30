@extends('frontend.layouts.main')
<style>
    .comment-section {
        padding: 1.5rem 0;
    }

    .comment-list {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .comment-card {
        background: #fff;
        border: 0.5px solid #e0e0e0;
        border-radius: 12px;
        padding: 1rem 1.25rem;
        display: flex;
        gap: 14px;
    }

    .comment-card.reply {
        margin-left: 48px;
        border-left: 2px solid #378ADD;
        border-radius: 0 12px 12px 0;
    }

    .bg-cmt {
        background: #ededed;
    }

    .avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        flex-shrink: 0;
        border: 0.5px solid #e0e0e0;
    }

    .comment-body {
        flex: 1;
        min-width: 0;
    }

    .comment-meta {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 6px 14px;
        margin-bottom: 8px;
    }

    .author {
        font-size: 14px;
        font-weight: 500;
        color: #222;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 4px;
        font-size: 12px;
        color: #999;
    }

    .stars {
        display: flex;
        gap: 2px;
        margin-bottom: 8px;
    }

    .star {
        font-size: 14px;
        color: #EF9F27;
    }

    .star.empty {
        color: #ddd;
    }

    .comment-text {
        font-size: 14px;
        color: #555;
        line-height: 1.65;
        margin-bottom: 10px;
    }

    .reply-btn {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 12px;
        color: #378ADD;
        border: 0.5px solid #378ADD;
        border-radius: 6px;
        padding: 4px 10px;
        background: transparent;
        cursor: pointer;
        text-decoration: none;
    }

    .reply-btn:hover {
        background: #E6F1FB;
    }

    .section-title {
        font-size: 15px;
        font-weight: 500;
        color: #666;
        margin-bottom: 1rem;
    }

    .replay-box {
        padding: 1.5rem 0;
    }

    .replay-box h2 {
        font-size: 17px;
        font-weight: 500;
        color: #333;
        margin-bottom: 1.25rem;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }

    .comment-form-card {
        background: #fff;
        border: 1px solid #e0e0e0;
        border-radius: 12px;
        padding: 1.25rem;
    }

    .user-row {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 14px;
    }

    .user-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        object-fit: cover;
        /* quan trọng khi dùng <img> */
        flex-shrink: 0;
        /* giữ các thuộc tính còn lại cho trường hợp fallback chữ */
        background: #E6F1FB;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 500;
        color: #378ADD;
    }

    .user-name {
        font-size: 14px;
        font-weight: 500;
        color: #222;
    }

    .user-sub {
        font-size: 12px;
        color: #999;
    }

    .comment-textarea {
        width: 100%;
        box-sizing: border-box;
        border: 1px solid #ddd;
        border-radius: 6px;
        padding: 10px 12px;
        font-size: 14px;
        color: #333;
        background: #fafafa;
        resize: vertical;
        min-height: 100px;
        font-family: inherit;
        line-height: 1.6;
        outline: none;
        transition: border-color 0.15s;
    }

    .comment-textarea:focus {
        border-color: #378ADD;
    }

    .comment-textarea::placeholder {
        color: #aaa;
    }

    .form-footer {
        display: flex;
        justify-content: flex-end;
        margin-top: 10px;
    }

    .btn-submit {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        font-weight: 500;
        color: #fff;
        background: #378ADD;
        border: none;
        border-radius: 6px;
        padding: 7px 16px;
        cursor: pointer;
        transition: background 0.15s;
    }

    .btn-submit:hover {
        background: #185FA5;
    }

    .btn-submit i {
        font-size: 15px;
    }

    .alert-login {
        display: flex;
        align-items: center;
        gap: 10px;
        background: #FAEEDA;
        border: 1px solid #EF9F27;
        border-radius: 10px;
        padding: 12px 16px;
        margin-bottom: 20px;
    }

    .alert-login i {
        font-size: 18px;
        color: #BA7517;
        flex-shrink: 0;
    }

    .alert-login p {
        font-size: 14px;
        color: #333;
        margin: 0;
    }

    .alert-login a {
        color: #378ADD;
        text-decoration: none;
        font-weight: 500;
    }

    .alert-login a:hover {
        text-decoration: underline;
    }
</style>
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="blog-post-area">
                        <h2 class="title text-center">Latest From our Blog</h2>
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
                                    style="width:100%; max-height:1000px; object-fit:cover; margin-bottom:15px;">
                            @endif

                            {{-- Nội dung đầy đủ (render HTML từ CKEditor) --}}
                            <div class="blog-content">
                                {!! $data->content !!}
                                <h3><strong>DETAIL</strong></h3>
                                <div style="white-space: pre-line;">
                                    {!! $data->description !!}
                                </div>
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

                    {{-- ========== RATING ========== --}}
                    <div class="rating-area" style="margin: 20px 0;">
                        <ul class="ratings">
                            <li class="rate-this">Rate this item:</li>
                            <li>
                                @php $displayRate = $userRate > 0 ? $userRate : $avgRate; @endphp

                                {{-- Hiển thị sao theo điểm TBC / cho user vote nhiều lần --}}
                                <!-- <div class="rate-many">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fa fa-star star-rate-many {{ $i <= round($avgRate) ? 'color' : '' }}"
                                            data-score="{{ $i }}" data-blog="{{ $data->id }}"
                                            style="cursor:pointer; font-size:20px;"></i>
                                    @endfor
                                </div> -->

                                {{-- Hiển thị sao theo điểm TBC / cho user vote 1 lần --}}
                                <div class="rate-one">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fa fa-star star-rate-one {{ $i <= round($avgRate) ? 'color' : '' }}"
                                            data-score="{{ $i }}" data-blog="{{ $data->id }}"
                                            style="cursor:pointer; font-size:20px;"></i>
                                    @endfor
                                </div>
                            </li>
                            <li id="total-raters" class="color">{{ number_format($avgRate, 1) }}/5</li>
                            <li id="total-raters" class="color">({{ $totalRaters }} votes)</li>
                        </ul>
                        <div id="rate-message" style="margin-top:5px;"></div>
                        <ul class="tag">
                            <li>TAG:</li>
                            <li><a class="color" href="">Pink <span>/</span></a></li>
                            <li><a class="color" href="">T-Shirt <span>/</span></a></li>
                            <li><a class="color" href="">Girls</a></li>
                        </ul>
                    </div><!--/rating-area-->


                    {{-- ========== COMMENT ========== --}}
                    <div class="socials-share">
                        <a href=""><img src="{{ asset('frontend/images/blog/socials.png') }}" alt=""></a>
                    </div><!--/socials-share-->
                    <div class="comment-section">
                        <p class="section-title">Reviews (<span id="comment-count">{{ $comments->count() }}</span>)</p>

                        <ul class="comment-list" id="comment-list">
                            @foreach ($comments->whereNull('parent_id') as $comment)
                                <li id="comment-{{ $comment->id }}">
                                    <div class="comment-card bg-cmt">
                                        @if($comment->user->avatar)
                                            <img class="user-avatar"
                                                src="{{ asset('upload/user/avatar/' . $comment->user->avatar) }}"
                                                alt="{{ $comment->user->name }}">
                                        @else
                                            <div class="user-avatar">
                                                {{ strtoupper(substr($comment->user->name, 0, 2)) }}
                                            </div>
                                        @endif

                                        <div class="comment-body">
                                            <div class="comment-meta">
                                                <span class="author">{{ $comment->user->name }}</span>
                                                <span class="meta-item">
                                                    <i class="fa fa-clock-o"></i>
                                                    {{ $comment->created_at->format('g:i a') }}
                                                </span>
                                                <span class="meta-item">
                                                    <i class="fa fa-calendar"></i>
                                                    {{ $comment->created_at->format('M j, Y') }}
                                                </span>
                                            </div>

                                            @if ($comment->rating)
                                                <div class="stars">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <span class="star {{ $i > $comment->rating ? 'empty' : '' }}">★</span>
                                                    @endfor
                                                </div>
                                            @endif

                                            <p class="comment-text">{{ $comment->content }}</p>

                                            {{-- Nút mở form reply --}}
                                            <button class="reply-btn btn-reply" data-id="{{ $comment->id }}">
                                                <i class="fa fa-reply"></i> Trả lời
                                            </button>

                                            {{-- Form reply (ẩn mặc định) --}}
                                            <div class="reply-form" id="reply-form-{{ $comment->id }}"
                                                style="display: none; margin-top: 10px;">
                                                <textarea class="reply-content comment-textarea" rows="3"
                                                    placeholder="Nhập reply của bạn..."></textarea>
                                                <div class="form-footer" style="margin-top: 8px;">
                                                    <button class="btn-submit btn-send-reply"
                                                        data-comment-id="{{ $comment->id }}">
                                                        <i class="fa fa-send"></i> Gửi reply
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Danh sách replies --}}
                                    <ul class="comment-list" id="replies-{{ $comment->id }}" style="margin-top: 8px;">
                                        @foreach ($comment->replies as $reply)
                                            <li id="comment-{{ $reply->id }}">
                                                <div class="comment-card reply">
                                                    @if($reply->user->avatar)
                                                        <img class="user-avatar"
                                                            src="{{ asset('upload/user/avatar/' . $reply->user->avatar) }}"
                                                            alt="{{ $reply->user->name }}">
                                                    @else
                                                        <div class="user-avatar">
                                                            {{ strtoupper(substr($reply->user->name, 0, 2)) }}
                                                        </div>
                                                    @endif

                                                    <div class="comment-body">
                                                        <div class="comment-meta">
                                                            <span class="author">{{ $reply->user->name }}</span>
                                                            <span class="meta-item">
                                                                <i class="fa fa-clock-o"></i>
                                                                {{ $reply->created_at->format('g:i a') }}
                                                            </span>
                                                            <span class="meta-item">
                                                                <i class="fa fa-calendar"></i>
                                                                {{ $reply->created_at->format('M j, Y') }}
                                                            </span>
                                                        </div>

                                                        <p class="comment-text">{{ $reply->content }}</p>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="replay-box">
                        <h2>Để lại bình luận</h2>

                        @guest('member')
                            <div class="alert-login">
                                <i class="fa fa-info-circle"></i>
                                <p>Vui lòng <a href="{{ route('member.login') }}">đăng nhập</a> để bình luận.</p>
                            </div>
                        @else
                            <div class="comment-form-card">
                                <div class="user-row">
                                    @if (auth('member')->user()->avatar)
                                        <img class="user-avatar"
                                            src="{{ asset('upload/user/avatar/' . auth('member')->user()->avatar) }}"
                                            alt="{{ auth('member')->user()->name }}">
                                    @else
                                        <div class="user-avatar">
                                            {{ strtoupper(substr(auth('member')->user()->name, 0, 2)) }}
                                        </div>
                                    @endif
                                    <div>
                                        <div class="user-name">{{ auth('member')->user()->name }}</div>
                                        <div class="user-sub">Đang bình luận với tư cách thành viên</div>
                                    </div>
                                </div>

                                <textarea id="comment-content" name="content" class="comment-textarea"
                                    placeholder="Nhập bình luận của bạn..."></textarea>

                                <div class="form-footer">
                                    <button class="btn-submit" id="btn-post-comment">
                                        <i class="fa fa-send"></i> Gửi bình luận
                                    </button>
                                </div>
                            </div>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        const BLOG_ID = {{ $data->id }};
        const IS_LOGIN = {{ Auth::guard('member')->check() ? 'true' : 'false' }};
        const CSRF_TOKEN = '{{ csrf_token() }}';

        // ===== RATING =====
        // Hover sao: tô vàng các sao <= sao đang hover
        // document.querySelectorAll('.star-rate-many').forEach(function (star) {
        //     star.addEventListener('mouseover', function () {
        //         const score = this.dataset.score;
        //         document.querySelectorAll('.star-rate-many').forEach(function (s) {
        //             s.classList.toggle('color', s.dataset.score <= score);
        //         });
        //     });

        //     // Mouseout: quay về điểm đã chọn ($displayRate từ PHP)
        //     star.addEventListener('mouseout', function () {
        //         const current = {{ $userRate > 0 ? $userRate : $avgRate }};
        //         document.querySelectorAll('.star-rate-many').forEach(function (s) {
        //             s.classList.toggle('color', s.dataset.score <= current);
        //         });
        //     });

        //     // ajax cho user vote nhiều lần
        //     $('.star-rate-many').click(function () {
        //         var checkLogin = "{{ Auth::guard('member')->check() }}";
        //         if (checkLogin) {
        //             var rate = $(this).data('score');
        //             var blog_id = $(this).data('blog');
        //             $('.star-rate-many').removeClass('color');
        //             $(this).prevAll().addBack().addClass('color');
        //             $.ajax({
        //                 type: 'POST',
        //                 url: '{{ route("blog.rate") }}',
        //                 data: {
        //                     score: rate,
        //                     blog_id: blog_id
        //                 },
        //                 success: function (data) {
        //                     // console.log(data);
        //                     // $('#rate-message').html(data.message);
        //                     showRateMessage('Đánh giá thành công!', 'green');
        //                 },
        //                 error: function (xhr) {
        //                     console.log(xhr.responseText);
        //                 }
        //             });
        //         } else {
        //             showRateMessage('Vui lòng đăng nhập để đánh giá!', 'red');
        //         }
        //     });
        // });

        // Hover sao: tô vàng các sao <= sao đang hover
        document.querySelectorAll('.star-rate-one').forEach(function (star) {
            star.addEventListener('mouseover', function () {
                const score = this.dataset.score;
                document.querySelectorAll('.star-rate-one').forEach(function (s) {
                    s.classList.toggle('color', s.dataset.score <= score);
                });
            });

            // Mouseout: quay về điểm đã chọn ($displayRate từ PHP)
            star.addEventListener('mouseout', function () {
                const current = {{ $userRate > 0 ? $userRate : $avgRate }};
                document.querySelectorAll('.star-rate-one').forEach(function (s) {
                    s.classList.toggle('color', s.dataset.score <= current);
                });
            });
        });
        // ajax cho user vote 1 lần
        let hasRated = {{ $userRate > 0 ? 'true' : 'false' }};
        $('.star-rate-one').click(function () {
            if (hasRated) {
                showRateMessage('Bạn đã đánh giá bài viết này rồi!', 'red');
                return;
            }

            var checkLogin = "{{ Auth::guard('member')->check() }}";
            if (!checkLogin) {
                showRateMessage('Vui lòng đăng nhập để đánh giá!', 'red');
                return;
            }

            var rate = $(this).data('score');
            var blog_id = $(this).data('blog');
            $('.star-rate-one').removeClass('color');
            $(this).prevAll().addBack().addClass('color');
            $.ajax({
                type: 'POST',
                url: '{{ route("blog.rate") }}',
                data: {
                    score: rate,
                    blog_id: blog_id
                },
                success: function (data) {
                    showRateMessage('Đánh giá thành công!', 'green');
                    // khóa không cho vote tiếp
                    hasRated = true;

                    // Cập nhật sao realtime theo avgRate mới từ server
                    $('.star-rate-one').each(function () {
                        const starScore = $(this).data('score');
                        if (starScore <= Math.round(data.avg)) {
                            $(this).addClass('color');
                        } else {
                            $(this).removeClass('color');
                        }
                    });
                },
                error: function (xhr) {
                    showRateMessage('Bạn đã đánh giá bài viết này rồi!', 'red');
                    if (xhr.status === 400) {
                        hasRated = true; // server bảo đã vote rồi → khóa luôn
                    }
                }
            });
        });
        function showRateMessage(msg, color) {
            const el = document.getElementById('rate-message');
            el.textContent = msg;
            el.style.color = color;
            // Tự ẩn sau 3 giây
            setTimeout(() => el.textContent = '', 3000);
        }

        $(function () {
            const blogId = {{ $data->id }};
            const isLogged = {{ auth('member')->check() ? 'true' : 'false' }};
            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            // PHẦN 1: GỬI COMMENT CHA
            $('#btn-post-comment').on('click', function () {
                // Kiểm tra login bằng JS (phòng trường hợp bypass Blade)
                if (!isLogged) {
                    alert('Vui lòng đăng nhập để bình luận!');
                    return;
                }

                const content = $('#comment-content').val().trim();
                if (!content) {
                    alert('Vui lòng nhập nội dung bình luận!');
                    return;
                }

                $.ajax({
                    url: '{{ route("blog.comment.store", $data->id) }}',
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrfToken },
                    data: { content: content },
                    success: function (res) {
                        if (res.success) {
                            // Tạo HTML comment mới và prepend lên đầu list
                            const html = buildCommentHTML(res.comment);
                            $('#comment-list').prepend(html);

                            // Cập nhật số lượng comment
                            const count = parseInt($('#comment-count').text()) + 1;
                            $('#comment-count').text(count);

                            // Xóa nội dung textarea
                            $('#comment-content').val('');
                        }
                    },
                    error: function (xhr) {
                        const msg = xhr.responseJSON?.message || 'Có lỗi xảy ra!';
                        alert(msg);
                    }
                });
            });

            // PHẦN 2: TOGGLE FORM REPLY
            // Dùng event delegation vì comment mới cũng có nút reply
            $(document).on('click', '.btn-reply', function () {
                const commentId = $(this).data('id');
                const form = $('#reply-form-' + commentId);

                // Toggle: nếu đang ẩn thì hiện, đang hiện thì ẩn
                form.toggle();

                // Focus vào textarea khi mở
                if (form.is(':visible')) {
                    form.find('.reply-content').focus();
                }
            });

            // PHẦN 3: GỬI REPLY (COMMENT CON)
            $(document).on('click', '.btn-send-reply', function () {

                if (!isLogged) {
                    alert('Vui lòng đăng nhập để bình luận!');
                    return;
                }

                const commentId = $(this).data('comment-id');
                const textarea = $('#reply-form-' + commentId).find('.reply-content');
                const content = textarea.val().trim();

                if (!content) {
                    alert('Vui lòng nhập nội dung reply!');
                    return;
                }

                $.ajax({
                    url: '{{ route("blog.reply.store", ":id") }}'.replace(':id', commentId),
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrfToken },
                    data: { content: content },
                    success: function (res) {
                        if (res.success) {
                            // Append reply vào đúng danh sách replies của comment cha
                            const html = buildReplyHTML(res.reply);
                            $('#replies-' + commentId).append(html);

                            // Xóa textarea và ẩn form
                            textarea.val('');
                            $('#reply-form-' + commentId).hide();
                        }
                    },
                    error: function (xhr) {
                        const msg = xhr.responseJSON?.message || 'Có lỗi xảy ra!';
                        alert(msg);
                    }
                });
            });

            // ==========================================
            // HÀM BUILD HTML
            // ==========================================

            // Build HTML cho comment cha mới
            function buildCommentHTML(comment) {
                return `
                    <li class="media" id="comment-${comment.id}">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="${comment.user.avatar}" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">
                                ${comment.user.name}<small>${comment.created_at}</small></h4>
                                <p>${escapeHtml(comment.content)}</p>
                                <button class="btn btn-xs btn-default btn-reply" data-id="${comment.id}">Reply</button>
                                    <div class="reply-form" id="reply-form-${comment.id}" style="display:none; margin-top:10px;">
                                        <textarea class="reply-content form-control" rows="3" placeholder="Nhập reply..."></textarea>
                                        <button class="btn btn-sm btn-primary btn-send-reply" data-comment-id="${comment.id}" style="margin-top:5px;">Gửi Reply</button>
                                    </div>
                                    <ul class="media-list replies-list" id="replies-${comment.id}"></ul>
                        </div>
                    </li>`;
            }

            // Build HTML cho reply mới
            function buildReplyHTML(reply) {
                return `
                    <li class="media" id="comment-${reply.id}">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="${reply.user.avatar}" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">${reply.user.name}
                                <small>${reply.created_at}</small>
                            </h4>
                            <p>${escapeHtml(reply.content)}</p>
                        </div>
                    </li>`;
            }

            // Escape HTML để tránh XSS
            function escapeHtml(text) {
                return text
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/"/g, '&quot;')
                    .replace(/'/g, '&#039;');
            }
        });
    </script>
@endpush