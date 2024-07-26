@extends('_partials.layouts.admin')
@section('header-title')
    Zarządzanie
@endsection
@section('header-button')
    <a class="btn btn-primary mt-2">Utwórz ankietę</a>
@endsection
@section('content')
    <div class="row bg-white py-3">
        <div class="col-4 mx-auto bg-white">
            <div class="d-inline-block">
                <ul class="nav nav-pills px-0 mx-0 nav-up">
                    <li class="nav-item active">
                        <a href="{{route('profile.index')}}" class="nav-link px-0">{{__('Moje konto')}}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-4 mx-auto white-box">
            <div class="row">
                <div class="col-12">
                    <h2 class="my-4">{{Auth()->user()->first_name.' '.Auth()->user()->last_name}} - zmiana hasła</h2>
                    <form method="POST" action="{{ route('profile.store') }}" autocomplete="off" class="form-ajax-send">
                        @csrf
                        <div class="form-group mt-2">
                            <label for="current_password">Obecne hasło</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" autocomplete="off" value="">
                        </div>
                        <div class="form-group mt-2">
                            <label for="new_password">Nowe hasło</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" value="">
                        </div>
                        <div class="form-group mt-2">
                            <label for="new_password_confirmation">Potwierdzenie nowego hasła</label>
                            <input type="password" class="form-control" id="new_password_confirmation"
                                   name="new_password_confirmation" value="">
                        </div>
                        <div class="modal-footer my-3">
                            <div class="mx-auto">
                                <button type="submit" class="btn btn-primary">{{__('Zmień hasło')}}</button>
{{--                                <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">--}}
{{--                                    {{__('Anuluj')}}--}}
{{--                                </button>--}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@include('_partials.session_messages')
