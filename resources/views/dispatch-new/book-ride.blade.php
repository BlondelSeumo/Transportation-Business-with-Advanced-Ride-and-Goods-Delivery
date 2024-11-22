@extends('dispatch-new.layout')
<style>

    span.add_stop {
    float: right;
    color: rgb(189, 70, 27);
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
}
h2{
    color:black;
}
.vehicle_type.d-none,.vehicle_type_data.d-none{
    display:none
}
.iti{
  font-size:1.5rem;
}
.loader {
  position: absolute;
  left: 50%;
  top: 50%;
  z-index: 100;
  width: 550px;
  height: 150px;
  margin: -75px 0 0 -75px;
/*   border: 5px solid #f3f3f3; */
  border-radius: 50%;
/*   border-top: 5px solid #3498db; */
  width: 450px;
  height: 50px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}
#popup{
  position:fixed;
  left:0;
  top:0;
  width:100%;
  height:100%;
  background-color: rgba(0,0,0, .5);
  opacity: 0;
  visibility: hidden;
  transition: all 0.4s ease;
}
#popup:target{
  opacity: 1;
  visibility: visible;
}
.popup-card-content{
  text-align:center;
  font-size:28px;
  font-weight:bold;
}
.bg-loader.actv {
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    z-index: 100;
    background-color: black;
    opacity: 0.5;
}
input[type="radio"] {
  display: inline-block;
  margin-right: 5px; /* Optional: Add some space between radio buttons */
  cursor:pointer;
}
.image-fit{
  height: 4rem !important;
  width: 4rem !important;
}
</style>
@section('dispatch-content')
<link rel="stylesheet" href="{{ asset('assets/css/dispatcher/book-ride.css') }}">

<div class="modal-wrapper" id="modal1" style="display:none">
<div class="modal-dialog">
<div class="modal-content ">
    <span class="modal-close" onclick="popup_close()">&times;</span>
    <div class="model-content-wrapping">
  </div>
  </div>
</div>
</div>
<div id="bg-loader" class="bg-loader"></div>
    <div id="loader" class="loader" style="display:none">
  <img src="{{asset('assets/images/car_loader.gif')}}"  style="width:250px" frameBorder="0" ></img>
 </div>
<div class="g-col-12 px-10" style="margin:20px">
    <div class="intro-y d-flex align-items-center h-10 mb-10">
        <h2 class=" me-5" style="font-size:25px;font-weight:800;color:#fca503;">
           <i class="far fa-question-circle" style="color:fca503;"></i> Book a Ride
        </h2>
    </div>
</div>

<div class="g-col-12 g-col-lg-4 mt-0 px-10" >
  <div class="grid columns-12 gap-5 mt-5">
        <!-- BEGIN: book ride form -->
        <div class="g-col-12 g-col-xl-5 g-col-xxl-5">
            <form id="dispatcher-booking" method="post">
            <div class="intro-y overflow-y-auto" style="height:500px;">
                <div class="d-flex flex-column flex-sm-row align-items-center p-5">
                    <h2 class="me-auto" style="font-size:20px;font-weight:800;">
                        Personal Details
                    </h2>
                    <input type="hidden" name="transport_type" id="transport_type" value="{{$request->type}}">
                </div>
                <div class="p-5">
                  <div class="row">
                  <div class="col-lg-6">
                      <div class="textOnInput mt-10 mt-lg-5">
                          <label for="phone" class="form-label">Mobile</label>
                          <input id="dialcodes" name="dialcodes" type="hidden">
                          <input id="phone" type="number" class="form-control" placeholder="Mobile" required style="padding-left: 87px;">
                          <span style=" color: red; font-size: 15px;display:none" class="invalid-phone" >Mobile number is invalid
</span>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="textOnInput mt-10 mt-lg-5">
                          <label for="name" class="form-label">Name</label>
                          <input id="name" type="text" class="form-control" placeholder="Name" required>
                      </div>
                    </div>

                  </div>
                </div>
