<style>
    .card {
     width: 500px; /* Adjust according to your design */
     background-color: #ffffff;
     border: 1px solid #fff;
     border-radius: 8px;
     padding: 10px;
     box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
 }
 .line{
    margin: 35px 0;
     border: 1px dashed #d1d1d1;
 }

 </style>

 @if(count($booking_data) > 0)
 <div id="loadingButton" style="display: none;">
     <button class="btn btn-primary btn-lg" type="button" disabled>
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        Loading...
     </button>
  </div>
 <div class="model-init" style="display: none;">
    <div class="model-wrapper">
       <div class="model-content1" style="display: none;">
          <div class="model-head">
             update additional Information
          </div>
          <div class="model-head name">
             Name
          </div>


          <div class="model-head name">
             Instruction
          </div>
          <div class="model-input1 data1" style="height: 65px;">
             <textarea id="model-promo-input-ins" style="height: 100%;width: 100%;border: none;outline: none;"></textarea>
          </div>
          <div class="promocode">
             <div class="promocode-cancel">
                Cancel
             </div>
             <div class="receiver-add">
                Add
             </div>
          </div>
       </div>
    </div>
 </div>
 <div id="head" class="head1">
    <div class="header-menu">
       <div class="right-arrow1 "><i class="fa fa-arrow-left booking-back"></i></div>
       <div class="drop_location" style="padding-bottom: 10px;">@lang('view_pages.booking_information')</div>
       <div class="booking_info">
          {{-- <div id="mapImageContainer">
             <img id="mapImage" style="width:100%" src="https://maps.googleapis.com/maps/api/staticmap?center={{ $request->lat }},{{ $request->lng }}&zoom=15&size=600x300&markers=icon:https://maps.google.com/mapfiles/ms/icons/blue-dot.png|{{ $request->lat }},{{ $request->lng }}&key=AIzaSyBgHOLmUHegDdvvQgwH7sqUtb8ZdD1NI4E">
          </div> --}}
          <div style="width: 500px;background-color: #ffffff;border: 1px solid #fff;border-radius: 8px;padding: 10px;box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
          <div class="pick_ups_location" style="padding-top:10px">
             <div class="left-text" style="color:red">@lang('view_pages.pickup')</div>
             <div class="pickup_loc_name pickup">{{$request->pickup_address}}</div>
          </div>
          <div class="line"></div>
          <div class="pick_ups_location">
             <div class="left-text" style="color:green">@lang('view_pages.drop')</div>
             <div class="pickup_loc_name drop">{{$request->drop_address}}</div>
          </div>
          </div>
          <div class="vehicle-details" style="margin-top:20px">
             <div class="price-details" style="padding: 10px 0px;">
                <div class="vehicle-type-text">
                   {{$booking_data[0]->name}}
                   <div class="price-vehicle-desc">{{$booking_data[0]->short_description}}</div>
                </div>
                <div class="price-data-value" style="top: 0px;right:5px"><img src="{{$booking_data[0]->vehicle_icon ?? ' '}}" id="vehicle-image"></div>
             </div>
          </div>
          @if(isset($request->booking_type))
          <div class="data">
             <div class="payment-mode">
                <div class="payment-text">@lang('view_pages.date')</div>
                <div class="price-data-value" >{{$request->date}} <i class="fa fa-pencil-square-o date-edit"  style="/* right: 25px; */top: 0px;color: blue;text-decoration: underline;cursor: pointer;padding-left: 10px;" aria-hidden="true"></i></div>
             </div>
          </div>
          @endif
          @if($transport_type == "delivery")
          <div class="data">
             <div class="payment-mode">
                <div class="payment-text">@lang('view_pages.receiver_information')</div>
                <div class="price-data-value receiver-dt" style="/* right: 25px; */top: 0px;color: blue;text-decoration: underline;cursor: pointer;"><i class="fa fa-pencil-square-o" style="/* right: 25px; */top: 0px;color: blue;text-decoration: underline;cursor: pointer;padding-left: 10px;" aria-hidden="true"></i></div>
             </div>
          </div>
          <div class="goods-details">
             <div class="goods_types">
                <div class="goods text">@lang('view_pages.goods_type')</div>
                <div class="from location text placeholder goods_type">
                   <select id="goods_type" class="depart-select ola-select">
                      <option value="select">@lang('view_pages.select_goods_type')</option>
                      @foreach($goods_type as $key=>$value)
                      <option value="{{$value->id}}" @if($key ==0) Selected @endif>{{$value->goods_type_name}}</option>
                      @endforeach
                      <template is="dom-repeat"></template>
                   </select>
                </div>
             </div>
             <div class="loose-goods" style=" margin-top:10px">
                <input type="radio" id="loose" name="goods_types" value="loose" class="radio-option" checked>
                &nbsp; <label for="loose">@lang('view_pages.loose')</label>
                &nbsp; <input type="radio" id="qty" name="goods_types" value="qty" class="radio-option">
                &nbsp; <label for="qty">@lang('view_pages.quantity')</label>
                <div class="model-input1 data1 qunatity-input" style="display:none">
                   <input type="text" id="model-promo-input-qty">
                </div>
             </div>
          </div>
          @endif
          <div class="confirm_your_location3 confirm_to_book text-center" onclick="confirm_booking()" style="margin-top:50px">
             <div class="confirm_button" style="width: 50%;">
              @lang('view_pages.request_quote')
             </div>
          </div>
       </div>
    </div>
 </div>

 <script>
 //    function confirm_booking(){


 // var form_data = new FormData($("#eta_calculaion")[0]);
 // var email = "{{ $email }}";
 // var response = {!! json_encode($response) !!};
 // console.log(response); // Display the entire response object in the browser console

 // var responseData = response.original.data[0];
 // var mm = JSON.stringify(responseData);
 // form_data.append("ridedetails", mm);


 // form_data.append("transport_type", "{{$transport_type}}");
 // form_data.append("vehicle_type", "{{$booking_data[0]->zone_type_id}}");
 // form_data.append("email", email);





 //               $.ajax({
 //                        url: 'send/sendmail',
 //                        type: 'POST',
 //                        data: form_data,
 //                        dataType: 'html',
 //                        processData: false,
 //                        contentType: false,
 //                        success: function(response) {

 // console.log("Sended");

 //                         },
 //                            error: function(xhr, status, error) {
 //                            // Handle errors
 //                            console.error('Error:', xhr.responseText);
 //                            }
 //                        });

 //    }

 function confirm_booking() {

    $('#loadingButton').show();

    var form_data = new FormData($("#eta_calculaion")[0]);
    var email = "{{ $email }}";
    var response = {!! json_encode($response) !!};

    var responseData = response.original.data[0];
    var mm = JSON.stringify(responseData);
    form_data.append("ridedetails", mm);

    form_data.append("transport_type", "{{$transport_type}}");
    form_data.append("vehicle_type", "{{$booking_data[0]->zone_type_id}}");
    form_data.append("email", email);

    $.ajax({
       url: 'send/sendmail',
       type: 'POST',
       data: form_data,
       dataType: 'html',
       processData: false,
       contentType: false,
       success: function(response) {
          console.log("Sent");

          $('#loadingButton').hide();

          alert('Success!');
       },
       error: function(xhr, status, error) {

          console.error('Error:', xhr.responseText);

          $('#loadingButton').hide();
       }
    });
 }

 </script>
 @endif
