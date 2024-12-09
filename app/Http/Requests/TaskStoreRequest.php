<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskStoreRequest extends FormRequest
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
            'Title' => ['required', 'string', 'max:45'],
            'Description' => ['required', 'string'],
            'idTask' => ['required', 'string'],
            'Title' => ['required', 'string', 'max:45'],
            'Description' => ['required', 'string'],
            'zone_id' => ['required', 'integer', 'exists:zones,id'],
            'animal_id' => ['required', 'integer', 'exists:animals,id'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'idTask' => ['required', 'string'],
            'Title' => ['required', 'string', 'max:45'],
            'Description' => ['required', 'string'],
            'zone_id' => ['required', 'integer', 'exists:zones,id'],
            'animal_id' => ['required', 'integer', 'exists:animals,id'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'idTask' => ['required', 'string'],
            'Title' => ['required', 'string', 'max:45'],
            'Description' => ['required', 'string'],
            'zone_id' => ['required', 'integer', 'exists:zones,id'],
            'animal_id' => ['required', 'integer', 'exists:animals,id'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'idTask' => ['required', 'string'],
            'Title' => ['required', 'string', 'max:45'],
            'Description' => ['required', 'string'],
            'zone_id' => ['required', 'integer', 'exists:zones,id'],
            'animal_id' => ['required', 'integer', 'exists:animals,id'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
        ];
    }
}
