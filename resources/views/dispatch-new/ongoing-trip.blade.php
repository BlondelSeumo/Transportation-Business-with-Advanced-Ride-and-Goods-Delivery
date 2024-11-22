@extends('dispatch-new.layout')
<style>
  ul {
    display: flex;
    flex-direction: column;
    align-items: start;
    padding: 1em;
    gap: 2em;
}
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
}
  </style>
@section('dispatch-content')
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> -->
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> -->
<link rel="stylesheet" href="{{ asset('assets/css/dispatcher/requestlist.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/dispatcher/ongoing.css') }}">
<link rel="stylesheet" href="{{asset('assets/vendor_components/sweetalert/sweetalert.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js">
<style>
.btn{
  font-size:12px;
}
.dropdown-item{
    background-color: white;
    font-size: 12px;
}
.soft-delete:hover{
  cursor: pointer;
}
span{
  height: auto;
  width: auto;
  margin: 0px;
}
</style>



<div class="g-col-12">
    <div class=" d-flex align-items-center h-10 mb-10">
        <h2 class=" me-5" style="font-size:25px;font-weight:800;color:#fca503;margin-top:20px;">
           <i class="fa fa-car" style="color:#fca503;"></i> Ongoing Trip
        </h2>
    </div>
</div>

<div class="g-col-12 g-col-lg-4 mt-10 p-10">
      <div class=" pe-1 d-flex align-items-center">
          <div class="box p-2 w-4/5" style="background:#ffffff;border: 1px solid rgb(215, 215, 215);box-shadow: 0px 0px 8px 1px rgba(127, 0, 255, 0.15); ">
              <ul class="pos__tabs nav nav-pills rounded-2" role="tablist">
                  <li id="all-tab" class="nav-item flex-1 flex-sm-0" onclick="toggleActiveTab('all-tab')" data-val="all" role="presentation">
                      <button class="nav-link w-full pt-2 pb-10 active"  data-bs-toggle="pill" >All</button>
                  </li>
                  <li id="assigned-tab" class="nav-item flex-1" onclick="toggleActiveTab('assigned-tab')" data-val="assigned">
                      <button class="nav-link w-full pt-2 pb-10" >Assigned</button>
                  </li>
                  <li id="unassigned-tab" class="nav-item flex-1" onclick="toggleActiveTab('unassigned-tab')" data-val="unassigned">
                      <button class="nav-link w-full pt-2 pb-10" >Un-assigned</button>
                  </li>
              </ul>
          </div>
          <!-- <div class="d-flex align-items-center ms-auto " style="font-size:22px;">
            <div class="form-check me-5"> <input id="auto" class="form-check-input" type="radio" name="assign_method" value="0" checked> <label class="form-check-label" for="auto">Automatic</label> </div>
            <div class="form-check ms-5 mt-2 mt-sm-0"> <input id="manual" class="form-check-input" type="radio" name="assign_method" value="1"> <label class="form-check-label" for="manual">Manual</label> </div>
          </div> -->
          <!-- <a href="" data-toggle="modal" data-target="#basicModal" class="btn ms-auto d-flex align-items-center text-theme-1 p-2" style="background:white;border-radius:10px;box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);"><i data-feather="sliders" style="rotate:90deg;"></i></a> -->
      </div>
<div class="tab-content mt-5">
 <!-- all drivers tab -->
 <div class="tab-pane fade active show" id="all" role="tabpanel" aria-labelledby="all-tab">
          <!-- <div class="grid columns-12 gap-5 mt-5"> -->
<div class="table-responsive  tb">
<table class="table caption-top tb">
    <thead>
      <tr>
        <th scope="col">@lang('view_pages.request_no')</th>
        <th scope="col">@lang('view_pages.date')</th>
        <th scope="col">@lang('view_pages.pick_address')</th>
        <th scope="col">@lang('view_pages.drop_address')</th>
        <th scope="col">@lang('view_pages.trip_status')</th>
        <th scope="col">@lang('view_pages.action')</th>
      </tr>
    </thead>
    <tbody id="append-rows">
    <tr class="no-data-found" id="row"><td colspan="6" style = " text-align: center; justify-content:center;">No Requests Yet</td></tr>
    </tbody>
