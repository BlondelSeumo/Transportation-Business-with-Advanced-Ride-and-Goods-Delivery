{{--This is a temporary view used for testing SPA. Delete later!--}}
<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
            font-weight: 600;
        }

        .title {
            font-size: 30px;
        }

        .form-header {
            margin-bottom: 30px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .login-form {
            font-size: 20px;
            margin-top: 20px;
        }

        .login-form_group {
            margin-bottom: 10px;
        }

        .form-label {
            width: 150px;
            display: inline-block;
            text-align: left;
        }

        .input-box {
            padding: 6px 15px;
            width: 250px;
        }

        .name {
            color: #ff0000;
        }

        .btn {
            padding: 6px;
            min-width: 120px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            @if (!auth('web')->check())
                <div class="form-header">@lang('view_pages.not_logged_in')</div>
                <form id="login_form" class="login-form">
                    <div class="login-form_group">
                        <label class="form-label">@lang('view_pages.email')</label>
                        <input class="input-box" name="email">
                    </div>
                    <div class="login-form_group">
                        <label class="form-label">@lang('view_pages.password')</label>
                        <input class="input-box" name="password">
                    </div>
                    <div class="login-form_group">
                        <input type="checkbox" name="remember" id="remember">
                        <label for="remember">@lang('view_pages.remember')</label>
                    </div>
                    <div class="login-form_group">
                        <input class="btn" type="submit" value="Login">
                    </div>
                </form>
            @else
                <?php $user = auth('web')->user()?>
                Logged in as [ <span class="name">{{ $user->id }}</span> ] [ <span class="name">{{ $user->name }}</span> ]<br>
                <small>[ {{ $user->roles->implode('name', ' | ') }} ]</small><br>
            @endif

            <button class="btn" onclick="user()">@lang('view_pages.get_current_user')</button><br>
            <form method="post" action="logout">
                {{ csrf_field() }}
                <input class="btn" type="submit" value="Logout">
            </form>
        </div>
    </div>
</div>

<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>

<script>
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#login_form').on('submit', function (e) {
            e.preventDefault();

            var data = $(this).serializeArray();

            $.post("api/spa/login", data, function (data) {
                console.log(data);
            });
        });
    });

    function user() {
        $.get("api/v1/user", function (data) {
            console.log(data);
        });
    }
</script>
</body>
</html>
