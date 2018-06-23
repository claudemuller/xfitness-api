<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }} | Verify Email</title>

    <style>
        body {
            background-color: #f2e3ce;
            color: #2b1813;
        }

        .content {
            text-align: center;
        }

        .m-b-md {
            margin: 30px 0;
        }

        p,
        .links {
            margin-top: 20px;
        }

        .btn {
            display: inline-block;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 0.9rem;
            line-height: 1.6;
            border-radius: 0.25rem;
        }

        .btn-brown,
        .btn-brown:active,
        .btn-brown:focus,
        .btn-brown:hover {
            color: #f2e3ce;
            background-color: #2b1813;
            text-decoration: none;
            text-transform: uppercase;
        }
        .btn-brown:hover {
            color: #f2e3ce;
            background-color: #723f32;
        }
    </style>
</head>
<body>
<div class="center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            <img src="{{ asset('images/logo.png') }}" width="250" alt="{{ config('app.name') }}">
        </div>

        <h4>
            Hi {{ $name }}
        </h4>

        <p>
            Thank you for your interest in XFitness :)
            To complete the registration process please click on the verification link below to confirm your email address:
        </p>

        <div class="links">
            <a href="{{ url('user/verify', $verification_code) }}" class="btn btn-brown" title="Confirm email address">Confirm email address</a>
        </div>

        <p>Enjoy the app! :)</p>
    </div>
</div>
</body>
</html>
