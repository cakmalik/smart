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
        Schema::create('room_student_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained();
            $table->foreignId('dormitory_id')->constrained();
            $table->foreignId('student_id')->constrained();
            $table->enum('status', ['waiting', 'approved', 'rejected'])->default('waiting');
            $table->foreignId('approved_by_sekretaris_id')->nullable()->constrained('users');
            $table->foreignId('approved_by_dormitory_admin_id')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_student_submissions');
    }
};