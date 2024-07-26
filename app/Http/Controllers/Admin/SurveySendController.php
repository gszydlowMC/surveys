<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\AdminSurveyRequest;
use App\Models\Survey;
use App\Repositories\SubscriberRepository;
use App\Repositories\SurveyRepository;
use App\Services\SurveyNotificationService;
use App\Services\SurveyService;
use Illuminate\Http\Request;

class SurveySendController extends BaseController
{
    public function __construct(protected SurveyRepository $repository,
                                protected SubscriberRepository $subscriberRepository,
                                protected SurveyNotificationService $surveyNotificationService,
                                protected SurveyService $service)
    {

    }

    public function index(Request $request)
    {

    }

    public function create($surveyId)
    {
        $query = $this->subscriberRepository->getSubscribersQuery();

        $subscribers = $query->sortable(['id' => 'desc'])
            ->paginate(500);

        $enableSearch = true;

        $survey = Survey::findOrFail($surveyId);
        return view('admin.survey_send.index', compact('survey', 'subscribers'));
    }

    public function store(Request $request, $surveyId)
    {
        $subscribers = $request->selected_items ?? [];
        if(!empty($subscribers)){
            $isSend = $this->surveyNotificationService->sendMultiple($surveyId, $subscribers);
        }

        return $this->handleSaveResponse($isSend ?? false,
            'Pomyślnie wysłano wybrane ankiety.',
            'Nie udało się wysłać wybranych ankiet.'
//            route('admin.surveys.send.create', $surveyId)
        );

    }

}
