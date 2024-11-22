@extends('admin.layouts.web_header')

@section('title', 'Admin')

<style>
  .driver a.nav-link {
    display: block;
  }

  #welcome:before {
    position: absolute;
    content: " ";
    top: 0;
    left: 0;
    width: 100%;
    height: 75vh;
    display: block;
    z-index: 0;
    background-image: linear-gradient(rgb(70 159 228 / 80%), rgba(0, 0, 0, 0));
  }

  .nav-link.driver {
    background: var(--logo-gradient);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  .nav-link.driver::before {
    content: "";
    position: absolute;
    left: .75rem;
    right: .75rem;
    bottom: .25rem;
    border-top: 2px solid #3dd845;
  }
  .list-styled-link.apply::before {
        content: "";
        position: absolute;
        left: 1.75rem;
        right: 4.75rem;
        bottom: 7.75rem;
        border-top: 2px solid #3dd845;
    }
  
</style>
@if($data)
<section class="py-15 mt-10" id="welcome" data-jarallax data-speed=".8" style="background-image: url({{ asset($p.$data->afrimage) }});">
  <div class="container">
    <br><br><br><br><br>
  </div>
</section>


<section class="pt-12 bg-light">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
        <h2 class="text-uppercase font-weight-bolder">
           {!! $data->afrhtext !!}
        </h2>
        <div class="row">
          <div class="col-md-6 m-auto">
            <div class="row">
              <div class="col-md-6 mb-5 text-md-right">
                <a href="{{ url($data->driverioslink) }}" target="_blank">
                  <img src="{{asset($p.$data->playstoreicon1)}}" alt="" class="w-50 w-md-100 wow slideInLeft">
                </a>
              </div>
              <div class="col-md-6 mb-5 text-md-left">
                <a href="{{ url($data->driverandroidlink) }}" target="_blank">
                  <img src="{{asset($p.$data->playstoreicon2)}}" alt="" class="w-50 w-md-100 wow slideInRight">
                </a>
              </div>
            </div>
          </div>
        </div>
        <h5>
          {!! $data->afrstext !!}
          
        </h5>
      </div>
    </div>
  </div>
</section>
<section class="pt-12 pb-10 bg-light">
  <div class="container">
    <div class="row">
      <div class="col-md-11 text-justify">
        <p>
          {!! $data->asrtext !!} 
        </p>
      </div>
    </div>
    <div class="row">

      <div class="col-md-4 mb-5">
        <div class=" dan-card-30 card lift p-5 mb-md-0 ">
          <div class=" card-img-top position-relative mx-auto " style=" max-width: 120px; ">
            <img class=" img-fluid " src="{{ asset($p.$data->asrimage1) }}" alt=" ... ">
          </div>
          <div class=" card-body text-center " style="min-height: 160px;">
            <h6 class=" mb-4 text-dark ">
              {!! $data->asrhtext1 !!}
            </h6>
            <p class=" mb-0 text-gray-500 ">
              {!! $data->asrstext1 !!}
            </p>
          </div>
        </div>
      </div>

      <div class="col-md-4 mb-5">
        <div class=" dan-card-30 card lift p-5 mb-md-0 ">
          <div class=" card-img-top position-relative mx-auto " style=" max-width: 120px; ">
            <img class=" img-fluid " src="{{ asset($p.$data->asrimage2) }}" alt=" ... ">
          </div>
          <div class=" card-body text-center " style="min-height: 160px;">
            <h6 class=" mb-4 text-dark ">
              {!! $data->asrhtext2 !!}
            </h6>
            <p class=" mb-0 text-gray-500 ">
              {!! $data->asrstext2 !!}
            </p>
          </div>
        </div>
      </div>

      <div class="col-md-4 mb-5">
        <div class=" dan-card-30 card lift p-5 mb-md-0 ">
          <div class=" card-img-top position-relative mx-auto " style=" max-width: 120px; ">
            <img class=" img-fluid " src="{{ asset($p.$data->asrimage3) }} " alt=" ... ">
          </div>
          <div class=" card-body text-center " style="min-height: 160px;">
            <h6 class=" mb-4 text-dark ">
              {!! $data->asrhtext3 !!}
            </h6>
            <p class=" mb-0 text-gray-500 ">
              {!! $data->asrstext3 !!}
            </p>
          </div>
        </div>
      </div>


    </div>
  </div>
</section>

<section id="Features" class="py-10 bg-light">
  <div class="container">
    <div class="row">
      <div class="col-md-12 ml-auto pb-5">
        <h2 class="text-uppercase font-weight-bolder wow lightSpeedIn">
          {!! $data->atrhtext !!}
        </h2>
      </div>

      <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4 m-auto pb-4 wow fadeInUp">
        <div class="dan-card-34 lift shadow shadow-border shadow-hover bg-white">
          <h2 class="categories-title">
           {!! $data->atrthtext1 !!}
          </h2>
          <a class='normal text-center' href='#'>
            <img src="{{ asset($p.$data->atrtimage1) }}" alt="" class="w-50 rounded-circle">
          </a>
          <div class="text-muted p-4 m-0 bg-white text-center" style="min-height: 300px;">
            {!! $data->atrtstext1 !!}
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4 m-auto pb-4 wow fadeInUp" data-wow-delay=".3s">
        <div class="dan-card-34 lift shadow shadow-border shadow-hover bg-white">
          <h2 class="categories-title">
            {!! $data->atrthtext2 !!}
          </h2>
          <a class='normal text-center' href='#'>
            <img src="{{ asset($p.$data->atrtimage2) }}" alt="" class="w-50 rounded-circle">
          </a>
          <div>
            <div class="text-muted p-4 m-0 bg-white text-center" style="min-height: 300px;">
              {!! $data->atrtstext2 !!}
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-md-6 col-lg-6 col-xl-4 m-auto pb-4 wow fadeInUp" data-wow-delay=".6s">
        <div class="dan-card-34 lift shadow shadow-border shadow-hover bg-white">
          <h2 class="categories-title">
            {!! $data->atrthtext3 !!}
          </h2>
          <a class='normal text-center' href='#'>
            <img src="{{ asset($p.$data->atrtimage3) }}" alt="" class="w-50 rounded-circle">
          </a>
          <div>
            <div class="text-muted p-4 m-0 bg-white text-center" style="min-height: 300px;">
              {!! $data->atrtstext3 !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="slice slice-lg bg-gradient-primary bg-cover py-10" style="background: var(--logo-gradient);background-image: url('{{ asset($p.$data->afrbimage) }}')">
  <div class="container">
    <div class="mb-5 text-center">
      <h3 class="text-white mt-4">{!! $data->afrheadtext !!}</h3>
      <div class="fluid-paragraph mt-3">
      </div>
    </div>
    <div class="row row-grid align-items-center">
      <div class="col-lg-4">
        <div class="d-flex align-items-start mb-5">
          <div class="pr-4">
            <div class="icon icon-shape bg-white text-primary box-shadow-3 rounded-circle" style="background: {{ $data->hdriverdownloadcolor }} !important;">
              1
            </div>
          </div>
          <div class="icon-text">
            <h5 class="h5 text-white">
              {!! $data->afrstext1 !!}
            </h5>
            <p class="mb-0 text-white"><br><br></p>
          </div>
        </div>
        <div class="d-flex align-items-start">
          <div class="pr-4">
            <div class="icon icon-shape bg-white text-primary box-shadow-3 rounded-circle" style="background: {{ $data->hdriverdownloadcolor }} !important;">
              2
            </div>
          </div>
          <div class="icon-text">
            <h5 class="text-white">
              {!! $data->afrstext2 !!}
            </h5>
            <p class="mb-0 text-white"><br><br></p>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="position-relative" style="z-index: 10;">
          <img alt="Image placeholder" src="{{ asset($p.$data->afrlimage) }}" class="img-center img-fluid">
        </div>
      </div>
      <div class="col-lg-4">
        <div class="d-flex align-items-start mb-5">
          <div class="pr-4">
            <div class="icon icon-shape bg-white text-primary box-shadow-3 rounded-circle" style="background: {{ $data->hdriverdownloadcolor }} !important;">
              3
            </div>
          </div>
          <div class="icon-text">
            <h5 class="text-white">
              {!! $data->afrstext3 !!}
            </h5>
            <p class="mb-0 text-white"><br><br></p>
          </div>
        </div>
        <div class="d-flex align-items-start">
          <div class="pr-4">
            <div class="icon icon-shape bg-white text-primary box-shadow-3 rounded-circle" style="background: {{ $data->hdriverdownloadcolor }} !important;">
              4
            </div>
          </div>
          <div class="icon-text">
            <h5 class="text-white">
              {!! $data->afrstext4 !!}
            </h5>
            <p class="mb-0 text-white"><br><br></p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 m-auto">
      <div class="row">
        <div class="col-md-6 mb-5 text-md-right">
          <a href="{{ url($data->driverioslink) }}" target="_blank">
            <img src="{{ asset($p.$data->playstoreicon1) }}" alt="" class="w-50 w-md-50 wow slideInLeft">
          </a>
        </div>
        <div class="col-md-6 mb-5 text-md-left">
          <a href="{{ url($data->driverandroidlink) }}" target="_blank">
            <img src="{{ asset($p.$data->playstoreicon2) }}" alt="" class="w-50 w-md-50 wow slideInRight">
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
@endif
@extends('admin.layouts.web_footer')
