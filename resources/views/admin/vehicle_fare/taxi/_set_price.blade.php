<div class="row p-0 m-0">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="col-sm-12 p-0">
                    <table class="table table-hover" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                        <thead>
                            <tr>
                           <th>@lang('view_pages.s_no')</th>
                            <th>@lang('view_pages.vehicle_type')</th>
                            <th>@lang('view_pages.price_type')</th>
                            <th>@lang('view_pages.status')</th>
                            <th>@lang('view_pages.action')</th>
                            </tr>
                        </thead>

                        <tbody>

                            @if(!$results)
                                <td class="no-result" colspan="11">{{ trans('view_pages.no_data_found')}}</td>
                            @else
                                @php $i= $results->firstItem(); @endphp

                 @foreach ($results as $key => $result)
                                    <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $result->zoneType->vehicleType->name }}
                            @if ($result->zoneType->zone->default_vehicle_type == $result->zoneType->vehicleType->id)
                            <button class="btn btn-warning btn-sm">Default</button>
                            @endif
                            @if ($result->zoneType->zone->default_vehicle_type_for_delivery == $result->zoneType->vehicleType->id)
                            <button class="btn btn-warning btn-sm">Default</button>
                            @endif
                            </td>
                    <td>
                        @if ($result->price_type == 1)
                        <span class="btn btn-success btn-sm">{{ __('view_pages.ride_now') }}</span>
                        @else
                        <span class="btn btn-danger btn-sm">{{ __('view_pages.ride_later') }}</span>
                        @endif
                    </td>
                    <td>
                        @if ($result->zoneType->active)
                        <button class="btn btn-success btn-sm">@lang('view_pages.active')</button>
                        @else
                        <button class="btn btn-danger btn-sm">@lang('view_pages.inactive')</button>
                        @endif
                    </td>
                    <td>
                        <!-- Dropdown for Actions -->
                        <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('view_pages.action')</button>
                        <div class="dropdown-menu w-48">
                            @if(auth()->user()->can('edit-price'))
                            <a class="dropdown-item" href="{{url('vehicle_fare/edit', $result->id)}}">
                                <i class="fa fa-pencil"></i>@lang('view_pages.edit')
                            </a>
                            @endif
                            @if(auth()->user()->can('assign-rental-package'))
                            <a class="dropdown-item" href="{{url('vehicle_fare/rental_package/index', $result->zoneType->id)}}">
                                <i class="fa fa-plus"></i>@lang('view_pages.assign_rental_package')
                            </a>
                            @endif
                                
                            @if(auth()->user()->can('default-vehicle-type') && $result->active == 1 && $result->zoneType->zone->default_vehicle_type != $result->zoneType->vehicleType->id)
                                 <a class="dropdown-item" href="{{url('vehicle_fare/set/default',$result->id)}}"><i class="fa fa-dot-circle-o"></i>@lang('view_pages.set_as_default')</a>
                            @endif
                            @if(auth()->user()->can('toggle-price'))
                                @if($result->zoneType->active)
                                <a class="dropdown-item" href="{{url('vehicle_fare/toggle_status', $result->id)}}">
                                    <i class="fa fa-dot-circle-o"></i>@lang('view_pages.inactive')</a>
                                @else
                                <a class="dropdown-item" href="{{url('vehicle_fare/toggle_status', $result->id)}}">
                                    <i class="fa fa-dot-circle-o"></i>@lang('view_pages.active')</a>
                                @endif
                            @endif
                            @if(auth()->user()->can('delete-price'))
                            <a class="dropdown-item sweet-delete" href="#" data-url="{{url('vehicle_fare/delete',$result->id)}}">
                                <i class="fa fa-trash-o"></i>@lang('view_pages.delete')</a>
                            @endif
                        </div>
                    </td>   
                   </tr>
              @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="">
                <div class="col-sm-12 col-md-5 float-left">

                </div>
                <div class="col-sm-12 col-md-7 float-left">
                    <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                        <ul class="pagination float-right">
                            {{ $results->links() }}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
                    @endif                                    

    </div>
</div>
