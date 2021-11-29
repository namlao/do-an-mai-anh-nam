@extends('backend.layouts.master')
@section('title','Thêm chuyên mục')
@section('css')
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">

@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

@endsection
@section('content')
    @include('backend.partials.page-heading',['namepage'=>'Thêm chuyên mục'])

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('setting.update',['setting'=>$setting->id]).'?type='.$setting->type }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="feature_image">Tên hiển thị</label>
                                <input type="text" class="form-control @error('config_name') is-invalid @enderror" id="config_name" name="config_name" value="{{  $setting->config_name }}"
                                       placeholder="Nhập tên hiển thị">
                                @error('config_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="key">Key</label>
                                <input type="text" class="form-control @error('config_key') is-invalid @enderror" id="config_key" name="config_key" value="{{  $setting->config_key }}"
                                       placeholder="Nhập key">
                                @error('config_key')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            @if(request()->type === 'textarea')
                                <div class="form-group">
                                    <label for="description">Giá trị</label>
                                    <textarea name="config_value" id="config_value" cols="30" rows="10" class="form-control @error('config_value') is-invalid @enderror">{{  $setting->config_value }}</textarea>
                                    @error('config_value')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            @elseif(request()->type==='image')
                                <div class="form-group">
                                    <label for="description">Giá trị</label>
                                    <div class="text-center mb-3 mt-3">
                                        <img width="250" src="{{ url($setting->config_value) }}" alt="">
                                    </div>
                                    <input type="file" class="form-control @error('config_value') is-invalid @enderror" id="config_value" name="config_value" value="{{  $setting->config_value }}"
                                           accept="image/*">

                                    @error('config_value')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            @else
                                <div class="form-group">
                                    <label for="description">Giá trị</label>

                                    <input type="text" class="form-control @error('config_value') is-invalid @enderror" id="config_value" name="config_value"
                                           placeholder="Nhập giá trị" value="{{ $setting->config_value }}">
                                    @error('config_value')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endif

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Gửi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
