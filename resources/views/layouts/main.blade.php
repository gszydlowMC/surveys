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
    @yield('header-scripts')
</head>
<body>
@include('partials.header')
<img class="img-fluid w-100" src="{{asset('img/banners/banner.png')}}" alt="">
<div id="main-wrapper">
    {{--        <div id="content">--}}
    {{--            @yield('content')--}}
    {{--        </div>--}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-11 mx-auto">
                <div class="row">
                    <div class="col-xxl-3 col-sm-12">
                        @yield('menu')
                    </div>
                    <div class="col-xxl-9">
                        <div class="row my-2">
                            <div class="col-xxl-3 offset-xxl-9 col-sm-12 d-none d-md-block">

                                <div class="form-group search-container">
                                    @if(strpos(request()->getRequestUri(), '/admin/') > -1)
                                        <input type="text" name="term" placeholder="Szukaj..."
                                               class="search-input form-control form-control-sm table-search"
                                               value="{{$term ?? ''}}"/>
                                        <span class="text-find" style="font-size:12px;"></span>
                                    @else
                                        <form method="get" action="{{route('search.index')}}">
                                            <input type="text" name="term" placeholder="Szukaj..."
                                                   class="search-input form-control form-control-sm table-search"
                                                   value="{{$term ?? ''}}"/>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div>
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
@include('partials.footer')
</body>
</html>
@yield('session-scripts')
@yield('other-scripts')
