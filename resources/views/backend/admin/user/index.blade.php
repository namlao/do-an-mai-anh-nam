@extends('backend.layouts.master')
@section('title','Danh sách thành viên')
@section('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/simple-datatables/style.css') }}">
    <style>

    </style>
@endsection
@section('js')


    <script src="{{ asset('backend/assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script>
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);

    </script>
@endsection
@section('content')
    @include('backend.partials.page-heading',['namepage'=>'Danh sách thành viên'])

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
{{--                    <div class="col-md-12">--}}
{{--                        <a href="{{ route('category.create') }}" class="btn btn-primary">Thêm</a>--}}
{{--                    </div>--}}
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered" id="table1">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Avatar</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Quyền</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                            <tr>

                                <td>{{$category->id}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{$category->slug}}</td>
                                <td>
                                    @foreach($category->ancestors as $item)
                                        {{$item->name }}
                                    @endforeach
                                </td>

                                <td>
                                    <a href="{{ route('category.edit',['category'=>$category->id]) }}" class="btn btn-primary">Sửa</a>
                                    <form action="{{ route('category.destroy',['category'=>$category->id]) }}" method="POST" class="delete-form">
                                        @csrf
                                        {{ @method_field('DELETE') }}
                                        <button class="btn btn-danger">Xóa</button>
                                    </form>

                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection