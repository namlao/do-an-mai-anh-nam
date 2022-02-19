@extends('backend.layouts.master')
@section('title','Danh sách bình luận')
@section('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/simple-datatables/style.css') }}">
    <style>

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
    @include('backend.partials.page-heading',['namepage'=>'Danh sách bình luận'])

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered" id="table1">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Người dùng</th>
                                <th>Email</th>
                                <th>Nội dung</th>
                                <th>Sản phẩm</th>
                                <th>Ngày bình luận</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($comments as $key=> $comment)
                                    <tr>
                                        <td>{{ $key }}</td>
                                        <td>{{ $comment->name }}</td>
                                        <td>{{ $comment->email }}</td>
                                        <td>{{ $comment->comment }}</td>
                                        <td>{{ \App\Models\Product::find($comment->product_id)->name }}</td>
                                        <td>{{ $comment->created_at }}</td>

                                        <td>
                                            <form action="{{ route('comment.destroy',['comment'=>$comment->id]) }}"
                                                  method="POST" class="delete-form">
                                                @csrf
                                                {{ @method_field('DELETE') }}
                                                <button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
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
