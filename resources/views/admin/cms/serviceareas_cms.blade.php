@extends('admin.layouts.app')
@section('title', 'Main page')


@section('content')
{{-- {{session()->get('errors')}} --}}
<style>
    [type="checkbox"]:checked, [type="checkbox"]:not(:checked) {
    position: relative;
    left: 0px;
    opacity: 1;
}
</style>
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

                           <form  method="post" class="form-horizontal" action="{{ route('servicepageadd') }}" enctype="multipart/form-data">
                                @csrf
                            <div class="form-group">
                                <label><strong>Servicearea Header Text :</strong></label>
                                <textarea class="ckeditor form-control" name="serviceheadtext">@if($data) {{ $data->serviceheadtext }} @endif</textarea>
                            </div>
                            <div class="form-group">
                                <label><strong>Servicearea Sub Text :</strong></label>
                                <textarea class="ckeditor form-control" name="servicesubtext">@if($data) {{ $data->servicesubtext }} @endif</textarea>
                            </div>

<div class="form-group">
                                <div class="col-6">
                                    <label for="icon">Upload Servicearea Image 1 Size(359px × 359px)</label><br>
                                    <div id="existing-images">
                                        @foreach ($serv as $key => $value)
                                            <div id="image-container-{{ $key }}">
                                                <img id="blah{{ $key }}" src="{{ $p . $value }}" alt="Image {{ $key }}" style="max-width: 100px; display: block;"><br>
                                                <input type="checkbox" name="remove_images[]" value="{{ $value }}"> Remove<br>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div id="new-images"></div>
                                    <input type="file" id="serviceasimage" multiple="multiple" onchange="previewImages(this)" name="serviceimage[]" style="display:none">
                                    <button class="btn btn-primary btn-sm" type="button" onclick="document.getElementById('serviceasimage').click()" id="upload">Browse</button>
                                    <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;">Remove</button><br>
                                    <span class="text-danger">{{ $errors->first('serviceimage') }}</span>
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
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

<script type="text/javascript">

    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });
document.addEventListener('DOMContentLoaded', (event) => {
    // Function to preview images before uploading
    function previewImages(input) {
        const newImagesDiv = document.getElementById('new-images');
        newImagesDiv.innerHTML = ''; // Clear existing previews
        if (input.files) {
            for (let i = 0; i < input.files.length; i++) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    let newImg = document.createElement('div');
                    newImg.innerHTML = <img src="${e.target.result}" style="max-width: 100px; display: block;"><br>;
                    newImagesDiv.appendChild(newImg);
                }
                reader.readAsDataURL(input.files[i]);
            }
        }
    }

    document.getElementById('remove_img').addEventListener('click', function() {
        document.querySelectorAll('[id^=blah]').forEach(function(img) {
            img.src = '';
        });
        document.getElementById('serviceasimage').value = '';
        this.style.display = 'none';
    });

    // Attach event listeners to dynamically handle the removal of images
    document.querySelectorAll('input[name="remove_images[]"]').forEach((checkbox) => {
        checkbox.addEventListener('change', function() {
            const containerId = 'image-container-' + this.value;
            const container = document.getElementById(containerId);
            if (container) {
                container.style.display = this.checked ? 'none' : 'block';
            }
        });
    });

    // Add event listener for the file input to show preview of new images
    document.getElementById('serviceasimage').addEventListener('change', function() {
        previewImages(this);
    });
});
</script>
@endsection
