<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\AdminSubscriberRequest;
use App\Models\Subscriber;
use App\Repositories\SubscriberRepository;
use App\Repositories\SurveyNotificationRepository;
use App\Services\SubscriberService;
use App\Services\SurveyNotificationService;
use Illuminate\Http\Request;

class SurveySmsController extends BaseController
{
    public function __construct(protected SurveyNotificationRepository $repository, protected SurveyNotificationService $service)
    {

    }

    public function index(Request $request)
    {
        $query = $this->repository->getSmsQuery();

        $sms = $query->sortable(['id' => 'desc'])
            ->paginate(500);

        $enableSearch = true;

        return view('admin.survey_sms.index', compact('sms', 'enableSearch'));
    }

    public function destroy(Request $request, $id)
    {
        $isDelete = $this->service->delete($request->selected_items ?? $id);

        return $this->handleSaveResponse($isDelete,
            'Pomyślnie usunięto wybrane wiadomości.',
            'Nie udało się usunąć wybranych wiadomości.',
            route('admin.survey_emails.index')
        );
    }

}
