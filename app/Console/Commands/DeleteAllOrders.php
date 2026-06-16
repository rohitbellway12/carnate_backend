<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Exception;

class DeleteAllOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:purge';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all order‑related data and reset auto‑increment counters.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting purge of order data...');

        // Tables that contain order‑related information.
        $tables = [
            'orders',
            'order_items',
            'order_item_histories',
            'stock_histories',
            'wallets',
            'notifications',
            'invoices',
            // pivot / linking tables – adjust names if they differ in your schema
            'order_spare_part',
            'order_workshop',
            'purchase_orders',
            'purchase_order_items',
            // serial / counter tables used for invoice numbers
            'tbl_invoices',
            'serial_counters',
        ];

        try {
            // Disable foreign key checks so we can truncate in any order.
            DB::statement('SET FOREIGN_KEY_CHECKS = 0');

            foreach ($tables as $table) {
                // Only truncate if the table actually exists in the current database.
                if (Schema::hasTable($table)) {
                    DB::statement("TRUNCATE TABLE `$table`");
                    $this->line("Truncated `$table`");
                } else {
                    $this->line("Table `$table` does not exist – skipping.");
                }
            }

            // Re‑enable foreign key checks.
            DB::statement('SET FOREIGN_KEY_CHECKS = 1');

            $this->info('All order data purged successfully.');
        } catch (Exception $e) {
            // Ensure foreign key checks are turned back on even if something fails.
            DB::statement('SET FOREIGN_KEY_CHECKS = 1');
            $this->error('Purge failed: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