</table>
</div>
</div>
</div>
<!-- offline drivers tab -->

</div>

          </div>
      </div>
<!-- filter modal -->
<!-- <div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
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
</div>  -->
<script>
  $(document).ready(
  function(){
    $("li.d-flex").removeClass("active");
    $('li.ongoing').addClass('active');
  }
)
  </script>
<script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-messaging.js"></script>
  <script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-database.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-analytics.js"></script>
<script>
    var firebaseConfig = {
        apiKey: "{{get_settings('firebase-api-key')}}",
    authDomain: "{{get_settings('firebase-auth-domain')}}",
    databaseURL: "{{get_settings('firebase-db-url')}}",
    projectId: "{{get_settings('firebase-project-id')}}",
    storageBucket: "{{get_settings('firebase-storage-bucket')}}",
    messagingSenderId: "{{get_settings('firebase-messaging-sender-id')}}",
    appId: "{{get_settings('firebase-app-id')}}",
    measurementId: "{{get_settings('firebase-measurement-id')}}"
  };

  firebase.initializeApp(firebaseConfig);
  var database = firebase.database();
  var requestRef = database.ref('requests');
  var requestMetaRef = database.ref('request-meta');
  var shouldProcessChildAdded = false;
   setTimeout(function() {
    shouldProcessChildAdded = true;
    shouldProcessSosChildAdded = true;
    }, 3000);
    var baseUrl = '{{ url("/") }}';
  requestRef.on("child_added", (snapshot) => {
    if(shouldProcessChildAdded){
      var type = $('.nav-item .active').closest('.nav-item').attr('data-val');
      var key = snapshot.key;
      var snapshot = snapshot.val();
      if(snapshot.cancelled_by_user)
      {
        $("tr#row_"+key).remove();
        var childRef = database.ref('requests/'+key);
        // Remove the child node
        childRef.remove()
        .then(function() {
          console.log("Child node removed successfully.");
        })
        .catch(function(error) {
          console.error("Error removing child node: ", error);
        });
        var ongoingRowCount = $("tr").length;
        if(ongoingRowCount < 2)
        {
          var html_data = ` <tr class="no-data-found" id="row"><td colspan="6" style = " text-align: center; justify-content:center;">No Requests Yet</td></tr>`;
          $("#append-rows").html(html_data);
        }
      }
      if(snapshot.request_id){
        URL = baseUrl+'/dispatch/detailed-view/'+snapshot.request_id;
        var html_data = ` <tr class="ongoing" id="row_${snapshot.request_id}">
        <td>${snapshot.request_number}</td>
        <td style="width:160px">${snapshot.date}</td>
        <td>${snapshot.pick_address}</td>
        <td>${snapshot.drop_address}</td>
        <td class="trip_status_${snapshot.request_id}"><button class="btn btn-warning"> Searching </button></td>
        <td>
        <div class="dropdown">
            <button type="button" class="btn btn-info btn-sm dropdown-toggle" id="drop_${snapshot.request_id}" data-toggle="dropdown" aria-expanded="false">@lang('view_pages.action')
            </button>
            <div class="dropdown-menu w-48" aria-labelledby="drop_${snapshot.request_id}">

              <a class="dropdown-item" href="${baseUrl+'/dispatch/detailed-view/'+snapshot.request_id}">
              <i class="fa fa-dot-circle-o"></i>@lang('view_pages.view')</a>

              <div class="dropdown-item soft-delete" data-url="${baseUrl+'/dispatch/cancel/'+snapshot.request_id}">
              <i class="fa fa-dot-circle-o"></i>@lang('view_pages.Cancel')</div>    
        </div>
        </div>
        </td>
          </tr>
        `;
        if(type !== 'assigned'){
          $("#append-rows").prepend(html_data);
          $("tr.no-data-found").remove();
        }
      }
    }
    });
    requestRef.on("child_changed", (snapshot) => {
      if(shouldProcessChildAdded){
        var snapshot = snapshot.val();
        if(snapshot.is_completed == true)
        {
          $("tr#row_"+snapshot.request_id).remove();
        }
        if(snapshot.cancelled_request == true)
        {
          $("tr#row_"+snapshot.request_id).remove();
        }
        if(snapshot.cancelled_by_user == true)
        {
          $("tr#row_"+snapshot.request_id).remove();
        }
        if(snapshot.is_accept == 0)
        {
          $("td.trip_status_"+snapshot.request_id).html('<button class="btn btn-warning"> Searching </button>');
        }
        if(snapshot.is_accept == 1)
        {
          $("td.trip_status_"+snapshot.request_id).html('<button class="btn btn-success"> Accepted </button>');
        }
        if(snapshot.cancelled_by_driver == true)
        {

          $("td.trip_status_"+snapshot.request_id).html('<button class="btn btn-danger"> Driver Cancelled the trip </button>');
          setTimeout(function() {
            $("td.trip_status_"+snapshot.request_id).html('<button class="btn btn-warning"> Searching </button>');
      }, 2000);
      firebase.database().ref('requests').child(snapshot.request_id).update({
            cancelled_by_driver: false,
            trip_arrived: 0,
            trip_start: 0
                                });
        }

        if(snapshot.trip_arrived == 1)
        {
          $("td.trip_status_"+snapshot.request_id).html('<button class="btn btn-success"> Trip arrived </button>');
        }
        if(snapshot.trip_start == 1)
        {
          $("td.trip_status_"+snapshot.request_id).html('<button class="btn btn-primary"> On the Ride </button>');
        }
      }
    });
    function sort_by_updated(snapshot){

        let requests = [];
        // Loop through each request
        snapshot.forEach(function(requestSnapshot) {
            let req_id = requestSnapshot.key;
            let requestDetails = requestSnapshot.val();
            // Get the latest updated_at timestamp from requestDetails
            let latestUpdatedAt = requestDetails.updated_at;

            // Push an object containing request ID and latest updated_at timestamp to the requests array
            if (latestUpdatedAt) {
                let requestObject = {};
                requestObject[req_id] = latestUpdatedAt;
                requests.push(requestObject);
            }

        });
        var desc_requests = {};
        // Sort requests by updated_at in descending order
        requests.sort((a, b) => b.updated_at - a.updated_at);
        requests.reverse();
        requests.forEach(function(descending_request){
          var req_id = Object.keys(descending_request)[0];
          let requestSnapshot = snapshot.child(req_id);
          if(requestSnapshot.exists()){
            desc_requests[req_id] = requestSnapshot.val();
          }
        })
        return desc_requests;
    }
  function getrequestdata(tabValue){
    requestRef.once('value').then(function(snapshot){
      var val = sort_by_updated(snapshot);
      var requests = [[], [],[]];
      // var assign_method = $('input[name="assign_method"]:checked').val(); // 0 if auto and 1 if manual
      // if(!assign_method){
      for(var key in val){
        var req = val[key];
        var completed =0;
        var cancelled =0;
        var cancel_by_user = 0;
        if(req.hasOwnProperty('cancelled_by_user') && req.cancelled_by_user == true){
          cancel_by_user = 1;
        }
        if(req.hasOwnProperty('is_completed') && req.is_completed == true){
          completed = 1;
        }
        if((req.hasOwnProperty('is_cancelled') && req.is_cancelled == true) || (req.hasOwnProperty('is_cancel') && req.is_cancel == true) || (req.hasOwnProperty('cancelled_request') && req.cancelled_request == true)){
          cancelled = 1;
        }
        if( !cancel_by_user && !cancelled && !completed  && req.hasOwnProperty('request_number')){
          if( req.hasOwnProperty('driver_id') ){
            requests[1].push(req);
          }
          if( !req.hasOwnProperty('driver_id') ){
            requests[2].push(req);
          }
          requests[0].push(req);
        }
      }
      // }else{
      // for(var key in val){
      //   var req = val[key];
      //   var completed =0;
      //   var cancelled =0;
      //   if(req.hasOwnProperty('is_completed') && req.is_completed == true){
      //     completed = 1;
      //   }
      //   // if(req.hasOwnProperty('is_cancelled') && req.is_cancelled == true){
      //   //   cancelled = 1;
      //   // }
      //   if( !req.hasOwnProperty('cancelled_by_user') && req.hasOwnProperty('assign_method') && !completed  && req.hasOwnProperty('request_number')){
      //     if( req.hasOwnProperty('driver_id') ){
      //       requests[1].push(req);
      //     }
      //     if( !req.hasOwnProperty('driver_id') ){
      //       requests[2].push(req);
      //     }
      //     requests[0].push(req);
      //   }
      // }
      // }
      var html_data = ``;
      var i = 0 ;
      switch (tabValue) {
        case 'assigned':
          i=1;
          break;
        case 'unassigned':
          i = 2;
          break;

      }
      requests[i].forEach(function (request) {
        var drop = "----";
        if(request.hasOwnProperty('drop_address')){
          drop = request.drop_address;
        }
        var status='';
        if(request.is_accept == 1){
          status ='<button class="btn btn-success"> Accepted </button>';
        } else {
          status ='<button class="btn btn-warning"> Searching </button>';
        }
        if(request.trip_arrived == 1)
        {
          status ='<button class="btn btn-success"> Trip arrived </button>';
        }
        if(request.trip_start == 1)
        {
          status ='<button class="btn btn-primary"> On the Ride </button>';
        }
        html_data += `
        <tr class="ongoing" id="row_${request.request_id}">
          <td>${request.request_number}</td>
          <td style="width:160px">${request.date}</td>
          <td>${request.pick_address}</td>
          <td>${drop}</td>
          <td id="trip_status_${request.request_id}">`+status+`</td>
          <td>
            <div class="dropdown">
            <button type="button" class="btn btn-info btn-sm dropdown-toggle" id="drop_${request.request_id}" data-toggle="dropdown" aria-expanded="false">@lang('view_pages.action')
            </button>
            <div class="dropdown-menu w-48" aria-labelledby="drop_${request.request_id}">
              <a class="dropdown-item" href="${baseUrl+'/dispatch/detailed-view/'+request.request_id}">
              <i class="fa fa-dot-circle-o"></i>@lang('view_pages.view')</a>

              <div class="dropdown-item soft-delete" data-url="${baseUrl+'/dispatch/cancel/'+request.request_id}">
              <i class="fa fa-dot-circle-o"></i>@lang('view_pages.Cancel')</div>
            </div>
            </div>
          </td>
        </tr>`;
      });
      if(requests[i].length !== 0){
        $("tr.no-data-found").remove();

      }else{
        html_data = ` <tr class="no-data-found" id="row"><td colspan="6" style = " text-align: center; justify-content:center;">No Requests Yet</td></tr>`;
      }
      $("#append-rows").html(html_data);
    });
  }
  function toggleActiveTab(tabId) {
  // Remove "active" class from all tabs
  var tabs = document.querySelectorAll('.nav-link');
  tabs.forEach(function(tab) {
      tab.classList.remove('active');
  });

  // Add "active" class to the clicked tab
  var clickedTab = document.getElementById(tabId);
  clickedTab.querySelector('.nav-link').classList.add('active');

  // Call the fetchDataFromFirebase function with the respective parameter
  var tabValue = clickedTab.getAttribute('data-val');

  getrequestdata(tabValue);
}
getrequestdata('all');


            $(document).on('click', '.soft-delete', function(e) {
                e.preventDefault();

                let url = $(this).attr('data-url');

                swal({
                    title: "Cancel the ride ?",
                    type: "error",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Cancel",
                    cancelButtonText: "Close",
                    closeOnConfirm: false,
                    closeOnCancel: true
                }, function(isConfirm) {
                    if (isConfirm) {
                        swal.close();

                        $.ajax({
                            url: url,
                            cache: false,
                            success: function(res) {
                              window.location.reload();
                                $.toast({
                                    heading: '',
                                    text: res,
                                    position: 'top-right',
                                    loaderBg: '#ff6849',
                                    icon: 'success',
                                    hideAfter: 5000,
                                    stack: 1
                                });
                            }
                        });
                    }
                });
            });


</script>
@endsection
@push('scripts-js')

@endpush
        <!-- END: Form Layout -->


