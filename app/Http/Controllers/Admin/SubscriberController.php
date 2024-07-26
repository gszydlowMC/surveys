<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\AdminSubscriberRequest;
use App\Models\Subscriber;
use App\Repositories\SubscriberRepository;
use App\Services\SubscriberService;
use Illuminate\Http\Request;

class SubscriberController extends BaseController
{
    public function __construct(protected SubscriberRepository $repository, protected SubscriberService $subscriberService)
    {

    }

    public function index(Request $request)
    {
        $query = $this->repository->getSubscribersQuery();

        $subscribers = $query->sortable(['id' => 'desc'])
            ->paginate(500);

        $enableSearch = true;

        return view('admin.subscribers.index', compact('subscribers', 'enableSearch'));
    }

    public function create()
    {
        $groups = Subscriber::all()->pluck('subscriber_group_name')->toArray();
        return view('admin.subscribers.form', compact('groups'));
    }

    public function edit($id)
    {
        $subscriber = Subscriber::findOrFail($id);
        $groups = Subscriber::all()->pluck('subscriber_group_name')->toArray();
        return view('admin.subscribers.form', compact('groups', 'subscriber'));
    }

    public function store(AdminSubscriberRequest $request)
    {
        $status = $this->subscriberService->save($request->all(), null);
        return $this->handleSaveResponse($status,
            'Pomyślnie dodano uczestnika.',
            'Nie udało się dodać nowego uczestnika.',
            route('admin.subscribers.index')
        );
    }

    public function update(AdminSubscriberRequest $request, $id)
    {
        $status = $this->subscriberService->save($request->all(), $id);
        return $this->handleSaveResponse($status,
            'Pomyślnie edytowano uczestnika.',
            'Nie udało się edytować uczestnika.',
            route('admin.subscribers.index')

        );
    }

    public function destroy(Request $request, $id)
    {
        $isDelete = $this->subscriberService->delete($request->selected_items ?? $id);

        return $this->handleSaveResponse($isDelete,
            'Pomyślnie usunięto wybranych uczestników.',
            'Nie udało się usunąć wybranych uczestników.',
            route('admin.subscribers.index')
        );
    }

}
