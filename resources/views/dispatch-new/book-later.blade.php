@extends('dispatch-new.layout')

@section('dispatch-content')
<style>

:root {
  --primary: {{ $navs -> value }};
  --primary-hover: {{ $side -> value }};
}


/* payments */
.select-form{
  position: relative;
    width: 100%;
    margin-bottom: 18px;
}

.select-checkbox-group {
  display: flex;
  align-items: center;
  position: relative;
}
.select-checkbox-btn {
  margin-right: 15px;
  margin-bottom: 15px;
}
.select-checkbox-btn-wrapper {
  display: flex;
  align-items: center;
  justify-content: center;
  width: fit-content;
  position: relative;
}
.select-checkbox-btn-input {
  clip: rect(0 0 0 0);
  -webkit-clip-path: inset(100%);
  clip-path: inset(100%);
  height: 1px;
  overflow: hidden;
  position: absolute;
  white-space: nowrap;
  width: 1px;
}
.select-checkbox-btn-input:checked + .select-checkbox-btn-content {
  border-color: var(--primary);
  color: var(--primary);
}
.select-checkbox-btn-input:checked + .select-checkbox-btn-content:before {
  transform: scale(1);
  opacity: 1;
  background-color: var(--primary);
  border-color: var(--primary);
}
.select-checkbox-btn-input:checked
  + .select-checkbox-btn-content
  .select-checkbox-btn-icon,
.select-checkbox-btn-input:checked
  + .select-checkbox-btn-content
  .select-checkbox-btn-label {
  color: var(--primary);
}
.select-checkbox-btn-input:focus + .select-checkbox-btn-content {
  border-color: var(--primary);
}
.select-checkbox-btn-input:focus + .select-checkbox-btn-content:before {
  transform: scale(1);
  opacity: 1;
}

.select-checkbox-btn-content {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  width: 140px;
  min-height: 140px;
  border-radius: 10px;
  border: 0.1rem solid #dfe2e6;
  background-color: #fff;
  transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s,
    -webkit-box-shadow ease-in-out 0.15s;
  cursor: pointer;
  position: relative;
  user-select: none;
  appearance: none;
}
.select-checkbox-btn-content:before {
  content: "";
  position: absolute;
  width: 22px;
  height: 22px;
  border: 0.1rem solid #bbc1e1;
  background-color: #fff;
  border-radius: 9999px;
  top: 5px;
  left: 5px;
  opacity: 0;
  transform: scale(0);
  transition: 0.25s ease;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='192' height='192' fill='%23FFFFFF' viewBox='0 0 256 256'%3E%3Crect width='256' height='256' fill='none'%3E%3C/rect%3E%3Cpolyline points='216 72.005 104 184 48 128.005' fill='none' stroke='%23FFFFFF' stroke-linecap='round' stroke-linejoin='round' stroke-width='32'%3E%3C/polyline%3E%3C/svg%3E");
  background-size: 12px;
  background-repeat: no-repeat;
  background-position: 50% 50%;
  display: flex;
  align-items: center;
  justify-content: center;
}
.select-checkbox-btn-content:hover {
  border-color: var(--primary);
}
.select-checkbox-btn-content:hover:before {
  transform: scale(1);
  opacity: 1;
}

.select-checkbox-btn-icon {
  transition: 0.375s ease;
  color: #3c3c3cc7;
}
.select-checkbox-btn-icon svg {
  width: 50px;
  height: 50px;
}

.select-checkbox-btn-label {
  color: #3c3c3cc7;
  transition: 0.375s ease;
  text-align: center;
}
/* end */

#map {
    height: 400px;
    width:100%;
    left: 10px;
    }

.map_icons li a i {
    font-size: 24px;
    color: white;
    padding: 10px;
    margin: 5px;
    display: none;
}
/* navbar */
/* Start Navigation Bar */

.navbar {
  background-color: var(--primary);
  color: #ffffff;
  border-radius: 4px;
  width: 100vw;
  max-width: 300px;
  margin: 3px auto 0;
  align-items: center;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  padding-bottom: 2px;
  padding-top: 2px;
  position: relative;

}

.navbar .menu {
  display: flex;
  position: relative;
}

@media (max-width: 820px) {
  .navbar .menu {
    display: flex;
    position: relative;
  }
}

.navbar .menu li {
  /* flex: 1; */
  display: flex;
  text-align: center;
  transition: background-color 0.5s ease;
}

.navbar .menu a {
  /* flex: 1; */
  justify-content: center;
  display: inline-flex;
  color: #ffffff;
  text-decoration: none;
  padding: 10px;
  position: relative;
  font-size:20px;
  font-weight:900;
}

