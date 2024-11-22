// cod jQuery

// activare tooltips
$('[data-toggle="tooltip"]').each(function() {
    var options = {
        html: true
    };
    // setari colorare tooltips
    if ($(this)[0].hasAttribute('data-type')) {
        options['template'] =
            '<div class="tooltip ' + $(this).attr('data-type') + '" role="tooltip">' +
            ' <div class="tooltip-arrow"></div>' +
            ' <div class="tooltip-inner"></div>' +
            '</div>';
    }

    $(this).tooltip(options);
});



//final cod JQuery



// inceput Javascript

// variabile globale
var map; // harta Google
var drawingManager; // obiectul care cuprinde majoritatea metodelor si proprietatilor necesare pentru desenare
var selectedShape; // ajuta la identificarea formei selectate
var selectedKernel; // ajuta la identificarea nucleului selectat
var gmarkers = []; // lista cu markerele care vor fi pozitionate in varfurile nucleului
var coordinates = []; // lista cu coordonatele varfurilor poligonului selectat
var infowindow = new google.maps.InfoWindow({
    size: new google.maps.Size(150, 50)
}); // infowindow care apare cand se da click pe markere
var allShapes = []; // lista cu toate formele desenate pe harta - ajuta pentru stergerea lor in acelasi timp
var sendable_coordinates = []; // lista cu toate formele desenate pe harta - ajuta pentru stergerea lor in acelasi timp
var shapeColor = "#007cff"; // culoare forma desenata
var kernelColor = "#000"; // culoare nucleu

// functie care copiaza textul primit ca parametru in clipboard
// Primeste ca parametri:
// text - document.getElementById('id-element').innerHTML,
// copymsg - document.getElementById('id-element')
function copyToClipboard(text, copymsg) {
    var temp = document.createElement('input');
    temp.type = 'input';
    temp.setAttribute('value', text);
    document.body.appendChild(temp);
    temp.select();
    document.execCommand("copy");
    temp.remove();
    copymsg.innerHTML = "Copiat în clipboard!"; // mesaj care se va afisa la executarea functiei
    setTimeout(function() { copymsg.innerHTML = "" }, 1000); // timp afisare mesaj
}


// schimba opacitatea containerului "opcard" atunci cand utilizatorul trece cursorul peste acest element
function changeOpacityHover() {
    var element = document.getElementById("opcard");
    element.classList.remove("ccard");
    element.classList.add("vcard");
}

// schimba opacitatea containerului "opcard" la forma initiala dupa ce cursorul nu se mai afla peste elementul "opcard"
function changeOpacityOut() {
    var element = document.getElementById("opcard");
    element.classList.remove("vcard");
    element.classList.add("ccard");
}

// Atribuie fiecarui marcator o harta
// parametrul "map" va fi trimis cu valoarea hartii Google sau cu "null"
function setMapOnAll(map) {
    for (var i = 0; i < gmarkers.length; i++) {
        gmarkers[i].setMap(map);
    }
}

// Ascunde toti marcatorii de pe harta
function clearMarkers() {
    setMapOnAll(null);
}


// Sterge toti marcatorii
function deleteMarkers() {
    clearMarkers();
    gmarkers = [];
}


// functie care sterge forma selectata
function deleteSelectedShape() {
    if (selectedShape) {
        selectedShape.setMap(null);
        var index = allShapes.indexOf(selectedShape);
        if (index > -1) {
            allShapes.splice(index, 1);
        }
        // document.getElementById('info').value = null; // actualizează lista de coordonate afisata
    }

    if (selectedKernel) {
        selectedKernel.setMap(null);
        // document.getElementById('info').value = null; // actualizează lista de coordonate afisata
    }
}



// functie care sterge toate formele de pe harta
function clearMap() {
    if (allShapes.length > 0) { // verific daca exista forme desenate

        for (var i = 0; i < allShapes.length; i++) // sterge toate formele
        {
            allShapes[i].setMap(null);
        }
        allShapes = [];
        deleteMarkers();
        document.getElementById('info').value = null;
        // document.getElementById('info').innerHTML = "Desenează un poligon. Aici vor apărea coordonatele vârfurilor sale și vor fi actualizate în timp real."; // actualizează lista de coordonate afisata

    }
}


// functie care seteaza culoarea formei selectate ca fiind cea aleasa de utilizator prin Color Picker

function update(picker) {
    shapeColor = picker.toHEXString();
    if (selectedShape) {
        selectedShape.setOptions({ fillColor: shapeColor });
    }
}



// a function that sets the color of the core selected as the one chosen by the user through the Color Picker
// function that cancels the current selection
function clearSelection() {
    if (selectedShape) { //check that the selected shape is a polygon
        if (selectedShape.type !== 'marker') {
            selectedShape.setEditable(false);
        }
        selectedShape = null;
    }

    if (selectedKernel) { // check to see if the selected shape is a core
        if (selectedKernel.type !== 'marker') {
            selectedKernel.setEditable(false);
        }
        selectedKernel = null;
    }
}

