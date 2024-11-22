@extends('dispatch-new.layout')

@section('dispatch-content')
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ asset('assets/css/dispatcher/requestlist.css') }}">
<style>

</style>



<div class="g-col-12 mt-8 p-10">
    <div class="intro-y d-flex align-items-center h-10 mb-10">
        <h2 class=" me-5" style="font-size:25px;font-weight:800;color:#7F00FF;">
           <i class="far fa-question-circle" style="color:black;"></i> Request List
        </h2>
    </div>
    <div class="grid columns-12 gap-6 mt-5">
        <div class="g-col-12 g-col-sm-6 g-col-xl-3">
            <div class="zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(127, 0, 255, 0.15);border-radius:15px;">
                <div class="box p-5" style="border-radius:15px;">
                    <div class="text-center mt-6" style="font-size:25px;font-weight:800;">COMPLETED</div>
                    <div class="text-end mt-1 p-5" style="font-size:25px;font-weight:800;color:#7F00FF;">10</div>
                </div>
            </div>
        </div>
        <div class="g-col-12 g-col-sm-6 g-col-xl-3">
            <div class="zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(127, 0, 255, 0.15);border-radius:15px;">
                <div class="box p-5" style="border-radius:15px;">
                    <div class="text-center mt-6" style="font-size:25px;font-weight:800;">USER CANCELLED</div>
                    <div class="text-end text-theme-6 mt-1 p-5" style="font-size:25px;font-weight:800;color:#7F00FF;">4</div>
                </div>
            </div>
        </div>
        <div class="g-col-12 g-col-sm-6 g-col-xl-3">
            <div class="zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(127, 0, 255, 0.15);border-radius:15px;">
                <div class="box p-5" style="border-radius:15px;">
                    <div class="text-center mt-6" style="font-size:25px;font-weight:800;">DRIVER CANCELLED</div>
                    <div class="text-end text-theme-6 mt-1 p-5" style="font-size:25px;font-weight:800;color:#7F00FF;">4</div>
                </div>
            </div>
        </div>
        <div class="g-col-12 g-col-sm-6 g-col-xl-3">
            <div class="zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(127, 0, 255, 0.15);border-radius:15px;">
                <div class="box p-5" style="border-radius:15px;">
                    <div class="text-center mt-6" style="font-size:25px;font-weight:800;">UPCOMING</div>
                    <div class="text-end text-theme-10 mt-1 p-5" style="font-size:25px;font-weight:800;color:#7F00FF;">4</div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
  function get_request_list(type){
            fetch('{{url("/")}}/dispatch/request_fetch?type='+type)
            .then(response => response.text())
            .then(html=>{
                document.querySelector('#js-admin-partial-target').innerHTML = html
            });

    }
</script>

<div class="g-col-12 g-col-lg-4 mt-10 p-10">
      <div class=" pe-1  d-flex align-items-center">
          <div class="box p-2 w-4/5" style="background:#EAF0FB;">
              <ul class="pos__tabs nav nav-pills rounded-2" role="tablist">
                  <li id="all-tab" class="nav-item flex-1" role="presentation">
                      <button class="nav-link w-full pt-2 pb-2.5 active" onclick="get_request_list('all')" data-bs-toggle="pill" data-bs-target="all" type="button" role="tab" aria-controls="all-tab" aria-selected="{{$type=='all' ? 'true' : 'false'}}">All</button>
                  </li>
                  <li id="completed-tab" class="nav-item flex-1" role="presentation">
                      <button class="nav-link w-full pt-2 pb-2.5" onclick="get_request_list('completed')" data-bs-toggle="pill" data-bs-target="completed" type="button" role="tab" aria-controls="completed-tab" aria-selected="{{$type=='completed' ? 'true' : 'false'}}">Completed</button>
                  </li>
                  <li id="cancelled-tab" class="nav-item flex-1" role="presentation">
                      <button class="nav-link w-full pt-2 pb-2.5" onclick="get_request_list('cancelled')" data-bs-toggle="pill" data-bs-target="cancelled" type="button" role="tab" aria-controls="cancelled-tab" aria-selected="{{$type=='cancelled' ? 'true' : 'false'}}">Cancelled</button>
                  </li>
                  <li id="upcoming-tab" class="nav-item flex-1" role="presentation">
                      <button class="nav-link w-full pt-2 pb-2.5" onclick="get_request_list('upcoming')" data-bs-toggle="pill" data-bs-target="upcoming" type="button" role="tab" aria-controls="upcoming-tab" aria-selected="{{$type=='upcoming' ? 'true' : 'false'}}">Upcoming</button>
                  </li>
              </ul>
          </div>
          <a href="" data-toggle="modal" data-target="#basicModal" class="btn ms-auto d-flex align-items-center text-theme-1 p-2" style="background:white;border-radius:10px;box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);"><i data-feather="sliders" style="rotate:90deg;"></i></a>
 

      </div>
      <div id="js-admin-partial-target" class="pagination-snippet">
        <include-fragment src="{{url('/')}}/dispatch/request_fetch?type={{ $type }}">
          <span style="text-align: center;font-weight: bold;"> Loading...</span>
        </include-fragment>
      </div>
<div class="tab-content mt-5">

 <!-- all req tab -->
  <div class="tab-pane fade active show" id="{{$type}}" role="tabpanel" aria-labelledby="all-tab">
  </div>
  <!-- </div> -->
