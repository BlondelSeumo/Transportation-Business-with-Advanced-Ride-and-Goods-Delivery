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
                            <a href="{{ url('cancellation') }}">
                                <button class="btn btn-danger btn-sm pull-right" type="submit">
                                    <i class="mdi mdi-keyboard-backspace mr-2"></i>
                                    @lang('view_pages.back')
                                </button>
                            </a>
                        </div>

                        <div class="col-sm-12">

                            <form method="post" class="form-horizontal" action="{{ url('cancellation/update',$item->id) }}">
                                @csrf

                                
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="user_type">@lang('view_pages.user_type') <span class="text-danger">*</span></label>
                                            <select name="user_type" id="user_type" class="form-control" required>
                                                <option value="" selected disabled>@lang('view_pages.select')</option>
                                                <option value="user" {{ old('user_type',$item->user_type) == 'user' ? 'selected' : '' }} >@lang('view_pages.user')</option>
                                                <option value="driver" {{ old('user_type',$item->user_type) == 'driver' ? 'selected' : '' }} >@lang('view_pages.driver')</option>
                                            </select>
                                            <span class="text-danger">{{ $errors->first('user_type') }}</span>
                                        </div>
                                    </div>
                            @if($app_for == "super" || $app_for == "bidding")                                     
                                  <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">@lang('view_pages.transport_type') <span class="text-danger">*</span></label>
                                            <select name="transport_type" id="transport_type" class="form-control" required>
                                                <option value="" selected disabled>@lang('view_pages.select')</option>
                                                <option value="taxi" {{ old('transport_type', $item->transport_type) == 'taxi' ? 'selected' : '' }}>@lang('view_pages.taxi')</option>
                                                <option value="delivery" {{ old('transport_type', $item->transport_type) == 'delivery' ? 'selected' : '' }}>@lang('view_pages.delivery')</option>
                                                <option value="both" {{ old('transport_type', $item->transport_type) == 'both' ? 'selected' : '' }}>@lang('view_pages.both')</option>
                                            </select>
                                            <span class="text-danger">{{ $errors->first('transport_type') }}</span>
                                        </div>
                                    </div>
                                @endif
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="payment_type">@lang('view_pages.payment_type') <span class="text-danger">*</span></label>
                                            <select name="payment_type" id="payment_type" class="form-control" required>
                                                <option value="" selected disabled>@lang('view_pages.select')</option>
                                                <option value="free" {{ old('payment_type',$item->payment_type) == 'free' ? 'selected' : '' }} >@lang('view_pages.free')</option>
                                                <option value="compensate" {{ old('payment_type',$item->payment_type) == 'compensate' ? 'selected' : '' }} >@lang('view_pages.compensate')</option>
                                            </select>
                                            <span class="text-danger">{{ $errors->first('payment_type') }}</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="arrival_status">@lang('view_pages.arrival_status') <span class="text-danger">*</span></label>
                                            <select name="arrival_status" id="arrival_status" class="form-control" required>
                                                <!-- <option value="" selected disabled>@lang('view_pages.select')</option> -->
                                                <option value="before" {{ old('arrival_status',$item->arrival_status) == 'before' ? 'selected' : '' }} >@lang('view_pages.before')</option>
                                                <option value="after" {{ old('arrival_status',$item->arrival_status) == 'after' ? 'selected' : '' }} >@lang('view_pages.after')</option>
                                            </select>
                                            <span class="text-danger">{{ $errors->first('arrival_status') }}</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="reason">@lang('view_pages.reason') <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="reason" name="reason"
                                                value="{{ old('reason',$item->reason) }}" required
                                                placeholder="@lang('view_pages.enter') @lang('view_pages.reason')">
                                            <span class="text-danger">{{ $errors->first('reason') }}</span>
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
