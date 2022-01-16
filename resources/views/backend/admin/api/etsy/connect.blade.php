@extends('backend.layouts.master')
@section('title','Kết nối etsy')
@section('css')

@endsection
@section('js')

@endsection
@section('content')
    @include('backend.partials.page-heading',['namepage'=>'Kết nối etsy'])

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        @if(\Illuminate\Support\Facades\Session::has('success'))
                            <div class="alert alert-success" role="alert">
                                {{\Illuminate\Support\Facades\Session::get('success')}}
                            </div>
                        @elseif(\Illuminate\Support\Facades\Session::has('error'))
                            <div class="alert alert-danger" role="alert">
                                {{\Illuminate\Support\Facades\Session::get('error')}}
                            </div>
                        @endif
                            @if(!\Illuminate\Support\Facades\Session::has('oauth_token'))
                                <form action="{{ route('etsy.postConnect') }}" method="post">

                                    @csrf
                                    <div class="form-group">
                                        <label for="basicInput">Etsy key</label>
                                        <input type="text" class="form-control @error('api_key') is-invalid @enderror"
                                               id="api_key" name="api_key"
                                               placeholder="Điền etsy key" value="{{ old('api_key') }}">
                                        @error('api_key')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="basicInput">Etsy Secret</label>
                                        <input type="text" class="form-control @error('secret_key') is-invalid @enderror"
                                               id="secret_key" name="secret_key"
                                               placeholder="Điền etsy secret" value="{{ old('secret_key') }}">
                                        @error('secret_key')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Gửi</button>
                                    </div>
                                </form>
                            @else
                                <div class="alert alert-success" role="alert">
                                    {{'Bạn đã kết nối với etsy'}}
                                </div>
                            @endif

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
