<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }} | Email Verified</title>

        <link href="{{ asset('css/app.min.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="m-b-md">
                    @svg('images/logo.svg')
                </div>

                <h4>
                    @if($failed)
                        You provided an invalid or expired verification code :(
                    @else
                        You Email has successfully been verified :)
                    @endif
                </h4>
            </div>
        </div>

        <script src="{{ asset('js/app.min.js') }}"></script>
    </body>
</html>
