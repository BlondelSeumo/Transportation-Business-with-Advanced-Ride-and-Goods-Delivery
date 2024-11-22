

@extends('admin.layouts.app')

@section('title', 'Map View')

@section('content')





@php


$value=web_map_settings();
@endphp
@if($value=="google")



<style>
    #map {
        height: 70vh;
        margin: 15px;
    }
    #legend {
        font-family: Arial, sans-serif;
        background: #fff;
        padding: 10px;
        margin: 10px;
        border: 3px solid #000;
    }
    #legend h3 {
        margin-top: 0;
    }
    #legend img {
        vertical-align: middle;
    }
</style>
<!-- Start Page content -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box">

                <div class="box-header with-border">
                    <h3>{{ $page }}</h3>
                </div>
                {{-- <div class="col-sm-12">

                    <form id="god_eye">
                        @csrf

                <div class="row">
                     <div class="col-sm-6">

                            <label for="search-box" class="form-label">@lang('view_pages.search_area')</label>
                            <input id="search-box" class="search__input form-control  p-5" type="text" placeholder="@lang('view_pages.search')" style="height: 40px" required/>
                            <input type="hidden" id="lat" name="lat" value="">
                            <input type="hidden" id="lng" name="lng" value="">
                            <input type="hidden" id="formatted_address" name="formatted_address" value="">

                            </div>
                  <div class="col-sm-6">

                                    <label for="radius" class="form-label">@lang('view_pages.within_distance') (km)</label>
                            <select name="radius" id="radius" placeholder="{{ __('view_pages.within_distance') }}" class="form-control" required>
                                <option value="100"{{ __('view_pages.select') }}  >100</option>
                                <option value="50" {{ old('radius') == '50' ? 'selected' : '' }}>50</option>
                                <option value="25" {{ old('radius') == '25' ? 'selected' : '' }}>25</option>
                            </select>

                            </div>

                </div>


                            <div class="col-12">
                                <button class="btn btn-primary btn-sm pull-right m-5" type="submit">
                                    @lang('view_pages.save')
                                </button>
                            </div>

                    </form>
                </div> --}}

                        <div id="map"></div>

                        <div id="legend"><h3>@lang('view_pages.legend')</h3></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


<script type="text/javascript" src="https://maps.google.com/maps/api/js?key={{get_settings('google_map_key')}}&libraries=visualization"></script>

<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-database.js"></script>
<!-- TODO: Add SDKs for Firebase products that you want to use https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-analytics.js"></script>

