@extends('frontend.layouts.master')
@section('title','Địa chỉ')

@section('css')


@endsection

@section('js')
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"
            type="text/javascript"></script><!-- for slider-range -->
    <script>
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
                <li><a href="{{ route('shop') }}">Store</a></li>
                <li class="active">Địa chỉ</li>
            </ul>
            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40">
            @include('frontend.partials.sidebar-account')

            <!-- BEGIN CONTENT -->
                <div class="col-md-9 col-sm-7">
                    <h1>Địa chỉ</h1>
                    <div class="content-page">
                        <form method="post" >
                            @csrf
                            <div class="form-group">
                                <label for="address">Địa chỉ<span
                                        class="require">*</span></label>
                                <input type="text" id="address" name="address"
                                       class="form-control"
                                       value="{{ !$customer == null?$customer->address:old('address') }}">
                            </div>
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
                            <button type="submit" class="btn btn-primary">Xác nhận</button>
                        </form>
                    </div>
                </div>
                <!-- END CONTENT -->
            </div>
            <!-- END SIDEBAR & CONTENT -->
        </div>
    </div>
    @include('frontend.partials.brands')
@endsection
