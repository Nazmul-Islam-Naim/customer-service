<?php

namespace App\Http\Requests\CustomerRequest;

use App\Models\Customer;
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
        return [
            'name' =>['required', 'max:255'], 
            'mobile' =>['required', 'max:15', Rule::unique(Customer::class)], 
            'email' =>['nullable', 'email',  Rule::unique(Customer::class)], 
            'lat' =>['required', 'max:255'],
            'long' =>['required', 'max:255'],
            'address' =>['nullable', 'max:255'], 
            'avatar' =>['nullable', 'max:255'],
            'priority_id' =>['required'], 
            'business_cat_id' =>['required'], 
            'user_id' =>['required'],
            'date' =>['required', 'date_format:Y-m-d'],
        ];
    }
}