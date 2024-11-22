<div class="box-body no-padding">
    <div class="table-responsive">
      <table class="table table-hover">
    <thead>
    <tr>


    <th> @lang('view_pages.s_no')
    <span style="float: right;">

    </span>
    </th>

    <th> @lang('view_pages.name')
    <span style="float: right;">
    </span>
    </th>
    <th> @lang('view_pages.email')
    <span style="float: right;">
    </span>
    </th>
    <th> @lang('view_pages.mobile')
    <span style="float: right;">
    </span>
    </th>
    <th> @lang('view_pages.address')
    <span style="float: right;">
    </span>
    </th>
    <th> @lang('view_pages.status')
    <span style="float: right;">
    </span>
    </th>
    <th> @lang('view_pages.action')
    <span style="float: right;">
    </span>
    </th>
    </tr>
    </thead>
    <tbody>


    @php  $i= $results->firstItem(); @endphp

    @forelse($results as $key => $result)

    <tr>
    <td>{{ $i++ }} </td>
    <td> {{$result->name}}</td>
    @if(env('APP_FOR')=='demo')
        <td>**********</td>
        @else
        <td>{{$result->email}}</td>
    @endif
    @if(env('APP_FOR')=='demo')
        <td>**********</td>
        @else
        <td>{{$result->mobile}}</td>
    @endif
    <td>{{$result->userDetails ? $result->userDetails->address : '-'}}</td>
    @if($result->active)
    <td><span class="label label-success">@lang('view_pages.active')</span></td>
    @else
    <td><span class="label label-danger">@lang('view_pages.inactive')</span></td>
    @endif
    <td>

    <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('view_pages.action')
    </button>
       <div class="dropdown-menu">
        @if(auth()->user()->can('edit-user'))         
            <a class="dropdown-item" href="{{url('users/edit',$result->id)}}">
            <i class="fa fa-pencil"></i>@lang('view_pages.edit')</a>
        @endif
        @if(auth()->user()->can('toggle-user'))         

             @if($result->active)
            <a class="dropdown-item" href="{{url('users/toggle_status',$result->id)}}">
            <i class="fa fa-dot-circle-o"></i>@lang('view_pages.inactive')</a>
            @else
            <a class="dropdown-item" href="{{url('users/toggle_status',$result->id)}}">
            <i class="fa fa-dot-circle-o"></i>@lang('view_pages.active')</a>
            @endif
        @endif
        @if(auth()->user()->can('delete-user'))         
            <a class="dropdown-item sweet-delete" href="#" data-url="{{url('users/delete',$result->id)}}">
            <i class="fa fa-trash-o"></i>@lang('view_pages.delete')</a>
        @endif
        @if(auth()->user()->can('view-user-request-list'))         
              <a class="dropdown-item" href="{{url('users/request-list',$result->id)}}">
              <i class="fa fa-dot-circle-o"></i>@lang('view_pages.request_list')</a>
        @endif
        @if(auth()->user()->can('user-payment-history'))         
            <a class="dropdown-item" href="{{url('users/payment-history',$result->id)}}">
            <i class="fa fa-dot-circle-o"></i>@lang('view_pages.user_payment_history')</a>
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


    <div class="text-right">
<span  style="float:right">
{{$results->links()}}
</span>
</div>
</div></div>
