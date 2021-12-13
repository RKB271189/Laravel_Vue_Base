<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="dp-date" content="{{ config('app.date_format_moment') }}">
    <meta name="dp-time" content="{{ config('app.time_format_moment') }}">
    <meta name="dp-datetime" content="{{ config('app.datetime_format_moment') }}">
    <meta name="app-locale" content="{{ App::getLocale() }}">
    <meta name="csrf-token" content="{{ csrf_token() }}"><!-- CSRF Token -->
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->

    <!-- Fonts -->
    <!-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> -->    
    <!-- Styles -->
</head>