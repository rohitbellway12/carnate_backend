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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->string('po_no')->unique();
            $table->date('po_date');
            $table->string('bill_no')->nullable();
            $table->date('bill_date')->nullable();
            $table->string('po_status')->default('Open');
            $table->unsignedBigInteger('supplier_id');
            $table->text('note')->nullable();
            $table->decimal('subtotal', 12, 2)->nullable();
            $table->decimal('taxable_subtotal', 12, 2)->nullable();
            $table->decimal('gst', 12, 2)->nullable();
            $table->decimal('total_payable', 12, 2)->nullable();
            $table->decimal('po_payment', 12, 2)->nullable();
            $table->decimal('balance', 12, 2)->nullable();
            $table->decimal('paid', 12, 2)->nullable();
            $table->string('transaction_type')->nullable();
            $table->date('transaction_date')->nullable();
            $table->string('transaction_no')->nullable();
            $table->string('transporter_name')->nullable();
            $table->date('received_date')->nullable();
            $table->string('vehicle_number')->nullable();
            $table->string('delivery_person')->nullable();
            $table->string('lt_number')->nullable();
            $table->decimal('return_amount', 12, 2)->nullable();
            $table->decimal('previous_balance', 12, 2)->nullable();
            $table->decimal('total_balance', 12, 2)->nullable();
            $table->timestamps();

            $table->foreign('supplier_id')->references('id')->on('spare_part_suppliers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
