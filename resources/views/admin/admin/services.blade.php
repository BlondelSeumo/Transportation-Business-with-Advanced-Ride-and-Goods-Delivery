@extends('admin.layouts.app')

@section('title', 'Admin')

@section('content')

<section class="content">

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
                            <button id="search" class="btn btn-success btn-outline btn-sm mt-5" type="submit">
                                @lang('view_pages.search')
                            </button>
                        </div>

                        <div class="col-9 text-right">
                            <a href="{{url('admins/create')}}" class="btn btn-primary btn-sm">
                                <i class="mdi mdi-plus-circle mr-2"></i>@lang('view_pages.add_admin')</a>
                            <!--  <a class="btn btn-danger">
                    Export</a> -->
                        </div>
                    </div>


                </div>

                <div id="js-admin-partial-target">
                    <include-fragment src="admins/fetch">
                        <span style="text-align: center;font-weight: bold;">@lang('view_pages.loading')</span>
                    </include-fragment>
                </div>

            </div>
        </div>
    </div>
    <!-- container -->
</section>

@endsection