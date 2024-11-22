<table class="table table-hover">
    <thead>
        <tr>
            <th> @lang('view_pages.s_no')</th>
            <th> @lang('view_pages.mail_id')</th>
            <th> @lang('view_pages.otp')</th>
            <th> @lang('view_pages.verification_status')</th>
            <th> @lang('view_pages.generated_date')</th>
        </tr>
    </thead>

<tbody>
    @php  $i= $results->firstItem(); @endphp

    @forelse($results as $key => $result)
        <tr>
            <td>{{ $i++ }} </td>
            <td>{{ $result->email }}</td>
            <td>{{ ucfirst($result->otp) }}</td>
            @if($result->verified == true)
            <td><span class="label label-success">@lang('view_pages.verified')</span></td>
            @else
            <td><span class="label label-danger">@lang('view_pages.un_verified')</span></td>
            @endif
            <td>{{ ucfirst($result->ConvertedCreatedAt) }}</td>
            
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
    <nav class="mt-15 pb-10">
        <ul class="pagination pagination-sm pull-right">
            <li class="page-item">
                <a class="page-link" href="#">{{$results->links()}}</a>
            </li>
        </ul>
    </nav>
