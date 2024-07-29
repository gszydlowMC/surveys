@extends('_partials.layouts.admin')
@section('header-title')
    {{__('Ankiety')}}
@endsection
@section('header-button')
    <a class="btn btn-primary mt-2" href="{{route('admin.surveys.create')}}">{{__('Utwórz ankietę')}}</a>
@endsection
@section('content')
    <div class="row bg-white py-3">
        <div class="col-8 mx-auto bg-white">
            <div class="d-inline-block">
                <ul class="nav nav-pills px-0 mx-0 nav-up">
                    <li class="nav-item">
                        <a href="{{route('admin.surveys.index')}}" class="nav-link px-0">{{__('Lista ankiet')}}</a>
                    </li>
                    <li class="nav-item ms-4 active">
                        <a href="{{route('admin.surveys.send.create', [$survey->id])}}" class="nav-link px-0">{{__('Ankieta - Wysyłka')}}</a>
                    </li>
                </ul>
            </div>
            <div class="float-end">
                <a
                    class="ref btn btn-secondary"
                    role="button"
                    href="{{ route('admin.surveys.send.store', [$survey->id]) }}"
                    method="post"
                    parame-selected_items="TableFunctions.getSelectedIds('selectedSubscribers')"
                    ref="ajaxOpen"
                    confirm="Czy na pewno chcesz wysłać ankietę do wybranych uczestników ?"
                    title="{{ __('Wyślij do wybranych') }}"
                >
                    {{__('Wyślij')}}
                </a>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-8 mx-auto white-box">
            <div class="row">
                <div class="col-12">
                    <div>
                        @include('admin.survey_send.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


