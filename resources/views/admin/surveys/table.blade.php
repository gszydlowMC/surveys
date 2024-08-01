<h2 class="my-3">{{__('Lista dodanych ankiet')}}</h2>
<div class="col-12 my-3 ps-2">
    <a class="ref"
       role="button"
       href="{{ route('admin.surveys.destroy', [0]) }}"
       method="delete"
       parame-selected_items="TableFunctions.getSelectedIds('selectedSurveys')"
       ref="ajaxOpen"
       confirm="Czy chcesz usunąć wybrane ankiety ?"
       title="{{ __('Usuń zaznaczone') }}"
    >
        <i class="bx bx-trash"></i>
        <span>{{__('Usuń zaznaczone')}}</span>
    </a>
{{--    <a class="" data-bs-toggle="modal" data-bs-target="#importSubscribersModal" role="button"><i class="bx bx-export px-2"></i>Import</a>--}}
</div>
<div class="col-12 py-2 mt-3">
    @csrf
    @include('_components.sortable-component', [
        'config' => [
            'id' => 'surveysTable',
            'checkbox' => 'selectedSurveys',
            'columns' => [
                ['alias' => 'name', 'text' => 'Nazwa ankiety', 'sort' => true],
                ['alias' => 'description', 'text' => 'Opis', 'sort' => true, 'view' => 'admin.surveys.table-row-description'],
                ['alias' => 'created_at', 'text' => 'Data utworzenia', 'sort' => true],
                [
                    'alias' => 'actions', 'text' => 'Szczegóły', 'sort' => false, 'view' => 'admin.surveys.table-row-actions'
                ],
            ],
            'data' => $surveys
        ]
    ])
</div>

