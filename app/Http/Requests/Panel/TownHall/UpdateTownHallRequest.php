<?php

namespace App\Http\Requests\Panel\TownHall;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTownHallRequest extends FormRequest
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
            'code' => ['required', 'string', 'max:8', 'unique:town_halls,code,' . $this->route('town_hall') . ',id'],
            'ekatte' => ['required', 'string', 'max:5'],
            'name' => ['required', 'string', 'max:64', 'unique:town_halls,name,' . $this->route('town_hall') . ',id,municipality_id,' . $this->municipality_id],
            'municipality_id' => ['required', 'integer']
        ];
    }
}
