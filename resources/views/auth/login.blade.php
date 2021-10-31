@extends('auth.layouts.master')
@section('title','Đăng nhập')
@section('content')
    <h1 class="auth-title">Đăng nhập.</h1>
    <p class="auth-subtitle mb-5">Đăng nhập bằng tài khoản bạn đã đăng ký</p>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="{{ route('login') }}">
        @csrf
        <div class="form-group position-relative has-icon-left mb-4">
            <input type="email" name="email" class="form-control form-control-xl @error('email') is-invalid @enderror"
                   placeholder="Email" required autocomplete="off" autofocus>
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
        </div>
        <div class="form-group position-relative has-icon-left mb-4">
            <input type="password" name="password"
                   class="form-control form-control-xl @error('password') is-invalid @enderror" placeholder="Password"
                   required autocomplete="current-password">
            <div class="form-control-icon">
                <i class="bi bi-shield-lock"></i>
            </div>
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-check form-check-lg d-flex align-items-end">
            <input class="form-check-input me-2" type="checkbox" value="" name="remember"
                   id="flexCheckDefault" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label text-gray-600" for="flexCheckDefault">
                Giữ tôi đăng nhập
            </label>
        </div>
        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Đăng nhập</button>
    </form>
    <div class="text-center mt-5 text-lg fs-4">
        <p class="text-gray-600">Tôi không có tài khoản <a href="{{ route('register') }}"
                                                           class="font-bold">Đăng ký</a>.</p>
        <p><a class="font-bold" href="{{ route('password.request') }}">Quên tài khoản</a>.</p>
    </div>
@endsection
