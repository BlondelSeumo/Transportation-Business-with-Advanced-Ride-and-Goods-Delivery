@extends('admin.layouts.app')

@section('title', 'List Projects')

@section('content')

<!-- Start Page content -->
<!-- <div class="content">
<div class="container-fluid"> -->

<div class="row">
<div class="col-12 build-main-div">
<div class="box col-md-11 mx-auto col-xs-11">
    <div class="box-header with-border">
                        <div class="row text-right">
                            <div class="">
                                <div class="form-group">
                                    <input type="text" id="search_keyword" name="search" class="form-control" placeholder="@lang('view_pages.enter_keyword')">
                                </div>
                            </div>

                            <div class="ml-2">
                                <button id="search"  class="btn btn-success btn-outline btn-sm" type="submit">
                                    @lang('view_pages.search')
                                </button>
                            </div>
            </div>
</div>

<div id="js-company-partial-target">
    <include-fragment src="fetch/projects">
        <span style="text-align: center;font-weight: bold;">@lang('view_pages.loading')</span>
    </include-fragment>
</div>

</div>
</div>
</div>

<!-- </div> -->
<!-- container -->

<!-- </div> -->
<!-- content -->

<script src="https://unpkg.com/@github/include-fragment-element"></script>
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
        fetch('fetch/projects?search='+search_keyword)
        .then(response => response.text())
        .then(html=>{
            document.querySelector('#js-company-partial-target').innerHTML = html
        });
});

});
</script>


@endsection
