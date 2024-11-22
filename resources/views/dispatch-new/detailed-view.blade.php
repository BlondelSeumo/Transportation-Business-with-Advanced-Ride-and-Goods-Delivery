@extends('dispatch-new.layout')

@section('dispatch-content')

<link rel="stylesheet" href="{{ asset('assets/css/dispatcher/detailed-view.css') }}">
<style>
  .loader {
  position: absolute;
  left: 50%;
  top: 50%;
  z-index: 1;
  width: 150px;
  height: 150px;
  margin: -75px 0 0 -75px;
  border: 5px solid #f3f3f3;
  border-radius: 50%;
  border-top: 5px solid #3498db;
  width: 50px;
  height: 50px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  50% { -webkit-transform: rotate(180deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  50% { -webkit-transform: rotate(180deg); }
  100% { transform: rotate(360deg); }
}
.container.left {
    /* padding-top: 42px; */
    margin-top: 31px !important;
}
.container.right{
  margin-top: 25px !important;
}
.container.left {
    left: -82px;
}
.svg{
  position:absolute;
  top:50%;
  left:50%;
  transform:translate(-50%, -50%);
  max-width:128px;
  max-height:128px;
}
.magnify{
  fill:#405069;
  animation:search 1s infinite ease;
}
.doc{
  fill:#fca503;
  animation:flyby 3s infinite ease-in;
}


@keyframes search {
  0%{
    transform:translate(40px, 40px) scale(.6);
  }
  50%{
    transform:translate(20px, 20px) scale(.6);
  }
  100%{
    transform:translate(40px, 40px) scale(.6);
  }
}

@keyframes flyby {
  0%{
    transform:translate(-20px, 20px) scale(.2);
    opacity:0
  }
  50%{
    transform:translate(30px, 20px) scale(.5);
    opacity:1
  }
  100%{
    transform:translate(100px, 20px) scale(.2);
    opacity:0
  }
}

.container .svg {
    position: absolute;
    display: inline-block;
    width: 60px;
    height: 60px;
    top: 60px;
    left:-1px;
    right: 58px;
    padding: 0px 0;
    background: #ffffff;
    border: 2px solid #f73131;
    border-radius: 50px;
    text-align: center;
    font-size: 30px;
    color: #fca503;
    z-index: 1;
}
  </style>
<div class="g-col-12 g-col-lg-4">
    <div class="grid columns-12 gap-5 mt-5">
        <!-- BEGIN: Driver Side Menu -->
        <div class="g-col-12 g-col-xl-6 g-col-xxl-6">
          <div class="box p-5 intro-y mt-5" style="background:#FBFBFB;box-shadow:  0px 0px 8px 1px rgba(255, 172, 38, 0.3);">
                <div class="d-flex flex-column flex-lg-row pb-5 mx-n5">
                    <div class="d-flex flex-1 px-5 align-items-start justify-content-center justify-content-lg-start">
                        <div class="d-flex ms-5">
                            <div class="px-4 ct1" >@lang('view_pages.ride_information')</div>
                        </div>
                    </div>
                </div>
                <div class="text-end p-2 cb-1" style="color:black;">{{ $item->request_number }}</div>
                <div class=" p-5 intro-y">
                @if($item->is_later)
                <div class="text-end p-2 cb-1" style="color:black;font-size: 13px;">@lang('view_pages.start_time') : {{ $item->converted_trip_start_time }}</div>
                @endif
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
                        <div class="me-5 p-2 box" style="border:1px dashed #fca503;">
                        @if($item->requestBill)
                        {{ number_format($item->requestBill->total_distance,2) }} {{ $item->unit ? 'km' : 'M' }}
                        @else
                        {{ number_format($item->total_distance,2) }} {{ $item->unit ? 'km' : 'M' }}
                        @endif
                        </div>
                        @if($item->requestBill)
                        <div class="p-2 box" style="border:1px dashed #fca503;">{{ $item->requestBill->total_time }} mins</div>
                        @else
                        <div class="p-2 box" style="border:1px dashed #fca503;">{{ $item->total_time }} mins</div>
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
@if(!$item->instant_ride);

<div class="box p-5 intro-y mt-10" style="background:#FBFBFB;box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
<div class="box p-5 intro-y">
<div class="timeline">

@foreach($data as $k=>$v)


 @php
 $process_type = "";

 if($v->process_type == "create_request")
 {
  $process_type = "Ride Created";
 }
 elseif($v->process_type == "accept"){
  $process_type = "Accepted";
 }
 elseif($v->process_type == "trip_arrived"){
  $process_type = "Trip Arrived";
 }
 elseif($v->process_type == "driver_cancelled"){
  $process_type = "Cancelled By Driver";
 }
 elseif($v->process_type == "decline"){
  $process_type = "Rejected";
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
 elseif($v->process_type == "user_cancelled"){
  $process_type = "Cancelled by User";
 }
 elseif($v->process_type == "auto_cancelled"){
  $process_type = "Cancelled Due to no driver";
 }
 else{
  $process_type = "";
 }

 @endphp
  @if($v->process_type == "accept" || $v->process_type == "decline" ||  $v->process_type == "driver_system_cancelled")
  @if($v->orderby_status % 2 == 0)

  <div class="container left timeline-data"  >
  @else
  <div class="container right timeline-data">
  @endif
  <img src="{{$v->dricver_details ? $v->dricver_details->image : asset('assets/images/default-profile-picture.png') }}" class="img-fluid img" width="50px" alt="">
              <!-- <i class="icon fa fa-gift"></i> -->
              <!-- <div class="date">22 Oct</div> -->
              @if($v->orderby_status % 2 == 0)
              <div class="content" style="position: relative;left: -70px;top: 15px;">
              @else
              <div class="content">
              @endif

                <div class="d-flex">
                <h2 class=" p-2" style="border-right:2px solid grey">{{$v->dricver_details ? $v->dricver_details->name : '----' }}</h2>
      <h2 class=" p-2">{{$v->rating}} <i class="fa fa-star" style="color:yellow;"></i></h2>
                </div>
                <p>{{ \Carbon\Carbon::parse($v->created_at)->setTimezone($timezone)->format('d,M Y h:i A') }} </p>
                @if($v->process_type == "accept")
                <p class="text-center" style="background:#a7ff99;color:green;padding:7px;width:80px;border-radius:6px;">{{$process_type}}</p>
                @else
                <p class="text-center" style="background:#ff9999;color:red;padding:7px;width:100px;border-radius:6px;">{{$process_type}}</p>
                @endif


              </div>
            </div>
  @else
  <div class="container right timeline-data data">
  @if($v->process_type == "create_request")
  <img src="{{$v->user_image}}" class="img-fluid img" width="50px" alt="">
 @else
 <img src="{{$v->dricver_details ? $v->dricver_details->image : asset('assets/images/default-profile-picture.png') }}" class="img-fluid img" width="50px" alt="">
 @endif
    <!-- <i class="icon fa fa-certificate"></i> -->
    @if($v->process_type == "driver_cancelled" || $v->process_type == "user_cancelled" || $v->process_type == "auto_cancelled")
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
            </div>
            @endif
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
                        <div class="fw-medium vd1"><a href="tel:{{ $item->driverDetail->mobile }}">{{ $demo=='demo' ? '***********' : $item->driverDetail->mobile }}</a></div>
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
                            <div class="fw-medium vd1 ms-2">{{ $item->userDetail ? $item->userDetail->name : $item->adHocuserDetail->name  }}</div>
                        </div>
                        <div class="d-flex mt-4">
                            <i data-feather="smartphone"></i>
                            <div class="fw-medium vd1 ms-2">{{ $demo=='demo' ? '***********' : ( $item->userDetail ? $item->userDetail->mobile : $item->adHocuserDetail->mobile) }}</div>
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
                            @if($item->requestBill)
                            <div class="fw-medium vd1 ms-2">{{ $item->requested_currency_symbol }} {{ $item->requestBill->total_amount }}</div>
                            @else
                            <div class="fw-medium vd1 ms-2">{{ $item->requested_currency_symbol }} --</div>
                            @endif
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
                          <div class="me-auto "><strong>Total Fare</strong></div>
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
          apiKey: "{{get_settings('firebase-api-key')}}",
          authDomain: "{{get_settings('firebase-auth-domain')}}",
          databaseURL: "{{get_settings('firebase-db-url')}}",
          projectId: "{{get_settings('firebase-project-id')}}",
          storageBucket: "{{get_settings('firebase-storage-bucket')}}",
          messagingSenderId: "{{get_settings('firebase-messaging-sender-id')}}",
          appId: "{{get_settings('firebase-app-id')}}",
          measurementId: "{{get_settings('firebase-measurement-id')}}"
    };
        // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    firebase.analytics();
var database;
var picture = "{{ asset('assets/images/default-profile-picture.png') }}";
database = firebase.database();
var specificTripRequestId = "{{ $item->id }}"; // Replace with the specific driver ID you want to retrieve
var triprequest = database.ref('requests').child(specificTripRequestId);
var triprequestmeta = database.ref('request-meta').child(specificTripRequestId);
var trip_arrived = false;
var is_completed = false;
var cancelled_by_driver = false;
var cancelled_by_user = false;
var trip_start = false;

triprequest.on("value", (snapshot) => {
  if(shouldProcessChildAdded){
  var key = snapshot.key;
    var snap_val = snapshot.val();
    var lastTimeline = $('.timeline-data:last');
    if (snap_val.request_id !== undefined) {
    if (snap_val.driver_id !== undefined) {

      var html_data = "";
      var formattedDate = timestampToDateString(snap_val.updated_at);
      if(snap_val.profile_picture){
        picture = snap_val.profile_picture;
      }
      if (snap_val.is_completed == true) {
        if(!is_completed)
        {
          if (lastTimeline.hasClass('left')) {
        var html_data = `<div class="container right timeline-data">`;
      }
      else{
        var html_data = `<div class="container right timeline-data" >`;
      }
        html_data+= `  <img src="${picture}" class="img-fluid img" width="50px" alt="">
    <!-- <i class="icon fa fa-certificate"></i> -->
    <div class="date">Trip Completed</div>
    <div class="content">
      <!-- <div class="d-flex">
      <h2 class=" p-2" style="border-right:2px solid grey">${snap_val.name}</h2>
      <h2 class=" p-2">${snap_val.rating} <i class="fa fa-star" style="color:yellow;"></i></h2>
      </div> -->
      <p style="position: relative; top: 25px;">${formattedDate}</p>
      <!-- <p class="text-center" style="background:#ff9999;color:red;padding:7px;width:80px;border-radius:6px;">Cancel</p> -->
    </div>
  </div>`;
  is_completed = true;
  window.location.reload();
        }

      }
      else if (snap_val.cancelled_by_driver == true)
      {
        // alert(formattedDate);
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
        html_data+= `<img src="${picture}" class="img-fluid img" width="50px" alt="" style="border: 2px solid red !important">
    <!-- <i class="icon fa fa-certificate"></i> -->
    <div class="date" style="color: red; font-weight: bold;left:-250px">Cancelled by Driver</div>
    <div class="content">
      <!-- <div class="d-flex">
      <h2 class=" p-2" style="border-right:2px solid grey">${snap_val.name}</h2>
      <h2 class=" p-2">${snap_val.rating} <i class="fa fa-star" style="color:yellow;"></i></h2>
      </div> -->
      <p style="position:relative;top:25px">${formattedDate}</p>
      <!-- <p class="text-center" style="background:#ff9999;color:red;padding:7px;width:80px;border-radius:6px;">Cancel</p> -->
    </div>
  </div>`;
  setTimeout(function() {
    trip_arrived = false;
  trip_start = false;
                        }, 3000);

                        var html_data1 = `<div class="container right timeline-data" id="loading-data">
  <svg class="svg" viewbox="0 0 128 128" width="100%" height="100%">
<svg class="doc" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="-41 -41 492.00 492.00" xml:space="preserve" width="100px" height="100px" fill="#5d32d2" stroke="#5d32d2" stroke-width="2.05" transform="rotate(0)"><g id="SVGRepo_bgCarrier" stroke-width="0"></g>
<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="2.46"></g><g id="SVGRepo_iconCarrier"> <g id="XMLID_1835_"> <path id="XMLID_1850_" style="fill:#FFDA44;" d="M75,232.5c13.326,0,25.294,5.797,33.534,15.002H170V247.5v-30v-100h-40H70l-30,70 H0v30h30v30H0v0.002h41.466C49.706,238.297,61.674,232.5,75,232.5z M89.782,147.5H155v40H72.639L89.782,147.5z"></path> <rect id="XMLID_1853_" x="170" y="247.5" style="fill:#FF9811;" width="30" height="0.002"></rect>
<path id="XMLID_1854_" style="fill:#FF9811;" d="M320,187.5l-50-70h-60h-40v100h30v30h30v-30h30v30h-30v0.002h71.466 c8.24-9.205,20.208-15.002,33.534-15.002s25.294,5.797,33.534,15.002H410V247.5h-20l-10-30h30v-10L320,187.5z M185,187.5v-40 h69.561l28.571,40H185z"></path> <path id="XMLID_1857_" style="fill:#ACABB1;" d="M0,247.502V277.5h30c0-11.527,4.339-22.037,11.466-29.998H0z"></path> <path id="XMLID_1858_" style="fill:#ACABB1;" d="M170,247.502h-61.466C115.661,255.463,120,265.973,120,277.5h80v-29.998H170z"></path>
 <path id="XMLID_1859_" style="fill:#ACABB1;" d="M230,247.502V277.5h60c0-11.527,4.339-22.037,11.466-29.998H230z"></path> <path id="XMLID_1860_" style="fill:#ACABB1;" d="M380,277.5h30v-29.998h-41.466C375.661,255.463,380,265.973,380,277.5z"></path> <path id="XMLID_1861_" style="fill:#616064;" d="M52.5,277.5c0-12.427,10.073-22.5,22.5-22.5v-22.5 c-13.326,0-25.294,5.797-33.534,15.002C34.339,255.463,30,265.973,30,277.5c0,24.853,20.147,45,45,45V300 C62.573,300,52.5,289.927,52.5,277.5z"></path> <path id="XMLID_1862_" style="fill:#565659;" d="M75,232.5V255c12.427,0,22.5,10.073,22.5,22.5S87.427,300,75,300v22.5 c24.852,0,45-20.147,45-45c0-11.527-4.339-22.037-11.466-29.998C100.294,238.297,88.326,232.5,75,232.5z"></path> <path id="XMLID_1863_" style="fill:#CDCDD0;" d="M52.5,277.5c0,12.427,10.073,22.5,22.5,22.5v-45 C62.573,255,52.5,265.073,52.5,277.5z"></path>
 <path id="XMLID_1864_" style="fill:#ACABB1;" d="M75,300c12.427,0,22.5-10.073,22.5-22.5S87.427,255,75,255V300z"></path> <path id="XMLID_1865_" style="fill:#616064;" d="M312.5,277.5c0-12.427,10.073-22.5,22.5-22.5v-22.5 c-13.326,0-25.294,5.797-33.534,15.002C294.339,255.463,290,265.973,290,277.5c0,24.853,20.147,45,45,45V300 C322.573,300,312.5,289.927,312.5,277.5z"></path> <path id="XMLID_1866_" style="fill:#565659;" d="M335,232.5V255c12.427,0,22.5,10.073,22.5,22.5S347.427,300,335,300v22.5 c24.852,0,45-20.147,45-45c0-11.527-4.339-22.037-11.466-29.998C360.294,238.297,348.326,232.5,335,232.5z"></path> <path id="XMLID_1867_" style="fill:#CDCDD0;" d="M312.5,277.5c0,12.427,10.073,22.5,22.5,22.5v-45 C322.573,255,312.5,265.073,312.5,277.5z"></path> <path id="XMLID_1868_" style="fill:#ACABB1;" d="M335,300c12.427,0,22.5-10.073,22.5-22.5S347.427,255,335,255V300z"></path>
 <polygon id="XMLID_1869_" style="fill:#FFFFFF;" points="155,147.5 89.782,147.5 72.639,187.5 155,187.5 "></polygon> <polygon id="XMLID_1870_" style="fill:#FFFFFF;" points="185,147.5 185,187.5 283.133,187.5 254.561,147.5 "></polygon> <rect id="XMLID_1871_" y="217.5" style="fill:#FF5023;" width="30" height="30"></rect> <polygon id="XMLID_1872_" style="fill:#FF5023;" points="390,247.5 410,247.5 410,217.5 380,217.5 "></polygon> <polygon id="XMLID_1873_" style="fill:#565659;" points="210,117.5 210,87.5 130,87.5 130,117.5 170,117.5 "></polygon> <rect id="XMLID_1874_" x="170" y="217.5" style="fill:#565659;" width="30" height="30"></rect> <polygon id="XMLID_1875_" style="fill:#565659;" points="230,247.5 200,247.5 200,247.502 200,277.5 230,277.5 230,247.502 "></polygon> <rect id="XMLID_1876_" x="230" y="217.5" style="fill:#565659;" width="30" height="30"></rect> </g> </g>
</svg>

<path class="magnify" d="M38.948,10.429c-18.254,10.539-24.468,33.953-14.057,51.986,9.229,15.984,28.649,22.764,45.654,16.763-0.84868,2.6797-0.61612,5.6834,0.90656,8.3207l17.309,29.98c2.8768,4.9827,9.204,6.6781,14.187,3.8013,4.9827-2.8768,6.6781-9.204,3.8013-14.187l-17.31-29.977c-1.523-2.637-4.008-4.34-6.753-4.945,13.7-11.727,17.543-31.935,8.31-47.919-10.411-18.034-33.796-24.359-52.049-13.82zm6.902,11.955c11.489-6.633,26.133-2.7688,32.893,8.9404,6.7603,11.709,2.7847,26.324-8.704,32.957-11.489,6.632-26.133,2.768-32.893-8.941-6.761-11.709-2.785-26.324,8.704-32.957z"/>
</svg>
<div class="date" style="left:-240px;font-weight: bold;">Searching for driver</div>
    <div class="content">
    <p>${formattedDate}</p>
    </div>
  </div>`;

      }
    }
      else if (snap_val.cancelled_by_user == true)
      {
        if(!cancelled_by_user)
        {
          $("#loading-data").remove();
          cancelled_by_user = true;
          if (lastTimeline.hasClass('left')) {
        var html_data = `<div class="container right timeline-data">`;
      }
      else{
        var html_data = `<div class="container right timeline-data" >`;
      }
      @if($item->userDetail)
      var name = "{{ $item->userDetail->name }}";
      var profile_picture = "{{ $item->userDetail->profile_picture }}";
      @else
      var name = "{{ $item->adhocUserDetail->name }}";
      var profile_picture = "{{ asset('assets/images/default-profile-picture.png') }}";
      @endif
        html_data+= `<img src="${profile_picture}" class="img-fluid img" width="50px" alt="" style="border: 2px solid red !important">
    <!-- <i class="icon fa fa-certificate"></i> -->
    <div class="date" style="color: red; font-weight: bold;left:-250px">Cancelled by User</div>
    <div class="content">
      <!-- <div class="d-flex">
      <h2 class=" p-2" style="border-right:2px solid grey">${snap_val.name}</h2>
      <h2 class=" p-2">${snap_val.rating} <i class="fa fa-star" style="color:yellow;"></i></h2>
      </div> -->
      <p style="position: relative; top: 25px;">${formattedDate}</p>
      <!-- <p class="text-center" style="background:#ff9999;color:red;padding:7px;width:80px;border-radius:6px;">Cancel</p> -->
    </div>
  </div>`;
      }
      }
      else if (snap_val.is_cancel == true)
      {
      if (lastTimeline.hasClass('left')) {
        var html_data = `<div class="container right timeline-data">`;
      }
      else{
        var html_data = `<div class="container right timeline-data" >`;
      }
        html_data+= `<img src="${picture}" class="img-fluid img" width="50px" alt="" style="border: 2px solid red !important">
    <!-- <i class="icon fa fa-certificate"></i> -->
    <div class="date" style="color: red; font-weight: bold;left:-250px">Cancelled Due to no driver</div>
    <div class="content">
      <!-- <div class="d-flex">
      <h2 class=" p-2" style="border-right:2px solid grey">${snap_val.name}</h2>
      <h2 class=" p-2">${snap_val.rating} <i class="fa fa-star" style="color:yellow;"></i></h2>
      </div> -->
      <p style="position: relative; top: 25px;">${formattedDate}</p>
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
        html_data+=`<img src="${picture}" class="img-fluid img" width="50px" alt="">
    <!-- <i class="icon fa fa-certificate"></i> -->
    <div class="date">Trip Started</div>
    <div class="content">
      <!-- <div class="d-flex">
      <h2 class=" p-2" style="border-right:2px solid grey">${snap_val.name}</h2>
      <h2 class=" p-2">${snap_val.rating} <i class="fa fa-star" style="color:yellow;"></i></h2>
      </div> -->
      <p style="position: relative; top: 25px;">${formattedDate}</p>
      <!-- <p class="text-center" style="background:#ff9999;color:red;padding:7px;width:80px;border-radius:6px;">Cancel</p> -->
    </div>
  </div>`;
      }
      }
      else if (snap_val.trip_arrived == 1)
      {
        if(!trip_arrived)
        {
          firebase.database().ref('requests').child(snap_val.request_id).update({
            trip_arrived: 0
                                });
          trip_arrived = true;
        if (lastTimeline.hasClass('left')) {
        var html_data = `<div class="container right timeline-data">`;
      }
      else{
        var html_data = `<div class="container right timeline-data" >`;
      }
      // alert(picture);
        html_data+=`<img src="${picture}" class="img-fluid img" width="50px" alt="">
    <!-- <i class="icon fa fa-certificate"></i> -->
    <div class="date">Trip Arrived</div>
    <div class="content">
      <!-- <div class="d-flex">
      <h2 class=" p-2" style="border-right:2px solid grey">${snap_val.name}</h2>
      <h2 class=" p-2">${snap_val.rating} <i class="fa fa-star" style="color:yellow;"></i></h2>
      </div> -->
      <p style="position: relative; top: 25px;">${formattedDate}</p>
      <!-- <p class="text-center" style="background:#ff9999;color:red;padding:7px;width:80px;border-radius:6px;">Cancel</p> -->
    </div>
  </div>`;
      }
      }
  $(".timeline").append(html_data);
  $(".timeline").append(html_data1);
  console.log("html_data --- child changed");
  var timelineDataElements = document.getElementsByClassName('timeline-data');
if (timelineDataElements.length > 0) {
    var lastTimelineData = timelineDataElements[timelineDataElements.length - 1];
    // Scroll the last timeline data element into view
    lastTimelineData.scrollIntoView({ behavior: 'smooth', block: 'end' });
} else {
    console.error("No element with class 'timeline-data' found.");
}
    }
    }
  }
});
triprequestmeta.on("value", (snapshot) => {
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
                        <img src="${picture}" class="img-fluid img" width="50px" alt="">
                          <div class="content">
                            <div class="d-flex">
                            <h2 class=" p-2" style="border-right:2px solid grey">${snap_val.name}</h2>
                            <h2 class=" p-2">${snap_val.rating} <i class="fa fa-star" style="color:yellow;"></i></h2>
                            </div>
                            <p >${formattedDate}</p>
                            <p class="text-center" style="background:#a7ff99;color:green;padding:7px;width:80px;border-radius:6px;">Accepted</p>
                          </div>
                        </div>`;

    }
else{
  var html_data = `<div class="container left timeline-data"  >
  <img src="${picture}" class="img-fluid img" width="50px" alt="">
    <!-- <i class="icon fa fa-cog"></i> -->
    <!-- <div class="date">10 Feb</div> -->
    <div class="content" style="position: relative;left: -70px;top: 15px;">
      <div class="d-flex">
      <h2 class=" p-2" style="border-right:2px solid grey">${snap_val.name}</h2>
      <h2 class=" p-2">${snap_val.rating} <i class="fa fa-star" style="color:yellow;"></i></h2>
      </div>
      <p >${formattedDate}</p>
      <p class="text-center" style="background:#a7ff99;color:green;padding:7px;width:80px;border-radius:6px;">Accepted</p>
    </div>
  </div>`;

}
$("#loading-data").remove();

      }
        if(snap_val.is_accepted == 0)
        {
          $("#loading-data").remove();
          if (lastTimeline.hasClass('left')) {
            var html_data = `<div class="container right timeline-data">
            <img src="${picture}" class="img-fluid img" width="50px" alt="">
              <!-- <i class="icon fa fa-gift"></i> -->
              <!-- <div class="date">22 Oct</div> -->
              <div class="content">
                <div class="d-flex">
                <h2 class=" p-2" style="border-right:2px solid grey">${snap_val.name}</h2>
      <h2 class=" p-2">${snap_val.rating} <i class="fa fa-star" style="color:yellow;"></i></h2>
                </div>
                <p >${formattedDate}</p>
                <p class="text-center" style="background:#ff9999;color:red;padding:7px;width:100px;border-radius:6px;">Rejected</p>
              </div>
            </div>`;

    }
    else{
    var html_data = `<div class="container left timeline-data">
  <img src="${picture}" class="img-fluid img" width="50px" alt="">
    <!-- <i class="icon fa fa-cog"></i> -->
    <!-- <div class="date">10 Feb</div> -->
    <div class="content" style="position: relative;left: -70px;top: 15px;">
                <div class="d-flex">
                <h2 class=" p-2" style="border-right:2px solid grey">${snap_val.name}</h2>
      <h2 class=" p-2">${snap_val.rating} <i class="fa fa-star" style="color:yellow;"></i></h2>
                </div>
                <p>${formattedDate}</p>
                <p class="text-center" style="background:#ff9999;color:red;padding:7px;width:80px;border-radius:6px;">Rejected</p>
              </div>
            </div>`;

    }
    var html_data1 = `<div class="container right timeline-data" id="loading-data">
  <svg class="svg" viewbox="0 0 128 128" width="100%" height="100%">
<svg class="doc" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="-41 -41 492.00 492.00" xml:space="preserve" width="100px" height="100px" fill="#5d32d2" stroke="#5d32d2" stroke-width="2.05" transform="rotate(0)"><g id="SVGRepo_bgCarrier" stroke-width="0"></g>
<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="2.46"></g><g id="SVGRepo_iconCarrier"> <g id="XMLID_1835_"> <path id="XMLID_1850_" style="fill:#FFDA44;" d="M75,232.5c13.326,0,25.294,5.797,33.534,15.002H170V247.5v-30v-100h-40H70l-30,70 H0v30h30v30H0v0.002h41.466C49.706,238.297,61.674,232.5,75,232.5z M89.782,147.5H155v40H72.639L89.782,147.5z"></path> <rect id="XMLID_1853_" x="170" y="247.5" style="fill:#FF9811;" width="30" height="0.002"></rect>
<path id="XMLID_1854_" style="fill:#FF9811;" d="M320,187.5l-50-70h-60h-40v100h30v30h30v-30h30v30h-30v0.002h71.466 c8.24-9.205,20.208-15.002,33.534-15.002s25.294,5.797,33.534,15.002H410V247.5h-20l-10-30h30v-10L320,187.5z M185,187.5v-40 h69.561l28.571,40H185z"></path> <path id="XMLID_1857_" style="fill:#ACABB1;" d="M0,247.502V277.5h30c0-11.527,4.339-22.037,11.466-29.998H0z"></path> <path id="XMLID_1858_" style="fill:#ACABB1;" d="M170,247.502h-61.466C115.661,255.463,120,265.973,120,277.5h80v-29.998H170z"></path>
 <path id="XMLID_1859_" style="fill:#ACABB1;" d="M230,247.502V277.5h60c0-11.527,4.339-22.037,11.466-29.998H230z"></path> <path id="XMLID_1860_" style="fill:#ACABB1;" d="M380,277.5h30v-29.998h-41.466C375.661,255.463,380,265.973,380,277.5z"></path> <path id="XMLID_1861_" style="fill:#616064;" d="M52.5,277.5c0-12.427,10.073-22.5,22.5-22.5v-22.5 c-13.326,0-25.294,5.797-33.534,15.002C34.339,255.463,30,265.973,30,277.5c0,24.853,20.147,45,45,45V300 C62.573,300,52.5,289.927,52.5,277.5z"></path> <path id="XMLID_1862_" style="fill:#565659;" d="M75,232.5V255c12.427,0,22.5,10.073,22.5,22.5S87.427,300,75,300v22.5 c24.852,0,45-20.147,45-45c0-11.527-4.339-22.037-11.466-29.998C100.294,238.297,88.326,232.5,75,232.5z"></path> <path id="XMLID_1863_" style="fill:#CDCDD0;" d="M52.5,277.5c0,12.427,10.073,22.5,22.5,22.5v-45 C62.573,255,52.5,265.073,52.5,277.5z"></path>
 <path id="XMLID_1864_" style="fill:#ACABB1;" d="M75,300c12.427,0,22.5-10.073,22.5-22.5S87.427,255,75,255V300z"></path> <path id="XMLID_1865_" style="fill:#616064;" d="M312.5,277.5c0-12.427,10.073-22.5,22.5-22.5v-22.5 c-13.326,0-25.294,5.797-33.534,15.002C294.339,255.463,290,265.973,290,277.5c0,24.853,20.147,45,45,45V300 C322.573,300,312.5,289.927,312.5,277.5z"></path> <path id="XMLID_1866_" style="fill:#565659;" d="M335,232.5V255c12.427,0,22.5,10.073,22.5,22.5S347.427,300,335,300v22.5 c24.852,0,45-20.147,45-45c0-11.527-4.339-22.037-11.466-29.998C360.294,238.297,348.326,232.5,335,232.5z"></path> <path id="XMLID_1867_" style="fill:#CDCDD0;" d="M312.5,277.5c0,12.427,10.073,22.5,22.5,22.5v-45 C322.573,255,312.5,265.073,312.5,277.5z"></path> <path id="XMLID_1868_" style="fill:#ACABB1;" d="M335,300c12.427,0,22.5-10.073,22.5-22.5S347.427,255,335,255V300z"></path>
 <polygon id="XMLID_1869_" style="fill:#FFFFFF;" points="155,147.5 89.782,147.5 72.639,187.5 155,187.5 "></polygon> <polygon id="XMLID_1870_" style="fill:#FFFFFF;" points="185,147.5 185,187.5 283.133,187.5 254.561,147.5 "></polygon> <rect id="XMLID_1871_" y="217.5" style="fill:#FF5023;" width="30" height="30"></rect> <polygon id="XMLID_1872_" style="fill:#FF5023;" points="390,247.5 410,247.5 410,217.5 380,217.5 "></polygon> <polygon id="XMLID_1873_" style="fill:#565659;" points="210,117.5 210,87.5 130,87.5 130,117.5 170,117.5 "></polygon> <rect id="XMLID_1874_" x="170" y="217.5" style="fill:#565659;" width="30" height="30"></rect> <polygon id="XMLID_1875_" style="fill:#565659;" points="230,247.5 200,247.5 200,247.502 200,277.5 230,277.5 230,247.502 "></polygon> <rect id="XMLID_1876_" x="230" y="217.5" style="fill:#565659;" width="30" height="30"></rect> </g> </g>
</svg>

<path class="magnify" d="M38.948,10.429c-18.254,10.539-24.468,33.953-14.057,51.986,9.229,15.984,28.649,22.764,45.654,16.763-0.84868,2.6797-0.61612,5.6834,0.90656,8.3207l17.309,29.98c2.8768,4.9827,9.204,6.6781,14.187,3.8013,4.9827-2.8768,6.6781-9.204,3.8013-14.187l-17.31-29.977c-1.523-2.637-4.008-4.34-6.753-4.945,13.7-11.727,17.543-31.935,8.31-47.919-10.411-18.034-33.796-24.359-52.049-13.82zm6.902,11.955c11.489-6.633,26.133-2.7688,32.893,8.9404,6.7603,11.709,2.7847,26.324-8.704,32.957-11.489,6.632-26.133,2.768-32.893-8.941-6.761-11.709-2.785-26.324,8.704-32.957z"/>
</svg>
    <div class="date" style="left:-240px;font-weight: bold;">Searching for driver</div>
    <div class="content">
    <p>${formattedDate}</p>
    </div>
  </div>`;

        }

  $(".timeline").append(html_data);
  $(".timeline").append(html_data1);
  var timelineDataElements = document.getElementsByClassName('timeline-data');
if (timelineDataElements.length > 0) {
    var lastTimelineData = timelineDataElements[timelineDataElements.length - 1];
    // Scroll the last timeline data element into view
    lastTimelineData.scrollIntoView({ behavior: 'smooth', block: 'end' });
} else {
    console.error("No element with class 'timeline-data' found.");
}
    }
    }
    }


});
@if(!$item->is_completed && $item->is_cancelled)
setTimeout(function() {
    shouldProcessChildAdded = true;
    shouldProcessSosChildAdded = true;
    }, 2000);
