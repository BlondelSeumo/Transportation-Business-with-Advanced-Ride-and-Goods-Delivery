@extends('admin.layouts.app')
@section('title', 'Main page')
 <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
     #map {
        height:250px;  /* The height is 400 pixels */
        width: 100%;  /* The width is the width of the web page */
       }
      /* Optional: Makes the sample page fill the window. */
      .box{
        flex-direction: revert !important;
      }
      .route-details,.route-details.chs-cls{
        padding-top:10px;
        padding-bottom:10px;
        display: inline-block;
      }
      .route-details h2{
        color:#fff;
        font-size: 20px;
        font-weight: 500;
      }
      .route-details .form-group{
        border: 1px solid #fff;
        display: flex;
        padding: 2px;
        border-radius: 25px;
        cursor:pointer;
      }
      .route-details.chs-cls .form-group{
        border: 1px solid #1e88e5;
        display: flex;
        border-radius: 25px;
      }
      .route-details.chs-cls .form-group.active{
        background: rgba(255,255,229,0.3);
        }
      .route-details.chs-cls .form-group span{
        color:#fff;
        font-weight:400;
        font-size:16px;
      }
      .route-details .form-group input.form-control::placeholder{
        color:#f5f5f5;
      }
      .route-details .form-group input.form-control{
        background:#1e88e5;
        color:#f5f5f5;
        border:none;
      }
      .con-order{
        padding: 7px 40px;
        background: #fff;
        border-radius: 25px;
      }
      .cancel-order,.cancel-order:hover{
        color:#333;
        text-decoration:none;
      }
      ul.choose-type li{
        margin-bottom:5px;
      }
      ul.choose-type li a{
        color:#fff;
        font-size:17px;
      }
      ul.choose-type li a img{
        width: 50px;
        padding: 10px;
        background: rgba;
        background: rgba(255,255,255,0.3);
        border-radius: 50%;
      }
      ul.choose-type{
        list-style-type:none;
        margin:0px;
        padding:0px;
      }
      a.drop-plus{
        position: absolute;
        top: 12px;
        right: -20px;
      }
    </style>
@section('content')

<!-- Start Page content -->
<div class="content">
<div class="container-fluid">
    @if($errors)
    @foreach ($errors->all() as $error)
       <div>{{ $error }}</div>
   @endforeach
 @endif
<div class="row">
<div class="col-sm-12">
    <div class="box">

    <div class="col-md-4 p-0 float-left" style="background:#1e88e5;">
        <div class=" col-12 route-details text-center pb-0 ">
            <h2> @lang('view_pages.route_details')</h2>
            <div class="col-md-12">
               <div class="form-group" style="border-radius:0px;">
                  <div class="col-md-10 float-left pr-0">
                    <input type="text" class="form-control" id="" placeholder="User Name">
                  </div>
                  <div class="col-md-2 float-left p-0">
                    <img src="{{ asset('images/email/user.svg') }}" width="25px" style="margin-top:4px" alt="">
                  </div>
                </div>
                <div class="form-group" style="border-radius:0px;">
                  <div class="col-md-10 float-left pr-0">
                    <input type="text" class="form-control" id="" placeholder="Mobile Number">
                  </div>
                  <div class="col-md-2 float-left p-0">
                    <img src="{{ asset('images/email/phone.svg') }}" width="25px" style="margin-top:4px" alt="">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-10 float-left pr-0">
                    <input type="text" class="form-control"  id="pickup_location" value="{{old('pickup_location')}}" placeholder="Pickup Location" required="">
                  </div>
                  <div class="col-md-2 float-left p-0">
                    <img src="{{ asset('images/email/home.svg') }}" width="25px" style="margin-top:4px" alt="">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-10 float-left pr-0">
                    <input type="text" class="form-control" id="drop_location" name="drop_location" value="{{old('drop_location')}}" required="" placeholder="Drop Location">
                  </div>
                  <div class="col-md-2 float-left p-0">
                    <img src="{{ asset('images/email/location.svg') }}" width="25px" style="margin-top:4px" alt="">
                  </div>
                  <a href="" class="drop-plus"> <img src="{{ asset('images/email/plus.svg') }}" width="15px" alt=""></a>
                </div>
            </div>
        </div>
        <div class=" col-12 route-details chs-cls text-center pt-0">
            <h2>@lang('view_pages.choose_type')</h2>

            <div class="col-md-3 float-left">
              <ul class="choose-type">
                <li><a href="">Mini</a></li>
                <li class="car-img"><a href=""> <img src="{{ asset('images/email/mini.svg') }}" alt=""></a></li>
                <li><a href="">$23</a></li>
              </ul>
            </div>
            <div class="col-md-3 float-left">
             <ul class="choose-type">
                <li><a href="">Micro</a></li>
                <li class="car-img"><a href=""> <img src="{{ asset('images/email/micro.svg') }}" alt=""></a></li>
                <li><a href="">$33</a></li>
              </ul>
            </div>
            <div class="col-md-3 float-left">
              <ul class="choose-type">
                <li><a href="">Sedan</a></li>
                <li class="car-img"><a href=""> <img src="{{ asset('images/email/sedan.svg') }}" alt=""></a></li>
                <li><a href="">$53</a></li>
              </ul>
            </div>
            <div class="col-md-3 float-left">
            <ul class="choose-type">
                <li><a href="">Suv</a></li>
                <li class="car-img"><a href=""> <img src="{{ asset('images/email/suv.svg') }}" alt=""></a></li>
                <li><a href="">$63</a></li>
              </ul>
            </div>
        </div>
        <div class="col-md-12 text-center" style="padding-top:10px;padding-bottom:25px;">
          <a href="" class="con-order">@lang('view_pages.confirm_order')</a><br/><br/>
          <a href="" class="cancel-order mt-3">@lang('view_pages.cancel')</a>
        </div>
    </div>
    <div class="col-md-8">
        <div id="map"> </div>
    </div>


        </div>


    </div>
