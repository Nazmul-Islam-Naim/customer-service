<?php

namespace App\Http\Requests\FolloupRequest;

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
        return [
            'question1' => ['required','max:10'],
            'question2' => ['required','max:10'],
            'question3' => ['required','max:10'],
            'question4' => ['required','max:10'],
        ];
    }
}
