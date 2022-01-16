@extends('backend.layouts.master')
@section('title','Danh sách Hóa đơn')
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
    @include('backend.partials.page-heading',['namepage'=>'Danh sách Hóa đơn'])

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    {{--                    <div class="col-md-12">--}}
                    {{--                        <a href="{{ route('category.create') }}" class="btn btn-primary">Thêm</a>--}}
                    {{--                    </div>--}}
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered" id="table1">
                            <thead>
                            <tr>
                                <th width="50">#</th>
                                <th width="100">Họ tên</th>
                                <th>Đia chỉ</th>
                                <th>Email</th>
                                <th width="150">Trạng thái</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($bills as $key=> $bill)
                                <tr>
                                    <td>{{ $key }}</td>
                                    <td>{{ $bill->customer->first_name .' '. $bill->customer->last_name}}</td>
                                    <td>{{ $bill->customer->address.'-'.$bill->customer->ward.'-'.$bill->customer->district.'-'.$bill->customer->city }}</td>
                                    <td>{{ \App\Models\User::find($bill->customer->user_id)->email }}</td>
                                    <td>{{$bill->status}}</td>
                                    <td>
                                        <a href="{{ route('bill.show',['bill'=>$bill->id]) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>

                                        <form action="{{ route('bill.destroy',['bill'=>$bill->id])}}"
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
