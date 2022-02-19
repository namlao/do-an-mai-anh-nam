@extends('frontend.layouts.master')
@section('title','FAQ')

@section('css')

@endsection

@section('js')
    {{--    <script src="{{ asset('frontend/assets/plugins/rateit/src/jquery.rateit.js') }}" type="text/javascript"></script>--}}
    <script type="text/javascript">
        jQuery(document).ready(function () {
            // Layout.init();
            Layout.initOWL();
            Layout.initTwitter();
            Layout.initImageZoom();
            Layout.initTouchspin();
            Layout.initUniform();
            Layout.initSliderRange();
        });


    </script>
@endsection

@section('content')
    <div class="main">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ url('') }}">Home</a></li>
                <li><a href="{{ route('shop') }}">Cửa hàng</a></li>
                <li class="active">FAQ</li>
            </ul>
            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40">
            @include('frontend.partials.sidebar')

            <!-- BEGIN CONTENT -->
                <div class="col-md-9 col-sm-9">
                    <h1>Frequently Asked Questions</h1>
                    <div class="faq-page">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1"
                                       href="#accordion1_1">
                                        1. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ?
                                    </a>
                                </h4>
                            </div>
                            <div id="accordion1_1" class="panel-collapse collapse  in">
                                <div class="panel-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                                    richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor
                                    brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                    aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
                                    Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente
                                    ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
                                    farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them
                                    accusamus labore sustainable VHS.
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1"
                                       href="#accordion1_2">
                                        2. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ?
                                    </a>
                                </h4>
                            </div>
                            <div id="accordion1_2" class="panel-collapse collapse">
                                <div class="panel-body">
                                    Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua
                                    put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                                    richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor
                                    brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                    aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
                                    Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente
                                    ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
                                    farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them
                                    accusamus labore sustainable VHS.
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1"
                                       href="#accordion1_3">
                                        3. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor ?
                                    </a>
                                </h4>
                            </div>
                            <div id="accordion1_3" class="panel-collapse collapse">
                                <div class="panel-body">
                                    Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua
                                    put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry
                                    richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor
                                    brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt
                                    aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
                                    Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente
                                    ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
                                    farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them
                                    accusamus labore sustainable VHS.
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-warning">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1"
                                       href="#accordion1_4">
                                        4. Wolf moon officia aute, non cupidatat skateboard dolor brunch ?
                                    </a>
                                </h4>
                            </div>
                            <div id="accordion1_4" class="panel-collapse collapse">
                                <div class="panel-body">
                                    3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa
                                    nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it
                                    squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh
                                    helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad
                                    vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw
                                    denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore
                                    sustainable VHS.
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1"
                                       href="#accordion1_5">
                                        5. Leggings occaecat craft beer farm-to-table, raw denim aesthetic ?
                                    </a>
                                </h4>
                            </div>
                            <div id="accordion1_5" class="panel-collapse collapse">
                                <div class="panel-body">
                                    3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa
                                    nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it
                                    squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh
                                    helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad
                                    vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw
                                    denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore
                                    sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon
                                    tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda
                                    shoreditch et
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1"
                                       href="#accordion1_6">
                                        6. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth ?
                                    </a>
                                </h4>
                            </div>
                            <div id="accordion1_6" class="panel-collapse collapse">
                                <div class="panel-body">
                                    3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa
                                    nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it
                                    squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh
                                    helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad
                                    vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw
                                    denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore
                                    sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon
                                    tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda
                                    shoreditch et
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1"
                                       href="#accordion1_7">
                                        7. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft ?
                                    </a>
                                </h4>
                            </div>
                            <div id="accordion1_7" class="panel-collapse collapse">
                                <div class="panel-body">
                                    3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa
                                    nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it
                                    squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh
                                    helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad
                                    vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw
                                    denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore
                                    sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon
                                    tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda
                                    shoreditch et
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END CONTENT -->
            </div>
            <!-- END SIDEBAR & CONTENT -->
        </div>
    </div>

        @include('frontend.partials.brands')

@endsection
