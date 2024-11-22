@extends('dispatch-new.layout')

@section('dispatch-content')
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ asset('assets/css/dispatcher/requestlist.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/dispatcher/ongoing.css') }}">
<style>

</style>



<div class="g-col-12 mt-8 p-10">
    <div class=" d-flex align-items-center h-10 mb-10">
        <h2 class=" me-5 animate__animated animate__backInRight" style="font-size:25px;font-weight:800;color:#7F00FF;">
           <i class="fa fa-car" style="color:black;"></i> Ongoing Trip
        </h2>
    </div>
    <div class="grid columns-12 gap-6 mt-5">
        <div class="g-col-12 g-col-sm-6 g-col-xl-1 "></div>
        <div class="g-col-12 g-col-sm-6 g-col-xl-2 ">
            <div class="zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(127, 0, 255, 0.15);border-radius:15px;">
                <div class="box p-5" style="border-radius:15px;">
                    <div class="text-center mt-6" style="font-size:25px;font-weight:800;">UNASSIGNED</div>
                    <div class="text-end mt-1 p-5" style="font-size:25px;font-weight:800;color:#7F00FF;">10</div>
                </div>
            </div>
        </div>
        <div class="g-col-12 g-col-sm-6 g-col-xl-2 ">
            <div class="zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(127, 0, 255, 0.15);border-radius:15px;">
                <div class="box p-5" style="border-radius:15px;">
                    <div class="text-center mt-6" style="font-size:25px;font-weight:800;">AWAITING</div>
                    <div class="text-end mt-1 p-5" style="font-size:25px;font-weight:800;color:#7F00FF;">4</div>
                </div>
            </div>
        </div>
        <div class="g-col-12 g-col-sm-6 g-col-xl-2 ">
            <div class="zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(127, 0, 255, 0.15);border-radius:15px;">
                <div class="box p-5" style="border-radius:15px;">
                    <div class="text-center mt-6" style="font-size:25px;font-weight:800;">ACCEPTED</div>
                    <div class="text-end mt-1 p-5" style="font-size:25px;font-weight:800;color:#7F00FF;">4</div>
                </div>
            </div>
        </div>
        <div class="g-col-12 g-col-sm-6 g-col-xl-2 ">
            <div class="zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(127, 0, 255, 0.15);border-radius:15px;">
                <div class="box p-5" style="border-radius:15px;">
                    <div class="text-center mt-6" style="font-size:25px;font-weight:800;">ARRIVED</div>
                    <div class="text-end mt-1 p-5" style="font-size:25px;font-weight:800;color:#7F00FF;">4</div>
                </div>
            </div>
        </div>
        <div class="g-col-12 g-col-sm-6 g-col-xl-2 ">
            <div class="zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(127, 0, 255, 0.15);border-radius:15px;">
                <div class="box p-5" style="border-radius:15px;">
                    <div class="text-center mt-6" style="font-size:25px;font-weight:800;">TRIP STARTED</div>
                    <div class="text-end mt-1 p-5" style="font-size:25px;font-weight:800;color:#7F00FF;">4</div>
                </div>
            </div>
        </div>
        <div class="g-col-12 g-col-sm-6 g-col-xl-1 "></div>
    </div>
</div>

<div class="g-col-12 g-col-lg-4 mt-10 p-10">
      <div class=" pe-1 d-flex align-items-center">
          <div class="box p-2 w-4/5" style="background:#EAF0FB;">
              <ul class="pos__tabs nav nav-pills rounded-2" role="tablist">
                  <li id="all-tab" class="nav-item flex-1 flex-sm-0" role="presentation">
                      <button class="nav-link w-full pt-2 pb-2.5 active" data-bs-toggle="pill" data-bs-target="#all" type="button" role="tab" aria-controls="all-tab" aria-selected="true">All</button>
                  </li>
                  <li id="assigned-tab" class="nav-item flex-1" role="presentation">
                      <button class="nav-link w-full pt-2 pb-2.5" data-bs-toggle="pill" data-bs-target="#assigned" type="button" role="tab" aria-controls="assigned-tab" aria-selected="false">Assigned</button>
                  </li>
                  <li id="unassigned-tab" class="nav-item flex-1" role="presentation">
                      <button class="nav-link w-full pt-2 pb-2.5" data-bs-toggle="pill" data-bs-target="#unassigned" type="button" role="tab" aria-controls="unassigned-tab" aria-selected="false">Un-assigned</button>
                  </li>
              </ul>
          </div>
          <a href="" data-toggle="modal" data-target="#basicModal" class="btn ms-auto d-flex align-items-center text-theme-1 p-2" style="background:white;border-radius:10px;box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);"><i data-feather="sliders" style="rotate:90deg;"></i></a>
      </div>
