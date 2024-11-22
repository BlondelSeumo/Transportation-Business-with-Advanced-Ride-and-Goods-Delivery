var baseUrl = appUrl;
         var stop_arr = 0;
        var marker; 
        var waypoints = [];
        var stop_data = [];
         var delivery_map;
                var pickUpMarker, dropMarker;
                var pickUpLocation, dropLocation;
                var pickUpLat, pickUpLng, dropLat, dropLng;
                var directionsService,directionsRenderer;
                var geocoder;
                var stopMarkers = []; 
                var stopMarker ; 
                var type;
               
                  // Draw path from pickup to drop - map api

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
                function createTripRequest(data_modal) {
                    var typeId = $('#vehicles').find(".truck-types.active").attr('data-id'); 
                    var goodsTypeId = $('#goods_type').find(":selected").val();
                    var goods_type_quantity = $('#goods_quantity').find(":selected").val();

                    // var fareTypeId = $('.addPackageBtn').find('span.removePackage').attr('id');
                    var pickAdd = $('#pickup').val();
                    var dropAdd = $('#drop').val();
                    var eta_amount = $('#eta_amount').val();

                    var sender = {
                       'name': $('#name').val(),
                        'phone': $('#phone').val()
                    }
                    var receiver = {
                        'name' : $('#receiverName').val(),
                        'phone' : $('#receiverPhone').val()
                    }  
                    let dataModal = data_modal;
                    var taxi = $('#transport_type').val();
                    var pick_lat = document.getElementById('pickup_lat').value;
                    var pick_lng = document.getElementById('pickup_lng').value;  
                    var pickAdd = document.getElementById('pickup').value;
                    var dialCode =$('.iti__selected-dial-code').text().trim();
                   
                    var checkedRadioButton = document.querySelector('input[name="radiobtn"]:checked');
                    var assign_method = checkedRadioButton.value;
                    var tripData = {
                        'vehicle_type': typeId,
                        'payment_opt': 1,
                        'pick_lat': pick_lat,
                        'pick_lng': pick_lng, 
                        'pick_address': pickAdd,  
                        'pickup_poc_name': sender.name,
                        'pickup_poc_mobile': sender.phone,
                         'request_eta_amount': eta_amount,
                            'transport_type':'taxi',
                            'assign_method':assign_method,
                         'dial_code':dialCode
                    };
                    var eta_amount = $('#vehicles').find(".truck-types.active").attr('data-amount'); 
                    if(type == "rental")
                    {
                        tripData.is_rental=1;
                        tripData.rental_package_id= $('#package_type').val();   
                    }else{
                        var drop_lat = document.getElementById('drop_lat').value;
                        var drop_lng = document.getElementById('drop_lng').value;
                        var dropAdd = document.getElementById('drop').value;
                        tripData.drop_lat= drop_lat;
                        tripData.drop_lng= drop_lng;
                        tripData.drop_address= dropAdd;
                    }
                    if(typeof goodsTypeId !== 'undefined' && goodsTypeId.length > 0){
                        tripData.transport_type='delivery';
                        tripData.goods_type_id = goodsTypeId;
                        tripData.goods_type_quantity = goods_type_quantity;
                    }
                    tripData.stops= JSON.stringify(stop_data);
                    tripData.drop_poc_name= receiver.name;
                    tripData.drop_poc_mobile= receiver.phone;
                   

                    // if(typeof fareTypeId != "undefined"){
                    //     tripData.fare_type_id = fareTypeId
                    // }

                    if (dataModal == 'book-later') {
                        var requestDate = $('#date_picker').val();
                        tripData.is_later = 1;
                        tripData.trip_start_time = requestDate + ':00';
                    }
                    var tripUrl = baseUrl+'/request/create';  
                    $("#loader").show();
                    $(".bg-loader").addClass("actv");
                    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    fetch(tripUrl, {
                            method: 'POST',
                            headers: {  
                                'Content-Type': 'application/json;charset=utf-8',
                                "X-CSRF-Token": csrfToken
                            },
                            body: JSON.stringify(tripData)
                        })
                        .then(response => response.json())
                        .then(result => { 
                            if (result.success == false) {
                                showfancyerror(result.message);
                                return false;
                            }
                            if (result.success == true) {
                                $("#loader").hide();
                                $(".bg-loader").removeClass("actv");
                                popup_init();
                                popup_data(` 
                                    <div class="popup-card"> 
                                    <div class="popup-card-content"> 
                                        <img src="${baseUrl}/assets/img/assign.png" style="margin:auto;width: 200px;height: 200px;" alt="">
                                        <h1>Ride has been Assigned</h1>
                                        <a class="btn btn-success" style="font-size:16px;margin: auto;margin-top: 20px;" href="#">Close</a>
                                    </div>
                                    </div>
                                `);
                                setTimeout(function() {
                                    // Your code to be executed after the delay 
                                    // window.location.href = baseUrl+'/assign-driver/'+result.data.id; 
                                    
                                    if(assign_method == 0)
                                        {
                                            if(dataModal == 'book-later'){
                                                window.location.reload();
                                            }else{
                                                window.location.href = baseUrl+'/ongoing-trip'; 
                                            }
                                        }
                                        else{
                                            // alert("dfsdf");
                                            window.location.href = baseUrl+'/dispatch/assign/'+result.data.id;
                                        }  
                                    }, 500);
                            }
                            else{
                                if(result.type == "date_format")
                                {
                                    $("#loader").hide();
                                    $(".bg-loader").removeClass("actv");
                                    $(".vehicle-type-error").show();
                                    $(".vehicle-type-error").html(result.message);
                                }
                                

                            }
                        });
                }


                // Fetch vehicle types by lat lng and get packages - api
                function fetchVehicleTypes(vehicleDiv, bodyType) {
                    let truckBodyMap = ['closed', 'open', 'both'];
                    let typesArr = '';
                    let packagesArr = '';
                    var vehiclesContainer = document.getElementById('vehicles'); 

                    var pick_lat = document.getElementById('pickup_lat').value;
                    var pick_lng = document.getElementById('pickup_lng').value;
                    var url = baseUrl+'/api/v1/dispatcher/request/eta'; 
                    var taxi = type;
                    var etaData = {
                        'pick_lat': pickUpLat,
                        'pick_lng': pickUpLng,
                        'drop_lat': dropLat,
                        'drop_lng': dropLng,
                        'stops': JSON.stringify(stop_data),
                        'ride_type': 1,
                        'transport_type':taxi,

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
                            var html_data = ""; 
                            var defaultIcon =
                                baseUrl+"/dispatcher/assets/img/truck/taxi.png";
                                    $(".vehicle_type_data").removeClass("d-none");
                                    $(".vehicle_type").removeClass("d-none");
                          
                            if(!result.success)
                            {
                                html_data+= `<span style=" font-size: 18px; position: relative; top: -18px;left: 10px; color: red;font-weight: bold;
">${result.message}</span>`; 
                            }   
                            else{
                                data.forEach(element => {
                                    var vehicleIcon = element.icon ? element.icon : defaultIcon;
                               
                                 html_data+= `<div class="select-checkbox-btn truck-types" data-id="${element.zone_type_id}" data-type-id="${element.type_id}">
                                <label for="vehicle_${element.zone_type_id}" class="select-checkbox-btn-wrapper">
                                    <input id="vehicle_${element.zone_type_id}" name="types" type="radio" class="select-checkbox-btn-input" />
                                    <span class="select-checkbox-btn-content">
                                        <a  class="me-4 cursor-pointer">
                                            <div class="flex-none image-fit rounded-circle">
                                                <img alt="" class="rounded-circle" src="${vehicleIcon}">
                                            </div>
                                            <div class="fs-ls text-gray-600 truncate text-center mt-2">${element.name}</div>
                                        </a>
                                    </span>
                                </label>
                            </div>`; 
                            });
                            } 
                            vehiclesContainer.innerHTML = html_data; 
                        });
                } 
                $(document).on("submit","#dispatcher-booking",function(e){
                    e.preventDefault();
                    // createTripRequest($("#booking_type").val());
                    var good_id = $("#goods_type").val(); 

                    var radioButtons = document.querySelectorAll('input[name="types"]');
                    var isChecked = false;

                    // Loop through each radio button
                    radioButtons.forEach(function(radioButton) {
                    // Check if the current radio button is checked
                    if (radioButton.checked) {
                        // If checked, set isChecked to true
                        isChecked = true;
                        // Exit the loop early since we found a checked radio button
                        return;
                    }
                    });
                    // var value = $(this).val();
                    var value = $("#phone").val();
                    // console.log("Dsfsdfsf");
        
                        // Display the value in the console
                        // console.log(value.length);
                        if (value.length >= 7 && value.length <= 14) {
                        // console.log(value.length);
                        // console.log("value.length");
                        $(".invalid-phone").hide();
                          // Check if the radio button is checked
                        if (isChecked) {
                            $(".vehicle-type-error").hide();
                            if(type == "delivery")
                            {
                                if(good_id == "" || good_id == null || good_id == undefined)
                                {
                                    $(".vehicle-type-error").show();
                                    $(".vehicle-type-error").html("Please select Goods Type");
                                }
                                else{
                                    createTripRequest($("#booking_type").val());
                                }
                            }
                            else{
                                createTripRequest($("#booking_type").val());
                            }
                            
                        }
                        else{
                            $(".vehicle-type-error").show();
                            $(".vehicle-type-error").html("Please select Vehicle type");
                        } 
                        } else {
                        $(".invalid-phone").show();
                        $("phone").focus();
                        }
                  
                    
                })
         function capitalizeFirstLetter(string) {
                    return string.charAt(0).toUpperCase() + string.slice(1);
                }
          function calcRoute(pickup, drop) { 
                    // console.log(pickup);
                    // console.log(drop);
                    // console.log("pickup");
                    // console.log(waypoints);
                    getVehicleTypes();  
                    geocoder.geocode({ 'location': pickup }, function(responses) {
        if (responses && responses.length > 0) {
            pickupAddress = responses[0].formatted_address;
            // console.log("pickupAddress");
            //     console.log(pickupAddress);
            // Update UI or do other operations with the pickup address
        } else {
            pickupAddress = 'Cannot determine address for pickup location.';
        }
        geocoder.geocode({ 'location': drop }, function(responses) {
            if (responses && responses.length > 0) {
                dropAddress = responses[0].formatted_address;
                // console.log("dropAddress");
                // console.log(dropAddress);
            }
            });
    });
        
                    var request = {
                        origin: pickup,
                        destination: drop,
                        waypoints: waypoints,
                        travelMode: google.maps.TravelMode['DRIVING']
                    }; 
                    // console.log("Travel mode");
                    // console.log(request);
                    directionsService.route(request, function(response, status) {
                        if (status == 'OK') {
                            // if(pickUpLocation && dropLocation) 
                            // updateDirections(pickUpLocation, dropLocation)   
                            directionsRenderer.setDirections(response); 
                            // updateDirections(pickUpLocation, dropLocation); 
                            
                        }
                    });
                }
                 function geocodewaypointPosition(pos,i) { 
                      geocoder.geocode({
                        latLng: pos
                      }, function(responses) {
                        if (responses && responses.length > 0) {
                            
                             waypoints[i] = {
                                    location: new google.maps.LatLng(pos.lat(), pos.lng()),
                                    stopover: true
                                };  
                             stop_data[i] = {
                                 latitude: pos.lat(),
                                  longitude: pos.lng(),
                                  address: responses[0].formatted_address
                            };  

                          stopMarkers[i].formatted_address = responses[0].formatted_address; 
                            $("#stop_"+i+"").val(responses[0].formatted_address);
                            var pickup = new google.maps.LatLng(pickUpMarker
                                        .getPosition().lat(), pickUpMarker.getPosition()
                                        .lng());
                                    var drop = new google.maps.LatLng(dropMarker
                                        .getPosition().lat(), dropMarker.getPosition()
                                        .lng()); 
                            calcRoute(pickup, drop);

                        } else {
                          stopMarker.formatted_address = 'Cannot determine address at this location.';
                        }
                        // infowindow.setContent(dropMarker.formatted_address + "<br>coordinates: " + dropMarker.getPosition().toUrlValue(6));
                        // infowindow.open(map, dropMarker);
                      });
                    }
                function clearStopMarkers(index=null) { 
                    if(index !== null)
                    {
                        // console.log("stopMarkers");
                        // console.log(stopMarkers); 
                        // console.log(index); 
                        // console.log("stopMarkers");
                        stopMarkers[index].setMap(null);
                        var indexToRemove = stopMarkers.indexOf(index); 
                        // Check if the element is found
                        if (indexToRemove !== -1) {
                        // Remove the element using splice
                        stopMarkers.splice(indexToRemove, 1);
                        }
                    }
                    else{
                         for (var i = 0; i < stopMarkers.length; i++) {
                        stopMarkers[i].setMap(null);
                        }
                        stopMarkers = [];
                    }

                   
                    }
                function animateMapToLocation(location) { 
                    delivery_map.panTo(location);
                }
                function findWaypointIndexByLocation(location) {
                for (var i = 0; i < waypoints.length; i++) {
                    if (waypoints[i].location.equals(location)) {
                        return i;  // Return the index of the waypoint with the same location
                    }
                }
                return -1;  // Return -1 if the location is not found in the waypoints array
                }
                function handlePlaceChanged(place,type,stopindex)
                {  
                     clearStopMarkers();
                    //  console.log("waypoints");
                    //  console.log(waypoints);
                    //  console.log(stop_data);
                     var places = place.getPlace();   
                     if(stop_arr > waypoints.length)
                     { 
                         waypoints.push({
                          location: places.geometry.location,
                          stopover: true
                         });
                         stop_data.push({
                          latitude: places.geometry.location.lat(),
                          longitude: places.geometry.location.lng(),
                          address: places.formatted_address
                         });
                     } 
                     else{  
                            // Update the waypoint at the found index 
                                waypoints[stopindex] = {
                                    location: places.geometry.location,
                                    stopover: true
                                }; 
                                  stop_data[stopindex] = {
                                      latitude: places.geometry.location.lat(),
                                      longitude: places.geometry.location.lng(),
                                      address: places.formatted_address
                                }; 

                     }
                     $("#stop_"+stopindex+"").val(places.formatted_address);
                     if(pickUpLocation && dropLocation) 
                     var pickup = new google.maps.LatLng(pickUpMarker
                                        .getPosition().lat(), pickUpMarker.getPosition()
                                        .lng());
                                     var drop = new google.maps.LatLng(dropMarker
                                        .getPosition().lat(), dropMarker.getPosition()
                                        .lng());

                            // calcRoute(pickup, drop);
                      updateDirections(pickup, drop)   
                }
                function updateDirections(pickup, drop) { 
                    getVehicleTypes();  
                     var request = {
                        origin: pickup,
                        destination: drop,
                        waypoints: waypoints,
                        travelMode: 'DRIVING'
                        };
                        directionsService.route(request, function(response, status) {
                                if (status == 'OK') {
                                        directionsRenderer.setDirections(response);
                                     var route = response.routes[0];
                                    var leg = route.legs[0];

                                         var index_1 = 0;
                                         var index_no = 1;
                                     for (var i = 0; i < waypoints.length; i++) {
                                (function (index_1) {
                        // Add marker for each waypoint 
                        var iconBase = baseUrl+'/map/icon/'; 
                            // console.log(iconBase+"/"+index_no+".png");
                        
                        var stopMarker = new google.maps.Marker({
                            map: delivery_map,
                            icon: iconBase+"/"+index_no+".png",
                            // position: leg.steps[i].end_location,
                            draggable: true
                        });
                        index_no++; 
                        stopMarkers.push(stopMarker);
                        stopMarker.setPosition(waypoints[index_1].location);
                        stopMarker.setVisible(true);

                        google.maps.event.addListener(stopMarker, 'dragend', function () {
                           
                            geocodewaypointPosition(stopMarker.getPosition(), index_1);
                        });

                        // Animate the map along the route to the stop position
                        // console.log(leg.steps[i].end_location);
                        animateMapToLocation(leg.steps[i].end_location);
                        })(i);
                    }
                                
                                }
                            });
                }
                 $(document).on('click', '.delete_icon', function() {
                    var data_val = $(this).attr("data-val"); 
                    stop_arr--;
                     waypoints.splice(data_val, 1);  
                     stop_data.splice(data_val, 1);   
                    $(this).closest(".stop").remove(); 
                    if(pickUpLocation && dropLocation)
                    { 
                        var pickup = new google.maps.LatLng(pickUpMarker
                                        .getPosition().lat(), pickUpMarker.getPosition()
                                        .lng());
                                     var drop = new google.maps.LatLng(dropMarker
                                        .getPosition().lat(), dropMarker.getPosition()
                                        .lng());

                            calcRoute(pickup, drop);
                        // calcRoute(pickUpLocation, dropLocation);
                    }
                    clearStopMarkers(data_val);
                    
                 });
                $(document).on('click', '.add_stop', function() {
                    
                    var newContent = '<div class="col-md-12 stop mt-4"><div class="input-group mb-3" style=" position: relative; width: 94%;"><input class="form-control w-100 required_for_valid stop" type="text" placeholder="Stop Location" name="stop" id="stop_'+stop_arr+'" aria-label="Username" aria-describedby="basic-addon1" style=" /* width: 66%; */" data-index="'+stop_arr+'">  <input type="hidden" class="form-control" id="stop_lat_'+stop_arr+'" name="stop_lat[]"> <input type="hidden" class="form-control" id="stop_lng_'+stop_arr+'" name="stop_lng[]"><span class="delete_icon" data-val="'+stop_arr+'" style="position: absolute; right: -30px; top: 5px; cursor: pointer;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 d-block mx-auto"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></span></div> </div>'; 
                    $('.drop-loc').before(newContent); 
                    // Set up autocomplete for the new input field
                    var stopInput = document.getElementById('stop_' + stop_arr);
                    // console.log(stop_arr); 
                    
                    var stopAutocomplete = new google.maps.places.Autocomplete(stopInput);
                    var index = stop_arr;
                  
                    

                    // Add event listener for place changed event in the new input field
                    google.maps.event.addListener(stopAutocomplete, 'place_changed', function () { 
                         var splace = stopAutocomplete.getPlace(); 
                         handlePlaceChanged(stopAutocomplete, 'stop',index);
                    });
                    // Autocomplete(stop_arr);
                     
                    stop_arr++;
                }); 
                $(document).ready(function(){ 
                      // Fetch goods type - api
                      // Get the query string from the current URL
                    const queryString = window.location.search;
                    if(typeof google == "undefined"){
                        window.location.reload();
                    }

                    // Create a new URLSearchParams object with the query string
                    const params = new URLSearchParams(queryString);

                    // Get the value of a specific parameter
                     type = params.get('type');
                     if(type == "delivery" || app_for !== 'taxi'){ 
                        
                        fetch(baseUrl+'/api/v1/common/goods-types')
                        .then(response => response.json())
                        .then(result => {
                        var typeSelect = document.getElementById('goods_type');
                        if (result.success) {
                        var goods = result.data;
                        goods.forEach(element => {
                        typeSelect.options[typeSelect.options.length] = new Option(
                        element.goods_type_name, element.id);
                        });
                        }
                        });
                    }
               
                   
                 directionsService = new google.maps.DirectionsService();
                 directionsRenderer = new google.maps.DirectionsRenderer({
                    suppressMarkers: true,
                    draggable: true,
                    panel: document.getElementById("pickup"),
                });
               
                var infowindow = new google.maps.InfoWindow({
                      size: new google.maps.Size(150, 50)
                    });  
                var iconBase = baseUrl+'/map/icon/';
                var icons = {
                    pickup: {
                        name: 'Pickup',
                        icon: iconBase + '/pickup.png'
                    },
                    drop: {
                        name: 'Drop',
                        icon: iconBase + '/drop.png'
                    }
                }; 
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
               
                let util = baseUrl+'/assets/build/js/utils.js';
                var hasErr = false;
                var errorCode = '';

                var errorMsg = document.querySelector("#error-msg");
                // var receiverErrorMsg = document.querySelector("#receiverPhone-error");

                // var receiverCountryDialCode = document.getElementById('receiverDialCode');
                var countryDialCode = document.getElementById('dialcodes');
                countryDialCode.value = iti.getSelectedCountryData().dialCode;
                // receiverCountryDialCode.value = receiverIti.getSelectedCountryData().dialCode;
            
                input.addEventListener('countrychange', function() {
                    countryDialCode.value = iti.getSelectedCountryData().dialCode;
                });

                var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long",
                    "Invalid number"
                ];
                errorMap['-99'] = 'Numeric only allowed';
                errorMap['9'] = 'Phone is required';
 
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
                    calculateEta(truckId);
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
                        `<i data-feather="map-pin"></i><span> ${packageCurrency} ${(packagePrice).toFixed(2)}</span>`
                        );
                    $('.etatime').html(
                        `<i data-feather="clock"></i> <span>${packageMin} Mins </span>`);
                    $('.etadistance').html(
                        `<i data-feather="credit-card"></i> <span> ${packageDis} Kms </span>`
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
              
                // Calculate eta for Truck and Package - api
                function calculateEta(truckId, fareType = null) { 
                    var taxi = type;
                     var etaData = {
                        'pick_lat': pickUpLat,
                        'pick_lng': pickUpLng,
                        'drop_lat': dropLat,
                        'drop_lng': dropLng,
                         'stops': JSON.stringify(stop_data),
                        'vehicle_type': truckId,
                        'ride_type': 1,
                        'transport_type':taxi,

                    };

                    if (fareType) {
                        etaData.fare_type_id = fareType;
                    } 
                    var etaUrl = baseUrl+'/api/v1/dispatcher/request/eta';
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
                                $('#eta_amount').val(etaResponse.total);

                                $('.etaprice').html(
                                    `<i class="fas fa-wallet" style="font-size: 17px;"></i> <a href="" class="fw-medium ms-2" style="font-size:20px;">${etaResponse.currency} ${(etaResponse.total).toFixed(2)}</a>`
                                    );
                                $('.etatime').html(
                                    `<i class="far fa-clock" style="font-size: 17px;"></i> <a href="" class="fw-medium ms-2" style="font-size:20px;">${etaResponse.driver_arival_estimation} Mins</a>`
                                    );
                                $('.etadistance').html(
                                    `<i class="fas fa-map-marker-alt" style="font-size: 17px;"></i> <a href="" class="fw-medium ms-2" style="font-size:20px;">${etaResponse.distance} ${etaResponse.unit_in_words}</a>`
                                    );
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
                function deg2rad(deg) {
                    return deg * (Math.PI / 180);
                }
                function calculateDistance(lat1, lon1, lat2, lon2) {
                    const R = 6371; // Radius of the Earth in kilometers
                    const dLat = deg2rad(lat2 - lat1);
                    const dLon = deg2rad(lon2 - lon1);
                    const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                                Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
                                Math.sin(dLon / 2) * Math.sin(dLon / 2);
                    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                    const distance = R * c; // Distance in kilometers
                    return distance;
                }
                function findNearbyDrivers(lat,lng,radius=10){
                    if(marker !== undefined){
                        marker.setMap(null); 
                    }
                    const dbRef = firebase.database().ref();
                    dbRef.child("drivers").once("value", (snapshot) => {
                        if (snapshot.exists()) {
                        if(snapshot.numChildren() > 0){
                            snapshot.forEach(function(driver){
                                driverData = "";
                                driverData = driver.val();
                                const driverId = driver.key;
                                if(driverId.startsWith("driver_") && driverData.is_active == 1 && driverData.is_available == true){
                                    var distance = calculateDistance(lat,lng,driverData.l[0],driverData.l[1]);
                                    if(distance < radius){
                                        var icon_type = driverData.vehicle_type_icon;
                                        switch (icon_type){
                                            case 'motor_bike':
                                                icon_url = baseUrl+'/map/icon/bike2.png';
                                                break
                                            default:
                                                icon_url = baseUrl+'/map/icon/taxi1.svg';
                                                break
                                        }
                                        var marker = new google.maps.Marker({
                                            position: { lat: driverData.l[0], lng : driverData.l[1]},
                                            map: delivery_map,
                                            title: driverData.name,
                                            icon: icon_url
                                        });
                                    }
                                }
                            })
                        }
                        }
                    });                    
                }
                function initialize() {
                    // console.log("dfdff");
                   var centerLat = default_latitude;
                    var centerLng = default_longitude;
                    var pickup = document.getElementById('pickup');
                    var drop = document.getElementById('drop');//11.018511, 76.969897
                    var stop = document.getElementsByClassName('stop');//11.018511, 76.969897
                    var latlng = new google.maps.LatLng(centerLat,centerLng);
                    directionsService = new google.maps.DirectionsService();
                    directionsRenderer = new google.maps.DirectionsRenderer({
                    suppressMarkers: true,
                    draggable: true,
                    panel: document.getElementById("pickup"),
                    });

                    delivery_map = new google.maps.Map(document.getElementById('map'), {
                        center: latlng,
                        zoom: 8,
                        mapTypeId: 'roadmap'
                    }); 
                    // console.log(directionsRenderer);
                    directionsRenderer.setMap(delivery_map); 
                    geocoder = new google.maps.Geocoder(); 
                    var pickup_location = new google.maps.places.Autocomplete(pickup);
                    var drop_location = new google.maps.places.Autocomplete(drop);
                    pickup_location.addListener('place_changed', function() {

                        // removeMarkers(dropMarker);
                        
                        // pickUpMarker.setVisible(false);

                        var place = pickup_location.getPlace(); 
                        if (!place.geometry) { 
                            return;
                        } 
                        if(pickUpMarker !== undefined){
                         
                            pickUpMarker.setMap(null); 
                        }
                        pickUpLat = place.geometry.location.lat();
                        pickUpLng = place.geometry.location.lng();
                        pickUpLocation = new google.maps.LatLng(pickUpLat, pickUpLng);
                         pickUpMarker = new google.maps.Marker({
                            position: pickUpLocation,
                            icon: icons['pickup'].icon,
                            draggable: true,
                            map: delivery_map,
                            // draggable: true,
                            anchorPoint: new google.maps.Point(0, -29)
                        }); 
                        

                         // If the place has a geometry, then present it on a map.
                        if (place.geometry.viewport) {
                            delivery_map.fitBounds(place.geometry.viewport);
                        } else {
                            delivery_map.setCenter(place.geometry.location);
                            delivery_map.setZoom(17);
                        }
                        if($('#transport_type').val() == 'rental'){
                        var data_ref = {
                            pick_lat : pickUpLat,
                            pick_lng : pickUpLng
                        };
                        console.log(data_ref);
                        $.ajax({
                                url: baseUrl+'/adhoc-list-packages',
                                type: "get",
                                data: data_ref,
                                success: function(response) { 
                                    $("#package_type").html('');
                                    var html_data = `<option value="" disabled="" selected="">Select</option>`;
                                    var html_data1 = ""; 
                                        var defaultIcon =
                                            baseUrl+"/dispatcher/assets/img/truck/taxi.png"; 
                                            $(".vehicle_type_data").removeClass("d-none");
                                            $(".vehicle_type").removeClass("d-none");
                                    for(var i=0;i<response.data.length;i++)
                                    {
                                        html_data+=`<option value="`+response.data[i].id+`">`+response.data[i].package_name+`</option>`;
                                        var price_data = response.data[i].typesWithPrice;
                                        // console.log(price_data);
                                        if(price_data !== null)
                                        {
                                            for(var k=0;k<price_data.data.length;k++)
                                            {
                                                var vehicleIcon = price_data.data[k].icon ? price_data.data[k].icon : defaultIcon;
                                                   
                                                html_data1+= `<div class="select-checkbox-btn truck-types package_${response.data[i].id}" data-id="${price_data.data[k].zone_type_id}" data-type-id="${price_data.data[k].type_id}" data-amount="${price_data.data[k].type_id}">
                                                <label for="vehicle_${price_data.data[k].zone_type_id}" class="select-checkbox-btn-wrapper">
                                                   <input id="vehicle_${price_data.data[k].zone_type_id}" name="types" type="radio" class="select-checkbox-btn-input" />
                                                   <span class="select-checkbox-btn-content">
                                                       <a  class="w-32 me-4 cursor-pointer">
                                                           <div class="w-32 h-32 flex-none image-fit rounded-circle">
                                                               <img alt="" class="rounded-circle" src="${vehicleIcon}">
                                                           </div>
                                                           <div class="fs-ls text-gray-600 truncate text-center mt-2">${price_data.data[k].name}</div>
                                                       </a>
                                                   </span>
                                                    </label>
                                                </div>`; 
                                            }
                                        }
                                      
                                    }
                                    $("#package_type").html(html_data);
                                    var vehiclesContainer = document.getElementById('vehicles'); 
                                    vehiclesContainer.style.setProperty('display', 'none', 'important');
                                    // vehiclesContainer.innerHTML = html_data1; 
                                },
                                error: function(response) { 
                                    printErrorMsg(response.responseJSON.errors);
            
                                } 
                            });

                        }

                        pickUpMarker.setPosition(place.geometry.location);
                        pickUpMarker.setVisible(true);

                         google.maps.event.addListener(pickUpMarker, 'dragend', function() {
                            // console.log(pickUpMarker.getPosition());
                            // console.log("pickUpMarker.getPosition()");
                            geocodePosition(pickUpMarker.getPosition());
                          }); 
                          google.maps.event.trigger(pickUpMarker, 'click') 


                        if (dropLocation)
                            calcRoute(pickUpLocation, dropLocation)

                        bindDataToForm(place.formatted_address, pickUpLat, pickUpLng, 'pickup');

                        findNearbyDrivers(pickUpLat, pickUpLng,$('#search_radius').val());
                       
                    });

                   drop_location.addListener('place_changed', function() {
                        var place = drop_location.getPlace();

                        if (!place.geometry) {
                            return;
                        }  
                       if(dropMarker !== undefined)
                       {  
                         dropMarker.setMap(null);
                       }
                        dropLat = place.geometry.location.lat();
                        dropLng = place.geometry.location.lng();
                        dropLocation = new google.maps.LatLng(dropLat, dropLng); 
                        dropMarker = new google.maps.Marker({
                            position: new google.maps.LatLng(dropLat, dropLng),
                            icon: icons['drop'].icon,
                            draggable: true,
                            map: delivery_map,
                            draggable: true,
                            anchorPoint: new google.maps.Point(0, -29)
                        });


                        // If the place has a geometry, then present it on a map.
                        if (place.geometry.viewport) {
                            delivery_map.fitBounds(place.geometry.viewport);
                        } else {
                            delivery_map.setCenter(place.geometry.location);
                            delivery_map.setZoom(17);
                        }


                        dropMarker.setPosition(place.geometry.location);
                        dropMarker.setVisible(true);

                         google.maps.event.addListener(dropMarker, 'dragend', function() {
                            geocodedropPosition(dropMarker.getPosition());
                          });
 
                        if (pickUpLocation)
                            calcRoute(pickUpLocation, dropLocation)

                        bindDataToForm(place.formatted_address, dropLat, dropLng, 'drop');
                    });
 
                   function geocodePosition(pos) {
                      geocoder.geocode({
                        latLng: pos
                      }, function(responses) {
                        // console.log(responses);
                        // console.log("responses");
                        if (responses && responses.length > 0) { 
                          pickUpMarker.formatted_address = responses[0].formatted_address;
                           $("#pickup").val(responses[0].formatted_address);
                           $("#pickup_lat").val(pickUpMarker.getPosition().lat());
                           $("#pickup_lng").val(pickUpMarker.getPosition().lng());
                            bindDataToForm(responses[0].formatted_address,
                                 pickUpMarker.getPosition().lat(), pickUpMarker
                                        .getPosition().lng(), 'pickup');
                                    var pickup = new google.maps.LatLng(pickUpMarker
                                        .getPosition().lat(), pickUpMarker.getPosition()
                                        .lng());
                                     var drop = new google.maps.LatLng(dropMarker
                                        .getPosition().lat(), dropMarker.getPosition()
                                        .lng());

                            calcRoute(pickup, drop);
                        } else {
                          pickUpMarker.formatted_address = 'Cannot determine address at this location.';
                        }
                        // infowindow.setContent(pickUpMarker.formatted_address + "<br>coordinates: " + pickUpMarker.getPosition().toUrlValue(6));
                        // infowindow.open(map, pickUpMarker);
                      });
                    } 

                    function geocodedropPosition(pos) {
                      geocoder.geocode({
                        latLng: pos
                      }, function(responses) {
                        if (responses && responses.length > 0) {
                            // console.log(responses[0])
                          dropMarker.formatted_address = responses[0].formatted_address;
                           $("#drop").val(responses[0].formatted_address);
                           $("#drop_lat").val(dropMarker.getPosition().lat());
                           $("#drop_lng").val(dropMarker.getPosition().lng());
                            bindDataToForm(responses[0].formatted_address,
                                 dropMarker.getPosition().lat(), dropMarker
                                        .getPosition().lng(), 'drop');
                                 var pickup = new google.maps.LatLng(pickUpMarker
                                        .getPosition().lat(), pickUpMarker.getPosition()
                                        .lng());
                                    var drop = new google.maps.LatLng(dropMarker
                                        .getPosition().lat(), dropMarker.getPosition()
                                        .lng()); 

                            calcRoute(pickup, drop);
                        } else {
                          dropMarker.formatted_address = 'Cannot determine address at this location.';
                        }
                        // infowindow.setContent(dropMarker.formatted_address + "<br>coordinates: " + dropMarker.getPosition().toUrlValue(6));
                        // infowindow.open(map, dropMarker);
                      });
                    }


                    // calcRoute(pickup, drop);
                    

                }
               
                // google.maps.event.addDomListener(window, 'load', initialize);
                initialize();

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
        
        $(document).on("change","#booking_type",function(){
            // console.log($(this).val());
            var value = $(this).val();
            if(value =="book-later")
            {
                $("input#option1").hide();
                $("label.option1").hide();
                $(".book-later-date").show();
            } 
            else{
                $("input#option1").show();
                $("label.option1").show();
                $(".book-later-date").hide();
            }
        });
        $(document).on("change","#transport_types",function(){
            var data_val = $(this).val(); 
            var pick_lat = $("#pickup_lat").val(); 
            var pick_lng = $("#pickup_lng").val(); 
            if(data_val == "delivery"){
                $('#goods_details').show();
            }else{
                $('#goods_details').hide();
            }
            var data_ref = {
                transport_type : data_val,
                pick_lat : pick_lat,
                pick_lng : pick_lng
            };
            $.ajax({
                    url: baseUrl+'/adhoc-list-packages',
                    type: "get",
                    data: data_ref,
                    success: function(response) { 
                        $("#package_type").html('');
                        // console.log(response);
                        var html_data = `<option value="" disabled="" selected="">Select</option>`;
                        var html_data1 = ""; 
                            var defaultIcon =
                                baseUrl+"/dispatcher/assets/img/truck/taxi.png"; 
                                $(".vehicle_type_data").removeClass("d-none");
                                $(".vehicle_type").removeClass("d-none");
                        for(var i=0;i<response.data.length;i++)
                        {
                          //  console.log(response.data);
                            html_data+=`<option value="`+response.data[i].id+`">`+response.data[i].package_name+`</option>`;
                            var price_data = response.data[i].typesWithPrice;
                            // console.log(price_data);
                            if(price_data !== null)
                            {
                                for(var k=0;k<price_data.data.length;k++)
                                {
                                    var vehicleIcon = price_data.data[k].icon ? price_data.data[k].icon : defaultIcon;
                                       
                                    html_data1+= `<div class="select-checkbox-btn truck-types package_${response.data[i].id}" data-id="${price_data.data[k].zone_type_id}" data-type-id="${price_data.data[k].type_id}" data-amount="${price_data.data[k].type_id}">
                                    <label for="vehicle_${price_data.data[k].zone_type_id}" class="select-checkbox-btn-wrapper">
                                       <input id="vehicle_${price_data.data[k].zone_type_id}" name="types" type="radio" class="select-checkbox-btn-input" />
                                       <span class="select-checkbox-btn-content">
                                           <a  class="me-4 cursor-pointer">
                                               <div class="flex-none image-fit rounded-circle">
                                                   <img alt="" class="rounded-circle" src="${vehicleIcon}">
                                               </div>
                                               <div class="fs-ls text-gray-600 truncate text-center mt-2">${price_data.data[k].name}</div>
                                           </a>
                                       </span>
                                        </label>
                                    </div>`; 
                                }
                            }
                          
                        }
                        $("#package_type").html(html_data);
                        var vehiclesContainer = document.getElementById('vehicles'); 
                        vehiclesContainer.style.setProperty('display', 'none', 'important');
                        // vehiclesContainer.innerHTML = html_data1; 
                    },
                    error: function(response) { 
                        printErrorMsg(response.responseJSON.errors);

                    } 
                });
        });
        $(document).on("change","#package_type",function(){
            var transport_type = $("#transport_types").val(); 
            var data_val = $(this).val();
            $(".vehicle_type_data").removeClass("d-none");
            $(".vehicle_type").removeClass("d-none");
            
            var pick_lat = $("#pickup_lat").val(); 
            var pick_lng = $("#pickup_lng").val(); 
            var data_ref = {
                transport_type : transport_type,
                data_val : data_val,
                pick_lat : pick_lat,
                pick_lng : pick_lng
            };
            $.ajax({
                    url: baseUrl+'/adhoc-list-packages',
                    type: "get",
                    data: data_ref,
                    success: function(response) { 
                        // $("#package_type").html('');
                      //  console.log(response);
                        var html_data = `<option value="" disabled="" selected="">Select</option>`;
                        var html_data1 = ""; 
                            var defaultIcon =
                                baseUrl+"/dispatcher/assets/img/truck/taxi.png"; 
                                $(".vehicle_type_data").removeClass("d-none");
                                $(".vehicle_type").removeClass("d-none");
                                var vehiclesContainer = document.getElementById('vehicles'); 
                                vehiclesContainer.innerHTML = "";
                        for(var i=0;i<response.data.length;i++)
                        { 
                            html_data+=`<option value="`+response.data[i].id+`">`+response.data[i].package_name+`</option>`;
                          //  console.log(response.data[i]);
                            var price_data = response.data[i].typesWithPrice;
                            // console.log(price_data);
                             
                                if(price_data !== null)
                                {
                                    
                                    for(var k=0;k<price_data.data.length;k++)
                                    {
                                        var vehicleIcon = price_data.data[k].icon ? price_data.data[k].icon : defaultIcon;
                                           
                                        html_data1+= `<div class="select-checkbox-btn truck-types package_${response.data[i].id}" data-id="${price_data.data[k].zone_type_id}" data-type-id="${price_data.data[k].type_id}" data-amount="${price_data.data[k].fare_amount.toFixed(2)}">
                                        <label for="vehicle_${price_data.data[k].zone_type_id}" class="select-checkbox-btn-wrapper">
                                           <input id="vehicle_${price_data.data[k].zone_type_id}" name="types" type="radio" class="select-checkbox-btn-input" />
                                           <span class="select-checkbox-btn-content">
                                               <a  class="me-4 cursor-pointer">
                                                   <div class="flex-none image-fit rounded-circle">
                                                       <img alt="" class="rounded-circle" src="${vehicleIcon}">
                                                   </div>
                                                   <div class="fs-ls text-gray-600 truncate text-center mt-2">${price_data.data[k].name}</div>
                                               </a>
                                           </span>
                                            </label>
                                        </div>`; 
                                    }
                                }
                                else{
                                    html_data1+= `<div style=" font-size: 16px; margin-left: 15px;color: red;">No Vehicles Available for this package</div>`;
                                }
                            
                           
                          
                        }
                        // $("#package_type").html(html_data);
                       
                        vehiclesContainer.style.setProperty('display', 'flex', 'important');
                        vehiclesContainer.innerHTML = html_data1; 
                    },
                    error: function(response) { 
                        printErrorMsg(response.responseJSON.errors);

                    } 
                });

        });
        // $('#package_type').change(function(){
        //     var data_val = $(this).val();
        //     $(".vehicle_type_data").removeClass("d-none");
        //     $(".vehicle_type").removeClass("d-none");
        //     var vehiclesContainer = document.getElementById('vehicles'); 
        //     vehiclesContainer.style.setProperty('display', 'flex', 'important');
        //     $(".truck-types").hide();
        //     $(".package_"+data_val).show();
        // });
        var input = document.querySelector("#phone");
        // var receiver = document.querySelector("#receiverPhone");
    
        var iti = window.intlTelInput(input, {
            initialCountry: default_country,
            allowDropdown: true,
            separateDialCode: true,
            // onlyCountries: ['gb'],
            utilsScript: util,
        });
        $('#phone').change(function(){
        // Get the value of the input field
        var value = $(this).val();
        
        // Display the value in the console
        // console.log(value.length);
        
        $.ajax({
                    url: baseUrl+'/check-user-exist',
                    type: "get",
                    data: {mobile:value},
                    success: function(response) { 
                        if(response.status)
                        {
                            $("#name").val(response.data.name);
                        }
                    },
                    error: function(response) { 
                        printErrorMsg(response.responseJSON.errors);

                    } 
        });
        
        if (value.length >= 7 && value.length <= 14) {
        $(".invalid-phone").hide();
      
        } else {
        $(".invalid-phone").show();
        }
        
        
        // You can perform any actions with the value here
        // For example, you can update the content of another element based on this value 
    });

$(document).on('change', '#goods_quantity',function(){
    if($(this).val()!=='loose'){
        $('.goods_quantity_no').show();
    }else{
        $('.goods_quantity_no').hide();
    }
})
$(document).on('change', '#goods_quantity_no',function(){
    $('#quantity').val($(this).val());
})

  $(document).change('date_picker', function(e){
    e.preventDefault();
    var now = new Date();
    console.log($(this).val(), now);
  })