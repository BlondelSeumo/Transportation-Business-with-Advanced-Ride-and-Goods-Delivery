@extends('admin.layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/build/css/intlTelInput.css') }}">
<!-- Include Bootstrap 5 styles -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-beta1/css/bootstrap.min.css" rel="stylesheet">
 <!-- bootstrap datepicker -->
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
        flex: 0.2;
    }
    .wizard-nav .btn + .btn {
        margin-left: 1rem;
    }
</style>

<div class="content">
<div class="container-fluid">

<div class="row">
<div class="col-sm-12">

<div class="container  mt-4 ">
    <div class="row box p-5">
        <div class="col-12 p-5">          
            <form method="post" action="{{ url('owners/store') }}" enctype="multipart/form-data" id="ownerForm">
                @csrf
                <!-- Wizard Steps -->
                <div class="wizard-step active" id="step1">
                    <h5 class="mt-5">@lang('view_pages.owner_details')</h5>
                    <div class="row">
                        @foreach([
                            ['label' => 'company_name', 'type' => 'text', 'required' => true],
                            ['label' => 'owner_name', 'type' => 'text', 'required' => true],
                            ['label' => 'email', 'type' => 'email', 'required' => true],
                            ['label' => 'password', 'type' => 'password', 'required' => true],
                            ['label' => 'password_confirmation', 'type' => 'password', 'required' => true],
                            ['label' => 'address', 'type' => 'text', 'required' => true],
                            ['label' => 'postal_code', 'type' => 'number', 'required' => true],
                            ['label' => 'city', 'type' => 'text', 'required' => true],
                            ['label' => 'no_of_vehicles', 'type' => 'number', 'required' => true, 'attributes' => ['min' => 1]],
                            ['label' => 'tax_number', 'type' => 'text', 'required' => true],
                        ] as $field)
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="{{ $field['label'] }}">@lang('view_pages.' . $field['label']) @if($field['required'])<span class="text-danger">*</span>@endif</label>
                                <input class="form-control" type="{{ $field['type'] }}" id="{{ $field['label'] }}" name="{{ $field['label'] }}" value="{{ old($field['label']) }}" @if($field['required']) required @endif placeholder="@lang('view_pages.enter') @lang('view_pages.' . $field['label'])" @foreach($field['attributes'] ?? [] as $attr => $value) {{ $attr }}="{{ $value }}" @endforeach>
                                <span class="text-danger">{{ $errors->first($field['label']) }}</span>
                            </div>
                        </div>
                        @endforeach

                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="service_location_id">@lang('view_pages.select_area') <span class="text-danger">*</span></label>
                                <input type="hidden" name="service_location_id" id="service_location_id" class="form-control" value="{{ $area->id }}" readonly>                                
                                <input type="text" name="service_location" id="service_location" class="form-control" value="{{ $area->name }}" readonly>
                            </div>
                        </div>

                        @if($app_for !== 'taxi' && $app_for !== 'delivery')
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="transport_type">@lang('view_pages.select_transport_type') <span class="text-danger">*</span></label>
                                <select name="transport_type" id="transport_type" class="form-control">
                                    <option value="" selected disabled>@lang('view_pages.select')</option>
                                    <option value="taxi" {{ old('transport_type') == 'taxi' ? 'selected' : '' }}>@lang('view_pages.taxi')</option>
                                    <option value="delivery" {{ old('transport_type') == 'delivery' ? 'selected' : '' }}>@lang('view_pages.delivery')</option>
                                    <option value="both" {{ old('transport_type') == 'both' ? 'selected' : '' }}>@lang('view_pages.both')</option>
                                </select>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>

                <div class="wizard-step" id="step2">
                    <h5>@lang('view_pages.contact_person_details')</h5>
                    <div class="row">
                        <input type="hidden" name="dial_code" id="dial_code" value="+91">
                        @foreach([
                            ['label' => 'name', 'type' => 'text', 'required' => true],
                            ['label' => 'surname', 'type' => 'text', 'required' => true],
                            ['label' => 'mobile', 'type' => 'text', 'required' => true],
                            ['label' => 'phone', 'type' => 'text', 'required' => false],
                        ] as $field)
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="{{ $field['label'] }}">@lang('view_pages.' . $field['label']) @if($field['required'])<span class="text-danger">*</span>@endif</label>
                                <input class="form-control" type="{{ $field['type'] }}" id="{{ $field['label'] }}" name="{{ $field['label'] }}" value="{{ old($field['label']) }}" @if($field['required']) required @endif placeholder="@lang('view_pages.enter') @lang('view_pages.' . $field['label'])">
                                <span class="text-danger">{{ $errors->first($field['label']) }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="wizard-step" id="step3">
                    <h5>@lang('view_pages.bank_details')</h5>
                    <div class="row">
                        @foreach([
                            ['label' => 'ifsc', 'type' => 'text', 'required' => true],
                            ['label' => 'bank_name', 'type' => 'text', 'required' => false],
                            ['label' => 'account_no', 'type' => 'text', 'required' => false],
                        ] as $field)
                        <div class="col-sm-6 mb-3">
                            <div class="form-group">
                                <label for="{{ $field['label'] }}">@lang('view_pages.' . $field['label']) @if($field['required'])<span class="text-danger">*</span>@endif</label>
                                <input class="form-control" type="{{ $field['type'] }}" id="{{ $field['label'] }}" name="{{ $field['label'] }}" value="{{ old($field['label']) }}" @if($field['required']) required @endif placeholder="@lang('view_pages.enter') @lang('view_pages.' . $field['label'])">
                                <span class="text-danger {{ $field['label'] == 'ifsc' ? 'ifsc_err' : '' }}">{{ $errors->first($field['label']) }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="wizard-step" id="step4">
                    <h5>@lang('view_pages.document')</h5>
                    <div class="row">
                        @foreach ($needed_document as $key => $item)
                        <input type="hidden" name="needed_document[]" value="{{ $item->id }}">
                        <div class="col-sm-12 pb-3">
                            <div class="col-sm-6 mb-3">
                                <div class="form-group">
                                    <label for="doc_name">@lang('view_pages.name') <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="doc_name" value="{{ $item->name }}" disabled>
                                </div>
                            </div>
                            @if ($item->has_expiry_date)
                                @php
                                    $expiryDates = old('expiry_date', [now()->format('Y-m-d')]); // Default to current date if no old values
                                @endphp
                                @foreach ($expiryDates as $expiryDate)
                                    <div class="col-md-6 dateDiv">
                                        <div class="form-group">
                                            <label for="expiry_date">@lang('view_pages.expiry_date') <span class="text-danger">*</span></label>
                                            <input class="form-control datepicker" type="text" id="expiry_date_{{$key}}" name="expiry_date[]"
                                                value="{{ $expiryDate }}" required
                                                placeholder="{{ now()->format('Y-m-d') }}">
                                            <span class="text-danger">{{ $errors->first('expiry_date') }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                            @if ($item->has_identify_number)
                                @php
                                    $identifyNumbers = old('identify_number', [$item->identify_number_locale_key]); // Default to the item's identify number locale key if no old values
                                @endphp
                                @foreach ($identifyNumbers as $index => $identifyNumber)
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="identify_number">@lang('view_pages.identify_number') <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="identify_number[]" required  placeholder="{{ $item->identify_number_locale_key }}">
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                            <div class="col-sm-6 mb-3">
                                <div class="form-group profile-img">
                                    <label for="doc_file_{{ $key }}">@lang('view_pages.document') <span class="text-danger">*</span></label>
                                    <div class="col-12" style="display: inline;">
                                    <div class="col-md-12 float-left input-group p-0">
                                        <span class="input-group-btn">
                                            <span class="btn btn-default btn-file">
                                                Browse…
                                                <input class="form-control doc_file" type="file" id="doc_file_{{ $key }}" name="document_{{ $item->id }}" required>
                                            </span>
                                        </span>
                                        <input type="text" class="form-control" readonly>
                                    </div>
                                    <div class="col-md-12 float-left p-0">
                                        <img class='img-upload' width="100px" class="rounded avatar-lg" src="" id="img_preview_{{ $key }}" />
                                    </div>
                                    </div>
                                    <span class="text-danger">{{ $errors->first('doc_file.' . $item->id) }}</span>
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
                    <button type="submit" class="btn btn-primary" id="submitBtn">@lang('view_pages.submit')</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>

<!-- Include jQuery first, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-beta1/js/bootstrap.bundle.min.js"></script>

<script>
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
<script src="{{ asset('assets/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}">
    </script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('assets/build/js/intlTelInput.js') }}"></script>

<script>

    let util = '{{ asset('assets/build/js/utils.js') }}'
    var input = document.querySelector("#mobile");
    var default_country = "{{get_settings('default_country_code_for_mobile_app')}}";
    var iti = window.intlTelInput(input, {
        initialCountry: default_country,
        allowDropdown: true,
        separateDialCode: true,
        utilsScript: util,
    });

   $('.select2').select2({
        placeholder : "Select ...",
    });

document.addEventListener('DOMContentLoaded', (event) => {
    if($('.iti__selected-dial-code').text() !== $('#dial_code').val()){
        $('#dial_code').val($('.iti__selected-dial-code').text());
    }
    $('#nextBtn').click(function(){
        if($('.wizard-step.active').attr('id') == 'step2'){
            $('#dial_code').val($('.iti__selected-dial-code').text());
        }
    })
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

        //Date picker
        $('.datepicker').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd',
            startDate: 'today',
        });
    </script>
@endsection
