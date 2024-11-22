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

                           <form  method="post" class="form-horizontal" action="{{ route('howdriverpageadd') }}" enctype="multipart/form-data">
                                @csrf
                            <div class="form-group">
                                <div class="col-6">
                                    <label for="icon">Banner Image Size(1050px × 700px)</label><br>
                                    <img id="blah" src="@if($p)  {{ $p.$data->howbannerimage }}  @endif " alt=""><br>
                                    <input type="file" id="howbannerimage" onchange="readURL(this)" name="howbannerimage" style="display:none">
                                    <button class="btn btn-primary btn-sm" type="button" onclick="$('#howbannerimage').click()" id="upload">Browse</button>
                                    <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;">Remove</button><br>
                                    <span class="text-danger"> {{ $errors->first('howbannerimage') }}  </span>
                                    </div>
                            </div>

                            <div class="form-group">
                                <label><strong>Firstrow Header Text:</strong></label>
                                <textarea class="ckeditor form-control" name="hfrht1">@if($data)  {{ $data->hfrht1 }}  @endif</textarea>
                            </div>

                            <div class="form-group">
                                <div class="col-6">
                                    <label for="icon">Firstrow Center Image Size(200px × 409px)</label><br>
                                    <img id="blah" src="@if($p)  {{ $p.$data->htrcimage1 }}  @endif " alt=""><br>
                                    <input type="file" id="hfrcimage1" onchange="readURL(this)" name="hfrcimage1" style="display:none">
                                    <button class="btn btn-primary btn-sm" type="button" onclick="$('#hfrcimage1').click()" id="upload">Browse</button>
                                    <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;">Remove</button><br>
                                    <span class="text-danger"> {{ $errors->first('hfrcimage1') }}  </span>
                                    </div>
                            </div>

                            <div class="form-group">
                                <label><strong>Firstrow Right Side Text:</strong></label>
                                <textarea class="ckeditor form-control" name="hfrht2">@if($data)  {{ $data->hfrht2 }}  @endif</textarea>
                            </div>

                            <div class="form-group">
                                <label><strong>Secondrow Header Text:</strong></label>
                                <textarea class="ckeditor form-control" name="hsrht1">@if($data)  {{ $data->hsrht1 }}  @endif</textarea>
                            </div>

                            <div class="form-group">
                                <div class="col-6">
                                    <label for="icon">Secondrow Center Image Size(200px × 409px)</label><br>
                                    <img id="blah" src="@if($p)  {{ $p.$data->hsrcimage1 }}  @endif " alt=""><br>
                                    <input type="file" id="hsrcimage1" onchange="readURL(this)" name="hsrcimage1" style="display:none">
                                    <button class="btn btn-primary btn-sm" type="button" onclick="$('#hsrcimage1').click()" id="upload">Browse</button>
                                    <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;">Remove</button><br>
                                    <span class="text-danger"> {{ $errors->first('hsrcimage1') }}  </span>
                                    </div>
                            </div>

                            <div class="form-group">
                                <label><strong>Secondrow Right Side Text:</strong></label>
                                <textarea class="ckeditor form-control" name="hsrht2">@if($data)  {{ $data->hsrht2 }}  @endif</textarea>
                            </div>


                            <div class="form-group">
                                <label><strong>Thirdrow Header Text:</strong></label>
                                <textarea class="ckeditor form-control" name="htrht1">@if($data)  {{ $data->htrht1 }}  @endif</textarea>
                            </div>

                            <div class="form-group">
                                <div class="col-6">
                                    <label for="icon">Thirdrow Center Image Size(200px × 409px)</label><br>
                                    <img id="blah" src="@if($p)  {{ $p.$data->htrcimage1 }}  @endif " alt=""><br>
                                    <input type="file" id="htrcimage1" onchange="readURL(this)" name="htrcimage1" style="display:none">
                                    <button class="btn btn-primary btn-sm" type="button" onclick="$('#htrcimage1').click()" id="upload">Browse</button>
                                    <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;">Remove</button><br>
                                    <span class="text-danger"> {{ $errors->first('htrcimage1') }}  </span>
                                    </div>
                            </div>

                            <div class="form-group">
                                <label><strong>Thirdrow Right Side Text:</strong></label>
                                <textarea class="ckeditor form-control" name="htrht2">@if($data)  {{ $data->htrht2 }}  @endif</textarea>
                            </div>

                            <div class="form-group">
                                <label><strong>Fourthrow Header Text:</strong></label>
                                <textarea class="ckeditor form-control" name="hforht1">@if($data)  {{ $data->hforht1 }}  @endif</textarea>
                            </div>

                            <div class="form-group">
                                <div class="col-6">
                                    <label for="icon">Fourthrow Center Image Size(200px × 409px)</label><br>
                                    <img id="blah" src="@if($p)  {{ $p.$data->hforcimage1 }}  @endif " alt=""><br>
                                    <input type="file" id="hforcimage1" onchange="readURL(this)" name="hforcimage1" style="display:none">
                                    <button class="btn btn-primary btn-sm" type="button" onclick="$('#hforcimage1').click()" id="upload">Browse</button>
                                    <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;">Remove</button><br>
                                    <span class="text-danger"> {{ $errors->first('hforcimage1') }}  </span>
                                    </div>
                            </div>

                            <div class="form-group">
                                <label><strong>Fourthrow Right Side Text:</strong></label>
                                <textarea class="ckeditor form-control" name="hforht2">@if($data)  {{ $data->hforht2 }}  @endif</textarea>
                            </div>

                            <div class="form-group">
                                <label><strong>Fifthrow Header Text:</strong></label>
                                <textarea class="ckeditor form-control" name="hfirht1">@if($data)  {{ $data->hfirht1 }}  @endif</textarea>
                            </div>

                            <div class="form-group">
                                <div class="col-6">
                                    <label for="icon">Fifthrow Center Image Size(200px × 409px)</label><br>
                                    <img id="blah" src="@if($p)  {{ $p.$data->hfircimage1 }}  @endif " alt=""><br>
                                    <input type="file" id="hfircimage1" onchange="readURL(this)" name="hfircimage1" style="display:none">
                                    <button class="btn btn-primary btn-sm" type="button" onclick="$('#hfircimage1').click()" id="upload">Browse</button>
                                    <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;">Remove</button><br>
                                    <span class="text-danger"> {{ $errors->first('hfircimage1') }}  </span>
                                    </div>
                            </div>

                            <div class="form-group">
                                <label><strong>Fifthrow Right Side Text:</strong></label>
                                <textarea class="ckeditor form-control" name="hfirht2">@if($data)  {{ $data->hfirht2 }}  @endif</textarea>
                            </div>

                            <div class="form-group">
                                <label><strong>Sixthrow Header Text:</strong></label>
                                <textarea class="ckeditor form-control" name="hsirht1">@if($data)  {{ $data->hsirht1 }}  @endif</textarea>
                            </div>

                            <div class="form-group">
                                <div class="col-6">
                                    <label for="icon">Sixthrow Center Image Size(200px × 409px)</label><br>
                                    <img id="blah" src="@if($p)  {{ $p.$data->hsircimage1 }}  @endif " alt=""><br>
                                    <input type="file" id="hsircimage1" onchange="readURL(this)" name="hsircimage1" style="display:none">
                                    <button class="btn btn-primary btn-sm" type="button" onclick="$('#hsircimage1').click()" id="upload">Browse</button>
                                    <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;">Remove</button><br>
                                    <span class="text-danger"> {{ $errors->first('hsircimage1') }}  </span>
                                    </div>
                            </div>

                            <div class="form-group">
                                <label><strong>Sixthrow Right Side Text:</strong></label>
                                <textarea class="ckeditor form-control" name="hsirht2">@if($data)  {{ $data->hsirht2 }}  @endif</textarea>
                            </div>

                            <div class="form-group">
                                <label><strong>Seventhrow Header Text:</strong></label>
                                <textarea class="ckeditor form-control" name="hserht1">@if($data)  {{ $data->hserht1 }}  @endif</textarea>
                            </div>

                            <div class="form-group">
                                <div class="col-6">
                                    <label for="icon">Seventhrow Center Image Size(200px × 409px)</label><br>
                                    <img id="blah" src="@if($p)  {{ $p.$data->hsercimage1 }}  @endif " alt=""><br>
                                    <input type="file" id="hsercimage1" onchange="readURL(this)" name="hsercimage1" style="display:none">
                                    <button class="btn btn-primary btn-sm" type="button" onclick="$('#hsercimage1').click()" id="upload">Browse</button>
                                    <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;">Remove</button><br>
                                    <span class="text-danger"> {{ $errors->first('hsercimage1') }}  </span>
                                    </div>
                            </div>

                            <div class="form-group">
                                <label><strong>Seventhrow Right Side Text:</strong></label>
                                <textarea class="ckeditor form-control" name="hserht2">@if($data)  {{ $data->hserht2 }}  @endif</textarea>
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