<!-- locations -->
@if($request->type == "taxi" || $request->type == "delivery")
                <div class="d-flex flex-column flex-sm-row align-items-center p-5">
                    <h2 class="me-auto" style="font-size:20px;font-weight:800;">
                        Pickup & Drop Location
                    </h2>
                    <span class="add_stop">+ Add Stop</span>
                </div>
                @endif
                <div class="p-5">
                  <div class="row">

                    <div class="col-lg-12">
                      <div class="textOnInput mt-5">
                          <label for="pickup" class="form-label">Pickup</label>
                          <input id="pickup" type="text" class="form-control" placeholder="Pickup Location" required>
                          <input type="hidden" id="search_radius" value="{{get_settings('driver_search_radius')}}">
                          <input type="hidden" class="form-control" id="pickup_lat" name="pickup_lat">
                          <input type="hidden" class="form-control" id="pickup"
                          name="pickup_addr">
                          <input type="hidden" class="form-control" id="pickup_lng"
                          name="pickup_lng">
                          <input type="hidden" class="form-control" id="eta_amount"
                          name="eta_amount">
                          </div>
                    </div>

                    @if($request->type == "taxi" || $request->type == "delivery")
                    <div class="col-lg-12 drop-loc">
                      <div class="textOnInput mt-10">
                          <label for="drop" class="form-label">Drop</label>
                          <input id="drop" type="text" class="form-control" placeholder="Drop Location" required>
                          <input type="hidden" class="form-control" id="drop"
                                                        name="drop_addr">
                          <input type="hidden" class="form-control" id="drop_lat"
                                                        name="drop_lat">
                                                    <input type="hidden" class="form-control" id="drop_lng"
                                                        name="drop_lng">
                      </div>
                    </div>
                    @endif
                  </div>
                </div>


                <div class="p-5">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="textOnInput mt-5 sl">
                          <label for="pickup" class="form-label">Booking Type</label>
                          <div class="mt-2 sl">
                             <select data-placeholder="Select" id="booking_type" class="tom-select w-full sl" style="height:45px;color:black">
                              <option class="sl" value="book-now">Instant Booking</option>
                              <option class="sl" value="book-later">Book later</option>
                          </select> </div>
                      </div>
                    </div>
                  </div>
                </div>

                @if($request->type == "rental")
                @if($app_for !=="taxi" && $app_for !== 'delivery')
<!-- Select goods type -->
                 <div class="d-flex flex-column flex-sm-row align-items-center p-5">
                    <h2 class="me-auto" style="font-size:20px;font-weight:800;">
                        Select Transport Types
                    </h2>
                </div>
                <div class="p-5">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="textOnInput mt-5 sl">
                          <label for="pickup" class="form-label">Select</label>
                          <!-- <input id="pickup" type="text" class="form-control" placeholder="Select Goods"> -->
                          <div class="mt-2 sl">
                             <select data-placeholder="Select" id="transport_types" class="form-control" >
                             <option value="" selected disabled>Select</option>
                              <option class="sl" value="taxi">Taxi</option>
                              <option class="sl" value="delivery">Delivery</option>
                              <option class="sl" value="both">Both</option>
                          </select> </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endif
                <div class="d-flex flex-column flex-sm-row align-items-center p-5">
                    <h2 class="me-auto" style="font-size:20px;font-weight:800;">
                        Select Package Types
                    </h2>
                </div>
                <div class="p-5">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="textOnInput mt-5 sl">
                          <!-- <label for="pickup" class="form-label">Select</label> -->
                          <!-- <input id="pickup" type="text" class="form-control" placeholder="Select Goods"> -->
                          <div class="mt-2 sl">
                          <select data-placeholder="Select Package Type" id="package_type" class="w-full package_type" style=" padding: 5px 5px 5px 5px; user-select: none;cursor: pointer; height:45px;color:black" required>
                              <option value="" selected disabled>Select</option>

                          </select> </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endif
                @if($request->type == "delivery" || $request->type == "rental" || $app_for == 'delivery')
 <!-- Select goods type -->
 <div id="goods_details" style="display:{{$request->type=='delivery'|| $app_for == 'delivery' ? 'block':'none'}}">
                <div class="d-flex flex-column flex-sm-row align-items-center p-5">
                    <h2 class="me-auto" style="font-size:20px;font-weight:800;">
                        Select Goods Type
                    </h2>
                </div>
                <div class="p-5">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="textOnInput mt-5 sl">
                          <!-- <label for="pickup" class="form-label">Select</label> -->
                          <!-- <input id="pickup" type="text" class="form-control" placeholder="Select Goods"> -->
                          <div class="mt-2 sl">

                          <select class="w-full"
                    aria-label=".form-select-sm example" id="goods_type"
                    name="goods_type" style=" padding: 5px; user-select: none;cursor:pointer; height: 45px; color:black;">
                    <option selected disabled value="">Select</option>
                </select>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="d-flex flex-column flex-sm-row align-items-center p-5">
                    <h2 class="me-auto" style="font-size:20px;font-weight:800;">
                        Select Goods Quantity
                    </h2>
                </div>
                <div class="p-5">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="textOnInput mt-5 sl">
                          <!-- <label for="pickup" class="form-label">Select</label> -->
                          <!-- <input id="pickup" type="text" class="form-control" placeholder="Select Goods"> -->
                          <div class="mt-2 sl"> 
                            
                          <select class="w-full" aria-label=".form-select-lg example" id="goods_quantity" name="goods_quantity" style=" padding: 5px 5px 5px 5px; user-select: none;cursor: pointer; height:45px;color:black" required> 
                    <option selected value="loose">Loose</option>
                    <option value="1" id="quantity">Quantity</option>
                </select>
                        
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div style="display:none" class="p-5 goods_quantity_no">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="textOnInput mt-5 sl">
                          <div class="mt-2 sl"> 
                            <input type="number" value=1 name="goods_quantity_no" id="goods_quantity_no" class="w-full h-20 form-control">
                        
                        </div>
                      </div>
                    </div>
                  </div>
                </div></div>
                @endif

