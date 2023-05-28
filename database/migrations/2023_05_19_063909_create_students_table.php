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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)->constrained();
            $table->string('nik');
            $table->string('place_of_birth');
            $table->date('date_of_birth');
            $table->string('gender');
            $table->string('address');
            $table->string('rt_rw');
            $table->string('village');
            $table->string('district');
            $table->string('city');
            $table->string('province');
            $table->string('postal_code');
            $table->string('religion');

            $table->string('nationality');

            $table->string('phone')->nullable();
            $table->string('student_image')->nullable();
            $table->string('parent_image')->nullable();

            $table->string('nis')->nullable();
            $table->string('hobby')->nullable();
            $table->string('ambition')->nullable();
            $table->string('housing_status')->nullable();
            $table->string('recidency_status')->nullable();
            $table->string('nism')->nullable();
            $table->string('kis')->nullable();
            $table->string('kip')->nullable();
            $table->string('kks')->nullable();
            $table->string('pkh')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
