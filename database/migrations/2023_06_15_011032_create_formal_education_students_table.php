<?php

use App\Models\Formal\FormalEducation;
use App\Models\Student;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Models\Formal\FormalEducationClass;
use App\Models\Formal\FormalEducationGrade;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('formal_education_students', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Student::class)->constrained('students');
            $table->foreignIdFor(FormalEducation::class)->constrained('formal_education');
            $table->foreignIdFor(FormalEducationClass::class)->constrained('formal_education_classes');
            $table->foreignId('formal_education_grade_id')->nullable()->constrained('formal_education_grades');
            $table->enum('status', ['waiting', 'approved', 'rejected', 'graduated', 'active', 'canceled', 'inactive'])->default('waiting');
            $table->string('year'); //sebagai penanda untuk riwayat suatu saat, jika di filter by tahun
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formal_education_students');
    }
};