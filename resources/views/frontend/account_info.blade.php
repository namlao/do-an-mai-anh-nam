@extends('frontend.layouts.master')
@section('title','Thay đổi thông tin')

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
                <li class="active">Thông tin</li>
            </ul>
            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40">
            @include('frontend.partials.sidebar-account')

            <!-- BEGIN CONTENT -->
                <div class="col-md-9 col-sm-7">
                    <h1>Thông tin</h1>
                    <div class="content-page">
                        <form >
                            <div class="form-group">
                                <label>Họ</label>
                                <input type="text" name="firstname" class="form-control" id="exampleInputEmail1"
                                       aria-describedby="emailHelp" placeholder="Nhập họ" value="{{ $customer==null ?'': $customer->first_name }}">
                            </div>
                            <div class="form-group">
                                <label>Tên</label>
                                <input type="text" name="lastname" class="form-control" id="exampleInputEmail1"
                                       aria-describedby="emailHelp" placeholder="Nhập tên" value="{{ $customer==null ?'': $customer->last_name }}">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control" id="exampleInputEmail1"
                                       aria-describedby="emailHelp" placeholder="Nhập email" value="{{ $email }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại</label>
                                <input type="text" name="phone" class="form-control" id="exampleInputEmail1"
                                       aria-describedby="emailHelp" placeholder="Nhập số điện thoại" value="{{ $customer==null ?'': $customer->phone }}">
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
