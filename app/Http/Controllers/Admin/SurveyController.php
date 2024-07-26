<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\AdminSurveyRequest;
use App\Models\Survey;
use App\Repositories\SurveyRepository;
use App\Services\SurveyService;
use Illuminate\Http\Request;

class SurveyController extends BaseController
{
    public function __construct(protected SurveyRepository $repository, protected SurveyService $service)
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

    public function edit($id)
    {
        $survey = Survey::findOrFail($id);
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
        $status = $this->subscriberService->save($request->all(), $id);
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
