 var latitude;
                            var longitude;
                            let map;
                            let marker,marker1;
                            var widgetid;
                            var otp_btn_active = false;
              // Your web app's Firebase configuration
        var firebaseConfig = {
                apiKey: "{{get_settings('firebase-api-key')}}",
                authDomain: "{{get_settings('firebase-auth-domain')}}",
                databaseURL: "{{get_settings('firebase-db-url')}}",
                projectId: "{{get_settings('firebase-project-id')}}",
                storageBucket: "{{get_settings('firebase-storage-bucket')}}",
                messagingSenderId: "{{get_settings('firebase-messaging-sender-id')}}",
                appId: "{{get_settings('firebase-app-id')}}",
                measurementId: "{{get_settings('firebase-measurement-id')}}"
        };
        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);  
      // Example: Rendering reCAPTCHA widget 
        var verifyCallback = function(response) { 
            if($("#input-dial-number").val() != "" && $("#input-dial-number").val() !== undefined)
            {
                $(".opt-text-button").addClass("actv");
            }
            
        };

         var onloadCallback = function() {
            @if(!Session('user_id')) 
        window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha', {
        'size': 'normal',
        'callback': verifyCallback
        });
        recaptchaVerifier.render().then((widgetId) => {
        window.recaptchaWidgetId = widgetId;
        // console.log("widgetId");
        // console.log(window.recaptchaWidgetId); 
        });  
        @endif
       
      };
      
            $(document).on("input","#input-dial-number",function(){
                 var response = grecaptcha.getResponse(widgetid);
                 if(response != "")
                 {
                     $(".opt-text-button").addClass("actv");
                 }
            })
            $(document).on("click",".item-name",function(){
                $(".item-name").removeClass("actv");
                $(this).addClass("actv");
                $(".book_now").removeClass("actv");
                $(".book_now").hide();
            })
            
              $('.item-name').hover(
                  function() { 
                     $(this).closest(".nav-tab").find(".tool-tips").show();
                  },
                  function() { 
                      $(this).closest(".nav-tab").find(".tool-tips").hide();
                  }
            );
               $('.fa-info-circle').hover(
                  function() { 
                     $(this).closest(".pick_ups_location").find(".tool-tips1").show();
                  },
                  function() { 
                      $(this).closest(".pick_ups_location").find(".tool-tips1").hide();
                  }
            );
              $(document).on("click",".daily-ride",function(){  
               
                $(".bar").addClass("actv"); 
                 setTimeout(function() { 
                    // $(".available_ride").show();
                    $(".rental_ride").hide();
                    $(".available-vehicle-details").removeClass('actv');
                    $(".package").hide();
                    $(".bar").removeClass("actv"); 
                    $(".book_now").removeClass("actv");
                    $(".book_now").hide();
                    $(".book_now1").hide(); 
                    $(".add-details").hide();


                    $("#packagePicker option[value='select']").prop("selected", true);
                    $('.desktop-bg.p2p').css('background-image', 'url("https://olawebcdn.com/images/v1/bg_city.jpg")'); 
                     $(".from-details.out_station").hide();
                    $(".from-details.booking_type").hide();
                    $(".from-details.daily_rides").show();
                    $(".from-details.rentals").hide();
                  }, 200);  
              }) 
                $(document).on("click",".out_station",function(){  
                    if($("#lat").val() != "" && $("#lat1").val() != "")
                    {
                        $(".available_ride").show();
                        $(".promo_coupon").show();
                        $(".daily_ride_vehicle").show();  
                        $(".add-details").show();
                    }
               
                $(".bar").addClass("actv"); 
                 setTimeout(function() { 
                    
                    // $(".available_ride").show();
                    $(".rental_ride").hide();
                    $(".available-vehicle-details").removeClass('actv');
                    // $(".daily_ride_vehicle").show();
                    $(".package").hide();
                    $(".bar").removeClass("actv"); 
                    $(".book_now").removeClass("actv");
                    $(".book_now").hide();
                    $(".book_now1").hide(); 
                    $("#packagePicker option[value='select']").prop("selected", true);
                    $('.desktop-bg.p2p').css('background-image', 'url("https://olawebcdn.com/images/v1/bg_city.jpg")'); 
                    $(".from-details.out_station").hide();
                    $(".from-details.booking_type").hide();
                    $(".from-details.daily_rides").show();
                    $(".from-details.rentals").hide();

                  }, 200);  
              }) 
                    $(document).on("click",".rental",function(){ 
                        $(".bar").addClass("actv");  
                        $(".add-details").hide();
                         setTimeout(function() {
                              $(".available_ride").hide();
                              $(".promo_coupon").hide();

                              $(".daily_ride_vehicle").hide(); 
                              $(".book_now1").hide(); 
                        $(".bar").removeClass("actv"); 
                        $(".available-vehicle-details").removeClass('actv');
                        $('.desktop-bg.p2p').css('background-image', 'url("https://olawebcdn.com/images/v1/bg_rentals.jpg")'); 
                        $(".from-details.out_station").hide();
                        $(".from-details.daily_rides").hide();
                        $(".from-details.booking_type").show();
                  }, 200);  
                
              })
                    
                     $(document).on("change","#rental_type",function(){
                        var form_data = new FormData($("#eta_calculaion")[0]);
                        var transport_type = $(this).val();
                        form_data.append("transport_type",transport_type);
                        $.ajax({
                            url:'adhoc-list-packages',
                            method:'post',
                            data:form_data,
                            dataType:'json',
                            processData:false,
                            contentType:false,
                            success:function(response){
                                if(response.success)
                                {
                                    var html_data = '<div class="from text">Package</div><div class="from location text placeholder select_package"><select id="packagePicker" class="depart-select ola-select"> <option value="select" disabled="" selected="">Select a package</option>'; 
                                    if(response.data.length > 0)
                                    { 
                                    var html_content1 = "";
                                    
                                    for(var i=0;i < response.data.length;i++)
                                    { 
                                        html_data+='<option value="'+response.data[i].id+'">'+response.data[i].package_name+'</option>';
                                        html_content1 += '<div class="available-vehicle-details package-list package_'+response.data[i].id+'" data-val="'+response.data[i].typesWithPrice.data[0].zone_type_id+'" data-id="'+response.data[i].id+'" data-amount="'+parseFloat(response.data[i].typesWithPrice.data[0].fare_amount.toFixed(2))+'" style="display:none"><div class="vehicle-info"> <div class="vehicle-image"><img src="'+response.data[i].typesWithPrice.data[0].icon+'"><div class="time-arrival">2 min</div></div></div><div class="vehicle-info-details"> <div class="vehicle-names">'+response.data[i].typesWithPrice.data[0].name+'</div><div class="vehicle-content">Get an auto at your doorstep</div></div><div class="right-arrow"><span class="price">'+response.data[i].typesWithPrice.data[0].currency+''+parseFloat(response.data[i].typesWithPrice.data[0].fare_amount.toFixed(2))+'</span> </div>  </div><div class="horizontal-line"></div>';
                                    }
                                    $(".vehicle-engine.package").html(html_content1); 
                                    }
                                    html_data+='<template is="dom-repeat"></template> </select> </div>';
                                    $(".rentals").show(); 
                                    $(".rentals").html(html_data);  
                                    
                                }
                            },
                            error: function(xhr, status, error) {
                            // Handle errors
                            console.error('Error:', xhr.responseText);
                            }
                        })
                        

                    });

                    $(document).on("change","#packagePicker",function(){
                        var data_value = $(this).val();
                        $(".rental_ride").show();
                        $(".package").show(); 
                        $(".book_now1").hide(); 
                        $(".available-vehicle-details.package-list").hide();
                        $(".package_"+data_value+"").show();
                    });
                    $(document).on("click",".search_pickup_location",function(){ 
                        $(".content-wrapper").hide();
                        $(".detail-engine-data").hide();
                        $(".content-wrapper1").show();
                        $(".content-wrapper2").hide();
                        $(".content-wrapper3").hide();
                    });
                    
                      $(document).on("click",".date-submit",function(){ 
                        if($(".datepicker").val() != "" && $(".datepicker").val() !== undefined)
                        {    

                        $(".date-error").hide();
                        var transport_type = $(".item-name.actv").attr("data-val");
                        var booking_type = $(".available-vehicle-details.actv").attr("data-val");
                        var formattedAddress = $("#formattedAddress").val();
                        var formattedAddress1 = $("#formattedAddress1").val();
                        var form_data = new FormData($("#eta_calculaion")[0]);
                         form_data.append("vehicle_type",booking_type);
                         form_data.append("country_code",$("#dial_code").val()); 
                         form_data.append("transport_type",transport_type);
                         form_data.append("html_type","html");
                         form_data.append("pickup_address",formattedAddress1);
                         form_data.append("drop_address",formattedAddress);
                         form_data.append("booking_type",1);
                         form_data.append("lat",$("#lat1").val());
                         form_data.append("lng",$("#lng1").val());
                         form_data.append("user_id",'{{Session("user_id")}}');
                         form_data.append("date",$(".datepicker").val()+' '+$("#timepicker").val());

                         $(".bar").addClass("actv");  
                                       $.ajax({
                                                url: 'adhoc-eta', 
                                                type: 'POST',
                                                data: form_data,
                                                dataType: 'html', 
                                                processData: false,
                                                contentType: false, 
                                                success: function(response) { 
                                                     $(".content-wrapper3").html('');
                                                      setTimeout(function() {
                                                            $(".content-wrapper").hide();
                                                            $(".detail-engine-data").hide();
                                                            $(".content-wrapper1").hide();
                                                            $(".content-wrapper2").hide();
                                                            $(".content-wrapper3").html(response);
                                                            $(".content-wrapper3").show();
                                                            $(".model-init1").hide();
                                                            $(".bar").removeClass("actv");  
                                                         }, 500);   
                                                    },
                                                    error: function(xhr, status, error) {
                                                    // Handle errors
                                                    console.error('Error:', xhr.responseText);
                                                    }
                                                }); 
                        }
                        else{
                            $(".date-error").show();
                        }
                       

                      
                    });
                    $(document).on("click",".book_now_details",function(){ 
                        var transport_type = $(".item-name.actv").attr("data-val");
                        var booking_type = $(".available-vehicle-details.actv").attr("data-val");
                        var formattedAddress = $("#formattedAddress").val();
                        var formattedAddress1 = $("#formattedAddress1").val();
                         var form_data = new FormData($("#eta_calculaion")[0]);
                         form_data.append("vehicle_type",booking_type);
                         form_data.append("transport_type",transport_type);
                         form_data.append("html_type","html");
                         form_data.append("pickup_address",formattedAddress1);
                         form_data.append("drop_address",formattedAddress);
                         form_data.append("lat",$("#lat1").val());
                         form_data.append("lng",$("#lng1").val());
                         form_data.append("user_id",'{{Session("user_id")}}');

                                       $.ajax({
                                                url: 'adhoc-eta', 
                                                type: 'POST',
                                                data: form_data,
                                                dataType: 'html', 
                                                processData: false,
                                                contentType: false, 
                                                success: function(response) {
                                                    // Handle the successful response
                                                    // console.log('Success:', response); 
                                                      setTimeout(function() {
                                                            $(".content-wrapper").hide();
                                                            $(".detail-engine-data").hide();
                                                            $(".content-wrapper1").hide();
                                                            $(".content-wrapper2").hide();
                                                            $(".content-wrapper3").html(response);
                                                            $(".content-wrapper3").show();
                                                         }, 200);   
                                                    },
                                                    error: function(xhr, status, error) {
                                                    // Handle errors
                                                    console.error('Error:', xhr.responseText);
                                                    }
                                                }); 

                      
                    });

                    $(document).on("click",".pickup_address",function(){

                        $(".content-wrapper").hide();
                        $(".detail-engine-data").hide();
                        $(".content-wrapper1").hide();
                        $(".content-wrapper3").hide();
                        $(".content-wrapper2").show();

                    })
                    $(document).on("click",".drop-location",function(){
                        $(".content-wrapper").show();
                        $(".detail-engine-data").show();
                        $(".content-wrapper1").hide();
                        $(".content-wrapper2").hide();

                    });
                     $(document).on("click",".drop-locations",function(){
                        $(".content-wrapper").show();
                        $(".detail-engine-data").show();
                        $(".content-wrapper1").hide();
                        $(".content-wrapper2").hide();

                    });
                      function initAutocomplete() { 
                            var autocomplete = new google.maps.places.Autocomplete(
                              document.getElementById("address"),
                              { types: ['geocode'] }
                            );
                            
                            autocomplete.addListener('place_changed', function() { 

                              var place = autocomplete.getPlace();
                              // console.log('Place selected:', place); 
                              var formattedAddress = place.formatted_address;
                              var latitude = place.geometry.location.lat();
                              var longitude = place.geometry.location.lng(); 
                              $("#confirm_lat").val(latitude);
                              $("#confirm_lng").val(longitude);
                              $("#confirm_formattedAddress").val(formattedAddress);
                              $(".confirm_your_location").show(); 

                               var options = {
                                      center: { lat: latitude, lng: longitude }, // Example: San Francisco, CA
                                      zoom: 18,
                                    };
                                     map = new google.maps.Map(document.getElementById('map'), options);

                                    // Add markers
                                     marker1 = new google.maps.Marker({
                                      position: { lat: latitude, lng: longitude }, // 
                                      map: map,
                                      draggable: true, 
                                      title: 'Marker 1',
                                      icon: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png',
                                    }); 
                                     google.maps.event.addListener(marker1, 'dragend', function() { 
                                        var latLng1 = new google.maps.LatLng(marker1.getPosition().lat(), marker1.getPosition().lng());
                                        var code2 = new google.maps.Geocoder(); 
                                        code2.geocode({ 'location': latLng1 }, function(results, status) { 

                                        if (status === 'OK') {  
                                             if (results[0]) { 
                                                 $("#confirm_lat").val(marker1.getPosition().lat());
                                                 $("#confirm_lng").val(marker1.getPosition().lng());
                                                 $("#confirm_formattedAddress").val(results[0].formatted_address);  
                                                 $(".confirm_your_location").show(); 
                                                 $("#address").val(results[0].formatted_address);

                                             }

                                        }
                                    });
                                    }); 
                             
                            });
                            }
                             function initAutocomplete1() { 
                            var autocomplete = new google.maps.places.Autocomplete(
                              document.getElementById("address1"),
                              { types: ['geocode'] }
                            );
                            
                            autocomplete.addListener('place_changed', function() { 
                              var place = autocomplete.getPlace();
                              // console.log('Place selected:', place); 
                              var formattedAddress = place.formatted_address;
                              var latitude = place.geometry.location.lat();
                              var longitude = place.geometry.location.lng();
                              $("#confirm_lat1").val(latitude);
                              $("#confirm_lng1").val(longitude);
                              $("#confirm_formattedAddress1").val(formattedAddress);  
                              $(".confirm_your_location1").show(); 
                                   // Create a map
                              var options = {
                                      center: { lat: latitude, lng: longitude }, // Example: San Francisco, CA
                                      zoom: 18,
                                    };
                                     map = new google.maps.Map(document.getElementById('map1'), options);

                                    // Add markers
                                     marker1 = new google.maps.Marker({
                                      position: { lat: latitude, lng: longitude }, // 
                                      map: map,
                                      draggable: true, 
                                      title: 'Marker 1',
                                      icon: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png',
                                    }); 
                                     google.maps.event.addListener(marker1, 'dragend', function() { 
                                        var latLng1 = new google.maps.LatLng(marker1.getPosition().lat(), marker1.getPosition().lng());
                                        var code1 = new google.maps.Geocoder()
                                        code1.geocode({ 'location': latLng1 }, function(results, status) {
                                        if (status === 'OK') {
                                             if (results[0]) {
                                                 $("#confirm_lat1").val(marker1.getPosition().lat());
                                                 $("#confirm_lng1").val(marker1.getPosition().lng());
                                                 $("#confirm_formattedAddress1").val(results[0].formatted_address);  
                                                 $(".confirm_your_location1").show();
                                                 $("#address1").val(results[0].formatted_address);

                                             }

                                        }
                                    });
                                       
                                    });  
                            });
                            }
                            $(document).on("focus","#address",function(){
                                if($(this).val() != "" && $(this).val() != null)
                                { 
                                    initAutocomplete("address");
                                }
                            })
                            $(document).on("focus","#address1",function(){
                                if($(this).val() != "" && $(this).val() != null)
                                { 
                                    initAutocomplete1();
                                }
                            })

                            var status = true;
                            function getCurrentLocation() {
      var locationInfo = document.getElementById('location-info');

      // Check if geolocation is supported
      if (navigator.geolocation) {
        // Get current position
        navigator.geolocation.getCurrentPosition(
          function(position) {
            // Get latitude and longitude
             latitude = position.coords.latitude;
             longitude = position.coords.longitude;

            // Display location information
            // locationInfo.innerHTML = 'Latitude: ' + latitude + '<br>Longitude: ' + longitude;

            // Optionally, you can use the Google Maps Geocoder API to get a formatted address
            var geocoder = new google.maps.Geocoder();
            var latLng = new google.maps.LatLng(latitude, longitude); 
            geocoder.geocode({ 'location': latLng }, function(results, status) {
              if (status === 'OK') {
                if (results[0]) {
                    if(status)
                    {
                         countryCode = results[0].address_components.find(component => component.types.includes('country')).short_name; 
                         // alert("dfsdf");
                          $.ajax({
                                    url: 'get-country-data?countryCode='+countryCode+'', 
                                    method: 'GET',
                                    dataType: 'json', 
                                    // data:data, 
                                    success: function(response) {  
                                     // console.log(response);
                                     if(response.status == "success")
                                     {
                                        // $("#flag").attr("src", response.flag.flag); 
                                        $(".dial_code").html(response.flag.dial_code); 
                                        $("#dial_code").val(response.flag.dial_code);  
                                         $(".img_src").html('<img id="flag" alt="Superbidding Logo" src="'+response.flag.flag+'">');
                                     }
                                     else{
                                        $("#flag").attr("src", 'http://localhost/Tagxi-Super-App/public/images/country/flags/AD.png');
                                     } 
                                   
                                    },
                                    error: function(error) {
                                    // Handle errors
                                    console.log('Error:', error);
                                    }
                            });
                          status = false;
                    } 
                              $("#lat1").val(latitude);
                              $("#lng1").val(longitude);
                              $("#formattedAddress1").val(results[0].formatted_address);
                              $(".pickup_address").html(results[0].formatted_address);
                                var mapOptions = {
                                      center: { lat: latitude, lng: longitude }, // Example: San Francisco, CA
                                      zoom: 18,
                                    };

                                    // Create a map
                                     map = new google.maps.Map(document.getElementById('map1'), mapOptions);

                                    // Add markers
                                     marker1 = new google.maps.Marker({
                                      position: { lat: latitude, lng: longitude }, // 
                                      map: map,
                                      draggable: true, 
                                      title: 'Marker 1',
                                      icon: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png',
                                    }); 
                                     google.maps.event.addListener(marker1, 'dragend', function() { 
                                        var latLng1 = new google.maps.LatLng(marker1.getPosition().lat(), marker1.getPosition().lng());
                                        geocoder.geocode({ 'location': latLng1 }, function(results, status) {
                                        if (status === 'OK') {
                                             if (results[0]) {
                                                // alert("dfdff");
                                                // var countryCode = results[0].address_components.find(component => component.types.includes('country')).short_name;
                                                // alert(countryCode);
                                                 $("#confirm_lat1").val(marker1.getPosition().lat());
                                                 $("#confirm_lng1").val(marker1.getPosition().lng());
                                                 $("#confirm_formattedAddress1").val(results[0].formatted_address); 
                                                 $(".confirm_your_location1").show(); 
                                                 $("#address1").val(results[0].formatted_address);
                                             }

                                        }
                                    }); 
                                    }); 

                } else {
                  console.log('No results found');
                }
              } else {
                console.log('Geocoder failed due to: ' + status);
              }
            });
          },
          function(error) {
            console.log('Error getting location:', error.message);
          }
        );
      } else {
        locationInfo.innerHTML = 'Geolocation is not supported by this browser.';
      }
    } 
