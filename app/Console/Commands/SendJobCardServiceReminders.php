<?php

namespace App\Console\Commands;

use App\Models\JobCard;
use App\Services\Msg91Service;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendJobCardServiceReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jobcard:send-service-reminders 
                            {--jobcard= : Specific Job Card ID to send reminder for (useful for testing)} 
                            {--type= : Reminder interval: 6m, 1y, or all (default: all)}
                            {--force : Force send even if already sent or delivery date is not matched}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send 6-month and 1-year service reminder SMS to customers based on Job Card delivery date';

    /**
     * Execute the console command.
     */
    public function handle(Msg91Service $msg91Service): int
    {
        $specificId = $this->option('jobcard');
        $force = (bool) $this->option('force');
        $type = strtolower($this->option('type') ?: 'all');

        // Mode 1: Manual / Specific Job Card Test
        if ($specificId) {
            return $this->handleSpecificJobCard((int) $specificId, $type, $force, $msg91Service);
        }

        // Mode 2: Scheduled Daily Automated Check
        $this->info("=== Starting Daily Service Reminders (6-Month & 1-Year) ===");

        $totalSent = 0;
        $totalFailed = 0;

        if ($type === 'all' || $type === '6m') {
            [$sent6m, $failed6m] = $this->processReminders('6m', $force, $msg91Service);
            $totalSent += $sent6m;
            $totalFailed += $failed6m;
        }

        if ($type === 'all' || $type === '1y') {
            [$sent1y, $failed1y] = $this->processReminders('1y', $force, $msg91Service);
            $totalSent += $sent1y;
            $totalFailed += $failed1y;
        }

        $this->info("=== Finished Service Reminders. Overall: {$totalSent} sent, {$totalFailed} failed ===");
        return 0;
    }

    /**
     * Process automated batch for a specific interval ('6m' or '1y')
     */
    private function processReminders(string $interval, bool $force, Msg91Service $msg91Service): array
    {
        $label = $interval === '6m' ? '6-Month' : '1-Year';
        $sentColumn = $interval === '6m' ? 'service_reminder_6m_sent_at' : 'service_reminder_sent_at';

        if ($interval === '6m') {
            $targetDate = Carbon::today()->subMonths(6)->toDateString();
            $lookbackWindow = Carbon::today()->subMonths(6)->subDays(7)->toDateString();
        } else {
            $targetDate = Carbon::today()->subYear()->toDateString();
            $lookbackWindow = Carbon::today()->subYear()->subDays(7)->toDateString();
        }

        $this->info("Searching for {$label} reminders (delivery date between {$lookbackWindow} and {$targetDate})...");

        $query = JobCard::with(['customer', 'vehicle', 'workshop'])
            ->where('status', 3) // Closed
            ->where(function ($q) {
                $q->whereNull('sms_alert')->orWhere('sms_alert', 1);
            })
            ->whereNull($sentColumn)
            ->whereNotNull('delivery_date');

        if ($force) {
            $query->whereDate('delivery_date', '<=', $targetDate);
        } else {
            $query->whereDate('delivery_date', '<=', $targetDate)
                  ->whereDate('delivery_date', '>=', $lookbackWindow);
        }

        $jobcards = $query->get();
        $count = $jobcards->count();
        $this->info("Found {$count} eligible Job Card(s) for {$label} Service Reminder.");

        $sent = 0;
        $failed = 0;

        foreach ($jobcards as $jobcard) {
            $custMobile = $jobcard->customer->mobile_no ?? 'N/A';
            $this->line("[{$label}] Sending reminder for Job Card #{$jobcard->id} (Vehicle: {$jobcard->vehical_number}, Mobile: {$custMobile})...");

            $success = $msg91Service->sendJobCardSms($jobcard, 'service_reminder');

            if ($success) {
                $jobcard->{$sentColumn} = now();
                $jobcard->save();
                $sent++;
                Log::info("[MSG91] {$label} Service Reminder sent for Job Card #{$jobcard->id}");
            } else {
                $failed++;
                Log::error("[MSG91] Failed {$label} Service Reminder for Job Card #{$jobcard->id}");
            }
        }

        $this->info("{$label} Summary: {$sent} sent, {$failed} failed.");
        return [$sent, $failed];
    }

    /**
     * Handle manual reminder dispatch for a single Job Card
     */
    private function handleSpecificJobCard(int $jobcardId, string $type, bool $force, Msg91Service $msg91Service): int
    {
        $jobcard = JobCard::with(['customer', 'vehicle', 'workshop'])->find($jobcardId);

        if (!$jobcard) {
            $this->error("Job Card #{$jobcardId} not found.");
            return 1;
        }

        $interval = in_array($type, ['6m', '1y']) ? $type : '6m';
        $label = $interval === '6m' ? '6-Month' : '1-Year';
        $sentColumn = $interval === '6m' ? 'service_reminder_6m_sent_at' : 'service_reminder_sent_at';

        $this->info("Processing {$label} Service Reminder for Job Card #{$jobcard->id} (Delivery Date: {$jobcard->delivery_date})");

        if ($jobcard->{$sentColumn} && !$force) {
            $this->warn("{$label} Service reminder already sent for Job Card #{$jobcard->id} on {$jobcard->{$sentColumn}}. Use --force to resend.");
            return 0;
        }

        $success = $msg91Service->sendJobCardSms($jobcard, 'service_reminder');

        if ($success) {
            $jobcard->{$sentColumn} = now();
            $jobcard->save();
            $custMobile = $jobcard->customer->mobile_no ?? 'N/A';
            $this->info("✅ {$label} Service Reminder SMS successfully sent to customer ({$custMobile})!");
            return 0;
        } else {
            $this->error("❌ Failed to send {$label} Service Reminder SMS. Check storage/logs/laravel.log for details.");
            return 1;
        }
    }
}
