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
        Schema::create('informal_educaion_class_subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->constrained('informal_education_classes');
            $table->foreignId('subject_id')->constrained('informal_education_subjects');
            $table->foreignId('teacher_id')->nullable()->constrained('teachers');
            $table->integer('minimum_completness_criteria')->default(0);
            $table->enum('gender', ['male', 'female'])->default('male');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informal_educaion_class_subjects');
    }
};
