<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Aplikacja webowa') }}</title>
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}"/>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <link rel="stylesheet" href="{{asset('css/app.css')}}?{{ date('YmdHis') }}">
    <script src="{{asset('js/app.js')}}?{{ date('YmdHis') }}"></script>
    @yield('header-scripts')
</head>
<body>
<header></header>
<div id="main-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-11 mx-auto">
                <div class="row">
                    <div class="col-xxl-3 col-sm-12">
                        @yield('menu')
                    </div>
                    <div class="col-xxl-9">
                        <div>
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
<footer></footer>
</body>
</html>
@yield('session-scripts')
@yield('other-scripts')
