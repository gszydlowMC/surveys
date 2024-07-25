<h2 class="">{{__('Lista uczestników')}}</h2>
<div class="col-12 my-3 ps-2">
    <a class="">
        <i class="bx bx-trash"></i>
        <span>{{__('Usuń')}}</span>
    </a>
    <a class="" data-bs-toggle="modal" data-bs-target="#importSubscribersModal"><i class="bx bx-export px-2"></i>Import</a>
</div>
<div class="col-12 py-2 mt-3">
    @csrf
    @include('_components.sortable-component', [
        'config' => [
            'checkbox' => true,
            'columns' => [
                ['alias' => 'subscriber_group_name', 'text' => 'Grupa', 'sort' => true],
                ['alias' => 'first_name', 'text' => 'Imię', 'sort' => true],
                ['alias' => 'last_name', 'text' => 'Nazwisko', 'sort' => true],
                ['alias' => 'email', 'text' => 'Email', 'sort' => true],
                ['alias' => 'phone', 'text' => 'Telefon', 'sort' => true],
                [
                    'alias' => 'actions', 'text' => 'Szczegóły', 'sort' => false, 'view' => 'admin.subscribers.table-row-actions'
                ],
            ],
            'data' => $subscribers
        ]
    ])
</div>
@include('admin.subscribers.import.modal', [])

