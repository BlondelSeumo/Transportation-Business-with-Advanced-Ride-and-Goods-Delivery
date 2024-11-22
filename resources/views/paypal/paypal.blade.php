<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PayPal</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">    
</head>
</head>
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



<body>
   <div class="center">
    <img src="{{ asset('assets/img/paypal.png')}}" class="img-fluid">
    <h1>{{ $currency }} {{ $amount }}</h1>

    <form action="{{ route('paypal.payment') }}" method="POST">
        @csrf
        <input type="hidden" name="amount" value="{{ $amount }}">
        <input type="hidden" name="payment_for" value="{{ $payment_for }}">
        <input type="hidden" name="request_id" value="{{ $request_id }}">
        <input type="hidden" name="currency" value="{{ $currency }}">
        <input type="hidden" name="user_id" value="{{ $user_id }}">

        @if($payment_for=="wallet")
        <button type="submit" class="btn btn-primary">Add Money To Wallet</button>
        @else
        <button type="submit" class="btn btn-primary">Pay</button> 
        @endif
    </form>
  </div>
</body>
</html>
