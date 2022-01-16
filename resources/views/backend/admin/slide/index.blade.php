@extends('backend.layouts.master')
@section('title','Danh sách slide')
@section('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/simple-datatables/style.css') }}">
    <style>
        .badge-success {
            color: #fff;
            background-color: #28a745;
        }

        .badge-danger {
            color: #fff;
            background-color: #dc3545;
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
    @include('backend.partials.page-heading',['namepage'=>'Danh sách slider'])

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered" id="table1">
                            <thead>
                            <tr>
                                <th width="50">#</th>
                                <th>Ảnh</th>
                                <th>Title</th>
                                <th>Mô tả ngắn</th>
                                <th width="100">Hiển thị</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($slides as $key => $slide)
                                <tr>
                                    <td>{{ $key }}</td>
                                    <td>
                                        <img width="150" src="{{ url($slide->img_slide_path) }}" alt="">
                                    </td>
                                    <td>{{$slide->title}}</td>
                                    <td style="word-break: break-word">{{$slide->description}}</td>
                                    <td>
                                        @if($slide->display === 0)
                                            <span class="badge badge-danger">Off</span>
                                        @else
                                            <span class="badge badge-success">On</span>
                                        @endif
                                    </td>

                                    <td>
                                        @can('slide edit')
                                            <a href="{{ route('slider.edit',['slider'=>$slide->id]) }}"
                                               class="btn btn-primary"><i class="fas fa-wrench"></i></a>
                                        @endcan
                                        @can('slide delete')
                                            <form action="{{ route('slider.destroy',['slider'=>$slide->id]) }}"
                                                  method="POST" class="delete-form">
                                                @csrf
                                                {{ @method_field('DELETE') }}
                                                <button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        @endcan
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
