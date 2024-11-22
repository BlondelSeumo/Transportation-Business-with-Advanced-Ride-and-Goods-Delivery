@extends('admin.layouts.app')

@section('title', 'Main page')

@section('content')
<style type="text/css">
.dropdown-container {
    position: relative;
    display: inline-block;
}

.info-icon {
    cursor: pointer;
    font-size: 12px;
}

.dropdown-menu {
    display: none;
    position: absolute;
    background-color: white;
    border: 1px solid #ccc;
    width: 300px;
    box-shadow: 0 8px 16px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-menu a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}
</style>
<!-- Start Page content -->
<div class="content">
<div class="container-fluid">
    {{-- @if($errors)
    @foreach ($errors->all() as $error)
       <div>{{ $error }}</div>
   @endforeach
 @endif --}}
<div class="row">
<div class="col-sm-12">
    <div class="box">
        <div class="box-header with-border">
<a href="{{ url()->previous() }}" class="btn btn-danger btn-sm pull-right">
<i class="mdi mdi-keyboard-backspace mr-2"></i>@lang('view_pages.back')</a>

</div>

        <div class="col-sm-12">
        <form  method="post" class="form-horizontal" action="{{url('vehicle_fare/store')}}" enctype="multipart/form-data">
{{csrf_field()}}

<div class="row">
<div class="col-6">
<div class="form-group">
<label for="admin_id">@lang('view_pages.select_zone')
    <span class="text-danger">*</span>
</label>
<select name="zone" id="zone" class="form-control" required>
    <option value="" selected disabled>@lang('view_pages.select_zone')</option>
    @foreach($zones as $key=>$zone)
    <option value="{{$zone->id}}" {{ old('zone') == $zone->id ? 'selected' : '' }}>{{$zone->name}}</option>
    @endforeach
</select>
</div>
</div>
<div class="col-sm-6">
           <div class="form-group">
               <label for="">@lang('view_pages.transport_type') <span class="text-danger">*</span></label>
               <select name="transport_type" id="transport_type" class="form-control" required>
               </select>
               <span class="text-danger">{{ $errors->first('transport_type') }}</span>
           </div>
       </div>
   <div class="col-sm-6">
        <div class="form-group">
            <label for="type">@lang('view_pages.select_type')
                <span class="text-danger">*</span>
            </label>
            <select name="type" id="type" class="form-control" required>
                <option value="" >@lang('view_pages.select_type')</option>
            </select>
        </div>
    </div>
<div class="col-sm-6">
<div class="form-group" style="padding-right: 30px;">
<label for="payment_type">@lang('view_pages.payment_type')
    <span class="text-danger">*</span>
</label>
@php
    $card = '';
    $cash = '';
    $wallet = '';
@endphp
@if (old('payment_type'))
    @foreach (old('payment_type') as $item)
        @if ($item == 'card')
            @php
                $card = 'selected';
            @endphp
        @elseif($item == 'cash')
            @php
                $cash = 'selected';
            @endphp
        @elseif($item == 'wallet')
            @php
                $wallet = 'selected';
            @endphp
        @endif
    @endforeach
@endif
<select  name="payment_type[]" id="payment_type" class="form-control select2" multiple="multiple" data-placeholder="@lang('view_pages.select') @lang('view_pages.payment_type')" required>
    <option value="cash" {{ $cash }}>@lang('view_pages.cash')</option>
    <option value="wallet" {{ $wallet }}>@lang('view_pages.wallet')</option>
    <option value="card" {{ $card }}>@lang('view_pages.card')</option>

</select>
</div>
</div>