// function that selects a form and receives as parameters:
// shape - the form to be selected
// check - 0 = polygon, 1 = core
function setSelection(shape, check) {
    clearSelection();
    shape.setEditable(true);
    if (check) {
        selectedKernel = shape;
    } else { selectedShape = shape; }
}



//display function that saves in the list "coordinates" the coordinates of the points of the polygon given as parameter coordinates coordonatele varfurilor poligonului dat ca parametru
function getCoordinates(polygon) {
    var path = polygon.getPath();
    coordinates = [];
    for (var i = 0; i < path.length; i++) {
        coordinates.push({
            lat: path.getAt(i).lat(),
            lng: path.getAt(i).lng()
        });
    }
    return coordinates;
    // document.getElementById('info').value = coordinates;
}



// functie care creeaza un marker si primeste ca parametri
// coord = coordonatele unde va fi creat marker-ul
// nr = numarul marker-ului
// map = harta Google Maps
function createMarker(coord, nr, map) {
    var mesaj = "<h6>Vârf " + nr + "</h6><br>" + "Lat: " + coord.lat + "<br>" + "Lng: " + coord.lng;
    var marker = new google.maps.Marker({
        position: coord,
        map: map,
        //zIndex: Math.round(coord.lat * -100000) << 5
    });
    // displaying marker information at "click"
    google.maps.event.addListener(marker, 'click', function() {
        infowindow.setContent(mesaj);
        infowindow.open(map, marker);
    });
    google.maps.event.addListener(marker, 'dblclick', function() { // delete marker at "double click"

        marker.setMap(null);
    });
    return marker;
}


// function that offers functionality to the search box
function searchBox() {
    // Create the search box
    var input = document.getElementById('search-box');
    var searchBox = new google.maps.places.SearchBox(input);

    // Results relevant to the current location
    map.addListener('bounds_changed', function() {
        searchBox.setBounds(map.getBounds());
    });


    // Get more details on the selected place
    searchBox.addListener('places_changed', function() {
        var places = searchBox.getPlaces();
        if (places.length == 0) {
            return;
        }

        var bounds = new google.maps.LatLngBounds();
        places.forEach(function(place) {
            if (!place.geometry) {
                return;
            }
            var icon = {
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(25, 25)
            };

            if (place.geometry.viewport) {
                bounds.union(place.geometry.viewport);
            } else {
                bounds.extend(place.geometry.location);
            }
        });
        map.fitBounds(bounds);
    });

}

function findAvg(Coords) {
    var lat = [];
    var lng = [];
    var LatAndLng = [];
    Object.keys(Coords).forEach((key) => {
        lat.push(Coords[key][key].lat);
        lng.push(Coords[key][key].lng);
    });

    LatAndLng['lat'] = lat.reduce((a, b) => a + b) / lat.length
    LatAndLng['lng'] = lng.reduce((a, b) => a + b) / lng.length
    return LatAndLng;
}

