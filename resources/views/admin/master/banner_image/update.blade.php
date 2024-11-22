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
                            <a href="{{ url('banner_image') }}">
                                <button class="btn btn-danger btn-sm pull-right" type="submit">
                                    <i class="mdi mdi-keyboard-backspace mr-2"></i>
                                    @lang('view_pages.back')
                                </button>
                            </a>
                        </div>

                        <div class="col-sm-12">

                            <form method="post" class="form-horizontal" action="{{ url('banner_image/update', $item->id) }}"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}

                        <div class="row">
                            <div class="form-group">
                            <label for="image">@lang('view_pages.image')</label><br>
                            <img id="blah" src="{{old('image',asset($item->image))}}" alt="missing image"><br>
                            <input type="file" id="image" onchange="readURL(this)" name="image"
                            style="display:none">
                            <button class="btn btn-primary btn-sm" type="button"
                            onclick="$('#image').click()" id="upload">@lang('view_pages.browse')</button>
                            <button class="btn btn-danger btn-sm" type="button" id="remove_img"
                            style="display: none;">@lang('view_pages.remove')</button><br>
                            <span class="text-danger">{{ $errors->first('image') }}</span>
                            </div>
                        </div>
                         <div class="form-group">
                            <div class="col-12">
                                <button class="btn btn-primary btn-sm pull-right m-5" type="submit">
                                    @lang('view_pages.update')
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

        <script src="{{asset('assets/vendor_components/jquery/dist/jquery.js')}}"></script>
@endsection
