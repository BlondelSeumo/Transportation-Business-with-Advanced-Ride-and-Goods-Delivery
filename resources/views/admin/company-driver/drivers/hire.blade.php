@extends('admin.layouts.app')

@section('content')


<br>

<div class="row p-0 m-0">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ url('company/drivers/hire') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12 float-left mb-md-3">
                            <div class="form-group">
                                <label for="driver">@lang('view_pages.driver_uuid') <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="driver" name="driver" value="{{ old('driver') }}" required="" placeholder="@lang('view_pages.enter') @lang('view_pages.driver_uuid')">
                                <span class="text-danger">{{ $errors->first('driver') }}</span>
                            </div>
                        </div>

                        <div class="col-12 btn-group mt-3">
                            <ul class="admin-add-btn">
                               
                                    <button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">{{ trans('view_pages.hire') }}</button>
                               
                            </ul>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


@endsection

