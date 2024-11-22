<html>
<head>
    <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>
    <title>Khalti</title>
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
        #payment-button{
            background-color: #A020F0;
            color: #12122c;
            padding: 10px;
            font-size:16px;
            border: 1px solid #0a8708;
            border-radius: 10px;
        }
    </style>

</head>
<body>
    <div class="center">
        <img src="{{ asset('assets/img/khalti.png')}}" class="img-fluid"> 
        <br>
        <h1>{{$currency}} {{$amount}}</h1>
        <br>   
        @if($payment_for=="wallet")        
            <button id="payment-button">Add To Wallet</button>
        @else
            <button id="payment-button">Pay</button>

        @endif

    </div>


    <script>
        var config = {
            "publicKey": "{{ $publicKey }}",
            "productIdentity": "taxi",
            "productName": "taxi",
            "productUrl": "{{ route('khalti.success') }}",
            "paymentPreference": [
                "KHALTI",
                "EBANKING",
                "MOBILE_BANKING",
                "CONNECT_IPS",
                "SCT",
                ],
            "eventHandler": {
                onSuccess (payload) {
                    // hit merchant api for initiating verfication
                    console.log(payload);
                    const redirectUrl = "{{ route('khalti.success') }}?amount={{ $amount }}&currency={{ $currency }}&user_id={{ $user_id }}&payment_for={{ $payment_for }}&request_id={{ $request_id }}";
                    window.location.href = redirectUrl;
                },
                onError (error) {
                    console.log(error);
                },
                onClose () {
                    console.log('widget is closing');
                }
            }
        };

        var checkout = new KhaltiCheckout(config);
        var btn = document.getElementById("payment-button");
        btn.onclick = function () {
            // minimum transaction amount must be 10, i.e 1000 in paisa.
            checkout.show({amount: '{{$amount}}' * 100});
        }
    </script>
</body>
</html>