</div>
<div class="row">
    <div class="col-sm-6" >
      <div class="form-group">
            <label for="admin_commision_type">@lang('view_pages.admin_commision_type')<span class="text-danger">*</span></label>
            <select name="admin_commision_type" id="admin_commision_type" class="form-control" required>
                    <option value="" >@lang('view_pages.select_type')</option>
                    <option value="2" {{ '2' }}>@lang('view_pages.fixed')</option>
                    <option value="1" {{ '1' }}>@lang('view_pages.percentage')</option>
                </select>
            <span class="text-danger">{{ $errors->first('admin_commision_type') }}</span>
        </div>
    </div>
    <div class="col-sm-6" >
      <div class="form-group">
            <label for="admin_commision">@lang('view_pages.admin_commision')<span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="admin_commision" name="admin_commision" value="{{old('admin_commision')}}" required="" placeholder="@lang('view_pages.enter') @lang('view_pages.admin_commision')">
            <span class="text-danger">{{ $errors->first('admin_commision') }}</span>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-sm-6" >
      <div class="form-group">
            <label for="admin_commission_type_from_owner">@lang('view_pages.admin_commission_type_for_owner')<span class="text-danger">*</span></label>
            <select name="admin_commission_type_from_owner" id="admin_commission_type_from_owner" class="form-control" required>
                    <option value="" >@lang('view_pages.select_type')</option>
                    <option value="0" >@lang('view_pages.fixed')</option>
                    <option value="1" >@lang('view_pages.percentage')</option>
                </select>
            <span class="text-danger">{{ $errors->first('admin_commission_type_from_owner') }}</span>
        </div>
    </div>
    <div class="col-sm-6" >
      <div class="form-group">
            <label for="admin_commission_from_owner">@lang('view_pages.admin_commission_for_owner')<span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="admin_commission_from_owner" name="admin_commission_from_owner" value="{{old('admin_commission_from_owner')}}" required="" placeholder="@lang('view_pages.enter') @lang('view_pages.admin_commission_for_owner')">
            <span class="text-danger">{{ $errors->first('admin_commission_from_owner') }}</span>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-sm-6" >
      <div class="form-group">
            <label for="admin_commission_type_from_driver">@lang('view_pages.admin_commission_type_for_driver')<span class="text-danger">*</span></label>
            <select name="admin_commission_type_from_driver" id="admin_commission_type_from_driver" class="form-control" required>
                    <option value="" >@lang('view_pages.select_type')</option>
                    <option value="0" >@lang('view_pages.fixed')</option>
                    <option value="1" >@lang('view_pages.percentage')</option>
                </select>
            <span class="text-danger">{{ $errors->first('admin_commission_type_from_driver') }}</span>
        </div>
    </div>
    <div class="col-sm-6" >
      <div class="form-group">
            <label for="admin_commission_from_driver">@lang('view_pages.admin_commision_from_driver')<span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="admin_commission_from_driver" name="admin_commission_from_driver" value="{{old('admin_commission_from_driver')}}" required="" placeholder="@lang('view_pages.enter') @lang('view_pages.admin_commision_from_driver')">
            <span class="text-danger">{{ $errors->first('admin_commission_from_driver') }}</span>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-sm-6" >
      <div class="form-group">
            <label for="service_tax">@lang('view_pages.service_tax_in_percentage')<span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="service_tax" name="service_tax" value="{{old('service_tax')}}" required="" placeholder="@lang('view_pages.enter') @lang('view_pages.service_tax')">
            <span class="text-danger">{{ $errors->first('service_tax') }}</span>
        </div>
    </div>
        <div class="col-sm-6">
          <div class="form-group">                
            <label for="admin_commision_taken_from">@lang('view_pages.order_number')<span class="text-danger">*</span></label>
            <div class="dropdown-container">
                <div class="info-icon" id="infoIcon">
                    <i class="fa fa-info-circle"></i>
                </div>
                <div class="dropdown-menu" id="dropdownMenu">
                    <a href="#"><em>@lang('view_pages.order_sequence_note')</em></a>
                </div>
            </div>
            <input class="form-control" type="number" id="order_number" name="order_number" required placeholder="@lang('view_pages.enter') @lang('view_pages.order_number')">
            <span id="orderErr" class="text-danger">{{ $errors->first('order_number') }}</span>
        </div>
    </div>
