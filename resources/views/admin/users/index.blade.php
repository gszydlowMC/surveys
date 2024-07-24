@extends('_partials.layouts.admin')
@section('header-title')
    Zarządzanie
@endsection
@section('header-button')
    <a class="btn btn-primary mt-2">Utwórz ankietę</a>
@endsection
@section('content')
    <div class="row bg-white py-3">
        <div class="col-8 mx-auto bg-white">
            <div class="d-inline-block">
                <ul class="nav nav-pills px-0 mx-0 nav-up">
                    <li class="nav-item active">
                        <a href="{{route('admin.users.index')}}" class="nav-link px-0">Osoby upoważnione</a>
                    </li>
                    <li class="nav-item ms-4">
                        <a href="{{route('admin.subscribers.index')}}" class="nav-link px-0">Lista uczestników</a>
                    </li>
                </ul>
            </div>
            <div class="float-end">
                <a class="btn btn-secondary" href="#" data-bs-toggle="modal" data-bs-target="#mainModalAdmin" data-url="{{route('admin.users.create')}}">Dodaj</a>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-8 mx-auto bg-white">
            <div class="row">
                <div class="col-12 py-2 mt-3">
                    <div id="usersTable">
                        @include('admin.users.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


