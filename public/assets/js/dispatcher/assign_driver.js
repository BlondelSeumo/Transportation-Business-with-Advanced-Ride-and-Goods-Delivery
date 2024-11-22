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
var mobile = "**********";
var markerMap = {};
var marker; 
var type; 
var database; 
var shouldProcessChildAdded = false;
var baseUrl = appUrl;
  var modal;
  function popup_init(){
       modal = document.getElementById("modal1");
      modal.style.display = "flex";
    }
    function popup_data(model_content){
      $(".model-content-wrapping").html(model_content);
      modal.style.display = "flex"; 
  
    }
    function popup_close()
    {
        setTimeout(function() { 
            modal = document.getElementById("modal1");
            modal.style.display = "none";
            var clickedTab = document.getElementById("online-tab");
            clickedTab.querySelector('.nav-link').classList.add('active');
          
            // Call the fetchDataFromFirebase function with the respective parameter
            var tabValue = clickedTab.getAttribute('data-val');
            fetchDataFromFirebase(tabValue,clickedTab);
        }, 500); 
     
    }
   
  function assign_driver(id,request_id)
{
  // alert(id);
  $("#loader").show();
                    $(".bg-loader").addClass("actv");
    $.ajax({
                    url: baseUrl+'/assign-manual/'+request_id,
                    type: "get",
                    data: {driver_id:id},
                    success: function(result) { 
                      $("#loader").hide();
                      $(".bg-loader").removeClass("actv");
                      popup_init();
                      popup_data(` 
                          <div class="popup-card">
                          
                          <div class="popup-card-content">
                          
                              <img src="${baseUrl}/assets/img/assign.png" style="margin:auto;width: 250px;" alt="">
                              <h1>Driver Assigned Successfully</h1>
                              <br>
                              <p class="driver_confirmation" style="font-size:16px;color:#d62727;">Waiting for Driver Accepting...</p>
                              <a class="btn btn-success" onclick="popup_close()" style="font-size:16px;margin: auto;margin-top: 20px;" href="#">Close</a>
                          </div>
                          </div>
                      `);
                      // setTimeout(function() { 
                      //     window.location.href = baseUrl+'/dispatch/detailed-view/'+request_id; 
                      // }, 500); 
                    }
                });
}

    function removeMarkers() {  
      for (var i = 0; i < markerPositions.length; i++) { 
        markerPositions[i].setMap(null); // Remove the marker from the map
      }
      markerPositions = [];
      markerMap = {};
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
  
  function deg2rad(deg) {
      return deg * (Math.PI / 180);
  }
    function get_html_data(text,driverData){
      var distance = calculateDistance(pick_lat,pick_lng,driverData.l[0],driverData.l[1]);
       
                          if(demo !== 'demo'){mobile = driverData.mobile;}
       

      html_data+=`<div class="intro-y g-col-12 g-col-md-12 all-tabss" id="${driverData.id}" data-lat="${driverData.l[0]}" data-lng="${driverData.l[1]}" style="background:#F3F4F4;box-shadow:  0px 0px 8px 1px rgba(0,0,0,0.3);cursor:pointer">
      <div class="box fs mt-10">
          <div class="d-flex flex-column flex-lg-row align-items-center p-5">
              <div class="w-24 h-24 w-lg-32 h-lg-32 image-fit me-lg-1">
                  <img alt="" class="img-fluid rounded-circle" src="${baseUrl}/assets/img/user-dummy.svg">
              </div>
              <div class="ms-lg-2 me-lg-auto text-center text-lg-start mt-3 mt-lg-0">
              <div class="fs p-2"><i class="fa fa-user me-5"></i>${driverData.name} <strong class="mx-2">${driverData.rating}<i class="fa fa-star" style="color:yellow"></i></strong></div>
              <div class="fs p-2"><i class="fa fa-phone me-5"></i>${mobile}</div> 
              </div>
              <div class="ms-lg-2 me-lg-3 text-center text-lg-center mt-3 mt-lg-0">`;

              if(!driverData.is_available )
                          {
                            html_data+= ` <p class="fs mb-2" style="background:#E1FBDE;color:64C319;padding:5px 10px;border-radius:5px;">${text}</p><p class="fs mb-2">${distance.toFixed(2)}km Away</p>`;
                          }
                          else{

                                if(driverData.is_active)
                              {
                                
                                html_data+= ` <p class="fs mb-2" style="background:#E1FBDE;color:64C319;padding:5px 10px;border-radius:5px;">${text}</p><p class="fs mb-2">${distance.toFixed(2)}km Away</p> <button class="btn py-1 px-2 me-2 fs" style="background:#8242F1;color:white;font-weight:800;" data-val="${driverData.id}" onclick="assign_driver('${driverData.id}','${request_id}')">Assign</button>`;
                              }
                              else{
                                html_data+= ` <p class="fs mb-2" style="background:#E1FBDE;color:64C319;padding:5px 10px;border-radius:5px;">${text}</p><p class="fs mb-2">${distance.toFixed(2)}km Away</p>`;
                              }
                          } 
                          html_data+= `</div></div></div></div>`;
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
          if(driverData.is_available === false)
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
            if(driverData.is_available === false)
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
              // Create marker position
              var markerPosition = { lat: latitude, lng: longitude ,driver_id:driverData.id}; 
            
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
              var centerLat = 0;
              var centerLng = 0;

              markerarray[type].forEach(function(markerPosition) {
                  centerLat += markerPosition.lat;
                  centerLng += markerPosition.lng;
              });

              centerLat /= markerarray[type].length;
              centerLng /= markerarray[type].length; 
              // Set the map center to the calculated center
              map.setCenter({ lat: centerLat, lng: centerLng }); 
              map.setZoom(5); 
              var html_datas = get_html_data(text,driverData); 
              $(".driver-side-menu").append(html_datas);
            
        
          }  
          if(lastkey)
          {  
            markerarray[type].forEach(function(markerPosition) {
              addMarker(markerPosition.lat,markerPosition.lng,markerPosition.driver_id);
            });
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
    function addMarker(latitude, longitude,id) {
                marker = new google.maps.Marker({
                  position: { lat: latitude, lng: longitude },
                  map: map, // Assuming 'map' is your initialized map object
                  title: "Marker" // You can set a title if needed
              });

              // Push the marker to the array
              markerPositions.push(marker);
              markerMap[id] = marker;  
    }
    var data_array = [];
    function fetchDataFromFirebase(type = undefined,element=undefined) {
       database = firebase.database();
       var requestRef = database.ref('requests');
        
       requestRef.child(request_id).on("value", (snapshot) => {
        // if(shouldProcessChildAdded){
          var snapshot = snapshot.val();
          if(snapshot.hasOwnProperty('is_accept'))
          {
              if(snapshot.is_accept == 1)
              {
                window.location.href = baseUrl+'/dispatch/detailed-view/'+request_id;    
              }
          }
          if(snapshot.hasOwnProperty('driver_rejected_ids'))
          {
            var data_value = snapshot.driver_rejected_ids;
            const difference = data_value.filter(value => !data_array.includes(value));
            
            if(difference.length > 0){
            $(".driver_confirmation").html('Driver Rejected the Request')
            }
            for(var i=0;i<data_value.length;i++)
            { 
            data_array.push(data_value[i]); 
            data_array = [...new Set(data_array)];  
            }
          }
        // }
      });
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
                addMarker(markerPosition.lat,markerPosition.lng,markerPosition.driver_id);
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
            html_data = `<div class="box p-2 mt-5" style="height:400px;width:400px"><img src="${baseUrl}/images/no-drivers.png" style="height:100%;width:100%"></div>`;
            $(".driver-side-menu").append(html_data);
          }
        }
      }
    });
  }
});
}
// document.querySelector(".hamburger").addEventListener("click", function () { 
//       document.querySelector("nav").classList.toggle("toggle-menu") 
//   });

