<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNoteRequest extends FormRequest
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
            'title' => 'required|string|max:255|unique:notes,title,NULL,id,user_id,' . $this->user_id,
            'content' => 'nullable|string',
            'category' => 'nullable|string|max:100',
            'is_favorite' => 'sometimes|boolean',
            'user_id' => 'required|exists:users,id',
        ];
    }
}
