@extends('admin.layouts.app')
@section('title', 'Main page')

@section('content')
{{-- {{session()->get('errors')}} --}}
<style> 
    .nav-item.active .nav_lang_preference{
        color: #fff !important;
        border-color: transparent !important;
        border-bottom-color: #398bf7 !important;
        background-color: #398bf7 !important;
    }
    .nav-item .nav_lang_preference{
        color: #929daf;
    }
    .lang_data_show.active{
        display: block;
    }
    .lang_data_show{
        display: none;
    }
</style>
    <!-- Start Page content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="box">

                        <div class="box-header with-border">
                            <a href="{{ url('country') }}">
                                <button class="btn btn-danger btn-sm pull-right" type="submit">
                                    <i class="mdi mdi-keyboard-backspace mr-2"></i>
                                    @lang('view_pages.back')
                                </button>
                            </a>
                        </div>

                        <div class="col-sm-12">

                            <form method="post" class="form-horizontal" action="{{ url('country/update',$item->id) }}" enctype="multipart/form-data">
                                @csrf
                                    <ul class="nav nav-tabs" style="padding: 1rem">
                                    @if(count($lang_data) > 0)
                                    @foreach($lang_data as $k=>$v)
                                    @if($v->locale == "en")
                                    <li class="nav-item " data-toggle="tab">
                                              <a href="#{{$v->locale}}" aria-expanded="false" class="nav-link nav_lang_preference header {{$v->locale}}_default active" data-val="{{$v->locale}}">@lang('view_pages.'.$v->locale) ({{$v->locale}})  <span class="text-danger">*</span></a>
                                        </li>
                                    @else
                                    <li class="nav-item  {{$v->locale}}_default" data-toggle="tab">
                                              <a href="#{{$v->locale}}" class="nav-link nav_lang_preference {{$v->locale}}_default header" data-val="{{$v->locale}}" aria-expanded="false">@lang('view_pages.'.$v->locale) ({{$v->locale}})</a>
                                        </li>
                                    @endif
                                      
                                    @endforeach 
                                    @endif                        
                                    </ul>
                                    <div class="row">
                                        <div class="col-sm-6">
                                        <div class="tab-content">
                                    @if(count($lang_data) > 0)
                                    @foreach($lang_data as $k=>$v)
                                    @if($v->locale == "en")
                                    <div id="{{$v->locale}}" class="tab-pane p-3 show lang_data_show active show_en">
                                        <label for="name_{{$v->locale}}" class="form-label">{{ __('view_pages.name') }} ({{$v->locale}}) <span class="text-danger">*</span></label>
                                        <input  id="name_{{$v->locale}}" name="name_{{$v->locale}}" value="{{$item->translation['en']}}" type="text" class="form-control w-full en_cate_name" placeholder="@lang('view_pages.enter') @lang('view_pages.name')" style="padding: 15px;">
                                    </div>
                                    @else
                                    <div id="{{$v->locale}}" class="tab-pane show p-3 lang_data_show show_{{$v->locale}}">
                                        <label for="name_{{$v->locale}}" class="form-label">{{ __('view_pages.name') }} ({{$v->locale}}) </label>
                                        <input  id="name_{{$v->locale}}" name="name_{{$v->locale}}" value="{{ isset($item->translation[$v->locale]) ? $item->translation[$v->locale] : '' }}" type="text" class="form-control w-full en_cate_name" placeholder="@lang('view_pages.enter') @lang('view_pages.name')" style="padding: 15px;">
                                    </div>
                                    @endif
                                    @endforeach
                                    @endif 
                                    </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="dial_code">@lang('view_pages.dial_code') <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="dial_code" name="dial_code"
                                                value="{{ old('dial_code',$item->dial_code) }}" required=""
                                                placeholder="@lang('view_pages.enter') @lang('view_pages.dial_code')">
                                            <span class="text-danger">{{ $errors->first('dial_code') }}</span>

                                        </div>
                                    </div>
                                </div>
                                 <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="dial_min_length">@lang('view_pages.dial_min_length') <span class="text-danger">*</span></label>
                                            <input class="form-control" type="number" id="dial_min_length" name="dial_min_length"
                                                value="{{ old('dial_min_length',$item->dial_min_length) }}" required
                                                placeholder="@lang('view_pages.enter') @lang('view_pages.dial_min_length')">
                                            <span class="text-danger">{{ $errors->first('dial_min_length') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="dial_max_length">@lang('view_pages.dial_max_length') <span class="text-danger">*</span></label>
                                            <input class="form-control" type="number" id="dial_max_length" name="dial_max_length"
                                                value="{{ old('dial_max_length',$item->dial_max_length) }}" required=""
                                                placeholder="@lang('view_pages.enter') @lang('view_pages.dial_max_length')">
                                            <span class="text-danger">{{ $errors->first('dial_max_length') }}</span>

                                        </div>
                                    </div>
                                </div>
                                 <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="code">@lang('view_pages.code') <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="code" name="code"
                                                value="{{ old('code',$item->code) }}" required
                                                placeholder="@lang('view_pages.enter') @lang('view_pages.code')">
                                            <span class="text-danger">{{ $errors->first('code') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="currency_name">@lang('view_pages.currency_name') <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="currency_name" name="currency_name"
                                                value="{{ old('currency_name',$item->currency_name) }}"
                                                placeholder="@lang('view_pages.enter') @lang('view_pages.currency_name')">
                                            <span class="text-danger">{{ $errors->first('currency_name') }}</span>

                                        </div>
                                    </div>
                                </div>
                                 <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="currency_code">@lang('view_pages.currency_code') <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="currency_code" name="currency_code"
                                                value="{{ old('currency_code',$item->currency_code) }}"
                                                placeholder="@lang('view_pages.enter') @lang('view_pages.currency_code')">
                                            <span class="text-danger">{{ $errors->first('currency_code') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="currency_symbol">@lang('view_pages.currency_symbol') <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="currency_symbol" name="currency_symbol"
                                                value="{{ old('currency_symbol',$item->currency_symbol) }}"
                                                placeholder="@lang('view_pages.enter') @lang('view_pages.currency_symbol')">
                                            <span class="text-danger">{{ $errors->first('currency_symbol') }}</span>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="img_remove form-group">
                                            <label for="flag">@lang('view_pages.flag')</label><br>
                                            <img id="blah" src="{{ $item->flag }}" alt=""><br>
                                            <input type="file" id="flag" onchange="readURL(this)" name="flag" style="display:none">
                                            <button class="btn btn-primary btn-sm" type="button" onclick="$('#flag').click()" id="upload">@lang('view_pages.browse')</button>
                                            <button class="btn btn-danger btn-sm" type="button" id="remove_img">@lang('view_pages.remove')</button><br>
                                            <span class="text-danger">{{ $errors->first('flag') }}</span>
                                        </div>
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
    <script>
        
        $(document).on("click",".nav_lang_preference",function(){ 
            var data_val = $(this).attr("data-val");
            $(".lang_data_show").removeClass("active"); 
            $(".nav-item").removeClass("active"); 
            $(".nav-item").removeClass("show"); 
            $("."+data_val+"_default").addClass("active");
            $(".lang_data_show.show_"+data_val+"").addClass("active"); 
           
        })
    </script>
@endsection
