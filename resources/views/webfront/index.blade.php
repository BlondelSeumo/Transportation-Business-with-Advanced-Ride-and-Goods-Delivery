@extends('admin.layouts.web_header');

<style>
    .flickity-page-dots .dot.is-selected {
        background-color: #2bc9de;
    }



    #welcome:before {
        position: absolute;
        content: " ";
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: block;
        z-index: 0;
        /* background-image: linear-gradient(#00000099, #0009); */
        background-color: #ffffff;
    }

    .nav-link.home {
    background: var(--logo-gradient);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  .nav-link.home::before {
    content: "";
    position: absolute;
    left: .75rem;
    right: .75rem;
    bottom: .25rem;
    border-top: 2px solid #3dd845;
  }

  

</style>

<div id="home" class="container-fluid mt-10">

    <div class="row bg-cover" data-jarallax data-speed=".8" style="background: {{ $data->firstrowbgcolor }} !important;background-image: url(img/pattern-1.svg)">
        <div class="col-md-6 p-0">
            <img src="{{ asset($p.$data->bannerimage) }}" alt="" class="w-100">
        </div>
        <div class="col-md-6 py-10 py-md-0  m-auto">
            <div class="text-center">
            @if($data)
            
                <h1 class="text-white">
                  {!! $data->description !!}   
                </h1>
            
            @endif            
                <div class="row">
                    <div class="col-md-6 mb-5 text-md-right">
                        <a href="{{ url($data->userioslink) }}" target="_blank">
                            <img src="{{ asset($p.$data->playstoreicon1 ) }}" alt="" class="w-50 w-md-75 wow slideInLeft">
                        </a>
                    </div>
                    <div class="col-md-6 mb-5 text-md-left">
                        <a href="{{ url($data->userandroidlink) }}" target="_blank">
                            <img src="{{ asset($p.$data->playstoreicon2) }}" alt="" class="w-50 w-md-75 wow slideInRight">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- 
<section class="py-15 mt-10" id="welcome" data-jarallax data-speed=".8" style="background-image: url(img/1.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-7 text-white ml-auto">
                <h2>
                    It’s time to change your ride experience!
                    Download the app for free
                </h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6 mb-5 text-md-right">
                                <img src="img/app-store.svg" alt="" class="w-50 w-md-100 wow slideInLeft">
                            </div>
                            <div class="col-md-6 mb-5 text-md-left">
                                <img src="img/play-store.svg" alt="" class="w-50 w-md-100 wow slideInRight">
                            </div>
                        </div>
                    </div>
                </div>
                <h1>
                    No Mask.No ride
                </h1>
            </div>
        </div>
    </div>
</section> -->
  @if($data)
  

<section class="py-10 bg-light">
    <div class="container">
        <div class="row">

            <div class="col-md-4 m-auto">
                <div class=" dan-card-30 card lift p-5 mb-md-0 ">
                    <div class=" card-img-top position-relative mx-auto " style=" max-width: 120px; ">
                        <img class=" img-fluid " src="{{asset($p.$data->firstrowimage1)}}" alt=" ... ">
                    </div>
                    <div class=" card-body text-center ">
                        <h6 class=" mb-4 text-dark ">
                            {!! $data->firstrowheadtext1 !!}
                        </h6>
                        <p class=" mb-0 text-gray-500 ">
                            {!! $data->firstrowsubtext1 !!}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 m-auto">
                <div class=" dan-card-30 card lift p-5 mb-md-0 ">
                    <div class=" card-img-top position-relative mx-auto " style=" max-width: 120px; ">
                        <img class=" img-fluid " src="{{asset($p.$data->firstrowimage2)}}" alt=" ... ">
                    </div>
                    <div class=" card-body text-center ">
                        <h6 class=" mb-4 text-dark ">
                            {!! $data->firstrowheadtext2 !!}
                        </h6>
                        <p class=" mb-0 text-gray-500 ">
                            {!! $data->firstrowsubtext2 !!}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 m-auto">
                <div class=" dan-card-30 card lift p-5 mb-md-0 ">
                    <div class=" card-img-top position-relative mx-auto " style=" max-width: 120px; ">
                        <img class=" img-fluid " src="{{asset($p.$data->firstrowimage3)}} " alt=" ... ">
                    </div>
                    <div class=" card-body text-center ">
                        <h6 class=" mb-4 text-dark ">
                            {!! $data->firstrowheadtext3 !!}
                        </h6>
                        <p class=" mb-0 text-gray-500 ">
                            {!! $data->firstrowsubtext3 !!}                        
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container dan-slider-2 py-8">
    <div class="row position-relative align-items-center">
        <div class="col-md-5 position-static order-2 order-md-2">
            <!-- Slider -->
            <div class="position-static flickity-buttons-lg" id="sliderArrivals" data-flickity='{"pageDots": true}'>

                <!-- Item -->
                <div class="col-12">
                    <!-- Card -->
                    <div class="card">
                        <h2>
                            {!! $data->secondrowheadtext1 !!}
                        </h2>
                    </div>
                </div>

                <!-- Item -->
                <div class="col-12">
                    <!-- Card -->
                    <div class="card">
                        <h2>
                            {!! $data->secondrowheadtext2 !!}
                        </h2>
                    </div>
                </div>

                <!-- Item -->
                <div class="col-12">
                    <!-- Card -->
                    <div class="card">
                        <h2>
                            {!! $data->secondrowheadtext3 !!}
                        </h2>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-md-7 order-1 order-md-1">
            <!-- Slider -->
            <div data-flickity='{"fade": true, "asNavFor": "#sliderArrivals", "draggable": false}'>

                <!-- Item -->
                <div class="w-100">
                    <img src="{{asset($p.$data->secondrowimage1)}}" alt="..." class="w-100">
                </div>

                <!-- Item -->
                <div class="w-100">
                    <img src="{{asset($p.$data->secondrowimage2)}}" alt="..." class="w-100">
                </div>

                <!-- Item -->
                <div class="w-100">
                    <img src="{{asset($p.$data->secondrowimage3)}}" alt="..." class="w-100">
                </div>
            </div>
        </div>

    </div>
</div>
<section class="slice slice-lg bg-gradient-primary bg-cover py-10" style="background: var(--logo-gradient);background-image: url('{{ asset($p.$data->afrbimage) }}')">
  <div class="container">
    <div class="mb-5 text-center">
      <h3 class="text-white mt-4">{!! $data->afrheadtext !!}</h3>
      <div class="fluid-paragraph mt-3">
        <!-- <p class="lead lh-180 text-white">Start building fast, beautiful and modern looking websites in no time using our theme.</p> -->
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