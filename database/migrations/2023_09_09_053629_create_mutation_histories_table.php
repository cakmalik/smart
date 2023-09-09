<?php

use App\Models\Student;
use App\Models\User;
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
        Schema::create('mutation_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Student::class);
            $table->string('model');
            $table->unsignedBigInteger('before_id')->nullable();
            $table->unsignedBigInteger('after_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mutation_histories');
    }
};
