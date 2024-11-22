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
    <th> @lang('view_pages.mobile')
    <span style="float: right;">
    </span>
    </th>
      <th> @lang('view_pages.email')
    <span style="float: right;">
    </span>
    </th>
    <th> @lang('view_pages.service_location')
    <span style="float: right;">
    </span>
    </th>
    <th> @lang('view_pages.role')
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
    @if(count($results)<1)
    <tr>
        <td colspan="11">
        <p id="no_data" class="lead no-data text-center">
        <img src="{{asset('assets/img/dark-data.svg')}}" style="width:150px;margin-top:25px;margin-bottom:25px;" alt="">
     <h4 class="text-center" style="color:#333;font-size:25px;">@lang('view_pages.no_data_found')</h4>
 </p>
    </tr>
    @else

    @php  $i= $results->firstItem(); @endphp

    @foreach($results as $key => $result)

    <tr>
    <td>{{ $i++ }} </td>
    <td> {{ $result->first_name .' '.$result->last_name }}</td>
    <td>{{$result->mobile}}</td>
    <td>{{$result->email}}</td>
    <td>{{$result->service_location_name}}</td>
    <td>

        @foreach($result->user->roles as $key=>$role)
          @if($role->name == 'Dispatcher')
              {{ "Taxi Dispatcher" }}
            @else
            {{$role->name}}
          @endif
        @endforeach

    </td>
    @if($result->user->active)
    <td><button class="btn btn-success btn-sm">@lang('view_pages.active')</button></td>
    @else
    <td><button class="btn btn-danger btn-sm">@lang('view_pages.inactive')</button></td>
    @endif
    <td>

    <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('view_pages.action')
    </button>
      <div class="dropdown-menu">
        @if(auth()->user()->can('edit-admin'))         

            <a class="dropdown-item" href="{{url('admins/edit',$result->id)}}">
            <i class="fa fa-pencil"></i>@lang('view_pages.edit')</a>
        @endif
        @if(auth()->user()->can('toggle-admin-status'))         

            @if($result->user->active)
            <a class="dropdown-item" href="{{url('admins/toggle_status',$result->user->id)}}">
            <i class="fa fa-dot-circle-o"></i>@lang('view_pages.inactive')</a>
            @else
            <a class="dropdown-item" href="{{url('admins/toggle_status',$result->user->id)}}">
            <i class="fa fa-dot-circle-o"></i>@lang('view_pages.active')</a>
            @endif
        @endif    
        @if(auth()->user()->can('delete-admin'))         
            <a class="dropdown-item sweet-delete" href="#" data-url="{{url('admins/delete',$result->user->id)}}">
            <i class="fa fa-trash-o"></i>@lang('view_pages.delete')</a>
        @endif    
            
        </div>
    </div>

    </td>
    </tr>
    @endforeach
    @endif
    </tbody>
    </table>
    <div class="text-right">
    <span  style="float:right">
    {{$results->links()}}
    </span>
    </div>
    </div>
    </div>
