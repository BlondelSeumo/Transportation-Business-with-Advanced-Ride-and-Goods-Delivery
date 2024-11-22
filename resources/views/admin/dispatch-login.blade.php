<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8" />
    <title>Admin login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <!-- <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}"> -->
    <link rel="shortcut icon" href="{{ fav_icon() ?? asset('assets/images/favicon.jpg') }}">

    <!-- Bootstrap 4.0-->
    <link rel="stylesheet" href="{{ url('assets/vendor_components/bootstrap/dist/css/bootstrap.min.css') }}">

    <!-- Bootstrap extend-->
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap-extend.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('assets/css/master_style.css') }}">

    <!-- Fab Admin skins -->
    <link rel="stylesheet" href="{{ url('assets/css/skins/_all-skins.css') }}">
    <style>
        .error-style {
            list-style: none;
            color: red;
            text-align: center;
            margin-top: 15%;
            padding: 0;
        }

        body {
            background-image: url(assets/images/bg-dispatcher.jpg) !important;
            background-size: cover !important;
        }

        body::before {
            content: "";
            position: absolute;
            height: 100%;
            width: 100%;
            background: #0b4dd847;
        }

    </style>
</head>

<body class="hold-transition login-page">

    <div class="container h-p100">
        <div class="row align-items-center justify-content-md-center h-p100">

            <div class="col-lg-8 col-md-4 d-none d-md-block">
                <!-- <img src="http://localhost/tagyourtaxi/future/public/assets/images/left.svg" alt=""> -->
            </div>

            <div class="col-lg-4 col-md-8 col-12">
                <div class="login-box">
                    <div class="login-box-body text-center">
                        <div class="print-error-msg" style="position: absolute;right: 0;left: 0;">
                            <ul class="error-style"></ul>
                        </div>
                    <img src="{{ fav_icon() ?? asset('images/favicon.png') }}" alt="">
                        <h3 class="text-center">Taxi Dispatch Panel</h3>
                        <p class="login-box-msg"></p>
                        <!-- action="{{ url('api/spa/login') }}" method="post" -->
                        <form class="login_form" id="form" enctype="multipart/form-data">
                            <div class="col-12 form-group has-feedback"
                                style="display:flex;margin-bottom:15px;background: #fff;padding: 0px;">
                                <!-- <div class="col-md-2 float-left text-center"> -->
                                <!-- <span class="ion ion-email form-control-feedback"></span>
                        </div> -->
                                <div class="col-md-11 mx-auto p-0 login-email">
                                    <input type="email" style="border-radius:none;" class="form-control rounded"
                                        name="email" id="emailaddress" required="" placeholder="Email" maxlength="74"
                                        data-validation="required length email" data-validation-length="8-74"
                                        data-validation-error-msg-email="Please enter valid email address">
                                </div>
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            </div>

                            <div class="col-12 form-group has-feedback"
                                style="display:flex;margin-bottom:10px;background: #fff;padding: 0px;">
                                <!-- <div class="col-md-2 float-left text-center">
                           <span class="ion ion-locked form-control-feedback"></span>
                      </div> -->
                                <div class="col-md-11 mx-auto text-center p-0 login-email">
                                    <input type="password" name="password" style="border-radius:none;" required=""
                                        id="password" class="form-control rounded" placeholder="Password" maxlength="30"
                                        data-validation="required length" data-validation-length="8-30"
                                        data-validation-error-msg-length="Password should have atleast 8 characters.">
                                </div>
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            </div>
                            <div class="col-md-11 mx-auto text-center p-0">
                                <div class="col-6">
                                    <div class="checkbox">
                                        <input type="checkbox" id="basic_checkbox_1">
                                        <label for="basic_checkbox_1">Remember Me</label>
                                    </div>
                                </div>

                                <!-- /.col -->
                                <div class="col-12 text-center login-btn">
                                    <button class="btn btn-info btn-block margin-top-10 submit_button"
                                        type="submit">Sign In</button>
                                </div>
                                <!-- /.col -->
                            </div>
                        </form>

                    </div>
                    <!-- /.login-box-body -->
                </div>
                <!-- /.login-box -->

            </div>


        </div>
    </div>

    <!-- jQuery 3 -->
    <script src="{{ url('assets/vendor_components/jquery/dist/jquery.min.js') }}"></script>


    <!-- Bootstrap 4.0-->
    <script src="{{ url('assets/vendor_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/js/jquery.form-validator.js') }}"></script>
    <script src="{{ asset('js/dispatch-login.js') }}"></script>

    <script>
        $(document).ready(function() {

            // Form  validation
            $.validate({
                modules: 'file,sanitize',
                validateOnBlur: false,
                form: '.login_form',
                inputParentClassOnError: 'has-danger',
                errorMessageClass: 'alert-danger',
                onError: function($form) {
                    return false;
                },
                onSuccess: function($form) {
                    $('.submit_button').attr('disabled', 'disabled');
                    login();

                    return false;
                }
            });

            // submit form
            function login() {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var values = $('.login_form').serializeArray();
                $.ajax({
                    url: "{{ url('api/spa/dispatch/login') }}",
                    type: "post",
                    data: values,
                    success: function(response) {
                        window.location.href = '{{ url('dispatch/dashboard') }}';
                    },
                    error: function(response) {

                        printErrorMsg(response.responseJSON.errors);

                    }


                });
            }

            function printErrorMsg(msg) {
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display', 'block');
                $.each(msg, function(key, value) {
                    $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
                    $('.submit_button').removeAttr('disabled');
                });
            }


        });

    </script>
    <?php if (session()->has('success')) {
    $alertMessage = session()->get('success'); ?>
    <script>
        var alertMessage = "<?php echo $alertMessage; ?>";

        //alert(alertMessage);
        $.toast({
            heading: '',
            text: alertMessage,
            position: 'top-right',
            loaderBg: '#5ba035',
            icon: 'success',
            hideAfter: 5000,
            stack: 1
        });

    </script>
    <?php
    } ?>

</body>

</html>
