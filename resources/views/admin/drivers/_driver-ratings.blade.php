                            <div class="col-12">
                                <div class="box">           
                                   <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th> @lang('view_pages.s_no')</th>
                                            <th> @lang('view_pages.name')</th>
                                            @if($app_for == "super" || $app_for == "bidding")
                                            <th> @lang('view_pages.transport_type')</th>
                                            @endif                                           
                                            <th> @lang('view_pages.vehicle_type')</th>
                                            <th> @lang('view_pages.mobile')</th>
                                        @if(auth()->user()->can('view-driver-rating'))         
                                            <th> @lang('view_pages.rating')</th>
                                        @endif
                                            <th> @lang('view_pages.action')</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse($results as $key => $result)

                                        <tr>
                                            <td>{{ $key+1}} </td>
                                            <td>{{$result->name ?? '-'}}</td>
                                            @if($app_for == "super" || $app_for == "bidding")
                                            <td>{{$result->transport_type}}</td>
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
                                            @if(env('APP_FOR')=='demo')
                                            <td>**********</td>
                                            @else
                                            <td>{{$result->mobile}}</td>
                                            @endif
                                           
                                           <td>
                                          @php $rating = $result->rating($result->user_id); @endphp  

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

                                        </td>
                                       @if(auth()->user()->can('view-driver-rating'))     
                                       <td>    
                                            <a href="{{ url('driver-ratings/view',$result->id) }}" class="btn btn-primary btn-sm">@lang('view_pages.view')</a>
                                        </td>
                                        @endif

                                        
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
        </div>
    </div>