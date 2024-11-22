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
                        <a href="{{ url('company/drivers') }}">
                            <button class="btn btn-danger btn-sm pull-right" type="submit">
                                <i class="mdi mdi-keyboard-backspace mr-2"></i>
                                @lang('view_pages.back')
                            </button>
                        </a>
                    </div>

                    <div class="col-sm-12">

                        <form method="post" class="form-horizontal" action="{{url('company/drivers/store')}}" enctype="multipart/form-data">
                            {{csrf_field()}}

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="name">@lang('view_pages.name') <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" id="name" name="name" value="{{old('name')}}" required="" placeholder="@lang('view_pages.enter_name')">
                                        <span class="text-danger">{{ $errors->first('name') }}</span>

                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="gender">@lang('view_pages.gender')
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select name="gender" id="gender" class="form-control" required>
                                            <option value="">@lang('view_pages.select_gender')</option>
                                            <option value='male' {{ old('gender') == 'male' ? 'selected' : '' }}>@lang('view_pages.male')</option>
                                            <option value='female' {{ old('gender') == 'female' ? 'selected' : '' }}>@lang('view_pages.female')</option>
                                            <option value='others' {{ old('gender') == 'others' ? 'selected' : '' }}>@lang('view_pages.others')</option>
                                        </select>
                                        <span class="text-danger">{{ $errors->first('gender') }}</span>

                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="address">@lang('view_pages.address')</label>
                                        <input class="form-control" type="text" id="address" name="address" value="{{old('address')}}" required="" placeholder="@lang('view_pages.enter_address')">
                                        <span class="text-danger">{{ $errors->first('address') }}</span>

                                    </div>
                                </div>
 <div class="col-sm-6">
           <div class="form-group">
               <label for="">@lang('view_pages.transport_type') <span class="text-danger">*</span></label>
               <select name="transport_type" id="transport_type" class="form-control" required>
                   <option value="" selected disabled>@lang('view_pages.select')</option>
                   <option value="taxi" {{ old('transport_type') == 'taxi' ? 'selected' : '' }}>@lang('view_pages.taxi')</option>
                   <option value="delivery" {{ old('transport_type') == 'delivery' ? 'selected' : '' }}>@lang('view_pages.delivery')</option>
                   <option value="rental" {{ old('transport_type') == 'rental' ? 'selected' : '' }}>@lang('view_pages.rental')</option>
                   <option value="both" {{ old('transport_type') == 'both' ? 'selected' : '' }}>@lang('view_pages.all')</option>
               </select>
               <span class="text-danger">{{ $errors->first('transport_type') }}</span>
           </div>
       </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="name">@lang('view_pages.mobile') <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" id="mobile" name="mobile" value="{{old('mobile')}}" required="" placeholder="@lang('view_pages.enter_mobile')">
                                        <span class="text-danger">{{ $errors->first('mobile') }}</span>

                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="email">@lang('view_pages.email') <span class="text-danger">*</span></label>
                                        <input class="form-control" type="email" id="email" name="email" value="{{old('email')}}" required="" placeholder="@lang('view_pages.enter_email')">
                                        <span class="text-danger">{{ $errors->first('email') }}</span>

                                    </div>
                                </div>
                            </div>

                           <!--  <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password">@lang('view_pages.password') <span class="text-danger">*</span></label>
                                        <input class="form-control" type="password" id="password" name="password" value="{{old('password')}}" required="" placeholder="@lang('view_pages.enter_password')">
                                        <span class="text-danger">{{ $errors->first('password') }}</span>

                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password_confrim">@lang('view_pages.confirm_password') <span class="text-danger">*</span></label>
                                        <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" value="{{old('password_confirmation')}}" required="" placeholder="@lang('view_pages.enter_password_confirmation')">
                                        <span class="text-danger">{{ $errors->first('password') }}</span>

                                    </div>
                                </div>
                            </div> -->

                            <div class="row">

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="country">@lang('view_pages.select_country')
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select name="country" id="country" class="form-control" required>
                                            <option value="">@lang('view_pages.select_country')</option>
                                            @foreach($countries as $key=>$country)
                                            <option value="{{$country->id}}" {{ old('country') == $country->id ? 'selected' : '' }}>{{$country->name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">{{ $errors->first('country') }}</span>

                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="state">@lang('view_pages.state')</label>
                                        <input class="form-control" type="text" id="state" name="state" value="{{old('state')}}" required="" placeholder="@lang('view_pages.enter_state')">
                                        <span class="text-danger">{{ $errors->first('state') }}</span>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="city">@lang('view_pages.city')</label>
                                        <input class="form-control" type="text" id="city" name="city" value="{{old('city')}}" required="" placeholder="@lang('view_pages.enter_city')">
                                        <span class="text-danger">{{ $errors->first('city') }}</span>

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="postal_code">@lang('view_pages.postal_code')</label>
                                        <input class="form-control" type="number" id="city" name="postal_code" value="{{old('postal_code')}}" required="" placeholder="@lang('view_pages.enter_postal_code')">
                                        <span class="text-danger">{{ $errors->first('postal_code') }}</span>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- <div class="col-6">
                                        <div class="form-group">
                                        <label for="type">@lang('view_pages.select_type')
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select name="type" id="type" class="form-control" required>
                                            <option value="" >@lang('view_pages.select_type')</option>
                                            @foreach($types as $key=>$type)
                                            <option value="{{$type->id}}" {{ old('type') == $type->id ? 'selected' : '' }}>{{$type->name}}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                        </div> -->

                                <!-- <div class="col-6">
                                    <div class="form-group">
                                        <label for="car_make">@lang('view_pages.car_make')<span class="text-danger">*</span></label>
                                        <select name="car_make" id="car_make" class="form-control select2" required>
                                            <option value="" selected disabled>@lang('view_pages.select')</option>
                                            @foreach($carmake as $key=>$make)
                                            <option value="{{$make->id}}" {{ old('car_make') == $make->id ? 'selected' : '' }}>{{$make->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="car_model">@lang('view_pages.car_model')<span class="text-danger">*</span></label>
                                        <select name="car_model" id="car_model" class="form-control select2" required>
                                            <option value="" selected disabled>@lang('view_pages.select')</option>
                                        </select>
                                    </div>
                                </div> -->

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="car_color">@lang('view_pages.car_color') <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" id="car_color" name="car_color" value="{{old('car_color')}}" required="" placeholder="@lang('view_pages.enter') @lang('view_pages.car_color')">
                                        <span class="text-danger">{{ $errors->first('car_color') }}</span>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="car_number">@lang('view_pages.car_number') <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" id="car_number" name="car_number" value="{{old('car_number')}}" required="" placeholder="@lang('view_pages.enter') @lang('view_pages.car_number')">
                                        <span class="text-danger">{{ $errors->first('car_number') }}</span>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-6">
                                    <label for="icon">@lang('view_pages.profile')</label><br>
                                    <img id="blah" src="#" alt=""><br>
                                    <input type="file" id="icon" onchange="readURL(this)" name="icon" style="display:none">
                                    <button class="btn btn-primary btn-sm" type="button" onclick="$('#icon').click()" id="upload">@lang('view_pages.browse')</button>
                                    <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;">@lang('view_pages.remove')</button><br>
                                    <span class="text-danger">{{ $errors->first('icon') }}</span>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-12">
                                    <button class="btn btn-primary btn-sm m-5 pull-right" type="submit">
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
<script src="{{asset('assets/vendor_components/jquery/dist/jquery.js')}}"></script>
<script>
   
</script>

@endsection