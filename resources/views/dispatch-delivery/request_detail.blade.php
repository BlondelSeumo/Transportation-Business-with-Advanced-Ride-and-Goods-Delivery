@extends('dispatch.layout')

@push('dispatch-css')

<style>
    #map{
        height: 250px;
        width: 100%;
        padding: 5px;
    }
    .time-line li {
        list-style-type: none;
    }

    .time-line li svg {
        position: absolute;
        left: 25px;
        background: #fff;
    }

    .time-line li:before {
        content: "";
        position: absolute;
        width: 2px;
        height: 65px;
        background-color: #748194;
        left: 32px;
    }

    .time-line li:nth-child(1) svg {
        color: orange;
    }

    .time-line li:nth-child(1)::before {
        background-color: orange;
    }

    .time-line li:nth-child(2) svg {
        color: Indigo;
    }

    .time-line li:nth-child(2)::before {
        background-color: Indigo;
    }

    .time-line li:nth-child(3) svg {
        color: blue;
    }

    .time-line li:nth-child(3)::before {
        background-color: blue;
    }

    .time-line li:nth-child(4) svg {
        color: green;
    }

    .time-line li:nth-child(4)::before {
        background-color: green;
    }

    .time-line li:nth-child(5) svg {
        color: red;
    }

    .time-line li:nth-child(5)::before {
        background-color: red;
    }

    .left .toggle {
        right: -50px;
        top: 20px;
        transition: 0.6s;
    }

    #fare-details-grid {
        display: grid;
        grid-template-columns: 48% 4% 48%;
    }

    .max-h{
        max-height: 200px;
    }
</style>
@endpush

