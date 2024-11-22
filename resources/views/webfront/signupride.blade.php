@extends('admin.layouts.web_header')

@section('title', 'Admin')

<section class="py-14">
    <div class=" container">
        <div class="row">
            <div class="col-12 col-md-6 m-auto">
                <div class="card card-lg border mb-10 mb-md-0">
                    <div class="card-body text-center">
                        <img src="{{asset('img/logo-1.png')}}" alt="" class="mb-5" style="max-width: 60px;border-radius: 50%;">
                        <h4 class="mb-5">
                            Let's start with your number
                        </h4>
                        <p>
                            We'll send a text to verify your phone.
                        </p>
                        <form>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <input class="form-control form-control-sm" id="" type="text" placeholder="Phone Number *" required>
                                    </div>
                                </div>
                                <div class="col-12 col-md text-left">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" id="loginRemember" type="checkbox">
                                            <label class="custom-control-label" for="loginRemember">
                                                Remember me
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-auto">
                                    <div class="form-group">
                                        <a class="font-size-sm text-reset" data-toggle="modal" href="#modalPasswordReset">Find your account</a>
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <button class="btn btn-sm btn-dark" type="submit">
                                        Next
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@extends('admin.layouts.web_footer')