<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Razorpay</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body{
            position: relative;
            height: 100vh;
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
        #rzp-button{
            background: #0a8708;
            color: #ffffff;
            padding: 10px;
            font-size:16px;
            border: 1px solid #0a8708;
            border-radius: 10px;
        }
        img{
            margin: auto;
/*            width: 30px;*/
        }
    </style>
</head>
<body>
    <div class="center">
    
    <!-- <h1>Razor Pay</h1> -->
    <img src="{{ asset('assets/img/razor.png')}}" class="img-fluid">
    <h1>{{ $amount }} {{ $currency }}</h1>
    @if($payment_for=="wallet")
    <button id="rzp-button">Add Money To Wallet</button>
    @else
    <button id="rzp-button">Pay Now</button>
    @endif
    
    </div>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        var orderId = "{{ $order->id }}";
        var amount = "{{ $order->amount }}";
        var paymentSuccessUrl = "{{ route('razorpay.success') }}";
        var key = "{{ $key }}";
        var payment_for = "{{ $payment_for }}";
        var request_id = "{{ $request_id }}";
        var currency = "{{ $currency }}";
        var user = "{{ $user }}";
        var user_id = "{{ $user->id }}";
        var request_amount = "{{ $amount }}";





        var options = {
            key: key,
            amount: amount,
            currency: currency,
            name: "taxi",
            description: "taxi",
            order_id: orderId,
            handler: function (response){
                // console.log(response);
                var redirectUrl = paymentSuccessUrl + "?payment_for=" + payment_for + "&user_id=" + user_id + "&request_id=" + request_id + "&amount=" + request_amount + "&order_id=" + orderId;
                window.location.href = redirectUrl;
            },
            prefill: {
                name: "{{ $user->name }}",
                email: "{{ $user->email }}",
                contact: "{{ $user->mobile }}"
            },
            notes: {
                address: "Razorpay Corporate Office"
            },
            theme: {
                color: "#3399cc"
            }
        };

        var rzp = new Razorpay(options);

        document.getElementById('rzp-button').onclick = function(e){
            rzp.open();
            e.preventDefault();
        }
    </script>
</body>
</html>
