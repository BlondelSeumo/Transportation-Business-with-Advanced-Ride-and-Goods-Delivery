@extends('admin.layouts.web_header');

@section('title', 'Admin');

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
    .list-styled-link.safe::before {
        content: "";
        position: absolute;
        left: 1.75rem;
        right: 4.75rem;
        bottom: 1.5rem;
        border-top: 2px solid #3dd845;
    }
</style>
@if($data)
<div class="row">
    <div class="col-10 m-auto pt-13">
        <img src="{{ asset($p.$data->safety) }}" alt="" class="w-100">
    </div>
</div>
<div class="container my-10">
    <div class="row">
        <div class="col-10 m-auto">
            {!! $data->safetytext !!}
        </div>
    </div>
</div>
@endif

@extends('admin.layouts.web_footer')