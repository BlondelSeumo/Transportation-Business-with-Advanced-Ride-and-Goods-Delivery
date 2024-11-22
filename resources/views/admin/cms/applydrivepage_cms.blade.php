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

                           <form  method="post" class="form-horizontal" action="{{ route('applydriverpageadd') }}" enctype="multipart/form-data">
                                @csrf
                            <div class="form-group">
                                <div class="col-6">
                                    <label for="icon">First Row Image Size(855px × 552px)</label><br>
                                    <img id="blah" src="@if($p) {{ $p.$data->afrimage }} @endif " alt=""><br>
                                    <input type="file" id="afrimage" onchange="readURL(this)" name="afrimage" style="display:none">
                                    <button class="btn btn-primary btn-sm" type="button" onclick="$('#afrimage').click()" id="upload">Browse</button>
                                    <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;">Remove</button><br>
                                    <span class="text-danger"> {{ $errors->first('afrimage') }}  </span>
                                    </div>
                            </div>
                            <div class="form-group">
                                <label><strong>First Row Head Text :</strong></label>
                                <textarea class="ckeditor form-control" name="afrhtext">@if($data) {{ $data->afrhtext }} @endif</textarea>
                            </div>
                            <div class="form-group">
                                <label><strong>First Row Sub Text :</strong></label>
                                <textarea class="ckeditor form-control" name="afrstext">@if($data) {{ $data->afrstext }} @endif</textarea>
                            </div>
                            <div class="form-group">
                                <label><strong>Second Row Text :</strong></label>
                                <textarea class="ckeditor form-control" name="asrtext">@if($data) {{ $data->asrtext }} @endif</textarea>
                            </div>

                            <div class="form-group">
                                <div class="col-6">
                                    <label for="icon">Second Row Image 1 Size(512px × 512px)</label><br>
                                    <img id="blah" src="@if($p) {{ $p.$data->asrimage1 }}  @endif" alt=""><br>
                                    <input type="file" id="asrimage1" onchange="readURL(this)" name="asrimage1" style="display:none">
                                    <button class="btn btn-primary btn-sm" type="button" onclick="$('#asrimage1').click()" id="upload">Browse</button>
                                    <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;">Remove</button><br>
                                    <span class="text-danger"> {{ $errors->first('asrimage1') }}  </span>
                                    </div>
                            </div>
                            <div class="form-group">
                                <label><strong>Second Row Head Text 1 :</strong></label>
                                <textarea class="ckeditor form-control" name="asrhtext1">@if($data) {{ $data->asrhtext1 }} @endif</textarea>
                            </div>
                            <div class="form-group">
                                <label><strong>Second Row Sub Text 1 :</strong></label>
                                <textarea class="ckeditor form-control" name="asrstext1">@if($data) {{ $data->asrstext1 }} @endif</textarea>
                            </div>

                            <div class="form-group">
                                <div class="col-6">
                                    <label for="icon">Second Row Image 2 Size(512px × 512px)</label><br>
                                    <img id="blah" src="@if($p) {{ $p.$data->asrimage2 }}  @endif" alt=""><br>
                                    <input type="file" id="asrimage2" onchange="readURL(this)" name="asrimage2" style="display:none">
                                    <button class="btn btn-primary btn-sm" type="button" onclick="$('#asrimage2').click()" id="upload">Browse</button>
                                    <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;">Remove</button><br>
                                    <span class="text-danger"> {{ $errors->first('asrimage2') }}  </span>
                                    </div>
                            </div>
                            <div class="form-group">
                                <label><strong>Second Row Head Text 2 :</strong></label>
                                <textarea class="ckeditor form-control" name="asrhtext2">@if($data) {{ $data->asrhtext2 }} @endif</textarea>
                            </div>
                            <div class="form-group">
                                <label><strong>Second Row Sub Text 2:</strong></label>
                                <textarea class="ckeditor form-control" name="asrstext2">@if($data) {{ $data->asrstext2 }} @endif</textarea>
                            </div>

                            <div class="form-group">
                                <div class="col-6">
                                    <label for="icon">Second Row Image 3 Size(512px × 512px)</label><br>
                                    <img id="blah" src="@if($p) {{ $p.$data->asrimage3 }}  @endif" alt=""><br>
                                    <input type="file" id="asrimage3" onchange="readURL(this)" name="asrimage3" style="display:none">
                                    <button class="btn btn-primary btn-sm" type="button" onclick="$('#asrimage3').click()" id="upload">Browse</button>
                                    <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;">Remove</button><br>
                                    <span class="text-danger"> {{ $errors->first('asrimage3') }}  </span>
                                    </div>
                            </div>
                            <div class="form-group">
                                <label><strong>Second Row Head Text 3 :</strong></label>
                                <textarea class="ckeditor form-control" name="asrhtext3">@if($data) {{ $data->asrhtext3 }} @endif</textarea>
                            </div>
                            <div class="form-group">
                                <label><strong>Second Row Sub Text 3 :</strong></label>
                                <textarea class="ckeditor form-control" name="asrstext3">@if($data) {{ $data->asrstext3 }} @endif</textarea>
                            </div>

                            <div class="form-group">
                                <label><strong>Third Row Head Text :</strong></label>
                                <textarea class="ckeditor form-control" name="atrhtext">@if($data) {{ $data->atrhtext }} @endif</textarea>
                            </div>


                            <div class="form-group">
                                <label><strong>Third Row Tab Head Text 1 :</strong></label>
                                <textarea class="ckeditor form-control" name="atrthtext1">@if($data) {{ $data->atrthtext1 }} @endif</textarea>
                            </div>
                            <div class="form-group">
                                <div class="col-6">
                                    <label for="icon">Third Row Tab Image 1 Size(540px × 540px)</label><br>
                                    <img id="blah" src="@if($p) {{ $p.$data->atrtimage1 }}  @endif" alt=""><br>
                                    <input type="file" id="atrtimage1" onchange="readURL(this)" name="atrtimage1" style="display:none">
                                    <button class="btn btn-primary btn-sm" type="button" onclick="$('#atrtimage1').click()" id="upload">Browse</button>
                                    <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;">Remove</button><br>
                                    <span class="text-danger"> {{ $errors->first('atrtimage1') }}  </span>
                                    </div>
                            </div>
                            <div class="form-group">
                                <label><strong>Third Row Tab Sub Text 1 :</strong></label>
                                <textarea class="ckeditor form-control" name="atrtstext1">@if($data) {{ $data->atrtstext1 }} @endif</textarea>
                            </div>

                            <div class="form-group">
                                <label><strong>Third Row Tab Head Text 2 :</strong></label>
                                <textarea class="ckeditor form-control" name="atrthtext2">@if($data) {{ $data->atrthtext2 }} @endif</textarea>
                            </div>
                            <div class="form-group">
                                <div class="col-6">
                                    <label for="icon">Third Row Tab Image 2 Size(540px × 540px)</label><br>
                                    <img id="blah" src="@if($p) {{ $p.$data->atrtimage2 }} @endif " alt=""><br>
                                    <input type="file" id="atrtimage2" onchange="readURL(this)" name="atrtimage2" style="display:none">
                                    <button class="btn btn-primary btn-sm" type="button" onclick="$('#atrtimage2').click()" id="upload">Browse</button>
                                    <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;">Remove</button><br>
                                    <span class="text-danger"> {{ $errors->first('atrtimage2') }}  </span>
                                    </div>
                            </div>
                            <div class="form-group">
                                <label><strong>Third Row Tab Sub Text 2 :</strong></label>
                                <textarea class="ckeditor form-control" name="atrtstext2">@if($data) {{ $data->atrtstext2 }} @endif</textarea>
                            </div>

                            <div class="form-group">
                                <label><strong>Third Row Tab Head Text 3 :</strong></label>
                                <textarea class="ckeditor form-control" name="atrthtext3">@if($data) {{ $data->atrthtext3 }} @endif</textarea>
                            </div>
                            <div class="form-group">
                                <div class="col-6">
                                    <label for="icon">Third Row Tab Image 3 Size(540px × 540px)</label><br>
                                    <img id="blah" src="@if($p) {{ $p.$data->atrtimage3 }}  @endif" alt=""><br>
                                    <input type="file" id="atrtimage3" onchange="readURL(this)" name="atrtimage3" style="display:none">
                                    <button class="btn btn-primary btn-sm" type="button" onclick="$('#atrtimage3').click()" id="upload">Browse</button>
                                    <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;">Remove</button><br>
                                    <span class="text-danger"> {{ $errors->first('atrtimage3') }}  </span>
                                    </div>
                            </div>
                            <div class="form-group">
                                <label><strong>Third Row Tab Sub Text 3 :</strong></label>
                                <textarea class="ckeditor form-control" name="atrtstext3">@if($data) {{ $data->atrtstext3 }} @endif</textarea>
                            </div>
                            <div class="form-group">
                                <div class="col-6">
                                    <label for="icon">Fourth Row Background Image Size(1560px × 975px)</label><br>
                                    <img id="blah" src="@if($p) {{ $p.$data->afrbimage }} @endif " alt=""><br>
                                    <input type="file" id="afrbimage" onchange="readURL(this)" name="afrbimage" style="display:none">
                                    <button class="btn btn-primary btn-sm" type="button" onclick="$('#afrbimage').click()" id="upload">Browse</button>
                                    <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;">Remove</button><br>
                                    <span class="text-danger"> {{ $errors->first('afrbimage') }}  </span>
                                    </div>
                            </div>

                            <div class="form-group">
                                <div class="col-6">
                                    <label for="icon">Fourth Row Image Size(1768px × 2400px)</label><br>
                                    <img id="blah" src="@if($p) {{ $p.$data->afrlimage }}  @endif" alt=""><br>
                                    <input type="file" id="afrlimage" onchange="readURL(this)" name="afrlimage" style="display:none">
                                    <button class="btn btn-primary btn-sm" type="button" onclick="$('#afrlimage').click()" id="upload">Browse</button>
                                    <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;">Remove</button><br>
                                    <span class="text-danger"> {{ $errors->first('afrlimage') }}  </span>
                                    </div>
                            </div>
                            <div class="form-group">
                                <label><strong>Fourth Row Head Text :</strong></label>
                                <textarea class="ckeditor form-control" name="afrheadtext">@if($data) {{ $data->afrheadtext }} @endif</textarea>
                            </div>
                            <div class="form-group">
                                <label><strong>Fourth Row Side Text 1:</strong></label>
                                <textarea class="ckeditor form-control" name="afrstext1">@if($data) {{ $data->afrstext1 }} @endif</textarea>
                            </div>
                            <div class="form-group">
                                <label><strong>Fourth Row Side Text 2:</strong></label>
                                <textarea class="ckeditor form-control" name="afrstext2">@if($data) {{ $data->afrstext2 }} @endif</textarea>
                            </div>
                            <div class="form-group">
                                <label><strong>Fourth Row Side Text 3:</strong></label>
                                <textarea class="ckeditor form-control" name="afrstext3">@if($data) {{ $data->afrstext3 }} @endif</textarea>
                            </div>
                            <div class="form-group">
                                <label><strong>Fourth Row Side Text 4:</strong></label>
                                <textarea class="ckeditor form-control" name="afrstext4">@if($data) {{ $data->afrstext4 }} @endif</textarea>
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
