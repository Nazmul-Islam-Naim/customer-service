<?php

namespace App\Http\Requests\ProductRequest;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateRequest extends FormRequest
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
        if (!empty($this->product_id)) { 
            return [
                'name' => ['required', 'max:255', Rule::unique(Product::class)->ignore($this->product_id)],
                'business_cat_id' => ['required']
            ];
        } else {
            return [
                'name' => ['required', 'max:255', Rule::unique(Product::class)],
                'business_cat_id' => ['required']
            ];
        }
        
    }
}
