<h2 class="">{{__('Lista uczestników')}}</h2>

<div class="col-12 py-2 mt-3">
    @csrf
    @include('_components.sortable-component', [
        'config' => [
            'id' => 'subscribersTable',
            'checkbox' => 'selectedSubscribers',
            'columns' => [
                ['alias' => 'subscriber_group_name', 'text' => 'Grupa', 'sort' => true],
                ['alias' => 'first_name', 'text' => 'Imię', 'sort' => true],
                ['alias' => 'last_name', 'text' => 'Nazwisko', 'sort' => true],
                ['alias' => 'email', 'text' => 'Email', 'sort' => true],
                ['alias' => 'phone', 'text' => 'Telefon', 'sort' => true],
            ],
            'data' => $subscribers
        ]
    ])
</div>
@include('admin.subscribers.import.modal', [])

