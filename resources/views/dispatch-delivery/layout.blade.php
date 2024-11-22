<!DOCTYPE html>
<html lang="en-US" dir="ltr">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ app_name() ?? 'Tagxi' }} - Dispatcher</title>

    <link rel="shortcut icon" href="{{ fav_icon() ?? asset('assets/images/favicon.jpg') }}">
    <link rel="manifest" href="assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">
    <script src="{{ asset('dispatcher/assets/js/config.js') }}"></script>

    <link href="{{ asset('dispatcher/assets/css/theme-rtl.min.css') }}" rel="stylesheet" id="style-rtl">
    <link href="{{ asset('dispatcher/vendors/swiper/swiper-bundle.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dispatcher/assets/css/theme.min.css') }}" rel="stylesheet" id="style-default">
    <link href="{{ asset('dispatcher/assets/css/user-rtl.min.css') }}" rel="stylesheet" id="user-style-rtl">
    <link href="{{ asset('dispatcher/assets/css/user.min.css') }}" rel="stylesheet" id="user-style-default">
    <link href="{{ asset('dispatcher/jquery.fancybox.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/build/css/intlTelInput.css') }}">
    <link href="{{ asset('dispatcher/vendors/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
</head>
@stack('dispatch-css')
<body>

    @yield('dispatch-content')

    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="{{ asset('dispatcher/assets/js/flatpickr.js') }}"></script>
    <script src="{{ asset('dispatcher/vendors/popper/popper.min.js') }}"></script>
    <script src="{{ asset('dispatcher/vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('dispatcher/vendors/anchorjs/anchor.min.js') }}"></script>
    <script src="{{ asset('dispatcher/vendors/is/is.min.js') }}"></script>
    <script src="{{ asset('dispatcher/vendors/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('dispatcher/vendors/progressbar/progressbar.min.js') }}"></script>
    <script src="{{ asset('dispatcher/vendors/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('dispatcher/vendors/lodash/lodash.min.js') }}"></script>
    <script src="../polyfill.io/v3/polyfill.min58be.js?features=window.scroll"></script>
    <script src="{{ asset('dispatcher/vendors/list.js/list.min.js') }}"></script>
    <script src="{{ asset('dispatcher/vendors/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('dispatcher/assets/js/theme.js') }}"></script>
    <script src="{{ asset('dispatcher/assets/js/user.js') }}"></script>
    <script src="{{ asset('dispatcher/jquery.fancybox.min.js') }}"></script>
@stack('dispatch-js')
</body>
</html>
