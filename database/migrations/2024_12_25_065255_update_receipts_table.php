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
        // Schema::table('receipts', function (Blueprint $table) {
        //     $table->renameColumn('receipt_number', 'email');
        //     $table->string('email', 255)->charset('utf8mb4')->collation('utf8mb4_general_ci')->change();
        //     $table->renameColumn('amount', 'name');
        //     $table->string('name', 255)->nullable()->default(null)->change();
        //     $table->renameColumn('receipt_date', 'status');
        //     $table->integer('status')->nullable()->default(null)->change();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('receipts', function (Blueprint $table) {
        //     $table->renameColumn('email', 'receipt_number');
        //     $table->string('receipt_number')->change();
        //     $table->renameColumn('name', 'amount');
        //     $table->decimal('amount', 8, 2)->nullable(false)->change();
        //     $table->renameColumn('status', 'receipt_date');
        //     $table->date('receipt_date')->nullable(false)->change();
        // });
    }
};
