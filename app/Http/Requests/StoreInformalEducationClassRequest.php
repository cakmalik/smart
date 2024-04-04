<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInformalEducationClassRequest extends FormRequest
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
        // $table->foreignIdFor(InformalEducation::class)->constrained('informal_education');
        // $table->string('class_name'); //e.g., 7
        // $table->integer('qty')->default(0);
        // $table->integer('current_qty')->default(0);
        // $table->string('class_name_full')->nullable();

        // $table->unsignedBigInteger('teacher_id')->nullable();
        // $table->foreign('teacher_id')->references('id')->on('teachers')->nullable();

        return [
            // 'informal_education_id' => ['required', 'exists:informal_educations,id'],
            // 'class_name' => ['required', 'string', 'max:20','unique:informal_education_classes,class_name,except,id'],
            // 'class_name_full' => ['nullable', 'string', 'max:20'],
            // ''
        ];
    }
}