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

class ProfilePasswordRequest extends BaseFormRequest
{
    public function rules(): array
    {
        $rules = [
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
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
