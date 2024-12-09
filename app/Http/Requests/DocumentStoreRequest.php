<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentStoreRequest extends FormRequest
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
            'Document' => ['required', 'string'],
            'idDocument' => ['required', 'string'],
            'Title' => ['required', 'string', 'max:45'],
            'Document' => ['required', 'string'],
            'animal_id' => ['required', 'integer', 'exists:animals,id'],
        ];
    }
}
