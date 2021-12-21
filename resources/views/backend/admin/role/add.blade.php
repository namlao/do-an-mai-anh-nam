@extends('backend.layouts.master')
@section('title','Thêm vai trò')

@section('css')
    <style>

        .check-all {
            display: inline-block;
            margin-left: 10px;
        }
    </style>
@endsection

@section('js')
    <script>
        // $(function () {
        //     $('.checkbox-all').on('click', function () {
        //         $(this).parents().find('.option-permission').prop('selected', $(this).prop('selected'))
        //     })
        //
        // })


    </script>
@endsection
@section('content')
    @include('backend.partials.page-heading',['namepage'=>'Thêm vai trò'])

    <div class="container-fluid">
        <form action="{{ route('role.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="basicInput">Tên hiển thị</label>
                                <input type="text" class="form-control @error('display_name') is-invalid @enderror"
                                       id="name" name="display_name"
                                       placeholder="" value="{{ old('display_name') }}">
                                @error('display_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="basicInput">Mô tả</label>
                                <textarea name="description" id="description"
                                          class="form-control @error('description') is-invalid @enderror" cols="30"
                                          rows="5" style="resize: none">{{ old('description') }}</textarea>
                                @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title pl-1" style="display: inline-block">Chọn phân quyền</h1>
{{--                            <div class="check-all">--}}
{{--                                <input class="form-check-input checkbox-all" type="checkbox"--}}
{{--                                       value="" id="checkboxAll">--}}
{{--                                <label class="form-check-label">--}}
{{--                                    Check all--}}
{{--                                </label>--}}
{{--                            </div>--}}
                        </div>
                        <div class="card-body">
                            <select class="form-select form-permission" size="10" aria-label="size 10 select example" name="permission[]"
{{--                                    style="height: 250px"--}}
                                    multiple>
                                @foreach($permissions as $permission)

                                    <option value="{{$permission->name}}" class="option-permission" style="text-transform: capitalize;padding: 0.7rem 1.2rem">{{$permission->display_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Gửi</button>
                    </div>

                </div>
            </div>
        </form>


    </div>
@endsection