@section('dispatch-content')
<main class="main">
    <div class="container-fluid">
       
     
        <div id="request_{{ $item->id }}" class="p-3">
         <div class="col-md-12">
             <div class="row">
            <div class="col-md-11">
                
            </div>
             <div class="col-md-1">
         <a href="{{ url('dispatch/dashboard') }}">
                <button class="btn btn-danger btn-sm pull-right ml-3" type="submit">
                    <i class="mdi mdi-keyboard-backspace mr-2"></i>
                    @lang('view_pages.back')
                </button>
            </a>
        </div>
        </div>
        </div>
            
           <div class="row">
                                    <div class="col card detail-overflow">
                                        <h5 class="off mt-3" style="font-weight: 900;">
                                           @lang('view_pages.order_id') : {{ $item->request_number }}
                                        </h5>
                                        {{-- <h5 class=" mb-3 color-03 font-dancing">
                                            <img class="rounded-circle ms-2"
                                                src="{{ asset('dispatcher/assets/img/team/1-thumb.png') }}" alt=""
                                                style="width: 30px;">
                                        </h5> --}}
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <h5 class="bg-secondary p-2 text-white">
                                                  @lang('view_pages.trip_details') :
                                                </h5>

                                                <p class="mb-1 f-12">

                                                    @lang('view_pages.type') : <b>{{ $item->vehicle_type_name }}</b>
                                                </p>
                                                <!--  <p class="mb-1 f-12">
                                                                                                    Weight : <b>{{ $item->zoneType->vehicleType->maximum_weight_can_carrying }}</b>
                                                                                                </p> -->

                                            </div>
                                            <div class="col-12 mb-3">
                                                <h5 class="bg-secondary p-2 text-white">
                                                      @lang('view_pages.payment_details'):
                                                </h5>
                                                <!--  <p class="mb-1 f-12">
                                                                                                    Paid By : <b>{{ $item->paid_by == 1 ? 'Sender' : 'Receiver' }}</b>
                                                                                                </p> -->
                                                <p class="mb-1 f-12">

                                                   @lang('view_pages.payment_type') : <b>{{ $item->payment_opt == 1 ? 'Cash' : 'Card' }}</b>
                                                </p>
                                                <p class="mb-1 f-12">
                                                    @lang('view_pages.amount') :
                                                    @if ($item->requestBill)
                                                        <b>{{ $item->currency . ' ' . $item->requestBill->total_amount }}</b>
                                                    @else
                                                        <b>-</b>
                                                    @endif
                                                </p>
                                            </div>

                                            @if ($item->driverDetail)
                                                <div class="col-12">
                                                    <h5 class="bg-secondary p-2 text-white">
                                                      @lang('view_pages.driver_details'):
                                                    </h5>
                                                </div>
                                                <div class="col-5 my-3">
                                                    <a href="{{ $item->driverDetail->profile_picture }}" data-fancybox>
                                                        <img class="img-fluid"
                                                            src="{{ $item->driverDetail->profile_picture }}" alt="">
                                                    </a>
                                                </div>
                                                <div class="col-7 my-3">
                                                    <p class="mb-1 f-12">
                                                      @lang('view_pages.name') : <b>{{ $item->driverDetail->name }}</b>
                                                    </p>
                                                    <p class="mb-1 f-12">
                                                    @lang('view_pages.email') : <b>{{ $item->driverDetail->email }}</b>
                                                    </p>
                                                    <p class="mb-1 f-12">
                                                   @lang('view_pages.phone') : <b>{{ $item->driverDetail->mobile }}</b>
                                                    </p>
                                                    <p class="mb-1 f-12">
                                                        Stars : <b>{{ $item->driverDetail->rating ? $item->driverDetail->rating : '-' }}<i
                                                                class="fas fa-star" style="color: yellow;"></i></b>
                                                    </p>
                                                </div>
                                            @endif

                                            @if ($item->zoneType->vehicleType)
                                                <div class="col-12">
                                                    <h5 class="bg-secondary p-2 text-white">
                                                     @lang('view_pages.veichle_details'):
                                                    </h5>
                                                </div>
                                                <div class="col-5 my-3">
                                                    <a href="{{ $item->zoneType->vehicleType->icon }}" data-fancybox>
                                                        <img class="img-fluid"
                                                            src="{{ $item->zoneType->vehicleType->icon }}" alt="">
                                                    </a>
                                                </div>
                                                <div class="col-7 my-3">
                                                    <p class="mb-1 f-12">
                                                       @lang('view_pages.plate_no') :
                                                        <b>{{ $item->driverDetail ? $item->driverDetail->vehicle_number : '-' }}</b>
                                                    </p>
                                                    <p class="mb-1 f-12">
                                                     @lang('view_pages.color'):
                                                        <b>{{ $item->driverDetail ? $item->driverDetail->car_color : '-' }}</b>
                                                    </p>
                                                    <p class="mb-1 f-12">
                                                   @lang('view_pages.type') : <b>{{ $item->vehicle_type_name }}</b>
                                                    </p>
                                                    <p class="mb-1 f-12">
                                                    @lang('view_pages.make') :
                                                        <b>{{ $item->driverDetail ? $item->driverDetail->carMake->name : '-' }}</b>
                                                    </p>
                                                    <p class="mb-1 f-12">
                                                     @lang('view_pages.model') :
                                                        <b>{{ $item->driverDetail ? $item->driverDetail->carModel->name : '-' }}</b>
                                                    </p>
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="col card detail-overflow">
                                        <div class="row">
                                            <div class="col-12 mt-3">
                                                <h5 class="bg-secondary p-2 text-white">
                                               @lang('view_pages.customer_details') :
                                                </h5>
                                            </div>
                                            <div class="col-6">
                                                <p class="mb-0 text-decoration-underline">
                                                    <b> @lang('view_pages.customer_detail') :</b>
                                                </p>
                                                 <p class="mb-1 f-12">
                                                 @lang('view_pages.name')  : <b>{{ $item->adHocuserDetail->name ?? $item->userDetail->name}}</b>
                                                </p>
                                                <p class="mb-1 f-12">
                                              @lang('view_pages.phone')  : <b>{{ $item->adHocuserDetail->mobile?? $item->userDetail->mobile }}</b>
                                                </p>
                                            </div>

                                            <div class="col-12 my-3 tripTimeline">
                                                <h5 class="bg-secondary p-2 text-white mb-3">
                                            @lang('view_pages.activity_timeline') :
                                                </h5>
                                                <ul class="time-line">
                                                     @if ($item->converted_created_at)
                                                    <li>
                                                        <p>
                                                            <b>@lang('view_pages.request_made_at') :</b> <br>
                                                            <small>{{ $item->converted_created_at }}</small>
                                                        </p>
                                                    </li>
                                                    @endif
                                                     @if ($item->converted_accepted_at)
                                                    <li>
                                                        <p>
                                                            <b>@lang('view_pages.accepted_at') :</b> <br>
                                                            <small>{{ $item->converted_accepted_at }}</small>
                                                        </p>
                                                    </li>
                                                    @endif
                                                    @if ($item->converted_arrived_at)
                                                    <li>
                                                        <p>
                                                            <b>@lang('view_pages.arrived_at') :</b> <br>
                                                            <small>{{ $item->converted_arrived_at }}</small>
                                                        </p>
                                                    </li>
                                                    @endif
                                                    @if ($item->converted_trip_start_time)
                                                    <li>
                                                        <p>
                                                            <b>@lang('view_pages.trip_started_at')
                                                                :</b> <br>
                                                            <small>{{ $item->converted_trip_start_time }}</small>
                                                        </p>
                                                    </li>
                                                     @endif
                                                      @if ($item->converted_completed_at)
                                                    <li>
                                                        <p>
                                                            <b>@lang('view_pages.reached_to_drop_location_at')
                                                                :</b> <br>
                                                            <small>{{ $item->converted_completed_at }}</small>
                                                        </p>
                                                    </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>


                                     <div class="col pt-3 card detail-overflow">
                                        <div id="map"></div>
                                        <div class="row">
                                            <div class="col-12 mt-3">
                                                <h5 class="bg-secondary p-2 text-white">
                                                 @lang('view_pages.pickup_details')  :
                                                </h5>
                                            </div>
                                            <div class="col-12">
                                                <p class="mb-0 text-decoration-underline">
                                                    {{-- <b>Coimbatore</b> --}}
                                                </p>
                                                <p class="mb-1 f-12">
                                                    <b> @lang('view_pages.location') : </b><br>
                                                    {{ $item->requestPlace->pick_address }}
                                                </p>
                                                <p class="mb-1 f-12">
                                                    <b>Time : </b><br>
                                                    {{ $item->converted_trip_start_time }}
                                                </p>
                                            </div>

                                            <div class="col-12 mt-3">
                                                <h5 class="bg-secondary p-2 text-white">
                                                   @lang('view_pages.drop_details') :
                                                </h5>
                                            </div>
                                            <div class="col-12">
                                                <p class="mb-0 text-decoration-underline">
                                                    {{-- <b>Coimbatore</b> --}}
                                                </p>
                                                <p class="mb-1 f-12">
                                                    <b> @lang('view_pages.location') : </b><br>
                                                    {{ $item->requestPlace->drop_address }}
                                                </p>
                                                <p class="mb-1 f-12">
                                                    <b> @lang('view_pages.time') : </b><br>
                                                    {{ $item->converted_completed_at }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
        </div>
    </div>
</main>

<script type="text/javascript" src="https://maps.google.com/maps/api/js?key={{get_settings('google_map_key')}}&libraries=places"></script>

<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-database.js"></script>
<!-- TODO: Add SDKs for Firebase products that you want to use https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-analytics.js"></script>

<script>
   // var lat = 11.015956;
    // var lng = 76.968985;
    var lat = "{{$item->requestPlace->pick_lat}}"
    var lng = "{{$item->requestPlace->pick_lng}}"
    var pickLat = [];
    var pickLng = [];
    var default_lat = lat;
    var default_lng = lng;
    var driverLat, driverLng, bearing, type;
    var marker = [];
    var onTrip, available;
    onTrip = available = true;
    var requestId = "{{ $item->id }}"
    var driverId = "{{ $item->driver_id }}"
    var directionsService = new google.maps.DirectionsService();
    var directionsRenderer = new google.maps.DirectionsRenderer({
        suppressMarkers: true
    });

    // Your web app's Firebase configuration
        var firebaseConfig = {
                apiKey: "{{get_settings('firebase-api-key')}}",
    authDomain: "{{get_settings('firebase-auth-domain')}}",
    databaseURL: "{{get_settings('firebase-db-url')}}",
    projectId: "{{get_settings('firebase-project-id')}}",
    storageBucket: "{{get_settings('firebase-storage-bucket')}}",
    messagingSenderId: "{{get_settings('firebase-messaging-sender-id')}}",
    appId: "{{get_settings('firebase-app-id')}}",
    measurementId: "{{get_settings('firebase-measurement-id')}}"@extends('dispatch.layout')

@push('dispatch-css')

<style>
    #map{
        height: 250px;
        width: 100%;
        padding: 5px;
    }
    .time-line li {
        list-style-type: none;
    }

    .time-line li svg {
        position: absolute;
        left: 25px;
        background: #fff;
    }

    .time-line li:before {
        content: "";
        position: absolute;
        width: 2px;
        height: 65px;
        background-color: #748194;
        left: 32px;
    }

    .time-line li:nth-child(1) svg {
        color: orange;
    }

    .time-line li:nth-child(1)::before {
        background-color: orange;
    }

    .time-line li:nth-child(2) svg {
        color: Indigo;
    }

    .time-line li:nth-child(2)::before {
        background-color: Indigo;
    }

    .time-line li:nth-child(3) svg {
        color: blue;
    }

    .time-line li:nth-child(3)::before {
        background-color: blue;
    }

    .time-line li:nth-child(4) svg {
        color: green;
    }

    .time-line li:nth-child(4)::before {
        background-color: green;
    }

    .time-line li:nth-child(5) svg {
        color: red;
    }

    .time-line li:nth-child(5)::before {
        background-color: red;
    }

    .left .toggle {
        right: -50px;
        top: 20px;
        transition: 0.6s;
    }

    #fare-details-grid {
        display: grid;
        grid-template-columns: 48% 4% 48%;
    }

    .max-h{
        max-height: 200px;
    }
