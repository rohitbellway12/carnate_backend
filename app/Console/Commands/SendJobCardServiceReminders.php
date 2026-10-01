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
                            {--force : Force send even if already sent or delivery date is not 1 year ago}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send 1-year service reminder SMS to customers based on Job Card delivery date';

    /**
     * Execute the console command.
     */
    public function handle(Msg91Service $msg91Service): int
    {
        $specificId = $this->option('jobcard');
        $force = $this->option('force');

        // Mode 1: Manual / Specific Job Card Test
        if ($specificId) {
            $jobcard = JobCard::with(['customer', 'vehicle', 'workshop'])->find($specificId);

            if (!$jobcard) {
                $this->error("Job Card #{$specificId} not found.");
                return 1;
            }

            $this->info("Processing Service Reminder for Job Card #{$jobcard->id} (Delivery Date: {$jobcard->delivery_date})");

            if ($jobcard->service_reminder_sent_at && !$force) {
                $this->warn("Service reminder already sent for Job Card #{$jobcard->id} on {$jobcard->service_reminder_sent_at}. Use --force to resend.");
                return 0;
            }

            $success = $msg91Service->sendJobCardSms($jobcard, 'service_reminder');

            if ($success) {
                $jobcard->service_reminder_sent_at = now();
                $jobcard->save();
                $custMobile = $jobcard->customer->mobile_no ?? 'N/A';
                $this->info("✅ Service Reminder SMS successfully sent to customer ({$custMobile})!");
                return 0;
            } else {
                $this->error("❌ Failed to send Service Reminder SMS. Check storage/logs/laravel.log for details.");
                return 1;
            }
        }

        // Mode 2: Scheduled Daily Automated Check
        $targetDate = Carbon::today()->subYear()->toDateString();
        // Catch job cards from the past 7 days if scheduler was missed over weekend/downtime
        $lookbackWindow = Carbon::today()->subYear()->subDays(7)->toDateString();

        $this->info("Searching for closed Job Cards with delivery date around 1 year ago (between {$lookbackWindow} and {$targetDate})...");

        $query = JobCard::with(['customer', 'vehicle', 'workshop'])
            ->where('status', 3) // Closed
            ->where(function ($q) {
                $q->whereNull('sms_alert')->orWhere('sms_alert', 1);
            })
            ->whereNull('service_reminder_sent_at')
            ->whereNotNull('delivery_date');

        if ($force) {
            $query->whereDate('delivery_date', '<=', $targetDate);
        } else {
            $query->whereDate('delivery_date', '<=', $targetDate)
                  ->whereDate('delivery_date', '>=', $lookbackWindow);
        }

        $jobcards = $query->get();
        $total = $jobcards->count();

        $this->info("Found {$total} eligible Job Card(s) for 1-year Service Reminder.");

        $sentCount = 0;
        $failedCount = 0;

        foreach ($jobcards as $jobcard) {
            $custMobile = $jobcard->customer->mobile_no ?? 'N/A';
            $this->line("Sending reminder for Job Card #{$jobcard->id} (Vehicle: {$jobcard->vehical_number}, Mobile: {$custMobile})...");

            $success = $msg91Service->sendJobCardSms($jobcard, 'service_reminder');

            if ($success) {
                $jobcard->service_reminder_sent_at = now();
                $jobcard->save();
                $sentCount++;
                Log::info("[MSG91] 1-Year Service Reminder sent for Job Card #{$jobcard->id}");
            } else {
                $failedCount++;
                Log::error("[MSG91] Failed 1-Year Service Reminder for Job Card #{$jobcard->id}");
            }
        }

        $this->info("Summary: {$sentCount} sent successfully, {$failedCount} failed.");
        return 0;
    }
}
