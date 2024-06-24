<?php

namespace App\Http\Requests\Panel\District;

use Illuminate\Foundation\Http\FormRequest;

class StoreDistrictRequest extends FormRequest
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
        return [
            'code' => ['required', 'string', 'max:4', 'unique:districts'],
            'ekatte' => ['required', 'string', 'max:5'],
            'name' => ['required', 'string', 'max:64', 'unique:districts'],
            'region_id' => ['required', 'integer']
        ];
    }
}