<!-- END: all req  -->


 <!-- completed rides tab -->
          <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
          <div class="grid columns-12 gap-5 mt-5">
                    <!-- BEGIN: Driver Side Menu -->
                    <div class="g-col-12 g-col-xl-12 g-col-xxl-12">
                      <div class="box p-5 intro-y mt-5" style="background:#FBFBFB;box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                               
                      <div class=" intro-y">
 <div class="overflow-x-auto p-5">
  <table class="table caption-top tb">
    <thead>
      <tr>
        <th scope="col">Request Id</th>
        <th scope="col">Date</th>
        <th scope="col">Pickup Location</th>
        <th scope="col">Trip Status</th>
        <th scope="col">View</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">Req_001</th>
        <td>05th Mar,3pm</td>
        <td>Coimbatore</td>
        <td>In progress</td>
        <td>
          <button class="btn btn-primary accordion-btn" type="button" data-bs-toggle="collapse" data-bs-target="#accordionExample1" aria-expanded="false" aria-controls="accordionExample1">
         <i class="fa fa-chevron-down"></i>
    </button>
        </td>
      </tr>
      <tr class="accordion-row">
        <td colspan="5">
          <div class="collapse" id="accordionExample1">
            <div class="">
              <div class="grid columns-12 gap-5 mt-5">
                    <!-- BEGIN: Driver Side Menu -->
                    <div class="g-col-12 g-col-xl-12 g-col-xxl-12">
                      <div class="box p-5 intro-y mt-5" style="background:#FBFBFB;box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                                <div class="intro-y d-flex align-items-center h-10 p-5">
                                    <a href="{{ url('/detailed-view') }}" class="ms-auto d-flex align-items-center"> <i data-feather="maximize-2" class="me-2"></i> Detailed View </a>
                                </div>
                            <div class=" intro-y">
                                <div class="pos intro-y grid columns-12 gap-5 mt-5">
                                    <!-- BEGIN: Left portion -->
                                    <div class="intro-y g-col-12 g-col-lg-5 ms-5">
                                        <div class="grid grid-cols-12 gap-5 mt-5">
                                            <div class="g-col-12 g-col-sm-6 g-col-xxl-3 box p-5 cursor-pointer zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
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
                                            </div>
                                            <div class="g-col-12 g-col-sm-12 g-col-xxl-3 box p-10 cursor-pointer zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                                                <div class="mt-5 d-flex align-items-center" style="font-size:clamp(12px, 2Vw, 18px);font-weight:800;"><i data-feather="disc" class="me-5" style="font-size:24px;font-weight:400;color:#59E304;"></i>Home,saravanampatti,Coimbatore-35</div>
                                                <div class="mt-5 d-flex align-items-center" style="font-size:clamp(12px, 2Vw, 18px);font-weight:800;"><i data-feather="map-pin" class="me-5" style="font-size:24px;font-weight:800;color:red;"></i>Drop,Gandhipuram,Coimbatore-05</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END: Left portion -->
                                    <!-- BEGIN: Right -->
  <div class="g-col-12 g-col-lg-7 box" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
    <section class="ps-timeline-sec">
        <div class="container">
            <ol class="ps-timeline">
                <li>
                    <div class="img-handler-top">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-bot">
                        <h1 style="font-size:20px;color:#7F00FF;">Trip Request</h1>
                    </div>
                    <span class="ps-sp-top"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-bot">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-top">
                      <h1 style="font-size:20px;color:#7F00FF;">Trip Accepted</h1>
                    </div>
                    <span class="ps-sp-bot"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-top">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-bot">
                      <h1 style="font-size:20px;color:#7F00FF;">Driver Arrived</h1>
                    </div>
                    <span class="ps-sp-top"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-bot">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-top">
                      <h1 style="font-size:20px;color:#7F00FF;">Trip Started</h1>
                    </div>
                    <span class="ps-sp-bot"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-top">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-bot">
                      <h1 style="font-size:20px;color:#7F00FF;">Trip Ended</h1>
                    </div>
                    <span class="ps-sp-top"><strong class="dot"></strong></span>
                </li>
            </ol>
        </div>
    </section>
  </div>
  <!-- END: Right -->
            </div>
        </div>
            </div>
          </div>
        </td>
      </tr>
      <tr>
        <th scope="row">Req_002</th>
        <td>05th Mar,3pm</td>
        <td>Coimbatore</td>
        <td>In progress</td>
        <td>
          <button class="btn btn-primary accordion-btn" type="button" data-bs-toggle="collapse" data-bs-target="#accordionExample2" aria-expanded="false" aria-controls="accordionExample2">
         <i class="fa fa-chevron-down"></i>
    </button>
        </td>
      </tr>
      <tr class="accordion-row">
        <td colspan="5">
          <div class="collapse" id="accordionExample2">
            <div class="">
            <div class="grid columns-12 gap-5 mt-5">
                    <!-- BEGIN: Driver Side Menu -->
                    <div class="g-col-12 g-col-xl-12 g-col-xxl-12">
                      <div class="box p-5 intro-y mt-5" style="background:#FBFBFB;box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                                <div class="intro-y d-flex align-items-center h-10 p-5">
                                    <a href="{{ url('/detailed-view') }}" class="ms-auto d-flex align-items-center"> <i data-feather="maximize-2" class="me-2"></i> Detailed View </a>
                                </div>
                            <div class=" intro-y">
                                <div class="pos intro-y grid columns-12 gap-5 mt-5">
                                    <!-- BEGIN: Left portion -->
                                    <div class="intro-y g-col-12 g-col-lg-5 ms-5">
                                        <div class="grid grid-cols-12 gap-5 mt-5">
                                            <div class="g-col-12 g-col-sm-6 g-col-xxl-3 box p-5 cursor-pointer zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
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
                                            </div>
                                            <div class="g-col-12 g-col-sm-12 g-col-xxl-3 box p-10 cursor-pointer zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                                                <div class="mt-5 d-flex align-items-center" style="font-size:clamp(12px, 2Vw, 18px);font-weight:800;"><i data-feather="disc" class="me-5" style="font-size:24px;font-weight:400;color:#59E304;"></i>Home,saravanampatti,Coimbatore-35</div>
                                                <div class="mt-5 d-flex align-items-center" style="font-size:clamp(12px, 2Vw, 18px);font-weight:800;"><i data-feather="map-pin" class="me-5" style="font-size:24px;font-weight:800;color:red;"></i>Drop,Gandhipuram,Coimbatore-05</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END: Left portion -->
                                    <!-- BEGIN: Right -->
  <div class="g-col-12 g-col-lg-7 box" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
    <section class="ps-timeline-sec">
        <div class="container">
            <ol class="ps-timeline">
                <li>
                    <div class="img-handler-top">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-bot">
                        <h1 style="font-size:20px;color:#7F00FF;">Trip Request</h1>
                    </div>
                    <span class="ps-sp-top"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-bot">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-top">
                      <h1 style="font-size:20px;color:#7F00FF;">Trip Accepted</h1>
                    </div>
                    <span class="ps-sp-bot"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-top">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-bot">
                      <h1 style="font-size:20px;color:#7F00FF;">Driver Arrived</h1>
                    </div>
                    <span class="ps-sp-top"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-bot">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-top">
                      <h1 style="font-size:20px;color:#7F00FF;">Trip Started</h1>
                    </div>
                    <span class="ps-sp-bot"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-top">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-bot">
                      <h1 style="font-size:20px;color:#7F00FF;">Trip Ended</h1>
                    </div>
                    <span class="ps-sp-top"><strong class="dot"></strong></span>
                </li>
            </ol>
        </div>
    </section>
  </div>
  <!-- END: Right -->
            </div>
        </div>
            </div>
          </div>
        </td>
      </tr>
      <tr>
        <th scope="row"><a href="">Req_003</a></th>
        <td>05th Mar,3pm</td>
        <td>Coimbatore</td>
        <td>In progress</td>
        <td>
          <button class="btn btn-primary accordion-btn" type="button" data-bs-toggle="collapse" data-bs-target="#accordionExample3" aria-expanded="false" aria-controls="accordionExample3">
         <i class="fa fa-chevron-down"></i>
    </button>
           
        </td>
      </tr>
      <tr class="accordion-row">
        <td colspan="5">
          <div class="collapse" id="accordionExample3">
            <div class="">
            <div class="grid columns-12 gap-5 mt-5">
                    <!-- BEGIN: Driver Side Menu -->
                    <div class="g-col-12 g-col-xl-12 g-col-xxl-12">
                      <div class="box p-5 intro-y mt-5" style="background:#FBFBFB;box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                                <div class="intro-y d-flex align-items-center h-10 p-5">
                                    <a href="{{ url('/detailed-view') }}" class="ms-auto d-flex align-items-center"> <i data-feather="maximize-2" class="me-2"></i> Detailed View </a>
                                </div>
                            <div class=" intro-y">
                                <div class="pos intro-y grid columns-12 gap-5 mt-5">
                                    <!-- BEGIN: Left portion -->
                                    <div class="intro-y g-col-12 g-col-lg-5 ms-5">
                                        <div class="grid grid-cols-12 gap-5 mt-5">
                                            <div class="g-col-12 g-col-sm-6 g-col-xxl-3 box p-5 cursor-pointer zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
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
                                            </div>
                                            <div class="g-col-12 g-col-sm-12 g-col-xxl-3 box p-10 cursor-pointer zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                                                <div class="mt-5 d-flex align-items-center" style="font-size:clamp(12px, 2Vw, 18px);font-weight:800;"><i data-feather="disc" class="me-5" style="font-size:24px;font-weight:400;color:#59E304;"></i>Home,saravanampatti,Coimbatore-35</div>
                                                <div class="mt-5 d-flex align-items-center" style="font-size:clamp(12px, 2Vw, 18px);font-weight:800;"><i data-feather="map-pin" class="me-5" style="font-size:24px;font-weight:800;color:red;"></i>Drop,Gandhipuram,Coimbatore-05</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END: Left portion -->
                                    <!-- BEGIN: Right -->
  <div class="g-col-12 g-col-lg-7 box" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
    <section class="ps-timeline-sec">
        <div class="container">
            <ol class="ps-timeline">
                <li>
                    <div class="img-handler-top">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-bot">
                        <h1 style="font-size:20px;color:#7F00FF;">Trip Request</h1>
                    </div>
                    <span class="ps-sp-top"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-bot">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-top">
                      <h1 style="font-size:20px;color:#7F00FF;">Trip Accepted</h1>
                    </div>
                    <span class="ps-sp-bot"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-top">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-bot">
                      <h1 style="font-size:20px;color:#7F00FF;">Driver Arrived</h1>
                    </div>
                    <span class="ps-sp-top"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-bot">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-top">
                      <h1 style="font-size:20px;color:#7F00FF;">Trip Started</h1>
                    </div>
                    <span class="ps-sp-bot"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-top">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-bot">
                      <h1 style="font-size:20px;color:#7F00FF;">Trip Ended</h1>
                    </div>
                    <span class="ps-sp-top"><strong class="dot"></strong></span>
                </li>
            </ol>
        </div>
    </section>
  </div>
  <!-- END: Right -->
            </div>
        </div>
            </div>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</div>
 </div>
  </div>
