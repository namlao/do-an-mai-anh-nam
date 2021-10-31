@extends('auth.layouts.master')
@section('title','Đăng ký')
@section('content')
    <h1 class="auth-title">Đăng ký</h1>
    <p class="auth-subtitle mb-5">Đăng ký tài khoản với chúng tôi.</p>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group position-relative has-icon-left mb-4">
            <input type="text" class="form-control form-control-xl @error('name') is-invalid @enderror" name="name"  placeholder="Họ và tên">
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
{{--            @error('name')--}}
{{--            <div class="alert alert-danger">{{ $message }}</div>--}}
{{--            @enderror--}}
        </div>
        <div class="form-group position-relative has-icon-left mb-4">
            <input type="text" class="form-control form-control-xl @error('email') is-invalid @enderror" name="email" placeholder="Email">
            <div class="form-control-icon">
                <i class="bi bi-envelope"></i>
            </div>
{{--            @error('email')--}}
{{--            <div class="alert alert-danger">{{ $message }}</div>--}}
{{--            @enderror--}}
        </div>

        <div class="form-group position-relative has-icon-left mb-4">
            <input type="password" class="form-control form-control-xl @error('password') is-invalid @enderror" name="password" placeholder="Password">
            <div class="form-control-icon">
                <i class="bi bi-shield-lock"></i>
            </div>

{{--            @error('password')--}}
{{--            <div class="alert alert-danger">{{ $message }}</div>--}}
{{--            @enderror--}}
        </div>
        <div class="form-group position-relative has-icon-left mb-4">
            <input type="password" class="form-control form-control-xl" name="password_confirmation" placeholder="Confirm Password">
            <div class="form-control-icon">
                <i class="bi bi-shield-lock"></i>
            </div>
        </div>
        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Đăng ký</button>
    </form>
    <div class="text-center mt-5 text-lg fs-4">
        <p class='text-gray-600'>Bạn đã có tài khoản? <a href="{{ route('login') }}"
                                                             class="font-bold">Đăng nhập</a>.</p>
    </div>
@endsection

