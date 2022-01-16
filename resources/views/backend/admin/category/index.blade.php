@extends('backend.layouts.master')
@section('title','Danh sách chuyên mục')
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
    @include('backend.partials.page-heading',['namepage'=>'Danh sách chuyên mục'])

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
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Chuyên mục cha</th>

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
                                        @can('category edit')
                                            <a href="{{ route('category.edit',['category'=>$category->id]) }}"
                                               class="btn btn-primary"><i class="fas fa-wrench"></i></a>
                                        @endcan
                                        @can('category delete')
                                            <form action="{{ route('category.destroy',['category'=>$category->id]) }}"
                                                  method="POST" class="delete-form">
                                                @csrf
                                                {{ @method_field('DELETE') }}
                                                <button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        @endcan
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
