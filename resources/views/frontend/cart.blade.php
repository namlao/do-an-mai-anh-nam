@extends('frontend.layouts.master')
@section('title','Giỏ hàng')

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
        function updateCart(qty, rowId) {
            $.get(
                '{{route('cart.update')}}',
                {qty: qty, rowId: rowId},
                function () {
                    location.reload()
                }
            );
        }
    </script>
@endsection
@section('content')
    <div class="main">
        <div class="container">
            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40">
                <!-- BEGIN CONTENT -->
                <div class="col-md-12 col-sm-12">
                    <h1>Giỏ hàng</h1>
                    @if($cartContent->count()>0)
                    <div class="goods-page">
                        <div class="goods-data clearfix">
                            <div class="table-wrapper-responsive">
                                <table summary="Shopping cart">
                                    <tr>
                                        <th class="goods-page-image">Image</th>
                                        <th class="goods-page-description">Description</th>
                                        <th class="goods-page-ref-no">Ref No</th>
                                        <th class="goods-page-quantity">Quantity</th>
                                        <th class="goods-page-price">Unit price</th>
                                        <th class="goods-page-total" colspan="2">Total</th>
                                    </tr>
                                    @foreach($cartContent as $key => $content)

                                        <tr>
                                        <td class="goods-page-image">
                                            <a href="{{ route('item',['id' => $content->id]) }}"><img src="{{ asset($content->options->image) }}"
                                                                        alt="{{ $content->name }}"></a>
                                        </td>
                                        <td class="goods-page-description">
                                            <h3><a href="{{ route('item',['id' => $content->id]) }}">{{ $content->name }}</a></h3>
{{--                                            <p><strong>Laptop {{ $content->options->category }}</strong></p>--}}
                                        </td>
                                        <td class="goods-page-ref-no">
                                            javc2133
                                        </td>
                                        <td class="goods-page-quantity">
                                            <div class="product-quantity">
                                                <input id="product-quantity" type="text" value="{{ $content->qty }}" readonly
                                                       class="form-control input-sm" onchange="updateCart(this.value,'{{$content->rowId}}')">
                                            </div>
                                        </td>
                                        <td class="goods-page-price">
                                            <strong>{{ $content->price }} <span>VND</span></strong>
                                        </td>
                                        <td class="goods-page-total">
                                            <strong>{{ $content->price*$content->qty }} <span>VND</span></strong>
                                        </td>
                                        <td class="del-goods-col">
                                            <a class="del-goods" href="{{ route('cart.remove',['rowId'=>$key]) }}" >&nbsp;</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>

                            <div class="shopping-total">
                                <ul>
                                    <li>
                                        <em>Tổng tiền</em>
                                        <strong class="price">{{ Cart::total() }} <span>VND</span></strong>
                                    </li>
                                    <li>
                                        <em>Shipping cost</em>
                                        <strong class="price">Miễn phí</strong>
                                    </li>
                                    <li class="shopping-total-price">
                                        <em>Tổng đơn đặt hàng</em>
                                        <strong class="price">{{ Cart::total() }} <span>VND</span></strong>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <a class="btn btn-default" href="{{ route('index') }}">Tiếp tục mua <i
                                class="fa fa-shopping-cart"></i></a>
                        <button class="btn btn-primary" type="submit">Checkout <i class="fa fa-check"></i></button>
                    </div>
                    @else
                        <div class="shopping-cart-page">
                            <div class="shopping-cart-data clearfix">
                                <p>Giỏ hàng của bạn trống</p>
                            </div>
                        </div>
                    @endif
                </div>
                <!-- END CONTENT -->
            </div>
            <!-- END SIDEBAR & CONTENT -->

           @include('frontend.partials.popular-product')
        </div>
    </div>

@endsection
