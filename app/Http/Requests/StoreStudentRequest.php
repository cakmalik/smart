<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
            'province' => 'required',
            'city' => 'required',
            'district' => 'required',
            'village' => 'required',
            'child_number' => 'numeric',
            'siblings' => 'numeric',
            'father_name' => 'required',
            'mother_name' => 'required',
        ];
    }
    
    public function messages(): array
    {
        return [
            'name.required' => 'Nama harus diisi.',
            'gender.required' => 'Jenis kelamin harus diisi.',
            'nik.required' => 'NIK harus diisi.',
            'place_of_birth.required' => 'Tempat lahir harus diisi.',
            'date_of_birth.required' => 'Tanggal lahir harus diisi.',
            'province.required' => 'Provinsi harus diisi.',
            'city.required' => 'Kota harus diisi.',
            'district.required' => 'Kecamatan harus diisi.',
            'village.required' => 'Desa harus diisi.',
            'child_number.numeric' => 'Nomor anak harus berupa angka.',
            'siblings.numeric' => 'Jumlah saudara harus berupa angka.',
            'father_name.required' => 'Nama ayah harus diisi.',
            'mother_name.required' => 'Nama ibu harus diisi.',
        ];
    }
}
