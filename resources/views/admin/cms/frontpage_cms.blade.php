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

                           <form  method="post" class="form-horizontal" action="{{ route('frontpagecmsadd') }}" enctype="multipart/form-data">
                                @csrf
                            <div class="form-group">
                                <div class="col-6">
                                    <label for="icon">@lang('view_pages.fav-icon')Size(614px × 375px)</label><br>
                                    <img id="blah" src="@if($p) {{ $p.$data->tabfaviconfile }}  @endif " alt=""><br>
                                    <input type="file" id="tabfavicon" onchange="readURL(this)" name="tabfavicon" style="display:none">
                                    <button class="btn btn-primary btn-sm" type="button" onclick="$('#tabfavicon').click()" id="upload">Browse</button>
                                    <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;">Remove</button><br>
                                    <span class="text-danger"> {{ $errors->first('tabfavicon') }}  </span>
                                    </div>
                            </div>


                            <div class="form-group">
                                <div class="col-6">
                                    <label for="icon">@lang('view_pages.fav-icon')Size(614px × 375px)</label><br>
                                    <img id="blah" src="@if($p) {{ $p.$data->faviconfile }}  @endif " alt=""><br>
                                    <input type="file" id="favicon" onchange="readURL(this)" name="faviconfile" style="display:none">
                                    <button class="btn btn-primary btn-sm" type="button" onclick="$('#favicon').click()" id="upload">Browse</button>
                                    <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;">Remove</button><br>
                                    <span class="text-danger"> {{ $errors->first('favicon') }}  </span>
                                    </div>
                            </div>

                            <div class="form-group">
                                <div class="col-6">
                                    <label for="icon">@lang('view_pages.banner-image')Size(960px × 815px)</label><br>
                                    <img id="blah" src="@if($p) {{ $p.$data->bannerimage }}  @endif " alt=""><br>
                                    <input type="file" id="banner" onchange="readURL(this)" name="bannerimage" style="display:none">
                                    <button class="btn btn-primary btn-sm" type="button" onclick="$('#banner').click()" id="upload">Browse</button>
                                    <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;">Remove</button><br>
                                    <span class="text-danger">{{ $errors->first('bannerimage') }}</span>
                                    </div>
                            </div>
                            
                            <div class="form-group">
                                <label><strong>Banner Text :</strong></label>
                                <textarea class="ckeditor form-control" name="description">@if($data)  {{ $data->description }}  @endif</textarea>
                            </div>

                                <div class="form-group">
                                    <div class="col-6">
                                    <label for="icon">@lang('view_pages.play-store-app-image')Size(322px × 96px)</label><br>
                                    <img id="blah" src="@if($p) {{ $p.$data->playstoreicon1 }}  @endif" alt=""><br>
                                    <input type="file" name="playstoreicon1" id="playviewimage1" onchange="readURL(this)" style="display:none" >
                                    <button class="btn btn-primary btn-sm" type="button" onclick="$('#playviewimage1').click()" id="upload">Browse</button>
                                    <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;">Remove</button><br>
                                    <span class="text-danger">{{ $errors->first('tabviewimage1') }}</span> 
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-6">
                                    <label for="icon">@lang('view_pages.play-store-app-image')Size(322px × 96px)</label><br>
                                    <img id="blah" src="@if($p) {{ $p.$data->playstoreicon2 }}  @endif" alt=""><br>
                                    <input type="file" name="playstoreicon2" id="playviewimage2" onchange="readURL(this)" style="display:none">
                                    <button class="btn btn-primary btn-sm" type="button" onclick="$('#playviewimage2').click()" id="upload">Browse</button>
                                    <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;">Remove</button><br>
                                    <span class="text-danger">{{ $errors->first('tabviewimage1') }}</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-6">
                                    <label for="icon">@lang('view_pages.tab-view-image')Size(512px × 512px)</label><br>
                                    <img id="blah" src="@if($p) {{ $p.$data->firstrowimage1 }}  @endif" alt=""><br>
                                    <input type="file" name="tabviewimage1" id="tabviewimage1" onchange="readURL(this)" style="display:none">
                                    <button class="btn btn-primary btn-sm" type="button" onclick="$('#tabviewimage1').click()" id="upload">Browse</button>
                                    <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;">Remove</button><br>
                                    <span class="text-danger">{{ $errors->first('tabviewimage1') }}</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label><strong>@lang('view_pages.tab-head-text') 1: </strong></label>
                                    <textarea class="ckeditor form-control" name="descriptiontabhead1">@if($data)  {{ $data->firstrowheadtext1 }}   @endif</textarea>
                                </div>
                                <div class="form-group">
                                    <label><strong>@lang('view_pages.tab-sub-text') 1: </strong></label>
                                    <textarea class="ckeditor form-control" name="descriptiontabsub1">@if($data)  {{ $data->firstrowsubtext1 }}   @endif</textarea>
                                </div>

                                <div class="form-group">
                                    <div class="col-6">
                                    <label for="icon">@lang('view_pages.tab-view-image')Size(512px × 512px)</label><br>
                                    <img id="blah" src="@if($p) {{ $p.$data->firstrowimage2 }}  @endif " alt=""><br>
                                    <input type="file" name="tabviewimage2" id="tabviewimage2" onchange="readURL(this)" style="display:none">
                                    <button class="btn btn-primary btn-sm" type="button" onclick="$('#tabviewimage2').click()" id="upload">Browse</button>
                                    <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;">Remove</button><br>
                                    <span class="text-danger">{{ $errors->first('tabviewimage2') }}</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label><strong>@lang('view_pages.tab-head-text') 2: </strong></label>
                                    <textarea class="ckeditor form-control" name="descriptiontabhead2">@if($data)  {{ $data->firstrowheadtext2 }}  @endif</textarea>
                                </div>
                                <div class="form-group">
                                    <label><strong>@lang('view_pages.tab-sub-text') 2: </strong></label>
                                    <textarea class="ckeditor form-control" name="descriptiontabsub2">@if($data)  {{ $data->firstrowsubtext2 }}   @endif</textarea>
                                </div>

                                <div class="form-group">
                                    <div class="col-6">
                                    <label for="icon">@lang('view_pages.tab-view-image')Size(512px × 512px)</label><br>
                                    <img id="blah" src="@if($p) {{ $p.$data->firstrowimage3 }}  @endif " alt=""><br>
                                    <input type="file" name="tabviewimage3" id="tabviewimage3" onchange="readURL(this)" style="display:none">
                                    <button class="btn btn-primary btn-sm" type="button" onclick="$('#tabviewimage3').click()" id="upload">Browse</button>
                                    <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;">Remove</button><br>
                                    <span class="text-danger">{{ $errors->first('tabviewimage3') }}</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label><strong>@lang('view_pages.tab-head-text') 3: </strong></label>
                                    <textarea class="ckeditor form-control" name="descriptiontabhead3">@if($data)  {{ $data->firstrowheadtext3 }}   @endif</textarea>
                                </div>
                                <div class="form-group">
                                    <label><strong>@lang('view_pages.tab-sub-text') 3: </strong></label>
                                    <textarea class="ckeditor form-control" name="descriptiontabsub3">@if($data)  {{ $data->firstrowsubtext3 }}   @endif</textarea>
                                </div>


                            <div class="form-group">
                                <div class="col-6">
                                    <label for="icon">@lang('view_pages.second-tab-view-image')Size(700px × 466px)</label><br>
                                    <img id="blah" src="@if($p) {{ $p.$data->secondrowimage1 }}  @endif " alt=""><br>
                                    <input type="file" name="tabviewimage4" id="tabviewimage4" onchange="readURL(this)" style="display:none">
                                    <button class="btn btn-primary btn-sm" type="button" onclick="$('#tabviewimage4').click()" id="upload">Browse</button>
                                    <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;">Remove</button><br>
                                    <span class="text-danger">{{ $errors->first('tabviewimage4') }}</span>
                                    </div>
                            </div>
                                <div class="form-group">
                                    <label><strong>@lang('view_pages.second-tab-head-text') </strong></label>
                                    <textarea class="ckeditor form-control" name="descriptionsecondtab1">@if($data)  {{ $data->secondrowheadtext1 }}   @endif</textarea>
                                </div>
                            <div class="form-group">
                                <div class="col-6">
                                    <label for="icon">@lang('view_pages.second-tab-view-image')Size(700px × 466px)</label><br>
                                    <img id="blah" src="@if($p) {{ $p.$data->secondrowimage2 }}  @endif " alt=""><br>
                                    <input type="file" name="tabviewimage5" id="tabviewimage5" onchange="readURL(this)" style="display:none">
                                    <button class="btn btn-primary btn-sm" type="button" onclick="$('#tabviewimage5').click()" id="upload">Browse</button>
                                    <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;">Remove</button><br>
                                    <span class="text-danger">{{ $errors->first('tabviewimage5') }}</span>
                                    </div>
                            </div>
                                <div class="form-group">
                                    <label><strong>@lang('view_pages.second-tab-head-text') </strong></label>
                                    <textarea class="ckeditor form-control" name="descriptionsecondtab2">@if($data)  {{ $data->secondrowheadtext2 }}   @endif</textarea>
                                </div>
                            <div class="form-group">
                                <div class="col-6">
                                    <label for="icon">@lang('view_pages.second-tab-view-image')Size(700px × 466px)</label><br>
                                    <img id="blah" src="@if($p) {{ $p.$data->secondrowimage3 }}  @endif " alt=""><br>
                                    <input type="file" name="tabviewimage6" id="tabviewimage6" onchange="readURL(this)" style="display:none">
                                    <button class="btn btn-primary btn-sm" type="button" onclick="$('#tabviewimage6').click()" id="upload">Browse</button>
                                    <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;">Remove</button><br>
                                    <span class="text-danger">{{ $errors->first('tabviewimage6') }}</span>
                                    </div>
                            </div>
                                <div class="form-group">
                                    <label><strong>@lang('view_pages.second-tab-head-text') </strong></label>
                                    <textarea class="ckeditor form-control" name="descriptionsecondtab3">@if($data)  {{ $data->secondrowheadtext3 }}   @endif</textarea>
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
