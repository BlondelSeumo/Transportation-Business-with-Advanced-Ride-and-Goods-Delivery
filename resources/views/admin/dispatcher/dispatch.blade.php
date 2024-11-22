@extends('admin.layouts.app')
@section('title', 'Dispatch Request')

@section('content')

    <style>
        body {
            margin-bottom: 0px !important;
        }

        .modal-backdrop {
            position: unset;
        }

        .modal-dialog {
            width: 80%;
        }

        .sidebar-contact {
            position: fixed;
            top: 65px;
            width: 30%;
            height: 90vh;
            background: #fff;
            box-shadow: 0 20px 50px rgba(0, 0, 0, .5);
            box-sizing: border-box;
            transition: 0.5s;
        }

        .toggle {
            position: absolute;
            height: 48px;
            width: 48px;
            text-align: center;
            cursor: pointer;
            background: #0b4dd8;
            top: 0;
            line-height: 48px;
            z-index: 9;
        }

        .toggle:before {
            font-size: 18px;
            color: #fff;
        }

        .toggle.active:before {
            content: 'X' !important;
        }

        @media(max-width:768px) {
            .sidebar-contact.active .toggle {
                top: 0;
                right: 0;
                transform: translateY(0);
            }
        }

        /* LEFT */
        .left {
            left: calc(230px - 30%);
        }

        .left.active {
            left: calc(230px - 0%);
        }

        .left .toggle {
            right: -48px;
            transition: 0.6s;
        }

        .left.active .toggle {
            right: 0;
        }

        .left .toggle:before {
            content: '>';
        }

        /* Right */
        .right {
            right: -30%;
        }

        .right.active {
            right: 0;
        }

        .right .toggle {
            left: -48px;
            transition: 0.6s;
        }

        .right.active .toggle {
            left: 0;
        }

        .right .toggle:before {
            content: '<';
        }

        .map {
            width: 100%;
            height: calc(100vh - 60px);
        }

        .choose-type {
            padding: 0%;
            background: #0b4dd8;
            border-radius: 10px;
            padding: 10px 0;
        }

        .choose-type li {
            list-style: none;
        }

        .choose-type li a {
            color: #fff;
        }

        .choose-type img {
            width: 55px;
            height: 55px;
            padding: 5px;
        }

    </style>
    <!-- Start Page content -->

    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d125323.40216323904!2d76.89719493217808!3d11.011870079525526!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ba859af2f971cb5%3A0x2fc1c81e183ed282!2sCoimbatore%2C%20Tamil%20Nadu!5e0!3m2!1sen!2sin!4v1609845148600!5m2!1sen!2sin"
        frameborder="0" style="border:0;" class="map" allowfullscreen="" aria-hidden="false" tabindex="0">
    </iframe>

    <section class="content" style="min-height: 0;padding: 0;">

        <div class="sidebar-contact left">
            <div class="toggle l"></div>
            <div>
                <div class="box mb-0">
                    <div class="box-header with-border">
                        <h4 class="box-title">@lang('view_pages.new_booking')</h4>
                    </div>
                    <div class="box-header with-border">
                        <div class="filters-group-wrap">
                            <div class="filters-group">
                                <div class="btn-group filter-options">
                                    <button class="btn btn--primary ml-1" data-group="all">
                                      @lang('view_pages.all')
                                    </button>
                                    <button class="btn btn--primary ml-1" data-group="pending">
                                      @lang('view_pages.pending')
                                    </button>
                                    <button class="btn btn--primary ml-1" data-group="accept">
                                        @lang('view_pages.accept')
                                    </button>
                                    <button class="btn btn--primary ml-1" data-group="active">
                                        @lang('view_pages.active')
                                    </button>
                                    <!-- <button class="btn btn--primary ml-1" data-group="completed">
                                        Completed
                                    </button>
                                    <button class="btn btn--primary ml-1" data-group="user-cancelled">
                                        User Cancelled
                                    </button>
                                    <button class="btn btn--primary ml-1" data-group="driver-cancelled">
                                        Driver Cancelled
                                    </button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-body py-0 chart-responsive" style="height: calc(100vh - 124px); overflow-y: scroll;">
                        <div id="grid" class="row my-shuffle-container">

                            <figure class="col-12 picture-item accept" data-groups='["accept"]'>
                                <div class="row">
                                    <div class="col-3">
                                       @lang('view_pages.name')
                                    </div>
                                    <div class="col-6">
                                         @lang('view_pages.personal_id')
                                    </div>
                                    <div class="col-3">
                                        <div class="ststus">
                                         @lang('view_pages.accept')                                  
                                          </div>
                                    </div>
                                </div>
                            </figure>
                            <figure class="col-12 picture-item active" data-groups='["active"]'>
                                <div class="row">
                                    <div class="col-3">
                                         @lang('view_pages.name')
                                    </div>
                                    <div class="col-6">
                                        @lang('view_pages.personal_id')
                                    </div>
                                    <div class="col-3">
                                        <div class="ststus">
                                            @lang('view_pages.active')
                                        </div>
                                    </div>
                                </div>
                            </figure>
                            <figure class="col-12 picture-item pending" data-groups='["pending"]'>
                                <div class="row">
                                    <div class="col-3">
                                        @lang('view_pages.name')
                                    </div>
                                    <div class="col-6">
                                        @lang('view_pages.personal_id')
                                    </div>
                                    <div class="col-3">
                                        <div class="ststus">
                                              @lang('view_pages.pending')
                                        </div>
                                    </div>
                                </div>
                            </figure>
                            <figure class="col-12 picture-item accept" data-groups='["accept"]'>
                                <div class="row">
                                    <div class="col-3">
                                       @lang('view_pages.name')
                                    </div>
                                    <div class="col-6">
                                       @lang('view_pages.personal_id')
                                    </div>
                                    <div class="col-3">
                                        <div class="ststus">
                                            @lang('view_pages.accept')  
                                        </div>
                                    </div>
                                </div>
                            </figure>
                            <figure class="col-12 picture-item active" data-groups='["active"]'>
                                <div class="row">
                                    <div class="col-3">
                                        @lang('view_pages.name')
                                    </div>
                                    <div class="col-6">
                                       @lang('view_pages.personal_id')
                                    </div>
                                    <div class="col-3">
                                        <div class="ststus">
                                           @lang('view_pages.active')
                                        </div>
                                    </div>
                                </div>
                            </figure>
                            <figure class="col-12 picture-item pending" data-groups='["pending"]'>
                                <div class="row">
                                    <div class="col-3">
                                       @lang('view_pages.name')
                                    </div>
                                    <div class="col-6">
                                      @lang('view_pages.personal_id')
                                    </div>
                                    <div class="col-3">
                                        <div class="ststus">
                                              @lang('view_pages.pending')
                                        </div>
                                    </div>
                                </div>
                            </figure>
                            <figure class="col-12 picture-item accept" data-groups='["accept"]'>
                                <div class="row">
                                    <div class="col-3">
                                      @lang('view_pages.name')
                                    </div>
                                    <div class="col-6">
                                            @lang('view_pages.personal_id')                                  
                                              </div>
                                    <div class="col-3">
                                        <div class="ststus">
                                             @lang('view_pages.accept')
                                        </div>
                                    </div>
                                </div>
                            </figure>
                            <figure class="col-12 picture-item active" data-groups='["active"]'>
                                <div class="row">
                                    <div class="col-3">
                                    @lang('view_pages.name')
                                    </div>
                                    <div class="col-6">
                                        @lang('view_pages.personal_id')
                                    </div>
                                    <div class="col-3">
                                        <div class="ststus">
                                          @lang('view_pages.active')
                                        </div>
                                    </div>
                                </div>
                            </figure>
                            <figure class="col-12 picture-item pending" data-groups='["pending"]'>
                                <div class="row">
                                    <div class="col-3">
                                   @lang('view_pages.name')
                                    </div>
                                    <div class="col-6">
                                       @lang('view_pages.personal_id')
                                    </div>
                                    <div class="col-3">
                                        <div class="ststus">
                                              @lang('view_pages.pending')
                                        </div>
                                    </div>
                                </div>
                            </figure>
                            <figure class="col-12 picture-item accept" data-groups='["accept"]'>
                                <div class="row">
                                    <div class="col-3">
                                   @lang('view_pages.name')
                                    </div>
                                    <div class="col-6">
                                       @lang('view_pages.personal_id')
                                    </div>
                                    <div class="col-3">
                                        <div class="ststus">
                                           @lang('view_pages.accept')
                                        </div>
                                    </div>
                                </div>
                            </figure>
                            <figure class="col-12 picture-item active" data-groups='["active"]'>
                                <div class="row">
                                    <div class="col-3">
                                   @lang('view_pages.name')
                                    </div>
                                    <div class="col-6">
                                      @lang('view_pages.personal_id')
                                    </div>
                                    <div class="col-3">
                                        <div class="ststus">
                                          @lang('view_pages.active')
                                        </div>
                                    </div>
                                </div>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="sidebar-contact right">
            <div class="toggle r"></div>
            <div>
                <div class="box mb-0">
                    <div class="box-header with-border text-right">
                        <h4 class="box-title">
                            <button type="button" class="btn btn-primary btn-lg turned-button mx-2" data-toggle="modal"
                                data-target="#book-latter">
                                 @lang('view_pages.book_later')
                            </button>

                            <button type="button" class="btn btn-primary btn-lg turned-button mr-auto" data-toggle="modal"
                                data-target="#book-now">
                               @lang('view_pages.book_now')
                            </button>
                           @lang('view_pages.booking_details')
                        </h4>
                    </div>
                </div>
            </div>
        </div>

        <div id="book-now" class="modal fade" role="dialog">
            <div class="modal-dialog container">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            @lang('view_pages.book_now')
                        </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="box">
                                    <div class="box-header with-border">
                                        <h4 class="box-title"> @lang('view_pages.passenger_details')</h4>
                                    </div>
                                    <div class="box-body py-0">
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>@lang('view_pages.full_name')</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Eg. your text here">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>@lang('view_pages.email_or_phone')</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Eg. your text here">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-header with-border">
                                        <h4 class="box-title">@lang('view_pages.location_details')</h4>
                                    </div>
                                    <div class="box-body py-0">
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>@lang('view_pages.pickup')</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <i class="fa fa-location-arrow"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control"
                                                            placeholder="Pickup Address">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>@lang('view_pages.drop')</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <i class="fa fa-location-arrow"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control" placeholder="Drop address">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-12 route-details chs-cls text-center p-0">
                                        <div class="box-header with-border text-left">
                                            <h4 class="box-title">@lang('view_pages.choose_type')</h4>
                                        </div>
                                        <div class="box-body py-0">
                                            <div class="row">
                                                <div class="col-md-3 m-auto">
                                                    <ul class="choose-type">
                                                        <li><a href="">Mini</a></li>
                                                        <li class="car-img"><a href=""> <img
                                                                    src="{{ asset('images/email/mini.svg') }}" alt=""></a>
                                                        </li>
                                                        <li><a href="">$23</a></li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-3 m-auto">
                                                    <ul class="choose-type">
                                                        <li><a href="">Micro</a></li>
                                                        <li class="car-img"><a href=""> <img
                                                                    src="{{ asset('images/email/micro.svg') }}"
                                                                    alt=""></a></li>
                                                        <li><a href="">$33</a></li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-3 m-auto">
                                                    <ul class="choose-type">
                                                        <li><a href="">Sedan</a></li>
                                                        <li class="car-img"><a href=""> <img
                                                                    src="{{ asset('images/email/sedan.svg') }}"
                                                                    alt=""></a></li>
                                                        <li><a href="">$53</a></li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-3 m-auto">
                                                    <ul class="choose-type">
                                                        <li><a href="">Suv</a></li>
                                                        <li class="car-img"><a href=""> <img
                                                                    src="{{ asset('images/email/suv.svg') }}" alt=""></a>
                                                        </li>
                                                        <li><a href="">$63</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 text-center login-btn">
                                        <button class="btn btn-info btn-block margin-top-10 submit_button"
                                            type="submit"> @lang('view_pages.book_now')</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="box">
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d125323.40216323904!2d76.89719493217808!3d11.011870079525526!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ba859af2f971cb5%3A0x2fc1c81e183ed282!2sCoimbatore%2C%20Tamil%20Nadu!5e0!3m2!1sen!2sin!4v1609845148600!5m2!1sen!2sin"
                                        style="width: 100%;height: 560px;" frameborder="0" style="border:0;"
                                        allowfullscreen="" aria-hidden="false" tabindex="0">
                                    </iframe>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div id="book-latter" class="modal fade" role="dialog">
            <div class="modal-dialog container">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            @lang('view_pages.book_later')
                        </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="box">
                                    <div class="box-header with-border">
                                        <h4 class="box-title">@lang('view_pages.passenger_details')</h4>
                                    </div>
                                    <div class="box-body py-0">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>@lang('view_pages.full_name')</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Eg. your text here">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>@lang('view_pages.email_or_phone')</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Eg. your text here">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-header with-border">
                                        <h4 class="box-title">Booking Date and Time</h4>
                                    </div>
                                    <div class="box-body py-0">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>PickUp Time</label>
                                                    <input type="datetime-local" class="form-control"
                                                        placeholder="Date and Time">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Drop Time</label>
                                                    <input type="datetime-local" class="form-control"
                                                        placeholder="Date and Time">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-header with-border">
                                        <h4 class="box-title">@lang('view_pages.location_details')</h4>
                                    </div>
                                    <div class="box-body py-0">
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>@lang('view_pages.pickup')</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <i class="fa fa-location-arrow"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control"
                                                            placeholder="Pickup Address">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>@lang('view_pages.drop')</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <i class="fa fa-location-arrow"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control" placeholder="Drop address">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-12 route-details chs-cls text-center p-0">
                                        <div class="box-header with-border text-left">
                                            <h4 class="box-title">@lang('view_pages.choose_type')</h4>
                                        </div>
                                        <div class="box-body py-0">
                                            <div class="row">
                                                <div class="col-md-3 m-auto">
                                                    <ul class="choose-type">
                                                        <li><a href="">Mini</a></li>
                                                        <li class="car-img"><a href=""> <img
                                                                    src="{{ asset('images/email/mini.svg') }}" alt=""></a>
                                                        </li>
                                                        <li><a href="">$23</a></li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-3 m-auto">
                                                    <ul class="choose-type">
                                                        <li><a href="">Micro</a></li>
                                                        <li class="car-img"><a href=""> <img
                                                                    src="{{ asset('images/email/micro.svg') }}"
                                                                    alt=""></a></li>
                                                        <li><a href="">$33</a></li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-3 m-auto">
                                                    <ul class="choose-type">
                                                        <li><a href="">Sedan</a></li>
                                                        <li class="car-img"><a href=""> <img
                                                                    src="{{ asset('images/email/sedan.svg') }}"
                                                                    alt=""></a></li>
                                                        <li><a href="">$53</a></li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-3 m-auto">
                                                    <ul class="choose-type">
                                                        <li><a href="">Suv</a></li>
                                                        <li class="car-img"><a href=""> <img
                                                                    src="{{ asset('images/email/suv.svg') }}" alt=""></a>
                                                        </li>
                                                        <li><a href="">$63</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 text-center login-btn">
                                        <button class="btn btn-info btn-block margin-top-10 submit_button"
                                            type="submit"> @lang('view_pages.book_now')</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="box">
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d125323.40216323904!2d76.89719493217808!3d11.011870079525526!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ba859af2f971cb5%3A0x2fc1c81e183ed282!2sCoimbatore%2C%20Tamil%20Nadu!5e0!3m2!1sen!2sin!4v1609845148600!5m2!1sen!2sin"
                                        style="width: 100%;height: 560px;" frameborder="0" style="border:0;"
                                        allowfullscreen="" aria-hidden="false" tabindex="0">
                                    </iframe>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <script>
        $(document).ready(function() {
            $('.toggle.l').click(function() {
                $('.left').toggleClass('active')
                $('.toggle.l').toggleClass('active')
            })
        })
        $(document).ready(function() {
            $('.toggle.r').click(function() {
                $('.right').toggleClass('active')
                $('.toggle.r').toggleClass('active')
            })
        })

    </script>
    <script src='https://unpkg.com/shufflejs@5'></script>
    <script>
        var Shuffle = window.Shuffle;

        class Demo {
            constructor(element) {
                this.element = element;
                this.shuffle = new Shuffle(element, {
                    itemSelector: ".picture-item",
                    sizer: element.querySelector(".my-sizer-element"),
                });

                this.addShuffleEventListeners();
                this._activeFilters = [];
                this.addFilterButtons();
                this.addSorting();
                this.addSearchFilter();
            }

            addShuffleEventListeners() {
                this.shuffle.on(Shuffle.EventType.LAYOUT, (data) => {
                    console.log("layout. data:", data);
                });
                this.shuffle.on(Shuffle.EventType.REMOVED, (data) => {
                    console.log("removed. data:", data);
                });
            }

            addFilterButtons() {
                const options = document.querySelector(".filter-options");
                if (!options) {
                    return;
                }

                const filterButtons = Array.from(options.children);
                const onClick = this._handleFilterClick.bind(this);
                filterButtons.forEach((button) => {
                    button.addEventListener("click", onClick, false);
                });
            }

            _handleFilterClick(evt) {
                const btn = evt.currentTarget;
                const isActive = btn.classList.contains("active");
                const btnGroup = btn.getAttribute("data-group");

                this._removeActiveClassFromChildren(btn.parentNode);

                let filterGroup;
                if (isActive) {
                    btn.classList.remove("active");
                    filterGroup = Shuffle.ALL_ITEMS;
                } else {
                    btn.classList.add("active");
                    filterGroup = btnGroup;
                }

                this.shuffle.filter(filterGroup);
            }

            _removeActiveClassFromChildren(parent) {
                const {
                    children
                } = parent;
                for (let i = children.length - 1; i >= 0; i--) {
                    children[i].classList.remove("active");
                }
            }

            addSorting() {
                const buttonGroup = document.querySelector(".sort-options");
                if (!buttonGroup) {
                    return;
                }
                buttonGroup.addEventListener("change", this._handleSortChange.bind(this));
            }

            _handleSortChange(evt) {
                const buttons = Array.from(evt.currentTarget.children);
                buttons.forEach((button) => {
                    if (button.querySelector("input").value === evt.target.value) {
                        button.classList.add("active");
                    } else {
                        button.classList.remove("active");
                    }
                });

                const {
                    value
                } = evt.target;
                let options = {};

                function sortByDate(element) {
                    return element.getAttribute("data-created");
                }

                function sortByTitle(element) {
                    return element.getAttribute("data-title").toLowerCase();
                }

                if (value === "date-created") {
                    options = {
                        reverse: true,
                        by: sortByDate,
                    };
                } else if (value === "title") {
                    options = {
                        by: sortByTitle,
                    };
                }
                this.shuffle.sort(options);
            }

            addSearchFilter() {
                const searchInput = document.querySelector(".js-shuffle-search");
                if (!searchInput) {
                    return;
                }
                searchInput.addEventListener("keyup", this._handleSearchKeyup.bind(this));
            }

            /**
             * Filter the shuffle instance by items with a title that matches the search input.
             * @param {Event} evt Event object.
             **/

            _handleSearchKeyup(evt) {
                const searchText = evt.target.value.toLowerCase();
                this.shuffle.filter((element, shuffle) => {
                    // If there is a current filter applied, ignore elements that don't match it.
                    if (shuffle.group !== Shuffle.ALL_ITEMS) {
                        // Get the item's groups.
                        const groups = JSON.parse(element.getAttribute("data-groups"));
                        const isElementInCurrentGroup = groups.indexOf(shuffle.group) !== -1;
                        // Only search elements in the current group
                        if (!isElementInCurrentGroup) {
                            return false;
                        }
                    }
                    const titleElement = element.querySelector(".picture-item__title");
                    const titleText = titleElement.textContent.toLowerCase().trim();
                    return titleText.indexOf(searchText) !== -1;
                });
            }
        }
        document.addEventListener("DOMContentLoaded", () => {
            window.demo = new Demo(document.getElementById("grid"));
        });

    </script>

@endsection
