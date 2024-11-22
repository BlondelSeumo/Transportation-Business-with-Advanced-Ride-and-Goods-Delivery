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
            <a href="{{ url('service_location') }}">
                <button class="btn btn-danger btn-sm pull-right" type="submit">
                    <i class="mdi mdi-keyboard-backspace mr-2"></i>
                    @lang('view_pages.back')
                </button>
            </a>
        </div>

<div class="col-sm-12">

<form  method="post" class="form-horizontal" action="{{url('service_location/store')}}" enctype="multipart/form-data">
@csrf

    <div class="row">

        <div class="col-sm-6">
            <div class="form-group">
                <label for="country">@lang('view_pages.select_country') <span class="text-danger">*</span></label>
                <select name="country" id="country" class="form-control select2" required>
                    <option value="" selected disabled>@lang('view_pages.select')</option>
                    @foreach($countries as $country)
                    <option value="{{ $country->id }}" {{ old('country') == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                    @endforeach
                </select>
                <span class="text-danger">{{ $errors->first('country') }}</span>

            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
            <label for="name">@lang('view_pages.name') <span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="name" name="name" value="{{old('name')}}" required="" placeholder="@lang('view_pages.enter_name')">
            <span class="text-danger">{{ $errors->first('name') }}</span>

        </div>
    </div>

    <input type="hidden" name="currency_name" id="currency_name">

    <div class="col-sm-6">
            <div class="form-group">
            <label for="currency_code">@lang('view_pages.currency_code') <span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="currency_code" name="currency_code" value="{{old('currency_code')}}" required="" placeholder="@lang('view_pages.enter') @lang('view_pages.currency_code')" list="currency_code_list" autocomplete="off">
            <datalist id="currency_code_list">
                
            </datalist>
            <span class="text-danger">{{ $errors->first('currency_code') }}</span>

        </div>
    </div>

    <div class="col-sm-6">
            <div class="form-group">
            <label for="currency_symbol">@lang('view_pages.currency_symbol') <span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="currency_symbol" name="currency_symbol" value="{{old('currency_symbol')}}" required="" placeholder="@lang('view_pages.enter_currency_symbol')" list="currency_symbol_list" autocomplete="off">
            <datalist id="currency_symbol_list">
                
            </datalist>
            <span class="text-danger">{{ $errors->first('currency_symbol') }}</span>

        </div>
    </div>

    <div class="col-sm-6">
            <div class="form-group">
            <label for="timezone">@lang('view_pages.timezone') <span class="text-danger">*</span></label>
            <select name="timezone" id="timezone" class="form-control select2" required>
                <option value="" selected disabled>@lang('view_pages.select')</option>
                @foreach($timezones as $timezone)
                <option value="{{ $timezone->timezone }}" {{ old('timezone') == $timezone->timezone ? 'selected' : '' }}>{{ $timezone->timezone }}</option>
                @endforeach
            </select>
            <span class="text-danger">{{ $errors->first('timezone') }}</span>

        </div>
    </div>

</div>


    <div class="form-group">
        <div class="col-12">
            <button class="btn btn-primary pull-right btn-sm m-5" type="submit">
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

<script type="text/javascript"> 

// Initialize Select2 for the country dropdown
$('#country').select2();

// Initialize Select2 for the timezone dropdown
$('#timezone').select2();

$(document).on('change','#country',function(e){
    var id = $(this).val();

    $.ajax({
        url: '{{ route("getCurrencyByCountry") }}',
        data: {'id':id},
        method: 'get',
        success: function(res){
            $('#currency_name').val(res.currency_name);
            $('#currency_code').val(res.currency_code);
            $('#currency_symbol').val(res.currency_symbol);
            $('#currency_code_list').html('<option value="'+ res.currency_code +'">'+res.currency_code+'</option>');
            $('#currency_symbol_list').html('<option value="'+ res.currency_symbol +'">'+res.currency_symbol+'</option>');
        }
    });
});
</script>
@endsection
