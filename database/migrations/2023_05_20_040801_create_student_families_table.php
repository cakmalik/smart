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
        Schema::create('student_families', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students');
            $table->string('father_name');
            $table->string('father_nik')->nullable();
            $table->string('father_phone')->nullable();
            $table->string('father_education')->nullable();
            $table->string('father_job')->nullable();
            $table->string('father_income')->nullable();

            $table->string('mother_name');
            $table->string('mother_nik')->nullable();
            $table->string('mother_phone')->nullable();
            $table->string('mother_education')->nullable();
            $table->string('mother_job')->nullable();
            $table->string('mother_income')->nullable();
            
            $table->string('guard_name')->nullable();
            $table->string('guard_nik')->nullable();
            $table->string('guard_phone')->nullable();
            $table->string('guard_education')->nullable();
            $table->string('guard_job')->nullable();
            $table->string('guard_income')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_families');
    }
};
