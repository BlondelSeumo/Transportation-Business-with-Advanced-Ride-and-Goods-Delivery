@extends('admin.layouts.web_header')

@section('title', 'Admin')

<section>
    <div class="container py-12 mt-10">
        <div class="row">
            <div class="col-md-12 m-auto text-justify">
                @if($data)
                  {!! $data->complaince !!}   
                @endif
            </div>
        </div>
    </div>
</section>


@extends('admin.layouts.web_footer')
