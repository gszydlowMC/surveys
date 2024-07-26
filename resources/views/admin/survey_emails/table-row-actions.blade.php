<div class="dropdown">
    <button type="button" class="btn p-0 hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
    <div class="dropdown-menu">
{{--        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#mainModalAdmin" data-url="{{route('admin.subscribers.edit', [$item->id]) }}" title="{{ __('Edytuj') }}">{{__('Edytuj dane')}}</a>--}}
        <a class="dropdown-item ref"
           role="button"
           href="{{ route('admin.survey_emails.destroy', [$item->id]) }}"
           method="delete"
           ref="ajaxOpen"
           confirm="Czy chcesz usunąć wybrany email ?"
           title="{{ __('Usuń') }}"
        >
            {{ __('Usuń z listy') }}
        </a>
    </div>
</div>
