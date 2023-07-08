<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFormatMessageRequest extends FormRequest
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
            'message' => 'required|string',
        ];
    }

    //messages indonesia
    public function messages(): array
    {
        return [
            'message.required' => 'Pesan tidak boleh kosong',
            'message.string' => 'Pesan harus berupa string',
            'message.max' => 'Pesan maksimal 255 karakter',
        ];
    }
}
