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
                            <a href="{{ url('carmake') }}">
                                <button class="btn btn-danger btn-sm pull-right" type="submit">
                                    <i class="mdi mdi-keyboard-backspace mr-2"></i>
                                    @lang('view_pages.back')
                                </button>
                            </a>
                        </div>

                        <div class="col-sm-12">

                           <form  method="post" class="form-horizontal" action="{{ route('playstorepageadd') }}" enctype="multipart/form-data">
                                @csrf

                            <div class="form-group">
                                <label><strong>User IOS Link :</strong></label>
                                <textarea class="form-control" name="userioslink">@if($data) {{ $data->userioslink }} @endif</textarea>
                            </div>
                            <div class="form-group">
                                <label><strong>User Android Link :</strong></label>
                                <textarea class="form-control" name="userandroidlink">@if($data) {{ $data->userandroidlink }} @endif</textarea>
                            </div>

                            <div class="form-group">
                                <label><strong>Driver IOS Link :</strong></label>
                                <textarea class="form-control" name="driverioslink">@if($data) {{ $data->driverioslink }} @endif</textarea>
                            </div>
                            <div class="form-group">
                                <label><strong>Driver Android Link :</strong></label>
                                <textarea class="form-control" name="driverandroidlink">@if($data) {{ $data->driverandroidlink }} @endif</textarea>
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
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

<script type="text/javascript">

    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });

</script>
@endsection
