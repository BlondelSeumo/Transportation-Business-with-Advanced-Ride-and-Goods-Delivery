@extends('admin.layouts.web_header')

@section('title', 'Admin')

<style>
    .text-primary {
        color: #19e5da !important;
    }

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
    .list-styled-link.req::before {
        content: "";
        position: absolute;
        left: 1.75rem;
        right: 1.75rem;
        bottom: 3.5rem;
        border-top: 2px solid #3dd845;
    }
    
</style>
@if($data)
<div class="container-fluid p-0">
    <div class="row no-gutters justify-content-between">
        <div class="col-12 col-md-6 bg-cover py-15 py-md-0 p-0" data-jarallax data-speed=".8" style="background-image: url({{ asset($p.$data->frimage) }});"></div>
        <div class="col-12 col-md-6 pr-md-5 pl-10 py-12">
         {!! $data->frtext !!}
        </div>
    </div>
</div>

<div class="container-fluid p-0">
    <div class="row no-gutters justify-content-between">
        <div class="col-12 col-md-6 pr-md-5 pl-10 py-12">
            {!! $data->srtext !!}
        </div>
        <div class="col-12 col-md-6 bg-cover p-0" data-jarallax data-speed=".8" style="background-image: url({{ asset($p.$data->srimage) }});"></div>
    </div>
</div>

<div class="container-fluid p-0">
    <div class="row no-gutters justify-content-between">
        <div class="col-12 col-md-6 bg-cover p-0" data-jarallax data-speed=".8" style="background-image: url({{ asset($p.$data->trimage) }});"></div>
        <div class="col-12 col-md-6 pr-md-5 pl-10 py-12">
        {!! $data->trtext !!} 
       </div>
    </div>
</div>
@endif
@extends('admin.layouts.web_footer')