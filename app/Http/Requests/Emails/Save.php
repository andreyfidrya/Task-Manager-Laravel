<?php

namespace App\Http\Requests\Emails;

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
            'client' => 'required|min:6',
            'intro' => 'required|min:65',
            'conclusion' => 'required|min:45'                        
        ];
    }
}
