@extends('dispatch.layout')

@push('dispatch-css')


@php


$value=web_map_settings();
@endphp
@if($value=="open_street")



    <style>
        #legend {
            font-family: Arial, sans-serif;
            background: #fff;
            /*transparent;*/
            padding: 5px;
            margin: 5px;
            border: 3px solid #000;
            width: 10%;
            font-size: 8px;
        }

        #legend div {
            display: flex;
            align-items: center;
        }

        #legend h5 {
            margin-top: 0;
            font-size: 15px;
        }

        #legend img {
            vertical-align: middle;
            width: 35px;
            height: 35px;
            margin: 0 10px;
            padding-top: 3px;
            vertical-align: sub;
        }

        #legend .text {
            font-weight: bold;
            font-size: 10px;
            font-style: italic;
        }

        .etarow {
            padding: 5px;
            background: aliceblue;
            margin: 3px;
        }

        .etarow div {
            font-size: larger;
            font-weight: bolder;
        }

        .detail-popup {
            display: none;
            width: 100%;
            max-width: 100%;
            height: 100%;
        }

        .detail-overflow {
            height: 89vh;
            overflow-y: scroll;
            overflow-x: hidden;
            margin-right: 25px;
        }

        .btn-type {
            width: 32%;
            border-radius: 0;
        }

        .detail-overflow::-webkit-scrollbar {
            width: 3px;
        }

        .detail-overflow::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .detail-overflow::-webkit-scrollbar-thumb {
            background: #888;
        }

        .detail-overflow::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        .f-12 {
            font-size: 12px;
        }

        #map {
            height: calc(100vh - 120px);
            width: 100%;
            padding: 10px;
            z-index:0;
        }

        .modal-content {
            height: 90vh;
        }

        #book-now-map,
        #book-later-map,
        #box-content {
            width: 100%;
            height: calc(80vh - 100px);
            padding: 10px;
            overflow-y: scroll;
            overflow-x: hidden;
        }

        #box-content::-webkit-scrollbar {
            width: 3px;
        }

        #box-content::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        #box-content::-webkit-scrollbar-thumb {
            background: #888;
        }

        #box-content::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        a.notification:hover,
        a.notification:focus {
            background-color: aquamarine;
        }

        .packages .fs--1 {
            font-size: .83333rem !important;
        }

        .body-type li {
            list-style: none;
            padding: 5px;
            background: bisque;
            border-radius: 5px;
            text-align: center;
            margin: 3px;
            cursor: pointer;
        }

        .notification-avatar {
            margin-left: auto;
            margin-top: auto;
            margin-bottom: auto;
        }

        .truck-types img {
            width: 55px;
        }

        .truck-types {
            padding: 0px 30px;
            height: 70px;
            margin: 0 0 25px 10px;
            cursor: pointer;
            width: auto;
            text-align: center;
            border: 5px solid #dddddd;
            border-radius: 5px;
        }

        .truck-types:hover,
        .truck-types:focus {
            border: 5px solid #ff9933;
        }

        .pac-container {
            z-index: 10000 !important;
        }

        .iti {
            width: 100%;
        }

        .iti__flag {
            background-image: {{ asset('assets/build/img/flags.png') }};
        }

        @media (-webkit-min-device-pixel-ratio: 2),
        (min-resolution: 192dpi) {
            .iti__flag {
                background-image: {{ asset('assets/build/img/flags@2x.png') }};
            }
        }

        .swiper-slide p {
            margin-top: 15px;
        }

        .swiper-slide.active {
            border: 5px solid #ff9933;
            color: #000;
            background: transparent;
        }

        .sidebar-contact.left.active {
            background: transparent;
        }

        .active {
            background: #ff9933;
            color: #fff;
            font-size: 14px;
            font-weight: 600;
        }

        .toggle.l.pulse.active {
            background: #000000;
        }

    </style>