</style>
@endpush

@section('dispatch-content')
<main class="main">
    <div class="container-fluid">
       
     
        <div id="request_{{ $item->id }}" class="p-3">
         <div class="col-md-12">
             <div class="row">
            <div class="col-md-11">
                
            </div>
             <div class="col-md-1">
         <a href="{{ url('dispatch/dashboard') }}">
                <button class="btn btn-danger btn-sm pull-right ml-3" type="submit">
                    <i class="mdi mdi-keyboard-backspace mr-2"></i>
                    @lang('view_pages.back')
                </button>
            </a>
        </div>
        </div>
        </div>
            
           <div class="row">
                                    <div class="col card detail-overflow">
                                        <h5 class="off mt-3" style="font-weight: 900;">
                                            @lang('view_pages.order_id') : {{ $item->request_number }}
                                        </h5>
                                        {{-- <h5 class=" mb-3 color-03 font-dancing">
                                            <img class="rounded-circle ms-2"
                                                src="{{ asset('dispatcher/assets/img/team/1-thumb.png') }}" alt=""
                                                style="width: 30px;">
                                        </h5> --}}
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <h5 class="bg-secondary p-2 text-white">
                                                     @lang('view_pages.trip_details') :
                                                </h5>

                                                <p class="mb-1 f-12">

                                                    Vehicle Type : <b>{{ $item->vehicle_type_name }}</b>
                                                </p>
                                                <!--  <p class="mb-1 f-12">
                                                                                                    Weight : <b>{{ $item->zoneType->vehicleType->maximum_weight_can_carrying }}</b>
                                                                                                </p> -->

                                            </div>
                                            <div class="col-12 mb-3">
                                                <h5 class="bg-secondary p-2 text-white">
                                                    Payment Details:
                                                </h5>
                                                <!--  <p class="mb-1 f-12">
                                                                                                    Paid By : <b>{{ $item->paid_by == 1 ? 'Sender' : 'Receiver' }}</b>
                                                                                                </p> -->
                                                <p class="mb-1 f-12">

                                                    Payment Type : <b>{{ $item->payment_opt == 1 ? 'Cash' : 'Card' }}</b>
                                                </p>
                                                <p class="mb-1 f-12">
                                                    Amount :
                                                    @if ($item->requestBill)
                                                        <b>{{ $item->currency . ' ' . $item->requestBill->total_amount }}</b>
                                                    @else
                                                        <b>-</b>
                                                    @endif
                                                </p>
                                            </div>

                                            @if ($item->driverDetail)
                                                <div class="col-12">
                                                    <h5 class="bg-secondary p-2 text-white">
                                                        Driver Details:
                                                    </h5>
                                                </div>
                                                <div class="col-5 my-3">
                                                    <a href="{{ $item->driverDetail->profile_picture }}" data-fancybox>
                                                        <img class="img-fluid"
                                                            src="{{ $item->driverDetail->profile_picture }}" alt="">
                                                    </a>
                                                </div>
                                                <div class="col-7 my-3">
                                                    <p class="mb-1 f-12">
                                                        Name : <b>{{ $item->driverDetail->name }}</b>
                                                    </p>
                                                    <p class="mb-1 f-12">
                                                        Email : <b>{{ $item->driverDetail->email }}</b>
                                                    </p>
                                                    <p class="mb-1 f-12">
                                                        Phone : <b>{{ $item->driverDetail->mobile }}</b>
                                                    </p>
                                                    <p class="mb-1 f-12">
                                                        Stars : <b>{{ $item->driverDetail->driverDetail->rating }} <i
                                                                class="fas fa-star" style="color: yellow;"></i></b>
                                                    </p>
                                                </div>
                                            @endif

                                            @if ($item->zoneType->vehicleType)
                                                <div class="col-12">
                                                    <h5 class="bg-secondary p-2 text-white">
                                                        Vehicle Details:
                                                    </h5>
                                                </div>
                                                <div class="col-5 my-3">
                                                    <a href="{{ $item->zoneType->vehicleType->icon }}" data-fancybox>
                                                        <img class="img-fluid"
                                                            src="{{ $item->zoneType->vehicleType->icon }}" alt="">
                                                    </a>
                                                </div>
                                                <div class="col-7 my-3">
                                                    <p class="mb-1 f-12">
                                                        Plate No :
                                                        <b>{{ $item->driverDetail ? $item->driverDetail->vehicle_number : '-' }}</b>
                                                    </p>
                                                    <p class="mb-1 f-12">
                                                        Color :
                                                        <b>{{ $item->driverDetail ? $item->driverDetail->car_color : '-' }}</b>
                                                    </p>
                                                    <p class="mb-1 f-12">
                                                        Type : <b>{{ $item->vehicle_type_name }}</b>
                                                    </p>
                                                    <p class="mb-1 f-12">
                                                        Make :
                                                        <b>{{ $item->driverDetail ? $item->driverDetail->carMake->name : '-' }}</b>
                                                    </p>
                                                    <p class="mb-1 f-12">
                                                        Model :
                                                        <b>{{ $item->driverDetail ? $item->driverDetail->carModel->name : '-' }}</b>
                                                    </p>
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="col card detail-overflow">
                                        <div class="row">
                                            <div class="col-12 mt-3">
                                                <h5 class="bg-secondary p-2 text-white">
                                                    Customer Details :
                                                </h5>
                                            </div>
                                            <div class="col-6">
                                                <p class="mb-0 text-decoration-underline">
                                                    <b>Customer Detail :</b>
                                                </p>
                                                 <p class="mb-1 f-12">
                                                    Name : <b>{{ $item->adHocuserDetail->name ?? $item->userDetail->name}}</b>
                                                </p>
                                                <p class="mb-1 f-12">
                                                    Number : <b>{{ $item->adHocuserDetail->mobile?? $item->userDetail->mobile }}</b>
                                                </p>
                                            </div>

                                            <div class="col-12 my-3 tripTimeline">
                                                <h5 class="bg-secondary p-2 text-white mb-3">
                                                    Activity Timeline :
                                                </h5>
                                                <ul class="time-line">
                                                     @if ($item->converted_created_at)
                                                    <li>
                                                        <p>
                                                            <b>Request Made at :</b> <br>
                                                            <small>{{ $item->converted_created_at }}</small>
                                                        </p>
                                                    </li>
                                                    @endif
                                                     @if ($item->converted_accepted_at)
                                                    <li>
                                                        <p>
                                                            <b>Accepted at :</b> <br>
                                                            <small>{{ $item->converted_accepted_at }}</small>
                                                        </p>
                                                    </li>
                                                    @endif
                                                    @if ($item->converted_arrived_at)
                                                    <li>
                                                        <p>
                                                            <b>Arrived at :</b> <br>
                                                            <small>{{ $item->converted_arrived_at }}</small>
                                                        </p>
                                                    </li>
                                                    @endif
                                                    @if ($item->converted_trip_start_time)
                                                    <li>
                                                        <p>
                                                            <b>Trip Started at
                                                                :</b> <br>
                                                            <small>{{ $item->converted_trip_start_time }}</small>
                                                        </p>
                                                    </li>
                                                     @endif
                                                      @if ($item->converted_completed_at)
                                                    <li>
                                                        <p>
                                                            <b>Reached to Drop location at
                                                                :</b> <br>
                                                            <small>{{ $item->converted_completed_at }}</small>
                                                        </p>
                                                    </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>


                                     <div class="col pt-3 card detail-overflow">
                                        <div id="map"></div>
                                        <div class="row">
                                            <div class="col-12 mt-3">
                                                <h5 class="bg-secondary p-2 text-white">
                                                    Pickup Details :
                                                </h5>
                                            </div>
                                            <div class="col-12">
                                                <p class="mb-0 text-decoration-underline">
                                                    {{-- <b>Coimbatore</b> --}}
                                                </p>
                                                <p class="mb-1 f-12">
                                                    <b>Location : </b><br>
                                                    {{ $item->requestPlace->pick_address }}
                                                </p>
                                                <p class="mb-1 f-12">
                                                    <b>Time : </b><br>
                                                    {{ $item->converted_trip_start_time }}
                                                </p>
                                            </div>

                                            <div class="col-12 mt-3">
                                                <h5 class="bg-secondary p-2 text-white">
                                                    Drop Details :
                                                </h5>
                                            </div>
                                            <div class="col-12">
                                                <p class="mb-0 text-decoration-underline">
                                                    {{-- <b>Coimbatore</b> --}}
                                                </p>
                                                <p class="mb-1 f-12">
                                                    <b>Location : </b><br>
                                                    {{ $item->requestPlace->drop_address }}
                                                </p>
                                                <p class="mb-1 f-12">
                                                    <b>Time : </b><br>
                                                    {{ $item->converted_completed_at }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
        </div>
    </div>
</main>

<script type="text/javascript" src="https://maps.google.com/maps/api/js?key={{get_settings('google_map_key')}}&libraries=places"></script>

<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-database.js"></script>
<!-- TODO: Add SDKs for Firebase products that you want to use https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-analytics.js"></script>

<script>
   // var lat = 11.015956;
    // var lng = 76.968985;
    var lat = "{{$item->requestPlace->pick_lat}}"
    var lng = "{{$item->requestPlace->pick_lng}}"
    var pickLat = [];
    var pickLng = [];
    var default_lat = lat;
    var default_lng = lng;
    var driverLat, driverLng, bearing, type;
    var marker = [];
    var onTrip, available;
    onTrip = available = true;
    var requestId = "{{ $item->id }}"
    var driverId = "{{ $item->driver_id }}"
    var directionsService = new google.maps.DirectionsService();
    var directionsRenderer = new google.maps.DirectionsRenderer({
        suppressMarkers: true
    });

    // Your web app's Firebase configuration
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

    var map = new google.maps.Map(document.getElementById('map'), {
            center: new google.maps.LatLng(default_lat, default_lng),
            zoom: 10,
            mapTypeId: 'roadmap',
            mapTypeControl: true,
            mapTypeControlOptions: {
                style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                position: google.maps.ControlPosition.TOP_CENTER,
            },
            zoomControl: true,
            zoomControlOptions: {
                position: google.maps.ControlPosition.RIGHT_BOTTOM,
            },
            scaleControl: true,
            streetViewControl: false,
            fullscreenControl: true,
        });

    directionsRenderer.setMap(map);

    var iconBase = "{{ asset('map/icon/') }}";
    var icons = {
        available: {
            name: 'Available',
            icon: iconBase + '/truck1.png'
        },
        ontrip: {
            name: 'OnTrip',
            icon: iconBase + '/truck2.png'
        },
        pickup: {
            name: 'PickUp',
            icon: iconBase + '/driver_available.png'
        },
        drop: {
            name: 'Drop',
            icon: iconBase + '/driver_on_trip.png'
        }
    };

    var requestRef = firebase.database().ref('requests/'+requestId);

    requestRef.on('value', async function(snapshot) {
        var tripData = snapshot.val();

        if (typeof tripData.request_id != 'undefined') {
            await loadDriverIcons(tripData);
            await getTripDetails(tripData.request_id);
        }
    });

    function loadDriverIcons(val){
        deleteAllMarkers();

        var iconImg = icons['ontrip'].icon;

        var carIcon = new google.maps.Marker({
            position: new google.maps.LatLng(val.lat, val.lng),
            icon: {
                url: iconImg,
                scaledSize: new google.maps.Size(40, 40)
            },
            map: map
        });

        marker.push(carIcon);
        carIcon.setMap(map);

        setTimeout(() => {
            rotateMarker(iconImg, val.bearing);
        }, 3000);
    }

    function getTripDetails(requestId){
        var basePath = "{{ asset('storage/uploads/request/delivery-proof') }}/"
        if(requestId){
            let url = "{{ url('dispatch/request') }}/"+requestId;
            fetch(url)
            .then(response => response.json())
            .then(result => {

                if(result){
                    var pickLat = result.pick_lat
                    var pickLng = result.pick_lng
                    var dropLat = result.drop_lat
                    var dropLng = result.drop_lng

                    var pickUpLocation = new google.maps.LatLng(pickLat, pickLng);
                    var dropLocation = new google.maps.LatLng(dropLat, dropLng);
                    calcRoute(pickUpLocation, dropLocation)

                    var activity = `<h5 class="bg-secondary p-2 text-white mb-3">
                                        Activity Timeline :
                                    </h5>
                                    <ul class="time-line">
                                        ${result.converted_created_at ? 
                                        `<li>
                                            <i class="fas fa-envelope"></i>
                                            <p>
                                                <b>Request Made at :</b> <br>
                                                <small>${result.converted_created_at}</small>
                                            </p>
                                        </li>`
                                        : ''
                                        }

                                        ${result.converted_accepted_at ? 
                                        `<li>
                                            <i class="fas fa-envelope-open-text"></i>
                                            <p>
                                                <b>Accepted at :</b> <br>
                                                <small>${result.converted_accepted_at}</small>
                                            </p>
                                        </li>`
                                        : ''
                                        }

                                        ${result.converted_arrived_at ? 
                                        `<li>
                                            <i class="fas fa-map-marked-alt"></i>
                                            <p>
                                                <b>Arrived at :</b> <br>
                                                <small>${result.converted_arrived_at}</small>
                                            </p>
                                        </li>`
                                        : ''
                                        }

                                        ${result.converted_trip_start_time ? 
                                        `<li>
                                            <i class="fas fa-box"></i>
                                            <p>
                                                <b>Trip Started at
                                                    :</b> <br>
                                                <small>${result.converted_trip_start_time}</small>
                                            </p>
                                        </li>`
                                        : ''
                                        }

                                        ${result.converted_completed_at ? 
                                        `<li>
                                            <i class="fas fa-parachute-box"></i>
                                            <p>
                                                <b>Reached to Drop location at
                                                    :</b> <br>
                                                <small>${result.converted_completed_at}</small>
                                            </p>
                                        </li>`
                                        : ''
                                        }
                                    </ul>`;

                    $('.tripTimeline').html(activity);

                   
                   
                }
            });
        }
    }

    // To rotate truck based on driver bearing
    function rotateMarker(carimage, bearing) {
        if(document.querySelectorAll(`img[src='${carimage}']`).length > 0)
             var bearing = Math.floor((Math.random() * 180) + 0);
            document.querySelectorAll(`img[src='${carimage}']`)[0].style.transform = 'rotate(' + bearing + 'deg)';
    }

    // Delete truck icons once map reloads
    function deleteAllMarkers() {
        for (var i = 0; i < marker.length; i++) {
            marker[i].setMap(null);
        }
    }

    // Draw path from pickup to drop - map api
    function calcRoute(pickup, drop) {
        var request = {
            origin: pickup,
            destination: drop,
            travelMode: google.maps.TravelMode['DRIVING']
        };

        directionsService.route(request, function(response, status) {
            if (status == 'OK') {
                directionsRenderer.setDirections(response);
                var leg = response.routes[0].legs[0];
                makeMarker(leg.start_location, icons['pickup'].icon, icons['pickup'].name, map);
                makeMarker(leg.end_location, icons['drop'].icon, icons['drop'].name, map);
            }
        });
    }

    function makeMarker(position, icon, title, map) {
        new google.maps.Marker({
            position: position,
            map: map,
            icon: icon,
            title: title
        });
    }
</script>
@endsection

        };
        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);
        firebase.analytics();

    var map = new google.maps.Map(document.getElementById('map'), {
            center: new google.maps.LatLng(default_lat, default_lng),
            zoom: 10,
            mapTypeId: 'roadmap',
            mapTypeControl: true,
            mapTypeControlOptions: {
                style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                position: google.maps.ControlPosition.TOP_CENTER,
            },
            zoomControl: true,
            zoomControlOptions: {
                position: google.maps.ControlPosition.RIGHT_BOTTOM,
            },
            scaleControl: true,
            streetViewControl: false,
            fullscreenControl: true,
        });

    directionsRenderer.setMap(map);

    var iconBase = "{{ asset('map/icon/') }}";
    var icons = {
        available: {
            name: 'Available',
            icon: iconBase + '/taxi1.svg'
        },
        ontrip: {
            name: 'OnTrip',
            icon: iconBase + '/taxi.svg'
        },
        pickup: {
            name: 'PickUp',
            icon: iconBase + '/driver_available.png'
        },
        drop: {
            name: 'Drop',
            icon: iconBase + '/driver_on_trip.png'
        }
    };

    var requestRef = firebase.database().ref('requests/'+requestId);

    requestRef.on('value', async function(snapshot) {
        var tripData = snapshot.val();

        if (typeof tripData.request_id != 'undefined') {
            await loadDriverIcons(tripData);
            await getTripDetails(tripData.request_id);
        }
    });

    function loadDriverIcons(val){
        deleteAllMarkers();

        var iconImg = icons['ontrip'].icon;

        var carIcon = new google.maps.Marker({
            position: new google.maps.LatLng(val.lat, val.lng),
            icon: {
                url: iconImg,
                scaledSize: new google.maps.Size(40, 40)
            },
            map: map
        });

        marker.push(carIcon);
        carIcon.setMap(map);

        setTimeout(() => {
            rotateMarker(iconImg, val.bearing);
        }, 3000);
    }

    function getTripDetails(requestId){
        var basePath = "{{ asset('storage/uploads/request/delivery-proof') }}/"
        if(requestId){
            let url = "{{ url('dispatch/request') }}/"+requestId;
            fetch(url)
            .then(response => response.json())
            .then(result => {

                if(result){
                    var pickLat = result.pick_lat
                    var pickLng = result.pick_lng
                    var dropLat = result.drop_lat
                    var dropLng = result.drop_lng

                    var pickUpLocation = new google.maps.LatLng(pickLat, pickLng);
                    var dropLocation = new google.maps.LatLng(dropLat, dropLng);
                    calcRoute(pickUpLocation, dropLocation)

                    var activity = `<h5 class="bg-secondary p-2 text-white mb-3">
                                        Activity Timeline :
                                    </h5>
                                    <ul class="time-line">
                                        ${result.converted_created_at ? 
                                        `<li>
                                            <i class="fas fa-envelope"></i>
                                            <p>
                                                <b>Request Made at :</b> <br>
                                                <small>${result.converted_created_at}</small>
                                            </p>
                                        </li>`
                                        : ''
                                        }

                                        ${result.converted_accepted_at ? 
                                        `<li>
                                            <i class="fas fa-envelope-open-text"></i>
                                            <p>
                                                <b>Accepted at :</b> <br>
                                                <small>${result.converted_accepted_at}</small>
                                            </p>
                                        </li>`
                                        : ''
                                        }

                                        ${result.converted_arrived_at ? 
                                        `<li>
                                            <i class="fas fa-map-marked-alt"></i>
                                            <p>
                                                <b>Arrived at :</b> <br>
                                                <small>${result.converted_arrived_at}</small>
                                            </p>
                                        </li>`
                                        : ''
                                        }

                                        ${result.converted_trip_start_time ? 
                                        `<li>
                                            <i class="fas fa-box"></i>
                                            <p>
                                                <b>Trip Started at
                                                    :</b> <br>
                                                <small>${result.converted_trip_start_time}</small>
                                            </p>
                                        </li>`
                                        : ''
                                        }

                                        ${result.converted_completed_at ? 
                                        `<li>
                                            <i class="fas fa-parachute-box"></i>
                                            <p>
                                                <b>Reached to Drop location at
                                                    :</b> <br>
                                                <small>${result.converted_completed_at}</small>
                                            </p>
                                        </li>`
                                        : ''
                                        }
                                    </ul>`;

                    $('.tripTimeline').html(activity);

                   
                   
                }
            });
        }
    }

    // To rotate truck based on driver bearing
    function rotateMarker(carimage, bearing) {
        if(document.querySelectorAll(`img[src='${carimage}']`).length > 0)
             var bearing = Math.floor((Math.random() * 180) + 0);
            document.querySelectorAll(`img[src='${carimage}']`)[0].style.transform = 'rotate(' + bearing + 'deg)';
    }

    // Delete truck icons once map reloads
    function deleteAllMarkers() {
        for (var i = 0; i < marker.length; i++) {
            marker[i].setMap(null);
        }
    }

    // Draw path from pickup to drop - map api
    function calcRoute(pickup, drop) {
        var request = {
            origin: pickup,
            destination: drop,
            travelMode: google.maps.TravelMode['DRIVING']
        };

        directionsService.route(request, function(response, status) {
            if (status == 'OK') {
                directionsRenderer.setDirections(response);
                var leg = response.routes[0].legs[0];
                makeMarker(leg.start_location, icons['pickup'].icon, icons['pickup'].name, map);
                makeMarker(leg.end_location, icons['drop'].icon, icons['drop'].name, map);
            }
        });
    }

    function makeMarker(position, icon, title, map) {
        new google.maps.Marker({
            position: position,
            map: map,
            icon: icon,
            title: title
        });
    }
</script>
@endsection
