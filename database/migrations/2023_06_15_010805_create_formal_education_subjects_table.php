<?php

use App\Models\Formal\FormalEducationClass;
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
        Schema::create('formal_education_subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(FormalEducationClass::class)->constrained('formal_education_classes');
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
        Schema::dropIfExists('formal_education_subjects');
    }
};
