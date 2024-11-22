<!DOCTYPE html>
<html>
<head>
<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
<style>
    body {
    text-align: center;
    padding: 40px 0;
    background: #EBF0F5;
    }
    h1 {
    color: #88B04B;
    font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
    font-weight: 900;
    font-size: 40px;
    margin-bottom: 10px;
    }
    p {
    color: #404F5E;
    font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
    font-size: 20px;
    margin: 0;
    }
    i.checkmark {
    color: #9ABC66;
    font-size: 100px;
    line-height: 200px;
    margin-left: -15px;
    }
    .card {
    background: white;
    padding: 60px;
    border-radius: 4px;
    box-shadow: 0 2px 3px #C8D0D8;
    display: inline-block;
    margin: 0 auto;
    }
    .btn {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 20px;
    }
</style>
</head>
<body>
<div class="card">
    <div style="border-radius: 200px; height: 200px; width: 200px; background: #F8FAF5; margin: 0 auto;">
    <i class="checkmark">✓</i>
    </div>
    <h1>Success</h1>
    <p>Thanks for Booking ....!</p>

@if($web_booking_value==1)
    <button class="btn" id="redirectButton">Back to Invoice</button>
@endif
</div>

<script>
var redirectButton = document.getElementById('redirectButton');
var request_id = "{{ $request_id }}";

redirectButton.addEventListener('click', function() {
    window.location.href = '{{ url("/") }}/track/request/' + request_id;
});
</script>
</body>
</html>
