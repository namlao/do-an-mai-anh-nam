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
                                <input type="text" class="form-control" id="name" name="name"
                                       placeholder="Nhập tên chuyên mục">
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
