<?php

namespace App\Http\Requests\Scripts;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class Save extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique('scripts', 'name')->ignore($this->route('script')),
            ],

            'category_id' => [
                'required',
                'exists:categories,id',
            ], 
        ];
    }
}
