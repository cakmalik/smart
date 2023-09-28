<?php

use App\Models\Student;
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
        Schema::create('student_in_out_permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Student::class, 'student_id')->constrained('students');
            $table->foreignId('in_out_permission_type_id')->constrained('in_out_permission_types');
            $table->dateTime('out_time');
            $table->dateTime('in_time')->nullable();
            $table->boolean('is_late')->default(false);
            $table->string('reason')->nullable();
            $table->bigInteger('approved_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_in_out_permissions');
    }
};