@endpush
@section('dispatch-content')

    <main class="main">
        <div class="container-fluid">
            @include('dispatch.header')
            {{-- Book Now --}}
            @include('dispatch.book-now')

            {{-- Book Later --}}
            {{-- @include('dispatch.book-later') --}}

            <div class="row g-0">
                <div class="col ps-md-2 mb-2" style="padding-right: 0 !important;">
                    <div class="card h-lg-100 overflow-hidden">
                        <div class="card-body d-flex align-items-center p-2" style="height: calc(100vh - 100px);">

                            <div id="map"></div>

                            <div id="legend">
                                <h5>@lang('view_pages.legend')</h5>
                            </div>

                            {{-- List requests --}}
                            <div class="sidebar-contact left active">
                                <div class="toggle l pulse">
                                    <i class="fas fa-align-justify"></i>
                                </div>
                                <div id="request-lists-target">
                                    <include-fragment src="{{ url('fetch/request_lists') }}">
                                        <span style="text-align: center;font-weight: bold;"> @lang('view_pages.loading')</span>
                                    </include-fragment>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

@endsection

@push('dispatch-js')

    <script src="{{ asset('assets/js/fetchdata.min.js') }}"></script>
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:100,200,300,400,500,600,700,800,900&amp;display=swap"
        rel="stylesheet">
        <script type="text/javascript"
        src="https://maps.google.com/maps/api/js?key={{get_settings('google_map_key')}}&libraries=places"></script>

    <script>
        var lat = parseFloat("{{ auth()->user()->admin->serviceLocationDetail->zones()->pluck('lat')->first() ?? 11.015956}}");
        var lng = parseFloat("{{ auth()->user()->admin->serviceLocationDetail->zones()->pluck('lng')->first() ?? 76.968985}}");



        function fetchRequestList(column = null, value = null) {
            let query = '';
            if (column && value)
                query = column + '=' + value

            $(function() {
                var url = '{{ url('fetch/request_lists') }}?' + query;
                fetch(url)
                    .then(response => response.text())
                    .then(html => {
                        document.querySelector('#request-lists-target').innerHTML = html;
                    });
            });
        }

        $('body').on('click', '.pagination a', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            $.get(url, $('#search').serialize(), function(data) {
                $('#request-lists-target').html(data);
            });
        });

        $(document).on('click', '.tripStatusFilter', function() {
            var col = $(this).attr('data-tripstatus');
            var val = $(this).attr('data-val');

            if (col == 'all')
                fetchRequestList();
            else
                fetchRequestList(col, val);
        })

    </script>

    @stack('booking-scripts')



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />

    <script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-database.js"></script>

    <script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-analytics.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>

<script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-database.js"></script>
<!-- TODO: Add SDKs for Firebase products that you want to use https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-analytics.js"></script>


<script>
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
    var map = L.map('map').setView([55.4, 0.2], 5);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors'
    }).addTo(map);

    var iconBase = '{{ asset("map/icon/") }}';
    var icons = {
        car_available: iconBase + '/driver_available.png',
        car_ontrip: iconBase + '/driver_on_trip.png',
        car_offline: iconBase + '/driver_off_trip.png',
        bike_available: iconBase + '/available-bike.png',
        bike_ontrip: iconBase + '/ontrip-bike.png',
        bike_offline: iconBase + '/offline-bike.png',
        truck_available: iconBase + '/available-truck.png',
        truck_ontrip: iconBase + '/ontrip-truck.png',
        truck_offline: iconBase + '/offline-truck.png',
    };
    var legend = L.control({ position: 'bottomright' });

legend.onAdd = function (map) {
    var div = L.DomUtil.create('div', 'info legend');
    var labels = ['Available', 'OnTrip', 'Offline'];
    var fliter_icons = {
        available: {
            name: 'Available',
            icon: iconBase + '/available.png'
        },
        ontrip: {
            name: 'OnTrip',
            icon: iconBase + '/ontrip.png'
        },
        offline: {
            name: 'Offline',
            icon: iconBase + '/offline.png'
        }
    };

    for (var key in fliter_icons) {
        var type = fliter_icons[key];
        var name = type.name;
        var icon = type.icon;
        var divItem = document.createElement('div'); // Changed variable name to divItem
        divItem.innerHTML = '<img src="' + icon + '"> ' + name;
        divItem.style.marginBottom = '5px'; // Add some spacing between legend items
        div.appendChild(divItem); // Changed from legend.appendChild(divItem) to div.appendChild(divItem)
    }

    return div;
};

