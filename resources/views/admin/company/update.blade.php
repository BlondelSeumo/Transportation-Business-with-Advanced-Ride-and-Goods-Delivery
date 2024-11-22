@extends('admin.layouts.app')


@section('title', 'Main page')

<!-- Bootstrap fileupload css -->
    <link href="{{asset('plugins/bootstrap-fileupload/bootstrap-fileupload.css')}}" rel="stylesheet"/>
    
    <link href="{{asset('assets/css/bootstrap-imageupload.css')}}" rel="stylesheet">


@section('content')



<!-- Start Page content -->
<div class="content">
<div class="container-fluid">

<div class="row">
<div class="col-sm-12">
    <div class="box">
                            
        <div class="box-header with-border">
            <a href="{{ url('company') }}">
                <button class="btn btn-danger btn-sm pull-right" type="submit">
                    <i class="mdi mdi-keyboard-backspace mr-2"></i>
                    @lang('view_pages.back')
                </button>
            </a>
        </div>

<div class="col-sm-12">

<form  method="post" class="form-horizontal" action="{{url('company/update',$result->id)}}" enctype="multipart/form-data">
{{csrf_field()}}
@if(access()->hasRole('super-admin'))
<div class="col-6">
<div class="form-group">
<label for="admin_id">@lang('view_pages.select_admin')
    <span class="text-danger">*</span>
</label>
<select name="service_location_id" id="service_location_id" class="form-control" required>
    <option value="" >@lang('view_pages.select_admin')</option>
    @foreach($service_location as $key=>$location)

    <option value="{{$location->id}}" {{ old('location',$result->service_location_id) == $location->id ? 'selected' : '' }}>{{$location->name}}</option>

    <option value="{{$location->id}}">{{$location->name}}</option>
    @endforeach
</select>
</div>
</div>
@endif

<div class="row">
        <div class="col-sm-6">
            <div class="form-group">
            <label for="name">@lang('view_pages.name')</label>
            <input class="form-control" type="text" id="name" name="name" value="{{old('name',$result->name)}}" required="" placeholder="@lang('view_pages.enter_name')">
            <span class="text-danger">{{ $errors->first('name') }}</span>

        </div>
    </div>
          <div class="col-sm-6">
            <div class="form-group">
            <label for="owner_name">@lang('view_pages.owner_name')</label>
            <input class="form-control" type="text" id="owner_name" name="owner_name" value="{{old('owner_name',$result->owner_name)}}" required="" placeholder="@lang('view_pages.enter_owner_name')">
            <span class="text-danger">{{ $errors->first('owner_name') }}</span>

        </div>
    </div>
</div>

<div class="row">
       <div class="col-sm-6">
            <div class="form-group">
            <label for="name">@lang('view_pages.mobile')</label>
            <input class="form-control" type="text" id="mobile" name="mobile" value="{{old('mobile',$result->mobile)}}" required="" placeholder="@lang('view_pages.enter_mobile')">
            <span class="text-danger">{{ $errors->first('mobile') }}</span>

        </div>
    </div>

       <div class="col-sm-6">
            <div class="form-group">
            <label for="name">@lang('view_pages.landline')</label>
            <input class="form-control" type="text" id="landline" name="landline" value="{{old('landline',$result->landline)}}" required="" placeholder="@lang('view_pages.enter_landline')">
            <span class="text-danger">{{ $errors->first('landline') }}</span>

        </div>
    </div>
</div>

<div class="row"> 
      <div class="col-sm-6">
            <div class="form-group">
            <label for="email">@lang('view_pages.email')</label>
            <input class="form-control" type="email" id="email" name="email" value="{{old('email',$result->email)}}" required="" placeholder="@lang('view_pages.enter_email')">
            <span class="text-danger">{{ $errors->first('email') }}</span>

        </div>
    </div>
  <div class="col-sm-6">
            <div class="form-group">
            <label for="vat_number">@lang('view_pages.vat_number')</label>
            <input class="form-control" type="number" id="vat_number" name="vat_number" value="{{old('vat_number',$result->vat_number)}}" required="" placeholder="@lang('view_pages.enter_vat_number')">
            <span class="text-danger">{{ $errors->first('vat_number') }}</span>

        </div>
    </div>