//   document.querySelector(".close").addEventListener("click", function () { 
//       document.querySelector("nav").classList.toggle("toggle-menu") 
//   });
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
                //  alert(data_array);
                 if (!data_array.includes(driverData.id)) { 
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
                 if(append_status == 1)
                 { 
                  console.log("sdfdsf");
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
                 if (!data_array.includes(driverData.id)) { 
                  var append_status = 0;  
                 }
                 else{
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
                     console.log(driver_ids[data_val].length);
                      $("#"+driverData.id).remove(); 
                      const index = driver_ids[data_val].indexOf(driverData.id); 
                       if (index !== -1) {
                         driver_ids[data_val].splice(index, 1);
                       } 
                   }
                 }
                 }  
                
                 if(append_status == 1)
                 { 
                  console.log("driver_ids[data_val].length");
                  html_data = "";
                  var html_datas = get_html_data(text,driverData);
                  $(".driver-side-menu").prepend(html_datas);
                 }
                } 
                } 
              }, (error) => {
              console.error("Error listening for new drivers:", error);
              }); 
            
            // $(document).on("mouseleave",".driver-side-menu",function(event){
             
            //     var latitude,longitude; 
            //     var data_val = $("li.nav-item.actv").attr("data-val");    
            //     if(markerarray[data_val] !== undefined)
            //     {
            //       fetchDataFromFirebase(data_val,$("li.nav-item.actv")); 
            //     }
                
            //     // map.setZoom(5); 
            // })
            $(document).on("click", ".all-tabss", function(event) { 
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