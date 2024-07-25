@extends('_partials.layouts.admin')
@section('header-title')
    {{__('Zarządzanie')}}
@endsection
@section('header-button')
    <a class="btn btn-primary mt-2">{{__('Utwórz ankietę')}}</a>
@endsection
@section('content')
    <div class="row bg-white py-3">
        <div class="col-8 mx-auto bg-white">
            <div class="d-inline-block">
                <ul class="nav nav-pills px-0 mx-0 nav-up">
                    <li class="nav-item">
                        <a href="{{route('admin.users.index')}}" class="nav-link px-0">{{__('Osoby upoważnione')}}</a>
                    </li>
                    <li class="nav-item ms-4 active">
                        <a href="{{route('admin.subscribers.index')}}" class="nav-link px-0">{{__('Lista uczestników')}}</a>
                    </li>
                </ul>
            </div>
            <div class="float-end">
                <a class="btn btn-secondary" href="#" data-bs-toggle="modal" data-bs-target="#mainModalAdmin" data-url="{{route('admin.subscribers.create')}}">{{__('Dodaj')}}</a>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-8 mx-auto white-box">
            <div class="row">
                <div class="col-12">
                    <div id="subscribersTable">
                        @include('admin.subscribers.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


