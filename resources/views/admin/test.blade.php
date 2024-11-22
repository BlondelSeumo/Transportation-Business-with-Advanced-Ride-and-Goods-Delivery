<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test-Socket</title>

</head>

<body>

<div class="container">
    <h1 id="addition">0</h1>
</div>
<script src="{{asset('assets/vendor_components/jquery/dist/jquery.js')}}"></script>
<script src="http://localhost:3001/socket.io/socket.io.js"></script>
<script>
    var socket = io('http://localhost:3001');
    socket.on("test-channel:App\\Events\\TestEvent", function(message) {
        console.log('here');
        $('#addition').text(parseInt($('#addition').text()) + parseInt(message.data.addition));
    });
</script>

</body>
</html>