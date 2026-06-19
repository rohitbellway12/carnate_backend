<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Move any existing invoice numbers that belong to spare‑part orders
        // (i.e., they do NOT start with the workshop prefix "CARNATE")
        // into the new `spare_invoice_number` column.
        DB::statement(
            "UPDATE `orders` SET `spare_invoice_number` = `invoice_number`
             WHERE `invoice_number` IS NOT NULL
               AND `invoice_number` NOT LIKE 'CARNATE%'
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Restore the original state by moving the values back to `invoice_number`
        // only for rows where `invoice_number` is currently NULL (meaning they were
        // originally spare‑part invoices).
        DB::statement(
            "UPDATE `orders` SET `invoice_number` = `spare_invoice_number`
             WHERE `invoice_number` IS NULL
               AND `spare_invoice_number` IS NOT NULL"
        );
        // Clear the spare column.
        DB::statement('UPDATE `orders` SET `spare_invoice_number` = NULL');
    }
};
