@extends('admin.layouts.app')

@section('title', 'Users')

@section('content')
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{!! asset('assets/vendor_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') !!}">
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <style>
        .form-horizontal {
            padding: 2em;
        }

    </style>

    <!-- Start Page content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box">

                    <div class="box-header with-border">
                        <h3>{{ $page }}</h3>
                    </div>

                    <form method="post" class="form-horizontal" action="{{ url('reports/download') }}">
                        @csrf
                        <input type="hidden" name="model" value="Driver">

                        <div class="row">
                            @if($app_for == "super" || $app_for == "bidding")                        
                            <div class="col-md-6">
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
                            </div><div class="col-md-6"></div>
                            @endif
                             <div class="col-md-12" >
                                <div class="row">
                                <div class="form-group col-lg-6">
                                    <label for="vehicle_type">@lang('view_pages.vehicle_type')</label>
                                    <select name="vehicle_type" id="vehicle_type" class="form-control select2" multiple="multiple" required>
                                        @if($app_for == "taxi" || $app_for == "delivery")
                                        @foreach($vehicletype as $key=> $type)
                                        <option value="{{$type->id}}">{{$type->name}}</option>
                                        @endforeach
                                        @else
                                        <option value="" selected disabled>@lang('view_pages.select_vehicle_type')</option>
                                        @endif
                                    </select>
                                    <span class="vehicleErr text-danger">{{ $errors->first('vehicle_type') }}</span>
                                </div>
                                <div class="form-group col-lg-6" >
                                    <input class="form-control" type="checkbox" id="all_vehicle_type" name="all_vehicle_type" value="all_vehicle_type" checked>
                                    <label for="all_vehicle_type" style="    margin: 30px;">@lang('view_pages.all_vehicle_types')</label>
                                </div>
                                </div>
                            </div>
                            <!-- 
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="status">@lang('view_pages.status')</label>
                                    <select name="active" id="active" class="form-control" required>
                                        <option value="" selected disabled>@lang('view_pages.select_status')</option>
                                        <option value="1">@lang('view_pages.active')</option>
                                        <option value="0">@lang('view_pages.inactive')</option>
                                    </select>
                                    <span class="text-danger">{{ $errors->first('active') }}</span>
                                </div>
                            </div>
 -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="status">@lang('view_pages.approve_status')</label>
                                    <select name="approve" id="approve" class="form-control" required>
                                        <option value="" selected disabled>@lang('view_pages.select_status')</option>
                                        <option value="1">@lang('view_pages.approved')</option>
                                        <option value="0">@lang('view_pages.disapproved')</option>
                                    </select>
                                    <span class="text-danger">{{ $errors->first('approve') }}</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date_option">@lang('view_pages.date_option')</label>
                                    <select name="date_option" id="date_option" class="form-control">
                                        <option value="date">@lang('view_pages.date')</option>
                                        <option value="today">@lang('view_pages.today')</option>
                                        <option value="week">@lang('view_pages.week')</option>
                                        <option value="month">@lang('view_pages.month')</option>
                                        <option value="year">@lang('view_pages.year')</option>
                                    </select>
                                    <span class="text-danger">{{ $errors->first('date_option') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6 dateDiv">
                                <div class="form-group">
                                    <label for="from">@lang('view_pages.from') <span class="text-danger">*</span></label>
                                    <input class="form-control datepicker" type="text" id="from" name="from"
                                        value="{{ old('from') }}" required
                                        placeholder="{{ now()->startOfMonth()->format('Y-m-d') }}" autocomplete="off">
                                    <span class="text-danger">{{ $errors->first('from') }}</span>
                                </div>
                            </div>

                            <div class="col-md-6 dateDiv">
                                <div class="form-group">
                                    <label for="to">@lang('view_pages.to') <span class="text-danger">*</span></label>
                                    <input class="form-control datepicker" type="text" id="to" name="to"
                                        value="{{ old('to') }}" required placeholder="{{ now()->format('Y-m-d') }}"
                                        autocomplete="off">
                                    <span class="text-danger">{{ $errors->first('to') }}</span>
                                </div>
                            </div>
                            @php 
                            @endphp

                           

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="format">@lang('view_pages.download_format') <span
                                            class="text-danger">*</span></label>
                                    <select name="format" id="format" class="form-control" required>
                                        <option value="" selected disabled>@lang('view_pages.select_format')</option>
                                        @foreach ($formats as $format)
                                            <option value="{{ $format }}">{{ $format }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">{{ $errors->first('format') }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-12">
                                <button class="btn btn-primary btn-sm pull-right submit" type="button">
                                    @lang('view_pages.download')
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('assets/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}">
    </script>

    <script>
        //Date picker
        $('.datepicker').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd',
            endDate: 'today'
        });

        $(document).on('change', '#vehicle_type', function(){
            var val = $(this).val();
            if(val && val.length > 0){
                if($('#all_vehicle_type').is(':checked')){
                    $('#all_vehicle_type').click();
                }
            }else{
                if(!$('#all_vehicle_type').is(':checked')){
                    $('#all_vehicle_type').click();
                }
            }
        })
        $(document).on('change', '#date_option', function() {
            dateOption();
        });

       $('.select2').select2({
            placeholder : "Select ...",
        });
        $(document).on('click', '.submit', function(e) {

            var validate = validateForm();

            if (validate) {
                let query = '?';
                var vehicle_type = $('#vehicle_type');

                if(vehicle_type.val().length == 0 && !$('#all_vehicle_type').is(':checked')){
                    $('.vehicleErr').html('PLease Select Vehicle Type');
                    return false;
                }else{
                    $('.vehicleErr').html('');
                    var types = '';
                    if(!$('#all_vehicle_type').is(':checked')){
                        types = vehicle_type.val();
                    query += 'vehicle_type='+ types+'&';
                    }
                }
                let filterColumn = ['date_option', 'approve'];

                var from = $('#from').val();
                var to = $('#to').val();

                $.each(filterColumn, function(index, value) {
                    var val = $('#' + value).val();

                    if (value == 'date_option') {
                        if (val == 'date') {
                            val = from + '<>' + to;
                        }
                    }
                    if (val != null && val != '') {
                        query += value + '=' + val + '&';
                    }
                });

                let url = '{{ url('reports/download') }}';
                let searchUrl = url + query;

                $.ajax({
                    url: searchUrl,
                    data: $('form').serialize(),
                    method: 'post',
                    success: function(res) {
                        $('form').trigger("reset");
                        dateOption();
                        window.location = res;
                    }
                });
            }
        });

        function validateForm() {
            let validateEle = ['date_option', 'format'];
            var returnVar = true;

            $.each(validateEle, function(i, ele) {
                if (ele == 'date_option') {
                    if ($('#' + ele).val() == 'date') {
                        if ($('#from').val() == '' || $('#from').val() == null) {
                            $('#from').next().text('The Field is required');
                            $('#to').next().text('The Field is required');
                            returnVar = false;
                        } else {
                            $('#from').next().text('');
                            $('#to').next().text('');
                        }
                    } else {
                        $('#from').next().text('');
                        $('#to').next().text('');
                    }
                } else {
                    ele = $('#' + ele);

                    if (ele.val() == '' || ele.val() == null) {
                        ele.next().text('The Field is required');
                        returnVar = false;
                    } else {
                        ele.next().text('');
                    }
                }
            });

            return returnVar;
        }

        function dateOption() {
            var option = $('#date_option').val();

            if (option == 'date') {
                $('.dateDiv').show();
                $('#from').attr('required', true);
                $('#to').attr('required', true);
            } else {
                $('.dateDiv').hide();
                $('#from').attr('required', false);
                $('#to').attr('required', false);
            }
        }

    </script>


<!-- jQuery 3 -->
    <script src="{{asset('assets/vendor_components/jquery/dist/jquery.js')}}"></script>
<script>
@if($app_for == "super" || $app_for == "bidding")
    let oldTransportType = "{{ old('transport_type') }}";

    function getType(value,model=''){
        var selected = '';
        $.ajax({
            url: "{{ route('getType') }}",
            type:  'GET',
            data: {
                'transport_type': value,
            },
            success: function(result)
            {
                $('#vehicle_type').empty();
                $("#vehicle_type").append('<option value="" selected disabled>Select</option>');
                result.forEach(element => {

                    $("#vehicle_type").append('<option value='+element.id+' '+selected+'>'+element.name+'</option>')
                });
                $('#vehicle_type').select();
            }
        });
        // alert("count==="+count);
    }

    $(document).on('change','#transport_type',function(){
        getType($(this).val());
    });

@endif
</script>

@endsection
