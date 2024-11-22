<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Favicons -->
  <link rel="icon" href="{{ asset($p.$data->tabfaviconfile) }}">

  <!-- Libs CSS -->
    @include('admin.layouts.web_common_styles')

  <title>Tweb_axi-App</title>

</head>

<body data-spy="scroll" data-target=".navbar" data-offset="71">

  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-xl navbar-light fixed-top py-2 border-bottom" style="background-color: #fffffff7;">
    <div class="container-fluid">

      <!-- Brand -->
      <a class="navbar-brand order-1 order-md-1" href="index.php">
        <img src="img/Blue.png" alt="Logo" style="max-width: 150px;">
      </a>

      <a class="navbar-brand order-3 order-md-2">
        <marquee>
          Coming Soon Fall 2021. Now Accepting Driver Applications
        </marquee>
      </a>

      <!-- Toggler -->
      <button class="navbar-toggler order-2" type="button" data-toggle="collapse" data-target="#navbarLandingCollapse" aria-controls="navbarLandingCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Collapse -->
      <div class="collapse navbar-collapse order-md-3" id="navbarLandingCollapse">

        <ul class="navbar-nav nav-divided ml-auto">
          <li class="nav-item dn-1">
            <a class="nav-link active" href="index.php">Rider</a>
          </li>
          <li class="nav-item dn-2">
            <a class="nav-link" href="index.php">Rider</a>
          </li>
          <li class="nav-item dropdown">

            <a class="nav-link driver" data-toggle="dropdown" href="#">Driver</a>

            <div class="dropdown-menu">
              <div class="card card-lg">
                <div class="card-body">
                  <ul class="list-styled font-size-sm">
                    <li class="list-styled-item">
                      <a class="list-styled-link" href="{{ url('driverpage') }}">
                        Apply to Drive
                      </a>
                    </li>
                    <li class="list-styled-item">
                      <a class="list-styled-link" href="{{ url('howdriving') }}">
                        How it works
                      </a>
                    </li>
                    <li class="list-styled-item">
                      <a class="list-styled-link" href="{{ url('driverrequirements') }}">
                        Driver Requirements
                      </a>
                    </li>
                    <!-- <li class="list-styled-item">
                      <a class="list-styled-link" href="dmv.php">
                        DMV check
                      </a>
                    </li> -->
                    <li class="list-styled-item">
                      <a class="list-styled-link" href="{{ url('safety') }}">
                        Safety
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link areas" href="{{ url('serviceareas') }}">Service&nbsp;Areas</a>
          </li>
          <li class="nav-item dropdown">

            <a class="nav-link" data-toggle="dropdown" href="#">Sign&nbsp;up</a>

            <div class="dropdown-menu">
              <div class="card card-lg">
                <div class="card-body">
                  <ul class="list-styled font-size-sm">

                    <li class="list-styled-item">
                      <a class="list-styled-link" href="{{ url('driverpage') }}">
                        Apply to Drive
                      </a>
                    </li>
                    <li class="list-styled-item">
                      <a class="list-styled-link" href="{{ url('home') }}">
                        Sign up to ride
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </li>
        </ul>
      </div>

    </div>
  </nav>
<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="x-pjax-version" content="{{ mix('/css/app.css') }}">
    <title>{{ app_name() ?? 'Tagxi' }} - Admin App</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta content="Tag your taxi Admin portal, helps to manage your fleets and trip requests" name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <meta name="theme-color" content="#0B4DD8">


    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ fav_icon() ?? asset('assets/img.logo.png')}}">
     

    @include('admin.layouts.common_styles')
    @yield('extra-css')
</head>

<body class="hold-transition skin-blue sidebar-mini fixed">
    <!-- Begin page -->
    <div class="wrapper skin-blue-light">
        <!-- Navigation -->
        @include('admin.layouts.topnavbar')

        @include('admin.layouts.navigation')

        <div class="content-wrapper">
            <!-- Page wrapper -->
            @include('admin.layouts.common_scripts')

            <!-- Main view  -->
            @yield('content')

        </div>
        <!-- Footer -->

    </div>

    @yield('extra-js')
   
</body>

</html>