</div>
<!-- END: Home Side card Menu -->
</div>
</div>

<!-- cancelled rides tab -->
<div class="tab-pane fade" id="cancelled" role="tabpanel" aria-labelledby="cancelled-tab">
<div class="grid columns-12 gap-5 mt-5">
                <!-- BEGIN: Driver Side Menu -->
                <div class="g-col-12 g-col-xl-12 g-col-xxl-12">
                  <div class="box p-5 intro-y mt-5" style="background:#FBFBFB;box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                  <div class=" intro-y">
 <div class="overflow-x-auto p-5">
  <table class="table caption-top tb">
    <thead>
      <tr>
        <th scope="col">Request Id</th>
        <th scope="col">Date</th>
        <th scope="col">Pickup Location</th>
        <th scope="col">Trip Status</th>
        <th scope="col">View</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">Req_001</th>
        <td>05th Mar,3pm</td>
        <td>Coimbatore</td>
        <td>In progress</td>
        <td>
          <button class="btn btn-primary accordion-btn" type="button" data-bs-toggle="collapse" data-bs-target="#accordionExample1" aria-expanded="false" aria-controls="accordionExample1">
         <i class="fa fa-chevron-down"></i>
    </button>
        </td>
      </tr>
      <tr class="accordion-row">
        <td colspan="5">
          <div class="collapse" id="accordionExample1">
            <div class="">
              <div class="grid columns-12 gap-5 mt-5">
                    <!-- BEGIN: Driver Side Menu -->
                    <div class="g-col-12 g-col-xl-12 g-col-xxl-12">
                      <div class="box p-5 intro-y mt-5" style="background:#FBFBFB;box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                                <div class="intro-y d-flex align-items-center h-10 p-5">
                                    <a href="{{ url('/detailed-view') }}" class="ms-auto d-flex align-items-center"> <i data-feather="maximize-2" class="me-2"></i> Detailed View </a>
                                </div>
                            <div class=" intro-y">
                                <div class="pos intro-y grid columns-12 gap-5 mt-5">
                                    <!-- BEGIN: Left portion -->
                                    <div class="intro-y g-col-12 g-col-lg-5 ms-5">
                                        <div class="grid grid-cols-12 gap-5 mt-5">
                                            <div class="g-col-12 g-col-sm-6 g-col-xxl-3 box p-5 cursor-pointer zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
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
                                            </div>
                                            <div class="g-col-12 g-col-sm-12 g-col-xxl-3 box p-10 cursor-pointer zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                                                <div class="mt-5 d-flex align-items-center" style="font-size:clamp(12px, 2Vw, 18px);font-weight:800;"><i data-feather="disc" class="me-5" style="font-size:24px;font-weight:400;color:#59E304;"></i>Home,saravanampatti,Coimbatore-35</div>
                                                <div class="mt-5 d-flex align-items-center" style="font-size:clamp(12px, 2Vw, 18px);font-weight:800;"><i data-feather="map-pin" class="me-5" style="font-size:24px;font-weight:800;color:red;"></i>Drop,Gandhipuram,Coimbatore-05</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END: Left portion -->
                                    <!-- BEGIN: Right -->
  <div class="g-col-12 g-col-lg-7 box" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
    <section class="ps-timeline-sec">
        <div class="container">
            <ol class="ps-timeline">
                <li>
                    <div class="img-handler-top">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-bot">
                        <h1 style="font-size:20px;color:#7F00FF;">Trip Request</h1>
                    </div>
                    <span class="ps-sp-top"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-bot">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-top">
                      <h1 style="font-size:20px;color:#7F00FF;">Trip Accepted</h1>
                    </div>
                    <span class="ps-sp-bot"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-top">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-bot">
                      <h1 style="font-size:20px;color:#7F00FF;">Driver Arrived</h1>
                    </div>
                    <span class="ps-sp-top"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-bot">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-top">
                      <h1 style="font-size:20px;color:#7F00FF;">Trip Started</h1>
                    </div>
                    <span class="ps-sp-bot"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-top">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-bot">
                      <h1 style="font-size:20px;color:#7F00FF;">Trip Ended</h1>
                    </div>
                    <span class="ps-sp-top"><strong class="dot"></strong></span>
                </li>
            </ol>
        </div>
    </section>
  </div>
  <!-- END: Right -->
            </div>
        </div>
            </div>
          </div>
        </td>
      </tr>
      <tr>
        <th scope="row">Req_002</th>
        <td>05th Mar,3pm</td>
        <td>Coimbatore</td>
        <td>In progress</td>
        <td>
          <button class="btn btn-primary accordion-btn" type="button" data-bs-toggle="collapse" data-bs-target="#accordionExample2" aria-expanded="false" aria-controls="accordionExample2">
         <i class="fa fa-chevron-down"></i>
    </button>
        </td>
      </tr>
      <tr class="accordion-row">
        <td colspan="5">
          <div class="collapse" id="accordionExample2">
            <div class="">
            <div class="grid columns-12 gap-5 mt-5">
                    <!-- BEGIN: Driver Side Menu -->
                    <div class="g-col-12 g-col-xl-12 g-col-xxl-12">
                      <div class="box p-5 intro-y mt-5" style="background:#FBFBFB;box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                                <div class="intro-y d-flex align-items-center h-10 p-5">
                                    <a href="{{ url('/detailed-view') }}" class="ms-auto d-flex align-items-center"> <i data-feather="maximize-2" class="me-2"></i> Detailed View </a>
                                </div>
                            <div class=" intro-y">
                                <div class="pos intro-y grid columns-12 gap-5 mt-5">
                                    <!-- BEGIN: Left portion -->
                                    <div class="intro-y g-col-12 g-col-lg-5 ms-5">
                                        <div class="grid grid-cols-12 gap-5 mt-5">
                                            <div class="g-col-12 g-col-sm-6 g-col-xxl-3 box p-5 cursor-pointer zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
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
                                            </div>
                                            <div class="g-col-12 g-col-sm-12 g-col-xxl-3 box p-10 cursor-pointer zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                                                <div class="mt-5 d-flex align-items-center" style="font-size:clamp(12px, 2Vw, 18px);font-weight:800;"><i data-feather="disc" class="me-5" style="font-size:24px;font-weight:400;color:#59E304;"></i>Home,saravanampatti,Coimbatore-35</div>
                                                <div class="mt-5 d-flex align-items-center" style="font-size:clamp(12px, 2Vw, 18px);font-weight:800;"><i data-feather="map-pin" class="me-5" style="font-size:24px;font-weight:800;color:red;"></i>Drop,Gandhipuram,Coimbatore-05</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END: Left portion -->
                                    <!-- BEGIN: Right -->
  <div class="g-col-12 g-col-lg-7 box" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
    <section class="ps-timeline-sec">
        <div class="container">
            <ol class="ps-timeline">
                <li>
                    <div class="img-handler-top">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-bot">
                        <h1 style="font-size:20px;color:#7F00FF;">Trip Request</h1>
                    </div>
                    <span class="ps-sp-top"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-bot">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-top">
                      <h1 style="font-size:20px;color:#7F00FF;">Trip Accepted</h1>
                    </div>
                    <span class="ps-sp-bot"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-top">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-bot">
                      <h1 style="font-size:20px;color:#7F00FF;">Driver Arrived</h1>
                    </div>
                    <span class="ps-sp-top"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-bot">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-top">
                      <h1 style="font-size:20px;color:#7F00FF;">Trip Started</h1>
                    </div>
                    <span class="ps-sp-bot"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-top">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-bot">
                      <h1 style="font-size:20px;color:#7F00FF;">Trip Ended</h1>
                    </div>
                    <span class="ps-sp-top"><strong class="dot"></strong></span>
                </li>
            </ol>
        </div>
    </section>
  </div>
  <!-- END: Right -->
            </div>
        </div>
            </div>
          </div>
        </td>
      </tr>
      <tr>
        <th scope="row"><a href="">Req_003</a></th>
        <td>05th Mar,3pm</td>
        <td>Coimbatore</td>
        <td>In progress</td>
        <td>
          <button class="btn btn-primary accordion-btn" type="button" data-bs-toggle="collapse" data-bs-target="#accordionExample3" aria-expanded="false" aria-controls="accordionExample3">
         <i class="fa fa-chevron-down"></i>
    </button>
           
        </td>
      </tr>
      <tr class="accordion-row">
        <td colspan="5">
          <div class="collapse" id="accordionExample3">
            <div class="">
            <div class="grid columns-12 gap-5 mt-5">
                    <!-- BEGIN: Driver Side Menu -->
                    <div class="g-col-12 g-col-xl-12 g-col-xxl-12">
                      <div class="box p-5 intro-y mt-5" style="background:#FBFBFB;box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                                <div class="intro-y d-flex align-items-center h-10 p-5">
                                    <a href="{{ url('/detailed-view') }}" class="ms-auto d-flex align-items-center"> <i data-feather="maximize-2" class="me-2"></i> Detailed View </a>
                                </div>
                            <div class=" intro-y">
                                <div class="pos intro-y grid columns-12 gap-5 mt-5">
                                    <!-- BEGIN: Left portion -->
                                    <div class="intro-y g-col-12 g-col-lg-5 ms-5">
                                        <div class="grid grid-cols-12 gap-5 mt-5">
                                            <div class="g-col-12 g-col-sm-6 g-col-xxl-3 box p-5 cursor-pointer zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
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
                                            </div>
                                            <div class="g-col-12 g-col-sm-12 g-col-xxl-3 box p-10 cursor-pointer zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                                                <div class="mt-5 d-flex align-items-center" style="font-size:clamp(12px, 2Vw, 18px);font-weight:800;"><i data-feather="disc" class="me-5" style="font-size:24px;font-weight:400;color:#59E304;"></i>Home,saravanampatti,Coimbatore-35</div>
                                                <div class="mt-5 d-flex align-items-center" style="font-size:clamp(12px, 2Vw, 18px);font-weight:800;"><i data-feather="map-pin" class="me-5" style="font-size:24px;font-weight:800;color:red;"></i>Drop,Gandhipuram,Coimbatore-05</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END: Left portion -->
                                    <!-- BEGIN: Right -->
  <div class="g-col-12 g-col-lg-7 box" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
    <section class="ps-timeline-sec">
        <div class="container">
            <ol class="ps-timeline">
                <li>
                    <div class="img-handler-top">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-bot">
                        <h1 style="font-size:20px;color:#7F00FF;">Trip Request</h1>
                    </div>
                    <span class="ps-sp-top"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-bot">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-top">
                      <h1 style="font-size:20px;color:#7F00FF;">Trip Accepted</h1>
                    </div>
                    <span class="ps-sp-bot"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-top">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-bot">
                      <h1 style="font-size:20px;color:#7F00FF;">Driver Arrived</h1>
                    </div>
                    <span class="ps-sp-top"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-bot">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-top">
                      <h1 style="font-size:20px;color:#7F00FF;">Trip Started</h1>
                    </div>
                    <span class="ps-sp-bot"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-top">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-bot">
                      <h1 style="font-size:20px;color:#7F00FF;">Trip Ended</h1>
                    </div>
                    <span class="ps-sp-top"><strong class="dot"></strong></span>
                </li>
            </ol>
        </div>
    </section>
  </div>
  <!-- END: Right -->
            </div>
        </div>
            </div>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</div>
 </div>
  </div>
