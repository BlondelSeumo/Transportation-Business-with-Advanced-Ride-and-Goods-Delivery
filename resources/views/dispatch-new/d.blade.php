@extends('dispatch-new.layout')

@section('dispatch-content')
<link rel="stylesheet" href="{{ asset('assets/css/dispatcher/detailed-view.css') }}">
<style>
    .svg{
  position:absolute;
  top:50%;
  left:50%;
  transform:translate(-50%, -50%);
  max-width:128px;
  max-height:128px;
}
.magnify{
  fill:#405069;
  animation:search 1s infinite ease;
}
.doc{
  fill:#7F00FF;
  animation:flyby 3s infinite ease-in;
}


@keyframes search {
  0%{
    transform:translate(40px, 40px) scale(.6);
  }
  50%{
    transform:translate(20px, 20px) scale(.6);
  }
  100%{
    transform:translate(40px, 40px) scale(.6);
  }
}

@keyframes flyby {
  0%{
    transform:translate(-20px, 20px) scale(.2);
    opacity:0
  }
  50%{
    transform:translate(30px, 20px) scale(.5);
    opacity:1
  }
  100%{
    transform:translate(100px, 20px) scale(.2);
    opacity:0
  }
}

.container .svg {
    position: absolute;
    display: inline-block;
    width: 60px;
    height: 60px;
    top: 60px;
    left:-1px;
    right: 58px;
    padding: 0px 0;
    background: #ffffff;
    border: 2px solid #f73131;
    border-radius: 50px;
    text-align: center;
    font-size: 30px;
    color: #7F00FF;
    z-index: 1;
}


</style>

<div class="g-col-12 g-col-lg-4 mt-10 p-10">
    <div class="grid columns-12 gap-5 mt-5">
        <!-- BEGIN: Driver Side Menu -->
        <div class="g-col-12 g-col-xl-6 g-col-xxl-3">
          <div class="box p-5 intro-y mt-5" style="background:#FBFBFB;box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                <div class="d-flex flex-column flex-lg-row pb-5 mx-n5">
                    <div class="d-flex flex-1 px-5 align-items-start justify-content-center justify-content-lg-start">
                        <div class="d-flex ms-5">
                            <div class="px-4 ct1" >Basic Information</div>
                        </div>
                    </div>
                </div>
                <div class="text-end p-2 cb-1" style="color:black;">Ride_000293</div>
                <div class=" p-5 intro-y">
                  <div class="grid grid-cols-12 gap-5 mt-5">
                    <!-- <div class="g-col-12 g-col-sm-6 g-col-xxl-3 box p-5 cursor-pointer zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                        <div class="text-theme-10" style="font-size:20px;font-weight:800;">Driver Details</div>
                        <div class="text-gray-600" style="font-size:20px;font-weight:800;">Sudarsan</div>
                        <div class="mt-6 mt-lg-0 pt-5">
                            <div class="fw-medium text-center text-lg-start " style="font-size:25px;font-weight:800;">4 <i class="fa fa-star" style="color:yellow;"></i></div>
                        </div>
                    </div>
                    <div class="g-col-12 g-col-sm-6 g-col-xxl-3 box p-5 cursor-pointer zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                        <div class="text-theme-10" style="font-size:20px;font-weight:800;">Customer Details</div>
                        <div class="text-gray-600" style="font-size:20px;font-weight:800;">Sudarsan</div>
                        <div class="mt-6 mt-lg-0 pt-5">
                            <div class="fw-medium text-center text-lg-start " style="font-size:25px;font-weight:800;">4 <i class="fa fa-star" style="color:yellow;"></i></div>
                        </div>
                    </div> -->
                    <div class="g-col-12 g-col-sm-12 g-col-xxl-3 box p-10" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);position:relative;">
                        <div class="mt-5 d-flex align-items-center" style="font-size:clamp(12px, 2Vw, 18px);font-weight:800;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-disc me-5" style="font-size:24px;font-weight:400;color:#59E304;"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="3"></circle></svg>Home,saravanampatti,Coimbatore-35</div>
                        <div class="divider"></div>
                        <div class="mt-5 d-flex align-items-center" style="font-size:clamp(12px, 2Vw, 18px);font-weight:800;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin me-5" style="font-size:24px;font-weight:800;color:red;"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>Drop,Gandhipuram,Coimbatore-05</div>
                        <div class="d-flex align-items-center text-end p-3 cb-1" style="float:right;color:black;position:relative;z-index:10">
                        <div class="me-5 p-2 box" style="border:1px dashed #7F00FF;">01 km</div>
                        <div class="p-2 box" style="border:1px dashed #7F00FF;">10 mins</div>
                        </div>
                        <div class="box p-5">
                              <img class="img-fluid" src="{{ asset('assets/images/map.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
                </div>
                
            </div>

<div class="box p-5 intro-y mt-10" style="background:#FBFBFB;box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
               
