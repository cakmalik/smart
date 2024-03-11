<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('informal_student_attendance_recaps', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Student::class);
            $table->foreignId('academic_id')->constrained('informal_education_academic_years');
            $table->integer('present')->default(0);
            $table->integer('absent')->default(0);
            $table->integer('late')->default(0);
            $table->integer('sick')->default(0);
            $table->integer('permission')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informal_student_attendance_recaps');
    }
};
