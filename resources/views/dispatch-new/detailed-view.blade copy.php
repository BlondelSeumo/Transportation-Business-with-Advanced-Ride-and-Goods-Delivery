@extends('dispatch-new.layout')

@section('dispatch-content')
<link rel="stylesheet" href="{{ asset('assets/css/dispatcher/detailed-view.css') }}">


<div class="g-col-12 g-col-lg-4 mt-10 p-10">
    <div class="grid columns-12 gap-5 mt-5">
        <!-- BEGIN: Driver Side Menu -->
        <div class="g-col-12 g-col-xl-6 g-col-xxl-6">
          <div class="box p-5 intro-y mt-5" style="background:#FBFBFB;box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                <div class="d-flex flex-column flex-lg-row pb-5 mx-n5">
                    <div class="d-flex flex-1 px-5 align-items-start justify-content-center justify-content-lg-start">
                        <div class="d-flex ms-5">
                            <div class="px-4 ct1" >Basic Information</div>
                        </div>
                    </div>
                </div>
                <div class="text-end p-2 cb-1" style="color:black;">{{ $item->request_number }}</div>
                <div class=" p-5 intro-y">
                  <div class="grid grid-cols-12 gap-5 mt-5">
                    <!-- <div class="g-col-12 g-col-sm-6 g-col-xxl-3 box p-5 cursor-pointer zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                        <div class="text-theme-10" style="font-size:20px;font-weight:800;">Driver Details</div>
                        <div class="text-gray-600" style="font-size:20px;font-weight:800;">Sudarsan</div>
                        <div class="mt-6 mt-lg-0 pt-5">
                            <div class="fw-medium text-center text-lg-start " style="font-size:25px;font-weight:800;">4 <i class="fa fa-star" style="color:yellow;"></i></div>
                        </div>
                    </div>
                    <div class="g-col-12 g-col-sm-6 g-col-xxl-3 box p-5 cursor-pointer zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                        <div class="text-theme-10" style="font-size:20px;font-weight:800;">Customer Details</div>
                        <div class="text-gray-600" style="font-size:20px;font-weight:800;">Sudarsan</div>
                        <div class="mt-6 mt-lg-0 pt-5">
                            <div class="fw-medium text-center text-lg-start " style="font-size:25px;font-weight:800;">4 <i class="fa fa-star" style="color:yellow;"></i></div>
                        </div>
                    </div> -->
                    <div class="g-col-12 g-col-sm-12 g-col-xxl-12 box p-10" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);position:relative;">
                        <div class="mt-5 d-flex align-items-center" style="font-size:clamp(12px, 2Vw, 18px);font-weight:800;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-disc me-5" style="font-size:24px;font-weight:400;color:#59E304;"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="3"></circle></svg>{{ $item->pick_address }}</div>
                        <div class="divider"></div>
                        <div class="mt-5 d-flex align-items-center" style="font-size:clamp(12px, 2Vw, 18px);font-weight:800;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin me-5" style="font-size:24px;font-weight:800;color:red;"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>{{ $item->drop_address }}</div>
                        <div class="d-flex align-items-center text-end p-3 cb-1" style="float:right;color:black;position:relative;z-index:10">
                        <div class="me-5 p-2 box" style="border:1px dashed #7F00FF;"> 
                        @if($item->requestBill)
                        {{ number_format($item->requestBill->total_distance,2) }} {{ $item->unit ? 'km' : 'M' }}
                        @else
                        {{ number_format($item->total_distance,2) }} {{ $item->unit ? 'km' : 'M' }}
                        @endif
                        </div>
                        @if($item->requestBill)
                        <div class="p-2 box" style="border:1px dashed #7F00FF;">{{ $item->requestBill->total_time }} mins</div>
                        @else
                        <div class="p-2 box" style="border:1px dashed #7F00FF;">{{ $item->total_time }} mins</div> 
                        @endif
                       
                        </div>
                        <div class="box p-5">
                          <div id="map" style="height:400px">
                            <img class="img-fluid" src="{{ asset('assets/images/map.jpg') }}" alt="">
                          </div>
                        </div>
                    </div>
                </div>
                </div>
                
            </div>

<div class="box p-5 intro-y mt-10" style="background:#FBFBFB;box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
               
<div class="box p-5 intro-y">
<div class="timeline">
  
