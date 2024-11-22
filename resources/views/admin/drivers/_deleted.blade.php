<div class="box-body">
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
<th> @lang('view_pages.area')
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
@if($app_for == "super" || $app_for == "bidding");

<th> @lang('view_pages.transport_type')</th>
<span style="float: right;">
</span>
</th>
@endif
<th>@lang('view_pages.document_view')</th>
<span style="float: right;">
</span>
</th>
<th> @lang('view_pages.approve_status')<span style="float: right;"></span></th>
<th> @lang('view_pages.declined_reason')<span style="float: right;"></span></th>
<th> @lang('view_pages.rating')
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
<td>{{ $key+1 }} </td>
<td>{{$result->driver->name}}</td>
@if($result->driver->serviceLocation)
<td>{{$result->driver->serviceLocation->name}}</td>
@else
<td>--</td>
@endif
@if(env('APP_FOR')=='demo')
    <td>**********</td>
    @else
    <td>{{$result->driver->email}}</td>
@endif
@if(env('APP_FOR')=='demo')
    <td>**********</td>
    @else
    <td>{{$result->driver->mobile}}</td>
@endif
@if($app_for == "super" || $app_for == "bidding");

    <td>{{$result->driver->transport_type}}</td>
@endif
<td>
    @if(auth()->user()->can('driver-document'))         
    <a href="{{ url('drivers/document/view',$result->driver->id) }}" class="btn btn-social-icon btn-bitbucket">
        <i class="fa fa-file-text"></i>
    @endif
    </a>
</td>
@if($result->driver->approve)
<td><button class="btn btn-success btn-sm">{{ trans('view_pages.approved') }}</button></td>
@else
<td><button class="btn btn-danger btn-sm">{{ trans('view_pages.disapproved') }}</button></td>
@endif
@if($result->driver->reason)
<td>{{$result->driver->reason}}</td>
@else
<td>--</td>
@endif
<td>
  @php $rating = $result->driver->rating($result->driver->user_id); @endphp  

            @foreach(range(1,5) as $i)
                <span class="fa-stack" style="width:1em">
                   
                    @if($rating > 0)
                        @if($rating > 0.5)
                            <i class="fa fa-star checked"></i>
                        @else
                            <i class="fa fa-star-half-o"></i>
                        @endif
                    @else
                     <i class="fa fa-star-o "></i>
                    @endif
                    @php $rating--; @endphp
                </span>
            @endforeach 

<td>

<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('view_pages.action')
</button>
    <div class="dropdown-menu">
        @if(auth()->user()->can('delete-drivers'))         
        <a class="dropdown-item" href="{{url('drivers/revert_deleted',$result->driver->id)}}">
        <i class="fa fa-dot-circle-o"></i>@lang('view_pages.revert_deleted')</a> 

        <a class="dropdown-item sweet-delete" href="#" data-url="{{url('drivers/delete',$result->driver->id)}}">
        <i class="fa fa-trash-o"></i>@lang('view_pages.delete')</a> 
        @endif
</div>
                     
</td>   
</a>
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