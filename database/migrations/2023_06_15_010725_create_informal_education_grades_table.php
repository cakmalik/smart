<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Models\Informal\InformalEducationClass;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('informal_education_grades', function (Blueprint $table) {
            $table->id();
            // informal_education_class_id
            $table->foreignIdFor(InformalEducationClass::class);
            $table->string('grade_name'); //e.g., 7a
            $table->integer('qty')->default(0);
            $table->unsignedBigInteger('teacher_id')->nullable();
            $table->foreign('teacher_id')->references('id')->on('teachers')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informal_education_grades');
    }
};
