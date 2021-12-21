@extends('backend.layouts.master')
@section('title','Danh sách vai trò')
@section('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/simple-datatables/style.css') }}">
    <style>
        .text-right{
            text-align: end;
        }
    </style>
@endsection
@section('js')


    <script src="{{ asset('backend/assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script>
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);

    </script>
@endsection
@section('content')
    @include('backend.partials.page-heading',['namepage'=>'Danh sách chuyên mục'])

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mb-2 text-right">
                        <a href="{{ route('role.create') }}" class="btn btn-primary">Thêm vai trò</a>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered" id="table1">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên vai trò</th>
                                <th>Description</th>
                                <th>Quyền</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $role)
                                <tr>

                                    <td>{{$role->id}}</td>
                                    <td>{{$role->display_name}}</td>
                                    <td>{{$role->description}}</td>
                                    <td>
                                        @foreach($role->getPermissionNames() as $value)
                                            {{ '-'.$value }}<br>
                                        @endforeach
                                    </td>


                                    <td>
                                        <a href="{{ route('role.edit',['role'=>$role->id]) }}" class="btn btn-primary">Sửa</a>
                                        <form action="{{ route('role.destroy',['role'=>$role->id]) }}" method="POST" class="delete-form">
                                            @csrf
                                            {{ @method_field('DELETE') }}
                                            <button class="btn btn-danger">Xóa</button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
