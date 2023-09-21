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
        Schema::create('invoice_category_discounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_category_id')->constrained();
            $table->integer('number_of_child');
            $table->integer('discount_amount');
            $table->enum('discount_type', ['percentage', 'amount']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_category_discounts');
    }
};
