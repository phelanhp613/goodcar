<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/elfinder/css/elfinder.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/elfinder/themes/windows-10/css/theme.css') }}">
    </head>
    <body>
        <div id="elfinder"></div>
        <script src="{{ asset('assets/vendor/jquery-3.5.1.min.js') }}"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
        <script src="{{ asset('assets/vendor/elfinder/js/elfinder.min.js') }}"></script>
        <script type="text/javascript" charset="utf-8">
            // Helper function to get parameters from the query string.
            function getUrlParam(paramName) {
                var reParam = new RegExp('(?:[\?&]|&amp;)' + paramName + '=([^&]+)', 'i');
                var match = window.location.search.match(reParam);
                return (match && match.length > 1) ? match[1] : '';
            }

            $().ready(function () {
                var funcNum = getUrlParam('CKEditorFuncNum');
                var elf = $('#elfinder').elfinder({
                    // set your elFinder options here
                    lang: '{{ $locale ?? 'LANG'}}', // locale
                    customData: {
                        _token: '{{ csrf_token() }}'
                    },
                    width: '100%',
                    height: '100%',
                    url: '{{ route("elfinder.connector") }}',  // connector URL
                    getFileCallback: function (file) {
                        window.opener.CKEDITOR.tools.callFunction(funcNum, file.url);
                        window.close();
                    }
                }).elfinder('instance');
            });
        </script>
    </body>
</html>
