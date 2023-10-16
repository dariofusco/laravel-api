<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProjectUpsertRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = Auth::user();

        if ($user->email === 'fdario@hotmail.it') {
            return true;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'type_id' => 'required',
            'technologies' => 'nullable',
            'description' => 'nullable',
            'date' => 'required',
            'image' => 'nullable',
            'github_link' => 'required'
        ];
    }

    public function messages(): array {
        return [
            'name.required' => 'Il nome è richiesto',
            'type.required' => 'La tipologia è richiesta',
            'date.required' => 'La data è richiesta',
            'github_link' => 'Il link è richiesto'
        ];
    }

}
