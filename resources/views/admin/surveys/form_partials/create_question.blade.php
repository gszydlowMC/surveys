<div class="col-9 mx-auto duplicate-container question-box mt-3 sortable-box">
    <a class="btn btn-danger position-relative z-0 title-value" style="top:7px;">
        {{__('Pytanie 1')}}
    </a>
    <div class="w-100 white-box position-relative z-1" style="border-top-left-radius: 0;">
        {{--    <div class="row">--}}
        {{--        <div class="col-12">--}}
        {{--            <label>Dodaj plik</label>--}}
        {{--            <input type="file" class="form-control" name="question_file"/>--}}
        {{--        </div>--}}
        {{--    </div>--}}
        <div class="row">
            <div class="col-12">
                <div class="form-group my-2">
                    @include('_components.fields.textarea', ['config' => [
                        'label' => __('Pytanie'),
                        'name' => 'question[name][]',
                        'value' => '',
                        'placeholder' => __('Treść pytania'),
                        'onkeyup' => 'SurveyCreator.setTabNav(this)'
                    ]])
                </div>
            </div>
            <div class="col-6">
                @include('admin.surveys.form_partials.create_question_option')
            </div>
            <div class="col-6">
                <div class="form-group my-2">
                    @include('_components.fields.select', ['config' => [
                            'label' => '',
                            'name' => 'question[type][]',
                            'value' => '',
                            'classes' => 'question_type_selector',
                            'options' => \App\Enums\SurveyQuestionTypeEnum::getList(),
                            'optionAttributes' => ['type']
                        ]])
                </div>
            </div>
        </div>
        <div class="row mt-2 py-2">
            <div class="col-6">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="q_req" name="question[is_required][]">
                    <label class="form-check-label" for="q_req">{{__('Wymagane')}}</label>
                </div>
            </div>
            <div class="col-6">
                <div class="float-end">
                <span class="d-inline ms-2" role="button">
                    <i class="bx bx-dots-vertical-rounded align-top mt-1"></i>
                    {{__('Więcej')}}
                </span>
                    <span class="d-inline ms-2 ref" ref="SurveyCreator.duplicate" role="button">
                    <i class="bx bx-duplicate align-top mt-1"></i>
                    {{__('Duplikuj')}}
                </span>
                    <span class="d-inline ms-2 ref" ref="SurveyCreator.delete" role="button">
                    <i class="bx bx-trash align-top mt-1"></i>
                    {{__('Usuń')}}
                </span>
                </div>
            </div>
        </div>
    </div>
</div>
