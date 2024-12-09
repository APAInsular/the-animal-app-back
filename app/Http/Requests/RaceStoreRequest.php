<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RaceStoreRequest extends FormRequest
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
            'idRace' => ['required', 'string'],
            'Name' => ['required', 'string', 'max:45'],
            'species_id' => ['required', 'integer', 'exists:species,id'],
        ];
    }
}
