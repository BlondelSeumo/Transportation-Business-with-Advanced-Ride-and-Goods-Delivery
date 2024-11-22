@extends('dispatch-new.layout')

@section('dispatch-content')
<style>

:root {
  --primary: {{ $navs -> value }};
  --primary-hover: {{ $side -> value }};
}
html{
    background:white;
}
body {
    background-attachment: fixed;
    background:white;
}
.main {
    background-attachment: fixed;
    background-repeat: no-repeat;
    padding-bottom: 0rem;
    padding-top: 0rem;
}
html body {
    -webkit-font-smoothing: antialiased;
    overflow-x: auto;
    padding-left: 0rem;
    padding-right: 0rem;
    padding-top: 0rem;
}


/* payments */
.select-form{
  position: relative;
    width: 100%;
    margin-bottom: 18px;
}

.select-checkbox-group {
  display: flex;
  align-items: center;
  position: relative;
}
.select-checkbox-btn {
  margin-right: 15px;
  margin-bottom: 15px;
}
.select-checkbox-btn-wrapper {
  display: flex;
  align-items: center;
  justify-content: center;
  width: fit-content;
  position: relative;
}
.select-checkbox-btn-input {
  clip: rect(0 0 0 0);
  -webkit-clip-path: inset(100%);
  clip-path: inset(100%);
  height: 1px;
  overflow: hidden;
  position: absolute;
  white-space: nowrap;
  width: 1px;
}
.select-checkbox-btn-input:checked + .select-checkbox-btn-content {
  border-color: var(--primary);
  color: var(--primary);
}
.select-checkbox-btn-input:checked + .select-checkbox-btn-content:before {
  transform: scale(1);
  opacity: 1;
  background-color: var(--primary);
  border-color: var(--primary);
}
.select-checkbox-btn-input:checked
  + .select-checkbox-btn-content
  .select-checkbox-btn-icon,
.select-checkbox-btn-input:checked
  + .select-checkbox-btn-content
  .select-checkbox-btn-label {
  color: var(--primary);
}
.select-checkbox-btn-input:focus + .select-checkbox-btn-content {
  border-color: var(--primary);
}
.select-checkbox-btn-input:focus + .select-checkbox-btn-content:before {
  transform: scale(1);
  opacity: 1;
}

.select-checkbox-btn-content {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  width: 140px;
  min-height: 140px;
  border-radius: 10px;
  border: 0.1rem solid #dfe2e6;
  background-color: #fff;
  transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s,
    -webkit-box-shadow ease-in-out 0.15s;
  cursor: pointer;
  position: relative;
  user-select: none;
  appearance: none;
}
.select-checkbox-btn-content:before {
  content: "";
  position: absolute;
  width: 22px;
  height: 22px;
  border: 0.1rem solid #bbc1e1;
  background-color: #fff;
  border-radius: 9999px;
  top: 5px;
  left: 5px;
  opacity: 0;
  transform: scale(0);
  transition: 0.25s ease;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='192' height='192' fill='%23FFFFFF' viewBox='0 0 256 256'%3E%3Crect width='256' height='256' fill='none'%3E%3C/rect%3E%3Cpolyline points='216 72.005 104 184 48 128.005' fill='none' stroke='%23FFFFFF' stroke-linecap='round' stroke-linejoin='round' stroke-width='32'%3E%3C/polyline%3E%3C/svg%3E");
  background-size: 12px;
  background-repeat: no-repeat;
  background-position: 50% 50%;
  display: flex;
  align-items: center;
  justify-content: center;
}
.select-checkbox-btn-content:hover {
  border-color: var(--primary);
}
.select-checkbox-btn-content:hover:before {
  transform: scale(1);
  opacity: 1;
}

.select-checkbox-btn-icon {
  transition: 0.375s ease;
  color: #3c3c3cc7;
}
.select-checkbox-btn-icon svg {
  width: 50px;
  height: 50px;
}

.select-checkbox-btn-label {
  color: #3c3c3cc7;
  transition: 0.375s ease;
  text-align: center;
}
/* end */

#map {
    height: 400px;
    width:100%;
    left: 10px;
    }

.map_icons li a i {
    font-size: 24px;
    color: white;
    padding: 10px;
    margin: 5px;
    display: none;
}

@import url("https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap");

html {
  font-size: 62.5%;
}

.hide-mobile {
  display: none;
}

body {
  margin: 0;
  background-color: white;
  font-family: "Nunito", sans-serif;
}

a {
  text-decoration: none;
}

ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
}

header {
  background-color: #dbe1e8;
  padding: 2.5em;
  border-radius: 1rem;
}
.wrapper {
    max-width: 1200px;
    margin: 0 auto;
}

header a.logo {
  font-size: 2.2rem;
  font-weight: bold;
  color: #0460bc;
}

.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

nav {
  position: fixed;
  right: 0;
  top: 0;
  height: 100vh;
  width: 45%;
  z-index: 2;
  background-color: #fff;
  transform: translateX(100%);
  transition: translateX .5s ease-in-out;
}

.toggle-menu {
  transform: translateX(0);
}

ul {
    display: flex;
    flex-direction: column;
    align-items: center;
    /* gap: 20em; */
}

.close {
  cursor: pointer;
    display: block;
    margin: 4em auto;
}

nav ul li a {
  font-size: 1.8rem;
  color: #000;
}

ul li.active>a {
    font-weight: bold;
    color:#7F00FF;
}

ul li a:hover {
    color: #0460BC;
}

.btn {
  display: flex;
  gap: 2.2em;
}

button {
  border: none;
  outline: none;
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: #c3ccd7;
  padding: 0.4em 0.8em;
  cursor: pointer;
  gap: 0.4em;
  border-radius: 0.4em;
  color: #000;
  font-size: 1.8rem;
}

button p {
  margin: 0;
}

button:hover {
  color: #fff;
  background-color: #0460bc;
}

span {
    width: 450px;
    height: 35px;
    background-color: #DBE1E8;
    margin-top: 9.7em;
    margin-left: 12.2em;
    border-radius: 4.5em;
}

.spTwo {
    width: 300px;
    margin-top: 2.4em;
} 

@media (min-width: 700px) {
  .hamburger, .close {
    display: none;
  }
  
  .hide-mobile {
    display: block;
  }
  
  nav {
    position: unset;
    height: auto;
    background: none;
    width: auto;
    transform: translateX(0);
  }
  ul {
    flex-direction: row;
    gap: 20em;
  }
  
  ul li.active {
    font-weight: bold;
    border-bottom: 2px solid #7F00FF;
  }
  ul li a.active {
    color: #7F00FF;
  }
}
.nav-pills .nav-link.active, .nav-pills .show>.nav-link {
    background-color: #7F00FF;
    color: #fff;
}




