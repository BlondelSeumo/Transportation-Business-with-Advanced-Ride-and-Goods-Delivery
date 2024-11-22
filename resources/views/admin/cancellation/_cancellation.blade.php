
<table class="table table-hover">
    <thead>
        <tr>
            <th> @lang('view_pages.s_no')</th>
            <th> @lang('view_pages.reason')</th>
            @if($app_for == "bidding" || $app_for == "super")
            <th>@lang('view_pages.transport_type')</th>
            @endif
            <th> @lang('view_pages.user_type')</th>
            <th> @lang('view_pages.payment_type')</th>
            <th> @lang('view_pages.status')</th>
            @if(!auth()->user()->company_key)
            <th> @lang('view_pages.action')</th>
            @endif
        </tr>
    </thead>

<tbody>
    @php  $i= $results->firstItem(); @endphp

    @forelse($results as $key => $result)
        <tr>
            <td>{{ $i++ }} </td>
            <td>{{$result->reason}}</td>
            @if($app_for == "bidding" || $app_for == "super")            
            <td>{{$result->transport_type}}</td>
            @endif
            <td>
                <span class="label label-warning">{{ ucfirst($result->user_type) }}</span>
            </td>
            <td>
                <span class="badge badge-purple badge-md">{{ ucfirst($result->payment_type) }}</span>
            </td>
            @if($result->active)
            <td><span class="label label-success">@lang('view_pages.active')</span></td>
            @else
            <td><span class="label label-danger">@lang('view_pages.inactive')</span></td>
            @endif
            @if(!auth()->user()->company_key)
            <td>

            <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('view_pages.action')
            </button>
                <div class="dropdown-menu">
                @if(auth()->user()->can('edit-cancellation'))         
                    <a class="dropdown-item" href="{{url('cancellation',$result->id)}}"><i class="fa fa-pencil"></i>@lang('view_pages.edit')</a>
                @endif
                @if(auth()->user()->can('toggle-cancellation'))         
                    @if($result->active)
                    <a class="dropdown-item" href="{{url('cancellation/toggle_status',$result->id)}}"><i class="fa fa-dot-circle-o"></i>@lang('view_pages.inactive')</a>
                    @else
                    <a class="dropdown-item" href="{{url('cancellation/toggle_status',$result->id)}}"><i class="fa fa-dot-circle-o"></i>@lang('view_pages.active')</a>
                    @endif
                @endif
                @if(auth()->user()->can('delete-cancellation'))         
                    <a class="dropdown-item sweet-delete" href="{{url('cancellation/delete',$result->id)}}"><i class="fa fa-trash-o"></i>@lang('view_pages.delete')</a>
                @endif
                </div>
            </div>

            </td>
            @endif
        </tr>
    @empty
        <tr>
            <td colspan="11">
                <p id="no_data" class="lead no-data text-center">
                    <img src="{{asset('assets/img/dark-data.svg')}}" style="width:150px;margin-top:25px;margin-bottom:25px;" alt="">
                    <h4 class="text-center" style="color:#333;font-size:25px;">@lang('view_pages.no_data_found')</h4>
                </p>
            </td>
        </tr>
    @endforelse

    </tbody>
    </table>
    <ul class="pagination pagination-sm pull-right">
        <li>
            <a href="#">{{$results->links()}}</a>
        </li>
    </ul>
