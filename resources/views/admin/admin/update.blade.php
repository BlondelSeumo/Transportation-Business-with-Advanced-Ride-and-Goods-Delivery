@extends('admin.layouts.app')
@section('title', 'Main page')

@section('content')

<!-- Start Page content -->
<div class="content">
<div class="container-fluid">
    @if($errors)
    @foreach ($errors->all() as $error)
       <div>{{ $error }}</div>
   @endforeach
 @endif
<div class="row">
<div class="col-sm-12">
    <div class="box">
        <div class="box-header with-border">
            <a href="{{url('admins')}}">
                <button class="btn btn-danger btn-sm pull-right" type="submit">
                    <i class="mdi mdi-keyboard-backspace mr-2"></i>
                    @lang('view_pages.back')
                </button>
            </a>
        </div>

<div class="col-sm-12">

<form  method="post" class="form-horizontal" action="{{url('admins/update',$item->id)}}" enctype="multipart/form-data">
{{csrf_field()}}

<div class="row">
    <div class="col-6">
    <div class="form-group">
    <label for="role">@lang('view_pages.select_role')
        <span class="text-danger">*</span>
    </label>
    <select name="role" id="role" class="form-control" onchange="getServiceLocation(this)" required>
        <option value="" selected disabled>@lang('view_pages.select_role')</option>
        @foreach($roles as $key=>$role)
        <option value="{{$role->slug}}" {{ old('role',$item->user->roles[0]->slug) == $role->slug ? 'selected' : '' }}>
                    @if($role->name == 'Dispatcher')
                    {{ "Taxi Dispatcher" }}
                    @else
                    {{$role->name}}
                    @endif
        </option>
        @endforeach
    </select>
    </div>
    </div>

    <div class="col-6" id="serviceLocation" style="display:none">
    <div class="form-group">
    <label for="admin_id">@lang('view_pages.select_area')
        <span class="text-danger">*</span>
    </label>
    <select name="service_location_id" id="service_location_id" class="form-control">
        <option value="" selected disabled>@lang('view_pages.select_area')</option>
        @foreach($services as $key=>$service)
        <option value="{{$service->id}}" {{ old('service_location_id',$item->service_location_id) == $service->id ? 'selected' : '' }}>{{$service->name}}</option>
        @endforeach
    </select>
    </div>
</div>
</div>

<div class="row">
        <div class="col-sm-6">
            <div class="form-group">
            <label for="first_name">@lang('view_pages.name') <span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="first_name" name="first_name" value="{{old('first_name',$item->first_name)}}" required="" placeholder="@lang('view_pages.enter_first_name')">
            <span class="text-danger">{{ $errors->first('first_name') }}</span>

        </div>
    </div>
         <!-- <div class="col-sm-6">
            <div class="form-group">
            <label for="last_name">@lang('view_pages.last_name') <span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="last_name" name="last_name" value="{{old('last_name',$item->last_name)}}" required="" placeholder="@lang('view_pages.enter_last_name')">
            <span class="text-danger">{{ $errors->first('last_name') }}</span>

        </div>
    </div>
</div> -->

<!-- <div class="row"> -->
     <div class="col-sm-6">
            <div class="form-group">
            <label for="address">@lang('view_pages.address') <span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="address" name="address" value="{{old('address',$item->address)}}" required="" placeholder="@lang('view_pages.enter_address')">
            <span class="text-danger">{{ $errors->first('address') }}</span>

        </div>
    </div>
</div>

<div class="row">
       <div class="col-sm-6">
            <div class="form-group">
            <label for="name">@lang('view_pages.mobile') <span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="mobile" name="mobile" value="{{old('mobile',$item->mobile)}}" required="" placeholder="@lang('view_pages.enter_mobile')">
            <span class="text-danger">{{ $errors->first('mobile') }}</span>

        </div>
    </div>

    <div class="col-sm-6">
            <div class="form-group">
            <label for="email">@lang('view_pages.email') <span class="text-danger">*</span></label>
            <input class="form-control" type="email" id="email" name="email" value="{{old('email',$item->email)}}" required="" placeholder="@lang('view_pages.enter_email')">
            <span class="text-danger">{{ $errors->first('email') }}</span>

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
    <option value="" selected disabled>@lang('view_pages.select_country')</option>
    @foreach($countries as $key=>$country)
    <option value="{{$country->id}}" {{ old('country',$item->country) == $country->id ? 'selected' : '' }}>{{$country->name}}</option>
    @endforeach
</select>
</div>
</div>

  <div class="col-sm-6">
            <div class="form-group">
            <label for="state">@lang('view_pages.state') <span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="state" name="state" value="{{old('state',$item->state)}}" required="" placeholder="@lang('view_pages.enter_state')">
            <span class="text-danger">{{ $errors->first('state') }}</span>

        </div>
    </div>
</div>

<div class="row">
      <div class="col-sm-6">
            <div class="form-group">
            <label for="city">@lang('view_pages.city') <span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="city" name="city" value="{{old('city',$item->city)}}" required="" placeholder="@lang('view_pages.enter_city')">
            <span class="text-danger">{{ $errors->first('city') }}</span>

        </div>
    </div>
       <div class="col-sm-6">
            <div class="form-group">
            <label for="postal_code">@lang('view_pages.postal_code') <span class="text-danger">*</span></label>
            <input class="form-control" type="number" min="1" id="city" name="postal_code" value="{{old('postal_code',$item->pincode)}}" required="" placeholder="@lang('view_pages.enter_postal_code')">
            <span class="text-danger">{{ $errors->first('postal_code') }}</span>

        </div>
    </div>
</div>
<div class="row">
      <div class="col-sm-6">
         <div class="form-group">
            <label for="password">@lang('view_pages.password') <span class="text-danger">*</span></label>
            <input class="form-control" type="password" id="password" name="password" value="{{old('password',$item->password)}}" required="" placeholder="@lang('view_pages.enter_password')">
            <span class="text-danger">{{ $errors->first('password') }}</span>

        </div>
    </div>
       <div class="col-sm-6">
          <div class="form-group">
            <label for="password_confrim">@lang('view_pages.confirm_password') <span class="text-danger">*</span></label>
            <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" value="{{old('password_confirmation',$item->password)}}" required="" placeholder="@lang('view_pages.enter_password_confirmation')">
            <span class="text-danger">{{ $errors->first('password') }}</span>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="col-6">
        <label for="profile_picture">@lang('view_pages.profile')</label><br>
        <img id="blah" src="{{ $item->user->profile_picture }}" alt=""><br>
        <input type="file" id="profile_picture" onchange="readURL(this)" name="profile_picture" style="display:none">
        <button class="btn btn-primary btn-sm" type="button" onclick="$('#profile_picture').click()" id="upload">@lang('view_pages.browse')</button>
        <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;">@lang('view_pages.remove')</button><br>
        <span class="text-danger">{{ $errors->first('profile_picture') }}</span>
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

<script>
    $(function() {
        var role = $('#role').val();

        if(role == 'super-admin'){
            $('#serviceLocation').css('display','none');
            $('#service_location_id').prop('required',false);
        }
        else{
            $('#serviceLocation').css('display','block');
            $('#service_location_id').prop('required',true);
        }
    });

    function getServiceLocation(details){
        var role = details.value;

        if(role == 'super-admin'){
            $('#serviceLocation').css('display','none');
            $('#service_location_id').prop('required',false);
        }
        else{
            $('#serviceLocation').css('display','block');
            $('#service_location_id').prop('required',true);
        }
    }
</script>

@endsection

