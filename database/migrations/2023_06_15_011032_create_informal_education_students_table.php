<?php

use App\Models\Informal\InformalEducation;
use App\Models\Student;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Models\Informal\InformalEducationClass;
use App\Models\Informal\InformalEducationGrade;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('informal_education_students', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Student::class)->constrained('students');
            $table->foreignIdFor(InformalEducation::class)->constrained('informal_education');
            $table->foreignIdFor(InformalEducationClass::class)->constrained('informal_education_classes');
            $table->foreignIdFor(InformalEducationGrade::class)->nullable()->constrained('informal_education_grades');
            $table->enum('status', ['waiting', 'approved', 'rejected', 'graduated', 'active', 'canceled', 'inactive'])->default('waiting');
            $table->string('year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informal_education_students');
    }
};
