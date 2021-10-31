@extends('auth.layouts.master')
@section('title','Quên mật khẩu')
@section('content')
    <h1 class="auth-title">Quên mật khẩu</h1>
    <p class="auth-subtitle mb-5">Nhập email để chúng tôi gửi email đặt lại mật khẩu.</p>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-group position-relative has-icon-left mb-4">
            <input type="email" class="form-control form-control-xl @error('email') is-invalid @enderror" name="email" placeholder="Email">
            <div class="form-control-icon">
                <i class="bi bi-envelope"></i>
            </div>
        </div>
        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Send</button>
    </form>
    <div class="text-center mt-5 text-lg fs-4">
        <p class='text-gray-600'>Bạn đã nhớ mật khẩu? <a href="{{ route('login') }}" class="font-bold">Đăng nhập</a>.
        </p>
    </div>
@endsection


