<div class="col-9 mx-auto duplicate-container question-box white-box mt-3">
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
                    'placeholder' => __('Treść pytania')
                ]])
            </div>
        </div>
        <div class="col-6">
        </div>
        <div class="col-6">
            <div class="form-group my-2">
                @include('_components.fields.select', ['config' => [
                        'label' => '',
                        'name' => 'question[type][]',
                        'value' => '',
                        'options' => \App\Enums\SurveyQuestionTypeEnum::getList()
                    ]])
            </div>
        </div>
    </div>
    <div class="row mt-2 py-2">
        <div class="col-6">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="q_req">
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
