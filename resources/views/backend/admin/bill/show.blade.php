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
    @include('backend.partials.page-heading',['namepage'=>'Chi tiết hóa đơn'])

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
       <div class="card">
           <div class="card-body">
               <div class="box">
                   <div class="box-header with-border">
                       <div class="row">
                           <div class="col-md-12">
                               <div class="container123  col-md-12"   style="">
                                   <h4></h4>
                                   <table class="table table-bordered">
                                       <thead>
                                       <tr>
                                           <th class="col-md-4">Thông tin khách hàng</th>
                                           <th class="col-md-6"></th>
                                       </tr>
                                       </thead>
                                       <tbody>
                                       <tr>
                                           <td>Thông tin người đặt hàng</td>
                                           <td>{{ $customerInfo->first_name .' '.$customerInfo->last_name }}</td>
                                       </tr>
                                       <tr>
                                           <td>Ngày đặt hàng</td>
                                           <td>{{ $customerInfo->created_at }}</td>
                                       </tr>
                                       <tr>
                                           <td>Số điện thoại</td>
                                           <td>{{ $customerInfo->phone }}</td>
                                       </tr>
                                       <tr>
                                           <td>Địa chỉ</td>
                                           <td>{{ $customerInfo->address .'-'.$customerInfo->ward.'-'.$customerInfo->district.'-'.$customerInfo->city }}</td>
                                       </tr>
                                       <tr>
                                           <td>Email</td>
                                           <td>{{ $customerInfo->email }}</td>
                                       </tr>
                                       <tr>
                                           <td>Ghi chú</td>
                                           <td>{{ $customerInfo->bill_note }}</td>
                                       </tr>
                                       </tbody>
                                   </table>
                               </div>
                               <table id="myTable" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                   <thead>
                                   <tr role="row">
                                       <th class="sorting col-md-1" >STT</th>
                                       <th class="sorting_asc col-md-4">Tên sản phẩm</th>
                                       <th class="sorting col-md-2">Số lượng</th>
                                       <th class="sorting col-md-2">Giá tiền</th>
                                   </thead>
                                   <tbody>
                                   @foreach($billInfo as $key => $bill)
                                       <tr>
                                           <td>{{ $key+1 }}</td>
                                           <td>{{ $bill->product_name }}</td>
                                           <td>{{ $bill->quantily }}</td>
                                           <td>{{ number_format($bill->price) }} VNĐ</td>
                                       </tr>
                                   @endforeach
                                   <tr>
                                       <td colspan="3"><b>Tổng tiền</b></td>
                                       <td colspan="1"><b class="text-red">{{ number_format($customerInfo->bill_total) }} VNĐ</b></td>
                                   </tr>
                                   </tbody>
                               </table>
                           </div>
                       </div>
                       <div class="col-md-12">
                           <form action="{{ route('status',['id'=>$bill->bill_id]) }}" method="POST">
                               @csrf
                               <div class="col-md-8"></div>
                               <div class="col-md-4">
                                   <div class="form-inline">
                                       <label>Trạng thái giao hàng: </label>
                                       <select name="status" class="form-control input-inline" style="width: 200px">
                                           <option value="Chưa xử lý" @if(\App\Models\Bill::find($bill->bill_id)->status === 'Chưa xử lý') selected  @endif>Chưa xử lý</option>
                                           <option value="Đang xử lý" @if(\App\Models\Bill::find($bill->bill_id)->status === 'Đang xử lý') selected  @endif>Đang xử lý</option>
                                           <option value="Đã xử lý" @if(\App\Models\Bill::find($bill->bill_id)->status === 'Đã xử lý') selected  @endif>Đã xử lý</option>
                                       </select>

                                       <input type="submit" value="Xử lý" class="btn btn-primary">
                                   </div>
                               </div>
                           </form>
                       </div>
                   </div>
               </div>
           </div>
       </div>
    </section>
@endsection
