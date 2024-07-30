<div class="row options-area">
    <div class="col-12 mt-2 option-box">
        <div class="input-group">
            <span class="d-inline-flex pe-2">
                <i class="d-none option-visible-element visible-{{\App\Enums\SurveyQuestionTypeEnum::MULTI_LIST}} bx bx-checkbox fs-4 mt-2"></i>
                <i class="d-none option-visible-element visible-{{\App\Enums\SurveyQuestionTypeEnum::ONCE_LIST}} bx bx-radio-circle fs-4 mt-2"></i>
                <i class="d-none option-visible-element visible-{{\App\Enums\SurveyQuestionTypeEnum::SELECT}} bx bx-list-ul fs-4 mt-2"></i>
            </span>
            <span class="d-inline-flex w-75">
                <input class="form-control" type="text" name="option[question_][]" placeholder="{{__('Opcja 1')}}"/>
            </span>
            <div class="d-none actions option-visible-element visible-{{\App\Enums\SurveyQuestionTypeEnum::SELECT}} visible-{{\App\Enums\SurveyQuestionTypeEnum::MULTI_LIST}} visible-{{\App\Enums\SurveyQuestionTypeEnum::ONCE_LIST}}">
                <span class="d-inline-flex pe-2 ms-3 mt-1 ref" ref="SurveyCreator.addOption" role="button" title="{{__('Duplikuj')}}">
                    <i class="bx bx-plus mt-3"></i>
                </span>
                <span class="d-inline-flex pe-2 ms-1 mt-1 ref" ref="SurveyCreator.delOption" role="button" title="{{__('Usuń opcję')}}">
                    <i class="bx bx-trash mt-3"></i>
                </span>
            </div>
        </div>
    </div>
</div>