@foreach($data as $k=>$v) 
 @php
 if($v->process_type == "create_request")
 {
  $process_type = "Trip Request";
 }
 elseif($v->process_type == "accept"){
  $process_type = "Accepted";
 }
 elseif($v->process_type == "trip_arrived"){
  $process_type = "Trip Arrived";
 }
 elseif($v->process_type == "driver_cancelled"){
  $process_type = "Cancelled By ".$v->dricver_details->name;
 }
 elseif($v->process_type == "decline"){
  $process_type = "Cancelled";
 }
 elseif($v->process_type == "trip_start"){
  $process_type = "Trip Started";
 }
 elseif($v->process_type == "trip_completed"){
  $process_type = "Trip Completed";
 }
 elseif($v->process_type == "driver_system_cancelled"){
  $process_type = "Cancelled by System";
 }
 elseif($v->process_type == "system_cancelled"){
  $process_type = "Request Cancelled by System";
 }
 else{
  $process_type = "";
 }

 @endphp
  @if($v->process_type == "accept" || $v->process_type == "decline" ||  $v->process_type == "driver_system_cancelled") 
  @if($v->orderby_status % 2 == 0)
  
  <div class="container left timeline-data"  style="left:-62px !important" > 
  @else
  <div class="container right timeline-data">
  @endif  
  <img src="{{$v->dricver_details->image}}" class="img-fluid img" width="50px" alt="">
              <!-- <i class="icon fa fa-gift"></i> -->
              <!-- <div class="date">22 Oct</div> -->
              @if($v->orderby_status % 2 == 0)
              <div class="content" style="position: relative;left: -70px;top: 15px;">
              @else
              <div class="content">
              @endif
              
                <div class="d-flex">
                <h2 class=" p-2" style="border-right:2px solid grey">{{$v->dricver_details->name}}</h2>
      <h2 class=" p-2">{{$v->rating}} <i class="fa fa-star" style="color:yellow;"></i></h2>
                </div>
                <p>{{ \Carbon\Carbon::parse($v->created_at)->setTimezone($timezone)->format('d,M Y h:i A') }} </p> 
                @if($v->process_type == "accept")
                <p class="text-center" style="background:#a7ff99;color:green;padding:7px;width:80px;border-radius:6px;">{{$process_type}}</p>
                @else
                <p class="text-center" style="background:#ff9999;color:red;padding:7px;min-width:90px;border-radius:6px;">{{$process_type}}</p>
                @endif 
               

              </div>
            </div>
  @else
  <div class="container right timeline-data data">
  @if($v->process_type == "create_request")
  <img src="" class="img-fluid img" width="50px" alt="">
 @else
 <img src="{{$v->dricver_details->image}}" class="img-fluid img" width="50px" alt="">
 @endif 
    <!-- <i class="icon fa fa-certificate"></i> -->
    @if($v->process_type == "driver_cancelled")
    <div class="date" style="color: red; font-weight: bold;left:-300px">{{$process_type}}</div>
    @else
    <div class="date">{{$process_type}}</div>
    @endif
    
    <div class="content">
      <!-- <div class="d-flex">
      <h2 class=" p-2" style="border-right:2px solid grey">${snap_val.name}</h2>
      <h2 class=" p-2">${snap_val.rating} <i class="fa fa-star" style="color:yellow;"></i></h2>
      </div> -->
      <p style="position: relative; top: 25px;">{{ \Carbon\Carbon::parse($v->created_at)->setTimezone($timezone)->format('d,M y h:i A') }} </p> 
      <!-- <p class="text-center" style="background:#ff9999;color:red;padding:7px;width:80px;border-radius:6px;">Cancel</p> -->
    </div>
  </div>
  @endif 
 
