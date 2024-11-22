@extends('admin.layouts.app')

@section('title', 'Main page')
<!-- Include flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<style>
        .demo-radio-button label {
            min-width: 100px;
            margin: 0 0 5px 50px;
        }
        input[type=file]::file-selector-button {
  margin-right: 10px;
  border: none;
  background: #084cdf;
  padding: 10px 10px;
  border-radius: 5px;
  color: #fff;
  cursor: pointer;
  transition: background .2s ease-in-out;
  font-size: 10px;
}

input[type=file]::file-selector-button:hover {
  background: #0d45a5;
}

/* CSS for toggle switch */
.switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
}

.slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
}

input:checked + .slider {
    background-color: #2196F3;
}

input:focus + .slider {
    box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
    border-radius: 34px;
}

.slider.round:before {
    border-radius: 50%;
}
a:hover {
  text-decoration: none;
}


.demo,
.demo p {
  margin: 4em 0;
  text-align: center;
}

/**
 * Tooltip Styles
 */

/* Add this attribute to the element that needs a tooltip */
[data-tooltip] {
  position: relative;
  z-index: 2;
  cursor: pointer;
}

/* Hide the tooltip content by default */
[data-tooltip]:before,
[data-tooltip]:after {
  visibility: hidden;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  filter: progid: DXImageTransform.Microsoft.Alpha(Opacity=0);
  opacity: 0;
  pointer-events: none;
}

/* Position tooltip above the element */
[data-tooltip]:before {
  position: absolute;
  bottom: 150%;
  left: 50%;
  margin-bottom: 5px;
  margin-left: -80px;
  padding: 7px;
  width: 160px;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  background-color: #000;
  background-color: hsla(0, 0%, 20%, 0.9);
  color: #fff;
  content: attr(data-tooltip);
  text-align: center;
  font-size: 14px;
  line-height: 1.2;
}

/* Triangle hack to make tooltip look like a speech bubble */
[data-tooltip]:after {
  position: absolute;
  bottom: 150%;
  left: 50%;
  margin-left: -5px;
  width: 0;
  border-top: 5px solid #000;
  border-top: 5px solid hsla(0, 0%, 20%, 0.9);
  border-right: 5px solid transparent;
  border-left: 5px solid transparent;
  content: " ";
  font-size: 0;
  line-height: 0;
}

/* Show tooltip content on hover */
[data-tooltip]:hover:before,
[data-tooltip]:hover:after {
  visibility: visible;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
  filter: progid: DXImageTransform.Microsoft.Alpha(Opacity=100);
  opacity: 1;
}

    </style>
@section('content')


<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="box p-5">
   

<div class="g-col-12 g-col-lg-4">
    <div class="tab-content mt-5">
<form method="post" action="{{ url('system/settings/sms_store') }}" enctype="multipart/form-data">
@csrf 
    <div class="box p-5 mt-5">
<!-- firbase-otp -->
<div class="d-flex align-items-center justify-content-between">
    <h2 class="fw-medium "> Enable Firebase OTP </h2>
<div class="form-check form-switch  w-sm-auto ms-sm-auto mt-3 mt-sm-0 ps-0">
        @php
             $enableFirebaseOTPValue = $sms_settings->where('name', 'enable_firebase_otp')->first(); 
            $firebaseisChecked = ($enableFirebaseOTPValue && $enableFirebaseOTPValue->value == 1) ? 'checked' : '';

        @endphp
        <span class="online-status"></span>
        <label class="switch">
            <input type="checkbox" class="online-toggle" name="enable_firebase_otp" value="1" {{ $firebaseisChecked }}>
            <span class="slider round"></span>
        </label>
    </div>
</div>     
       </div>
