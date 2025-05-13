<?php

namespace App\Http\Requests\Panel\Settlement;

use Illuminate\Foundation\Http\FormRequest;

class StoreSettlementRequest extends FormRequest
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
            'ekatte' => ['required', 'string', 'max:5'],
            'name' => ['required', 'string', 'max:64', 'unique:settlements,name,NULL,id,town_hall_id,' . $this->town_hall_id],
            'settlement_kind_id' => ['required', 'integer'],
            'district_id' => ['required', 'integer'],
            'municipality_id' => ['required', 'integer'],
            'town_hall_id' => ['required', 'integer']
        ];
    }
}
