@extends('admin.layouts.web_header')

@section('title', 'Admin')

<section>
    <div class="container py-12">
        <div class="row">
            <div class="col-12 text-center py-5">
                @if($data)
                  {!! $data->terms !!}   
                @endif

            </div>
        </div>
    </div>
</section>

@extends('admin.layouts.web_footer')