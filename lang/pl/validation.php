<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Pole :attribute musi zostać zaakceptowane.',
    'accepted_if' => 'Pole :attribute musi zostać zaakceptowane, gdy :other ma wartość :value.',
    'active_url' => 'Pole :attribute musi być poprawnym adresem URL.',
    'after' => 'Pole :attribute musi być datą po :date.',
    'after_or_equal' => 'Pole :attribute musi być datą późniejszą lub równą :date.',
    'alpha' => 'Pole :attribute może zawierać tylko litery.',
    'alpha_dash' => 'Pole :attribute może zawierać tylko litery, cyfry, myślniki i podkreślenia.',
    'alpha_num' => 'Pole :attribute może zawierać tylko litery i cyfry.',
    'array' => 'Pole :attribute musi być tablicą.',
    'ascii' => 'Pole :attribute może zawierać wyłącznie jednobajtowe znaki alfanumeryczne i symbole.',
    'before' => 'Pole :attribute musi zawierać datę poprzedzającą :date.',
    'before_or_equal' => 'Pole :attribute musi być datą wcześniejszą lub równą :date.',
    'between' => [
        'array' => 'Pole :attribute musi zawierać elementy od :min do :max.',
        'file' => 'Pole :attribute musi mieścić się w przedziale od :min do :max kilobajtów.',
        'numeric' => 'Pole :attribute musi mieścić się w przedziale od :min do :max.',
        'string' => 'Pole :attribute musi zawierać się pomiędzy :min i :max znaków.',
    ],
    'boolean' => 'Pole :attribute musi mieć wartość true lub false.',
    'can' => 'Pole :attribute zawiera nieautoryzowaną wartość.',
    'confirmed' => 'Potwierdzenie pola :attribute nie pasuje.',
    'contains' => 'W polu :attribute brakuje wymaganej wartości.',
    'current_password' => 'Hasło jest nieprawidłowe.',
    'date' => 'Pole :attribute musi być poprawną datą.',
    'date_equals' => 'Pole :attribute musi być datą równą :date.',
    'date_format' => 'Pole :attribute musi odpowiadać formatowi :format.',
    'decimal' => 'Pole :attribute musi zawierać :decimal miejsca dziesiętne.',
    'declined' => 'Pole :attribute musi zostać odrzucone.',
    'declined_if' => 'Pole :attribute musi zostać odrzucone, jeśli :other ma :wartość.',
    'różne' => 'Pole :attribute i :other muszą być różne.',
    'digits' => 'Pole :attribute musi mieć wartość :digits cyfr.',
    'digits_between' => 'Pole :attribute musi mieścić się w przedziale od :min do :max cyfr.',
    'dimensions' => 'Pole :attribute zawiera nieprawidłowe wymiary obrazu.',
    'distinct' => 'Pole :attribute ma zduplikowaną wartość.',
    'doesnt_end_with' => 'Pole :attribute nie może kończyć się jedną z następujących wartości: :values.',
    'doesnt_start_with' => 'Pole :attribute nie może zaczynać się od jednej z następujących wartości: :values.',
    'email' => 'Pole :attribute musi być poprawnym adresem e-mail.',
    'ends_with' => 'Pole :attribute musi kończyć się jedną z następujących wartości: :values.',
    'enum' => 'Wybrany atrybut jest nieprawidłowy.',
    'exists' => 'Wybrany :atrybut jest nieprawidłowy.',
    'extensions' => 'Pole :attribute musi mieć jedno z następujących rozszerzeń: :values.',
    'file' => 'Pole :attribute musi być plikiem.',
    'filled' => 'Pole :attribute musi mieć wartość.',
    'gt' => [
        'array' => 'Pole :attribute musi zawierać więcej niż :wartość elementów.',
        'file' => 'Pole :attribute musi być większe niż :value kilobajtów.',
        'numeric' => 'Pole :attribute musi być większe niż :wartość.',
        'string' => 'Pole :attribute musi być większe niż :value znaków.',
    ],
    'gte' => [
        'array' => 'Pole :attribute musi zawierać elementy :value lub więcej.',
        'file' => 'Pole :attribute musi być większe lub równe :value kilobajtów.',
        'numeric' => 'Pole :attribute musi być większe lub równe :value.',
        'string' => 'Pole :attribute musi być większe lub równe :value znaków.',
    ],
    'hex_color' => 'Pole :attribute musi mieć prawidłowy kolor szesnastkowy.',
    'image' => 'Pole :attribute musi być obrazem.',
    'in' => 'Wybrany atrybut jest nieprawidłowy.',
    'in_array' => 'Pole :attribute musi istnieć w :other.',
    'integer' => 'Pole :attribute musi być liczbą całkowitą.',
    'ip' => 'Pole :attribute musi być poprawnym adresem IP.',
    'ipv4' => 'Pole :attribute musi być poprawnym adresem IPv4.',
    'ipv6' => 'Pole :attribute musi być poprawnym adresem IPv6.',
    'json' => 'Pole :attribute musi być poprawnym ciągiem JSON.',
    'list' => 'Pole :attribute musi być listą.',
    'lowercase' => 'Pole :attribute musi być pisane małymi literami.',
    'lt' => [
        'array' => 'Pole :attribute musi zawierać mniej niż :value elementów.',
        'file' => 'Pole :attribute musi być mniejsze niż :value kilobajtów.',
        'numeric' => 'Pole :attribute musi być mniejsze niż :wartość.',
        'string' => 'Pole :attribute musi mieć mniej niż :value znaków.',
    ],
    'lte' => [
        'array' => 'Pole :attribute nie może zawierać więcej niż :wartość elementów.',
        'file' => 'Pole :attribute musi być mniejsze lub równe :value kilobajtów.',
        'numeric' => 'Pole :attribute musi być mniejsze lub równe :value.',
        'string' => 'Pole :attribute musi być mniejsze lub równe :value znaków.',
    ],
    'mac_address' => 'Pole :attribute musi być poprawnym adresem MAC.',
    'maks.' => [
        'array' => 'Pole :attribute nie może zawierać więcej niż :max elementów.',
        'file' => 'Pole :attribute nie może być większe niż :max kilobajtów.',
        'numeric' => 'Pole :attribute nie może być większe niż :max.',
        'string' => 'Pole :attribute nie może być większe niż :max znaków.',
    ],
    'max_digits' => 'Pole :attribute nie może zawierać więcej niż :max cyfr.',
    'mimes' => 'Pole :attribute musi być plikiem typu: :values.',
    'mimetypes' => 'Pole :attribute musi być plikiem typu: :values.',
    'min' => [
        'array' => 'Pole :attribute musi zawierać co najmniej :min elementów.',
        'file' => 'Pole :attribute musi mieć co najmniej :min kilobajtów.',
        'numeric' => 'Pole :attribute musi mieć wartość co najmniej :min.',
        'string' => 'Pole :attribute musi zawierać co najmniej :min znaków.',
    ],
    'min_digits' => 'Pole :attribute musi zawierać co najmniej :min cyfr.',
    'missing' => 'Musi brakować pola :attribute.',
    'missing_if' => 'Pola :attribute musi brakować, gdy :other ma :wartość.',
    'missing_unless' => 'Pola :attribute musi brakować, chyba że :other to :wartość.',
    'missing_with' => 'Pola :attribute musi brakować, gdy obecne są :values.',
    'missing_with_all' => 'Pola :attribute musi brakować, jeśli obecne są :wartości.',
    'multiple_of' => 'Pole :attribute musi być wielokrotnością :value.',
    'not_in' => 'Wybrany atrybut jest nieprawidłowy.',
    'not_regex' => 'Format pola :attribute jest nieprawidłowy.',
    'numeric' => 'Pole :attribute musi być liczbą.',
    'hasło' => [
        'lettery' => 'Pole :attribute musi zawierać przynajmniej jedną literę.',
        'mixed' => 'Pole :attribute musi zawierać przynajmniej jedną wielką i jedną małą literę.',
        'numbers' => 'Pole :attribute musi zawierać co najmniej jedną liczbę.',
        'symbols' => 'Pole :attribute musi zawierać przynajmniej jeden symbol.',
        'uncompromised' => 'Podany :attribute pojawił się w wyniku wycieku danych. Proszę wybrać inny :atrybut.',
    ],
    'present' => 'Pole :attribute musi być obecne.',
    'present_if' => 'Pole :attribute musi być obecne, gdy :other ma :wartość.',
    'present_unless' => 'Pole :attribute musi być obecne, chyba że :other to :value.',
    'present_with' => 'Pole :attribute musi być obecne, gdy obecne są :values.',
    'present_with_all' => 'Pole :attribute musi być obecne, gdy obecne są :wartości.',
    'prohibited' => 'Pole :attribute jest zabronione.',
    'prohibited_if' => 'Pole :attribute jest zabronione, gdy :other ma wartość :value.',
    'prohibited_unless' => 'Pole :attribute jest zabronione, chyba że :other znajduje się w :wartościach.',
    'prohibits' => 'Pole :attribute zabrania obecności :other.',
    'regex' => 'Format pola :attribute jest nieprawidłowy.',
    'required' => 'Pole :attribute jest wymagane.',
    'required_array_keys' => 'Pole :attribute musi zawierać wpisy dla: :wartości.',
    'required_if' => 'Pole :attribute jest wymagane, gdy :other to :wartość.',
    'required_if_accepted' => 'Pole :attribute jest wymagane, gdy akceptowane jest :other.',
    'required_if_declined' => 'Pole :attribute jest wymagane w przypadku odrzucenia opcji :other.',
    'required_unless' => 'Pole :attribute jest wymagane, chyba że :other znajduje się w :wartościach.',
    'required_with' => 'Pole :attribute jest wymagane, jeśli występuje :values.',
    'required_with_all' => 'Pole :attribute jest wymagane, jeśli obecne są :wartości.',
    'required_without' => 'Pole :attribute jest wymagane, gdy nie ma :values.',
    'required_without_all' => 'Pole :attribute jest wymagane, jeśli nie ma żadnej z :wartości.',
    'same' => 'Pole :attribute musi pasować do :innego.',
    'size' => [
        'array' => 'Pole :attribute musi zawierać elementy :size.',
        'file' => 'Pole :attribute musi mieć wartość :size kilobajtów.',
        'numeric' => 'Pole :attribute musi mieć wartość :size.',
        'string' => 'Pole :attribute musi zawierać :size znaków.',
    ],
    'starts_with' => 'Pole :attribute musi zaczynać się od jednej z następujących wartości: :values.',
    'string' => 'Pole :attribute musi być ciągiem znaków.',
    'timezone' => 'Pole :attribute musi być prawidłową strefą czasową.',
    'unique' => ' :attribute został już zajęty.',
    'uploaded' => 'Nie udało się przesłać :attribute.',
    'uppercase' => 'Pole :attribute musi być pisane wielkimi literami.',
    'url' => 'Pole :attribute musi być poprawnym adresem URL.',
    'ulid' => 'Pole :attribute musi być poprawnym identyfikatorem ULID.',
    'uuid' => 'Pole :attribute musi być prawidłowym identyfikatorem UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'nazwa-atrybutu' => [
            'rule-name' => 'niestandardowa wiadomość',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
