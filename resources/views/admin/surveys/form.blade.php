@extends('_partials.layouts.admin')
@section('header-title')
    Ankiety
@endsection
@section('header-button')
    <a class="btn btn-primary mt-2">Wyślij ankietę</a>
@endsection
@section('content')
    <div class="row">
        <div class="col-2 px-2">
            <div class="white-box">

            </div>
        </div>

        <div class="col-10">
            <div class="row py-3 white-box">
                <div class="col-9 mx-auto">
                    <div class="d-inline-block">
                        <ul class="nav nav-pills px-0 mx-0 nav-up">
                            <li class="nav-item">
                                <a href="{{route('admin.surveys.index')}}" class="nav-link px-0">{{__('Ankiety')}}</a>
                            </li>
                            <li class="nav-item active ms-4">
                                <a href="{{route('admin.surveys.create')}}"
                                   class="nav-link px-0">{{__('Formularz')}}</a>
                            </li>
                            <li class="nav-item ms-4">
                                <a href="{{route('admin.surveys.create')}}"
                                   class="nav-link px-0">{{__('Ustawienia')}}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <form method="POST" action="{{ route('admin.surveys.store') }}" autocomplete="off" class="form-ajax-send">
                    @csrf
                    <div class="col-9 mx-auto white-box">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mt-3">
                                    <label>Dodaj logo</label>
                                    <input type="file" class="form-control" name="logo_file"/>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mt-3">
                                    @include('_components.fields.input-text', ['config' => [
                                        'label' => __('Nazwa'),
                                        'name' => 'name',
                                        'value' => $form->name ?? '',
                                        'placeholder' => __('Tytuł ankiety')
                                    ]])
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-9 mx-auto white-box mt-3">
                        <div class="row">
                            <div class="col-12">
                                <h2 class="my-4">Nagłówek ankiety</h2>
                                <div class="form-group my-2">
                                    @include('_components.fields.input-text', ['config' => [
                                        'label' => __('Opis ankiety'),
                                        'name' => 'description',
                                        'value' => $form->description ?? '',
                                        'placeholder' => __('Opis ankiety')
                                    ]])
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-9 mx-auto white-box mt-3">
                        <div class="row">
                            <div class="col-12">
                                <div class="modal-footer">
                                    <div class="mx-auto">
                                        <button type="submit" class="btn btn-primary">{{__('Zapisz')}}</button>
                                        <a class="btn btn-secondary close" href="{{route('admin.surveys.index')}}">
                                            {{__('Anuluj')}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

@endsection
@include('_partials.session_messages')