.navbar .menu a > .fa {
  font-weight: bold;
  margin-left: 8px;
}

.navbar .menu li a:hover {
  background-color: white;
  color:var(--primary);
  border-bottom:3px solid orange;
  border-radius:10px;
}

.navbar .menu li:hover .container {
  display: flex;
}

@media (max-width: 820px) {
  .navbar .menu li:hover .container {
    display: none;
  }
  
  .fa-angle-down {
    display: none;
  }
}

a.hasDropdown:after {
  position: absolute;
  bottom: -16px;
  left: 50%;
  transform: translateX(-50%);
  height: 0;
  width: 0;
  border: 8px solid transparent;
  border-top-color: #25283d;
  z-index: 2;
}

@media (max-width: 820px) {
  li:hover a.hasDropdown:after {
    display: none;
  }
}

li:hover a.hasDropdown:after {
  content: '';
  border-top-color: #8F3985;
}

/* End Navigation Bar */

/* Start Single Section Menu */

.container {
  display: none;
  position: absolute;
  top: 56px;
  left: 0;
  right: 0;
  background-color: #ffffff;
  box-shadow: 0 2px 0 rgba(0, 0, 0, 0.06);
  padding: 20px;
  text-align: left;
  margin-bottom: 30px;
}

.container__list {
  flex: 1;
  display: flex;
  flex-wrap: wrap;
  min-width: 0;
}

.container__listItem {
  flex: 0 0 25%;
  padding: 10px 30px;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
}

.container__listItem > div {
  color: #DB6356;
  text-decoration: underline;
  cursor: pointer;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
}
.navbar>ul>li.active>a{
	color: white;
    border-bottom:3px solid white;
	/* background-color: blue; */
	transition: all 0.7s;
}

/* End Single Section Menu */


</style>
<!-- BEGIN: Top Bar -->
<div class="top-bar">
    <!-- BEGIN: Breadcrumb -->
    <div class="-intro-x breadcrumb me-auto d-none d-sm-flex"> <a href="">Dispatcher</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">Dashboard</a> </div>
    <!-- END: Breadcrumb -->
    
    <!-- BEGIN: Account Menu -->
    <div class="intro-x dropdown w-8 h-8">
        <div class="dropdown-toggle w-8 h-8 rounded-pill overflow-hidden shadow-lg image-fit zoom-in" role="button" aria-expanded="false" data-bs-toggle="dropdown">
            <img alt="Rubick Tailwind HTML Admin Template" src="dist/images/profile-11.jpg">
        </div>
        <div class="dropdown-menu w-56">
            <ul class="dropdown-content bg-theme-26 dark-bg-dark-6 text-white">
                <li class="p-2">
                    <div class="fw-medium text-white">Sudarsan</div>
                </li>
                <li>
                    <hr class="dropdown-divider border-theme-27 dark-border-dark-3">
                </li>
                <li>
                    <a href="" class="dropdown-item text-white bg-theme-1-hover dark-bg-dark-3-hover"> <i data-feather="user" class="w-4 h-4 me-2"></i> Profile </a>
                </li>
                <li>
                    <a href="" class="dropdown-item text-white bg-theme-1-hover dark-bg-dark-3-hover"> <i data-feather="edit" class="w-4 h-4 me-2"></i> Add Account </a>
                </li>
                <li>
                    <a href="" class="dropdown-item text-white bg-theme-1-hover dark-bg-dark-3-hover"> <i data-feather="lock" class="w-4 h-4 me-2"></i> Reset Password </a>
                </li>
                <li>
                    <a href="" class="dropdown-item text-white bg-theme-1-hover dark-bg-dark-3-hover"> <i data-feather="help-circle" class="w-4 h-4 me-2"></i> Help </a>
                </li>
                <li>
                    <hr class="dropdown-divider border-theme-27 dark-border-dark-3">
                </li>
                <li>
                    <a href="" class="dropdown-item text-white bg-theme-1-hover dark-bg-dark-3-hover"> <i data-feather="toggle-right" class="w-4 h-4 me-2"></i> Logout </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- END: Account Menu -->
</div>
<div class="intro-y box mt-5 p-5">
<!-- Start Navigation Bar -->
<nav class="navbar">
    <ul class="menu">
        <li class="nav-item ">
            <a class="nav-link" href="{{ url('/dispatch-new') }}">Book Now</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="{{ url('/dispatch-new/later') }}">Book Later</a>
        </li>
    <ul>
