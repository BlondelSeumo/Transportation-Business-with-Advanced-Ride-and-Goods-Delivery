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
                            <a href="{{ url('mail_templates') }}">
                                <button class="btn btn-danger btn-sm pull-right" type="submit">
                                    <i class="mdi mdi-keyboard-backspace mr-2"></i>
                                    @lang('view_pages.back')
                                </button>
                            </a>
                        </div>

                        <div class="col-sm-12">

                            <form method="post" class="form-horizontal" action="{{ url('mail_templates/store') }}">
                                @csrf

                                <div class="row">
                        
                                <div class="col-6">
                                        <div class="form-group">
                                            <label for="">@lang('view_pages.mail_type') <span class="text-danger">*</span></label>
                                            <select name="mail_type" id="mail_type" class="form-control" required>
                                                <option value="" selected disabled>@lang('view_pages.select')</option>
                                                <option value="welcome_mail" {{ old('mail_type') == 'welcome_mail' ? 'selected' : '' }}>@lang('view_pages.welcome_mail')</option>
                                                <option value="trip_start_mail" {{ old('mail_type') == 'trip_start_mail' ? 'selected' : '' }}>@lang('view_pages.trip_start_mail')</option>
                                            </select>
                                            <span class="text-danger">{{ $errors->first('mail_type') }}</span>
                                        </div>
                                    </div>
                                </div>

                           <div class="row">
                                <div class="col-12">
                                     <div class="form-group">
                                       <label for="description">@lang('view_pages.description') <span class="text-danger">*</span></label>
                                        <textarea class="ckeditor form-control" name="description"></textarea>
                                    </div>
                                </div>
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
    <!-- container -->
</div>
    <!-- content -->
<!-- ck editor -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>

<script type="text/javascript">

    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });

</script>


@endsection
