<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <script type="text/javascript">
            var full_path = '<?= url('/') . '/'; ?>';
            var logged_in = '<?= (Auth::guard('frontend')->guest()) ? true : false; ?>';
        </script>
        <meta charset="UTF-8">
        <title>{{ env('APP_NAME', 'Laravel') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        {!! MetaTag::tag('title') !!}
        {!! MetaTag::tag('keyword') !!}
        {!! MetaTag::tag('description') !!}
        @php
        $routeArray = app('request')->route()->getAction();
        $controllerAction = class_basename($routeArray['controller']);
        list($controller, $action) = explode('@', $controllerAction);
        @endphp
        @if(in_array($controller,['UserController','ProductController','AdvertController','OrderController','CustomerorderController','WithdrawalController']))
        <link href="{{ URL::asset('public/frontend/css/dashboard.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('public/frontend/css/style.css') }}" rel="stylesheet" type="text/css" />
        @endif
        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,600,700&display=swap" rel="stylesheet">
        <link href="{{ URL::asset('public/frontend/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('public/frontend/css/icofont.min.css') }}" rel="stylesheet" type="text/css" />       
        <link href="{{ URL::asset('public/frontend/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />       
        <!--<link href="{{ URL::asset('public/frontend/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />-->
        <link href="{{ URL::asset('public/frontend/css/custom.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('public/frontend/css/responsive.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('public/frontend/custom/iao-alert/iao-alert.min.css') }}" rel="stylesheet" type="text/css" />
        <script src="{{ URL::asset('public/frontend/js/jquery-3.4.1.min.js') }}" type="text/javascript"></script>
        <link rel="stylesheet" href="{{ URL::asset('public/frontend/css/jquery-confirm.min.css') }}" />
        <link rel="shortcut icon" href="{{ URL::asset('favicon.png') }}">
        @yield('css')
    </head>
    <body>
        @include('partials.header')
        @yield('content')
        @if(!in_array($controller,['UserController','ProductController','AdvertController','OrderController','CustomerorderController','WithdrawalController']))
        @include('partials.footer')
        @endif
        <script src="{{ URL::asset('public/frontend/js/popper.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/frontend/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/frontend/custom/iao-alert/iao-alert.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/frontend/custom/js/script.js') }}" type="text/javascript"></script>
        <script type="text/javascript" src="{{URL::asset('public/frontend/custom/mask/jquery.mask.min.js')}}"></script>
        <script src="{{ URL::asset('public/frontend/js/jquery-confirm.min.js') }}" type="text/javascript"></script>
        @yield('js')
        <script>
            $(window).scroll(function () {
                var scroll = $(window).scrollTop();
                if (scroll >= 100)
                    $(".header-section").addClass("affix");
                else
                    $(".header-section").removeClass("affix");
            });
        </script>
        @if(Session::has('success'))
        <input type="hidden" id="success_msg" value="{{ Session::get('success') }}"/>
        <script>
            var success_msg = $('#success_msg').val();
            $.iaoAlert({
                type: "success",
                position: "top-right",
                mode: "dark",
                msg: success_msg,
                autoHide: true,
                alertTime: "3000",
                fadeTime: "1000",
                closeButton: true,
                fadeOnHover: true,
            });
        </script>
        @endif
        @if(Session::has('error'))
        <input type="hidden" id="error_msg" value="{{ Session::get('error') }}"/>
        <script>
            var error_msg = $('#error_msg').val();
            $.iaoAlert({
                type: "error",
                position: "top-right",
                mode: "dark",
                msg: error_msg,
                autoHide: true,
                alertTime: "3000",
                fadeTime: "1000",
                closeButton: true,
                fadeOnHover: true,
            });
        </script>
        @endif
    </body>
</html>