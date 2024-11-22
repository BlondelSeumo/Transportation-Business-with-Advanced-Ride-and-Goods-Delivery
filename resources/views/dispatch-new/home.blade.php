@extends('dispatch-new.layout') @section('dispatch-content')
<link rel="stylesheet" href="{{ asset('assets/css/dispatcher/style.css') }}" />
<!-- <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<style>
.season_tabs {
  position: relative;
  min-height: 260px;
  clear: both;
  margin: 25px 0;
}
.season_tab {
  float: left;
  clear: both;
  width: 200px;
  border-right:1px solid #dcbaff;
}
.season_tab label {
    /* background: #eee; */
    padding: 15px;
    /* border: 1px solid #ccc; */
    margin-left: -1px;
    font-size: 18px;
    vertical-align: middle;
    position: relative;
    left: 1px;
    width: 200px;
    height: 68px;
    display: table-cell;
}
.season_tab [type=radio] {
  display: none;
}
.season_content {
  position: absolute;
  font-size:15px;
  top: 0;
  left: 210px;
  background: white;
  right: 0;
  bottom: 0;
  padding: 20px;
  /* border: 1px solid #ccc; */
 }
.season_content span {
  animation: 0.5s ease-out 0s 1 slideInFromTop;
}
[type=radio]:checked ~ label {
  /* background: white; */
  border-left: 5px solid #fca503;
  z-index: 2;
}
[type=radio]:checked ~ label ~ .season_content {
  z-index: 1;
}
.tom-select .ts-dropdown {
    font-size: 1.5rem;
}
.tom-select .ts-input {
    font-size: 1.5rem;
}
.form-control {
    font-size: 1.5rem;
}
.form-select {
    font-size: 1.5rem;
}
.show {
    display: block;
    z-index: 0;
}

.modal-backdrop.show {
    opacity: 0;
}
.modal-backdrop.fade {
    opacity: 0;
}
.show {
    display: block;
    z-index: 0;
}
.show {
    display: block;
    z-index: 60;
}
.modal-backdrop {
    background-color: #000;
    height: 100vh;
    left: 0;
    position: fixed;
    top: 0;
    width: 100vw;
    z-index: 0;
}
.mt-6{
  align-
}
.fs{
  font-size:16px;
}
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
.form-check-input[type=checkbox] {
    border-radius: 0.25em;
    border: 1px solid #b4b1b1;
}
</style>

<script>
  var default_profile_url = '{{ asset("assets/images/default-profile.jpeg") }}';
</script>
<div class="g-col-12 g-col-lg-4">
    <div class="pe-1 d-flex align-items-center">
        <div class="box p-2 h-16 w-4/5">
            <ul class="pos__tabs nav nav-pills rounded-2" role="tablist">
                <li id="all-tab" onclick="fetchDataFromFirebase('all',this),toggleActiveTab('all-tab')" class="nav-item flex-1 actv-tab" data-val="all" role="presentation">
                    <button class="nav-link w-full pt-2 pb-10 active">All</button>
                </li>
                <li id="online-tab" onclick="fetchDataFromFirebase('online',this),toggleActiveTab('online-tab')" class="nav-item flex-1" data-val="online" role="presentation">
                    <button class="nav-link w-full pt-2 pb-10">Online</button>
                </li>
                <li data-val="offline" id="offline-tab" onclick="fetchDataFromFirebase('offline',this),toggleActiveTab('offline-tab')" class="nav-item flex-1">
                    <button class="nav-link w-full pt-2 pb-10">Offline</button>
                </li>
                <li data-val="onride" id="onride-tab" onclick="fetchDataFromFirebase('onride',this),toggleActiveTab('onride-tab')" class="nav-item flex-1">
                    <button class="nav-link w-full pt-2 pb-10">On-Ride</button>
                </li>
            </ul>
        </div>
        <div class="d-flex align-items-center ms-auto " style="font-size:22px;"><button class="w-full pt-2 pr-5 pb-2.5" onclick="all_drivers()">All Drivers</button></div>
        <!-- <a href="" data-toggle="modal" data-target="#drivermodal" class="btn ms-auto d-flex align-items-center text-theme-1 p-2" style="background:white;border-radius:10px;box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);"><i data-feather="sliders" style="rotate:90deg;"></i></a> -->
    </div>
    <div class="tab-content mt-5">
        <!-- all drivers tab -->
        <div class="tab-pane fade active show" id="all" role="tabpanel" aria-labelledby="all-tab">
            <div class="grid columns-12 gap-5 mt-5 no-data-fouds">
                <!-- BEGIN: Driver Side Menu -->
                <div class="g-col-12 g-col-xl-4 g-col-xxl-4 all-driver-side-menu overflow-y-auto p-5" style="height:500px;z-index:110px;">
                    <div class="driver-side-menu">
                    </div>
                    <div class="driver-side-menu1">
                    </div>
                </div>
                <!-- END: Home Side card Menu -->
                <!-- BEGIN: Map Content -->
                <div class="g-col-12 g-col-xl-8 g-col-xxl-8">
                    <div class="box p-5">
                        <div id="map" style=" height: 450px;width: 100%;"></div>
                    </div>
                </div>
                <!-- END: Map Content -->
            </div>
        </div>
    </div>