<div class="box p-5 intro-y">
<div class="timeline">
  <div class="container left">
    <img src="{{ asset('assets/img/user-dummy.svg') }}" class="img-fluid img" width="50px" alt="">
    <!-- <i class="icon fa fa-home"></i> -->
    <!-- <div class="date">15 Dec</div> -->
    <div class="content">
      <div class="d-flex">
      <h2 class=" p-2" style="border-right:2px solid grey">Sudarsan</h2>
      <h2 class=" p-2">5 <i class="fa fa-star" style="color:yellow;"></i></h2>
      </div>
      <p>11 MAR,2024</p>
      <p> 03.00pm</p>
      <p class="text-center" style="background:#ff9999;color:red;padding:7px;width:75px;border-radius:6px;">Cancel</p>
    </div>
  </div>
  <div class="container right">
  <img src="{{ asset('assets/img/user-dummy.svg') }}" class="img-fluid img" width="50px" alt="">
    <!-- <i class="icon fa fa-gift"></i> -->
    <!-- <div class="date">22 Oct</div> -->
    <div class="content">
      <div class="d-flex">
      <h2 class=" p-2" style="border-right:2px solid grey">Sudarsan</h2>
      <h2 class=" p-2">5 <i class="fa fa-star" style="color:yellow;"></i></h2>
      </div>
      <p>11 MAR,2024</p>
      <p> 03.00pm</p>
      <p class="text-center" style="background:#ff9999;color:red;padding:7px;width:75px;border-radius:6px;">Cancel</p>
    </div>
  </div>
  <div class="container left">
  <img src="{{ asset('assets/img/user-dummy.svg') }}" class="img-fluid img" width="50px" alt="">
    <!-- <i class="icon fa fa-user"></i> -->
    <!-- <div class="date">10 Jul</div> -->
    <div class="content">
      <div class="d-flex">
      <h2 class=" p-2" style="border-right:2px solid grey">Sudarsan</h2>
      <h2 class=" p-2">5 <i class="fa fa-star" style="color:yellow;"></i></h2>
      </div>
      <p>11 MAR,2024</p>
      <p> 03.00pm</p>
      <p class="text-center" style="background:#ff9999;color:red;padding:7px;width:75px;border-radius:6px;">Cancel</p>
    </div>
  </div>
  <div class="container right">
  <img src="{{ asset('assets/img/user-dummy.svg') }}" class="img-fluid img" width="50px" alt="">
    <!-- <i class="icon fa fa-running"></i> -->
    <!-- <div class="date">18 May</div> -->
    <div class="content">
      <div class="d-flex">
      <h2 class=" p-2" style="border-right:2px solid grey">Sudarsan</h2>
      <h2 class=" p-2">5 <i class="fa fa-star" style="color:yellow;"></i></h2>
      </div>
      <p>11 MAR,2024</p>
      <p> 03.00pm</p>
      <p class="text-center" style="background:#ff9999;color:red;padding:7px;width:75px;border-radius:6px;">Cancel</p>
    </div>
  </div>
  <div class="container left">
  <img src="{{ asset('assets/img/user-dummy.svg') }}" class="img-fluid img" width="50px" alt="">
    <!-- <i class="icon fa fa-cog"></i> -->
    <!-- <div class="date">10 Feb</div> -->
    <div class="content">
      <div class="d-flex">
      <h2 class=" p-2" style="border-right:2px solid grey">Sudarsan</h2>
      <h2 class=" p-2">5 <i class="fa fa-star" style="color:yellow;"></i></h2>
      </div>
      <p>11 MAR,2024</p>
      <p> 03.00pm</p>
      <p class="text-center" style="background:#a7ff99;color:green;padding:7px;width:80px;border-radius:6px;">Accepted</p>
    </div>
  </div>
  <div class="container right">
  <img src="{{ asset('assets/img/user-dummy.svg') }}" class="img-fluid img" width="50px" alt="">
    <!-- <i class="icon fa fa-certificate"></i> -->
    <div class="date">Trip Request</div>
    <div class="content">
      <!-- <div class="d-flex">
      <h2 class=" p-2" style="border-right:2px solid grey">Sudarsan</h2>
      <h2 class=" p-2">5 <i class="fa fa-star" style="color:yellow;"></i></h2>
      </div> -->
      <p>11 MAR,2024</p>
      <p> 03.00pm</p>
      <!-- <p class="text-center" style="background:#ff9999;color:red;padding:7px;width:75px;border-radius:6px;">Cancel</p> -->
    </div>
  </div>
  <div class="container right">
  <img src="{{ asset('assets/img/user-dummy.svg') }}" class="img-fluid img" width="50px" alt="">
    <!-- <i class="icon fa fa-certificate"></i> -->
    <div class="date">Trip Accepted</div>
    <div class="content">
      <!-- <div class="d-flex">
      <h2 class=" p-2" style="border-right:2px solid grey">Sudarsan</h2>
      <h2 class=" p-2">5 <i class="fa fa-star" style="color:yellow;"></i></h2>
      </div> -->
      <p>11 MAR,2024</p>
      <p> 03.00pm</p>
      <!-- <p class="text-center" style="background:#ff9999;color:red;padding:7px;width:75px;border-radius:6px;">Cancel</p> -->
    </div>
  </div>
  <div class="container right">
  <img src="{{ asset('assets/img/user-dummy.svg') }}" class="img-fluid img" width="50px" alt="">
    <!-- <i class="icon fa fa-certificate"></i> -->
    <div class="date">Trip Arrived</div>
    <div class="content">
      <!-- <div class="d-flex">
      <h2 class=" p-2" style="border-right:2px solid grey">Sudarsan</h2>
      <h2 class=" p-2">5 <i class="fa fa-star" style="color:yellow;"></i></h2>
      </div> -->
      <p>11 MAR,2024</p>
      <p> 03.00pm</p>
      <!-- <p class="text-center" style="background:#ff9999;color:red;padding:7px;width:75px;border-radius:6px;">Cancel</p> -->
    </div>
  </div>
  <div class="container right">
  <img src="{{ asset('assets/img/user-dummy.svg') }}" class="img-fluid img" width="50px" alt="">
    <!-- <i class="icon fa fa-certificate"></i> -->
    <div class="date">Trip Started</div>
    <div class="content">
      <!-- <div class="d-flex">
      <h2 class=" p-2" style="border-right:2px solid grey">Sudarsan</h2>
      <h2 class=" p-2">5 <i class="fa fa-star" style="color:yellow;"></i></h2>
      </div> -->
      <p>11 MAR,2024</p>
      <p> 03.00pm</p>
      <!-- <p class="text-center" style="background:#ff9999;color:red;padding:7px;width:75px;border-radius:6px;">Cancel</p> -->
    </div>
  </div>
  <div class="container right">
  <img src="{{ asset('assets/img/user-dummy.svg') }}" class="img-fluid img" width="50px" alt="">
    <!-- <i class="icon fa fa-certificate"></i> -->
    <div class="date">Trip Completed</div>
    <div class="content">
      <!-- <div class="d-flex">
      <h2 class=" p-2" style="border-right:2px solid grey">Sudarsan</h2>
      <h2 class=" p-2">5 <i class="fa fa-star" style="color:yellow;"></i></h2>
      </div> -->
      <p>11 MAR,2024</p>
      <p> 03.00pm</p>
      <!-- <p class="text-center" style="background:#ff9999;color:red;padding:7px;width:75px;border-radius:6px;">Cancel</p> -->
    </div>
  </div>
  <div class="container right">
  <svg class="svg" viewbox="0 0 128 128" width="100%" height="100%">
