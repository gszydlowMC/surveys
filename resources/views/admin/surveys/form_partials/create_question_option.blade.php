<div class="col-12 mt-2 option-box">
    <div class="input-group">
            <span class="d-inline-flex pe-2 sortable-handle">
                <i class="@if(($question->field_type ?? null) !== \App\Enums\SurveyQuestionTypeEnum::MULTI_LIST) d-none @endif option-visible-element visible-{{\App\Enums\SurveyQuestionTypeEnum::MULTI_LIST}} bx bx-checkbox fs-4 mt-2"></i>
                <i class="@if(($question->field_type ?? null) !== \App\Enums\SurveyQuestionTypeEnum::ONCE_LIST) d-none @endif option-visible-element visible-{{\App\Enums\SurveyQuestionTypeEnum::ONCE_LIST}} bx bx-radio-circle fs-4 mt-2"></i>
                <i class="@if(($question->field_type ?? null) !== \App\Enums\SurveyQuestionTypeEnum::SELECT) d-none @endif option-visible-element visible-{{\App\Enums\SurveyQuestionTypeEnum::SELECT}} bx bx-list-ul fs-4 mt-2"></i>
            </span>
        <span class="d-inline-flex w-75">
                <input class="form-control" type="text" name="option[question_][]" placeholder="{{__('Opcja 1')}}"
                       value="{{$option->label ?? ''}}"/>
            </span>
        <div
            class="@if(!in_array(($question->field_type ?? ''), [\App\Enums\SurveyQuestionTypeEnum::ONCE_LIST, \App\Enums\SurveyQuestionTypeEnum::MULTI_LIST, \App\Enums\SurveyQuestionTypeEnum::SELECT])) d-none @endif actions option-visible-element visible-{{\App\Enums\SurveyQuestionTypeEnum::SELECT}} visible-{{\App\Enums\SurveyQuestionTypeEnum::MULTI_LIST}} visible-{{\App\Enums\SurveyQuestionTypeEnum::ONCE_LIST}}">
                <span class="d-inline-flex pe-2 ms-3 mt-1 ref" ref="SurveyCreator.addOption" role="button"
                      title="{{__('Duplikuj')}}">
                    <i class="bx bx-plus mt-3"></i>
                </span>
            <span class="d-inline-flex pe-2 ms-1 mt-1 ref" ref="SurveyCreator.delOption" role="button"
                  title="{{__('Usuń opcję')}}">
                    <i class="bx bx-trash mt-3"></i>
                </span>
        </div>
    </div>
</div>

