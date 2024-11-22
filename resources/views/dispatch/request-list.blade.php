<style>
    .timeline li {
        list-style: none;
    }

    .timeline li::before {
        content: "" !important;
        position: absolute !important;
        height: 64px !important;
        width: 3px !important;
        background: #748194;
        top: unset !important;
        left: unset !important;
        right: unset !important;
        margin-top: 10px;
        margin-left: -40px;
    }

    .timeline li::after {
        content: "" !important;
        position: absolute !important;
        height: 22px !important;
        width: 22px !important;
        border-radius: 50% !important;
        background-color: #748194;
        margin-left: -26px !important;
        margin-top: -15px !important;
    }

    .timeline li p::before {
        content: "";
        position: absolute;
        background: #fff;
        height: 10px;
        width: 10px;
        left: -20px;
        z-index: 9;
        top: 4px;
        border-radius: 10px;
    }

    .timeline li:nth-child(1)::before,
    .timeline li:nth-child(1)::after {
        background-color: #FF0000 !important;
    }

    .timeline li:nth-child(2)::before,
    .timeline li:nth-child(2)::after {
        background-color: #0000FF !important;
    }

    .timeline li:nth-child(3)::before,
    .timeline li:nth-child(3)::after {
        background-color: #FF7F00 !important;
    }

    .timeline li:nth-child(4)::before,
    .timeline li:nth-child(4)::after {
        background-color: #FFFF00 !important;
    }

    .timeline li:nth-child(5)::before,
    .timeline li:nth-child(5)::after {
        background-color: #00FF00 !important;
    }

</style>

<div class="card">
    <div class="card-header">
        <div class="row align-items-center justify-content-between">
            <div class="col-4 col-sm-auto d-flex align-items-center pr-0">
                {{-- <div class="form-group">
                    <input class="form-control datetimepicker" id="wizard-datepicker"
                        type="date" placeholder="d/m/y"
                        data-options='{"dateFormat":"d/m/Y"}' />
                </div> --}}
                <h5 class="text-danger">@lang('view_pages.requests')</h5>
            </div>
            <div class="col-8 col-sm-auto text-right pl-2">
                <div class="d-none" id="customers-actions">
                    <div class="input-group input-group-sm"><select class="custom-select cus" aria-label="Bulk actions">
                            <option selected="">@lang('view_pages.bulk_actions')</option>
                            <option value="Delete">@lang('view_pages.delete')</option>
                            <option value="Archive">@lang('view_pages.archive')</option>
                        </select><button class="btn btn-falcon-default btn-sm ml-2" type="button">@lang('view_pages.apply')</button>
                    </div>
                </div>
                <div id="customer-table-actions">
                    <button class="btn btn-falcon-default btn-sm tripStatusFilter" data-tripstatus="all" data-val="1"
                        type="button">
                        <span class="d-none d-sm-inline-block ml-1">
                            @lang('view_pages.all')
                        </span>
                    </button>
                    <button class="btn btn-falcon-default btn-sm tripStatusFilter" data-tripstatus="is_assigned"
                        data-val="1" type="button">
                        <span class="d-none d-sm-inline-block ml-1">
                            @lang('view_pages.assigned')
                        </span>
                    </button>
                    <button class="btn btn-falcon-default btn-sm tripStatusFilter" data-tripstatus="is_trip_start"
                        data-val="0" type="button">
                        <span class="d-none d-sm-inline-block ml-1">
                            @lang('view_pages.unassigned')
                        </span>
                    </button>
                    <button class="btn btn-falcon-default btn-sm tripStatusFilter" data-tripstatus="is_completed"
                        data-val="1" type="button">
                        <span class="d-none d-sm-inline-block ml-1">
                            @lang('view_pages.completed')
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body p-0" style="height: calc(100vh - 170px)">
        <div class="falcon-data-table">
            <div style="overflow-y: scroll;max-height: calc(100vh - 164px);">
                <table
                    class="table table-sm mb-0 table-striped table-dashboard fs--1 data-table border-bottom border-200">
                    <thead class="bg-200 text-900">
                        <tr>
                            <th class="align-middle sort">@lang('view_pages.request_id')</th>
                            <th class="align-middle sort">@lang('view_pages.date')</th>
                            <th class="align-middle sort">@lang('view_pages.pickup_location')</th>
                            <th class="align-middle sort">@lang('view_pages.trip_status')</th>
                        </tr>
                    </thead>
                    <tbody id="customers">
                        @forelse ($results as $item)
                            <tr class="btn-reveal-trigger">
                                <th class="align-middle">
                                    <a href="{{ route('dispatcherRequestDetailView',$item->id) }}" data-id="{{ $item->id }}">
                                    {{ $item->request_number }}
                                </a>
                                   {{--  <a data-fancybox data-src="#request_{{ $item->id }}" href="javascript:;">
                                        {{ $item->request_number }}
                                    </a> --}}
                                </th>
                                <td class="py-2 align-middle">
                                    {{ $item->converted_created_at ?? '-' }}
                                </td>
                                <td class="py-2 align-middle pl-5">
                                    {{ str_limit($item->requestPlace->pick_address, 30) }}
                                </td>
                                <td class="align-middle fs-0" id="{{ $item->id }}">
                                    @if ($item->is_cancelled == 1)
                                        <span class="badge badge rounded-capsule badge-soft-danger">
                                            @lang('view_pages.cancelled')
                                        </span>
                                    @elseif($item->is_completed == 1)
                                        <span class="badge badge rounded-capsule badge-soft-success">
                                            @lang('view_pages.completed')
                                        </span>
                                    @elseif($item->is_trip_start == 0 && $item->is_cancelled == 0)
                                        <span class="badge badge rounded-capsule badge-soft-warning">
                                            @lang('view_pages.not_started')
                                        </span>
                                    @else
                                        <span class="badge badge rounded-capsule badge-soft-dark">
                                            @lang('view_pages.progress')
                                            <div class="spinner-border text-dark" style="width: 1rem;height: 1rem;"
                                                role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </span>
                                    @endif
                                </td>
                            </tr>


                           
                        @empty
                            <tr>
                                <td class="py-2 align-middle pl-5 text-center text-danger" colspan="4">
                                    @lang('view_pages.no_results')
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{ $results->links() }}
            </div>
        </div>
    </div>
</div>