<div class="row p-5">
<!-- twilio -->
    <div class="col-lg-6">
        <div class="box p-5 mt-5">
            <div class="d-flex align-items-center justify-content-between p-5 border-bottom border-gray-200 dark-border-dark-5">
                <div class="d-flex align-items-center"><h2 class="fw-medium fs-base me-auto">Twilio</h2> <p><a href="#" data-tooltip="I’m the Twilio"><i class="fa fa-info-circle" style="font-size:24px; margin-top:10px;margin-left:10px;"></i></a></p></div>
                <div class="form-check form-switch w-sm-auto ms-sm-auto mt-3 mt-sm-0 ps-0">
        @php
             $enabletwilioValue = $sms_settings->where('name', 'enable_twilio')->first(); 
            // Check if $enabletwilioValue is null or 0
            $twilioisChecked = ($enabletwilioValue && $enabletwilioValue->value == 1) ? 'checked' : '';
        @endphp

                    <span class="online-status"></span>
                    <label class="switch">
                        <input type="checkbox" class="online-toggle"  name="enable_twilio" value="1" {{ $twilioisChecked }}>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>

            <div class="p-5 text-center"> 
                <img style="margin:auto;" src="{{ asset('assets/img/twilio.png') }}" width="200px" alt="">
            </div>
            <div class="row mt-5">
                <div class="col-12 col-lg-12 mt-5">
                    <label for="" class="form-label">Sid</label> 
                        <input type="text" class="form-control p-3" placeholder=""  name="twilio_sid" value="{{ $sms_settings->where('name', 'twilio_sid')->first()->value ?? '' }}"> 
                 </div>
                <div class="col-12 col-lg-12 mt-5">
                    <label for="" class="form-label">Token</label> 
                    <input type="text" class="form-control p-3" placeholder=""  name="twilio_token" value="{{ $sms_settings->where('name', 'twilio_token')->first()->value ?? '' }}"> 
                 </div>
                <div class="col-12 col-lg-12 mt-5">
                    <label for="" class="form-label">Twilio Mobile Number</label> 
                    <input type="text" class="form-control p-3" placeholder=""  name="twilio_from_number" value="{{ $sms_settings->where('name', 'twilio_from_number')->first()->value ?? '' }}">                     
                </div>
            </div>
            <div class="text-end mt-5">
                <button type="submit" class="btn btn-primary w-32">Save</button>
            </div>
        </div>
    </div>
<!-- smsAla -->
    <div class="col-lg-6">
        <div class="box p-5 mt-5">
            <div class="d-flex align-items-center justify-content-between p-5 border-bottom border-gray-200 dark-border-dark-5">
            <div class="d-flex align-items-center"><h2 class="fw-medium fs-base me-auto">SMS ALA</h2> <p><a href="#" data-tooltip="I’m the SMS ALA"><i class="fa fa-info-circle" style="font-size:24px; margin-top:10px;margin-left:10px;"></i></a></p></div>
    <div class="form-check form-switch w-sm-auto ms-sm-auto mt-3 mt-sm-0 ps-0">
        @php
             $enableSmsAlaValue = $sms_settings->where('name', 'enable_smsala')->first(); 
            // Check if $enableSmsAlaValue is null or 0
            $smsalaisChecked = ($enableSmsAlaValue && $enableSmsAlaValue->value == 1) ? 'checked' : '';
        @endphp
        <span class="online-status"></span>
        <label class="switch">
            <input type="checkbox" class="online-toggle"  name="enable_smsala"  value="1" {{ $smsalaisChecked }}>
            <span class="slider round"></span>
        </label>
    </div>
            </div>
            <div class="p-5 text-center"> 
                <img style="margin:auto;" src="{{ asset('assets/img/smsala.webp') }}" width="200px" alt="">
            </div>
            <div class="row mt-5">
                <div class="col-12 col-lg-12 mt-5">
                    <label for="" class="form-label">Api ID </label> 
                    <input type="text" class="form-control p-3" placeholder=""  name="smsala_api_key" value="{{ $sms_settings->where('name', 'smsala_api_key')->first()->value ?? '' }}"> 
                </div>
                <div class="col-12 col-lg-12 mt-5">
                    <label for="" class="form-label">Api Password</label> 
                    <input type="text" class="form-control p-3" placeholder=""  name="smsala_secrect_key" value="{{ $sms_settings->where('name', 'smsala_secrect_key')->first()->value ?? '' }}"> 
                </div>
                <div class="col-12 col-lg-12 mt-5">
                    <label for="" class="form-label">Sender ID</label> 
                    <input type="text" class="form-control p-3" placeholder=""  name="smsala_token" value="{{ $sms_settings->where('name', 'smsala_token')->first()->value ?? '' }}"> 
                </div>
            </div>
            <div class="text-end mt-5">
                <button type="submit" class="btn btn-primary w-32">Save</button>
            </div>
        </div>
    </div>
