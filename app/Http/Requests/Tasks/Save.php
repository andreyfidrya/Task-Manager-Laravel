<?php

namespace App\Http\Requests\Tasks;

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
            'client_id' => 'required',
            'user_id' => 'required',
            'task' => 'required|min:3',
            'feepercentage' => 'required',
            'vatpercentage' => 'required',
            'taskstatus' => 'required'
        ];
    }
}
