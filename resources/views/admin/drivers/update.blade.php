@extends('admin.layouts.app')
@section('title', 'Main page')


@section('content')
  <link rel="stylesheet" href="{{ asset('assets/build/css/intlTelInput.css') }}">
  <!-- Start Page content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="box">

                        <div class="box-header with-border">
                            <a href="{{ url('drivers') }}">
                                <button class="btn btn-danger btn-sm pull-right" type="submit">
                                    <i class="mdi mdi-keyboard-backspace mr-2"></i>
                                    @lang('view_pages.back')
                                </button>
                            </a>
                        </div>

                        <div class="col-sm-12">

                            <form method="post" id="driverUpdate"  class="form-horizontal" action="{{ url('drivers/update', $item->id) }}"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="admin_id">@lang('view_pages.select_area')
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="service_location_id" id="service_location_id" class="form-control"
                                                onchange="getypesAndCompanys()" required>
                                                <option value="" selected disabled>@lang('view_pages.select_area')</option>
                                                @foreach ($services as $key => $service)
                                                    <option value="{{ $service->id }}"
                                                        {{ old('service_location_id', $item->service_location_id) == $service->id ? 'selected' : '' }}>
                                                        {{ $service->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="name">@lang('view_pages.name') <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="name" name="name"
                                                value="{{ old('name', $item->name) }}" required=""
                                                placeholder="@lang('view_pages.enter_name')">
                                            <span class="text-danger">{{ $errors->first('name') }}</span>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                <div class="col-6">
                                    @if(env('APP_FOR')=='demo')
                                        <div class="form-group">
                                            <label for="name">@lang('view_pages.mobile') <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="mobile" name="mobile"
                                                value="{{ old('mobile', "********") }}" required=""
                                                placeholder="@lang('view_pages.enter_mobile')">
                                            <input type="hidden" value="{{$item->country ? $item->countryDetail->code : get_settings('default_country_code_for_mobile_app')}}" id="dial_code">
                                            <span class="text-danger">{{ $errors->first('mobile') }}</span>

                                        </div>
                                    @else
                                        <div class="form-group">
                                            <label for="name">@lang('view_pages.mobile') <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="mobile" name="mobile"
                                                value="{{ old('mobile', $item->mobile) }}" required=""
                                                placeholder="@lang('view_pages.enter_mobile')">
                                            <input type="hidden" value="{{$item->country ? $item->countryDetail->code : get_settings('default_country_code_for_mobile_app')}}" id="dial_code">
                                            <span class="text-danger">{{ $errors->first('mobile') }}</span>

                                        </div>
                                    @endif
                                    </div>

                                    <div class="col-sm-6">
                                        @if(env('APP_FOR')=='demo')
                                            <div class="form-group">
                                                <label for="email">@lang('view_pages.email') <span class="text-danger">*</span></label>
                                                <input class="form-control" type="email" id="email" name="email"
                                                    value="{{ old('email', "******************") }}" required=""
                                                    placeholder="@lang('view_pages.enter_email')">
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                            </div>
                                        @else
                                            <div class="form-group">
                                                <label for="email">@lang('view_pages.email') <span class="text-danger">*</span></label>
                                                <input class="form-control" type="email" id="email" name="email"
                                                    value="{{ old('email', $item->email) }}" required=""
                                                    placeholder="@lang('view_pages.enter_email')">
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                            </div>
                                        @endif
                                    </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="password">@lang('view_pages.password')</label>
                                    <input class="form-control" type="password" id="password" value="{{old('password')}}" placeholder="@lang('view_pages.enter_password')">
                                    <span class="text-danger">{{ $errors->first('password') }}</span>

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="password_confrim">@lang('view_pages.confirm_password')</label>
                                    <input class="form-control" type="password" id="password_confirmation" value="{{old('password_confirmation')}}" placeholder="@lang('view_pages.enter_password_confirmation')">
                                    <span class="passErr text-danger">{{ $errors->first('password') }}</span>
                                </div>
                            </div>


                                </div>
                                
                                <div class="row">
                                <div class="col-sm-6">
                                   <div class="form-group">
                                       <label for="">@lang('view_pages.gender') <span class="text-danger">*</span></label>
                                       <select name="gender" id="gender" class="form-control" required>
                                           <option value="" selected disabled>@lang('view_pages.select')</option>
                                           <option value="male" {{ old('gender',$item->gender) == 'male' ? 'selected' : '' }}>@lang('view_pages.male')</option>
                                           <option value="female" {{ old('gender',$item->gender) == 'female' ? 'selected' : '' }}>@lang('view_pages.female')</option>
                                           <option value="others" {{ old('gender',$item->gender) == 'others' ? 'selected' : '' }}>@lang('view_pages.others')</option>
                                       </select>
                                       <span class="text-danger">{{ $errors->first('gender') }}</span>
                                   </div>
                                </div>
                                    @if($app_for !== 'taxi' && $app_for !== 'delivery')
                                <div class="col-sm-6">
                                           <div class="form-group">
                                               <label for="">@lang('view_pages.transport_type') <span class="text-danger">*</span></label>
                                               <select name="transport_type" id="transport_type" class="form-control" required>
                                                   <option value="" selected disabled>@lang('view_pages.select')</option>
                                                   <option value="taxi" {{ $item->transport_type == 'taxi' ? 'selected' : '' }}>@lang('view_pages.taxi')</option>
                                                   <option value="delivery" {{ $item->transport_type == 'delivery' ? 'selected' : '' }}>@lang('view_pages.delivery')</option>
                                                   <option value="both" {{ $item->transport_type == 'both' ? 'selected' : '' }}>@lang('view_pages.both')</option>
                                               </select>
                                               <span class="text-danger">{{ $errors->first('transport_type') }}</span>
                                           </div>
                                       </div>
                                       @endif
                                 <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="type">@lang('view_pages.vehicle_type')
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select name="type[]" id="type" class="form-control select2" multiple="multiple" required>

                                       @foreach($types as $key=>$type)
                                            <option value="{{ $type->id }}" {{ old('type[]', $item->driverVehicleTypeDetail()->Where('vehicle_type', $type->id)->pluck('vehicle_type')->first()) ? 'selected' : '' }}>
                                            {{ $type->name }}</option>
                                       @endforeach
                                       </select>
                                    </div>
                                 </div>
                               </div>
                                <div class="row">
                                 <div class="col-6">
                                        <div class="form-group">
                                            <label for="car_make">@lang('view_pages.car_make')<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="custom_make" name="custom_make" placeholder="@lang('view_pages.custom_make')" required value="{{ $item->custom_make }}">
                                            <span class="text-danger makeErr"></span>
                                        </div>
                                    </div>                            
                                <div class="col-6">
                                        <div class="form-group">
                                            <label for="car_model">@lang('view_pages.car_model')<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="custom_model" name="custom_model" placeholder="@lang('view_pages.custom_model')" required value="{{ $item->custom_model }}">
                                            <span class="text-danger modelErr"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="car_color">@lang('view_pages.car_color') <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="car_color" name="car_color"
                                                value="{{ old('car_color', $item->car_color) }}" required=""
                                                placeholder="@lang('view_pages.enter') @lang('view_pages.car_color')">
                                            <span class="text-danger">{{ $errors->first('car_color') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="car_number">@lang('view_pages.car_number') <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="car_number" name="car_number"
                                                value="{{ old('car_number', $item->car_number) }}" required=""
                                                placeholder="@lang('view_pages.enter') @lang('view_pages.car_number')">
                                            <span class="text-danger">{{ $errors->first('car_number') }}</span>
                                        </div>
                                    </div>
                                </div>
                                    <div class="form-group">
                                    <div class="col-6">
                                        <label for="profile_picture">@lang('view_pages.profile')</label><br>
                         <img class="user-image" id="blah" src="{{asset( $item->user->profile_picture) }}" alt=" "><br>
                                        <input type="file" id="icon" onchange="readURL(this)" name="profile_picture"
                                            style="display:none">
                                        <button class="btn btn-primary btn-sm" type="button" onclick="$('#icon').click()"
                                            id="upload">@lang('view_pages.browse')</button>
                                        <button class="btn btn-danger btn-sm" type="button" id="remove_img"
                                            style="display: none;">@lang('view_pages.remove')</button><br>
                                        <span class="text-danger">{{ $errors->first('icon') }}</span>
                                    </div>
                                </div>
                                
                                </div>
                                


                                <div class="form-group">
                                    <div class="col-12">
                                        <button class="btn btn-primary btn-sm pull-right" type="submit">
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
    <!-- jQuery 3 -->
    <script src="{{ asset('assets/vendor_components/jquery/dist/jquery.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('assets/build/js/intlTelInput.js') }}"></script>

<script>

    let util = '{{ asset('assets/build/js/utils.js') }}';
    var input = document.querySelector("#mobile");
    var default_country = $('#dial_code').val();
    var iti = window.intlTelInput(input, {
        initialCountry: default_country,
        allowDropdown: true,
        separateDialCode: true,
        utilsScript: util,
    });
    $('#driverUpdate').submit(function(e){
        e.preventDefault();
        var formData = $(this).serializeArray();
        if($('#password').val().length > 0 ){
            if($('#password').val() !== $('#password_confirmation').val()){
                $('.passErr').html('Passwords must be identical');
                return false;
            }else{
                $('.passErr').html('');
                formData.push({'name':'password','value': $('#password').val()});
            }
        }
        formData.push({name:'dial_code', value:$('.iti__selected-dial-code').text()});
        $('<input>').attr({
            type: 'hidden',
            name: 'dial_code',
            value: $('.iti__selected-dial-code').text()
        }).appendTo(this);
        $.param(formData);
        $(this).off('submit').submit();
    })
    $(document).ready(function(){

    // Retrieve the initial selected transport_type value
    var initialTransportType = $('#transport_type').val();

    // Perform an initial request to get the corresponding types based on the transport_type value
    getTypesByTransportType(initialTransportType);

    // On change event of transport_type select
    $(document).on('change', '#transport_type', function() {
        var transportType = $(this).val();

        // Call the function to get the types based on the selected transport_type
        getTypesByTransportType(transportType);
    });

    // Function to get types based on the transport_type
    function getTypesByTransportType(transportType) {
        $.ajax({
            url: "{{ route('getType') }}",
            type: 'GET',
            data: {
                'transport_type': transportType,
            },
            success: function(result) {
                var selectedTypes = [];
                
                // Get the selected type values from the type select element
                $('#type').find('option:selected').each(function() {
                    selectedTypes.push($(this).val());
                });

                $('#type').empty();

                result.forEach(element => {
                    var option = $('<option>').val(element.id).text(element.name);

                    // Check if the type value is in the selectedTypes array
                    if (selectedTypes.includes(element.id.toString())) {
                        option.attr('selected', 'selected');
                    }

                    $('#type').append(option);
                });

                $('#type').select2();
            }
        });
    }
});


    $('.select2').select2({
        placeholder : "Select ...",
    });
        $('#is_company_driver').change(function() {
            var value = $(this).val();
            if (value == 1) {
                $('#companyShow').show();
            } else {
                $('#companyShow').hide();
            }
        });

        function getypesAndCompanys() {

            var admin_id = document.getElementById('admin_id').value;
            var ajaxPath = "<?php echo url('types/by/admin'); ?>";
            var ajaxCompanyPath = "<?php echo url('company/by/admin'); ?>";

            $.ajax({
                url: ajaxPath,
                type: 'GET',
                data: {
                    'admin_id': admin_id,
                },
                success: function(result) {
                    $('#type').empty();

                    $("#type").append('<option value="">Select Type</option>');

                    for (var i = 0; i < result.data.length; i++) {
                        console.log(result.data[i]);
                        $("#type").append('<option  class="left" value="' + result.data[i].id +
                            '" data-icon="' + result.data[i].icon + '"  >' + result.data[i].name +
                            '</option>');
                    }

                    $('#type').select();
                },
                error: function() {

                }
            });

            $.ajax({
                url: ajaxCompanyPath,
                type: 'GET',
                data: {
                    'admin_id': admin_id,
                },
                success: function(result) {
                    $('#company').empty();

                    $("#company").append('<option value="">Select Company</option>');
                    $("#company").append('<option value="0">Individual</option>');

                    for (var i = 0; i < result.data.length; i++) {
                        console.log(result.data[i]);
                        $("#company").append('<option  class="left" value="' + result.data[i].id + '" >' +
                            result.data[i].name + '</option>');
                    }

                    $('#company').select();
                },
                error: function() {

                }
            });
        }
        $(document).on('change', '#transport_type', function() {
            let value = $(this).val();

            $.ajax({
                url: "{{ route('getType') }}",
                type: 'GET',
                data: {
                    'transport_type': value,
                },
                success: function(result) {
                    $('#type').empty();
                    // $("#type").append('<option value="" selected disabled>Select</option>');
                    result.forEach(element => {
                        $("#type").append('<option value=' + element.id + '>' + element
                            .name + '</option>')
                    });
                    $('#type').select();
                }
            });
        });
        $(document).on('change', '#type', function() {
            let value = $(this).val();

            $.ajax({
                url: "{{ route('getCarMake') }}",
                type: 'GET',
                data: {
                    'type': value,
                },
                success: function(result) {
                    $('#car_make').empty();
                    $("#car_make").append('<option value="" selected disabled>Select</option>');
                    result.forEach(element => {
                        $("#car_make").append('<option value=' + element.id + '>' + element
                            .name + '</option>')
                    });
                    $('#car_make').select();
                }
            });
        });

        $(document).on('change', '#car_make', function() {
            let value = $(this).val();
            let custom_make = $('#custom_make');
            if(typeof custom_make !== 'undefined'){
                $('label[for="custom_make"]').remove();
                custom_make.remove();
                $
            }

            $.ajax({
                url: "{{ route('getCarModel') }}",
                type: 'GET',
                data: {
                    'car_make': value,
                },
                success: function(result) {
                    $('#car_model').empty();
                    $("#car_model").append('<option value="" selected disabled>Select</option>');
                    result.forEach(element => {
                        $("#car_model").append('<option value=' + element.id + '>' + element
                            .name + '</option>')
                    });
                    $('#car_model').select();
                }
            });
        });
        $('#car_model').change(function(){
            let custom_model = $('#custom_model');
            if(typeof custom_model !== "undefined"){
                $('label[for="custom_model"]').remove();
                custom_model.remove();
            }
        })

    </script>

@endsection
