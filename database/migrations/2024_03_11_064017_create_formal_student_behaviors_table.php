<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('formal_student_behaviors', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Student::class);
            $table->foreignId('academic_id')->constrained('formal_education_academic_years');
            $table->enum('behavior', ['kerapian', 'kerajinan', 'ketertiban'])->default('kerapian');
            $table->string('score');
            $table->string('score_textt')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formal_student_behaviors');
    }
};
