<?php

use App\Models\Informal\InformalEducationClass;
use App\Models\Teacher;
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
        Schema::create('informal_education_subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(InformalEducationClass::class)->constrained('informal_education_classes');
            $table->string('name'); //e.g., Matematika
            $table->foreignIdFor(Teacher::class)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informal_education_subjects');
    }
};
