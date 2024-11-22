@extends('admin.layouts.app')
@section('title', 'Main page')


@section('content')
<br>

<!-- Start Page content -->
 <div class="row">
            @foreach ($card as $items)
                <div class="col-xl-4 col-md-4 col-6" style="margin: 25px">
                    <div class="box box-body">
                        <h5 class="text-capitalize">{{ $items['display_name'] }}</h5>
                        <div class="flexbox wid-icons mt-2">
                            <span class="{{ $items['icon'] }} font-size-40"></span>
                            <span class=" font-size-30">{{ $items['count'] }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="col-xl-6 col-md-4 col-6" style="margin: 25px">
                <div class="box box-body flex">
                    <h5 class="text-capitalize">@lang('view_pages.bank_information') </h5>
                    <div>
                 <span><b>@lang('view_pages.bank_name') : </b>{{$bankInfo->bank_name}}</span><br>
                        <span><b>@lang('view_pages.bank_code')  : </b>{{$bankInfo->bank_code}}</span><br>
                        <span><b>@lang('view_pages.account_holder_name') : </b>{{$bankInfo->account_name}}</span><br>
                        <span><b>@lang('view_pages.account_number') : </b>{{$bankInfo->account_no}}</span><br>
                    </div>
                </div>
          </div>
        </div>


<div class="content" style="margin: 25px">

 <div class="row">
   <h5 style="margin: 25px">@lang('view_pages.withdrawal_requests_history')</h5>
     <div class="col-12">
        <div class="box">
            <table class="table table-hover">
    <thead>
         <tr>
            <th> @lang('view_pages.s_no')</th>
            <th> @lang('view_pages.date')</th>
            <th> @lang('view_pages.name')</th>
            <th> @lang('view_pages.mobile')</th>
            <th> @lang('view_pages.amount')</th>
            <th> @lang('view_pages.status')</th>
            <th> @lang('view_pages.action')</th>

        </tr>
    </thead>
      <tbody>

        @forelse($history as $key => $result)

        <tr>
            <td>{{ $key+1 }} </td>
            <td>{{$result->getConvertedCreatedAtAttribute()}}</td>
            <td>{{$result->driverDetail->name }}</td>
            <td>{{$result->driverDetail->mobile }}</td>
            <td> {{$result->requested_currency}} {{$result->requested_amount}}</td>
            @if ($result->status == 0)
                <td><button class="btn btn-warning btn-sm">@lang('view_pages.requested')</button></td>
            @elseif($result->status==1)
                 <td><button class="btn btn-success btn-sm">@lang('view_pages.approved')</button></td>
            @else
                 <td><button class="btn btn-danger btn-sm">@lang('view_pages.declined')</button></td>
            @endif
            <td>
                <div class="dropdown">
<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('view_pages.action')
</button>
    <div class="dropdown-menu">
        @if ($result->status == 0)
        <a class="dropdown-item" href="{{url('withdrawal-requests-lists/approve',$result->id)}}">
        <i class="fa fa-dot-circle-o"></i>@lang('view_pages.approve')</a>
        <a class="dropdown-item" href="{{url('withdrawal-requests-lists/decline',$result->id)}}">
        <i class="fa fa-dot-circle-o"></i>@lang('view_pages.decline')</a>
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
{{$history->links()}}
</span>
</div>

        </div>
        </div>
        </div>
        </div>





</div>

</div>
<!-- container -->

</div>

@endsection

