@extends('frontend.layouts.master')
@section('title','Đổi mật khẩu')

@section('css')


@endsection

@section('js')

@endsection
@section('content')

    <div class="main">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{ url('') }}">Home</a></li>
            <li><a href="{{ route('shop') }}">Store</a></li>
            <li class="active">Đổi mật khẩu</li>
        </ul>
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
        @include('frontend.partials.sidebar-account')

            <!-- BEGIN CONTENT -->
            <div class="col-md-9 col-sm-7">
                <h1>Đổi mật khẩu</h1>
                <div class="content-page">
                    <form>
                        <div class="form-group">
                            <label>Mật khẩu cũ</label>
                            <input type="password" name="oldPassword" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập mật khẩu cũ" >
                        </div>
                        <div class="form-group">
                            <label>Mật khẩu mới</label>
                            <input type="password" name="newPassword" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập mật khẩu mới">
                        </div>
                        <div class="form-group">
                            <label>Mật khẩu mới</label>
                            <input type="password" name="comfirmPassword" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập lại mật khẩu mới">
                        </div>
                        <button type="submit" class="btn btn-primary">Xác nhận</button>
                    </form>
                </div>
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->
    </div>
</div>
    @include('frontend.partials.brands')
@endsection
