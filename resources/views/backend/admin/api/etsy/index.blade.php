@extends('backend.layouts.master')
@section('title','Danh sách sản phẩm')
@section('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/simple-datatables/style.css') }}">
    <style>
        .text-right {
            text-align: right !important;
        }

        .card-header {
            background-color: #0dcaf0 !important;
        }

        .card-body {
            background-color: #fff !important;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }
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
        <div class="card text-white bg-info">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        @if(!\Illuminate\Support\Facades\Session::has('oauth_token'))
                            <a href="{{ route('etsy.connect') }}" class="btn btn-primary">Kết nối với Etsy</a>
                        @else
                            <h3>{{ 'Shop '.$nameShop }}</h3>
                        @endif
                    </div>
                    <div class="col-md-6">

                    </div>
                </div>

            </div>
            <div class="card-body">
                <div class="row">
                    @if(\Illuminate\Support\Facades\Session::has('oauth_token'))
                        <div class="col-md-12">
                            <table class="table table-striped table-bordered " id="table1">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Price</th>
                                    <th>Số lượng</th>
                                    <th>Lượt thích</th>
                                    <th>Lượt xem</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($listingShops as $key => $listingShop)
                                    <tr>

                                        <td>{{$key}}</td>
                                        <td>{{$listingShop['title']}}</td>
                                        <td>{{$listingShop['price']}}</td>
                                        <td>{{$listingShop['quantity']}}</td>
                                        <td>{{$listingShop['num_favorers']}}</td>
                                        <td>{{$listingShop['views']}}</td>
                                        <td>
                                            <div>
                                                <a href="{{$listingShop['url']}}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
{{--                                                <a href="" class="btn btn-danger">Xóa</a>--}}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
@endsection