</div>

<div class="row">

<div class="col-6">
<div class="form-group">
<label for="country">@lang('view_pages.select_country')
    <span class="text-danger">*</span>
</label>
<select name="country" id="country" class="form-control" required>
    <option value="" >@lang('view_pages.select_country')</option>
    @foreach($countries as $key=>$country)
    <option value="{{$country->id}}" {{ old('country',$result->country) == $country->id ? 'selected' : '' }}>{{$country->name}}</option>
    @endforeach
</select>
</div>
</div>

  <div class="col-sm-6">
            <div class="form-group">
            <label for="state">@lang('view_pages.state')</label>
            <input class="form-control" type="text" id="state" name="state" value="{{old('state',$result->state)}}" required="" placeholder="@lang('view_pages.enter_state')">
            <span class="text-danger">{{ $errors->first('state') }}</span>

        </div>
    </div>
</div>

<div class="row">
      <div class="col-sm-6">
            <div class="form-group">
            <label for="city">@lang('view_pages.city')</label>
            <input class="form-control" type="text" id="city" name="city" value="{{old('city',$result->city)}}" required="" placeholder="@lang('view_pages.enter_city')">
            <span class="text-danger">{{ $errors->first('city') }}</span>

        </div>
    </div>
       <div class="col-sm-6">
            <div class="form-group">
            <label for="postal_code">@lang('view_pages.postal_code')</label>
            <input class="form-control" type="number" id="city" name="postal_code" value="{{old('postal_code',$result->postal_code)}}" required="" placeholder="@lang('view_pages.enter_postal_code')">
            <span class="text-danger">{{ $errors->first('postal_code') }}</span>

        </div>
    </div>
</div>

<div class="row">

      <div class="col-sm-6">
            <div class="form-group">
            <label for="address">@lang('view_pages.address')</label>
            <input class="form-control" type="text" id="address" name="address" value="{{old('address',$result->address)}}" required="" placeholder="@lang('view_pages.enter_address')">
            <span class="text-danger">{{ $errors->first('address') }}</span>

        </div>
    </div>

    <div class="col-12">
<div class="form-group">
    <div class="imageupload panel panel-default">
        <div class="panel-heading clearfix">
            <h5 class="panel-title pull-left">@lang('view_pages.icon')</h5>
        </div>
        <div class="file-tab panel-body">
            <br>
            <label class="btn btn-custom btn-file">
                <span>@lang('view_pages.browse')</span>
                <!-- The file is stored here. -->

                <input name="icon" type="file">
            </label>
            <button type="button" class="btn btn-danger" style="margin-bottom: 0.5rem; display: none;">@lang('view_pages.remove')</button>
        </div>

    </div>
</div>
</div>

</div>

<div class="form-group">
        <div class="col-12">
            <button class="btn btn-primary pull-right mb-10" type="submit">
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


<!-- Bootstrap fileupload js -->
<script src="{{asset('plugins/bootstrap-fileupload/bootstrap-fileupload.js')}}"></script>
<script src="{{asset('assets/js/bootstrap-imageupload.js')}}"></script>
<script>
    var $imageupload = $('.imageupload');
    $imageupload.imageupload();

    $('#imageupload-disable').on('click', function () {
        $imageupload.imageupload('disable');
        $(this).blur();
    })

    $('#imageupload-enable').on('click', function () {
        $imageupload.imageupload('enable');
        $(this).blur();
    })

    $('#imageupload-reset').on('click', function () {
        $imageupload.imageupload('reset');
        $(this).blur();
    });
</script>

@endsection

