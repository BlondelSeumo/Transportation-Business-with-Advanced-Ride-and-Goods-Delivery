<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request - Tagxi</title>
    <link rel="shortcut icon" href="{{ fav_icon() ?? asset('assets/img.logo.png') }}">
    <link rel="stylesheet" href="{!! asset('css/track-request.css') !!}"><link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
      <link href="{{asset('css/custom.css')}}" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
      <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
</head>

<style>
    #map {
        height: 400px;
        width: 100%;
        padding: 10px;
    }

    th {
        text-align: center;
    }

    td {
        text-align: center;
    }

    .highlight {
        color: red;
        font-weight: 800;
        font-size: large;
    }

/*timeline*/
@media (min-width:992px) {
    .page-container {
        max-width: 1140px;
        margin: 0 auto
    }

    .page-sidenav {
        display: block !important
    }
}

.padding {
    padding: 2rem
}

.w-32 {
    width: 32px !important;
    height: 32px !important;
    font-size: .85em
}

.tl-item .avatar {
    z-index: 2
}

.circle {
    border-radius: 500px
}

.gd-warning {
    color: #fff;
    border: none;
    background: #f4c414 linear-gradient(45deg, #f4c414, #f45414)
}

.timeline {
    position: relative;
    border-color: rgba(160, 175, 185, .15);
    padding: 0;
    margin: 0
}

.p-4 {
    padding: 1.5rem !important
}

.block,
.card {
    background: #fff;
    border-width: 0;
    border-radius: .25rem;
    box-shadow: 0 1px 3px rgba(0, 0, 0, .05);
    margin-bottom: 1.5rem
}

.mb-4,
.my-4 {
    margin-bottom: 1.5rem !important
}

.tl-item {
    border-radius: 3px;
    position: relative;
    display: -ms-flexbox;
    display: flex
}

.tl-item>* {
    padding: 10px
}

.tl-item .avatar {
    z-index: 2
}

.tl-item:last-child .tl-dot:after {
    display: none
}

.tl-item.active .tl-dot:before {
    border-color: #448bff;
    box-shadow: 0 0 0 4px rgba(68, 139, 255, .2)
}

.tl-item:last-child .tl-dot:after {
    display: none
}

.tl-item.active .tl-dot:before {
    border-color: #34b807;
    box-shadow: 0 0 0 4px rgba(68, 139, 255, .2)
}

.tl-dot {
    position: relative;
    border-color: rgba(160, 175, 185, .15)
}

.tl-dot:after,
.tl-dot:before {
    content: '';
    position: absolute;
    border-color: inherit;
    border-width: 2px;
    border-style: solid;
    border-radius: 50%;
    width: 10px;
    height: 10px;
    top: 15px;
    left: 50%;
    transform: translateX(-50%)
}

.tl-dot:after {
    width: 0;
    height: auto;
    top: 25px;
    bottom: -15px;
    border-right-width: 0;
    border-top-width: 0;
    border-bottom-width: 0;
    border-radius: 0
}

tl-item.active .tl-dot:before {
    border-color:#34b807;
    box-shadow: 0 0 0 4px rgba(68, 139, 255, .2)
}

.tl-dot {
    position: relative;
    border-color: rgba(160, 175, 185, .15)
}

.tl-dot:after,
.tl-dot:before {
    content: '';
    position: absolute;
    border-color: inherit;
    border-width: 2px;
    border-style: solid;
    border-radius: 50%;
    width: 10px;
    height: 10px;
    top: 15px;
    left: 50%;
    transform: translateX(-50%)
}

.tl-dot:after {
    width: 0;
    height: auto;
    top: 25px;
    bottom: -15px;
    border-right-width: 0;
    border-top-width: 0;
    border-bottom-width: 0;
    border-radius: 0
}

.tl-content p:last-child {
    margin-bottom: 0
}

.tl-date {
    font-size: .85em;
    margin-top: 2px;
    min-width: 100px;
    max-width: 100px
}

.avatar {
    position: relative;
    line-height: 1;
    border-radius: 500px;
    white-space: nowrap;
    font-weight: 700;
    border-radius: 100%;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-pack: center;
    justify-content: center;
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-negative: 0;
    flex-shrink: 0;
    border-radius: 500px;
    box-shadow: 0 5px 10px 0 rgba(50, 50, 50, .15)
}

.b-warning {
    border-color: #b1b1b1!important;
}

.b-primary {
    border-color: #f63f3f!important;
}

.b-danger {
    border-color: #f54394!important;
}
/*timeline end*/

/* Modal styles */
.modal {
  display: none; /* Hide the modal by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}
@media (min-width:786px) {
.modal-content {
  background-color: #fefefe;
  margin: 15% auto; /* Center modal on screen */
  padding: 20px;
  border: 1px solid #888;
  width: 30%;
}
}
@media (max-width:320px)  {
    .modal-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 100%;
}
}

.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}
.payment-list{
    display: flex;
    flex-direction:column;
    margin:auto;
    align-items: center;
}
/* width */
::-webkit-scrollbar {
  width: 0px;
}
.payment-mode{
    display: flex;
    align-items:center;
    justify-content:space-between;
}

</style>

<body class="bg-white-400">

