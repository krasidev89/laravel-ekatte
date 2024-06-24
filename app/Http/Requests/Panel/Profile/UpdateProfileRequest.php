<?php

namespace App\Http\Requests\Panel\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
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
        if ($this->input('_form') == 'update-password') {
            return [
                'current_password' => ['required', 'current_password'],
                'password' => ['required', 'confirmed', Password::defaults()]
            ];
        }

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . auth()->user()->id . ',id'],
            'role' => ['nullable', 'integer']
        ];
    }
}
