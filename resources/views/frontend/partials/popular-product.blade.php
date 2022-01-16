<!-- BEGIN SIMILAR PRODUCTS -->
<div class="row margin-bottom-40">
    <div class="col-md-12 col-sm-12">
        <h2>Đề xuất sản phẩm</h2>
        <div class="owl-carousel owl-carousel4">
            @foreach($product as $item )
            <div>
                <div class="product-item">
                    <div class="pi-img-wrapper">
                        <img src="{{ asset($item->image_feature_path) }}" class="img-responsive"
                             alt="Berry Lace Dress">
                        <div>
                            <a href="{{ asset($item->image_feature_path) }}"
                               class="btn btn-default fancybox-button">Zoom</a>
                            <a href="#product-pop-up-{{ $item->id }}" class="btn btn-default fancybox-fast-view">View</a>
                        </div>
                    </div>
                    <h3><a href="{{ route('item',['id' => $item->id]) }}">{{ asset($item->name) }}</a></h3>
                    <div class="pi-price">{{$item->price}} VND</div>
                    <a href="{{ route('cart.add',['id' => $item->id]) }}" class="btn btn-default add2cart">Thêm vào giỏ</a>
                    <div class="sticker sticker-new"></div>
                </div>
                <div id="product-pop-up-{{$item->id}}" style="display: none; width: 700px;">
                    <div class="product-page product-pop-up">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-3">
                                <div class="product-main-image">
                                    <img src="{{ $item->image_feature_path }}"
                                         alt="Cool green dress with red bell" class="img-responsive">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-9">
                                {{--                                            <div class="sticker sticker-new"></div>--}}

                                <h2>{{$item->name}}</h2>
                                <div class="price-availability-block clearfix">
                                    <div class="price">
                                        <strong>{{ number_format($item->price, 0, ',', '.') }}
                                            <span>VND</span></strong>
                                        {{--                                                    <em>$<span>62.00</span></em>--}}
                                    </div>
                                    <div class="availability">
                                        Trạng thái:
                                        @if($item->quantity > 0)
                                            <strong>Còn hàng</strong>
                                        @else
                                            <strong>Hết hàng</strong>
                                        @endif
                                    </div>
                                </div>
                                <div class="description">
                                    {{--                                                <p>Lorem ipsum dolor ut sit ame dolore  adipiscing elit, sed nonumy nibh sed euismod laoreet dolore magna aliquarm erat volutpat Nostrud duis molestie at dolore.</p>--}}
                                    <p>{!! $item->short_description !!} </p>
                                </div>
                                <div class="product-page-cart">
                                    <div class="product-quantity">
                                        <input id="product-quantity" type="text" value="1" readonly
                                               name="product-quantity" class="form-control input-sm">
                                    </div>
                                    <a class="btn btn-primary" href="{{ route('cart.add',['id'=>$item->id]) }}">Thêm vào giỏ</a>
                                    <a href="{{ route('item',['id'=>$item->id]) }}" class="btn btn-default">Chi tiết</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- END SIMILAR PRODUCTS -->
