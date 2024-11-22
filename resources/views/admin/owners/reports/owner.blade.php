<table class="table table-hover" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
    <thead>
        <tr>
            <th> @lang('view_pages.s_no')</th>
            <th> @lang('view_pages.company_name')</th>
            <th> @lang('view_pages.owner_name')</th>
            <th> @lang('view_pages.no_of_vehicles')</th>
            <th> @lang('view_pages.email')</th>
            <th> @lang('view_pages.mobile')</th>
            <th> @lang('view_pages.approve_status')</th>
        </tr>
    </thead>

    <tbody>
        @if (count($results) < 1)
            <tr>
                <td class="no-result" colspan="11">{{ trans('view_pages.no_result_found')}}</td>
            </tr>
        @else

            @php $i= 1; @endphp

            @foreach ($results as $key => $result)

                <tr>
                    <td>{{ $i++ }} </td>
                    <td> {{ $result->company_name }}</td>
                    <td> {{ $result->owner_name }}</td>
                    <td> {{ $result->no_of_vehicles }}</td>
                    <td>{{ $result->email }}</td>
                    <td>{{ $result->mobile }}</td>

                    <td>
                        @if ($result->approve)
                            <span class="badge badge-success font-size-10">{{trans('view_pages.approved')}}</span>
                        @else
                            <span class="badge badge-danger font-size-10">{{trans('view_pages.blocked')}}</span>
                        @endif
                    </td>

                </tr>
            @endforeach
        @endif
    </tbody>
</table>
