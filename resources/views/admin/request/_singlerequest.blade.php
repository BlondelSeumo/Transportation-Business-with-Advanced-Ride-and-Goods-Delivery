<table class="table table-hover">
    <thead>
        <tr>
            <th> @lang('view_pages.s_no')</th>
            <th> @lang('view_pages.request_id')</th>
            <th> @lang('view_pages.date')</th>
            <th> @lang('view_pages.user_name')</th>
            <th> @lang('view_pages.driver_name')</th>
            <th> @lang('view_pages.pick_location')</th>
            <th> @lang('view_pages.drop_location')</th>
            <th> @lang('view_pages.action')</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>{{ 1 }} </td>
            <td>{{ $item->request_number}}</td>
            <td>{{ $item->trip_start_time }}</td>
            <td>{{ $item->userDetail ? $item->userDetail->name : '-'}}</td>
            <td>{{ $item->driverDetail ? $item->driverDetail->name : '-'}}</td>
            <td>{{ $item->requestPlace ? $item->requestPlace->pick_address : '-' }}</td>
            <td>{{ $item->requestPlace ? $item->requestPlace->drop_address : '-' }}</td>

            @if ($item->is_completed)
            <td>
                <div class="dropdown">
                    <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">@lang('view_pages.action')
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{url('requests',$item->id)}}">
                            <i class="fa fa-eye"></i>@lang('view_pages.view')</a>
                    </div>
                </div>
            </td>
            @else
                 @if (($item->is_completed == 0) && ($item->is_cancelled == 0))
            <td>
                <div class="dropdown">
                    <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">@lang('view_pages.action')
                    </button>
                    <div class="dropdown-menu">
                             <a class="dropdown-item" href="{{url('requests/trip_view',$item->id) }}">
                            <i class="fa fa-eye"></i>@lang('view_pages.trip_request')</a>
                    </div>
                </div>
            </td>
            @else
               <td>-</td>
                  @endif
            @endif
        </tr>

    </tbody>
</table>