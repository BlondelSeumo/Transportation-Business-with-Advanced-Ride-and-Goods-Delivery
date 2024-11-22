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

<div class="row">
<div class="col-sm-12">
    <div class="box">

        <div class="box-header with-border">
            <a href="{{ url()->previous() }}">
                <button class="btn btn-danger btn-sm pull-right" type="submit">
                    <i class="mdi mdi-keyboard-backspace mr-2"></i>
                    @lang('view_pages.back')
                </button>
            </a>
        </div>

        <div class="col-sm-12">
                <form method="post" action="{{ url('vehicle_fare/update', $zone_price->id) }}">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <input type="hidden" id="zone_value" name="zone_value" value="{{ $zone_price->zoneType->zone }}">
                                <label for="admin_id">@lang('view_pages.select_zone')
                                <span class="text-danger">*</span>
                                </label>
                                    <select name="zone" id="zone" class="form-control" required>
                                        <option value="{{ $zone_price->zoneType->zone->id }}">{{ $zone_price->zoneType->zone->name }}</option>
                                    </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">@lang('view_pages.transport_type') <span class="text-danger">*</span></label>
                                <select name="transport_type" id="transport_type" class="form-control" required>
                                    <option value="taxi" {{ old('transport_type', $zone_price->zoneType->transport_type ) == 'taxi' ? 'selected' : '' }}>@lang('view_pages.taxi')</option>
                                    <option value="delivery" {{ old('transport_type', $zone_price->zoneType->transport_type ) == 'delivery' ? 'selected' : '' }}>@lang('view_pages.delivery')</option>
                                    <option value="both" {{ old('transport_type', $zone_price->zoneType->transport_type ) == 'both' ? 'selected' : '' }}>@lang('view_pages.both')</option>
                                </select>
                                <span class="text-danger">{{ $errors->first('transport_type') }}</span>
                            </div>
                        </div>
   <div class="col-sm-6">
        <div class="form-group">
            <label for="type">@lang('view_pages.select_type')
                <span class="text-danger">*</span>
            </label>
                <select name="type" id="type" class="form-control">
                    <option value="{{ $zone_price->zoneType->vehicleType->id }}">{{ $zone_price->zoneType->vehicleType->name }}</option>
                </select>
        </div>
    </div>
<div class="col-sm-6">
<div class="form-group" style="padding-right: 30px;">
<label for="payment_type">@lang('view_pages.payment_type')
    <span class="text-danger">*</span>
</label>
                 @php
                   $card = $cash = $wallet = '';
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
                    @else
                        @php
                            $paymentType = explode(',',$zone_price->zoneType->payment_type);
                        @endphp
                        @foreach ($paymentType as $val)
                            @if ($val == 'card')
                                @php
                                    $card = 'selected';
                                @endphp
                            @elseif($val == 'cash')
                                @php
                                    $cash = 'selected';
                                @endphp
                            @elseif($val == 'wallet')
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
                <option
                value="2" {{ old('admin_commision_type',$zone_price->zoneType->admin_commision_type) == '2' ? 'selected' : '' }}>@lang('view_pages.fixed')</option>
                <option value="1" {{ old('admin_commision_type',$zone_price->zoneType->admin_commision_type) == '1' ? 'selected' : '' }}>@lang('view_pages.percentage')</option>
                </select>
            <span class="text-danger">{{ $errors->first('admin_commision_type') }}</span>
        </div>
    </div>
    <div class="col-sm-6" >
      <div class="form-group">
            <label for="admin_commision">@lang('view_pages.admin_commision')<span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="admin_commision" name="admin_commision" value="{{old('admin_commision',$zone_price->zoneType->admin_commision)}}" required="" placeholder="@lang('view_pages.enter') @lang('view_pages.admin_commision')">
            <span class="text-danger">{{ $errors->first('admin_commision') }}</span>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-sm-6" >
      <div class="form-group">
            <label for="admin_commission_type_from_owner">@lang('view_pages.admin_commission_type_for_owner')<span class="text-danger">*</span></label>
            <select name="admin_commission_type_from_owner" id="admin_commission_type_from_owner" class="form-control" required>
                    <option value="0" @if(!$zone_price->zoneType->admin_commission_type_from_owner) selected @endif>@lang('view_pages.fixed')</option>
                    <option value="1" @if($zone_price->zoneType->admin_commission_type_from_owner) selected @endif>@lang('view_pages.percentage')</option>
                </select>
            <span class="text-danger">{{ $errors->first('admin_commission_type_from_owner') }}</span>
        </div>
    </div>
    <div class="col-sm-6" >
      <div class="form-group">
            <label for="admin_commission_from_owner">@lang('view_pages.admin_commission_for_owner')<span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="admin_commission_from_owner" name="admin_commission_from_owner" value="{{old('admin_commission_from_owner',$zone_price->zoneType->admin_commission_from_owner)}}" required="" placeholder="@lang('view_pages.enter') @lang('view_pages.admin_commission_for_owner')">
            <span class="text-danger">{{ $errors->first('admin_commission_from_owner') }}</span>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-sm-6" >
      <div class="form-group">
            <label for="admin_commission_type_from_driver">@lang('view_pages.admin_commission_type_for_driver')<span class="text-danger">*</span></label>
            <select name="admin_commission_type_from_driver" id="admin_commission_type_from_driver" class="form-control" required>
                    <option value="0" @if(!$zone_price->zoneType->admin_commission_type_from_driver) selected @endif>@lang('view_pages.fixed')</option>
                    <option value="1" @if($zone_price->zoneType->admin_commission_type_from_driver) selected @endif>@lang('view_pages.percentage')</option>
                </select>
            <span class="text-danger">{{ $errors->first('admin_commission_type_from_driver') }}</span>
        </div>
    </div>
    <div class="col-sm-6" >
      <div class="form-group">
            <label for="admin_commission_from_driver">@lang('view_pages.admin_commision_from_driver')<span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="admin_commission_from_driver" name="admin_commission_from_driver" value="{{old('admin_commission_from_driver',$zone_price->zoneType->admin_commission_from_driver)}}" required="" placeholder="@lang('view_pages.enter') @lang('view_pages.admin_commision_from_driver')">
            <span class="text-danger">{{ $errors->first('admin_commission_from_driver') }}</span>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-sm-6" >
      <div class="form-group">
            <label for="service_tax">@lang('view_pages.service_tax_in_percentage')<span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="service_tax" name="service_tax" value="{{old('service_tax',$zone_price->zoneType->service_tax)}}" required="" placeholder="@lang('view_pages.enter') @lang('view_pages.service_tax')">
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
            <input class="form-control" type="number" id="order_number" name="order_number" required placeholder="@lang('view_pages.enter') @lang('view_pages.order_number')" value="{{$zone_price->zoneType->order_number}}">
            <span id="orderErr" class="text-danger">{{ $errors->first('order_number') }}</span>
        </div>
    </div>
