<h2 class="my-3">{{__('Lista wysłanych maili do uczestników')}}</h2>
<div class="col-12 my-3 ps-2">
    <a class="ref"
       role="button"
       href="{{ route('admin.survey_emails.destroy', [0]) }}"
       method="delete"
       parame-selected_items="TableFunctions.getSelectedIds('selectedEmails')"
       ref="ajaxOpen"
       confirm="Czy chcesz usunąć wybrane maile ?"
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
            'id' => 'emailsTable',
            'checkbox' => 'selectedEmails',
            'columns' => [
                ['alias' => 'subscriber_group_name', 'text' => 'Grupa', 'sort' => true],
                ['alias' => 'first_name', 'text' => 'Imię', 'sort' => true],
                ['alias' => 'last_name', 'text' => 'Nazwisko', 'sort' => true],
                ['alias' => 'to', 'text' => 'Numer telefonu', 'sort' => true],
                ['alias' => 'sent_at', 'text' => 'Data wysłania', 'sort' => true],
                ['alias' => 'created_at', 'text' => 'Data nadania', 'sort' => true],
                [
                    'alias' => 'actions', 'text' => 'Szczegóły', 'sort' => false, 'view' => 'admin.survey_emails.table-row-actions'
                ],
            ],
            'data' => $sms
        ]
    ])
</div>

