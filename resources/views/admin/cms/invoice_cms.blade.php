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
                            <a href="{{ url('cms/invoicecms') }}">
                                <button class="btn btn-danger btn-sm pull-right" type="submit">
                                    <i class="mdi mdi-keyboard-backspace mr-2"></i>
                                    @lang('view_pages.back')
                                </button>
                            </a>
                        </div>

                        <div class="col-sm-12">

                           <form  method="post" class="form-horizontal" action="{{ route('invoicecmsadd') }}" enctype="multipart/form-data">
                                @csrf
                            <div class="form-group">
                                <div class="col-6">
                                    <label for="icon">Invoice Logo Image <span color="blue">Size(644px × 284px)</span></label><br>
                                    <img id="blah" src="@if($p) {{ $p.$data->invoice_logo }} @endif " alt=""><br>
                                    <input type="file" id="invoice_logo" onchange="readURL(this)" name="invoice_logo" style="display:none">
                                    <button class="btn btn-primary btn-sm" type="button" onclick="$('#invoice_logo').click()" id="upload">Browse</button>
                                    <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;">Remove</button><br>
                                    <span class="text-danger"> {{ $errors->first('invoice_logo') }}  </span>
                                    </div>
                            </div>

                            <div class="form-group">
                                <label><strong>Privacy Policy Link</strong></label>
                                <textarea class="form-control" name="privacy_policy_link">@if($data) {{ $data->privacy_policy_link }} @endif</textarea>
                            </div>
                            <div class="form-group">
                                <label><strong>Terms & Conditions Link :</strong></label>
                                <textarea class="form-control" name="terms_and_conditions_link">@if($data) {{ $data->terms_and_conditions_link }} @endif</textarea>
                            </div>
                            <div class="form-group">
                                <label><strong>Invoice Email</strong></label>
                                <textarea class="form-control" name="invoice_email">@if($data) {{ $data->invoice_email }} @endif</textarea>
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