@endforeach  
</div>
                </div>
                <!-- <div class="text-end p-3 cb-1">Action</div> -->
            </div>
        </div>
        <!-- END: Home Side card Menu -->
        <!-- BEGIN: Map Content -->
        <div class="g-col-12 g-col-xl-6 g-col-xxl-6">
            <div class="box p-5 mt-5" style="background:#FBFBFB;box-shadow:  0px 0px 4px 1px rgba(0,0,0,0.3);">
              <div class="d-flex flex-column flex-lg-row pb-5 mx-n5">
                <div class="d-flex flex-1 px-5 align-items-start justify-content-center justify-content-lg-start">
                    <div class="d-flex ms-5">
                        <div class="px-4 ct1" >Vehicle Details</div>
                    </div>
                </div>
              </div>
              <div class="g-col-12 g-col-sm-12 g-col-xxl-3 p-10">
                <div class="row">
                  <div class="col-lg-3"></div>
                  <div class="col-lg-6">
                    <div class="d-flex">
                        <div class="me-auto vd">Plate.No</div>
                        @if($item->driverDetail)
                        <div class="fw-medium vd1">{{ $item->driverDetail->car_number }}</div>
                        @else
                        <div class="fw-medium vd1">---------</div>
                        @endif
                       
                    </div>
                    <div class="d-flex mt-4">
                        <div class="me-auto vd">Type</div>
                        <div class="fw-medium vd1">{{ $item->vehicle_type_name }}</div>
                    </div>
                    <div class="d-flex mt-4">
                        <div class="me-auto vd">Make</div>
                        <div class="fw-medium vd1">{{ $item->make }}</div>
                    </div>
                    <div class="d-flex mt-4">
                        <div class="me-auto vd">Model</div>
                        <div class="fw-medium vd1">{{ $item->model }}</div>
                    </div>
                    <div class="d-flex mt-4">
                        <div class="me-auto vd">Color</div>
                        @if($item->driverDetail)
                        <div class="fw-medium vd1">{{ $item->driverDetail->car_color }}</div>
                        @else
                        <div class="fw-medium vd1">---------</div>
                        @endif 
                    </div>
                  </div>
                  <div class="col-lg-3"></div>
                </div>
              </div>
            </div>
<!-- driver details -->
            <div class="grid columns-12 gap-5 mt-5">
              <div class="g-col-12 g-col-lg-6 g-col-xl-6">
                  <div class="box p-5 mt-5" style="background:#FBFBFB;box-shadow:  0px 0px 4px 1px rgba(0,0,0,0.3);">
                  <div class="d-flex flex-column flex-lg-row pb-5 mx-n5">
                    <div class="d-flex flex-1 px-5 align-items-start justify-content-center justify-content-lg-start">
                        <div class="d-flex ms-5">
                            <div class="px-4 ct1" >Driver Details</div>
                        </div>
                    </div>
                  </div>
                  <div class="g-col-12 g-col-sm-12 g-col-xxl-3 p-10">
                        <div class="d-flex">
                            <i data-feather="user"></i>
                            @if($item->driverDetail)
                        <div class="fw-medium vd1">{{ $item->driverDetail->name }}</div>
                        @else
                        <div class="fw-medium vd1">---------</div>
                        @endif  
                        </div>
                        <div class="d-flex mt-4">
                            <i data-feather="smartphone"></i>
                            @if($item->driverDetail)
                        <div class="fw-medium vd1">{{ $item->driverDetail->mobile }}</div>
                        @else
                        <div class="fw-medium vd1">---------</div>
                        @endif  
                        </div>
                  </div>
                </div>
              </div>
<!-- user details -->
              <div class="g-col-12 g-col-lg-6 g-col-xl-6">
                  <div class="box p-5 mt-5" style="background:#FBFBFB;box-shadow:  0px 0px 4px 1px rgba(0,0,0,0.3);">
                  <div class="d-flex flex-column flex-lg-row pb-5 mx-n5">
                    <div class="d-flex flex-1 px-5 align-items-start justify-content-center justify-content-lg-start">
                        <div class="d-flex ms-5">
                            <div class="px-4 ct1" >User Details</div>
                        </div>
                    </div>
                  </div>
                  <div class="g-col-12 g-col-sm-12 g-col-xxl-3 p-10">
                        <div class="d-flex">
                            <i data-feather="user"></i>
                            <div class="fw-medium vd1 ms-2">{{ $item->userDetail->name }}</div>
                        </div>
                        <div class="d-flex mt-4">
                            <i data-feather="smartphone"></i>
                            <div class="fw-medium vd1 ms-2">{{ $item->userDetail->mobile }}</div>
                        </div>
                  </div>
                </div>
              </div>
<!-- payment details -->
              <div class="g-col-12 g-col-lg-6 g-col-xl-6">
                  <div class="box p-5 mt-5" style="background:#FBFBFB;box-shadow:  0px 0px 4px 1px rgba(0,0,0,0.3);">
                  <div class="d-flex flex-column flex-lg-row pb-5 mx-n5">
                    <div class="d-flex flex-1 px-5 align-items-start justify-content-center justify-content-lg-start">
                        <div class="d-flex ms-5">
                            <div class="px-4 ct1" >Payment Details</div>
                        </div>
                    </div>
                  </div>
                  <?php
                  if($item->payment_opt == 0){
                    $pay_method = 'Card';
                  }elseif($item->payment_opt == 1){
                    $pay_method = 'Cash';
                  }elseif($item->payment_opt == 2){
                    $pay_method = 'Wallet';
                  }else{
                    $pay_method = 'Wallet/Cash';
                  }
                  ?>
                  <div class="g-col-12 g-col-sm-12 g-col-xxl-3 p-10">
                        <div class="d-flex">
                            <div class="me-auto vd">Payment Types</div>
                            <div class="fw-medium vd1 ms-2">{{ $pay_method }}</div>
                        </div>
                        <div class="d-flex mt-4">
                            <div class="me-auto vd">Total Fare</div>
                            <div class="fw-medium vd1 ms-2">{{ $item->requested_currency_symbol }} {{ $item->request_eta_amount }}</div>
                        </div>
                  </div>
                </div>
              </div>
