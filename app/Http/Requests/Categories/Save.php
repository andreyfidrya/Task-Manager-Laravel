<?php

namespace App\Http\Requests\Categories;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class Save extends FormRequest
{
    public function authorize(): bool
    {
        return false;
    }

    public function rules(): array
    {
        return [
            'slug' => ['required', 'min:3', Rule::unique('categories')->ignore($this->category)],
            'name' => ['required', 'min:3', Rule::unique('categories')->ignore($this->category)]
        ];
    }
}
