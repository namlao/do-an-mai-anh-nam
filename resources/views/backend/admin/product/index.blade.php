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
    @include('backend.partials.page-heading',['namepage'=>'Danh sách sản phẩm'])

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @if (session('lazadaError'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('lazadaError') }}
                        </div>
                    @endif
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered" id="table1">
                            <thead>
                            <tr>
                                <th width="50">#</th>
                                <th>Name</th>
                                <th>Ảnh đại diện</th>
                                <th width="100">Chuyên mục</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $key => $product)
                                <tr>

                                    <td>{{$key}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>
                                        <div>
                                            <img width="150" height="250" style="object-fit: contain" src="{{ url($product->image_feature_path) }}">
                                        </div>
                                    </td>
                                    <td>{{$product->category->name }}</td>
                                    <td>{{ number_format($product->price, 0, ',', '.') }} VND</td>
                                    <td>
{{--                                        <a href="{{ route('etsy.add',['id' => $product->id]) }}" class="btn btn-success"><i class="fab fa-etsy"></i></a>--}}
                                        @can('product edit')
                                            <a href="{{ route('product.edit',['product'=>$product->id]) }}"
                                               class="btn btn-primary mb-1"><i class="fas fa-wrench"></i></a><br>
                                        @endcan
                                        @if(!$product->item_id || !$product->sku_id)
                                            <a href="{{ route('product.sync',['product'=>$product->id]) }}"
                                               class="btn btn-primary mb-1"><i class="fas fa-sync"></i></a><br>
                                        @endif
                                        @can('product delete')
                                            <form action="{{ route('product.destroy',['product'=>$product->id]) }}"
                                                  method="POST" class="delete-form">
                                                @csrf
                                                {{ @method_field('DELETE') }}
                                                <button class="btn btn-danger mb-1"><i class="fas fa-trash-alt"></i></button>
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