<!-- Rating details -->
              <div class="g-col-12 g-col-lg-6 g-col-xl-6">
                  <div class="box p-5 mt-5" style="background:#FBFBFB;box-shadow:  0px 0px 4px 1px rgba(0,0,0,0.3);">
                  <div class="d-flex flex-column flex-lg-row pb-5 mx-n5">
                    <div class="d-flex flex-1 px-5 align-items-start justify-content-center justify-content-lg-start">
                        <div class="d-flex ms-5">
                            <div class="px-4 ct1" >Ratings</div>
                        </div>
                    </div>
                  </div>
                  <div class="g-col-12 g-col-sm-12 g-col-xxl-3 p-10">
                    <?php
                    $driver_rating = '';
                    $user_rating = '';
                    if($item->user_rated){
                      $driver_rating = str_repeat('<i class="fa fa-star" style="color:yellow"></i>',$item->user_rating);
                    }
                    if($item->driver_rated){
                      $user_rating = str_repeat('<i class="fa fa-star" style="color:yellow"></i>',$item->driver_rating);
                    }
                    ?>
                        <div class="d-flex">
                            <div class="me-auto vd">User</div>
                            <div class="fw-medium vd1 ms-2">{!! $driver_rating !!} </div>
                        </div>
                        <div class="d-flex mt-4">
                            <div class="me-auto vd">Driver</div>
                            <div class="fw-medium vd1 ms-2">{!! $user_rating !!} </div>
                        </div>
                  </div>
                </div>
              </div>
<!-- Trip summary -->
@if($item->requestBill)
              <div class="g-col-12 g-col-lg-12 g-col-xl-12">
                  <div class="box p-5 mt-5" style="background:#FBFBFB;box-shadow:  0px 0px 4px 1px rgba(0,0,0,0.3);">
                  <div class="d-flex flex-column flex-lg-row pb-5 mx-n5">
                    <div class="d-flex flex-1 px-5 align-items-start justify-content-center justify-content-lg-start">
                        <div class="d-flex ms-5">
                            <div class="px-4 ct1" >Trip Summary</div>
                        </div>
                    </div>
                  </div>
                    <div class="p-10 mt-5 vd1">
                      <div class="d-flex">
                          <div class="me-auto">Base Price</div>
                         
                          <div class="fw-medium">{{ $item->requested_currency_symbol }} {{ $item->requestBill->base_price }}</div>
                      </div>
                      <div class="d-flex mt-4">
                          <div class="me-auto">Distance Price</div>
                          <div class="fw-medium">{{ $item->requested_currency_symbol }} {{ $item->requestBill->distance_price }}</div>
                      </div>
                      <div class="d-flex mt-4">
                          <div class="me-auto">Waiting Price({{ $item->requested_currency_symbol }} {{ $item->requestBill->waiting_charge_per_min }} x {{ $item->total_time }})</div>
                          <div class="fw-medium">{{ $item->requested_currency_symbol }} {{ $item->requestBill->waiting_charge }}</div>
                      </div>
                      <div class="d-flex mt-4">
                          <div class="me-auto">Convenience Fee</div>
                          <div class="fw-medium">{{ $item->requested_currency_symbol }} {{ $item->requestBill->admin_commision_with_tax }}</div>
                      </div>
                      <div class="d-flex mt-4 text-theme-6">
                          <div class="me-auto">Discount</div>
                          <div class="fw-medium text-theme-6"> - {{ $item->requested_currency_symbol }} {{ $item->requestBill->promo_discount }}</div>
                      </div>
                      <div class="d-flex mt-4">
                          <div class="me-auto">Tax</div>
                          <div class="fw-medium">{{ $item->requested_currency_symbol }} {{ $item->requestBill->service_tax }}</div>
                      </div>
                      <div class="d-flex mt-4 pt-4 border-top border-gray-200 vd1">
                          <div class="me-auto ">Total Fare</div>
                          <div class="">{{ $item->requested_currency_symbol }} {{ $item->requestBill->total_amount }}</div>
                      </div>
                    </div>
                </div>
              </div>
              @endif
            </div>
        </div>
        <!-- END: Map Content -->
    </div>
    </div>