legend.addTo(map);

    var driversRef = firebase.database().ref('drivers');

    driversRef.on('value', async function(snapshot) {
        var data = snapshot.val();

        await loadDriverIcons(data);
    });

    var markers = [];

    function loadDriverIcons(data) {
        markers.forEach(marker => {
            map.removeLayer(marker);
        });

        markers = [];

        Object.values(data).forEach(val => {
            if (typeof val.l !== 'undefined') {
                var iconImg = getDriverIcon(val);

                var marker = L.marker([val.l[0], val.l[1]], { icon: iconImg })
                    .bindPopup(getPopupContent(val))
                    .addTo(map);

                markers.push(marker);
            }
        });
    }

    function getDriverIcon(driver) {
        var date = new Date();
        var timestamp = date.getTime();
        var conditionalTimestamp = new Date(timestamp - 5 * 60000);

        if (conditionalTimestamp > driver.updated_at) {
            return L.icon({ iconUrl: icons['car_offline'] });
        } else {
            if (driver.is_available == true && driver.is_active == true) {
                return L.icon({ iconUrl: icons['car_available'] });
            } else if (driver.is_active == true && driver.is_available == false) {
                return L.icon({ iconUrl: icons['car_ontrip'] });
            } else {
                return L.icon({ iconUrl: icons['car_offline'] });
            }
        }
    }

    function getPopupContent(driver) {
        return `
            <div class="p-2">
                <h6><i class="fa fa-id-badge"></i> : ${driver.name ?? '-'}</h6>
                <h6><i class="fa fa-phone-square"></i> : ${driver.mobile ?? '-'}</h6>
                <h6><i class="fa fa-id-card"></i> : ${driver.vehicle_number ?? '-'}</h6>
                <h6><i class="fa fa-truck"></i> : ${driver.vehicle_type_name ?? '-'}</h6>
            </div>`;
    }





    function formInputReset() {
            $('#tripForm').trigger("reset");
            $("#receiverName").prop("readonly", false);
            $("#receiverPhone").prop("readonly", false);
            $(".truck-types").removeClass('active');
            $("#vehicleTypeDiv").addClass('d-none');
            $('.etaprice').html(`<i class="fas fa-wallet"></i><span> - - - </span>`);
            $('.etatime').html(`<i class="far fa-clock"></i> <span> - - - </span>`);
            $('.etadistance').html(`<i class="fas fa-map-marker-alt"></i> - - - </span>`);
        }




    $(document).on('click', '.booking_screen', function() {
            formInputReset();

            let modal = $(this).attr('data-id');
            $('#book-now').attr('data-modal', modal)

            $('.datetimepicker').removeClass('required_for_valid');
            $('.datetimepicker').removeAttr('required');

            if (modal == 'book-now') {
                $('.date-option').addClass('d-none');
                $('.modal-title').text('Taxi Book Now');
                 $('#book-now').modal('show');
                 $('.arrival-time').addClass('d-none');
            } else if (modal == 'book-later')  {
                $('.arrival-time').removeClass('d-none');
                $('.date-option').removeClass('d-none');
                $('.datetimepicker').addClass('required_for_valid');
                $('.datetimepicker').prop('required', true);
                $('.modal-title').text('Taxi Book Later');
                $('#book-now').modal('show');
            } else  if (modal == 'book-now-delivery') {
                alert('book-now-delivery');
            } else {
                alert('book-later-delivery');
            }

            // $('#book-now').modal('show');


        });


    </script>
@endpush

