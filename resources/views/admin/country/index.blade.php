@extends('admin.layouts.admin')
@section('main')
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-5 align-self-center">
                    <h4 class="page-title">Country</h4>
                </div>
                <div class="col-7 align-self-center">
                    <div class="d-flex align-items-center justify-content-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Country</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="card-title"></h4>
                                <a href="{{ route('country.add') }}" class="btn btn-primary">
                                    <i class="mdi mdi-plus"></i> Add Country
                                </a>
                            </div>

                            {{-- Thông báo success --}}
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible m-t-20">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <h4><i class="icon fa fa-check"></i> Notification!</h4>
                                    {{ session('success') }}
                                </div>
                            @endif

                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Countries</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($countries as $country)
                                        <tr>
                                            <td>{{ $country->id }}</td>
                                            <td>{{ $country->name }}</td>
                                            <td>
                                                <a href="#" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#deleteModal{{ $country->id }}">
                                                    <i class="mdi mdi-delete"></i> Delete
                                                </a>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="deleteModal{{ $country->id }}" tabindex="-1" role="dialog">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content" style="border: none; border-radius: 8px;">
                                                    <div class="modal-body text-center" style="padding: 35px 25px;">

                                                        <div
                                                            style="width: 70px; height: 70px; border-radius: 50%; background: #feded7; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                                                            <i class="mdi mdi-alert-outline"
                                                                style="font-size: 35px; color: #fa5838;"></i>
                                                        </div>

                                                        <h4 style="font-weight: 500; color: #4F5467; margin-bottom: 10px;">
                                                            Are you sure?
                                                        </h4>
                                                        <p style="color: #afb5c1; font-size: 14px; margin-bottom: 25px;">
                                                            "{{ $country->name }}" will be permanently deleted and cannot be restored.
                                                        </p>

                                                        <div class="d-flex justify-content-center" style="gap: 10px;">
                                                            <button type="button" class="btn btn-secondary"
                                                                style="border-radius: 4px; padding: 8px 25px;"
                                                                data-dismiss="modal">
                                                                Cancel
                                                            </button>
                                                            <a href="{{ route('country.delete', $country->id) }}"
                                                                class="btn btn-danger"
                                                                style="border-radius: 4px; padding: 8px 25px;">
                                                                Delete
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">No Country!</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection