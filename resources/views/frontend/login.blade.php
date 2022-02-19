@extends('frontend.layouts.master')
@section('title','Đăng nhập')

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
                        <li class="list-group-item clearfix"><a href="{{ route('customer.register') }}"><i class="fa fa-angle-right"></i> Đăng ký</a></li>
                        <li class="list-group-item clearfix"><a href="#"><i class="fa fa-angle-right"></i> Quên mật khẩu</a></li>
{{--                        <li class="list-group-item clearfix"><a href="#"><i class="fa fa-angle-right"></i> My account</a></li>--}}
{{--                        <li class="list-group-item clearfix"><a href="#"><i class="fa fa-angle-right"></i> Address book</a></li>--}}
{{--                        <li class="list-group-item clearfix"><a href="#"><i class="fa fa-angle-right"></i> Wish list</a></li>--}}
{{--                        <li class="list-group-item clearfix"><a href="#"><i class="fa fa-angle-right"></i> Returns</a></li>--}}
{{--                        <li class="list-group-item clearfix"><a href="#"><i class="fa fa-angle-right"></i> Newsletter</a></li>--}}
                    </ul>
                </div>
                <!-- BEGIN CONTENT -->

                <div class="col-md-9 col-sm-12">
                    <h1>Đăng nhập</h1>
                    <!-- BEGIN CHECKOUT PAGE -->
                    <div class="content-form-page">
                        <div class="row">
                            <div class="col-md-7 col-sm-7">
                                @if(session()->exists('error'))
                                    <div class="alert alert-danger">
                                        <p>{{ session()->get('error') }}</p>
                                    </div>
                                @endif
                                <form class="form-horizontal form-without-legend" role="form" method="post" action="{{ route('customer.postCustomLogin') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email" class="col-lg-4 control-label">Email <span class="require">*</span></label>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                                            @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="col-lg-4 control-label">Password <span class="require">*</span></label>
                                        <div class="col-lg-8">
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password') }}">
                                            @error('password')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
{{--                                    <div class="row">--}}
{{--                                        <div class="col-lg-8 col-md-offset-4 padding-left-0">--}}
{{--                                            <a href="forgotton-password.html">Forget Password?</a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <div class="row">
                                        <div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-20">
                                            <button type="submit" class="btn btn-primary">Login</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-10 padding-right-30">
{{--                                            <hr>--}}
{{--                                            <div class="login-socio">--}}
{{--                                                <p class="text-muted">or login using:</p>--}}
{{--                                                <ul class="social-icons">--}}
{{--                                                    <li><a href="#" data-original-title="facebook" class="facebook" title="facebook"></a></li>--}}
{{--                                                    <li><a href="#" data-original-title="Twitter" class="twitter" title="Twitter"></a></li>--}}
{{--                                                    <li><a href="#" data-original-title="Google Plus" class="googleplus" title="Google Plus"></a></li>--}}
{{--                                                    <li><a href="#" data-original-title="Linkedin" class="linkedin" title="LinkedIn"></a></li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-4 col-sm-4 pull-right">
                                <div class="form-info">
                                    <h2><em>Important</em> Information</h2>
                                    <p>Duis autem vel eum iriure at dolor vulputate velit esse vel molestie at dolore.</p>

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
