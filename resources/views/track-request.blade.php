<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request - {{ app_name() ?? 'Tagxi' }}</title>
    <link rel="shortcut icon" href="{{ fav_icon() ?? asset('assets/images/favicon.png')}}">
    <link rel="stylesheet" href="{!! asset('css/track-request.css') !!}">
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
</style>

<body class="bg-gray-400">

    @if($request->is_completed || $request->is_cancelled)
    <!-- <div class="w-screen">
        <img src="{{ asset('map/logo.png') }}" alt="" class="w-full h-16 object-cover object-bottom">    
    </div> -->

    <div class="flex justify-center h-screen">
        <div class="flex-column text-black font-bold rounded-lg mt-40">
            <div class="flex justify-center">
                <img src="{{ asset('map/tick.png') }}" alt="" class="rounded w-10 h-10">
            </div>
            <p class="mt-5">@lang('view_pages.the_trip_has_ended')</p>
        </div>
    </div>
    @else
    <div class="lg:flex">
        <div class="lg:w-1/2 sm:w-full md:w-full sm:h-screen md:h-screen">
            <!-- Trip Details bg-orange-300 shadow-lg-->
            <div class="m-1 p-2 rounded shadow-lg">
                <div class="mx-auto flex justify-center items-center mb-5">
                    <!-- <div class="w-full text-center"> -->
                    <strong class="text-blue-900">{{ $request->request_number }} -</strong>
                    @if ($request->is_completed)
                    <p class="text-md text-black font-bold ml-3 trip_status">@lang('view_pages.trip_completed')</p>
                    @elseif ($request->is_cancelled)
                    <p class="text-md text-black font-bold ml-3 trip_status">@lang('view_pages.trip_cancelled')</p>
                    @elseif ($request->is_trip_start)
                    <p class="text-md text-black font-bold ml-3 trip_status">@lang('view_pages.on_going_ride')</p>
                    @else
                    <p class="text-md text-black font-bold ml-3 trip_status">@lang('view_pages.driver_is_on_the_way')</p>
                    @endif

                    <!-- </div> -->
                </div>
                <hr>
                <div class="flex justify-between items-center m-3">
                    <div class="flex-column">
                        <p class="font-sans leading-relaxed text-lg text-gray-700 text-center font-extrabold">@lang('view_pages.pickup')</p>
                        <p class="font-sans leading-relaxed text-lg text-gray-700 text-center font-extrabold">@lang('view_pages.drop')</p>
                    </div>
                    <div class="flex-column">
                        <p class="font-serif leading-relaxed text-lg text-black text-center font-hairline">{{ str_limit($request->requestPlace->pick_address,30) }}</p>
                        <p class="font-serif leading-relaxed text-lg text-black text-center font-hairline">{{ str_limit($request->requestPlace->drop_address,30) }}</p>
                    </div>
                </div>
            </div>

            <!-- Map -->
            <div class="lg:mt-10 mt-6">
                <div id="map"></div>
            </div>
@if($request->driverDetail)
            <!-- Driver Details -->
            <div class="bg-white rounded shadow-lg m-5 p-3 lg:mt-10">
                <div class="flex justify-between">
                    <div class="flex items-center">
                        <img src="{{ $request->zoneType->vehicleType->icon_image ?? 'https://cdn0.iconfinder.com/data/icons/isometric-city-basic-transport/480/car-front-02-128.png' }}" alt="" class="rounded shadow-lg" width="50" height="50">
                        <p class="ml-2 text-gray-900">{{ $request->zoneType->vehicleType->name }}</p>
                    </div>
                    <div class="flex">
                        <p>{{ $request->driverDetail->car_number }}</p>
                    </div>
                </div>

                <hr>

                <div class="flex justify-between m-2">
                    <div class="flex items-center">
                        <img src="{{ $request->driverDetail->user->profile_pic ?? 'https://cdn4.iconfinder.com/data/icons/rcons-user/32/child_boy-128.png' }}" alt="" class="rounded-full h-12 w-12 flex items-center justify-center" width="50" height="50">

                        <div class="flex-column ml-2">
                            <p class="text-gray-900">{{ ucfirst($request->driverDetail->name) }}</p>

                            <p class="flex flex-row">
                                @for($i = 0; $i < $request->driverDetail->user->rating; $i++)
                                    <img src="https://cdn2.iconfinder.com/data/icons/ios-7-icons/50/star-128.png" alt="" class="h-4 w-4 items-center justify-center bg-yellow">
                                    @endfor
                            </p>

                        </div>
                    </div>

                    <div class="flex">
                        <a href="tel:{{ $request->driverDetail->mobile }}">
                            <img src="https://www.iconfinder.com/data/icons/font-awesome/1792/phone-square-128.png" alt="" class="rounded" width="50" height="50">
                        </a>
                    </div>
                </div>

            </div>
        </div>
