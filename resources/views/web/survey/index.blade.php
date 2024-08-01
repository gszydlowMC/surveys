@extends('_partials.layouts.survey')
@section('content')
    <form method="GET" action="{{route('survey', ['token' => $SurveyToken->token])}}" id="Survey">
        @include('web.survey.header', ['progress' => 10])
        <div class="row survey-area">
            @if(empty($SurveyToken->lastResult) || ($SurveyToken->lastResult->is_start ?? false))
                @include('web.survey.start')
            @else
                @include('web.survey.question')
            @endif

        </div>
        <div class="row mt-3 buttons-area">
            <div class="col-12">
                @if(empty($SurveyToken->lastResult) || ($SurveyToken->lastResult->is_start ?? false))
                    <button type="submit" form="Survey" name="action" value="start"
                            class="btn btn-primary me-2 start">{{__('Start')}}</button>
                @elseif($SurveyToken->lastResult->question->isLast() ?? false)
                    <button type="submit" form="Survey" name="action" value="back"
                            class="btn btn-secondary me-2 back">{{__('Wstecz')}}</button>
                    <button type="submit" form="Survey" name="action" value="end"
                            class="btn btn-primary me-2 done">{{__('Zakończ')}}</button>
                @else
                    <button type="submit" form="Survey" name="action" value="back"
                            class="btn btn-secondary me-2 back">{{__('Wstecz')}}</button>
                    <button type="submit" form="Survey" name="action" value="next"
                            class="btn btn-primary me-2 next">{{__('Dalej')}}</button>
                @endif
            </div>
        </div>
    </form>
@endsection