<svg class="doc" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="-41 -41 492.00 492.00" xml:space="preserve" width="100px" height="100px" fill="#5d32d2" stroke="#5d32d2" stroke-width="2.05" transform="rotate(0)"><g id="SVGRepo_bgCarrier" stroke-width="0"></g>
<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="2.46"></g><g id="SVGRepo_iconCarrier"> <g id="XMLID_1835_"> <path id="XMLID_1850_" style="fill:#FFDA44;" d="M75,232.5c13.326,0,25.294,5.797,33.534,15.002H170V247.5v-30v-100h-40H70l-30,70 H0v30h30v30H0v0.002h41.466C49.706,238.297,61.674,232.5,75,232.5z M89.782,147.5H155v40H72.639L89.782,147.5z"></path> <rect id="XMLID_1853_" x="170" y="247.5" style="fill:#FF9811;" width="30" height="0.002"></rect> 
<path id="XMLID_1854_" style="fill:#FF9811;" d="M320,187.5l-50-70h-60h-40v100h30v30h30v-30h30v30h-30v0.002h71.466 c8.24-9.205,20.208-15.002,33.534-15.002s25.294,5.797,33.534,15.002H410V247.5h-20l-10-30h30v-10L320,187.5z M185,187.5v-40 h69.561l28.571,40H185z"></path> <path id="XMLID_1857_" style="fill:#ACABB1;" d="M0,247.502V277.5h30c0-11.527,4.339-22.037,11.466-29.998H0z"></path> <path id="XMLID_1858_" style="fill:#ACABB1;" d="M170,247.502h-61.466C115.661,255.463,120,265.973,120,277.5h80v-29.998H170z"></path>
 <path id="XMLID_1859_" style="fill:#ACABB1;" d="M230,247.502V277.5h60c0-11.527,4.339-22.037,11.466-29.998H230z"></path> <path id="XMLID_1860_" style="fill:#ACABB1;" d="M380,277.5h30v-29.998h-41.466C375.661,255.463,380,265.973,380,277.5z"></path> <path id="XMLID_1861_" style="fill:#616064;" d="M52.5,277.5c0-12.427,10.073-22.5,22.5-22.5v-22.5 c-13.326,0-25.294,5.797-33.534,15.002C34.339,255.463,30,265.973,30,277.5c0,24.853,20.147,45,45,45V300 C62.573,300,52.5,289.927,52.5,277.5z"></path> <path id="XMLID_1862_" style="fill:#565659;" d="M75,232.5V255c12.427,0,22.5,10.073,22.5,22.5S87.427,300,75,300v22.5 c24.852,0,45-20.147,45-45c0-11.527-4.339-22.037-11.466-29.998C100.294,238.297,88.326,232.5,75,232.5z"></path> <path id="XMLID_1863_" style="fill:#CDCDD0;" d="M52.5,277.5c0,12.427,10.073,22.5,22.5,22.5v-45 C62.573,255,52.5,265.073,52.5,277.5z"></path> 
 <path id="XMLID_1864_" style="fill:#ACABB1;" d="M75,300c12.427,0,22.5-10.073,22.5-22.5S87.427,255,75,255V300z"></path> <path id="XMLID_1865_" style="fill:#616064;" d="M312.5,277.5c0-12.427,10.073-22.5,22.5-22.5v-22.5 c-13.326,0-25.294,5.797-33.534,15.002C294.339,255.463,290,265.973,290,277.5c0,24.853,20.147,45,45,45V300 C322.573,300,312.5,289.927,312.5,277.5z"></path> <path id="XMLID_1866_" style="fill:#565659;" d="M335,232.5V255c12.427,0,22.5,10.073,22.5,22.5S347.427,300,335,300v22.5 c24.852,0,45-20.147,45-45c0-11.527-4.339-22.037-11.466-29.998C360.294,238.297,348.326,232.5,335,232.5z"></path> <path id="XMLID_1867_" style="fill:#CDCDD0;" d="M312.5,277.5c0,12.427,10.073,22.5,22.5,22.5v-45 C322.573,255,312.5,265.073,312.5,277.5z"></path> <path id="XMLID_1868_" style="fill:#ACABB1;" d="M335,300c12.427,0,22.5-10.073,22.5-22.5S347.427,255,335,255V300z"></path>
 <polygon id="XMLID_1869_" style="fill:#FFFFFF;" points="155,147.5 89.782,147.5 72.639,187.5 155,187.5 "></polygon> <polygon id="XMLID_1870_" style="fill:#FFFFFF;" points="185,147.5 185,187.5 283.133,187.5 254.561,147.5 "></polygon> <rect id="XMLID_1871_" y="217.5" style="fill:#FF5023;" width="30" height="30"></rect> <polygon id="XMLID_1872_" style="fill:#FF5023;" points="390,247.5 410,247.5 410,217.5 380,217.5 "></polygon> <polygon id="XMLID_1873_" style="fill:#565659;" points="210,117.5 210,87.5 130,87.5 130,117.5 170,117.5 "></polygon> <rect id="XMLID_1874_" x="170" y="217.5" style="fill:#565659;" width="30" height="30"></rect> <polygon id="XMLID_1875_" style="fill:#565659;" points="230,247.5 200,247.5 200,247.502 200,277.5 230,277.5 230,247.502 "></polygon> <rect id="XMLID_1876_" x="230" y="217.5" style="fill:#565659;" width="30" height="30"></rect> </g> </g>
</svg>

