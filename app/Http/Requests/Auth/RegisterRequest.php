<?php

namespace App\Http\Requests\Auth;

use App\Helpers\KohanaHasher;
use App\Http\Requests\BaseFormRequest;
use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class RegisterRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'company_name' => 'nullable|string|min:5|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            '*.required' => 'Wymagana wartość',
            '*.string' => 'Pole typu text',
            '*.email' => 'Niepoprawny email',
            '*.unique' => 'Ten email już istnieje w systemie',
            '*.max' => 'Maksymalna ilość znaków :max',
            '*.min' => 'Minimalna ilość znaków :min',

        ];
    }


}
