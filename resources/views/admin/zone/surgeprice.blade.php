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


            <span class="text-danger">@lang('view_pages.note') : @lang('view_pages.please_update_to_save_changes')</span>
        </div>

        <div class="col-sm-12">

            <form  method="post" class="form-horizontal" action="{{url('zone/surge/update',$zone->id)}}" enctype="multipart/form-data">
            @csrf
            <table class="table surgeTable">
                <thead>
                    <th> @lang('view_pages.start_time') <span class="text-danger">*</span></th>
                    <th>@lang('view_pages.end_time') <span class="text-danger">*</span></th>
                    <th> @lang('view_pages.surge_price_in_percentage') <span class="text-danger">*</span></th>
                    <th style="width:100px;">@lang('view_pages.action')</th>
                </thead>
                <tbody class="append_row">
                    @if (!$zone->zoneSurge->isEmpty())
                        @foreach ($zone->zoneSurge as $k => $surgeValue)

                            <tr>
                                <td>
                                    <div class="bootstrap-timepicker">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                                </div>
                                                <input type="text" name="start_time[]" value="{{ old('start_time.'.$k,$surgeValue->from) }}" class="start_time form-control timepicker">
                                            </div>
                                            <span class="text-danger">{{ $errors->first('start_time') }}</span>
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
                                                <input type="text" name="end_time[]" value="{{ old('end_time.'.$k,$surgeValue->to) }}" class="end_time form-control timepicker">
                                            </div>
                                            <span class="text-danger">{{ $errors->first('end_time') }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                            <input class="form-control" type="number" min="1" max="100" id="name" name="price[]" value="{{old('price.'.$k,$surgeValue->value)}}" required="" placeholder="@lang('view_pages.enter_price')">
                                            <span class="text-danger">{{ $errors->first('price.0') }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-success btn-sm add_row"> + </button>
                                        @if ($k != 0)
                                            <button type="button" class="btn btn-danger btn-sm remove_row"> - </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        @if (old('start_time'))
                            @foreach (old('start_time') as $k => $oldValue)
                                <tr>
                                    <td>
                                        <div class="bootstrap-timepicker">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                    <i class="fa fa-clock-o"></i>
                                                    </div>
                                                    <input type="text" name="start_time[]" value="{{ old('start_time.'.$k) }}" class="start_time form-control timepicker">
                                                </div>
                                                <span class="text-danger">{{ $errors->first('start_time') }}</span>
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
                                                    <input type="text" name="end_time[]" value="{{ old('end_time.'.$k) }}" class="end_time form-control timepicker">
                                                </div>
                                                <span class="text-danger">{{ $errors->first('end_time') }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                                <input class="form-control" type="number" min="1" max="100" id="name" name="price[]" value="{{old('price.'.$k)}}" required="" placeholder="@lang('view_pages.enter_price')">
                                                <span class="text-danger">{{ $errors->first('price.0') }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <button type="button" class="btn btn-success btn-sm add_row"> + </button>
                                            @if ($k != 0)
                                            <button type="button" class="btn btn-danger btn-sm remove_row"> - </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>
                                    <div class="bootstrap-timepicker">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                                </div>
                                                <input type="text" name="start_time[]" value="{{old('start_time.0')}}" class="start_time form-control timepicker">
                                            </div>
                                            <span class="text-danger">{{ $errors->first('start_time') }}</span>
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
                                                <input type="text" name="end_time[]" value="{{old('end_time.0')}}" class="end_time form-control timepicker">
                                            </div>
                                            <span class="text-danger">{{ $errors->first('end_time') }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                            <input class="form-control" type="number" min="1" max="100" id="name" name="price[]" value="{{old('price.0')}}" required="" placeholder="@lang('view_pages.enter_price')">
                                            <span class="text-danger">{{ $errors->first('price.0') }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-success btn-sm add_row"> + </button>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @endif
                </tbody>
            </table>

            <div class="form-group">
                <div class="col-12">
                    <button class="btn btn-primary pull-right  btn-sm m-5" id="saveSurge" type="submit">
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

@endsection

@section('extra-js')
    <!-- date-range-picker -->
    <script src="{{asset('assets/vendor_components/moment/min/moment.min.js') }}"></script>
    <!-- bootstrap time picker -->
    <script src="{{asset('assets/vendor_plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
    <script>
        $('.timepicker').timepicker({
            showInputs: false
        });


        $(document).on("click",".add_row",function(){
            if($('.add_row').length <= 4){
                var append_row = "";
                append_row +='<tr>';
                append_row += '<td>\
                                    <div class="bootstrap-timepicker">\
                                        <div class="form-group">\
                                            <div class="input-group">\
                                                <div class="input-group-addon">\
                                                <i class="fa fa-clock-o"></i>\
                                                </div>\
                                                <input type="text" name="start_time[]" class="start_time form-control timepicker">\
                                            </div>\
                                            <span class="text-danger">{{ $errors->first("start_time") }}</span>\
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
                                                <input type="text" name="end_time[]" class="end_time form-control timepicker">\
                                            </div>\
                                            <span class="text-danger">{{ $errors->first("end_time") }}</span>\
                                        </div>\
                                    </div>\
                                </td>';

                append_row += '<td>\
                                    <div class="form-group">\
                                        <input class="form-control" type="number" min="1" max="100" id="name" name="price[]" value="" required="" placeholder="@lang('view_pages.enter_price')">\
                                    </div>\
                                </td>';

                append_row +='<td>\
                                    <div class="form-group">\
                                        <button type="button" class="btn btn-success btn-sm add_row"> + </button>\
                                        <button type="button" class="btn btn-danger btn-sm remove_row"> - </button>\
                                    </div>\
                                </td>\
                        </tr>';

                $(".append_row").append(append_row);
                    $('.timepicker').timepicker({
                        showInputs: false
                    });
                }
        });

        $(document).on("click",".remove_row",function(){
            $(this).closest("tr").remove();
        });

        $('#saveSurge').click(function(e) {

            var exitSubmit = true;
            var today = new Date();
            var date = today.getFullYear()+'/'+(today.getMonth()+1)+'/'+today.getDate();

            $('.start_time').each(function () {

                var start_time = $(this).val();
                var end_time = $(this).closest("tr").find(".end_time").val();
                var validate_time1 = new Date(date +' '+start_time);
                var validate_time2 = new Date(date +' '+end_time);

                if(start_time == ''){
                    $(this).parent().next().text('Start Time Field is required');
                    exitSubmit = false;
                }

                if(end_time == ''){
                    $(this).closest("tr").find(".end_time").parent().next().text('End Time Field is required');
                    exitSubmit = false;
                }

                if(start_time  && end_time){
                    if(validate_time2 < validate_time1){
                        $(this).parent().next().text('Start Time is greater than End Time');
                        exitSubmit = false;
                    }
                }
                
            });

            return exitSubmit;
        });
    </script>

@endsection
