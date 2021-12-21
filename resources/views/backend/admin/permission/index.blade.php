@extends('backend.layouts.master')
@section('title','Thêm phân quyền')

@section('css')
    <style>
        .card-header {
            border-bottom: 1px solid #7c8db51a !important;
        }

        .card .card-body {
            padding: 1.5rem 2.5rem;
        }
        .check-all{
            display: inline-block;
            margin-left: 10px;
        }
    </style>
@endsection

@section('js')
    <script>
        $(function () {
            $('.checkbox-all').on('click',function () {
                $(this).parents('.card').find('.checkbox-child').prop('checked',$(this).prop('checked'))
            })

            $('.checkAll').on('click',function (){
                $(this).parents().find('.checkbox-child').prop('checked',$(this).prop('checked'))
                $(this).parents().find('.checkbox-all').prop('checked',$(this).prop('checked'))
            })
        })


    </script>
@endsection

@section('content')
    <form action="{{ route('permission.add') }}" method="post">
        @csrf
        <div class="col-md-12">
            <div class="form-check">
                <input class="form-check-input checkAll" type="checkbox"
                       value="" id="checkAll">
                <label class="form-check-label">
                    Check all
                </label>
            </div>
        </div>
        @foreach($display_names as $keyRole => $display_name)
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title pl-1" style="display: inline-block">Module {{ $display_name }}</h1>
                        <div class="check-all">
                            <input class="form-check-input checkbox-all" type="checkbox"
                                   value="" id="checkboxAll">
                            <label class="form-check-label">
                                Check all
                            </label>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                @foreach($actions as $keyAction => $action)
                                    <div class="form-check form-check-inline col">
                                        <input class="form-check-input checkbox-child" name="permission[]" type="checkbox"
                                               value="{{ $keyRole.' '.$keyAction }}" id="defaultCheck">
                                        <label class="form-check-label" >
                                            {{ $action }}
                                        </label>
                                    </div>

                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @endforeach
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">Gửi</button>
        </div>
    </form>


@endsection
