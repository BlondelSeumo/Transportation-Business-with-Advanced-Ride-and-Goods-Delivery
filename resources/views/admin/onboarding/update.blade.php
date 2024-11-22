@extends('admin.layouts.app')
@section('title', 'Main page')

@section('content')
{{-- {{session()->get('errors')}} --}}
<style>

     .app {
        /* needed for demo only */
         margin: auto;
         width: 315px;
         height: 612px;
         border: 12px solid #6e6e72;
         border-radius: 48px;
         overflow: hidden;
        /* needed for demo only */
         display: grid;
         position: relative;
         grid-template-rows: auto 1fr auto;
         grid-template-columns: 100%;
         grid-template-areas: "appbar" "content" "tabbar";
         /* background-color: #87ba7b; */
    }

     .contents {
      grid-area: content;
        position: relative;
        top: 259px;
        left: 0px;
        height: 35%;
        padding: 32px 24px;
        border-radius: 40% 0 0 40%;
        text-align:center;
    }
     .head{
      grid-area: content;
      position: relative;
      z-index: 1;
         height: 44%;
       border-radius: 0 0 40% 0;
         //background: url('2151002728.jpg');
       background-size:cover ;
       background-repeat: no-repeat;
       background-position: center;
     }
     .foot{
      grid-area: content;
        position: relative;
        top: 465px;
        left: 0px;
        z-index: 1;
        height: 30%;
        border-radius: 0 40% 0 0;
        background-color: #d88e2c;
        text-align:center;
        color: #fff;

    }
    </style>

    <!-- Start Page content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="box">

                        <div class="box-header with-border">
                            <a href="{{ url('system/settings/onboarding') }}">
                                <button class="btn btn-danger btn-sm pull-right" type="submit">
                                    <i class="mdi mdi-keyboard-backspace mr-2"></i>
                                    @lang('view_pages.back')
                                </button>
                            </a>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 ">
                                <main class="app">
                                    @php
    $imagePath = 'storage/onboarding/upload/' . $item->onboarding_image;

@endphp
<header class="head" style="background: url('{{ asset($imagePath) }}');background-position:center;background-repeat:no-repeat;background-size: cover;">
</header>

                                    <section class="contents">
                                        <h3 id="titleHeading">{{ old('title', $item->title) }}</h3>
                                        <p id="descriptionParagraph">{!! strip_tags(html_entity_decode(old('title', $item->description))) !!}</p>


                                    </section>
                                    <nav class="foot">
                                <h4>Signup</h4>
                                <img src="{{ asset('assets/images/arrow.svg') }}" alt="" style="color: white;width: 20px;height: 20px;">

                                    </nav>
                                  </main>

                            </div>
                        <div class="col-sm-6 ">

                            <form method="post" class="form-horizontal" action="{{ url('system/settings/onboarding/update',$item->id) }}" enctype="multipart/form-data">

                                @csrf

                                    <input class="form-control" type="hidden" id="id" name="id" value="{{ old('id',$item->id) }}" required="">
                                    <div class="form-group">
                                        <label for="title">@lang('view_pages.onboarding_title') <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" id="title" name="title" value="{{ old('title', $item->title) }}" required placeholder="Enter title" oninput="updateHeading(this.value)">
                                        <span class="text-danger"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="description">@lang('view_pages.onboarding_description') <span class="text-danger">*</span></label>
                                        <textarea class="form-control" id="description" name="description" required placeholder="Enter description" oninput="updateParagraph(this.value)"  rows="10 ">{{ $item->description }}</textarea>
                                      </div>
                                    <div class="form-group">
                                        <div class="col-6">
                                            <label for="icon">@lang('view_pages.onboarding_image') Size(3584 x 5376 px)<span class="text-danger">*</span></label><br>
                                            <img id="blah" src="{{ $item->onboarding_image ? asset($p.$item->onboarding_image) : '' }}" alt=""><br>
                                            <input type="file" name="onboarding_image" id="onboarding_image" onchange="readURL(this)" style="display:none">
                                            <button class="btn btn-primary btn-sm" type="button" onclick="$('#onboarding_image').click()" id="upload">Browse</button>
                                            <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;">Remove</button><br>
                                            <span class="text-danger">{{ $errors->first('onboarding_image') }}</span>
                                        </div>
                                    </div>




                                <div class="form-group">
                                    <div class="col-12">
                                        <button class="btn btn-primary btn-sm pull-right m-5" type="submit">Update</button>
                                    </div>
                                </div>
                            </form>

                                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    function updateParagraph(value) {
       document.getElementById('descriptionParagraph').innerText = value;
   }

   $(document).ready(function() {
      $('.ckeditor').ckeditor();
   });

   // Function to update the title heading
   function updateHeading(value) {
       document.getElementById('titleHeading').innerText = value;
   }
   updateParagraph(document.getElementById('description').value);
   function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#blah').attr('src', e.target.result);
            // Update background image of header
            $('.head').css('background-image', 'url(' + e.target.result + ')');
        }

        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
