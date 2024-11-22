@extends('admin.layouts.app')

@section('content')

    <!-- Morris charts -->
    <link rel="stylesheet" href{!! asset('assets/vendor_components/morris.js/morris.css') !!}">
    <style>
        .text-red {
            color: red;
        }

        .demo-radio-button label {
            font-size: 15px;
            font-weight: 600 !important;
            margin-bottom: 5px !important;
        }

        .box-title {
            font-size: 15px;
            margin: 0 0 7px 0;
            margin-bottom: 7px;
            font-weight: 600;
        }

        .total-earnings-text {
            font-size: 15px;
        }

        .total-earnings {
            font-size: 30px;
            margin-bottom: 60px;
        }
        #map {
            height: 50vh;
            margin: 10px;
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
            @foreach ($card as $item)
                <div class="col-xl-3 col-md-6 col-12">
                    <div class="box box-body">
                        <h5 class="text-capitalize">{{ $item['display_name'] }}</h5>
                        <div class="flexbox wid-icons mt-2">
                            <span class="{{ $item['icon'] }} font-size-40"></span>
                            <span class=" font-size-30">{{ $item['count'] }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-body">
                        <h5> We are Developing Dashboard. Will update the feature soon </h5>
                        <!--  <div class="media pl-0">
                            <div >
                                <img src="{{ asset('assets/images/profile.svg') }}" width="80" alt="profile">
                            </div>

                            <div class="media-body">
                                <div class="text-muted">
                                    <h5>Arjun</h5>
                                    <p class="mb-1">arjun@tagxi.com</p>
                                    <p class="mb-0">Id no: #SK0234</p>
                                </div>
                            </div>
                        </div> -->
                    </div>
                    <!-- <div class="box-body border-top pt-4 pb-4">
                        <div class="row">
                            <div class="col-sm-6">
                                <div>
                                    <p class="text-muted mb-2">Admin Earnings</p>
                                    <h4>$ 9148.23</h4>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-right mt-4 mt-sm-0">
                                    <p class="text-muted mb-2">Driver Earnings</p>
                                    <h4> $ 248.35</h4>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div> --}}

 <div class="row">
            <div class="col-12">

                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">@lang('view_pages.map_view')</h4>
                <div id="map"></div>
                <div id="legend"><h3>@lang('view_pages.legend')</h3></div>
                </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">@lang('view_pages.trip_verview')</h4>
                        <ul class="box-controls pull-right">
                            <li><a class="box-btn-slide" href="#"></a></li>
                            <li><a class="box-btn-fullscreen" href="#"></a></li>
                        </ul>
                    </div>
                    <div class="box-body">
                        <div class="chart-responsive">
                            <div class="chart" id="bar-chart" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">@lang('view_pages.earnings_overview')</h4>
                        <ul class="box-controls pull-right">
                            <li><a class="box-btn-slide" href="#"></a></li>
                            <li><a class="box-btn-fullscreen" href="#"></a></li>
                        </ul>
                    </div>
                    <div class="box-body chart-responsive">
                        <div class="chart" id="revenue-chart" style="height: 300px;"></div>
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
    var default_lat = '{{ $default_lat ??  get_settings('default_latitude') }}';
    var default_lng = '{{ $default_lng ?? get_settings('default_longitude') }}';
     var company_key='{{auth()->user()->company_key}}';

    var driverLat,driverLng,bearing,type;

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
          available: {
            name: 'Available',
            icon: iconBase + '/driver_available.png'
          },
          ontrip: {
            name: 'OnTrip',
            icon: iconBase + '/driver_on_trip.png'
          }
        };

        var legend = document.getElementById('legend');

        for (var key in icons) {
            var type = icons[key];
            var name = type.name;
            var icon = type.icon;
            var div = document.createElement('div');
            div.innerHTML = '<img src="' + icon + '"> ' + name;
            legend.appendChild(div);
        }

        map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(legend);

    function loadDriverIcons(data){
        // var result = Object.entries(data);
        Object.entries(data).forEach(([key, val]) => {
            // var infowindow = new google.maps.InfoWindow({
            //     content: contentString
            // });

            var iconImg = '';
            if(val.company_key==company_key){
                 if(val.is_available == true && val.is_active==true){
                iconImg = icons['available'].icon;
            }else if(val.is_active==true && val.is_available==false){
                iconImg = icons['ontrip'].icon;
            }else{
                iconImg = icons['available'].icon;
                //@TODO
            }

            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(val.l[0],val.l[1]),
                icon: iconImg,
                map: map
            });

            }

            // marker.addListener('click', function() {
            //     infowindow.open(map, marker);
            // });
        });
    }
</script>
@endsection


@section('extra-scripts')

    <!-- Morris.js charts -->
    <script src="{{asset('assets/vendor_components/raphael/raphael.min.js') }}"></script>
    <script src="{{asset('assets/vendor_components/morris.js/morris.min.js') }}"></script>

<script>
$(function () {
    const monthNames = ["", "Jan", "Feb", "Mar", "Apr", "May", "Jun",
        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
    ];

    var earningData = JSON.parse('<?php echo json_encode($earningsData) ?>');
    earningData = Object.values(earningData);

    var area = new Morris.Area({
      element: 'revenue-chart',
      parseTime: false,
      resize: true,
      data: earningData,
        xkey: 'y',
        xLabelFormat: function (x) {
            var index = parseInt(x.src.y);
            return monthNames[index];
        },
        xLabels: "month",
        ykeys: ['a'],
        labels: ['Monthly Earnings'],
        fillOpacity: 1,
        lineWidth:1,
        lineColors: ['#7460ee', '#ffb22b'],
        hideHover: 'auto',
        color: '#666666'
    });

    var barData = JSON.parse('<?php echo json_encode($data) ?>');
    barData = Object.values(barData);
    var bar = new Morris.Bar({
      element: 'bar-chart',
      resize: true,
      data: barData,
        barColors: ['#26c6da','#fc4b6c'],
        barSizeRatio: 0.5,
        barGap:5,
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Completed', 'Cancelled'],
        hideHover: 'auto',
        color: '#666666'
    });
});

</script>

@endsection
