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

                           <form  method="post" class="form-horizontal" action="{{ route('drreqpageadd') }}" enctype="multipart/form-data">
                                @csrf
                            <div class="form-group">
                                <div class="col-6">
                                    <label for="icon">First Row Image Size(1140px × 956px)</label><br>
                                    <img id="blah" src="@if($p) {{ $p.$data->frimage }}  @endif " alt=""><br>
                                    <input type="file" id="frimage" onchange="readURL(this)" name="frimage" style="display:none">
                                    <button class="btn btn-primary btn-sm" type="button" onclick="$('#frimage').click()" id="upload">Browse</button>
                                    <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;">Remove</button><br>
                                    <span class="text-danger"> {{ $errors->first('frimage') }}  </span>
                                    </div>
                            </div>
                            <div class="form-group">
                                <label><strong>First Row Text :</strong></label>
                                <textarea class="ckeditor form-control" name="frtext">@if($data) {{ $data->frtext }}  @endif</textarea>
                            </div>

                            <div class="form-group">
                                <div class="col-6">
                                    <label for="icon">Second Row Image Size(1140px × 956px)</label><br>
                                    <img id="blah" src="@if($p) {{ $p.$data->srimage }}  @endif " alt=""><br>
                                    <input type="file" id="srimage" onchange="readURL(this)" name="srimage" style="display:none">
                                    <button class="btn btn-primary btn-sm" type="button" onclick="$('#srimage').click()" id="upload">Browse</button>
                                    <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;">Remove</button><br>
                                    <span class="text-danger"> {{ $errors->first('srimage') }}  </span>
                                    </div>
                            </div>
                            <div class="form-group">
                                <label><strong>Second Row Text :</strong></label>
                                <textarea class="ckeditor form-control" name="srtext">@if($data) {{ $data->srtext }}  @endif</textarea>
                            </div>

                            <div class="form-group">
                                <div class="col-6">
                                    <label for="icon">Third Row Image Size(1140px × 956px)</label><br>
                                    <img id="blah" src="@if($p) {{ $p.$data->trimage }}  @endif " alt=""><br>
                                    <input type="file" id="trimage" onchange="readURL(this)" name="trimage" style="display:none">
                                    <button class="btn btn-primary btn-sm" type="button" onclick="$('#trimage').click()" id="upload">Browse</button>
                                    <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;">Remove</button><br>
                                    <span class="text-danger"> {{ $errors->first('trimage') }}  </span>
                                    </div>
                            </div>
                            <div class="form-group">
                                <label><strong>Third Row Text :</strong></label>
                                <textarea class="ckeditor form-control" name="trtext">@if($data) {{ $data->trtext }}  @endif</textarea>
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
