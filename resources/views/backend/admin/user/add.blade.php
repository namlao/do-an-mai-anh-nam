@extends('backend.layouts.master')
@section('title','Thêm chuyên mục')
@section('css')

@endsection
@section('js')

@endsection
@section('content')
    @include('backend.partials.page-heading',['namepage'=>'Thêm thành viên'])

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="basicInput">Avatar</label>
                                <input type="file" class="form-control" id="avatar" name="avatar"
                                       >
                            </div>
                            <div class="form-group">
                                <label for="basicInput">Tên thành viên</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       placeholder="Nhập tên thành viên">
                            </div>
                            <div class="form-group">
                                <label for="basicInput">Email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                       placeholder="Nhập email thành viên">
                            </div>
                            <div class="form-group">
                                <label for="basicInput">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                       placeholder="Nhập password">
                            </div>
                            <div class="form-group">
                                <label for="basicInput">Quyền thành viên</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option>Chọn quyền</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Gửi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
