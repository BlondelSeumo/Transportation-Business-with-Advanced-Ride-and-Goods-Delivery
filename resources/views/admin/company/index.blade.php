@extends('admin.layouts.app')

@section('title', 'Company page')

@section('content')
<style>
    .demo-radio-button label {
        min-width: 100px;
        margin: 0 0 5px 50px;
    }
</style>
<!-- Start Page content -->
<section class="content">
{{-- <div class="container-fluid"> --}}

<div class="row">
<div class="col-12">
<div class="box">

    <div class="box-header with-border">
        <div class="row text-right">

                <div class="col-2">
                    <div class="form-group">
                    <input type="text" id="search_keyword" name="search" class="form-control" placeholder="@lang('view_pages.enter_keyword')">
                    </div>
                </div>
                <div class="col-1">
                    <button class="btn btn-success btn-outline btn-sm mt-5" type="submit">
                    @lang('view_pages.search')
                    </button>
                </div>

                <div class="col-9 text-right">
                    <a href="{{url('company/create')}}" class="btn btn-primary btn-sm">
                    <i class="mdi mdi-plus-circle mr-2"></i>@lang('view_pages.add_company')</a>
                    <!--  <a class="btn btn-danger">
                    Export</a> -->
                </div>
        </div>


            </div>

        <div id="js-company-partial-target">
            <include-fragment src="company/fetch">
                <span style="text-align: center;font-weight: bold;"> @lang('view_pages.loading')</span>
            </include-fragment>
        </div>

</div>
</div>
</div>

<!-- </div> -->

<!-- container -->

{{--</div>--}}
<!-- content -->

<script src="{{asset('assets/js/fetchdata.min.js')}}"></script>

<script>
    $(function() {
    $('body').on('click', '.pagination a', function(e) {
    e.preventDefault();
    var url = $(this).attr('href');
    $.get(url, $('#search').serialize(), function(data){
        $('#js-company-partial-target').html(data);
    });
});

$('#search').on('click', function(e){
    e.preventDefault();
        var search_keyword = $('#search_keyword').val();
        console.log(search_keyword);
        fetch('company/fetch?search='+search_keyword)
        .then(response => response.text())
        .then(html=>{
            document.querySelector('#js-company-partial-target').innerHTML = html
        });
});

});
</script>


@endsection
