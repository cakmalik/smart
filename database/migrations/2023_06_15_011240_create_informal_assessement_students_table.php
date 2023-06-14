<?php

use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Models\Informal\InformalEducation;
use Illuminate\Database\Migrations\Migration;
use App\Models\Informal\InformalEducationClass;
use App\Models\Informal\InformalEducationGrade;
use App\Models\Informal\InformalEducationSubject;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('informal_assessement_students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students');
            $table->foreignId('informal_education_id')->constrained('informal_education');
            $table->foreignId('informal_education_class_id')->constrained('informal_education_classes')->name('fk_ias_education_class');
            $table->foreignId('informal_education_grade_id')->constrained('informal_education_grades')->name('fk_ias_education_grade');
            $table->foreignId('informal_education_subject_id')->constrained('informal_education_subjects')->name('fk_ias_education_subject');
            $table->string('academic_year');
            $table->integer('score');
            $table->string('score_text');
            $table->string('description')->nullable();
            $table->foreignId('teacher_id')->nullable()->constrained('teachers')->name('fk_ias_teacher');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informal_assessement_students');
    }
};
