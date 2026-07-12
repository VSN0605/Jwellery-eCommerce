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
        Schema::create('billing', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('contact_no' ,15);
            $table->string('address');
            $table->string('purchase_product');
            $table->string('product_qty', 150);
            $table->string('product_price', 150);
            $table->smallInteger('gst');
            $table->smallInteger('total_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billing');
    }
};
