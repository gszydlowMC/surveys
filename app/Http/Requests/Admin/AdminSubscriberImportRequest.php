<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseFormRequest;

class AdminSubscriberImportRequest extends BaseFormRequest
{

    public function rules()
    {
        $isXlsSend = $this->input('xls');

        if ($isXlsSend) {
            $rules = [
                'files' => ['required'],
            ];
        } else {
            $rules = [
                'subscriber.*.first_name' => 'required|string|max:255',
                'subscriber.*.last_name' => 'required|string|max:255',
                'subscriber.*.email' => 'required|string|email|max:255|distinct|unique:subscribers,email,' . $this->route('subscriber'),
                'subscriber.*.phone' => 'nullable|string|min:8|max:15',
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [];
    }

}
