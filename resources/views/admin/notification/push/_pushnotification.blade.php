<table class="table table-hover">
    <thead>
        <tr>    
            <th> @lang('view_pages.s_no')</th>   
            <th> @lang('view_pages.push_title')</th>
            <th> @lang('view_pages.message')</th>
            <th> @lang('view_pages.user_type')</th>
            <th> @lang('view_pages.action')</th>
        </tr>
    </thead>

<tbody>
    @php  $i= $results->firstItem(); @endphp
    
    @forelse($results as $key => $result)
        <tr>
            <td>{{ $i++ }} </td>
            <td>{{ $result->title }}</td>
            <td>{{ $result->body }}</td>
            <td>
                @if ($result->for_user && $result->for_driver)
                    <span class="badge badge-success">@lang('view_pages.both')</span>
                @elseif($result->for_user)
                    <span class="badge badge-warning">@lang('view_pages.user')</span>
                @else
                    <span class="badge badge-danger">@lang('view_pages.driver')</span>
                @endif    
            </td>
            
            <td>
                    <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('view_pages.action')</button>
                        <div class="dropdown-menu">
                         @if(auth()->user()->can('delete-notifications'))         
                            <a class="dropdown-item sweet-delete" href="{{url('notifications/push/delete',$result->id)}}"><i class="fa fa-trash-o"></i>@lang('view_pages.delete')</a>
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