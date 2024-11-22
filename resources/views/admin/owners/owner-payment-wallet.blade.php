@extends('admin.layouts.app')
@section('title', 'Main page')


@section('content')
<br>

<!-- Start Page content -->
 <div class="row">
            @foreach ($card as $items)
                <div class="col-xl-4 col-md-6 col-12">
                    <div class="box box-body">
                        <h5 class="text-capitalize">{{ $items['display_name'] }}</h5>
                        <div class="flexbox wid-icons mt-2">
                            <span class="{{ $items['icon'] }} font-size-40"></span>
                            <span class=" font-size-30">{{ $items['count'] }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


<div class="content">
<div class="container-fluid">

<div class="row">
<div class="col-sm-12">
    <div class="box">

       {{--  <div class="box-header with-border">
            <a href="{{ url('owners') }}">
                <button class="btn btn-danger btn-sm pull-right" type="submit">
                    <i class="mdi mdi-keyboard-backspace mr-2"></i>
                    @lang('view_pages.back')
                </button>
            </a>
        </div> --}}

<div class="col-sm-12">

<form  method="post" class="form-horizontal" action="{{url('owners/payment-history',$item->id)}}" enctype="multipart/form-data">
{{csrf_field()}}


<div class="row">
        <div class="col-sm-6">
            <div class="form-group">
            <label for="amount">@lang('view_pages.amount') <span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="amount" name="amount" value="{{old('amount')}}" required="" placeholder="@lang('view_pages.enter_amount')">
            <span class="text-danger">{{ $errors->first('amount') }}</span>

        </div>
    </div>

               
</div>


<div class="form-group">
        <div class="col-12">
            <button class="btn btn-primary btn-sm m-5 pull-right" type="submit">
                @lang('view_pages.submit')
            </button>
        </div>
    </div>

</form>

            </div>
        </div>


    </div>
</div>

 <div class="content">

        <div class="row">
<h5>Wallet History</h5>
            <div class="col-12">
        <div class="box">            
            <table class="table table-hover">
    <thead>
        <tr>
            <th> @lang('view_pages.s_no')</th>
            <th> @lang('view_pages.request_id')</th>
            <th> @lang('view_pages.owner_name')</th>
            <th> @lang('view_pages.transaction_id')</th>
            <th> @lang('view_pages.amount')</th>
            <th> @lang('view_pages.remarks')</th>
            <th> @lang('view_pages.date')</th>
           
        </tr>
    </thead>
    <tbody>

        @forelse($history as $key => $result)

        <tr>
            <td>{{ $key+1 }} </td>
            <td>{{$result->requestDetail->request_number ?? '-' }}</td>
            <td>{{$item->name ?? '-' }}</td>
            <td>{{$result->transaction_id}}</td>
            @if ($result->is_credit == 1)
                <td><button class="btn btn-success btn-sm">{{$result->amount}}</button></td>
            @else
                 <td><button class="btn btn-danger btn-sm">{{$result->amount}}</button></td>
            @endif
            <td>{!!$result->remarks!!}</td>
            <td>{{$result->getConvertedCreatedAtAttribute()}}</td>

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

