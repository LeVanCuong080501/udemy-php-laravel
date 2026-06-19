@extends('admin.layouts.admin')
@section('main')
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-5 align-self-center">
                    <h4 class="page-title">Add new countries</h4>
                </div>
                <div class="col-7 align-self-center">
                    <div class="d-flex align-items-center justify-content-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('country.index') }}">Country</a></li>
                                <li class="breadcrumb-item active">Add</li>
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
                        <!-- <h4 class="card-title">Add new countries</h4> -->

                        {{-- Thông báo lỗi --}}
                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <h4><i class="icon fa fa-times"></i> Thông báo!</h4>
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('country.list') }}" method="POST" class="form-horizontal m-t-30">
                            @csrf
                            <div class="form-group">
                                <label>Country Name</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                                    placeholder="Example: Vietnam">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">
                                    <i class="mdi mdi-content-save"></i> Save
                                </button>
                                <a href="{{ route('country.index') }}" class="btn btn-secondary">
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