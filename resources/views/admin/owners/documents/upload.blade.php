@extends('admin.layouts.app')
@section('title', 'Upload Driver Document')

@section('content')

	<!-- bootstrap datepicker -->	
    <link rel="stylesheet" href="{!! asset('assets/vendor_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') !!}">
    
<div class="content">
    <div class="container-fluid">
    
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-header with-border">
                    <a href="{{ url()->previous() }}">
                        <button class="btn btn-danger btn-sm pull-right" type="submit">
                            <i class="mdi mdi-keyboard-backspace mr-2"></i>
                            @lang('view_pages.back')
                        </button>
                    </a>
                </div>
    
        <div class="col-sm-12">
            <form  method="post" class="form-horizontal" action="{{url('owners/upload/document',[$owner->id,$needed_document->id])}}" enctype="multipart/form-data">
            {{csrf_field()}}

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="name">@lang('view_pages.name')</label>
                            <input class="form-control" type="text" id="name" name="name" value="{{$needed_document->name}}" placeholder="@lang('view_pages.document_name')" readonly>
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        </div>
                    </div>

                    @if ($needed_document->has_identify_number)
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="identify_number">@lang('view_pages.identify_number')</label>
                                <input class="form-control" type="text" id="identify_number" name="identify_number" value="{{ old('identify_number',$ownerDoc ? $ownerDoc->identify_number : '') }}" required="" placeholder="@lang('view_pages.identify_number')">
                                <span class="text-danger">{{ $errors->first('identify_number') }}</span>
                            </div>
                        </div>
                    @endif
                

                    @if ($needed_document->has_expiry_date)
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="expiry_date">@lang('view_pages.expiry_date')</label>
                                <input class="form-control datepicker" type="text" id="expiry_date" name="expiry_date" value="{{old('expiry_date',$ownerDoc ? $ownerDoc->expiry_date : '')}}" required="" placeholder="@lang('view_pages.enter_expiry_date')" autocomplete="off">
                                <span class="text-danger">{{ $errors->first('expiry_date') }}</span>
                            </div>
                        </div>
                    @endif

                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="document">@lang('view_pages.document')</label><br>
                        <img id="blah" src="{{ $ownerDoc ? $ownerDoc->image : '' }}" alt=""><br>
                        <input type="file" id="document" onchange="readURL(this)" name="document" style="display:none">
                        <button class="btn btn-primary btn-sm" type="button" onclick="$('#document').click()" id="upload">@lang('view_pages.browse')</button>
                        <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;">@lang('view_pages.remove')</button><br>
                        <span class="text-danger">{{ $errors->first('document') }}</span>
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

<script src="{{asset('assets/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>

<script>

    //Date picker
    $('.datepicker').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd',
      startDate: 'today'
    });
</script>
@endsection