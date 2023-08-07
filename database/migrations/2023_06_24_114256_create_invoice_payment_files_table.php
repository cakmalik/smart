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
        Schema::create('invoice_payment_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained('invoices');
            $table->string('file_name');
            $table->string('from_bank');
            $table->string('to_bank');
            $table->string('from_account');
            $table->string('to_account')->nullable();
            $table->string('amount');
            $table->string('title')->nullable();
            $table->string('reference')->nullable();
            $table->string('desc')->nullable();
            $table->enum('status', ['waiting', 'approved', 'reject'])->default('waiting');
            //caused by foreign id
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->date('approved_at')->nullable();
            // TODO:add approved_by
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_payment_files');
    }
};
