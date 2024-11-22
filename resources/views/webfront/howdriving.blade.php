@extends('admin.layouts.web_header')

@section('title', 'Admin')

<style>
    .driver a.nav-link {
        display: block;
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
    .list-styled-link.drive::before {
        content: "";
        position: absolute;
        left: 1.75rem;
        right: 4.75rem;
        bottom: 5.5rem;
        border-top: 2px solid #3dd845;
    }

    h3 {
        color: #44a4e3;
        background: var(--logo-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    b {
        background:{{  $data->hownumberbgcolor }} !important;
        color: #fff !important;
        font-size: 30px;
        border-radius: 50%;
        padding: 3px 10px;
    }

    @media (max-width:678px) {
        b {
            display: none;
        }
    }
</style>
@if($data)
<section class="py-15 mt-10" id="welcome" data-jarallax data-speed=".8" style="background-image: url('{{ asset($p.$data->howbannerimage) }}');">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-7 col-lg-5 text-white">
                <br><br><br><br><br>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <div class="row p-5 py-md-10">
        <div class="col-6 col-md-4 p-0 m-auto text-center">
            <b style="background: {{ $data->hownumberbgcolor }} !important;">
                1.
            </b>
            <h3>
                {!! $data->hfrht1 !!}
            </h3>
        </div>
        <div class="col-6 col-md-2 p-0 text-center">
            <a data-fancybox="driver" href="{{ asset($p.$data->hfrcimage1) }}">
                <img src="{{asset($p.$data->hfrcimage1) }}" alt="Your-Brand,-Your-Logo" class="w-50 w-md-100">
            </a>
        </div>
        <div class="col-md-6 m-auto font-weight-lighter pt-5 pt-md-10 text-md-left">
            <h4>
                {!! $data->hfrht2 !!}
            </h4>
            <div class="row">
                <div class="col-6 mb-1">
                    <a href="{{ url($data->driverandroidlink) }}" target="_blank">
                    <img src="{{asset($p.$data->playstoreicon2)}}" alt="" class="w-100 w-md-75 wow slideInLeft animated" style="visibility: visible;">
                </a>
                </div>
                <div class="col-6 mb-1">
                    <a href="{{url($data->driverioslink)}}" target="_blank">
                        <img src="{{asset($p.$data->playstoreicon1)}}" alt="" class="w-100 w-md-75 wow slideInRight animated" style="visibility: visible;">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="bg-light">
    <div class="container">
        <div class="row p-5 py-md-10">
            <div class="col-6 col-md-4 p-0 m-auto text-center order-md-2">
                <b>
                    2.
                </b>
                <h3>
                    {!! $data->hsrht2 !!}
                </h3>
            </div>
            <div class="col-6 col-md-2 p-0 order-md-1 text-center">
                <a data-fancybox="driver" href="{{asset($p.$data->hsrcimage1) }}">
                    <img src="{{asset($p.$data->hsrcimage1) }}" alt="Your-Brand,-Your-Logo" class="w-50 w-md-100">
                </a>
            </div>
            <div class="col-md-6 order-md-0 m-auto font-weight-lighter text-md-right pt-5 pt-md-10 text-left">
                <h4>
                    {!! $data->hsrht1 !!}
                </h4>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="row p-5 py-md-10">
        <div class="col-6 col-md-4 p-0 m-auto text-center">
            <b>3.</b>
            <h3>
                {!! $data->htrht1 !!}
            </h3>
        </div>
        <div class="col-6 col-md-2 p-0 text-center">
            <a data-fancybox="driver" href="{{asset($p.$data->htrcimage1)}}">
                <img src="{{asset($p.$data->htrcimage1)}}" alt="Your-Brand,-Your-Logo" class="w-50 w-md-100">
            </a>
        </div>
        <div class="col-md-6 m-auto font-weight-lighter pt-5 pt-md-10 text-md-left">
            <h4>
                {!! $data->htrht2 !!}
            </h4>
        </div>
    </div>
</div>
<section class="bg-light">
    <div class="container">
        <div class="row p-5 py-md-10">
            <div class="col-6 col-md-4 p-0 m-auto text-center order-md-2">
                <b>
                    4.
                </b>
                <h3>
                    {!! $data->hforht2 !!}
                </h3>
            </div>
            <div class="col-6 col-md-2 p-0 order-md-1 text-center">
                <a data-fancybox="driver" href="{{asset($p.$data->hforcimage1)}}">
                    <img src="{{asset($p.$data->hforcimage1)}}" alt="Your-Brand,-Your-Logo" class="w-50 w-md-100">
                </a>
            </div>
            <div class="col-md-6 order-md-0 m-auto font-weight-lighter pt-5 pt-md-10 text-left text-md-right">
                <h4>
                    {!! $data->hforht1 !!}
                </h4>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="row p-5 py-md-10">
        <div class="col-6 col-md-4 p-0 m-auto text-center">
            <b>
                5.
            </b>
            <h3>
                {!! $data->hfirht1 !!}
            </h3>
        </div>
        <div class="col-6 col-md-2 p-0 text-center">
            <a data-fancybox="driver" href="{{asset($p.$data->hfircimage1)}}">
                <img src="{{asset($p.$data->hfircimage1)}}" alt="Your-Brand,-Your-Logo" class="w-50 w-md-100">
            </a>
        </div>
        <div class="col-md-6 m-auto font-weight-lighter pt-5 pt-md-10 text-md-left">
            <h4>
                {!! $data->hfirht2 !!}
            </h4>
        </div>
    </div>
</div>
<section class="bg-light">
    <div class="container">
        <div class="row p-5 py-md-10">
            <div class="col-6 col-md-4 p-0 m-auto text-center order-md-2">
                <b>
                    6.
                </b>
                <h3>
                    {!! $data->hsirht2 !!}
                </h3>
            </div>
            <div class="col-6 col-md-2 p-0 order-md-1 text-center">
                <a data-fancybox="driver" href="{{asset($p.$data->hsircimage1)}}">
                    <img src="{{asset($p.$data->hsircimage1)}}" alt="Your-Brand,-Your-Logo" class="w-50 w-md-100">
                </a>
            </div>
            <div class="col-md-6 order-md-0 m-auto font-weight-lighter pt-5 pt-md-10 text-left text-md-right">
                <h4>
                    {!! $data->hsirht1 !!}
                </h4>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="row pb-10 p-5 py-md-10">
        <div class="col-6 col-md-4 p-0 m-auto text-center">
            <b>
                7.
            </b>
            <h3>
                {!! $data->hserht1 !!}
            </h3>
        </div>
        <div class="col-6 col-md-2 p-0 text-center">
            <a data-fancybox="driver" href="{{asset($p.$data->hsercimage1)}}">
                <img src="{{asset($p.$data->hsercimage1)}}" alt="Your-Brand,-Your-Logo" class="w-50 w-md-100">
            </a>
        </div>
        <div class="col-md-6 m-auto font-weight-lighter pt-5 pt-md-10 text-md-left">
            <h4>
                {!! $data->hserht2 !!}
            </h4>
        </div>
    </div>
</div>


</div>
@endif
@extends('admin.layouts.web_footer')