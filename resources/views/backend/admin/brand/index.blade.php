@extends('backend.layouts.master')
@section('title','Danh sách thương hiệu')
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
    @include('backend.partials.page-heading',['namepage'=>'Danh sách thương hiệu'])

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
                                <th>Logo</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($brands as $key => $brand)
                                <tr>
                                    <td>{{ $key }}</td>
                                    <td>{{$brand->name}}</td>
                                    <td>
                                        <div>
                                            <img width="150" height="250" style="object-fit: contain" src="{{ url($brand->logo) }}">
                                        </div>
                                    </td>

                                    <td>
                                            <a href="{{ route('brand.edit',['brand'=>$brand->id]) }}"
                                               class="btn btn-primary"><i class="fas fa-wrench"></i></a>
                                            <form action="{{ route('brand.destroy',['brand'=>$brand->id]) }}"
                                                  method="POST" class="delete-form">
                                                @csrf
                                                {{ @method_field('DELETE') }}
                                                <button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
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
