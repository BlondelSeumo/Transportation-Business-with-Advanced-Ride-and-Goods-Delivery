@extends('admin.layouts.app')

@section('title', 'Company Driver Document')

@section('content')
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
<!-- Start Page content -->
<section class="content">

<div class="row">
<div class="col-12">
<div class="box">

    <div class="box-header with-border">
        <a href="{{ url()->previous() }}">
            <button class="btn btn-danger btn-sm pull-right" type="submit">
                <i class="mdi mdi-keyboard-backspace mr-2"></i>
                @lang('view_pages.back')
            </button>
        </a>
    </div>

    <div class="box-body no-padding">
        <div class="table-responsive">
        <form action="#" method="post">
            @csrf
          <table class="table table-hover">
            <thead>
                <tr>
                    <th> @lang('view_pages.s_no')</th>
                    <th> @lang('view_pages.driver_name')</th>
                    <th> @lang('view_pages.document_name')</th>
                    <th> @lang('view_pages.expiry_date')</th>
                    <th> @lang('view_pages.status')</th>
                    <th> @lang('view_pages.comment')</th>
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
                        $driver_doc_id="";
                        $doc_comment = '-';
                        $doc_status = '';
                    @endphp
                    @foreach($driverDoc as $doc_dets)
                        @if($doc_dets->document_id == $item->id)
                            @php
                                $count++;
                                $expiry_date = $doc_dets->expiry_date;
                                $driver_doc_id = $doc_dets->id;
                                $doc_status = $doc_dets->document_status;
                                $doc_comment = $doc_dets->comment;
                                 $docImage=$doc_dets->image;
                            @endphp
                        @endif
                    @endforeach
                <tr>
                    <input type="hidden" name="driver_id" class="driver_id" value="{{ $driver->id }}">
                    <input type="hidden" name="document_id[]" class="document_id" value="{{ $driver_doc_id }}">
                    <input type="hidden" name="document_status[]" class="document_status" value="{{ $doc_status }}">
                    <input type="hidden" name="comment[]" class="comment" value="{{$doc_comment}}">

                    <td>{{ $i++ }}</td>
                    <td>
                        {{ $driver->name }}
                    </td>
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
                        @if($count == 0)
                            <a href="{{ url('company/drivers/upload/document',[$driver->id,$item->id]) }}" class="fas fa fa-upload"></a>
                        @else
                            <a href="#" class="open-image"  title="View Image">
                                <i class="imageresource fas fa fa-file-image-o" data-src="{{ $docImage }}"></i>
                            </a>
                            {{-- <a href="{{ $docImage }}" class="fas fa fa-download text-purple" download></a> --}}
                            <a href="{{ url('company/drivers/upload/document',[$driver->id,$item->id]) }}" class="fas fa fa-edit"></a>
                            {{-- <a href="{{ url('company/drivers/delete/document',[$driver_doc_id]) }}" class="fas fa fa-trash text-red sweet-delete"></a> --}}
                        @endif
                    </td>

                   
                     <td>
                        @if($count == 0)
                           <!--  <span class="badge badge-danger">@lang('view_pages.not_uploaded')</span> -->
                           -
                        @else
                            {{-- @if ($doc_status == 1)
                                <span class="btn btn-sm  btn-outline btn-danger decline">@lang('view_pages.decline')</span>
                            @elseif ($doc_status == 5)
                                <span class="btn btn-sm btn-success btn-outline approve">@lang('view_pages.approve')</span>
                            @else
                                <span class="btn btn-sm btn-success btn-outline approve">@lang('view_pages.approve')</span>
                                <span class="btn btn-sm  btn-outline btn-danger decline">@lang('view_pages.decline')</span>
                            @endif --}}

                            <span class="btn btn-sm btn-success btn-outline approve">@lang('view_pages.approve')</span>
                            <span class="btn btn-sm  btn-outline btn-danger decline">@lang('view_pages.decline')</span>

                        @endif
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

        <div class="form-group">
            <div class="col-12">
                <button class="btn btn-primary btn-sm pull-right m-5" id="approveDocument" type="button">
                    @lang('view_pages.update')
                </button>
            </div>
        </div>
    </form>

    <div class="text-right">
    <span  style="float:right">
    {{-- {{$results->links()}} --}}
    </span>
    </div>
    </div>
    </div>

</div>
</div>
</div>
</section>

<div class="modal fade bd-example-modal-lg" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: fit-content;">
        <div class="modal-content">
            <div class="modal-body">
                <img src="" class="imagepreview" style="height: 80vh;">
            </div>
            <div class="modal-footer">
                <button type="button" data-bs-dismiss="modal" class="btn btn-danger btn-sm float-right">Close</button>
                <a href="" class="downloadImage" download>
                    <button type="button" class="btn btn-success btn-sm float-right mr-2">Download</button>
                </a>
            </div>
        </div>
    </div>
</div>


<script>
     $(document).on('click','.open-image',function(){
        let image = $(this).find('.imageresource').attr('data-src');
        console.log(image);
        $('.imagepreview').attr('src', image);
        $('.downloadImage').attr('href',image);
        $('#imagemodal').modal('show');
    });

$(document).on('click','.decline',function(){
    var button = $(this);
    var inpVal = button.closest('tr').find('.comment_td').text().trim();

    if(inpVal == '-'){
        inpVal = '';
    }

    swal({
        title: "",
        text: "Add A Comment For Your Action",
        type: "input",
        showCancelButton: true,
        closeOnConfirm: false,
        confirmButtonText: 'Decline',
        cancelButtonText: 'Cancel',
        confirmButtonColor: '#fc4b6c',
        confirmButtonBorderColor: '#fc4b6c',
        animation: "slide-from-top",
        inputPlaceholder: "Enter Comment for Decline",
        inputValue: inpVal
    },
    function(inputValue){
        if (inputValue === false) return false;

        if (inputValue === "") {
            swal.showInputError("Reason is required!");
            return false
        }

        button.prev().text('Approve');

        if(!button.prev().hasClass('btn-outline')){
            button.prev().addClass('btn-outline')
        }

        button.text('Declined');
        button.removeClass('btn-outline');
        button.closest('tr').find('.comment_td').text(inputValue);
        button.closest('tr').find('.comment').val(inputValue);
        button.closest('tr').find('.document_status').val(5);

        swal.close();
    });
});

$(document).on('click','.approve',function(){
    let span = $(this);

    span.text('Approved');
    span.removeClass('btn-outline');
    span.closest('tr').find('.comment_td').text('-');
    span.next().text('Decline');
    span.closest('tr').find('.comment').val('');
    span.closest('tr').find('.document_status').val(1);

    if(!span.next().hasClass('btn-outline')){
        span.next().addClass('btn-outline');
    }

});

$(document).on('click','#approveDocument',function(){
    var url = "{{ url('company/drivers') }}";

    $.ajax({
        url: '{{ route("approveCompanyDriverDocument") }}',
        data: $('form').serialize(),
        method: 'post',
        success: function(res){
            if(res == 'success'){
                window.location.href = url;
            }
        }
    });
});

</script>
@endsection

