@extends('admin.layouts.app')


@section('title', 'Main page')

@section('content')
<!-- Add these styles to your stylesheet or in the head of your HTML -->
<style>


    .radio-img  > input {
  display:none;
}

.radio-img  > img{
  cursor:pointer;
  border:2px solid transparent;
}

.radio-img  > input:checked + img{
  border:5px solid #0b4dd8;
  box-shadow: 10px 13px 9px 10px rgba(237,237,237,0.6);

}
.instruction{
  margin:auto;
  padding:20px;
  border:1px solid #dedede;
  box-shadow: 10px 13px 9px 10px rgba(237,237,237,0.6);
}
</style>


<div class="grid columns-12 gap-6 mt-5">
    <div class="intro-y g-col-12 g-col-lg-12">
        <!-- BEGIN: Form Layout -->

        <div class="intro-y box p-10 mt-10">
          {{-- <div class="instruction mt-10" >
            <h3 class="text-center" style="font-size:24px;font-weight:800;text-decoration: underline;">Note</h3>
            <strong style="font-size:20px;padding:5px;">Open Street API's Works for Below Funtionality:</strong>
            <ul style="font-size:18px;margin-top:20px;">
              <li>Search autocomplete in User/Driver Apps.</li>
              <li>Coordinate to address search function.</li>
              <li>Distance matrix to calculate ETA & Bill.</li>
              <li><strong>Admin panel works with only using by google map API.</strong></li>
            </ul>
          </div> --}}
        <h4 class="p-5 text-center" style="margin-top:65px;">Choose Map Type</h4>
        @php
        $id = $item[0]->id;
        @endphp
            <form method="post" class="form-horizontal" action="{{ url('system/settings/map/store') }}" enctype="multipart/form-data">

            @csrf
                  <div class="row mt-10 p-5">
                  <div class="col-12 col-lg-2"> </div>
                    <div class="col-12 col-lg-4">
                        <label class="radio-img">
                        <input type="radio" name="map_type" value="google" {{ $item[0]->value == 'google' ? 'checked' : '' }} checked />
                        <img src="{{ asset('assets/img/google.jpg') }}" width="300" style="margin:auto;">
                        <div class="text-center mt-3">Google Map</div>
                      </label>
                    </div>

                    <div class="col-12 col-lg-4">
                      <label class="radio-img">
                        <input type="radio" name="map_type" value="open_street" {{ $item[0]->value == 'open_street' ? 'checked' : '' }} />
                        <img src="{{ asset('assets/img/road.png') }}" width="300" style="margin:auto;">
                        <div class="text-center mt-3">Open Street</div>
                      </label>
                    </div>
                    <div class="col-12 col-lg-2"> </div>
                  </div>

            <div class="text-end float-right mt-5">
                <button type="submit" class="btn btn-primary  text-end">{{ __('view_pages.save') }}</button>
            </div>
            </form>
        </div>
        <!-- END: Form Layout -->
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
{{--
<script>
  $(document).ready(function () {
    // Check if mobile_theme exists
    @if($mobile_theme)
      // If it exists, set the selected image
      $(".theme-image[data-image='{{ $mobile_theme->theme }}']").addClass("selected-image");
      $(".selectedImage").val('{{ $mobile_theme->theme }}');
    @endif

    $(".theme-image").click(function () {
      // Remove the selected class from all images
      $(".theme-image").removeClass("selected-image");

      // Add the selected class to the clicked image
      $(this).addClass("selected-image");

      // Set a hidden input value to store the selected image data
      $(".selectedImage").val($(this).data("image"));
    });
  });
</script>
--}}



@endsection
