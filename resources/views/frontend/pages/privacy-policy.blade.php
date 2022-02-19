@extends('frontend.layouts.master')
@section('title','Privacy Policy')

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
                <li class="active">Privacy Policy</li>
            </ul>
            <!-- BEGIN SIDEBAR & CONTENT -->
            <div class="row margin-bottom-40">
            @include('frontend.partials.sidebar')

            <!-- BEGIN CONTENT -->
                <div class="col-md-9 col-sm-9">
                    <h1>Privacy Policy</h1>
                    <div class="content-page">
                        <h2>How we use your information</h2>

                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod
                            tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis
                            nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.
                            Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel
                            illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui
                            blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam
                            liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim
                            placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis
                            qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii
                            legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium
                            lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram,
                            anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem
                            modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.</p>

                        <h2>Use and storage of data</h2>

                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod
                            tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis
                            nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo
                            consequat.</p>

                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod
                            tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis
                            nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.
                            Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel
                            illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui
                            blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam
                            liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim
                            placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis
                            qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii
                            legunt saepius. </p>

                        <h3>Investigationes demonstraverunt</h3>
                        <ul>
                            <li>Lorem ipsum dolor sit amet</li>
                            <li>Claritas est etiam processus dynamicus</li>
                            <li>Duis autem vel eum iriure dolor</li>
                            <li>Eodem modo typi</li>
                        </ul>

                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod
                            tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis
                            nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.
                            Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel
                            illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui
                            blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam
                            liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim
                            placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis
                            qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii
                            legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium
                            lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram,
                            anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem
                            modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.</p>

                        <p>Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim
                            placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis
                            qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii
                            legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium
                            lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram,
                            anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem
                            modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.</p>
                    </div>
                </div>
                <!-- END CONTENT -->
            </div>
            <!-- END SIDEBAR & CONTENT -->
        </div>
    </div>
    @include('frontend.partials.brands')
@endsection
