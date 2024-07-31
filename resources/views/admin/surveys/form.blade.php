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
                        @if($survey->id ?? null)
                            <a class="btn btn-secondary" href="{{route('admin.surveys.show', [$survey])}}"
                               target="__blank">Podgląd</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row mt-2 position-relative mb-3">
                {{--                <div class="empty-area mb-3">--}}
                <div class="empty-area d-none">
                    @include('admin.surveys.form_partials.create_section')
                    @include('admin.surveys.form_partials.create_question')
                </div>
                @php($action = ($survey ?? false) ? route('admin.surveys.update', [$survey]) : route('admin.surveys.store'))
                <form method="POST" id="SurveyForm" action="{{ $action }}" autocomplete="off" class="form-ajax-send"
                      onsubmit="SurveyCreator.beforeSubmit()" enctype="multipart/form-data">
                    @if(($survey ?? false) )
                        @method('put')
                    @endif
                    @csrf
                    <div class="col-9 mx-auto white-box">
                        <div class="row">
                            <div class="col-3">
                                <div class="logo-preview">
                                    <img id="logoPreview"
                                         src="{{(!empty($survey->logo_path ?? '')) ? asset('storage/'.$survey->logo_path) : ''}}"
                                         alt="your image"/>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group mt-3">
                                    <label>Dodaj logo</label>
                                    <input type="file" class="form-control" id="logoInp" name="logo_file"
                                           accept="image/*"/>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mt-3">
                                    @include('_components.fields.input-text', ['config' => [
                                        'label' => __('Nazwa'),
                                        'name' => 'name',
                                        'value' => $survey->name ?? '',
                                        'placeholder' => __('Tytuł ankiety')
                                    ]])
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-9 mx-auto white-box mt-3">
                        <div class="row">
                            <div class="col-12">
                                <div class="w-100">
                                    <img id="bannerPreview" src="{{(!empty($survey->banner_path ?? '')) ? asset('storage/'.$survey->banner_path) : ''}}" alt="Banner"/>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="file" class="form-control" id="bannerInp" name="banner_file"
                                           accept="image/*"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-9 mx-auto white-box mt-3">
                        <div class="row">
                            <div class="col-12">
                                <h2 class="my-4">Nagłówek ankiety</h2>
                                <div class="form-group my-2">
                                    @include('_components.fields.textarea', ['config' => [
                                        'label' => __('Opis ankiety'),
                                        'name' => 'description',
                                        'classes' => 'tinymce-init',
                                        'value' => $survey->description ?? '',
                                        'placeholder' => __('Opis ankiety')
                                    ]])
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="sortable-area questions-area">
                        {{--                        @include('admin.surveys.form_partials.create_section')--}}
                        {{--                        @include('admin.surveys.form_partials.create_question')--}}
                        @if(isset($survey->id))
                            @foreach($survey->questions()->orderBy('position')->get() as $question)
                                @foreach($question->sectionsBefore()->orderBy('id')->get() as $section)
                                    @include('admin.surveys.form_partials.create_section', ['section' => $section])
                                @endforeach
                                @include('admin.surveys.form_partials.create_question', ['question' => $question])
                            @endforeach
                            @foreach($survey->sections()->orderBy('id')->get() as $section)
                                @include('admin.surveys.form_partials.create_section', ['section' => $section])
                            @endforeach
                        @endif
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

        $(document).ready(function () {
            $('.question_type_selector').each(function () {
                $(this).trigger('change');
            });
            $(document).on('change', '.question_type_selector', function () {
                const question = $(this).closest('.question-box');
                const value = $(this).val();
                $(this).find('option[value="' + value + '"]').attr('selected', 'selected');
                question.find('.option-visible-element').addClass('d-none');
                question.find('.option-visible-element.visible-' + value).removeClass('d-none');
                if ($(this).find('option:selected').attr('type') !== 'list') {
                    question.find('.options-area .option-box').each(function (index) {
                        if (index > 0) {
                            $(this).remove();
                        }
                    });
                }
            });

            $('.sortable-area').sortable({
                items: '.sortable-box',
                handle: '.title-value',
            });

            sortableOptionsInit();

            logoInp.onchange = evt => {
                const [file] = logoInp.files
                if (file) {
                    logoPreview.src = URL.createObjectURL(file)
                }
            }

            bannerInp.onchange = evt => {
                const [file] = bannerInp.files
                if (file) {
                    bannerPreview.src = URL.createObjectURL(file)
                }
            }
        });

        function sortableOptionsInit() {
            $('.options-area').sortable({
                items: '.option-box',
                handle: '.sortable-handle',
            });
        }

        SurveyCreator = {
            addQuestion: function (src) {
                const container = $(src).closest('.survey-area');
                const questionsArea = container.find('.questions-area');
                const question = container.find('.empty-area .question-box');
                const copy = question.clone();
                questionsArea.append(copy);
                // select2Init();
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
                // select2Init();
            },
            setTabNav: function (src) {
                const container = $(src).closest('.sortable-box');
                const title = container.find('.title-value');
                title.html($(src).val());
            },
            delete: function (src) {
                const el = $(src).closest('.duplicate-container');
                el.remove();
            },
            addOption: function (src) {
                const container = $(src).closest('.options-area');
                const option = $(src).closest('.option-box');
                const copy = option.clone();
                container.append(copy);
                sortableOptionsInit();
            },
            delOption: function (src) {
                const container = $(src).closest('.options-area');
                if (container.find('.option-box').length > 1) {
                    $(src).closest('.option-box').remove();
                }
            },
            beforeSubmit: function () {
                $('.questions-area :input[name="question[name][]"]').each(function (index) {
                    const prevSection = $(this).closest('.question-box').prevAll('.section-box:first');
                    if (prevSection) {
                        prevSection.find(':input[name="section[before_question_index][]"]').val(index);
                    }
                    $(this).closest('.question-box').find('input[name="option[question_][]"]').each(function () {
                        const name = $(this).attr('name');
                        $(this).attr('name', name.replace('question_', 'question_' + index));
                    });
                });
            },

        };

    </script>
@endsection
@include('_partials.session_messages')