<!-- end  -->
    </div>
</div>
<script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-messaging.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-database.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-analytics.js"></script>
<script>
  var baseUrl = window.location.protocol + "//" + window.location.hostname + (window.location.port ? ":" + window.location.port : "");
  if(window.location.hostname == "localhost")
  {
      baseUrl+="/super_bidding/public";
  }   

  function removeMarkers(markers) {
    for (i = 0; i < markers.length; i++) {
        markers[i].setMap(null);
    }
  } 
    var pick_lat = {{ $item->pick_lat }};
    var pick_lng = {{ $item->pick_lng }};
    var drop_lat = {{ $item->drop_lat }};
    var drop_lng = {{ $item->drop_lng }};
    function initMap() {
        var iconBase = baseUrl+'/map/icon/';
        var icons = {
            pickup: {
                name: 'Pickup',
                icon: iconBase + '/pickup.png'
            },
            drop: {
                name: 'Drop',
                icon: iconBase + '/drop.png'
            }
        };
        var map = new google.maps.Map(document.getElementById("map"), {
            zoom: 5,
            center: {lat: pick_lat, lng: pick_lng}
        });

        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(pick_lat,pick_lng),
            icon: icons.pickup.icon,
            map: map
        });

        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(drop_lat,drop_lng),
            icon: icons.drop.icon,
            map: map
        });

        var directionsService = new google.maps.DirectionsService();
        var directionsRenderer = new google.maps.DirectionsRenderer({
            map: map,
            suppressMarkers: true // Suppress default markers 
        });

        var request = {
            origin: pick_lat+','+pick_lng,
            destination: drop_lat+','+drop_lng, 
            travelMode: 'DRIVING'
        };

        directionsService.route(request, function(response, status) {
            if (status === 'OK') {
                directionsRenderer.setDirections(response);
            } else {
                window.alert('Directions request failed due to ' + status);
            }
        });
    }
    // initMap(); 
</script>

<script type="text/javascript" src="https://maps.google.com/maps/api/js?key={{get_settings('google_map_key')}}&callback=initMap" async defer></script>
@endsection
@push('scripts-js')
<script>
  jQuery(document).ready(function($){
	var $timeline_block = $('.cd-timeline-block');

	//hide timeline blocks which are outside the viewport
	$timeline_block.each(function(){
		if($(this).offset().top > $(window).scrollTop()+$(window).height()*0.75) {
			$(this).find('.cd-timeline-img, .cd-timeline-content').addClass('is-hidden');
		}
	});

	//on scolling, show/animate timeline blocks when enter the viewport
	$(window).on('scroll', function(){
		$timeline_block.each(function(){
			if( $(this).offset().top <= $(window).scrollTop()+$(window).height()*0.75 && $(this).find('.cd-timeline-img').hasClass('is-hidden') ) {
				$(this).find('.cd-timeline-img, .cd-timeline-content').removeClass('is-hidden').addClass('bounce-in');
			}
		});
	});
});
</script>
<script>  
function timestampToDateString(timestamp) {
  // Convert the timestamp to a Date object
  var date = new Date(timestamp);

  // Extract date components
  var year = date.getFullYear();
  var month = ('0' + (date.getMonth() + 1)).slice(-2); // Months are zero-based
  var day = ('0' + date.getDate()).slice(-2);

  // Extract time components
  var hours = ('0' + date.getHours() % 12 || 12).slice(-2); // Convert to 12-hour format
  var minutes = ('0' + date.getMinutes()).slice(-2);
  var seconds = ('0' + date.getSeconds()).slice(-2);

  // Get AM or PM indicator
  var ampm = date.getHours() >= 12 ? 'PM' : 'AM';

  // Construct the formatted date string
  var dateString = year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':' + seconds + ' ' + ampm;

  return dateString;
}
   var shouldProcessChildAdded = false;
   var shouldProcessSosChildAdded = false;
    var firebaseConfig = {
    apiKey: "{{get_firebase_settings('firebase_api_key')}}",
    authDomain: "{{get_firebase_settings('firebase_auth_domain')}}",
    databaseURL: "{{get_firebase_settings('firebase_db_url')}}",
    projectId: "{{get_firebase_settings('firebase_project_id')}}",
    storageBucket: "{{get_firebase_settings('firebase_storage_bucket')}}",
    messagingSenderId: "{{get_firebase_settings('firebase_messaging_sender_id')}}",
    appId: "{{get_firebase_settings('firebase_app_id')}}",
    measurementId: "{{get_firebase_settings('firebase_measurement_id')}}"
    };
        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);
        firebase.analytics(); 
