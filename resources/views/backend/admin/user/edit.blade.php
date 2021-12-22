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
        $('#changePasssword').click(function () {
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
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                       name="name"
                                       placeholder="Nhập tên thành viên">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="basicInput">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                       name="email"
                                       placeholder="Nhập email thành viên">
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="basicInput">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                       id="password" name="password"
                                       placeholder="Nhập password">
                                @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="basicInput">Quyền thành viên</label>
                                <select class="form-select" aria-label="Default select example" name="role">
                                    <option>Chọn quyền</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}"
                                                @if($user->hasRole($role->name)) selected @endif>{{ $role->display_name }}</option>
                                    @endforeach
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
