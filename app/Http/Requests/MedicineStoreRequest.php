<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicineStoreRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'Name' => ['required', 'string', 'max:45'],
            'idMedicine' => ['required', 'string'],
            'Name' => ['required', 'string', 'max:45'],
            'Description' => ['required', 'string'],
            'treatment_id' => ['required', 'integer', 'exists:treatments,id'],
            'idMedicine' => ['required', 'string'],
            'Name' => ['required', 'string', 'max:45'],
            'Description' => ['required', 'string'],
            'treatment_id' => ['required', 'integer', 'exists:treatments,id'],
        ];
    }
}
