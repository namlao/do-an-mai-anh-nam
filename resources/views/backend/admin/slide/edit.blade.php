@extends('backend.layouts.master')
@section('title','Thêm chuyên mục')
@section('css')
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">

@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

@endsection
@section('content')
    @include('backend.partials.page-heading',['namepage'=>'Sửa slider'])

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('slider.update',['slider' => $slide->id]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <div class="text-center">
                                    <img width="150" src="{{ url($slide->img_slide_path) }}" alt="">
                                </div>
                                <label for="feature_image">Ảnh background</label>

                                <input type="file"
                                       class="form-control @error('img_slide_path') is-invalid @enderror"
                                       id="img_slide_path" name="img_slide_path" accept="image/*">
                                @error('img_slide_path')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="basicInput">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                                       placeholder="Nhập title" value="{{ $slide->title }}">
                                @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Mô tả ngắn</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" maxlength="300" minlength="100" rows="6" style="resize: none;">
                                    {{ $slide->description }}
                                </textarea>
                                @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Hiển thị</label>
                                <input type="checkbox" name="display" {{ $slide->display == 1 ? 'checked':''  }}  data-toggle="toggle" data-onstyle="info">
                            </div>
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
