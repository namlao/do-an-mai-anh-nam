@extends('frontend.layouts.master')
@section('title','Trang chủ')

@section('css')

    <style>
        .pi-img-wrapper {
            height: 130px;
        }
        .product-img{
            height: 100%;
            object-fit: contain !important;
        }
        .pi-img-wrapper img {
            object-fit: cover;
        }

        .list-group-item a:focus + ul.dropdown-menu {
            display: block;
        }
    </style>
@endsection

@section('js')
    {{--    <script>--}}
    {{--        $('.list-group-item > a').document(function (){--}}
    {{--            this.preventDefault();--}}
    {{--        });--}}
    {{--    </script>--}}
@endsection

@section('content')
    @include('frontend.partials.slide')

    <div class="main">
        <div class="container">
            <!-- BEGIN SALE PRODUCT & NEW ARRIVALS -->
            <div class="row margin-bottom-40">
                <!-- BEGIN SALE PRODUCT -->
                <div class="col-md-12 sale-product">
                    <h2>Sản phẩm mới nhất</h2>
                    <div class="owl-carousel owl-carousel5">
                        @foreach($productNews as $productNew)
                            <div>
                                <div class="product-item">
                                    <div class="pi-img-wrapper">
                                        <img style="height: 100%" src="{{ $productNew->image_feature_path }}" class="img-responsive"
                                             alt="Berry Lace Dress">
                                        <div>
                                            <a href="{{ $productNew->image_feature_path }}"
                                               class="btn btn-default fancybox-button">Phóng to</a>
                                            <a href="#product-pop-up-{{$productNew->id}}"
                                               class="btn btn-default fancybox-fast-view">Xem</a>
                                        </div>
                                    </div>
                                    <h3><a href="{{ route('item',['id'=>$productNew->id]) }}">{{ $productNew->name }}</a></h3>
                                    <div class="pi-price">{{ number_format($productNew->price, 0, ',', '.') }}
                                        <span>VND</span></div>
                                    <a href="{{ route('cart.add',['id'=>$productNew->id]) }}" class="btn btn-default add2cart">Thêm vào giỏ</a>
                                    <div class="sticker sticker-new"></div>
                                </div>
                                <!-- BEGIN fast view of a product -->
                                <div id="product-pop-up-{{$productNew->id}}" style="display: none; width: 700px;">
                                    <div class="product-page product-pop-up">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-3">
                                                <div class="product-main-image">
                                                    <img src="{{ $productNew->image_feature_path }}"
                                                         alt="Cool green dress with red bell" class="img-responsive">
                                                </div>
                                                {{--                                            <div class="product-other-images">--}}
                                                {{--                                                <a href="javascript:;" class="active"><img alt="Berry Lace Dress" src="{{asset('frontend/assets/pages/img/products/model3.jpg')}}"></a>--}}
                                                {{--                                                <a href="javascript:;"><img alt="Berry Lace Dress" src="{{asset('frontend/assets/pages/img/products/model4.jpg')}}"></a>--}}
                                                {{--                                                <a href="javascript:;"><img alt="Berry Lace Dress" src="{{asset('frontend/assets/pages/img/products/model5.jpg')}}"></a>--}}
                                                {{--                                            </div>--}}
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-9">
                                                {{--                                            <div class="sticker sticker-new"></div>--}}

                                                <h2 >{{$productNew->name}}</h2>
                                                <div class="price-availability-block clearfix">
                                                    <div class="price">
                                                        <strong>{{ number_format($productNew->price, 0, ',', '.') }}
                                                            <span>VND</span></strong>
                                                        {{--                                                    <em>$<span>62.00</span></em>--}}
                                                    </div>
                                                    <div class="availability">
                                                        Trạng thái:
                                                        @if($productNew->quantity > 0)
                                                            <strong>Còn hàng</strong>
                                                        @else
                                                            <strong>Hết hàng</strong>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="description">
                                                    {{--                                                <p>Lorem ipsum dolor ut sit ame dolore  adipiscing elit, sed nonumy nibh sed euismod laoreet dolore magna aliquarm erat volutpat Nostrud duis molestie at dolore.</p>--}}
                                                    <p>{!! $productNew->short_description !!} </p>
                                                </div>
                                                {{--                                            <div class="product-page-options">--}}
                                                {{--                                                <div class="pull-left">--}}
                                                {{--                                                    <label class="control-label">Size:</label>--}}
                                                {{--                                                    <select class="form-control input-sm">--}}
                                                {{--                                                        <option>L</option>--}}
                                                {{--                                                        <option>M</option>--}}
                                                {{--                                                        <option>XL</option>--}}
                                                {{--                                                    </select>--}}
                                                {{--                                                </div>--}}
                                                {{--                                                <div class="pull-left">--}}
                                                {{--                                                    <label class="control-label">Color:</label>--}}
                                                {{--                                                    <select class="form-control input-sm">--}}
                                                {{--                                                        <option>Red</option>--}}
                                                {{--                                                        <option>Blue</option>--}}
                                                {{--                                                        <option>Black</option>--}}
                                                {{--                                                    </select>--}}
                                                {{--                                                </div>--}}
                                                {{--                                            </div>--}}
                                                <div class="product-page-cart">
                                                    <div class="product-quantity">
                                                        <input id="product-quantity" type="text" value="1" readonly
                                                               name="product-quantity" class="form-control input-sm">
                                                    </div>
                                                    <a class="btn btn-primary" type="submit" href="{{ route('cart.add',['id'=>$productNew->id]) }}">Thêm vào giỏ</a>
                                                    <a href="{{ route('item',['id'=>$productNew->id]) }}" class="btn btn-default">Chi tiết</a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- END fast view of a product -->
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- END SALE PRODUCT -->
            </div>
            <!-- END SALE PRODUCT & NEW ARRIVALS -->

            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40 ">
            {{--           @include('frontend.partials.sidebar')--}}
            <!-- BEGIN CONTENT -->
                @foreach($categoryWithProducts as $category)
                    @if(!is_null($category->product))

                    <div class="col-md-12 col-sm-12">
                        <h2 style="margin-top: 15px;margin-bottom: 15px">{{ $category->name }}</h2>

                        <div class="owl-carousel owl-carousel3">
                                @foreach($category->product as $productItem)

                                    <div>
                                        <div class="product-item">
                                            <div class="pi-img-wrapper">
                                                <img height="100%" src="{{ url($productItem->image_feature_path) }}" class="img-responsive product-img"
                                                     alt="Berry Lace Dress">
                                                <div>
                                                    <a href="{{  url($productItem->image_feature_path) }}"
                                                       class="btn btn-default fancybox-button">Phóng to</a>
                                                    <a href="#product-pop-up-{{$productItem->id}}"
                                                       class="btn btn-default fancybox-fast-view">Xem</a>
                                                </div>
                                            </div>
                                            <h3><a href="{{ route('item',['id'=>$productNew->id]) }}">{{ $productItem->name }}</a></h3>
                                            <div class="pi-price">{{  number_format($productItem->price, 0, ',', '.')  }} VND</div>
                                            <a href="{{ route('cart.add',['id'=>$productItem->id]) }}" class="btn btn-default add2cart">Thêm vào giỏ</a>
                                            {{--                                    <div class="sticker sticker-new"></div>--}}
                                        </div>
                                        <div id="product-pop-up-{{$productItem->id}}" style="display: none; width: 700px;">
                                            <div class="product-page product-pop-up">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6 col-xs-3">
                                                        <div class="product-main-image">
                                                            <img src="{{ $productNew->image_feature_path }}"
                                                                 alt="Cool green dress with red bell" class="img-responsive">
                                                        </div>
                                                        {{--                                            <div class="product-other-images">--}}
                                                        {{--                                                <a href="javascript:;" class="active"><img alt="Berry Lace Dress" src="{{asset('frontend/assets/pages/img/products/model3.jpg')}}"></a>--}}
                                                        {{--                                                <a href="javascript:;"><img alt="Berry Lace Dress" src="{{asset('frontend/assets/pages/img/products/model4.jpg')}}"></a>--}}
                                                        {{--                                                <a href="javascript:;"><img alt="Berry Lace Dress" src="{{asset('frontend/assets/pages/img/products/model5.jpg')}}"></a>--}}
                                                        {{--                                            </div>--}}
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 col-xs-9">
                                                        {{--                                            <div class="sticker sticker-new"></div>--}}

                                                        <h2 >{{$productNew->name}}</h2>
                                                        <div class="price-availability-block clearfix">
                                                            <div class="price">
                                                                <strong>{{ number_format($productNew->price, 0, ',', '.') }}
                                                                    <span>VND</span></strong>
                                                                {{--                                                    <em>$<span>62.00</span></em>--}}
                                                            </div>
                                                            <div class="availability">
                                                                Trạng thái:
                                                                @if($productNew->quantity > 0)
                                                                    <strong>Còn hàng</strong>
                                                                @else
                                                                    <strong>Hết hàng</strong>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="description">
                                                            {{--                                                <p>Lorem ipsum dolor ut sit ame dolore  adipiscing elit, sed nonumy nibh sed euismod laoreet dolore magna aliquarm erat volutpat Nostrud duis molestie at dolore.</p>--}}
                                                            <p>{!! $productNew->short_description !!} </p>
                                                        </div>
                                                        {{--                                            <div class="product-page-options">--}}
                                                        {{--                                                <div class="pull-left">--}}
                                                        {{--                                                    <label class="control-label">Size:</label>--}}
                                                        {{--                                                    <select class="form-control input-sm">--}}
                                                        {{--                                                        <option>L</option>--}}
                                                        {{--                                                        <option>M</option>--}}
                                                        {{--                                                        <option>XL</option>--}}
                                                        {{--                                                    </select>--}}
                                                        {{--                                                </div>--}}
                                                        {{--                                                <div class="pull-left">--}}
                                                        {{--                                                    <label class="control-label">Color:</label>--}}
                                                        {{--                                                    <select class="form-control input-sm">--}}
                                                        {{--                                                        <option>Red</option>--}}
                                                        {{--                                                        <option>Blue</option>--}}
                                                        {{--                                                        <option>Black</option>--}}
                                                        {{--                                                    </select>--}}
                                                        {{--                                                </div>--}}
                                                        {{--                                            </div>--}}
                                                        <div class="product-page-cart">
                                                            <div class="product-quantity">
                                                                <input id="product-quantity" type="text" value="1" readonly
                                                                       name="product-quantity" class="form-control input-sm">
                                                            </div>
                                                            <button class="btn btn-primary" type="{{ route('cart.add',['id'=>$productNew->id]) }}">Thêm vào giỏ</button>
                                                            <a href="{{ route('item',['id'=>$productNew->id]) }}" class="btn btn-default">Chi tiết</a>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                        </div>
                    </div>
                @endif

            @endforeach
            <!-- END CONTENT -->
            </div>
            <!-- END SIDEBAR & CONTENT -->
        </div>
    </div>
    @include('frontend.partials.brands')

@endsection
