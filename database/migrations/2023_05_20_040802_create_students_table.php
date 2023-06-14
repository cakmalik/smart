<?php

use App\Models\StudentFamily;
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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)->constrained();
            $table->foreignIdFor(StudentFamily::class)->constrained();
            $table->string('name');
            $table->string('nickname')->nullable();
            $table->string('nik');
            $table->string('place_of_birth');
            $table->date('date_of_birth');
            $table->enum('gender', ['male', 'female'])->default('male');
            $table->string('address')->default('-');
            $table->string('rt_rw')->default('-');
            $table->string('village');
            $table->string('district');
            $table->string('city');
            $table->string('province');
            $table->string('postal_code');
            $table->string('religion')->default('islam');

            $table->string('nationality')->default('indonesia');

            $table->string('phone')->default('-');
            $table->string('student_image')->nullable();

            $table->integer('child_number')->nullable();
            $table->integer('siblings')->nullable();
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
            $table->enum('status', ['waiting', 'accepted', 'rejected'])->default('waiting');
            $table->dateTime('verified_at')->nullable();

            // $table->foreignId('student_family_id')->constrained('student_families')->onDelete('cascade');
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
