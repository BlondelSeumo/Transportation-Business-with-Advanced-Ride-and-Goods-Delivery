<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Welcome to Our Website</title>
<style>
/* Add your custom CSS styles here */
body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    padding: 20px;
}
.container {
    max-width: 600px;
    margin: 0 auto;
    background-color: #ffffff;
    padding: 40px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}
h1 {
    color: #333333;
    margin-bottom: 20px;
}
p {
    color: #666666;
    line-height: 1.5;
}
.button {
    display: inline-block;
    background-color: #4caf50;
    color: #ffffff;
    text-decoration: none;
    padding: 10px 20px;
    border-radius: 4px;
    margin-top: 30px;
}
.footer {
    margin-top: 40px;
    text-align: center;
    color: #999999;
}
</style>
</head>
<body>
<div class="container">
    <h1>Fare Estimate for Your Trip</h1>
    <p>Thank you for choosing us for your trip. Below is the fare estimate for your journey:</p>
    <h2>Pickup Address: {{$pick_address}}</h2>
    <h2>Drop Address: {{$drop_address}}</h2>
    <br>
    <h2>Fare Breakup:</h2>
    <p>Base Price: {{$ridedetails->currency}} {{$ridedetails->base_price}}</p>
    <p>Distance Price: {{$ridedetails->currency}} {{$ridedetails->distance_price}}</p>
    <p>Time Price: {{$ridedetails->currency}} {{$ridedetails->time_price}}</p>
    <p>Service Price: {{$ridedetails->currency}} {{ number_format($ridedetails->tax_amount, 2, '.', ',') }}</p>
    <p>Convenience Fee: {{$ridedetails->currency}} {{ number_format($ridedetails->without_discount_admin_commision, 2, '.', ',') }}</p>
    <h3>Total Amount: {{$ridedetails->currency}} {{$ridedetails->total}}</h3>
    <div class="footer">
        {!! $app_name !!}. All rights reserved.
    </div>

</div>
</body>
</html>