</div>
<hr style="width: 100%; border: 1px solid #2a3042; opacity: 70%; margin: 10px 0;">
{{-- Ride now price --}}
<div class="row">
<div class="col-12">
    <div class="box box-solid box-info">

        <div class="box-body">
                <div class="row">
                        <div class="col-sm-6">
                             <div class="form-group">
                               <label for="base_price">@lang('view_pages.base_price')&nbsp (@lang('view_pages.kilometer')) <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="ride_now_base_price" name="ride_now_base_price" value="{{old('ride_now_base_price')}}" required="" placeholder="@lang('view_pages.enter') @lang('view_pages.base_price')">
                                <span class="text-danger">{{ $errors->first('ride_now_base_price') }}</span>
                            </div>
                        </div>

                          <div class="col-sm-6">
                            <div class="form-group">
                           <label for="price_per_distance">@lang('view_pages.price_per_distance')&nbsp (@lang('view_pages.kilometer')) <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="ride_now_price_per_distance" name="ride_now_price_per_distance" value="{{old('ride_now_price_per_distance')}}" required="" placeholder="@lang('view_pages.enter') @lang('view_pages.distance_price')">
                            <span class="text-danger">{{ $errors->first('ride_now_price_per_distance') }}</span>

                        </div>
                    </div>
                </div>

            <div class="row">
                <div class="col-sm-6">
                   <div class="form-group">
                    <label for="base_distance">@lang('view_pages.select_base_distance')
                        <span class="text-danger">*</span>
                    </label>
                     <input class="form-control" type="number" id="ride_now_base_distance" name="ride_now_base_distance" value="{{old('ride_now_base_distance')}}" required="" placeholder="@lang('view_pages.base_distance')">
                    
                   
                    </div>
                </div>
                 <div class="col-sm-6">
                   <div class="form-group">
                    <label for="price_per_time">@lang('view_pages.time_price')<span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="ride_now_price_per_time" name="ride_now_price_per_time" value="{{old('ride_now_price_per_time')}}" required="" placeholder="@lang('view_pages.enter') @lang('view_pages.time_price')">
                    <span class="text-danger">{{ $errors->first('ride_now_price_per_time') }}</span>

                    </div>
                </div>

            </div>

            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                    <label for="cancellation_fee">@lang('view_pages.cancellation_fee')<span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="ride_now_cancellation_fee" name="ride_now_cancellation_fee" value="{{old('ride_now_cancellation_fee')}}" required="" placeholder="@lang('view_pages.enter') @lang('view_pages.cancellation_fee')">
                    <span class="text-danger">{{ $errors->first('ride_now_cancellation_fee') }}</span>
                  </div>
                </div>
            <div class="col-sm-6">
               <div class="form-group">
                    <label for="waiting_charge">@lang('view_pages.waiting_charge')<span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="ride_now_waiting_charge" name="ride_now_waiting_charge" value="{{old('ride_now_waiting_charge')}}" required="" placeholder="@lang('view_pages.enter') @lang('view_pages.waiting_charge')">
                    <span class="text-danger">{{ $errors->first('ride_now_waiting_charge') }}</span>
                  </div>
                </div>
            <div class="col-sm-6">
               <div class="form-group">
                    <label for="free_waiting_time_in_mins_before_trip_start">@lang('view_pages.free_waiting_time_in_mins_before_trip_start')<span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="ride_now_free_waiting_time_in_mins_before_trip_start" name="ride_now_free_waiting_time_in_mins_before_trip_start" value="{{old('ride_now_free_waiting_time_in_mins_before_trip_start')}}" required="" placeholder="@lang('view_pages.enter') @lang('view_pages.free_waiting_time_in_mins_before_trip_start')">
                    <span class="text-danger">{{ $errors->first('ride_now_free_waiting_time_in_mins_before_trip_start') }}</span>
                 </div>
               </div>
              <div class="col-sm-6">
                <div class="form-group">
                    <label for="free_waiting_time_in_mins_after_trip_start">@lang('view_pages.free_waiting_time_in_mins_after_trip_start')<span class="text-danger">*</span></label>
                    <input class="form-control" type="text" id="ride_now_free_waiting_time_in_mins_after_trip_start" name="ride_now_free_waiting_time_in_mins_after_trip_start" value="{{old('ride_now_free_waiting_time_in_mins_after_trip_start')}}" required="" placeholder="@lang('view_pages.enter') @lang('view_pages.free_waiting_time_in_mins_after_trip_start')">
                    <span class="text-danger">{{ $errors->first('ride_now_free_waiting_time_in_mins_after_trip_start') }}</span>
                  </div>
                </div>
        </div>
    </div>