function updateMarkerPosition(latLng) {
    // Update the marker position on the UI
    document.getElementById('marker-position').innerHTML = `Marker Position: ${latLng.lat()}, ${latLng.lng()}`;
}

function updateAddress(latLng) {
    // Use the Geocoder to get the address based on the marker's position
    let geocoder = new google.maps.Geocoder();
    geocoder.geocode({'location': latLng}, function(results, status) {
        if (status === 'OK') {
            if (results[0]) {
                // Update the address on the UI
                document.getElementById('address').innerHTML = `Address: ${results[0].formatted_address}`;
            } else {
                console.error('No results found');
            }
        } else {
            console.error(`Geocoder failed due to: ${status}`);
        }
    });
}

 function initMap() {
    getCurrentLocation();  
  }
  $(document).on("click",".confirm_your_location",function(){
       $("#lat").val($("#confirm_lat").val());
       $("#lng").val($("#confirm_lng").val());  
       $("#formattedAddress").val($("#confirm_formattedAddress").val());
       $(".bar").addClass("actv");  

                        
                                 if($("#lat").val() != "")
                                 {
                                    var form_data = new FormData($("#eta_calculaion")[0]);
                                       $.ajax({
                                                url: 'adhoc-eta', 
                                                type: 'POST',
                                                data: form_data,
                                                dataType: 'json', 
                                                processData: false,
                                                contentType: false, 
                                                success: function(response) {
                                                    // Handle the successful response
                                                    // console.log('Success:', response);
                                                   if(response.success)
                                                    {
                                                        var html_content = "";
                                                    for(var i=0;i<response.data.length;i++)
                                                    {
                                                        var distance = response.data[i].distance;
                                                        var base_distance = response.data[i].base_distance; 
                                                        var base_price = parseFloat(response.data[i].base_price) + parseFloat(response.data[i].distance_price);  
                                                        html_content += '<div class="available-vehicle-details" data-val="'+response.data[i].zone_type_id+'"><div class="vehicle-info"> <div class="vehicle-image"><img src="'+response.data[i].icon+'"><div class="time-arrival">2 min</div></div></div><div class="vehicle-info-details"> <div class="vehicle-names">'+response.data[i].type_name+'</div><div class="vehicle-content">Get an auto at your doorstep</div></div><div class="right-arrow"><span class="price">'+response.data[i].currency+''+parseFloat(response.data[i].total.toFixed(2))+'</span> </div>  </div><div class="horizontal-line"></div>';
                                                    }
                                                    $(".daily_ride_vehicle").html(html_content) 
                                                      setTimeout(function() {
                                                        $(".search_pickup_location").html($("#confirm_formattedAddress").val());
                                                       $(".content-wrapper").show();
                                                        $(".detail-engine-data").show();
                                                        $(".content-wrapper1").hide();
                                                        $(".content-wrapper2").hide();
                                                        $(".content-wrapper3").hide();
                                                        $(".bar").removeClass("actv"); 
                                                         }, 200); 
                                                         $(".search_pickup_location").addClass("actv"); 
                                                         $(".available_ride").show();
                                                         $(".promo_coupon").show();
                                                         $(".daily_ride_vehicle").show(); 
                                                      $(".pickup_address").addClass("actv");
                                                    }
                                                    },
                                                    error: function(xhr, status, error) {
                                                    // Handle errors
                                                    console.error('Error:', xhr.responseText);
                                                    }
                                                }); 

                                    
                                 }
                                 else{
                                      setTimeout(function() {
                                                        $(".search_pickup_location").html($("#confirm_formattedAddress").val());
                                                       $(".content-wrapper").show();
                                                        $(".detail-engine-data").show();
                                                        $(".content-wrapper1").hide();
                                                        $(".content-wrapper2").hide();
                                                        $(".content-wrapper3").hide();
                                                        $(".bar").removeClass("actv"); 
                                                         }, 200); 
                                                         $(".search_pickup_location").addClass("actv"); 
                                    $(".available_ride").hide();
                                     $(".promo_coupon").hide();
                                    $(".daily_ride_vehicle").hide();
                                 }

  })
   $(document).on("click",".confirm_your_location1",function(){

       $("#lat1").val($("#confirm_lat1").val());
       $("#lng1").val($("#confirm_lng1").val()); 
       $("#formattedAddress1").val($("#confirm_formattedAddress1").val());
                        $(".bar").addClass("actv");  

                        
                           if($("#lat").val() != "")
                                 { 

                                    var form_data = new FormData($("#eta_calculaion")[0]);
                                       $.ajax({
                                                url: 'adhoc-eta', 
                                                type: 'POST',
                                                data: form_data,
                                                dataType: 'json', 
                                                processData: false,
                                                contentType: false, 
                                                success: function(response) {
                                                    // Handle the successful response
                                                    // console.log('Success:', response);
                                                   if(response.success)
                                                    {
                                                        var html_content = "";
                                                    for(var i=0;i<response.data.length;i++)
                                                    {
                                                        var distance = response.data[i].distance;
                                                        var base_distance = response.data[i].base_distance; 
                                                        var base_price = parseFloat(response.data[i].base_price) + parseFloat(response.data[i].distance_price);  
                                                        html_content += '<div class="available-vehicle-details" data-val="'+response.data[i].zone_type_id+'"><div class="vehicle-info"> <div class="vehicle-image"><img src="'+response.data[i].icon+'"><div class="time-arrival">2 min</div></div></div><div class="vehicle-info-details"> <div class="vehicle-names">'+response.data[i].type_name+'</div><div class="vehicle-content">Get an auto at your doorstep</div></div><div class="right-arrow"><span class="price">'+response.data[i].currency+''+response.data[i].total.toFixed(2)+'</span> </div>  </div><div class="horizontal-line"></div>';
                                                    }
                                                    $(".daily_ride_vehicle").html(html_content) 
                                                      setTimeout(function() {
                                                        $(".pickup_address").html($("#confirm_formattedAddress1").val());
                                                        $(".content-wrapper").show();
                                                        $(".detail-engine-data").show();
                                                        $(".content-wrapper1").hide();
                                                        $(".content-wrapper2").hide();
                                                        $(".content-wrapper3").hide();
                                                        $(".bar").removeClass("actv"); 
                                                         }, 200); 
                                                         $(".search_pickup_location").addClass("actv"); 
                                                         $(".pickup_address").addClass("actv");
                                                         if($(".item-name.actv").attr("data-val") == "rentals")
                                                         {
                                                            $(".available_ride").hide();
                                                            $(".promo_coupon").hide();
                                                            $(".daily_ride_vehicle").hide();
                                                         }
                                                         else{
                                                            $(".available_ride").show();
                                                         $(".promo_coupon").show();
                                                         $(".daily_ride_vehicle").show(); 
                                                     } 
                                                        
                                                    }
                                                    },
                                                    error: function(xhr, status, error) {
                                                    // Handle errors
                                                    console.error('Error:', xhr.responseText);
                                                    }
                                                }); 
                                                
                                 }
                                 else{
                                      setTimeout(function() {
                                                        $(".pickup_address").html($("#confirm_formattedAddress1").val());
                                                            $(".content-wrapper").show();
                                                            $(".detail-engine-data").show();
                                                            $(".content-wrapper1").hide();
                                                            $(".content-wrapper2").hide();
                                                            $(".bar").removeClass("actv"); 
                                        }, 200);  
                                    $(".available_ride").hide();
                                    $(".promo_coupon").hide();
                                    $(".daily_ride_vehicle").hide();
                                 }
  }) 

   $(document).on("click",".opt-text-button",function(){   

    var response = grecaptcha.getResponse(window.recaptchaWidgetId);  
    $(".opt-text-button").removeClass("actv");
    // grecaptcha.reset(widgetid);   
    if($("#input-dial-number").val() != "" && $("#input-dial-number").val() !== undefined && response !="") { 
        $(".otp-error-message").hide();
        const phoneNumber = $("#dial_code").val()+""+$("#input-dial-number").val()+""; 
        const name = $("#input-name").val();
        const appVerifier = window.recaptchaVerifier;
        $(".bar").addClass("actv");  
        var this_data = $(this);
        // firebase.auth().signInWithPhoneNumber(phoneNumber, appVerifier)
        // .then((confirmationResult) => {
          // SMS sent. Prompt user to type the code from the message, then sign the
          // user in with confirmationResult.confirm(code).
          // window.confirmationResult = confirmationResult; 
          // console.log(confirmationResult);
           this_data.addClass("actv");  
            $(".otp-design").hide();
            $(".verify-otps").show();
            $(".bar").removeClass("actv"); 
            this_data.removeClass("actv");  
            $(".entered-no").html($("#input-dial-number").val());
            $(".otp-error-message-verify").html('');
            $(".otp-error-message-verify").hide();
            $(".opt-text-button-verify").removeClass("actv");
            $("#input-name1").val('');
          // ...
        // }).catch((error) => {
        //     $(".otp-error-message").html('OTP Not sent . Please check the Number');
        //     $(".otp-error-message").show();
        //     $(".bar").removeClass("actv"); 
        // }); 
   }
   // else{
   //       $(".otp-error-message").show();
   //      $(".otp-error-message").html('Please Enter the mobile number');
   // }
   
   });
   $(document).on("click",".back-to-home",function(){
     $("#input-dial-number").val('');
     $("#input-name").val(''); 
     grecaptcha.reset(window.recaptchaWidgetId);
     $(".verify-otps").hide();
     $(".otp-design").show();
     $(".content-wrapper").hide();
        $(".detail-engine-data").hide();
        $(".opt-text-button").removeClass("actv");
        $(".otp-error-message").hide();
        $(".otp-error-message").html('');
    });

 // function clearUser(uid) {
 //      // Use the UID to delete the user
 //      firebase.auth().deleteUser(uid);
       
 //    }
   $(document).on("click",".opt-text-button-verify",function(){
     $(".otp-error-message-verify").html('');
    $(".otp-error-message-verify").hide();
    $(this).removeClass("actv");
    $(".bar").addClass("actv");  
    var this_dt = $(this);
     if($("#input-name1").val() != "" && $("#input-name1").val() !== undefined){ 
        var code = $("#input-name1").val(); 
        var csrfToken = $('meta[name="csrf-token"]').attr('content'); 
        var form_data = new FormData($("#Adduser")[0]);
       
        // confirmationResult.confirm(code).then((result) => { 
            // User signed in successfully. 
                grecaptcha.reset(window.recaptchaWidgetId);    
                  $.ajax({
                    headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                url: 'Adduser', 
                type: 'POST',
                data: form_data,
                dataType: 'json', 
                processData: false,
                contentType: false, 
                success: function(response) {
                    // Handle the successful response 
                    if(response.status == "success")
                    {
                        const phoneNumber = $("#dial_code").val()+""+$("#input-dial-number").val()+""; 
                        const name = $("#input-name").val();
                        $("#model-promo-input-name").val(name);
                        $("#model-promo-input-number").val(phoneNumber); 
                        window.location.reload(); 
                    }
                    },
                    error: function(xhr, status, error) {
                    // Handle errors
                    console.error('Error:', xhr.responseText);
                    }
                }); 
               
             
            // }).catch((error) => {
            //     console.log("bad verification codesss");
            //     $(".otp-error-message-verify").html('OTP is Invalid');
            //     $(".otp-error-message-verify").show();
            //     $(".opt-text-button-verify").addClass("actv"); 
            //     $(".bar").removeClass("actv"); 
            // }); 
     }
     else{
            $(".otp-error-message-verify").html('Please Enter the OTP');
            $(".otp-error-message-verify").show();
     }
   })
    $(document).on("input","#input-name1",function(){
        if($(this).val() != ""){
             $(".opt-text-button-verify").addClass("actv");
        }
                  
            })
    
    $(document).on("click",".available-vehicle-details",function(){
        $(".available-vehicle-details").removeClass("actv"); 
        $(this).addClass("actv"); 
        if($(this).hasClass("package-list"))
        { 
            $(".book_now1").addClass("actv");
            $(".book_now1").show(); 
        }
        else{
            $(".book_now").addClass("actv");
            $(".book_now").show(); 
        }
         

       
    }) 
    $(document).on("click",".promocode-cancel",function(){
        $(".model-init1").hide();
        $(".model-init").hide();

    })
    $(document).on("click",".receiver-add",function(){
         $(".model-init1").hide();
        $(".model-init").hide();

    })
    

    $(document).on("click",".promocode-submit",function(){
        if($("#model-promo-input") != "")
        {
             var form_data = new FormData($("#eta_calculaion")[0]);
         form_data.append("promo_code",$("#model-promo-input").val());
         $.ajax({
                                                url: 'adhoc-eta', 
                                                type: 'POST',
                                                data: form_data,
                                                dataType: 'json', 
                                                processData: false,
                                                contentType: false, 
                                                success: function(response) {

                                                    // Handle the successful response
                                                    // console.log('Success:', response);
                                                   if(response.success)
                                                    {
                                                        $(".model-init1").hide();
                                                        $(".model-init").hide();
                                                        var html_content = "";
                                                    for(var i=0;i<response.data.length;i++)
                                                    {
                                                        var distance = response.data[i].distance;
                                                        var base_distance = response.data[i].base_distance; 
                                                        html_content += '<div class="available-vehicle-details" data-val="'+response.data[i].zone_type_id+'"><div class="vehicle-info"> <div class="vehicle-image"><img src="'+response.data[i].icon+'"><div class="time-arrival">2 min</div></div></div><div class="vehicle-info-details"> <div class="vehicle-names">'+response.data[i].type_name+'</div><div class="vehicle-content">Get an auto at your doorstep</div></div><div class="right-arrow"><span class="price">'+response.data[i].currency+''+parseFloat(response.data[i].total.toFixed(2))+'</span> </div>  </div><div class="horizontal-line"></div>';
                                                    }
                                                    $(".daily_ride_vehicle").html(html_content)
                                                    // console.log(response);
                                                      setTimeout(function() {
                                                        $(".search_pickup_location").html($("#confirm_formattedAddress").val());
                                                       $(".content-wrapper").show();
                                                        $(".detail-engine-data").show();
                                                        $(".content-wrapper1").hide();
                                                        $(".content-wrapper2").hide();
                                                        $(".content-wrapper3").hide();
                                                        $(".bar").removeClass("actv"); 
                                                         }, 200); 
                                                         $(".search_pickup_location").addClass("actv"); 
                                                         $(".available_ride").show();
                                                         $(".promo_coupon").show();
                                                         $(".daily_ride_vehicle").show(); 
                                                      $(".pickup_address").addClass("actv");
                                                    }
                                                    },
                                                    error: function(xhr, status, error) {
                                                    // Handle errors
                                                    console.error('Status Code:', xhr.status); 
                                                    var response =JSON.parse(xhr.responseText); 
                                                    console.error('Error:', JSON.parse(xhr.responseText));
                                                    if(xhr.status == 500)
                                                    {
                                                        $(".promo-code-error").html(response.message);
                                                    } 
                                                    }
                                                }); 
        }
        else{
         $(".promo-code-error").html('Please enthe the promo code');
        }
        
       
    })
    $(document).on("click",".promo_coupon",function(){
        $(".model-init1").show();
        $(".model-content").show();
        $(".model-content1").hide();
    }) 
    $(document).on("click",".receiver-dt",function(){
          $(".model-init").show();
          $(".model-content1").show();
          $(".model-content").hide();
    })
      $(document).on("click",".confirm_button1",function(){ 
                      $(".model-init").hide();
                      $(".model-init1").show();
                      $(".model-content1").hide();
                      $(".model-content").hide();
                      $(".model-content2").show(); 
                        
                    }); 
        $(document).on("click",".date-edit",function(){ 
                      $(".model-init1").show();
                      $(".model-content1").hide();
                      $(".model-content").hide();
                      $(".model-content2").show(); 

                        
                    }); 

    $(document).on('change', '.radio-option', function() { 
        var selectedValue = $(this).val();
        if(selectedValue == "qty")
        {
            $(".qunatity-input").show();
        }
        else{
            $(".qunatity-input").hide();
        }
    });
    $(document).on("click",".booking-back",function(){ 
          $(".bar").addClass("actv"); 

                 setTimeout(function() { 
                    // $(".available_ride").show();
                    $(".content-wrapper3").hide();
                    $(".rental_ride").hide();
                    $(".available-vehicle-details").removeClass('actv');
                    $(".package").hide();
                    $(".bar").removeClass("actv"); 
                    $(".book_now").removeClass("actv");
                    $(".book_now").hide();
                    $(".add-details").hide();
                    $(".detail-engine-data").show();
                    $(".content-wrapper").show();


                    $("#packagePicker option[value='select']").prop("selected", true);
                    $('.desktop-bg.p2p').css('background-image', 'url("https://olawebcdn.com/images/v1/bg_city.jpg")'); 
                     $(".from-details.out_station").hide();
                    $(".from-details.booking_type").hide();
                    $(".from-details.daily_rides").show();
                    $(".from-details.rentals").hide();
                  }, 200);  
    }) 
     function package_booking(){ 
      

    // Push a new state to the history and change the URL
    

                    var form_data = new FormData($("#eta_calculaion")[0]);
                        var transport_type = $(".package-list.actv").attr("data-val");
                        var rental_package_id = $(".package-list.actv").attr("data-id");
                        var request_eta_amount = $(".package-list.actv").attr("data-amount"); 
                           form_data.append("vehicle_type",transport_type); 
                           form_data.append("rental_package_id",rental_package_id); 
                           form_data.append("request_eta_amount",request_eta_amount);  
                           form_data.append("country_code",'{{Session("dial_code")}}');
                           form_data.append("mobile",'{{Session("mobile")}}'); 
                           $.ajax({
                                    url: 'adhoc-create-request', 
                                    type: 'POST',
                                    data: form_data,
                                    dataType: 'json', 
                                    processData: false,
                                    contentType: false, 
                                    success: function(response) {
                                        // Handle the successful response
                                        console.log('Success:', response);  
                                        $(".model-init1").html('<div class="model-wrapper"><div class="model-content">  <div class="booking-confirmation image"> <img src="{{ asset("images/success.jpeg") }}" id="success-image"> </div>   <div class="booking-confirmation-text">Booking Confirmed Successfully</div>  </div>  </div>');
                                        $(".model-init1").show(); 

                                          var stateObj = { data: response.data }; // You can pass any data as the state object
                                          var title = "New Page Title";
                                          var newUrl = "{{ url('/') }}/new-booking?request_id="+response.data.id+"";
                                        history.pushState(stateObj, title, newUrl);
                                        setTimeout(function() { 
                                            $(".content-wrapper").show();
                                            $(".content-wrapper3").hide();
                                            $(".content-wrapper4").show(); 
                                            $(".content-wrapper4").html(); 

                                         }, 200); 
                                        },
                                        error: function(xhr, status, error) {
                                        // Handle errors
                                        console.error('Error:', xhr.responseText);
                                        }
                                    }); 

                } 
    google.maps.event.addDomListener(window, 'load', initAutocomplete);
    google.maps.event.addDomListener(window, 'load', initAutocomplete1);
    google.maps.event.addDomListener(window, 'load', initMap);