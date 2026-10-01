<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\JobCard;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Msg91Service
{
    protected ?string $authKey;
    protected array $templates;

    public function __construct()
    {
        $this->authKey = config('services.msg91.auth_key') ?: env('MSG91_AUTH_KEY');
        $this->templates = config('services.msg91.templates', []);
    }

    /**
     * Format Indian mobile number to MSG91 required format (91XXXXXXXXXX)
     */
    public function formatMobile(?string $mobile): ?string
    {
        if (empty($mobile)) {
            return null;
        }

        // Remove non-digit characters
        $cleaned = preg_replace('/\D/', '', $mobile);

        // If 10 digits, prepend 91
        if (strlen($cleaned) === 10) {
            return '91' . $cleaned;
        }

        // If 11 digits starting with 0, replace leading 0 with 91
        if (strlen($cleaned) === 11 && str_starts_with($cleaned, '0')) {
            return '91' . substr($cleaned, 1);
        }

        // If already 12 digits starting with 91
        if (strlen($cleaned) === 12 && str_starts_with($cleaned, '91')) {
            return $cleaned;
        }

        return $cleaned;
    }

    /**
     * Send Flow SMS using MSG91 Flow API
     *
     * @param string $mobile
     * @param string $templateId
     * @param array $variables
     * @return bool
     */
    public function sendFlowSms(string $mobile, string $templateId, array $variables = []): bool
    {
        if (empty($this->authKey)) {
            Log::warning('[MSG91] Auth Key is missing in config/services.php or .env');
            return false;
        }

        if (empty($templateId)) {
            Log::warning('[MSG91] Template ID is missing');
            return false;
        }

        $formattedMobile = $this->formatMobile($mobile);
        if (empty($formattedMobile)) {
            Log::warning("[MSG91] Invalid mobile number: '{$mobile}'");
            return false;
        }

        $payload = [
            'template_id' => $templateId,
            'short_url' => '0',
            'recipients' => [
                array_merge([
                    'mobiles' => $formattedMobile,
                ], $variables),
            ],
        ];

        try {
            Log::info("[MSG91] Sending SMS via Flow API", [
                'mobile' => $formattedMobile,
                'template_id' => $templateId,
                'variables' => $variables,
            ]);

            $response = Http::withHeaders([
                'authkey' => $this->authKey,
                'content-type' => 'application/json',
                'accept' => 'application/json',
            ])->timeout(10)->post('https://control.msg91.com/api/v5/flow', $payload);

            $body = $response->body();
            Log::info("[MSG91] Response status: {$response->status()}, Body: {$body}");

            if ($response->successful()) {
                return true;
            }

            Log::error("[MSG91] Flow API failed with status {$response->status()}: {$body}");
            return false;
        } catch (\Throwable $e) {
            Log::error("[MSG91] Exception while sending SMS: " . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);
            return false;
        }
    }

    /**
     * Send Job Card Notification SMS based on event/status
     *
     * @param JobCard|int $jobcard
     * @param string $event 'create' | 'process' | 'confirm' | 'close' | 'service_reminder'
     * @param array $extraVariables
     * @return bool
     */
    public function sendJobCardSms($jobcard, string $event, array $extraVariables = []): bool
    {
        if (is_numeric($jobcard)) {
            $jobcard = JobCard::with(['customer', 'vehicle', 'workshop'])->find($jobcard);
        }

        if (!$jobcard) {
            Log::warning("[MSG91] JobCard not found for event '{$event}'");
            return false;
        }

        // Check if sms_alert is explicitly turned off
        if (isset($jobcard->sms_alert) && (int)$jobcard->sms_alert === 0) {
            Log::info("[MSG91] SMS Alert is disabled for JobCard #{$jobcard->id} (event: {$event})");
            return false;
        }

        // Fetch Customer Mobile
        $customer = $jobcard->customer ?? Customer::find($jobcard->customer_id);
        $mobile = $customer->mobile_no ?? null;

        if (empty($mobile)) {
            Log::warning("[MSG91] Customer mobile number missing for JobCard #{$jobcard->id}");
            return false;
        }

        // Select Template ID
        $templateKey = strtolower($event) . '_jobcard';
        $templateId = $this->templates[$templateKey] 
            ?? $this->templates[$event] 
            ?? config("services.msg91.templates.{$templateKey}")
            ?? config("services.msg91.templates.{$event}");

        if (empty($templateId)) {
            Log::warning("[MSG91] No template ID mapped for event '{$event}'");
            return false;
        }

        // Prepare dynamic parameters
        $customerName = trim(($customer->name ?? '') . ' ' . ($customer->lastname ?? ''));
        if (empty($customerName)) {
            $customerName = $jobcard->customer_name ?: 'Customer';
        }

        $vehicleNumber = $jobcard->vehical_number ?: ($jobcard->vehicle->number_plate ?? '');
        $vehicleName = $jobcard->vehical ?: '';
        $jobcardNumber = $jobcard->jobcard_number ?: ('#' . $jobcard->id);
        $workshopName = $jobcard->workshop->company_name ?? ($jobcard->workshop->name ?? 'Carnate Workshop');
        $finalAmount = (string)($jobcard->final_amount ?: ($jobcard->amount ?: 0));
        $pendingAmount = (string)($jobcard->balance_amount ?: 0);
        $currentDate = now()->format('d-m-Y');

        // Populate multiple aliases for variables so whatever key MSG91 template uses, it matches!
        $variables = array_merge([
            'name' => $customerName,
            'customer_name' => $customerName,
            'jobcard_no' => $jobcardNumber,
            'job_card_no' => $jobcardNumber,
            'vehicle_no' => $vehicleNumber,
            'vehical_number' => $vehicleNumber,
            'vehicle_name' => $vehicleName,
            'workshop_name' => $workshopName,
            'amount' => $finalAmount,
            'balance' => $pendingAmount,
            'date' => $currentDate,
            // Generic positional fallback variables
            'var1' => $customerName,
            'var2' => $jobcardNumber,
            'var3' => $vehicleNumber,
            'var4' => $workshopName,
            'var5' => $finalAmount,
        ], $extraVariables);

        return $this->sendFlowSms($mobile, $templateId, $variables);
    }
}
