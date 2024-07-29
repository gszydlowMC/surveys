@php
    $isEdit = (($user->id ?? null) > 0);
    $action = (($user->id ?? null) > 0) ? route('admin.users.update', [$user->id]) : route('admin.users.store');
    $form = $user ?? null;
@endphp

<form method="POST" action="{{$action}}" class="form-ajax-send">
    <div class="modal-header">
        <h2 class="my-2">{{($isEdit) ? __('Edytuj użytkownika') : __('Dodaj użytkownika')}}</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <div class="modal-body">
        <div class="container-fluid">
            @csrf
            @if($isEdit)
                @method('put')
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="form-group mt-3">
                        @include('_components.fields.select', ['config' => [
                            'label' => __('Grupa'),
                            'name' => 'user_group_id',
                            'value' => $form->user_group_id ?? '',
                            'options' => $userGroups ?? []
                        ]])
                    </div>
                    <div class="form-group mt-3">
                        @include('_components.fields.input-text', ['config' => [
                            'label' => __('Imię'),
                            'name' => 'first_name',
                            'value' => $form->first_name ?? '',
                            'placeholder' => __('Wpisz imię')
                        ]])
                    </div>
                    <div class="form-group mt-3">
                        @include('_components.fields.input-text', ['config' => [
                            'label' => __('Nazwisko'),
                            'name' => 'last_name',
                            'value' => $form->last_name ?? '',
                            'placeholder' => __('Wpisz nazwisko')
                        ]])
                    </div>
                    <div class="form-group mt-3">
                        @include('_components.fields.input-text', ['config' => [
                            'label' => __('Email'),
                            'name' => 'email',
                            'value' => $form->email ?? '',
                            'placeholder' => __('Wpisz adres e-mail')
                        ]])
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <div class="mx-auto">
            <button type="submit" class="btn btn-primary">{{__('Zapisz')}}</button>
            <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">
                {{__('Anuluj')}}
            </button>
        </div>
    </div>
</form>
