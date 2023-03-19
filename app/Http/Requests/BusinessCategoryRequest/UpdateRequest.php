<?php

namespace App\Http\Requests\BusinessCategoryRequest;

use App\Models\BusinessCategory;
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
        $id = $this->route('business_category');
        return [
            'name' => ['required',Rule::unique(BusinessCategory::class)->ignore($id)]
        ];
    }
}