<div class="tab-content mt-5">
 <!-- all drivers tab -->
          <div class="tab-pane fade active show" id="all" role="tabpanel" aria-labelledby="all-tab">
          <div class="grid columns-12 gap-5 mt-5">
                    <!-- BEGIN: Driver Side Menu -->
                    <div class="g-col-12 g-col-xl-12 g-col-xxl-12">
                      <div class="box p-5  mt-5" style="background:#FBFBFB;box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                            <div class="d-flex flex-column flex-lg-row pb-5">
                                <div class="d-flex px-5 align-items-start justify-content-center justify-content-lg-start">
                                    <div class="d-flex ms-5">
                                        <div class="px-4" style="font-size:25px;font-weight:800;border-right:3px solid #7F00FF;">Req_00933</div>
                                    </div>
                                </div>
                                <div class="mt-6 mt-lg-0 flex-1 px-5 border-start border-end border-gray-200 border-top border-top-lg-0 pt-5 pt-lg-0">
                                    <div class="fw-medium text-center text-lg-start " style="font-size:25px;font-weight:800;color:#7F00FF;"> <i class="fas fa-business-time me-2" style="color:#8BB7F0;"></i>27 FEB ,03.30 PM</div>
                                </div>
                            </div>
                            <div class="">
                                <div class="pos  grid columns-12 gap-5 mt-5">
                                    <!-- BEGIN: Left portion -->
                                    <div class=" g-col-12 g-col-lg-5 ms-5">
                                        <div class="grid grid-cols-12 gap-5 mt-5">
                                            <div class="g-col-12 g-col-sm-6 g-col-xxl-6 box p-5 cursor-pointer zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                                                <div class="text-theme-10" style="font-size:20px;font-weight:800;">Driver Details</div>
                                                <div class="text-gray-600" style="font-size:20px;font-weight:800;">Sudarsan</div>
                                                <div class="mt-6 mt-lg-0 pt-5">
                                                    <div class="fw-medium text-center text-lg-start " style="font-size:25px;font-weight:800;">4 <i class="fa fa-star" style="color:yellow;"></i></div>
                                                </div>
                                            </div>
                                            <div class="g-col-12 g-col-sm-6 g-col-xxl-6 box p-5 cursor-pointer zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                                                <div class="text-theme-10" style="font-size:20px;font-weight:800;">Customer Details</div>
                                                <div class="text-gray-600" style="font-size:20px;font-weight:800;">Sudarsan</div>
                                                <div class="mt-6 mt-lg-0 pt-5">
                                                    <div class="fw-medium text-center text-lg-start " style="font-size:25px;font-weight:800;">4 <i class="fa fa-star" style="color:yellow;"></i></div>
                                                </div>
                                            </div>
                                            <div class="g-col-12 g-col-sm-12 g-col-xxl-12 box p-10 cursor-pointer zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                                                <div class="mt-5 d-flex align-items-center" style="font-size:clamp(12px, 2Vw, 24px);font-weight:800;"><i data-feather="disc" class="me-5" style="font-size:24px;font-weight:400;color:#59E304;"></i>Home,saravanampatti,Coimbatore-35</div>
                                                <div class="mt-5 d-flex align-items-center" style="font-size:clamp(12px, 2Vw, 24px);font-weight:800;"><i data-feather="map-pin" class="me-5" style="font-size:24px;font-weight:800;color:red;"></i>Drop,Gandhipuram,Coimbatore-05</div>
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
<!-- END: Home Side card Menu -->
</div>
</div>

 <!-- online drivers tab -->
          <div class="tab-pane fade" id="assigned" role="tabpanel" aria-labelledby="assigned-tab">
          <div class="grid columns-12 gap-5 mt-5">
                    <!-- BEGIN: Driver Side Menu -->
                    <div class="g-col-12 g-col-xl-12 g-col-xxl-12">
                      <div class="box p-5  mt-5" style="background:#FBFBFB;box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                            <div class="d-flex flex-column flex-lg-row pb-5">
                                <div class="d-flex px-5 align-items-start justify-content-center justify-content-lg-start">
                                    <div class="d-flex ms-5">
                                        <div class="px-4" style="font-size:25px;font-weight:800;border-right:3px solid #7F00FF;">Req_00935</div>
                                    </div>
                                </div>
                                <div class="mt-6 mt-lg-0 flex-1 px-5 border-start border-end border-gray-200 border-top border-top-lg-0 pt-5 pt-lg-0">
                                    <div class="fw-medium text-center text-lg-start " style="font-size:25px;font-weight:800;color:#7F00FF;"> <i class="fas fa-business-time me-2" style="color:#8BB7F0;"></i>27 FEB ,03.30 PM</div>
                                </div>
                            </div>
                            <div class=" ">
                                <div class="pos  grid columns-12 gap-5 mt-5">
                                    <!-- BEGIN: Left portion -->
                                    <div class=" g-col-12 g-col-lg-5 ms-5">
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
                                                <div class="mt-5 d-flex align-items-center" style="font-size:clamp(12px, 2Vw, 24px);font-weight:800;"><i data-feather="disc" class="me-5" style="font-size:24px;font-weight:400;color:#59E304;"></i>Home,saravanampatti,Coimbatore-35</div>
                                                <div class="mt-5 d-flex align-items-center" style="font-size:clamp(12px, 2Vw, 24px);font-weight:800;"><i data-feather="map-pin" class="me-5" style="font-size:24px;font-weight:800;color:red;"></i>Drop,Gandhipuram,Coimbatore-05</div>
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
<!-- END: Home Side card Menu -->
</div>
</div>

