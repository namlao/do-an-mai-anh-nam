@extends('backend.layouts.master')
@section('title','Sửa thành viên')
@section('css')
    <!-- Filepond stylesheet -->
    <!-- <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">

    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
          rel="stylesheet"> -->
@endsection
@section('js')

    {{--    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>--}}
    {{--    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>--}}
    {{--    <script>--}}
    {{--        // register desired plugins...--}}
    {{--        FilePond.registerPlugin(--}}
    {{--            FilePondPluginImagePreview,--}}
    {{--        );--}}

    {{--        const inputElement = document.querySelector('input[id="avatar"]');--}}
    {{--        const pond = FilePond.create( inputElement );--}}
    {{--        FilePond.setOptions({--}}
    {{--            server:{--}}
    {{--                url: '/images/',--}}
    {{--                headers: {--}}
    {{--                    'X-CSRF-TOKEN': '{{ csrf_token() }}'--}}
    {{--                }--}}
    {{--            }--}}

    {{--        });--}}
    {{--    </script>--}}

    <script>
        $('#changePasssword').click(function() {
            if ($(this).is(':checked')) {
                $('#password').removeAttr('readonly');
            } else {
                $('#password').prop('readonly', true);

            }
        });

    </script>
@endsection
@section('content')
    @include('backend.partials.page-heading',['namepage'=>'Sửa thành viên'])

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('user.update',['user'=>$user->id]) }}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <div style="text-align: center">
                                    <img width="150" height="200" style="object-fit: cover"
                                         src="{{ url('').'/'.$user->avatar }}" alt="">
                                </div>
                                <label for="basicInput">Avatar</label>
                                <input type="file" class="form-control" id="avatar" name="avatar"
                                >
                                {{--                                <input type="file" class="image-preview-filepond"  name="avatar" id="avatar">--}}

                            </div>
                            <div class="form-group">
                                <label for="basicInput">Tên thành viên</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       placeholder="Nhập tên thành viên" value="{{ $user->name }}">
                            </div>
                            <div class="form-group">
                                <label for="basicInput">Email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                       placeholder="Nhập email thành viên" disabled value="{{ $user->email }}">
                            </div>
                            <div class="form-group">
                                <label for="basicInput">Password</label>
                                <input type="checkbox" name="changePassword" id="changePasssword" > <span>Sửa mật khẩu</span>
                                <input type="password" class="form-control" id="password" name="password"
                                       placeholder="Nhập password" readonly>
                            </div>
                            <div class="form-group">
                                <label for="basicInput">Quyền thành viên</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option>Chọn quyền</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="basicInput">Tình trạng</label>
                                @if(!is_null($user->email_verified_at))
                                    <span class="badge rounded-pill bg-success">Đã xác thực</span>
                                @else
                                    <span class="badge rounded-pill bg-danger">Chưa xác thực</span>
                                @endif
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