</div>
<hr style="width: 100%; border: 1px solid #2a3042; opacity: 70%; margin: 10px 0;">
{{-- Ride now price --}}
                    @if ($zone_price->price_type == 1)
                        <div class="row">
                            <div class="col-12 ">
                                <h2 class="fw-medium fs-base me-auto">
                                    Ride Now
                                </h2>
                            </div>
                            </div>
                            <div class="row ml-2 mr-2">
                            <div class="col-12 col-lg-6 mt-4">
                                <label for="base_price">@lang('view_pages.base_price')&nbsp (@lang('view_pages.kilometer')) <span class="text-danger">*</span></label>
                                <input id="ride_now_base_price" name="ride_now_base_price" value="{{ old('ride_now_base_price', $zone_price->base_price) }}" type="text" class="form-control w-full" placeholder="@lang('view_pages.enter') @lang('view_pages.base_price')" required>
                                <span class="text-danger">{{ $errors->first('ride_now_base_price') }}</span>
                            </div>

                            <div class="col-12 col-lg-6 mt-4">
                               <label for="price_per_distance">@lang('view_pages.price_per_distance')&nbsp (@lang('view_pages.kilometer')) <span class="text-danger">*</span></label>
                                <input id="ride_now_price_per_distance" name="ride_now_price_per_distance" value="{{ old('ride_now_price_per_distance', $zone_price->price_per_distance) }}" type="text" class="form-control w-full" placeholder="@lang('view_pages.enter') @lang('view_pages.price_per_distance')" required>
                                <span class="text-danger">{{ $errors->first('ride_now_price_per_distance') }}</span>
                            </div>

                            <div class="col-12 col-lg-6 mt-4">
                                <label for="base_distance" class="form-label">@lang('view_pages.base_distance')</label>
                                <input id="ride_now_base_distance" name="ride_now_base_distance" value="{{ old('ride_now_base_distance', $zone_price->base_distance) }}" type="number" min="0" class="form-control w-full" placeholder="@lang('view_pages.enter') @lang('view_pages.base_distance')" required>
                                <span class="text-danger">{{ $errors->first('ride_now_base_distance') }}</span>
                            </div>
                            <div class="col-12 col-lg-6 mt-4">
                                <label for="price_per_time" class="form-label">@lang('view_pages.time_price')</label>
                                <input id="ride_now_price_per_time" name="ride_now_price_per_time" value="{{ old('ride_now_price_per_time', $zone_price->price_per_time) }}" type="text" class="form-control w-full" placeholder="@lang('view_pages.enter') @lang('view_pages.price_per_time')" required>
                                <span class="text-danger">{{ $errors->first('ride_now_price_per_time') }}</span>
                            </div>

                            <div class="col-12 col-lg-6 mt-4">
                                <label for="cancellation_fee" class="form-label">@lang('view_pages.cancellation_fee')</label>
                                <input id="ride_now_cancellation_fee" name="ride_now_cancellation_fee" value="{{ old('ride_now_cancellation_fee', $zone_price->cancellation_fee) }}" type="text" class="form-control w-full" placeholder="@lang('view_pages.enter') @lang('view_pages.cancellation_fee')" required>
                                <span class="text-danger">{{ $errors->first('ride_now_cancellation_fee') }}</span>
                            </div>
                            <div class="col-12 col-lg-6 mt-4">
                                <label for="waiting_charge" class="form-label">@lang('view_pages.waiting_charge')</label>
                                <input id="ride_now_waiting_charge" name="ride_now_waiting_charge" value="{{ old('ride_now_waiting_charge', $zone_price->waiting_charge) }}" type="text" class="form-control w-full" placeholder="@lang('view_pages.enter') @lang('view_pages.waiting_charge')" required>
                                <span class="text-danger">{{ $errors->first('ride_now_waiting_charge') }}</span>
                            </div>                               
                            <div class="col-12 col-lg-6 mt-4">
                                <label for="ride_now_free_waiting_time_in_mins_before_trip_start" class="form-label">@lang('view_pages.free_waiting_time_in_mins_before_trip_start')</label>
                                <input id="ride_now_free_waiting_time_in_mins_before_trip_start" name="ride_now_free_waiting_time_in_mins_before_trip_start" value="{{ old('ride_now_free_waiting_time_in_mins_before_trip_start', $zone_price->free_waiting_time_in_mins_before_trip_start) }}" type="text" class="form-control w-full" placeholder="@lang('view_pages.enter') @lang('view_pages.ride_now_free_waiting_time_in_mins_before_trip_start')" required>
                                <span class="text-danger">{{ $errors->first('ride_now_free_waiting_time_in_mins_before_trip_start') }}</span>
                            </div>
                            <div class="col-12 col-lg-6 mt-4">
                                <label for="ride_later_free_waiting_time_in_mins_after_trip_start" class="form-label">@lang('view_pages.free_waiting_time_in_mins_after_trip_start')</label>
                                <input id="ride_later_free_waiting_time_in_mins_after_trip_start" name="ride_later_free_waiting_time_in_mins_after_trip_start" value="{{ old('ride_later_free_waiting_time_in_mins_after_trip_start', $zone_price->free_waiting_time_in_mins_after_trip_start) }}" type="text" class="form-control w-full" placeholder="@lang('view_pages.enter') @lang('view_pages.ride_later_free_waiting_time_in_mins_after_trip_start')" required>
                                <span class="text-danger">{{ $errors->first('ride_later_free_waiting_time_in_mins_after_trip_start') }}</span>
                            </div>

                        </div>

                    @else
                 <!-- <div class="col-sm-12"> -->
                        <div class="row">
                            <div class="form-group">
                                <h2 class="fw-medium fs-base me-auto">
                                    Ride Later
                                </h2>
                            </div>
                            <div class="row ml-2 mr-2">
                            <div class="col-12 col-lg-6 mt-4">
                              <label for="base_price">@lang('view_pages.base_price')&nbsp (@lang('view_pages.kilometer')) <span class="text-danger">*</span></label>
                                <input id="ride_later_base_price" name="ride_later_base_price" value="{{ old('ride_later_base_price', $zone_price->base_price) }}" type="text" class="form-control w-full" placeholder="@lang('view_pages.enter') @lang('view_pages.base_price')" required>
                                <span class="text-danger">{{ $errors->first('ride_later_base_price') }}</span>
                            </div>

                            <div  class="col-12 col-lg-6 mt-4">
                              <label for="price_per_distance">@lang('view_pages.price_per_distance')&nbsp (@lang('view_pages.kilometer')) <span class="text-danger">*</span></label>
                                <input id="ride_later_price_per_distance" name="ride_later_price_per_distance" value="{{ old('ride_later_price_per_distance', $zone_price->price_per_distance) }}" type="text" class="form-control w-full" placeholder="@lang('view_pages.enter') @lang('view_pages.price_per_distance')" required>
                                <span class="text-danger">{{ $errors->first('ride_later_price_per_distance') }}</span>
                            </div>

                            <div  class="col-12 col-lg-6 mt-4">
                                <label for="base_distance" class="form-label">@lang('view_pages.base_distance')</label>
                                <input id="ride_later_base_distance" name="ride_later_base_distance" value="{{ old('ride_later_base_distance', $zone_price->base_distance) }}" type="number" min="0" class="form-control w-full" placeholder="@lang('view_pages.enter') @lang('view_pages.base_distance')" required>
                                <span class="text-danger">{{ $errors->first('ride_later_base_distance') }}</span>
                            </div>
                            <div class="col-12 col-lg-6 mt-4">
                                <label for="price_per_time" class="form-label">@lang('view_pages.time_price')</label>
                                <input id="ride_later_price_per_time" name="ride_later_price_per_time" value="{{ old('ride_later_price_per_time', $zone_price->price_per_time) }}" type="text" class="form-control w-full" placeholder="@lang('view_pages.enter') @lang('view_pages.price_per_time')" required>
                                <span class="text-danger">{{ $errors->first('ride_later_price_per_time') }}</span>
                            </div>

                            <div class="col-sm-6">
                                <label for="cancellation_fee" class="form-label">@lang('view_pages.cancellation_fee')</label>
                                <input id="ride_later_cancellation_fee" name="ride_later_cancellation_fee" value="{{ old('ride_later_cancellation_fee', $zone_price->cancellation_fee) }}" type="text" class="form-control w-full" placeholder="@lang('view_pages.enter') @lang('view_pages.cancellation_fee')" required>
                                <span class="text-danger">{{ $errors->first('ride_later_cancellation_fee') }}</span>
                            </div>
                            <div class="col-12 col-lg-6 mt-4">
                                <label for="ride_later_free_waiting_time_in_mins_before_trip_start" class="form-label">@lang('view_pages.free_waiting_time_in_mins_before_trip_start')</label>
                                <input id="ride_later_free_waiting_time_in_mins_before_trip_start" name="ride_later_free_waiting_time_in_mins_before_trip_start" value="{{ old('ride_later_free_waiting_time_in_mins_before_trip_start', $zone_price->free_waiting_time_in_mins_before_trip_start) }}" type="text" class="form-control w-full" placeholder="@lang('view_pages.enter') @lang('view_pages.ride_later_free_waiting_time_in_mins_before_trip_start')" required>
                                <span class="text-danger">{{ $errors->first('ride_later_free_waiting_time_in_mins_before_trip_start') }}</span>
                            </div>
                            <div class="col-12 col-lg-6 mt-4">
                                <label for="ride_now_free_waiting_time_in_mins_after_trip_start" class="form-label">@lang('view_pages.free_waiting_time_in_mins_after_trip_start')</label>
                                <input id="ride_now_ride_now_free_waiting_time_in_mins_after_trip_start" name="ride_now_ride_now_free_waiting_time_in_mins_after_trip_start" value="{{ old('ride_now_ride_now_free_waiting_time_in_mins_after_trip_start', $zone_price->free_waiting_time_in_mins_after_trip_start) }}" type="text" class="form-control w-full" placeholder="@lang('view_pages.enter') @lang('view_pages.ride_now_free_waiting_time_in_mins_after_trip_start')" required>
                                <span class="text-danger">{{ $errors->first('ride_now_ride_now_free_waiting_time_in_mins_after_trip_start') }}</span>
                            </div>                            
                        </div>
                    @endif
            
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-sm pull-right m-5">{{ __('view_pages.save') }}</button>
                    </div>
                </form>
            </div>
            <!-- END: Form Layout -->
        </div>
    </div>
