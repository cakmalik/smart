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
            $table->foreignId('education_id')->constrained('informal_education');
            $table->foreignId('class_id')->constrained('informal_education_classes');
            $table->foreignId('grade_id')->constrained('informal_education_grades');
            $table->foreignId('subjectt_id')->constrained('informal_education_subjects');
            $table->foreignId('academic_id');
            $table->string('score');
            $table->string('score_text')->nullable();
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
        Schema::dropIfExists('informal_assessement_students');
    }
};
