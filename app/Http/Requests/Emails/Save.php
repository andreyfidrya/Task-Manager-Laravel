<?php

namespace App\Http\Requests\Emails;

use Illuminate\Foundation\Http\FormRequest;

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
            'client' => 'required|min:6',
            'intro' => 'required|min:65',
            'conclusion' => 'required|min:45'                        
        ];
    }
}
