@extends('admin.layouts.app')

<style>
    .timeline .timeline-item>.timeline-point {
        color: yellow !important;
        padding: 3px;
    }

</style>

@section('content')


    <section class="content">

        <div class="row">


            <div class="col-12 col-lg-4">
                <div class="box">

                    <div class="text-white box-body bg-img text-center py-50"
                        style="background-image: url({{ asset('assets/images/1-bg.jpg') }});">
                        <a href="#">
                            <img class="avatar avatar-xxl avatar-bordered" src="{{ asset('assets/images/1.jpg') }}"
                                alt="">
                        </a>
                        <h5 class="mt-2 mb-0"><a class="text-white" href="#">Driver Name</a></h5>
                        <span>
                            <i class="fa fa-star" style="color: yellow"></i>
                            <i class="fa fa-star" style="color: yellow"></i>
                            <i class="fa fa-star" style="color: yellow"></i>
                            <i class="fa fa-star" style="color: yellow"></i>
                            <i class="fa fa-star"></i>
                        </span>
                    </div>
                    <ul class="flexbox flex-justified text-center p-20">
                        <li class="br-1 border-light">
                            <span class="text-muted">Completed</span><br>
                            <span class="font-size-20">652</span>
                        </li>
                        <li class="br-1 border-light">
                            <span class="text-muted">Cancelled</span><br>
                            <span class="font-size-20">58</span>
                        </li>
                        <li>
                            <span class="text-muted">Scheduled</span><br>
                            <span class="font-size-20">21</span>
                        </li>
                    </ul>
                </div>

                <div class="box">
                    <div class="box-body">
                        <div class="flexbox align-items-baseline mb-20 border-bottom">
                            <h6 class="text-uppercase ls-2 font-weight-600">Vehicle details :</h6>
                        </div>
                        <img class="w-full" src="{{ asset('assets/images/2.jpg') }}" alt="">
                        <div class="profile-user-info">
                            <p>
                                <b>
                                    Car Make
                                    :
                                </b>
                                <br>
                                <span class="text-gray">
                                    Volkswagen
                                </span>
                            </p>
                            <p>
                                <b>
                                    Car Model
                                    :
                                </b>
                                <br>
                                <span class="text-gray">
                                    Passat
                                </span>
                            </p>
                            <p>
                                <b>
                                    Car Type
                                    :
                                </b>
                                <br>
                                <span class="text-gray">
                                    Sedan
                                </span>
                            </p>
                            <p>
                                <b>
                                    Car Number
                                    :
                                </b>
                                <br>
                                <span class="text-gray">
                                    SBJ38 BF5569
                                </span>
                            </p>
                            <p>
                                <b>
                                    Car Color
                                    :
                                </b>
                                <br>
                                <span class="text-gray">
                                    Pink
                                </span>
                            </p>
                            <p>
                                <b>
                                    Vehicle Model Year
                                    :
                                </b>
                                <br>
                                <span class="text-gray">
                                    2019
                                </span>
                            </p>
                            <p>
                                <b>
                                    Own Vehicle ?
                                </b>
                                <br>
                                <span class="text-gray">
                                    Yes
                                </span>
                            </p>
                        </div>
                    </div>
                </div>

            </div>


            <div class="col-lg-8 col-12">


                <div class="box">
                    <div class="box-body box-profile">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="profile-user-info">
                                    <p><b>Email :</b> <br>
                                        <span class="text-gray">
                                            driver@gmail.com
                                        </span>
                                    </p>
                                    <p><b>Phone :</b> <br>
                                        <span class="text-gray">
                                            xxxxx xxxxx
                                        </span>
                                    </p>
                                    <p><b>Address :</b> <br>
                                        <span class="text-gray">
                                            123, Lorem, ipsum dolor sit
                                            amvoluptatibus.
                                            Dignissimos iusto deserunt debitis ab possimus, harum vero, error laboriosam
                                            iste reprehenderit et hic!
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="profile-user-info">
                                    <p><b>Last Active Location :</b></p>
                                    <div class="map-box">
                                        <iframe
                                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2805244.1745767146!2d-86.32675167439648!3d29.383165774894163!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88c1766591562abf%3A0xf72e13d35bc74ed0!2sFlorida%2C+USA!5e0!3m2!1sen!2sin!4v1501665415329"
                                            width="100%" height="200" frameborder="0" style="border:0"
                                            allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

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


        </div>


    </section>

@endsection