</div>
</div>

</div>
<!-- container -->

</div>
<!-- content -->
    <script src="{{asset('assets/vendor_components/jquery/dist/jquery.js')}}"></script>

    <script type="text/javascript"
            src="http://maps.googleapis.com/maps/api/js?key={{get_settings('google_map_key')}}&libraries=places">
    </script>
    <script>


    // 40.71.190.142
    google.maps.event.addDomListener(window, 'load', initialize);
            function initialize() {

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 10,
                container: 'map',
                style: 'mapbox://styles/mapbox/streets-v10',
                center: new google.maps.LatLng(44.599, -78.443),
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                disableDefaultUI: true,
                zoomControl: true
            });
        new AutocompleteDirectionsHandler(map);

        }
        google.maps.event.addDomListener(window, 'load', function () {

        var pickup_location = new google.maps.places.Autocomplete(document.getElementById('pickup_location'));
        google.maps.event.addListener(pickup_location, 'place_changed', function () {
            console.log(pickup_location);
        });

        var drop_location = new google.maps.places.Autocomplete(document.getElementById('drop_location'));
        google.maps.event.addListener(drop_location, 'place_changed', function () {
        });
    });

    /**
 * @constructor
 */
function AutocompleteDirectionsHandler(map) {
  this.map = map;
  this.originPlaceId = null;
  this.destinationPlaceId = null;
  this.travelMode = 'DRIVING';
  this.directionsService = new google.maps.DirectionsService;
  this.directionsRenderer = new google.maps.DirectionsRenderer;
  this.directionsRenderer.setMap(map);

  var originInput = document.getElementById('pickup_location');
  var destinationInput = document.getElementById('drop_location');

  var originAutocomplete = new google.maps.places.Autocomplete(originInput);
  // Specify just the place data fields that you need.
  originAutocomplete.setFields(['place_id','geometry', 'name', 'formatted_address']);

  var destinationAutocomplete =
      new google.maps.places.Autocomplete(destinationInput);
  // Specify just the place data fields that you need.
  destinationAutocomplete.setFields(['place_id','geometry', 'name', 'formatted_address']);
  this.setupPlaceChangedListener(originAutocomplete, 'ORIG');
  this.setupPlaceChangedListener(destinationAutocomplete, 'DEST');

  this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(originInput);
  this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(
      destinationInput);
  // this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(modeSelector);
}

AutocompleteDirectionsHandler.prototype.setupPlaceChangedListener = function(
    autocomplete, mode) {
  var me = this;
  autocomplete.bindTo('bounds', this.map);

  autocomplete.addListener('place_changed', function() {
    console.log(autocomplete.getPlace().geometry.location.lat());
    var place = autocomplete.getPlace();
    if (!place.place_id) {
      window.alert('Please select an option from the dropdown list.');
      return;
    }

    if (mode === 'ORIG') {
      me.originPlaceId = place.place_id;
    } else {
      me.destinationPlaceId = place.place_id;
    }
    me.route();
  });
};

AutocompleteDirectionsHandler.prototype.route = function() {
  if (!this.originPlaceId || !this.destinationPlaceId) {
    return;
  }
  var me = this;

  this.directionsService.route(
      {
        origin: {'placeId': this.originPlaceId},
        destination: {'placeId': this.destinationPlaceId},
        travelMode: this.travelMode
      },
      function(response, status) {
        if (status === 'OK') {
            // console.log(response);
          me.directionsRenderer.setDirections(response);
        } else {
          window.alert('Directions request failed due to ' + status);
        }
      });
};


</script>


@endsection
