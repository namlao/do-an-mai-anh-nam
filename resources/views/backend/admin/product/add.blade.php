@extends('backend.layouts.master')
@section('title','Thêm sản phẩm')
@section('css')

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>

    <style>
        button:focus {
            outline: none;
        }
        .product-require{
            color: red;
        }
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
            tokenSeparators: [',']
        })

        $(".js-brands").select2({
            placeholder: "Chọn thương hiệu",
        })
        // $('#delivery').on('change',function (value) {
        //
        //     $('.toast').toast('show');
        //     value = $(this).val();
        //     if(value === 'yes'){
        //         $('.content-delivery').append(document.createTextNode("Được giao hàng bởi người bán"));
        //         // alert('cscscs')
        //     }else{
        //         $('.content-delivery').append(document.createTextNode("Được giao hàng bởi lazada"));
        //     }
        //
        // })

    </script>
@endsection
@section('content')
    @include('backend.partials.page-heading',['namepage'=>'Thêm sản phẩm'])

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        @if(session('message'))
                            <div class="alert alert-danger">

                                <p>{{ session('message') }}</p>
                            </div>
                        @endif

                    </div>
                    <div class="col-md-12">
                        <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="nav-general_description-tab"
                                            data-bs-toggle="tab"
                                            data-bs-target="#general-description" type="button" role="tab"
                                            aria-controls="general-description" aria-selected="true">Mô tả chung
                                    </button>
                                    <button class="nav-link" id="nav-detail-description-tab"
                                            data-bs-toggle="tab"
                                            data-bs-target="#detail-description" type="button" role="tab"
                                            aria-controls="detail-description" aria-selected="false">Mô tả chi tiết
                                    </button>
                                    <button class="nav-link" id="nav-delivery-warranty-tab"
                                            data-bs-toggle="tab"
                                            data-bs-target="#delivery-warranty" type="button" role="tab"
                                            aria-controls="delivery-warranty" aria-selected="false">Vận chuyển và bảo
                                        hành
                                    </button>

                                </div>
                            </nav>
                            <div class="tab-content mt-3" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="general-description" role="tabpanel"
                                     aria-labelledby="nav-general_description-tab">
                                    <div><p>(<span class="product-require">*</span>) Bắt buộc</p></div>
                                    <div class="form-group">
                                        <label for="feature_image">Ảnh đại diện<span class="product-require">*</span></label>
                                        <input type="file"
                                               class="form-control @error('feature_image') is-invalid @enderror"
                                               id="feature_image" name="feature_image" accept="image/*">
                                        @error('feature_image')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Tên sản phẩm<span class="product-require">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               id="name" name="name"
                                               placeholder="Nhập tên sản phẩm"
                                               value="{{ old('name') }}">
                                        @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Giá<span class="product-require">*</span></label>
                                        <input type="text" class="form-control @error('price') is-invalid @enderror"
                                               id="price" name="price"
                                               placeholder="Nhập giá sản phẩm"
                                               value="{{ old('price') }}"
                                        >
                                        @error('price')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Hình ảnh chi tiết sản phẩm</label>
                                        <input type="file" name="image_detail[]" id="image" class="form-control"
                                               accept="image/*"
                                               multiple/>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="category">Chuyên mục<span class="product-require">*</span></label>
                                                <select class="form-select @error('category') is-invalid @enderror"
                                                        id="category" name="category">
                                                    <option value="">Chọn chuyện mục</option>
{{--                                                    @foreach($categories as $category)--}}
{{--                                                        <option--}}
{{--                                                            value="{{ $category->id }}"--}}
{{--                                                            @if(old('category') == $category->id) selected @endif>{{ $category->name }}</option>--}}
{{--                                                    @endforeach--}}
                                                    {{ \App\Helpers\RecursiveCategory::showAddProductCategories($categories) }}

                                                </select>
                                                @error('category')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
{{--                                        <div class="col-md-6">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label for="basicInput">Tags</label>--}}
{{--                                                <select class="form-select js-example-tokenizer" id="tag" name="tags[]"--}}
{{--                                                        multiple>--}}
{{--                                                    @foreach($tags as $tag)--}}
{{--                                                        <option value="{{ $tag->slug }}">{{ $tag->name }}</option>--}}
{{--                                                    @endforeach--}}
{{--                                                </select>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="basicInput">Thương hiệu<span class="product-require">*</span></label>
                                                <select class="form-select js-brands" id="brand" name="brand"
                                                >
                                                    <option value=""></option>

                                                    @foreach($brands as $brand)
                                                        <option
                                                            value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Mô tả ngắn sản phẩm<span class="product-require">*</span></label>
                                        <textarea class="form-control @error('short_description') is-invalid @enderror"
                                                  name="short_description" id="short_description"
                                                  id="exampleFormControlTextarea1"
                                                  rows="3">{{ old('short_description') }}</textarea>
                                    </div>
                                    @error('short_description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    <div class="form-group">
                                        <label for="description">Mô tả sản phẩm<span class="product-require">*</span></label>
                                        <textarea name="description" id="description" cols="30" rows="10"
                                                  class="ckeditor @error('description') is-invalid @enderror">
                                                {{ old('description') }}

                                        </textarea>
                                        @error('description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                    </div>

                                </div>
                                <div class="tab-pane fade" id="detail-description" role="tabpanel"
                                     aria-labelledby="nav-detail-description-tab">
                                    <div><p>(<span class="product-require">*</span>) Bắt buộc</p></div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="cpu">CPU</label>
                                                <input type="text"
                                                       class="form-control @error('cpu') is-invalid @enderror"
                                                       id="cpu" name="cpu"
                                                       placeholder="Nhập thông tin CPU"
                                                       value="{{ old('cpu') }}"
                                                >
                                                @error('cpu')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="ram">RAM</label>
                                                <input type="text"
                                                       class="form-control @error('ram') is-invalid @enderror"
                                                       id="ram" name="ram"
                                                       placeholder="Nhập thông tin Ram"
                                                       value="{{ old('ram') }}"
                                                >
                                                @error('ram')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="hard_drive">Ổ cứng</label>
                                                <input type="text"
                                                       class="form-control @error('hard_drive') is-invalid @enderror"
                                                       id="hard_drive" name="hard_drive"
                                                       placeholder="Nhập thông tin ổ cứng"
                                                       value="{{ old('hard_drive') }}"
                                                >
                                                @error('hard_drive')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="screen">Màn hình</label>
                                                <input type="text" class="form-control"
                                                       id="screen" name="screen"
                                                       placeholder="Nhập thông tin Màn hình"
                                                       value="{{ old('screen') }}"
                                                >
                                            </div>
                                            <div class="form-group">
                                                <label for="graphic_card">Card đồ họa</label>
                                                <input type="text" class="form-control"
                                                       id="graphic_card" name="graphic_card"
                                                       placeholder="Nhập thông tin card đồ họa"
                                                       value="{{ old('graphic_card') }}"
                                                >
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="connect_port">Cổng kết nối</label>
                                                <input type="text" class="form-control"
                                                       id="connect_port" name="connect_port"
                                                       placeholder="Nhập thông tin cổng kết nối"
                                                       value="{{ old('connect_port') }}"
                                                >
                                            </div>
                                            <div class="form-group">
                                                <label for="special">Tính năng khác</label>
                                                <input type="text" class="form-control"
                                                       id="special" name="special"
                                                       placeholder="Nhập thông tin tính năng khác"
                                                       value="{{ old('special') }}"
                                                >
                                            </div>
                                            <div class="form-group">
                                                <label for="os">Hệ điều hành</label>
                                                <select name="os" id="os"
                                                        class="form-select @error('os') is-invalid @enderror">
                                                    <option value="">Hãy chọn hệ điều hành</option>
                                                    <option value="MacOs">Mac OS</option>
                                                    <option value="Windows">Windown</option>
                                                    <option value="Ubuntu">Ubuntu</option>
                                                </select>
                                                @error('os')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="design">Thiết kế</label>
                                                <input type="text" class="form-control"
                                                       id="design" name="design"
                                                       placeholder="Nhập thông tin thiết kế"
                                                       value="{{ old('design') }}"
                                                >
                                            </div>
                                            <div class="form-group">
                                                <label for="weight">Khối lượng(kg)<span class="product-require">*</span></label>
                                                <input type="text"
                                                       class="form-control @error('weight') is-invalid @enderror"
                                                       id="weight" name="weight"
                                                       placeholder="Nhập thông tin khối lượng"
                                                       value="{{ old('weight') }}"
                                                >
                                                @error('weight')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="quantity">Số lượng<span class="product-require">*</span></label>
                                                <input type="number"
                                                       class="form-control @error('quantity') is-invalid @enderror"
                                                       id="quantity" name="quantity"
                                                       placeholder="Nhập thông tin số lượng"
                                                       value="{{ old('quantity') }}"
                                                >
                                                @error('quantity')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="quantity">Chiều dài(cm)<span class="product-require">*</span></label>
                                                <input type="number"
                                                       class="form-control @error('length') is-invalid @enderror"
                                                       id="length" name="length"
                                                       placeholder="Nhập thông tin chiều dài (cm)"
                                                       value="{{ old('length') }}"
                                                >
                                                @error('length')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="quantity">Chiều cao(cm)<span class="product-require">*</span></label>
                                                <input type="number"
                                                       class="form-control @error('height') is-invalid @enderror"
                                                       id="height" name="height"
                                                       placeholder="Nhập thông tin chiều cao"
                                                       value="{{ old('height') }}"
                                                >
                                                @error('height')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="quantity">Chiều rộng(cm)<span class="product-require">*</span></label>
                                                <input type="number"
                                                       class="form-control @error('width') is-invalid @enderror"
                                                       id="width" name="width"
                                                       placeholder="Nhập thông tin chiều rộng (cm)"
                                                       value="{{ old('width') }}"
                                                >
                                                @error('width')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="delivery-warranty" role="tabpanel"
                                     aria-labelledby="nav-delivery-warranty-tab">
                                    <div><p>(<span class="product-require">*</span>) Bắt buộc</p></div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="delivery">Vận chuyện<span class="product-require">*</span></label>
                                                <select class="form-control @error('delivery') is-invalid @enderror" id="delivery" name="delivery" required>
                                                    <option value="0">Không</option>
                                                    {{--                                                    <option value="1">Có</option>--}}
                                                </select>
                                                <div class="form-text">Chọn "Không" nếu vận chuyển bởi lazada</div>
                                                @error('delivery')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
{{--                                                <div class="form-text">Chọn "Có" nếu vận chuyển bởi người bán hàng</div>--}}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="warranty_type">Bảo hành<span class="product-require">*</span></label>
                                                <select class="form-control @error('warranty') is-invalid @enderror" id="warranty_type" name="warranty" required>
                                                    <option value="">Lựa chọn phương thức bảo hành</option>
                                                    <option value="No Warranty">Không bảo hành</option>
                                                    <option value="Invoice">Bảo hành bằng hóa đơn</option>
                                                    <option value="Warranty Stamp">Tem bảo hành</option>
                                                    <option value="Electronic Warranty">Bảo hành điện tử</option>
                                                </select>
                                                @error('warranty')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
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
