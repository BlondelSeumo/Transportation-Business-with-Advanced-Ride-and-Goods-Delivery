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
            <a href="{{ url('fleets') }}">
                <button class="btn btn-danger btn-sm pull-right" type="submit">
                    <i class="mdi mdi-keyboard-backspace mr-2"></i>
                    @lang('view_pages.back')
                </button>
            </a>
        </div>

<div class="col-sm-12">

<form  method="post" class="form-horizontal" action="{{url('fleets/assign_driver',$fleet->id)}}">
@csrf

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="driver">@lang('view_pages.select_driver') <span class="text-danger">*</span></label>
                <select name="driver" id="driver" class="form-control select2" required>
                    <option value="" selected disabled>@lang('view_pages.select')</option>
                    @foreach($drivers as $driver)
                    <option value="{{ $driver->id }}" {{ old('driver') == $driver->id ? 'selected' : '' }}>{{ $driver->name }}</option>
                    @endforeach
                </select>
                <span class="text-danger">{{ $errors->first('driver') }}</span>

            </div>
        </div>
    </div>

</div>


    <div class="form-group">
        <div class="col-12">
            <button class="btn btn-primary pull-right btn-sm m-5" type="submit">
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

@endsection
