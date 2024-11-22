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
                            <a href="{{ url('complaint/title') }}">
                                <button class="btn btn-danger btn-sm pull-right" type="submit">
                                    <i class="mdi mdi-keyboard-backspace mr-2"></i>
                                    @lang('view_pages.back')
                                </button>
                            </a>
                        </div>

                        <div class="col-sm-12">

                            <form method="post" class="form-horizontal" action="{{ url('complaint/title/update',$item->id) }}">
                                @csrf

                                <div class="row">
                                         <div class="col-sm-6">
                                             <div class="form-group">
                                            <label for="complaint_title_type">@lang('view_pages.complaint_title_type') <span class="text-danger">*</span></label>
                                            <select name="complaint_type" id="complaint_type" class="form-control" required>
                                                <!-- <option value="" selected disabled>@lang('view_pages.select')</option> -->
                                                <option value="request_help" {{ old('complaint_type',$item->complaint_type) == 'request_help' ? 'selected' : '' }} >@lang('view_pages.dispute')</option>
                                                <option value="general" {{ old('complaint_type',$item->complaint_type) == 'general' ? 'selected' : '' }} >@lang('view_pages.general')</option>

                                            </select>
                                            <span class="text-danger">{{ $errors->first('complaint_type') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="user_type">@lang('view_pages.user_type') <span class="text-danger">*</span></label>
                                            <select name="user_type" id="user_type" class="form-control" required>
                                                <option value="" selected disabled>@lang('view_pages.select')</option>
                                                <option value="user" {{ old('user_type',$item->user_type) == 'user' ? 'selected' : '' }} >@lang('view_pages.user')</option>
                                                <option value="driver" {{ old('user_type',$item->user_type) == 'driver' ? 'selected' : '' }} >@lang('view_pages.driver')</option>
                                                <option value="owner" {{ old('user_type',$item->user_type) == 'owner' ? 'selected' : '' }} >@lang('view_pages.owner')</option>
                                                {{-- <option value="both" {{ old('user_type') == 'both' ? 'selected' : '' }} >@lang('view_pages.both')</option> --}}
                                            </select>
                                            <span class="text-danger">{{ $errors->first('user_type') }}</span>
                                        </div>
                                    </div>
                                </div>
                          <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="title">@lang('view_pages.title') <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="title" name="title"
                                                value="{{ old('title',$item->title) }}" required
                                                placeholder="@lang('view_pages.enter') @lang('view_pages.title')">
                                            <span class="text-danger">{{ $errors->first('title') }}</span>
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
