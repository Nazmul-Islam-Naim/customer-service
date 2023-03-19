<?php

namespace App\Http\Requests\DistrictRequest;

use App\Models\District;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $id = $this->route('district');
        return [
            'division_id' => ['required'],
            'name' => ['required', 'max:255', Rule::unique(District::class)->ignore($id)],
        ];
    }
}
