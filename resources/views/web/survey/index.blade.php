@extends('_partials.layouts.survey')
@section('content')
    <div class="row mt-3">
        <div class="col-7">
            <div class="float-start" style="height:50px;">
                <img src="{{(!empty($survey->logo_path ?? '')) ? asset('storage/'.$survey->logo_path) : ''}}" class="d-block w-100 h-100" alt="logo"/>
            </div>
        </div>
        <div class="col-5 position-relative" style="text-align: right;">
            <h3 class="position-absolute pe-3" style="right: 0; bottom:-10px">{{$survey->name}}</h3>
        </div>
    </div>
    <div class="row mt-3 banner-area">
        <div class="col-12">
            <div class="w-100 box-radius" style="height:250px;">
                <img src="{{(!empty($survey->banner_path ?? '')) ? asset('storage/'.$survey->banner_path) : ''}}" class="d-block w-100 h-100" alt="banner"/>
            </div>

        </div>
    </div>

    <div class="row mt-3 progress-area">
        <div class="col-12">
            <div class="w-100 box-radius">
                <div class="progress">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>

        </div>
    </div>
    <div class="row mt-3 survey-area">
        <div class="col-12">
            <div class="box-radius w-100 bg-white p-3 mt-3">
                {{$survey->description ?? ''}}
            </div>
            <div class="box-radius section-box w-100 bg-white p-3 mt-3">
                <h2>Dane osobowe</h2>
                <p>
                    Pytanie nr 1 test
                </p>
            </div>
            <div class="box-radius question-box w-100 bg-white p-3 mt-3">
                Pytanie nr 1 test
            </div>
        </div>
    </div>
    <div class="row mt-3 buttons-area">
        <div class="col-12">
{{--            <button class="btn btn-secondary">{{__('Wstecz')}}</button>--}}
{{--            <button class="btn btn-primary">{{__('Dalej')}}</button>--}}
            <button class="btn btn-primary">{{__('Start')}}</button>
        </div>
    </div>
@endsection

{{--@if(isset($survey->id))--}}
{{--    @foreach($survey->questions()->orderBy('position')->get() as $question)--}}
{{--        @foreach($question->sectionsBefore()->orderBy('id')->get() as $section)--}}
{{--            @include('admin.surveys.form_partials.create_section', ['section' => $section])--}}
{{--        @endforeach--}}
{{--        @include('admin.surveys.form_partials.create_question', ['question' => $question])--}}
{{--    @endforeach--}}
{{--    @foreach($survey->sections()->orderBy('id')->get() as $section)--}}
{{--        @include('admin.surveys.form_partials.create_section', ['section' => $section])--}}
{{--    @endforeach--}}
{{--@endif--}}