var database; 
database = firebase.database();
var specificTripRequestId = "19f7ffb1-efb5-45c9-af9a-9017b6c34343"; // Replace with the specific driver ID you want to retrieve 
var triprequest = database.ref('requests').child(specificTripRequestId);
var triprequestmeta = database.ref('request-meta').child(specificTripRequestId); 
var trip_arrived = false;
var is_completed = false;
var cancelled_by_driver = false;
var cancelled_by_user = false;
var trip_start = false; 
  
triprequest.on("value", (snapshot) => { 
  var key = snapshot.key;
    var snap_val = snapshot.val();  
    var lastTimeline = $('.timeline-data:last');
    if (snap_val.request_id !== undefined) {
    if (snap_val.driver_id !== undefined) {
      
      console.log(snap_val.is_completed);
      var html_data = "";
      var formattedDate = timestampToDateString(snap_val.updated_at);
      if (snap_val.is_completed == true) {
        if(!is_completed)
        {
          if (lastTimeline.hasClass('left')) {
        var html_data = `<div class="container right timeline-data">`; 
      }
      else{
        var html_data = `<div class="container right timeline-data" >`;
      }
        html_data+= `  <img src="${snap_val.profile_picture}" class="img-fluid img" width="50px" alt="">
    <!-- <i class="icon fa fa-certificate"></i> -->
    <div class="date">Trip Completed</div>
    <div class="content">
      <!-- <div class="d-flex">
      <h2 class=" p-2" style="border-right:2px solid grey">${snap_val.name}</h2>
      <h2 class=" p-2">${snap_val.rating} <i class="fa fa-star" style="color:yellow;"></i></h2>
      </div> -->
      <p>${formattedDate}</p> 
      <!-- <p class="text-center" style="background:#ff9999;color:red;padding:7px;width:80px;border-radius:6px;">Cancel</p> -->
    </div>
  </div>`;
  is_completed = true;
        }
       
      }
      else if (snap_val.cancelled_by_driver == true) 
      {   
        if(!cancelled_by_driver)
        { 
          // alert(snap_val.request_id);

          firebase.database().ref('requests').child(snap_val.request_id).update({
            cancelled_by_driver: false,
            trip_arrived: 0,
            trip_start: 0
                                });  

                                
        if (lastTimeline.hasClass('left')) {
        var html_data = `<div class="container right timeline-data">`; 
      }
      else{
        var html_data = `<div class="container right timeline-data" >`;
      }
        html_data+= `<img src="${snap_val.profile_picture}" class="img-fluid img" width="50px" alt="" style="border: 2px solid red !important">
    <!-- <i class="icon fa fa-certificate"></i> -->
    <div class="date" style="color: red; font-weight: bold;left:-250px">Cancelled by driver</div>
    <div class="content">
      <!-- <div class="d-flex">
      <h2 class=" p-2" style="border-right:2px solid grey">${snap_val.name}</h2>
      <h2 class=" p-2">${snap_val.rating} <i class="fa fa-star" style="color:yellow;"></i></h2>
      </div> -->
      <p>${formattedDate}</p> 
      <!-- <p class="text-center" style="background:#ff9999;color:red;padding:7px;width:80px;border-radius:6px;">Cancel</p> -->
    </div>
  </div>`;
  setTimeout(function() {
    trip_arrived = false;
  trip_start = false; 
                        }, 3000);
  
      }
    }
      else if (snap_val.cancelled_by_user == true)
      { 
        if(!cancelled_by_user)
        {
          cancelled_by_user = true;
          if (lastTimeline.hasClass('left')) {
        var html_data = `<div class="container right timeline-data">`; 
      }
      else{
        var html_data = `<div class="container right timeline-data" >`;
      }
        html_data+= `<img src="${snap_val.profile_picture}" class="img-fluid img" width="50px" alt="" style="border: 2px solid red !important">
    <!-- <i class="icon fa fa-certificate"></i> -->
    <div class="date" style="color: red; font-weight: bold;left:-250px">Cancelled by User</div>
    <div class="content">
      <!-- <div class="d-flex">
      <h2 class=" p-2" style="border-right:2px solid grey">${snap_val.name}</h2>
      <h2 class=" p-2">${snap_val.rating} <i class="fa fa-star" style="color:yellow;"></i></h2>
      </div> -->
      <p>${formattedDate}</p> 
      <!-- <p class="text-center" style="background:#ff9999;color:red;padding:7px;width:80px;border-radius:6px;">Cancel</p> -->
    </div>
  </div>`;
      }
      }
      else if (snap_val.cancelled_request == true)
      {  
      if (lastTimeline.hasClass('left')) {
        var html_data = `<div class="container right timeline-data">`; 
      }
      else{
        var html_data = `<div class="container right timeline-data" >`;
      }
        html_data+= `<img src="${snap_val.profile_picture}" class="img-fluid img" width="50px" alt="" style="border: 2px solid red !important"> 
    <!-- <i class="icon fa fa-certificate"></i> -->
    <div class="date" style="color: red; font-weight: bold;left:-250px">Cancelled by System</div>
    <div class="content">
      <!-- <div class="d-flex">
      <h2 class=" p-2" style="border-right:2px solid grey">${snap_val.name}</h2>
      <h2 class=" p-2">${snap_val.rating} <i class="fa fa-star" style="color:yellow;"></i></h2>
      </div> -->
      <p>${formattedDate}</p> 
      <!-- <p class="text-center" style="background:#ff9999;color:red;padding:7px;width:80px;border-radius:6px;">Cancel</p> -->
    </div>
  </div>`; 
      }
      else if (snap_val.trip_start == 1) 
      { 
        if(!trip_start)
        {
          trip_start = true;
        if (lastTimeline.hasClass('left')) {
        var html_data = `<div class="container right timeline-data">`; 
      }
      else{
        var html_data = `<div class="container right timeline-data" >`;
      }
        html_data+=`<img src="${snap_val.profile_picture}" class="img-fluid img" width="50px" alt="">
    <!-- <i class="icon fa fa-certificate"></i> -->
    <div class="date">Trip Started</div>
    <div class="content">
      <!-- <div class="d-flex">
      <h2 class=" p-2" style="border-right:2px solid grey">${snap_val.name}</h2>
      <h2 class=" p-2">${snap_val.rating} <i class="fa fa-star" style="color:yellow;"></i></h2>
      </div> -->
      <p>${formattedDate}</p> 
      <!-- <p class="text-center" style="background:#ff9999;color:red;padding:7px;width:80px;border-radius:6px;">Cancel</p> -->
    </div>
  </div>`;
      } 
      } 
      else if (snap_val.trip_arrived == 1) 
      { 
        if(!trip_arrived)
        {
          trip_arrived = true;
        if (lastTimeline.hasClass('left')) {
        var html_data = `<div class="container right timeline-data">`; 
      }
      else{
        var html_data = `<div class="container right timeline-data" >`;
      }
      alert(snap_val.profile_picture);
        html_data+=`<img src="${snap_val.profile_picture}" class="img-fluid img" width="50px" alt=""> 
    <!-- <i class="icon fa fa-certificate"></i> -->
    <div class="date">Trip Arrived</div>
    <div class="content">
      <!-- <div class="d-flex">
      <h2 class=" p-2" style="border-right:2px solid grey">${snap_val.name}</h2>
      <h2 class=" p-2">${snap_val.rating} <i class="fa fa-star" style="color:yellow;"></i></h2>
      </div> -->
      <p>${formattedDate}</p> 
      <!-- <p class="text-center" style="background:#ff9999;color:red;padding:7px;width:80px;border-radius:6px;">Cancel</p> -->
    </div>
  </div>`;
      }  
      }  
      console.log(html_data);
  $(".timeline").append(html_data);
  console.log("html_data --- child changed");
    }
    }

});    
triprequestmeta.on("value", (snapshot) => {
  console.log("Child meta");
  var key = snapshot.key;
    var snap_val = snapshot.val(); 
    var lastTimeline = $('.timeline-data:last');
    if(snap_val !== null && snap_val !== undefined)
    {

    if (snap_val.hasOwnProperty('driver_id')) 
    {
    if(snap_val.driver_id !== null && snap_val.driver_id !== undefined && snap_val.driver_id !== "")
    {
      var formattedDate = timestampToDateString(snap_val.updated_at);
      if(snap_val.is_accepted == 1)
      {
        if (lastTimeline.hasClass('left')) {
          var html_data = `<div class="container right timeline-data">
  <img src="${snap_val.profile_picture}" class="img-fluid img" width="50px" alt=""> 
    <div class="content">
      <div class="d-flex">
      <h2 class=" p-2" style="border-right:2px solid grey">${snap_val.name}</h2>
      <h2 class=" p-2">${snap_val.rating} <i class="fa fa-star" style="color:yellow;"></i></h2>
      </div>
      <p>${formattedDate}</p> 
      <p class="text-center" style="background:#a7ff99;color:green;padding:7px;width:80px;border-radius:6px;">Accepted</p>
    </div>
  </div>`;
        
}
else{
  var html_data = `<div class="container left timeline-data" style="left:-62px !important" >
  <img src="${snap_val.profile_picture}" class="img-fluid img" width="50px" alt="">
    <!-- <i class="icon fa fa-cog"></i> -->
    <!-- <div class="date">10 Feb</div> -->
    <div class="content" style="position: relative;left: -70px;top: 15px;>
      <div class="d-flex">
      <h2 class=" p-2" style="border-right:2px solid grey">${snap_val.name}</h2>
      <h2 class=" p-2">${snap_val.rating} <i class="fa fa-star" style="color:yellow;"></i></h2>
      </div>
      <p>${formattedDate}</p> 
      <p class="text-center" style="background:#a7ff99;color:green;padding:7px;width:80px;border-radius:6px;">Accepted</p>
    </div>
  </div>`;
  
}

      }
        if(snap_val.is_accepted == 0)
        { 
          if (lastTimeline.hasClass('left')) {
            var html_data = `<div class="container right timeline-data">
            <img src="${snap_val.profile_picture}" class="img-fluid img" width="50px" alt="">
              <!-- <i class="icon fa fa-gift"></i> -->
              <!-- <div class="date">22 Oct</div> -->
              <div class="content">
                <div class="d-flex">
                <h2 class=" p-2" style="border-right:2px solid grey">${snap_val.name}</h2>
      <h2 class=" p-2">${snap_val.rating} <i class="fa fa-star" style="color:yellow;"></i></h2>
                </div>
                <p>${formattedDate}</p> 
                <p class="text-center" style="background:#ff9999;color:red;padding:7px;width:80px;border-radius:6px;">Cancelled</p>
              </div>
            </div>`;
          
    }
    else{
    var html_data = `<div class="container left timeline-data" style="left:-62px !important" >
  <img src="${snap_val.profile_picture}" class="img-fluid img" width="50px" alt="">
    <!-- <i class="icon fa fa-cog"></i> -->
    <!-- <div class="date">10 Feb</div> -->
    <div class="content" style="position: relative;left: -70px;top: 15px;>
                <div class="d-flex">
                <h2 class=" p-2" style="border-right:2px solid grey">${snap_val.name}</h2>
      <h2 class=" p-2">${snap_val.rating} <i class="fa fa-star" style="color:yellow;"></i></h2>
                </div>
                <p>${formattedDate}</p> 
                <p class="text-center" style="background:#ff9999;color:red;padding:7px;width:80px;border-radius:6px;">Cancelled</p>
              </div>
            </div>`;

    }
        }
    
  console.log(html_data);
  $(".timeline").append(html_data);
  console.log("html_data");
    } 
    } 
    } 


});   
setTimeout(function() {
    shouldProcessChildAdded = true;
    shouldProcessSosChildAdded = true;
    }, 500);
</script> 


@endsection
@push('scripts-js')
<script>
  jQuery(document).ready(function($){
	var $timeline_block = $('.cd-timeline-block');

	//hide timeline blocks which are outside the viewport
	$timeline_block.each(function(){
		if($(this).offset().top > $(window).scrollTop()+$(window).height()*0.75) {
			$(this).find('.cd-timeline-img, .cd-timeline-content').addClass('is-hidden');
		}
	});

	//on scolling, show/animate timeline blocks when enter the viewport
	$(window).on('scroll', function(){
		$timeline_block.each(function(){
			if( $(this).offset().top <= $(window).scrollTop()+$(window).height()*0.75 && $(this).find('.cd-timeline-img').hasClass('is-hidden') ) {
				$(this).find('.cd-timeline-img, .cd-timeline-content').removeClass('is-hidden').addClass('bounce-in');
			}
		});
	});
});
function myFunction() {
  // Some code...
  debugger; // Execution will pause here
  // More code...
}

myFunction();
</script>
@endpush
        <!-- END: Form Layout -->


