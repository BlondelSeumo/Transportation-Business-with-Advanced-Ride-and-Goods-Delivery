@extends('admin.layouts.app')
@section('title', 'Main page')

@section('content')

<!-- Start Page content -->
<div class="content">
<div class="container-fluid">

<div class="row">
<div class="col-sm-12">
    <div class="box">

        <div class="box-header with-border">
            <a href="{{ url('sos') }}">
                <button class="btn btn-danger btn-sm pull-right" type="submit">
                    <i class="mdi mdi-keyboard-backspace mr-2"></i>
                    @lang('view_pages.back')
                </button>
            </a>
        </div>

<div class="col-sm-12">

<form  method="post" class="form-horizontal" action="{{url('sos/update',$sos->id)}}" enctype="multipart/form-data">
{{csrf_field()}}



<div class="row">

        <div class="col-6">
        <div class="form-group">
        <label for="admin_id">@lang('view_pages.select_area')
            <span class="text-danger">*</span>
        </label>
        <select name="service_location_id" id="service_location_id" class="form-control" required>
            <option value="" >@lang('view_pages.select_area')</option>
            @foreach($cities as $key=>$city)
            <option value="{{$city->id}}" {{ $city->id == $sos->service_location_id ? 'selected' : '' }}>{{$city->name}}</option>
            @endforeach
        </select>
        </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
            <label for="name">@lang('view_pages.name') <span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="name" name="name" value="{{old('name',$sos->name)}}" required="" placeholder="@lang('view_pages.enter_name')">
            <span class="text-danger">{{ $errors->first('name') }}</span>

        </div>
    </div>
               <div class="col-sm-6">
            <div class="form-group">
            <label for="number">@lang('view_pages.number') <span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="number" name="number" value="{{old('number',$sos->number)}}" required="" placeholder="@lang('view_pages.enter_number')">
            <span class="text-danger">{{ $errors->first('number') }}</span>

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

@endsection
