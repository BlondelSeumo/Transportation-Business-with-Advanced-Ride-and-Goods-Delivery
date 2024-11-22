@extends('admin.layouts.app')

 <!-- Morris charts -->
    <link rel="stylesheet" href{!! asset('assets/vendor_components/morris.js/morris.css') !!}">
    <style>
         .timeline .timeline-item>.timeline-point {
        color: yellow !important;
        padding: 3px;
    }
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


@section('content')


    <section class="content">

        <div class="row">

             <div class="col-12">
                <div class="box">
                    <div class="box-body box-profile">
                        <div class="row">
                            <div class="col-md-2 m-auto text-right">
                                <img class="avatar avatar-xxl avatar-bordered"
                                    src="{{ asset('/assets/img/user-dummy.svg') }}" alt="">
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="profile-user-info">
                                    <h3>
                                        <span class="text-gray">Pavi</span>
                                    </h3>
                                  
                                        <span>
                                            <i class="fa fa-star" style="color: yellow"></i>
                                            <i class="fa fa-star" style="color: yellow"></i>
                                            <i class="fa fa-star" style="color: yellow"></i>
                                            <i class="fa fa-star" style="color: yellow"></i>
                                            <i class="fa fa-star" style="color: yellow"></i>
                                        </span>
                                       <p>
                                    
                                        <span class="text-gray">
                                            pavi@gmail.com <br>
                                            9791700456
                                        </span>
                                        </p>
                                        <p>
                                         <span class="text-gray">
                                            status : Offline <br>
                                            Last Logout :6/3/2021 12:30 PM <br>
                                        </span>
                                    </p>
                                    
                                </div>
                            </div>
                            <div class="col-md-2 m-auto">
                                <img class="w-fill" src="{{ asset('assets/images/2.jpg') }}"
                                    alt="">
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="profile-user-info">
                                    <h3>
                                        <span class="text-gray">Bentley</span>
                                    </h3>
                                    <p>
                                        <span class="text-gray">
                                            Continental GT (Sedan)
                                        </span>
                                    </p>
                                    <p>
                                        <span class="text-gray">
                                            44777336
                                        </span>
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>

       
            {{-- card --}}
             <div class="row g-3">
            <div class="col-sm-6 col-md-2">
                <div class="card overflow-hidden" style="min-width: 12rem">
                    <div class="bg-holder bg-card"
                        style="background-image:url({{ asset('assets/images/corner-3.png') }});">
                    </div>
                    <!--/.bg-holder-->
                    <div class="card-body position-relative">
                        <h6>Today's Trip
                        </h6>
                        <div class="display-4 fs-4 mb-2 font-weight-normal font-sans-serif text-warning"
                            data-countup="{&quot;endValue&quot;:58.386,&quot;decimalPlaces&quot;:2,&quot;suffix&quot;:&quot;k&quot;}">
                            20</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-2">
                <div class="card overflow-hidden" style="min-width: 12rem">
                    <div class="bg-holder bg-card"
                        style="background-image:url({{ asset('assets/images/corner-2.png') }});">
                    </div>
                    <!--/.bg-holder-->
                    <div class="card-body position-relative">
                        <h6>Today's Earning
                        </h6>
                        <div class="display-4 fs-4 mb-2 font-weight-normal font-sans-serif text-success"
                            data-countup="{&quot;endValue&quot;:58.386,&quot;decimalPlaces&quot;:2,&quot;suffix&quot;:&quot;k&quot;}">
                            10</div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-2">
                <div class="card overflow-hidden" style="min-width: 12rem">
                    <div class="bg-holder bg-card"
                        style="background-image:url({{ asset('assets/images/corner-2.png') }});">
                    </div>
                    <!--/.bg-holder-->
                    <div class="card-body position-relative">
                        <h6>Total Trips
                        </h6>
                        <div class="display-4 fs-4 mb-2 font-weight-normal font-sans-serif text-warning"
                            data-countup="{&quot;endValue&quot;:58.386,&quot;decimalPlaces&quot;:2,&quot;suffix&quot;:&quot;k&quot;}">
                            10</div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-2">
                <div class="card overflow-hidden" style="min-width: 12rem">
                    <div class="bg-holder bg-card"
                        style="background-image:url({{ asset('assets/images/corner-1.png') }});">
                    </div>
                    <!--/.bg-holder-->
                    <div class="card-body position-relative">
                        <h6>Total Earnings
                        </h6>
                        <div class="display-4 fs-4 mb-2 font-weight-normal font-sans-serif text-danger"
                            data-countup="{&quot;endValue&quot;:58.386,&quot;decimalPlaces&quot;:2,&quot;suffix&quot;:&quot;k&quot;}">
                            45</div>
                    </div>
                </div>
            </div> <div class="col-sm-6 col-md-2">
                <div class="card overflow-hidden" style="min-width: 12rem">
                    <div class="bg-holder bg-card"
                        style="background-image:url({{ asset('assets/images/corner-1.png') }});">
                    </div>
                    <!--/.bg-holder-->
                    <div class="card-body position-relative">
                        <h6>Wallet Amount
                        </h6>
                        <div class="display-4 fs-4 mb-2 font-weight-normal font-sans-serif text-danger"
                            data-countup="{&quot;endValue&quot;:58.386,&quot;decimalPlaces&quot;:2,&quot;suffix&quot;:&quot;k&quot;}">
                            45</div>
                    </div>
                </div>
            </div>
        </div>



         <div class="row">
            <div class="col-12">

                <div class="box">

                    <div class="box-header with-border">
                                <h3 class="font-weight-600">Driver Location :</h3>
                                <ul class="box-controls pull-right">
                                    <li><a class="box-btn-close" href="#"></a></li>
                                    <li><a class="box-btn-slide" href="#"></a></li>
                                    <li><a class="box-btn-fullscreen" href="#"></a></li>
                                </ul>
                            </div>
                   
                         <div class="box-body">
                           
                        <div id="map"></div>
                        <div id="legend">
                            <h3>@lang('view_pages.legend')</h3>
                        </div>
                    </div>
                </div>

            </div>
        </div>


            <div class="row">
            <div class="col-12 col-lg-12">
                <!-- DONUT CHART -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="font-weight-600">Total earnings</h3>
                        <ul class="box-controls pull-right">
                            <li><a class="box-btn-close" href="#"></a></li>
                            <li><a class="box-btn-slide" href="#"></a></li>
                            <li><a class="box-btn-fullscreen" href="#"></a></li>
                        </ul>
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
                                        <span class="info-box-icon rounded"
                                            style="background-color:#7460ee;padding: 20px;"><i
                                                class="ion ion-stats-bars text-white"></i></span>
                                        <div class="info-box-content" style="color: #455a80">
                                            <h4 class="font-weight-600">
                                                $15,956
                                                <br>
                                                Total Earnings
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
                                        <span class="info-box-icon rounded"
                                            style="background-color: #fc4b6c;padding: 20px;"><i
                                                class="ion ion-stats-bars text-white"></i></span>
                                        <div class="info-box-content" style="color: #fc4b6c">
                                            <h4 class="font-weight-600">
                                                $5,000
                                                <br>
                                               Admin Commision
                                            </h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="info-box">
                                        <span class="info-box-icon rounded"
                                            style="background-color:#26c6da;padding: 20px;"><i
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
            </div>

            <div class="row">
             <div class="col-12 col-lg-12">
                <!-- DONUT CHART -->
                 <div class="box">
                    <div class="box-header with-border">
                        <h3 class="font-weight-600">Trip statistics</h3>
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
                                        <!-- small box -->
                                    <div class="small-box text-white" style="background-color:#7460ee">
                                        <div class="inner">
                                            <h3>652</h3>

                                            <p>Completed Trips</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-pie-chart"></i>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                       <!-- small box -->
                                    <div class="small-box text-white" style="background-color:#fc4b6c">
                                        <div class="inner">
                                            <h3>62</h3>

                                            <p>Cancelled Trips</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-pie-chart"></i>
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
            </div>



        <div class="row">
            <div class="col-md-12">
                <div class="row">


                    <div class="col-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="font-weight-600">Ongoing trip Info</h3>
                                <ul class="box-controls pull-right">
                                    <li><a class="box-btn-close" href="#"></a></li>
                                    <li><a class="box-btn-slide" href="#"></a></li>
                                    <li><a class="box-btn-fullscreen" href="#"></a></li>
                                </ul>
                            </div>

                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="tickets" class="table mt-0 table-hover no-wrap table-striped table-bordered"
                                        data-page-size="10">
                                        <thead>
                                            <tr class="bg-dark">
                                                <th>Fleet No</th>
                                                <th>Pickup details</th>
                                                <th>Drop details</th>
                                                <th>Ttip Status</th>
                                                <th>Current Location</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td>
                                                    123564ABD987
                                                </td>
                                                <td>
                                                    Hourse 57, road-8, Block-D, <br> niketon, Gulshan.
                                                </td>
                                                <td>
                                                    Daffodil international <br> Unerversity, 102/1, <br> Sukrabad Mirpur Rd,
                                                    <br> Dhaka 1207, Bangladesh.
                                                </td>
                                                <td>
                                                    Trip&nbsp;Started
                                                </td>
                                                <td>
                                                    <div class="map-box">
                                                        <iframe
                                                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2805244.1745767146!2d-86.32675167439648!3d29.383165774894163!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88c1766591562abf%3A0xf72e13d35bc74ed0!2sFlorida%2C+USA!5e0!3m2!1sen!2sin!4v1501665415329"
                                                            width="100%" height="165" frameborder="0" style="border:0"
                                                            allowfullscreen></iframe>
                                                    </div>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="row">


                    <div class="col-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="font-weight-600">Recharge History</h3>
                                <ul class="box-controls pull-right">
                                    <li><a class="box-btn-close" href="#"></a></li>
                                    <li><a class="box-btn-slide" href="#"></a></li>
                                    <li><a class="box-btn-fullscreen" href="#"></a></li>
                                </ul>
                            </div>

                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="tickets" class="table mt-0 table-hover no-wrap table-striped table-bordered"
                                        data-page-size="10">
                                        <thead>
                                            <tr class="bg-dark">
                                                <th>Fleet No</th>
                                                <th>Pickup details</th>
                                                <th>Drop details</th>
                                                <th>Ttip Status</th>
                                                <th>Current Location</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td colspan="6" class="text-center">
                                                    No hostry found
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="row">


                    <div class="col-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="font-weight-600">Shift History</h3>
                                <ul class="box-controls pull-right">
                                    <li><a class="box-btn-close" href="#"></a></li>
                                    <li><a class="box-btn-slide" href="#"></a></li>
                                    <li><a class="box-btn-fullscreen" href="#"></a></li>
                                </ul>
                            </div>

                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="tickets" class="table mt-0 table-hover no-wrap table-striped table-bordered"
                                        data-page-size="10">
                                        <thead>
                                            <tr class="bg-dark">
                                                <th>#</th>
                                                <th>Fleet No</th>
                                                <th>Shift Start</th>
                                                <th>Shift End</th>
                                                <th>Shift Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td>1</td>
                                                <td>123564ABD987</td>
                                                <td>
                                                    01/06/2021-05:14:00 pM
                                                </td>
                                                <td>
                                                    01/06/2021-07:51:24 PM
                                                </td>
                                                <td>
                                                    2Hr 37Min 24Sec
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>123564ABD987</td>
                                                <td>
                                                    01/06/2021-05:14:00 pM
                                                </td>
                                                <td>
                                                    01/06/2021-07:51:24 PM
                                                </td>
                                                <td>
                                                    2Hr 37Min 24Sec
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>123564ABD987</td>
                                                <td>
                                                    01/06/2021-05:14:00 pM
                                                </td>
                                                <td>
                                                    01/06/2021-07:51:24 PM
                                                </td>
                                                <td>
                                                    2Hr 37Min 24Sec
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>123564ABD987</td>
                                                <td>
                                                    01/06/2021-05:14:00 pM
                                                </td>
                                                <td>
                                                    01/06/2021-07:51:24 PM
                                                </td>
                                                <td>
                                                    2Hr 37Min 24Sec
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>123564ABD987</td>
                                                <td>
                                                    01/06/2021-05:14:00 pM
                                                </td>
                                                <td>
                                                    01/06/2021-07:51:24 PM
                                                </td>
                                                <td>
                                                    2Hr 37Min 24Sec
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>123564ABD987</td>
                                                <td>
                                                    01/06/2021-05:14:00 pM
                                                </td>
                                                <td>
                                                    01/06/2021-07:51:24 PM
                                                </td>
                                                <td>
                                                    2Hr 37Min 24Sec
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>7</td>
                                                <td>123564ABD987</td>
                                                <td>
                                                    01/06/2021-05:14:00 pM
                                                </td>
                                                <td>
                                                    01/06/2021-07:51:24 PM
                                                </td>
                                                <td>
                                                    2Hr 37Min 24Sec
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>8</td>
                                                <td>123564ABD987</td>
                                                <td>
                                                    01/06/2021-05:14:00 pM
                                                </td>
                                                <td>
                                                    01/06/2021-07:51:24 PM
                                                </td>
                                                <td>
                                                    2Hr 37Min 24Sec
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>9</td>
                                                <td>123564ABD987</td>
                                                <td>
                                                    01/06/2021-05:14:00 pM
                                                </td>
                                                <td>
                                                    01/06/2021-07:51:24 PM
                                                </td>
                                                <td>
                                                    2Hr 37Min 24Sec
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>10</td>
                                                <td>123564ABD987</td>
                                                <td>
                                                    01/06/2021-05:14:00 pM
                                                </td>
                                                <td>
                                                    01/06/2021-07:51:24 PM
                                                </td>
                                                <td>
                                                    2Hr 37Min 24Sec
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-5">
                                        <div class="dataTables_info" id="tickets_info" role="status" aria-live="polite">
                                            Showing
                                            1 to
                                            10 of 20 entries</div>
                                    </div>
                                    <div class="col-sm-12 col-md-7 text-right">
                                        <div class="dataTables_paginate paging_simple_numbers" id="tickets_paginate">
                                            <ul class="pagination">
                                                <li class="paginate_button page-item previous disabled"
                                                    id="tickets_previous"><a href="#" aria-controls="tickets"
                                                        data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
                                                <li class="paginate_button page-item active"><a href="#"
                                                        aria-controls="tickets" data-dt-idx="1" tabindex="0"
                                                        class="page-link">1</a></li>
                                                <li class="paginate_button page-item "><a href="#" aria-controls="tickets"
                                                        data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                                                <li class="paginate_button page-item next" id="tickets_next"><a href="#"
                                                        aria-controls="tickets" data-dt-idx="3" tabindex="0"
                                                        class="page-link">Next</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


           
        </div>
        {{-- <div class="row">


            <div class="col-lg-8 col-12">

                <div class="nav-tabs-custom box-profile">
                    <ul class="nav nav-tabs">

                        <li><a class="active" href="#timeline" data-toggle="tab">Ratings</a></li>
                        <li><a href="#activity" data-toggle="tab">Activity</a></li>
                        <li><a href="#settings" data-toggle="tab">Update Profile</a></li>
                    </ul>

                    <div class="tab-content">

                        <div class="active tab-pane" id="timeline">

                            <div class="box p-15">
                                <div class="timeline timeline-single-column">

                                    <div class="timeline-item">
                                        <div class="timeline-point">
                                            <i class="fa fa-star text-yellow"></i>
                                        </div>
                                        <div class="timeline-event">
                                            <div class="timeline-heading">
                                                <h4 class="timeline-title">Rider Name</h4>
                                            </div>
                                            <div class="timeline-body">
                                                <p>Advenientibus aliorum eam ad per te sed. Facere debetur aut veneris
                                                    accedens.</p>
                                                <br>
                                                <span>
                                                    <i class="fa fa-star" style="color: yellow"></i>
                                                    <i class="fa fa-star" style="color: yellow"></i>
                                                    <i class="fa fa-star" style="color: yellow"></i>
                                                    <i class="fa fa-star" style="color: yellow"></i>
                                                    <i class="fa fa-star" style="color: yellow"></i>
                                                </span>
                                            </div>
                                            <div class="timeline-footer">
                                                <p class="text-right">Feb-22-2021</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="timeline-item">
                                        <div class="timeline-point">
                                            <i class="fa fa-star text-yellow"></i>
                                        </div>
                                        <div class="timeline-event">
                                            <div class="timeline-heading">
                                                <h4 class="timeline-title">Rider Name</h4>
                                            </div>
                                            <div class="timeline-body">
                                                <p>Advenientibus aliorum eam ad per te sed. Facere debetur aut veneris
                                                    accedens.</p>
                                                <br>
                                                <span>
                                                    <i class="fa fa-star" style="color: yellow"></i>
                                                    <i class="fa fa-star" style="color: yellow"></i>
                                                    <i class="fa fa-star" style="color: yellow"></i>
                                                    <i class="fa fa-star" style="color: yellow"></i>
                                                    <i class="fa fa-star" style="color: yellow"></i>
                                                </span>
                                            </div>
                                            <div class="timeline-footer">
                                                <p class="text-right">Feb-22-2021</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="timeline-item">
                                        <div class="timeline-point">
                                            <i class="fa fa-star text-yellow"></i>
                                        </div>
                                        <div class="timeline-event">
                                            <div class="timeline-heading">
                                                <h4 class="timeline-title">Rider Name</h4>
                                            </div>
                                            <div class="timeline-body">
                                                <p>Advenientibus aliorum eam ad per te sed. Facere debetur aut veneris
                                                    accedens.</p>
                                                <br>
                                                <span>
                                                    <i class="fa fa-star" style="color: yellow"></i>
                                                    <i class="fa fa-star" style="color: yellow"></i>
                                                    <i class="fa fa-star" style="color: yellow"></i>
                                                    <i class="fa fa-star" style="color: yellow"></i>
                                                    <i class="fa fa-star" style="color: yellow"></i>
                                                </span>
                                            </div>
                                            <div class="timeline-footer">
                                                <p class="text-right">Feb-22-2021</p>
                                            </div>
                                        </div>
                                    </div>

                                    <span class="timeline-label">
                                        <span class="badge badge-info badge-lg">label</span>
                                    </span>

                                    <div class="timeline-item">
                                        <div class="timeline-point">
                                            <i class="fa fa-star text-yellow"></i>
                                        </div>
                                        <div class="timeline-event">
                                            <div class="timeline-heading">
                                                <h4 class="timeline-title">Rider Name</h4>
                                            </div>
                                            <div class="timeline-body">
                                                <p>Advenientibus aliorum eam ad per te sed. Facere debetur aut veneris
                                                    accedens.</p>
                                                <br>
                                                <span>
                                                    <i class="fa fa-star" style="color: yellow"></i>
                                                    <i class="fa fa-star" style="color: yellow"></i>
                                                    <i class="fa fa-star" style="color: yellow"></i>
                                                    <i class="fa fa-star" style="color: yellow"></i>
                                                    <i class="fa fa-star" style="color: yellow"></i>
                                                </span>
                                            </div>
                                            <div class="timeline-footer">
                                                <p class="text-right">Feb-22-2021</p>
                                            </div>
                                        </div>
                                    </div>

                                    <span class="timeline-label">
                                        <button class="btn btn-danger"><i class="fa fa-clock-o"></i></button>
                                    </span>
                                </div>


                            </div>
                        </div>


                        <div class="tab-pane" id="activity">

                            <div class="box p-15">

                                <div class="post">
                                    <div class="user-block">
                                        <img class="img-bordered-sm rounded-circle"
                                            src="{{ asset('assets/images/1.jpg') }}" alt="user image">
                                        <span class="username">
                                            <a href="#">Brayden</a>
                                        </span>
                                        <span class="description">5 minutes ago</span>
                                    </div>

                                    <div class="activitytimeline">
                                        <p>
                                            <b>
                                                Pickup Location
                                                :
                                            </b>
                                            <br>
                                            <span class="text-gray">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio.
                                                Praesent libero. Sed cursus ante dapibus diam.
                                            </span>
                                        </p>
                                        <p>
                                            <b>
                                                Drop Location
                                                :
                                            </b>
                                            <br>
                                            <span class="text-gray">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio.
                                                Praesent libero. Sed cursus ante dapibus diam.
                                            </span>
                                        </p>
                                    </div>
                                </div>

                                <div class="post">
                                    <div class="user-block">
                                        <img class="img-bordered-sm rounded-circle"
                                            src="{{ asset('assets/images/1.jpg') }}" alt="user image">
                                        <span class="username">
                                            <a href="#">Brayden</a>
                                        </span>
                                        <span class="description">5 minutes ago</span>
                                    </div>

                                    <div class="activitytimeline">
                                        <p>
                                            <b>
                                                Pickup Location
                                                :
                                            </b>
                                            <br>
                                            <span class="text-gray">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio.
                                                Praesent libero. Sed cursus ante dapibus diam.
                                            </span>
                                        </p>
                                        <p>
                                            <b>
                                                Drop Location
                                                :
                                            </b>
                                            <br>
                                            <span class="text-gray">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio.
                                                Praesent libero. Sed cursus ante dapibus diam.
                                            </span>
                                        </p>
                                    </div>
                                </div>

                                <div class="post">
                                    <div class="user-block">
                                        <img class="img-bordered-sm rounded-circle"
                                            src="{{ asset('assets/images/1.jpg') }}" alt="user image">
                                        <span class="username">
                                            <a href="#">Brayden</a>
                                        </span>
                                        <span class="description">5 minutes ago</span>
                                    </div>

                                    <div class="activitytimeline">
                                        <p>
                                            <b>
                                                Pickup Location
                                                :
                                            </b>
                                            <br>
                                            <span class="text-gray">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio.
                                                Praesent libero. Sed cursus ante dapibus diam.
                                            </span>
                                        </p>
                                        <p>
                                            <b>
                                                Drop Location
                                                :
                                            </b>
                                            <br>
                                            <span class="text-gray">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio.
                                                Praesent libero. Sed cursus ante dapibus diam.
                                            </span>
                                        </p>
                                    </div>
                                </div>


                            </div>

                        </div>


                        <div class="tab-pane" id="settings">

                            <div class="box p-15">
                                <form class="form-horizontal form-element col-12">
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 control-label">Name</label>

                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputName" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputEmail" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPhone" class="col-sm-2 control-label">Phone</label>

                                        <div class="col-sm-10">
                                            <input type="tel" class="form-control" id="inputPhone" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="ml-auto col-sm-10">
                                            <div class="checkbox">
                                                <input type="checkbox" id="basic_checkbox_1" checked="">
                                                <label for="basic_checkbox_1"> I agree to the</label>
                                                &nbsp;&nbsp;&nbsp;&nbsp;<a href="#">Terms and Conditions</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="ml-auto col-sm-10">
                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>

                </div>

            </div>


        </div> --}}


    </section>
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
                    y: '',
                    a: 652,
                    b: 62,
                    
                }],
                barColors: ['#7460ee', '#fc4b6c'],
                barSizeRatio: 0.5,
                barGap: 5,
                xkey: 'y',
                ykeys: ['a', 'b'],
                labels: ['Completed Trips', 'Cancelled Trips'],
                hideHover: 'auto'
            });
        });

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
            if ($('#chart_6').length > 0) {
                var ctx6 = document.getElementById("chart_6").getContext("2d");
                var data6 = {
                    labels: [
                        "By Cash",
                        "By Wallet",
                        "By Card/Online"
                    ],
                    datasets: [{
                        data: [15956, 5000, 10956],
                        backgroundColor: [
                            "#7460ee",
                            "#fc4b6c",
                            "#398bf7"
                        ],
                        hoverBackgroundColor: [
                            "#7460ee",
                            "#fc4b6c",
                            "#398bf7"
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
        });

    </script>
     <script type="text/javascript"
        src="https://maps.google.com/maps/api/js?key={{get_settings('google_map_key')}}&libraries=visualization"></script>
    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-database.js"></script>
    <!-- TODO: Add SDKs for Firebase products that you want to use https://firebase.google.com/docs/web/setup#available-libraries -->
    <script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-analytics.js"></script>

    <script type="text/javascript">
        var heatmapData = [];
        var pickLat = [];
        var pickLng = [];
        var default_lat = '{{ $default_lat ??  get_settings('default_latitude') }}';
        var default_lng = '{{ $default_lng ?? get_settings('default_longitude') }}';
        var company_key = '{{ auth()->user()->company_key }}';

        var driverLat, driverLng, bearing, type;

        // Your web app's Firebase configuration
        var firebaseConfig = {
                apiKey: "{{get_settings('firebase-api-key')}}",
    authDomain: "{{get_settings('firebase-auth-domain')}}",
    databaseURL: "{{get_settings('firebase-db-url')}}",
    projectId: "{{get_settings('firebase-project-id')}}",
    storageBucket: "{{get_settings('firebase-storage-bucket')}}",
    messagingSenderId: "{{get_settings('firebase-messaging-sender-id')}}",
    appId: "{{get_settings('firebase-app-id')}}",
    measurementId: "{{get_settings('firebase-measurement-id')}}"
        };

        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);
        firebase.analytics();

        var tripRef = firebase.database().ref('drivers');

        tripRef.on('value', async function(snapshot) {
            var data = snapshot.val();

            await loadDriverIcons(data);
        });

        var map = new google.maps.Map(document.getElementById('map'), {
            center: new google.maps.LatLng(default_lat, default_lng),
            zoom: 5,
            mapTypeId: 'roadmap'
        });

        var iconBase = '{{ asset('map/icon/') }}';
        var icons = {
            available: {
                name: 'Available',
                icon: iconBase + '/driver_available.png'
            },
            ontrip: {
                name: 'OnTrip',
                icon: iconBase + '/driver_on_trip.png'
            }
        };

        var legend = document.getElementById('legend');

        for (var key in icons) {
            var type = icons[key];
            var name = type.name;
            var icon = type.icon;
            var div = document.createElement('div');
            div.innerHTML = '<img src="' + icon + '"> ' + name;
            legend.appendChild(div);
        }

        map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(legend);

        function loadDriverIcons(data) {
            // var result = Object.entries(data);
            Object.entries(data).forEach(([key, val]) => {
                // var infowindow = new google.maps.InfoWindow({
                //     content: contentString
                // });

                var iconImg = '';
                if (val.company_key == company_key) {
                    if (val.is_available == true && val.is_active == true) {
                        iconImg = icons['available'].icon;
                    } else if (val.is_active == true && val.is_available == false) {
                        iconImg = icons['ontrip'].icon;
                    } else {
                        iconImg = icons['available'].icon;
                        //@TODO
                    }

                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(val.l[0], val.l[1]),
                        icon: iconImg,
                        map: map
                    });

                }

                // marker.addListener('click', function() {
                //     infowindow.open(map, marker);
                // });
            });
        }

    </script>
@endsection