/* new timeline */
.ps-timeline-sec {
	 position: relative;
	 background: #fff;
}
 .ps-timeline-sec .container {
	 position: relative;
}
 @media screen and (max-width: 767px) {
	 .ps-timeline-sec .container ol:before {
		 background: #7F00FF;
		 content: ""; 
		 width: 10px;
		 height: 10px;
		 border-radius: 100%;
		 position: absolute;
		 top: 130px !important;
		 left: 36px !important;
	}
	 .ps-timeline-sec .container ol:after {
		 background: #7F00FF;
		 content: "";
		 width: 10px;
		 height: 10px;
		 border-radius: 100%;
		 position: absolute;
		 top: inherit !important;
		 left: 36px;
	}
	 .ps-timeline-sec .container ol.ps-timeline {
		 margin: 130px 0 !important;
		 border-left: 2px solid #7F00FF;
		 padding-left: 0 !important;
		 padding-top: 120px !important;
		 border-top: 0 !important;
		 margin-left: 25px !important;
	}
	 .ps-timeline-sec .container ol.ps-timeline li {
		 height: 220px;
		 float: none !important;
		 width: inherit !important;
	}
	 .ps-timeline-sec .container ol.ps-timeline li:nth-child(2) .img-handler-bot img {
		 width: 70px;
	}
	 .ps-timeline-sec .container ol.ps-timeline li:last-child {
		 margin: 0;
		 bottom: 0 !important;
		 height: 120px;
	}
	 .ps-timeline-sec .container ol.ps-timeline li:last-child .img-handler-bot {
		 bottom: 40px !important;
		 width: 40% !important;
		 margin-left: 25px !important;
		 margin-top: 0 !important;
	}
	 .ps-timeline-sec .container ol.ps-timeline li:last-child .img-handler-bot img {
		 width: 100%;
	}
	 .ps-timeline-sec .container ol.ps-timeline li:last-child .ps-top {
		 margin-bottom: 0 !important;
		 top: 20px;
		 width: 50% !important;
	}
	 .ps-timeline-sec .container ol.ps-timeline li span {
		 left: 0 !important;
	}
	 .ps-timeline-sec .container ol.ps-timeline li span.ps-sp-top:before {
		 content: none !important;
	}
	 .ps-timeline-sec .container ol.ps-timeline li span.ps-sp-top:after {
		 content: none !important;
	}
	 .ps-timeline-sec .container ol.ps-timeline li span.ps-sp-bot:before {
		 content: none !important;
	}
	 .ps-timeline-sec .container ol.ps-timeline li span.ps-sp-bot:after {
		 content: none !important;
	}
	 .ps-timeline-sec .container ol.ps-timeline li .img-handler-top {
		 position: absolute !important;
		 bottom: 150px !important;
		 width: 30% !important;
		 float: left !important;
		 margin-left: 35px !important;
		 margin-bottom: 0 !important;
	}
	 .ps-timeline-sec .container ol.ps-timeline li .img-handler-top img {
		 margin: 0 auto !important;
		 width: 100% !important;
	}
	 .ps-timeline-sec .container ol.ps-timeline li .img-handler-bot {
		 position: absolute !important;
		 bottom: 115px !important;
		 width: 30% !important;
		 float: left !important;
		 margin-left: 35px !important;
		 margin-bottom: 0 !important;
	}
	 .ps-timeline-sec .container ol.ps-timeline li p {
		 text-align: left !important;
		 width: 100% !important;
		 margin: 0 auto !important;
		 margin-top: 0px !important;
	}
	 .ps-timeline-sec .container ol.ps-timeline li .ps-top {
		 width: 60% !important;
		 float: right !important;
		 right: 0;
		 top: -40px;
	}
	 .ps-timeline-sec .container ol.ps-timeline li .ps-bot {
		 width: 60% !important;
		 float: right !important;
		 right: 0;
		 top: -40px;
	}
}
 .ps-timeline-sec .container ol:before {
	 /* background: #7F00FF; */
	 content: "";
	 width: 10px;
	 height: 10px;
	 border-radius: 100%;
	 position: absolute;
	 left: 8px;
	 top: 49.5%;
}
 .ps-timeline-sec .container ol:after {
	 /* background: #7F00FF; */
	 content: "";
	 width: 10px;
	 height: 10px;
	 border-radius: 100%;
	 position: absolute;
	 right: 8px;
	 top: 49.5%;
}
 .ps-timeline-sec .container ol.ps-timeline {
	 margin: 200px 0;
	 padding: 0;
	 border-top: 2px solid #7F00FF;
	 list-style: none;
}
 .ps-timeline-sec .container ol.ps-timeline li {
	 float: left;
	 width: 20%;
	 padding-top: 30px;
	 position: relative;
}
 .ps-timeline-sec .container ol.ps-timeline li span {
	 width: 50px;
	 height: 50px;
	 margin-left: -25px;
	 background: #fff;
	 border: 4px solid #7F00FF;
	 border-radius: 50%;
	 box-shadow: 0 0 0 0px #fff;
	 text-align: center;
	 line-height: 50px -10;
	 color: #df8625;
	 font-size: 2em;
	 font-style: normal;
	 position: absolute;
	 top: -200px;
	 left: 50%;
}
 .ps-timeline-sec .container ol.ps-timeline li span.ps-sp-top:before {
	 content: '';
	 color: #7F00FF;
	 width: 2px;
	 height: 50px;
	 background: #7F00FF;
	 position: absolute;
	 top: -50px;
	 left: 50%;
}
 .ps-timeline-sec .container ol.ps-timeline li span.ps-sp-top:after {
	 content: '';
	 color: #7F00FF;
	 width: 8px;
	 height: 8px;
	 background: #7F00FF;
	 position: absolute;
	 bottom: 90px;
	 left: 44%;
	 border-radius: 100%;
}
 .ps-timeline-sec .container ol.ps-timeline li span.ps-sp-bot:before {
	 content: '';
	 color: #7F00FF;
	 width: 2px;
	 height: 50px;
	 background: #7F00FF;
	 position: absolute;
	 bottom: -50px;
	 left: 50%;
}
 .ps-timeline-sec .container ol.ps-timeline li span.ps-sp-bot:after {
	 content: '';
	 color: #7F00FF;
	 width: 8px;
	 height: 8px;
	 background: #7F00FF;
	 position: absolute;
	 top: 90px;
	 left: 44%;
	 border-radius: 100%;
}
 .ps-timeline-sec .container ol.ps-timeline li .img-handler-top {
	 position: absolute;
	 bottom: 0;
	 margin-bottom: 130px;
	 width: 100%;
}
 .ps-timeline-sec .container ol.ps-timeline li .img-handler-top img {
	 display: table;
	 margin: 0 auto;
}
 .ps-timeline-sec .container ol.ps-timeline li .img-handler-bot {
	 position: absolute;
	 margin-top: 60px;
	 width: 100%;
}
 .ps-timeline-sec .container ol.ps-timeline li .img-handler-bot img {
	 display: table;
	 margin: 0 auto;
}
 .ps-timeline-sec .container ol.ps-timeline li p {
	 text-align: center;
	 width: 80%;
	 margin: 0 auto;
}
 .ps-timeline-sec .container ol.ps-timeline li .ps-top {
	 position: absolute;
	 bottom: 0;
	 margin-bottom: 70px;
   margin-left:60px;
}
 .ps-timeline-sec .container ol.ps-timeline li .ps-bot {
	 position: absolute;
	 margin-top: 0px;
   margin-left:70px;
}
.dot{
  width:25px;
  height:25px;border-radius:50%;
  background-color: #7F00FF;
  display: inline-block;
  margin:8px;
} 
.tb{
  font-size:16px;
}
.accordion-row > td {
      border: none; /* Remove border */
      padding: 0; /* Remove padding */
    }
	
	.accordion-icon:before{
	transform: rotate(0deg);
	transition: transform 0.3s ease; /* Add transition effect */
	}
	
	.rotate:before {
    transform: rotate(180deg);
    transition: transform 0.3s ease; /* Add transition effect */
}
</style>



