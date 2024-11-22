@extends('admin.layouts.app')


@section('title', 'Main page')

@section('content')

    <!-- Start Page content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">

                <div class="col-sm-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <form method="get" name="search" action="{{ url('roles') }}">
                                <div class="row text-right">
                            @if(auth()->user()->can('create-new-roles'))
                                <div class="col-sm-12 text-right">
                                 <a href="{{ url('roles/create') }}" class="btn btn-primary btn-sm">
                                    <i class="mdi mdi-plus-circle mr-2"></i>@lang('view_pages.add_role')</a>
                                </div>
                            @endif
                        
                                    <div class="col-8 col-md-3">
                                        <div class="form-group">
                                            <input type="text" name="search" class="form-control"
                                                placeholder="@lang('view_pages.enter_keyword')">
                                        </div>
                                    </div>

                                    <div class="col-4 col-md-2 text-left">
                                        <button class="btn btn-success btn-outline btn-sm py-2" type="submit">
                                            @lang('view_pages.search')
                                        </button>
                                    </div>

                            </form>
                            <!-- <div class="box-controls pull-right">
                            <div class="lookup lookup-circle lookup-right">
                              <input type="text" name="s">
                            </div>
                          </div> -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>


                                            <th> @lang('view_pages.s_no')
                                                <span style="float: right;">

                                                </span>
                                            </th>
                                            <th> @lang('view_pages.slug')
                                                <span style="float: right;">
                                                </span>
                                            </th>
                                            <th> @lang('view_pages.name')
                                                <span style="float: right;">
                                                </span>
                                            </th>
                                            <th> @lang('view_pages.description')
                                                <span style="float: right;">
                                                </span>
                                            </th>
                                        <!-- @if(auth()->user()->can('edit-roles')) -->
                                            <th> @lang('view_pages.action')
                                                <span style="float: right;">
                                                </span>
                                            </th>
                                        <!-- @endif -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($results) < 1)
                                            <tr>
                                                <td colspan="11">
                                                    <p id="no_data" class="lead no-data text-center">
                                                        <img src="{{ asset('assets/img/dark-data.svg') }}"
                                                            style="width:150px;margin-top:25px;margin-bottom:25px;" alt="">
                                                    <h4 class="text-center" style="color:#333;font-size:25px;">
                                                        @lang('view_pages.no_data_found')</h4>
                                                    </p>
                                                </td>
                                            </tr>
                                        @else
                                            @php  $i= $results->firstItem(); @endphp
                                            @foreach ($results as $key => $result)

                                                <tr>
                                                    <td>{{ $i++ }} </td>
                                                    <td> {{ $result->slug }}</td>
                                                    <td>{{ $result->name }}</td>
                                                    <td>{{ $result->description }} </td>
                                            @if(($result->slug != 'dispatcher') & ($result->slug != 'delivery-dispatcher'))
                                                <!-- @if(auth()->user()->can('edit-roles')) -->
                                                    <td>
                                                        <a class="btn btn-primary btn-sm"
                                                            href="{{ url('roles/assign/permissions', $result->id) }}">
                                                            <i class="fa fa-pencil" id="edit_session" data-toggle="tooltip"
                                                                data-placement="top" title="Assign Permissions"></i>
                                                        </a>

                                                    </td>
                                                <!-- @endif -->
                                            @endif
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <span style="float:right">
                            {{ $results->links() }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- container -->

    </div>
    <!-- content -->


@endsection