<!-- offline drivers tab -->
          <div class="tab-pane fade" id="unassigned" role="tabpanel" aria-labelledby="unassigned-tab">
          <div class="grid columns-12 gap-5 mt-5">
                    <!-- BEGIN: Driver Side Menu -->
                    <div class="g-col-12 g-col-xl-12 g-col-xxl-12">
                      <div class="box p-5  mt-5" style="background:#FBFBFB;box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                            <div class="d-flex flex-column flex-lg-row pb-5">
                                <div class="d-flex px-5 align-items-start justify-content-center justify-content-lg-start">
                                    <div class="d-flex ms-5">
                                        <div class="px-4" style="font-size:25px;font-weight:800;border-right:3px solid #7F00FF;">Req_00938</div>
                                    </div>
                                </div>
                                <div class="mt-6 mt-lg-0 flex-1 px-5 border-start border-end border-gray-200 border-top border-top-lg-0 pt-5 pt-lg-0">
                                    <div class="fw-medium text-center text-lg-start " style="font-size:25px;font-weight:800;color:#7F00FF;"> <i class="fas fa-business-time me-2" style="color:#8BB7F0;"></i>27 FEB ,03.30 PM</div>
                                </div>
                            </div>
                            <div class=" ">
                                <div class="pos  grid columns-12 gap-5 mt-5">
                                    <!-- BEGIN: Left portion -->
                                    <div class=" g-col-12 g-col-lg-5 ms-5">
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
                                                <div class="mt-5 d-flex align-items-center" style="font-size:clamp(12px, 2Vw, 24px);font-weight:800;"><i data-feather="disc" class="me-5" style="font-size:24px;font-weight:400;color:#59E304;"></i>Home,saravanampatti,Coimbatore-35</div>
                                                <div class="mt-5 d-flex align-items-center" style="font-size:clamp(12px, 2Vw, 24px);font-weight:800;"><i data-feather="map-pin" class="me-5" style="font-size:24px;font-weight:800;color:red;"></i>Drop,Gandhipuram,Coimbatore-05</div>
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
<!-- END: Home Side card Menu -->
</div>
</div>

<!-- On-ride drivers tab -->
          <div class="tab-pane fade" id="upcoming" role="tabpanel" aria-labelledby="upcoming-tab">
          <div class="grid columns-12 gap-5 mt-5">
                    <!-- BEGIN: Driver Side Menu -->
                    <div class="g-col-12 g-col-xl-12 g-col-xxl-12">
                      <div class="box p-5  mt-5" style="background:#FBFBFB;box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                            <div class="d-flex flex-column flex-lg-row pb-5">
                                <div class="d-flex px-5 align-items-start justify-content-center justify-content-lg-start">
                                    <div class="d-flex ms-5">
                                        <div class="px-4" style="font-size:25px;font-weight:800;border-right:3px solid #7F00FF;">Req_00945</div>
                                    </div>
                                </div>
                                <div class="mt-6 mt-lg-0 flex-1 px-5 border-start border-end border-gray-200 border-top border-top-lg-0 pt-5 pt-lg-0">
                                    <div class="fw-medium text-center text-lg-start " style="font-size:25px;font-weight:800;color:#7F00FF;"> <i class="fas fa-business-time me-2" style="color:#8BB7F0;"></i>27 FEB ,03.30 PM</div>
                                </div>
                            </div>
                            <div class=" ">
                                <div class="pos  grid columns-12 gap-5 mt-5">
                                    <!-- BEGIN: Left portion -->
                                    <div class=" g-col-12 g-col-lg-5 ms-5">
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
                                                <div class="mt-5 d-flex align-items-center" style="font-size:clamp(12px, 2Vw, 24px);font-weight:800;"><i data-feather="disc" class="me-5" style="font-size:24px;font-weight:400;color:#59E304;"></i>Home,saravanampatti,Coimbatore-35</div>
                                                <div class="mt-5 d-flex align-items-center" style="font-size:clamp(12px, 2Vw, 24px);font-weight:800;"><i data-feather="map-pin" class="me-5" style="font-size:24px;font-weight:800;color:red;"></i>Drop,Gandhipuram,Coimbatore-05</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END: Left portion -->
                                    <!-- BEGIN: Right -->
  <div class="g-col-12 g-col-lg-7 box" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
    <section class="ps-timeline-sec">
        <div class="container">
            <ol class="ps-">
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

    <!-- <section class="ps-timeline-sec">
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
    </section> -->
@endsection
@push('scripts-js')

@endpush
        <!-- END: Form Layout -->