<path class="magnify" d="M38.948,10.429c-18.254,10.539-24.468,33.953-14.057,51.986,9.229,15.984,28.649,22.764,45.654,16.763-0.84868,2.6797-0.61612,5.6834,0.90656,8.3207l17.309,29.98c2.8768,4.9827,9.204,6.6781,14.187,3.8013,4.9827-2.8768,6.6781-9.204,3.8013-14.187l-17.31-29.977c-1.523-2.637-4.008-4.34-6.753-4.945,13.7-11.727,17.543-31.935,8.31-47.919-10.411-18.034-33.796-24.359-52.049-13.82zm6.902,11.955c11.489-6.633,26.133-2.7688,32.893,8.9404,6.7603,11.709,2.7847,26.324-8.704,32.957-11.489,6.632-26.133,2.768-32.893-8.941-6.761-11.709-2.785-26.324,8.704-32.957z"/>
</svg>
    <div class="date">Searching</div>
    <div class="content">
      <p>11 MAR,2024</p>
      <p> 03.00pm</p>
    </div>
  </div>
  <div class="container right">
  <svg class="svg" viewbox="0 0 128 128" width="100%" height="100%">
<svg class="doc" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="-41 -41 492.00 492.00" xml:space="preserve" width="100px" height="100px" fill="#5d32d2" stroke="#5d32d2" stroke-width="2.05" transform="rotate(0)"><g id="SVGRepo_bgCarrier" stroke-width="0"></g>
<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="2.46"></g><g id="SVGRepo_iconCarrier"> <g id="XMLID_1835_"> <path id="XMLID_1850_" style="fill:#FFDA44;" d="M75,232.5c13.326,0,25.294,5.797,33.534,15.002H170V247.5v-30v-100h-40H70l-30,70 H0v30h30v30H0v0.002h41.466C49.706,238.297,61.674,232.5,75,232.5z M89.782,147.5H155v40H72.639L89.782,147.5z"></path> <rect id="XMLID_1853_" x="170" y="247.5" style="fill:#FF9811;" width="30" height="0.002"></rect> 
<path id="XMLID_1854_" style="fill:#FF9811;" d="M320,187.5l-50-70h-60h-40v100h30v30h30v-30h30v30h-30v0.002h71.466 c8.24-9.205,20.208-15.002,33.534-15.002s25.294,5.797,33.534,15.002H410V247.5h-20l-10-30h30v-10L320,187.5z M185,187.5v-40 h69.561l28.571,40H185z"></path> <path id="XMLID_1857_" style="fill:#ACABB1;" d="M0,247.502V277.5h30c0-11.527,4.339-22.037,11.466-29.998H0z"></path> <path id="XMLID_1858_" style="fill:#ACABB1;" d="M170,247.502h-61.466C115.661,255.463,120,265.973,120,277.5h80v-29.998H170z"></path>
 <path id="XMLID_1859_" style="fill:#ACABB1;" d="M230,247.502V277.5h60c0-11.527,4.339-22.037,11.466-29.998H230z"></path> <path id="XMLID_1860_" style="fill:#ACABB1;" d="M380,277.5h30v-29.998h-41.466C375.661,255.463,380,265.973,380,277.5z"></path> <path id="XMLID_1861_" style="fill:#616064;" d="M52.5,277.5c0-12.427,10.073-22.5,22.5-22.5v-22.5 c-13.326,0-25.294,5.797-33.534,15.002C34.339,255.463,30,265.973,30,277.5c0,24.853,20.147,45,45,45V300 C62.573,300,52.5,289.927,52.5,277.5z"></path> <path id="XMLID_1862_" style="fill:#565659;" d="M75,232.5V255c12.427,0,22.5,10.073,22.5,22.5S87.427,300,75,300v22.5 c24.852,0,45-20.147,45-45c0-11.527-4.339-22.037-11.466-29.998C100.294,238.297,88.326,232.5,75,232.5z"></path> <path id="XMLID_1863_" style="fill:#CDCDD0;" d="M52.5,277.5c0,12.427,10.073,22.5,22.5,22.5v-45 C62.573,255,52.5,265.073,52.5,277.5z"></path> 
 <path id="XMLID_1864_" style="fill:#ACABB1;" d="M75,300c12.427,0,22.5-10.073,22.5-22.5S87.427,255,75,255V300z"></path> <path id="XMLID_1865_" style="fill:#616064;" d="M312.5,277.5c0-12.427,10.073-22.5,22.5-22.5v-22.5 c-13.326,0-25.294,5.797-33.534,15.002C294.339,255.463,290,265.973,290,277.5c0,24.853,20.147,45,45,45V300 C322.573,300,312.5,289.927,312.5,277.5z"></path> <path id="XMLID_1866_" style="fill:#565659;" d="M335,232.5V255c12.427,0,22.5,10.073,22.5,22.5S347.427,300,335,300v22.5 c24.852,0,45-20.147,45-45c0-11.527-4.339-22.037-11.466-29.998C360.294,238.297,348.326,232.5,335,232.5z"></path> <path id="XMLID_1867_" style="fill:#CDCDD0;" d="M312.5,277.5c0,12.427,10.073,22.5,22.5,22.5v-45 C322.573,255,312.5,265.073,312.5,277.5z"></path> <path id="XMLID_1868_" style="fill:#ACABB1;" d="M335,300c12.427,0,22.5-10.073,22.5-22.5S347.427,255,335,255V300z"></path>
 <polygon id="XMLID_1869_" style="fill:#FFFFFF;" points="155,147.5 89.782,147.5 72.639,187.5 155,187.5 "></polygon> <polygon id="XMLID_1870_" style="fill:#FFFFFF;" points="185,147.5 185,187.5 283.133,187.5 254.561,147.5 "></polygon> <rect id="XMLID_1871_" y="217.5" style="fill:#FF5023;" width="30" height="30"></rect> <polygon id="XMLID_1872_" style="fill:#FF5023;" points="390,247.5 410,247.5 410,217.5 380,217.5 "></polygon> <polygon id="XMLID_1873_" style="fill:#565659;" points="210,117.5 210,87.5 130,87.5 130,117.5 170,117.5 "></polygon> <rect id="XMLID_1874_" x="170" y="217.5" style="fill:#565659;" width="30" height="30"></rect> <polygon id="XMLID_1875_" style="fill:#565659;" points="230,247.5 200,247.5 200,247.502 200,277.5 230,277.5 230,247.502 "></polygon> <rect id="XMLID_1876_" x="230" y="217.5" style="fill:#565659;" width="30" height="30"></rect> </g> </g>
