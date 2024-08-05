<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\AdminSurveyRequest;
use App\Models\Survey;
use App\Models\SurveyQuestion;
use App\Models\SurveyToken;
use App\Repositories\SurveyRepository;
use App\Services\SurveyService;
use App\Services\WebSurveyService;
use Illuminate\Http\Request;

class WebSurveyController extends BaseController
{
    public function __construct(
        protected SurveyRepository $repository,
        protected SurveyService    $service,
        protected WebSurveyService $webSurveyService)
    {

    }

    public function show(Request $request, $token)
    {
        $action = $request->get('action');
        [$SurveyToken, $nextQuestion] = $this->getQuestion($action, $token);
//        dd($SurveyToken->lastResult, $nextQuestion);
        $survey = $SurveyToken->survey;
        $question = $nextQuestion;
        return view('web.survey.index', compact('SurveyToken', 'survey', 'question'));
    }

    public function getQuestion($action, $token)
    {
        $SurveyToken = SurveyToken::query()->newQuery()
            ->where('token', $token)
            ->with([
//                    'survey',
                    'lastResult.question',
                    'lastResult.question.options',
                    'lastResult.question.beforeSections',
                ]
            )
            ->firstOrFail();

        $questionId = $SurveyToken->lastResult->question->id ?? null;
        $position = $SurveyToken->lastResult->question->position ?? -1;
        $nextQuestion = SurveyQuestion::query()->newQuery()
            ->with(['sectionsBefore', 'options'])
            ->where('survey_id', $SurveyToken->survey->id);

        $value = json_encode(request()->value ?? []);
        if (!empty($action)) {

            switch ($action) {
                case 'start':
                    if (empty($SurveyToken->lastResult->id ?? null)) {
                        $this->webSurveyService->saveSurveyResult($SurveyToken->id, null, null, true, false);
                        $nextQuestion->where('position', 0);
                    }
                    break;
                case 'next':
                    $this->webSurveyService->saveSurveyResult($SurveyToken->id, $questionId, $value);
                    $nextQuestion->where('position', $position + 1);
                    break;
                case 'back':
                    $this->webSurveyService->saveSurveyResult($SurveyToken->id, $questionId, $value);
                    $nextQuestion->where('position', $position - 1);
                    break;
                case 'end':
                    $this->webSurveyService->saveSurveyResult($SurveyToken->id, $questionId, $value, false, true);
                    $nextQuestion->where('position', -1);
                    break;
            }
        }

        return [$SurveyToken, $nextQuestion->first()];
    }

}