</div>
<!-- END: Home Side card Menu -->
</div>
</div>

<!-- upcoimg rides tab -->
<div class="tab-pane fade" id="upcoming" role="tabpanel" aria-labelledby="upcoming-tab">
<div class="grid columns-12 gap-5 mt-5">
  <!-- BEGIN: Driver Side Menu -->
  <div class="g-col-12 g-col-xl-12 g-col-xxl-12">
    <div class="box p-5 intro-y mt-5" style="background:#FBFBFB;box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
    <div class=" intro-y">
 <div class="overflow-x-auto p-5">
  <table class="table caption-top tb">
    <thead>
      <tr>
        <th scope="col">Request Id</th>
        <th scope="col">Date</th>
        <th scope="col">Pickup Location</th>
        <th scope="col">Trip Status</th>
        <th scope="col">View</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">Req_001</th>
        <td>05th Mar,3pm</td>
        <td>Coimbatore</td>
        <td>In progress</td>
        <td>
          <button class="btn btn-primary accordion-btn" type="button" data-bs-toggle="collapse" data-bs-target="#accordionExample1" aria-expanded="false" aria-controls="accordionExample1">
         <i class="fa fa-chevron-down"></i>
    </button>
        </td>
      </tr>
      <tr class="accordion-row">
        <td colspan="5">
          <div class="collapse" id="accordionExample1">
            <div class="">
              <div class="grid columns-12 gap-5 mt-5">
                    <!-- BEGIN: Driver Side Menu -->
                    <div class="g-col-12 g-col-xl-12 g-col-xxl-12">
                      <div class="box p-5 intro-y mt-5" style="background:#FBFBFB;box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                                <div class="intro-y d-flex align-items-center h-10 p-5">
                                    <a href="{{ url('/detailed-view') }}" class="ms-auto d-flex align-items-center"> <i data-feather="maximize-2" class="me-2"></i> Detailed View </a>
                                </div>
                            <div class=" intro-y">
                                <div class="pos intro-y grid columns-12 gap-5 mt-5">
                                    <!-- BEGIN: Left portion -->
                                    <div class="intro-y g-col-12 g-col-lg-5 ms-5">
                                        <div class="grid grid-cols-12 gap-5 mt-5">
                                            <div class="g-col-12 g-col-sm-6 g-col-xxl-3 box p-5 cursor-pointer zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
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
                                            </div>
                                            <div class="g-col-12 g-col-sm-12 g-col-xxl-3 box p-10 cursor-pointer zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                                                <div class="mt-5 d-flex align-items-center" style="font-size:clamp(12px, 2Vw, 18px);font-weight:800;"><i data-feather="disc" class="me-5" style="font-size:24px;font-weight:400;color:#59E304;"></i>Home,saravanampatti,Coimbatore-35</div>
                                                <div class="mt-5 d-flex align-items-center" style="font-size:clamp(12px, 2Vw, 18px);font-weight:800;"><i data-feather="map-pin" class="me-5" style="font-size:24px;font-weight:800;color:red;"></i>Drop,Gandhipuram,Coimbatore-05</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END: Left portion -->
                                    <!-- BEGIN: Right -->
  <div class="g-col-12 g-col-lg-7 box" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
    <section class="ps-timeline-sec">
        <div class="container">
            <ol class="ps-timeline">
                <li>
                    <div class="img-handler-top">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-bot">
                        <h1 style="font-size:20px;color:#7F00FF;">Trip Request</h1>
                    </div>
                    <span class="ps-sp-top"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-bot">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-top">
                      <h1 style="font-size:20px;color:#7F00FF;">Trip Accepted</h1>
                    </div>
                    <span class="ps-sp-bot"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-top">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-bot">
                      <h1 style="font-size:20px;color:#7F00FF;">Driver Arrived</h1>
                    </div>
                    <span class="ps-sp-top"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-bot">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-top">
                      <h1 style="font-size:20px;color:#7F00FF;">Trip Started</h1>
                    </div>
                    <span class="ps-sp-bot"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-top">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-bot">
                      <h1 style="font-size:20px;color:#7F00FF;">Trip Ended</h1>
                    </div>
                    <span class="ps-sp-top"><strong class="dot"></strong></span>
                </li>
            </ol>
        </div>
    </section>
  </div>
  <!-- END: Right -->
            </div>
        </div>
            </div>
          </div>
        </td>
      </tr>
      <tr>
        <th scope="row">Req_002</th>
        <td>05th Mar,3pm</td>
        <td>Coimbatore</td>
        <td>In progress</td>
        <td>
          <button class="btn btn-primary accordion-btn" type="button" data-bs-toggle="collapse" data-bs-target="#accordionExample2" aria-expanded="false" aria-controls="accordionExample2">
         <i class="fa fa-chevron-down"></i>
    </button>
        </td>
      </tr>
      <tr class="accordion-row">
        <td colspan="5">
          <div class="collapse" id="accordionExample2">
            <div class="">
            <div class="grid columns-12 gap-5 mt-5">
                    <!-- BEGIN: Driver Side Menu -->
                    <div class="g-col-12 g-col-xl-12 g-col-xxl-12">
                      <div class="box p-5 intro-y mt-5" style="background:#FBFBFB;box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                                <div class="intro-y d-flex align-items-center h-10 p-5">
                                    <a href="{{ url('/detailed-view') }}" class="ms-auto d-flex align-items-center"> <i data-feather="maximize-2" class="me-2"></i> Detailed View </a>
                                </div>
                            <div class=" intro-y">
                                <div class="pos intro-y grid columns-12 gap-5 mt-5">
                                    <!-- BEGIN: Left portion -->
                                    <div class="intro-y g-col-12 g-col-lg-5 ms-5">
                                        <div class="grid grid-cols-12 gap-5 mt-5">
                                            <div class="g-col-12 g-col-sm-6 g-col-xxl-3 box p-5 cursor-pointer zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
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
                                            </div>
                                            <div class="g-col-12 g-col-sm-12 g-col-xxl-3 box p-10 cursor-pointer zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                                                <div class="mt-5 d-flex align-items-center" style="font-size:clamp(12px, 2Vw, 18px);font-weight:800;"><i data-feather="disc" class="me-5" style="font-size:24px;font-weight:400;color:#59E304;"></i>Home,saravanampatti,Coimbatore-35</div>
                                                <div class="mt-5 d-flex align-items-center" style="font-size:clamp(12px, 2Vw, 18px);font-weight:800;"><i data-feather="map-pin" class="me-5" style="font-size:24px;font-weight:800;color:red;"></i>Drop,Gandhipuram,Coimbatore-05</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END: Left portion -->
                                    <!-- BEGIN: Right -->
  <div class="g-col-12 g-col-lg-7 box" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
    <section class="ps-timeline-sec">
        <div class="container">
            <ol class="ps-timeline">
                <li>
                    <div class="img-handler-top">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-bot">
                        <h1 style="font-size:20px;color:#7F00FF;">Trip Request</h1>
                    </div>
                    <span class="ps-sp-top"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-bot">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-top">
                      <h1 style="font-size:20px;color:#7F00FF;">Trip Accepted</h1>
                    </div>
                    <span class="ps-sp-bot"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-top">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-bot">
                      <h1 style="font-size:20px;color:#7F00FF;">Driver Arrived</h1>
                    </div>
                    <span class="ps-sp-top"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-bot">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-top">
                      <h1 style="font-size:20px;color:#7F00FF;">Trip Started</h1>
                    </div>
                    <span class="ps-sp-bot"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-top">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-bot">
                      <h1 style="font-size:20px;color:#7F00FF;">Trip Ended</h1>
                    </div>
                    <span class="ps-sp-top"><strong class="dot"></strong></span>
                </li>
            </ol>
        </div>
    </section>
  </div>
  <!-- END: Right -->
            </div>
        </div>
            </div>
          </div>
        </td>
      </tr>
      <tr>
        <th scope="row"><a href="">Req_003</a></th>
        <td>05th Mar,3pm</td>
        <td>Coimbatore</td>
        <td>In progress</td>
        <td>
          <button class="btn btn-primary accordion-btn" type="button" data-bs-toggle="collapse" data-bs-target="#accordionExample3" aria-expanded="false" aria-controls="accordionExample3">
         <i class="fa fa-chevron-down"></i>
    </button>
           
        </td>
      </tr>
      <tr class="accordion-row">
        <td colspan="5">
          <div class="collapse" id="accordionExample3">
            <div class="">
            <div class="grid columns-12 gap-5 mt-5">
                    <!-- BEGIN: Driver Side Menu -->
                    <div class="g-col-12 g-col-xl-12 g-col-xxl-12">
                      <div class="box p-5 intro-y mt-5" style="background:#FBFBFB;box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                                <div class="intro-y d-flex align-items-center h-10 p-5">
                                    <a href="{{ url('/detailed-view') }}" class="ms-auto d-flex align-items-center"> <i data-feather="maximize-2" class="me-2"></i> Detailed View </a>
                                </div>
                            <div class=" intro-y">
                                <div class="pos intro-y grid columns-12 gap-5 mt-5">
                                    <!-- BEGIN: Left portion -->
                                    <div class="intro-y g-col-12 g-col-lg-5 ms-5">
                                        <div class="grid grid-cols-12 gap-5 mt-5">
                                            <div class="g-col-12 g-col-sm-6 g-col-xxl-3 box p-5 cursor-pointer zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
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
                                            </div>
                                            <div class="g-col-12 g-col-sm-12 g-col-xxl-3 box p-10 cursor-pointer zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                                                <div class="mt-5 d-flex align-items-center" style="font-size:clamp(12px, 2Vw, 18px);font-weight:800;"><i data-feather="disc" class="me-5" style="font-size:24px;font-weight:400;color:#59E304;"></i>Home,saravanampatti,Coimbatore-35</div>
                                                <div class="mt-5 d-flex align-items-center" style="font-size:clamp(12px, 2Vw, 18px);font-weight:800;"><i data-feather="map-pin" class="me-5" style="font-size:24px;font-weight:800;color:red;"></i>Drop,Gandhipuram,Coimbatore-05</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END: Left portion -->
                                    <!-- BEGIN: Right -->
  <div class="g-col-12 g-col-lg-7 box" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
    <section class="ps-timeline-sec">
        <div class="container">
            <ol class="ps-timeline">
                <li>
                    <div class="img-handler-top">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-bot">
                        <h1 style="font-size:20px;color:#7F00FF;">Trip Request</h1>
                    </div>
                    <span class="ps-sp-top"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-bot">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-top">
                      <h1 style="font-size:20px;color:#7F00FF;">Trip Accepted</h1>
                    </div>
                    <span class="ps-sp-bot"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-top">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-bot">
                      <h1 style="font-size:20px;color:#7F00FF;">Driver Arrived</h1>
                    </div>
                    <span class="ps-sp-top"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-bot">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-top">
                      <h1 style="font-size:20px;color:#7F00FF;">Trip Started</h1>
                    </div>
                    <span class="ps-sp-bot"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-top">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-bot">
                      <h1 style="font-size:20px;color:#7F00FF;">Trip Ended</h1>
                    </div>
                    <span class="ps-sp-top"><strong class="dot"></strong></span>
                </li>
            </ol>
        </div>
    </section>
  </div>
  <!-- END: Right -->
            </div>
        </div>
            </div>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</div>
 </div>
  </div>
