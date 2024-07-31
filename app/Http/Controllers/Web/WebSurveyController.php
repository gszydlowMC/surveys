<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\AdminSurveyRequest;
use App\Models\Survey;
use App\Repositories\SurveyRepository;
use App\Services\SurveyService;
use Illuminate\Http\Request;

class WebSurveyController extends BaseController
{
    public function __construct(protected SurveyRepository $repository, protected SurveyService $service)
    {

    }

    public function show($token)
    {
        dd($token);
        $survey = Survey::with(['sections', 'questions.options', 'questions.sectionsBefore'])->findOrFail($id);
        return view('admin.surveys.form', compact('survey'));
    }

}
