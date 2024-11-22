@extends('admin.layouts.app')

@section('title', 'Users')

@section('content')

 <style>
        .demo-radio-button label {
            min-width: 100px;
            margin: 0 0 5px 50px;
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

    </style>


<section class="content">
<div class="row">
    <div class="col-12">
        <div class="box">
            <div class="box-header with-border">
                <div class="row text-right">
                    {{-- <div class="col-2">
                        <div class="form-group">
                            <input type="text" id="search_keyword" name="search" class="form-control" placeholder="Enter keyword">
                        </div>
                    </div>

                    <div class="col-1">
                        <button class="btn btn-success btn-outline btn-sm mt-5" type="submit">
                            @lang('view_pages.search')
                        </button>
                    </div> --}}

                     <div class="col-md-12 text-center text-md-right">
                                <button class="btn btn-outline btn-sm btn-danger py-2" type="button" data-toggle="modal"
                                    data-target="#request-modal">
                                    @lang('view_pages.filter_requests')
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
                                           
                                            <h4>@lang('view_pages.paid_status')</h4>
                                            <div class="demo-radio-button">
                                                <input name="is_paid" type="radio" id="paid" data-val="1"
                                                    class="with-gap radio-col-green">
                                                <label for="paid">@lang('view_pages.paid')</label>
                                                <input name="is_paid" type="radio" id="unpaid" data-val="0"
                                                    class="with-gap radio-col-red">
                                                <label for="unpaid">@lang('view_pages.unpaid')</label>
                                            </div>
                                           
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" data-dismiss="modal"
                                            class="btn btn-success btn-sm float-right filter">@lang('view_pages.apply_filters')</button>

                                        <button type="button" data-dismiss="modal"
                                            class="btn btn-danger btn-sm resetfilter float-right mr-2">@lang('view_pages.reset_filters')</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->

                    </div>

        <div id="js-cancellation-partial-target">
            <include-fragment src="cancellation-rides/fetch">
                <span style="text-align: center;font-weight: bold;">@lang('view_pages.loading')</span>
            </include-fragment>
        </div>

        </div>
    </div>
</div>

<script src="{{asset('assets/js/fetchdata.min.js')}}"></script>
<script>
    $(function() {
         var query = '';
    $('body').on('click', '.pagination a', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        $.get(url, $('#search').serialize(), function(data){
            $('#js-cancellation-partial-target').html(data);
        });
    });

    $('#search').on('click', function(e){
        e.preventDefault();
            var search_keyword = $('#search_keyword').val();
            console.log(search_keyword);
            fetch('cancellation-rides/fetch?search='+search_keyword)
            .then(response => response.text())
            .then(html=>{
                document.querySelector('#js-cancellation-partial-target').innerHTML = html
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

                    fetch('cancellation-rides/fetch?' + query)
                        .then(response => response.text())
                        .then(html => {
                            document.querySelector('#js-cancellation-partial-target').innerHTML = html
                        });
                });

});



</script>
@endsection

