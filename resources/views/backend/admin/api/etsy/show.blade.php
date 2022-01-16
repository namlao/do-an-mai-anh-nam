@extends('backend.layouts.master')
@section('title','Thêm sản phẩm vào etsy')
@section('css')
    /*
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css"/>*/
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>

    <style>
        button:focus {
            outline: none;
        }

        .img-product {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        /**/
    </style>
@endsection
@section('js')
    <script type="text/javascript" src="{{asset('/ckeditor/ckeditor.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript">
        var editor = CKEDITOR.replace('description', {
            language: 'vi',
            filebrowserImageBrowseUrl: '../../ckfinder/ckfinder.html?Type=Images',
            filebrowserFlashBrowseUrl: '../../ckfinder/ckfinder.html?Type=Flash',
            filebrowserImageUploadUrl: '../../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
            filebrowserFlashUploadUrl: '../../public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
        });
        $(".js-example-tokenizer").select2({
            placeholder: "Chọn tag",
            tags: true,
            tokenSeparators: [',', ' ']
        })

    </script>
@endsection
@section('content')
    @include('backend.partials.page-heading',['namepage'=>'Thêm sản phẩm vào etsy'])
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('etsy.postAdd',['id' => $product->id]) }}" method="post"
                              enctype="application/x-www-form-urlencoded">
                            @csrf

                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="nav-general_description-tab"
                                            data-bs-toggle="tab"
                                            data-bs-target="#general-description" type="button" role="tab"
                                            aria-controls="general-description" aria-selected="true">Mô tả chung
                                    </button>
                                    <button class="nav-link" id="nav-detail-payment-tab"
                                            data-bs-toggle="tab"
                                            data-bs-target="#detail-payment" type="button" role="tab"
                                            aria-controls="detail-payment" aria-selected="false">Payment
                                    </button>
                                    <button class="nav-link" id="nav-detail-shipping-tab"
                                            data-bs-toggle="tab"
                                            data-bs-target="#detail-shipping" type="button" role="tab"
                                            aria-controls="detail-shipping" aria-selected="false">Shipping
                                    </button>

                                </div>
                            </nav>
                            <div class="tab-content mt-3" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="general-description" role="tabpanel"
                                     aria-labelledby="nav-general_description-tab">
                                    <div class="form-group">
                                        <div class="text-center">
                                            <img width="150" src="{{ url($product->image_feature_path) }}"
                                                 class="img-thumbnail">
                                        </div>
                                        <label for="feature_image">Ảnh đại diện</label>
                                        <input type="file"
                                               class="form-control @error('feature_image') is-invalid @enderror"
                                               id="feature_image" name="feature_image" accept="image/*">
                                        @error('feature_image')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                    <div class="form-group">
                                        <label for="name">Tên sản phẩm</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               id="name" name="name"
                                               placeholder="Nhập tên sản phẩm"
                                               value="{{ $product->name }}"
                                               readonly
                                        >
                                        @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Giá</label>
                                        <input type="text" class="form-control @error('price') is-invalid @enderror"
                                               id="price" name="price"
                                               placeholder="Nhập giá sản phẩm"
                                               value="{{ $product->price }}" readonly
                                        >
                                        @error('price')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="text-center">
                                            <div class="row">
                                                @foreach($imgDetails as $imgDetail)
                                                    <div class="col-md-4">
                                                        <img src="{{ url($imgDetail->path) }}" class="img-product">
                                                    </div>
                                                @endforeach
                                            </div>

                                        </div>
                                        <label for="image">Hình ảnh chi tiết sản phẩm</label>
                                        <input type="file" name="image_detail[]" id="image" class="form-control"
                                               accept="image/*"
                                               multiple/>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Mô tả sản phẩm</label>
                                        <textarea name="description" id="description" cols="30" rows="10"
                                                  class="ckeditor @error('description') is-invalid @enderror" readonly>
                                                                            {{ $product->description }}

                                                                    </textarea>
                                        @error('description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="quantity">Số lượng</label>
                                                <input type="number"
                                                       class="form-control @error('quantity') is-invalid @enderror"
                                                       id="quantity" name="quantity"
                                                       placeholder="Nhập thông tin số lượng" readonly
                                                       value="{{ $product->quantity }}"
                                                >
                                                @error('quantity')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="weight">Khối lượng</label>
                                                <input type="text"
                                                       class="form-control @error('weight') is-invalid @enderror"
                                                       id="weight" name="weight"
                                                       placeholder="Nhập thông tin khối lượng"
                                                       value="{{ $product->attribute->weight }}" readonly
                                                >
                                                @error('weight')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="who_made">Năm sản xuất</label>
                                                <select name="when_made" id="when_made"
                                                        class="form-select @error('when_made') is-invalid @enderror"
                                                >
                                                    <option value="">Hãy chọn thời gian sản xuất</option>
                                                    <option value="2020_2022"
                                                            @if($product->when_made == '2020_2022') selected @endif>
                                                        2020-2022
                                                    </option>
                                                    <option value="2010_2019"
                                                            @if($product->when_made == '2010_2019') selected @endif>
                                                        2010-2019
                                                    </option>
                                                    <option value="2003_2009"
                                                            @if($product->when_made == '2003_2009') selected @endif>
                                                        2003-2009
                                                    </option>
                                                    <option value="before_2003"
                                                            @if($product->when_made == 'before_2003') selected @endif>
                                                        Trước 2003
                                                    </option>
                                                    <option value="2000_2002"
                                                            @if($product->when_made == '2000_2002') selected @endif>
                                                        2000-2002
                                                    </option>

                                                </select>
                                                @error('when_made')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="basicInput">Taxonomy</label>
                                                <select class="form-select" id="taxonomy_id" name="taxonomy_id"
                                                >
                                                    @foreach($taxonomies as $key => $value)
                                                        <option value="{{$key}}">{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="detail-payment" role="tabpanel"
                                     aria-labelledby="nav-detail-payment-tab">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="quantity">Tên người bán</label>
                                                <input type="text"
                                                       class="form-control @error('nameSeller') is-invalid @enderror"
                                                       id="nameSeller" name="nameSeller"
                                                       placeholder="Nhập tên người bán"
                                                       value="{{ old('nameSeller') }}"
                                                >
                                                @error('nameSeller')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="quantity">Địa chỉ 1(bắt buộc)</label>
                                                <input type="text"
                                                       class="form-control @error('first_line') is-invalid @enderror"
                                                       id="first_line" name="first_line"
                                                       placeholder="Nhập địa chỉ 1"
                                                       value="{{ old('first_line') }}" required
                                                >
                                                @error('first_line')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="quantity">Địa chỉ 2(tùy chọn)</label>
                                                <input type="text"
                                                       class="form-control @error('second_line') is-invalid @enderror"
                                                       id="second_line" name="second_line"
                                                       placeholder="Nhập địa chỉ 2"
                                                       value="{{ old('second_line') }}"
                                                >
                                                @error('second_line')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label for="quantity">Thành phố</label>
                                                <input type="text"
                                                       class="form-control @error('city') is-invalid @enderror"
                                                       id="city" name="city"
                                                       placeholder="Nhập thành phố"
                                                       value="{{ old('city') }}"
                                                >
                                                @error('city')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="state">Vùng</label>
                                                <input type="text"
                                                       class="form-control @error('state') is-invalid @enderror"
                                                       id="state" name="state"
                                                       placeholder="Nhập vùng"
                                                       value="{{ old('state') }}"
                                                >
                                                @error('state')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="state">Zipcode</label>
                                                <input type="text"
                                                       class="form-control @error('zip') is-invalid @enderror"
                                                       id="zip" name="zip"
                                                       placeholder="Nhập zipcode"
                                                       value="{{ old('zip') }}"
                                                >
                                                @error('zip')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="basicInput">Country</label>
                                                <select class="form-select" id="country_id" name="country_id"
                                                >
                                                    @foreach($countries as $value)
                                                        <option value="{{$value['country_id']}}">{{ $value['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="detail-shipping" role="tabpanel"
                                     aria-labelledby="nav-detail-shipping-tab">
                                    <div class="row">

                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Gửi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
