<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\AdminSubscriberImportRequest;
use App\Repositories\SubscriberRepository;
use App\Services\SubscriberImportService;
use App\Services\SubscriberService;
use Illuminate\Http\Request;

class ImportSubscriberController extends BaseController
{
    public function __construct(protected SubscriberRepository $repository, protected SubscriberImportService $service, protected SubscriberService $subscriberService)
    {

    }

    public function index(Request $request)
    {

    }

    public function store(AdminSubscriberImportRequest $request)
    {
        if ($request->xls ?? false) {
            $sheets = $this->service->getDataObjectFromXls($request->all());

            return response()->json([
                'append' => [
                    'target' => '#previewXLS',
                    'html' => view('admin.subscribers.import.preview_xls', compact('sheets'))->render()
                ]
            ]);
        }  else {
            $subscribers = $request->subscriber ?? [];

            if(!empty($subscribers)){
                $isSave = $this->subscriberService->saveMultiple($subscribers);
                return $this->handleSaveResponse($isSave,
                    'Pomyślnie zaimportowano uczestników.',
                    'Nie udało się zaimportować nowych uczestników.',
                    route('admin.subscribers.index')
                );
            }
        }
    }


}