</svg>

<path class="magnify" d="M38.948,10.429c-18.254,10.539-24.468,33.953-14.057,51.986,9.229,15.984,28.649,22.764,45.654,16.763-0.84868,2.6797-0.61612,5.6834,0.90656,8.3207l17.309,29.98c2.8768,4.9827,9.204,6.6781,14.187,3.8013,4.9827-2.8768,6.6781-9.204,3.8013-14.187l-17.31-29.977c-1.523-2.637-4.008-4.34-6.753-4.945,13.7-11.727,17.543-31.935,8.31-47.919-10.411-18.034-33.796-24.359-52.049-13.82zm6.902,11.955c11.489-6.633,26.133-2.7688,32.893,8.9404,6.7603,11.709,2.7847,26.324-8.704,32.957-11.489,6.632-26.133,2.768-32.893-8.941-6.761-11.709-2.785-26.324,8.704-32.957z"/>
</svg>
    <div class="date">Searching</div>
    <div class="content">
      <p>11 MAR,2024</p>
      <p> 03.00pm</p>
    </div>
  </div>
  <div class="container right">
  <svg class="svg" viewbox="0 0 128 128" width="100%" height="100%">
<svg class="doc" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="-41 -41 492.00 492.00" xml:space="preserve" width="100px" height="100px" fill="#5d32d2" stroke="#5d32d2" stroke-width="2.05" transform="rotate(0)"><g id="SVGRepo_bgCarrier" stroke-width="0"></g>
<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="2.46"></g><g id="SVGRepo_iconCarrier"> <g id="XMLID_1835_"> <path id="XMLID_1850_" style="fill:#FFDA44;" d="M75,232.5c13.326,0,25.294,5.797,33.534,15.002H170V247.5v-30v-100h-40H70l-30,70 H0v30h30v30H0v0.002h41.466C49.706,238.297,61.674,232.5,75,232.5z M89.782,147.5H155v40H72.639L89.782,147.5z"></path> <rect id="XMLID_1853_" x="170" y="247.5" style="fill:#FF9811;" width="30" height="0.002"></rect> 
<path id="XMLID_1854_" style="fill:#FF9811;" d="M320,187.5l-50-70h-60h-40v100h30v30h30v-30h30v30h-30v0.002h71.466 c8.24-9.205,20.208-15.002,33.534-15.002s25.294,5.797,33.534,15.002H410V247.5h-20l-10-30h30v-10L320,187.5z M185,187.5v-40 h69.561l28.571,40H185z"></path> <path id="XMLID_1857_" style="fill:#ACABB1;" d="M0,247.502V277.5h30c0-11.527,4.339-22.037,11.466-29.998H0z"></path> <path id="XMLID_1858_" style="fill:#ACABB1;" d="M170,247.502h-61.466C115.661,255.463,120,265.973,120,277.5h80v-29.998H170z"></path>
 <path id="XMLID_1859_" style="fill:#ACABB1;" d="M230,247.502V277.5h60c0-11.527,4.339-22.037,11.466-29.998H230z"></path> <path id="XMLID_1860_" style="fill:#ACABB1;" d="M380,277.5h30v-29.998h-41.466C375.661,255.463,380,265.973,380,277.5z"></path> <path id="XMLID_1861_" style="fill:#616064;" d="M52.5,277.5c0-12.427,10.073-22.5,22.5-22.5v-22.5 c-13.326,0-25.294,5.797-33.534,15.002C34.339,255.463,30,265.973,30,277.5c0,24.853,20.147,45,45,45V300 C62.573,300,52.5,289.927,52.5,277.5z"></path> <path id="XMLID_1862_" style="fill:#565659;" d="M75,232.5V255c12.427,0,22.5,10.073,22.5,22.5S87.427,300,75,300v22.5 c24.852,0,45-20.147,45-45c0-11.527-4.339-22.037-11.466-29.998C100.294,238.297,88.326,232.5,75,232.5z"></path> <path id="XMLID_1863_" style="fill:#CDCDD0;" d="M52.5,277.5c0,12.427,10.073,22.5,22.5,22.5v-45 C62.573,255,52.5,265.073,52.5,277.5z"></path> 
 <path id="XMLID_1864_" style="fill:#ACABB1;" d="M75,300c12.427,0,22.5-10.073,22.5-22.5S87.427,255,75,255V300z"></path> <path id="XMLID_1865_" style="fill:#616064;" d="M312.5,277.5c0-12.427,10.073-22.5,22.5-22.5v-22.5 c-13.326,0-25.294,5.797-33.534,15.002C294.339,255.463,290,265.973,290,277.5c0,24.853,20.147,45,45,45V300 C322.573,300,312.5,289.927,312.5,277.5z"></path> <path id="XMLID_1866_" style="fill:#565659;" d="M335,232.5V255c12.427,0,22.5,10.073,22.5,22.5S347.427,300,335,300v22.5 c24.852,0,45-20.147,45-45c0-11.527-4.339-22.037-11.466-29.998C360.294,238.297,348.326,232.5,335,232.5z"></path> <path id="XMLID_1867_" style="fill:#CDCDD0;" d="M312.5,277.5c0,12.427,10.073,22.5,22.5,22.5v-45 C322.573,255,312.5,265.073,312.5,277.5z"></path> <path id="XMLID_1868_" style="fill:#ACABB1;" d="M335,300c12.427,0,22.5-10.073,22.5-22.5S347.427,255,335,255V300z"></path>
 <polygon id="XMLID_1869_" style="fill:#FFFFFF;" points="155,147.5 89.782,147.5 72.639,187.5 155,187.5 "></polygon> <polygon id="XMLID_1870_" style="fill:#FFFFFF;" points="185,147.5 185,187.5 283.133,187.5 254.561,147.5 "></polygon> <rect id="XMLID_1871_" y="217.5" style="fill:#FF5023;" width="30" height="30"></rect> <polygon id="XMLID_1872_" style="fill:#FF5023;" points="390,247.5 410,247.5 410,217.5 380,217.5 "></polygon> <polygon id="XMLID_1873_" style="fill:#565659;" points="210,117.5 210,87.5 130,87.5 130,117.5 170,117.5 "></polygon> <rect id="XMLID_1874_" x="170" y="217.5" style="fill:#565659;" width="30" height="30"></rect> <polygon id="XMLID_1875_" style="fill:#565659;" points="230,247.5 200,247.5 200,247.502 200,277.5 230,277.5 230,247.502 "></polygon> <rect id="XMLID_1876_" x="230" y="217.5" style="fill:#565659;" width="30" height="30"></rect> </g> </g>
