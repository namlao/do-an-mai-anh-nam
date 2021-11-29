@extends('backend.layouts.master')
@section('title','Danh sách setting')
@section('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/simple-datatables/style.css') }}">

@endsection
@section('js')


    <script src="{{ asset('backend/assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script>
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);

    </script>
@endsection
@section('content')
    @include('backend.partials.page-heading',['namepage'=>'Danh sách setting'])

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered" id="table1">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên cấu hình</th>
                                <th>Key cấu hình</th>
                                <th>Giá trị</th>
                                <th>Type</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($settings as $key => $setting)
                                <tr>
                                    <td>{{ $key }}</td>
                                    <td>{{$setting->config_name}}</td>
                                    <td>{{$setting->config_key}}</td>
                                    <td style="word-break: break-word">
                                        @if($setting->type === 'image')
                                            <img width="150" src="{{ url($setting->config_value) }}" alt="">
                                        @else
                                            {{$setting->config_value}}
                                        @endif
                                    </td>
                                    <td>{{$setting->type}}</td>
                                    <td>
                                        <a href="{{ route('setting.edit',['setting'=>$setting->id]).'?type='.$setting->type  }}"
                                           class="btn btn-primary">Sửa</a>
                                        <form action="{{ route('setting.destroy',['setting'=>$setting->id]) }}"
                                              method="POST" class="delete-form">
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
