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

                           <form  method="post" class="form-horizontal" action="{{ route('contactpageadd') }}" enctype="multipart/form-data">
                                @csrf
                            <div class="form-group">
                                <div class="col-6">
                                    <label for="icon">Contact Banner Image <span color="blue">Size(644px × 284px)</span></label><br>
                                    <img id="blah" src="@if($p) {{ $p.$data->contactbanner }} @endif " alt=""><br>
                                    <input type="file" id="contactbanner" onchange="readURL(this)" name="contactbanner" style="display:none">
                                    <button class="btn btn-primary btn-sm" type="button" onclick="$('#contactbanner').click()" id="upload">Browse</button>
                                    <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;">Remove</button><br>
                                    <span class="text-danger"> {{ $errors->first('contactbanner') }}  </span>
                                    </div>
                            </div>

                            <div class="form-group">
                                <label><strong>Contact Text :</strong></label>
                                <textarea class="ckeditor form-control" name="contacttext">@if($data) {{ $data->contacttext }} @endif</textarea>
                            </div>
                            <div class="form-group">
                                <label><strong>Contact Map :</strong></label>
                                <textarea class="form-control" name="contactmap">@if($data) {{ $data->contactmap }} @endif</textarea>
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
