@extends('frontend.layouts.master')
@section('title','Thanh toán')

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

        /*.accountBox{*/
        /*    display: none;*/
        /*}*/
    </style>
@endsection

@section('js')
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"
            type="text/javascript"></script><!-- for slider-range -->
    <script>
        // Đăng nhập/đăng ký
        $(document).ready(function () {
            $('input[type=radio][name=account]').click(function () {
                // var inputValue = $(this).attr("value");
                // var targetBox = $("." + inputValue);
                // $(".selectt").not(targetBox).hide();
                // $(targetBox).show();

                var test = $(this).val();

                $("div.accountBox").hide();
                $("#account-" + test).show();
                // alert("Radio button " + inputValue + " is selected");
            });
        });

        // ajax select district form province
        var urlDistrict = "{{ url('/jsonDistrictInProvince') }}";
        $("select[name='province_id']").change(function () {
            var province_id = $(this).val();
            var token = $("input[name='_token']").val();

            $.ajax({
                url: urlDistrict,
                method: 'POST',
                data: {
                    province_id: province_id,
                    _token: token
                },
                success: function (data) {
                    // $("select[name='province_id'").html('');
                    $.each(data, function (key, value) {
                        $("select[name='district_id']").append(
                            "<option value=" + value.id + ">" + value.name + "</option>"
                        );
                    });
                }
            });
        });

        // ajax select ward form District
        var urlWard = "{{ url('/jsonWardInDistrict') }}";
        $("select[name='district_id']").change(function () {
            var district_id = $(this).val();
            var token = $("input[name='_token']").val();

            $.ajax({
                url: urlWard,
                method: 'POST',
                data: {
                    district_id: district_id,
                    _token: token
                },
                success: function (data) {
                    // $("select[name='province_id'").html('');
                    $.each(data, function (key, value) {
                        $("select[name='ward_id']").append(
                            "<option value=" + value.id + ">" + value.name + "</option>"
                        );
                    });
                }
            });
        });
    </script>
