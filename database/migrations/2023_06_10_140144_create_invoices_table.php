<?php

use Carbon\Carbon;
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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('student_id')->constrained('students');
            $table->foreignId('invoice_category_id')->constrained('invoice_categories');
            $table->string('period');
            $table->string('invoice_number');
            $table->dateTime('invoice_date')->default(now());
            $table->dateTime('due_date')->default(Carbon::now()->addDays(7));
            $table->string('description')->nullable();
            $table->bigInteger('amount')->default(0);
            $table->enum('status', ['draft', 'sent',  'unpaid', 'waiting', 'paid', 'canceled', 'expired'])->default('unpaid');
            $table->foreignId('payment_method_id')->nullable()->constrained('payment_methods');
            $table->string('title')->nullable();
            $table->string('reference')->nullable();
            $table->string('desc')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
