@extends('admin.layouts.app')
@section('title', 'Main page')

@section('content')
{{-- {{session()->get('errors')}} --}}

    <!-- Start Page content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="box">

                        <div class="box-header with-border">
                            <a href="{{ url('carmodel') }}">
                                <button class="btn btn-danger btn-sm pull-right" type="submit">
                                    <i class="mdi mdi-keyboard-backspace mr-2"></i>
                                    @lang('view_pages.back')
                                </button>
                            </a>
                        </div>

                        <div class="col-sm-12">
                            <form method="post" class="form-horizontal" action="{{ url('carmodel/store') }}">
                                @csrf
                        <div class="row">
                             <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">@lang('view_pages.transport_type') <span class="text-danger">*</span></label>
                                            <select name="transport_type" id="transport_type" class="form-control" required>
                                                <option value="" selected disabled>@lang('view_pages.select')</option>
                                                <option value="taxi" {{ old('transport_type') == 'taxi' ? 'selected' : '' }}>@lang('view_pages.taxi')</option>
                                                <option value="delivery" {{ old('transport_type') == 'delivery' ? 'selected' : '' }}>@lang('view_pages.delivery')</option>
                                                <option value="both" {{ old('transport_type') == 'both' ? 'selected' : '' }}>@lang('view_pages.both')</option>
                                            </select>
                                            <span class="text-danger">{{ $errors->first('transport_type') }}</span>
                                        </div>
                                    </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="make_id">@lang('view_pages.vehicle_make')<span class="text-danger">*</span></label>
                                            <select name="make_id" id="make_id" class="form-control select2" data-placeholder="@lang('view_pages.select_car_make')"
                                                required>
                                                    <option value="" selected disabled>@lang('view_pages.select')</option>
                                                </select>
                                            </div>
                                    </div>
                                                                   
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="name">@lang('view_pages.name') <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="name" name="name"
                                                value="{{ old('name') }}" required=""
                                                placeholder="@lang('view_pages.enter') @lang('view_pages.name')">
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        </div>
                                    </div>
                                <div class="form-group">
                                    <div class="col-12">
                                        <button class="btn btn-primary btn-sm pull-right m-5" type="submit">
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
    <script src="{{asset('assets/vendor_components/jquery/dist/jquery.js')}}"></script>
<script>
    let oldTransportType = "{{ old('transport_type') }}";

    let oldCarMake = "{{ old('car_make') }}";

    if(oldCarMake){
        getCarModel(oldCarMake,oldCarModel);
    }

    $('#is_company_driver').change(function() {
        var value = $(this).val();
        if(value == 1){
            $('#companyShow').show();
        }else{
            $('#companyShow').hide();
        }
    });

    function getypesAndCompany(){

            var admin_id = document.getElementById('admin_id').value;
            var ajaxPath = "<?php echo url('types/by/admin');?>";
            var ajaxCompanyPath = "<?php echo url('company/by/admin');?>";

            $.ajax({
                url: ajaxPath,
                type:  'GET',
                data: {
                    'admin_id': admin_id,
                },
                success: function(result)
                {
                    $('#type').empty();

                    $("#type").append('<option value="">Select Type</option>');

                    for(var i = 0 ; i < result.data.length ; i++)
                    {
                        console.log(result.data[i]);
                        $("#type").append('<option  class="left" value="'+result.data[i].id+'" data-icon="'+result.data[i].icon+'"  >'+result.data[i].name+'</option>');
                    }

                    $('#type').select();
                },
                error: function()
                {

                }
            });

            $.ajax({
                url: ajaxCompanyPath,
                type:  'GET',
                data: {
                    'admin_id': admin_id,
                },
                success: function(result)
                {
                    $('#company').empty();

                    $("#company").append('<option value="">Select Company</option>');
                    $("#company").append('<option value="0">Individual</option>');

                    for(var i = 0 ; i < result.data.length ; i++)
                    {
                        console.log(result.data[i]);
                        $("#company").append('<option  class="left" value="'+result.data[i].id+'" >'+result.data[i].name+'</option>');
                    }

                    $('#company').select();
                },
                error: function()
                {

                }
            });
    }
    function getVehicleMake(value,model=''){
        var selected = '';
        $.ajax({
            url: "{{ route('getVehicleMake') }}",
            type:  'GET',
            data: {
                'transport_type': value,
            },
            success: function(result)
            {
                $('#make_id').empty();
                $("#make_id").append('<option value="" selected disabled>Select</option>');
                result.forEach(element => {

                    $("#make_id").append('<option value='+element.id+' '+selected+'>'+element.name+'</option>')
                });
                $('#make_id').select();
            }
        });
        // alert("count==="+count);
    }

    $(document).on('change','#transport_type',function(){
        getVehicleMake($(this).val());
    });

</script>
@endsection
