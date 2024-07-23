<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'DS - materiały reklamowe') }}</title>
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}"/>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <link rel="stylesheet" href="{{asset('css/app.css')}}?{{ date('YmdHis') }}">
    <script src="{{asset('js/app.js')}}?{{ date('YmdHis') }}"></script>
</head>
<body>
@include('partials.header')
<img class="img-fluid w-100" src="{{$SETTINGS_GLOBAL['BANNER_FILE_PATH'] ?? asset('img/banners/banner.png')}}"
     alt="">
<div id="main-wrapper">
    <div id="content">
        @yield('content')
    </div>
</div>
@include('partials.footer')
</body>
</html>
@yield('session-scripts')

