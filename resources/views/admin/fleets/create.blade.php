@extends('admin.layouts.app')

@section('content')

<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="box">

                    <div class="box-header with-border">
                        <a href="{{ url('fleets') }}">
                            <button class="btn btn-danger btn-sm pull-right" type="submit">
                                <i class="mdi mdi-keyboard-backspace mr-2"></i>
                                @lang('view_pages.back')
                            </button>
                        </a>
                    </div>
                
                <div class="col-12">
                <form  method="post" action="{{url('fleets/store')}}" enctype="multipart/form-data">
                @csrf
                    <div class="row">
                        <div class="col-sm-4 float-left mb-md-3">
                            <div class="form-group">
                                <label for="type">@lang('view_pages.select_owner')<span class="text-danger">*</span></label>
                                <select name="owner_id" id="owner_id" class="form-control" required>
                                    <option value="" selected disabled>@lang('view_pages.select_owner')</option>
                                    @foreach ($owner as $key => $owner)
                                        <option value="{{ $owner->user_id }}" {{ old('type') == $owner->id ? 'selected' : '' }}>
                                            {{ $owner->name }}</option>
                                    @endforeach
                                </select>
                                 <span class="text-danger">{{ $errors->first('owner_id') }}</span>

                            </div>
                        </div>
                        <div class="col-sm-4 float-left mb-md-3">
                            <div class="form-group">
                                <label for="type">@lang('view_pages.select_type')<span class="text-danger">*</span></label>
                                <select name="type" id="type" class="form-control" required>
                                    <option value="" selected disabled>@lang('view_pages.select_type')</option>
                                    @foreach ($types as $key => $type)
                                        <option value="{{ $type->id }}" {{ old('type') == $type->id ? 'selected' : '' }} 
                                            data-seat="{{ $type->capacity }}"
                                            data-luggage="{{ $type->luggage_capacity }}">
                                            {{ $type->name }}</option>
                                    @endforeach
                                </select>
                                 <span class="text-danger">{{ $errors->first('type') }}</span>

                            </div>
                        </div>

                       <div class="col-sm-4 float-left mb-md-3">
                            <div class="form-group">
                                <label for="custom_make">@lang('view_pages.car_brand')<span class="text-danger">*</span></label>
                                <input id="custom_make" name="custom_make" placeholder="{{ trans('view_pages.car_brand')}}" type="text" class="form-control" value="{{ old('custom_make') }}" required>
                            </div>
                        </div>

                         <div class="col-sm-4 float-left mb-md-3">
                            <div class="form-group">
                                <label for="custom_model">@lang('view_pages.car_model')<span class="text-danger">*</span></label>
                                <input id="custom_model" name="custom_model" placeholder="{{ trans('view_pages.car_model')}}" type="text" class="form-control" value="{{ old('custom_model') }}" required>
                            </div>
                        </div>

                     
                        <div class="col-sm-6 float-left mb-md-3">
                            <div class="form-group">
                                <label for="license_number">{{ trans('view_pages.license_number')}}<span class="text-danger">*</span></label>
                                <input id="license_number" name="license_number" placeholder="{{ trans('view_pages.license_number')}}" type="text" class="form-control" value="{{ old('license_number') }}" required>
                                <span class="text-danger">{{ $errors->first('license_number') }}</span>
                            </div>
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


<script src="{{ asset('styles/js/jquery.js') }}"></script>
<script>
    $(document).ready(function() {
        $(document).on('change', '.btn-file :file', function() {
            var input = $(this),
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [label]);
        });

        $('.btn-file :file').on('fileselect', function(event, label) {

            var input = $(this).parents('.input-group').find(':text'),
                log = label;

            if (input.length) {
                input.val(log);
            } else {
                if (log) alert(log);
            }

        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $(input).closest('div').parent().find('.img-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $(".imgInp").change(function() {
            readURL(this);
        });

         
    });


   let oldCarMake = "{{ old('brand') }}";
    let oldCarModel = "{{ old('model') }}";

    if(oldCarMake){
        getCarModel(oldCarMake,oldCarModel);
    }

    function getCarModel(value,model=''){
        var selected = '';
        $.ajax({
            url: "{{ route('getCarModel') }}",
            type:  'GET',
            data: {
                'car_make': value,
            },
            success: function(result)
            {
                $('#car_model').empty();
                $("#car_model").append('<option value="" selected disabled>Select</option>');
                result.forEach(element => {

                    if(model == element.id){
                        selected = 'selected';
                    }else{
                        selected='';
                    }

                    $("#car_model").append('<option value='+element.id+' '+selected+'>'+element.name+'</option>')
                });
                $('#car_model').select();
            }
        });
    }

    $(document).on('change','#brand',function(){
        getCarModel($(this).val());
    });
</script>
@endsection
