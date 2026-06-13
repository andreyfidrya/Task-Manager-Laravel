<?php

namespace App\Http\Requests\Answers;

use Illuminate\Foundation\Http\FormRequest;

class Save extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [            
            'waiting'     => ['nullable', 'string'],
            'apologize'   => ['nullable', 'string'],
            'maintext'    => ['nullable', 'string'],
            'addquestion' => ['nullable', 'string'],
        ];
    }
}