</div>

<!-- filter modal -->
<div class="modal fade" id="drivermodal" tabindex="-1" role="dialog" aria-labelledby="drivermodal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title fs" id="myModalLabel">Filter</h4>
        <div type="button" class="btn btn-default tb" data-dismiss="modal"><i data-feather="x"></i></div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="season_tabs">

            <div class="season_tab">
              <div for="tab-1" class="d-flex align-items-center">
                <div>
                <input type="radio" id="tab-1" name="tab-group-1" checked>
                <label for="tab-1">Vehicle Type</label>
                <span class="text-danger vehicleErr"></span>
                </div>
                <div>
                <input  id="vehicleCheckbox"  class="form-check-input" type="checkbox" value="" style="font-size:14px;">
                </div>
              </div>

                <div class="season_content">
                    <div>
                      <select id="vehicle_type" data-placeholder="Select" class="tom-select w-full" multiple >
                          @foreach($vehicle_types as $key=>$type)
                          <option name="{{ $type->name }}" value="{{$type->id}}">{{ $type->name }}</option>
                          @endforeach
                      </select>


                    </div>
                </div>
            </div>

            <div class="season_tab d-flex align-items-center">
                <input type="radio" id="tab-2" name="tab-group-1">
                <label for="tab-2">Mobile Number</label>
                <div style="margin-bottom:15px;">
                <input id="searchCheckbox" class="form-check-input" type="checkbox" value=""  style="font-size:14px;">
                <span class="text-danger mobileErr"></span>
                </div>

                <div for="tab-2" class="season_content">
                    <div>
                    <input id="mobile" type="number" class="form-control" placeholder="Search">
                    </div>
                </div>
            </div>
<!--
            <div class="season_tab d-flex align-items-center">
                <input type="radio" id="tab-3" name="tab-group-1">
                <label for="tab-3">Location</label>
                <div style="margin-bottom:15px;">
                <input id="locationCheckbox" class="form-check-input" type="checkbox" value="" style="font-size:14px;">
                </div>

                <div class="season_content">
                    <div>
                      <input id="locationSelect" type="text" class="form-control" placeholder="Search">
                      <input id="location_lat" type="hidden" placeholder="Search">
                      <input id="location_lng" type="hidden" placeholder="Search">
                    </select>
                    </div>
                </div>
            </div>
          </div> -->
      </div>
      <div class="modal-footer">
        <button id="resetButton" type="button" class="btn btn-default fs" >reset</button>
        <button onclick=driver_filter() type="button" class="btn btn-primary fs">Filter</button>
      </div>
    </div>
  </div>
</div>
<script>
    var demo = "{{$demo}}";

  document.querySelector(".hamburger").addEventListener("click", function () {
            document.querySelector("nav").classList.toggle("toggle-menu")
        });

        document.querySelector(".close").addEventListener("click", function () {
            document.querySelector("nav").classList.toggle("toggle-menu")
        });
</script>
<script>
  var appUrl = "{{ url('/') }}";
  $(document).ready(
  function(){
    $("li.d-flex").removeClass("active");
    $('li.driver-list').addClass('active');
  }
)
  </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('assets/js/dispatcher/script.js') }}"></script>
