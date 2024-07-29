@extends('_partials.layouts.admin')
@section('header-title')
    Ankiety
@endsection
@section('header-button')
    <a class="btn btn-primary mt-2">Wyślij ankietę</a>
@endsection
@section('content')
    <div class="row survey-area">
        <div class="col-2 px-2">
            <div class="white-box">
                @include('admin.surveys.form_partials.toolbox_left')
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
                    <div class="float-end">
                        {{--                        @if($survey->id ?? null)--}}
                        <a class="btn btn-secondary" href="#" target="__blank">Podgląd</a>
                        {{--                        @endif--}}
                    </div>
                </div>
            </div>
            <div class="row mt-2 position-relative mb-3">
                <div class="empty-area d-none">
                    @include('admin.surveys.form_partials.create_section')
                    @include('admin.surveys.form_partials.create_question')
                </div>
                <form method="POST" action="{{ route('admin.surveys.store') }}" autocomplete="off"
                      class="form-ajax-send">
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
                    <div class="sortable-area questions-area">
                        {{--                        @include('admin.surveys.form_partials.create_section')--}}
                        {{--                        @include('admin.surveys.form_partials.create_question')--}}
                    </div>
                    <div class="col-9 mx-auto white-box mt-3 position-sticky bottom-0 z-2">
                        <div class="row">
                            <div class="col-12">
                                <div class="modal-footer">
                                    <div class="mx-auto">
                                        <button type="submit" class="btn btn-primary">{{__('Zapisz')}}</button>
                                        <a class="btn btn-secondary close" href="{{route('admin.surveys.index')}}">
                                            {{__('Usuń')}}
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
@section('other-scripts')
    <script>
        SurveyCreator = {
            addQuestion: function (src) {
                const container = $(src).closest('.survey-area');
                const questionsArea = container.find('.questions-area');
                const question = container.find('.empty-area .question-box');
                const copy = question.clone();
                questionsArea.append(copy);
                select2Init();
            },
            addSection: function (src) {
                const container = $(src).closest('.survey-area');
                const questionsArea = container.find('.questions-area');
                const section = container.find('.empty-area .section-box');
                const copy = section.clone();
                questionsArea.append(copy);
            },
            duplicate: function (src) {
                const el = $(src).closest('.duplicate-container');
                const title = el.find('.title-value').html();
                const copy = el.clone();
                copy.find('.title-value').html(title + '-DUPLIKAT');
                el.after(copy);
                select2Init();
            },
            setTabNav: function (src) {
                const container = $(src).closest('.section-box');
                const title = container.find('.title-value');
                title.html($(src).val());
            },
            delete: function (src) {
                const el = $(src).closest('.duplicate-container');
                el.remove();
            },
            // changeId: function(src){
            //     $(src).find(':input').each(function(){
            //         $(this).attr('id', $(this).attr('id')+'')
            //     })
            // }

        };

    </script>
@endsection
@include('_partials.session_messages')
