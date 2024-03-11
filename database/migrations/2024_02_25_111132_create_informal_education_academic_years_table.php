<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Models\Informal\InformalEducation;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('informal_education_academic_years', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); //144501, 144502, 144503
            $table->foreignIdFor(InformalEducation::class);
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->integer('semester'); //1, 2
            $table->integer('year'); //1445
            $table->boolean('is_active')->default(false);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informal_education_academic_years');
    }
};
