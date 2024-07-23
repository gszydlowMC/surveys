<?php

namespace App\Http\Requests\Auth;


use Illuminate\Foundation\Http\FormRequest;


class PasswordSetRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'password' => 'required|string|min:8|confirmed',
//            'password' => ['required', 'string'],
        ];
    }

    public function messages()
    {
        return [
            '*.required' => 'Wymagana wartość',
            '*.string' => 'Pole typu text',
            '*.email' => 'Niepoprawny email',
            '*.max' => 'Maksymalna ilość znaków',
            '*.confirmed' => 'Hasła niezgodne',

        ];
    }
}
