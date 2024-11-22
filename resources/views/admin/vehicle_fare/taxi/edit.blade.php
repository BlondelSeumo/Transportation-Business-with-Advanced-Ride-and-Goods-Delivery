@extends('admin.layouts.app')
@section('title', 'Main page')


@section('content')
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
                                <label for="admin_id">@lang('view_pages.select_zone')
                                <span class="text-danger">*</span>
                                </label>
                                    <select name="zone" id="zone" class="form-control" disabled required>
                                        <option value="{{ $zone_price->zoneType->zone->id }}" disabledi>{{ $zone_price->zoneType->zone->name }}</option>
                                    </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="type">@lang('view_pages.select_type')
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="type" id="type" class="form-control" disabled required>
                                        <option value="{{ $zone_price->zoneType->vehicleType->id }}">{{ $zone_price->zoneType->vehicleType->name }}</option>
                                    </select>
                                </div>
                                    <span class="text-danger">{{ $errors->first('type') }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6" >
                          <div class="form-group">
                                <label for="admin_commision_type">@lang('view_pages.admin_commision_type')<span class="text-danger">*</span></label>
                                <select name="admin_commision_type" id="admin_commision_type" class="form-control" required>
                              <option
                                value="2" {{ old('admin_commision_type',$zone_price->zoneType->admin_commision_type) == '2' ? 'selected' : '' }}>@lang('view_pages.fixed')</option>
                                <option
                                value="1" {{ old('admin_commision_type',$zone_price->zoneType->admin_commision_type) == '1' ? 'selected' : '' }}>@lang('view_pages.percentage')</option>option>
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
                                <label for="service_tax">@lang('view_pages.service_tax_in_percentage')<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="service_tax" name="service_tax" value="{{old('service_tax',$zone_price->zoneType->service_tax)}}" required="" placeholder="@lang('view_pages.enter') @lang('view_pages.service_tax')">
                                <span class="text-danger">{{ $errors->first('service_tax') }}</span>
                            </div>
                        </div>
                    <div class="col-6">
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
                    <select name="payment_type[]" id="payment_type" class="form-control select2" multiple="multiple" data-placeholder="@lang('view_pages.select') @lang('view_pages.payment_type')" required>
                        <option value="cash" {{ $cash }}>@lang('view_pages.cash')</option>
                        <option value="card" {{ $card }}>@lang('view_pages.card')</option>
                        <option value="wallet" {{ $wallet }}>@lang('view_pages.wallet')</option>
                         </select>
                     </div>
                     <span class="text-danger">{{ $errors->first('payment_type') }}</span>
                </div>
        </div>

<div class="row">
        <div class="col-sm-6">
          <div class="form-group">                
            <label for="admin_commision_taken_from">@lang('view_pages.order_number')<span class="text-danger">*</span></label>
            <input class="form-control" type="number" value="{{$zone_price->zoneType->order_number}}" id="order_number" name="order_number" required placeholder="@lang('view_pages.enter') @lang('view_pages.order_number')">
            <span id="orderErr" class="text-danger">{{ $errors->first('order_number') }}</span>
        </div>
    </div>
</div>
                   <!--  <div class="row">
                        <div class="col-sm-6" >
                          <div class="form-group">
                                <label for="admin_commision_taken_from">@lang('view_pages.admin_commision_taken_from')<span class="text-danger">*</span></label>
                                <select name="admin_commision_taken_from" id="admin_commision_taken_from" class="form-control" required>
                              <option
                                value="user" {{ old('admin_commision_taken_from',$zone_price->zoneType->admin_commision_taken_from) == 'user' ? 'selected' : '' }}>@lang('view_pages.user')</option>
                                <option
                                value="driver" {{ old('admin_commision_taken_from',$zone_price->zoneType->admin_commision_taken_from) == 'driver' ? 'selected' : '' }}>@lang('view_pages.driver')</option>
                                    </select>
                                <span class="text-danger">{{ $errors->first('admin_commision_taken_from') }}</span>
                            </div>
                        </div>
                       </div>  -->

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
                                <label for="ride_now_base_price" class="form-label">@lang('view_pages.base_price')  (@lang('view_pages.kilometer'))</label>
                                <input type="hidden" id="price_type" name="price_type" value="RIDENOW">
                                <input id="ride_now_base_price" name="ride_now_base_price" value="{{ old('ride_now_base_price', $zone_price->base_price) }}" type="text" class="form-control w-full" placeholder="@lang('view_pages.enter') @lang('view_pages.base_price')" required>
                                <span class="text-danger">{{ $errors->first('ride_now_base_price') }}</span>
                            </div>

                            <div class="col-12 col-lg-6 mt-4">
                                <label for="price_per_distance" class="form-label">@lang('view_pages.price_per_distance')  (@lang('view_pages.kilometer'))</label>
                                <input id="ride_now_price_per_distance" name="ride_now_price_per_distance" value="{{ old('ride_now_price_per_distance', $zone_price->price_per_distance) }}" type="text" class="form-control w-full" placeholder="@lang('view_pages.enter') @lang('view_pages.price_per_distance')" required>
                                <span class="text-danger">{{ $errors->first('ride_now_price_per_distance') }}</span>
                            </div>

                            <div class="col-12 col-lg-6 mt-4">
                                <label for="base_distance" class="form-label">@lang('view_pages.base_distance')</label>
                                <input id="ride_now_base_distance" name="ride_now_base_distance" value="{{ old('ride_now_base_distance', $zone_price->base_distance) }}" type="number" min="0" class="form-control w-full" placeholder="@lang('view_pages.enter') @lang('view_pages.base_distance')" required>
                                <span class="text-danger">{{ $errors->first('ride_now_base_distance') }}</span>
                            </div>

                            <div class="col-12 col-lg-6 mt-4">
                                <label for="price_per_time" class="form-label">@lang('view_pages.price_per_time')(minutes)</label>
                                <input id="ride_now_price_per_time" name="ride_now_price_per_time" value="{{ old('ride_now_price_per_time', $zone_price->price_per_time) }}" type="text" class="form-control w-full" placeholder="@lang('view_pages.enter') @lang('view_pages.price_per_time')" required>
                                <span class="text-danger">{{ $errors->first('ride_now_price_per_time') }}</span>
                            </div>

                            <div class="col-12 col-lg-6 mt-4">
                                <label for="cancellation_fee" class="form-label">@lang('view_pages.cancellation_fee')</label>
                                <input id="ride_now_cancellation_fee" name="ride_now_cancellation_fee" value="{{ old('ride_now_cancellation_fee', $zone_price->cancellation_fee) }}" type="text" class="form-control w-full" placeholder="@lang('view_pages.enter') @lang('view_pages.cancellation_fee')" required>
                                <span class="text-danger">{{ $errors->first('ride_now_cancellation_fee') }}</span>
                        </div>
             <div class="col-12 col-lg-6 mt-4">
                <div class="form-group">
                    <label for="waiting_charge">@lang('view_pages.waiting_charge')<span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="ride_now_waiting_charge" name="ride_now_waiting_charge" value="{{old('ride_now_waiting_charge',$zone_price->waiting_charge)}}" required="" placeholder="@lang('view_pages.enter') @lang('view_pages.waiting_charge')">
                <span class="text-danger">{{ $errors->first('ride_now_waiting_charge') }}</span>

                </div>
                </div>

                <div class="col-12 col-lg-6 mt-4">
                <div class="form-group">
                <label for="free_waiting_time_in_mins_before_trip_start">@lang('view_pages.free_waiting_time_in_mins_before_trip_start')<span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="ride_now_free_waiting_time_in_mins_before_trip_start" name="ride_now_free_waiting_time_in_mins_before_trip_start" value="{{old('ride_now_free_waiting_time_in_mins_before_trip_start',$zone_price->free_waiting_time_in_mins_before_trip_start)}}" required="" placeholder="@lang('view_pages.enter') @lang('view_pages.free_waiting_time_in_mins_before_trip_start')">
                <span class="text-danger">{{ $errors->first('ride_now_free_waiting_time_in_mins_before_trip_start') }}</span>

                </div>
                </div>
                <div class="col-12 col-lg-6 mt-4">
                <div class="form-group">
                <label for="free_waiting_time_in_mins_after_trip_start">@lang('view_pages.free_waiting_time_in_mins_after_trip_start')<span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="ride_now_free_waiting_time_in_mins_after_trip_start" name="ride_now_free_waiting_time_in_mins_after_trip_start" value="{{old('ride_now_free_waiting_time_in_mins_after_trip_start',$zone_price->free_waiting_time_in_mins_after_trip_start)}}" required="" placeholder="@lang('view_pages.enter') @lang('view_pages.free_waiting_time_in_mins_after_trip_start')">
                <span class="text-danger">{{ $errors->first('ride_now_free_waiting_time_in_mins_after_trip_start') }}</span>

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
                                <label for="ride_later_base_price" class="form-label">@lang('view_pages.base_price')  (@lang('view_pages.kilometer'))</label>
                                <input type="hidden" id="price_type" name="price_type" value="RIDELATER">
                                <input id="ride_later_base_price" name="ride_later_base_price" value="{{ old('ride_later_base_price', $zone_price->base_price) }}" type="text" class="form-control w-full" placeholder="@lang('view_pages.enter') @lang('view_pages.base_price')" required>
                                <span class="text-danger">{{ $errors->first('ride_later_base_price') }}</span>
                            </div>

                            <div  class="col-12 col-lg-6 mt-4">
                                <label for="price_per_distance" class="form-label">@lang('view_pages.price_per_distance')  (@lang('view_pages.kilometer'))</label>
                                <input id="ride_later_price_per_distance" name="ride_later_price_per_distance" value="{{ old('ride_later_price_per_distance', $zone_price->price_per_distance) }}" type="text" class="form-control w-full" placeholder="@lang('view_pages.enter') @lang('view_pages.price_per_distance')" required>
                                <span class="text-danger">{{ $errors->first('ride_later_price_per_distance') }}</span>
                            </div>

                            <div  class="col-12 col-lg-6 mt-4">
                                <label for="base_distance" class="form-label">@lang('view_pages.base_distance')</label>
                                <input id="ride_later_base_distance" name="ride_later_base_distance" value="{{ old('ride_later_base_distance', $zone_price->base_distance) }}" type="number" min="0" class="form-control w-full" placeholder="@lang('view_pages.enter') @lang('view_pages.base_distance')" required>
                                <span class="text-danger">{{ $errors->first('ride_later_base_distance') }}</span>
                            </div>

                            <div  class="col-12 col-lg-6 mt-4">
                                <label for="price_per_time" class="form-label">@lang('view_pages.price_per_time')(minutes)</label>
                                <input id="ride_later_price_per_time" name="ride_later_price_per_time" value="{{ old('ride_later_price_per_time', $zone_price->price_per_time) }}" type="text" class="form-control w-full" placeholder="@lang('view_pages.enter') @lang('view_pages.price_per_time')" required>
                                <span class="text-danger">{{ $errors->first('ride_later_price_per_time') }}</span>
                            </div>

                            <div class="col-sm-6">
                                <label for="cancellation_fee" class="form-label">@lang('view_pages.cancellation_fee')</label>
                                <input id="ride_later_cancellation_fee" name="ride_later_cancellation_fee" value="{{ old('ride_later_cancellation_fee', $zone_price->cancellation_fee) }}" type="text" class="form-control w-full" placeholder="@lang('view_pages.enter') @lang('view_pages.cancellation_fee')" required>
                                <span class="text-danger">{{ $errors->first('ride_later_cancellation_fee') }}</span>
                            </div>
     <div class="col-12 col-lg-6 mt-4">
                <div class="form-group">
                    <label for="waiting_charge">@lang('view_pages.waiting_charge')<span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="ride_later_waiting_charge" name="ride_later_waiting_charge" value="{{old('ride_later_waiting_charge', $zone_price->waiting_charge)}}" required="" placeholder="@lang('view_pages.enter') @lang('view_pages.waiting_charge')">
                <span class="text-danger">{{ $errors->first('ride_now_waiting_charge') }}</span>

                </div>
                </div>

                <div class="col-12 col-lg-6 mt-4">
                <div class="form-group">
                <label for="free_waiting_time_in_mins_before_trip_start">@lang('view_pages.free_waiting_time_in_mins_before_trip_start')<span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="ride_later_free_waiting_time_in_mins_before_trip_start" name="ride_later_free_waiting_time_in_mins_before_trip_start" value="{{old('ride_later_free_waiting_time_in_mins_before_trip_start',$zone_price->free_waiting_time_in_mins_before_trip_start)}}" required="" placeholder="@lang('view_pages.enter') @lang('view_pages.free_waiting_time_in_mins_before_trip_start')">
                <span class="text-danger">{{ $errors->first('ride_later_free_waiting_time_in_mins_before_trip_start') }}</span>

                </div>
                </div>
                <div class="col-12 col-lg-6 mt-4">
                <div class="form-group">
                <label for="free_waiting_time_in_mins_after_trip_start">@lang('view_pages.free_waiting_time_in_mins_after_trip_start')<span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="ride_later_free_waiting_time_in_mins_after_trip_start" name="ride_later_free_waiting_time_in_mins_after_trip_start" value="{{old('ride_later_free_waiting_time_in_mins_after_trip_start',$zone_price->free_waiting_time_in_mins_after_trip_start)}}" required="" placeholder="@lang('view_pages.enter') @lang('view_pages.free_waiting_time_in_mins_after_trip_start')">
                <span class="text-danger">{{ $errors->first('ride_later_free_waiting_time_in_mins_after_trip_start') }}</span>

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
    $(document).on('change', '#zone', function() {
        let zone = $(this).val();

        $.ajax({
            url: "{{ url('vehicle_fare/fetch/vehicles') }}",
            type: 'GET',
            data: {
                '_zone': zone,
            },
            success: function(result) {
                var vehicles = result.data;
                order_nos = result.order_nos;
                var option = ''
                option += `<option value="" selected disabled>@lang('view_pages.select_type')</option>`;
                vehicles.forEach(vehicle => {
                    option += `<option value="${vehicle.id}">${vehicle.name}</option>`;
                });
                var max_order_no = Math.max(...order_nos);
                $('#order_number').val(max_order_no+1);
                $('#type').html(option)
            }
        });
    });
    </script>
@endsection