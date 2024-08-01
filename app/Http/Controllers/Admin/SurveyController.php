<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\AdminSurveyRequest;
use App\Models\Survey;
use App\Models\SurveyToken;
use App\Repositories\SurveyRepository;
use App\Services\SurveyNotificationService;
use App\Services\SurveyService;
use Auth;
use Illuminate\Http\Request;
use Str;

class SurveyController extends BaseController
{
    public function __construct(protected SurveyRepository $repository, protected SurveyService $service, protected SurveyNotificationService $notificationService)
    {

    }

    public function index(Request $request)
    {
        $query = $this->repository->getSurveysQuery();

        $surveys = $query->sortable(['id' => 'desc'])
            ->paginate(500);

        $enableSearch = true;

        return view('admin.surveys.index', compact('surveys', 'enableSearch'));
    }

    public function create()
    {
        return view('admin.surveys.form');
    }

    public function show($id)
    {
        $tokenModel = SurveyToken::query()->newQuery()->firstOrCreate([
            'survey_id' => $id,
            'user_id' => Auth::user()->id,
        ],
        [
            'subscriber_id' => null,
            'token' => Str::random(30).date('ymdhis'),
            'created_by' => Auth::user()->id,
            'created_at' => now()->format('Y-m-d H:i:s'),

        ]);

        return redirect()->route('survey', ['token' => $tokenModel->token]);
    }

    public function edit($id)
    {
        $survey = Survey::with(['sections', 'questions.options', 'questions.sectionsBefore'])->findOrFail($id);
        return view('admin.surveys.form', compact('survey'));
    }

    public function store(AdminSurveyRequest $request)
    {
        $status = $this->service->save($request->all(), null);
        return $this->handleSaveResponse($status,
            'Pomyślnie dodano nową ankietę.',
            'Nie udało się dodać nowej ankiety.',
            route('admin.surveys.index')
        );
    }

    public function update(AdminSurveyRequest $request, $id)
    {
        $status = $this->service->save($request->all(), $id);
        return $this->handleSaveResponse($status,
            'Pomyślnie edytowano ankietę.',
            'Nie udało się edytować ankiety.',
            route('admin.surveys.index')

        );
    }

    public function destroy(Request $request, $id)
    {
        $isDelete = $this->service->delete($request->selected_items ?? $id);

        return $this->handleSaveResponse($isDelete,
            'Pomyślnie usunięto wybrane ankiety.',
            'Nie udało się usunąć wybranych ankiet.',
            route('admin.surveys.index')
        );
    }

}
