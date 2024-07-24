<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseFormRequest;

class AdminSubscriberRequest extends BaseFormRequest
{
    public function rules(): array
    {
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:subscribers,email,' . $this->route('subscriber'),
            'phone' => 'nullable|string|min:8|max:15',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            '*.required' => 'Wymagana wartość',
            '*.unique' => 'Ten email już istnieje w systemie',
            '*.string' => 'Pole typu text',
            '*.email' => 'Niepoprawny email',
            '*.max' => 'Maksymalna ilość znaków to :max',
        ];
    }


}