@endif
  var baseUrl = "{{url('/')}}";

  function removeMarkers(markers) {
    for (i = 0; i < markers.length; i++) {
        markers[i].setMap(null);
    }
  }
    var pick_lat = {{ $item->pick_lat }};
    var pick_lng = {{ $item->pick_lng }};
    var drop_lat = {{ $item->drop_lat ?? 0 }};
    var drop_lng = {{ $item->drop_lng ?? 0 }};
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
        if(typeof drop_lat!== 0){
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
                } 
            });
        }
    }
    function getCurrentDateTime() {
  const now = new Date();
  const year = now.getFullYear();
  const month = String(now.getMonth() + 1).padStart(2, '0');
  const day = String(now.getDate()).padStart(2, '0');
  let hours = now.getHours();
  const am_pm = hours >= 12 ? 'PM' : 'AM';
  hours = hours % 12 || 12; // Convert to 12-hour format
  const minutes = String(now.getMinutes()).padStart(2, '0');

  return `${year}-${month}-${day} ${hours}:${minutes} ${am_pm}`;
}
const currentDateTime = getCurrentDateTime();
  $(document).ready(function(){
    @if(count($data) == 1)

    var html_data1 = `<div class="container right timeline-data" id="loading-data">
  <svg class="svg" viewbox="0 0 128 128" width="100%" height="100%">
<svg class="doc" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="-41 -41 492.00 492.00" xml:space="preserve" width="100px" height="100px" fill="#5d32d2" stroke="#5d32d2" stroke-width="2.05" transform="rotate(0)"><g id="SVGRepo_bgCarrier" stroke-width="0"></g>
<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="2.46"></g><g id="SVGRepo_iconCarrier"> <g id="XMLID_1835_"> <path id="XMLID_1850_" style="fill:#FFDA44;" d="M75,232.5c13.326,0,25.294,5.797,33.534,15.002H170V247.5v-30v-100h-40H70l-30,70 H0v30h30v30H0v0.002h41.466C49.706,238.297,61.674,232.5,75,232.5z M89.782,147.5H155v40H72.639L89.782,147.5z"></path> <rect id="XMLID_1853_" x="170" y="247.5" style="fill:#FF9811;" width="30" height="0.002"></rect>
<path id="XMLID_1854_" style="fill:#FF9811;" d="M320,187.5l-50-70h-60h-40v100h30v30h30v-30h30v30h-30v0.002h71.466 c8.24-9.205,20.208-15.002,33.534-15.002s25.294,5.797,33.534,15.002H410V247.5h-20l-10-30h30v-10L320,187.5z M185,187.5v-40 h69.561l28.571,40H185z"></path> <path id="XMLID_1857_" style="fill:#ACABB1;" d="M0,247.502V277.5h30c0-11.527,4.339-22.037,11.466-29.998H0z"></path> <path id="XMLID_1858_" style="fill:#ACABB1;" d="M170,247.502h-61.466C115.661,255.463,120,265.973,120,277.5h80v-29.998H170z"></path>
 <path id="XMLID_1859_" style="fill:#ACABB1;" d="M230,247.502V277.5h60c0-11.527,4.339-22.037,11.466-29.998H230z"></path> <path id="XMLID_1860_" style="fill:#ACABB1;" d="M380,277.5h30v-29.998h-41.466C375.661,255.463,380,265.973,380,277.5z"></path> <path id="XMLID_1861_" style="fill:#616064;" d="M52.5,277.5c0-12.427,10.073-22.5,22.5-22.5v-22.5 c-13.326,0-25.294,5.797-33.534,15.002C34.339,255.463,30,265.973,30,277.5c0,24.853,20.147,45,45,45V300 C62.573,300,52.5,289.927,52.5,277.5z"></path> <path id="XMLID_1862_" style="fill:#565659;" d="M75,232.5V255c12.427,0,22.5,10.073,22.5,22.5S87.427,300,75,300v22.5 c24.852,0,45-20.147,45-45c0-11.527-4.339-22.037-11.466-29.998C100.294,238.297,88.326,232.5,75,232.5z"></path> <path id="XMLID_1863_" style="fill:#CDCDD0;" d="M52.5,277.5c0,12.427,10.073,22.5,22.5,22.5v-45 C62.573,255,52.5,265.073,52.5,277.5z"></path>
 <path id="XMLID_1864_" style="fill:#ACABB1;" d="M75,300c12.427,0,22.5-10.073,22.5-22.5S87.427,255,75,255V300z"></path> <path id="XMLID_1865_" style="fill:#616064;" d="M312.5,277.5c0-12.427,10.073-22.5,22.5-22.5v-22.5 c-13.326,0-25.294,5.797-33.534,15.002C294.339,255.463,290,265.973,290,277.5c0,24.853,20.147,45,45,45V300 C322.573,300,312.5,289.927,312.5,277.5z"></path> <path id="XMLID_1866_" style="fill:#565659;" d="M335,232.5V255c12.427,0,22.5,10.073,22.5,22.5S347.427,300,335,300v22.5 c24.852,0,45-20.147,45-45c0-11.527-4.339-22.037-11.466-29.998C360.294,238.297,348.326,232.5,335,232.5z"></path> <path id="XMLID_1867_" style="fill:#CDCDD0;" d="M312.5,277.5c0,12.427,10.073,22.5,22.5,22.5v-45 C322.573,255,312.5,265.073,312.5,277.5z"></path> <path id="XMLID_1868_" style="fill:#ACABB1;" d="M335,300c12.427,0,22.5-10.073,22.5-22.5S347.427,255,335,255V300z"></path>
 <polygon id="XMLID_1869_" style="fill:#FFFFFF;" points="155,147.5 89.782,147.5 72.639,187.5 155,187.5 "></polygon> <polygon id="XMLID_1870_" style="fill:#FFFFFF;" points="185,147.5 185,187.5 283.133,187.5 254.561,147.5 "></polygon> <rect id="XMLID_1871_" y="217.5" style="fill:#FF5023;" width="30" height="30"></rect> <polygon id="XMLID_1872_" style="fill:#FF5023;" points="390,247.5 410,247.5 410,217.5 380,217.5 "></polygon> <polygon id="XMLID_1873_" style="fill:#565659;" points="210,117.5 210,87.5 130,87.5 130,117.5 170,117.5 "></polygon> <rect id="XMLID_1874_" x="170" y="217.5" style="fill:#565659;" width="30" height="30"></rect> <polygon id="XMLID_1875_" style="fill:#565659;" points="230,247.5 200,247.5 200,247.502 200,277.5 230,277.5 230,247.502 "></polygon> <rect id="XMLID_1876_" x="230" y="217.5" style="fill:#565659;" width="30" height="30"></rect> </g> </g>
</svg>

<path class="magnify" d="M38.948,10.429c-18.254,10.539-24.468,33.953-14.057,51.986,9.229,15.984,28.649,22.764,45.654,16.763-0.84868,2.6797-0.61612,5.6834,0.90656,8.3207l17.309,29.98c2.8768,4.9827,9.204,6.6781,14.187,3.8013,4.9827-2.8768,6.6781-9.204,3.8013-14.187l-17.31-29.977c-1.523-2.637-4.008-4.34-6.753-4.945,13.7-11.727,17.543-31.935,8.31-47.919-10.411-18.034-33.796-24.359-52.049-13.82zm6.902,11.955c11.489-6.633,26.133-2.7688,32.893,8.9404,6.7603,11.709,2.7847,26.324-8.704,32.957-11.489,6.632-26.133,2.768-32.893-8.941-6.761-11.709-2.785-26.324,8.704-32.957z"/>
</svg>
    <div class="date" style="left:-240px;font-weight: bold;">Searching for driver</div>
    <div class="content">
    <p>${currentDateTime}</p>
    </div>
  </div>`;
  $(".timeline").append(html_data1);

   @endif
  });
    // initMap();
</script>

<script type="text/javascript" src="https://maps.google.com/maps/api/js?key={{get_settings('google_map_key')}}&callback=initMap" async defer></script>


@endsection
@push('scripts-js')
<script>

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
// function myFunction() {
//   // Some code...
//   debugger; // Execution will pause here
//   // More code...
// }

// myFunction();
</script>
@endpush
        <!-- END: Form Layout -->