</nav>
<!-- End Navigation Bar -->
<div class="intro-y grid columns-12 gap-5 mt-5">
    <!-- BEGIN: Left Content -->
    <div class="intro-y g-col-12 g-col-lg-7 " >
        <div class="post intro-y overflow-hidden box overflow-y-scroll scrollbar-hidden" style="height:520px">
            <div class="p-3 ">
                <div class="border border-gray-200  rounded-2 p-5 mt-5">
                    <div class="fw-medium d-flex align-items-center border-bottom border-gray-200 pb-5"> <i data-feather="user" class="w-4 h-4 me-2"></i>User Details </div>
                    <div class="mt-5">
                        <div>
                            <label for="name" class="form-label">Name</label>
                            <input  type="text" class="form-control" placeholder="Enter Name">
                        </div>
                        <div class="mt-5">
                            <label for="phone" class="form-label">Mobile</label>
                            <input  type="number" class="form-control" placeholder="Enter Phone">
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-3">
                <div class="border border-gray-200  rounded-2 p-5 mt-5">
                    <div class="fw-medium d-flex align-items-center border-bottom border-gray-200 pb-5"> <i data-feather="map-pin" class="w-4 h-4 me-2"></i>Location Details </div>
                    <div class="mt-5">
                        <div>
                            <label for="pickup" class="form-label">Pickup Location</label>
                            <input type="text" id="pickup" class="form-control" placeholder="Enter Pickup" name="pickup">
                            <input type="hidden" class="form-control" id="pickup_lat" name="pickup_lat">
                            <input type="hidden" class="form-control" id="pickup_lng" name="pickup_lng">
                        </div>
                        <div class="mt-5">
                            <label for="drop" class="form-label">Drop Location</label>
                            <input type="text" id="pickup" class="form-control" placeholder="Enter Drop" name="drop">
                            <input type="hidden" class="form-control" id="drop_lat" name="drop_lat">
                            <input type="hidden" class="form-control" id="drop_lng" name="drop_lng">
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-3">
                <div class="border border-gray-200  rounded-2 p-5 mt-5">
                    <div class="fw-medium d-flex align-items-center border-bottom border-gray-200 pb-5"> <i data-feather="truck" class="w-4 h-4 me-2"></i>Vehicle Types</div>
                        <div class="mt-5">
                            <div class="overflow-x-auto scrollbar-hidden">
                                <div class="d-flex mt-5">
                                    <div class="select-checkbox-btn">
                                        <label for="hatch" class="select-checkbox-btn-wrapper">
                                            <input id="hatch" name="types" type="radio" class="select-checkbox-btn-input" />
                                            <span class="select-checkbox-btn-content">
                                                <a  class="w-32 me-4 cursor-pointer">
                                                    <div class="w-32 h-32 flex-none image-fit rounded-circle">
                                                        <img alt="" class="rounded-circle" src="{{ asset('assets/img/hatch.png') }}">
                                                    </div>
                                                    <div class="fs-ls text-gray-600 truncate text-center mt-2">HATCHPACK</div>
                                                </a>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="select-checkbox-btn">
                                        <label for="sedan" class="select-checkbox-btn-wrapper">
                                            <input id="sedan" name="types" type="radio" class="select-checkbox-btn-input" />
                                            <span class="select-checkbox-btn-content">
                                                <a  class="w-32 me-4 cursor-pointer">
                                                    <div class="w-32 h-32 flex-none image-fit rounded-circle">
                                                        <img alt="" class="rounded-circle" src="{{ asset('assets/img/sedan.png') }}">
                                                    </div>
                                                    <div class="fs-ls text-gray-600 truncate text-center mt-2">SEDAN</div>
                                                </a>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="select-checkbox-btn">
                                        <label for="suv" class="select-checkbox-btn-wrapper">
                                            <input id="suv" name="types" type="radio" class="select-checkbox-btn-input" />
                                            <span class="select-checkbox-btn-content">
                                                <a  class="w-32 me-4 cursor-pointer">
                                                    <div class="w-32 h-32 flex-none image-fit rounded-circle">
                                                        <img alt="" class="rounded-circle" src="{{ asset('assets/img/suv.png') }}">
                                                    </div>
                                                    <div class="fs-ls text-gray-600 truncate text-center mt-2">SUV</div>
                                                </a>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="select-checkbox-btn">
                                        <label for="auto" class="select-checkbox-btn-wrapper">
                                            <input id="auto" name="types" type="radio" class="select-checkbox-btn-input" />
                                            <span class="select-checkbox-btn-content">
                                                <a  class="w-32 me-4 cursor-pointer">
                                                    <div class="w-32 h-32 flex-none image-fit rounded-circle">
                                                        <img alt="" class="rounded-circle" src="{{ asset('assets/img/auto.png') }}">
                                                    </div>
                                                    <div class="fs-ls text-gray-600 truncate text-center mt-2">AUTO</div>
                                                </a>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="select-checkbox-btn">
                                        <label for="bike" class="select-checkbox-btn-wrapper">
                                            <input id="bike" name="types" type="radio" class="select-checkbox-btn-input" />
                                            <span class="select-checkbox-btn-content">
                                                <a  class="w-32 me-4 cursor-pointer">
                                                    <div class="w-32 h-32 flex-none image-fit rounded-circle">
                                                        <img alt="" class="rounded-circle" src="{{ asset('assets/img/bike.png') }}">
                                                    </div>
                                                    <div class="fs-ls text-gray-600 truncate text-center mt-2">BIKE</div>
                                                </a>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="select-checkbox-btn">
                                        <label for="mini" class="select-checkbox-btn-wrapper">
                                            <input id="mini" name="types" type="radio" class="select-checkbox-btn-input" />
                                            <span class="select-checkbox-btn-content">
                                                <a  class="w-32 me-4 cursor-pointer">
                                                    <div class="w-32 h-32 flex-none image-fit rounded-circle">
                                                        <img alt="" class="rounded-circle" src="{{ asset('assets/img/mini.png') }}">
                                                    </div>
                                                    <div class="fs-ls text-gray-600 truncate text-center mt-2">MINI</div>
                                                </a>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="p-3">
                <div class="border border-gray-200  rounded-2 p-5 mt-5">
                    <div class="fw-medium d-flex align-items-center border-bottom border-gray-200 pb-5"> <i data-feather="calendar" class="w-4 h-4 me-2"></i>Date </div>
                    <div class="mt-5">
                        <div>
                            <label for="pickup" class="form-label">Start Date</label>
                                <div id="input-group-datepicker" class="">
                                    <div class="preview">
                                        <div class="input-group  mx-auto">
                                            <div id="input-group-email" class="input-group-text"> <i data-feather="calendar" class="w-4 h-4"></i> </div>
                                            <input type="text" class="datepicker form-control" data-single-mode="true">
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="mt-5">
                            <label for="drop" class="form-label">Start Time</label>
                            <div class="input-group w-80">
                                <div id="input-group-email" class="input-group-text"> <i data-feather="watch" class="w-4 h-4"></i> </div> 
                                <input class=" form-control" data-single-mode="true" type="time" id="start_time" name="start_time"  required> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-3">
                <div class="border border-gray-200  rounded-2 p-5 mt-5">
                    <div class="fw-medium d-flex align-items-center border-bottom border-gray-200 pb-5"> <i data-feather="credit-card" class="w-4 h-4 me-2"></i>Payments </div>
                        <div class="select-form mt-5">
                            <div class="select-checkbox-group">
                                <div class="select-checkbox-btn">
                                    <label for="images_1" class="select-checkbox-btn-wrapper">
                                        <input id="images_1" name="payment" type="radio" class="select-checkbox-btn-input" />
                                        <span class="select-checkbox-btn-content">
                                            <span class="select-checkbox-btn-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16"> <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z"/> <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z"/> <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z"/> <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z"/> </svg>
                                            </span>
                                            <span class="select-checkbox-btn-label">Cash</span>
                                        </span>
                                    </label>
                                </div>
                                <div class="select-checkbox-btn">
                                <label for="images_2" class="select-checkbox-btn-wrapper">
                                    <input id="images_2" name="payment" type="radio" class="select-checkbox-btn-input" />
                                    <span class="select-checkbox-btn-content">
                                        <span class="select-checkbox-btn-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wallet2" viewBox="0 0 16 16"> <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z"/> </svg>
                                        </span>
                                        <span class="select-checkbox-btn-label">Wallet</span>
                                    </span>
                                </labe>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Left Content -->
    <!-- BEGIN: Right Info -->
    <div class="g-col-12 g-col-lg-5">
        <div class="intro-y box p-5" style="min-height:520px">
        <div id="map" class="col-12 col-lg-10" style="float:left;"></div>
        </div>
    </div>
    <!-- END: Right Info -->
</div>
</div>


@endsection
@push('scripts-js')
<script src="https://maps.google.com/maps/api/js?key={{ get_settings('google_map_key') }}&libraries=drawing,geometry,places"></script>
<script src="https://maps.google.com/maps/api/js?key={{get_settings('google_map_key')}}&libraries=drawing,geometry,places"></script>
<script>

function initialize() {
        var input = document.getElementById('pickup');
        var autocomplete = new google.maps.places.Autocomplete(input);
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            document.getElementById('pickup_lat').value = place.geometry.location.lat();
            document.getElementById('pickup_lng').value = place.geometry.location.lng();


        });

    }

    google.maps.event.addDomListener(window, 'load', initialize);
</script>

@endpush
        <!-- END: Form Layout -->