<header class="box" style="box-shadow: 0 30px 40px #0000000b;">
 <div class="wrapper navbar">
    
   
  <nav>
    <svg class="close" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M17.59 5L12 10.59L6.41 5L5 6.41L10.59 12L5 17.59L6.41 19L12 13.41L17.59 19L19 17.59L13.41 12L19 6.41L17.59 5Z" fill="black"/>
</svg>
    <ul>
      <li class="d-flex"><i data-feather="user"></i><a href="{{ url('/dispatch-new') }}">Driver List</a></li>
      <li class="d-flex"><i data-feather="play"></i><a href="{{ url('/book-ride') }}">Book Ride</a></li>
      <li class="active d-flex"><i data-feather="file-text"></i><a href="{{ url('/requests-list') }}">Request List</a></li>
      <li class="d-flex"><i data-feather="truck" class="me-2"></i><a href="{{ url('/ongoing-trip') }}">Ongoing Trip</a></li>
    </ul>
  </nav>
  
  <div class="btn">
  <div class="intro-x dropdown w-16 h-16">
      <div class="dropdown-toggle w-24 h-24 rounded-pill overflow-hidden shadow-lg image-fit zoom-in" role="button" aria-expanded="false" data-bs-toggle="dropdown">
          <img alt="" src="{{ asset('assets/img/1.png') }}">
      </div>
  </div>
  <svg class="hamburger" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M15 22.5H3.75V20H15V22.5ZM26.25 16.25H3.75V13.75H26.25V16.25ZM26.25 10H15V7.5H26.25V10Z" fill="black"/>
  </svg>
  </div>
</div>
</header>

<div class="g-col-12 mt-8 p-10">
    <div class="intro-y d-flex align-items-center h-10 mb-10">
        <h2 class=" me-5" style="font-size:25px;font-weight:800;color:#7F00FF;">
           <i class="far fa-question-circle" style="color:black;"></i> Request List
        </h2>
    </div>
    <div class="grid columns-12 gap-6 mt-5">
        <div class="g-col-12 g-col-sm-6 g-col-xl-3 intro-y">
            <div class="zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(127, 0, 255, 0.15);border-radius:15px;">
                <div class="box p-5" style="border-radius:15px;">
                    <div class="text-center mt-6" style="font-size:25px;font-weight:800;">COMPLETED</div>
                    <div class="text-end mt-1 p-5" style="font-size:25px;font-weight:800;color:#7F00FF;">10</div>
                </div>
            </div>
        </div>
        <div class="g-col-12 g-col-sm-6 g-col-xl-3 intro-y">
            <div class="zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(127, 0, 255, 0.15);border-radius:15px;">
                <div class="box p-5" style="border-radius:15px;">
                    <div class="text-center mt-6" style="font-size:25px;font-weight:800;">USER CANCELLED</div>
                    <div class="text-end text-theme-6 mt-1 p-5" style="font-size:25px;font-weight:800;color:#7F00FF;">4</div>
                </div>
            </div>
        </div>
        <div class="g-col-12 g-col-sm-6 g-col-xl-3 intro-y">
            <div class="zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(127, 0, 255, 0.15);border-radius:15px;">
                <div class="box p-5" style="border-radius:15px;">
                    <div class="text-center mt-6" style="font-size:25px;font-weight:800;">DRIVER CANCELLED</div>
                    <div class="text-end text-theme-6 mt-1 p-5" style="font-size:25px;font-weight:800;color:#7F00FF;">4</div>
                </div>
            </div>
        </div>
        <div class="g-col-12 g-col-sm-6 g-col-xl-3 intro-y">
            <div class="zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(127, 0, 255, 0.15);border-radius:15px;">
                <div class="box p-5" style="border-radius:15px;">
                    <div class="text-center mt-6" style="font-size:25px;font-weight:800;">UPCOMING</div>
                    <div class="text-end text-theme-10 mt-1 p-5" style="font-size:25px;font-weight:800;color:#7F00FF;">4</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="g-col-12 g-col-lg-4 mt-10 p-10">
      <div class="intro-y pe-1">
          <div class="box p-2" style="background:#EAF0FB;">
              <ul class="pos__tabs nav nav-pills rounded-2" role="tablist">
                  <li id="all-tab" class="nav-item flex-1" role="presentation">
                      <button class="nav-link w-full pt-2 pb-2.5 active" data-bs-toggle="pill" data-bs-target="#all" type="button" role="tab" aria-controls="all-tab" aria-selected="true">All</button>
                  </li>
                  <li id="completed-tab" class="nav-item flex-1" role="presentation">
                      <button class="nav-link w-full pt-2 pb-2.5" data-bs-toggle="pill" data-bs-target="#completed" type="button" role="tab" aria-controls="completed-tab" aria-selected="false">Completed</button>
                  </li>
                  <li id="cancelled-tab" class="nav-item flex-1" role="presentation">
                      <button class="nav-link w-full pt-2 pb-2.5" data-bs-toggle="pill" data-bs-target="#cancelled" type="button" role="tab" aria-controls="cancelled-tab" aria-selected="false">Cancelled</button>
                  </li>
                  <li id="upcoming-tab" class="nav-item flex-1" role="presentation">
                      <button class="nav-link w-full pt-2 pb-2.5" data-bs-toggle="pill" data-bs-target="#upcoming" type="button" role="tab" aria-controls="upcoming-tab" aria-selected="false">Upcoming</button>
                  </li>
              </ul>
          </div>
      </div>

