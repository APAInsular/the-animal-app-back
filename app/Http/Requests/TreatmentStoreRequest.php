<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TreatmentStoreRequest extends FormRequest
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
            'idTreatment' => ['required', 'string'],
            'Name' => ['required', 'string', 'max:45'],
            'Frequency' => ['required', 'string'],
            'Dosis' => ['required', 'string'],
            'Comments' => ['required', 'string'],
            'clinical_history_id' => ['required', 'integer', 'exists:clinical_histories,id'],
            'idTreatment' => ['required', 'string'],
            'Name' => ['required', 'string', 'max:45'],
            'Frequency' => ['required', 'string'],
            'Dosis' => ['required', 'string'],
            'Comments' => ['required', 'string'],
            'clinical_history_id' => ['required', 'integer', 'exists:clinical_histories,id'],
            'idTreatment' => ['required', 'string'],
            'Name' => ['required', 'string', 'max:45'],
            'Frequency' => ['required', 'string'],
            'Dosis' => ['required', 'string'],
            'Comments' => ['required', 'string'],
            'clinical_history_id' => ['required', 'integer', 'exists:clinical_histories,id'],
        ];
    }
}
