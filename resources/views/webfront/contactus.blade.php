@extends('admin.layouts.web_header')

@section('title', 'Admin')

<style>
    .nav-link.contact {
        background: var(--logo-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .nav-link.contact::before {
        content: "";
        position: absolute;
        left: .75rem;
        right: .75rem;
        bottom: .25rem;
        border-top: 2px solid #01f0ff;
    }
</style>

<!--Captcha-->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<!--Captcha-->

@if($data)
<section class="py-15 mt-10" id="welcome"  data-jarallax data-speed=".8" style="background-image: url('{{ asset($p.$data->contactbanner) }}');">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-7 col-lg-5 text-white">
                <br><br><br><br><br>
            </div>
        </div>
    </div>
</section>
<section class="pt-12 pb-10">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-5 col-lg-4">

                <!-- Card -->
                <div class="card card-xl h-md-0 minh-md-100 mb-10 mb-md-0 shadow" data-simplebar="init">
                    <div class="simplebar-wrapper" style="margin: 0px;">
                        <div class="simplebar-height-auto-observer-wrapper">
                            <div class="simplebar-height-auto-observer"></div>
                        </div>
                        <div class="">
                            <div class="simplebar-offset">
                                <div class="simplebar-content-wrapper">
                                    <div class="simplebar-content">
                                        <div class="card-body bg-light wow fadeInLeft" data-wow-delay="0.3s">

                                             {!! $data->contacttext !!}

                                           
                                            <br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="simplebar-placeholder" style="width: auto; height: 520px;"></div>
                    </div>
                </div>

            </div>
            <div class="col-12 col-md-7 col-lg-8 wow fadeInLeft" data-wow-delay="0.3s">
                <iframe style="width:100%; height:500px; border:0" src="{{ url($data->contactmap) }}" width="600" height="450"></iframe>
                <!--<iframe style="width:100%; height:500px; border:0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3915.8124423896343!2d76.99306681417376!3d11.052684457057428!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ba85c1faf9dbe73%3A0x68dc9947d4882eff!2sTaxi%20Dispatch%20Software%2FSystem%20%7C%20White%20Label%20Taxi%20App%20-%20TagYourTaxi!5e0!3m2!1sen!2sin!4v1616142939290!5m2!1sen!2sin" width="600" height="450"></iframe>-->
            </div>
            <div class="col-12 pt-3">

                <form class="row" class="Contact-form" action="{{ route('contactussendmail') }}" method="POST">
                    @csrf
                    <div class="form-group col-md-6">
                        <label class="sr-only" for="contactName">
                            First Name
                        </label>
                        <input class="form-control form-control-sm" id="name" name="first_name" type="text" placeholder="First Name" required="">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="sr-only" for="contactName">
                            Last Name
                        </label>
                        <input class="form-control form-control-sm" id="name" name="last_name" type="text" placeholder="Last Name" required="">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="sr-only" for="contactEmail">
                            Email Address
                        </label>
                        <input class="form-control form-control-sm" id="email" name="emailaddress" type="email" placeholder="Email Address" required="">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="sr-only" for="contactTitle">
                            Phone Number
                        </label>
                        <input class="form-control form-control-sm" id="mobile" name="mobile" type="text" placeholder="Phone Number" required="">
                    </div>
                    <div class="form-group col-md-12 mb-7">
                        <label class="sr-only" for="contactMessage">
                            Message
                        </label>
                        <textarea class="form-control form-control-sm" id="message" name="message" rows="5" placeholder="Message" required=""></textarea>
                    </div>
                    <button class="btn btn-dark m-auto" style="display: flex" type="submit">
                        Send Message
                    </button>
                </form>

            </div>
        </div>
    </div>
</section>
@endif

@extends('admin.layouts.web_footer')
