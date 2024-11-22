

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fetch Data from Firebase</title>
</head>
<body>

    <h1>Ride Tracking Data</h1>

    <div id="requestNumber"></div>
    <div id="dataDisplay"></div>
        <h1>New Key  <div id="newKeysDisplay"></div></h1>
    <div id="newKeysDisplay"></div>
    <div id="countNumber"></div>
    <a class="dropdown-item" href="#" id="linkWithNewKeysDisplay">
        <i class="fa fa-pencil"></i>@lang('view_pages.submit')</a>

    <script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-database.js"></script>
    <script>
        function redirectToRequest() {
            var newKeysDisplayValue = document.getElementById('newKeysDisplay').textContent.trim();
            var url = "{{url('dispatchsample/dispatchsample')}}/" + (newKeysDisplayValue);
            console.log(newKeysDisplayValue);
            window.location.href = url;
        }
        document.getElementById('linkWithNewKeysDisplay').addEventListener('click', function(event) {
            event.preventDefault();

            redirectToRequest();
        });
    </script>

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
    var previousKeys = {};

    requestsRef.on('value', function(snapshot) {
        var data = snapshot.val();
        var currentKeys = Object.keys(data);
        var newKeys = currentKeys.filter(key => !Object.keys(previousKeys).includes(key));
        newKeys.forEach(key => {
            previousKeys[key] = data[key];
        });

        countValue(data);
        displayNewKeys(newKeys);
    });
    setInterval(function() {
        requestsRef.once('value', function(snapshot) {
            var data = snapshot.val();
            var currentKeys = Object.keys(data);
            Object.keys(previousKeys).forEach(key => {
                if (currentKeys.includes(key)) {
                    if (JSON.stringify(previousKeys[key]) !== JSON.stringify(data[key])) {
                        previousKeys[key] = data[key];
                        displayNewKeys([key], previousKeys);
                    }
                } else {
                    delete previousKeys[key];
                }
            });
        });
    }, 1000);

    function countValue(data) {
        var countNumber = document.getElementById('countNumber');
        countNumber.innerHTML = '';
        var count = Object.keys(data).length;
        var paragraph1 = document.createElement('p');
        paragraph1.textContent = 'Total Count: ' + count;
        countNumber.appendChild(paragraph1);
    }

    function displayNewKeys(newKeys, data) {
        var newKeysDisplay = document.getElementById('newKeysDisplay');
        newKeysDisplay.innerHTML = '';
        if (newKeys.length > 0) {
            newKeys.forEach(key => {
                var paragraphKey = document.createElement('p');
                paragraphKey.textContent =key;
                newKeysDisplay.appendChild(paragraphKey);

                var paragraphData = document.createElement('p');
                //paragraphData.textContent = 'Data: ' + JSON.stringify(data[key]);
                newKeysDisplay.appendChild(paragraphData);
                if (data[key].hasOwnProperty('request_number')) {
                    var requestNumberDiv = document.getElementById('requestNumber');
                    var requestNumber = data[key]['request_number'];
                    requestNumberDiv.textContent = 'Request Number: ' + requestNumber;
                }
            });
        }
    }
</script>
</body>
</html>
