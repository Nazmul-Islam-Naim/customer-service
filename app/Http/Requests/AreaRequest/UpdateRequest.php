<?php

namespace App\Http\Requests\AreaRequest;

use App\Models\Area;
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
        $id =$this->route('area');
        return [
            'name' => ['required', 'max:255', Rule::unique(Area::class)->ignore($id) ],
            'address' => ['nullable', 'max:255' ],
            'district_id' => ['required'],
            'user_id' => ['required'],
        ];
    }
}