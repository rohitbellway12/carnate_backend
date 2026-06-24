<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== TRUNCATING ALL TEST DATA ===\n\n";

// Disable foreign key checks
DB::statement('SET FOREIGN_KEY_CHECKS=0');

$tables = [
    // Notifications first (references orders, job_cards)
    'notifications',
    // Job Card related (in dependency order)
    'send_job_card_pdf_mails',
    'exit_notes',
    'job_cards_inspections',
    'job_cards_dent_marks',
    'job_card_images',
    'job_card_extra_charges',
    'job_card_payments',
    'job_card_spare_parts',
    // Counter Sales
    'counter_sale_spare_parts',
    'counter_customers',
    'countersales',
    // Orders
    'order_items',
    'orders',
    // Payments
    'payments',
    // Customers
    'customers',
    // Job Cards main table
    'job_cards',
    // Invoice serial numbers (reset invoice counters)
    'shared_serial_numbers',
    'shared_serial_counters',
    // Subscriptions
    'subscriptions',
];

foreach ($tables as $table) {
    try {
        DB::table($table)->truncate();
        echo "✓ TRUNCATED: {$table}\n";
    } catch (\Exception $e) {
        echo "✗ ERROR truncating {$table}: " . $e->getMessage() . "\n";
    }
}

// Re-enable foreign key checks
DB::statement('SET FOREIGN_KEY_CHECKS=1');

echo "\n=== DONE! Verifying row counts ===\n\n";

foreach ($tables as $table) {
    try {
        $count = DB::table($table)->count();
        echo sprintf("%-40s => %d rows\n", $table, $count);
    } catch (\Exception $e) {
        echo sprintf("%-40s => ERROR\n", $table);
    }
}
