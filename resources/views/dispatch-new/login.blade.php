
<!DOCTYPE html>
<html lang="en" dir="" class="">

<head>

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta http-equiv="x-pjax-version" content="{{ mix('/css/app.css') }}">
        <title>{{ app_name() ?? 'Tagyourtaxi' }} - Dispatcher</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta content="Tag your taxi Admin portal, helps to manage your fleets and trip requests" name="description" />
        <meta content="Coderthemes" name="author" />
        <meta name="x-apple-disable-message-reformatting">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="theme-color" content="#0B4DD8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ fav_icon() ?? asset('assets/img.logo.png')}}">
        <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}" />
        <!-- END: CSS Assets-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

        
        <style>

* {
  box-sizing: border-box;
}
html{
    background:url("{{ asset('assets/img/login.png') }}");
    background-attachment: fixed;
    background-repeat: no-repeat;
    background-size:cover;
}

@import url('https://fonts.googleapis.com/css?family=Poppins');

/* BASIC */

body {
  font-family: "Poppins", sans-serif;
  height: 100vh;
}

a {
  color: #92badd;
  display:inline-block;
  text-decoration: none;
  font-weight: 400;
}

h2 {
  text-align: center;
  font-size: 16px;
  font-weight: 600;
  text-transform: uppercase;
  display:inline-block;
  margin: 40px 8px 10px 8px; 
  color: #cccccc;
}



/* STRUCTURE */

.wrapper {
  display: grid;
  place-items: center;
  min-height:95vh;
  /* flex-direction: column; 
  justify-content: center;
  width: 100%; */
  /* min-height: 100%; */
  /* padding: 20px; */
}

#formContent {
  -webkit-border-radius: 10px 10px 10px 10px;
  border-radius: 10px 10px 10px 10px;
  background: #fff;
  padding: 30px;
  width: 90%;
  min-height:400px;
  max-width: 450px;
  position: relative;
  padding: 0px;
  -webkit-box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
  box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
  text-align: center;
}

#formFooter {
  background-color: #f6f6f6;
  border-top: 1px solid #dce8f1;
  padding: 25px;
  text-align: center;
  -webkit-border-radius: 0 0 10px 10px;
  border-radius: 0 0 10px 10px;
}



/* TABS */

h2.inactive {
  color: #cccccc;
}

h2.active {
  color: #0d0d0d;
  border-bottom: 2px solid #5fbae9;
}



/* FORM TYPOGRAPHY*/

input[type=button], input[type=submit], input[type=reset]  {
  background-color: #fca503;
  border: none;
  color: white;
  padding: 15px 80px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  text-transform: uppercase;
  font-size: 13px;
  -webkit-box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
  box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
  -webkit-border-radius: 5px 5px 5px 5px;
  border-radius: 5px 5px 5px 5px;
  margin: 5px 20px 40px 20px;
  -webkit-transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
  -ms-transition: all 0.3s ease-in-out;
  -o-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
}

input[type=button]:hover, input[type=submit]:hover, input[type=reset]:hover  {
  background-color: #39ace7;
}

input[type=button]:active, input[type=submit]:active, input[type=reset]:active  {
  -moz-transform: scale(0.95);
  -webkit-transform: scale(0.95);
  -o-transform: scale(0.95);
  -ms-transform: scale(0.95);
  transform: scale(0.95);
}

input[type=email], input[type=password] {
  background-color: #f6f6f6;
  border: none;
  color: #0d0d0d;
  padding: 15px 50px;
  text-align: start;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 15px;
  width: 85%;
  border: 2px solid #fca503;
  -webkit-transition: all 0.5s ease-in-out;
  -moz-transition: all 0.5s ease-in-out;
  -ms-transition: all 0.5s ease-in-out;
  -o-transition: all 0.5s ease-in-out;
  transition: all 0.5s ease-in-out;
  -webkit-border-radius: 5px 5px 5px 5px;
  border-radius: 5px 5px 5px 5px;
}

input[type=email], input[type=password]:focus {
  background-color: #fff;
  border-bottom: 2px solid #fca503;
}

input[type=email], input[type=password]:placeholder {
  color: #cccccc;
}



/* ANIMATIONS */

/* Simple CSS3 Fade-in-down Animation */
.fadeInDown {
  -webkit-animation-name: fadeInDown;
  animation-name: fadeInDown;
  -webkit-animation-duration: 1s;
  animation-duration: 1s;
  -webkit-animation-fill-mode: both;
  animation-fill-mode: both;
}

@-webkit-keyframes fadeInDown {
  0% {
    opacity: 0;
    -webkit-transform: translate3d(0, -100%, 0);
    transform: translate3d(0, -100%, 0);
  }
  100% {
    opacity: 1;
    -webkit-transform: none;
    transform: none;
  }
}

