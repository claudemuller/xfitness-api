<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    {{--
    <!-- Google Tag Manager Install as high in the head as possible-->
    <script>
      (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
          new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
      })(window,document,'script','dataLayer','GTM-MWDGFP8');
    </script>
    --}}

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, minimal-ui" />
    <meta name="keywords" content="crayon, crew, crayon crew, crayon-crew, jobs, careers, recruitment, agency, agent, hire, work, vacancy, personality, profiling">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>

    {{-- Favicons --}}
    <link rel="shortcut icon" href="{{ asset('assets/fav/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('assets/fav/favicon.ico') }}" type="image/x-icon">

    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('assets/fav/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('assets/fav/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('assets/fav/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/fav/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('assets/fav/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('assets/fav/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('assets/fav/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('assets/fav/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/fav/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('assets/fav/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/fav/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/fav/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/fav/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/fav/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('assets/fav/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">

    {{--	<meta property="og:title" content="title" />
        <meta property="og:description" content="description" />--}}
    <meta property="og:image" content="{{ asset('assets/fav/facebook_share.jpg') }}" />

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>

    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    @rev_asset('css/vendor.min.css', 'link')
    @rev_asset('css/app.min.css', 'link')

    {{--
    <!-- Facebook Pixel Code -->
    <script>
      !function(f,b,e,v,n,t,s)
      {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window,document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
      fbq('init', '1273229946155210');
      fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1" src="https://www.facebook.com/tr?id=1273229946155210&ev=PageView&noscript=1"/>
    </noscript>
    <!-- End Facebook Pixel Code -->
    --}}
</head>
<body>
    <div style='-webkit-overflow-scrolling: touch;'>
        {{--
        <!-- Google Tag Manager (noscript) Paste immediately after the opening body tag-->
        <noscript>
            <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MWDGFP8" height="0" width="0" style="display:none;visibility:hidden"></iframe>
        </noscript>
        <!-- End Google Tag Manager (noscript) -->
        --}}

        @include('partials.nav')

        <div id="app">
            @yield('background')

            @yield('content')
        </div>
    </div>

    @include('partials.footer')

    {{-- Scripts --}}
    {{--
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-114178100-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-114178100-1');
    </script>
    --}}

    @yield('scripts')
    @rev_asset('js/vendor.min.js', 'script')
    <script>
      (function (global) {
        'use strict';

        global.facebookIcon = "{{ asset('social/facebook_icon@2x.svg') }}";
        global.twitterIcon = "{{ asset('social/twitter@2x.png') }}";
        global.linkedInIcon = "{{ asset('social/Linkedin@2x.png') }}";

        global.referralKey = "{{ $referral_key }}";
        global.referralUrl = "{{  url('referral/send') }}";
        global.candidateCvUrl = "{{ url('/candidate-cv') }}"
        global.subscriberAddUrl = "{{ url('subscriber/add') }}";
        global.removeJobUrl = "{{  url('remove-a-job') }}";
      })(window.Crayon = window.Crayon ? window.Crayon : {});
    </script>
    @rev_asset('js/app.min.js', 'script')

    {{--
    <!-- Start of HubSpot Embed Code -->
    <script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/4318845.js"></script>
    <!-- End of HubSpot Embed Code -->
    --}}
</body>
</html>
