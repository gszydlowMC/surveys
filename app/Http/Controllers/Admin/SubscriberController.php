<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\AdminsubscriberRequest;
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
        $search = $request->search ?? '';
        $query = Subscriber::query()
            ->select(
                [
                    'subscribers.id',
                    'subscribers.subscriber_group_name',
                    'subscribers.first_name',
                    'subscribers.last_name',
                    'subscribers.email',
                    'subscribers.phone',
                    'subscribers.created_at',
                ]
            );
        if(!empty($search)){
            $query->whereRaw("LOWER(concat(first_name, ' ', last_name, ' ', email)) like ? ", '%' . mb_strtolower($search, 'utf-8') . '%');
        }

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

    public function store(AdminsubscriberRequest $request)
    {
        $status = $this->subscriberService->save($request->all(), null);
        return $this->handleSaveResponse($status,
            'Pomyślnie dodano subskrybenta.',
            'Nie udało się dodać nowego subskrybenta.',
            route('admin.subscribers.index')
        );
    }

    public function update(AdminsubscriberRequest $request, $id)
    {
        $status = $this->subscriberService->save($request->all(), $id);
        return $this->handleSaveResponse($status,
            'Pomyślnie edytowano subskrybenta.',
            'Nie udało się edytować subskrybenta.',
            route('admin.subscribers.index')

        );
    }

}
