@php use Modules\Setting\Models\Website; @endphp
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=3.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Cache-control" content="public">
    <title>{{ getSetting(Website::WEBSITE_NAME) ?? 'GoodCar' }}</title>
    @php($faviconURL = cache('setting_website')[Website::FAVICON]['value'] ?? getSetting(Website::FAVICON))
    <link rel="icon" type="image/x-icon" href="{{ !empty($faviconURL) ? $faviconURL : 'https://abctech.vn/wp-content/uploads/2017/06/logo-nen-xanh.jpg' }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/slick/css/slick.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/slick/css/slick-theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/toastr/toastr.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/styling/frontend/bootstrap_theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/frontend.css') }}?v={{ env('APP_VERSION', '1') }}">
    @stack('css')
    <script type="text/javascript" src="{{ asset('assets/vendor/jquery-3.7.0.min.js') }}"></script>
</head>
<body>
@include('Base::frontend.header')
<main class="layout-wrapper">
    @yield('content')
</main>
@include('Base::frontend.footer')
<!-- Back to top button -->
<button type="button" class="btn btn-primary btn-floating btn-lg rounded-circle border border-white btn-back-to-top" id="btn-back-to-top" aria-label="button-top">
    &uarr;
</button>
<script async defer src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('assets/vendor/slick/js/slick.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendor/jquery-passive-events.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendor/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jsvalidation/jsvalidation.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/frontend.js') }}?v={{ env('APP_VERSION', '1') }}"></script>
<script class="js-loading">
	$(document).ready(function () {
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
{{-- <script type="text/javascript" src="{{ asset('assets/vendor/fastclick.js') }}"></script>
<script>$(function() { FastClick.attach(document.body); });</script> --}}
@stack('js')
</body>
</html>