<div class="tab-content mt-5">
 <!-- all drivers tab -->
          <div class="tab-pane fade active show" id="all" role="tabpanel" aria-labelledby="all-tab">
          <div class="grid columns-12 gap-5 mt-5">
                    <!-- BEGIN: Driver Side Menu -->
                    <div class="g-col-12 g-col-xl-12 g-col-xxl-6">
                      <div class="box p-5 intro-y mt-5" style="background:#FBFBFB;box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                            <div class="d-flex flex-column flex-lg-row pb-5">
                                <div class="d-flex px-5 align-items-start justify-content-center justify-content-lg-start">
                                    <div class="d-flex ms-5">
                                        <div class="px-4" style="font-size:25px;font-weight:800;border-right:3px solid #7F00FF;">Req_00933</div>
                                    </div>
                                </div>
                                <div class="mt-6 mt-lg-0 flex-1 px-5 border-start border-end border-gray-200 border-top border-top-lg-0 pt-5 pt-lg-0">
                                    <div class="fw-medium text-center text-lg-start " style="font-size:25px;font-weight:800;color:#7F00FF;"> <i class="fas fa-business-time me-2" style="color:#8BB7F0;"></i>27 FEB ,03.30 PM</div>
                                </div>
                            </div>
                            <div class=" intro-y">
                                <div class="pos intro-y grid columns-12 gap-5 mt-5">
                                    <!-- BEGIN: Left portion -->
                                    <div class="intro-y g-col-12 g-col-lg-5 ms-5">
                                        <div class="grid grid-cols-12 gap-5 mt-5">
                                            <div class="g-col-12 g-col-sm-6 g-col-xxl-3 box p-5 cursor-pointer zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                                                <div class="text-theme-10" style="font-size:20px;font-weight:800;">Driver Details</div>
                                                <div class="text-gray-600" style="font-size:20px;font-weight:800;">Sudarsan</div>
                                                <div class="mt-6 mt-lg-0 pt-5">
                                                    <div class="fw-medium text-center text-lg-start " style="font-size:25px;font-weight:800;">4 <i class="fa fa-star" style="color:yellow;"></i></div>
                                                </div>
                                            </div>
                                            <div class="g-col-12 g-col-sm-6 g-col-xxl-3 box p-5 cursor-pointer zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                                                <div class="text-theme-10" style="font-size:20px;font-weight:800;">Customer Details</div>
                                                <div class="text-gray-600" style="font-size:20px;font-weight:800;">Sudarsan</div>
                                                <div class="mt-6 mt-lg-0 pt-5">
                                                    <div class="fw-medium text-center text-lg-start " style="font-size:25px;font-weight:800;">4 <i class="fa fa-star" style="color:yellow;"></i></div>
                                                </div>
                                            </div>
                                            <div class="g-col-12 g-col-sm-12 g-col-xxl-3 box p-10 cursor-pointer zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                                                <div class="mt-5 d-flex align-items-center" style="font-size:clamp(12px, 2Vw, 24px);font-weight:800;"><i data-feather="disc" class="me-5" style="font-size:24px;font-weight:400;color:#59E304;"></i>Home,saravanampatti,Coimbatore-35</div>
                                                <div class="mt-5 d-flex align-items-center" style="font-size:clamp(12px, 2Vw, 24px);font-weight:800;"><i data-feather="map-pin" class="me-5" style="font-size:24px;font-weight:800;color:red;"></i>Drop,Gandhipuram,Coimbatore-05</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END: Left portion -->
                                    <!-- BEGIN: Right -->
  <div class="g-col-12 g-col-lg-7 box" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
    <section class="ps-timeline-sec">
        <div class="container">
            <ol class="ps-timeline">
                <li>
                    <div class="img-handler-top">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-bot">
                        <h1 style="font-size:20px;color:#7F00FF;">Trip Request</h1>
                    </div>
                    <span class="ps-sp-top"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-bot">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-top">
                      <h1 style="font-size:20px;color:#7F00FF;">Trip Accepted</h1>
                    </div>
                    <span class="ps-sp-bot"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-top">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-bot">
                      <h1 style="font-size:20px;color:#7F00FF;">Driver Arrived</h1>
                    </div>
                    <span class="ps-sp-top"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-bot">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-top">
                      <h1 style="font-size:20px;color:#7F00FF;">Trip Started</h1>
                    </div>
                    <span class="ps-sp-bot"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-top">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-bot">
                      <h1 style="font-size:20px;color:#7F00FF;">Trip Ended</h1>
                    </div>
                    <span class="ps-sp-top"><strong class="dot"></strong></span>
                </li>
            </ol>
        </div>
    </section>
  </div>
  <!-- END: Right -->
            </div>
        </div>
  </div>
</div>
<!-- END: Home Side card Menu -->
</div>
</div>

 <!-- online drivers tab -->
          <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
          <div class="grid columns-12 gap-5 mt-5">
                    <!-- BEGIN: Driver Side Menu -->
                    <div class="g-col-12 g-col-xl-12 g-col-xxl-6">
                      <div class="box p-5 intro-y mt-5" style="background:#FBFBFB;box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                            <div class="d-flex flex-column flex-lg-row pb-5">
                                <div class="d-flex px-5 align-items-start justify-content-center justify-content-lg-start">
                                    <div class="d-flex ms-5">
                                        <div class="px-4" style="font-size:25px;font-weight:800;border-right:3px solid #7F00FF;">Req_00935</div>
                                    </div>
                                </div>
                                <div class="mt-6 mt-lg-0 flex-1 px-5 border-start border-end border-gray-200 border-top border-top-lg-0 pt-5 pt-lg-0">
                                    <div class="fw-medium text-center text-lg-start " style="font-size:25px;font-weight:800;color:#7F00FF;"> <i class="fas fa-business-time me-2" style="color:#8BB7F0;"></i>27 FEB ,03.30 PM</div>
                                </div>
                            </div>
                            <div class=" intro-y">
                                <div class="pos intro-y grid columns-12 gap-5 mt-5">
                                    <!-- BEGIN: Left portion -->
                                    <div class="intro-y g-col-12 g-col-lg-5 ms-5">
                                        <div class="grid grid-cols-12 gap-5 mt-5">
                                            <div class="g-col-12 g-col-sm-6 g-col-xxl-3 box p-5 cursor-pointer zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                                                <div class="text-theme-10" style="font-size:20px;font-weight:800;">Driver Details</div>
                                                <div class="text-gray-600" style="font-size:20px;font-weight:800;">Sudarsan</div>
                                                <div class="mt-6 mt-lg-0 pt-5">
                                                    <div class="fw-medium text-center text-lg-start " style="font-size:25px;font-weight:800;">4 <i class="fa fa-star" style="color:yellow;"></i></div>
                                                </div>
                                            </div>
                                            <div class="g-col-12 g-col-sm-6 g-col-xxl-3 box p-5 cursor-pointer zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                                                <div class="text-theme-10" style="font-size:20px;font-weight:800;">Customer Details</div>
                                                <div class="text-gray-600" style="font-size:20px;font-weight:800;">Sudarsan</div>
                                                <div class="mt-6 mt-lg-0 pt-5">
                                                    <div class="fw-medium text-center text-lg-start " style="font-size:25px;font-weight:800;">4 <i class="fa fa-star" style="color:yellow;"></i></div>
                                                </div>
                                            </div>
                                            <div class="g-col-12 g-col-sm-12 g-col-xxl-3 box p-10 cursor-pointer zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                                                <div class="mt-5 d-flex align-items-center" style="font-size:clamp(12px, 2Vw, 24px);font-weight:800;"><i data-feather="disc" class="me-5" style="font-size:24px;font-weight:400;color:#59E304;"></i>Home,saravanampatti,Coimbatore-35</div>
                                                <div class="mt-5 d-flex align-items-center" style="font-size:clamp(12px, 2Vw, 24px);font-weight:800;"><i data-feather="map-pin" class="me-5" style="font-size:24px;font-weight:800;color:red;"></i>Drop,Gandhipuram,Coimbatore-05</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END: Left portion -->
                                    <!-- BEGIN: Right -->
  <div class="g-col-12 g-col-lg-7 box" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
    <section class="ps-timeline-sec">
        <div class="container">
            <ol class="ps-timeline">
                <li>
                    <div class="img-handler-top">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-bot">
                        <h1 style="font-size:20px;color:#7F00FF;">Trip Request</h1>
                    </div>
                    <span class="ps-sp-top"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-bot">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-top">
                      <h1 style="font-size:20px;color:#7F00FF;">Trip Accepted</h1>
                    </div>
                    <span class="ps-sp-bot"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-top">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-bot">
                      <h1 style="font-size:20px;color:#7F00FF;">Driver Arrived</h1>
                    </div>
                    <span class="ps-sp-top"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-bot">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-top">
                      <h1 style="font-size:20px;color:#7F00FF;">Trip Started</h1>
                    </div>
                    <span class="ps-sp-bot"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-top">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-bot">
                      <h1 style="font-size:20px;color:#7F00FF;">Trip Ended</h1>
                    </div>
                    <span class="ps-sp-top"><strong class="dot"></strong></span>
                </li>
            </ol>
        </div>
    </section>
  </div>
  <!-- END: Right -->
            </div>
        </div>
  </div>
</div>
<!-- END: Home Side card Menu -->
</div>
</div>

<!-- offline drivers tab -->
          <div class="tab-pane fade" id="cancelled" role="tabpanel" aria-labelledby="cancelled-tab">
          <div class="grid columns-12 gap-5 mt-5">
                    <!-- BEGIN: Driver Side Menu -->
                    <div class="g-col-12 g-col-xl-12 g-col-xxl-6">
                      <div class="box p-5 intro-y mt-5" style="background:#FBFBFB;box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                            <div class="d-flex flex-column flex-lg-row pb-5">
                                <div class="d-flex px-5 align-items-start justify-content-center justify-content-lg-start">
                                    <div class="d-flex ms-5">
                                        <div class="px-4" style="font-size:25px;font-weight:800;border-right:3px solid #7F00FF;">Req_00938</div>
                                    </div>
                                </div>
                                <div class="mt-6 mt-lg-0 flex-1 px-5 border-start border-end border-gray-200 border-top border-top-lg-0 pt-5 pt-lg-0">
                                    <div class="fw-medium text-center text-lg-start " style="font-size:25px;font-weight:800;color:#7F00FF;"> <i class="fas fa-business-time me-2" style="color:#8BB7F0;"></i>27 FEB ,03.30 PM</div>
                                </div>
                            </div>
                            <div class=" intro-y">
                                <div class="pos intro-y grid columns-12 gap-5 mt-5">
                                    <!-- BEGIN: Left portion -->
                                    <div class="intro-y g-col-12 g-col-lg-5 ms-5">
                                        <div class="grid grid-cols-12 gap-5 mt-5">
                                            <div class="g-col-12 g-col-sm-6 g-col-xxl-3 box p-5 cursor-pointer zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                                                <div class="text-theme-10" style="font-size:20px;font-weight:800;">Driver Details</div>
                                                <div class="text-gray-600" style="font-size:20px;font-weight:800;">Sudarsan</div>
                                                <div class="mt-6 mt-lg-0 pt-5">
                                                    <div class="fw-medium text-center text-lg-start " style="font-size:25px;font-weight:800;">4 <i class="fa fa-star" style="color:yellow;"></i></div>
                                                </div>
                                            </div>
                                            <div class="g-col-12 g-col-sm-6 g-col-xxl-3 box p-5 cursor-pointer zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                                                <div class="text-theme-10" style="font-size:20px;font-weight:800;">Customer Details</div>
                                                <div class="text-gray-600" style="font-size:20px;font-weight:800;">Sudarsan</div>
                                                <div class="mt-6 mt-lg-0 pt-5">
                                                    <div class="fw-medium text-center text-lg-start " style="font-size:25px;font-weight:800;">4 <i class="fa fa-star" style="color:yellow;"></i></div>
                                                </div>
                                            </div>
                                            <div class="g-col-12 g-col-sm-12 g-col-xxl-3 box p-10 cursor-pointer zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                                                <div class="mt-5 d-flex align-items-center" style="font-size:clamp(12px, 2Vw, 24px);font-weight:800;"><i data-feather="disc" class="me-5" style="font-size:24px;font-weight:400;color:#59E304;"></i>Home,saravanampatti,Coimbatore-35</div>
                                                <div class="mt-5 d-flex align-items-center" style="font-size:clamp(12px, 2Vw, 24px);font-weight:800;"><i data-feather="map-pin" class="me-5" style="font-size:24px;font-weight:800;color:red;"></i>Drop,Gandhipuram,Coimbatore-05</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END: Left portion -->
                                    <!-- BEGIN: Right -->
  <div class="g-col-12 g-col-lg-7 box" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
    <section class="ps-timeline-sec">
        <div class="container">
            <ol class="ps-timeline">
                <li>
                    <div class="img-handler-top">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-bot">
                        <h1 style="font-size:20px;color:#7F00FF;">Trip Request</h1>
                    </div>
                    <span class="ps-sp-top"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-bot">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-top">
                      <h1 style="font-size:20px;color:#7F00FF;">Trip Accepted</h1>
                    </div>
                    <span class="ps-sp-bot"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-top">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-bot">
                      <h1 style="font-size:20px;color:#7F00FF;">Driver Arrived</h1>
                    </div>
                    <span class="ps-sp-top"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-bot">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-top">
                      <h1 style="font-size:20px;color:#7F00FF;">Trip Started</h1>
                    </div>
                    <span class="ps-sp-bot"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-top">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-bot">
                      <h1 style="font-size:20px;color:#7F00FF;">Trip Ended</h1>
                    </div>
                    <span class="ps-sp-top"><strong class="dot"></strong></span>
                </li>
            </ol>
        </div>
    </section>
  </div>
  <!-- END: Right -->
            </div>
        </div>
  </div>
</div>
<!-- END: Home Side card Menu -->
</div>
</div>

<!-- On-ride drivers tab -->
          <div class="tab-pane fade" id="upcoming" role="tabpanel" aria-labelledby="upcoming-tab">
          <div class="grid columns-12 gap-5 mt-5">
                    <!-- BEGIN: Driver Side Menu -->
                    <div class="g-col-12 g-col-xl-12 g-col-xxl-6">
                      <div class="box p-5 intro-y mt-5" style="background:#FBFBFB;box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                            <div class="d-flex flex-column flex-lg-row pb-5">
                                <div class="d-flex px-5 align-items-start justify-content-center justify-content-lg-start">
                                    <div class="d-flex ms-5">
                                        <div class="px-4" style="font-size:25px;font-weight:800;border-right:3px solid #7F00FF;">Req_00945</div>
                                    </div>
                                </div>
                                <div class="mt-6 mt-lg-0 flex-1 px-5 border-start border-end border-gray-200 border-top border-top-lg-0 pt-5 pt-lg-0">
                                    <div class="fw-medium text-center text-lg-start " style="font-size:25px;font-weight:800;color:#7F00FF;"> <i class="fas fa-business-time me-2" style="color:#8BB7F0;"></i>27 FEB ,03.30 PM</div>
                                </div>
                            </div>
                            <div class=" intro-y">
                                <div class="pos intro-y grid columns-12 gap-5 mt-5">
                                    <!-- BEGIN: Left portion -->
                                    <div class="intro-y g-col-12 g-col-lg-5 ms-5">
                                        <div class="grid grid-cols-12 gap-5 mt-5">
                                            <div class="g-col-12 g-col-sm-6 g-col-xxl-3 box p-5 cursor-pointer zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                                                <div class="text-theme-10" style="font-size:20px;font-weight:800;">Driver Details</div>
                                                <div class="text-gray-600" style="font-size:20px;font-weight:800;">Sudarsan</div>
                                                <div class="mt-6 mt-lg-0 pt-5">
                                                    <div class="fw-medium text-center text-lg-start " style="font-size:25px;font-weight:800;">4 <i class="fa fa-star" style="color:yellow;"></i></div>
                                                </div>
                                            </div>
                                            <div class="g-col-12 g-col-sm-6 g-col-xxl-3 box p-5 cursor-pointer zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                                                <div class="text-theme-10" style="font-size:20px;font-weight:800;">Customer Details</div>
                                                <div class="text-gray-600" style="font-size:20px;font-weight:800;">Sudarsan</div>
                                                <div class="mt-6 mt-lg-0 pt-5">
                                                    <div class="fw-medium text-center text-lg-start " style="font-size:25px;font-weight:800;">4 <i class="fa fa-star" style="color:yellow;"></i></div>
                                                </div>
                                            </div>
                                            <div class="g-col-12 g-col-sm-12 g-col-xxl-3 box p-10 cursor-pointer zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                                                <div class="mt-5 d-flex align-items-center" style="font-size:clamp(12px, 2Vw, 24px);font-weight:800;"><i data-feather="disc" class="me-5" style="font-size:24px;font-weight:400;color:#59E304;"></i>Home,saravanampatti,Coimbatore-35</div>
                                                <div class="mt-5 d-flex align-items-center" style="font-size:clamp(12px, 2Vw, 24px);font-weight:800;"><i data-feather="map-pin" class="me-5" style="font-size:24px;font-weight:800;color:red;"></i>Drop,Gandhipuram,Coimbatore-05</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END: Left portion -->
                                    <!-- BEGIN: Right -->
  <div class="g-col-12 g-col-lg-7 box" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
    <section class="ps-timeline-sec">
        <div class="container">
            <ol class="ps-timeline">
                <li>
                    <div class="img-handler-top">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-bot">
                        <h1 style="font-size:20px;color:#7F00FF;">Trip Request</h1>
                    </div>
                    <span class="ps-sp-top"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-bot">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-top">
                      <h1 style="font-size:20px;color:#7F00FF;">Trip Accepted</h1>
                    </div>
                    <span class="ps-sp-bot"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-top">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-bot">
                      <h1 style="font-size:20px;color:#7F00FF;">Driver Arrived</h1>
                    </div>
                    <span class="ps-sp-top"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-bot">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-top">
                      <h1 style="font-size:20px;color:#7F00FF;">Trip Started</h1>
                    </div>
                    <span class="ps-sp-bot"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-top">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-bot">
                      <h1 style="font-size:20px;color:#7F00FF;">Trip Ended</h1>
                    </div>
                    <span class="ps-sp-top"><strong class="dot"></strong></span>
                </li>
            </ol>
        </div>
    </section>
  </div>
  <!-- END: Right -->
            </div>
        </div>
  </div>
</div>
<!-- END: Home Side card Menu -->
</div>
</div>
<!-- end  -->
          </div>
      </div>

    <!-- <section class="ps-timeline-sec">
        <div class="container">
            <ol class="ps-timeline">
                <li>
                    <div class="img-handler-top">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-bot">
                        <h1 style="font-size:20px;color:#7F00FF;">Trip Request</h1>
                    </div>
                    <span class="ps-sp-top"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-bot">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-top">
                      <h1 style="font-size:20px;color:#7F00FF;">Trip Accepted</h1>
                    </div>
                    <span class="ps-sp-bot"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-top">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-bot">
                      <h1 style="font-size:20px;color:#7F00FF;">Driver Arrived</h1>
                    </div>
                    <span class="ps-sp-top"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-bot">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-top">
                      <h1 style="font-size:20px;color:#7F00FF;">Trip Started</h1>
                    </div>
                    <span class="ps-sp-bot"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-top">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-bot">
                      <h1 style="font-size:20px;color:#7F00FF;">Trip Ended</h1>
                    </div>
                    <span class="ps-sp-top"><strong class="dot"></strong></span>
                </li>
            </ol>
        </div>
    </section> -->
    <details>
  <summary><div class="d-flex flex-column flex-lg-row pb-5">
                                <div class="d-flex px-5 align-items-start justify-content-center justify-content-lg-start">
                                    <div class="d-flex ms-5">
                                        <div class="px-4" style="font-size:25px;font-weight:800;border-right:3px solid #7F00FF;">Req_00933</div>
                                    </div>
                                </div>
                                <div class="mt-6 mt-lg-0 flex-1 px-5 border-start border-end border-gray-200 border-top border-top-lg-0 pt-5 pt-lg-0">
                                    <div class="fw-medium text-center text-lg-start " style="font-size:25px;font-weight:800;color:#7F00FF;"> <i class="fas fa-business-time me-2" style="color:#8BB7F0;"></i>27 FEB ,03.30 PM</div>
                                </div>
                            </div>
                          </summary>
  <p>
  <div class="grid columns-12 gap-5 mt-5">
                    <!-- BEGIN: Driver Side Menu -->
                    <div class="g-col-12 g-col-xl-12 g-col-xxl-6">
                      <div class="box p-5 intro-y mt-5" style="background:#FBFBFB;box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                            <div class=" intro-y">
                                <div class="pos intro-y grid columns-12 gap-5 mt-5">
                                    <!-- BEGIN: Left portion -->
                                    <div class="intro-y g-col-12 g-col-lg-5 ms-5">
                                        <div class="grid grid-cols-12 gap-5 mt-5">
                                            <div class="g-col-12 g-col-sm-6 g-col-xxl-3 box p-5 cursor-pointer zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                                                <div class="text-theme-10" style="font-size:20px;font-weight:800;">Driver Details</div>
                                                <div class="text-gray-600" style="font-size:20px;font-weight:800;">Sudarsan</div>
                                                <div class="mt-6 mt-lg-0 pt-5">
                                                    <div class="fw-medium text-center text-lg-start " style="font-size:25px;font-weight:800;">4 <i class="fa fa-star" style="color:yellow;"></i></div>
                                                </div>
                                            </div>
                                            <div class="g-col-12 g-col-sm-6 g-col-xxl-3 box p-5 cursor-pointer zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                                                <div class="text-theme-10" style="font-size:20px;font-weight:800;">Customer Details</div>
                                                <div class="text-gray-600" style="font-size:20px;font-weight:800;">Sudarsan</div>
                                                <div class="mt-6 mt-lg-0 pt-5">
                                                    <div class="fw-medium text-center text-lg-start " style="font-size:25px;font-weight:800;">4 <i class="fa fa-star" style="color:yellow;"></i></div>
                                                </div>
                                            </div>
                                            <div class="g-col-12 g-col-sm-12 g-col-xxl-3 box p-10 cursor-pointer zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                                                <div class="mt-5 d-flex align-items-center" style="font-size:clamp(12px, 2Vw, 24px);font-weight:800;"><i data-feather="disc" class="me-5" style="font-size:24px;font-weight:400;color:#59E304;"></i>Home,saravanampatti,Coimbatore-35</div>
                                                <div class="mt-5 d-flex align-items-center" style="font-size:clamp(12px, 2Vw, 24px);font-weight:800;"><i data-feather="map-pin" class="me-5" style="font-size:24px;font-weight:800;color:red;"></i>Drop,Gandhipuram,Coimbatore-05</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END: Left portion -->
                                    <!-- BEGIN: Right -->
  <div class="g-col-12 g-col-lg-7 box" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
    <section class="ps-timeline-sec">
        <div class="container">
            <ol class="ps-timeline">
                <li>
                    <div class="img-handler-top">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-bot">
                        <h1 style="font-size:20px;color:#7F00FF;">Trip Request</h1>
                    </div>
                    <span class="ps-sp-top"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-bot">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-top">
                      <h1 style="font-size:20px;color:#7F00FF;">Trip Accepted</h1>
                    </div>
                    <span class="ps-sp-bot"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-top">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-bot">
                      <h1 style="font-size:20px;color:#7F00FF;">Driver Arrived</h1>
                    </div>
                    <span class="ps-sp-top"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-bot">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-top">
                      <h1 style="font-size:20px;color:#7F00FF;">Trip Started</h1>
                    </div>
                    <span class="ps-sp-bot"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-top">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-bot">
                      <h1 style="font-size:20px;color:#7F00FF;">Trip Ended</h1>
                    </div>
                    <span class="ps-sp-top"><strong class="dot"></strong></span>
                </li>
            </ol>
        </div>
    </section>
  </div>
  <!-- END: Right -->
            </div>
        </div>

  </p>
</details>
 
<div class="overflow-x-auto">
<!-- <div class="container mt-5"> -->
  <table class="table table-striped caption-top tb">
    <caption>List of users</caption>
    <thead>
      <tr>
        <th scope="col">Request Id</th>
        <th scope="col">Date</th>
        <th scope="col">Pickup Location</th>
        <th scope="col">Trip Status</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">1</th>
        <td>Mark</td>
        <td>Otto</td>
        <td>@mdo</td>
        <td>
          <button class="btn btn-primary accordion-btn" type="button" data-bs-toggle="collapse" data-bs-target="#accordionExample1" aria-expanded="false" aria-controls="accordionExample1">
         <i class="fa fa-chevron-down"></i>
    </button>
        </td>
      </tr>
      <tr class="accordion-row">
        <td colspan="5">
          <div class="collapse" id="accordionExample1">
            <div class="card card-body">
            <div class="grid columns-12 gap-5 mt-5">
                    <!-- BEGIN: Driver Side Menu -->
                    <div class="g-col-12 g-col-xl-12 g-col-xxl-6">
                      <div class="box p-5 intro-y mt-5" style="background:#FBFBFB;box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                            <div class=" intro-y">
                                <div class="pos intro-y grid columns-12 gap-5 mt-5">
                                    <!-- BEGIN: Left portion -->
                                    <div class="intro-y g-col-12 g-col-lg-5 ms-5">
                                        <div class="grid grid-cols-12 gap-5 mt-5">
                                            <div class="g-col-12 g-col-sm-6 g-col-xxl-3 box p-5 cursor-pointer zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                                                <div class="text-theme-10" style="font-size:20px;font-weight:800;">Driver Details</div>
                                                <div class="text-gray-600" style="font-size:20px;font-weight:800;">Sudarsan</div>
                                                <div class="mt-6 mt-lg-0 pt-5">
                                                    <div class="fw-medium text-center text-lg-start " style="font-size:25px;font-weight:800;">4 <i class="fa fa-star" style="color:yellow;"></i></div>
                                                </div>
                                            </div>
                                            <div class="g-col-12 g-col-sm-6 g-col-xxl-3 box p-5 cursor-pointer zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                                                <div class="text-theme-10" style="font-size:20px;font-weight:800;">Customer Details</div>
                                                <div class="text-gray-600" style="font-size:20px;font-weight:800;">Sudarsan</div>
                                                <div class="mt-6 mt-lg-0 pt-5">
                                                    <div class="fw-medium text-center text-lg-start " style="font-size:25px;font-weight:800;">4 <i class="fa fa-star" style="color:yellow;"></i></div>
                                                </div>
                                            </div>
                                            <div class="g-col-12 g-col-sm-12 g-col-xxl-3 box p-10 cursor-pointer zoom-in" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
                                                <div class="mt-5 d-flex align-items-center" style="font-size:clamp(12px, 2Vw, 24px);font-weight:800;"><i data-feather="disc" class="me-5" style="font-size:24px;font-weight:400;color:#59E304;"></i>Home,saravanampatti,Coimbatore-35</div>
                                                <div class="mt-5 d-flex align-items-center" style="font-size:clamp(12px, 2Vw, 24px);font-weight:800;"><i data-feather="map-pin" class="me-5" style="font-size:24px;font-weight:800;color:red;"></i>Drop,Gandhipuram,Coimbatore-05</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END: Left portion -->
                                    <!-- BEGIN: Right -->
  <div class="g-col-12 g-col-lg-7 box" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);">
    <section class="ps-timeline-sec">
        <div class="container">
            <ol class="ps-timeline">
                <li>
                    <div class="img-handler-top">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-bot">
                        <h1 style="font-size:20px;color:#7F00FF;">Trip Request</h1>
                    </div>
                    <span class="ps-sp-top"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-bot">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-top">
                      <h1 style="font-size:20px;color:#7F00FF;">Trip Accepted</h1>
                    </div>
                    <span class="ps-sp-bot"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-top">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-bot">
                      <h1 style="font-size:20px;color:#7F00FF;">Driver Arrived</h1>
                    </div>
                    <span class="ps-sp-top"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-bot">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-top">
                      <h1 style="font-size:20px;color:#7F00FF;">Trip Started</h1>
                    </div>
                    <span class="ps-sp-bot"><strong class="dot"></strong></span>
                </li>
                <li>
                    <div class="img-handler-top">
                      <p style="font-size:18px;">28 Feb 2024,<br>11 am</p>
                    </div>
                    <div class="ps-bot">
                      <h1 style="font-size:20px;color:#7F00FF;">Trip Ended</h1>
                    </div>
                    <span class="ps-sp-top"><strong class="dot"></strong></span>
                </li>
            </ol>
        </div>
    </section>
  </div>
  <!-- END: Right -->
            </div>
        </div>
            </div>
          </div>
        </td>
      </tr>
      <tr>
        <th scope="row">2</th>
        <td>Jacob</td>
        <td>Thornton</td>
        <td>@fat</td>
        <td>
          <button class="btn btn-primary accordion-btn" type="button" data-bs-toggle="collapse" data-bs-target="#accordionExample2" aria-expanded="false" aria-controls="accordionExample2">
         <i class="fa fa-chevron-down"></i>
    </button>
        </td>
      </tr>
      <tr class="accordion-row">
        <td colspan="5">
          <div class="collapse" id="accordionExample2">
            <div class="card card-body">
             It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).


            </div>
          </div>
        </td>
      </tr>
      <tr>
        <th scope="row">3</th>
        <td>Larry</td>
        <td>the Bird</td>
        <td>@twitter</td>
        <td>
          <button class="btn btn-primary accordion-btn" type="button" data-bs-toggle="collapse" data-bs-target="#accordionExample3" aria-expanded="false" aria-controls="accordionExample3">
         <i class="fa fa-chevron-down"></i>
    </button>
           
        </td>
      </tr>
      <tr class="accordion-row">
        <td colspan="5">
          <div class="collapse" id="accordionExample3">
            <div class="card card-body">
              Accordion Content 3
            </div>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</div>
 </div>

@endsection
@push('scripts-js')
<script>
  document.querySelector(".hamburger").addEventListener("click", function () { 
            document.querySelector("nav").classList.toggle("toggle-menu") 
        });

        document.querySelector(".close").addEventListener("click", function () { 
            document.querySelector("nav").classList.toggle("toggle-menu") 
        });
</script>
<script>
  $(document).ready(function() {
      $('.accordion-btn').click(function() {
		$(this).find('.accordion-icon').toggleClass('rotate');
        var target = $($(this).data('accordion-target'));
        $('.collapse').removeClass('show'); // Remove 'show' class from all accordions
        $(target).collapse('toggle'); // Toggle 'show' class for the clicked accordion
      });
    });
</script>
@endpush
        <!-- END: Form Layout -->


