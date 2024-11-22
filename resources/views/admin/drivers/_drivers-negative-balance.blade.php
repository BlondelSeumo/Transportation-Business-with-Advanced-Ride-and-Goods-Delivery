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
<th> @lang('view_pages.type')
<span style="float: right;">
</span>
<th> @lang('view_pages.wallet_balance')
<span style="float: right;">
</span>
</th>
<!-- <th>@lang('view_pages.document_view')</th>
<th> @lang('view_pages.status')
<span style="float: right;">
</span>
</th> -->
<th> @lang('view_pages.approve_status')<span style="float: right;"></span></th>
<th> @lang('view_pages.declined_reason')<span style="float: right;"></span></th>
<!-- <th> @lang('view_pages.rating')
<span style="float: right;">
</span>
</th> -->
<!-- <th> @lang('view_pages.online_status')<span style="float: right;"></span></th> -->
@if(auth()->user()->can('neagtive-driver-view'))         
<th> @lang('view_pages.action')
<span style="float: right;">
</span>
</th>
@endif
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
<td>{{$result->name}}</td>
@if($result->serviceLocation)
<td>{{$result->serviceLocation->name}}</td>
@else
<td>--</td>
@endif
<td>{{$result->email}}</td>
@if(env('APP_FOR')=='demo')
<td>**********</td>
@else
<td>{{$result->mobile}}</td>
@endif
@if($result->vehicleType!=null)
<td>{{$result->vehicleType->name ?? '-'}}</td>
@else
<td>
@foreach($result->driverVehicleTypeDetail as $vehicleType)
{{ $vehicleType->vehicleType->name.',' }}
@endforeach
</td>
@endif
<td>{{$result->driverWallet->amount_balance}}</td>
<!-- <td>
    <a href="{{ url('drivers/document/view',$result->id) }}" class="btn btn-social-icon btn-bitbucket">
        <i class="fa fa-file-text"></i>
    </a>
</td> -->
<!-- @if($result->active)
<td><button class="btn btn-success btn-sm">{{ trans('view_pages.active') }}</button></td>
@else
<td><button class="btn btn-danger btn-sm">{{ trans('view_pages.inactive') }}</button></td>
@endif -->

@if($result->approve)
<td><button class="btn btn-success btn-sm">{{ trans('view_pages.approved') }}</button></td>
@else
<td><button class="btn btn-danger btn-sm">{{ trans('view_pages.disapproved') }}</button></td>
@endif
@if($result->reason)
<td>{{$result->reason}}</td>
@else
<td>--</td>
@endif

<td>
<div class="dropdown">
@if(auth()->user()->can('neagtive-driver-view'))         
<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('view_pages.action')
</button>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="{{url('drivers/payment-history',$result->id)}}">
        <i class="fa fa-dot-circle-o"></i>@lang('view_pages.driver_payment_history')</a>
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