<!-- Msg91 -->
    <div class="col-lg-6">
        <div class="box p-5 mt-5">
            <div class="d-flex align-items-center justify-content-between p-5 border-bottom border-gray-200 dark-border-dark-5">
            <div class="d-flex align-items-center"><h2 class="fw-medium fs-base me-auto">Msg91</h2> <p><a href="#" data-tooltip="I’m the MSG91"><i class="fa fa-info-circle" style="font-size:24px; margin-top:10px;margin-left:10px;"></i></a></p></div>
    <div class="form-check form-switch w-sm-auto ms-sm-auto mt-3 mt-sm-0 ps-0">
        @php
             $enableMsg91Value = $sms_settings->where('name', 'enable_msg91')->first(); 
            // Check if $enableMsg91Value is null or 0
            $msg91isChecked = ($enableMsg91Value && $enableMsg91Value->value == 1) ? 'checked' : '';
        @endphp
        <span class="online-status"></span>
        <label class="switch">
            <input type="checkbox" class="online-toggle"  name="enable_msg91"  value="1" {{ $msg91isChecked }}>
            <span class="slider round"></span>
        </label>
    </div>

            </div>
            <div class="p-5 text-center"> 
                <img style="margin:auto;" src="{{ asset('assets/img/msg91.png') }}" width="200px" alt="">
            </div>
            <div class="row mt-5">
                <div class="col-12 col-lg-12 mt-5">
                    <label for="" class="form-label">Template Id</label> 
                    <input type="text" class="form-control p-3" placeholder=""  name="msg91_sender_id" value="{{ $sms_settings->where('name', 'msg91_sender_id')->first()->value ?? '' }}">   
                </div>
                <div class="col-12 col-lg-12 mt-5">
                    <label for="" class="form-label">Auth Key</label> 
                    <input type="text" class="form-control p-3" placeholder=""  name="msg91_auth_key" value="{{ $sms_settings->where('name', 'msg91_auth_key')->first()->value ?? '' }}">
                </div>
             </div>
            <div class="text-end mt-5">
                <button type="submit" class="btn btn-primary w-32">Save</button>
            </div>
        </div>
    </div>
<!-- Sparrow -->
    <div class="col-lg-6">
        <div class="box p-5 mt-5">
            <div class="d-flex align-items-center justify-content-between p-5 border-bottom border-gray-200 dark-border-dark-5">
            <div class="d-flex align-items-center"><h2 class="fw-medium fs-base me-auto">Sparrow</h2> <p><a href="#" data-tooltip="I’m the Sparrow"><i class="fa fa-info-circle" style="font-size:24px; margin-top:10px;margin-left:10px;"></i></a></p></div>
    <div class="form-check form-switch w-sm-auto ms-sm-auto mt-3 mt-sm-0 ps-0">
        @php
             $enableSparrowValue = $sms_settings->where('name', 'enable_sparrow')->first(); 
            // Check if $enableSparrowValue is null or 0
            $sparrowisChecked = ($enableSparrowValue && $enableSparrowValue->value == 1) ? 'checked' : '';
        @endphp        
        <span class="online-status"></span>
        <label class="switch">
            <input type="checkbox" class="online-toggle"  name="enable_sparrow" value="1" {{ $sparrowisChecked }}>
            <span class="slider round"></span>
        </label>
    </div>
            </div>
            <div class="p-5 text-center"> 
                <img style="margin:auto;" src="{{ asset('assets/img/sparrow.png') }}" width="200px" alt="">
            </div>
            <div class="row mt-5">
                <div class="col-12 col-lg-12 mt-5">
                    <label for="" class="form-label">Sender Id</label> 
                    <input type="text" class="form-control p-3" placeholder=""  name="sparrow_sender_id" value="{{ $sms_settings->where('name', 'sparrow_sender_id')->first()->value ?? '' }}">                    
                </div>
                <div class="col-12 col-lg-12 mt-5">
                    <label for="" class="form-label">Token</label> 
                    <input type="text" class="form-control p-3" placeholder=""  name="sparrow_token" value="{{ $sms_settings->where('name', 'sparrow_token')->first()->value ?? '' }}"> 
                </div>
            </div>
            <div class="text-end mt-5">
                <button type="submit" class="btn btn-primary w-32">Save</button>
            </div>
        </div>
    </div>    
