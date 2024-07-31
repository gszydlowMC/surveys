<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Ankiety') }}</title>
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}"/>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <link rel="stylesheet" href="{{asset('css/web-survey.css')}}?{{ date('YmdHis') }}">
    <script src="{{asset('js/web-survey.js')}}?{{ date('YmdHis') }}"></script>
    <style>

    </style>
</head>
<body>
    <div class="main-wrapper">
        <div class="container-xxl" style="max-width: 800px;">
            @yield('content')
        </div>
    </div>
</body>
</html>
@yield('other-scripts')
