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
        <a href="{{ url('vehicle_fare/rental_package/index',$item->zone_type_id) }}">
                <button class="btn btn-danger btn-sm pull-right" type="submit">
                    <i class="mdi mdi-keyboard-backspace mr-2"></i>
                    @lang('view_pages.back')
                </button>
            </a>
        </div>

<div class="col-sm-12">

<form  method="post" class="form-horizontal" action="{{url('zone/types/zone_package_price/update',$item->id)}}" enctype="multipart/form-data">
@csrf

    <div class="row">

        <div class="col-sm-6">
            <div class="form-group">
                <label for="type">@lang('view_pages.select_package_type') <span class="text-danger">*</span></label>
                <select name="type_id" id="type_id" class="form-control select2" required>
                    <option value="" selected disabled>@lang('view_pages.select')</option>
                    @foreach($types as $type)
                    <option value="{{ $type->id }}" {{ old('package_type_id',$item->package_type_id) == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                    @endforeach
                </select>
                <span class="text-danger">{{ $errors->first('type_id') }}</span>

            </div>
        </div>
         <div class="col-sm-6">
                                <div class="form-group">
                               <label for="base_price">@lang('view_pages.base_price')&nbsp (@lang('view_pages.kilometer')) <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="base_price" name="base_price" value="{{old('base_price',$item->base_price)}}" required="" placeholder="@lang('view_pages.enter') @lang('view_pages.base_price')">
                                <span class="text-danger">{{ $errors->first('base_price') }}</span>
                            </div>
                        </div>

        <div class="col-sm-6">
            <div class="form-group">
            <label for="distance_price">@lang('view_pages.distance_price') <span class="text-danger">*</span></label>
            <input class="form-control" type="number" id="distance_price" name="distance_price" value="{{old('distance_price_per_km',$item->distance_price_per_km)}}" required="" placeholder="@lang('view_pages.enter_distance_price')">
            <span class="text-danger">{{ $errors->first('distance_price') }}</span>

        </div>
    </div> 
    <div class="col-sm-6">
            <div class="form-group">
            <label for="time_price">@lang('view_pages.time_price') <span class="text-danger">*</span></label>
            <input class="form-control" type="number" id="time_price" name="time_price" value="{{old('time_price_per_min',$item->time_price_per_min)}}" required="" placeholder="@lang('view_pages.enter_time_price')">
            <span class="text-danger">{{ $errors->first('time_price') }}</span>

        </div>
    </div> 
    <div class="col-sm-6">
            <div class="form-group">
            <label for="free_distance">@lang('view_pages.free_distance') <span class="text-danger">*</span></label>
            <input class="form-control" type="number" id="free_distance" name="free_distance" value="{{old('free_distance',$item->free_distance)}}" required="" placeholder="@lang('view_pages.enter_free_distance')">
            <span class="text-danger">{{ $errors->first('free_distance') }}</span>

        </div>
    </div>
    <div class="col-sm-6">
                <div class="form-group">
                <label for="free_minute">@lang('view_pages.free_minute') <span class="text-danger">*</span></label>
                <input class="form-control" type="number" id="free_minute" name="free_minute" value="{{old('free_min',$item->free_min)}}" required="" placeholder="@lang('view_pages.enter_free_minute')">
                <span class="text-danger">{{ $errors->first('free_minute') }}</span>

            </div>
    </div>
    <div class="col-sm-6">
                <div class="form-group">
                <label for="cancellation_fee">@lang('view_pages.cancellation_fee') <span class="text-danger">*</span></label>
                <input class="form-control" type="number" id="cancellation_fee" name="cancellation_fee" value="{{old('cancellation_fee',$item->cancellation_fee)}}" required="" placeholder="@lang('view_pages.enter_cancellation_fee')">
                <span class="text-danger">{{ $errors->first('cancellation_fee') }}</span>

            </div>
        </div>

    
   

   
   


    <div class="form-group">
        <div class="col-12">
            <button class="btn btn-primary pull-right btn-sm m-5" type="submit">
                @lang('view_pages.update')
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

@endsection