</div>
</div>
</div>

<div class="form-group">
    <div class="col-12">
        <button class="btn btn-primary btn-sm pull-right mb-4" type="submit">
            @lang('view_pages.save')
        </button>
    </div>
</div>

</form>

            </div>
        </div>


    </div>
</div>
</div>

</div>
<!-- container -->

</div>
<!-- content -->
<!-- jQuery 3 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $('.select2').select2({
        placeholder : "Select ...",
    });
document.addEventListener('DOMContentLoaded', () => {
    const infoIcon = document.getElementById('infoIcon');
    const dropdownMenu = document.getElementById('dropdownMenu');

    // Show dropdown on hover
    infoIcon.addEventListener('mouseenter', () => {
        dropdownMenu.style.display = 'block';
    });

    // Hide dropdown when not hovering
    infoIcon.addEventListener('mouseleave', () => {
        dropdownMenu.style.display = 'none';
    });

    // Hide dropdown when clicking outside
    document.addEventListener('click', (event) => {
        if (!infoIcon.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.style.display = 'none';
        }
    });
});

var order_nos = [];
    $('#order_number').on('input change',function() {
        var zone = $('#zone').val();
        if(!zone) {
            $('#orderErr').html("Select Zone");
        }else if(order_nos.includes($(this).val())){
            $('#orderErr').html("Order Number Unavailable");
        }else{
            $('#orderErr').html('');
        }
    });
    $(document).on('change', '#transport_type', function () {
        let zone = document.getElementById("zone").value;
        let transport_type =$(this).val();
              
        $.ajax({
            url: "{{ url('vehicle_fare/fetch/vehicles') }}",
            type: 'GET',
            data: {
                '_zone': zone,
                'transport_type': transport_type,
            },
            success: function(result) {

                var vehicles = result.data;
                order_nos = result.order_nos;
                var option = ''
                vehicles.forEach(vehicle => {
                    option += `<option value="${vehicle.id}">${vehicle.name}</option>`;
                });

                var max_order_no = Math.max(...order_nos);
                $('#order_number').val(max_order_no+1);
                $('#type').html(option)
            }
        });
    });
    $(document).on('change','#zone',function(){
        var selected =$(this).val();
        $("#transport_type").empty();
          $.ajax({
            url : "{{ route('getTransportTypes') }}",
            type:'GET',
            dataType: 'json',
            success: function(response) {
               $("#transport_type").append('<option value="" disabled selected>Select a transport type</option>');
                
                $.each(response,function(key, value)
                {
                    $("#transport_type").append('<option value=' + value + '>' + value + '</option>');
                });
             }
        });
    });

/*zone on change change label name */

$(document).on('change', '#zone', function () {
    var selected = $(this).val();
    let zone = document.getElementById("zone").value;

    $.ajax({
        url: "{{ route('getUnit') }}",
        type: 'GET',
        dataType: 'json',
        data: {
            'zone': zone,
        },
        success: function (response) {
            // Assuming response.unit contains the new unit text
            if(response.unit == 1)
            {
                        var newUnitText = "Kilometer";

            }else{
                        var newUnitText = "Miles";

            }

            // Update the label text
            var label = $("label[for='base_price']");
            label.html(`@lang('view_pages.base_price')&nbsp (${newUnitText}) <span class="text-danger">*</span>`);

            // You may also want to update the input placeholder
            $("#ride_now_base_price").attr("placeholder", `@lang('view_pages.enter') @lang('view_pages.base_price')`);
            // Update the label text
            var label1 = $("label[for='price_per_distance']");
            label1.html(`@lang('view_pages.price_per_distance')&nbsp (${newUnitText}) <span class="text-danger">*</span>`);

            // You may also want to update the input placeholder
            $("#ride_now_price_per_distance").attr("placeholder", `@lang('view_pages.enter') @lang('view_pages.price_per_distance')`);
        }
    });
});
    
</script>

@endsection

