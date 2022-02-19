
@extends('frontend.layouts.master')
@section('title','Shop')

@section('css')
    <link href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css"><!-- for slider-range -->
    <link href="{{ asset('frontend/assets/plugins/rateit/src/rateit.css') }}" rel="stylesheet" type="text/css">

    <style>
        .pi-img-wrapper {
            height: 130px;
        }
        .pi-img-wrapper img{
            object-fit: contain;
            height: 100%;
        }
    </style>
@endsection

@section('js')
    <script src="{{ asset('frontend/assets/plugins/rateit/src/jquery.rateit.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            // Layout.init();
            Layout.initOWL();
            Layout.initTwitter();
            Layout.initImageZoom();
            Layout.initTouchspin();
            Layout.initUniform();
            Layout.initSliderRange();
        });


    </script>
@endsection

@section('content')
    <div class="main">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ url('') }}">Home</a></li>
                <li><a href="{{ route('shop') }}">Cửa hàng</a></li>
                <li class="active">{{ $productItem->name }}</li>
            </ul>
            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40">
                @include('frontend.partials.sidebar')

                <!-- BEGIN CONTENT -->
                <div class="col-md-9 col-sm-7">
                    <div class="product-page">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="product-main-image">
                                    <img src="{{ asset($productItem->image_feature_path) }}" alt="Cool green dress with red bell" class="img-responsive" data-BigImgsrc="assets/pages/img/products/model7.jpg">
                                </div>
                                <div class="product-other-images">
                                    @foreach($productItem->images as $image)
                                    <a href="{{ asset($image->path) }}" class="fancybox-button" rel="photos-lib"><img alt="Berry Lace Dress" src="{{ asset($image->path) }}"></a>
{{--                                    <a href="assets/pages/img/products/model4.jpg" class="fancybox-button" rel="photos-lib"><img alt="Berry Lace Dress" src="assets/pages/img/products/model4.jpg"></a>--}}
{{--                                    <a href="assets/pages/img/products/model5.jpg" class="fancybox-button" rel="photos-lib"><img alt="Berry Lace Dress" src="assets/pages/img/products/model5.jpg"></a>--}}
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <h1>{{ $productItem->name }}</h1>
                                <div class="price-availability-block clearfix">
                                    <div class="price">
                                        <strong>{{ $productItem->price }} <span>VND</span></strong>
{{--                                        <em>$<span>62.00</span></em>--}}
                                    </div>
                                    <div class="availability">
                                        Trạng thái:
                                        @if($productItem->quantity > 0)
                                            <strong>Còn hàng</strong>
                                        @else
                                            <strong>Hết hàng</strong>
                                        @endif
                                    </div>
                                </div>
                                <div class="description">
                                    <p>{{ $productItem->short_description }}</p>
                                </div>
{{--                                <div class="product-page-options">--}}
{{--                                    <div class="pull-left">--}}
{{--                                        <label class="control-label">Size:</label>--}}
{{--                                        <select class="form-control input-sm">--}}
{{--                                            <option>L</option>--}}
{{--                                            <option>M</option>--}}
{{--                                            <option>XL</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                    <div class="pull-left">--}}
{{--                                        <label class="control-label">Color:</label>--}}
{{--                                        <select class="form-control input-sm">--}}
{{--                                            <option>Red</option>--}}
{{--                                            <option>Blue</option>--}}
{{--                                            <option>Black</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="product-page-cart">
                                    <div class="product-quantity">
                                        <input id="product-quantity" type="text" value="1" readonly class="form-control input-sm">
                                    </div>
                                    <a class="btn btn-primary" href="{{ route('cart.add',['id'=>$productItem->id]) }}">Thêm vào giỏ</a>
                                </div>
                                <div class="review">
                                    <input type="range" value="4" step="0.25" id="backing4">
                                    <div class="rateit" data-rateit-backingfld="#backing4" data-rateit-resetable="false"  data-rateit-ispreset="true" data-rateit-min="0" data-rateit-max="5">
                                    </div>
                                    <a href="javascript:;">7 reviews</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="javascript:;">Write a review</a>
                                </div>
                                <ul class="social-icons">
                                    <li><a class="facebook" data-original-title="facebook" href="{{ \App\Helpers\getConfigSetting::getConfigValue('facebook') }}"></a></li>
                                    <li><a class="twitter" data-original-title="twitter" href="{{ \App\Helpers\getConfigSetting::getConfigValue('twitter') }}"></a></li>
{{--                                    <li><a class="youtube" data-original-title="youtube" href="{{ \App\Helpers\getConfigSetting::getConfigValue('youtube') }}"></a></li>--}}
                                </ul>
                            </div>

                            <div class="product-page-content">
                                <ul id="myTab" class="nav nav-tabs">
                                    <li class="active"><a href="#Description" data-toggle="tab">Mô tả chi tiết</a></li>
                                    <li><a href="#Information" data-toggle="tab">Thông tin</a></li>
                                    <li><a href="#Reviews" data-toggle="tab">Đánh giá ({{ $comments->count() }})</a></li>
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    <div class="tab-pane fade in active" id="Description">
                                        {!! $productItem->description !!}
                                    </div>
                                    <div class="tab-pane fade" id="Information">
                                        <table class="datasheet">
                                            <tr>
                                                <th colspan="2">Cấu hình</th>
                                            </tr>
                                            <tr>
                                                <td class="datasheet-features-type">CPU</td>
                                                <td>{{ $productItem->attribute->cpu }}</td>
                                            </tr>
                                            <tr>
                                                <td class="datasheet-features-type">RAM</td>
                                                <td>{{ $productItem->attribute->ram }}</td>
                                            </tr>
                                            <tr>
                                                <td class="datasheet-features-type">Ổ cứng</td>
                                                <td>{{ $productItem->attribute->hard_drive }}</td>
                                            </tr>
                                            <tr>
                                                <td class="datasheet-features-type">Màn hình</td>
                                                <td>{{ $productItem->attribute->screen }}</td>
                                            </tr>
                                            <tr>
                                                <td class="datasheet-features-type">Card đồ họa</td>
                                                <td>{{ $productItem->attribute->graphic_card }}</td>
                                            </tr>
                                            <tr>
                                                <td class="datasheet-features-type">Cổng kết nối</td>
                                                <td>{{ $productItem->attribute->connect_port }}</td>
                                            </tr>
                                            <tr>
                                                <td class="datasheet-features-type">Đặc biệt</td>
                                                <td>{{ $productItem->attribute->special }}</td>
                                            </tr>
                                            <tr>
                                                <td class="datasheet-features-type">Hệ điều hành</td>
                                                <td>{{ $productItem->attribute->os }}</td>
                                            </tr>
                                            <tr>
                                                <td class="datasheet-features-type">Thiết kế</td>
                                                <td>{{ $productItem->attribute->design }}</td>
                                            </tr>
                                            <tr>
                                                <td class="datasheet-features-type">Cân nặng</td>
                                                <td>{{ $productItem->attribute->weight }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="Reviews">
                                        <!--<p>There are no reviews for this product.</p>-->
                                        @foreach($comments as $comment)
                                        <div class="review-item clearfix">
                                            <div class="review-item-submitted">
                                                <strong>{{ $comment->name }}</strong>
                                                <em>{{ $comment->created_at }}</em>
                                                <div class="rateit" data-rateit-value="{{ $comment->rate }}" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
                                            </div>
                                            <div class="review-item-content">
                                                <p>{{ $comment->comment }}</p>
                                            </div>
                                        </div>
                                        @endforeach
{{--                                        <div class="review-item clearfix">--}}
{{--                                            <div class="review-item-submitted">--}}
{{--                                                <strong>Mary</strong>--}}
{{--                                                <em>13/12/2013 - 17:49</em>--}}
{{--                                                <div class="rateit" data-rateit-value="2.5" data-rateit-ispreset="true" data-rateit-readonly="true"></div>--}}
{{--                                            </div>--}}
{{--                                            <div class="review-item-content">--}}
{{--                                                <p>Sed velit quam, auctor id semper a, hendrerit eget justo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Duis vel arcu pulvinar dolor tempus feugiat id in orci. Phasellus sed erat leo. Donec luctus, justo eget ultricies tristique, enim mauris bibendum orci, a sodales lectus purus ut lorem.</p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

                                        <!-- BEGIN FORM-->
                                        <form action="{{ route('comment.store',['id' => $productItem->id]) }}" class="reviews-form" role="form" method="post">
                                            @csrf
                                            <h2>Viết đánh giá</h2>
                                            <div class="form-group">
                                                <label for="name">Tên <span class="require">*</span></label>
                                                <input type="text" class="form-control" id="name" name="name">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="text" class="form-control" id="email" name="email">
                                            </div>
                                            <div class="form-group">
                                                <label for="review">Đánh giá <span class="require">*</span></label>
                                                <textarea class="form-control" rows="8" id="review" name="comment"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Rating</label>
                                                <input type="range" value="4" step="0.25" id="backing5" name="rate">
                                                <div class="rateit" data-rateit-backingfld="#backing5" data-rateit-resetable="false"  data-rateit-ispreset="true" data-rateit-min="0" data-rateit-max="5">
                                                </div>
                                            </div>
                                            <div class="padding-top-20">
                                                <button type="submit" class="btn btn-primary">Send</button>
                                            </div>
                                        </form>
                                        <!-- END FORM-->
                                    </div>
                                </div>
                            </div>

{{--                            <div class="sticker sticker-sale"></div>--}}
                        </div>
                    </div>
                </div>
                <!-- END CONTENT -->
            </div>
            <!-- END SIDEBAR & CONTENT -->

           @include('frontend.partials.popular-product')
        </div>
    </div>
    @include('frontend.partials.brands')

@endsection
