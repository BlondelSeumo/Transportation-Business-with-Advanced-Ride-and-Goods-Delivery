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
        <h1> Verification Mail.</h1>
        <p>  Your {!! $app_name !!} Verification Otp Is : {!! $otp !!}</p>
        <p>Thank you for signing up on our website. We are excited to have you as a member of our community.</p>
        <p>If you didn't sign up for our website, you can safely ignore this email.</p>
        <div class="footer">
            {!! $app_name !!}. All rights reserved.
        </div>
    </div>
</body>
</html>
