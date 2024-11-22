<table class="table table-hover">
    <thead>
        <tr>
            <th> @lang('view_pages.s_no')</th>
            <th> @lang('view_pages.code')</th>
            <th> @lang('view_pages.from')</th>
            <th> @lang('view_pages.to')</th>
            <!-- <th> @lang('view_pages.promo_total_uses')</th> -->
            <th> @lang('view_pages.status')</th>
            <th> @lang('view_pages.action')</th>
        </tr>
    </thead>

<tbody>
    @php  $i= $results->firstItem(); 
    @endphp

    @forelse($results as $key => $result)
        <tr>
            <td>{{ $i++ }} </td>
            <td>{{ $result->code }}</td>
            <td>{{ $result->from_date }}</td>
            <td>{{ $result->to_date }}</td>
            <!-- <td>{{ $result->total_uses }}</td> -->
            @if($result->active)
                <td><span class="label label-success">@lang('view_pages.active')</span></td>
            @else
                <td><span class="label label-danger">@lang('view_pages.inactive')</span></td>
            @endif
            <td>

            <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('view_pages.action')
            </button>
                     <div class="dropdown-menu">
                 @if(auth()->user()->can('edit-promo'))         

                    <a class="dropdown-item" href="{{url('promo',$result->id)}}"><i class="fa fa-pencil"></i>@lang('view_pages.edit')</a>
                @endif
                 @if(auth()->user()->can('toggle-promo'))         

                    @if($result->active)
                    <a class="dropdown-item" href="{{url('promo/toggle_status',$result->id)}}"><i class="fa fa-dot-circle-o"></i>@lang('view_pages.inactive')</a>
                    @else
                    <a class="dropdown-item" href="{{url('promo/toggle_status',$result->id)}}"><i class="fa fa-dot-circle-o"></i>@lang('view_pages.active')</a>
                    @endif
                 @endif
                 @if(auth()->user()->can('delete-promo'))         
                    <a class="dropdown-item sweet-delete" href="{{url('promo/delete',$result->id)}}"><i class="fa fa-trash-o"></i>@lang('view_pages.delete')</a>
                 @endif
                </div>
            </div>

            </td>
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
