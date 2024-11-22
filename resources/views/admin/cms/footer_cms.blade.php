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

                           <form  method="post" class="form-horizontal" action="{{ route('footerpageadd') }}" enctype="multipart/form-data">
                                @csrf
                            <div class="form-group">
                                <div class="col-6">
                                    <label for="icon">Footer Logo Image Size(614px × 375px)</label><br>
                                    <img id="blah" src="@if($p) {{ $p.$data->footerlogo }} @endif " alt=""><br>
                                    <input type="file" id="footerlogo" onchange="readURL(this)" name="footerlogo" style="display:none">
                                    <button class="btn btn-primary btn-sm" type="button" onclick="$('#footerlogo').click()" id="upload">Browse</button>
                                    <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;">Remove</button><br>
                                    <span class="text-danger"> {{ $errors->first('footerlogo') }}  </span>
                                    </div>
                            </div>

                                <div class="form-group">
                                    <label><strong>Footer Text Sub </strong></label>
                                    <textarea class="ckeditor form-control" name="descriptionfootertext">@if($data)  {{ $data->footertextsub }}   @endif</textarea>
                                </div>
                                <div class="form-group">
                                    <label><strong>Footer Copyright Text</strong></label>
                                    <textarea class="ckeditor form-control" name="descriptionfootercopytext">@if($data)  {{ $data->footercopytextsub }}   @endif</textarea>
                                </div>

                                <div class="form-group">
                                    <label><strong>Footer Instagram Link</strong></label>
                                    <textarea class="form-control" name="footerinstagramlink">@if($data)  {{ $data->footerinstagramlink }}   @endif</textarea>
                                </div>
                                <div class="form-group">
                                    <label><strong>Footer Facebook Link</strong></label>
                                    <textarea class="form-control" name="footerfacebooklink">@if($data)  {{ $data->footerfacebooklink }}   @endif</textarea>
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
