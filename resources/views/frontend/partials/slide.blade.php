<!-- BEGIN SLIDER -->
<div class="page-slider margin-bottom-35">
    <div id="carousel-example-generic" class="carousel slide carousel-slider">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            @for($i = 0;$i < $slides->count();$i++)
            <li data-target="#carousel-example-generic" data-slide-to="{{$i}}" class="@if(!$i) active @endif"></li>
            @endfor
        </ol>
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <!-- First slide -->
           @foreach($slides as $key => $value)
                <div class="item @if(!$key) active @endif" style="background: #bebebe url('{{str_replace('\\','/',$value->img_slide_path) }}') no-repeat;background-size: cover;background-position: center center; ">
                <div class="container">
                    <div class="carousel-position-four text-left">
                        <div class="row">
                            <div class="col-md-6">
                                <h2 class="margin-bottom-20 animate-delay carousel-title-v3 border-bottom-title text-uppercase" data-animation="animated fadeInDown">
                                    {{--                            Tones of <br/><span class="color-red-v2">Shop UI Features</span><br/> designed--}}
                                    {{ $value->title }}
                                </h2>
                                <p class="carousel-subtitle-v2" data-animation="animated fadeInUp">
                                    {{ $value->description }}</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Controls -->
        <a class="left carousel-control carousel-control-shop" href="#carousel-example-generic" role="button" data-slide="prev">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
        </a>
        <a class="right carousel-control carousel-control-shop" href="#carousel-example-generic" role="button" data-slide="next">
            <i class="fa fa-angle-right" aria-hidden="true"></i>
        </a>
    </div>
</div>
<!-- END SLIDER -->