@elseif($value=="google")
<style>
    #legend {
        font-family: Arial, sans-serif;
        background: #fff;
        /*transparent;*/
        padding: 5px;
        margin: 5px;
        border: 3px solid #000;
        width: 10%;
        font-size: 8px;
    }

    #legend div {
        display: flex;
        align-items: center;
    }

    #legend h5 {
        margin-top: 0;
        font-size: 15px;
    }

    #legend img {
        vertical-align: middle;
        width: 35px;
        height: 35px;
        margin: 0 10px;
        padding-top: 3px;
        vertical-align: sub;
    }

    #legend .text {
        font-weight: bold;
        font-size: 10px;
        font-style: italic;
    }

    .etarow {
        padding: 5px;
        background: aliceblue;
        margin: 3px;
    }

    .etarow div {
        font-size: larger;
        font-weight: bolder;
    }

    .detail-popup {
        display: none;
        width: 100%;
        max-width: 100%;
        height: 100%;
    }

    .detail-overflow {
        height: 89vh;
        overflow-y: scroll;
        overflow-x: hidden;
        margin-right: 25px;
    }

    .btn-type {
        width: 32%;
        border-radius: 0;
    }

    .detail-overflow::-webkit-scrollbar {
        width: 3px;
    }

    .detail-overflow::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .detail-overflow::-webkit-scrollbar-thumb {
        background: #888;
    }

    .detail-overflow::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    .f-12 {
        font-size: 12px;
    }

    #map {
        height: calc(100vh - 120px);
        width: 100%;
        padding: 10px;
    }

    .modal-content {
        height: 90vh;
    }

    #book-now-map,
    #book-later-map,
    #box-content {
        width: 100%;
        height: calc(80vh - 100px);
        padding: 10px;
        overflow-y: scroll;
        overflow-x: hidden;
    }

    #box-content::-webkit-scrollbar {
        width: 3px;
    }

    #box-content::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    #box-content::-webkit-scrollbar-thumb {
        background: #888;
    }

    #box-content::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    a.notification:hover,
    a.notification:focus {
        background-color: aquamarine;
    }

    .packages .fs--1 {
        font-size: .83333rem !important;
    }

    .body-type li {
        list-style: none;
        padding: 5px;
        background: bisque;
        border-radius: 5px;
        text-align: center;
        margin: 3px;
        cursor: pointer;
    }

    .notification-avatar {
        margin-left: auto;
        margin-top: auto;
        margin-bottom: auto;
    }

    .truck-types img {
        width: 55px;
    }

    .truck-types {
        padding: 0px 30px;
        height: 70px;
        margin: 0 0 25px 10px;
        cursor: pointer;
        width: auto;
        text-align: center;
        border: 5px solid #dddddd;
        border-radius: 5px;
    }

    .truck-types:hover,
    .truck-types:focus {
        border: 5px solid #ff9933;
    }

    .pac-container {
        z-index: 10000 !important;
    }

    .iti {
        width: 100%;
    }

    .iti__flag {
        background-image: {{ asset('assets/build/img/flags.png') }};
    }

    @media (-webkit-min-device-pixel-ratio: 2),
    (min-resolution: 192dpi) {
        .iti__flag {
            background-image: {{ asset('assets/build/img/flags@2x.png') }};
        }
    }

    .swiper-slide p {
        margin-top: 15px;
    }

    .swiper-slide.active {
        border: 5px solid #ff9933;
        color: #000;
        background: transparent;
    }

    .sidebar-contact.left.active {
        background: transparent;
    }

    .active {
        background: #ff9933;
        color: #fff;
        font-size: 14px;
        font-weight: 600;
    }

    .toggle.l.pulse.active {
        background: #000000;
    }

</style>
@endpush
@section('dispatch-content')

<main class="main">
    <div class="container-fluid">
        @include('dispatch.header')
        {{-- Book Now --}}
        @include('dispatch.book-now')

        {{-- Book Later --}}
        {{-- @include('dispatch.book-later') --}}

        <div class="row g-0">
            <div class="col ps-md-2 mb-2" style="padding-right: 0 !important;">
                <div class="card h-lg-100 overflow-hidden">
                    <div class="card-body d-flex align-items-center p-2" style="height: calc(100vh - 100px);">

                        <div id="map"></div>

                        <div id="legend">
                            <h5>@lang('view_pages.legend')</h5>
                        </div>

                        {{-- List requests --}}
                        <div class="sidebar-contact left active">
                            <div class="toggle l pulse">
                                <i class="fas fa-align-justify"></i>
                            </div>
                            <div id="request-lists-target">
                                <include-fragment src="{{ url('fetch/request_lists') }}">
                                    <span style="text-align: center;font-weight: bold;"> @lang('view_pages.loading')</span>
                                </include-fragment>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</main>

