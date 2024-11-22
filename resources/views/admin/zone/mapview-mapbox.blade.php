@extends('admin.layouts.app')

@section('title', 'Main page')

@section('content')


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

  
 {{-- mapbox script --}}
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js"></script>
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js'></script>

     {{-- mapbox link --}}
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css" rel="stylesheet">

   



    <script type="text/javascript">
        var drawingManager;
        var data= '{{$zones}}';
        var default_lat = '{{$default_lat}}';
        var default_lng = '{{$default_lng}}';
        let zones = JSON.parse(data.replace(/&quot;/g,'"'));
        console.log(zones);

          mapboxgl.accessToken = '{{get_settings('map_box_key')}}';
var map = new mapboxgl.Map({
container: 'map', // container id  
style: 'mapbox://styles/mapbox/light-v10',
// center: [-68.137343, 45.137451], // starting position
center: new mapboxgl.LngLat(default_lng, default_lat), // starting position
zoom: 5 // starting zoom
});

map.on('load', function () {
// Add a data source containing GeoJSON data.
map.addSource('maine', {
'type': 'geojson',
'data': {
'type': 'Feature',
'geometry': {
'type': 'Polygon',
// These coordinates outline Maine.
'coordinates': [
[ 
zones[0],
// [-67.13734, 45.13745],
// [-66.96466, 44.8097],
// [-68.03252, 44.3252],
// [-69.06, 43.98],
// [-70.11617, 43.68405],
// [-70.64573, 43.09008],
// [-70.75102, 43.08003],
// [-70.79761, 43.21973],
// [-70.98176, 43.36789],
// [-70.94416, 43.46633],
// [-71.08482, 45.30524],
// [-70.66002, 45.46022],
// [-70.30495, 45.91479],
// [-70.00014, 46.69317],
// [-69.23708, 47.44777],
// [-68.90478, 47.18479],
// [-68.2343, 47.35462],
// [-67.79035, 47.06624],
// [-67.79141, 45.70258],
// [-67.13734, 45.13745]
]
]
}
}
});
 
// Add a new layer to visualize the polygon.
map.addLayer({
'id': 'maine',
'type': 'fill',
'source': 'maine', // reference the data source
'layout': {},
'paint': {
'fill-color': '#FF0000', // blue color fill
'fill-opacity': 0.35
}
});
// Add a black outline around the polygon.
map.addLayer({
'id': 'outline',
'type': 'line',
'source': 'maine',
'layout': {},
'paint': {
'line-color': '#000',
'line-width': 3
}
});
});


    function initialize() {

  //   var map = new google.maps.Map(document.getElementById('map'), {
  //   zoom: 8,
  //   center: new google.maps.LatLng(default_lat, default_lng),
  //   mapTypeId: 'terrain'
  // });

   

// Add zoom and rotation controls to the map.
map.addControl(new mapboxgl.NavigationControl());




    // var i;
    // var polygon;
    // for (i = 0; i < zones.length; i++) {
    // polygon = new google.maps.Polygon({
    // map: map,
    // paths: zones[i],
    // strokeColor: "#FF0000",
    // strokeOpacity: 0.8,
    // strokeWeight: 2,
    // fillColor: "#FF0000",
    // fillOpacity: 0.35
    // // geodesic: true
    // });

    // }
}
        // google.maps.event.addDomListener(window, 'load', initialize);

    </script>

@endsection

