<?php

use App\Models\Formal\FormalEducation;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('formal_education_academic_years', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // e,g,. "2019-2020"
            $table->foreignIdFor(FormalEducation::class);
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->integer('semester'); // 1, 2
            $table->integer('year'); // 2019, 2020
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formal_education_academic_years');
    }
};
