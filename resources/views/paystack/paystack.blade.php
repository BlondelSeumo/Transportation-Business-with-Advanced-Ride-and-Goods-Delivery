<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Paystack</title>
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
        #start-payment-button {
            background: #0a8708;
            color: #ffffff;
            padding: 10px;
            font-size:16px;
            border: 1px solid #0a8708;
            border-radius: 10px;
        }
    </style>


</head>
<body>
    <div class="center">
        <img src="{{ asset('assets/img/paystack.png')}}" class="img-fluid">
        <h1>{{ $amount }} {{ $currency }}</h1>
        <form id="paymentForm">
        <div class="form-submit">
            <!-- Convert amount to kobo by multiplying by 100 -->
            <input type="hidden" name="amount" value="{{ $amount * 100 }}">
            <input type="hidden" name="currency" value="{{ $currency }}">
            <input type="hidden" name="user_id" value="{{ $user_id }}">
            <input type="hidden" name="request_id" value="{{ $request_id }}">
            <input type="hidden" name="payment_for" value="{{ $payment_for }}">
        </br>
             @if($payment_for=="wallet")
            <button type="submit" id="start-payment-button" onclick="payWithPaystack()">Add To Wallet</button>
            @else
            <button type="submit" id="start-payment-button" onclick="payWithPaystack()">Pay</button>
            @endif
        </div>
    </form>
</div>
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script>
        const paymentForm = document.getElementById('paymentForm');
        paymentForm.addEventListener("submit", payWithPaystack, false);
        function payWithPaystack(e) {
            e.preventDefault();
            let handler = PaystackPop.setup({
                key: "{{$key}}",
                email: "{{$email }}",
                amount: "{{ $amount * 100 }}", // Convert amount to kobo
                metadata: {
                    // Custom fields if needed
                },
                onClose: function(){
                    alert('Window closed.');
                },
                callback: function(response){

                    const redirectUrl = "{{ route('paystack.success') }}?amount={{ $amount }}&currency={{ $currency }}&payment_for={{ $payment_for }}&user_id={{ $user_id }}&request_id={{ $request_id }}";
                    window.location.href = redirectUrl;
                }
            });
            handler.openIframe();
        }
    </script>
</body>
</html>
