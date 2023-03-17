<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

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
        // dd($this->all());
        return [
            'name' => 'required|string|min:2|max:255',
            'email' => 'nullable|email|unique:users',
            'phone' => 'required|max:15|unique:users',
            'role_id' => 'required',
            'department_id' => 'required',
            'designation_id' => 'required',
        ];
    }
}
