@extends('backend.layouts.master')
@section('title','Danh sách sản phẩm')
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
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered" id="table1">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Ảnh đại diện</th>
                                <th>Chuyên mục</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>

                                    <td>{{$product->id}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>
                                        <div>
                                            <img width="150" height="250" src="{{ url($product->image_feature_path) }}">
                                        </div>
                                    </td>
                                    <td>{{$product->category->name }}</td>
                                    <td>{{ number_format($product->price, 0, ',', '.') }} VND</td>
                                    <td>
                                        <a href="{{ route('product.edit',['product'=>$product->id]) }}"
                                           class="btn btn-primary">Sửa</a>
                                        <form action="{{ route('product.destroy',['product'=>$product->id]) }}"
                                              method="POST" class="delete-form">
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
