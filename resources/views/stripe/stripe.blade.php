<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stripe</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
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
        @php
$amount=$amount/100;
        @endphp
            <img src="{{ asset('assets/img/stripe.png')}}" class="img-fluid">
                <h1>{{ $amount }} {{ $currency }}</h1>
             <div class="card-body">
                <form action="{{ route('checkout.process') }}" method="POST">

                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type='hidden' name="amount" value="{{ $amount }}">
                <input type='hidden' name="productname" value="taxi">
                <input type='hidden' name="payment_for" value="{{$payment_for}}">
                <input type='hidden' name="currency" value="{{$currency}}">
                <input type='hidden' name="user_id" value="{{$user_id}}">
                <input type='hidden' name="request_id" value="{{$request_id}}">


                @if($payment_for=="wallet")
                <button class="btn btn-success" type="submit" id="checkout-live-button">To Wallet</button>
                @else
                <button class="btn btn-success" type="submit" id="checkout-live-button">Pay Now</button>
                @endif
                </form>
            </div>
    </div>
</body>
</html>
