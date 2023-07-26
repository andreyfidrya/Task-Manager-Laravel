<?php

namespace App\Http\Requests\Samples;

use App\Models\Topic;
use App\Rules\AllInModel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class Save extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
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
            'url' => ['required', 'url', 'min:3', Rule::unique('samples')],
            'title' => ['required', 'min:3', Rule::unique('samples')],
            'topics' => [ 'required', 'array', 'min:1']
        ];
    }

    public function messages()
    {
        return [
            'topics.required' => 'Select at least 1 tag'
        ];
    }
}