<!-- sms india Hub -->
<!-- Sparrow -->
    <div class="col-lg-6">
        <div class="box p-5 mt-5">
            <div class="d-flex align-items-center justify-content-between p-5 border-bottom border-gray-200 dark-border-dark-5">
            <div class="d-flex align-items-center"><h2 class="fw-medium fs-base me-auto">SMS India Hub</h2> <p><a href="#" data-tooltip="I’m the SMS India Hub"><i class="fa fa-info-circle" style="font-size:24px; margin-top:10px;margin-left:10px;"></i></a></p></div>
    <div class="form-check form-switch w-sm-auto ms-sm-auto mt-3 mt-sm-0 ps-0">
        @php
             $enablesms_india_hubValue = $sms_settings->where('name', 'enable_sms_india_hub')->first(); 
            // Check if $enablesms_india_hubValue is null or 0
            $sms_india_hubisChecked = ($enablesms_india_hubValue && $enablesms_india_hubValue->value == 1) ? 'checked' : '';
        @endphp        
        <span class="online-status"></span>
        <label class="switch">
            <input type="checkbox" class="online-toggle"  name="enable_sms_india_hub" value="1" {{ $sms_india_hubisChecked }}>
            <span class="slider round"></span>
        </label>
    </div>
            </div>
            <div class="p-5 text-center"> 
                <img style="margin:auto;" src="{{ asset('assets/img/SMSINDIAHUB.png') }}" width="200px" alt="">
            </div>
            <div class="row mt-5">
                <div class="col-12 col-lg-12 mt-5">
                    <label for="" class="form-label">Api Key</label> 
                    <input type="text" class="form-control p-3" placeholder=""  name="sms_india_hub_api_key" value="{{ $sms_settings->where('name', 'sms_india_hub_api_key')->first()->value ?? '' }}">                    
                </div>
                <div class="col-12 col-lg-12 mt-5">
                    <label for="" class="form-label">SID</label> 
                    <input type="text" class="form-control p-3" placeholder=""  name="sms_india_hub_sid" value="{{ $sms_settings->where('name', 'sms_india_hub_sid')->first()->value ?? '' }}"> 
                </div>
            </div>
            <div class="text-end mt-5">
                <button type="submit" class="btn btn-primary w-32">Save</button>
            </div>
        </div>
    </div>  
            </div>
        </div>
    </div>
</div>
 <!-- tab end -->
</form>

</div>
</div>
</div>
</div>
</div>
<script>
    $(document).ready(function() {
        $(document).on('change', '.online-toggle', function() {
            $('.online-toggle').not(this).prop('checked', false);
            var isChecked = $(this).is(':checked');
            
            if (!isChecked) {
                // Prevent unchecking if no other checkbox is checked
                var anyChecked = $('.online-toggle:checked').length > 0;
                if (!anyChecked) {
                    $(this).prop('checked', true);
                    alert("Please enable at least one event.");
                }
            }

            // console.log("Status:", isChecked ? "ON" : "OFF");
        });
    });
</script>

@endsection

