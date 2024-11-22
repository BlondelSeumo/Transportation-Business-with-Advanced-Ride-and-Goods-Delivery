@extends('admin.layouts.app')

@section('content')


<div class="row p-0 m-0">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form  method="post" action="{{url('fleets/update',$item->id)}}" enctype="multipart/form-data">
                @csrf
                    <div class="row">
                        <div class="col-sm-4 float-left mb-md-3">
                            <div class="form-group">
                                <label for="type">@lang('view_pages.select_type')<span class="text-danger">*</span></label>
                                <select name="type" id="type" class="form-control" required>
                                    <option value="" selected disabled>@lang('view_pages.select_type')</option>
                                    @foreach ($types as $key => $type)
                                        <option value="{{ $type->id }}" {{ old('type',$item->vehicle_type) == $type->id ? 'selected' : '' }} >{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                       <div class="col-sm-4 float-left mb-md-3">
                            <div class="form-group">
                                <label for="custom_make">@lang('view_pages.car_brand')<span class="text-danger">*</span></label>
                                <input id="custom_make" name="custom_make" placeholder="{{ trans('view_pages.car_brand')}}" type="text" class="form-control" value="{{ $type->car_make_name }}" required>
                            </div>
                        </div>

                         <div class="col-sm-4 float-left mb-md-3">
                            <div class="form-group">
                                <label for="custom_model">@lang('view_pages.car_model')<span class="text-danger">*</span></label>
                                <input id="custom_model" name="custom_model" placeholder="{{ trans('view_pages.car_model')}}" type="text" class="form-control" value="{{ $type->car_model_name }}" required>
                            </div>
                        </div>

                        <div class="col-sm-6 float-left mb-md-3">
                            <div class="form-group">
                                <label for="license_number">{{ trans('view_pages.license_number')}}<span class="mandatory">*</span></label>
                                <input id="license_number" name="license_number" placeholder="{{ trans('view_pages.license_number')}}" type="text" class="form-control" value="{{ old('license_number',$item->license_number) }}" required>
                                <span class="text-danger">{{ $errors->first('license_number') }}</span>
                            </div>
                        </div>

                        <div class="col-12 btn-group mt-3">
                                    <button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">{{ trans('view_pages.update')}}</button>
                        </div>
                    </div>
                </form>
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

        getCarModel("{{ $item->brand }}","{{ $item->model }}");
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
