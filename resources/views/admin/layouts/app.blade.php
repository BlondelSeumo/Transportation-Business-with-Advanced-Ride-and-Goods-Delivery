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


            <div id="sos-model" class="modal fade" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content" style="padding: 10px;">
                        <!-- BEGIN: Modal Header -->
                        <div class="modal-header" style="border:none !important">
                            <h2 class="fw-medium fs-base me-auto " style="font-size:17px !important">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <span style="padding-left:8px" class="sos-req"></span>
                            </h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
                        </div> <!-- END: Modal Header -->
                        <!-- BEGIN: Modal Body -->
                        <div class="modal-body " style="text-align: center;padding: 26px;">
                            <a id="sos-nav" data-url="">
                                <button type="button" class="btn btn-primary"  aria-haspopup="true" aria-expanded="false" style="padding: 11px;font-size: 13px;">Click to view</button>
                            </a>
                            <div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <audio id="sosplayer">
                <source src="{{ asset('audio/sos_alert.mp3') }}">
                </audio>

            <!-- Main view  -->
            @yield('content')

        </div>
        <!-- Footer -->

    </div>

    @yield('extra-js')
       <!-- jQuery -->
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
       <!-- Your custom script -->
       <script>
         var sos_audio = document.getElementById("sosplayer");
    function playAudio(type=undefined) {
      if(type == 1)
      {
        sos_audio.play();
      }
      else{
        audio.play();
      }

    }

    function pauseAudio(type=undefined) {
      if(type == 1)
      {
        sos_audio.pause();
      }
      else{
        audio.pause();
      }
    }

           $(document).ready(function() {
               $(document).on("click", "#sos-nav", function() {
                   var data_url = $(this).attr("data-url");
                   window.location.href = "{{ url('requests') }}/" + data_url;
               });
           });
       </script>

</body>

</html>