<script type="text/javascript">
    var heatmapData = [];
    var pickLat = [];
    var pickLng = [];
     var default_lat = '{{$default_lat}}';
    var default_lng = '{{$default_lng}}';
     var company_key='{{auth()->user()->company_key}}';
    var driverLat,driverLng,bearing,type;
    var marker = [];


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

    tripRef.on('value', async function(snapshot) {
        var data = snapshot.val();

        await loadDriverIcons(data);
    });

    var map = new google.maps.Map(document.getElementById('map'), {
            center: new google.maps.LatLng(default_lat, default_lng),
            zoom: 5,
            mapTypeId: 'roadmap'
        });

        var iconBase = '{{ asset("map/icon/") }}';
        var icons = {
          car_available: {
            name: 'Available',
            icon: iconBase + '/driver_available.png'
          },
          car_ontrip: {
            name: 'OnTrip',
            icon: iconBase + '/driver_on_trip.png'
          },
         car_offline: {
            name: 'Offline',
            icon: iconBase + '/driver_off_trip.png'
         },
         bike_available: {
            name: 'Available',
            icon: iconBase + '/available-bike.png'
          },
          bike_ontrip: {
            name: 'OnTrip',
            icon: iconBase + '/ontrip-bike.png'
          },
          bike_offline: {
            name: 'Offline',
            icon: iconBase + '/offline-bike.png'
          },
          truck_available: {
            name: 'Available',
            icon: iconBase + '/available-truck.png'
          },
          truck_ontrip: {
            name: 'OnTrip',
            icon: iconBase + '/ontrip-truck.png'
          },
          truck_offline: {
            name: 'Offline',
            icon: iconBase + '/offline-truck.png'
          },
        };

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

        var legend = document.getElementById('legend');

        for (var key in fliter_icons) {
            var type = fliter_icons[key];
            var name = type.name;
            var icon = type.icon;
            var div = document.createElement('div');
            div.innerHTML = '<img src="' + icon + '"> ' + name;
            legend.appendChild(div);
        }

        map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(legend);

    function loadDriverIcons(data){
        deleteAllMarkers();

        Object.entries(data).forEach(([key, val]) => {
            if( typeof val.l !=  'undefined'  ) {
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

            var date = new Date();
            var timestamp = date.getTime();
            var conditional_timestamp = new Date(timestamp - 5 * 60000);
            //    console.log(conditional_timestamp,val.updated_at,conditional_timestamp < val.updated_at);
            if(conditional_timestamp > val.updated_at){
                if(val.vehicle_type_icon=='taxi'){
                    iconImg = icons['car_offline'].icon;
                }else if(val.vehicle_type_icon=='motor_bike'){
                    iconImg = icons['bike_offline'].icon;
                }else if(val.vehicle_type_icon=='truck'){
                    iconImg = icons['truck_offline'].icon;
                }else{
                    iconImg = icons['car_offline'].icon;

                }
            }else{
                if(val.is_available == true && val.is_active==true){
                    if(val.vehicle_type_icon=='taxi'){
                    iconImg = icons['car_available'].icon;
                    }else if(val.vehicle_type_icon=='motor_bike'){
                    iconImg = icons['bike_available'].icon;
                    }else if(val.vehicle_type_icon=='truck'){
                    iconImg = icons['truck_available'].icon;
                    }else{
                    iconImg = icons['car_available'].icon;

                    }
                }else if(val.is_active==true && val.is_available==false){
                    if(val.vehicle_type_icon=='taxi'){
                    iconImg = icons['car_ontrip'].icon;
                    }else if(val.vehicle_type_icon=='motor_bike'){
                    iconImg = icons['bike_ontrip'].icon;
                    }else if(val.vehicle_type_icon=='truck'){
                    iconImg = icons['truck_ontrip'].icon;
                    }else{
                    iconImg = icons['car_ontrip'].icon;
                    }
                }else{

                    if(val.vehicle_type_icon=='taxi'){
                    iconImg = icons['car_offline'].icon;
                    }else if(val.vehicle_type_icon=='motor_bike'){
                    iconImg = icons['bike_offline'].icon;
                    }else if(val.vehicle_type_icon=='truck'){
                    iconImg = icons['truck_offline'].icon;
                    }else{
                    iconImg = icons['car_offline'].icon;

                    }
                }
            }
            // if(val.company_key==company_key){


            var carIcon = new google.maps.Marker({
                position: new google.maps.LatLng(val.l[0],val.l[1]),
                icon: iconImg,
                map: map
            });

            carIcon.addListener('click', function() {
                infowindow.open(map, carIcon);
            });

            marker.push(carIcon);
            carIcon.setMap(map);
            // }

            // marker.addListener('click', function() {
            //     infowindow.open(map, marker);
            // });
            }
        });
    }

    // Delete truck icons once map reloads
    function deleteAllMarkers() {
        for(var i=0;i<marker.length;i++){
            marker[i].setMap(null);
        }
    }



    function initAutocomplete() {
    var autocomplete = new google.maps.places.Autocomplete(
        document.getElementById('search-box'),
        { types: ['geocode'] }
    );
    autocomplete.addListener('place_changed', function () {
        var place = autocomplete.getPlace();
        var latitude = place.geometry.location.lat();
        var longitude = place.geometry.location.lng();
        var formatted_address = place.formatted_address;
        $('#lat').val(latitude);
        $('#lng').val(longitude);
        $('#formatted_address').val(formatted_address);
        // $('#search-box').trigger('input');
        $("#search-button").html('Data loading , Please wait...');
        ajaxrequest();
    });
}


$('#god_eye').on('submit',function (e){
        e.preventDefault();
        $("#search-button").html('Data loading , Please wait...');

     ajaxrequest();
    });


function ajaxrequest(){
        var formData = $("#god_eye").serialize();
        var lat = $("#lat").val();
        if(lat !== undefined)
        {
            $.ajax({
            url: '{{ route("fetchCity") }}',
            method: 'get',
            data: formData,
            success: function(results){
                 console.log(results.data);
                 console.log(typeof results);
                loadDriverIcons(results.data);
            }
        })
        }

    }
window.onload = function () {
    initAutocomplete();
};


</script>

















@elseif($value=="open_street")

<style>
    #map {
        height: 70vh;
        margin: 15px;
    }
    #legend {
        font-family: Arial, sans-serif;
        background: #fff;
        padding: 10px;
        margin: 10px;
        border: 3px solid #000;
    }
    #legend h3 {
        margin-top: 0;
    }
    #legend img {
        vertical-align: middle;
    }
</style>
<!-- Start Page content -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box">

                <div class="box-header with-border">
                    <h3>{{ $page }}</h3>
                </div>

                <div id="map"></div>

                <div id="legend"><h3>@lang('view_pages.legend')</h3></div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-database.js"></script>
<!-- TODO: Add SDKs for Firebase products that you want to use https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-analytics.js"></script>

<script type="text/javascript">
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
    var map = L.map('map').setView([{{$default_lat}}, {{$default_lng}}], 5);

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
</script>
@endif
@endsection
