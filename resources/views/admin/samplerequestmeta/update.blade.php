<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update FAQ</title>
</head>
<body>
    <h1>{{ $item }}</h1>


            <div id="itemDataDisplay1"></div>
            <div id="driverDataList1"></div>



            <h2> <div id="user_id"></div> </h2>
            <div id="userDetailsDiv"></div>


            <h2> <div id="requestNumber"></div></h2>
            <div id="itemDataDisplay"></div>
            <div id="seachingDriver"></div>


    <div id="driver_id_cancel"></div>
    <div id="driver_id_cancel1"></div>
    @foreach($driverRejectedRequest as $key => $result)
        @if($result->request_id === $item)
            <?php $driver_id = $result->driver_id; ?>
            <?php $created_at_time = $result->created_at; ?>
            <h2>Rejected Driver Id List</h2>
            <h4>{{ $driver_id }} rejected at {{ $created_at_time }}</h4>
        @endif
    @endforeach

    <h2>  <div id="driver_id"></div> </h2>
    <div id="DriverDetailsDiv"></div>

    <div id="DriverChecking"></div>
    <div id="tripchecking"></div>
    <div id="completechecking"></div>
    <div id="userCancelled"></div>
    <div id="driverCancelled"></div>



    <div class="driverCancelledDetail">

</div>






    <script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-database.js"></script>
    <script>
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
        firebase.initializeApp(firebaseConfig);
        const database = firebase.database();
        var requestsRef = database.ref('requests');

        var itemKey = "{{ $item }}";
        var itemDataDisplay = document.getElementById('itemDataDisplay');

        function displayItemData(itemData) {
            itemDataDisplay.innerHTML = '';
            document.getElementById('DriverChecking').innerHTML = '';
            document.getElementById('seachingDriver').innerHTML = '';
            document.getElementById('tripchecking').innerHTML = '';
            document.getElementById('completechecking').innerHTML = '';
            document.getElementById('userCancelled').innerHTML = '';
            document.getElementById('driverCancelled').innerHTML = '';
            document.getElementById('user_id').innerHTML = '';
            document.getElementById('driver_id').innerHTML = '';






            var paragraphTripStatus = document.createElement('p');
            var userId = itemData['user_id'];
            user_id.textContent = 'User Id :- ' + userId;




            var users = {!! json_encode($users) !!};
            var user = users.find(u => u.id == userId);
            if (user) {
                var userHtml = '<p>Name: ' + user.name + '</p>';
                userHtml += '<p>Email: ' + user.email + '</p>';
                userDetailsDiv.innerHTML = userHtml;
            }




            var requestNumberDiv = document.getElementById('requestNumber');
            var requestNumber = itemData['request_number'];
            requestNumberDiv.textContent = 'Request Number: ' + requestNumber;





            if (itemData) {
                var paragraphItemData = document.createElement('p');
                paragraphItemData.textContent = 'Item Data: ' + JSON.stringify(itemData);
                itemDataDisplay.appendChild(paragraphItemData);
                if (itemData.cancelled_by_user) {
        var paragraphTripStatus = document.createElement('p');
        paragraphTripStatus.textContent = 'The user has cancelled the booking.';
        userCancelled.appendChild(paragraphTripStatus);
    }

    if (itemData.is_accept) {
        var paragraphTripStatus = document.createElement('p');
        paragraphTripStatus.textContent = 'A driver has been found and has accepted the booking.';
        seachingDriver.appendChild(paragraphTripStatus);

        if (itemData.trip_arrived === "1") {
            var paragraphTripStatus = document.createElement('p');
            paragraphTripStatus.textContent = 'The driver has arrived.';
            DriverChecking.appendChild(paragraphTripStatus);

            if (itemData.trip_start === "1") {
                var paragraphTripStatus = document.createElement('p');
                paragraphTripStatus.textContent = 'The trip has started.';
                tripchecking.appendChild(paragraphTripStatus);

                if (itemData.is_completed) {
                    var paragraphTripStatus = document.createElement('p');
                    paragraphTripStatus.textContent = 'The trip has been completed by driver ' + itemData.driver_id + '.';
                    completechecking.appendChild(paragraphTripStatus);
                } else {
                    var paragraphTripStatus = document.createElement('p');
                    paragraphTripStatus.textContent = 'The trip is in progress.';
                    completechecking.appendChild(paragraphTripStatus);
                }
            } else {
                var paragraphTripStatus = document.createElement('p');
                paragraphTripStatus.textContent = 'The trip is yet to start.';
                tripchecking.appendChild(paragraphTripStatus);
            }
        } else {
            var paragraphTripStatus = document.createElement('p');
            paragraphTripStatus.textContent = 'The driver is on the way.';
            DriverChecking.appendChild(paragraphTripStatus);
        }
    } else {
        var paragraphTripStatus = document.createElement('p');
        paragraphTripStatus.textContent = 'Booking confirmed and searching for a driver.';
        seachingDriver.appendChild(paragraphTripStatus);
    }
} else {
    var paragraphItemData = document.createElement('p');
    paragraphItemData.textContent = 'Item Data not found.';
    itemDataDisplay.appendChild(paragraphItemData);
}
        }
        requestsRef.on('value', function(snapshot) {
            var itemData = snapshot.child(itemKey).val();
            displayItemData(itemData);
        });




        var apiUrl = "{{ url('dispatchsample/update/{dispatchrequestmeta}') }}";
    var requestsRef = database.ref('request-meta/{{ $item }}');

    function displayItemData1(itemData) {
        var itemDataDisplay = document.getElementById('itemDataDisplay1');
        var driverDataList = document.getElementById('driverDataList1');
        var driverIdCancelDiv = document.getElementById('driver_id_cancel');
        var driverIdCancelDiv1 = document.getElementById('driver_id_cancel1');

        document.getElementById('driver_id_cancel1').innerHTML = '';


        if (itemData && itemData.driver_id) {

        var paragraphTripStatus = document.createElement('p');
        var driverId = itemData['driver_id'];
        paragraphTripStatus.textContent = 'Driver ID: ' + driverId;
        driverIdCancelDiv.appendChild(paragraphTripStatus);

    }

    else if(itemData) {

        var paragraphTripStatus = document.createElement('p');
        paragraphTripStatus.textContent = 'No driver nearby. Searching for available drivers...';
        driverIdCancelDiv1.appendChild(paragraphTripStatus);

    }
    else{

    }

        if (itemData) {
            var drivers = {};
            for (var key in itemData) {
                if (itemData.hasOwnProperty(key) && key !== 'active') {
                    var driverData = itemData[key];
                    drivers[key] = driverData;
                }
            }


        } else {
            var paragraphItemData = document.createElement('p');
            paragraphItemData.textContent = 'Item Data not found.';
            itemDataDisplay.appendChild(paragraphItemData);
        }
    }


    requestsRef.on('value', function(snapshot) {
        var itemData = snapshot.val();
        displayItemData1(itemData);

    });



    </script>







</body>
</html>


