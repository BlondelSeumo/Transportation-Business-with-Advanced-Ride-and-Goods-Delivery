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
                            <a href="{{ url('carmake') }}">
                                <button class="btn btn-danger btn-sm pull-right" type="submit">
                                    <i class="mdi mdi-keyboard-backspace mr-2"></i>
                                    @lang('view_pages.back')
                                </button>
                            </a>
                        </div>

                        <div class="col-sm-12">

                           <form  method="post" class="form-horizontal" action="{{ route('webbookingcmsadd') }}" enctype="multipart/form-data">
                                @csrf
                            <div class="form-group">
                                <div class="col-6">
                                    <label for="icon">Web Booking Logo Image Size(80px × 40px)</label><br>
                                    <img id="blah" src="@if($p) {{ $p.$data->web_booking_logo }} @endif " alt=""><br>
                                    {{-- <h1>{{ $p.$data->web_booking_logo }} </h1><br> --}}
                                    <input type="file" id="web_booking_logo" onchange="readURL(this)" name="web_booking_logo" style="display:none">
                                    <button class="btn btn-primary btn-sm" type="button" onclick="$('#web_booking_logo').click()" id="upload">Browse</button>
                                    <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;">Remove</button><br>
                                    <span class="text-danger"> {{ $errors->first('web_booking_logo') }}  </span>
                                    </div>
                            </div>
                            <div class="form-group">
                                <div class="col-6">
                                    <label for="icon">Web Booking Taxi Image Size(657px × 703px)</label><br>
                                    <img id="blah" src="@if($p) {{ $p.$data->web_booking_taxi }} @endif " alt=""><br>
                                    {{-- <h1>{{ $p.$data->web_booking_logo }} </h1><br> --}}
                                    <input type="file" id="web_booking_taxi" onchange="readURL(this)" name="web_booking_taxi" style="display:none">
                                    <button class="btn btn-primary btn-sm" type="button" onclick="$('#web_booking_taxi').click()" id="upload">Browse</button>
                                    <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;">Remove</button><br>
                                    <span class="text-danger"> {{ $errors->first('footerlogo') }}  </span>
                                    </div>
                            </div>
                            <div class="form-group">
                                <div class="col-6">
                                    <label for="icon">Web Booking Rental Image Size(657px × 703px)</label><br>
                                    <img id="blah" src="@if($p) {{ $p.$data->web_booking_rental }} @endif " alt=""><br>
                                    {{-- <h1>{{ $p.$data->web_booking_logo }} </h1><br> --}}
                                    <input type="file" id="web_booking_rental" onchange="readURL(this)" name="web_booking_rental" style="display:none">
                                    <button class="btn btn-primary btn-sm" type="button" onclick="$('#web_booking_rental').click()" id="upload">Browse</button>
                                    <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;">Remove</button><br>
                                    <span class="text-danger"> {{ $errors->first('web_booking_rental') }}  </span>
                                    </div>
                            </div>
                            <div class="form-group">
                                <div class="col-6">
                                    <label for="icon"> Web Booking Delivery Image Size(657px × 703px)</label><br>
                                    <img id="blah" src="@if($p) {{ $p.$data->web_booking_delivery }} @endif " alt=""><br>
                                    {{-- <h1>{{ $p.$data->web_booking_delivery }} </h1><br> --}}
                                    <input type="file" id="web_booking_delivery" onchange="readURL(this)" name="web_booking_delivery" style="display:none">
                                    <button class="btn btn-primary btn-sm" type="button" onclick="$('#web_booking_delivery').click()" id="upload">Browse</button>
                                    <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;">Remove</button><br>
                                    <span class="text-danger"> {{ $errors->first('web_booking_delivery') }}  </span>
                                    </div>
                            </div>
                            <div class="form-group">
                                <div class="col-6">
                                    <label for="icon">Web Booking History Image Size(640px × 703px)</label><br>
                                    <img id="blah" src="@if($p) {{ $p.$data->web_booking_history }} @endif " alt=""><br>
                                    {{-- <h1>{{ $p.$data->web_booking_history }} </h1><br> --}}
                                    <input type="file" id="web_booking_history" onchange="readURL(this)" name="web_booking_history" style="display:none">
                                    <button class="btn btn-primary btn-sm" type="button" onclick="$('#web_booking_history').click()" id="upload">Browse</button>
                                    <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;">Remove</button><br>
                                    <span class="text-danger"> {{ $errors->first('web_booking_history') }}  </span>
                                    </div>
                            </div>
                            <div class="form-group">
                                <div class="col-6">
                                    <label for="icon">Web Booking Track Image Size(640px × 703px)</label><br>
                                    <img id="blah" src="@if($p) {{ $p.$data->web_booking_track }} @endif " alt=""><br>
                                    {{-- <h1>{{ $p.$data->web_booking_history }} </h1><br> --}}
                                    <input type="file" id="web_booking_track" onchange="readURL(this)" name="web_booking_track" style="display:none">
                                    <button class="btn btn-primary btn-sm" type="button" onclick="$('#web_booking_track').click()" id="upload">Browse</button>
                                    <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;">Remove</button><br>
                                    <span class="text-danger"> {{ $errors->first('web_booking_track') }}  </span>
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
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

<script type="text/javascript">

    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });

</script>
@endsection
