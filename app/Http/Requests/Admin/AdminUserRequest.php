<?php

namespace App\Http\Requests\Admin;

use App\Helpers\KohanaHasher;
use App\Http\Requests\BaseFormRequest;
use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AdminUserRequest extends BaseFormRequest
{
    public function rules(): array
    {
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->route('user'),
            'user_group_id' => 'required|exists:user_groups,id',
//            'phone' => 'required|string|max:15',
//            'status' => 'required',
            // 'address' => 'required|string|max:255',
            // 'code' => 'required|string|max:10',
            // 'city' => 'required|string|max:100',
        ];

//        if ($this->input('password_option') === 'yes') {
//            $rules['password'] = 'nullable|string|min:8|confirmed';
//            $rules['address'] = 'nullable|string|max:255';
//            $rules['code'] = 'nullable|string|max:10';
//            $rules['city'] = 'nullable|string|max:100';
//        }

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
