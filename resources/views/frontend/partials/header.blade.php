<!-- BEGIN HEADER -->
<div class="header">
    <div class="container">
        <a class="site-logo" href="{{ url('') }}"><img src="{{ url(\App\Helpers\getConfigSetting::getConfigValue('logo')) }}"
                                                       alt="Metronic Shop UI"></a>

        <a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a>

        <!-- BEGIN CART -->
        <div class="top-cart-block">
            <div class="top-cart-info">
                <a href="{{ route('cart.index') }}" class="top-cart-info-count">{{ Cart::count() }} items</a>
                <a href="{{ route('cart.index') }}" class="top-cart-info-value">{{ Cart::total() }} VND</a>
            </div>
            <i class="fa fa-shopping-cart"></i>

            <div class="top-cart-content-wrapper">
                <div class="top-cart-content">
                    @if(Cart::count() > 0)
                    <ul class="scroller" style="height: 250px;">
                        @foreach(Cart::content() as $cart)
                            <li>
                            <a href="{{ route('item',['id' => $cart->id]) }}"><img src="{{ asset($cart->options->image) }}"
                                                          alt="Rolex Classic Watch" width="37" height="34"></a>
                            <span class="cart-content-count">x {{ $cart->qty}}</span>
                            <strong><a href="{{ route('item',['id' => $cart->id]) }}">{{ $cart->name }}</a></strong>
                            <em>{{ $cart->price }}</em>
                                <form action="{{ route('cart.remove',['rowId' => $cart->rowId]) }}"
                                      class="delete-form" method="post">
                                    @csrf
                                    @method('post')
                                    <button class="del-goods" style="border: none"></button>
                                </form>
                        </li>
                        @endforeach
                    </ul>
                    <div class="text-right">
                        <a href="{{ route('cart.index') }}" class="btn btn-default">Gi??? h??ng</a>
                        <a href="{{ route('cart.checkout') }}" class="btn btn-primary">Thanh to??n</a>
                    </div>
                    @else
                        <div class="text-center">
                            <p class="color-red">Kh??ng c?? s???n ph???m n??o trong gi??? h??ng</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!--END CART -->

        <!-- BEGIN NAVIGATION -->
        <div class="header-navigation">
            <ul>
                <li><a href="{{url('')}}">Home</a></li>
                <li><a href="{{route('shop')}}">Shop</a></li>
{{--                @foreach($categories as $category)--}}
{{--                    <li class="dropdown">--}}
{{--                        <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="#">--}}
{{--                            {{ $category->name }}--}}

{{--                        </a>--}}
{{--                        <!-- BEGIN DROPDOWN MENU -->--}}
{{--                        <ul class="dropdown-menu">--}}
{{--                            @foreach($category->children as $cat_child)--}}
{{--                                <li class="dropdown-submenu">--}}
{{--                                    <a href="{{ route('category',['id'=>$cat_child->id]) }}">{{ $cat_child->name }} </a>--}}
{{--                                </li>--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}
{{--                        <!-- END DROPDOWN MENU -->--}}
{{--                    </li>--}}
{{--            @endforeach--}}
                <li><a href="{{route('about')}}">Gi???i thi???u</a></li>
                <li><a href="{{route('contact')}}">Li??n h???</a></li>

            <!-- BEGIN TOP SEARCH -->
                <li class="menu-search">
                    <span class="sep"></span>
                    <i class="fa fa-search search-btn"></i>
                    <div class="search-box">
                        <form action="{{ route('getSearch') }}" method="get">
                            <div class="input-group">
                                <input type="text" placeholder="Nh???p t??? kh??a" class="form-control" name="keyword">
                                <span class="input-group-btn">
                      <button class="btn btn-primary" type="submit">T??m ki???m</button>
                    </span>
                            </div>
                        </form>
                    </div>
                </li>
                <!-- END TOP SEARCH -->
            </ul>
        </div>
        <!-- END NAVIGATION -->
    </div>
</div>
<!-- Header END -->
