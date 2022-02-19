@extends('backend.layouts.master')
@section('title','Authorize')
@section('css')

@endsection
@section('js')

@endsection
@section('content')
    @if(\Illuminate\Support\Facades\Session::exists('refresh'))
        <div class="alert alert-success">
            {{ \Illuminate\Support\Facades\Session::get('refresh') }} <a href="{{ route('lazada.refresh') }}">Link</a>
        </div>
    @endif
    @include('backend.partials.page-heading',['namepage'=>'Authorize'])

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">

                        @if(!session()->exists('access_token'))
                            <form action="{{ route('lazada.authorize') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="basicInput">App key</label>
                                    <input type="text" class="form-control @error('app_key') is-invalid @enderror"
                                           id="app_key" name="app_key"
                                           placeholder="Nhập App key" value="{{ old('app_key') }}">
                                    @error('app_key')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="basicInput">App secret</label>
                                    <input type="text" class="form-control @error('app_secret') is-invalid @enderror"
                                           id="app_secret" name="app_secret"
                                           placeholder="Nhập App secret" value="{{ old('app_secret') }}">
                                    @error('app_secret')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Gửi</button>
                                </div>
                            </form>
                        @else
                            <div class="text-center">
                                <i class="fas fa-check-circle"></i>
                                <p>Bạn đã authorize thành công</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
