<!-- BEGIN PRE-FOOTER -->
<div class="pre-footer">
    <div class="container">
        <div class="row">
            <!-- BEGIN BOTTOM ABOUT BLOCK -->
            <div class="col-md-4 col-sm-6 pre-footer-col">
{{--                <h2>About us</h2>--}}
{{--                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam sit nonummy nibh euismod tincidunt ut laoreet dolore magna aliquarm erat sit volutpat. Nostrud exerci tation ullamcorper suscipit lobortis nisl aliquip  commodo consequat. </p>--}}
{{--                <p>Duis autem vel eum iriure dolor vulputate velit esse molestie at dolore.</p>--}}
                {!! \App\Helpers\getConfigSetting::getConfigValue('about-us') !!}
            </div>
            <!-- END BOTTOM ABOUT BLOCK -->
            <!-- BEGIN BOTTOM INFO BLOCK -->
            <div class="col-md-4 col-sm-6 pre-footer-col">
                <h2>Thông tin trang</h2>
                <ul class="list-unstyled">
                    <li><i class="fa fa-angle-right"></i> <a href="{{ route('index') }}">Trang chủ</a></li>
                    <li><i class="fa fa-angle-right"></i> <a href="{{ route('shop') }}">Shop</a></li>
                    <li><i class="fa fa-angle-right"></i> <a href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
                    <li><i class="fa fa-angle-right"></i> <a href="{{ route('terms-conditions') }}">Terms &amp; Conditions</a></li>
                    <li><i class="fa fa-angle-right"></i> <a href="{{ route('faq') }}">FAQ</a></li>
                    <li><i class="fa fa-angle-right"></i> <a href="{{ route('about') }}">About</a></li>
                    <li><i class="fa fa-angle-right"></i> <a href="{{ route('contact') }}">Contact</a></li>
{{--                    <li><i class="fa fa-angle-right"></i> <a href="javascript:;">Careers</a></li>--}}
{{--                    <li><i class="fa fa-angle-right"></i> <a href="javascript:;">Payment Methods</a></li>--}}
                </ul>
            </div>
            <!-- END INFO BLOCK -->

{{--            <!-- BEGIN TWITTER BLOCK -->--}}
{{--            <div class="col-md-3 col-sm-6 pre-footer-col">--}}
{{--                <h2 class="margin-bottom-0">Latest Tweets</h2>--}}
{{--                <a class="twitter-timeline" href="https://twitter.com/twitterapi" data-tweet-limit="2" data-theme="dark" data-link-color="#57C8EB" data-widget-id="455411516829736961" data-chrome="noheader nofooter noscrollbar noborders transparent">Loading tweets by @keenthemes...</a>--}}
{{--            </div>--}}
            <!-- END TWITTER BLOCK -->

            <!-- BEGIN BOTTOM CONTACTS -->
            <div class="col-md-4 col-sm-12 pre-footer-col">
                {!! \App\Helpers\getConfigSetting::getConfigValue('contact') !!}
            </div>
            <!-- END BOTTOM CONTACTS -->
        </div>
        <hr>
        <div class="row">
            <!-- BEGIN SOCIAL ICONS -->
            <div class="col-md-6 col-sm-6">
                <ul class="social-icons">
{{--                    <li><a class="rss" data-original-title="rss" href="javascript:;"></a></li>--}}
                    <li><a class="facebook" data-original-title="facebook" href="{{ \App\Helpers\getConfigSetting::getConfigValue('facebook') }}"></a></li>
                    <li><a class="twitter" data-original-title="twitter" href="{{ \App\Helpers\getConfigSetting::getConfigValue('twitter') }}"></a></li>
{{--                    <li><a class="googleplus" data-original-title="googleplus" href="javascript:;"></a></li>--}}
                    <li><a class="linkedin" data-original-title="linkedin" href="{{ \App\Helpers\getConfigSetting::getConfigValue('linkedin') }}"></a></li>
                    <li><a class="youtube" data-original-title="youtube" href="{{ \App\Helpers\getConfigSetting::getConfigValue('youtube') }}"></a></li>
                </ul>
            </div>
            <!-- END SOCIAL ICONS -->
            <!-- BEGIN NEWLETTER -->
            <div class="col-md-6 col-sm-6">
                <div class="pre-footer-subscribe-box pull-right">
                    <h2>Newsletter</h2>
                    <form action="#">
                        <div class="input-group">
                            <input type="text" placeholder="youremail@mail.com" class="form-control">
                            <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit">Subscribe</button>
                  </span>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END NEWLETTER -->
        </div>
    </div>
</div>
<!-- END PRE-FOOTER -->
