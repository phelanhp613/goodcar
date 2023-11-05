@php use Modules\Setting\Models\Website; @endphp
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=3.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Cache-control" content="public">
    <meta name="title" content="{{ session()->get('meta_title') ?? 'Basic' }}">
    <meta name="description" content="{{ session()->get('meta_description') ?? 'Basic Home Page' }}">
    <meta name="keywords" content="{{ session()->get('meta_keyword') ?? 'Basic Home Page' }}">
    <meta name="image" content="{{ session()->get('meta_image') ?? asset('/images/meta_image.png')  }}">
    <meta property="og:title" content="{{ session()->get('meta_title') ?? 'Basic' }}">
    <meta property="og:description" content="{{ session()->get('meta_description') ?? 'Basic Showroom' }}">
    <meta property="og:image" content="{{ session()->get('meta_image') ?? asset('/images/meta_image.png')  }}">
    <meta name="twitter:title" content="{{ session()->get('meta_title') ?? 'Basic' }}">
    <meta name="twitter:description" content="{{ session()->get('meta_description') ?? 'Basic Showroom' }}">
    <meta name="twitter:image" content="{{ session()->get('meta_image') ?? asset('/images/meta_image.png') }}">
    <meta name="google-site-verification" content="_2HhNdVqKnDNhq4kcjJ-qfNaRiRTeOOQrYFQoDI0MnE" />
    <title>{{ session()->get('meta_title') ?? 'Basic' }}</title>
    <link rel="canonical" href="{{ session()->get('canonical') ?? request()->url() }}">
    @php($faviconURL = cache('setting_website')[Website::FAVICON]['value'] ?? getSetting(Website::FAVICON))
    <link rel="icon" type="image/x-icon" href="{{ !empty($faviconURL) ? $faviconURL : 'https://abctech.vn/wp-content/uploads/2017/06/logo-nen-xanh.jpg' }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/slick/css/slick.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/slick/css/slick-theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/toastr/toastr.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/styling/frontend/bootstrap_theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/frontend.css') }}?v={{ env('APP_VERSION', '1') }}">
    @php($font_size_header = !empty(cache('setting_website')[Website::MENU_HEADER_FONT_SIZE]['value']) ? cache('setting_website')[Website::MENU_HEADER_FONT_SIZE]['value'] : 15)
    <style>
        @media (min-width: 991px) {
	        .menu-header-nav li{
		        font-size: {{ $font_size_header }}px;
	        }
        }
    </style>
    @stack('css')
    @php($cssStyle = cache('setting_website')[Website::CSS_STYLE]['value'] ?? getSetting(Website::CSS_STYLE))
    {!! $cssStyle !!}
    <script type="text/javascript" src="{{ asset('assets/vendor/jquery-3.7.0.min.js') }}"></script>
</head>
<body>
<div class="layout-wrapper">
    @include('Base::frontend.header')
    <div class="main">
        @yield('content')
    </div>
    @include('Base::frontend.footer')
</div>
<!-- Back to top button -->
<button type="button" class="btn btn-primary btn-floating btn-lg rounded-circle border border-white" id="btn-back-to-top" aria-label="button-top">
    &uarr;
</button>
<script async defer src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('assets/vendor/jquery-passive-events.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendor/toastr/toastr.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendor/slick/js/slick.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendor/lazyload/jquery.lazy.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendor/lazyload/jquery.lazy.plugins.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/frontend.js') }}?v={{ env('APP_VERSION', '1') }}"></script>
@php($javascript = cache('setting_website')[Website::JAVASCRIPT]['value'] ?? getSetting(Website::JAVASCRIPT))
{!! $javascript !!}
<script class="js-loading">
	$(document).ready(function () {
		$('.lazy').Lazy();
		toastr.options.fadeOut = 1000;
		toastr.options.timeOut = 3000;
        @if (session()->has('error'))
		toastr.error("{!! session()->get('error') !!}");
        @endif
        @if (session()->has('send-success'))
		toastr.success("{!! session()->get('send-success') !!}");
        @endif
        @if (session()->has('rating_success'))
		toastr.success("{!! session()->get('rating_success') !!}");
        @endif
        @if (session()->has('frontend_success'))
        toastr.success("{!! session()->get('frontend_success') !!}");
        @endif
	});
</script>
<script type="text/javascript" src="{{ asset('assets/vendor/fastclick.js') }}"></script>
<script>$(function() { FastClick.attach(document.body); });</script>
@stack('js')
</body>
</html>
