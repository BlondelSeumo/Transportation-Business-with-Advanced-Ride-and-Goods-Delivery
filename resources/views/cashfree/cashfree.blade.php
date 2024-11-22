<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
     <title>Laravel 9 Cashfree Payment Gateway Integration Tutorial</title>
     <meta name="csrf-token" content="{{ csrf_token() }}">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
     <div class="container mt-3">
          <div class="row justify-content-center">
               <div class="col-12 col-md-6 mb-3">
                    <div class=" text-dark bg-light mb-3">

                    <div class="center">
                    
                         <form action="{{ route('store') }}" method="POST">
                              @csrf
                              <img src="{{ asset('assets/img/cashfree.jpeg')}}" class="img-fluid"> 
                               <h1>{{$currency}} {{$amount}}</h1><br>
                              <input type="hidden" class="form-control" name="name" id="name" value="{{ $user->name }}" placeholder="name">
                             
                              <input type="hidden" class="form-control" name="email" id="email" value="{{ $user->email }}"placeholder="email">
                             
                              <input type="hidden" class="form-control" name="mobile" id="mobile" value="{{ $user->mobile }}" placeholder="mobile">

                             <input type="hidden" class="form-control" name="amount" id="amount" value="{{ $amount }}" placeholder="amount">

                             <input type="hidden" class="form-control" name="currency" id="currency" value="{{ $currency }}" placeholder="currency">

                              <input type="hidden" class="form-control" name="payment_for" id="payment_for" value="{{ $payment_for }}" placeholder="payment_for">

                              <input type="hidden" class="form-control" name="request_id" id="request_id" value="{{ $request_id }}" placeholder="request_id">
                             
                              <input type="hidden" class="form-control" name="user_id" id="user_id" value="{{ $user_id }}" placeholder="user_id">

                               @if($payment_for=="wallet")        
        <button class="w-100 btn btn-lg btn-warning" type="submit" id="start-payment-button">Add To Wallet</button>
        @else
        <button class="w-100 btn btn-lg btn-success mt-5" type="submit" id="start-payment-button">Pay Now</button>
        @endif 
                         </form>
                         @if ($errors->any())
                         <div class="alert alert-danger text-start" role="alert">
                              <strong>Opps!</strong> Something went wrong<br>
                              <ul>
                              @foreach ($errors->all() as $error)
                                   <li>{{ $error }}</li>
                              @endforeach
                              </ul>
                         </div>
                         @endif
                    </div>
                    </div>
               </div>
          </div>
     </div>
</body>
</html>