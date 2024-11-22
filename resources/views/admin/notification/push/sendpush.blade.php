@extends('admin.layouts.app')
@section('title', 'Main page')

@section('content')

<!-- iCheck for checkboxes and radio inputs -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link rel="stylesheet" href="{{ asset('assets/vendor_plugins/iCheck/all.css') }}">
{{-- {{session()->get('errors')}} --}}

    <!-- Start Page content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="box">

                        <div class="box-header with-border">
                            <a href="{{ url('notifications/push') }}">
                                <button class="btn btn-danger btn-sm pull-right" type="submit">
                                    <i class="mdi mdi-keyboard-backspace mr-2"></i>
                                    @lang('view_pages.back')
                                </button>
                            </a>
                        </div>

                        <div class="col-sm-12">

                            <form method="post" class="form-horizontal" action="{{ url('notifications/push/send') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="user">@lang('view_pages.user') <span class="text-danger">*</span></label>
                                            <select name="user[]" id="user" class="form-control select2"  multiple="multiple" data-placeholder="Select User">
                                                {{-- <option value="" selected disabled>@lang('view_pages.select')</option> --}}
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}" {{ old('user') == $user->id ? 'selected' : '' }}>{{ ucfirst($user->name) }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">{{ $errors->first('user') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 mt-30">
                                        <div class="form-group">
                                            <input type="checkbox" id="all_user" name="all_user" class="filled-in chk-col-light-blue mt-4 selectAll" data-type="user"/>
					                        <label for="all_user">@lang('view_pages.select_all')</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="driver">@lang('view_pages.driver') <span class="text-danger">*</span></label>
                                            <select name="driver[]" id="driver" class="form-control select2"  multiple="multiple" data-placeholder="Select Driver">
                                                {{-- <option value="" selected disabled>@lang('view_pages.select')</option> --}}
                                                @foreach ($drivers as $driver)
                                                    <option value="{{ $driver->id }}" {{ old('driver') == $driver->id ? 'selected' : '' }}>{{ ucfirst($driver->name) }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">{{ $errors->first('driver') }}</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-2 mt-30">
                                        <div class="form-group">
                                            <input type="checkbox" id="all_driver" name="all_driver" class="filled-in chk-col-light-blue mt-4 selectAll" data-type="driver"/>
					                        <label for="all_driver">@lang('view_pages.select_all')</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="title">@lang('view_pages.push_title') <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="title" name="title"
                                                value="{{ old('title') }}" required
                                                placeholder="@lang('view_pages.enter') @lang('view_pages.push_title')">
                                            <span class="text-danger">{{ $errors->first('title') }}</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="message">@lang('view_pages.message') <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="message" id="message" rows="3" placeholder="@lang('view_pages.enter') @lang('view_pages.message')" required>{{ old('message') }}</textarea>
                                            <span class="text-danger">{{ $errors->first('message') }}</span>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="image">@lang('view_pages.push_image')</label><br>
                                            <img id="blah" src="#" alt=""><br>
                                            <input type="file" id="image" onchange="readURL(this)" name="image" style="display:none">
                                            <button class="btn btn-primary btn-sm" type="button" onclick="$('#image').click()" id="upload">@lang('view_pages.browse')</button>
                                            <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;">@lang('view_pages.remove')</button><br>
                                            <span class="text-danger">{{ $errors->first('image') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-12">
                                        <button class="btn btn-primary btn-sm pull-right m-5 sendPush" type="submit">
                                            @lang('view_pages.send')
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
    $(document).ready(function() {
        $(".selectAll").click(function(){
            var user_type = $(this).attr('data-type');

            if($(this).is(':checked') ){
                $("#"+user_type).find('option').prop("selected",true);
                // alert($("#"+user_type).find('option:selected').length);
                $("#"+user_type).trigger('change');
                $("li.select2-selection__choice").css('display', 'none');
                
            } else {
                $("#"+user_type).find('option').prop("selected",false);
                $("#"+user_type).trigger('change');
                  $("li.select2-selection__choice").css('display', 'block');
            }
        });
    });

   $('.select2').select2({
        placeholder : "Select ...",
    });
    $(document).on('click','.sendPush',function(){
        var isUserSelected = $('#user option:not([disabled])').is(':selected');
        var isDriverSelected = $('#driver option:not([disabled])').is(':selected');

        if(!isUserSelected && !isDriverSelected){
            $.toast({
                heading: '',
                text: 'You have to Select atleast one user or driver',
                position: 'top-center',
                loaderBg: '#ff6849',
                icon: 'error',
                hideAfter: 5000,
                stack: 1
            });
            return false;
        }
    });
</script>
@endsection
