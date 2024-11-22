@extends('admin.layouts.app')
@section('title', 'Main page')
<style>
button,
input {
    font-family: "Montserrat", "Helvetica Neue", Arial, sans-serif;
}

a {
    color: #f96332;
}

a:hover,
a:focus {
    color: #f96332;
}

p {
    line-height: 1.61em;
    font-weight: 300;
    font-size: 1.2em;
}

.category {
    text-transform: capitalize;
    font-weight: 700;
    color: #9A9A9A;
}

body {
    color: #2c2c2c;
    font-size: 14px;
    font-family: "Montserrat", "Helvetica Neue", Arial, sans-serif;
    overflow-x: hidden;
    -moz-osx-font-smoothing: grayscale;
    -webkit-font-smoothing: antialiased;
}

.nav-item .nav-link,
.nav-tabs .nav-link {
    -webkit-transition: all 300ms ease 0s;
    -moz-transition: all 300ms ease 0s;
    -o-transition: all 300ms ease 0s;
    -ms-transition: all 300ms ease 0s;
    transition: all 300ms ease 0s;
}

.card a {
    -webkit-transition: all 150ms ease 0s;
    -moz-transition: all 150ms ease 0s;
    -o-transition: all 150ms ease 0s;
    -ms-transition: all 150ms ease 0s;
    transition: all 150ms ease 0s;
}

[data-toggle="collapse"][data-parent="#accordion"] i {
    -webkit-transition: transform 150ms ease 0s;
    -moz-transition: transform 150ms ease 0s;
    -o-transition: transform 150ms ease 0s;
    -ms-transition: all 150ms ease 0s;
    transition: transform 150ms ease 0s;
}

[data-toggle="collapse"][data-parent="#accordion"][aria-expanded="true"] i {
    filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=2);
    -webkit-transform: rotate(180deg);
    -ms-transform: rotate(180deg);
    transform: rotate(180deg);
}


