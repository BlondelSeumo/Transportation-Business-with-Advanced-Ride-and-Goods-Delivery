    <!-- Color Picker -->
    <!--<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.3.6/css/bootstrap-colorpicker.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-2.2.2.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.3.6/js/bootstrap-colorpicker.js"></script>
    <!-- Color Picker -->

@extends('admin.layouts.app')
@section('title', 'Main page')

@section('content')
{{-- {{session()->get('errors')}} --}}

<!-- ColorPicker JS -->

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

                           <form  method="post" class="form-horizontal" action="{{ route('colorthemepageadd') }}" enctype="multipart/form-data">
                                @csrf
                            <div class="form-group">
                                <div class="col-6">
                                    <label for="icon">Navbar Header Color:</label><br>
                                    <div id="cp1" class="input-group colorpicker-component"> 
                                    <input name="mrcolor" type="text" value="{{ $data->menucolor }}" class="form-control" /> 
                                    <span class="input-group-addon"><i></i></span>
                                    </div> 
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-6">
                                    <label for="icon">Navbar Menu Text Color:</label><br>
                                    <div id="cp2" class="input-group colorpicker-component"> 
                                    <input name="mtcolor" type="text" value="{{ $data->menutextcolor }}" class="form-control" /> 
                                    <span class="input-group-addon"><i></i></span>
                                    </div> 
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-6">
                                    <label for="icon">Navbar Menu Text Hover Color:</label><br>
                                    <div id="cp3" class="input-group colorpicker-component"> 
                                    <input name="mhcolor" type="text" value="{{ $data->menutexthover }}" class="form-control" /> 
                                    <span class="input-group-addon"><i></i></span>
                                    </div> 
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-6">
                                    <label for="icon">Homepage Banner Background Color:</label><br>
                                    <div id="cp4" class="input-group colorpicker-component"> 
                                    <input name="frbgcolor" type="text" value="{{ $data->firstrowbgcolor }}" class="form-control" /> 
                                    <span class="input-group-addon"><i></i></span>
                                    </div> 
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-6">
                                    <label for="icon">Homepage Driver Download App Number Color:</label><br>
                                    <div id="cp5" class="input-group colorpicker-component"> 
                                    <input type="text" name="hdriverdownloadcolor" value="{{ $data->hdriverdownloadcolor }}" class="form-control" /> 
                                    <span class="input-group-addon"><i></i></span>
                                    </div> 
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-6">
                                    <label for="icon">How It Works Number Color:</label><br>
                                    <div id="cp6" class="input-group colorpicker-component"> 
                                    <input type="text" name="hownumberbgcolor" value="{{ $data->hownumberbgcolor }}" class="form-control" /> 
                                    <span class="input-group-addon"><i></i></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-6">
                                    <label for="icon">Footer Background Color:</label><br>
                                    <div id="cp8" class="input-group colorpicker-component"> 
                                    <input type="text" name="footerbgcolor" value="{{ $data->footerbgcolor }}" class="form-control" /> 
                                    <span class="input-group-addon"><i></i></span>
                                    </div>
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
  $('#cp1').colorpicker();
  $('#cp2').colorpicker();
  $('#cp3').colorpicker();
  $('#cp4').colorpicker();      
  $('#cp5').colorpicker();  
  $('#cp6').colorpicker(); 
  $('#cp7').colorpicker();  
  $('#cp8').colorpicker();  
</script>
@endsection