<script>
  var default_latitude = {{get_settings('default_latitude')}};
  var default_longitude = {{get_settings('default_longitude')}};
   function initMap() {
   map = new google.maps.Map(document.getElementById("map"), {
      zoom: 5,
      center: { lat: default_latitude, lng: default_longitude },
      mapTypeId: 'roadmap'

  });
}
</script>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?key={{ get_settings('google_map_key') }}&libraries=drawing,geometry,places&callback=initMap" async defer></script>
<script>
    // vehicle select
  document.getElementById("vehicle_type").addEventListener("input", function() {
  var selectedOptions = this.selectedOptions;

  if (selectedOptions.length > 0) {
      // Check the checkbox if at least one option is selected
      document.getElementById("vehicleCheckbox").checked = true;
    } else {
      // Uncheck the checkbox if no option is selected
      document.getElementById("vehicleCheckbox").checked = false;

    }
  });
  function all_drivers(){
    var element = $('.nav-link.active').closest('.nav-item');
    var type = element.attr('data-val');
    fetchDataFromFirebase(type,element);
  }
  function driver_filter() {
    $(".close").click();
    var element = $('.nav-link.active').closest('.nav-item');
    var type = element.attr('data-val');
    var filters = [];
    filters[0] = [];
    filters[1] = '';
    var type_flag = 0;
    var mobile_flag = 0;

    if(document.getElementById("vehicleCheckbox").checked){
      if($('#vehicle_type').val().length > 0){
        filters[0] = $('#vehicle_type').val();
        type_flag = 1;
        $('#vehicleErr').html('');
      }else{
        type_flag = 0;
        $('#vehicleErr').html('Please select vehicle type');
      }
    }else{$('#vehicleErr').html('');}

    if(document.getElementById("searchCheckbox").checked){
      if($('#mobile').val().length > 0){
        filters[1] = $('#mobile').val();
        mobile_flag = 1;
        $('#mobileErr').html('');
      }else{
        mobile_flag = 0;
        $('#mobileErr').html('Please enter the mobile number');
      }
    }else{$('#mobileErr').html('');}

    if(type_flag || mobile_flag){
      driver_search(type,filters);
    }
  }
  function driver_search(type,filters){
removeMarkers();
    $(".driver-side-menu").html('');
    var drivers = [];
    var html_data = '';
    switch (type){
      case 'online':
        var driverRef = database.ref('drivers').orderByChild("is_active").equalTo(1);
        break;
      case 'offline':
        var driverRef = database.ref('drivers').orderByChild("is_active").equalTo(0);
        break;
      case 'onride':
        var driverRef = database.ref('drivers').orderByChild("is_available").equalTo(false);
        break;
      default:
        var driverRef = database.ref('drivers').orderByKey().startAt("driver_");
        break;
    }

    driverRef.once("value", function(snapshot) {
      var totalChildren = snapshot.numChildren();
      if(totalChildren == 0)
      {
        html_data= `<div class="box p-5  mt-5" style="height:400px;width:400px"><img src="${appUrl}/images/no-drivers.png" style="height:100%;width:100%"></div>`;
        $(".driver-side-menu").append(html_data);
      }else{
        snapshot.forEach(function(childSnapshot) {
            var driverData = childSnapshot.val();
            var driverKey = childSnapshot.key;
            if (driverKey.startsWith("driver_")) {
            if(filters[0].length > 0 && driverData.hasOwnProperty('vehicle_types')){
              for (var i = 0; i < driverData.vehicle_types.length; i++) {
                if(filters[0].includes(driverData.vehicle_types[i])){
                  drivers.push(driverData);
                  return;
                }
              }
            }
            if(filters[1].length > 0){
              if(filters[1] == driverData.mobile){
                drivers.push(driverData);
                return;
              }
            }
            }
        });
        markerarray = [];
        if(drivers.length > 0){
          for(var i=0; i < drivers.length; i++){
            var text  = '';
            if(drivers[i].is_active){
              if(drivers[i].is_available){
                text= 'online';
              }else{
                text= 'onride';
              }
            }else{
              text= 'offline';
            }
            if(i == drivers.length - 1){
              setmap(type,drivers[i],true);
            }else{
              setmap(type,drivers[i]);

            }
          };
        }else{
          html_data = `<div class="box p-5  mt-5" style="height:400px;width:400px"><img src="${appUrl}/images/no-drivers.png" style="height:100%;width:100%"></div>`;
          $(".driver-side-menu").html(html_data);
        }
      }
    });
    var checkboxes = document.querySelectorAll('#drivermodal .form-check-input');
    checkboxes.forEach(function(checkbox) {
        checkbox.checked = false;
    });
  }
// number search
document.getElementById('mobile').addEventListener('input', function(event) {
        // Get the input value
        var inputValue = this.value.trim();

        // Check if the input is not empty
        if (inputValue) {
            // Check the checkbox
            document.getElementById('searchCheckbox').checked = true;
        } else {
            // Uncheck the checkbox if the input is empty
            document.getElementById('searchCheckbox').checked = false;

        }
});

// reset
document.getElementById("resetButton").addEventListener("click", function() {
    // Uncheck all checkboxes within the modal
    var checkboxes = document.querySelectorAll('#drivermodal .form-check-input');
    checkboxes.forEach(function(checkbox) {
        checkbox.checked = false;
    });

    var multiSelect = document.getElementById("vehicle_type");
    multiSelect.value = -1;
});
</script>
@endsection @push('scripts-js') @endpush
<!-- END: Form Layout -->
