<div class="box-body no-padding">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th> @lang('view_pages.s_no')<span style="float: right;"></span></th>
                    <th> @lang('view_pages.uuid')<span style="float: right;"></span></th>
                    <th> @lang('view_pages.owner')<span style="float: right;"></span></th>
                    <th> @lang('view_pages.name')<span style="float: right;"></span></th>
                    <th> @lang('view_pages.email')<span style="float: right;"></span></th>
                    <th> @lang('view_pages.mobile')<span style="float: right;"></span></th>
                    <th>@lang('view_pages.document_view')<span style="float: right;"></span></th>
                    <th> @lang('view_pages.approve_status')<span style="float: right;"></span></th>
                    <th> @lang('view_pages.online_status')<span style="float: right;"></span></th>
                    <th> @lang('view_pages.action')<span style="float: right;"></span></th>
                </tr>
            </thead>

            <tbody>
                @if(count($results)<1) 
                    <tr>
                        <td colspan="11">
                            <p id="no_data" class="lead no-data text-center">
                                <img src="{{asset('assets/img/dark-data.svg')}}" style="width:150px;margin-top:25px;margin-bottom:25px;" alt="">
                            <h4 class="text-center" style="color:#333;font-size:25px;">@lang('view_pages.no_data_found')</h4>
                            </p>
                        </td>
                    </tr>
                @else

                    @php $i= $results->firstItem(); @endphp

                        @foreach($results as $key => $result)

                        <tr>
                            <td>{{ $i++ }} </td>
                            <td> {{$result->uuid}}</td>
                            <td> {{$result->owner?$result->owner->name:'--'}}</td>
                            <td> {{$result->name}}</td>
                            <td>{{$result->email}}</td>
                            <td>{{$result->mobile}}</td>
                            <td>
                            <a href="{{ url('company/drivers/document/view',$result->id) }}" class="btn btn-social-icon btn-bitbucket">
                                <i class="fa fa-file-text"></i>
                            </a>
                            </td>
                            @if($result->approve == true)
                            <td><button class="btn btn-success btn-sm">{{ trans('view_pages.approved') }}</button></td>
                            @else
                            <td><button class="btn btn-danger btn-sm">{{ trans('view_pages.disapproved') }}</button></td>
                            @endif
                            <td>
                                @if ($result->available)
                                <span class="badge badge-success font-size-10">{{trans('view_pages.online')}}</span>
                                @else
                                <span class="badge badge-danger font-size-10">{{trans('view_pages.offline')}}</span>
                                @endif
                            </td>

                            <td>
                                    <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('view_pages.action')
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{url('company/drivers',$result->id)}}">
                                            <i class="fa fa-pencil"></i>@lang('view_pages.edit')
                                        </a>

                                        <!-- <a class="dropdown-item grey-text text-darken-2" href="{{url('company/drivers/profile',$result->id) }}">{{ trans('view_pages.profile')}}</a>

                                        <a class="dropdown-item grey-text text-darken-2" href="{{url('company/drivers/vehicle/privileges',$result->id) }}">{{ trans('view_pages.vehicle_privileges')}}</a> -->
<!-- 
                                      @if ($result->approve)
                                        <a class="dropdown-item sweet-decline grey-text text-darken-2" href="{{url('company/drivers/toggle_approve',$result->id) }}">
                                            <i class="fa fa-dot-circle-o"></i>{{ trans('view_pages.disapproved')}}</a>
                                        @else
                                        <a class="dropdown-item sweet-approve grey-text text-darken-2" href="{{url('company/drivers/toggle_approve',$result->id) }}">
                                            <i class="fa fa-dot-circle-o"></i>{{ trans('view_pages.approve')}}</a>
                                      @endif -->
                                       <!--  <a class="dropdown-item" href="{{url('company/drivers/request-list',$result->id)}}">
                                        <i class="fa fa-dot-circle-o"></i>@lang('view_pages.request_list')</a> 
                                      
                                        <a class="dropdown-item" href="{{url('company/drivers/payment-history',$result->id)}}">
                                        <i class="fa fa-dot-circle-o"></i>@lang('view_pages.driver_payment_history')</a> -->



                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @endif
            </tbody>
        </table>
        <div class="text-right">
            <span style="float:right">
                {{$results->links()}}
            </span>
        </div>
    </div>
</div>