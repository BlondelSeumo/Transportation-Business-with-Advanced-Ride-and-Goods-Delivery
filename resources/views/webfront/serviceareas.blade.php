@extends('admin.layouts.web_header')

@section('title', 'Admin')

<style>
    .nav-link.areas {
        background: var(--logo-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .nav-link.areas::before {
        content: "";
        position: absolute;
        left: .75rem;
        right: .75rem;
        bottom: .25rem;
        border-top: 2px solid #3dd845;
    }
</style>
@if($data)
<section id="Locations" class="mt-10 py-10">
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-11 text-justify">
                <h2 class="text-uppercase font-weight-bolder line-black-left">
                    {!! $data->serviceheadtext !!}
                </h2>
                <p class="line-red-left">
                    {!! $data->servicesubtext !!}
                </p>
            </div>
        </div>
        
        <?php  
        $itemsChunks = array_chunk($serv, 3);
           foreach($itemsChunks as $itemsChunk): ?>
              <div class="row"><div class="col-md-1"></div>
                <?php foreach($itemsChunk as $item): ?>
                <div class="col-12 col-md pt-5">
                 <div class="card mb-7 mb-md-0 shadow  shadow shadow-hover lift border">
                    <img src="{{asset($p.$item)}}" alt="..." class="card-img-top">
                 </div>
                </div>
                <?php endforeach; ?>
                </div>
            <?php endforeach; ?>    
        
@endif
    </div>
    </div>
</section>

@extends('admin.layouts.web_footer')