@php use Modules\Setting\Models\Website;
$locale = env('APP_LANG', 'en');
@endphp
<!doctype html>
<html lang="{{ env('APP_LANG', 'en') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Cache-control" content="public">
    <title>{{ env('APP_NAME') }} - Admin Dashboard</title>
    @php($faviconURL = cache('setting_website')[Website::FAVICON]['value'] ?? getSetting(Website::FAVICON))
    <link rel="icon" type="image/x-icon" href="{{ !empty($faviconURL) ? $faviconURL : 'https://abctech.vn/wp-content/uploads/2017/06/logo-nen-xanh.jpg' }}">
    <link as="style" rel="stylesheet preload prefetch" href="https://fonts.googleapis.com/css2?family=Shantell+Sans:wght@400;500;600;700;800&display=swap" type="text/css" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{ asset('assets/vendor/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css"/>
    <link rel="stylesheet" href="{{ asset('assets/css/backend.css') }}?v={{ env('APP_VERSION', '1') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/toastr/toastr.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendor/datetimepicker/css/datetimepicker.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendor/select2/select2.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendor/select2/select2-bootstrap5.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/elfinder/css/elfinder.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/elfinder/themes/windows-10/css/theme.css') }}">
    @stack('css')
</head>
<body>
<div class="layout-wrapper d-flex justify-content-between flex-column h-100 vh-100">
    <div id="main-content-page" class="pb-3">
        @if(auth('admin')->check())
            @include('Base::backend.header')
        @endif
        @yield('content')
    </div>
    @if(auth('admin')->check())
        @include('Base::backend.footer')
    @endif
</div>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-3.5.1.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script src="{{ asset('assets/vendor/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('assets/vendor/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('assets/vendor/select2/select2.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datetimepicker/js/datetimepicker.js') }}"></script>
<script src="{{ asset('assets/vendor/datetimepicker/js/datetimepicker_main.js') }}"></script>
<script src="{{ asset('assets/vendor/jsvalidation/jsvalidation.min.js') }}"></script>
<script src="{{ asset('assets/vendor/elfinder/js/elfinder.full.js') }}"></script>
<script src="{{ asset("assets/vendor/elfinder/js/i18n/elfinder.". ($locale ?? 'LANG') .".js") }}"></script>
<script src="{{ asset('assets/js/sweetalert.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/modal.js') }}?v={{ env('APP_VERSION', '1') }}"></script>
<script src="{{ asset('assets/js/main.js') }}?v={{ env('APP_VERSION', '1') }}"></script>
<script class="js-loading">
	$(document).ready(function () {
		toastr.options = {
			"closeButton": true,
			"hideDuration": 0
		};
        @if (session()->has('success'))
		toastr.success("{!! session()->get('success')!!}");
        @endif
        @if (session()->has('error'))
		toastr.error("{!! session()->get('error') !!}");
        @endif

		/*File Manager*/
		if ($('#elfinder').length > 0) {
			elfinderInit('{{ route("elfinder.connector") }}', '{{ $locale ?? 'LANG' }}', '{{ csrf_token() }}');
		}
		openElfinder('{{ route("elfinder.connector") }}', '{{ csrf_token() }}', '{{ env('APP_URL') }}');
	});
	$(document).ready(function () {
		$('.select2').select2({
			theme: 'bootstrap-5'
		});
		$('.select2-multiple').select2({
			theme: 'bootstrap-5',
			closeOnSelect: true
		});
		$('.select2-multiple-tag').select2({
			theme: 'bootstrap-5',
			closeOnSelect: true,
			tags: true
		});
	});
</script>
@stack('js')
</body>
</html>
