@extends('frontend.layouts.main')

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

                    <div class="rating-area">
                        <ul class="ratings">
                            <li class="rate-this">Rate this item:</li>
                            <li>
                                <i class="fa fa-star color"></i>
                                <i class="fa fa-star color"></i>
                                <i class="fa fa-star color"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </li>
                            <li class="color">(2 votes)</li>
                        </ul>
                        <ul class="tag">
                            <li>TAG:</li>
                            <li><a class="color" href="">Pink <span>/</span></a></li>
                            <li><a class="color" href="">T-Shirt <span>/</span></a></li>
                            <li><a class="color" href="">Girls</a></li>
                        </ul>
                    </div><!--/rating-area-->

                    <div class="socials-share">
                        <a href=""><img src="{{ asset('frontend/images/blog/socials.png') }}" alt=""></a>
                    </div><!--/socials-share-->
                    <div class="response-area">
                        <h2></h2>
                        <ul class="media-list">
                            <li class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="{{ asset('frontend/images/blog/man-two.jpg') }}" alt="">
                                </a>
                                <div class="media-body">
                                    <ul class="sinlge-post-meta">
                                        <li><i class="fa fa-user"></i>Janis Gallagher</li>
                                        <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                                        <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                                    </ul>
                                    <div class="rate">
                                        <div class="vote">
                                            <div class="star_1 ratings_stars"><input value="1" type="hidden"></div>
                                            <div class="star_2 ratings_stars"><input value="2" type="hidden"></div>
                                            <div class="star_3 ratings_stars"><input value="3" type="hidden"></div>
                                            <div class="star_4 ratings_stars"><input value="4" type="hidden"></div>
                                            <div class="star_5 ratings_stars"><input value="5" type="hidden"></div>
                                            <!-- <span class="rate-np">3</span> -->
                                        </div>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                        nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                    </p>
                                    <a class="btn btn-primary" href=""><i class="fa fa-reply"></i>Replay</a>
                                </div>
                            </li>
                            <li class="media second-media">
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="{{ asset('frontend/images/blog/man-three.jpg') }}"
                                        alt="">
                                </a>
                                <div class="media-body">
                                    <ul class="sinlge-post-meta">
                                        <li><i class="fa fa-user"></i>Janis Gallagher</li>
                                        <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                                        <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                                    </ul>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                        nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                    </p>
                                    <a class="btn btn-primary" href=""><i class="fa fa-reply"></i>Replay</a>
                                </div>
                            </li>
                            <li class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="{{ asset('frontend/images/blog/man-four.jpg') }}" alt="">
                                </a>
                                <div class="media-body">
                                    <ul class="sinlge-post-meta">
                                        <li><i class="fa fa-user"></i>Janis Gallagher</li>
                                        <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                                        <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                                    </ul>
                                    <div class="rate">
                                        <div class="vote">
                                            <div class="star_1 ratings_stars"><input value="1" type="hidden"></div>
                                            <div class="star_2 ratings_stars"><input value="2" type="hidden"></div>
                                            <div class="star_3 ratings_stars"><input value="3" type="hidden"></div>
                                            <div class="star_4 ratings_stars"><input value="4" type="hidden"></div>
                                            <div class="star_5 ratings_stars"><input value="5" type="hidden"></div>
                                            <!-- <span class="rate-np">3</span> -->
                                        </div>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                        nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                    </p>
                                    <a class="btn btn-primary" href=""><i class="fa fa-reply"></i>Replay</a>
                                </div>
                            </li>
                            <li class="media second-media">
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="{{ asset('frontend/images/blog/man-three.jpg') }}"
                                        alt="">
                                </a>
                                <div class="media-body">
                                    <ul class="sinlge-post-meta">
                                        <li><i class="fa fa-user"></i>Janis Gallagher</li>
                                        <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                                        <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                                    </ul>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                        nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                    </p>
                                    <a class="btn btn-primary" href=""><i class="fa fa-reply"></i>Replay</a>
                                </div>
                            </li>
                        </ul>
                    </div><!--/Response-area-->
                    <div class="replay-box">
                        <div class="row">
                            <div class="col-sm-12">
                                <h2>Leave a replay</h2>

                                <div class="text-area">
                                    <div class="blank-arrow">
                                        <label>Your Name</label>
                                    </div>
                                    <span>*</span>
                                    <textarea name="message" rows="11"></textarea>
                                    <a class="btn btn-primary" href="">post comment</a>
                                </div>
                            </div>
                        </div>
                    </div><!--/Repaly Box-->
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            //vote
            $('.ratings_stars').hover(
                // Handles the mouseover
                function () {
                    $(this).prevAll().andSelf().addClass('ratings_hover');
                    // $(this).nextAll().removeClass('ratings_vote'); 
                },
                function () {
                    $(this).prevAll().andSelf().removeClass('ratings_hover');
                    // set_votes($(this).parent());
                }
            );

            $('.ratings_stars').click(function () {
                var Values = $(this).find("input").val();
                alert(Values);
                if ($(this).hasClass('ratings_over')) {
                    $('.ratings_stars').removeClass('ratings_over');
                    $(this).prevAll().andSelf().addClass('ratings_over');
                } else {
                    $(this).prevAll().andSelf().addClass('ratings_over');
                }
            });
        });
    </script>
@endpush