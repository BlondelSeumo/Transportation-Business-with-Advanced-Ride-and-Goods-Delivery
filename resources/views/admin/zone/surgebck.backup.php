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

            <form  method="post" class="form-horizontal" action="{{url('service_location/store')}}" enctype="multipart/form-data">
            @csrf
            <table class="table surgeTable">
                <thead>
                    <th> @lang('view_pages.start_time') </th>
                    <th>@lang('view_pages.end_time') </th>
                    <th> @lang('view_pages.price') </th>
                    <th style="width:100px;"> @lang('view_pages.action') </th>
                </thead>
                <tbody class="append_row">
                    <tr>
                       <!-- <td> 
                            <div class="bootstrap-timepicker">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                        </div>
                                        <input type="text" name="start_time[]" class="start_time form-control timepicker">
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
                                        <input type="text" name="end_time" class="end_time form-control timepicker">
                                    </div>
                                    <span class="text-danger">{{ $errors->first('end_time') }}</span>
                                </div>
                            </div>
                        </td> -->

                        <td> 
                            <div class="form-group">
                                    <input class="form-control from_no"  row_id="1" type="text" name="to_no[]" value="" required="" placeholder="@lang('view_pages.enter_price')">
                              
                                    <span class="text-danger">{{ $errors->first('price') }}</span>
                                    <label class="text-danger"></label>
                            </div>
                        </td>
                        <td> 
                            <div class="form-group">
                                    <input class="form-control to_no" type="text" name="from_no[]" value="" required="" placeholder="@lang('view_pages.enter_price')">
                              
                                    <span class="text-danger">{{ $errors->first('price') }}</span>
                                    <label class="text-danger"></label>
                            </div>
                        </td> 




                        <td> 
                            <div class="form-group">
                                    <input class="form-control" type="text" id="name" name="price[]" value="{{old('price')}}" required="" placeholder="@lang('view_pages.enter_price')">
                              
                                    <span class="text-danger">{{ $errors->first('price') }}</span>
                            </div>
                        </td> 
                        <td>
                            <div class="form-group">
                                <button type="button" class="btn btn-success btn-sm add_row"> + </button>                                    
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="form-group">
                <div class="col-12">
                    <button class="btn btn-primary pull-right m-5" id="saveSurge" type="button">
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
@section('extra-js')
    <!-- date-range-picker -->
    <script src="{{asset('assets/vendor_components/moment/min/moment.min.js') }}"></script>
    <!-- bootstrap time picker -->
    <script src="{{asset('assets/vendor_plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
    <script>
        $('.timepicker').timepicker({
        showInputs: false
        });


        function check_no(){
            $(".from_no").each(function(){
                
            });
        }


function check_exist_value(){
    alert("in");
    $(".from_no").each(function(){
        var main_row_id=$(this).attr("row_id");
        var main_from_no=$(this).val();
        var main_to_no=$(this).closest("tr").find(".to_no").val();

        if(main_from_no < main_to_no){
            $(this).closest("tr").find("label").html("");

            $(".from_no").each(function(){
            var row_id=$(this).attr("row_id");
            var from_no=$(this).val();
            var to_no=$(this).closest("tr").find(".to_no").val();

            if(main_row_id != row_id){

                if(main_to_no < to_no ){
                    alert("main id lessthan from id");
                }
                
            }

        });






          }else{
            
             $(this).closest("div").find("label").css("display","block");
            $(this).closest("div").find("label").text("from no should be lessthan to no ");
        }
        return false;


        


    });
}

        $(document).on("click",".add_row",function(){
           var row_id=$(".table tr").length;

           // alert( $('.table tr').index(this););
            if($('.add_row').length <= 4){
                var append_row = "";
                append_row +='<tr>';
               /* append_row += '<td>\
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
                                </td>'; */
                                append_row+= '<td>\
                            <div class="form-group">\
                                    <input class="form-control from_no" row_id='+ row_id +' type="text" name="from_no[]" value="" required="" placeholder="@lang("view_pages.enter_price")">\
                                    <span class="text-danger">{{ $errors->first("price") }}</span>\
                                    <label class="text-danger"></label>\
                            </div>\
                        </td>\
                        <td>\
                            <div class="form-group">\
                                    <input class="form-control to_no" type="text" name="to_no[]" value="" required="" placeholder="@lang("view_pages.enter_price")">\
                                    <span class="text-danger">{{ $errors->first("price") }}</span>\
                                    <label class="text-danger"></label>\
                            </div>\
                       ';
                                
                append_row += '<td>\
                                    <div class="form-group">\
                                        <input class="form-control" type="text" id="name" name="price[]" value="{{old("price")}}" required="" placeholder="@lang('view_pages.enter_price')">\
                                        <span class="text-danger">{{ $errors->first("price") }}</span>\
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

        function ConvertTimeformat(format, time) {
            var hours = Number(time.match(/^(\d+)/)[1]);
            var minutes = Number(time.match(/:(\d+)/)[1]);
            var AMPM = time.match(/\s(.*)$/)[1];
            if (AMPM == "PM" && hours < 12) hours = hours + 12;
            if (AMPM == "AM" && hours == 12) hours = hours - 12;
            var sHours = hours.toString();
            var sMinutes = minutes.toString();
            if (hours < 10) sHours = "0" + sHours;
            if (minutes < 10) sMinutes = "0" + sMinutes;

            return sHours+":"+sMinutes;
        }

        $('#saveSurge').click(function() {


            check_exist_value();
            return false;

            var error_count = 0;
            $('.start_time').each(function () {

                var start_time = $(this).val();
                var end_time = $(this).closest("tr").find(".end_time").val();

                if(start_time == ""){
                    error_count++;
                    alert("Start time is required");
                }
                if(end_time == ""){
                    error_count++;
                    alert("End time is required");
                }

                if(start_time !="" && end_time !=""){
                    alert(moment(start_time,"HH:mm"));
                    alert(end_time);
                    return false;
                    if(start_time >= end_time){
                        error_count++;
                    }
                }

            });
        });
    </script>
    
@endsection

@endsection