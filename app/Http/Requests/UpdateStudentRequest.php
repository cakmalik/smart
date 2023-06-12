<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
                'name' => 'required',
                'gender' => 'required',
                'nik' => 'required',
                'place_of_birth' => 'required',
                'date_of_birth' => 'required',
                'child_number' => 'numeric',
                'siblings' => 'numeric',
                // 'father_name' => 'required',
                // 'mother_name' => 'required',
        ];
    }
}