.now-ui-icons {
    display: inline-block;
    font: normal normal normal 14px/1 'Nucleo Outline';
    font-size: inherit;
    speak: none;
    text-transform: none;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

@-webkit-keyframes nc-icon-spin {
    0% {
        -webkit-transform: rotate(0deg);
    }

    100% {
        -webkit-transform: rotate(360deg);
    }
}

@-moz-keyframes nc-icon-spin {
    0% {
        -moz-transform: rotate(0deg);
    }

    100% {
        -moz-transform: rotate(360deg);
    }
}

@keyframes nc-icon-spin {
    0% {
        -webkit-transform: rotate(0deg);
        -moz-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        -o-transform: rotate(0deg);
        transform: rotate(0deg);
    }

    100% {
        -webkit-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        -o-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}

.now-ui-icons.objects_umbrella-13:before {
    content: "\ea5f";
}

.now-ui-icons.shopping_cart-simple:before {
    content: "\ea1d";
}

.now-ui-icons.shopping_shop:before {
    content: "\ea50";
}

.now-ui-icons.ui-2_settings-90:before {
    content: "\ea4b";
}

.nav-tabs {
    border: 0;
    padding: 15px 0.7rem;
}

.nav-tabs:not(.nav-tabs-neutral)>.nav-item>.nav-link.active {
    box-shadow: 0px 5px 35px 0px rgba(0, 0, 0, 0.3);
}

.card .nav-tabs {
    border-top-right-radius: 0.1875rem;
    border-top-left-radius: 0.1875rem;
}

.nav-tabs>.nav-item>.nav-link {
    color: #888888;
    margin: 0;
    margin-right: 5px;
    background-color: transparent;
    border: 1px solid transparent;
    border-radius: 30px;
    font-size: 14px;
    line-height: 1.5;
}

.nav-tabs>.nav-item>.nav-link:hover {
    background-color: transparent;
}

.nav-tabs>.nav-item>.nav-link.active {
    background-color: #2a3042;
    border-radius: 30px;
    color: #FFFFFF;
  border-bottom: none !important;
}

.nav-tabs>.nav-item>.nav-link i.now-ui-icons {
    font-size: 14px;
    position: relative;
    top: 1px;
    margin-right: 3px;
}

.nav-tabs.nav-tabs-neutral>.nav-item>.nav-link {
    color: #FFFFFF;
}

.nav-tabs.nav-tabs-neutral>.nav-item>.nav-link.active {
    background-color: rgba(255, 255, 255, 0.2);
    color: #FFFFFF;
}

.card {
    border: 0;
    border-radius: 0.1875rem;
    display: inline-block;
    position: relative;
    width: 100%;
    margin-bottom: 30px;
    box-shadow: 0px 5px 25px 0px rgba(0, 0, 0, 0.2);
}

.card .card-header {
    background-color: transparent;
    border-bottom: 0;
    background-color: transparent;
    border-radius: 0;
    padding: 0;
}

.card[data-background-color="orange"] {
    background-color: #f96332;
}

.card[data-background-color="red"] {
    background-color: #FF3636;
}

.card[data-background-color="yellow"] {
    background-color: #FFB236;
}

.card[data-background-color="blue"] {
    background-color: #2CA8FF;
}

.card[data-background-color="green"] {
    background-color: #15b60d;
}

[data-background-color="orange"] {
    background-color: #e95e38;
}

[data-background-color="black"] {
    background-color: #2c2c2c;
}

[data-background-color]:not([data-background-color="gray"]) {
    color: #FFFFFF;
}

[data-background-color]:not([data-background-color="gray"]) p {
    color: #FFFFFF;
}

[data-background-color]:not([data-background-color="gray"]) a:not(.btn):not(.dropdown-item) {
    color: #FFFFFF;
}

[data-background-color]:not([data-background-color="gray"]) .nav-tabs>.nav-item>.nav-link i.now-ui-icons {
    color: #FFFFFF;
}


@font-face {
  font-family: 'Nucleo Outline';
  src: url("https://github.com/creativetimofficial/now-ui-kit/blob/master/assets/fonts/nucleo-outline.eot");
  src: url("https://github.com/creativetimofficial/now-ui-kit/blob/master/assets/fonts/nucleo-outline.eot") format("embedded-opentype");
  src: url("https://raw.githack.com/creativetimofficial/now-ui-kit/master/assets/fonts/nucleo-outline.woff2");
  font-weight: normal;
  font-style: normal;
        
}

.now-ui-icons {
  display: inline-block;
  font: normal normal normal 14px/1 'Nucleo Outline';
  font-size: inherit;
  speak: none;
  text-transform: none;
  /* Better Font Rendering */
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

@media screen and (max-width: 768px) {

    .nav-tabs {
        display: inline-block;
        width: 100%;
        padding-left: 100px;
        padding-right: 100px;
        text-align: center;
    }

    .nav-tabs .nav-item>.nav-link {
        margin-bottom: 5px;
    }
}
</style>

@section('content')
<section class="content">

<div class="row">

  <div class="col-12">
    <div class="box">
      <div class="container mt-5">
      <div class="row">
      <div class="col-md-10 col-xl-6 ">
      <!-- Nav tabs -->
      <div class="card">
        <div class="">
          <ul class="nav nav-tabs justify-content-center" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
                <i class="now-ui-icons objects_umbrella-13"></i> @lang('view_pages.city_taxi')
              </a>
            </li>
          
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#rentals" role="tab">
                <i class="now-ui-icons shopping_shop"></i> @lang('view_pages.rentals')
              </a>
            </li>
              <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#outstation" role="tab">
                <i class="now-ui-icons shopping_cart-simple"></i>@lang('view_pages.outstation') 
              </a>
            </li>
          </ul>
        </div>
        <div class="card-body">
          <!-- Tab panes -->
          <div class="tab-content text-center">
            <div class="tab-pane active" id="home" role="tabpanel">
    
        <div class="radio_book">
          <input class="form-check-input" type="radio" name="book" id="booklater" value="booklater" >
          <label class="form-check-label" for="booklater">
             @lang('view_pages.book_later')
          </label>
          <input class="form-check-input" type="radio" name="book" id="booknow" value="booknow">
          <label class="form-check-label" for="booknow"> @lang('view_pages.book_now')
          </label>
        </div>
     
       <p class="box-title txtInput">@lang('view_pages.user_details')</p>
      <div class="input-group mar1rm">
                  <input class="form-control w-100 required_for_valid" type="text"
                      placeholder="Name" name="name" id="name" aria-label="Username"
                      aria-describedby="basic-addon1">
              </div>
            
              <div class="input-group mar1rm">
                  <input class="form-control w-100" type="text" name="phone"
          placeholder="Phone Number"  id="phone" aria-label="phone" aria-describedby="basic-addon1">
              </div>
      
        <p class="box-title txtInput">@lang('view_pages.location_details')</p>
                                                <div class="input-group mar1rm">
                                                    <input class="form-control w-100 required_for_valid" type="text"
                                                        placeholder="Pickup Location" name="pickup" id="pickup"
                                                        aria-label="Username" aria-describedby="basic-addon1">
                                                  
                                                </div>
                        <div class="input-group mar1rm">
                                                    <input class="form-control w-100 required_for_valid" type="text"
                                                        placeholder="Drop Location" name="drop" id="drop"
                                                        aria-label="Username" aria-describedby="basic-addon1">
                                                  
                                                </div>

                                                <div class="text-left">
                                                     <p class="box-title txtInput">@lang('view_pages.start_date')</p>
                                                <input class="form-control datetimepicker required_for_valid"
                                                    name="date" id="datepicker" type="text" required placeholder="d/m/y"
                                                    data-options='{"disableMobile":true}' />
                                               <!--  <span class="text-danger"
                                                    id="error-date">{{ $errors->first('date') }}</span> -->
                                            </div>
                                            <div class="text-left">
                                                <p class="box-title txtInput">
                                                @lang('view_pages.start_time')</p>
                                                <input class="form-control datetimepicker required_for_valid"
                                                    name="time" id="timepicker" type="text" required placeholder="H:i"
                                                    data-options='{"enableTime":true,"noCalendar":true,"dateFormat":"H:i","disableMobile":true}' />
                                              <!--   <span class="text-danger"
                                                    id="error-time">{{ $errors->first('time') }}</span> -->
                                            </div>
                        <p class="box-title txtInput"> @lang('view_pages.payment_method')</p>
                        <div class="text-left chq-radio">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" id="cash" type="radio" name="payment_opt" value="1">
                                                    <label class="form-check-label book" for="cash">
                                                        &nbsp; @lang('view_pages.cash')
                                                    </label>
                                                </div>
                                            </div>
                      <div class="col-12 mt-3">
                                        <button type="button"
                                            class="btn btn-primary btn-md turned-button form-submit mr-auto appbtn"
                                            style="float: right">
                                            @lang('view_pages.book_cabs')
                                        </button>
                                    </div>
                                          
            </div>
             <div class="tab-pane" id="rentals" role="tabpanel">
             <div class="radio_book">
          <input class="form-check-input" type="radio" name="rentalbook" id="rentalbooklater" value="rentalbooklater">
          <label class="form-check-label" for="rentalbooklater">
           @lang('view_pages.book_later')
          </label>
          <input class="form-check-input" type="radio" name="rentalbook" id="rentalbooknow" value="rentalbooknow" >
          <label class="form-check-label" for="rentalbooknow">@lang('view_pages.book_now')
          </label>
        </div>
              <p class="box-title txtInput">@lang('view_pages.location_details')</p>
                                                <div class="input-group mar1rm">
                                                
                                                    <input class="form-control w-100 required_for_valid" type="text"
                                                        placeholder="Pickup Location" name="pickup" id="pickup"
                                                        aria-label="Username" aria-describedby="basic-addon1">
                                                  
                                                </div>
                                                <div class="text-left">
                                                     <p class="box-title txtInput">@lang('view_pages.start_date')</p>
                                                <input class="form-control datetimepicker required_for_valid"
                                                    name="date" id="datepicker" type="text" required placeholder="d/m/y"
                                                    data-options='{"disableMobile":true}' />
                                            </div>
                                            <div class="text-left">
                                                <p class="box-title txtInput"> @lang('view_pages.start_time')</p>
                                                <input class="form-control datetimepicker required_for_valid"
                                                    name="time" id="timepicker" type="text" required placeholder="H:i"
                                                    data-options='{"enableTime":true,"noCalendar":true,"dateFormat":"H:i","disableMobile":true}' />
                                            </div>
                                                <p class="box-title txtInput">@lang('view_pages.payment_method')</p>
                                                <div class="text-left chq-radio">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" id="cash" type="radio" name="payment_opt" value="1">
                                                    <label class="form-check-label book" for="cash">
                                                        &nbsp; @lang('view_pages.cash')
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-3">
                                        <button type="button"
                                            class="btn btn-primary btn-md turned-button form-submit mr-auto appbtn"
                                            style="float: right">
                                           @lang('view_pages.book_rental_cabs)
                                        </button>
                                    </div>
            </div>
            <div class="tab-pane" id="outstation" role="tabpanel">
       <div class="radio_book">
          <input class="form-check-input" type="radio" name="outstationbook" id="outstationbooklater" value="outstationbooklater" >
          <label class="form-check-label" for="outstationbooklater">
            @lang('view_pages.book_later')
          </label>
          <input class="form-check-input" type="radio" name="outstationbook" id="outstationbooknow" value="outstationbooknow" >
          <label class="form-check-label" for="outstationbooknow"> @lang('view_pages.book_now')
          </label>
        </div>
            
              <p class="box-title txtInput">@lang('view_pages.location_details')</p>
                                                <div class="input-group mar1rm">
                                                
                                                    <input class="form-control w-100 required_for_valid" type="text"
                                                        placeholder="Pickup Location" name="pickup" id="pickup"
                                                        aria-label="Username" aria-describedby="basic-addon1">
                                                  
                                                </div>
                                                <div class="input-group mar1rm">
                                                    <input class="form-control w-100 required_for_valid" type="text"
                                                        placeholder="Drop Location" name="drop" id="drop"
                                                        aria-label="Username" aria-describedby="basic-addon1">
                                                  
                                                </div>
                                                <p class="box-title txtInput">@lang('view_pages.payment_method')</p>
                                                <div class="text-left chq-radio">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" id="cash" type="radio" name="payment_opt" value="1">
                                                    <label class="form-check-label book" for="cash">
                                                        &nbsp; @lang('view_pages.cash')
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-3">
                                        <button type="button"
                                            class="btn btn-primary btn-md turned-button form-submit mr-auto appbtn"
                                            style="float: right">
                                            @lang('view_pages.book_outstation_cabs')
                                        </button>
                                    </div>
            </div>
           
          </div>
        </div>
      </div>
    </div>
</div>
<div class="row">
                                                
                                        </div>
</div>
  </div>
</div>
</section>

@endsection
