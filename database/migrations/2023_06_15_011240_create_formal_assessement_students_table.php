<?php

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Formal\FormalEducation;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Models\Formal\FormalEducationClass;
use App\Models\Formal\FormalEducationGrade;
use App\Models\Formal\FormalEducationSubject;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('formal_assessment_students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students');
            $table->foreignId('formal_education_id')->constrained('formal_education');
            $table->foreignId('formal_education_class_id')->constrained('formal_education_classes');
            $table->foreignId('formal_education_grade_id')->constrained('formal_education_grades');
            $table->foreignId('formal_education_subject_id')->constrained('formal_education_subjects');
            $table->string('academic_year');
            $table->integer('score');
            $table->string('score_text');
            $table->string('description')->nullable();
            $table->foreignId('teacher_id')->nullable()->constrained('teachers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formal_assessment_students');
    }
};
