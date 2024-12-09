<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnimalStoreRequest extends FormRequest
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
            'Description' => ['required', 'string', 'max:45'],
            'Superpower' => ['required', 'string', 'max:45'],
            'idAnimal' => ['required', 'string'],
            'Description' => ['required', 'string', 'max:45'],
            'Superpower' => ['required', 'string', 'max:45'],
            'DateOfBirth' => ['nullable', 'date'],
            'DateOfDeath' => ['nullable', 'date'],
            'race_id' => ['required', 'integer', 'exists:races,id'],
            'zone_id' => ['required', 'integer', 'exists:zones,id'],
            'idAnimal' => ['required', 'string'],
            'Description' => ['required', 'string', 'max:45'],
            'Superpower' => ['required', 'string', 'max:45'],
            'DateOfBirth' => ['nullable', 'date'],
            'DateOfDeath' => ['nullable', 'date'],
            'race_id' => ['required', 'integer', 'exists:races,id'],
            'zone_id' => ['required', 'integer', 'exists:zones,id'],
            'idAnimal' => ['required', 'string'],
            'Description' => ['required', 'string', 'max:45'],
            'Superpower' => ['required', 'string', 'max:45'],
            'DateOfBirth' => ['nullable', 'date'],
            'DateOfDeath' => ['nullable', 'date'],
            'race_id' => ['required', 'integer', 'exists:races,id'],
            'zone_id' => ['required', 'integer', 'exists:zones,id'],
        ];
    }
}
