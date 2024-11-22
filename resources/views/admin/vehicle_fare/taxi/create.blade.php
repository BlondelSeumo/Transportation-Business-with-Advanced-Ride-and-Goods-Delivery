@extends('admin.layouts.app')

@section('title', 'Main page')

@section('content')

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
            <label for="type">@lang('view_pages.select_type')
                <span class="text-danger">*</span>
            </label>
            <select name="type" id="type" class="form-control" required>
                <option value="" >@lang('view_pages.select_type')</option>
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
            <label for="service_tax">@lang('view_pages.service_tax_in_percentage')<span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="service_tax" name="service_tax" value="{{old('service_tax')}}" required="" placeholder="@lang('view_pages.enter') @lang('view_pages.service_tax')">
            <span class="text-danger">{{ $errors->first('service_tax') }}</span>
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
        <div class="col-sm-6">
          <div class="form-group">                
            <label for="admin_commision_taken_from">@lang('view_pages.order_number')<span class="text-danger">*</span></label>
            <input class="form-control" type="number" id="order_number" name="order_number" required placeholder="@lang('view_pages.enter') @lang('view_pages.order_number')">
            <span id="orderErr" class="text-danger">{{ $errors->first('order_number') }}</span>
        </div>
    </div>
</div>


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
                <label for="price_per_time">@lang('view_pages.price_per_time')(minutes)<span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="ride_now_price_per_time" name="ride_now_price_per_time" value="{{old('ride_now_price_per_time')}}" required="" placeholder="@lang('view_pages.enter') @lang('view_pages.price_per_time')">
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

