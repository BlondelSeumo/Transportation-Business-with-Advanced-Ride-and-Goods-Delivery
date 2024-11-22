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
         .modal-header {
            border-bottom: 2px solid #1e88e5;
        }

        .modal-title {
            color: #9c9cdc;
            font-weight: 700;
        }

        .request-status h4 {
            background: blue;
            padding: 5px 5px 5px 5px;
            border-radius: 5px;
            width: 35%;
            color: white;
            font-weight: 600;
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

    </style>
    <!-- Start Page content -->
    <section class="content">
        <div class="row">
            @foreach ($card as $item)
                <div class="col-xl-4 col-md-6 col-12">
                    <div class="box box-body">
                        <h5 class="text-capitalize">{{ $item['display_name'] }}</h5>
                        <div class="flexbox wid-icons mt-2">
                            <span class="{{ $item['icon'] }} font-size-40"></span>
                            <span class=" font-size-30">{{ $item['count'] }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

         <input type="hidden" id="items" name="items" value="{{$items}}">

         <div class="content">

        <div class="row">
            <div class="col-12">
        <div class="box"> 


                    <div class="box-header with-border">
                        <div class="row text-right">
                            <div class="col-8 col-md-3">
                                <div class="form-group">
                                    <div class="controls">
                                        {{-- <input type="hidden" id="item" value="{{$item}}"> --}}
                                        <input type="text" id="search_keyword" name="search" class="form-control"
                                            placeholder="@lang('view_pages.enter_keyword')">
                                    </div>
                                </div>
                            </div>

                            <div class="col-2 col-md-1 text-left">
                                <button id="search" class="btn btn-success btn-outline btn-sm py-2" type="submit">
                                    @lang('view_pages.search')
                                </button>
                            </div>

                            <div class="col-5 col-md-1 text-left">
                                <button class="btn btn-outline btn-sm btn-danger py-2" type="button" data-toggle="modal"
                                    data-target="#request-modal">
                                     @lang('view_pages.filter')
                                </button>
                            </div>

                           
                        </div>

 <!-- Modal -->
                        <div class="modal fade" id="request-modal">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">@lang('view_pages.filter_request')</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div class="modal-body text-left">
                                        <div class="request-status">
                                            <h4>@lang('view_pages.trip_status')</h4>
                                            <div class="demo-radio-button">

                                                <input name="trip_status" type="radio" id="is_completed" data-val="1"
                                                    class="with-gap radio-col-green">
                                                <label for="is_completed">@lang('view_pages.completed')</label>
                                                <input name="trip_status" type="radio" id="is_cancelled" data-val="1"
                                                    class="with-gap radio-col-red">
                                                <label for="is_cancelled">@lang('view_pages.cancelled')</label>
                                                <input name="trip_status" type="radio" id="is_trip_start" data-val="0"
                                                    class="with-gap radio-col-yellow">
                                                <label for="is_trip_start">@lang('view_pages.not_yet_started')</label>
                                            </div>
                                            <h4>@lang('view_pages.paid_status')</h4>
                                            <div class="demo-radio-button">
                                                <input name="is_paid" type="radio" id="paid" data-val="1"
                                                    class="with-gap radio-col-green">
                                                <label for="paid">@lang('view_pages.paid')</label>
                                                <input name="is_paid" type="radio" id="unpaid" data-val="0"
                                                    class="with-gap radio-col-red">
                                                <label for="unpaid">@lang('view_pages.unpaid')</label>
                                            </div>
                                            <h4>@lang('view_pages.payment_option')</h4>
                                            <div class="demo-radio-button">
                                                <input name="payment_opt" type="radio" id="card" data-val="0"
                                                    class="with-gap radio-col-red">
                                                <label for="card">@lang('view_pages.card')</label>
                                                <input name="payment_opt" type="radio" id="cash" data-val="1"
                                                    class="with-gap radio-col-blue">
                                                <label for="cash">@lang('view_pages.cash')</label>
                                                <input name="payment_opt" type="radio" id="wallet" data-val="2"
                                                    class="with-gap radio-col-yellow">
                                                <label for="wallet">@lang('view_pages.wallet')</label>
                                                <input name="payment_opt" type="radio" id="wallet_cash" data-val="3"
                                                    class="with-gap radio-col-deep-purple">
                                                <label for="wallet_cash">@lang('view_pages.cash_wallet')</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" data-dismiss="modal"
                                            class="btn btn-success btn-sm float-right filter">@lang('view_pages.apply_filters')</button>

                                        <button type="button" data-dismiss="modal"
                                            class="btn btn-danger btn-sm resetfilter float-right mr-2">
                                            @lang('view_pages.reset_filters')</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->

                    </div>  

                     <div id="js-request-partial-target" class="table-responsive">
                        <include-fragment src="/drivers/request-list/{{$items}}/fetch">
                            <span style="text-align: center;font-weight: bold;">@lang('view_pages.loading')</span>
                        </include-fragment>
                    </div>        

        

       
 
        

    </section>


 <script src="{{ asset('assets/js/fetchdata.min.js') }}"></script>
        <script>
            var search_keyword = '';
            var query = '';
            var items = $('#items').val();
           

            $(function() {
                $('body').on('click', '.pagination a', function(e) {
                    e.preventDefault();
                    var url = $(this).attr('href');
                    $.get(url, $('#search').serialize(), function(data) {
                        $('#js-request-partial-target').html(data);
                    });
                });

                $('#search').on('click', function(e) {
                    e.preventDefault();
                    search_keyword = $('#search_keyword').val();

                    fetch('drivers/request-list/'+items+'/fetch?search=' + search_keyword)
                        .then(response => response.text())
                        .then(html => {
                            document.querySelector('#js-request-partial-target').innerHTML = html
                        });
                });

                $('.filter,.resetfilter').on('click', function() {
                    let filterColumn = ['trip_status', 'is_paid', 'payment_opt'];
                    let className = $(this);

                    $.each(filterColumn, function(index, value) {
                        if (className.hasClass('resetfilter')) {
                            $('input[name="' + value + '"]').prop('checked', false);
                            query = '';
                        } else if ($('input[name="' + value + '"]:checked').attr('id') !=
                            undefined) {
                            var activeVal = $('input[name="' + value + '"]:checked').attr(
                                'data-val');

                            if (value == 'trip_status') {
                                value = $('input[name="' + value + '"]:checked').attr('id');
                            }

                            query += value + '=' + activeVal + '&';
                        }
                    });

                    fetch('/drivers/request-list/'+items+'/fetch?'+query)
                        .then(response => response.text())
                        .then(html => {
                            document.querySelector('#js-request-partial-target').innerHTML = html
                        });
                });
            });

           


           
        </script>
    @endsection