<!-- jQuery 3 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $('.select2').select2({
        placeholder : "Select ...",
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
                // $("#transport_type").attr('disabled', false);
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
document.addEventListener("DOMContentLoaded", function() {
    var zone = document.getElementById("zone_value");

    var zone_unit = zone.value;

    // Parse the JSON string into a JavaScript object
    var zone_unit_obj = JSON.parse(zone_unit);

    // Access the 'unit' property

            if(zone_unit_obj.unit == 1)
            {
                        var newUnitText = "Kilometer";

            }else{
                        var newUnitText = "Miles";

            }




    var label = $("label[for='base_price']");
        label.html(`@lang('view_pages.base_price')&nbsp (${newUnitText}) <span class="text-danger">*</span>`);

        // You may also want to update the input placeholder
        $("#ride_now_base_price").attr("placeholder", `@lang('view_pages.enter') @lang('view_pages.base_price')`);
        // Update the label text
        var label1 = $("label[for='price_per_distance']");
        label1.html(`@lang('view_pages.price_per_distance')&nbsp (${newUnitText}) <span class="text-danger">*</span>`);

        // You may also want to update the input placeholder
        $("#ride_now_price_per_distance").attr("placeholder", `@lang('view_pages.enter') @lang('view_pages.price_per_distance')`);

});

    
</script>

@endsection