@extends('admin.layouts.app')

@section('title', 'Main page')

@section('content')


@php


$value=web_map_settings();
@endphp
@if($value=="google")


<style>
    #map {
    height: 400px;
    width: 80%;
    left: 10px;
    }
    html, body {
    padding: 0;
    margin: 0;
    height: 100%;
    }

    #panel {
    width: 200px;
    font-family: Arial, sans-serif;
    font-size: 13px;
    float: right;
    margin: 10px;
    margin-top: 100px;
    }

    #delete-button, #add-button, #delete-all-button, #save-button {
    margin-top: 5px;
    }
    #pac-input {
    background-color: #f7f7f7;
    font-size: 15px;
    font-weight: 300;
    margin-top: 10px;
    padding: 0 11px 0 13px;
    text-overflow: ellipsis;
    height: 25px;
    width: 70%;
    border: 1px solid #c7c7c7;
    }
    .map_icons{
    font-size: 24px;
    color: white;
    padding: 10px;
    background-color: #43439999;
    margin: 5px;
    }
    </style>

    <div class="content">
    <div class="container-fluid">
    <div class="row">
    <div class="col-sm-12">
    <div class="box">

    <div class="box-header with-border">
    <a href="{{ url('zone') }}">
    <button class="btn btn-danger btn-sm pull-right" type="submit">
    <i class="mdi mdi-keyboard-backspace mr-2"></i>
    @lang('view_pages.back')
    </button>
    </a>
    </div>
    <div class="col-sm-12">
    <div class="row">
    <div class="col-sm-12">
    <div id="map" class="col-sm-9" style="float:left;"></div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>

       <script type="text/javascript" src="https://maps.google.com/maps/api/js?key={{get_settings('google_map_key')}}&sensor=false&libraries=places"></script>

        <script type="text/javascript">
            var drawingManager;
            var data= '{{$zones}}';
            var default_lat = '{{$default_lat}}';
            var default_lng = '{{$default_lng}}';
            let zones = JSON.parse(data.replace(/&quot;/g,'"'));
            // console.log(zones);
        function initialize() {

        var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 8,
        center: new google.maps.LatLng(default_lat, default_lng),
        mapTypeId: 'terrain'
      });
        var i;
        var polygon;
        for (i = 0; i < zones.length; i++) {
        polygon = new google.maps.Polygon({
        map: map,
        paths: zones[i],
        strokeColor: "#FF0000",
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: "#FF0000",
        fillOpacity: 0.35
        // geodesic: true
        });

        }
    }
            google.maps.event.addDomListener(window, 'load', initialize);

        </script>

@elseif($value=="open_street")



<style>
#map {
height: 500px;
width: 80%;
left: 10px;
}
html, body {
padding: 0;
margin: 0;
height: 100%;
}

#panel {
width: 200px;
font-family: Arial, sans-serif;
font-size: 13px;
float: right;
margin: 10px;
margin-top: 100px;
}

#delete-button, #add-button, #delete-all-button, #save-button {
margin-top: 5px;
}
#pac-input {
background-color: #f7f7f7;
font-size: 15px;
font-weight: 300;
margin-top: 10px;
padding: 0 11px 0 13px;
text-overflow: ellipsis;
height: 25px;
width: 70%;
border: 1px solid #c7c7c7;
}
.map_icons{
font-size: 24px;
color: white;
padding: 10px;
background-color: #43439999;
margin: 5px;
}
</style>

<div class="content">
<div class="container-fluid">
<div class="row">
<div class="col-sm-12">
<div class="box">

<div class="box-header with-border">
<a href="{{ url('zone') }}">
<button class="btn btn-danger btn-sm pull-right" type="submit">
<i class="mdi mdi-keyboard-backspace mr-2"></i>
@lang('view_pages.back')
</button>
</a>
</div>
<div class="col-sm-12">
<div class="row">
<div class="col-sm-12">
<div id="map" class="col-sm-9" style="float:left;"></div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>

<script type="text/javascript">
  var default_lat = {{$default_lat}};
var default_lng = {{$default_lng}};
var data= '{{$zones}}';
let zones = JSON.parse(data.replace(/&quot;/g,'"'));
function initialize() {
    var map = L.map('map').setView([default_lat, default_lng], 8);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
    }).addTo(map);

    var i;
    var polygon;
    for (i = 0; i < zones.length; i++) {
        polygon = L.polygon(zones[i], {
            color: "#FF0000",
            opacity: 0.8,
            weight: 2,
            fillColor: "#FF0000",
            fillOpacity: 0.35
        }).addTo(map);
    }
}

initialize();
</script>

@endif
@endsection

