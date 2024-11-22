<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles for this template */
        /* Adjust styles based on your preferences */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }
        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .invoice-title {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }
        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }
        .table th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="invoice-title">
            <h2>Invoice</h2> <br> <br>
        </div><br><br>
        <p style="font-size:10px;">Generated on: {{ $data['currentDateTime'] }}</p>
         <br> <br> <br> <br> <br>
         <div class="header">
            <div class="row">
                <div class="col-md-6">
                    <img src="C:\xampp\htdocs\TagxiSuperBiding\public\images\email\logo.jpeg" alt="Logo" style="width: 200px; height: auto;"><br><br>
                </div>
                <div class="col-md-6 text-right">
                    <p>Company Name</p><br>
                    <p>Address Line 1</p><br>
                    <p>Address Line 2</p><br>
                </div>
            </div>
        </div>
        <br> <br> <br> <br> <br>
        
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Service Tax</td>
                    <td>{{ $data['service_tax'] }}</td>
                </tr>
                <tr>
                    <td>Promo Discount</td>
                    <td>{{ $data['promo_discount'] }}</td>
                </tr>
                <tr>
                    <td>Admin Commission</td>
                    <td>{{ $data['Base Distance'] }}</td>
                </tr>
                <tr>
                    <td>Driver Commission</td>
                    <td>{{ $data['Total Distance'] }}</td>
                </tr>
                <tr>
                    <td><strong>Total Amount</strong></td>
                    <td><strong>{{ $data['Total Time'] }}</strong></td>
                </tr>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
