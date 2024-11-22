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

                            <form method="post" class="form-horizontal" action="{{ url('mail_templates/send_test_mail') }}">
                                @csrf
                               <span class="text-danger">{{ $errors->first('to_mail') }}</span>

                                <div class="row">
                                    <div class="col-12">
                                             <div class="form-group">
                                               <label for="to_mail">@lang('view_pages.to_mail') <span class="text-danger">*</span></label>
                                                <input type="mail" class="form-control" name="to_mail" placeholder="Enter Your mail Address"></textarea>
                                            </div>
                                        </div>  
                                    </div>                              
                                   <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                               <label for="description">@lang('view_pages.description') <span class="text-danger">*</span></label>
                                                <textarea class="form-control" name="description" placeholder="Enter Your Text and Check Your mail Credentials are Correct"></textarea>
                                            </div>
                                        </div>
                                    </div> 
                              <div class="row">
                                <div class="form-group">
                                    <div class="col-12">
                                        <button class="btn btn-primary btn-sm pull-right m-5" type="submit">
                                            @lang('view_pages.send')
                                        </button>
                                    </div>
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
