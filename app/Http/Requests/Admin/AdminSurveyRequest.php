<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseFormRequest;

class AdminSurveyRequest extends BaseFormRequest
{
    public function rules(): array
    {
        $rules = [
                'name' => 'required',
                'description' => 'required'
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
