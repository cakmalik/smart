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
        Schema::create('student_educational_backgrounds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students');
            $table->string('school_name');
            $table->enum('level', ['primary', 'secondary', 'high', 'bachelor', 'master', 'doctoral']);
            $table->string('school_address');
            $table->string('school_phone_number')->nullable();
            $table->string('npsn')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_educational_backgrounds');
    }
};