</svg>

<path class="magnify" d="M38.948,10.429c-18.254,10.539-24.468,33.953-14.057,51.986,9.229,15.984,28.649,22.764,45.654,16.763-0.84868,2.6797-0.61612,5.6834,0.90656,8.3207l17.309,29.98c2.8768,4.9827,9.204,6.6781,14.187,3.8013,4.9827-2.8768,6.6781-9.204,3.8013-14.187l-17.31-29.977c-1.523-2.637-4.008-4.34-6.753-4.945,13.7-11.727,17.543-31.935,8.31-47.919-10.411-18.034-33.796-24.359-52.049-13.82zm6.902,11.955c11.489-6.633,26.133-2.7688,32.893,8.9404,6.7603,11.709,2.7847,26.324-8.704,32.957-11.489,6.632-26.133,2.768-32.893-8.941-6.761-11.709-2.785-26.324,8.704-32.957z"/>
</svg>
    <div class="date">Searching</div>
    <div class="content">
      <p>11 MAR,2024</p>
      <p> 03.00pm</p>
    </div>
  </div>
  <div class="container right">
  <svg class="svg" viewbox="0 0 128 128" width="100%" height="100%">
<svg class="doc" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="-41 -41 492.00 492.00" xml:space="preserve" width="100px" height="100px" fill="#5d32d2" stroke="#5d32d2" stroke-width="2.05" transform="rotate(0)"><g id="SVGRepo_bgCarrier" stroke-width="0"></g>
<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="2.46"></g><g id="SVGRepo_iconCarrier"> <g id="XMLID_1835_"> <path id="XMLID_1850_" style="fill:#FFDA44;" d="M75,232.5c13.326,0,25.294,5.797,33.534,15.002H170V247.5v-30v-100h-40H70l-30,70 H0v30h30v30H0v0.002h41.466C49.706,238.297,61.674,232.5,75,232.5z M89.782,147.5H155v40H72.639L89.782,147.5z"></path> <rect id="XMLID_1853_" x="170" y="247.5" style="fill:#FF9811;" width="30" height="0.002"></rect> 
<path id="XMLID_1854_" style="fill:#FF9811;" d="M320,187.5l-50-70h-60h-40v100h30v30h30v-30h30v30h-30v0.002h71.466 c8.24-9.205,20.208-15.002,33.534-15.002s25.294,5.797,33.534,15.002H410V247.5h-20l-10-30h30v-10L320,187.5z M185,187.5v-40 h69.561l28.571,40H185z"></path> <path id="XMLID_1857_" style="fill:#ACABB1;" d="M0,247.502V277.5h30c0-11.527,4.339-22.037,11.466-29.998H0z"></path> <path id="XMLID_1858_" style="fill:#ACABB1;" d="M170,247.502h-61.466C115.661,255.463,120,265.973,120,277.5h80v-29.998H170z"></path>
 <path id="XMLID_1859_" style="fill:#ACABB1;" d="M230,247.502V277.5h60c0-11.527,4.339-22.037,11.466-29.998H230z"></path> <path id="XMLID_1860_" style="fill:#ACABB1;" d="M380,277.5h30v-29.998h-41.466C375.661,255.463,380,265.973,380,277.5z"></path> <path id="XMLID_1861_" style="fill:#616064;" d="M52.5,277.5c0-12.427,10.073-22.5,22.5-22.5v-22.5 c-13.326,0-25.294,5.797-33.534,15.002C34.339,255.463,30,265.973,30,277.5c0,24.853,20.147,45,45,45V300 C62.573,300,52.5,289.927,52.5,277.5z"></path> <path id="XMLID_1862_" style="fill:#565659;" d="M75,232.5V255c12.427,0,22.5,10.073,22.5,22.5S87.427,300,75,300v22.5 c24.852,0,45-20.147,45-45c0-11.527-4.339-22.037-11.466-29.998C100.294,238.297,88.326,232.5,75,232.5z"></path> <path id="XMLID_1863_" style="fill:#CDCDD0;" d="M52.5,277.5c0,12.427,10.073,22.5,22.5,22.5v-45 C62.573,255,52.5,265.073,52.5,277.5z"></path> 
 <path id="XMLID_1864_" style="fill:#ACABB1;" d="M75,300c12.427,0,22.5-10.073,22.5-22.5S87.427,255,75,255V300z"></path> <path id="XMLID_1865_" style="fill:#616064;" d="M312.5,277.5c0-12.427,10.073-22.5,22.5-22.5v-22.5 c-13.326,0-25.294,5.797-33.534,15.002C294.339,255.463,290,265.973,290,277.5c0,24.853,20.147,45,45,45V300 C322.573,300,312.5,289.927,312.5,277.5z"></path> <path id="XMLID_1866_" style="fill:#565659;" d="M335,232.5V255c12.427,0,22.5,10.073,22.5,22.5S347.427,300,335,300v22.5 c24.852,0,45-20.147,45-45c0-11.527-4.339-22.037-11.466-29.998C360.294,238.297,348.326,232.5,335,232.5z"></path> <path id="XMLID_1867_" style="fill:#CDCDD0;" d="M312.5,277.5c0,12.427,10.073,22.5,22.5,22.5v-45 C322.573,255,312.5,265.073,312.5,277.5z"></path> <path id="XMLID_1868_" style="fill:#ACABB1;" d="M335,300c12.427,0,22.5-10.073,22.5-22.5S347.427,255,335,255V300z"></path>
 <polygon id="XMLID_1869_" style="fill:#FFFFFF;" points="155,147.5 89.782,147.5 72.639,187.5 155,187.5 "></polygon> <polygon id="XMLID_1870_" style="fill:#FFFFFF;" points="185,147.5 185,187.5 283.133,187.5 254.561,147.5 "></polygon> <rect id="XMLID_1871_" y="217.5" style="fill:#FF5023;" width="30" height="30"></rect> <polygon id="XMLID_1872_" style="fill:#FF5023;" points="390,247.5 410,247.5 410,217.5 380,217.5 "></polygon> <polygon id="XMLID_1873_" style="fill:#565659;" points="210,117.5 210,87.5 130,87.5 130,117.5 170,117.5 "></polygon> <rect id="XMLID_1874_" x="170" y="217.5" style="fill:#565659;" width="30" height="30"></rect> <polygon id="XMLID_1875_" style="fill:#565659;" points="230,247.5 200,247.5 200,247.502 200,277.5 230,277.5 230,247.502 "></polygon> <rect id="XMLID_1876_" x="230" y="217.5" style="fill:#565659;" width="30" height="30"></rect> </g> </g>