@keyframes fadeInDown {
  0% {
    opacity: 0;
    -webkit-transform: translate3d(0, -100%, 0);
    transform: translate3d(0, -100%, 0);
  }
  100% {
    opacity: 1;
    -webkit-transform: none;
    transform: none;
  }
}

/* Simple CSS3 Fade-in Animation */
@-webkit-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
@-moz-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
@keyframes fadeIn { from { opacity:0; } to { opacity:1; } }

.fadeIn {
  opacity:0;
  -webkit-animation:fadeIn ease-in 1;
  -moz-animation:fadeIn ease-in 1;
  animation:fadeIn ease-in 1;

  -webkit-animation-fill-mode:forwards;
  -moz-animation-fill-mode:forwards;
  animation-fill-mode:forwards;

  -webkit-animation-duration:1s;
  -moz-animation-duration:1s;
  animation-duration:1s;
}

.fadeIn.first {
  -webkit-animation-delay: 0.4s;
  -moz-animation-delay: 0.4s;
  animation-delay: 0.4s;
}

.fadeIn.second {
  -webkit-animation-delay: 0.6s;
  -moz-animation-delay: 0.6s;
  animation-delay: 0.6s;
}

.fadeIn.third {
  -webkit-animation-delay: 0.8s;
  -moz-animation-delay: 0.8s;
  animation-delay: 0.8s;
}

.fadeIn.fourth {
  -webkit-animation-delay: 1s;
  -moz-animation-delay: 1s;
  animation-delay: 1s;
}

/* Simple CSS3 Fade-in Animation */
.underlineHover:after {
  display: block;
  left: 0;
  bottom: -10px;
  width: 0;
  height: 2px;
  background-color: #56baed;
  content: "";
  transition: width 0.2s;
}

.underlineHover:hover {
  color: #0d0d0d;
}

.underlineHover:hover:after{
  width: 100%;
}

/* OTHERS */

*:focus {
    outline: none;
} 

#icon {
  width:60%;
}

.inputs{
  padding:40px 0;
}


.img-top {
    height:150px;
    width:150px;
    margin:0 auto;
    position: relative;  
    overflow:hidden;
    background:white;
    border-radius:50%;
    box-shadow: 0 30px 40px #0000000b;
    border:1px solid #e1e1e1;
  
}
.img-top img {
    position: absolute;
    top: 50%;
    left:50%;
    transform: translate(-50%, -50%); 
      /* display:block; */
}
.error-style {
            list-style: none;
            color: red;
            text-align: center;
            margin-top: 5%;
            padding: 0;
            font-size: 13px;
            font-weight: bold;
        }
</style>

</head>



<body class="body">
<div class="wrapper fadeInDown">
<div class="container4">
    <img src="{{asset('assets/img/android.svg')}}"  alt="bar" />
</div>
  <div id="formContent">
    <div class="img-top" style="margin-top:-90px;"><img style="margin:auto;" src="{{asset('assets/img/log-in.png')}}" class="img-fluid" width="100px;" alt=""></div>
    <!-- Login Form -->
    <div class="print-error-msg" style="position: absolute;right: 0;left: 0;">
                            <ul class="error-style"></ul>
                        </div>
    <form class="login_form" id="form" enctype="multipart/form-data">
      <div style="position:relative;">
        <i data-feather="user" style="display:block;position:absolute;left:50;top:30;z-index:5;color:#fca503;"></i>
        <input type="email" id="login" class="fadeIn second" name="email" maxlength="74" data-validation="required length email" data-validation-length="8-74" data-validation-error-msg-email="Please enter valid email address" placeholder="Username">
        <br><span class="text-danger">{{ $errors->first('email') }}</span>
      </div>
      <div style="position:relative;">
        <i data-feather="lock" style="display:block;position:absolute;left:50;top:30;z-index:5;color:#fca503;"></i>
        <input type="password" id="password" class="fadeIn third" maxlength="30" name="password" data-validation="required length" data-validation-length="8-30" data-validation-error-msg-length="Password should have at least 8 characters." placeholder="Password">
        <br><span class="text-danger">{{ $errors->first('password') }}</span>
      </div>

      <input type="submit" class="fadeIn fourth" value="Log In">
    </form>



  </div>
</div>
  <!-- jQuery 3 -->
  <script src="{{ url('assets/vendor_components/jquery/dist/jquery.min.js') }}"></script>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>


<!-- Bootstrap 4.0-->
<script src="{{ url('assets/vendor_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

<!-- App js -->
<script src="{{ asset('assets/js/jquery.form-validator.js') }}"></script>
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
            window.location.href = '{{ url('dispatch/home') }}';
        },
        error: function(response) { 
                         $('.submit_button').removeAttr('disabled');
            printErrorMsg(response.responseJSON.errors);

        }


    });
}

function printErrorMsg(msg) {
  $(".print-error-msg").removeAttr('style');
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


        <!-- END: Form Layout -->


