<!-- BEGIN TOP BAR -->
<div class="pre-header">
    <div class="container">
        <div class="row">
            <!-- BEGIN TOP BAR LEFT PART -->
            <div class="col-md-6 col-sm-6 additional-shop-info">
                <ul class="list-unstyled list-inline">
                    <li>
                        <i class="fa fa-phone"></i><span>{{ \App\Helpers\getConfigSetting::getConfigValue('phone') }}</span>
                    </li>
                    <li>
                        <i class="fa fa-envelope"></i><span>{{ \App\Helpers\getConfigSetting::getConfigValue('email') }}</span>
                    </li>
                    <li>
                        <i class="fa fa-map-marker"></i><span>{{ \App\Helpers\getConfigSetting::getConfigValue('address') }}</span>
                    </li>
                </ul>
            </div>
            <!-- END TOP BAR LEFT PART -->
            <!-- BEGIN TOP BAR MENU -->
            <div class="col-md-6 col-sm-6 additional-nav">
                <ul class="list-unstyled list-inline pull-right">
                    <li>
                        @if(\Illuminate\Support\Facades\Auth::check() == 1)
                            Xin chào <a
                                href="{{ route('customer.account') }}">{{ \Illuminate\Support\Facades\Auth::user()->name }}</a>
                        @endif
                    </li>
{{--                    <li><a href="shop-wishlist.html">My Wishlist</a></li>--}}
                    <li><a href="{{ route('cart.checkout') }}">Thanh toán</a></li>
                    @if(\Illuminate\Support\Facades\Auth::check() == 1)
{{--                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"--}}
                        <a href="{{ route('customer.logout') }}">Đăng xuất</a>
{{--                        <form id="logout-form" action="{{ route('customer.logout') }}" method="POST" class="d-none">--}}
{{--                            @csrf--}}
{{--                        </form>--}}
                    @else
                        <li><a href="{{ route('customer.login') }}">Đăng nhập</a></li>
                    @endif

                </ul>
            </div>
            <!-- END TOP BAR MENU -->
        </div>
    </div>
</div>
<!-- END TOP BAR -->