</div>
<!-- END: Home Side card Menu -->
</div>
</div>
<!-- end  -->
          </div>
      </div>
 
 
<!-- filter modal -->
<div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title tb" id="myModalLabel">Filter</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="tabs">
  <div class="tab-header">
    <div class="active">
      <i class="fa fa-map-marker"></i> Service Location
    </div>
    <div>
      <i class="fa fa-bar-chart"></i> Sort
    </div>
  </div>
  <div class="tab-indicator"></div>
  <div class="tab-content">
    
    <div class="active">
      <div class="tb"> <label>Sort By</label>
        <div class="form-check mt-2 tb"> <input id="radio-switch-1" class="form-check-input" type="radio" name="vertical_radio_button" value="vertical-radio-chris-evans"> <label class="form-check-label" for="radio-switch-1">Rating:High to Low</label> </div>
        <div class="form-check mt-2 tb"> <input id="radio-switch-2" class="form-check-input" type="radio" name="vertical_radio_button" value="vertical-radio-liam-neeson"> <label class="form-check-label" for="radio-switch-2">Ride:High to Low</label> </div>
        <div class="form-check mt-2 tb"> <input id="radio-switch-3" class="form-check-input" type="radio" name="vertical_radio_button" value="vertical-radio-daniel-craig"> <label class="form-check-label" for="radio-switch-3">High Cancellation-Driver</label> </div>
      </div>
    </div>
    
    <div>
      <div class="tb"> <label>Sort By</label>
        <div class="form-check mt-2 tb"> <input id="radio-switch-1" class="form-check-input" type="radio" name="vertical_radio_button" value="vertical-radio-chris-evans"> <label class="form-check-label" for="radio-switch-1">Rating:High to Low</label> </div>
        <div class="form-check mt-2 tb"> <input id="radio-switch-2" class="form-check-input" type="radio" name="vertical_radio_button" value="vertical-radio-liam-neeson"> <label class="form-check-label" for="radio-switch-2">Ride:High to Low</label> </div>
        <div class="form-check mt-2 tb"> <input id="radio-switch-3" class="form-check-input" type="radio" name="vertical_radio_button" value="vertical-radio-daniel-craig"> <label class="form-check-label" for="radio-switch-3">High Cancellation-Driver</label> </div>
      </div>
    </div>
    
  </div>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default tb" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary tb">Filter</button>
      </div>
    </div>
  </div>
</div>

@endsection
@push('scripts-js')
<script src="{{asset('assets/js/fetchdata.min.js')}}"></script>
<script>
  $(document).ready(function() {
      $('.accordion-btn').click(function() {
		$(this).find('.accordion-icon').toggleClass('rotate');
        var target = $($(this).data('accordion-target'));
        $('.collapse').removeClass('show'); // Remove 'show' class from all accordions
        $(target).collapse('toggle'); // Toggle 'show' class for the clicked accordion
      });
    });
</script>
<script>
  function _class(name){
  return document.getElementsByClassName(name);
}

let tabPanes = _class("tab-header")[0].getElementsByTagName("div");

for(let i=0;i<tabPanes.length;i++){
  tabPanes[i].addEventListener("click",function(){
    _class("tab-header")[0].getElementsByClassName("active")[0].classList.remove("active");
    tabPanes[i].classList.add("active");
    
    _class("tab-indicator")[0].style.top = `calc(80px + ${i*50}px)`;
    
    _class("tab-content")[0].getElementsByClassName("active")[0].classList.remove("active");
    _class("tab-content")[0].getElementsByTagName("div")[i].classList.add("active");
    
  });
}
</script>
@endpush
        <!-- END: Form Layout -->


