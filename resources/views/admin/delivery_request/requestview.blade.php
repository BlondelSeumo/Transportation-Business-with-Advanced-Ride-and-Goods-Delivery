@extends('admin.layouts.app')

@section('title', 'Users')

@section('content')
<style>
#map {
    height: 300px;
    width: 100%;
    padding: 10px;
}

th {
    text-align: center;
}

td {
    text-align: center;
}

.highlight {
    color: red;
    font-weight: 800;
    font-size: large;
}
</style>
<!-- Start Page content -->
<section class="content">
    <div class="row">
        <div class="col-12">

            <a href="{{ url('requests') }}">
                <button class="btn btn-danger btn-sm pull-right mb-3" type="submit">
                    <i class="mdi mdi-keyboard-backspace mr-2"></i>
                    @lang('view_pages.back')
                </button>
            </a>

            <div class="box">

                <div class="box-header bb-2 border-primary">
                    <h3 class="box-title">@lang('view_pages.map_views')</h3>
                </div>

                <div class="box-body">
                    <div id="map"></div>
                </div>
            </div>

            <div class="box">

                <div class="box-header bb-2 border-primary">
                    <h3 class="box-title">@lang('view_pages.trip_location')</h3>
                </div>

                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>@lang('view_pages.pick_location')</th>
                                <th>@lang('view_pages.drop_location')</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $item->requestPlace->pick_address }}</td>
                                <td>{{ $item->requestPlace->drop_address }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="box">
                <div class="box-header bb-2 border-primary">
                    <h3 class="box-title">@lang('view_pages.request')</h3>
                </div>

                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>@lang('view_pages.zone')</th>
                                <th>@lang('view_pages.transport_type')</th>
                                <th>@lang('view_pages.vehicle_type')</th>
                                <th>@lang('view_pages.trip_time')</th>
                                @if($item->goodsTypeDetail)
                                <th>@lang('view_pages.goods_type_and_quantity')</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $item->zoneType->zone->name }}</td>
                                <td>{{ $item->zoneType->vehicleType->is_taxi }}</td>
                                <td>{{ $item->zoneType->vehicleType->name }}</td>
                                <td>{{ $item->trip_start_time }}</td>
                                @if($item->goodsTypeDetail)
                                <td>{{ $item->goodsTypeDetail->goods_type_name }} - {{$item->goods_type_quantity }}</td>
                                @endif

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="box">
                <div class="box-header bb-2 border-primary">
                    <h3 class="box-title">@lang('view_pages.user_details')</h3>
                </div>

                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>@lang('view_pages.name')</th>
                                <th>@lang('view_pages.email')</th>
                                <th>@lang('view_pages.mobile')</th>
                                <th>@lang('view_pages.rating')</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr>
                                @if($item->userDetail()->exists())
                                <td>{{ $item->userDetail->name }}</td>
                                 @if(env('APP_FOR')=='demo')
                                    <td>**********</td>
                                    @else
                                    <td>{{ $item->userDetail->email }}</td>
                                @endif
                                @if(env('APP_FOR')=='demo')
                                    <td>**********</td>
                                    @else
                                    <td>{{ $item->userDetail->mobile }}</td>
                                @endif
                                <td>{{ $item->requestRating()->where('user_rating',1)->pluck('rating')->first() }}</td>
                                @else
                                 <td>{{ $item->adHocuserDetail->name }}</td>
                                     @if(env('APP_FOR')=='demo')
                                        <td>**********</td>
                                        @else
                                       <td>{{ $item->adHocuserDetail->email }}</td>
                                    @endif
                                    @if(env('APP_FOR')=='demo')
                                        <td>**********</td>
                                        @else
                                        <td>{{ $item->adHocuserDetail->mobile }}</td>
                                    @endif
                                <td>{{ $item->requestRating()->where('user_rating',1)->pluck('rating')->first() }}</td>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="box">
                <div class="box-header bb-2 border-primary">
                    <h3 class="box-title">@lang('view_pages.driver_details')</h3>
                </div>

                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>@lang('view_pages.name')</th>
                                <th>@lang('view_pages.email')</th>
                                <th>@lang('view_pages.mobile')</th>
                                <th>@lang('view_pages.rating')</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $item->driverDetail->name }}</td>
                                     @if(env('APP_FOR')=='demo')
                                        <td>**********</td>
                                        @else
                                        <td>{{ $item->driverDetail->email }}</td>
                                    @endif
                                    @if(env('APP_FOR')=='demo')
                                        <td>**********</td>
                                        @else
                                       <td>{{ $item->driverDetail->mobile }}</td>
                                   @endif
                                <td>{{ $item->requestRating()->where('driver_rating',1)->pluck('rating')->first() }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($item->requestBill)
            <div class="box">
                <div class="box-header bb-2 border-primary">
                    <h3 class="box-title">@lang('view_pages.bill_details')</h3>
                </div>

                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>@lang('view_pages.col_title')</th>
                                <th>@lang('view_pages.description')</th>
                                <th>@lang('view_pages.price')</th>
                            </tr>
                        </thead>

                        @php
                        $requestBill = collect($item->requestBill->toArray());
                        $bill =
                        $requestBill->only(['base_price','distance_price','time_price','waiting_charge','cancellation_fee','service_tax','promo_discount','total_amount','admin_commision','driver_commision']);
                        $bill->all();

                        $bill = $bill->toArray();
                        @endphp

                        <tbody>
                            @foreach ($bill as $key => $value)
                            <tr class="{{ $key == 'total_amount' ? 'highlight' : '' }}">
                                <td>{{ __('view_pages.'.$key) }}</td>

                                <td>
                                    @if ($key == 'distance_price')
                                    {{ $item->total_distance .' '. $item->request_unit  }} *
                                    {{ $item->currency .' '. $item->requestBill->price_per_distance.' / '.$item->request_unit }}
                                    @elseif ($key == 'time_price')
                                    {{ $item->total_time.' Mins' }} *
                                    {{ $item->currency .' '. $item->requestBill->price_per_time.' / Mins' }}
                                    @elseif ($key == 'base_price')
                                    {{  'For first ' . $item->requestBill->base_distance .' '. $item->request_unit }}
                                    @else
                                    -
                                    @endif
                                </td>

                                <td>{{ $value }}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            @endif
            @if(($item->transport_type == 'delivery'))
                     <div class="box">
                                    <div class="box-header bb-2 border-primary">
                                        <h3 class="box-title">@lang('view_pages.delivery_proof')</h3>
                                    </div>

                                    <div class="box-body">
                                        @foreach ($item->requestProofs as $key => $proof)
                                        <img class="max-h" src="{{ $proof->proof_image }}" alt="">
                                        @endforeach
                                    </div>

                     </div>
            @endif
        </div>
    </div>
</section>

<script type="text/javascript"
    src="https://maps.google.com/maps/api/js?key={{get_settings('google_map_key')}}&sensor=false&libraries=places"></script>

<script type="text/javascript">
var area1, area2, icon1, icon2;

area1 = "{{ $item->pick_address }}";
area2 = "{{ $item->drop_address }}";
icon1 = "{{ url('map/start_pin_flag.png') }}";
icon2 = "{{ url('map/end_pin_flag.png') }}";

var locations = [
    [area1, "{{ $item->pick_lat }}", "{{ $item->pick_lng }}", icon1],
    [area2, "{{ $item->drop_lat == null ? $item->pick_lat : $item->drop_lat }}",
        "{{ $item->drop_lng == null ? $item->pick_lng : $item->drop_lng }}", icon2
    ],
];

var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 10,
    center: new google.maps.LatLng(locations[1][1], locations[1][2]),
    mapTypeId: google.maps.MapTypeId.ROADMAP
});

@if($item->request_path != null)
var flightPlanCoordinates = [ < ? php echo $item - > request_path ? > ];

flightPlanCoordinates = flightPlanCoordinates[0];

var flightPath = new google.maps.Polyline({
    path: flightPlanCoordinates,
    geodesic: true,
    strokeColor: '#FF0000',
    strokeOpacity: 4.0,
    strokeWeight: 5
});

flightPath.setMap(map);
@endif

// map new
var infowindow = new google.maps.InfoWindow();
var marker, i;
var markers = new Array();
for (i = 0; i < locations.length; i++) {
    marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        icon: locations[i][3],
        map: map
    });
    markers.push(marker);
    google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
            infowindow.setContent(locations[i][0]);
            infowindow.open(map, marker);
        }
    })(marker, i));
}
</script>
@endsection