@endsection

@push('dispatch-js')

<script src="{{ asset('assets/js/fetchdata.min.js') }}"></script>
<link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:100,200,300,400,500,600,700,800,900&amp;display=swap"
    rel="stylesheet">


<script type="text/javascript"
    src="https://maps.google.com/maps/api/js?key={{get_settings('google_map_key')}}&libraries=places"></script>

<script>
    var lat = parseFloat("{{ auth()->user()->admin->serviceLocationDetail->zones()->pluck('lat')->first() ?? 11.015956}}");
    var lng = parseFloat("{{ auth()->user()->admin->serviceLocationDetail->zones()->pluck('lng')->first() ?? 76.968985}}");

    // Get user current location
    // if (navigator.geolocation) {
    //     navigator.geolocation.getCurrentPosition(position => {
    //         lat = position.coords.latitude
    //         lng = position.coords.longitude
    //         loadMap(lat,lng);
    //     },
    //     err => {
    //         loadMap(lat,lng);
    //     });
    // }else{
    //     loadMap(lat,lng);
    // }
    // loadMap(lat,lng);

    // function loadMap(lat,lng) {
    //     var map = new google.maps.Map(document.getElementById("map"), {
    //         center: new google.maps.LatLng(lat, lng),
    //         zoom: 13,
    //         mapTypeId: google.maps.MapTypeId.ROADMAP
    //     });
    // }

    function fetchRequestList(column = null, value = null) {
        let query = '';
        if (column && value)
            query = column + '=' + value

        $(function() {
            var url = '{{ url('fetch/request_lists') }}?' + query;
            fetch(url)
                .then(response => response.text())
                .then(html => {
                    document.querySelector('#request-lists-target').innerHTML = html;
                });
        });
    }

    $('body').on('click', '.pagination a', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        $.get(url, $('#search').serialize(), function(data) {
            $('#request-lists-target').html(data);
        });
    });

    $(document).on('click', '.tripStatusFilter', function() {
        var col = $(this).attr('data-tripstatus');
        var val = $(this).attr('data-val');

        if (col == 'all')
            fetchRequestList();
        else
            fetchRequestList(col, val);
    })

</script>

@stack('booking-scripts')

<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-database.js"></script>
<!-- TODO: Add SDKs for Firebase products that you want to use https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-analytics.js"></script>


