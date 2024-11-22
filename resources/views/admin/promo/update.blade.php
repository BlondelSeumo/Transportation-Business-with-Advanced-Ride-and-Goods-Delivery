@extends('admin.layouts.app')
@section('title', 'Main page')

@section('content')
{{-- {{session()->get('errors')}} --}}

<!-- bootstrap datepicker -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link rel="stylesheet" href="{!! asset('assets/vendor_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') !!}">

    <!-- Start Page content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="box">

                        <div class="box-header with-border">
                            <a href="{{ url('promo') }}">
                                <button class="btn btn-danger btn-sm pull-right" type="submit">
                                    <i class="mdi mdi-keyboard-backspace mr-2"></i>
                                    @lang('view_pages.back')
                                </button>
                            </a>
                        </div>

                        <div class="col-sm-12">

                            <form method="post" class="form-horizontal" action="{{ url('promo/update',$item->id) }}">
                                @csrf

                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="admin_id">@lang('view_pages.select_area')
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="service_location_id[]" id="service_location_id" class="form-control select2" multiple="multiple" data-placeholder="@lang('view_pages.select_area')">
                                                <option value="">@lang('view_pages.select_area')</option>
                                                @foreach ($cities as $key => $city)
                                                    @if($city->service_location_status == 1)
                                                        <option value="{{ $city->id }}" selected {{ in_array($city->id, (array)old('service_location_id', $item->service_location_id)) ? 'selected' : '' }} >{{ $city->name }}</option>
                                                    @else
                                                        <option value="{{ $city->id }}" {{ in_array($city->id, (array)old('service_location_id', $item->service_location_id)) ? 'selected' : '' }} >{{ $city->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <span class="text-danger">{{ $errors->first('service_location_id') }}</span>
                                        </div>

                                    </div>
                             <div class="col-4">
                                        <div class="form-group">
                                            <label for="">@lang('view_pages.transport_type') <span class="text-danger">*</span></label>
                                            <select name="transport_type" id="transport_type" class="form-control" required>
                                                <option value="" selected disabled>@lang('view_pages.select')</option>
                                                <option value="taxi" {{ old('transport_type', $item->transport_type) == 'taxi' ? 'selected' : '' }}>@lang('view_pages.taxi')</option>
                                                <option value="delivery" {{ old('transport_type', $item->transport_type) == 'delivery' ? 'selected' : '' }}>@lang('view_pages.delivery')</option>
                                                <option value="both" {{ old('transport_type', $item->transport_type) == 'both' ? 'selected' : '' }}>@lang('view_pages.both')</option>
                                            </select>
                                            <span class="text-danger">{{ $errors->first('transport_type') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="code">@lang('view_pages.code') <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="code" name="code"
                                                value="{{ old('code',$item->code) }}" required
                                                placeholder="@lang('view_pages.enter') @lang('view_pages.code')">
                                            <span class="text-danger">{{ $errors->first('code') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="minimum_trip_amount">@lang('view_pages.minimum_trip_amount') <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="minimum_trip_amount" name="minimum_trip_amount"
                                                value="{{ old('minimum_trip_amount',$item->minimum_trip_amount) }}" required
                                                placeholder="@lang('view_pages.enter') @lang('view_pages.minimum_trip_amount')">
                                            <span class="text-danger">{{ $errors->first('minimum_trip_amount') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="maximum_discount_amount">@lang('view_pages.maximum_discount_amount') <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="maximum_discount_amount" name="maximum_discount_amount"
                                                value="{{ old('maximum_discount_amount',$item->maximum_discount_amount) }}" required=""
                                                placeholder="@lang('view_pages.enter') @lang('view_pages.maximum_discount_amount')">
                                            <span class="text-danger">{{ $errors->first('maximum_discount_amount') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="discount_percent">@lang('view_pages.discount_percent') <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="discount_percent" name="discount_percent"
                                                value="{{ old('discount_percent',$item->discount_percent) }}" required=""
                                                placeholder="@lang('view_pages.enter') @lang('view_pages.discount_percent')">
                                            <span class="text-danger">{{ $errors->first('discount_percent') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="total_uses">@lang('view_pages.total_uses') <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="total_uses" name="total_uses"
                                                value="{{ old('total_uses',$item->total_uses) }}" required
                                                placeholder="@lang('view_pages.enter') @lang('view_pages.total_uses')">
                                            <span class="text-danger">{{ $errors->first('total_uses') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="uses_per_user">@lang('view_pages.uses_per_user') <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="uses_per_user" name="uses_per_user"
                                                value="{{ old('uses_per_user',$item->uses_per_user) }}" required=""
                                                placeholder="@lang('view_pages.enter') @lang('view_pages.uses_per_user')">
                                            <span class="text-danger">{{ $errors->first('uses_per_user') }}</span>
                                        </div>
                                    </div>
                                </div> -->

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="from">@lang('view_pages.from') <span class="text-danger">*</span></label>
                                            <input class="form-control datepicker" type="text" id="from" name="from"
                                                value="{{ old('from',$item->from_date) }}" required
                                                placeholder="@lang('view_pages.enter') @lang('view_pages.from')" autocomplete="off">
                                            <span class="text-danger">{{ $errors->first('from') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="to">@lang('view_pages.to') <span class="text-danger">*</span></label>
                                            <input class="form-control datepicker" type="text" id="to" name="to"
                                                value="{{ old('to',$item->to_date) }}" required=""
                                                placeholder="@lang('view_pages.enter') @lang('view_pages.to')" autocomplete="off">
                                            <span class="text-danger">{{ $errors->first('to') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="uses_per_user">@lang('view_pages.uses_per_user') <span class="text-danger">*</span></label>
                                            <input class="form-control" type="number" id="uses_per_user" name="uses_per_user" value="{{ old('uses_per_user',$item->uses_per_user) }}" required="" placeholder="@lang('view_pages.enter') @lang('view_pages.uses_per_user')">
                                            <span class="text-danger">{{ $errors->first('uses_per_user') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-12">
                                        <button class="btn btn-primary btn-sm pull-right m-5" type="submit">
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


<script src="{{asset('assets/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>

<script>
    //Date picker
    $('.datepicker').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd',
      startDate: 'today'
    });
   $('.select2').select2({
        placeholder : "Select ...",
    });
</script>
@endsection
