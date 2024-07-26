@extends('_partials.layouts.admin')
@section('header-title')
    {{__('Komunikacja')}}
@endsection
@section('header-button')
    <a class="btn btn-primary mt-2">{{__('Utwórz ankietę')}}</a>
@endsection
@section('content')
    <div class="row bg-white py-3">
        <div class="col-8 mx-auto bg-white">
            <div class="d-inline-block">
                <ul class="nav nav-pills px-0 mx-0 nav-up">
                    <li class="nav-item active">
                        <a href="{{route('admin.survey_emails.index')}}" class="nav-link px-0">{{__('Wysłane maile')}}</a>
                    </li>
                    <li class="nav-item ms-4">
                        <a href="{{route('admin.survey_sms.index')}}" class="nav-link px-0">{{__('Wysłane sms')}}</a>
                    </li>
                </ul>
            </div>
            <div class="float-end">
                <a class="btn btn-secondary" href="#" data-bs-toggle="modal" data-bs-target="#mainModalAdmin" data-url="{{route('admin.subscribers.create')}}">{{__('Wyślij ponownie')}}</a>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-8 mx-auto white-box">
            <div class="row">
                <div class="col-12">
                    <div>
                        @include('admin.survey_emails.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