@endsection
@section('content')

    <div class="main">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ url('') }}">Home</a></li>
                <li><a href="{{ route('shop') }}">Cửa hàng</a></li>
                <li class="active">Thanh toán</li>
            </ul>
            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40">
                <!-- BEGIN CONTENT -->
                @if(auth()->check())
                    <div class="col-md-12 col-sm-12">
                        <h1>Thanh toán</h1>
                        <!-- BEGIN CHECKOUT PAGE -->
                        <div class="panel-group checkout-page accordion scrollable" id="checkout-page">

                            <!-- BEGIN PAYMENT ADDRESS -->
                            @if($cartCount == 0)
                                <div class="col-md-12 col-sm-12" style="margin-bottom: 15px;margin-top: 15px">
                                    <div class="text-center">
                                        <h1>Bạn hãy mua hàng mới sử dụng được tính năng này</h1>
                                        <a href="{{ route('shop') }}" class="btn btn-primary" style="color: white">Mua hàng</a>
                                    </div>
                                </div>
                            @else
                                <form action="{{ route('cart.postCheckout') }}" method="post" style="margin-top: 5px;">
                                    @csrf
                                    <div id="payment-address" class="panel panel-default">
                                        <div class="panel-heading">
                                            <h2 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#checkout-page"
                                                   href="#payment-address-content" class="accordion-toggle">
                                                    Bước 1: Thông tin tài khoản và địa chỉ
                                                </a>
                                            </h2>
                                        </div>
                                        <div id="payment-address-content"
                                             class="panel-collapse collapse ">
                                            <div class="panel-body row">
                                                <div class="col-md-6 col-sm-6">
                                                    <h3>Thông tin chi tiết</h3>
                                                    <div class="form-group">
                                                        <label for="firstname">Họ <span class="require">*</span></label>
                                                        <input type="text" id="firstname" class="form-control"
                                                               name="firstname"
                                                               value="{{ !$customer == null ?$customer->first_name:old('firstname') }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="lastname">Tên <span class="require">*</span></label>
                                                        <input type="text" id="lastname" class="form-control"
                                                               name="lastname"
                                                               value="{{ !$customer == null ?$customer->last_name:old('lastname') }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Email <span class="require">*</span></label>
                                                        <input type="text" id="email" class="form-control" name="email"
                                                               value="{{  !$customer == null ?$user->email: auth()->user()->email }}"
                                                               readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="phone">Số điện thoại <span
                                                                class="require">*</span></label>
                                                        <input type="text" id="phone" class="form-control" name="phone"
                                                               value="{{ !$customer == null ?$customer->phone:old('phone') }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-sm-6">
                                                    <h3>Địa chỉ của bạn</h3>

                                                    <div class="form-group">
                                                        <label for="city">Tỉnh/Thành phố <span
                                                                class="require">*</span></label>
                                                        <select class="form-control" name="province_id">
                                                            <option value="">Chọn thành phố</option>
                                                            @foreach($provinces as $province)
                                                                <option
                                                                    value="{{ $province->id }}">{{ $province->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="district">Quận,Huyện <span
                                                                class="require">*</span></label>
                                                        <select class="form-control" name="district_id">

                                                            <option value="0">Chọn Quận Huyện</option>

                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="ward">Phường,Xã <span
                                                                class="require">*</span></label>
                                                        <select class="form-control" name="ward_id">
                                                            <option value="0">Chọn phường xã</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="address">Địa chỉ<span
                                                                class="require">*</span></label>
                                                        <input type="text" id="address" name="address"
                                                               class="form-control"
                                                               value="{{ !$customer == null?$customer->address:old('address') }}">
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="col-md-12">

                                                    <button class="btn btn-primary  pull-right" type="button"
                                                            data-toggle="collapse"
                                                            data-parent="#checkout-page"
                                                            data-target="#shipping-method-content"
                                                            id="button-payment-address">Tiếp tục
                                                    </button>
                                                    <div class="checkbox pull-right">
                                                        <label>
                                                            <input type="checkbox"> I have read and agree to the <a
                                                                title="Privacy Policy" href="{{ route('privacy-policy') }}">Privacy
                                                                Policy</a>
                                                            &nbsp;&nbsp;&nbsp;
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END PAYMENT ADDRESS -->


                                    <!-- BEGIN SHIPPING METHOD -->
                                    <div id="shipping-method" class="panel panel-default">
                                        <div class="panel-heading">
                                            <h2 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#checkout-page"
                                                   href="#shipping-method-content" class="accordion-toggle">
                                                    Bước 2: Phương thức thanh toán
                                                </a>
                                            </h2>
                                        </div>
                                        <div id="shipping-method-content" class="panel-collapse collapse">
                                            <div class="panel-body row">
                                                <div class="col-md-12">
                                                    <p>Hãy chọn phương thức thanh toán</p>
                                                    <h4>Chọn phương thức thanh toán</h4>
                                                    <div class="radio-list">
                                                        <label>
                                                            <input type="radio" name="payment_method"
                                                                   value="cod">
                                                            Ship cod
                                                        </label>
{{--                                                        <label>--}}
{{--                                                            <input type="radio" name="payment_method"--}}
{{--                                                                   value="online"--}}
{{--                                                                   onclick="return alert('Chức năng đang phát triển')">--}}
{{--                                                            Thanh toán online--}}
{{--                                                        </label>--}}
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="delivery-comments">Nội dung nhắn</label>
                                                        <textarea id="delivery-comments" rows="8"
                                                                  class="form-control" name="note"></textarea>
                                                    </div>
                                                    <button class="btn btn-primary  pull-right" type="button"
                                                            id="button-shipping-method" data-toggle="collapse"
                                                            data-parent="#checkout-page"
                                                            data-target="#confirm-content">
                                                        Tiếp tục
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END SHIPPING METHOD -->


                                    <!-- BEGIN CONFIRM -->
                                    <div id="confirm" class="panel panel-default">
                                        <div class="panel-heading">
                                            <h2 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#checkout-page"
                                                   href="#confirm-content"
                                                   class="accordion-toggle">
                                                    Bước 3: Xác nhận đặt hàng
                                                </a>
                                            </h2>
                                        </div>
                                        <div id="confirm-content" class="panel-collapse collapse">
                                            <div class="panel-body row">
                                                <div class="col-md-12 clearfix">
                                                    <div class="table-wrapper-responsive">
                                                        <table>
                                                            <tr>
                                                                <th class="checkout-image">Ảnh</th>
                                                                <th class="checkout-description">Tên sản phẩm</th>
                                                                <th class="checkout-quantity">Số lượng</th>
                                                                <th class="checkout-price">Giá</th>
                                                                <th class="checkout-total">Thành tiền</th>
                                                            </tr>
                                                            @foreach($cart as $item)
                                                                <tr>
                                                                    <td class="checkout-image">
                                                                        <a href="{{ route('item',['id'=>$item->id]) }}"><img
                                                                                src="{{ $item->options->image }}"
                                                                                alt="{{ $item->name }}"></a>
                                                                    </td>
                                                                    <td class="checkout-description">
                                                                        <h3>
                                                                            <a href="{{ route('item',['id'=>$item->id]) }}">{{ $item->name }}</a>
                                                                        </h3>

                                                                    </td>
                                                                    <td class="checkout-quantity">{{ $item->qty }}</td>
                                                                    <td class="checkout-price">
                                                                        <strong>{{ $item->price }}
                                                                            <span>VND</span></strong>
                                                                    </td>
                                                                    <td class="checkout-total">
                                                                        <strong>{{ $item->price*$item->qty }}
                                                                            <span>VND</span></strong>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </table>
                                                    </div>
                                                    <div class="checkout-total-block">
                                                        <ul>
                                                            <li>
                                                                <em>Tổng tiền</em>
                                                                <strong>{{ $item->price*$item->qty }}
                                                                    <span>VND</span></strong>
                                                            </li>
                                                            <li>
                                                                <em>Shipping cost</em>
                                                                <strong class="price">Miễn phí</strong>
                                                            </li>
{{--                                                            <li>--}}
{{--                                                                <em>Eco Tax (-2.00)</em>--}}
{{--                                                                <strong class="price"><span>$</span>3.00</strong>--}}
{{--                                                            </li>--}}
{{--                                                            <li>--}}
{{--                                                                <em>VAT (17.5%)</em>--}}
{{--                                                                <strong class="price"><span>$</span>3.00</strong>--}}
{{--                                                            </li>--}}
                                                            <li class="checkout-total-price">
                                                                <em>Total</em>
                                                                <strong>{{ Cart::total() }} <span>VND</span></strong>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <button class="btn btn-primary pull-right" type="submit"
                                                            id="button-confirm">
                                                        Xác nhận đơn hàng
                                                    </button>
                                                    <button type="button"
                                                            class="btn btn-default pull-right margin-right-20">
                                                        Hủy
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END CONFIRM -->
                                </form>

                            @endif

                        </div>
                        <!-- END CHECKOUT PAGE -->
                    </div>
                @else
                    <div class="col-md-12 col-sm-12" style="margin-bottom: 15px;margin-top: 15px">
                        <div class="text-center">
                            <h1>Bạn chưa đăng nhập, hãy đăng nhập để tiếp tục</h1>
                            <a href="{{ route('customer.login') }}" class="btn btn-primary">Đăng nhập</a>
                        </div>
                    </div>
            @endif
            <!-- END CONTENT -->
            </div>
            <!-- END SIDEBAR & CONTENT -->
        </div>
    </div>
@endsection
