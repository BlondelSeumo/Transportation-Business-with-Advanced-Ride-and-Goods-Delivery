@extends('admin.layouts.app')

@section('content')

<!--alerts CSS -->
<link href="{!! asset('taxi/assets/vendor/sweetalert/sweetalert.css') !!}" rel="stylesheet" type="text/css">

<style>
    .fas {
        padding: 12px 13px;
        background: rgba(85, 110, 230, 0.3);
        color: rgb(85, 110, 230);
        font-size: 15px;
        border-radius: 50%;
        cursor: pointer;
    }
    .text-red {
        color: red;
    }
</style>

<div class="row p-0 m-0">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18"> @lang('view_pages.manage_document')</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ url('owners/by_area',$owner->service_location_id) }}"> @lang('view_pages.manage_owner')</a></li>
                    <li class="breadcrumb-item active">@lang('view_pages.owner_document')</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row p-0 m-0">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="col-sm-12 p-0">
                    <div class="form-group">
                        {{-- <p><span> <strong> {{strtoupper($driver->firstname) .' '. strtoupper($driver->lastname)}} </strong></span> <span class="float-right"><b>@lang('view_pages.reg_code')</b>: {{ $driver->registration_code }}</span></p> --}}
                    </div>
                </div>
                <div class="col-sm-12 p-0">

                <form action="#" method="post">
                    @csrf
                    <table class="table table-hover" style="border-collapse: collapse; border-spacing: 0px; width: 100%;" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                        <thead>
                            <tr>
                                <th> @lang('view_pages.s_no')</th>
                                <th> @lang('view_pages.name')</th>
                                <th> @lang('view_pages.expiry_date')</th>
                                <th> @lang('view_pages.status')</th>
                                <th> @lang('view_pages.comment')</th>
                                <th> @lang('view_pages.doc_view')</th>
                                <th> @lang('view_pages.action')</th>
                                <th> @lang('view_pages.approval_action')</th>
                            </tr>

                        </thead>

                        <tbody>
                            @php $i = 1; @endphp

                            @forelse ($neededDocument as $item)
                                @php
                                    $count=0;
                                    $expiry_date="-";
                                    $owner_doc_id="";
                                    $doc_comment = '-';
                                    $doc_status = '';
                                @endphp
                                @foreach($ownerDoc as $doc_dets)
                                    @if($doc_dets->document_id == $item->id)
                                        @php
                                            $count++;
                                            $expiry_date = $doc_dets->expiry_date ? now()->parse($doc_dets->expiry_date)->format('d-m-Y') : '-';
                                            $owner_doc_id = $doc_dets->id;
                                            $doc_status = $doc_dets->document_status;
                                            $doc_comment = $doc_dets->comment;
                                            $image = $doc_dets->image;
                                        @endphp
                                    @endif
                                @endforeach
                            <tr>
                                <input type="hidden" name="owner_id" class="owner_id" value="{{ $owner->id }}">
                                <input type="hidden" name="document_id[]" class="document_id" value="{{ $owner_doc_id }}">
                                <input type="hidden" name="document_status[]" class="document_status" value="{{ $doc_status }}">
                                <input type="hidden" name="comment[]" class="comment" value="{{$doc_comment}}">

                                <td>{{ $i++ }}</td>
                                <td>
                                    {{ $item->name }}
                                </td>
                                <td>{{ $expiry_date }}</td>
                                <td>
                                    @if($count == 0)
                                        <span class="badge badge-danger">@lang('view_pages.not_uploaded')</span>
                                    @else
                                        @if ($doc_status == 1)
                                            <span class="badge badge-success">{{ driver_document_name($doc_status) }}</span>
                                        @elseif ($doc_status == 5)
                                            <span class="badge badge-danger">{{ driver_document_name($doc_status) }}</span>
                                        @else
                                            <span class="badge badge-warning">{{ driver_document_name($doc_status) }}</span>
                                        @endif
                                    @endif
                                </td>


                                <td class="comment_td">
                                    {{ $doc_comment ?? '-' }}
                                </td>

                                <td>
                                    @if($count > 0)
                                        <a href="#" class="open-image fas fa fa-eye" data-src="{{ $image }}"></a>
                                    @else
                                        -
                                    @endif
                                </td>

                                <td>
                                    @if($count == 0)
                                        <a href="{{url('owners/upload/document',[$owner->id,$item->id]) }}" class="fas fa fa-upload"></a>
                                    @else
                                        <a href="{{url('owners/upload/document',[$owner->id,$item->id]) }}" class="fas fa fa-edit"></a>
                                        {{-- <a href="{{ $image }}" target="_blank" class="fas fa fa-eye"></a> --}}
                                    @endif
                                </td>
                                    <td>
                                    @if($count == 0)
                                        -
                                    @else
                                        <span class="btn btn-sm btn-outline-success approve">@lang('view_pages.approve')</span>
                                        <span class="btn btn-sm btn-outline-danger decline">@lang('view_pages.decline')</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="11">
                                        <p id="no_data" class="lead no-data text-center">
                                            <img src="{{asset('assets/img/dark-data.svg')}}" style="width:250px;margin-top:25px;" alt="">
                                            <h4 class="text-center" style="color:#333;font-size:25px;">@lang('view_pages.no_data_found')</h4>
                                        </p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <hr>
                        <div class="form-group">
                            <div class="col-12 mt-3">
                                <button class="btn btn-primary btn-sm pull-right" id="approveDocument" type="button">
                                    @lang('view_pages.update')
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <img src="" class="imagepreview" style="width: 100%;">
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-danger btn-sm float-right"> @lang('view_pages.close')</button>
                <a href="" class="downloadImage" download>
                    <button type="button" class="btn btn-success btn-sm float-right mr-2">@lang('view_pages.download')</button>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Sweet-Alert  -->