// function that initializes the Google Maps, sets its options and calls other functions
function initMap() {
    var Lat = 51.0967515;
    var Lng = 5.966128;
    var latLng;
    var infoTag = document.getElementById('info');
    var zoomVal = 18;
    var locationCoords = [];
    var createdCoords = JSON.parse(document.getElementById('coords').value);

    if (infoTag.hasAttribute('data-type')) {
        locationCoords = document.getElementById('location_coordinates').value;

        if (locationCoords.length > 0) {
            locationCoords = JSON.parse(locationCoords);
            latLng = findAvg(locationCoords);
            Lat = latLng['lat'];
            Lng = latLng['lng'];
            zoomVal = 8;
        }
    }
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: zoomVal,
        center: new google.maps.LatLng(Lat, Lng),
        mapTypeControl: false, // disabled
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
            position: google.maps.ControlPosition.LEFT_CENTER
        },
        zoomControl: true,
        zoomControlOptions: {
            position: google.maps.ControlPosition.RIGHT_CENTER
        },
        scaleControl: false, // disabled
        scaleControlOptions: {
            position: google.maps.ControlPosition.RIGHT_CENTER
        },
        streetViewControl: false, // disabled
        fullscreenControl: false // disabled
    });

    if(createdCoords.length > 0){
        createdCoords.forEach(element => {
            for (let index = 0; index < element.length; index++) {
                new google.maps.Polygon({
                    map: map,
                    paths: element,
                    strokeColor: "#ff8c00",
                    strokeOpacity: 0.8,
                    strokeWeight: 2,
                    fillColor: "#ff8c00",
                    fillOpacity: 0.10
                });
            }    
        });
    }

    var i;
    for (i = 0; i < locationCoords.length; i++) {
        new google.maps.Polygon({
            map: map,
            paths: locationCoords[i],
            strokeColor: "#FF0000",
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: "#FF0000",
            fillOpacity: 0.25
            // geodesic: true
        });
    }

    searchBox();
    // settings for drawing shapes and drawing polygon
    var shapeOptions = {
        strokeWeight: 1,
        fillOpacity: 0.4,
        editable: true,
        draggable: true
    };

    // initializare Drawing Manager
    drawingManager = new google.maps.drawing.DrawingManager({
        // direct polygon drawing setting
        // drawingMode: google.maps.drawing.OverlayType.POLYGON,
        drawingMode: null,
        drawingControl: false, //dezactivat
        drawingControlOptions: {
            position: google.maps.ControlPosition.RIGHT_CENTER,
            drawingModes: ['polygon'] //  you can also add: 'marker', 'polyline', 'rectangle', 'circle'
        },
        polygonOptions: shapeOptions,
        map: map
    });
    google.maps.event.addListener(drawingManager, 'overlaycomplete', function(e) {
        var newShape = e.overlay;
        console.log(newShape);
        allShapes.push(newShape); // save the form to the allShapes list
        let lat_lng = [];
        allShapes.forEach(function(data, index) {
            lat_lng[index] = getCoordinates(data);
            console.log(lat_lng);
        });
        document.getElementById('info').value = JSON.stringify(lat_lng);

        newShape.setOptions({ fillColor: shapeColor }); // color form with the current value of shapeColor

        // getCoordinates(newShape); // find coordinates peaks
        let coordinates = getCoordinates(newShape);
        // console.log(coordinates);
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            /* the route pointing to the post function */
            url: "validate-stand",
            type: 'POST',
            /* send the csrf-token and the input to the controller */
            data: { _token: CSRF_TOKEN, coordinates: $("#info").val(), zone: $("#zone").val(), is_update: false },
            dataType: 'JSON',
            /* remind that 'data' is the response of the AjaxController */
            success: function(data) {
                console.log("vvrrrr");
            },
            error: function(response) {
                $.each(response.responseJSON.errors, function(key, value) {
                    alert(value);
                    clearMap();
                });
            }
        });
        // exit drawing mode after completion of the polygon
        drawingManager.setDrawingMode(null);
        setSelection(newShape, 0);
        // select polygon at "click"
        google.maps.event.addListener(newShape, 'click', function(e) {
            if (e.vertex !== undefined) {
                var path = newShape.getPaths().getAt(e.path);
                path.removeAt(e.vertex);
                getCoordinates(newShape);
                if (path.length < 3) {
                    newShape.setMap(null);
                }
            }
            setSelection(newShape, 0);
        });


        //update coordinates
        google.maps.event.addListener(newShape.getPath(), 'click', function(e) {
            getCoordinates(newShape);
        });
        google.maps.event.addListener(newShape.getPath(), "dragend", function(e) {

            let coordinates = getCoordinates(newShape);
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                /* the route pointing to the post function */
                url: "validate-zone",
                type: 'POST',
                /* send the csrf-token and the input to the controller */
                data: { _token: CSRF_TOKEN, coordinates: $("#info").val(), service_location_id: $("#service_location_id").val(), is_update: false },
                dataType: 'JSON',
                /* remind that 'data' is the response of the AjaxController */
                success: function(data) {
                    console.log("vvrrrr");
                },
                error: function(response) {
                    $.each(response.responseJSON.errors, function(key, value) {
                        alert(value);
                        clearMap();
                    });
                }
            });

        });
        google.maps.event.addListener(newShape.getPath(), "insert_at", function(e) {
            let coordinates = getCoordinates(newShape);
            // console.log(coordinates);
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                /* the route pointing to the post function */
                url: "validate-zone",
                type: 'POST',
                /* send the csrf-token and the input to the controller */
                data: { _token: CSRF_TOKEN, coordinates: $("#info").val(), service_location_id: $("#service_location_id").val(), is_update: false },
                dataType: 'JSON',
                /* remind that 'data' is the response of the AjaxController */
                success: function(data) {

                },
                error: function(response) {
                    $.each(response.responseJSON.errors, function(key, value) {
                        alert(value);
                        clearMap();
                    });
                }
            });

            getCoordinates(newShape);
        });
        google.maps.event.addListener(newShape.getPath(), "remove_at", function(e) { getCoordinates(newShape); });
        google.maps.event.addListener(newShape.getPath(), "set_at", function(e) {
            let coordinates = getCoordinates(newShape);
            // console.log(coordinates);
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                /* the route pointing to the post function */
                url: "validate-zone",
                type: 'POST',
                /* send the csrf-token and the input to the controller */
                data: { _token: CSRF_TOKEN, coordinates: $("#info").val(), service_location_id: $("#service_location_id").val(), is_update: false },
                dataType: 'JSON',
                /* remind that 'data' is the response of the AjaxController */
                success: function(data) {

                },
                error: function(response) {
                    $.each(response.responseJSON.errors, function(key, value) {
                        alert(value);
                        clearMap();
                    });
                }
            });

            getCoordinates(newShape);
        });

    });
    // Deselect the form when changing the drawing mode or when the user clicks on the map
    google.maps.event.addListener(drawingManager, 'drawingmode_changed', clearSelection);
    google.maps.event.addListener(map, 'click', clearSelection);


}
// start application
google.maps.event.addDomListener(window, 'load', initMap);
