<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Validation\Rules;
class ResetRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }

    public function messages()
    {
        return [
            '*.required' => 'Wymagana wartość',
            '*.string' => 'Pole typu text',
            '*.email' => 'Niepoprawny email',
            '*.max' => 'Maksymalna ilość znaków to :max',
            '*.confirmed' => 'Hasła niezgodne',
        ];
    }
}