</svg>

<path class="magnify" d="M38.948,10.429c-18.254,10.539-24.468,33.953-14.057,51.986,9.229,15.984,28.649,22.764,45.654,16.763-0.84868,2.6797-0.61612,5.6834,0.90656,8.3207l17.309,29.98c2.8768,4.9827,9.204,6.6781,14.187,3.8013,4.9827-2.8768,6.6781-9.204,3.8013-14.187l-17.31-29.977c-1.523-2.637-4.008-4.34-6.753-4.945,13.7-11.727,17.543-31.935,8.31-47.919-10.411-18.034-33.796-24.359-52.049-13.82zm6.902,11.955c11.489-6.633,26.133-2.7688,32.893,8.9404,6.7603,11.709,2.7847,26.324-8.704,32.957-11.489,6.632-26.133,2.768-32.893-8.941-6.761-11.709-2.785-26.324,8.704-32.957z"/>
</svg>
    <div class="date">Searching</div>
    <div class="content">
      <p>11 MAR,2024</p>
      <p> 03.00pm</p>
    </div>
  </div>
</div>
                </div>
                <!-- <div class="text-end p-3 cb-1">Action</div> -->
            </div>
        </div>
        <!-- END: Home Side card Menu -->
        <!-- BEGIN: Map Content -->
        <div class="g-col-12 g-col-xl-6 g-col-xxl-9">
            <div class="box p-5 mt-5" style="background:#FBFBFB;box-shadow:  0px 0px 4px 1px rgba(0,0,0,0.3);">
              <div class="d-flex flex-column flex-lg-row pb-5 mx-n5">
                <div class="d-flex flex-1 px-5 align-items-start justify-content-center justify-content-lg-start">
                    <div class="d-flex ms-5">
                        <div class="px-4 ct1" >Vehicle Details</div>
                    </div>
                </div>
              </div>
              <div class="g-col-12 g-col-sm-12 g-col-xxl-3 p-10">
                <div class="row">
                  <div class="col-lg-3"></div>
                  <div class="col-lg-6">
                    <div class="d-flex">
                        <div class="me-auto vd">Plate.No</div>
                        <div class="fw-medium vd1">TN66BR1234</div>
                    </div>
                    <div class="d-flex mt-4">
                        <div class="me-auto vd">Type</div>
                        <div class="fw-medium vd1">SUV</div>
                    </div>
                    <div class="d-flex mt-4">
                        <div class="me-auto vd">Make</div>
                        <div class="fw-medium vd1">Honda</div>
                    </div>
                    <div class="d-flex mt-4">
                        <div class="me-auto vd">Model</div>
                        <div class="fw-medium vd1">2020</div>
                    </div>
                    <div class="d-flex mt-4">
                        <div class="me-auto vd">Color</div>
                        <div class="fw-medium vd1">White</div>
                    </div>
                  </div>
                  <div class="col-lg-3"></div>
                </div>
              </div>
            </div>
<!-- driver details -->
            <div class="grid columns-12 gap-5 mt-5">
              <div class="g-col-12 g-col-lg-6 g-col-xl-6">
                  <div class="box p-5 mt-5" style="background:#FBFBFB;box-shadow:  0px 0px 4px 1px rgba(0,0,0,0.3);">
                  <div class="d-flex flex-column flex-lg-row pb-5 mx-n5">
                    <div class="d-flex flex-1 px-5 align-items-start justify-content-center justify-content-lg-start">
                        <div class="d-flex ms-5">
                            <div class="px-4 ct1" >Driver Details</div>
                        </div>
                    </div>
                  </div>
                  <div class="g-col-12 g-col-sm-12 g-col-xxl-3 p-10">
                        <div class="d-flex">
                            <i data-feather="user"></i>
                            <div class="fw-medium vd1 ms-2">Sudarsan</div>
                        </div>
                        <div class="d-flex mt-4">
                            <i data-feather="smartphone"></i>
                            <div class="fw-medium vd1 ms-2">+91-9876543210</div>
                        </div>
                  </div>
                </div>
              </div>
