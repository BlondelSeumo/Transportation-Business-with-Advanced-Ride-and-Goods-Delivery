var html_data = "";
var map;
var markerPositions = [];
var markerarray = [];
markerarray["all"] = [];
markerarray["online"] = [];
markerarray["offline"] = [];
markerarray["onride"] = [];
var driver_ids = [];
driver_ids["all"] = [];
driver_ids["online"] = [];
driver_ids["offline"] = [];
driver_ids["onride"] = [];
var markerMap = {};
var marker;
var type;
var database;
var mobile = "**********";
var shouldProcessChildAdded = false;
var baseUrl = appUrl
    function removeMarkers() {
      for (var i = 0; i < markerPositions.length; i++) {
        markerPositions[i].setMap(null); // Remove the marker from the map
      }
      markerPositions = [];
      markerMap = {};
    }
    function get_html_data(text,driverData){
      var last_seen = '';
      var last_seen_time = new Date() - new Date(driverData.updated_at);
      var seenInMinutes = parseInt(last_seen_time / 60000),
          seenInHours = 0,
          seenInDays = 0,
          seenInWeeks = 0;
      if(seenInMinutes > 59){
        seenInHours = parseInt(seenInMinutes / 60);
        if(seenInHours > 23){
          seenInDays = parseInt(seenInHours / 24);
          if(seenInDays > 6){
            seenInWeeks = parseInt(seenInDays / 7);
          }
        }
      }
      if(seenInMinutes <= 1){
        last_seen = 'just now';
      }
      if(seenInMinutes > 1 && seenInMinutes < 59){
        last_seen = seenInMinutes + ' minutes ago';
      }
      if(seenInHours == 1){last_seen = 'An hour ago'}
      if(seenInHours > 1){
        last_seen = seenInHours + ' hours ago';
      }
      if(seenInDays == 1){last_seen = 'A day ago'}
      if(seenInDays > 1){
        last_seen = seenInDays +' days ago';
      }
      if(seenInWeeks == 1){last_seen = 'A week ago'}
      if(seenInWeeks > 1){
        last_seen = seenInWeeks + ' weeks ago';
      }
      var types = [];
      var picture = default_profile_url;
      var vehicle_type = $('#vehicle_type').find('option');
      if(typeof vehicle_type == 'array'){
          vehicle_type.each(function(){
          if($(this).val() == driverData.vehicle_types[0]){
            types.push($(this).attr('name'));
          }
        })
      }
      types = types.join(',')
      html_data= `<div class="box p-2  mt-5 all-tabss" id="${driverData.id}" style="box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);cursor:pointer" data-lat="${driverData.l[0]}" data-lng="${driverData.l[1]}">
                      <div class="d-flex flex-column flex-lg-row pb-2 mx-n5">
                          <div class="d-flex px-5 flex-1 align-items-start justify-content-center justify-content-lg-start">
                              <div class="d-flex ms-5">
                                  <div class="px-4 ct1">${driverData.name}</div>
                                  <input type="hidden" id="state_${driverData.id}" value="${text}">
                              </div>
                          </div>`;
                          if(!driverData.is_active )
                          {
                            html_data+= ` <div class="mt-6 mt-lg-0 flex-0 px-5">
                            <div class="  text-theme-6  px-5 mt-1.5 w-40 ct3" style="font-size:10px;">${text}</div>
                          </div>`;
                          }
                          else{

                              if(driverData.is_available)
                              {

                                html_data+= ` <div class="mt-6 mt-lg-0 flex-0 px-5">
                            <div class="text-theme-9 px-5 mt-1.5 w-40 ct3" style="color:green;font-size:10px;">${text}</div>
                          </div>`;
                              }
                              else{
                                html_data+= ` <div class="mt-6 mt-lg-0 flex-0 px-5">
                                <div class="bg-theme-14 text-theme-10 rounded px-5 mt-1.5 w-40 ct3" style="font-size:10px;">
                                ${text}</div>
                              </div>`;
                              }
                          }
                          if(driverData.profile_picture){ picture=driverData.profile_picture; }
                          if(demo !== 'demo'){mobile = driverData.mobile;}

                          html_data+= `</div>
                      <div class="box p-2">
                          <div class="position-relative d-flex align-items-center">
                              <div class="w-12 h-12 flex-none image-fit">
                                  <img alt="" class="rounded-circle" src="${picture}">
                              </div>
                              <div class="ms-4 me-auto">
                                  <div  style="font-size: 14px; padding: 5px;" class="fw-medium cm1">${types}</div>
                              </div>
                              <div class="fw-medium cm1">${mobile}</div>
                      </div>`;
                      if(driverData.is_active == 0){
                        html_data += `<div style="font-size: 14px; padding: 5px; text-align: right;">${last_seen}</div>`;
                      }
                      html_data += `</div>`;
                  return html_data;
    }

    function setmap(type,driverData,lastkey=false)
    {
      if(driverData.hasOwnProperty('is_available'))
      {
          var eligible_status = 0;
          if(type == "all")
          {
            eligible_status = 1;
          if(driverData.is_active == 1 && driverData.is_available === true)
          {
            var text = "Online";
          }
          if(driverData.is_active == 1 && driverData.is_available === false)
          {
            var text = "Onride";
          }
          if(driverData.is_active == 0)
          {
            var text = "Offline";
          }
          }
          if(type == "online")
          {
          if(driverData.is_active == 1 && driverData.is_available === true)
          {
            eligible_status = 1;
            var text = "Online";
          }
          }
          if(type == "offline")
          {
            if(driverData.is_active == 0)
            {
              eligible_status = 1;
              var text = "Offline";
            }
          }
          if(type == "onride")
          {
            if(driverData.is_active == 1 && driverData.is_available === false)
            {
              eligible_status = 1;
              var text = "Onride";
            }
          }
          if(eligible_status == 1)
          {
                // alert("eligible_status");
              var latitude = driverData.l[0];
              var longitude = driverData.l[1];
              if(demo !== 'demo'){mobile = driverData.mobile;}
              // Create marker position
              var markerPosition = { 
                                      lat: latitude,
                                      lng: longitude,
                                      driver_id:driverData.id,
                                      name: driverData.name,
                                      mobile: mobile
                                    };

              driver_ids[type].push(driverData.id);
            // markerarray[type].push(markerPosition);
            // markerarray.push(markerPosition);

              driver_ids[type] = [...new Set(driver_ids[type])];
              (markerarray[type] || (markerarray[type] = [])).push(markerPosition);

              // Convert the array of marker positions to a Set to remove duplicates based on driver ID
              const uniqueMarkerPositions = Array.from(new Set(markerarray[type].map(pos => pos.driver_id)))
              .map(driver_id => markerarray[type].find(pos => pos.driver_id === driver_id));

              // Update markerarray[type] with the unique marker positions
              markerarray[type] = uniqueMarkerPositions;

              // Calculate the center of all marker positions
              var centerLat = default_latitude;
              var centerLng = default_longitude;

              // Set the map center to the calculated center
              map.setCenter({ lat: centerLat, lng: centerLng });
              map.setZoom(5);
              var html_datas = get_html_data(text,driverData);
              $(".driver-side-menu").append(html_datas);


          }
          if(lastkey)
          {
            if(typeof markerarray[type] == 'undefined'){
              var baseUrl = appUrl;
              html_data = "";
              html_data+= `<div class="box p-2 mt-5" style="height:400px;width:400px"><img src="${baseUrl}/images/no-drivers.png" style="height:100%;width:100%"></div>`;

              $(".driver-side-menu").append(html_data);
            }else{
              markerarray[type].forEach(function(markerPosition) {
                addMarker(markerPosition.lat,markerPosition.lng,markerPosition.driver_id,markerPosition.name, markerPosition.mobile);
              });
            }
          }
      }
    }
    function deleteSingleMarker(id)
    {
      var markerToRemove = markerMap[id];
      if (markerToRemove) {
          markerToRemove.setMap(null);
          delete markerMap[id];
      }
    }
    function addMarker(latitude, longitude,id,name,mobile) {

                var contentString = `<div class="p-2">
                    <h6><i class="fa fa-id-badge"></i> : ${name ?? '-' } </h6>
                    <h6><i class="fa fa-phone-square"></i> : ${mobile ?? '-'} </h6>
                </div>`;
                marker = new google.maps.Marker({
                  position: { lat: latitude, lng: longitude },
                  map: map,
                  title:contentString
              });

              var infowindow = new google.maps.InfoWindow({
                content: contentString
            });
              marker.addListener('click', function() {
                infowindow.setPosition(new google.maps.LatLng(latitude, longitude));
                infowindow.open(map);
            });
              // Push the marker to the array
              markerPositions.push(marker);
              markerMap[id] = marker;
    }
    function fetchDataFromFirebase(type = undefined,element=undefined) {
       database = firebase.database();
       $("li.nav-item").removeClass("actv");
      if(element === undefined || type=="all")
      {
        $("#all-tab").addClass("actv");
      }
      else{
        if (element instanceof jQuery) {
          element.addClass("actv");
        } else {
          element.classList.add("actv");
        }
      }
$(".driver-side-menu").html('');


var driverRef = database.ref('drivers').orderByKey().startAt("driver_");
if(type == "online")
{
var driverRef = database.ref('drivers').orderByChild("is_active").equalTo(1);
}
if(type == "offline")
{
var driverRef = database.ref('drivers').orderByChild("is_active").equalTo(0);
}
if(type == "onride")
{
var driverRef = database.ref('drivers').orderByChild("is_available").equalTo(false);
}


var driverIdPattern = "driver_"; // The pattern to match
removeMarkers();
markerarray = [];
driverRef.once("value", function(snapshot) {


var totalChildren = snapshot.numChildren();
if(totalChildren == 0)
{
    var baseUrl = appUrl;
  html_data = "";
 html_data+= `<div class="box p-2 mt-5" style="height:400px;width:400px"><img src="${baseUrl}/images/no-drivers.png" style="height:100%;width:100%"></div>`;

 $(".driver-side-menu").append(html_data);
}else{
var processedChildren = 0;

    snapshot.forEach(function(childSnapshot) {
      html_data = "";
      processedChildren++;
      var lastkey;
      // Check if this is the last child
      var driverData = childSnapshot.val();
        var driverKey = childSnapshot.key;

      if(driverKey.startsWith("driver_"))
      {
        if (processedChildren === totalChildren)
        {

          if(driverData.hasOwnProperty('is_available'))
          {
            setmap(type,driverData,true);
          }
          else{
              markerarray[type].forEach(function(markerPosition) {
                addMarker(markerPosition.lat,markerPosition.lng,markerPosition.driver_id,markerPosition.name,markerPosition.mobile);
              });

          }

        }
        else{
              setmap(type,driverData,false);
        }
      }
      else{
        if (processedChildren === totalChildren) {
          if(markerarray.length > 0){
            markerarray[type].forEach(function(markerPosition) {
              addMarker(markerPosition.lat,markerPosition.lng,markerPosition.driver_id);
            });
          }else{
            var baseUrl = appUrl;
            html_data = `<div class="box p-2 mt-5" style="height:400px;width:400px"><img src="${baseUrl}/images/no-drivers.png" style="height:100%;width:100%"></div>`;
            $(".driver-side-menu").append(html_data);
          }
        }
      }
    });
  }
});
}
document.querySelector(".hamburger").addEventListener("click", function () {
      document.querySelector("nav").classList.toggle("toggle-menu")
  });

  document.querySelector(".close").addEventListener("click", function () {
      document.querySelector("nav").classList.toggle("toggle-menu")
  });
  // window.onload = fetchDataFromFirebase;

  $(document).ready(function() {
    setTimeout(function() {
      shouldProcessChildAdded = true;
      shouldProcessSosChildAdded = true;
      }, 3000);
            // setInterval(function(){

            // var data_val = $("li.nav-item.actv").attr("data-val");
            // // alert(data_val);
            // fetchDataFromFirebase(data_val,$("li.nav-item.actv"));
            // }, 60000);
            fetchDataFromFirebase('all');
            const dbRef = firebase.database().ref();
            dbRef.child("drivers").on("child_changed", (snapshot) => {
              if (snapshot.exists()) {

                driverData = "";
                 driverData = snapshot.val();
                 const driverId = snapshot.key;
                 if (driverId.startsWith("driver_")) {
                 var data_val = $("li.nav-item.actv").attr("data-val");

                 if(data_val == "online")
                 {
                  var append_status = 0;
                  if(driverData.is_active == 1 && driverData.is_available == true)
                  {
                    var text = "Online";
                    if (!driver_ids[data_val].includes(driverData.id)) {
                        append_status = 1;
                        driver_ids[data_val].push(driverData.id);
                        var latitude = driverData.l[0];
                        var longitude = driverData.l[1];
                        addMarker(latitude,longitude,driverData.id);
                    }
                  }
                  else{
                     $("#"+driverData.id).remove();
                     deleteSingleMarker(driverData.id);
                     const index = driver_ids[data_val].indexOf(driverData.id);
                      if (index !== -1) {
                        driver_ids[data_val].splice(index, 1);
                      }
                  }
                 }
                 if(data_val == "offline")
                 {
                  var append_status = 0;
                  if(driverData.is_active == 0 && driverData.is_available == true)
                  {
                    var text = "Offline";
                    if (!driver_ids[data_val].includes(driverData.id)) {
                     append_status = 1;
                     driver_ids[data_val].push(driverData.id);
                     addMarker(driverData.l[0],driverData.l[1],driverData.id);
                    }
                  }
                  else{
                    deleteSingleMarker(driverData.id);
                    $("#"+driverData.id).remove();
                  }
                 }
                 if(data_val == "onride")
                 {
                  var append_status = 0;
                  if(driverData.is_available == true)
                  {

                    deleteSingleMarker(driverData.id);
                    $("#"+driverData.id).remove();
                  }
                  else{
                    var text = "Onride";
                    if (!driver_ids[data_val].includes(driverData.id)) {
                        append_status = 1;
                        driver_ids[data_val].push(driverData.id);
                        addMarker(driverData.l[0],driverData.l[1],driverData.id);
                    }
                  }
                 }
                 if(data_val == "all"){
                    var text  = '';
                    if(driverData.is_active){
                      if(driverData.is_available){
                        text= 'online';
                      }else{
                        text= 'onride';
                      }
                    }else{
                      text= 'offline';
                    }
                    html_data = "";
                    if(text !== $('#state_'+driverData.id).val()){
                      var html_datas = get_html_data(text,driverData);
                      $("#"+driverData.id).remove();
                      if(text == "offline"){
                        $(".driver-side-menu").append(html_datas);
                      }else{
                        $(".driver-side-menu").prepend(html_datas);
                      }
                    }
                    $('#state_'+driverData.id).val(text);
                 }
                 if(append_status == 1)
                 {
                  html_data = "";
                  var html_datas = get_html_data(text,driverData);
                  $(".driver-side-menu").prepend(html_datas);
                 }
                }

              } else {
                console.log("No data available");
              }
            });
            dbRef.child("drivers").on("child_added", (childSnapshot) => {
              if (shouldProcessChildAdded)
              {
              const driverId = childSnapshot.key;
              const driverData = childSnapshot.val();
                 if (driverId.startsWith("driver_")) {

                 var data_val = $("li.nav-item.actv").attr("data-val");
                 if(data_val == "all")
                 {
                  var append_status = 0;

                    if (!driver_ids[data_val].includes(driverData.id)) {
                     append_status = 1;
                     driver_ids[data_val].push(driverData.id);
                     var text = "Online";
                    }
                 }
                 if(data_val == "online")
                 {
                  var append_status = 0;
                  if(driverData.is_active == 1 && driverData.is_available == true)
                  {
                    var text = "Online";
                    if (!driver_ids[data_val].includes(driverData.id)) {
                     append_status = 1;
                     driver_ids[data_val].push(driverData.id);

                    }
                  }
                  else{
                     $("#"+driverData.id).remove();
                     const index = driver_ids[data_val].indexOf(driverData.id);
                      if (index !== -1) {
                        driver_ids[data_val].splice(index, 1);
                      }
                  }
                }


                 if(append_status == 1)
                 {
                  html_data = "";
                  var html_datas = get_html_data(text,driverData);
                  $(".driver-side-menu").prepend(html_datas);
                 }
                }
                }
              }, (error) => {
              console.error("Error listening for new drivers:", error);
              });

            $(document).on("click", ".all-tabss", function(event) {
              if(event.type == "click")
              {
                removeMarkers();
                var lat = parseFloat($(this).attr("data-lat"));
                var lng = parseFloat($(this).attr("data-lng"));
                var id = parseFloat($(this).attr("id"));
                setTimeout(function() {
                  addMarker(lat,lng,id);
                }, 100);
                var zoomLevel = 12; // Adjust as needed
                var animationDuration = 1000; // Adjust the duration of the animation in milliseconds

                // Pan to the specified location with animation
                map.panTo({ lat: lat, lng: lng });

                // Start the zoom animation
                var startZoom = map.getZoom();
                var zoomDifference = zoomLevel - startZoom;
                var increment = zoomDifference > 0 ? 1 : -1;
                var stepDuration = animationDuration / Math.abs(zoomDifference);

                function zoomStep() {
                    if ((increment > 0 && map.getZoom() < zoomLevel) || (increment < 0 && map.getZoom() > zoomLevel)) {
                        map.setZoom(map.getZoom() + increment);
                        setTimeout(zoomStep, stepDuration);
                    }
                }
                zoomStep();
              }
        });


});

function toggleActiveTab(tabId) {
  // Remove "active" class from all tabs
  var tabs = document.querySelectorAll('.nav-link');
  tabs.forEach(function(tab) {
      tab.classList.remove('active');
  });

  // Add "active" class to the clicked tab
  var clickedTab = document.getElementById(tabId);
  clickedTab.querySelector('.nav-link').classList.add('active');

  // Call the fetchDataFromFirebase function with the respective parameter
  var tabValue = clickedTab.getAttribute('data-val');
  // fetchDataFromFirebase(tabValue, clickedTab);
}
