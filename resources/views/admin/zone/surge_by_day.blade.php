@extends('admin.layouts.app')
@section('title', 'Main page')
@section('extra-css')
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="{!! asset('assets/vendor_plugins/timepicker/bootstrap-timepicker.min.css') !!}">
@endsection

@section('content')
<!-- Start Page content -->
<div class="content">
<div class="container-fluid">

<div class="row">
<div class="col-sm-12">
    <div class="box">

        <div class="box-header with-border">
            <a href="{{ url('zone') }}">
                <button class="btn btn-danger btn-sm pull-right" type="submit">
                    <i class="mdi mdi-keyboard-backspace mr-2"></i>
                    @lang('view_pages.back')
                </button>
            </a>
        </div>

        <div class="col-sm-12">
        <form method="post" action="{{ url('zone/surge/store', $zone->id) }}">
            @csrf
            @php
             $WeekDays = [
                    'Sunday' => 'Sun',
                    'Monday' => 'Mon',
                    'Tuesday' => 'Tue',
                    'Wednesday' => 'Wed',
                    'Thursday' => 'Thu',
                    'Friday' => 'Fri',
                    'Saturday' => 'Sat',
                ];

            $daysOfWeek = array_intersect_key($WeekDays, [$day => '']);


            @endphp
 
{{-- surge price by day --}}
<div class="row">
    <div class="col-12">
        <div class="box box-solid box-info">
        <div class="box-header with-border">
        <h4 class="box-title">@lang('view_pages.surge')</h4>
        </div>

        <div class="box-body">
            <table class="table" id="surge_table">
                <thead>
                    <th style="width:100px;">@lang('view_pages.day') <span class="text-danger">*</span></th>
                    <th style="width:100px;">@lang('view_pages.from_time') <span class="text-danger">*</span></th>
                    <th style="width:100px;">@lang('view_pages.to_time') <span class="text-danger">*</span></th>
                    <th style="width:100px;">@lang('view_pages.surge_price_in_percentage') <span class="text-danger">*</span></th>
                    <th style="width:100px;">@lang('view_pages.action')</th>
                </thead>
          @if (!$price->isEmpty())
            @foreach ($price as $k => $price_day)
                <tbody class="append_row">
                            <tr>
                                <td>
                                    <div class="bootstrap">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <select name="day[]" class="day form-control">
                                                    @foreach ($daysOfWeek as $day => $label)
                                                        <option value="{{ $day }}" selected>
                                                            {{ $label }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <span class="text-danger">{{ $errors->first('day') }}</span>
                                        </div>
                                    </div>
                                </td>
                               <td>
                                    <div class="bootstrap-timepicker">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                                </div>
                                                <input type="time" name="from_time[]" value="{{ date('H:i', strtotime($price_day->start_time)) }}" class="from_time form-control">
                                            </div>
                                            <span class="text-danger">{{ $errors->first('from_time') }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="bootstrap-timepicker">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                                </div>
                                                <input type="time" name="to_time[]"  value="{{ date('H:i', strtotime($price_day->end_time)) }}" class="to_time form-control">
                                            </div>
                                            <span class="text-danger">{{ $errors->first('to_time') }}</span>
                                        </div>
                                    </div>
                                </td> 
                                <td>
                                    <div class="form-group">
                                            <input class="form-control" type="number" id="name" name="distance_surge[]" value="{{old('distance_surge.'.$k,$price_day->value)}}" required="" placeholder="@lang('view_pages.enter_price')">
                                            <span class="text-danger">{{ $errors->first('distance_surge.0') }}</span>
                                    </div>
                                </td>                                
                                <td>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-success btn-sm add_row"> + </button>
                                        @if($k>0)
                                        <button type="button" class="btn btn-danger btn-sm remove_row"> - </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                      </tbody>

                        @endforeach
                        @else
                <tbody class="append_row">
                            <tr>
                                <td>
                                    <div class="bootstrap">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <select name="day[]" class="day form-control">
                                                    @foreach ($daysOfWeek as $day => $label)
                                                        <option value="{{ $day }}">{{ $label }}</option>
                                                    @endforeach
                                                </select>
                                             </div>
                                            <span class="text-danger">{{ $errors->first('day') }}</span>
                                        </div>
                                    </div>
                                </td>    
                                <td>
                                    <div class="bootstrap-timepicker">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                                </div>
                                                <input type="time" name="from_time[]" value="{{ old('from_time') }}" class="from_time form-control">
                                            </div>
                                            <span class="text-danger">{{ $errors->first('from_time') }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="bootstrap-timepicker">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                                </div>
                                                <input type="time" name="to_time[]" value="{{ old('to_time') }}" class="to_time form-control">
                                            </div>
                                            <span class="text-danger">{{ $errors->first('to_time') }}</span>
                                        </div>
                                    </div>
                                </td>                                                              
                                <td>
                                    <div class="form-group">
                                            <input class="form-control" id="distance_surge" type="number" id="name" name="distance_surge[]" value="{{old('distance_surge.0')}}" required="" placeholder="@lang('view_pages.enter_price')">
                                            <span class="text-danger">{{ $errors->first('distance_surge.0') }}</span>
                                    </div>
                                </td>                                
                                <td>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-success btn-sm add_row"> + </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    @endif
                </table>
            </div>
        </div>
            
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-sm pull-right m-5">{{ __('view_pages.save') }}</button>
                    </div>
                </form>
            </div>
            <!-- END: Form Layout -->
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{asset('assets/vendor_components/moment/min/moment.min.js') }}"></script>

<script>
$(document).ready(function(){
    var time = new Date();
    var H = time.getHours().toString().padStart(2, '0');
    var M = time.getMinutes().toString().padStart(2, '0');
    if($('input[type="time"]').val().length == 0){
        $('input[type="time"]').val(H+":"+M);
    }
})
$(document).on("click", ".add_row", function () {
    //empty field validation
    var emptyFields = false;

    // Check if any input fields are empty or have the "disabled" value
    var inputs = $(this).closest("tr").find('input[type="text"], input[type="number"], select');
    inputs.each(function () {
        if (!$(this).val() || $(this).val() === 'disabled') {
            emptyFields = true;
            return false; // exit the loop early
        }
    });

    if (emptyFields) {
        alert("Please fill in all fields.");
        return;
    }

    //time validation
    var fromTimeInput = $(this).closest("tr").find('.from_time');
    var toTimeInput = $(this).closest("tr").find('.to_time');

    if (fromTimeInput.val() === toTimeInput.val()) {
        alert("From Time and To Time cannot be the same.");
        return;
    }
    if (fromTimeInput.val() > toTimeInput.val()) {
        alert("From Time cannot be after To Time");
        return;
    }

    var table = document.getElementById("surge_table");
    var append_row = "";

    append_row +='<tr>';
    append_row += '<td>\
                        <div class="bootstrap">\
                            <div class="form-group">\
                                <div class="input-group">\
                                    <select name="day[]" class="day form-control">\
                                            @foreach ($daysOfWeek as $day => $label)\
                                            <option value="{{ $day }}">{{ $label }}</option>\
                                            @endforeach\
                                    </select>\
                                 </div>\
                                <span class="text-danger">{{ $errors->first('day') }}</span>\
                            </div>\
                        </div>\
                    </td>';
    append_row += '<td>\
                        <div class="bootstrap-timepicker">\
                            <div class="form-group">\
                                <div class="input-group">\
                                    <div class="input-group-addon">\
                                    <i class="fa fa-clock-o"></i>\
                                    </div>\
                                    <input type="time" name="from_time[]" value="{{ old('from_time') }}" class="from_time form-control">\
                                </div>\
                                <span class="text-danger">{{ $errors->first('from_time') }}</span>\
                            </div>\
                        </div>\
                    </td>';
    append_row += '<td>\
                        <div class="bootstrap-timepicker">\
                            <div class="form-group">\
                                <div class="input-group">\
                                    <div class="input-group-addon">\
                                    <i class="fa fa-clock-o"></i>\
                                    </div>\
                                    <input type="time" name="to_time[]" value="{{ old('to_time') }}" class="to_time form-control">\
                                </div>\
                                <span class="text-danger">{{ $errors->first('to_time') }}</span>\
                            </div>\
                        </div>\
                    </td>';                                
    append_row += '<td>\
                        <div class="form-group">\
                            <input class="form-control" type="number"  id="name" name="distance_surge[]" value="" required="" placeholder="@lang('view_pages.enter_price')">\
                        </div>\
                    </td>';                                
    append_row +='<td>\
                        <div class="form-group">\
                            <button type="button" class="btn btn-success btn-sm add_row"> + </button>\
                            <button type="button" class="btn btn-danger btn-sm remove_row"> - </button>\
                        </div>\
                    </td>\
            </tr>';

    var currentRow = $(this).closest("tr");
    currentRow.after(append_row);
});

$(document).on("click", ".remove_row", function () {
    $(this).closest("tr").remove();
});
</script>
@endsection