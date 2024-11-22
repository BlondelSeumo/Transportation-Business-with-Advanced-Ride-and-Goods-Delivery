<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact us</title>
    <style>
        body {
            margin: 0px;
            padding: 0px;
        }
        
        .contact-main-div {
            width: 100%;
            display: inline-block;
            background: #f5f5f5;
            height: 100vh;
        }
        
        .contact-us-content {
            width: 50%;
            padding: 10px 20px;
            background: #ffffff;
            margin: 0px auto;
            margin-top: 5%;
            border-radius: 5px;
        }
        
        .contact-table {
            width: 100%;
        }
        
        table.contact-table tr {
            display: flex;
            width: 100%;
            float: left;
            border-top: 1px solid #f5f5f5;
            padding: 10px 0px;
        }
        
        table.contact-table tr td {
            width: 50%;
            float: left;
            font-size: 16px;
            color: #8C8889;
        }
        
        table.contact-table tr td:nth-child(2) {
            text-align: right;
        }
        @media only screen and (max-width: 600px) {            
           .contact-us-content {
                width:90%;
            }
        }
    </style>
</head>

<body>
    <section class="contact-main-div">
        <div class="contact-us-content">
            <h2 style="text-align: center;font-weight: 400;">A New Request from {{ ucfirst($data['name']) }}</h2>
            <table class="contact-table">
                <tbody>
                    <tr>
                        <td>
                          @lang('view_pages.name')
                        </td>
                        <td>
                            {{ $data['name'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                           @lang('view_pages.email')
                        </td>
                        <td>
                            {{ $data['email'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                           @lang('view_pages.country')
                        </td>
                        <td>
                            {{ $data['country'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            @lang('view_pages.phone')
                        </td>
                        <td>
                            {{ $data['mobile'] }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                          @lang('view_pages.message')
                        </td>
                        <td>
                            {{ $data['message'] }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</body>

</html> 