@endif        
        <div class="hidden lg:flex lg:w-1/2">
            <img src="{{ asset('images/Track3.jpg') }}" alt="" class="rounded w-full object-cover">
        </div>
    </div>




    <script type="text/javascript" src="https://maps.google.com/maps/api/js?key={{get_settings('google_map_key')}}&sensor=false&libraries=places"></script>

    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-database.js"></script>
    <!-- TODO: Add SDKs for Firebase products that you want to use https://firebase.google.com/docs/web/setup#available-libraries -->
    <script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-analytics.js"></script>

    <script type="text/javascript">
        var carimage = "{{ url('map/car.png') }}";
        var driverId = '{{ $request->driverDetail->id }}';
        var requestId = '{{ $request->id }}';
        var driverLat, driverLng, bearing;

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


        var tripRef = firebase.database().ref('requests/' + requestId);

        tripRef.on('value', async function(snapshot) {

            var data = snapshot.val();

            // console.log(data);

            driverLat = data.lat;
            driverLng = data.lng;
            bearing = data.bearing;

            await loadCarInMap(driverLat, driverLng, bearing, carimage);

            // await rotateMarker(bearing);
        });


        var area1, area2, icon1, icon2;

        area1 = "{{ $request->pick_address }}";
        area2 = "{{ $request->drop_address }}";
        icon1 = "{{ url('map/start_pin_flag.png') }}";
        icon2 = "{{ url('map/end_pin_flag.png') }}";

        var locations = [
            [area1, "{{ $request->pick_lat }}", "{{ $request->pick_lng }}", icon1],
            [area2, "{{ $request->drop_lat == null ? $request->pick_lat : $request->drop_lat }}", "{{ $request->drop_lng == null ? $request->pick_lng : $request->drop_lng }}", icon2],
        ];

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 13,
            center: new google.maps.LatLng(locations[1][1], locations[1][2]),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        // map new
        var infowindow = new google.maps.InfoWindow();
        var marker, i, carIcon;

        var markers = new Array();
        for (i = 0; i < locations.length; i++) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                icon: locations[i][3],
                map: map
            });
            markers.push(marker);
            marker.setMap(map);

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent(locations[i][0]);
                    infowindow.open(map, marker);
                }
            })(marker, i));
        }

        function loadCarInMap(driverLat, driverLng, bearing, carimage) {
            var icon = {
                url: carimage
            };

            icon.rotation += bearing;

            carIcon = new google.maps.Marker({
                title: 'carIcon',
                icon: icon,
                position: new google.maps.LatLng(driverLat, driverLng)
            });

            deleteCarIcon(carIcon);

            markers.push(carIcon);
            carIcon.setMap(map);

            setTimeout(() => {
                rotateMarker(carimage, bearing);
            }, 3000);
        }


        function rotateMarker(carimage, bearing) {
            document.querySelector(`img[src='${carimage}']`).style.transform = 'rotate(' + bearing + 'deg)';
            // document.querySelector("img[src='http://localhost/future/public/map/car.png']").style.transform = 'rotate(80deg)'
        }

        function deleteCarIcon() {
            for (var i = 0; i < markers.length; i++) {
                if (markers[i].hasOwnProperty('title')) {
                    if (markers[i].title == 'carIcon') {
                        markers[i].setMap(null);
                    }
                }
            }
        }
    </script>

    @endif

</body>

</html>