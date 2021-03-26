<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <script type="text/javascript">
            var full_path = '<?= url('/') . '/admin/'; ?>';
        </script>
        <meta charset="UTF-8">
        <title>{{ env('APP_NAME', 'Laravel') }}</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('public/backend/assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('public/backend/assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('public/backend/assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('public/backend/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('public/backend/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('public/backend/assets/global/css/components.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('public/backend/assets/layouts/layout2/css/layout.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('public/backend/assets/layouts/layout2/css/themes/blue.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('public/backend/assets/layouts/layout2/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('public/backend/assets/global/css/plugins.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('public/backend/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('public/backend/custom/css/style.css') }}" rel="stylesheet" type="text/css" />
        <script src="{{ URL::asset('public/backend/assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
        <link href="{{ URL::asset('public/frontend/custom/iao-alert/iao-alert.min.css') }}" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="{{ URL::asset('favicon.png') }}">
        @yield('css')
    </head>
    <body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid">
        <!-- BEGIN HEADER -->
        @include('admin::partials.header')
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <!-- END SIDEBAR -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <div class="page-sidebar navbar-collapse collapse">
                    <!-- BEGIN SIDEBAR MENU -->
                    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    @include('admin::partials.left')
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
            </div>
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <ul class="breadcrumb">
                        <li><i class="icon-home"></i> <a href="{{ Route('admin-dashboard') }}">Home</a></li>
                        @yield('breadcrumb')
                    </ul>
                    @if(Session::has('success'))
                    <div class="alert alert-success fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        <span>{{ Session::get('success') }}</span>
                    </div>
                    @endif
                    @if(Session::has('danger'))
                    <div class="alert alert-danger fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        <span>{{ Session::get('danger') }}</span>
                    </div>
                    @endif
                    @yield('content')
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
            <!-- BEGIN QUICK SIDEBAR -->
            @include('admin::partials.sidebar')
            <!-- END QUICK SIDEBAR -->
        </div>
        <!-- BEGIN FOOTER -->
        @include('admin::partials.footer')
        <!-- END FOOTER -->
        <script src="{{ URL::asset('public/backend/assets/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/backend/assets/global/plugins/js.cookie.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/backend/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/backend/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/backend/assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/backend/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/backend/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/backend/assets/global/plugins/morris/morris.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/backend/assets/global/plugins/counterup/jquery.waypoints.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/backend/assets/global/plugins/counterup/jquery.counterup.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/backend/assets/global/scripts/app.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/backend/assets/global/plugins/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/backend/assets/layouts/layout2/scripts/layout.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/backend/assets/layouts/global/scripts/quick-sidebar.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/backend/assets/pages/scripts/dashboard.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/backend/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/backend/custom/js/script.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/frontend/custom/iao-alert/iao-alert.min.js') }}" type="text/javascript"></script>
        @yield('js')
    </body>
</html>