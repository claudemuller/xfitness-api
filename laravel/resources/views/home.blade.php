<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        <link href="{{ asset('css/app.min.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    <img src="{{ asset('images/logo.svg') }}" width="250" alt="{{ config('app.name') }}">
                </div>

                <h4>
                    XFitness is a crossfit session and user management mobile app written in Ionic with a backend in Laravel
                </h4>

                <div class="source-links">
                    <a href="https://github.com/claudemuller/xfitness-api" title="Download source for the API" target="_blank">Source for API</a>
                    <a href="https://github.com/claudemuller/xfitness" title="Download source for the app" target="_blank">Source for app</a>
                </div>

                <div class="links">
                    <a href="{{ asset('files/xfitness.apk') }}" class="btn btn-brown" title="Download .apk">Download .apk</a>
                </div>
            </div>
        </div>

        <script src="{{ asset('js/app.min.js') }}"></script>
    </body>
</html>