<!-- vehicle types -->
                <div class="d-flex flex-column flex-sm-row align-items-center p-5 vehicle_type d-none" >
                    <h2 class="me-auto" style="font-size:20px;font-weight:800;">
                        Vehicle Type
                    </h2>
                </div>

<!-- select vehicle -->
                <div class="vehicle_type_data ">
                    <div class="overflow-x-auto scrollbar-hidden">
                        <div class="d-flex mt-5 select-vehile-types-data" id="vehicles">


                        </div>
                    </div>
                </div>
                @if($request->type == "taxi" || $request->type == "delivery" || $request->type == "rental")
<!-- Select time & date -->
<div class="book-later-date" style="display:none;margin-top:15px">
                <div class="d-flex flex-column flex-sm-row align-items-center p-5 select_time" >
                    <h2 class="me-auto" style="font-size:20px;font-weight:800;">
                        Select Date And Time
                    </h2>
                </div>
                <div class="p-5 select_time_data">
                  <div class="row">
                    <div class="col-lg-12">
                    <div class="input-group">
                      <div id="input-group-email" class="input-group-text">  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar w-4 h-4"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>  </div> <input type="datetime-local" class="form-control" name="datepicker" id="date_picker" data-single-mode="true">
                    </div>
                    </div>
                    </div>
                </div>
  </div>
                <script>
var default_latitude = {{get_settings('default_latitude')}};
var default_longitude = {{get_settings('default_longitude')}};
var default_country = "{{get_settings('default_country_code_for_mobile_app')}}";
    // Get the current time

    var today = new Date();

    // Get components of the current date and time
    var year = today.getFullYear();
    var month = String(today.getMonth() + 1).padStart(2, '0');
    var day = String(today.getDate()).padStart(2, '0');
    var hours = String(today.getHours()).padStart(2, '0');
    var minutes = String(today.getMinutes()).padStart(2, '0');

    // Format the datetime as YYYY-MM-DDTHH:MM
    var formattedNow = `${year}-${month}-${day}T${hours}:${minutes}`;
    // Set the value and min attributes of the datetime input to the formatted current datetime
    var datetimePicker = document.getElementById('date_picker');
    datetimePicker.value = formattedNow;
    datetimePicker.setAttribute('min', formattedNow);
</script>
                @endif
<!-- driver assign -->

                <div class="p-5"  style="margin-top: 20px;">
                <input type="radio" id="option1" name="radiobtn" value="1">
  <label for="option1" class="option1" style="margin-right:10px;color:rgb(0, 0, 0)">Manual Assign</label>
  <input type="radio" id="option2" name="radiobtn" value="0" checked>
  <label for="option2" style="margin-right:10px;color:rgb(0, 0, 0)">Automatic assign</label>

                </div>


<!-- booking button -->
<div class="vehicle-type-error" style="text-align: center;color: red;font-size: 15px; font-weight: bolder;display:none">
</div>
                <div class="d-flex align-items-center justify-content-center mt-10">

                    <button type="submit" class="btn book-now me-3" style=" width: 290px;font-size: 17px; margin-top: 10px;background-color:black;color:#fca503" data-modal="book-now">Confirm Booking</button>
                    <!-- <button type="click" class="btn book-later " id="book_later" data-modal="book-later"><i data-feather="clock" class="w-12 h-12 "></i>Book Later</button> -->
                </div>
 <!-- booking button end  -->
            </div>
</form>
        </div>
        <!-- END: Book ride -->
        <!-- BEGIN: Map Content -->
        <div class="g-col-12 g-col-xl-7 g-col-xxl-7 detail">
          <!-- details box -->
          <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
              <div class="intro-y g-col-12 g-col-md-6 px-20">
                  <div class="box">
                      <div class="d-flex  flex-lg-row align-items-center justify-content-center">
                          <div class="d-flex align-items-center ms-lg-2 me-lg-auto text-center text-lg-center mt-3 mt-lg-0 etadistance">

                          </div>
                          <div class="d-flex align-items-center ms-lg-2 me-lg-auto text-center text-lg-center mt-3 mt-lg-0 etatime">

                          </div>
                          <div class="d-flex align-items-center ms-lg-2 me-lg-end text-center text-lg-center mt-3 mt-lg-0 etaprice">

                          </div>
                      </div>
                  </div>
              </div>
            </div>
            <div class="col-lg-2"></div>
          </div>
          <!-- details box end-->
            <div class="box">
            <div id="map" style=" height: 500px;width: 100%;"></div>
            </div>
        </div>
        <!-- END: Map Content -->
<!-- end  -->
  </div>
</div>
<script>
  var app_for = "{{$app_for}}";
  $(document).ready(function(){
    $("li.d-flex").removeClass("active");
    $('li.bookride').addClass('active');
  })
  </script>
<script>
  let util = '{{ asset('assets/build/js/utils.js') }}'

  </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('assets/build/js/intlTelInput.js') }}"></script>
<script>
  let appUrl = '{{ url("/") }}';
</script>
<script src="{{ asset('assets/js/dispatcher/book-ride.js') }}"></script>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?key={{get_settings('google_map_key')}}&libraries=places" async defer></script>

@endsection

        <!-- END: Form Layout -->

