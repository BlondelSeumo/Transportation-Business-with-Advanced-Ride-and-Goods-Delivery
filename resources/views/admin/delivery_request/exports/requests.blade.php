<table class="table table-hover">
    <thead>
        <tr>
            <th> @lang('view_pages.s_no')</th>
            <th> @lang('view_pages.date')</th>
            <th> @lang('view_pages.request_id')</th>
            <th> @lang('trip_start_time')</th>
            <th> @lang('trip_end_time')</th>
            <th> @lang('view_pages.user_name')</th>
            <th> @lang('view_pages.driver_name')</th>
            <th> @lang('view_pages.owner_name')</th>
            <th> @lang('view_pages.trip_status')</th>
            <th> @lang('view_pages.is_paid_status')</th>
            <th> @lang('view_pages.payment_option')</th>
            <th> @lang('view_pages.vehicle_type')</th>
            <th> @lang('view_pages.ride_type')</th> 
            <th> @lang('view_pages.trip_time')</th>
            <th> @lang('view_pages.trip_distance')</th>
            <th> @lang('view_pages.driver_commission')</th>               
            <th> @lang('view_pages.admin_commission')</th>
            <th> @lang('view_pages.total_amount')</th>
        </tr>
    </thead>

    <tbody>
        @php $i= 1; @endphp

        @forelse($results as $key => $result)
            <tr>
                <td>{{ $i++ }} </td>
                <td>{{ $result->created_at->format("m/d/Y") }} </td>
                <td>{{$result->request_number}}</td>
                <td>{{ $result->converted_trip_start_time ?? '-' }}</td>
                <td>{{ $result->converted_completed_at ?? '-' }}</td>
                <td>{{$result->userDetail ? $result->userDetail->name : '-'}}</td>
                <td>{{$result->driverDetail ? $result->driverDetail->name : '-'}}</td>

                @if($result->owner_id)
                <td>{{$result->ownerDetail ? $result->ownerDetail->owner_name : '-'}}</td>
                @else
                <td>{{"Individual"}}</td>
                @endif

                @if($result->is_cancelled == 1)
                    <td><span class="label label-danger">@lang('view_pages.cancelled')</span></td>
                @elseif($result->is_completed == 1)
                    <td><span class="label label-success">@lang('view_pages.completed')</span></td>
                @elseif($result->is_trip_start == 0 && $result->is_cancelled == 0)
                    <td><span class="label label-warning">@lang('view_pages.not_started')</span></td>
                @else
                    <td>-</td>
                @endif

                @if ($result->is_paid)
                    <td><span class="label label-success">@lang('view_pages.paid')</span></td>
                @else
                    <td><span class="label label-danger">@lang('view_pages.not_paid')</span></td>
                @endif

                @if ($result->payment_opt == 0)
                    <td><span class="label label-danger">@lang('view_pages.card')</span></td>
                @elseif($result->payment_opt == 1)
                    <td><span class="label label-primary">@lang('view_pages.cash')</span></td>
                @elseif($result->payment_opt == 2)
                    <td><span class="label label-warning">@lang('view_pages.wallet')</span></td>
                @else
                    <td><span class="label label-info">@lang('view_pages.cash_wallet')</span></td>
                @endif

                <td>{{ $result->vehicle_type_name }}</td>


            @php
               $later = $result->is_later;  
               $rental = $result->is_rental;
             @endphp
             @if($later == 0)

                @if(($later == 0) &&  ($rental == 0))           
                <td><span class="label label-success">@lang('view_pages.regular_instant')</span> </td>
                @else(($later == 0) &&  ($rental == 1)) 
                <td><span class="label label-success"> @lang('view_pages.rental_instant') </span> </td>
                @endif

            @else($later == 1)
               
                @if(($later == 1) &&  ($rental == 0))           
                <td><span class="label label-success">  @lang('view_pages.regular_scheduled') </span></td>
                @else(($later == 1) &&  ($rental == 1 )) 
                <td><span class="label label-success"> @lang('view_pages.rental_scheduled')</span></td>
                @endif
               
            @endif


                <td>{{ $result->total_time .' Mins' }}</td>
                <td>{{ $result->total_distance .'  '. $result->request_unit}}</td>
                <td>{{ $result->requestBill ? $result->currency .' '. $result->requestBill->driver_commision : '-' }}</td>
                <td>{{ $result->requestBill ? $result->currency .' '. $result->requestBill->admin_commision : '-' }}</td>
                <td>{{ $result->requestBill ? $result->currency .' '. $result->requestBill->total_amount : '-' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="11">
                    <h4 class="text-center" style="color:#333;font-size:25px;">@lang('view_pages.no_data_found')</h4>
                </td>
            </tr>
        @endforelse

    </tbody>
</table>
