@extends('backend.layouts.master')
@section('title','Thêm chuyên mục')
@section('css')

@endsection
@section('js')

@endsection
@section('content')
    @include('backend.partials.page-heading',['namepage'=>'Thêm chuyên mục'])

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('category.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="basicInput">Tên chuyên mục</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                       name="name"
                                       placeholder="Nhập tên chuyên mục" value="{{ old('name') }}">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="basicInput">Tên thể loại</label>
                                <select class="form-select" id="lazshop_cate_id" name="lazshop_cate_id">
                                    <option value="">Chọn thể loại</option>
                                    {{ \App\Helpers\RecursiveCategory::recursuveCategory($cateLzd)   }}
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="basicInput">Chuyên mục cha</label>
                                <select class="form-select" id="parent_id" name="parent_id">
                                    <option value="">Chọn chuyện mục</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>

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
