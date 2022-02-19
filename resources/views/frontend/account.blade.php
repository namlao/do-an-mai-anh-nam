@extends('frontend.layouts.master')
@section('title','Tài khoản')

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
            <li class="active">Tài khoản của tôi</li>
        </ul>
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
           @include('frontend.partials.sidebar-account')

            <!-- BEGIN CONTENT -->
            <div class="col-md-9 col-sm-7">
                <h1>Trang tài khoản của tôi</h1>
                <div class="content-page">
                    <h3>Tài khoản của tôi</h3>
                    <ul>
                        <li><a href="{{ route('customer.accountInfo') }}">Chỉnh sửa thông tin</a></li>
                        <li><a href="{{ route('customer.accountPassword') }}">Đổi mật khẩu</a></li>
                        <li><a href="{{ route('customer.accountAddress') }}">Địa chỉ</a></li>
                    </ul>
                    <hr>

                    <h3>Đơn hàng của tôi</h3>
                    <ul>
                        <li><a href="javascript:;">Xem lịch sử mua</a></li>
                    </ul>
                </div>
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->
    </div>
</div>
    @include('frontend.partials.brands')
@endsection
