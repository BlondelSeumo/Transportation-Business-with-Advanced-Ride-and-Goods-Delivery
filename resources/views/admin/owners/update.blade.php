@extends('admin.layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/build/css/intlTelInput.css') }}">
<!-- Include Bootstrap 5 and other necessary styles -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-beta1/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap datepicker -->
<link rel="stylesheet" href="{!! asset('assets/vendor_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') !!}">

<style>
    .wizard-step {
        display: none;
    }
    .wizard-step.active {
        display: block;
    }
    .wizard-nav {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1rem;
    }
    .wizard-nav .btn {
        flex: 1;
    }
    .wizard-nav .btn + .btn {
        margin-left: 1rem;
    }
</style>

<div class="content">
<div class="container-fluid">
<div class="row">
<div class="col-sm-12">
<div class="container mt-4 p-5">
    <div class="row box">
        <div class="col-12">
            <form method="post" action="{{ url('owners/update', $item->id) }}" enctype="multipart/form-data" id="ownerForm">
                @csrf
                <!-- Wizard Steps -->
                <div class="wizard-step active" id="step1">
                    <h5>@lang('view_pages.owner_details')</h5>
                    <div class="row">
                        @foreach([
                            ['label' => 'company_name', 'type' => 'text', 'required' => true, 'value' => $item->company_name],
                            ['label' => 'owner_name', 'type' => 'text', 'required' => true, 'value' => $item->owner_name],
                            ['label' => 'email', 'type' => 'email', 'required' => true, 'value' => $item->email],
                            ['label' => 'address', 'type' => 'text', 'required' => true, 'value' => $item->address],
                            ['label' => 'postal_code', 'type' => 'number', 'required' => true, 'value' => $item->postal_code],
                            ['label' => 'city', 'type' => 'text', 'required' => true, 'value' => $item->city],
                            ['label' => 'no_of_vehicles', 'type' => 'number', 'required' => true, 'value' => $item->no_of_vehicles, 'attributes' => ['min' => 1]],
                            ['label' => 'tax_number', 'type' => 'text', 'required' => true, 'value' => $item->tax_number],
                        ] as $field)
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="{{ $field['label'] }}">@lang('view_pages.' . $field['label']) @if($field['required'])<span class="text-danger">*</span>@endif</label>
                                <input class="form-control" type="{{ $field['type'] }}" id="{{ $field['label'] }}" name="{{ $field['label'] }}" value="{{ old($field['label'], $field['value']) }}" @if($field['required']) required @endif placeholder="@lang('view_pages.enter') @lang('view_pages.' . $field['label'])" @foreach($field['attributes'] ?? [] as $attr => $value) {{ $attr }}="{{ $value }}" @endforeach>
                                <span class="text-danger">{{ $errors->first($field['label']) }}</span>
                            </div>
                        </div>
                        @endforeach

                        <div class="col-sm-6 mb-3">
                        <div class="form-group">
                            <label for="service_location_id">@lang('view_pages.select_area') <span class="text-danger">*</span></label>
                            <input type="hidden" name="service_location_id" id="service_location_id" class="form-control" value="{{ $item->service_location_id }}">
                            <input type="text" name="service_location" id="service_location" class="form-control" value="{{ $item->area->name }}" readonly>
                        </div>
                        </div>
                        @if($app_for !== 'taxi' && $app_for !== 'delivery')
                        <div class="col-sm-6 mb-3">
                        <div class="form-group">
                            <label for="transport_type">@lang('view_pages.select_transport_type') <span class="text-danger">*</span></label>
                            <select name="transport_type" id="transport_type" class="form-control" readonly>
                                <option value="" selected disabled>@lang('view_pages.select')</option>
                                <option value="taxi" {{ old('transport_type',$item->transport_type) == 'taxi' ? 'selected' : '' }}>@lang('view_pages.taxi')</option>
                                <option value="delivery" {{ old('transport_type',$item->transport_type) == 'delivery' ? 'selected' : '' }}>@lang('view_pages.delivery')</option>
                                <option value="both" {{ old('transport_type',$item->transport_type) == 'both' ? 'selected' : '' }}>@lang('view_pages.both')</option>
                            </select>
                        </div>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="wizard-step" id="step2">
                    <h5>@lang('view_pages.contact_person_details')</h5>
                    <div class="row">
                        @foreach([
                            ['label' => 'name', 'type' => 'text', 'required' => true, 'value' => $item->name],
                            ['label' => 'surname', 'type' => 'text', 'required' => true, 'value' => $item->surname],
                            ['label' => 'mobile', 'type' => 'text', 'required' => true, 'value' => $item->mobile],
                            ['label' => 'phone', 'type' => 'text', 'required' => false, 'value' => $item->phone],
                        ] as $field)
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="{{ $field['label'] }}">@lang('view_pages.' . $field['label']) @if($field['required'])<span class="text-danger">*</span>@endif</label>
                                <input class="form-control" type="{{ $field['type'] }}" id="{{ $field['label'] }}" name="{{ $field['label'] }}" value="{{ old($field['label'], $field['value']) }}" @if($field['required']) required @endif placeholder="@lang('view_pages.enter') @lang('view_pages.' . $field['label'])">
                                <span class="text-danger">{{ $errors->first($field['label']) }}</span>
                            </div>
                        </div>
                        @endforeach
                        <input type="hidden" value="{{$item->user->country ? $item->user->countryDetail->code : get_settings('default_country_code_for_mobile_app')}}" name="dial_code" id="dial_code">
                    </div>
                </div>

                <div class="wizard-step" id="step3">
                    <h5>@lang('view_pages.bank_details')</h5>
                    <div class="row">
                        @foreach([
                            ['label' => 'ifsc', 'type' => 'text', 'required' => true, 'value' => $item->ifsc],
                            ['label' => 'bank_name', 'type' => 'text', 'required' => false, 'value' => $item->bank_name],
                            ['label' => 'account_no', 'type' => 'text', 'required' => false, 'value' => $item->account_no],
                        ] as $field)
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="{{ $field['label'] }}">@lang('view_pages.' . $field['label']) @if($field['required'])<span class="text-danger">*</span>@endif</label>
                                <input class="form-control" type="{{ $field['type'] }}" id="{{ $field['label'] }}" name="{{ $field['label'] }}" value="{{ old($field['label'], $field['value']) }}" @if($field['required']) required @endif placeholder="@lang('view_pages.enter') @lang('view_pages.' . $field['label'])">
                                <span class="text-danger {{ $field['label'] == 'ifsc' ? 'ifsc_err' : '' }}">{{ $errors->first($field['label']) }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

<div class="wizard-step" id="step4">
    <h5>@lang('view_pages.document')</h5>
    <div class="row">
        @foreach ($needed_document as $key => $docs)
        <input type="hidden" name="needed_document[]" value="{{ $docs->id }}">
        <div class="col-sm-12 pb-3">
            <div class="col-sm-6 mb-3">
                <div class="form-group">
                    <label for="doc_name">@lang('view_pages.name') <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="doc_name" value="{{ $docs->name }}" disabled>
                </div>
            </div>
            @if ($docs->has_expiry_date)
            <div class="col-md-6 dateDiv">
                <div class="form-group">
                    <label for="expiry_date">@lang('view_pages.expiry_date') <span class="text-danger">*</span></label>
                    <input class="form-control datepicker" type="text" id="expiry_date_{{$key}}" name="expiry_date[]"
                        value="{{ $item->ownerDocument[$key]->expiry_date }}" required
                        placeholder="YYYY-MM-DD">
                    <span class="text-danger">{{ $errors->first('expiry_date.'.$docs->id) }}</span>
                </div>
            </div>
            @endif
            @if ($docs->has_identify_number)
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="identify_number">@lang('view_pages.identify_number') <span class="text-danger">*</span></label>
                    <input class="form-control" type="text" name="identify_number[]" value="{{ old('identify_number.'.$docs->id, $item->ownerDocument[$key]->identify_number) }}" required placeholder="{{ $docs->identify_number_locale_key }}">
                </div>
            </div>
            @endif
            <div class="col-sm-6 mb-3">
                <div class="form-group profile-img">
                    <label>{{ trans('view_pages.document')}} <span class="text-danger">*</span></label>
                    <div class="col-12" style="display: inline;">
                        <div class="col-md-12 float-left input-group p-0">
                            <span class="input-group-btn">
                                <span class="btn btn-default btn-file">
                                    Browse…
                                    <input class="form-control doc_file" type="file" id="doc_file_{{ $key }}" value="{{ $item->ownerDocument[$key]->image }}" name="document_{{ $docs->id }}">
                                </span>
                            </span>
                            <input type="text" class="form-control" readonly>
                        </div>
                        <div class="col-md-12 float-left p-0">
                            @if (!empty($item->ownerDocument[$key]->image))
                            <img class='img-upload' width="100px" class="rounded avatar-lg" src="{{ asset($item->ownerDocument[$key]->image) }}" id="img_preview_{{ $key }}" />
                            @else
                            <img class='img-upload' width="100px" class="rounded avatar-lg" src="" id="img_preview_{{ $key }}" />
                            @endif
                        </div>
                    </div>
                    <span class="text-danger">{{ $errors->first('doc_file.' . $docs->id) }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>


                <!-- Wizard Navigation -->
                <div class="wizard-nav">
                    <button type="button" class="btn btn-secondary" id="prevBtn">@lang('view_pages.previous')</button>
                    <button type="button" class="btn btn-secondary" id="nextBtn">@lang('view_pages.next')</button>
                    <button type="submit" class="btn btn-primary" id="submitBtn">@lang('view_pages.update')</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>

<!-- Include Bootstrap 5 and other necessary scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-beta1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
    <script src="{{ asset('assets/build/js/intlTelInput.js') }}"></script>

<script>


    let util = '{{ asset('assets/build/js/utils.js') }}';
    var input = document.querySelector("#mobile");
    var default_country = $('#dial_code').val();
    var iti = window.intlTelInput(input, {
        initialCountry: default_country,
        allowDropdown: true,
        separateDialCode: true,
        utilsScript: util,
    });

    $(document).ready(function () {
        var currentStep = 1;
        var totalSteps = $('.wizard-step').length;

        function showStep(step) {
            $('.wizard-step').removeClass('active');
            $('#step' + step).addClass('active');

            $('#prevBtn').toggle(step > 1);
            $('#nextBtn').toggle(step < totalSteps);
            $('#submitBtn').toggle(step === totalSteps);
        }

        $('#nextBtn').click(function () {
            if (currentStep < totalSteps) {
                currentStep++;
                showStep(currentStep);
            }
        });

        $('#prevBtn').click(function () {
            if (currentStep > 1) {
                currentStep--;
                showStep(currentStep);
            }
        });

        showStep(currentStep);
    });
</script>

<script src="{{ asset('assets/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script>
    if($('.iti__selected-dial-code').text() !== $('#dial_code').val()){
        $('#dial_code').val($('.iti__selected-dial-code').text());
    }
    $('#nextBtn').click(function(){
        if($('.wizard-step.active').attr('id') == 'step2'){
            $('#dial_code').val($('.iti__selected-dial-code').text());
        }
    })
    $('.datepicker').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        startDate: 'today',
    });
document.addEventListener('DOMContentLoaded', (event) => {
    document.querySelectorAll('.btn-file input[type="file"]').forEach((input) => {
        input.addEventListener('change', function(event) {
            let input = event.target;
            let key = input.id.split('_').pop(); // Get the key from the input ID
            let label = input.value.replace(/\\/g, '/').replace(/.*\//, '');
            let textInput = input.closest('.input-group').querySelector('input[type="text"]');
            let imgPreview = document.getElementById('img_preview_' + key);

            if (textInput) {
                textInput.value = label;
            }

            if (input.files && input.files[0]) {
                let reader = new FileReader();

                reader.onload = function (e) {
                    if (imgPreview) {
                        imgPreview.src = e.target.result;
                    }
                }

                reader.readAsDataURL(input.files[0]);
            }
        });
    });
});


    
</script>
@endsection
