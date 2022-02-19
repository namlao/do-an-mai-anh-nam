@extends('frontend.layouts.master')
@section('title','Shop')

@section('css')
    <link href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" rel="stylesheet"
          type="text/css"><!-- for slider-range -->
    <style>
        .pi-img-wrapper {
            height: 130px;
        }

        .pi-img-wrapper img {
            object-fit: contain;
            height: 100%;
            margin: 0 auto;
        }
    </style>
@endsection

@section('js')
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"
            type="text/javascript"></script><!-- for slider-range -->
    <script type="text/javascript">
        jQuery(document).ready(function () {
            // Layout.init();
            Layout.initOWL();
            Layout.initTwitter();
            Layout.initImageZoom();
            Layout.initTouchspin();
            Layout.initUniform();
            Layout.initSliderRange();
        });

        //ajax sort with shop
        $('#sort').on('change',function (e) {
            console.log(e)
            var sort = e.target.value;
            $.get('sort/'+sort,function (data) {
                $('#ajaxProduct').html(data)
            });
        })

        //ajax show shop
        $('#showShop').on('change',function (e) {
            console.log(e)
            var show = e.target.value;
            $.get('showShop/'+show,function (data) {
                $('#ajaxProduct').html(data)
            })
        })


        //ajax filter quantity shop
        $('.filter-stock').on('click',function (e) {
            var filterShop = e.target.value;
            $.get('filterStockShop/'+filterShop,function (data) {
                $('#ajaxProduct').html(data)
            })
        })

        //filter price shop
        $('.filter-price').on('click',function (e) {
            var filterShop = e.target.value;
            $.get('filterPriceShop/'+filterShop,function (data) {
                $('#ajaxProduct').html(data)
                // alert(data)
            })
        })
    </script>
@endsection

@section('content')
    <div class="title-wrapper">
        <div class="container">
            <div class="container-inner">
                <h1>Shop</h1>
                {{--            <em>Over 4000 Items are available here</em>--}}
            </div>
        </div>
    </div>

    <div class="main">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ url('') }}">Home</a></li>
                <li><a href="{{ route('shop')  }}">Cửa hàng</a></li>
            </ul>
            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40">
            @include('frontend.partials.sidebar')
            <!-- BEGIN CONTENT -->
                <div class="col-md-9 col-sm-7">
                    <div class="row list-view-sorting clearfix">
                        <div class="col-md-2 col-sm-2 list-view">
                            <a href="javascript:;"><i class="fa fa-th-large"></i></a>
                            <a href="javascript:;"><i class="fa fa-th-list"></i></a>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <div class="pull-right">
                                <label class="control-label">Hiển thị:</label>

                                    <select class="form-control input-sm" id="showShop">
                                        <option value="">Chọn</option>
                                        <option value="2">2</option>
                                        <option value="16">16</option>
                                        <option value="32">32</option>
                                        <option value="48">48</option>
                                        <option value="64">64</option>
                                        <option value="80">80</option>
                                    </select>
                                <span>Sản phẩm</span>

                            </div>
                            <div class="pull-right">
                                <label class="control-label">Sắp xếp theo:</label>
                                <select class="form-control input-sm" id="sort">
                                    <option value="" selected="selected">Chọn
                                    </option>
                                    <option value="name_asc">Name (A - Z)</option>
                                    <option value="name_desc">Name (Z - A)</option>
                                    <option value="price_asc">Price (Low &gt; High)</option>
                                    <option value="price_desc">Price (High &gt; Low)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- BEGIN PRODUCT LIST -->

                    <div class="row product-list"  id="ajaxProduct">
                    @foreach($products as $product)
                        <!-- PRODUCT ITEM START -->
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="product-item">
                                    <div class="pi-img-wrapper">
                                        <img src="{{ url($product->image_feature_path) }}" class="img-responsive"
                                             alt="Berry Lace Dress">
                                        <div>
                                            <a href="{{ url($product->image_feature_path) }}"
                                               class="btn btn-default fancybox-button">Zoom</a>
                                            <a href="#product-pop-up-{{$product->id}}"
                                               class="btn btn-default fancybox-fast-view">View</a>
                                        </div>
                                    </div>
                                    <h3><a href="{{ route('item',['id' => $product->id]) }}">{{ $product->name }}</a>
                                    </h3>
                                    <div class="pi-price">{{ number_format($product->price, 0, ',', '.') }} VND</div>
                                    <a href="{{ route('cart.add',['id' => $product->id]) }}"
                                       class="btn btn-default add2cart">Thêm vào giỏ</a>
                                </div>
                                <div id="product-pop-up-{{$product->id}}" style="display: none; width: 700px;">
                                    <div class="product-page product-pop-up">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-3">
                                                <div class="product-main-image">
                                                    <img src="{{ url($product->image_feature_path) }}"
                                                         alt="Cool green dress with red bell" class="img-responsive">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-9">
                                                <h2>{{$product->name}}</h2>
                                                <div class="price-availability-block clearfix">
                                                    <div class="price">
                                                        <strong>{{ number_format($product->price, 0, ',', '.') }}
                                                            <span>VND</span></strong>
                                                        {{--                                                    <em>$<span>62.00</span></em>--}}
                                                    </div>
                                                    <div class="availability">
                                                        Trạng thái:
                                                        @if($product->quantity > 0)
                                                            <strong>Còn hàng</strong>
                                                        @else
                                                            <strong>Hết hàng</strong>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="description">
                                                    <p>{!! $product->short_description !!} </p>
                                                    <div class="product-page-cart">
                                                        <div class="product-quantity">
                                                            <input id="product-quantity" type="text" value="1" readonly
                                                                   name="product-quantity"
                                                                   class="form-control input-sm">
                                                        </div>
                                                        <a class="btn btn-primary"
                                                           href="{{ route('cart.add',['id' => $product->id]) }}">Thêm
                                                            vào giỏ</a>
                                                        <a href="{{ route('item',['id' => $product->id]) }}"
                                                           class="btn btn-default">Chi tiết</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- PRODUCT ITEM END -->
                        @endforeach
                    </div>

                    <!-- END PRODUCT LIST -->
                    <!-- BEGIN PAGINATOR -->
                    <div class="row">
                        {{ $products->links() }}
                    </div>
                {{--                <div class="row">--}}
                {{--                    <div class="col-md-4 col-sm-4 items-info">Items 1 to 9 of 10 total</div>--}}
                {{--                    <div class="col-md-8 col-sm-8">--}}
                {{--                        <ul class="pagination pull-right">--}}
                {{--                            <li><a href="javascript:;">&laquo;</a></li>--}}
                {{--                            <li><a href="javascript:;">1</a></li>--}}
                {{--                            <li><span>2</span></li>--}}
                {{--                            <li><a href="javascript:;">3</a></li>--}}
                {{--                            <li><a href="javascript:;">4</a></li>--}}
                {{--                            <li><a href="javascript:;">5</a></li>--}}
                {{--                            <li><a href="javascript:;">&raquo;</a></li>--}}
                {{--                        </ul>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                <!-- END PAGINATOR -->
                </div>
                <!-- END CONTENT -->
            </div>
            <!-- END SIDEBAR & CONTENT -->
        </div>
    </div>
    @include('frontend.partials.brands')

@endsection
