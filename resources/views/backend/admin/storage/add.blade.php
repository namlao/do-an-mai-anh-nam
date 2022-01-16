@extends('backend.layouts.master')
@section('title','Thêm sản phẩm')
@section('css')
    /*
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css"/>*/
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>

    <style>
        button:focus {
            outline: none;
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
            tokenSeparators: [',', ' ']
        })

        // $('.addRow').on('click', function () {
        //     addRow();
        // })
        //
        // function addRow() {
        //     var tr = '<tr>'+
        //             '<td>'+
        //                 '<input type="text" name="attributeName" class="form-control" placeholder="VD: Màu sắc" required>'+
        //             '</td>'+
        //             '<td>'+
        //                 '<input type="text" name="attributeKey" class="form-control" placeholder="VD: color" required>'+
        //             '</td>'+
        //             '<td>'+
        //                 '<input type="text" name="attributeValue" class="form-control" placeholder="VD: đỏ" required>'+
        //             '</td>'+
        //             '<td>'+
        //                 '<a href="#" class="btn btn-danger remove">-</a>'+
        //             '</td>'+
        //         '</tr>';
        //     $('tbody').append(tr);
        // }
        // $('tbody').on('click','.remove',function () {
        //     $(this).parent().parent().remove();
        // });
    </script>
@endsection
@section('content')
    @include('backend.partials.page-heading',['namepage'=>'Thêm sản phẩm'])

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
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
                                </div>
                            </nav>
                            <div class="tab-content mt-3" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="general-description" role="tabpanel"
                                     aria-labelledby="nav-general_description-tab">
                                    <div class="form-group">
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
                                               value="{{ old('name') }}">
                                        @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Giá</label>
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
                                        <input type="file" name="image_detail[]" id="image" class="form-control" accept="image/*"
                                               multiple/>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="category">Chuyên mục cha</label>
                                                <select class="form-select @error('category') is-invalid @enderror"
                                                        id="category" name="category">
                                                    <option value="">Chọn chuyện mục</option>
                                                    @foreach($categories as $category)
                                                        <option
                                                            value="{{ $category->id }}"
                                                            @if(old('category') == $category->id) selected @endif>{{ $category->name }}</option>
                                                    @endforeach

                                                </select>
                                                @error('category')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="basicInput">Tags</label>
                                                <select class="form-select js-example-tokenizer" id="tag" name="tags[]"
                                                        multiple>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Mô tả sản phẩm</label>
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
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="cpu">CPU</label>
                                                <input type="text" class="form-control @error('cpu') is-invalid @enderror"
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
                                                <input type="text" class="form-control @error('ram') is-invalid @enderror"
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
                                                <input type="text" class="form-control @error('hard_drive') is-invalid @enderror"
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
                                                <select name="os" id="os" class="form-select @error('os') is-invalid @enderror">
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
                                                <label for="weight">Khối lượng</label>
                                                <input type="text" class="form-control @error('weight') is-invalid @enderror"
                                                       id="weight" name="weight"
                                                       placeholder="Nhập thông tin khối lượng"
                                                       value="{{ old('weight') }}"
                                                >
                                                @error('weight')
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
