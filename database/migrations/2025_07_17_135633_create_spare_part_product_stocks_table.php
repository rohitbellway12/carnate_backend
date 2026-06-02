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
        Schema::create('spare_part_product_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('partname');
            $table->string('part_no')->nullable();
            $table->string('company_name')->nullable();
            $table->string('category')->nullable();
            $table->integer('quantity');
            $table->string('unit')->nullable();
            $table->string('rack_no')->nullable();
            $table->decimal('total_payable', 12, 2)->nullable();
            $table->unsignedBigInteger('purchase_order_id')->nullable();
            $table->timestamps();

            $table->foreign('purchase_order_id')->references('id')->on('purchase_orders')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spare_part_product_stocks');
    }
};
