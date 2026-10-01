<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Automatically send 1-Year Service Reminder SMS every day at 10:00 AM
Schedule::command('jobcard:send-service-reminders')->dailyAt('10:00');
