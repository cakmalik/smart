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
        Schema::table('student_families', function (Blueprint $table) {
            $table->string('father_place_of_birth')->after('father_name')->nullable();
            $table->date('father_date_of_birth')->after('father_name')->nullable();
            $table->string('mother_place_of_birth')->after('mother_name')->nullable();
            $table->date('mother_date_of_birth')->after('mother_name')->nullable();
            $table->string('father_status')->default('kandung')->after('father_name');
            $table->string('mother_status')->default('kandung')->after('mother_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_families', function (Blueprint $table) {
            $table->dropColumn(['father_place_of_birth', 'father_date_of_birth', 'mother_place_of_birth', 'mother_date_of_birth', 'father_status', 'mother_status']);
        });
    }
};