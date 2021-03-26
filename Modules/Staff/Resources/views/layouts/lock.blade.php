<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <script type="text/javascript">
            var full_path = '<?= url('/') . '/'; ?>';
        </script>
        <meta charset="UTF-8">
        <title>{{ env('APP_NAME', 'Laravel') }} - Staff Lock</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('public/backend/assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('public/backend/assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('public/backend/assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('public/backend/assets/global/plugins/uniform/css/uniform.default.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('public/backend/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('public/backend/assets/global/css/components.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('public/backend/assets/global/css/plugins.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('public/backend/assets/pages/css/lock-2.min.css') }}" rel="stylesheet" type="text/css" />
        <script src="{{ URL::asset('public/backend/assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
        <link rel="shortcut icon" href="{{ URL::asset('favicon.png') }}">
    </head>
    <body class="">
        @yield('content')
        <script src="{{ URL::asset('public/backend/assets/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/backend/assets/global/plugins/js.cookie.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/backend/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/backend/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/backend/assets/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/backend/assets/global/plugins/uniform/jquery.uniform.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/backend/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/backend/assets/global/plugins/backstretch/jquery.backstretch.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/backend/assets/global/scripts/app.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/backend/assets/pages/scripts/lock-2.min.js') }}" type="text/javascript"></script>
    </body>
</html>