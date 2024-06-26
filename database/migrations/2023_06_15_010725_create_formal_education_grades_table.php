<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Models\Formal\FormalEducationClass;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('formal_education_grades', function (Blueprint $table) {
            $table->id();
            // formal_education_class_id
            $table->foreignIdFor(FormalEducationClass::class)->constrained('formal_education_classes');
            $table->string('grade_name'); //e.g., 7a
            $table->integer('qty')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formal_education_grades');
    }
};
