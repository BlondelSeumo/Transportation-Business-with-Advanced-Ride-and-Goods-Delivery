<table class="table table-hover">
    <thead>
        <tr>    
            <th> @lang('view_pages.s_no')</th>   
            <th> @lang('view_pages.title')</th>
            <th> @lang('view_pages.complaint_type')</th>
            <th> @lang('view_pages.user_type')</th>
            <th> @lang('view_pages.status')</th>
            <th> @lang('view_pages.action')</th>
        </tr>
    </thead>

<tbody>
    @php  $i= $results->firstItem(); @endphp
    
    @forelse($results as $key => $result)
        <tr>
            <td>{{ $i++ }} </td>
            <td>{{ $result->title }}</td>
            <td>{{ $result->complaint_type }}</td>
            <td>
                <span class="label label-warning">{{ ucfirst($result->user_type) }}</span>
            </td>
            @if($result->active)
            <td><span class="label label-success">@lang('view_pages.active')</span></td>
            @else
            <td><span class="label label-danger">@lang('view_pages.inactive')</span></td>
            @endif
            <td>
            
            <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('view_pages.action')
            </button>
                <div class="dropdown-menu">
                    @if(auth()->user()->can('edit-complaint-title'))         
                    <a class="dropdown-item" href="{{url('complaint/title',$result->id)}}"><i class="fa fa-pencil"></i>@lang('view_pages.edit')</a>
                    @endif
                   @if(auth()->user()->can('toggle-complaint-title'))         
                    @if($result->active)
                    <a class="dropdown-item" href="{{url('complaint/title/toggle_status',$result->id)}}"><i class="fa fa-dot-circle-o"></i>@lang('view_pages.inactive')</a>
                    @else
                    <a class="dropdown-item" href="{{url('complaint/title/toggle_status',$result->id)}}"><i class="fa fa-dot-circle-o"></i>@lang('view_pages.active')</a>
                    @endif
                @endif

                    @if(auth()->user()->can('delete-complaint-title'))         
                    <a class="dropdown-item sweet-delete" href="{{url('complaint/title/delete',$result->id)}}"><i class="fa fa-trash-o"></i>@lang('view_pages.delete')</a>
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