<script src="{{asset('taxi/assets/vendor/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{asset('taxi/assets/vendor/sweetalert/jquery.sweet-alert.custom.js')}}"></script>
<script>
$(document).on('click','.decline',function(){
    var button = $(this);
    var inpVal = button.closest('tr').find('.comment_td').text().trim();

    if(inpVal == '-'){
        inpVal = '';
    }

    swal({
        title: "",
        text: "Reason for Decline",
        type: "input",
        showCancelButton: true,
        closeOnConfirm: false,
        confirmButtonText: 'Decline',
        cancelButtonText: 'Close',
        confirmButtonColor: '#fc4b6c',
        confirmButtonBorderColor: '#fc4b6c',
        animation: "slide-from-top",
        inputPlaceholder: "Enter Reason for Decline",
        inputValue: inpVal
    },
    function(inputValue){
        if (inputValue === false) return false;

        if (inputValue === "") {
            swal.showInputError("Reason is required!");
            return false
        }

        button.prev().text('Approve');

        if(button.prev().hasClass('btn-success')){
            button.prev().removeClass('btn-success')
            button.prev().addClass('btn-outline-success')
        }

        button.text('Declined');
        button.removeClass('btn-outline-danger');
        button.addClass('btn-danger');
        button.closest('tr').find('.comment_td').text(inputValue);
        button.closest('tr').find('.comment').val(inputValue);
        button.closest('tr').find('.document_status').val(5);

        swal.close();
    });
});

$(document).on('click','.approve',function(){
    let span = $(this);

    span.text('Approved');
    span.removeClass('btn-outline-success');
    span.addClass('btn-success');
    span.closest('tr').find('.comment_td').text('-');
    span.next().text('Decline');
    span.closest('tr').find('.comment').val('');
    span.closest('tr').find('.document_status').val(1);


    if(span.next().hasClass('btn-danger')){
        span.next().removeClass('btn-danger');
        span.next().addClass('btn-outline-danger');
    }

});

$(document).on('click','#approveDocument',function(){
    var url = "{{url('owners/by_area') }}/"+"{{$owner->service_location_id}}";

    $.ajax({
        url: '{{ route("approveOwnerDocument") }}',
        data: $('form').serialize(),
        method: 'post',
        success: function(res){
            if(res == 'success'){
                window.location.href = url;
            }
        }
    });
});

$(document).on('click','.open-image',function(){
   let image = $(this).attr('data-src');
   $('.imagepreview').attr('src', image);
   $('.downloadImage').attr('href',image);
   $('#imagemodal').modal('show');
});
</script>
@endsection

