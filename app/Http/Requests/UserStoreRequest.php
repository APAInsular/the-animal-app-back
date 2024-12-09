<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'idUser' => ['required', 'string'],
            'FirstName' => ['required', 'string', 'max:45'],
            'LastName' => ['required', 'string', 'max:45'],
            'Email' => ['required', 'string', 'max:45'],
            'idUser' => ['required', 'string'],
            'FirstName' => ['required', 'string', 'max:45'],
            'LastName' => ['required', 'string', 'max:45'],
            'Email' => ['required', 'string', 'max:45'],
            'Email' => ['required', 'string', 'max:45'],
            'idUser' => ['required', 'string'],
            'FirstName' => ['required', 'string', 'max:45'],
            'LastName' => ['required', 'string', 'max:45'],
            'Email' => ['required', 'string', 'max:45'],
        ];
    }
}
