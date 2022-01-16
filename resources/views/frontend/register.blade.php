@extends('frontend.layouts.master')
@section('title','Đăng Ký')

@section('css')


@endsection

@section('js')

@endsection
@section('content')

    <div class="main">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ url('') }}">Home</a></li>
                <li><a href="{{ route('shop') }}">Cửa hàng</a></li>
                <li class="active">Đăng nhập</li>
            </ul>
            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40">
                <div class="sidebar col-md-3 col-sm-3">
                    <ul class="list-group margin-bottom-25 sidebar-menu">
                        <li class="list-group-item clearfix"><a href="{{ route('customer.register') }}"><i
                                    class="fa fa-angle-right"></i> Đăng ký</a></li>
                        <li class="list-group-item clearfix"><a href="#"><i class="fa fa-angle-right"></i> Quên mật khẩu</a>
                        </li>
                        {{--                        <li class="list-group-item clearfix"><a href="#"><i class="fa fa-angle-right"></i> My account</a></li>--}}
                        {{--                        <li class="list-group-item clearfix"><a href="#"><i class="fa fa-angle-right"></i> Address book</a></li>--}}
                        {{--                        <li class="list-group-item clearfix"><a href="#"><i class="fa fa-angle-right"></i> Wish list</a></li>--}}
                        {{--                        <li class="list-group-item clearfix"><a href="#"><i class="fa fa-angle-right"></i> Returns</a></li>--}}
                        {{--                        <li class="list-group-item clearfix"><a href="#"><i class="fa fa-angle-right"></i> Newsletter</a></li>--}}
                    </ul>
                </div>
                <!-- BEGIN CONTENT -->

                <div class="col-md-9 col-sm-12">
                    <h1>Đăng Ký</h1>
                    <!-- BEGIN CHECKOUT PAGE -->
                    <div class="content-form-page">
                        <div class="row">
                            <div class="col-md-7 col-sm-7">
                                @if(session()->has('success'))
                                    <div class="alert alert-success">
                                        <p>{{ session()->get('success') }}</p>
                                    </div>
                                @endif
                                <form class="form-horizontal" role="form" method="post"
                                      action="{{ route('customer.postRegister') }}">
                                    @csrf
                                    <fieldset>
                                        <legend>Your personal details</legend>
                                        <div class="form-group">
                                            <label for="firstname" class="col-lg-4 control-label">Họ <span
                                                    class="require">*</span></label>
                                            <div class="col-lg-8">
                                                <input type="text"
                                                       class="form-control @error('firstname') is-invalid @enderror"
                                                       id="firstname" name="firstname" value="{{ old('firstname') }}">
                                                @error('firstname')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="lastname" class="col-lg-4 control-label">Last Name <span
                                                    class="require">*</span></label>
                                            <div class="col-lg-8">
                                                <input type="text"
                                                       class="form-control @error('lastname') is-invalid @enderror"
                                                       id="lastname" name="lastname" value="{{ old('lastname') }}">
                                                @error('lastname')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="col-lg-4 control-label">Email <span
                                                    class="require">*</span></label>
                                            <div class="col-lg-8">
                                                <input type="text"
                                                       class="form-control @error('email') is-invalid @enderror"
                                                       id="email" name="email" value="{{ old('email') }}">
                                                @error('email')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <legend>Your password</legend>
                                        <div class="form-group">
                                            <label for="password" class="col-lg-4 control-label">Mật khẩu <span
                                                    class="require">*</span></label>
                                            <div class="col-lg-8">
                                                <input type="password"
                                                       class="form-control @error('password') is-invalid @enderror"
                                                       id="password" name="password" value="{{ old('password') }}">
                                                @error('password')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="confirm-password" class="col-lg-4 control-label">Xác nhận mật
                                                khẩu <span class="require">*</span></label>
                                            <div class="col-lg-8">
                                                <input type="password"
                                                       class="form-control @error('confirm_password') is-invalid @enderror"
                                                       id="confirm_password" name="confirm_password"
                                                       value="{{ old('confirm_password') }}">
                                                @error('confirm_password')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </fieldset>

                                    <div class="row">
                                        <div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-20">
                                            <button type="submit" class="btn btn-primary">Tạo tài khoản</button>
                                            <button type="button" class="btn btn-default">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-4 col-sm-4 pull-right">
                                <div class="form-info">
                                    <h2><em>Important</em> Information</h2>
                                    <p>Lorem ipsum dolor ut sit ame dolore adipiscing elit, sed sit nonumy nibh sed
                                        euismod ut laoreet dolore magna aliquarm erat sit volutpat. Nostrud exerci
                                        tation ullamcorper suscipit lobortis nisl aliquip commodo quat.</p>

                                    <p>Duis autem vel eum iriure at dolor vulputate velit esse vel molestie at
                                        dolore.</p>

                                    <button type="button" class="btn btn-default">More details</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END CHECKOUT PAGE -->
                </div>
                <!-- END CONTENT -->
            </div>
            <!-- END SIDEBAR & CONTENT -->
        </div>
    </div>
    @include('frontend.partials.brands')
@endsection
