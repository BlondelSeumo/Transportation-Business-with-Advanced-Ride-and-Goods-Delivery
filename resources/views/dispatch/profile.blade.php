@extends('dispatch.layout')

@section('dispatch-content')
<main class="main">
    <div class="container-fluid">
      @include('dispatch.header')
      {{-- <div class="row g-0 mt-2">
        <div class=" col-md-6 col-xxl-3 mb-3 pe-md-2">
          <div class="card h-md-100">
            <div class="card-header pb-0">
              <h6 class="mb-0 mt-2 d-flex align-items-center">@lang('view_pages.weekly_sales')</h6>
            </div>
            <div class="card-body d-flex align-items-end">
              <div class="row flex-grow-1">
                <div class="col">
                  <div class="fs-4 fw-normal font-sans-serif text-700 lh-1 mb-1">$47K</div>
                  <span class="badge badge-soft-success rounded-pill fs--2">+3.5%</span>
                </div>
                <div class="col-auto ps-0">
                 @lang('view_pages.icons')
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> --}}

        <div class="col-md-12 mb-3 ps-md-2">
          <form action="" method="post">
          <div class="card h-md-100">
            <div class="card-header d-flex flex-between-center pb-0">
              <h5 class="mb-0">
               @lang('view_pages.personal_info')
              </h5>
            </div>
            <div class="card-body pt-2">
              <div class="row">
                <div class="col-md-8">
                  <h6 class="mb-0">
                    @lang('view_pages.first_name')
                  </h6>
                  <div class="input-group mb-3">
                    <input class="form-control" type="text" placeholder="FirstName" aria-label="FirstName" />
                  </div>
                  <h6 class="mb-0">
                    @lang('view_pages.last_name')
                  </h6>
                  <div class="input-group mb-3">
                    <input class="form-control" type="text" placeholder="Lastname" aria-label="Lastname"/>
                  </div>
                  <h6 class="mb-0">
                    @lang('view_pages.new_password')
                  </h6>
                  <div class="input-group mb-3">
                    <input class="form-control" type="password" placeholder="Password" aria-label="Password"/>
                  </div>
                </div>
                <div class="col-md-4 m-auto text-center">
                  <img src="{{ asset('dispatcher/profile-img.png') }}" alt="" class="w-25" id="img-src">
                  <input type="file" id="profile_picture" onchange="readURL(this)" name="profile_picture" style="display:none">
                  <button class="btn btn-primary btn-sm" type="button" onclick="$('#profile_picture').click()" id="upload"> @lang('view_pages.browse')</button>
                  <button class="btn btn-danger btn-sm" type="button" id="remove_img" style="display: none;"> @lang('view_pages.remove')</button><br>
                </div>
              </div>
            </div>
            <div class="row" style="margin-left: auto;">
              <div class="col-ma-1">
                <button class="btn btn-success btn-sm me-1 mb-1" type="button"> @lang('view_pages.update')</button>
              </div>
            </div>
          </div>
        </form>
        </div>
      </div>
    </div>
  </main>

  @push('dispatch-js')
  <script>
    function readURL(input) {
        var parentDiv = input.closest('div');

           if (input.files && input.files[0]) {
               var reader = new FileReader();
               reader.onload = function(e) {
                   if(e.target.result){
                       parentDiv.childNodes[5].innerText = 'Change';
                       parentDiv.childNodes[7].style.display = 'inline-block';
                   }else{
                       parentDiv.childNodes[7].style.display = 'none';
                       parentDiv.childNodes[5].innerText = 'Browse';
                   }
                   parentDiv.childNodes[1].setAttribute('src', e.target.result);
               }
               reader.readAsDataURL(input.files[0]);
           }
       }
  
      $(document).on('click','#remove_img',function(){
          var defaultImg = "{{ asset('dispatcher/profile-img.png') }}";
           $('#img-src').removeAttr('src');
           $('#remove_img').hide();
           $('#upload').text('Browse');
           $('#img-src').attr('src',defaultImg);
       });
  </script>
  @endpush
  @endsection