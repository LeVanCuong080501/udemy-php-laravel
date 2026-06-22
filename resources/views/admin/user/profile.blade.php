@extends('admin.layouts.admin')
@section('main')
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-5 align-self-center">
                    <h4 class="page-title">Profile</h4>
                </div>
                <div class="col-7 align-self-center">
                    <div class="d-flex align-items-center justify-content-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="#">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Profile</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-xlg-3 col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <center class="m-t-30">
                                <div class="dropdown d-inline-block">
                                    <img id="avatarPreview"
                                        src="{{ Auth::user()->avatar ? asset('upload/user/avatar/' . Auth::user()->avatar) : asset('admin/assets/images/users/5.jpg') }}"
                                        class="rounded-circle" width="150" style="cursor: pointer; border: 3px solid #eee;"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" />

                                    <div class="dropdown-menu">
                                        <!-- Xem ảnh -->
                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                            data-target="#viewAvatarModal">
                                            <i class="mdi mdi-eye"></i> Xem ảnh đại diện
                                        </a>
                                        <!-- Đổi ảnh -->
                                        <a class="dropdown-item" href="#"
                                            onclick="document.getElementById('avatarInput').click()">
                                            <i class="mdi mdi-camera"></i> Thay đổi ảnh đại diện
                                        </a>
                                    </div>
                                </div>

                                <h4 class="card-title m-t-10">{{ Auth::user()->name }}</h4>
                                <h6 class="card-subtitle">Accoubts Manager Amix corp</h6>
                                <div class="row text-center justify-content-md-center">
                                    <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-people"></i>
                                            <font class="font-medium">254</font>
                                        </a></div>
                                    <div class="col-4"><a href="javascript:void(0)" class="link"><i
                                                class="icon-picture"></i>
                                            <font class="font-medium">54</font>
                                        </a></div>
                                </div>
                            </center>
                        </div>
                        <div>
                            <hr>
                        </div>
                        <div class="card-body"> <small class="text-muted">Email address </small>
                            <h6>{{Auth::user()->email}}</h6> <small class="text-muted p-t-30 db">Phone</small>
                            <h6>+84 {{Auth::user()->phone}}</h6> <small class="text-muted p-t-30 db">Address</small>
                            <h6>71 Pilgrim Avenue Chevy Chase, MD 20815</h6>
                            <div class="map-box">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d470029.1604841957!2d72.29955005258641!3d23.019996818380896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e848aba5bd449%3A0x4fcedd11614f6516!2sAhmedabad%2C+Gujarat!5e0!3m2!1sen!2sin!4v1493204785508"
                                    width="100%" height="150" frameborder="0" style="border:0" allowfullscreen></iframe>
                            </div> <small class="text-muted p-t-30 db">Social Profile</small>
                            <br />
                            <button class="btn btn-circle btn-secondary"><i class="mdi mdi-facebook"></i></button>
                            <button class="btn btn-circle btn-secondary"><i class="mdi mdi-twitter"></i></button>
                            <button class="btn btn-circle btn-secondary"><i class="mdi mdi-youtube-play"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-xlg-9 col-md-7">
                    <div class="card">
                        <div class="card-body">
                            {{-- Thông báo success --}}
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                                    {{ session('success') }}
                                </div>
                            @endif

                            {{-- Thông báo lỗi --}}
                            @if($errors->any())
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h4><i class="icon fa fa-times"></i> Thông báo!</h4>
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('admin.update') }}" method="POST" enctype="multipart/form-data"
                                class="form-horizontal form-material">
                                @csrf

                                <!-- Input file ẩn - nằm trong form bên phải -->
                                <input type="file" id="avatarInput" name="avatar" accept="image/*" style="display: none"
                                    onchange="previewAvatar(this)">

                                <div class="form-group">
                                    <label class="col-md-12">Full Name</label>
                                    <div class="col-md-12">
                                        <input value="{{ old('name', Auth::user()->name) }}" name="name" type="text"
                                            placeholder="Johnathan Doe" class="form-control form-control-line">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="example-email" class="col-md-12">Email</label>
                                    <div class="col-md-12">
                                        <input value="{{ old('email', Auth::user()->email) }}" type="email"
                                            placeholder="johnathan@admin.com" class="form-control form-control-line"
                                            name="email" id="example-email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Password</label>
                                    <div class="col-md-12">
                                        <input name="password" type="password" class="form-control form-control-line">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Phone No</label>
                                    <div class="col-md-12">
                                        <input value="{{ old('phone', Auth::user()->phone) }}" name="phone" type="text"
                                            placeholder="123 456 7890" class="form-control form-control-line">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Message</label>
                                    <div class="col-md-12">
                                        <textarea rows="5" class="form-control form-control-line"></textarea>
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <label class="col-sm-12">Select Country</label>
                                    <div class="col-sm-12">
                                        <select name="id_country" class="form-control form-control-line">
                                            <option value="1">Vietnam</option>
                                            <option value="2">India</option>
                                            <option value="3">Usa</option>
                                            <option value="4">Canada</option>
                                            <option value="5">Thailand</option>
                                            <option value="6">London</option>
                                        </select>
                                    </div>
                                </div> -->

                                <div class="form-group">
                                    <label class="col-sm-12">Select Country</label>
                                    <div class="col-sm-12">
                                        <select name="id_country" class="form-control form-control-line">
                                            @forelse($countries as $country)
                                                <option value="{{ $country->id }}"
                                                    {{ Auth::user()->id_country == $country->id ? 'selected' : '' }}>
                                                    {{ $country->name }}
                                                </option>
                                            @empty
                                                <option value="">Chưa có quốc gia nào!</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-success">Update Profile</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal xem ảnh - đặt trước @endsection --}}
    <div class="modal fade" id="viewAvatarModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ảnh đại diện</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalAvatarImg"
                        src="{{ Auth::user()->avatar ? asset('upload/user/avatar/' . Auth::user()->avatar) : asset('admin/assets/images/users/5.jpg') }}"
                        class="img-fluid rounded" style="max-width: 100%;" />
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewAvatar(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    // Cập nhật ảnh hiển thị trên trang
                    document.getElementById('avatarPreview').src = e.target.result;
                    // Cập nhật ảnh trong modal
                    document.getElementById('modalAvatarImg').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection