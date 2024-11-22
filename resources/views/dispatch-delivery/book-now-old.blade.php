<div id="book-now" class="modal fade" role="dialog">
    <div class="modal-dialog container">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Book Now
                </h4>
                <button type="button" class="close btn btn-danger" data-bs-dismiss="modal">X</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 p-0">
                        <div class="box" id="box-content">
                            <div class="box-body">
                                <form action="#" method="post" id="tripForm">
                                    <div class="card p-3 mb-3 book">
                                        <div class="row">
                                            <div class="col-12">
                                                <h6 class="box-title">User Details</h6>
                                            </div>

                                            <input id="dialcodes" name="dialcodes" type="hidden">

                                            <div class="col-md-6">
                                                <div class="input-group mb-3">
                                                    <input class="form-control w-100 required_for_valid" type="text"
                                                        placeholder="Name" name="name" id="name" aria-label="Username"
                                                        aria-describedby="basic-addon1">
                                                    <span class="text-danger"
                                                        id="error-name">{{ $errors->first('name') }}</span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="input-group mb-3">
                                                    <input class="form-control w-100" type="text" name="phone"
                                                        id="phone" aria-label="phone" aria-describedby="basic-addon1">
                                                    <span class="text-danger"
                                                        id="error-msg">{{ $errors->first('phone') }}</span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    {{-- <div class="card p-3 mb-3 book">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6 class="box-title">Receiver Details</h6>
                                    </div>
                                    
                                    <input id="receiverDialCode" name="receiverDialCode" type="hidden">

                                    <div class="col-md-6">
                                        <div class="form-check" style="float: right;padding: 0;">
                                            <input class="form-check-input" id="same_as_sender" type="checkbox"/>
                                            <label class="form-check-label" for="same_as_sender">Same as Sender</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <input class="form-control w-100 required_for_valid" type="text" placeholder="Name" name="receiverName" id="receiverName">
                                            <span class="text-danger" id="error-receiverName">{{ $errors->first('receiverName') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <input class="form-control" type="text" name="receiverPhone" id="receiverPhone">
                                            <span class="text-danger" id="receiverPhone-error">{{ $errors->first('receiverPhone') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                                    <div class="card p-3 mb-3 book">
                                        <div class="row">
                                            <div class="col-12">
                                                <h6 class="box-title">Location Details</h6>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="input-group mb-3">
                                                    <input class="form-control w-100 required_for_valid" type="text"
                                                        placeholder="Pickup Location" name="pickup" id="pickup"
                                                        aria-label="Username" aria-describedby="basic-addon1">
                                                    <span class="text-danger"
                                                        id="error-pickup">{{ $errors->first('pickup') }}</span>

                                                    <input type="hidden" class="form-control" id="pickup_lat"
                                                        name="pickup_lat">
                                                    <input type="hidden" class="form-control" id="pickup_lng"
                                                        name="pickup_lng">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="input-group mb-3">
                                                    <input class="form-control w-100 required_for_valid" type="text"
                                                        placeholder="Drop Location" name="drop" id="drop"
                                                        aria-label="Username" aria-describedby="basic-addon1">
                                                    <span class="text-danger"
                                                        id="error-drop">{{ $errors->first('drop') }}</span>

                                                    <input type="hidden" class="form-control" id="drop_lat"
                                                        name="drop_lat">
                                                    <input type="hidden" class="form-control" id="drop_lng"
                                                        name="drop_lng">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card p-3 mb-3 book d-none" id="vehicleTypeDiv">
                                        <div class="row">
                                            {{-- <div class="col-12" id="vehicle-body">
                                    <div class="box-header with-border text-left">
                                        <h6 class="box-title">Truck Type</h6>
                                    </div>
                                    <div class="box-body py-0">
                                        <div class="row">
                                            <div class="col-md-4 m-auto truckType">
                                                <ul class="body-type">
                                                    <li data-id="1">Open</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-4 m-auto truckType">
                                                <ul class="body-type">
                                                    <li data-id="0">Closed</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-4 m-auto truckType">
                                                <ul class="body-type">
                                                    <li data-id="2">Any</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                            <div class="col-12">
                                                <h6 class="box-title">Vehicle Type</h6>
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-lg-12 mb-4 mb-lg-0">
                                                        <div class="swiper-container theme-slider">
                                                            <div class="swiper-wrapper" id="vehicles">

                                                            </div>
                                                        </div>
                                                    </div>
                                                   <!--  <div class="col-12 py-2 addPackageBtn d-none">
                                                        <span class="badge bg-success cursor-pointer"
                                                            data-bs-toggle="collapse" data-bs-target="#collapseExample"
                                                            aria-expanded="false" style="float:right"
                                                            aria-controls="collapseExample">Add Packages</span>
                                                    </div> -->
                                                    <div class="collapse text-center" id="collapseExample">
                                                        <hr>
                                                        <h4>
                                                            Packages
                                                        </h4>
                                                        <div class="packages" id="packageList">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="card p-3 mb-3 book date-option d-none">
                                        <div class="row">
                                            <div class="mb-3">
                                                <label class="form-label" for="datepicker">Start Date</label>
                                                <input class="form-control datetimepicker required_for_valid"
                                                    name="date" id="datepicker" type="text" required placeholder="d/m/y"
                                                    data-options='{"disableMobile":true}' />
                                                <span class="text-danger"
                                                    id="error-date">{{ $errors->first('date') }}</span>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="timepicker">Start Time</label>
                                                <input class="form-control datetimepicker required_for_valid"
                                                    name="time" id="timepicker" type="text" required placeholder="H:i"
                                                    data-options='{"enableTime":true,"noCalendar":true,"dateFormat":"H:i","disableMobile":true}' />
                                                <span class="text-danger"
                                                    id="error-time">{{ $errors->first('time') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card p-3 mb-3 book">
                                        <div class="row">
                                            <div class="col-12">
                                                <h6 class="box-title">Payment Method</h6>
                                            </div>
                                            <div class="col-md-12 chq-radio">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" id="cash" type="radio"
                                                        name="payment_opt" value="1" />
                                                    <label class="form-check-label book" for="cash">
                                                        <svg width="35" height="38" viewBox="0 0 40 44" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M36.7644 40.301H3.23563C1.44865 40.301 0 38.8523 0 37.0653V9.14645C0 7.35948 1.44865 5.91083 3.23563 5.91083H36.7644C38.5513 5.91083 40 7.35948 40 9.14645V37.0653C40 38.8523 38.5513 40.301 36.7644 40.301Z"
                                                                fill="url(#paint0_linear)" />
                                                            <path
                                                                d="M36.0167 39.534H3.98337C2.27606 39.534 0.891968 38.1499 0.891968 36.4425V9.76896C0.891968 8.06165 2.27598 6.67755 3.98337 6.67755H36.0166C37.7239 6.67755 39.108 8.06156 39.108 9.76896V36.4426C39.1081 38.1499 37.724 39.534 36.0167 39.534Z"
                                                                fill="url(#paint1_linear)" />
                                                            <path
                                                                d="M37.8321 14.9416L29.7672 0.973031C29.2301 0.0425448 28.0402 -0.276288 27.1097 0.261023L1.68225 14.9416H37.8321Z"
                                                                fill="url(#paint2_linear)" />
                                                            <path
                                                                d="M0 26.1838H40V15.5894C40 14.2521 38.916 13.1682 37.5788 13.1682H2.4212C1.08398 13.1682 0 14.2521 0 15.5894V26.1838Z"
                                                                fill="url(#paint3_linear)" />
                                                            <path
                                                                d="M0 22.1993V37.0653C0 38.8523 1.44865 40.301 3.23571 40.301H36.7644C38.5513 40.301 40 38.8524 40 37.0654V22.1993C40 21.0956 39.1052 20.2008 38.0015 20.2008H1.9985C0.894774 20.2008 0 21.0955 0 22.1993Z"
                                                                fill="url(#paint4_linear)" />
                                                            <path
                                                                d="M33.9653 14.5317V40.3011H36.7643C38.5513 40.3011 40 38.8524 40 37.0655V20.5663L33.9653 14.5317Z"
                                                                fill="url(#paint5_linear)" />
                                                            <path
                                                                d="M31.237 43.9289L3.15785 40.6678C1.35783 40.4586 0 38.9341 0 37.122V8.90521C0 9.51163 0.454384 10.0217 1.05659 10.0917L32.0605 13.6926C33.8605 13.9017 35.2184 15.4263 35.2184 17.2384V40.3832C35.2184 42.5177 33.3573 44.1753 31.237 43.9289Z"
                                                                fill="url(#paint6_linear)" />
                                                            <path
                                                                d="M31.237 38.2927L3.15785 35.0316C1.35783 34.8225 0 33.298 0 31.4858V37.122C0 38.9341 1.35783 40.4587 3.15785 40.6678L31.237 43.9289C33.3573 44.1752 35.2185 42.5178 35.2185 40.3831V34.747C35.2184 36.8816 33.3573 38.539 31.237 38.2927Z"
                                                                fill="url(#paint7_linear)" />
                                                            <path
                                                                d="M2.51742 13.3032C2.4939 13.3032 2.47004 13.3018 2.44608 13.2993L1.16114 13.158C0.806251 13.1189 0.550173 12.7997 0.589233 12.4449C0.628292 12.0901 0.947726 11.8343 1.30227 11.873L2.58721 12.0143C2.9421 12.0534 3.19818 12.3726 3.15912 12.7274C3.12272 13.0583 2.84269 13.3032 2.51742 13.3032Z"
                                                                fill="url(#paint8_linear)" />
                                                            <path
                                                                d="M28.9207 41.7994C28.8936 41.7994 28.8659 41.7976 28.8383 41.7941L26.3409 41.4766C25.9869 41.4316 25.7362 41.1079 25.7813 40.7537C25.8264 40.3997 26.1499 40.1505 26.5041 40.1941L29.0015 40.5117C29.3555 40.5566 29.6063 40.8803 29.5611 41.2345C29.5195 41.5609 29.2413 41.7994 28.9207 41.7994ZM31.3788 41.4794C31.1364 41.4794 30.9038 41.3423 30.7937 41.1083C30.6415 40.7854 30.78 40.4002 31.1029 40.2482C31.7587 39.9392 32.2519 39.4267 32.4561 38.8419C32.5738 38.505 32.9426 38.3273 33.2794 38.4447C33.6164 38.5624 33.7943 38.9311 33.6766 39.2681C33.354 40.1916 32.6358 40.9551 31.6539 41.4176C31.5648 41.4595 31.4712 41.4794 31.3788 41.4794ZM23.9261 41.1643C23.899 41.1643 23.8713 41.1625 23.8437 41.159L21.3463 40.8415C20.9923 40.7965 20.7415 40.4729 20.7867 40.1187C20.8318 39.7646 21.1553 39.5153 21.5095 39.559L24.0069 39.8766C24.3609 39.9216 24.6117 40.2452 24.5665 40.5994C24.5249 40.9257 24.2466 41.1643 23.9261 41.1643ZM18.9315 40.5291C18.9043 40.5291 18.8768 40.5273 18.8491 40.5239L16.3517 40.2063C15.9977 40.1613 15.7469 39.8377 15.7921 39.4835C15.8372 39.1295 16.1608 38.879 16.5149 38.9239L19.0123 39.2414C19.3663 39.2864 19.617 39.61 19.5719 39.9642C19.5303 40.2905 19.2519 40.5291 18.9315 40.5291ZM13.9367 39.8939C13.9096 39.8939 13.882 39.8921 13.8543 39.8887L11.3568 39.571C11.0027 39.526 10.7521 39.2024 10.7972 38.8482C10.8423 38.4941 11.166 38.2448 11.52 38.2886L14.0175 38.6062C14.3716 38.6513 14.6223 38.9748 14.5771 39.329C14.5356 39.6555 14.2573 39.8939 13.9367 39.8939ZM8.94208 39.2587C8.91495 39.2587 8.88739 39.2569 8.85967 39.2535L6.36223 38.9359C6.00812 38.8908 5.75744 38.5672 5.8026 38.213C5.84767 37.8589 6.17139 37.6095 6.52542 37.6534L9.02286 37.971C9.37697 38.0161 9.62765 38.3397 9.58249 38.6939C9.54094 39.0203 9.26271 39.2587 8.94208 39.2587ZM33.2114 37.2006C32.8543 37.2006 32.565 36.9113 32.565 36.5542V34.0368C32.565 33.6798 32.8543 33.3905 33.2114 33.3905C33.5684 33.3905 33.8577 33.6798 33.8577 34.0368V36.5542C33.8578 36.9113 33.5685 37.2006 33.2114 37.2006ZM33.2114 32.1658C32.8543 32.1658 32.565 31.8765 32.565 31.5195V29.002C32.565 28.645 32.8543 28.3557 33.2114 28.3557C33.5684 28.3557 33.8577 28.645 33.8577 29.002V31.5195C33.8578 31.8764 33.5685 32.1658 33.2114 32.1658ZM33.2114 27.1309C32.8543 27.1309 32.565 26.8416 32.565 26.4846V23.9671C32.565 23.6101 32.8543 23.3208 33.2114 23.3208C33.5684 23.3208 33.8577 23.6101 33.8577 23.9671V26.4846C33.8578 26.8415 33.5685 27.1309 33.2114 27.1309ZM33.2114 22.096C32.8543 22.096 32.565 21.8067 32.565 21.4497V18.9323C32.565 18.5752 32.8543 18.2859 33.2114 18.2859C33.5684 18.2859 33.8577 18.5752 33.8577 18.9323V21.4497C33.8578 21.8067 33.5685 22.096 33.2114 22.096ZM32.3074 17.3191C32.1478 17.3191 31.9879 17.2603 31.863 17.1419C31.3839 16.688 30.719 16.3988 29.9906 16.3274L29.9735 16.3256C29.6185 16.2874 29.3618 15.9687 29.4001 15.6138C29.4383 15.2588 29.7569 15.002 30.1119 15.0403L30.1229 15.0415C31.1296 15.1402 32.0655 15.5531 32.7522 16.2036C33.0114 16.4491 33.0223 16.8582 32.7768 17.1174C32.6496 17.2514 32.4787 17.3191 32.3074 17.3191ZM27.541 16.0543C27.5175 16.0543 27.4936 16.0529 27.4696 16.0503L24.9673 15.7752C24.6125 15.7361 24.3563 15.417 24.3954 15.0621C24.4345 14.7073 24.7539 14.452 25.1084 14.4902L27.6108 14.7654C27.9656 14.8044 28.2217 15.1236 28.1827 15.4784C28.1464 15.8093 27.8662 16.0543 27.541 16.0543ZM22.5364 15.504C22.5129 15.504 22.489 15.5026 22.4651 15.5001L19.9627 15.2249C19.6079 15.1859 19.3517 14.8667 19.3908 14.5119C19.4297 14.157 19.7497 13.9013 20.1038 13.94L22.6062 14.2151C22.961 14.2542 23.2172 14.5733 23.1781 14.9281C23.1417 15.2591 22.8617 15.504 22.5364 15.504ZM17.5316 14.9538C17.5081 14.9538 17.4842 14.9524 17.4602 14.9499L14.9579 14.6747C14.6031 14.6357 14.3469 14.3165 14.386 13.9617C14.425 13.6069 14.7442 13.3512 15.099 13.3898L17.6014 13.6649C17.9562 13.704 18.2123 14.0232 18.1733 14.378C18.137 14.7088 17.8569 14.9538 17.5316 14.9538ZM12.5268 14.4036C12.5033 14.4036 12.4795 14.4023 12.4555 14.3997L9.95317 14.1245C9.59829 14.0855 9.34221 13.7663 9.38127 13.4115C9.42024 13.0568 9.73916 12.8012 10.0943 12.8396L12.5966 13.1147C12.9514 13.1538 13.2076 13.473 13.1685 13.8278C13.1323 14.1586 12.8522 14.4036 12.5268 14.4036ZM7.5221 13.8534C7.49858 13.8534 7.47471 13.852 7.45076 13.8494L4.94843 13.5743C4.59363 13.5352 4.33746 13.216 4.37652 12.8612C4.41558 12.5065 4.73459 12.251 5.08956 12.2893L7.59189 12.5645C7.94678 12.6035 8.20286 12.9227 8.1638 13.2775C8.12748 13.6083 7.84737 13.8534 7.5221 13.8534Z"
                                                                fill="url(#paint9_linear)" />
                                                            <path
                                                                d="M3.94135 38.6227C3.91422 38.6227 3.88675 38.621 3.85902 38.6175L2.57657 38.4545C2.22245 38.4095 1.9717 38.0858 2.01685 37.7317C2.06184 37.3776 2.38548 37.1271 2.73959 37.172L4.02205 37.335C4.37616 37.38 4.62692 37.7037 4.58176 38.0578C4.54021 38.3842 4.2619 38.6227 3.94135 38.6227Z"
                                                                fill="url(#paint10_linear)" />
                                                            <path
                                                                d="M27.6891 4.81319L23.5523 7.06425C23.0135 7.35741 22.339 7.15833 22.0457 6.61948C21.7525 6.08062 21.9516 5.40613 22.4905 5.11288L26.6273 2.86191C27.1662 2.56874 27.8407 2.76782 28.1339 3.30668C28.4271 3.84545 28.228 4.52002 27.6891 4.81319Z"
                                                                fill="#61DB99" />
                                                            <path
                                                                d="M35.2184 31.2326L31.1131 27.1273C30.5339 26.4966 29.7027 26.101 28.779 26.101C27.0289 26.101 25.6102 27.5198 25.6102 29.2698C25.6102 30.1936 26.0058 31.0248 26.6365 31.604L35.2184 40.1859V31.2326H35.2184Z"
                                                                fill="url(#paint11_linear)" />
                                                            <path
                                                                d="M28.7786 32.4382C30.5287 32.4382 31.9474 31.0195 31.9474 29.2694C31.9474 27.5193 30.5287 26.1006 28.7786 26.1006C27.0286 26.1006 25.6099 27.5193 25.6099 29.2694C25.6099 31.0195 27.0286 32.4382 28.7786 32.4382Z"
                                                                fill="url(#paint12_linear)" />
                                                            <path
                                                                d="M28.7786 31.4562C29.9864 31.4562 30.9655 30.4771 30.9655 29.2694C30.9655 28.0616 29.9864 27.0825 28.7786 27.0825C27.5708 27.0825 26.5918 28.0616 26.5918 29.2694C26.5918 30.4771 27.5708 31.4562 28.7786 31.4562Z"
                                                                fill="url(#paint13_linear)" />
                                                            <path
                                                                d="M27.9478 28.8911C28.1977 28.8911 28.4003 28.6885 28.4003 28.4386C28.4003 28.1887 28.1977 27.9861 27.9478 27.9861C27.6979 27.9861 27.4953 28.1887 27.4953 28.4386C27.4953 28.6885 27.6979 28.8911 27.9478 28.8911Z"
                                                                fill="url(#paint14_linear)" />
                                                            <path
                                                                d="M29.6094 28.8911C29.8593 28.8911 30.0619 28.6885 30.0619 28.4386C30.0619 28.1887 29.8593 27.9861 29.6094 27.9861C29.3595 27.9861 29.1569 28.1887 29.1569 28.4386C29.1569 28.6885 29.3595 28.8911 29.6094 28.8911Z"
                                                                fill="url(#paint15_linear)" />
                                                            <path
                                                                d="M27.9478 30.5536C28.1977 30.5536 28.4003 30.351 28.4003 30.1011C28.4003 29.8512 28.1977 29.6486 27.9478 29.6486C27.6979 29.6486 27.4953 29.8512 27.4953 30.1011C27.4953 30.351 27.6979 30.5536 27.9478 30.5536Z"
                                                                fill="url(#paint16_linear)" />
                                                            <path
                                                                d="M29.6094 30.5536C29.8593 30.5536 30.0619 30.351 30.0619 30.1011C30.0619 29.8512 29.8593 29.6486 29.6094 29.6486C29.3595 29.6486 29.1569 29.8512 29.1569 30.1011C29.1569 30.351 29.3595 30.5536 29.6094 30.5536Z"
                                                                fill="url(#paint17_linear)" />
                                                            <defs>
                                                                <linearGradient id="paint0_linear" x1="20.6536"
                                                                    y1="3.92858" x2="20.4201" y2="10.7762"
                                                                    gradientUnits="userSpaceOnUse">
                                                                    <stop stop-color="#FFB92D" />
                                                                    <stop offset="1" stop-color="#F59500" />
                                                                </linearGradient>
                                                                <linearGradient id="paint1_linear" x1="21.7734"
                                                                    y1="8.47512" x2="21.1374" y2="13.721"
                                                                    gradientUnits="userSpaceOnUse">
                                                                    <stop stop-color="#FFB92D" />
                                                                    <stop offset="1" stop-color="#F59500" />
                                                                </linearGradient>
                                                                <linearGradient id="paint2_linear" x1="19.7567"
                                                                    y1="8.63025" x2="19.7567" y2="12.6265"
                                                                    gradientUnits="userSpaceOnUse">
                                                                    <stop stop-color="#A7F3CE" />
                                                                    <stop offset="1" stop-color="#61DB99" />
                                                                </linearGradient>
                                                                <linearGradient id="paint3_linear" x1="19.9995"
                                                                    y1="15.548" x2="19.9995" y2="26.7619"
                                                                    gradientUnits="userSpaceOnUse">
                                                                    <stop stop-color="#FF4C54" />
                                                                    <stop offset="1" stop-color="#BE3F45" />
                                                                </linearGradient>
                                                                <linearGradient id="paint4_linear" x1="19.9995"
                                                                    y1="23.8748" x2="19.9995" y2="41.1937"
                                                                    gradientUnits="userSpaceOnUse">
                                                                    <stop stop-color="#FF4C54" />
                                                                    <stop offset="1" stop-color="#BE3F45" />
                                                                </linearGradient>
                                                                <linearGradient id="paint5_linear" x1="37.7244"
                                                                    y1="27.4167" x2="34.8063" y2="27.4167"
                                                                    gradientUnits="userSpaceOnUse">
                                                                    <stop stop-color="#BE3F45" stop-opacity="0" />
                                                                    <stop offset="1" stop-color="#BE3F45" />
                                                                </linearGradient>
                                                                <linearGradient id="paint6_linear" x1="11.6266"
                                                                    y1="24.421" x2="26.4712" y2="31.2686"
                                                                    gradientUnits="userSpaceOnUse">
                                                                    <stop stop-color="#FFB92D" />
                                                                    <stop offset="1" stop-color="#F59500" />
                                                                </linearGradient>
                                                                <linearGradient id="paint7_linear" x1="17.1359"
                                                                    y1="39.6675" x2="16.5223" y2="44.3574"
                                                                    gradientUnits="userSpaceOnUse">
                                                                    <stop stop-color="#BE3F45" stop-opacity="0" />
                                                                    <stop offset="1" stop-color="#BE3F45" />
                                                                </linearGradient>
                                                                <linearGradient id="paint8_linear" x1="1.87405"
                                                                    y1="11.8697" x2="1.87405" y2="41.8616"
                                                                    gradientUnits="userSpaceOnUse">
                                                                    <stop stop-color="#FFF465" />
                                                                    <stop offset="1" stop-color="#FFE600" />
                                                                </linearGradient>
                                                                <linearGradient id="paint9_linear" x1="19.1147"
                                                                    y1="11.8706" x2="19.1147" y2="41.7995"
                                                                    gradientUnits="userSpaceOnUse">
                                                                    <stop stop-color="#FFF465" />
                                                                    <stop offset="1" stop-color="#FFE600" />
                                                                </linearGradient>
                                                                <linearGradient id="paint10_linear" x1="3.29914"
                                                                    y1="11.8689" x2="3.29914" y2="41.8599"
                                                                    gradientUnits="userSpaceOnUse">
                                                                    <stop stop-color="#FFF465" />
                                                                    <stop offset="1" stop-color="#FFE600" />
                                                                </linearGradient>
                                                                <linearGradient id="paint11_linear" x1="33.0076"
                                                                    y1="33.4995" x2="24.1276" y2="24.6194"
                                                                    gradientUnits="userSpaceOnUse">
                                                                    <stop stop-color="#BE3F45" stop-opacity="0" />
                                                                    <stop offset="1" stop-color="#BE3F45" />
                                                                </linearGradient>
                                                                <linearGradient id="paint12_linear" x1="28.778"
                                                                    y1="27.2807" x2="28.778" y2="31.8629"
                                                                    gradientUnits="userSpaceOnUse">
                                                                    <stop stop-color="#FF4C54" />
                                                                    <stop offset="1" stop-color="#BE3F45" />
                                                                </linearGradient>
                                                                <linearGradient id="paint13_linear" x1="28.7779"
                                                                    y1="30.6426" x2="28.7779" y2="27.4806"
                                                                    gradientUnits="userSpaceOnUse">
                                                                    <stop stop-color="#FF4C54" />
                                                                    <stop offset="1" stop-color="#BE3F45" />
                                                                </linearGradient>
                                                                <linearGradient id="paint14_linear" x1="23.6584"
                                                                    y1="9.49896" x2="24.5633" y2="13.4952"
                                                                    gradientUnits="userSpaceOnUse">
                                                                    <stop stop-color="#A7F3CE" />
                                                                    <stop offset="1" stop-color="#61DB99" />
                                                                </linearGradient>
                                                                <linearGradient id="paint15_linear" x1="25.32"
                                                                    y1="9.49915" x2="26.2249" y2="13.4954"
                                                                    gradientUnits="userSpaceOnUse">
                                                                    <stop stop-color="#A7F3CE" />
                                                                    <stop offset="1" stop-color="#61DB99" />
                                                                </linearGradient>
                                                                <linearGradient id="paint16_linear" x1="23.3003"
                                                                    y1="9.57999" x2="24.2052" y2="13.5762"
                                                                    gradientUnits="userSpaceOnUse">
                                                                    <stop stop-color="#A7F3CE" />
                                                                    <stop offset="1" stop-color="#61DB99" />
                                                                </linearGradient>
                                                                <linearGradient id="paint17_linear" x1="24.9619"
                                                                    y1="9.58018" x2="25.8668" y2="13.5764"
                                                                    gradientUnits="userSpaceOnUse">
                                                                    <stop stop-color="#A7F3CE" />
                                                                    <stop offset="1" stop-color="#61DB99" />
                                                                </linearGradient>
                                                            </defs>
                                                        </svg>
                                                        &nbsp; Cash
                                                    </label>
                                                </div>
                                                <span class="text-danger"
                                                    id="error-payment_opt">{{ $errors->first('payment_opt') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <p class="mb-0">
                                    <a data-fancybox data-animation-duration="500" data-src="#animatedModal" href="javascript:;" class="btn btn-primary">Success!</a>
                                </p> --}}


                                    <div class="col-12 mt-3">
                                        <button type="button"
                                            class="btn btn-primary btn-md turned-button form-submit mr-auto"
                                            style="float: right">
                                            Book
                                        </button>
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="box">
                            <div class="row etarow">
                                <div class="col-4 etacol etaprice"><i class="fas fa-wallet"></i> <span>- - -</span>
                                </div>
                                <div class="col-4 etacol etatime"><i class="far fa-clock"></i> <span>- - -</span></div>
                                <div class="col-4 etacol etadistance"><i class="fas fa-map-marker-alt"></i> <span>- -
                                        -</span></div>
                            </div>

                            <div id="book-now-map"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@push('booking-scripts')

    <script src="{{ asset('assets/build/js/intlTelInput.js') }}"></script>
    <script type="text/javascript">
        ['DOMContentLoaded'].forEach(function(eve) {
            // On load document
            window.addEventListener(eve, function() {
                $("#datepicker").flatpickr({
                    minDate: "today",
                    maxDate: new Date().fp_incr(5)
                });

                google.maps.event.addDomListener(window, 'load', initialize);

                var directionsService = new google.maps.DirectionsService();
                var directionsRenderer = new google.maps.DirectionsRenderer({
                    suppressMarkers: true
                });
                var map;
                var pickUpMarker, dropMarker = [];
                var pickUpLocation, dropLocation;
                var pickUpLat, pickUpLng, dropLat, dropLng;

                var iconBase = '{{ asset('map/icon/') }}';
                var icons = {
                    pickup: {
                        name: 'Pickup',
                        icon: iconBase + '/driver_available.png'
                    },
                    drop: {
                        name: 'Drop',
                        icon: iconBase + '/driver_on_trip.png'
                    }
                };

                function initialize() {
                    var centerLat = parseFloat("{{ auth()->user()->admin->serviceLocationDetail->zones()->pluck('lat')->first() ?? 11.015956}}");
                    var centerLng = parseFloat("{{ auth()->user()->admin->serviceLocationDetail->zones()->pluck('lng')->first() ?? 76.968985}}");
                    var pickup = document.getElementById('pickup');
                    var drop = document.getElementById('drop');//11.018511, 76.969897
                    var latlng = new google.maps.LatLng(centerLat,centerLng);

                    map = new google.maps.Map(document.getElementById('book-now-map'), {
                        center: latlng,
                        zoom: 5,
                        mapTypeId: 'roadmap'
                    });

                    directionsRenderer.setMap(map);
                    var geocoder = new google.maps.Geocoder();

                    var pickup_location = new google.maps.places.Autocomplete(pickup);
                    var drop_location = new google.maps.places.Autocomplete(drop);

                    pickup_location.addListener('place_changed', function() {

                        var place = pickup_location.getPlace();

                        if (!place.geometry) {
                            // window.alert("Autocomplete's returned place contains no geometry");
                            return;
                        }

                        removeMarkers(dropMarker);
                        pickUpLat = place.geometry.location.lat();
                        pickUpLng = place.geometry.location.lng();
                        pickUpLocation = new google.maps.LatLng(pickUpLat, pickUpLng);

                        pickUpMarker = new google.maps.Marker({
                            position: pickUpLocation,
                            icon: icons['pickup'].icon,
                            map,
                            // draggable: true,
                            anchorPoint: new google.maps.Point(0, -29)
                        });

                        // If the place has a geometry, then present it on a map.
                        if (place.geometry.viewport) {
                            map.fitBounds(place.geometry.viewport);
                        } else {
                            map.setCenter(place.geometry.location);
                            map.setZoom(17);
                        }

                        pickUpMarker.setPosition(place.geometry.location);
                        pickUpMarker.setVisible(true);

                        if (dropLocation)
                            calcRoute(pickUpLocation, dropLocation)

                        bindDataToForm(place.formatted_address, pickUpLat, pickUpLng, 'pickup');
                    });

                    drop_location.addListener('place_changed', function() {
                        var place = drop_location.getPlace();

                        if (!place.geometry) {
                            return;
                        }

                        removeMarkers(dropMarker);
                        dropLat = place.geometry.location.lat();
                        dropLng = place.geometry.location.lng();
                        dropLocation = new google.maps.LatLng(dropLat, dropLng);

                        dropMarker = new google.maps.Marker({
                            position: new google.maps.LatLng(dropLat, dropLng),
                            icon: icons['drop'].icon,
                            map,
                            // draggable: true,
                            anchorPoint: new google.maps.Point(0, -29)
                        });

                        // If the place has a geometry, then present it on a map.
                        if (place.geometry.viewport) {
                            map.fitBounds(place.geometry.viewport);
                        } else {
                            map.setCenter(place.geometry.location);
                            map.setZoom(17);
                        }

                        dropMarker.setPosition(place.geometry.location);
                        dropMarker.setVisible(true);

                        if (pickUpLocation)
                            calcRoute(pickUpLocation, dropLocation)

                        bindDataToForm(place.formatted_address, dropLat, dropLng, 'drop');
                    });

                    // @TODO this function will work on marker move event into map 
                    google.maps.event.addListener(pickUpMarker, 'dragend', function() {
                        geocoder.geocode({
                            'latLng': pickUpMarker.getPosition()
                        }, function(results, status) {
                            if (status == google.maps.GeocoderStatus.OK) {
                                if (results[0]) {
                                    bindDataToForm(results[0].formatted_address,
                                        pickUpMarker.getPosition().lat(), pickUpMarker
                                        .getPosition().lng(), 'pickup');
                                    var pickup = new google.maps.LatLng(pickUpMarker
                                        .getPosition().lat(), pickUpMarker.getPosition()
                                        .lng());
                                    calcRoute(pickup, dropLocation);
                                }
                            }
                        });
                    });
                }

                // Draw path from pickup to drop - map api
                function calcRoute(pickup, drop) {
                    // to get vehicle type with vehicle body type Both {open or closed}
                    getVehicleTypes();

                    var request = {
                        origin: pickup,
                        destination: drop,
                        travelMode: google.maps.TravelMode['DRIVING']
                    };
                    directionsService.route(request, function(response, status) {
                        if (status == 'OK') {
                            directionsRenderer.setDirections(response);
                        }
                    });
                }

                // Add pick and drop address,Lat and Lng
                function bindDataToForm(address, lat, lng, loc) {
                    document.getElementById(loc).value = address;
                    document.getElementById(loc + '_lat').value = lat;
                    document.getElementById(loc + '_lng').value = lng;
                }

                // Remove markers already drawn on map
                function removeMarkers(markers) {
                    for (i = 0; i < markers.length; i++) {
                        markers[i].setMap(null);
                    }
                }

                // From intl-tel for country code and phone number validation for sender and receiver
                let util = '{{ asset('assets/build/js/utils.js') }}'
                var hasErr = false;
                var errorCode = '';

                var errorMsg = document.querySelector("#error-msg");
                // var receiverErrorMsg = document.querySelector("#receiverPhone-error");

                // var receiverCountryDialCode = document.getElementById('receiverDialCode');
                var countryDialCode = document.getElementById('dialcodes');

                var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long",
                    "Invalid number"
                ];
                errorMap['-99'] = 'Numeric only allowed';
                errorMap['9'] = 'Phone is required';

                // $('#book-now').on('shown.bs.modal', function (e) {
                var input = document.querySelector("#phone");
                // var receiver = document.querySelector("#receiverPhone");

                var iti = window.intlTelInput(input, {
                    initialCountry: "GB",
                    allowDropdown: false,
                    separateDialCode: true,
                    onlyCountries: ['gb'],
                    utilsScript: util,
                });

                // var receiverIti = window.intlTelInput(receiver, {
                //     initialCountry: "IN",
                //     allowDropdown: false,
                //     separateDialCode: true,
                //     onlyCountries: ['in'],
                //     utilsScript: util,
                // });

                countryDialCode.value = iti.getSelectedCountryData().dialCode;
                // receiverCountryDialCode.value = receiverIti.getSelectedCountryData().dialCode;

                input.addEventListener('countrychange', function() {
                    countryDialCode.value = iti.getSelectedCountryData().dialCode;
                });

                // receiver.addEventListener('countrychange', function() {
                //     receiverCountryDialCode.value = receiverIti.getSelectedCountryData().dialCode;
                // });

                // });

                var reset = function(span) {
                    span.innerHTML = "";
                    errorCode = '';
                    hasErr = false;
                };

                function validatePhone(user) {
                    var tag, inTel, span;
                    if (user == 'sender') {
                        tag = input;
                        inTel = iti;
                        span = errorMsg;
                    }
                    reset(span);
                    if (tag.value.trim()) {
                        if (inTel.isValidNumber()) {
                            span.innerHTML = "";
                            errorCode = '';
                            hasErr = false;
                        } else {
                            errorCode = inTel.getValidationError();
                            span.innerHTML = errorMap[errorCode];
                            hasErr = true;
                            return false;
                        }
                    } else {
                        span.innerHTML = errorMap['9']
                        hasErr = true;
                        return false;
                    }
                }

                $(document).on('blur change keyup', '#phone', function() {
                    validatePhone('sender');
                });
                // $(document).on('blur change keyup', '#receiverPhone', function() {
                //     validatePhone('receiver');
                // });
                // Phone number validation ends here


                // Form validation
                $(document).on('click', '.form-submit', function() {
                    let validation_error = validation();

                    if (validation_error > 0) {
                        showfancyerror('Fill all the required fields');
                        return false;
                    } else {
                        createTripRequest();
                    }
                });

                $(document).on("blur change keyup", ".required_for_valid", function() {
                    let current_value = $(this).val();
                    let name = $(this).attr("name");
                    if (current_value != '') {
                        $("#error-" + name).html(" ");
                    } else {
                        $("#error-" + name).html("The Field is required");
                    }
                });

                function validation() {
                    let error_count = 0;
                    $(".required_for_valid").each(function() {
                        let name = $(this).attr("name");
                        if ($(this).val() != '') {
                            $("#error-" + name).html(" ");
                        } else {
                            $("#error-" + name).html("The Field is required");
                            error_count++;
                        }
                    });
                    return error_count;
                }


                let formVar = ['name', 'receiverName', 'pickup', 'drop'];

                formVar.forEach(element => {
                    $(document).on('blur keyup', '#' + element, function() {
                        //    validateForm(element);
                    });
                });

                function validateForm(inputTag) {
                    var val = document.getElementById(inputTag);
                    if (val.value == '') {
                        val.nextElementSibling.innerHTML = 'The Field is required';
                    } else {
                        val.nextElementSibling.innerHTML = '';
                    }
                }


                // Truck body type - Open Closed Any
                let truckTypeDiv = document.getElementsByClassName("truckType");
                Array.from(truckTypeDiv).forEach(ele => {
                    ele.addEventListener("click", function(e) {
                        var type = e.target.innerHTML;
                        var typeId = e.target.getAttribute('data-id');
                        getVehicleTypes();
                    });
                });


                // Fetch vehicle types - validate pickup and drop
                function getVehicleTypes() {
                    if (pickUpLocation && dropLocation) {
                        let vehicleDiv = document.getElementById('vehicleTypeDiv');
                        fetchVehicleTypes(vehicleDiv);
                    } else {
                        showfancyerror('Choose Pickup Drop Location');
                        return false;
                    }
                }

                // Fetch vehicle types by lat lng and get packages - api
                function fetchVehicleTypes(vehicleDiv, bodyType) {
                    let truckBodyMap = ['closed', 'open', 'both'];
                    let typesArr = '';
                    let packagesArr = '';
                    var vehiclesContainer = document.getElementById('vehicles');
                    var packageContainer = document.getElementById('packageList');

                    var pick_lat = document.getElementById('pickup_lat').value;
                    var pick_lng = document.getElementById('pickup_lng').value;
                    var url = '{{ url('api/v1/dispatcher/request/eta') }}';

                    var etaData = {
                        'pick_lat': pickUpLat,
                        'pick_lng': pickUpLng,
                        'drop_lat': dropLat,
                        'drop_lng': dropLng,
                        'ride_type': 1,
                    };

                    fetch(url, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json;charset=utf-8'
                            },
                            body: JSON.stringify(etaData)
                        })
                        .then(response => response.json())
                        .then(result => {
                            var data = result.data;
                            data.forEach(element => {
                                vehicleDiv.classList.remove("d-none")

                                var defaultIcon =
                                    "{{ asset('dispatcher/assets/img/truck/taxi.png') }}";
                                var vehicleIcon = element.icon ? element.icon : defaultIcon;
                                typesArr += `<div class="swiper-slide col-2 truck-types book" data-id="${element.zone_type_id}" data-type-id="${element.type_id}">
                                        <img class="rounded-1 img-fluid" src="${vehicleIcon}" alt="" />
                                        <p>${element.name}</p>
                                    </div>`;

                                // var packageData = element.zoneTypePrice.data;
                                // packageData.forEach(packagePrice => {
                                //     if(packagePrice.price_type == 1){
                                //         packagesArr += `<div class="fs--1 m-auto mb-2 selectTypePackage d-none" style="max-width: 25rem;" data-truck-id="${element.id}" data-package-id="${packagePrice.fare_type_id}">
                                //                 <a class="notification" href="#!">
                                //                     <div class="notification-body">
                                //                         <h5 class="m-0 package_name">
                                //                             ${packagePrice.fare_type_name}
                                //                         </h5>
                                //                         <p class="mb-1" style="text-align:left;" data-package-min="${packagePrice.free_minutes}" data-package-dis="${packagePrice.base_distance}" data-package-currency="${packagePrice.currency}">
                                //                             <br>
                                //                             ${packagePrice.currency} ${packagePrice.price_per_time} / Min after ${packagePrice.free_minutes} Min<br>
                                //                             ${packagePrice.currency} ${packagePrice.price_per_distance} / Km after ${packagePrice.base_distance} Km
                                //                         </p>
                                //                     </div>
                                //                     <div class="notification-avatar">
                                //                         <div class="btn btn-success packagePrice" data-package-price="${packagePrice.base_price}">
                                //                             ${packagePrice.currency} ${packagePrice.base_price}
                                //                         </div>
                                //                     </div>
                                //                 </a>
                                //             </div>`;    
                                //     }
                                // });
                            });
                            vehiclesContainer.innerHTML = typesArr;
                            // packageContainer.innerHTML = packagesArr;
                        });
                }

                // To capitalize first letter of a string
                function capitalizeFirstLetter(string) {
                    return string.charAt(0).toUpperCase() + string.slice(1);
                }

                // On click vehicles get packages and calculate eta
                $(document).on('click', '.truck-types', function() {
                    var truckId = $(this).attr('data-id');
                    $('.truck-types').removeClass('active');
                    $(this).addClass('active');
                    $('.addPackageBtn').removeClass('d-none');
                    calculateEta(truckId)
                    getPackages(truckId);
                });

                // Get package by vehicle id i.e Truck id
                function getPackages(truckId) {
                    $('.selectTypePackage').addClass('d-none');
                    $('.selectTypePackage').removeClass('active');

                    var $div = $(".selectTypePackage").filter(function() {
                        return $(this).data("truck-id") == truckId;
                    });

                    $div.addClass('active')
                    $div.removeClass('d-none');
                }

                // Select package and hide all other packages
                $(document).on('click', '.selectTypePackage', function() {
                    var packageTruckId = $(this).attr('data-truck-id');
                    var fareTypeId = $(this).attr('data-package-id');
                    var packageName = $(this).find('.package_name').text();
                    var packageMin = ($(this).find('p').attr('data-package-min') != 'null' ? $(this)
                        .find('p').attr('data-package-min') : '-');
                    var packageDis = $(this).find('p').attr('data-package-dis');
                    var packageCurrency = $(this).find('p').attr('data-package-currency');
                    var packagePrice = parseFloat($(this).find('.packagePrice').attr(
                        'data-package-price'));

                    $('.addPackageBtn').empty();
                    $('#collapseExample').toggle();
                    $('.addPackageBtn').html(`
                                        <span class="badge bg-success">${packageName}</span>
                                        <span class="badge bg-danger cursor-pointer removePackage" style="float:right" id="${fareTypeId}">-</span>
                                    `);

                    $('.etaprice').html(
                        `<i class="fas fa-wallet"></i><span> ${packageCurrency} ${(packagePrice).toFixed(2)}</span>`
                        );
                    $('.etatime').html(
                        `<i class="far fa-clock"></i> <span>${packageMin} Mins </span>`);
                    $('.etadistance').html(
                        `<i class="fas fa-map-marker-alt"></i> <span> ${packageDis} Kms </span>`
                        );
                    // calculateEta(packageTruckId,fareTypeId);
                });

                // Remove selected package 
                $(document).on('click', '.removePackage', function() {
                    var id = $(this).attr('id');
                    $('.addPackageBtn').empty();
                    $('#collapseExample').removeAttr("style");
                    $('.addPackageBtn').html(`<span class="badge bg-success cursor-pointer" data-bs-toggle="collapse"
                                            data-bs-target="#collapseExample" aria-expanded="false" style="float:right"
                                            aria-controls="collapseExample">Add Packages</span>`);
                });

                // Calculate eta for Truck and Package - api
                function calculateEta(truckId, fareType = null) {
                    var etaData = {
                        'pick_lat': pickUpLat,
                        'pick_lng': pickUpLng,
                        'drop_lat': dropLat,
                        'drop_lng': dropLng,
                        'vehicle_type': truckId,
                        'ride_type': 1,
                    };

                    if (fareType) {
                        etaData.fare_type_id = fareType;
                    }

                    var etaUrl = "{{ url('api/v1/dispatcher/request/eta') }}"
                    fetch(etaUrl, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json;charset=utf-8'
                            },
                            body: JSON.stringify(etaData)
                        })
                        .then(response => response.json())
                        .then(result => {
                            if (result.success) {
                                var etaResponse = result.data;
                                $('.etaprice').html(
                                    `<i class="fas fa-wallet"></i> ${etaResponse.currency} ${(etaResponse.total).toFixed(2)}`
                                    );
                                $('.etatime').html(
                                    `<i class="far fa-clock"></i> ${etaResponse.driver_arival_estimation} Mins`
                                    );
                                $('.etadistance').html(
                                    `<i class="fas fa-map-marker-alt"></i> ${etaResponse.distance} ${etaResponse.unit_in_words}`
                                    );
                            }
                        });
                }

                function createTripRequest() {
                    var typeId = $('#vehicles').find("div.active").attr('data-id');
                    // var fareTypeId = $('.addPackageBtn').find('span.removePackage').attr('id');
                    var pickAdd = $('#pickup').val();
                    var dropAdd = $('#drop').val();
                    var sender = {
                        'name': $('#name').val(),
                        'phone': '+' + $('#dialcodes').val() + $('#phone').val()
                    }
                    // var receiver = {
                    //     'name' : $('#receiverName').val(),
                    //     'phone' : '+'+$('#receiverDialCode').val() + $('#receiverPhone').val()
                    // }

                    let dataModal = $('#book-now').attr('data-modal');

                    var tripData = {
                        'vehicle_type': typeId,
                        'payment_opt': 1,
                        'pick_lat': pickUpLat,
                        'pick_lng': pickUpLng,
                        'drop_lat': dropLat,
                        'drop_lng': dropLng,
                        'pick_address': pickAdd,
                        'drop_address': dropAdd,
                        'pickup_poc_name': sender.name,
                        'pickup_poc_mobile': sender.phone
                    }

                    // if(typeof fareTypeId != "undefined"){
                    //     tripData.fare_type_id = fareTypeId
                    // }

                    if (dataModal == 'book-later') {
                        var requestDate = $('#datepicker').val();
                        var requestTime = $('#timepicker').val();

                        tripData.is_later = 1;
                        tripData.trip_start_time = requestDate + ' ' + requestTime + ':00'
                    }


                    var tripUrl = "{{ url('request/create') }}"
                    fetch(tripUrl, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json;charset=utf-8',
                                "X-CSRF-Token": "{{ csrf_token() }}"
                            },
                            body: JSON.stringify(tripData)
                        })
                        .then(response => response.json())
                        .then(result => {
                            console.log(result)
                            if (result.success == false) {
                                showfancyerror(result.message);
                                return false;
                            }
                            if (result.success == true) {
                                fetchRequestList();
                                $('#book-now').modal('toggle');
                                formInputReset();
                                showSuccess(result.message)
                            }
                        });
                }

                $('#book-now').on('hidden.bs.modal', function(e) {
                    directionsRenderer.setMap(null);
                    pickUpMarker.setMap(null)
                    dropMarker.setMap(null)
                })

                function showfancyerror(message) {
                    $.fancybox.open(`<div class="err-message"><h5>${message}</h5></div>`);
                    setTimeout(closeFancyBox, 2000);
                }

                function showSuccess(message) {
                    var mes = `<div style="display: none;" id="animatedModal" class="animated-modal text-center p-5">
                                <h2>
                                    Success!
                                </h2>
                                <p>
                                   ${message} <br/>
                                </p>
                                <p class="mb-0">
                                    <svg width="150" height="150" viewBox="0 0 510 510" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <path fill="#fff" d="M150.45,206.55l-35.7,35.7L229.5,357l255-255l-35.7-35.7L229.5,285.6L150.45,206.55z M459,255c0,112.2-91.8,204-204,204 S51,367.2,51,255S142.8,51,255,51c20.4,0,38.25,2.55,56.1,7.65l40.801-40.8C321.3,7.65,288.15,0,255,0C114.75,0,0,114.75,0,255 s114.75,255,255,255s255-114.75,255-255H459z"></path>
                                    </svg>
                                </p>
                            </div>`;

                    $.fancybox.open(mes);
                    setTimeout(closeFancyBox, 2000);
                }


            });
        });




        // Validate phone numbers on submit
        $(document).on("keypress", ".only_numbers", function(e) {
            var regex = new RegExp("^[0-9]+$");
            // ^[6-9]\d{9}$
            var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
            if (regex.test(str)) {
                return true;
            }
            e.preventDefault();
            return false;
        });

        // Validate Input on submit
        $(document).on("keypress", ".only_numbers_alpha", function(e) {
            var regex = new RegExp("^[a-zA-Z0-9]+$");
            var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
            if (regex.test(str)) {
                return true;
            }
            e.preventDefault();
            return false;
        });

    </script>

@endpush