<div class="row" style="height:100vh;margin:auto">
    <!-- <div class="col-12 col-lg-4 mt-10">
    <div class="" id="payment" >
        <div class="d-flex aling-items-center justify-content-between p-2">
            <div><h5>Payment Method</h5></div>
            <div style="font-size:18px;font-weight:800;">Card</div>
        </div>
    </div>
    <div class="text-center mt-10">
    <button class="btn btn-primary" id="openModalButton" style="margin:auto;">Pay</button>
    </div>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <div class="d-flex aling-items-center justify-content-between">
                <p>Choose Payment Method</p>
                <span class="close">&times;</span>
            </div>
            <div class="payment-list p-5 overflow-auto" style="height:300px;">
                <a href="#" class="payment-option" data-method="paystack"><img src="{{ asset('assets/img/stripe.png')}}" class="img-fluid" width="100px" alt=""></a>
                <a href="#" class="payment-option mt-4" data-method="paypal"><img src="{{ asset('assets/img/paypal.png')}}" class="img-fluid" width="100px" alt=""></a>
                <a href="#" class="payment-option mt-4" data-method="flutterwave"><img src="{{ asset('assets/img/flutterwave.png')}}" class="img-fluid" width="100px" alt=""></a>
                <a href="#" class="payment-option mt-4" data-method="khalti"><img src="{{ asset('assets/img/khalti.png')}}" class="img-fluid" width="100px" alt=""></a>
                <a href="#" class="payment-option mt-4" data-method="paystack"><img src="{{ asset('assets/img/paystack.png')}}" class="img-fluid" width="100px" alt=""></a>
                <a href="#" class="payment-option mt-4" data-method="ccavenue"><img src="{{ asset('assets/img/ccavenue.png')}}" class="img-fluid" width="100px" alt=""></a>
            </div>
        </div>
    </div>
</div>
<div class="col-12 col-lg-8" style="background:url('{{asset('images/pay.jpg')}}');"></div> -->
<div class="col-12 col-lg-5" id="image5" style="display: block;">
        <!-- Trip Details bg-orange-300 shadow-lg-->
        <div class="m-1 p-2 rounded shadow-lg" id= "image1">
            <div class="mx-auto d-flex justify-content-center align-items-center mb-5 p-3">
                <!-- <div class="w-full text-center"> -->
                <strong class="text-blue-900 mx-2">Req003 - </strong>
                <div class="text-md text-black font-bold ml-3 trip_status">Driver arrived</div>


                <!-- </div> -->
            </div>
            <hr>

  <!-- Map -->
        <div class="lg:mt-10 mt-6">
            <div id="map"></div>
        </div>

                <p class="text-md text-black font-bold text-center ride_otp"><strong>OTP: </strong> 123456</p>

        </div>



        <!-- Driver Details -->
        <div class="bg-white rounded shadow-lg m-5 p-3 lg:mt-10" id="image2">

            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div>
                    <img src="{{ $request->driverDetail->user->profile_pic ?? 'https://cdn4.iconfinder.com/data/icons/rcons-user/32/child_boy-128.png' }}" alt="" class="rounded-full h-12 w-12 flex items-center justify-center" width="50" height="50">
                    </div>
                   <div class="mx-2">
                        <p class="text-gray-900">Sun</p>

                        <p class="">
                            
                                <img src="https://cdn2.iconfinder.com/data/icons/ios-7-icons/50/star-128.png" alt="" class="h-4 w-4 items-center justify-center bg-yellow">
                            
                        </p>
                        </div>
                    </div>
                    <div class="text-center">
                    <p style="color:red;">
                        @lang('view_pages.estimated_price')
                    &30
                    </p>
                    </div>

            


                <div class="text-center mt-2">
                <ul class="box-controls pull-right">
                <li>
                <div class="">
                    <p>TN66SS7654</p>
                </div>
                </li>
                 <li>
                    <p class="ml-2 text-gray-900">TATA</p>
                </li>
                <li>
                    <p class="ml-2 text-gray-900">SUV</p>
                </li>
                    </div>
                </ul>

                </div>
                </div>

            <hr>


        
<!-- pickup & drop address -->

<div class="page-content page-container" id="page-content" style="display: block;">
<div class="padding">
    <div class="row">

        <div class="col-lg-12">
            <div><h5>Location Details</h5></div>
            <div class="timeline p-4 block mb-4">
                <div class="tl-item active">
                    <div class="tl-dot b-warning"></div>
                    <div class="tl-content">
                        <div class="">Pickup</div>
                        <div class="tl-date text-muted mt-1">Gandhipuram</div>
                    </div>
                </div>
                <div class="tl-item">
                    <div class="tl-dot b-primary"></div>
                    <div class="tl-content">
                        <div class="">Drop</div>
                        <div class="tl-date text-muted mt-1">Ganapathy</div>
                    </div>
                </div>

            </div>
        </div>


    </div>
</div>
</div>
</div>
<div class="col-12 col-lg-7" style="background:url('{{asset('images/track1.jpg')}}');background-size:cover;background-repeat:no-repeat;"></div>
</div>
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?key={{get_settings('google_map_key')}}&sensor=false&libraries=places"></script>

    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-database.js"></script>
    <!-- TODO: Add SDKs for Firebase products that you want to use https://firebase.google.com/docs/web/setup#available-libraries -->
    <script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-analytics.js"></script>




    <script>
    // Get the modal and the button to open it
const modal = document.getElementById("myModal");
const openModalButton = document.getElementById("openModalButton");

// Get the <span> element that closes the modal
const closeModalSpan = modal.querySelector(".close");

// When the user clicks on the button, open the modal
openModalButton.addEventListener("click", function() {
  modal.style.display = "block";
});

// When the user clicks on <span> (x), close the modal
closeModalSpan.addEventListener("click", function() {
  modal.style.display = "none";
});

// When the user clicks anywhere outside of the modal, close it
window.addEventListener("click", function(event) {
  if (event.target === modal) {
    modal.style.display = "none";
  }
});
</script>



</body>


</html>
