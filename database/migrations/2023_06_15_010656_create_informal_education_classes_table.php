<?php

use App\Models\Informal\InformalEducation;
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
        Schema::create('informal_education_classes', function (Blueprint $table) {
            $table->id();
            // informal_education_id
            $table->foreignIdFor(InformalEducation::class)->constrained('informal_education');
            $table->string('class_name'); //e.g., 7
            $table->integer('qty')->default(0);
            $table->integer('current_qty')->default(0);
            $table->string('class_name_full')->nullable();

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
        Schema::dropIfExists('informal_education_classes');
    }
};
