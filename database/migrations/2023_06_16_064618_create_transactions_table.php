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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('student_id')->constrained();
            $table->foreignId('invoice_id')->constrained();
            $table->foreignId('invoice_category_id')->constrained();
            $table->string('reference');
            $table->string('merchant_ref');
            $table->integer('total_amount');
            $table->enum('status', ['paid', 'unpaid', 'cash', 'expired', 'failed'])->default('unpaid');
            $table->boolean('is_cash')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
