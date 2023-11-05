<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link rel="stylesheet" type="text/css" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/elfinder/css/elfinder.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/elfinder/themes/windows-10/css/theme.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/backend.css') }}">
    </head>
    <body>
        <div id="elfinder" class="vh-100"></div>
        <script src="{{ asset('assets/vendor/jquery-3.5.1.min.js') }}"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
        <script src="{{ asset('assets/vendor/elfinder/js/elfinder.min.js') }}"></script>
        <script src="{{ asset('assets/js/main.js') }}"></script>
        <script type="text/javascript" charset="utf-8">
            @php($locale = $locale ?? 'LANG')
            elfinderInit('{{ route("elfinder.connector") }}', '{{ $locale }}', '{{ csrf_token() }}', true);
        </script>
    </body>
</html>
