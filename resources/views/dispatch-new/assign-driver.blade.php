
<!DOCTYPE html>
<html lang="en" dir="" class="">

<head>

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta http-equiv="x-pjax-version" content="{{ mix('/css/app.css') }}">
        <title>Dispatcher</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta content="Tag your taxi Admin portal, helps to manage your fleets and trip requests" name="description" />
        <meta content="Coderthemes" name="author" />
        <meta name="x-apple-disable-message-reformatting">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="theme-color" content="#0B4DD8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ fav_icon() ?? asset('assets/img.logo.png')}}">
        <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}" />
        <!-- END: CSS Assets-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
        <link rel="stylesheet" href="{{ asset('assets/css/dispatcher/style.css') }}" />
        

        
<style>
    .fs{
        font-size:16px;
    }
    .bar{
        /* display: flex;
        align-items:center; */
        justify-content:space-between;
    }
    ul {
    display: flex;
    flex-direction: row;
    align-items: center;
    gap: 5em;
}

/* width */
::-webkit-scrollbar {
  width: 5px;
  height: 3px;
}

/* Track */
::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px grey; 
  border-radius: 10px;
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #fca503; 
  border-radius: 10px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #fca503; 
}
span.add_stop {
    float: right;
    color: red;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
}
.vehicle_type.d-none,.vehicle_type_data.d-none{
    display:none
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

 /* Modal Styling */
 .modal-wrapper {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgb(0 0 0 / 67%);
  z-index: 9999;
  display: flex;
  justify-content: center; 
  animation: fadeIn 0.5s ease-in-out;
  outline: 0;
    overflow-x: hidden;
    overflow-y: auto;
    position: fixed;
}

.modal-content {
  min-width: 500px;
  max-width: 700px;
  background-color: #fff;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  animation: slideIn 0.5s ease-in-out;
}

.modal-close {
  position: absolute;
  top: 10px;
  right: 10px;
  cursor: pointer;
  font-size: 25px;
  font-weight: bold;
}

/* Animation */
@keyframes fadeIn {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

@keyframes slideIn {
  from {
    transform: translateY(-50px);
  }
  to {
    transform: translateY(0);
  }
}

.modal.fade.top.show{
top:0px !important
    }
    @media (max-width:320px){
      .detail{
position: relative;
left:100px;
      }
    }
</style>
@include('admin.layouts.common_scripts')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body class="body">
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
  <iframe src="https://giphy.com/embed/jkYQhKynh5jfyav9TF" frameBorder="0" ></iframe>
 </div>
            <!-- BEGIN: Content -->
<div class="cont">           
<div class="box p-5" style="box-shadow: 0 30px 40px #0000000b;">
<div class="float-left"><a href="javascript:history.back()" class="btn btn-danger w-32" style="font-size:16px;"> Back</a></div>
<div class="row p-5">
    <div class="col-12 col-lg-2 text-center" style="margin:auto;">
    <h1 style="font-size:22px;padding:20px;border:4px solid #fca503;color:#fca503;">Ride Details</h1>
    </div>
    <div class="col-12 col-lg-2 p-3 detail" style="margin-left:10px;">
        <div class="fs p-2"><i class="fa fa-user me-5"></i>{{$item->userDetail->name}}</div>
        <div class="fs p-2"><i class="fa fa-phone me-5"></i>{{$item->userDetail->mobile}}</div>
        <div class="fs p-2"><i class="fa fa-car me-5"></i>{{$item->vehicle_type_name}}</div>
    </div>
    <div class="col-12 col-lg-5" style="margin:auto;">
        <div class="  p-10 " style="background:#F8F8F8;box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);width:">
            <div class="mt-5 d-flex align-items-center" style="font-size:clamp(12px, 2Vw, 18px);font-weight:800;"><i data-feather="disc" class="me-5" style="font-size:24px;font-weight:400;color:#59E304;margin:0 20px;"></i>{{$item->requestPlace->pick_address}}</div>
            <div style="border-top:1px dashed grey;margin-top:10px;"></div>
            <div class="mt-5 d-flex align-items-center" style="font-size:clamp(12px, 2Vw, 18px);font-weight:800;"><i data-feather="map-pin" class="me-5" style="font-size:24px;font-weight:800;color:red;margin:0 20px;"></i>
            @if($item->requestPlace->drop_address == NULL)
            -------
            @else
            {{$item->requestPlace->drop_address}}
            @endif
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-2 text-center" style="margin:auto;">
        <h3 style="font-size:20px;">{{$item->distance}}</h3>
    </div>
</div>
</div>
<div class="g-col-12 g-col-lg-4 mt-10 p-10">
    <div class="pe-1">
        <div class="box p-2" style="background:#EAF0FB;">
            <ul class="pos__tabs nav nav-pills rounded-2" role="tablist">
                <li id="all-tab" onclick="fetchDataFromFirebase('all',this),toggleActiveTab('all-tab')" class="nav-item flex-1 actv-tab" data-val="all" role="presentation">
                    <button class="nav-link w-full pt-2 pb-2.5 active">All</button>
                </li>
                <li id="online-tab" onclick="fetchDataFromFirebase('online',this),toggleActiveTab('online-tab')" class="nav-item flex-1" data-val="online" role="presentation">
                    <button class="nav-link w-full pt-2 pb-2.5">Online</button>
                </li>
                <li data-val="offline" id="offline-tab" onclick="fetchDataFromFirebase('offline',this),toggleActiveTab('offline-tab')" class="nav-item flex-1">
                    <button class="nav-link w-full pt-2 pb-2.5">Offline</button>
                </li>
                <li data-val="onride" id="onride-tab" onclick="fetchDataFromFirebase('onride',this),toggleActiveTab('onride-tab')" class="nav-item flex-1">
                    <button class="nav-link w-full pt-2 pb-2.5">On-Ride</button>
                </li>
            </ul>
        </div>
    </div>
    <div class="tab-content mt-5">
        <!-- all drivers tab -->
        <div class="tab-pane fade active show" id="all" role="tabpanel" aria-labelledby="all-tab">
            <div class="grid columns-12 gap-5 mt-5 no-data-fouds">
                <!-- BEGIN: Driver Side Menu -->
                <div class="g-col-12 g-col-xl-4 g-col-xxl-4 all-driver-side-menu overflow-y-auto p-5" style="height:500px;">
                    <div class="driver-side-menu">
                    </div>
                    <div class="driver-side-menu1">
                    </div> 
                </div>
                <!-- END: Home Side card Menu -->
                <!-- BEGIN: Map Content -->
                <div class="g-col-12 g-col-xl-8 g-col-xxl-8">
                    <div class="box p-5">
                        <div id="map" style=" height: 500px;width: 100%;"></div>
                    </div>
                </div>
                <!-- END: Map Content -->
            </div>
        </div> 
    </div>
</div>
               
                
            </div>
             <!-- END: Content -->    



<script>

    var pick_lat = "{{$item->requestPlace->pick_lat}}";
    var pick_lng = "{{$item->requestPlace->pick_lng}}";
    var request_id = "{{$item->id}}";
    var demo = "{{$demo}}";
  let appUrl = '{{ url("/") }}';
   function initMap() { 
   map = new google.maps.Map(document.getElementById("map"), {
      zoom: 5,
      center: { lat: 27.7172, lng: 85.3240 }, // Example: New York City
      mapTypeId: 'roadmap'
       
  }); 
}

</script> 
<script type="text/javascript" src="https://maps.google.com/maps/api/js?key={{get_settings('google_map_key')}}&callback=initMap" async defer></script> 
<script src="{{ asset('assets/js/dispatcher/assign_driver.js') }}"></script>

</body>

</html>


<!-- END: Form Layout -->