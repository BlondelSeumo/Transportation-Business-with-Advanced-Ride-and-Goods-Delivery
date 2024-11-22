<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8" />
        <title>Un-Authorized</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="admin/assets/images/favicon.ico">

        <link rel="stylesheet" type="text/css" href="{!!asset('/css/app.css')!!}">

        <!-- App css -->
        <link href="{!!asset('assets/css/bootstrap.min.css')!!}" rel="stylesheet" type="text/css" />
        <link href="{!!asset('assets/css/icons.css')!!}" rel="stylesheet" type="text/css" />
        <link href="{!!asset('assets/css/metismenu.min.css')!!}" rel="stylesheet" type="text/css" />
        <link href="{!!asset('assets/css/style.css')!!}" rel="stylesheet" type="text/css" />

        <script src="{{asset('assets/js/modernizr.min.js')}}"></script>

    </head>

    <body class="account-pages">

             <!-- Begin page -->
        <!-- <div class="accountbg" style="background: url('assets/images/bg-1.jpg');background-size: cover;"></div> -->

        <div class="wrapper-page account-page-full">

            <div class="card">
                <div class="card-block">

                    <div class="account-box">

                        <div class="card-box p-5">
                            <h2 class="text-uppercase text-center pb-4">
                                <a href="index.html" class="text-success">
                                    <span><img src="assets/images/logo.png" alt="" height="26"></span>
                                </a>
                            </h2>

                            <div class="text-center">
                                <h1 class="text-error">401</h1>
                                <h4 class="text-uppercase text-danger mt-3">Un Authorized Request</h4>
                                <p class="text-muted mt-3">It's looking like you may have taken a wrong turn. Don't worry... it
                                    happens to the best of us. Here's a
                                    little tip that might help you get back on track.</p>

                                <a class="btn btn-md btn-block btn-custom waves-effect waves-light mt-3" href="/login"> Return Login</a>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <!-- <div class="m-t-40 text-center">
                <p class="account-copyright">2018 © Highdmin. - Coderthemes.com</p>
            </div> -->

        </div>


        <!-- jQuery  -->
        <script src="{{asset('assets/js/jquery.min.js')}}"></script>
        <script src="{{asset('assets/js/popper.min.js')}}"></script>
        <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('assets/js/metisMenu.min.js')}}"></script>
        <script src="{{asset('assets/js/jquery.slimscroll.js')}}"></script>

        <!-- App js -->
        <script src="{{asset('assets/js/jquery.core.js')}}"></script>
        <script src="{{asset('assets/js/jquery.app.js')}}"></script>
        <script src="{{asset('assets/js/jquery.form-validator.min.js')}}"></script>


    </body>
</html>