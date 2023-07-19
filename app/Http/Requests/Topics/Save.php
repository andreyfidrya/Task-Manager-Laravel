<?php

namespace App\Http\Requests\Topics;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class Save extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'slug' => ['required', 'min:3', Rule::unique('topics')],
            'name' => ['required', 'min:3', Rule::unique('topics')]
        ];
    }
}
