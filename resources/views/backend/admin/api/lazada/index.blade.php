@extends('backend.layouts.master')
@section('title','Lazada - Danh sách sản phẩm')
@section('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/simple-datatables/style.css') }}">
    <style>
        *{
            outline: none;
        }
        .badge-danger{
            background-color: #dc3545;
        }
        .badge-success{
            background-color: #28a745;
        }

    </style>
@endsection
@section('js')


    <script src="{{ asset('backend/assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script>
        let all_product = document.querySelector('#all_product');
        let dataTable1 = new simpleDatatables.DataTable(all_product);

        let product_active_table = document.querySelector('#product_active_table');
        let dataTable2 = new simpleDatatables.DataTable(product_active_table);

        let product_inactive_table = document.querySelector('#product_inactive_table');
        let dataTable3 = new simpleDatatables.DataTable(product_inactive_table);

        let product_deleted_table = document.querySelector('#product_deleted_table');
        let dataTable4 = new simpleDatatables.DataTable(product_deleted_table);


    </script>
@endsection
@section('content')
    @include('backend.partials.page-heading',['namepage'=>'Lazada - Danh sách sản phẩm'])

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6"><h5>Thông tin shop</h5></div>
                            <div class="col-md-6">
                                <div>
                                    <p><strong>Tên shop:</strong> {{$info['data']['name']}}</p>
                                    <p><strong>Trạng thái:</strong> {{$info['data']['status']}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="button" class="btn btn-primary" onclick="refresh()">Refresh</button>
                        <script>
                            function refresh(){
                                location.reload();
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-all-product-tab"
                                data-bs-toggle="tab"
                                data-bs-target="#all-product" type="button" role="tab"
                                aria-controls="all-product" aria-selected="true">Tất cả sản phẩm {{ isset($productAll['data']['total_products'])?'('.$productAll['data']['total_products'].')':'' }}
                        </button>
                        <button class="nav-link" id="nav-product-active-tab"
                                data-bs-toggle="tab"
                                data-bs-target="#active-product" type="button" role="tab"
                                aria-controls="active-product" aria-selected="false">Đang hoạt động {{ isset($productActive['data']['total_products'])?'('.$productActive['data']['total_products'].')':'' }}
                        </button>
                        <button class="nav-link" id="nav-product-inactive-tab"
                                data-bs-toggle="tab"
                                data-bs-target="#inactive-product" type="button" role="tab"
                                aria-controls="inactive-product" aria-selected="false">Không hoạt động {{ isset($productInactive['data']['total_products'])?'('.$productInactive['data']['total_products'].')':'' }}
                        </button>
                        <button class="nav-link" id="nav-product-deleted-tab"
                                data-bs-toggle="tab"
                                data-bs-target="#deleted-product" type="button" role="tab"
                                aria-controls="deleted-product" aria-selected="false">Đã xóa {{ isset($productDeleted['data']['total_products'])?'('.$productDeleted['data']['total_products'].')':'' }}
                        </button>

                    </div>
                </nav>
            </div>
        </div>

        <div class="tab-content mt-3" id="nav-tabContent">
            <div class="tab-pane fade show active" id="all-product" role="tabpanel"
                 aria-labelledby="nav-all-product-tab">
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-12">
                                <table class="table table-striped table-bordered" id="all_product">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Ảnh</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Giá</th>
                                        <th>Status</th>
                                        <th>Hành động nhanh</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($productAllItem)
                                        @foreach($productAllItem as $key => $item)
                                            <tr>
                                                <th scope="row">{{ $key }}</th>
                                                <th>
                                                    <img width="150" height="150" style="object-fit: cover" src="{{ $item['images'][0] }}" alt="">
                                                </th>
                                                <td>

                                                    <a href="{{ $item['skus'][0]['Url'] }}">{{ $item['attributes']['name'] }}</a>
                                                </td>
                                                <td>{{ $item['skus'][0]['quantity'] }}</td>
                                                <td>{{ $item['skus'][0]['price'] }}</td>
                                                <td>
                                                    @include('backend.admin.api.lazada.include.status')
                                                </td>
                                                <td>

                                                    @include('backend.admin.api.lazada.include.action')
                                                </td>


                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="tab-pane fade" id="active-product" role="tabpanel"
                 aria-labelledby="nav-product-active-tab">
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-12">
                                <table class="table table-striped table-bordered" id="product_active_table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Ảnh</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Giá</th>
                                        <th>Status</th>
                                        <th>Hành động nhanh</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($productActiveItem)
                                        @foreach($productActiveItem as $key => $item)
                                            <tr>
                                                <th scope="row">{{ $key }}</th>
                                                <th>
                                                    <img width="150" height="150" style="object-fit: cover" src="{{ $item['images'][0] }}" alt="">
                                                </th>
                                                <td>

                                                    <a href="{{ $item['skus'][0]['Url'] }}">{{ $item['attributes']['name'] }}</a>
                                                </td>
                                                <td>{{ $item['skus'][0]['quantity'] }}</td>
                                                <td>{{ $item['skus'][0]['price'] }}</td>
                                                <td>
                                                    @include('backend.admin.api.lazada.include.status')
                                                </td>
                                                <td>
                                                    @include('backend.admin.api.lazada.include.action')
                                                </td>


                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="tab-pane fade" id="inactive-product" role="tabpanel"
                 aria-labelledby="nav-product-inactive-tab">
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-12">
                                <table class="table table-striped table-bordered" id="product_inactive_table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Ảnh</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Giá</th>
                                        <th>Status</th>
                                        <th>Hành động nhanh</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($productInactiveItem)
                                        @foreach($productInactiveItem as $key => $item)
                                            <tr>
                                                <th scope="row">{{ $key }}</th>
                                                <th>
                                                    <img width="150" height="150" style="object-fit: cover" src="{{ $item['images'][0] }}" alt="">
                                                </th>
                                                <td>

                                                    <a href="{{ $item['skus'][0]['Url'] }}">{{ $item['attributes']['name'] }}</a>
                                                </td>
                                                <td>{{ $item['skus'][0]['quantity'] }}</td>
                                                <td>{{ $item['skus'][0]['price'] }}</td>
                                                <td>
                                                    @include('backend.admin.api.lazada.include.status')
                                                </td>
                                                <td>
                                                    @include('backend.admin.api.lazada.include.action')
                                                </td>


                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="tab-pane fade" id="deleted-product" role="tabpanel"
                 aria-labelledby="nav-product-deleted-tab">
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-12">
                                <table class="table table-striped table-bordered" id="product_deleted_table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Ảnh</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Giá</th>
                                        <th>Status</th>
                                        <th>Hành động nhanh</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($productDeletedItem)
                                        @foreach($productDeletedItem as $key => $item)
                                            <tr>
                                                <th scope="row">{{ $key }}</th>
                                                <th>
                                                    <img width="150" height="150" style="object-fit: cover" src="{{ $item['images'][0] }}" alt="">
                                                </th>
                                                <td>

                                                    <a href="{{ $item['skus'][0]['Url'] }}">{{ $item['attributes']['name'] }}</a>
                                                </td>
                                                <td>{{ $item['skus'][0]['quantity'] }}</td>
                                                <td>{{ $item['skus'][0]['price'] }}</td>
                                                <td>
                                                    @include('backend.admin.api.lazada.include.status')
                                                </td>
                                                <td>

                                                    @include('backend.admin.api.lazada.include.action')
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>
@endsection


