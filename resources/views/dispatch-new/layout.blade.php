<!DOCTYPE html>
<html lang="en" dir="" class="">

<head>

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta http-equiv="x-pjax-version" content="{{ mix('/css/app.css') }}">
        <title>{{ app_name() ?? 'Tagyourtaxi' }} - Admin App</title>

        <meta content="Tag your taxi Admin portal, helps to manage your fleets and trip requests" name="description" />
        <meta content="Coderthemes" name="author" />
        <meta name="x-apple-disable-message-reformatting">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="theme-color" content="#0B4DD8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ fav_icon() ?? asset('assets/img/logo.png')}}">
        <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}" />
        <!-- END: CSS Assets-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

        


</head>

<body class="body">
@include('dispatch-new.header')
            <!-- BEGIN: Content -->
        @include('admin.layouts.common_scripts')
            <div class="cont">
                @yield('dispatch-content')
               
                
            </div>
             <!-- END: Content -->    


</body>

</html>