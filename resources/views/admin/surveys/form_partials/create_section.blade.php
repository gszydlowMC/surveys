<div class="col-9 mx-auto mt-3 section-box duplicate-container">
    <a class="btn btn-primary position-relative z-0 title-value" style="top:7px;">
        {{__('Sekcja 1')}}
    </a>
    <div class="w-100 white-box position-relative z-1" style="border-top-left-radius: 0;">
        <div class="row">
            <div class="col-12">
                <div class="form-group my-2">
                    @include('_components.fields.input-text', ['config' => [
                        'label' => __('Dodaj opis (opcjonalnie)'),
                        'name' => 'section[name][]',
                        'value' => $form->section_name ?? '',
                        'placeholder' => __('Nagłówek'),
                        'onkeyup' => 'SurveyCreator.setTabNav(this)'
                    ]])
                </div>

                <div class="form-group my-2">
                    @include('_components.fields.textarea', ['config' => [
                        'name' => 'section[description][]',
                        'value' => $form->short_description ?? '',
                        'placeholder' => __('Podaj krótki opis')
                    ]])
                </div>

            </div>
        </div>
        <div class="row mt-2 py-2">
            <div class="col-12">
                <div class="float-end">
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
