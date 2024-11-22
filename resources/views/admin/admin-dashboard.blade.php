@extends('admin.layouts.app')

@section('content')

    <!-- Morris charts -->
    <link rel="stylesheet" href{!! asset('assets/vendor_components/morris.js/morris.css') !!}">
    <style>
        .text-red {
            color: red;
        }

        .demo-radio-button label {
            font-size: 15px;
            font-weight: 600 !important;
            margin-bottom: 5px !important;
        }

        .box-title {
            font-size: 15px;
            margin: 0 0 7px 0;
            margin-bottom: 7px;
            font-weight: 600;
        }

        .total-earnings-text {
            font-size: 15px;
        }

        .total-earnings {
            font-size: 30px;
            margin-bottom: 60px;
        }

        #map {
            height: 50vh;
            margin: 10px;
        }

        #legend {
            font-family: Arial, sans-serif;
            background: #fff;
            padding: 10px;
            margin: 10px;
            border: 3px solid #000;
        }

        #legend h3 {
            margin-top: 0;
        }

        #legend img {
            vertical-align: middle;
        }

        .g-3 h6 {
            font-weight: 600;
        }

        .g-3 a {
            font-weight: 600;
        }

        .g-3 .bg-holder {
            position: absolute;
            width: 100%;
            min-height: 100%;
            top: 0;
            left: 0;
            background-size: cover;
            background-position: center;
            overflow: hidden;
            will-change: transform, opacity, filter;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            background-repeat: no-repeat;
            z-index: 0;
        }

        .g-3 .bg-card {
            background-size: contain;
            background-position: right;
            border-top-right-radius: 0.375rem;
            border-bottom-right-radius: 0.375rem;
        }

        .g-3 .display-4 {
            font-size: 2.5rem;
            font-weight: 300;
            line-height: 1.2;
        }

        .badge {
            display: inline-block;
            padding: .35556em .71111em;
            font-size: .75em;
            font-weight: 600;
            line-height: 1;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: .25rem;
            background-image: var(--bs-gradient);
        }

        .badge-soft-warning {
            color: #9d5228;
            background-color: #fde6d8;
        }

        .badge-soft-success {
            color: #00864e;
            background-color: #ccf6e4;
        }

        .g-3 .dropdown-menu,
        .dropdown-grid {
            width: -webkit-fill-available;
            border: 1px solid #c5c5c5;
        }

    </style>
    <!-- Start Page content -->
    <section class="content">

        {{-- <div class="row g-3 pb-15 pb-md-0 justify-content-end">
            <div class="col-md-2 pb-4 pb-md-0">
                <div class="dropdown">
                    <button class="btn btn-outline btn-dark w-full dropdown-toggle" type="button"
                        data-toggle="dropdown">Select
                        Brand</button>
                    <div class="dropdown-menu">
                        <h4 class="pl-2 pt-2">
                            Brand Name
                        </h4>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item flexbox" href="#">
                            <span>Tagxi</span>
                            <span class="badge badge-pill badge-dark">5</span>
                        </a>
                        <a class="dropdown-item" href="#">Tagyourtruck</a>
                        <a class="dropdown-item" href="#">iizi-taxi</a>
                        <div class="dropdown-divider"></div>
                        <h4 class="pl-2 pt-2">
                            Zone Name
                        </h4>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item flexbox" href="#">
                            <span>Coimbature</span>
                        </a>
                        <a class="dropdown-item flexbox" href="#">
                            <span>Chennai</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-6">
                <form action="post">
                    <div class="form-group has-feedback">
                        <input type="date" class="form-control btn btn-outline btn-dark" placeholder="From Date"
                            style="height: 45px">
                    </div>
                </form>
            </div>
            <div class="col-md-2 col-6">
                <form action="post">
                    <div class="form-group has-feedback">
                        <input type="date" class="form-control btn btn-outline btn-dark" placeholder="To Date"
                            style="height: 45px">
                    </div>
                </form>
            </div>
            <div class="col-md-1">
                <button class="btn btn-outline btn-dark bg-dark text-white w-full w-md-auto" type="button">Go</button>
            </div>
        </div> --}}
      
        <div class="row g-3">
            <div class="col-sm-6 col-md-3">
                <div class="card overflow-hidden" style="min-width: 12rem">
                    <div class="bg-holder bg-card"
                        style="background-image:url({{ asset('assets/images/corner-3.png') }});">
                    </div>
                    <!--/.bg-holder-->
                    <div class="card-body position-relative">
                        <h6>@lang('view_pages.drivers_registered')<span class="badge badge-soft-warning rounded-pill ml-2">-0.23%</span>
                        </h6>
                        <div class="display-4 fs-4 mb-2 font-weight-normal font-sans-serif text-warning"
                            data-countup="{&quot;endValue&quot;:58.386,&quot;decimalPlaces&quot;:2,&quot;suffix&quot;:&quot;k&quot;}">
                            {{ $total_drivers }}</div><a class="font-weight-semi-bold fs--1 text-nowrap" href="#">@lang('view_pages.see_all')<span class="fa fa-angle-right ml-1" data-fa-transform="down-1"></span></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card overflow-hidden" style="min-width: 12rem">
                    <div class="bg-holder bg-card"
                        style="background-image:url({{ asset('assets/images/corner-2.png') }});">
                    </div>
                    <!--/.bg-holder-->
                    <div class="card-body position-relative">
                        <h6>@lang('view_pages.drivers_approved')<span class="badge badge-soft-success rounded-pill ml-2">25%</span>
                        </h6>
                        <div class="display-4 fs-4 mb-2 font-weight-normal font-sans-serif text-success"
                            data-countup="{&quot;endValue&quot;:58.386,&quot;decimalPlaces&quot;:2,&quot;suffix&quot;:&quot;k&quot;}">
                            {{ $driver_approval }}</div><a class="font-weight-semi-bold fs--1 text-nowrap" href="#">@lang('view_pages.see_all')<span class="fa fa-angle-right ml-1" data-fa-transform="down-1"></span></a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <div class="card overflow-hidden" style="min-width: 12rem">
                    <div class="bg-holder bg-card"
                        style="background-image:url({{ asset('assets/images/corner-2.png') }});">
                    </div>
                    <!--/.bg-holder-->
                    <div class="card-body position-relative">
                        <h6>>@lang('view_pages.drivers_waiting_for_approval')<span
                                class="badge badge-soft-warning rounded-pill ml-2">-0.23%</span>
                        </h6>
                        <div class="display-4 fs-4 mb-2 font-weight-normal font-sans-serif text-warning"
                            data-countup="{&quot;endValue&quot;:58.386,&quot;decimalPlaces&quot;:2,&quot;suffix&quot;:&quot;k&quot;}">
                            {{ $driver_approval_waiting }}</div><a class="font-weight-semi-bold fs--1 text-nowrap"
                            href="#">@lang('view_pages.see_all')<span class="fa fa-angle-right ml-1" data-fa-transform="down-1"></span></a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <div class="card overflow-hidden" style="min-width: 12rem">
                    <div class="bg-holder bg-card"
                        style="background-image:url({{ asset('assets/images/corner-1.png') }});">
                    </div>
                    <!--/.bg-holder-->
                    <div class="card-body position-relative">
                        <h6> @lang('view_pages.users_registered')<span class="badge badge-soft-warning rounded-pill ml-2">-0.23%</span>
                        </h6>
                        <div class="display-4 fs-4 mb-2 font-weight-normal font-sans-serif text-danger"
                            data-countup="{&quot;endValue&quot;:58.386,&quot;decimalPlaces&quot;:2,&quot;suffix&quot;:&quot;k&quot;}">
                            {{ $total_users }}</div><a class="font-weight-semi-bold fs--1 text-nowrap" href="#">@lang('view_pages.see_all')<span class="fa fa-angle-right ml-1" data-fa-transform="down-1"></span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-md-12">
                <div class="row">


                    <div class="col-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="font-weight-600">@lang('view_pages.todays_trips')</h3>
                                <ul class="box-controls pull-right">
                                    <li><a class="box-btn-close" href="#"></a></li>
                                    <li><a class="box-btn-slide" href="#"></a></li>
                                    <li><a class="box-btn-fullscreen" href="#"></a></li>
                                </ul>
                            </div>

                            <div class="box-body row">
                                <div class="col-md-6">
                                    <canvas id="trips" height="200"></canvas>
                                </div>

                                <div class="col-md-6 m-auto">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="info-box">
                                                <span class="info-box-icon rounded" style="background-color:#7460ee"><i
                                                        class="ion ion-stats-bars text-white"></i></span>
                                                <div class="info-box-content" style="color: #455a80">
                                                    <h4 class="font-weight-600">
                                                        $15,956
                                                        <br>
                                                       @lang('view_pages.today_earnings')
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="box box-body">
                                                <div class="font-size-18 flexbox align-items-center" style="color: #7460ee">
                                                    <span style="color: #455a80">B  @lang('view_pages.by_cash')</span>
                                                    <span>$5,956</span>
                                                </div>
                                                <div class="progress progress-xxs mt-10 mb-0">
                                                    <div class="progress-bar" role="progressbar"
                                                        style="width: 65%; height: 4px;background-color: #7460ee;"
                                                        aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <div class="text-right"><small class="font-weight-300 mb-5"><i
                                                            class="fa fa-sort-up text-success mr-1"></i> 60%</small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="box box-body">
                                                <div class="font-size-18 flexbox align-items-center" style="color: #7460ee">
                                                    <span style="color: #455a80">@lang('view_pages.by_wallet')</span>
                                                    <span>$1,025</span>
                                                </div>
                                                <div class="progress progress-xxs mt-10 mb-0">
                                                    <div class="progress-bar" role="progressbar"
                                                        style="width: 65%; height: 4px;background-color: #7460ee"
                                                        aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <div class="text-right"><small class="font-weight-300 mb-5"><i
                                                            class="fa fa-sort-up text-success mr-1"></i> 30%</small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="box box-body">
                                                <div class="font-size-18 flexbox align-items-center" style="color: #7460ee">
                                                    <span style="color: #455a80"> @lang('view_pages.by_card_online')</span>
                                                    <span>$5,902</span>
                                                </div>
                                                <div class="progress progress-xxs mt-10 mb-0">
                                                    <div class="progress-bar" role="progressbar"
                                                        style="width: 65%; height: 4px;background-color: #7460ee"
                                                        aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <div class="text-right"><small class="font-weight-300 mb-5"><i
                                                            class="fa fa-sort-up text-success mr-1"></i> 10%</small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="info-box">
                                                <span class="info-box-icon rounded" style="background-color: #fc4b6c"><i
                                                        class="ion ion-stats-bars text-white"></i></span>
                                                <div class="info-box-content" style="color: #fc4b6c">
                                                    <h4 class="font-weight-600">
                                                        $5,000
                                                        <br>
                                                      @lang('view_pages.commision')
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="info-box">
                                                <span class="info-box-icon rounded" style="background-color:#26c6da"><i
                                                        class="ion ion-stats-bars text-white"></i></span>
                                                <div class="info-box-content" style="color: #26c6da">
                                                    <h4 class="font-weight-600">
                                                        $10,956
                                                        <br>
                                                        @lang('view_pages.driver_earnings')
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="font-weight-600">@lang('view_pages.cancellation_chart')</h3>
                        <ul class="box-controls pull-right">
                            <li><a class="box-btn-close" href="#"></a></li>
                            <li><a class="box-btn-slide" href="#"></a></li>
                            <li><a class="box-btn-fullscreen" href="#"></a></li>
                        </ul>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="chart" id="bar-chart" style="height: 300px;"></div>
                            </div>
                            <div class="col-md-6 m-auto">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="box box-body bg-primary">
                                            <div class="flexbox">
                                                <span class="ion ion-ios-person-outline font-size-50"></span>
                                                <span class="font-size-40 font-weight-200">45,965</span>
                                            </div>
                               <div class="text-right">@lang('view_pages.total_request_cancelled')</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="box box-body bg-primary" style="background-color: #1e88e5 !important">
                                            <div class="flexbox">
                                                <span class="ion ion-ios-person-outline font-size-50"></span>
                                                <span class="font-size-40 font-weight-200">45,965</span>
                                            </div>
                                            <div class="text-right">@lang('view_pages.cancelled_due_to_no_drivers')</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="box box-body bg-primary" style="background-color: #26c6da !important">
                                            <div class="flexbox">
                                                <span class="ion ion-ios-person-outline font-size-50"></span>
                                                <span class="font-size-40 font-weight-200">45,965</span>
                                            </div>
                                                    <div class="text-right">@lang('view_pages.cancelled_by_user')</div>
                                        </div> 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="box box-body bg-primary" style="background-color: #fc4b6c !important">
                                            <div class="flexbox">
                                                <span class="ion ion-ios-person-outline font-size-50"></span>
                                                <span class="font-size-40 font-weight-200">45,965</span>
                                            </div>
                                             <div class="text-right">@lang('view_pages.cancelled_by_driver')</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <div class="col-12 col-lg-12">
                <!-- DONUT CHART -->
                <div class="box">
                    <div class="box-header with-border pb-0 mb-20">
                        <div class="row">
                            <div class="col-md-4">
                                <h3 class="font-weight-600">@lang('view_pages.overall_earnings')</h3>
                            </div>
                            <div class="col-md-8">
                                <div class="row g-3 pb-15 pb-md-0 justify-content-end">
                                    <div class="col-md-4 pb-4 pb-md-0">
                                        <div class="dropdown">
                                            <button class="btn btn-outline btn-dark w-full dropdown-toggle" type="button"
                                                data-toggle="dropdown">Select
                                                Brand</button>
                                            <div class="dropdown-menu">
                                                <h4 class="pl-2 pt-2">
                                                    Brand Name
                                                </h4>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item flexbox" href="#">
                                                    <span>Tagxi</span>
                                                    <span class="badge badge-pill badge-dark">5</span>
                                                </a>
                                                <a class="dropdown-item" href="#">Tagyourtruck</a>
                                                <a class="dropdown-item" href="#">iizi-taxi</a>
                                                <div class="dropdown-divider"></div>
                                                <h4 class="pl-2 pt-2">
                                                    Zone Name
                                                </h4>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item flexbox" href="#">
                                                    <span>Coimbature</span>
                                                </a>
                                                <a class="dropdown-item flexbox" href="#">
                                                    <span>Chennai</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <form action="post">
                                            <div class="form-group has-feedback">
                                                <input type="date" class="form-control btn btn-outline btn-dark"
                                                    placeholder="From Date" style="height: 45px">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <form action="post">
                                            <div class="form-group has-feedback">
                                                <input type="date" class="form-control btn btn-outline btn-dark"
                                                    placeholder="To Date" style="height: 45px">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-outline btn-dark bg-dark text-white w-full w-md-auto"
                                            type="button">Go</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="box-body chart-responsive">
                                <canvas id="chart_1" height="200"></canvas>
                            </div>
                        </div>

                        <div class="col-md-6 m-auto pr-25">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="info-box">
                                        <span class="info-box-icon rounded" style="background-color:#7460ee"><i
                                                class="ion ion-stats-bars text-white"></i></span>
                                        <div class="info-box-content" style="color: #455a80">
                                            <h4 class="font-weight-600">
                                                $15,956
                                                <br>
                                               @lang('view_pages.overall_earnings')
                                            </h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="box box-body">
                                        <div class="font-size-18 flexbox align-items-center" style="color: #7460ee">
                                            <span style="color: #455a80">By Cash</span>
                                            <span>$5,956</span>
                                        </div>
                                        <div class="progress progress-xxs mt-10 mb-0">
                                            <div class="progress-bar" role="progressbar"
                                                style="width: 65%; height: 4px;background-color: #7460ee;"
                                                aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div class="text-right"><small class="font-weight-300 mb-5"><i
                                                    class="fa fa-sort-up text-success mr-1"></i> 60%</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="box box-body">
                                        <div class="font-size-18 flexbox align-items-center" style="color: #7460ee">
                                            <span style="color: #455a80">By Wallet</span>
                                            <span>$1,025</span>
                                        </div>
                                        <div class="progress progress-xxs mt-10 mb-0">
                                            <div class="progress-bar" role="progressbar"
                                                style="width: 65%; height: 4px;background-color: #7460ee" aria-valuenow="65"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div class="text-right"><small class="font-weight-300 mb-5"><i
                                                    class="fa fa-sort-up text-success mr-1"></i> 30%</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="box box-body">
                                        <div class="font-size-18 flexbox align-items-center" style="color: #7460ee">
                                            <span style="color: #455a80">By Card/Online</span>
                                            <span>$5,902</span>
                                        </div>
                                        <div class="progress progress-xxs mt-10 mb-0">
                                            <div class="progress-bar" role="progressbar"
                                                style="width: 65%; height: 4px;background-color: #7460ee" aria-valuenow="65"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div class="text-right"><small class="font-weight-300 mb-5"><i
                                                    class="fa fa-sort-up text-success mr-1"></i> 10%</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="info-box">
                                        <span class="info-box-icon rounded" style="background-color: #fc4b6c"><i
                                                class="ion ion-stats-bars text-white"></i></span>
                                        <div class="info-box-content" style="color: #fc4b6c">
                                            <h4 class="font-weight-600">
                                                $5,000
                                                <br>
                                                Commision
                                            </h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="info-box">
                                        <span class="info-box-icon rounded" style="background-color:#26c6da"><i
                                                class="ion ion-stats-bars text-white"></i></span>
                                        <div class="info-box-content" style="color: #26c6da">
                                            <h4 class="font-weight-600">
                                                $10,956
                                                <br>
                                                Driver Earnings
                                            </h4>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.box -->

            </div>

            <div class="col-md-12">

                <!-- Radar CHART -->
                <div class="box">
                    <div class="box-header with-border">
                        <div class="row">
                            <div class="col-md-4">
                                <h3 class="font-weight-600">Radar Chart</h3>
                            </div>
                            <div class="col-md-8">
                                <div class="row g-3 pb-15 pb-md-0 justify-content-end">
                                    <div class="col-md-4 pb-4 pb-md-0">
                                        <div class="dropdown">
                                            <button class="btn btn-outline btn-dark w-full dropdown-toggle" type="button"
                                                data-toggle="dropdown">Select
                                                Brand</button>
                                            <div class="dropdown-menu">
                                                <h4 class="pl-2 pt-2">
                                                    Brand Name
                                                </h4>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item flexbox" href="#">
                                                    <span>Tagxi</span>
                                                    <span class="badge badge-pill badge-dark">5</span>
                                                </a>
                                                <a class="dropdown-item" href="#">Tagyourtruck</a>
                                                <a class="dropdown-item" href="#">iizi-taxi</a>
                                                <div class="dropdown-divider"></div>
                                                <h4 class="pl-2 pt-2">
                                                    Zone Name
                                                </h4>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item flexbox" href="#">
                                                    <span>Coimbature</span>
                                                </a>
                                                <a class="dropdown-item flexbox" href="#">
                                                    <span>Chennai</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <form action="post">
                                            <div class="form-group has-feedback">
                                                <input type="date" class="form-control btn btn-outline btn-dark"
                                                    placeholder="From Date" style="height: 45px">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <form action="post">
                                            <div class="form-group has-feedback">
                                                <input type="date" class="form-control btn btn-outline btn-dark"
                                                    placeholder="To Date" style="height: 45px">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-outline btn-dark bg-dark text-white w-full w-md-auto"
                                            type="button">Go</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <canvas id="chart_3" height="200"></canvas>
                            </div>
                            <div class="col-md-6">
                                <div class="row py-2 m-0">
                                    <div class="col-lg-6 pl-xl-0">
                                        <h2 class="text-lgreen m-0">$125</h2>
                                        <p class="m-0">Expenses</p>
                                        <div class="progress mt-4">
                                            <div class="progress-bar progress-bar-primary progress-bar-striped"
                                                style="width: 60%;" role="progressbar"><span class="sr-only">60%
                                                    Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 pr-xl-0">
                                        <h2 class="text-lgreen m-0">$125</h2>
                                        <p class="m-0">Transaction</p>
                                        <div class="progress mt-4">
                                            <div class="progress-bar progress-bar-danger progress-bar-striped"
                                                style="width: 60%;" role="progressbar"><span class="sr-only">60%
                                                    Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 pl-xl-0">
                                        <h2 class="text-lgreen m-0">$125</h2>
                                        <p class="m-0">Expenses</p>
                                        <div class="progress mt-4">
                                            <div class="progress-bar progress-bar-info progress-bar-striped"
                                                style="width: 60%;" role="progressbar"><span class="sr-only">60%
                                                    Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 pr-xl-0">
                                        <h2 class="text-lgreen m-0">$125</h2>
                                        <p class="m-0">Transaction</p>
                                        <div class="progress mt-4">
                                            <div class="progress-bar progress-bar-warning progress-bar-striped"
                                                style="width: 60%;" role="progressbar"><span class="sr-only">60%
                                                    Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 pl-xl-0">
                                        <h2 class="text-lgreen m-0">$125</h2>
                                        <p class="m-0">Expenses</p>
                                        <div class="progress mt-4">
                                            <div class="progress-bar progress-bar-default progress-bar-striped"
                                                style="width: 60%;" role="progressbar"><span class="sr-only">60%
                                                    Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 pr-xl-0">
                                        <h2 class="text-lgreen m-0">$125</h2>
                                        <p class="m-0">Transaction</p>
                                        <div class="progress mt-4">
                                            <div class="progress-bar progress-bar-success progress-bar-striped"
                                                style="width: 60%;" role="progressbar"><span class="sr-only">60%
                                                    Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <div class="col-md-12">
                <!-- Line CHART -->
                <div class="box">
                    <div class="box-header with-border">
                        <div class="row">
                            <div class="col-md-4">
                                <h3 class="font-weight-600">Line Chart</h3>
                            </div>
                            <div class="col-md-8">
                                <div class="row g-3 pb-15 pb-md-0 justify-content-end">
                                    <div class="col-md-4 pb-4 pb-md-0">
                                        <div class="dropdown">
                                            <button class="btn btn-outline btn-dark w-full dropdown-toggle" type="button"
                                                data-toggle="dropdown">Select
                                                Brand</button>
                                            <div class="dropdown-menu">
                                                <h4 class="pl-2 pt-2">
                                                    Brand Name
                                                </h4>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item flexbox" href="#">
                                                    <span>Tagxi</span>
                                                    <span class="badge badge-pill badge-dark">5</span>
                                                </a>
                                                <a class="dropdown-item" href="#">Tagyourtruck</a>
                                                <a class="dropdown-item" href="#">iizi-taxi</a>
                                                <div class="dropdown-divider"></div>
                                                <h4 class="pl-2 pt-2">
                                                    Zone Name
                                                </h4>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item flexbox" href="#">
                                                    <span>Coimbature</span>
                                                </a>
                                                <a class="dropdown-item flexbox" href="#">
                                                    <span>Chennai</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <form action="post">
                                            <div class="form-group has-feedback">
                                                <input type="date" class="form-control btn btn-outline btn-dark"
                                                    placeholder="From Date" style="height: 45px">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <form action="post">
                                            <div class="form-group has-feedback">
                                                <input type="date" class="form-control btn btn-outline btn-dark"
                                                    placeholder="To Date" style="height: 45px">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-outline btn-dark bg-dark text-white w-full w-md-auto"
                                            type="button">Go</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="chart">
                                    <canvas id="chart_1" height="200"></canvas>
                                </div>
                            </div>
                            <div class="col-md-5 m-auto">
                                <div class="info-box text-white" style="background: #26c6da !important;">
                                    <span class="info-box-icon push-bottom rounded"><i
                                            class="ion ion-ios-pricetag-outline"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">New Clients</span>
                                        <span class="info-box-number">450</span>

                                        <div class="progress">
                                            <div class="progress-bar" style="width: 45%"></div>
                                        </div>
                                        <span class="progress-description">
                                            45% Increase in 28 Days
                                        </span>
                                    </div>
                                </div>

                                <div class="info-box text-white" style="background: #ffb22b !important;">
                                    <span class="info-box-icon push-bottom rounded"><i
                                            class="ion ion-ios-pricetag-outline"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">New Clients</span>
                                        <span class="info-box-number">450</span>

                                        <div class="progress">
                                            <div class="progress-bar" style="width: 45%"></div>
                                        </div>
                                        <span class="progress-description">
                                            45% Increase in 28 Days
                                        </span>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                </div>
                <!-- /.col (LEFT) -->
                <div class="col-md-12">
                    <!-- Doughnut CHART -->
                    <div class="box">
                        <div class="box-header with-border">
                            <div class="row">
                                <div class="col-md-4">
                                    <h3 class="font-weight-600">Doughnut Chart</h3>
                                </div>
                                <div class="col-md-8">
                                    <div class="row g-3 pb-15 pb-md-0 justify-content-end">
                                        <div class="col-md-4 pb-4 pb-md-0">
                                            <div class="dropdown">
                                                <button class="btn btn-outline btn-dark w-full dropdown-toggle"
                                                    type="button" data-toggle="dropdown">Select
                                                    Brand</button>
                                                <div class="dropdown-menu">
                                                    <h4 class="pl-2 pt-2">
                                                        Brand Name
                                                    </h4>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item flexbox" href="#">
                                                        <span>Tagxi</span>
                                                        <span class="badge badge-pill badge-dark">5</span>
                                                    </a>
                                                    <a class="dropdown-item" href="#">Tagyourtruck</a>
                                                    <a class="dropdown-item" href="#">iizi-taxi</a>
                                                    <div class="dropdown-divider"></div>
                                                    <h4 class="pl-2 pt-2">
                                                        Zone Name
                                                    </h4>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item flexbox" href="#">
                                                        <span>Coimbature</span>
                                                    </a>
                                                    <a class="dropdown-item flexbox" href="#">
                                                        <span>Chennai</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-6">
                                            <form action="post">
                                                <div class="form-group has-feedback">
                                                    <input type="date" class="form-control btn btn-outline btn-dark"
                                                        placeholder="From Date" style="height: 45px">
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-3 col-6">
                                            <form action="post">
                                                <div class="form-group has-feedback">
                                                    <input type="date" class="form-control btn btn-outline btn-dark"
                                                        placeholder="To Date" style="height: 45px">
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-2">
                                            <button class="btn btn-outline btn-dark bg-dark text-white w-full w-md-auto"
                                                type="button">Go</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="chart">
                                        <canvas id="chart_7" height="200"></canvas>
                                    </div>
                                </div>
                                <div class="col-md-6 m-auto">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <!-- small box -->
                                            <div class="small-box text-white" style="background-color:#fc4b6c">
                                                <div class="inner">
                                                    <h3>65</h3>

                                                    <p>New Visitors</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fa fa-pie-chart"></i>
                                                </div>
                                                <a href="#" class="small-box-footer">More info <i
                                                        class="fa fa-arrow-right"></i></a>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <!-- small box -->
                                            <div class="small-box text-white" style="background-color:#7460ee">
                                                <div class="inner">
                                                    <h3>65</h3>

                                                    <p>New Visitors</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fa fa-pie-chart"></i>
                                                </div>
                                                <a href="#" class="small-box-footer">More info <i
                                                        class="fa fa-arrow-right"></i></a>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <!-- small box -->
                                            <div class="small-box text-white" style="background-color:#26c6da">
                                                <div class="inner">
                                                    <h3>65</h3>

                                                    <p>New Visitors</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fa fa-pie-chart"></i>
                                                </div>
                                                <a href="#" class="small-box-footer">More info <i
                                                        class="fa fa-arrow-right"></i></a>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <!-- small box -->
                                            <div class="small-box text-white" style="background-color:#ffb22b">
                                                <div class="inner">
                                                    <h3>65</h3>

                                                    <p>New Visitors</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fa fa-pie-chart"></i>
                                                </div>
                                                <a href="#" class="small-box-footer">More info <i
                                                        class="fa fa-arrow-right"></i></a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <div class="col-md-6">
                    <!-- pie CHART -->
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Pie Chart</h3>

                            <ul class="box-controls pull-right">
                                <li><a class="box-btn-close" href="#"></a></li>
                                <li><a class="box-btn-slide" href="#"></a></li>
                                <li><a class="box-btn-fullscreen" href="#"></a></li>
                            </ul>
                        </div>
                        <div class="box-body">
                            <div class="chart">
                                <canvas id="chart_6" height="200"></canvas>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <div class="col-md-6">
                    <!-- Polar area  CHART -->
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Polar area Chart</h3>

                            <ul class="box-controls pull-right">
                                <li><a class="box-btn-close" href="#"></a></li>
                                <li><a class="box-btn-slide" href="#"></a></li>
                                <li><a class="box-btn-fullscreen" href="#"></a></li>
                            </ul>
                        </div>
                        <div class="box-body">
                            <div class="chart">
                                <canvas id="chart_4" height="200"></canvas>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                </div>
                <!-- /.col (RIGHT) -->
                <div class="col-md-6">

                    <!-- Bubble CHART -->
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Bubble Chart</h3>

                            <ul class="box-controls pull-right">
                                <li><a class="box-btn-close" href="#"></a></li>
                                <li><a class="box-btn-slide" href="#"></a></li>
                                <li><a class="box-btn-fullscreen" href="#"></a></li>
                            </ul>
                        </div>
                        <div class="box-body">
                            <div class="chart">
                                <canvas id="chart_5" height="200"></canvas>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                </div>
                <div class="col-md-6">

                    <!-- Bar CHART -->
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Bar Chart</h3>

                            <ul class="box-controls pull-right">
                                <li><a class="box-btn-close" href="#"></a></li>
                                <li><a class="box-btn-slide" href="#"></a></li>
                                <li><a class="box-btn-fullscreen" href="#"></a></li>
                            </ul>
                        </div>
                        <div class="box-body">
                            <div class="chart">
                                <canvas id="chart_8" height="510"></canvas>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                </div>
                <div class="col-12 col-lg-12">
                    <!-- LINE CHART -->
                    <div class="box">
                        <div class="box-header with-border">
                            <div class="row">
                                <div class="col-md-4">
                                    <h3 class="font-weight-600">Analatics</h3>
                                </div>
                                <div class="col-md-8">
                                    <div class="row g-3 pb-15 pb-md-0 justify-content-end">
                                        <div class="col-md-4 pb-4 pb-md-0">
                                            <div class="dropdown">
                                                <button class="btn btn-outline btn-dark w-full dropdown-toggle"
                                                    type="button" data-toggle="dropdown">Select
                                                    Brand</button>
                                                <div class="dropdown-menu">
                                                    <h4 class="pl-2 pt-2">
                                                        Brand Name
                                                    </h4>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item flexbox" href="#">
                                                        <span>Tagxi</span>
                                                        <span class="badge badge-pill badge-dark">5</span>
                                                    </a>
                                                    <a class="dropdown-item" href="#">Tagyourtruck</a>
                                                    <a class="dropdown-item" href="#">iizi-taxi</a>
                                                    <div class="dropdown-divider"></div>
                                                    <h4 class="pl-2 pt-2">
                                                        Zone Name
                                                    </h4>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item flexbox" href="#">
                                                        <span>Coimbature</span>
                                                    </a>
                                                    <a class="dropdown-item flexbox" href="#">
                                                        <span>Chennai</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-6">
                                            <form action="post">
                                                <div class="form-group has-feedback">
                                                    <input type="date" class="form-control btn btn-outline btn-dark"
                                                        placeholder="From Date" style="height: 45px">
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-3 col-6">
                                            <form action="post">
                                                <div class="form-group has-feedback">
                                                    <input type="date" class="form-control btn btn-outline btn-dark"
                                                        placeholder="To Date" style="height: 45px">
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-2">
                                            <button class="btn btn-outline btn-dark bg-dark text-white w-full w-md-auto"
                                                type="button">Go</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-body chart-responsive">
                            <div class="chart" id="line-chart" style="height: 300px;"></div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                </div>

                <div class="col-12 col-lg-6">
                    <!-- BAR CHART -->
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Download Count</h3>

                            <ul class="box-controls pull-right">
                                <li><a class="box-btn-close" href="#"></a></li>
                                <li><a class="box-btn-slide" href="#"></a></li>
                                <li><a class="box-btn-fullscreen" href="#"></a></li>
                            </ul>
                        </div>
                        <div class="box-body chart-responsive">
                            <div class="chart" id="bar-chart" style="height: 300px;"></div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>

                <div class="col-12 col-lg-6">
                    <!-- AREA CHART -->
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Revenue Statistics</h3>

                            <ul class="box-controls pull-right">
                                <li><a class="box-btn-close" href="#"></a></li>
                                <li><a class="box-btn-slide" href="#"></a></li>
                                <li><a class="box-btn-fullscreen" href="#"></a></li>
                            </ul>
                        </div>
                        <div class="box-body chart-responsive">
                            <div class="chart" id="revenue-chart" style="height: 300px;"></div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                </div>
            </div>

    </section>


    <script>
        $(function() {
            'use strict';

            // pie chart
            $("span.piee").peity("pie", {
                height: 220,
                width: 300,
            });

        }); // End of use strict

    </script>

    <!-- Morris.js charts -->
    <script src="{{ asset('assets/vendor_components/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_components/morris.js/morris.min.js') }}"></script>

    <script>
        $(function() {
            "use strict";

            //BAR CHART
            var bar = new Morris.Bar({
                element: 'bar-chart',
                resize: true,
                data: [{
                        y: 'Mon',
                        a: 4,
                        b: 5,
                        c: 6
                    },
                    {
                        y: 'Tue',
                        a: 1,
                        b: 2,
                        c: 3
                    },
                    {
                        y: 'Wed',
                        a: 7,
                        b: 5,
                        c: 3
                    },
                    {
                        y: 'Thu',
                        a: 1,
                        b: 2,
                        c: 5
                    },
                    {
                        y: 'Fri',
                        a: 9,
                        b: 5,
                        c: 9
                    },
                    {
                        y: 'Sat',
                        a: 10,
                        b: 5,
                        c: 6
                    },
                    {
                        y: 'Sun',
                        a: 5,
                        b: 3,
                        c: 7
                    }
                ],
                barColors: ['#1e88e5', '#26c6da', '#fc4b6c'],
                barSizeRatio: 0.5,
                barGap: 5,
                xkey: 'y',
                ykeys: ['a', 'b', 'c'],
                labels: ['Cancelled due to no Drivers', 'Cancelled by User', 'Cancelled by Driver'],
                hideHover: 'auto'
            });
        });

    </script>


    <script>
        $(function() {
            "use strict";
            //DONUT CHART
            var donut = new Morris.Donut({
                element: 'sales-chart',
                resize: true,
                colors: ["#745af2", "#fc4b6c", "#06d79c"],
                data: [{
                        label: "By Cash",
                        value: 50
                    },
                    {
                        label: "By Wallet",
                        value: 35
                    },
                    {
                        label: "Card/Online",
                        value: 15
                    }
                ],
                hideHover: 'auto'
            });
        });

    </script>

    <script>
        $(document).ready(function() {
            "use strict";

            if ($('#chart_2').length > 0) {
                var ctx2 = document.getElementById("chart_2").getContext("2d");
                var data2 = {
                    labels: ["January", "February", "March", "April", "May", "June", "July"],
                    datasets: [{
                            label: "Due to no Drivers",
                            backgroundColor: "#1e88e5",
                            borderColor: "#1e88e5",
                            data: [10, 59, 40, 75, 50, 45, 80]
                        },
                        {
                            label: "Cancelled by User",
                            backgroundColor: "#26c6da",
                            borderColor: "#26c6da",
                            data: [80, 5, 25, 15, 20, 35, 10]
                        },
                        {
                            label: "Cancelled by Driver",
                            backgroundColor: "#fc4b6c",
                            borderColor: "#fc4b6c",
                            data: [48, 88, 50, 58, 34, 67, 65]
                        }
                    ]
                };

                var hBar = new Chart(ctx2, {
                    type: "horizontalBar",
                    data: data2,

                    options: {
                        tooltips: {
                            mode: "label"
                        },
                        scales: {
                            yAxes: [{
                                stacked: true,
                                gridLines: {
                                    color: "rgba(135,135,135,0)",
                                },
                                ticks: {
                                    fontFamily: "Poppins",
                                    fontColor: "#878787"
                                }
                            }],
                            xAxes: [{
                                stacked: true,
                                gridLines: {
                                    color: "rgba(135,135,135,0)",
                                },
                                ticks: {
                                    fontFamily: "Poppins",
                                    fontColor: "#878787"
                                }
                            }],

                        },
                        elements: {
                            point: {
                                hitRadius: 40
                            }
                        },
                        animation: {
                            duration: 3000
                        },
                        responsive: true,
                        legend: {
                            display: false,
                        },
                        tooltip: {
                            backgroundColor: 'rgba(33,33,33,1)',
                            cornerRadius: 0,
                            footerFontFamily: "'Poppins'"
                        }

                    }
                });
            }

        }); // End of use strict

    </script>

    <script>
        $(document).ready(function() {
            "use strict";

            if ($('#chart_1').length > 0) {
                var ctx1 = document.getElementById("chart_1").getContext("2d");
                var data1 = {
                    labels: ["January", "February", "March", "April", "May", "June", "July"],
                    datasets: [{
                        label: "Overall Earnings",
                        backgroundColor: "#bdb5ed",
                        borderColor: "#9080f1",
                        pointBorderColor: "#ffffff",
                        pointHighlightStroke: "#26c6da",
                        data: [0, 59, 40, 75, 50, 45, 80]
                    }]
                };

                var areaChart = new Chart(ctx1, {
                    type: "line",
                    data: data1,

                    options: {
                        tooltips: {
                            mode: "label"
                        },
                        elements: {
                            point: {
                                hitRadius: 90
                            }
                        },

                        scales: {
                            yAxes: [{
                                stacked: true,
                                gridLines: {
                                    color: "rgba(135,135,135,0)",
                                },
                                ticks: {
                                    fontFamily: "Poppins",
                                    fontColor: "#878787"
                                }
                            }],
                            xAxes: [{
                                stacked: true,
                                gridLines: {
                                    color: "rgba(135,135,135,0)",
                                },
                                ticks: {
                                    fontFamily: "Poppins",
                                    fontColor: "#878787"
                                }
                            }]
                        },
                        animation: {
                            duration: 3000
                        },
                        responsive: true,
                        legend: {
                            display: false,
                        },
                        tooltip: {
                            backgroundColor: 'rgba(33,33,33,1)',
                            cornerRadius: 0,
                            footerFontFamily: "'Poppins'"
                        }

                    }
                });
            }

            if ($('#chart_12').length > 0) {
                var ctx1 = document.getElementById("chart_12").getContext("2d");
                var data1 = {
                    labels: ["January", "February", "March", "April", "May", "June", "July"],
                    datasets: [{
                            label: "fir",
                            backgroundColor: "#ffb22b",
                            borderColor: "#ffb22b",
                            pointBorderColor: "#ffb22b",
                            pointHighlightStroke: "#ffb22b",
                            data: [0, 59, 40, 75, 50, 45, 80]
                        },
                        {
                            label: "sec",
                            backgroundColor: "#26c6da",
                            borderColor: "#26c6da",
                            pointBorderColor: "#26c6da",
                            pointBackgroundColor: "#26c6da",
                            data: [48, 88, 50, 58, 34, 67, 65],
                        },
                        {
                            label: "sec2",
                            backgroundColor: "#fc4b6c",
                            borderColor: "#fc4b6c",
                            pointBorderColor: "#fc4b6c",
                            pointBackgroundColor: "#fc4b6c",
                            data: [8, 8, 5, 5, 3, 7, 6],
                        }
                    ]
                };

                var areaChart = new Chart(ctx1, {
                    type: "line",
                    data: data1,

                    options: {
                        tooltips: {
                            mode: "label"
                        },
                        elements: {
                            point: {
                                hitRadius: 90
                            }
                        },

                        scales: {
                            yAxes: [{
                                stacked: true,
                                gridLines: {
                                    color: "rgba(135,135,135,0)",
                                },
                                ticks: {
                                    fontFamily: "Poppins",
                                    fontColor: "#878787"
                                }
                            }],
                            xAxes: [{
                                stacked: true,
                                gridLines: {
                                    color: "rgba(135,135,135,0)",
                                },
                                ticks: {
                                    fontFamily: "Poppins",
                                    fontColor: "#878787"
                                }
                            }]
                        },
                        animation: {
                            duration: 3000
                        },
                        responsive: true,
                        legend: {
                            display: false,
                        },
                        tooltip: {
                            backgroundColor: 'rgba(33,33,33,1)',
                            cornerRadius: 0,
                            footerFontFamily: "'Poppins'"
                        }

                    }
                });
            }

            if ($('#chart_3').length > 0) {
                var ctx3 = document.getElementById("chart_3").getContext("2d");
                var data3 = {
                    labels: ["Eating", "Drinking", "Sleeping", "Designing", "Coding", "Cycling", "Running"],
                    datasets: [{
                            label: "My First dataset",
                            backgroundColor: "rgba(116, 96, 238, 0.6)",
                            borderColor: "rgba(116, 96, 238, 0.6)",
                            pointBackgroundColor: "rgba(116, 96, 238, 0.6)",
                            pointBorderColor: "#fff",
                            pointHoverBackgroundColor: "#fff",
                            pointHoverBorderColor: "rgba(116, 96, 238, 0.6)",
                            data: [65, 59, 90, 81, 56, 55, 40]
                        },
                        {
                            label: "My Second dataset",
                            backgroundColor: "rgba(57, 139, 247, 1)",
                            borderColor: "rgba(57, 139, 247, 1)",
                            pointBackgroundColor: "rgba(57, 139, 247, 1)",
                            pointBorderColor: "#fff",
                            pointHoverBackgroundColor: "#fff",
                            pointHoverBorderColor: "rgba(57, 139, 247, 1)",
                            data: [28, 48, 40, 19, 96, 27, 100]
                        }
                    ]
                };
                var radarChart = new Chart(ctx3, {
                    type: "radar",
                    data: data3,
                    options: {
                        scale: {
                            ticks: {
                                beginAtZero: true,
                                fontFamily: "Poppins",

                            },
                            gridLines: {
                                color: "rgba(135,135,135,0)",
                            },
                            pointLabels: {
                                fontFamily: "Poppins",
                                fontColor: "#878787"
                            },
                        },

                        animation: {
                            duration: 3000
                        },
                        responsive: true,
                        legend: {
                            labels: {
                                fontFamily: "Poppins",
                                fontColor: "#878787"
                            }
                        },
                        elements: {
                            arc: {
                                borderWidth: 0
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(33,33,33,1)',
                            cornerRadius: 0,
                            footerFontFamily: "'Poppins'"
                        }
                    }
                });
            }

            if ($('#chart_4').length > 0) {
                var ctx4 = document.getElementById("chart_4").getContext("2d");
                var data4 = {
                    datasets: [{
                        data: [
                            11,
                            16,
                            7,
                            3,
                            14
                        ],
                        backgroundColor: [
                            "#26c6da",
                            "#ffb22b",
                            "#1e88e5",
                            "#fc4b6c",
                            "#7460ee"
                        ],
                        hoverBackgroundColor: [
                            "#26c6da",
                            "#ffb22b",
                            "#1e88e5",
                            "#fc4b6c",
                            "#7460ee"
                        ],
                        label: 'My dataset' // for legend
                    }],
                    labels: [
                        "lab 1",
                        "lab 2",
                        "lab 3",
                        "lab 4",
                        "lab 5"
                    ]
                };
                var polarChart = new Chart(ctx4, {
                    type: "polarArea",
                    data: data4,
                    options: {
                        elements: {
                            arc: {
                                borderColor: "#fff",
                                borderWidth: 0
                            }
                        },
                        scale: {
                            ticks: {
                                beginAtZero: true,
                                fontFamily: "Poppins",

                            },
                            gridLines: {
                                color: "rgba(135,135,135,0)",
                            }
                        },
                        animation: {
                            duration: 3000
                        },
                        responsive: true,
                        legend: {
                            labels: {
                                fontFamily: "Poppins",
                                fontColor: "#878787"
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(33,33,33,1)',
                            cornerRadius: 0,
                            footerFontFamily: "'Poppins'"
                        }
                    }
                });
            }

            if ($('#chart_5').length > 0) {
                var ctx5 = document.getElementById("chart_5").getContext("2d");
                var data5 = {
                    datasets: [{
                            label: 'First Dataset',
                            data: [{
                                    x: 80,
                                    y: 60,
                                    r: 10
                                },
                                {
                                    x: 40,
                                    y: 40,
                                    r: 10
                                },
                                {
                                    x: 30,
                                    y: 40,
                                    r: 20
                                },
                                {
                                    x: 20,
                                    y: 10,
                                    r: 10
                                },
                                {
                                    x: 50,
                                    y: 30,
                                    r: 10
                                }
                            ],
                            backgroundColor: "#1e88e5",
                            hoverBackgroundColor: "#1e88e5",
                        },
                        {
                            label: 'Second Dataset',
                            data: [{
                                    x: 40,
                                    y: 30,
                                    r: 10
                                },
                                {
                                    x: 25,
                                    y: 20,
                                    r: 10
                                },
                                {
                                    x: 35,
                                    y: 30,
                                    r: 10
                                }
                            ],
                            backgroundColor: "#ffb22b",
                            hoverBackgroundColor: "#ffb22b",
                        }
                    ]
                };

                var bubbleChart = new Chart(ctx5, {
                    type: "bubble",
                    data: data5,
                    options: {
                        elements: {
                            points: {
                                borderWidth: 1,
                                borderColor: 'rgb(33, 33, 33)'
                            }
                        },
                        scales: {
                            xAxes: [{
                                ticks: {
                                    min: -10,
                                    max: 100,
                                    fontFamily: "Poppins",
                                    fontColor: "#878787"
                                },
                                gridLines: {
                                    color: "rgba(135,135,135,0)",
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                    fontFamily: "Poppins",
                                    fontColor: "#878787"
                                },
                                gridLines: {
                                    color: "rgba(135,135,135,0)",
                                }
                            }]
                        },
                        animation: {
                            duration: 3000
                        },
                        responsive: true,
                        legend: {
                            labels: {
                                fontFamily: "Poppins",
                                fontColor: "#878787"
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(33,33,33,1)',
                            cornerRadius: 0,
                            footerFontFamily: "'Poppins'"
                        }
                    }
                });
            }

            if ($('#chart_6').length > 0) {
                var ctx6 = document.getElementById("chart_6").getContext("2d");
                var data6 = {
                    labels: [
                        "lab 1",
                        "lab 2",
                        "lab 3"
                    ],
                    datasets: [{
                        data: [300, 50, 100],
                        backgroundColor: [
                            "#26c6da",
                            "#ffb22b",
                            "#1e88e5"
                        ],
                        hoverBackgroundColor: [
                            "#26c6da",
                            "#ffb22b",
                            "#1e88e5"
                        ]
                    }]
                };

                var pieChart = new Chart(ctx6, {
                    type: 'pie',
                    data: data6,
                    options: {
                        animation: {
                            duration: 3000
                        },
                        responsive: true,
                        legend: {
                            labels: {
                                fontFamily: "Poppins",
                                fontColor: "#878787"
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(33,33,33,1)',
                            cornerRadius: 0,
                            footerFontFamily: "'Poppins'"
                        },
                        elements: {
                            arc: {
                                borderWidth: 0
                            }
                        }
                    }
                });
            }

            if ($('#chart_7').length > 0) {
                var ctx7 = document.getElementById("chart_7").getContext("2d");
                var data7 = {
                    labels: [
                        "lab 1",
                        "lab 2",
                        "lab 3",
                        "lab 4"
                    ],
                    datasets: [{
                        data: [300, 50, 100, 74],
                        backgroundColor: [
                            "#fc4b6c",
                            "#7460ee",
                            "#26c6da",
                            "#ffb22b"
                        ],
                        hoverBackgroundColor: [
                            "#fc4b6c",
                            "#7460ee",
                            "#26c6da",
                            "#ffb22b"
                        ]
                    }]
                };

                var doughnutChart = new Chart(ctx7, {
                    type: 'doughnut',
                    data: data7,
                    options: {
                        animation: {
                            duration: 4000
                        },
                        responsive: true,
                        legend: {
                            labels: {
                                fontFamily: "Poppins",
                                fontColor: "#878787"
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(33,33,33,1)',
                            cornerRadius: 0,
                            footerFontFamily: "'Poppins'"
                        },
                        elements: {
                            arc: {
                                borderWidth: 0
                            }
                        }
                    }
                });
            }

            if ($('#trips').length > 0) {
                var ctx7 = document.getElementById("trips").getContext("2d");
                var data7 = {
                    labels: [
                        "Completed",
                        "Cancelled",
                        "Scheduled"
                    ],
                    datasets: [{
                        data: [65, 40, 20],
                        backgroundColor: [
                            "#7460ee",
                            "#fc4b6c",
                            "#26c6da"
                        ],
                        hoverBackgroundColor: [
                            "#7460ee",
                            "#fc4b6c",
                            "#26c6da"
                        ]
                    }]
                };
                var doughnutChart = new Chart(ctx7, {
                    type: 'doughnut',
                    data: data7,
                    options: {
                        animation: {
                            duration: 4000
                        },
                        responsive: true,
                        legend: {
                            labels: {
                                fontFamily: "Poppins",
                                fontColor: "#878787"
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(33,33,33,1)',
                            cornerRadius: 0,
                            footerFontFamily: "'Poppins'"
                        },
                        elements: {
                            arc: {
                                borderWidth: 0
                            }
                        }
                    }
                });
            }

            if ($('#chart_8').length > 0) {
                var ctx2 = document.getElementById("chart_8").getContext("2d");
                var data2 = {
                    labels: ["January", "February", "March", "April", "May", "June", "July"],
                    datasets: [{
                            label: "My First dataset",
                            backgroundColor: "#26c6da",
                            borderColor: "#26c6da",
                            data: [15, 20, 70, 51, 36, 85, 50]
                        },
                        {
                            label: "My Second dataset",
                            backgroundColor: "#fc4b6c",
                            borderColor: "#fc4b6c",
                            data: [28, 48, 40, 19, 86, 27, 90]
                        },
                        {
                            label: "My Third dataset",
                            backgroundColor: "#7460ee",
                            borderColor: "#7460ee",
                            data: [8, 28, 50, 29, 76, 77, 40]
                        }
                    ]
                };

                var hBar = new Chart(ctx2, {
                    type: "bar",
                    data: data2,

                    options: {
                        tooltips: {
                            mode: "label"
                        },
                        scales: {
                            yAxes: [{
                                stacked: true,
                                gridLines: {
                                    color: "rgba(135,135,135,0)",
                                },
                                ticks: {
                                    fontFamily: "Poppins",
                                    fontColor: "#878787"
                                }
                            }],
                            xAxes: [{
                                stacked: true,
                                gridLines: {
                                    color: "rgba(135,135,135,0)",
                                },
                                ticks: {
                                    fontFamily: "Poppins",
                                    fontColor: "#878787"
                                }
                            }],

                        },
                        elements: {
                            point: {
                                hitRadius: 40
                            }
                        },
                        animation: {
                            duration: 3000
                        },
                        responsive: true,
                        maintainAspectRatio: false,
                        legend: {
                            display: false,
                        },

                        tooltip: {
                            backgroundColor: 'rgba(33,33,33,1)',
                            cornerRadius: 0,
                            footerFontFamily: "'Poppins'"
                        }

                    }
                });
            }

        }); // End of use strict

    </script>

@endsection
