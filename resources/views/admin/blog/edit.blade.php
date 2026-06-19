@extends('admin.layouts.admin')
@section('main')
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-5 align-self-center">
                    <h4 class="page-title">Edit Article</h4>
                </div>
                <div class="col-7 align-self-center">
                    <div class="d-flex align-items-center justify-content-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.blog.index') }}">Blog</a></li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-body">
                        <h4 class="card-title">Edit post</h4>

                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data"
                            class="form-horizontal m-t-30">
                            @csrf

                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" value="{{ old('title', $blog->title) }}"
                                    class="form-control" placeholder="Enter article title">
                            </div>

                            <div class="form-group">
                                <label>Image</label>
                                {{-- Hiển thị ảnh cũ --}}
                                @if($blog->image)
                                    <div class="m-b-10">
                                        <img id="thumbnailPreview" src="{{ asset('upload/blog/' . $blog->image) }}"
                                            style="max-width:200px; border-radius:4px;">
                                    </div>
                                @else
                                    <img id="thumbnailPreview" src="#"
                                        style="display:none; max-width:200px; border-radius:4px;">
                                @endif
                                <input type="file" name="image" accept="image/*" class="form-control m-t-10"
                                    onchange="previewThumbnail(this)">
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" rows="3" class="form-control"
                                    placeholder="Enter article description">{{ old('description', $blog->description) }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Content</label>
                                <textarea name="content" id="content" rows="10"
                                    class="form-control">{{ old('content', $blog->content) }}</textarea>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success">
                                    <i class="mdi mdi-content-save"></i> Update
                                </button>
                                <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary">
                                    <i class="mdi mdi-arrow-left"></i> Back
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection