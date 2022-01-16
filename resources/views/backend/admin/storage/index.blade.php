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
    @include('backend.partials.page-heading',['namepage'=>'Kho'])

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <a href="" class="btn btn-info">Hướng dẫn</a>
                        <a href="" class="btn btn-success">Import</a>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered" id="table1">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Năm sản xuất</th>
                                <th>Nơi sản xuất</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>

                                <td>1</td>
                                <td>Acer</td>
                                <td>11</td>
                                <td>1996</td>
                                <td>Acer</td>
                                <td>


{{--                                    <form action="{{ route('storage.destroy',['storage'=>$product->id]) }}"--}}
{{--                                          method="POST" class="delete-form">--}}
{{--                                        @csrf--}}
{{--                                        {{ @method_field('DELETE') }}--}}
{{--                                        <button class="btn btn-danger">Xóa</button>--}}
{{--                                    </form>--}}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
