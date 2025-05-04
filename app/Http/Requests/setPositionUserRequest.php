<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class setPositionUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'name' => 'required|string',
            'lastname' => 'required|string',
            'document_type' => 'required|string|min:2|max:3',
            'document_number' => 'required|string|min:8|max:11',
            'additionals' => 'array',
            'skills.*.id' => 'integer',
            'skills.*.value' => 'string',
        ];
    }
}
