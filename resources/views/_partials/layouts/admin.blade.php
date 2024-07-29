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
    <link rel="stylesheet" href="{{asset('css/app.css')}}?{{ date('YmdHis') }}">
    <script src="{{asset('js/app.js')}}?{{ date('YmdHis') }}"></script>
    @yield('header-scripts')
</head>
<body>
<div id="header">
    <div class="container-fluid">
        <div class="row my-4">
            <div class="col-2">
                <h2 class="mt-3">
                    @yield('header-title')
                </h2>
            </div>
            <div class="col-lg-6 col-md-3">
            </div>
            <div class="col-lg-4 col-md-7">
                <div class="row">
                    <div class="col-6">
                        <div class="float-end me-3">
                            @yield('header-button')
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="float-end ms-3 position-relative">
                            <span class="d-inline-flex align-top" style="background: #495FAC; padding:1.5rem; border-radius:100%;">

                            </span>
                            <span class="d-inline-flex align-top mt-2">
                                <i class="bx bx-dots-vertical-rounded fs-3"></i>
                            </span>
                            <span class="d-inline-flex align-top mt-2 pt-1" data-bs-toggle="dropdown" role="button">
                                {{Auth()->user()->first_name.' '.Auth()->user()->last_name}}
                                <i class="bx bx-chevron-down pt-1 ps-2"></i>
                            </span>
                            <div class="dropdown-menu">
                                <a href="{{ route('profile.index') }}" class="p-2 dropdown-item">
                                    Edytuj konto
                                </a>
                                <a href="{{ route('admin.surveys.index') }}" class="p-2 dropdown-item">
                                    Ankiety
                                </a>
                                <a href="{{ route('admin.users.index') }}" class="p-2 dropdown-item">
                                    Zarządzanie
                                </a>
                                <a href="{{ route('admin.survey_emails.index') }}" class="p-2 dropdown-item">
                                    Komunikacja
                                </a>
                                <a href="{{ route('logout') }}" class="p-2 dropdown-item">
                                    Wyloguj się
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="main-wrapper mt-1 float-start w-100">
    <div class="container-fluid">
        <div class="row mt-2">
            @if(View::hasSection('menu-left'))
                <div class="col-xxl-2 col-lg-3 bg-white py-2 col-2">
                    <div class="card">
                        <div class="card-body">
                            @yield('menu-left')
                        </div>
                    </div>
                </div>
                <div class="col-xxl-10 col-10">
                    @yield('content')
                </div>
            @else
                <div class="col-xxl-12 col-12">
                    @yield('content')
                </div>
            @endif
        </div>

    </div>
</div>
<div class="modal fade" id="mainModalAdmin" tabindex="-1" aria-modal="true" role="dialog" data-bs-backdrop="static"
     data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
        </div>
    </div>
</div>
</body>
</html>
@yield('session-scripts')
@yield('other-scripts')
