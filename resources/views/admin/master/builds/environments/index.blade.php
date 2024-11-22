@extends('admin.layouts.app')

@section('title', 'Company page')

@section('content')
 <section class="content-header">
                      <h1>
                        {{$page}}
                      </h1>
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('builds/projects') }}"><i class="fa fa-dashboard"></i> {{$project_name}}</a></li>
                         <li class="breadcrumb-item"><a href="{{ url('builds/flavours',request()->project_id) }}"><i class="fa fa-dashboard"></i> {{$flavour_name}}</a></li>
                        <li class="breadcrumb-item active">{{$page}}</li>
                      </ol>
                    </section>
<!-- Start Page content -->
<!-- <div class="content">
<div class="container-fluid"> -->

<div class="row">
<div class="col-12 build-main-div">
<div class="box col-md-11 mx-auto col-xs-11">
   <!--  <div class="box-header with-border">
                        <div class="row text-right">
                            <div class="">
                                <div class="form-group">
                                    <input type="text" id="search_keyword" style="width:200px;margin-right:5px;" name="search" class="form-control" placeholder="Enter Build number">
                                </div>
                            </div>

                            <div class="">
                                <button id="search"  class="btn btn-success btn-outline btn-sm" type="submit">
                                    @lang('view_pages.search_build')
                                </button>
                            </div>
            </div>
</div> -->

<table class="table table-bordered">
    <thead>
    <tr>


    <th> @lang('view_pages.s_no')
    <span style="float: right;">

    </span>
    </th>

    <th> @lang('view_pages.environment')
    <span style="float: right;">
    </span>
    </th>
    <th> @lang('view_pages.action')
    <span style="float: right;">
    </span>
    </th>
    </tr>
    </thead>
    <tbody>
    @if(count($results)<1)
    <tr>
        <td colspan="11">
        <p id="no_data" class="lead no-data text-center">
     <img src="../../assets/img/dark-data.svg" style="width:250px;margin-top:25px;" alt="">
     <h4 class="text-center" style="color:#333;font-size:25px;">@lang('view_pages.no_data_found')</h4>
 </p>
        </td>
    </tr>
    @else

    @php  $i= $results->firstItem(); @endphp

    @foreach($results as $key => $result)

    <tr>
    <td>{{ $i++ }} </td>
    <td> {{$result->environment}}</td>
    <td>
    <div class="dropdown">
    <a href="{{ url('builds?team=android',['project_id'=>request()->project_id,'flavour_id'=>request()->flavour_id,'environment'=>$result->environment]) }}">
    <button type="button" class="btn btn-info">@lang('view_pages.view')
    </button>
</a>

    </div>

    </td>
    </tr>
    @endforeach
    @endif
    </tbody>
    </table>
    <div class="text-right">
    <span  style="float:right">
    {{$results->links()}}
    </span>
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
