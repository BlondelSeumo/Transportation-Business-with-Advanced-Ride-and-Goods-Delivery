<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CCavenue</title>
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

        <form method="POST" action="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction">
            @csrf
            <input type="hidden" name="tid" value="{{ $orderId }}">
            <input type="hidden" name="merchant_id" value="{{ $merchantId }}">
            <input type="hidden" name="order_id" value="{{ $orderId }}">
            <input type="hidden" name="amount" value="{{ $amount }}">
            <input type="hidden" name="currency" value="{{ $currency }}">
            <input type="hidden" name="redirect_url" value="{{ route('ccavenue.payment.response') }}">
            <input type="hidden" name="cancel_url" value="{{ route('ccavenue.payment.cancel') }}">
            <input type="hidden" name="language" value="EN">
            <input type="hidden" name="billing_name" value="{{ $user->name }}">
            <input type="hidden" name="billing_address" value="{{ $user->address }}">
            <input type="hidden" name="billing_city" value="{{ $user->city }}">
            <input type="hidden" name="billing_state" value="{{ $user->state }}">
            <input type="hidden" name="billing_zip" value="{{ $user->zip }}">
            <input type="hidden" name="billing_country" value="{{ $user->country }}">
            <input type="hidden" name="billing_tel" value="{{ $user->phone }}">
            <input type="hidden" name="billing_email" value="{{ $user->email }}">
            <input type="hidden" name="merchant_param1" value="{{ $payment_for }}">
            <input type="hidden" name="merchant_param2" value="{{ $request_id }}">
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <input type="submit" value="Proceed to Payment">
        </form>
  </div>
</body>
</html>