<script type="text/javascript">
    var shouldProcessChildAdded = false;
    $(document).ready(function(){
        console.log("testttttin");
    })
    var heatmapData = [];
    var pickLat = [];
    var pickLng = [];
    var default_lat = lat;
    var default_lng = lng;
    var driverLat, driverLng, bearing, type;
    var marker = [];
    var onTrip, available, offline;
    onTrip = available = offline = true;

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

    var tripRef = firebase.database().ref('drivers');
    var requestRef = firebase.database().ref('requests');

    tripRef.on('value', async function(snapshot) {
        var data = snapshot.val();
        console.log("data");
        console.log(data);


        await loadDriverIcons(data);
    });
    function strLimit(str, limit) {
if (str.length <= limit) {
    return str;
} else {
    return str.substring(0, limit) + '...';
}
}
    requestRef.on('child_added', async function(snapshot) {
        if (shouldProcessChildAdded)
    {
        var tripaddedData = snapshot.val();
        var key = snapshot.key;
        var length = Object.keys(tripaddedData).length;
        var truncatedAddress = strLimit(tripaddedData.pick_address, 30);
        var is_dispatch=tripaddedData
        var newRow = `<tr class="btn-reveal-trigger">
                            <td class="align-middle">
                                <a href="{{url('/')}}request/detail_view/${key}" data-id="${key}">
                                ${tripaddedData.request_number}
                            </a>
                            </td>
                            <td class="py-2 align-middle">
                            ${tripaddedData.date}
                            </td>
                            <td class="py-2 align-middle pl-5">
                            ${truncatedAddress}
                            </td>
                            <td class="align-middle fs-0" id="${key}">
                            <span class="badge badge rounded-capsule badge-soft-dark">
                                        Searching
                                        <div class="spinner-border text-dark" style="width: 1rem;height: 1rem;"
                                            role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </span>
                            </td>
                            <td class="py-2 align-middle pl-5" id="view-${key}" >
                              <a href="{{url('/')}}/request/cancelRide/${key}" data-id="${key}">
                              <button type="button" class="btn btn-primary btn-sm turned-button mx-4 cancel_ride">Cancel Ride</button>
                                </a>
                            </td>

                        </tr>` ;
        $("#customers").prepend(newRow);
        var rowCount = $("#customers tr").length;
        if (rowCount >= 11) {
            $("#customers tr:nth-child(10)").remove();
        }
        console.log("successfully working");
    }

    });
    setTimeout(function() {
shouldProcessChildAdded = true;
}, 4000);
    requestRef.on('child_changed', async function(snapshot) {
        var val = snapshot.val();
        var key = snapshot.key;
        var length = Object.keys(val).length;
        console.log(val);
        console.log(val.request_id);
            if (val.request_id != 'undefined') {
                var status = $('#' + val.request_id);
                console.log('#' + val.request_id);
                var statusTxt =
                    `<span class="badge badge rounded-capsule badge-soft-<<color>>"><<status>><<loader>></span>`
                if (val.is_completed == true) {
                    $('#' + val.request_id).html('<span class="badge badge rounded-capsule badge-soft-success">Completed</span>');
                    $('#view-' + val.request_id).html('<a href="{{url('/')}}/request/detail_view/'+key+'" data-id="'+key+'"><button type="button" class="btn btn-primary btn-sm turned-button mx-4">View</button> </a>');

                } else if (val.is_cancelled == true) {
                    $('#' + val.request_id).html('<span class="badge badge rounded-capsule badge-soft-danger">Cancelled</span>');
                } else if (val.cancelled_by_user == true) {
                    $('#' + val.request_id).html('<span class="badge badge rounded-capsule badge-soft-danger">Cancelled</span>');
                }
                 else if (val.trip_start == 1) {
                    $('#' + val.request_id).html('<span class="badge badge rounded-capsule badge-soft-success">Trip Started</span>');
                } else if (val.trip_arrived == 1) {
                    $('#' + val.request_id).html('<span class="badge badge rounded-capsule badge-soft-warning">Driver Arrived</span>');
                }
                else if (val.is_accept == 1 ) {
                    $('#' + val.request_id).html('<span class="badge badge rounded-capsule badge-soft-warning">Driver on the way</span>');
                }
                else {
                    $('#' + val.request_id).html('<span class="badge badge rounded-capsule badge-soft-dark">Searching</span>');
                }
                // status.html(statusTxt);
            }
    });

    var map = new google.maps.Map(document.getElementById('map'), {
        center: new google.maps.LatLng(default_lat, default_lng),
        zoom: 7,
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

    var iconBase = '{{ asset('map/icon/') }}';
    var icons = {
        available: {
            name: 'Available',
            icon: iconBase + '/taxi0.svg'
        },
        ontrip: {
            name: 'OnTrip',
            icon: iconBase + '/taxi1.svg'
        },
        offline: {
            name: 'Offline',
            icon: iconBase + '/taxi.svg'
        }
    };

    var legend = document.getElementById('legend');

    for (var key in icons) {
        var type = icons[key];
        var name = type.name;
        var icon = type.icon;
        var div = document.createElement('div');
        div.innerHTML = `<input type="checkbox" data-status="${key}" class="status" checked>` +
            '<img src="' + icon + '"> ' +
            `<span class="text">${name}</span>`;
        legend.appendChild(div);
    }

    map.controls[google.maps.ControlPosition.RIGHT_CENTER].push(legend);

    // Load all driver icons by availability and set info window
    function loadDriverIcons(data) {
        deleteAllMarkers();

        Object.entries(data).forEach(([key, val]) => {
            if (typeof val.l != 'undefined') {
                var contentString = `<div class="p-2">
                <h6><i class="fa fa-id-badge"></i> : ${val.name ?? '-' } </h6>
                <h6><i class="fa fa-phone-square"></i> : ${val.mobile ?? '-'} </h6>
                <h6><i class="fa fa-id-card"></i> : ${val.vehicle_number ?? '-'} </h6>
                <h6><i class="fa fa-truck"></i> : ${val.vehicle_type_name ?? '-'} </h6>
            </div>`;

                var infowindow = new google.maps.InfoWindow({
                    content: contentString
                });

                var iconImg = '';
                if(val.is_active == true && available){
                    if(val.is_available == true){
                    iconImg = icons['available'].icon;
                    }else if(onTrip){
                    iconImg = icons['ontrip'].icon;
                    }
                }else if(offline){
                    iconImg = icons['offline'].icon;
                }

                var carIcon = new google.maps.Marker({
                    position: new google.maps.LatLng(val.l[0], val.l[1]),
                     // animation: google.maps.Animation.DROP,
                    icon: {
                        url: iconImg,
                        scaledSize: new google.maps.Size(35, 35)
                    },
                    map: map
                });


                carIcon.addListener('click', function() {
                    infowindow.open(map, carIcon);
                });


                marker.push(carIcon);
                carIcon.setMap(map);





                // rotateMarker(iconImg, bearing);
            }
        });
    }



    // To rotate truck based on driver bearing
    function rotateMarker(carimage, bearing) {
        var bearing = Math.floor((Math.random() * 180) + 0);
        document.querySelectorAll(`img[src='${carimage}']`).style.transform = 'rotate(' + bearing + 'deg)';
    }

    // Filter available and ontrip drivers
    $(document).on('click', '.status', function() {
        var checked = $(this).prop('checked');
        var tripStatus = $(this).attr('data-status');

        if (checked) {
            if (tripStatus == 'available') {
                available = true;
            } else if(tripStatus == "offline"){
                offline = true;
            }else {
                onTrip = true;
            }
        } else {
            if (tripStatus == 'available') {
                available = false;
            } else if(tripStatus == "offline"){
                offline = false;
            }else {
                onTrip = false;
            }
        }

        tripRef.on('value', async function(snapshot) {
            var data = snapshot.val();

            await loadDriverIcons(data);
        });
    });

    // Delete truck icons once map reloads
    function deleteAllMarkers() {
        for (var i = 0; i < marker.length; i++) {
            marker[i].setMap(null);
        }
    }

    // To error alert
    function closeFancyBox() {
        $.fancybox.close();
    }


    function formInputReset() {
        $('#tripForm').trigger("reset");
        $("#receiverName").prop("readonly", false);
        $("#receiverPhone").prop("readonly", false);
        $(".truck-types").removeClass('active');
        $("#vehicleTypeDiv").addClass('d-none');
        $('.etaprice').html(`<i class="fas fa-wallet"></i><span> - - - </span>`);
        $('.etatime').html(`<i class="far fa-clock"></i> <span> - - - </span>`);
        $('.etadistance').html(`<i class="fas fa-map-marker-alt"></i> - - - </span>`);
    }

    $(document).on('click', '.booking_screen', function() {
        formInputReset();

        let modal = $(this).attr('data-id');
        $('#book-now').attr('data-modal', modal)

        $('.datetimepicker').removeClass('required_for_valid');
        $('.datetimepicker').removeAttr('required');

        if (modal == 'book-now') {
            $('.date-option').addClass('d-none');
            $('.modal-title').text('Taxi Book Now');
             $('#book-now').modal('show');
             $('.arrival-time').addClass('d-none');
        } else if (modal == 'book-later')  {
            $('.arrival-time').removeClass('d-none');
            $('.date-option').removeClass('d-none');
            $('.datetimepicker').addClass('required_for_valid');
            $('.datetimepicker').prop('required', true);
            $('.modal-title').text('Taxi Book Later');
            $('#book-now').modal('show');
        } else  if (modal == 'book-now-delivery') {
            alert('book-now-delivery');
        } else {
            alert('book-later-delivery');
        }

        // $('#book-now').modal('show');


    });

</script>
@endpush

@endif

