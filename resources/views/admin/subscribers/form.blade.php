@php
    $isEdit = (($subscriber->id ?? null) > 0);
    $action = (($subscriber->id ?? null) > 0) ? route('admin.subscribers.update', [$subscriber->id]) : route('admin.subscribers.store');
    $form = $subscriber ?? null;
@endphp

<form method="POST" action="{{$action}}" class="form-ajax-send">
    <div class="modal-header">
        <h2 class="my-2">{{($isEdit) ? __('Edytuj uczestnika') : __('Dodaj uczestnika')}}</h2>
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
                    <div class="form-group mt-3">
                        @include('_components.fields.input-text', ['config' => [
                            'label' => __('Numer telefonu'),
                            'name' => 'phone',
                            'value' => $form->phone ?? '',
                            'placeholder' => __('Wpisz numer telefonu')
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
