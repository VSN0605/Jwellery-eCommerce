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
        Schema::table('products', function (Blueprint $table) {
            $table->string('item_type')->after('product_name');
            $table->integer('product_number')->after('item_type');
            $table->integer('nsh_code')->after('product_number');
            $table->decimal('product_weight', 10, 2)->after('nsh_code');
            $table->decimal('purity', 10, 2)->after('product_weight');
            $table->integer('making_charge')->after('product_price');
            $table->integer('hole_mark_charge')->after('making_charge');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['item_type', 'product_number', 'nsh_code', 'product_weight', 'purity', 'making_charge', 'hole_mark_charge']);
        });
    }
};
