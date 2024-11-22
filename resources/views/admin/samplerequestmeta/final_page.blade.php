
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>meta Update FAQ</title>
</head>
<body>
    <h1>{{ $item }}</h1>
    <div id="itemDataDisplay"></div>
    <div id="driverDataList"></div>

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
        var requestsRef = database.ref('request-meta/{{ $item }}'); // Modify the reference to include itemKey

        function displayItemData1(itemData) {
            var itemDataDisplay = document.getElementById('itemDataDisplay');
            var driverDataList = document.getElementById('driverDataList');

            if (itemData) {
                var paragraphItemData = document.createElement('p');
                paragraphItemData.textContent = 'Item Data: ' + JSON.stringify(itemData);
                itemDataDisplay.appendChild(paragraphItemData);

                // Display driver data with IDs in JSON format
                var drivers = {};
                for (var key in itemData) {
                    if (itemData.hasOwnProperty(key) && key !== 'active') {
                        var driverData = itemData[key];
                        drivers[key] = driverData;
                    }
                }
                var driverDataItem = document.createElement('p');
                driverDataItem.textContent = 'Driver Data: ' + JSON.stringify(drivers);
                driverDataList.appendChild(driverDataItem);
            } else {
                var paragraphItemData = document.createElement('p');
                paragraphItemData.textContent = 'Item Data not found.';
                itemDataDisplay.appendChild(paragraphItemData);
            }
        }

        requestsRef.on('value', functi  on(snapshot) {
            var itemData = snapshot.val();
            displayItemData1(itemData);
        });
    </script>
</body>
</html>



