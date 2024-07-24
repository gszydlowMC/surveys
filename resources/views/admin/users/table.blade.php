<h2 class="">Osoby upoważnione do zarządzania</h2>
<div class="col-12 py-2 mt-3">
    @include('_components.sortable-component', [
        'config' => [
            'columns' => [
                ['alias' => 'first_name', 'text' => 'Imię', 'sort' => true],
                ['alias' => 'last_name', 'text' => 'Nazwisko', 'sort' => true],
                ['alias' => 'email', 'text' => 'Email', 'sort' => true],
                ['alias' => 'group_name', 'text' => 'Grupa', 'sort' => true],
                [
                    'alias' => 'actions', 'text' => 'Szczegóły', 'sort' => false, 'view' => 'admin.users.table-row-actions'
                ],
            ],
            'data' => $users
        ]
    ])
</div>


