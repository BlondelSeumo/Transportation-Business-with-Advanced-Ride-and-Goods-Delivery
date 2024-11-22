<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FlutterWave</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <style>
        body {
            font-size: 14px;
            font-family: "Moderat","Inter",sans-serif;
            font-weight: 400;
            color: #333;
        }
        .center{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        #start-payment-button{
            background-color: #ff9b00;
            color: #12122c;
            padding: 10px;
            font-size:16px;
            border: 1px solid #0a8708;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <script src="https://checkout.flutterwave.com/v3.js"></script>
    <div class="center">

    <form>
        <img src="{{ asset('assets/img/flutterwave.png')}}" class="img-fluid"> 
        <br>
        <h1>{{$currency}} {{$amount}}</h1>
        <br>
        @if($payment_for=="wallet")        
        <button type="button" id="start-payment-button" onclick="makePayment()">Add To Wallet</button>
        @else
        <button type="button" id="start-payment-button" onclick="makePayment()">Pay Now</button>
        @endif        
    </form>
</div>
    <script>
        function makePayment() {
            FlutterwaveCheckout({
                public_key: "{{$public_key}}",   //"FLWPUBK_TEST-02b9b5fc6406bd4a41c3ff141cc45e93-X",
                tx_ref: "{{$tx_ref}}",  //"txref-DI0NzMx13",
                amount: "{{$amount}}",
                currency: "{{$currency}}",
                payment_options: "card, banktransfer, ussd",  //update payment option what You want
                meta: {
                    source: "docs-inline-test",
                    consumer_mac: "92a3-912ba-1192a",
                },
                customer: {
                    email: "{{$user->email}}",
                    phone_number: "{{$user->mobile}}",
                    name: "{{$user->name}}",
                },
                customizations: {
                    title: "Flutterwave",
                    description: "Test Payment",
                    logo: "https://checkout.flutterwave.com/assets/img/rave-logo.png",
                },
                callback: function (data) {
                    console.log("payment callback:", data);
                    const redirectUrl = "{{ route('flutterwave.success') }}?amount={{ $amount }}&currency={{ $currency }}&user_id={{ $user_id }}&payment_for={{ $payment_for }}&request_id={{ $request_id }}";
                    window.location.href = redirectUrl;


                },
                onclose: function() {
                    console.log("Payment cancelled!");
                }
            });
        }
    </script>
</body>
</html>
