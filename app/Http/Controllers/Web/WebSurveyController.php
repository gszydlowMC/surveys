<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\AdminSurveyRequest;
use App\Models\Survey;
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
        $SurveyToken = $this->getQuestion($action, $token);
        $survey = $SurveyToken->survey;
        return view('web.survey.index', compact('SurveyToken', 'survey'));
    }

    public function getQuestion($action, $token)
    {
        $SurveyToken = SurveyToken::query()->newQuery()
            ->where('token', $token)
            ->with([
//                    'survey',
                    'lastResult.question.options',
                    'lastResult.question.beforeSections',
                ]
            )
            ->firstOrFail();
//dd($SurveyToken);
        $position = request()->position ?? null;
        $value = json_encode(request()->value ?? []);
        if (!empty($action)) {

            switch ($action) {
                case 'start':
                    if (empty($SurveyToken->lastResult->id ?? null)) {
                        $this->webSurveyService->saveSurveyResult($SurveyToken->id, null, null, true, false);
                    }
                    break;
                case 'next':
                    $this->webSurveyService->saveSurveyResult($SurveyToken->id, $position, $value);
                    break;
                case 'back':
                    $this->webSurveyService->saveSurveyResult($SurveyToken->id, $position, $value);
                    break;
                case 'end':
                    $this->webSurveyService->saveSurveyResult($SurveyToken->id, $position, $value, false, true);
                    break;
            }
        }

        return $SurveyToken;
    }

}
