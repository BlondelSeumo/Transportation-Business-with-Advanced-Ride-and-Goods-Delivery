@extends('dispatch-new.layout')

@section('dispatch-content')
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> -->
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> -->
<link rel="stylesheet" href="{{ asset('assets/css/dispatcher/requestlist.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js">
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
.pagination .page-item .page-link {
    border-radius: 0.375rem;
    box-shadow: none;
    font-weight: 400;
    margin-right: 0.5rem;
    min-width: 40px;
    text-align: center;
    font-size: 18px;
    margin-top: 20px;
}
.zoom-in .box{
  /* background-color:#453e30; */
}
.bx{
    border: 1px solid rgb(215, 215, 215);
    box-shadow: 0px 0px 8px 1px rgba(127, 0, 255, 0.15);
}
.dropdown-item{
    background-color: white;
    font-size: 12px;
}
</style>



<div class="g-col-12">
    <div class="intro-y d-flex align-items-center h-10 mb-10">
        <h2 class="me-5" style="font-size:25px;font-weight:800;color:#fca503;">
           <i class="far fa-question-circle" style="color:black;"></i> Request List
        </h2>
    </div>
    <div class="grid columns-12 gap-6 mt-5">
        <div class="g-col-12 g-col-sm-6 g-col-xl-3">
            <div class="zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(127, 0, 255, 0.15);border-radius:15px;">
                <div class="box p-5" style="border-radius:15px;">
                    <div class="text-center mt-6" style="font-size:25px;font-weight:800;">COMPLETED</div>
                    <div class="text-end mt-1 p-5" style="font-size:25px;font-weight:800;color:green;">{{$is_completed_count}}</div>
                </div>
            </div>
        </div>
        <div class="g-col-12 g-col-sm-6 g-col-xl-3">
            <div class="zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(127, 0, 255, 0.15);border-radius:15px;">
                <div class="box p-5" style="border-radius:15px;">
                    <div class="text-center mt-6" style="font-size:25px;font-weight:800;">USER CANCELLED</div>
                    <div class="text-end text-theme-6 mt-1 p-5" style="font-size:25px;font-weight:800;color:#fca503;">{{$user_cancelled_count}}</div>
                </div>
            </div>
        </div>
        <div class="g-col-12 g-col-sm-6 g-col-xl-3">
            <div class="zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(127, 0, 255, 0.15);border-radius:15px;">
                <div class="box p-5" style="border-radius:15px;">
                    <div class="text-center mt-6" style="font-size:25px;font-weight:800;">DRIVER CANCELLED</div>
                    <div class="text-end text-theme-6 mt-1 p-5" style="font-size:25px;font-weight:800;color:#fca503;">{{$driver_cancelled_count}}</div>
                </div>
            </div>
        </div>
        <div class="g-col-12 g-col-sm-6 g-col-xl-3">
            <div class="zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(127, 0, 255, 0.15);border-radius:15px;">
                <div class="box p-5" style="border-radius:15px;">
                    <div class="text-center mt-6" style="font-size:25px;font-weight:800;">UPCOMING</div>
                    <div class="text-end mt-1 p-5" style="font-size:25px;font-weight:800;color:#fca503;">{{$upcoming_count}}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="g-col-12 g-col-lg-4 mt-10 p-10">
      <div class=" pe-1  d-flex align-items-center">
          <div class="box p-2 w-4/5 bx" style="color:#fca503;">
              <ul class="pos__tabs nav nav-pills rounded-2" role="tablist">
                  <li id="all-tab" class="nav-item flex-1" role="presentation">
                      <button class="nav-link w-full pt-2 pb-10 active" onclick="get_request_list('all')" data-bs-toggle="pill" data-bs-target="all" type="button" role="tab" aria-controls="all-tab" aria-selected="{{$type=='all' ? 'true' : 'false'}}">All</button>
                  </li>
                  <li id="completed-tab" class="nav-item flex-1" role="presentation">
                      <button class="nav-link w-full pt-2 pb-10" onclick="get_request_list('completed')" data-bs-toggle="pill" data-bs-target="completed" type="button" role="tab" aria-controls="completed-tab" aria-selected="{{$type=='completed' ? 'true' : 'false'}}">Completed</button>
                  </li>
                  <li id="cancelled-tab" class="nav-item flex-1" role="presentation">
                      <button class="nav-link w-full pt-2 pb-10" onclick="get_request_list('cancelled')" data-bs-toggle="pill" data-bs-target="cancelled" type="button" role="tab" aria-controls="cancelled-tab" aria-selected="{{$type=='cancelled' ? 'true' : 'false'}}">Cancelled</button>
                  </li>
                  <li id="upcoming-tab" class="nav-item flex-1" role="presentation">
                      <button class="nav-link w-full pt-2 pb-10" onclick="get_request_list('upcoming')" data-bs-toggle="pill" data-bs-target="upcoming" type="button" role="tab" aria-controls="upcoming-tab" aria-selected="{{$type=='upcoming' ? 'true' : 'false'}}">Upcoming</button>
                  </li>
              </ul>
          </div>
          <!-- <a href="" data-toggle="modal" data-target="#basicModal" class="btn ms-auto d-flex align-items-center text-theme-1 p-2" style="background:white;border-radius:10px;box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);"><i data-feather="sliders" style="rotate:90deg;"></i></a> -->


      </div><input type="hidden" id="page_count" value="">
      <div id="request_list">
      </div>
</div>

<script>

function get_request_list(type,page=1){
    console.log(type,page);
    var url = '{{url("/")}}/dispatch/request_fetch?type='+type;
    if (page > 1) {
      url += '&page=' + page;
    }
    $.get(url, function(data) {
        $('#request_list').html(data);
    });
    }
  $(document).ready(function(){
    $("li.d-flex").removeClass("active");
    $('li.request').addClass('active');
  });
  $('body').on('click', '.pagination a', function(e){
    e.preventDefault();
    var type = $('.nav-link.active').attr('data-bs-target');
    var href = $(this).attr('href');
    var page = href.split('page=')[1];
    get_request_list(type,page);
  })
  get_request_list('all');
</script>
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
<!-- <script>
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
</script> -->
<script>
  document.getElementById("vehicleSelect").addEventListener("change", function() {
  // Check if any option is selected
  var selectedOptions = this.selectedOptions;

  if (selectedOptions.length > 0) {
    // Check the checkbox if at least one option is selected
    document.getElementById("vehicleCheckbox").checked = true;
  } else {
    // Uncheck the checkbox if no option is selected
    document.getElementById("vehicleCheckbox").checked = false;
  }
});

</script>
@endpush
        <!-- END: Form Layout -->


