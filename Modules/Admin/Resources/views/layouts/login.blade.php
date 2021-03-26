<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <script type="text/javascript">
            var full_path = '<?= url('/') . '/'; ?>';
        </script>
        <meta charset="UTF-8">
        <title>{{ env('APP_NAME', 'Laravel') }} - Admin Login</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('public/backend/assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('public/backend/assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('public/backend/assets/global/plugins/uniform/css/uniform.default.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('public/backend/assets/global/css/components.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('public/backend/assets/global/css/plugins.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('public/backend/assets/pages/css/login-5.min.css') }}" rel="stylesheet" type="text/css" />
        <script src="{{ URL::asset('public/backend/assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
        <link rel="shortcut icon" href="{{ URL::asset('favicon.png') }}">
    </head>
    <body class=" login">
        <!-- BEGIN : LOGIN PAGE 5-1 -->
        <div class="user-login-5">
            <div class="row bs-reset">
                <div class="col-md-6 bs-reset">
                    <div class="login-bg" style="background-image:url({{ URL::asset('public/backend/assets/pages/img/login/bg1.jpg') }})">
                        <img src="{{ URL::asset('public/frontend/images/logo.png') }}" class="login-logo" alt="Logo" height="68">
                    </div>
                </div>
                <div class="col-md-6 login-container bs-reset">
                    @yield('content')
                </div>
            </div>
        </div>
        <!-- END : LOGIN PAGE 5-1 -->
        <script src="{{ URL::asset('public/backend/assets/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/backend/assets/global/plugins/js.cookie.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/backend/assets/global/plugins/uniform/jquery.uniform.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/backend/assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/backend/assets/global/plugins/backstretch/jquery.backstretch.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/backend/assets/global/scripts/app.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/backend/assets/pages/scripts/login-5.min.js') }}" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#admin-forgot-password-form").submit(function (event) {
                    event.preventDefault();
                    $('.errorMsg').text('').parent().hide();
                    $('#submit-btn').attr('disabled', true);
                    var url = full_path + 'admin/forgotpassword';
                    var csrf_token = $('input[name=_token]').val();
                    var data = new FormData($(this)[0]);
                    $.ajax({
                        url: url,
                        headers: {'X-CSRF-TOKEN': csrf_token},
                        type: 'POST',
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        data: data,
                        success: function (resp) {
                            window.location.reload();
                        },
                        error: function (resp) {
                            $.each(resp.responseJSON.errors, function (key, val) {
                                $("#err_" + key).text(val[0]);
                            });
                            $('#submit-btn').removeAttr('disabled');
                            $('.errorMsg').parent().show();
                        }
                    });
                });

                $('#back-btn').click(function () {
                    $('.errorMsg').parent().hide();
                });
            });
        </script>
    </body>
</html>