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
        Schema::table('purchase_order_items', function (Blueprint $table) {
            $table->unsignedBigInteger('part_id')->nullable()->after('purchase_order_id');
            $table->string('part_number')->nullable()->after('part_name');
            $table->unsignedBigInteger('category_id')->nullable()->after('part_number');
            $table->unsignedBigInteger('unit_id')->nullable()->after('category_id');
            $table->string('rack_no')->nullable()->after('unit_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('purchase_order_items', function (Blueprint $table) {
            $table->dropColumn(['part_id', 'part_number', 'category_id', 'unit_id', 'rack_no']);
        });
    }
};