<!-- user details -->
              <div class="g-col-12 g-col-lg-6 g-col-xl-6">
                  <div class="box p-5 mt-5" style="background:#FBFBFB;box-shadow:  0px 0px 4px 1px rgba(0,0,0,0.3);">
                  <div class="d-flex flex-column flex-lg-row pb-5 mx-n5">
                    <div class="d-flex flex-1 px-5 align-items-start justify-content-center justify-content-lg-start">
                        <div class="d-flex ms-5">
                            <div class="px-4 ct1" >User Details</div>
                        </div>
                    </div>
                  </div>
                  <div class="g-col-12 g-col-sm-12 g-col-xxl-3 p-10">
                        <div class="d-flex">
                            <i data-feather="user"></i>
                            <div class="fw-medium vd1 ms-2">Sudarsan</div>
                        </div>
                        <div class="d-flex mt-4">
                            <i data-feather="smartphone"></i>
                            <div class="fw-medium vd1 ms-2">+91-9876543210</div>
                        </div>
                  </div>
                </div>
              </div>
<!-- payment details -->
              <div class="g-col-12 g-col-lg-6 g-col-xl-6">
                  <div class="box p-5 mt-5" style="background:#FBFBFB;box-shadow:  0px 0px 4px 1px rgba(0,0,0,0.3);">
                  <div class="d-flex flex-column flex-lg-row pb-5 mx-n5">
                    <div class="d-flex flex-1 px-5 align-items-start justify-content-center justify-content-lg-start">
                        <div class="d-flex ms-5">
                            <div class="px-4 ct1" >Payment Details</div>
                        </div>
                    </div>
                  </div>
                  <div class="g-col-12 g-col-sm-12 g-col-xxl-3 p-10">
                        <div class="d-flex">
                            <div class="me-auto vd">Payment Types</div>
                            <div class="fw-medium vd1 ms-2">Cash</div>
                        </div>
                        <div class="d-flex mt-4">
                            <div class="me-auto vd">Total Fare</div>
                            <div class="fw-medium vd1 ms-2">Rs 20</div>
                        </div>
                  </div>
                </div>
              </div>
<!-- Rating details -->
              <div class="g-col-12 g-col-lg-6 g-col-xl-6">
                  <div class="box p-5 mt-5" style="background:#FBFBFB;box-shadow:  0px 0px 4px 1px rgba(0,0,0,0.3);">
                  <div class="d-flex flex-column flex-lg-row pb-5 mx-n5">
                    <div class="d-flex flex-1 px-5 align-items-start justify-content-center justify-content-lg-start">
                        <div class="d-flex ms-5">
                            <div class="px-4 ct1" >Ratings</div>
                        </div>
                    </div>
                  </div>
                  <div class="g-col-12 g-col-sm-12 g-col-xxl-3 p-10">
                        <div class="d-flex">
                            <div class="me-auto vd">User</div>
                            <div class="fw-medium vd1 ms-2">4 <i class="fa fa-star" style="color:yellow"></i></div>
                        </div>
                        <div class="d-flex mt-4">
                            <div class="me-auto vd">Driver</div>
                            <div class="fw-medium vd1 ms-2">4 <i class="fa fa-star" style="color:yellow"></i></div>
                        </div>
                  </div>
                </div>
              </div>
<!-- Trip summary -->
              <div class="g-col-12 g-col-lg-12 g-col-xl-12">
                  <div class="box p-5 mt-5" style="background:#FBFBFB;box-shadow:  0px 0px 4px 1px rgba(0,0,0,0.3);">
                  <div class="d-flex flex-column flex-lg-row pb-5 mx-n5">
                    <div class="d-flex flex-1 px-5 align-items-start justify-content-center justify-content-lg-start">
                        <div class="d-flex ms-5">
                            <div class="px-4 ct1" >Trip Summary</div>
                        </div>
                    </div>
                  </div>
                    <div class="p-10 mt-5 vd1">
                      <div class="d-flex">
                          <div class="me-auto">Base Price</div>
                          <div class="fw-medium">$250</div>
                      </div>
                      <div class="d-flex mt-4">
                          <div class="me-auto">Distance Price</div>
                          <div class="fw-medium">$10</div>
                      </div>
                      <div class="d-flex mt-4">
                          <div class="me-auto">Waiting Price($1 x 20mins)</div>
                          <div class="fw-medium">$10</div>
                      </div>
                      <div class="d-flex mt-4">
                          <div class="me-auto">Convenience Fee</div>
                          <div class="fw-medium">$10</div>
                      </div>
                      <div class="d-flex mt-4 text-theme-6">
                          <div class="me-auto">Discount</div>
                          <div class="fw-medium text-theme-6">-$20</div>
                      </div>
                      <div class="d-flex mt-4">
                          <div class="me-auto">Tax</div>
                          <div class="fw-medium">$15</div>
                      </div>
                      <div class="d-flex mt-4 pt-4 border-top border-gray-200 vd1">
                          <div class="me-auto ">Total Fare</div>
                          <div class="">$220</div>
                      </div>
                    </div>
                </div>
              </div>
            </div>
        </div>
        <!-- END: Map Content -->
    </div>
    </div>
<!-- end  -->
    </div>
</div>





@endsection
@push('scripts-js')
<script>
  jQuery(document).ready(function($){
	var $timeline_block = $('.cd-timeline-block');

	//hide timeline blocks which are outside the viewport
	$timeline_block.each(function(){
		if($(this).offset().top > $(window).scrollTop()+$(window).height()*0.75) {
			$(this).find('.cd-timeline-img, .cd-timeline-content').addClass('is-hidden');
		}
	});

	//on scolling, show/animate timeline blocks when enter the viewport
	$(window).on('scroll', function(){
		$timeline_block.each(function(){
			if( $(this).offset().top <= $(window).scrollTop()+$(window).height()*0.75 && $(this).find('.cd-timeline-img').hasClass('is-hidden') ) {
				$(this).find('.cd-timeline-img, .cd-timeline-content').removeClass('is-hidden').addClass('bounce-in');
			}
		});
	});
});
</script>
@endpush
        <!-- END: Form Layout -->

