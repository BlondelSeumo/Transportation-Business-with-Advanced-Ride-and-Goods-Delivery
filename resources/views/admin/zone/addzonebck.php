  <style>
        .dropbtn {
            background-color: #4CAF50;
            color: white;
            padding: 12px;
            font-size: 17px;
            border: none;
            cursor: pointer;
            border-radius: 50%;
        }

        .dropbtn:hover, .dropbtn:focus {
            background-color: #3e8e41;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            overflow: auto;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        }

        .dropdown-content a {
            color: black;
            padding: 12px 20px;
            text-decoration: none;
            display: block;
        }

        .dropdown a:hover {
            background-color: #f1f1f1
        }

        .show {
            display: block;
        }

        .sk-cube-grid {
            width: 400px;
            padding: 22% 47%;
            background: white;
            top:0px;
            height: 400px;

        }

        .sk-cube-grid .sk-cube {
            width: 33%;
            height: 33%;
            background-color: #333;
            float: left;
            -webkit-animation: sk-cubeGridScaleDelay 1.3s infinite ease-in-out;
            animation: sk-cubeGridScaleDelay 1.3s infinite ease-in-out;
        }
        .sk-cube-grid .sk-cube1 {
            -webkit-animation-delay: 0.2s;
            animation-delay: 0.2s; }
        .sk-cube-grid .sk-cube2 {
            -webkit-animation-delay: 0.3s;
            animation-delay: 0.3s; }
        .sk-cube-grid .sk-cube3 {
            -webkit-animation-delay: 0.4s;
            animation-delay: 0.4s; }
        .sk-cube-grid .sk-cube4 {
            -webkit-animation-delay: 0.1s;
            animation-delay: 0.1s; }
        .sk-cube-grid .sk-cube5 {
            -webkit-animation-delay: 0.2s;
            animation-delay: 0.2s; }
        .sk-cube-grid .sk-cube6 {
            -webkit-animation-delay: 0.3s;
            animation-delay: 0.3s; }
        .sk-cube-grid .sk-cube7 {
            -webkit-animation-delay: 0s;
            animation-delay: 0s; }
        .sk-cube-grid .sk-cube8 {
            -webkit-animation-delay: 0.1s;
            animation-delay: 0.1s; }
        .sk-cube-grid .sk-cube9 {
            -webkit-animation-delay: 0.2s;
            animation-delay: 0.2s; }

        @-webkit-keyframes sk-cubeGridScaleDelay {
            0%, 70%, 100% {
                -webkit-transform: scale3D(1, 1, 1);
                transform: scale3D(1, 1, 1);
            } 35% {
                  -webkit-transform: scale3D(0, 0, 1);
                  transform: scale3D(0, 0, 1);
              }
        }

        @keyframes sk-cubeGridScaleDelay {
            0%, 70%, 100% {
                -webkit-transform: scale3D(1, 1, 1);
                transform: scale3D(1, 1, 1);
            } 35% {
                  -webkit-transform: scale3D(0, 0, 1);
                  transform: scale3D(0, 0, 1);
              }
        }
    </style>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">
                        <h4 class="header">{{ trans('zone::content_message.add_zone')}}
                        </h4>

                        <form method="post" id="main-form" action="" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" id="form_type" name="type" value="new">

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="zone_admin" class="">@lang('view_pages.select_area')<sup>*</sup></label>
                                          <select name="admin_id" id="zone_admin" class="form-control" required>
                                <option value="" >@lang('view_pages.select_area')</option>
                                @foreach($services as $key=>$service)
                                <option value="{{$service->id}}">{{$service->name}}</option>
                                @endforeach
                                </select>
                                    </div>
                                </div>


                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label> @lang('view_pages.name')</label>
                                        <input class="form-control" id="zone_name" type="text" name="zone_name" value="" placeholder="@lang('view_pages.enter_name')" required>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="zone_admin" class="">@lang('view_pages.select_unit')<sup>*</sup></label>
                                          <select name="unit" id="unit" class="form-control" required>
                                            <option value="" selected disabled>@lang('view_pages.select_unit')</option>
                                            <option value="1">@lang('view_pages.kilo_meter')</option>
                                            <option value="2">@lang('view_pages.miles')</option>
                                        </select>
                                    </div>
                                </div>
                            </div>



                    <input style="top: 1%; left: 272px; width: 45%;display: none;" class="form-control" type="text" name="auto_input" dir="{{ trans('language_changer.text_format') }}" id="auto_input" value="" placeholder="{{ trans('zone::content_message.search').' '.trans('zone::content_message.place') }}">

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-md-12 col-sm-12">

                                <div class="sk-cube-grid" id="loader" style="z-index: 1;position: absolute;width: 100%;">
                                    <div class="sk-cube sk-cube1" style="width: 20px;height: 20px;"></div>
                                    <div class="sk-cube sk-cube2" style="width: 20px;height: 20px;"></div>
                                    <div class="sk-cube sk-cube3" style="width: 20px;height: 20px;"></div>
                                    <div class="sk-cube sk-cube4" style="width: 20px;height: 20px;"></div>

                                    <p style="text-align: center;font-weight: bold;width: 81px;margin-left: -10px;">@lang('view_pages.getting_map_data')</p>
                                </div>

                                <div id="map" style="width: 100%;height: 400px;">

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- dropdown menu-->
                    <ul id="side-menu" style="display: none;position: absolute;z-index: 1;width: 100%;">
                        <li class="dropdown-content" style="display: block;"><a style="padding: 6px 19px;" href="#" class="tool1" data-id="reset">
                                <i class="fa fa-refresh" aria-hidden="true"></i>@lang('view_pages.reset')
                            </a>
                        </li>
                    </ul>

                    <ul id="drop"  style="left: 91%; margin-top: 1%;display: none;">
                        <li class="dropdown-content" style="position:relative;display: block;right: 20%;"><a href="#" class="tool1" data-id="pen">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li class="dropdown-content" style="position: relative;display: block;right: 20%;">
                            <a href="#" class="tool1 tmp-tool" style="display: none;" data-id="delete"><i
                                        class="fa fa-trash-o" aria-hidden="true"></i>
                            </a>
                        </li>

                        <li class="dropdown-content" style="position: relative;display: block;right: 20%;">
                            <a href="#" class="tool1" id="undo" style="display: none;" data-id="undo"><i
                                        class="fa fa-undo" aria-hidden="true"></i>
                            </a>
                        </li>

                    </ul>

                            <div class="form-group text-right m-b-0"><br>
                                <button class="btn btn-custom waves-effect waves-light" type="submit">
                                    @lang('view_pages.save')
                                </button>
                            </div>

                        </form>
                </div>

             {{--<div class="dropdown" id="drop">
                 <button type="button" onclick="myFunction()" data-toggle="tooltip" data-placement="top"
                         title="Click To Select Tool" class="dropbtn"><i class="fa fa-bars fa-6"
                                                                         aria-hidden="true"></i>
                 </button>
                 <div id="myDropdown" class="dropdown-content">
                     <a href="#" class="tool1" data-id="pen"><i class="fa fa-pencil" aria-hidden="true"></i>
                     </a>
                     <a href="#" class="tool1 tmp-tool" style="display: none;" data-id="delete"><i
                                 class="fa fa-trash-o" aria-hidden="true"></i>
                         </i>
                     </a>
                 </div>
             </div>--}}

         </div>
         </div>
         </div>
         </div>






    <script src="{{asset('assets/vendor_components/jquery/dist/jquery.js')}}"></script>

    <script type="application/javascript">
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();

            //global variables
            var a1 = new ajax(); //ajax object
            var pen_active=false; //pen tool status
            var history=[]; //history array
            var map1 = new map(-34.397, 150.644); //map object
            var compeleted = false; //shape status
            var all_ploygon = []; //ploygon array
            var shape_len; //shape length
            var lis = new listen(); //lister object


            /* listen to the tilesloaded event
             if that is triggered, google maps is loaded successfully for sure */
            google.maps.event.addListener(map1.newmap, 'tilesloaded', function() {

                $('#auto_input,#drop').show();
                var input = document.getElementById('auto_input');
                var tool = document.getElementById('drop');
                //content inside the map
                map1.newmap.controls[google.maps.ControlPosition.TOP_RIGHT].push(tool);
                map1.newmap.controls[google.maps.ControlPosition.TOP_CENTER].push(input);

                //hide loader
                $('#loader').animate({'display':'none','z-index':"0"},800);
                $('#auto_input').css("margin-top","1%");

                //clear the listener, we only need it once
                google.maps.event.clearListeners(map1.newmap, 'tilesloaded');
            });

            //submit off for enter key
            $('#main-form').on('keyup keypress', function(e) {
                var keyCode = e.keyCode || e.which;
                if (keyCode === 13) {
                    e.preventDefault();
                    return false;
                }
            });

            //ctrl+z undo
            $('#map').keydown(function (e) {

                if(e.keyCode == 90 && e.ctrlKey)
                {
                    var t = new tools();
                    compeleted?t.undo():"";
                }
            });


            //right click menu
            $('#map').mousedown(function (e) {
                if(e.button == 2 && pen_active)
                {
                    $('#side-menu').css({"top":e.pageY-105,"left":e.pageX-262}).show();
                }
                if(e.button == 1)
                {
                    $('#side-menu').css({"display":"none"});
                }
            });


            //animation for input
            $('#auto_input').focusin(function(e)
            {

                $(this).animate({top:"20px"},"slow");
            });

            //animation for input
            $('#auto_input').focusout(function(e)
            {

                $(this).animate({top:"0px"},"slow");
            });


            //click event for tools
            $('.tool1').click(function (e) {
                // $('.tool1').css('background-color','white');
                $(this).css('background-color','#e63b3b');
                $(this).find("i").css('color','white');
                e.preventDefault();
                var tool = $(this).attr('data-id');
                var t = new tools();
                switch (tool) {
                    case "pen":
                        t.drawcondition(tool);
                        break;
                    case "undo":
                        t.undo();
                        break;
                    case "delete":
                        t.shapedelete();
                        break;
                    case "reset":
                        t.reset();
                }
            });




            //edit form
            $('#main-form-edit').submit(function (e) {
                var url = $(this).attr("action");
                var test = $(this)[0];
                var len = test.length;
                var c = new custom_validate();


                for (var i = 0; i < len; i++) {
                    switch (test[i].name) {
                            // case "zone_name":
                        case "type[]":
                        case "typeid[]":
                        case "service_visible[]":
                            if (!c.czone_json(test[i], i, test[i].value)) {
                                return false;
                            }
                            break;
                        case "service_base_price[]":
                        case "service_price_distance[]":
                        case "service_price_time[]":
                        case "service_max_size[]":

                            if (!c.cservice_base_price(test[i], i, test[i].value)) {
                                return false;
                            }
                            break;

                        case "admin_percentage[]":
                            if (!c.czone_admin_percent(test[i], i, test[i].value)) {
                                return false;
                            }
                            break;


                    }
                }

                var data = $(this).serialize();
                //send ajax for edit
                a1.send(url, 'post', data, a1.success, a1.error);
                return false;

            });


            //add zone
            $('#main-form').submit(function (e) {
                var url = $(this).attr("action");
                var test = $(this)[0];
                var len = test.length;
                var c = new custom_validate();


                for (var i = 0; i < len; i++) {
                    switch (test[i].name) {
                        case "zone_name":
                        case "type[]":
                        case "typeid[]":
                        case "service_visible[]":
                            if (!c.czone_json(test[i], i, test[i].value)) {
                                return false;
                            }
                            break;
                        case "service_base_price[]":
                        case "service_price_distance[]":
                        case "service_price_time[]":
                        case "service_base_distance[]":
                        case "service_max_size[]":

                            if (!c.cservice_base_price(test[i], i, test[i].value)) {
                                return false;
                            }
                            break;

                        case "admin_percentage[]":
                            if (!c.czone_admin_percent(test[i], i, test[i].value)) {
                                return false;
                            }
                            break;
                    }
                }

                //check zone is present or not

                if(all_ploygon == '' || typeof all_ploygon != 'object'){
                    alert('Draw your zone in map using pen tool');
                    return false;
                }

                if ((all_ploygon == '' || typeof all_ploygon != 'object') && compeleted) {
                    alert('Draw your zone in map using pen tool');
                    return false;
                }

                var data = $(this).serialize() + '&zone_json=' + JSON.stringify(all_ploygon);

                console.log(data);
                //send zone data to add
                a1.send(url, 'post', data, a1.success, a1.error);
                return false;
            });



            //custom validate functions ---start
            function custom_validate() {

            }

            custom_validate.prototype.greater_hundred= function (value) {


                if((value < 100) && (value > 0) ){
                    return true;
                }else{

                    return false;
                }

            };


            custom_validate.prototype.required = function (value) {
                return value ? true : false;
            };
            custom_validate.prototype.isnum = function (value) {
                if (!isNaN(value)) {
                    return true;
                } else {
                    return false;
                }
            };

            custom_validate.prototype.error = function (obj, index, error) {


                if (obj.name == 'zone_name') {
                    alert('zone name is required');
                }
                else {
                    var type = $(obj).attr('data-type');
                    var name = $(obj).attr('title');
                    var msg;


                    if(error=='gr'){
                        msg = 'is between 1-100';

                    }else if (error == 're') {
                        msg = 'is required';
                    } else {
                        msg = 'is not a integer';
                    }
                    alert(type + ' ' + name + ' ' + msg);

                }
                return false;
            };

            custom_validate.prototype.czone_json = function (obj, index, value) {
                if (!this.required(value)) {
                    return this.error(obj, index, 're')
                }
                return true;
            };


            custom_validate.prototype.czone_admin_percent = function (obj, index, value) {

                var id = $(obj).attr('data-id');
                /*if ($('#visible_' + id)[0].checked) {

                    if (!this.required(value)) {
                        return this.error(obj, index, 're')
                    }

                    if(!this.greater_hundred(value)){
                        return this.error(obj, index, 'gr')
                    }
                }*/
                return true;
            };

            custom_validate.prototype.cservice_base_price = function (obj, index, value) {
                var id = $(obj).attr('data-id');
                if ($('#visible_' + id)[0].checked) {
                    if (!this.required(value)) {
                        return this.error(obj, index, 're')
                    }


                    if (!this.isnum(value)) {

                        return this.error(obj, index, 'num')
                    }
                }
                return true;
            };
            //custom validate function ----end


            //tools functions -----start
            function tools() {

            }

            tools.prototype.drawcondition = function (tool) {
                if (!compeleted) {
                    if(pen_active)
                    {
                        this.reset();
                    }
                    else {
                        switch (tool) {
                            case 'pen':
                                this.setpen();
                                break;
                            default:
                                this.setpen();
                                break;
                        }
                    }

                }
                else {
                    alert('Can\'t Draw more than one Zone Area');
                    lis.toolcolorchange();
                }
            };

            //setpen
            tools.prototype.setpen = function () {
                var polyOptions = {
                    strokeWeight: 0,
                    fillOpacity: 0.45
                };myFunction();
                map1.drawingManager = new google.maps.drawing.DrawingManager({
                    drawingControl: false,
                    polygonOptions: polyOptions
                });
                map1.drawingManager.setOptions({
                    drawingMode: google.maps.drawing.OverlayType.POLYGON
                });
                map1.drawingManager.setMap(map1.newmap);
                google.maps.event.addListener(map1.drawingManager, 'overlaycomplete', test);
                pen_active=true;
            };

            //reset
            tools.prototype.reset = function () {
                map1.drawingManager.setMap(null);
                lis.toolcolorchange();
                $('#side-menu').hide();
                pen_active=false;
            };


            /* tools.prototype.setrect = function () {

             map1.drawingManager.setOptions({
             drawingMode: google.maps.drawing.OverlayType.RECTANGLE
             });
             map1.drawingManager.setMap(map1.newmap);
             };
             */


            //delete
            tools.prototype.shapedelete = function () {
                if (confirm("Sure you want to delete this zone")) {
                    map1.mapPoly.setMap(null);
                    this.showtool();
                    all_ploygon = [];
                    compeleted = false;
                    shape_len = 0;
                    history = [];
                    lis.toolcolorchange();
                }

            };

            //showtool
            tools.prototype.showtool = function () {
                $('.tmp-tool').toggle();
            };

            tools.prototype.checkundotool = function () {
                if (map1.mapPoly != null) {
                    if (shape_len < map1.mapPoly.getPath().getLength()) {
                        if ($('.undo-tool').css('display') == 'none') {
                            $('.undo-tool').css('display', 'block');
                        }
                    }
                    else {
                        if ($('.undo-tool').css('display') != 'none') {
                            $('.undo-tool').css('display', 'none');
                        }
                    }
                }

            };



            //undo
            tools.prototype.undo = function () {
                if (history.length > 0) {
                    var len = map1.mapPoly.getPath().getLength();
                    for(i = 0; i < len; i++)
                    {
                        map1.mapPoly.getPath().pop();
                    }
                    len=history.length;
                    var undo = history[len-1];
                    var maplat = [];
                    for (i = 0; i < undo.length; i++) {
                        maplat.push(new google.maps.LatLng(undo[i].lat, undo[i].lng));
                    }
                    map1.draw(maplat);
                    history.pop();
                    lis.setarray(map1.mapPoly,true);
                    google.maps.event.addListener(map1.mapPoly.getPath(), "insert_at", lis.setarray);
                    //google.maps.event.addListener(map1.mapPoly.getPath(), "remove_at", lis.setarray);
                    google.maps.event.addListener(map1.mapPoly.getPath(), "set_at", lis.setarray);
                    lis.toolcolorchange();
                }

            };
            //tool function ----end





            //callback for completed drawing shape
            function test(e) {
                lis.toolcolorchange();
                pen_active=false;
                var shape = e.overlay;
                var t = new tools();
                t.showtool();
                lis.setarray(shape);
                if (e.type != 'marker') {
                    map1.drawingManager.setDrawingMode(null);
                }
                var maplat = [];
                for (i = 0; i < all_ploygon.length; i++) {
                    maplat.push(new google.maps.LatLng(all_ploygon[i].lat, all_ploygon[i].lng));
                }
                shape_len = shape.getPath().getLength();
                map1.draw(maplat);
                shape.setMap(null);

                google.maps.event.addListener(map1.mapPoly.getPath(), "insert_at", lis.setarray);
                //google.maps.event.addListener(map1.mapPoly.getPath(), "remove_at", lis.setarray);
                google.maps.event.addListener(map1.mapPoly.getPath(), "set_at", lis.setarray);
                compeleted = true;
            }



            //map function ------start
            function map(lat, long) {

                //new map
                this.newmap = new google.maps.Map(document.getElementById('map'), {
                    center: {lat: lat, lng: long},
                    zoom: 8
                });

                var input = document.getElementById('auto_input');


                //auto complete
                this.autocomplete= new google.maps.places.Autocomplete(input);
                this.autocomplete.addListener('place_changed', getaddress);


                this.mapPoly = null;
            }



            //callback for auto complete
            function getaddress()
            {
                var place = map1.autocomplete.getPlace();
                map1.newmap.setCenter(place.geometry.location);
                map1.newmap.setZoom(15);
            }

            //polygon draw
            map.prototype.draw = function (lat) {
                map1.mapPoly = new google.maps.Polygon({
                    paths: lat,
                    editable: true,
                    strokeColor: '#FF0000',
                    strokeOpacity: 0.8,
                    strokeWeight: 2,
                    fillColor: '#FF0000',
                    fillOpacity: 0.35
                });
                map1.mapPoly.setMap(map1.newmap);

            };

            //view draw
            map.prototype.view_draw = function (lat) {
                map1.mapPoly1 = new google.maps.Polygon({
                    paths: lat,
                    editable: false,
                    strokeColor: '#FF0000',
                    strokeOpacity: 0.8,
                    strokeWeight: 2,
                    fillColor: '#FF0000',
                    fillOpacity: 0.35
                });
                map1.mapPoly1.setMap(map1.newmap);
            };

            //map function ----end


            //listen function ----start
            function listen() {
            }

            //check status of history menu
            listen.prototype.checkhistory = function () {
                if(history.length > 0)
                {
                    $('#undo').show();

                }
                else {
                    $('#undo').hide();
                }
            };

            //setarray
            listen.prototype.setarray = function (shape,status) {
                if (typeof shape !== 'object') {
                    shape = map1.mapPoly;
                }
                var len = shape.getPath().getLength();
                var htmlStr = "";
                if((!status || typeof status === 'object') && all_ploygon.length > 0)
                {
                    var history_len=history.length;
                    history[history_len] = all_ploygon;
                }
                lis.checkhistory();
                all_ploygon = [];
                for (var i = 0; i < len; i++) {
                    htmlStr = shape.getPath().getAt(i).toJSON();
                    all_ploygon.push(htmlStr);
                    //history[history_len].push(htmlStr);
                }
            };

            listen.prototype.toolcolorchange =  function()
            {
                $('.tool1').css('background-color','#fff');//animate({'background-color':'white !important'},600);
                $('.tool1').find("i").css('color','black');//animate({'color':'black'},600);
            };



            //listen function ------end


            //ajax function -------start
            function ajax() {

            }

            //ajax sender
            ajax.prototype.send = function (url, type, data, success, error) {
                $.ajax({
                    url: url,
                    data: data,
                    type: type,
                    success: success,
                    error: error
                });
            };

            ajax.prototype.success = function (response, status) {

                var getUrl = window.location;
                var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1] + "/" + getUrl.pathname.split('/')[2] + "/admin/zone/view";

                if (status == 'success') {

                    //console.log("res"+response);alert("con");

                    if(document.getElementById('form_type').value == 'new')
                    {
                           // alert('Added Successfully');
                            window.location.href = baseUrl;
                    }
                    else {console.log(response);
                            alert('Update Successfully');
                            // window.location.href = baseUrl;
                    }
                    /*if(response.type == 'new')
                    {
                        alert('Added Successfully');
                        window.location.href = baseUrl;
                    }
                    else {console.log(response);
                        alert('Update Successfully');
                       // window.location.href = baseUrl;
                    }*/
                }
                else {
                    alert('Something went wrong');
                }

            };
            ajax.prototype.error = function (a, b, c) {
                console.log(a);
                console.log(b);
                console.log(c);
            };

            ajax.prototype.usuccess = function (response) {
                //alert(response);
                console.log(response.zone);
                var res = JSON.parse(response.zone);
                var maplat = [];
                for (i = 0; i < res.length; i++) {
                    maplat.push(new google.maps.LatLng(res[i].lat, res[i].lng));
                }
                map1.view_draw(maplat);
                map1.newmap.setCenter(new google.maps.LatLng(res[0].lat, res[0].lng));
                map1.newmap.setZoom(13);

            };


            function show_map() {
                var a5 = new ajax();
                var formData = {
                    'zoneId': $("#zone-view #zone_id").attr("value") //for get zone_id
                };
                a5.send($("#zone-view").attr("action"), "post", formData, a5.usuccess, a5.error);
            }

            show_map();

        });

    </script>


    <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgkO8chMIq3JSKLXwTTRuP7ByhkL3Wzxk&libraries=drawing,places">
    </script>
    <script>

        /* When the user clicks on the button,
         toggle between hiding and showing the dropdown content */
        function myFunction() {
            document.getElementById("drop").classList.toggle("show");//myDropdown
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function (event) {
            if (!event.target.matches('.dropbtn')) {

                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
