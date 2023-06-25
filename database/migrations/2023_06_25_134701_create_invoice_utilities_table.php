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
        Schema::create('invoice_utilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_category_id')->nullable()->constrained('invoice_categories');
            $table->string('name');
            $table->string('period');
            $table->string('description')->nullable();
            $table->bigInteger('amount')->default(0);
            $table->string('code')->unique();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_utilities');
    }
};
