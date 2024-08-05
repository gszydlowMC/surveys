@php($section = $question->sectionsBefore()->orderBy('id', 'desc')->first())

<div class="col-12">
    <div class="box-radius section-box w-100 bg-white p-3 mt-3">
        <h2>{{$section->title ?? ''}}</h2>
        <p>
            {{$section->description ?? ''}}
        </p>
    </div>
    <div class="box-radius question-box w-100 bg-white p-3 mt-3">
        <div class="form-group">
            <div class="w-100">
                <label class="form-label" for="q_{{$question->id}}">
                    {{$question->label}}
                </label>
            </div>
            @if($question->field_type === \App\Enums\SurveyQuestionTypeEnum::SHORT_ANSWER)
                <input class="form-control" type="text" id="question" name="q[]" value=""/>
            @elseif($question->field_type === \App\Enums\SurveyQuestionTypeEnum::LONG_ANSWER)
                <textarea class="form-check-input" id="q_{{$question->id}}" name="q[]"></textarea>
            @elseif($question->field_type === \App\Enums\SurveyQuestionTypeEnum::ONCE_LIST || $question->field_type === \App\Enums\SurveyQuestionTypeEnum::MULTI_LIST)
                @foreach($question->options as $option)
                    <div class="w-100">
                        <div class="d-inline-flex">
                            <input class="form-check-input" type="{{$question->field_type}}"
                                   id="q_{{$option->id}}"
                                   name="q[]" value="{{$option->value}}"/>
                        </div>
                        <div class="d-inline-flex ms-2">
                            <label class="form-check-label" for="q_{{$option->id}}">{{$option->value}}</label>
                        </div>
                    </div>
                @endforeach
            @elseif($question->field_type === \App\Enums\SurveyQuestionTypeEnum::SELECT)
                <select name="question[{{$question->id}}]">
                    @foreach($question->options as $option)
                        <option value="{{$option->value}}">{{$option->value}}</option>
                    @endforeach
                </select>
            @endif
        </div>
    </div>
</div>
