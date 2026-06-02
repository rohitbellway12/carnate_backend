<?php

namespace App\Services;

use App\Models\CounterSale;
use App\Models\JobCard;
use App\Models\SharedSerialCounter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SharedSerialService
{
	public function formatSerial(string $companyCode, string $seriesCode, int $serial): string
	{
		return sprintf('%s/%s/%04d', $companyCode, $seriesCode, $serial);
	}

	/**
	 * Resolve invoice prefix from vendor/workshop record (company_name preferred).
	 */
	public static function resolveCompanyCode(object $vendor): string
	{
		$name = $vendor->company_name ?? $vendor->branch_name ?? 'COM';

		return strtoupper(Str::of((string) $name)->substr(0, 3) . 'INV');
	}

	/**
	 * Financial year series code, e.g. 2627 for FY 2026-27.
	 */
	public static function resolveSeriesCode(): string
	{
		$currentMonth = (int) date('n');
		$currentYear = (int) date('Y');
		$year1 = ($currentMonth < 4) ? $currentYear - 1 : $currentYear;
		$year2 = $year1 + 1;

		return substr((string) $year1, -2) . substr((string) $year2, -2);
	}

	public function previewNext(int $workshopId, string $companyCode, string $seriesCode): string
	{
		$counter = SharedSerialCounter::firstOrCreate(
			[
				'workshop_id' => $workshopId,
				'company_code' => $companyCode,
				'series_code' => $seriesCode,
			],
			['last_serial' => 0]
		);

		$this->syncCounterFromExistingRecords($counter, $workshopId, $companyCode, $seriesCode);

		return $this->formatSerial($companyCode, $seriesCode, $counter->last_serial + 1);
	}

	public function claimNext(int $workshopId, string $companyCode, string $seriesCode): string
	{
		return DB::transaction(function () use ($workshopId, $companyCode, $seriesCode) {
			SharedSerialCounter::firstOrCreate(
				[
					'workshop_id' => $workshopId,
					'company_code' => $companyCode,
					'series_code' => $seriesCode,
				],
				['last_serial' => 0]
			);

			$counter = SharedSerialCounter::where([
				'workshop_id' => $workshopId,
				'company_code' => $companyCode,
				'series_code' => $seriesCode,
			])->lockForUpdate()->first();

			$this->syncCounterFromExistingRecords($counter, $workshopId, $companyCode, $seriesCode);

			$counter->last_serial = ($counter->last_serial ?? 0) + 1;
			$counter->save();

			return $this->formatSerial($companyCode, $seriesCode, $counter->last_serial);
		});
	}

	/**
	 * Keep counter aligned with highest serial already stored on job cards / counter sales.
	 */
	protected function syncCounterFromExistingRecords(
		SharedSerialCounter $counter,
		int $workshopId,
		string $companyCode,
		string $seriesCode
	): void {
		$maxExisting = $this->maxExistingSerialNumber($workshopId, $companyCode, $seriesCode);

		if ($maxExisting > ($counter->last_serial ?? 0)) {
			$counter->last_serial = $maxExisting;
			$counter->save();
		}
	}

	protected function maxExistingSerialNumber(int $workshopId, string $companyCode, string $seriesCode): int
	{
		$prefix = $companyCode . '/' . $seriesCode . '/';
		$max = 0;

		$serials = JobCard::where('user_id', $workshopId)
			->whereNotNull('shared_serial')
			->where('shared_serial', 'like', $prefix . '%')
			->pluck('shared_serial');

		foreach ($serials as $serial) {
			$num = $this->parseSerialNumber($serial, $companyCode, $seriesCode);
			if ($num > $max) {
				$max = $num;
			}
		}

		$counterSerials = CounterSale::where('workshop_id', $workshopId)
			->where(function ($q) use ($prefix) {
				$q->where('shared_serial', 'like', $prefix . '%')
					->orWhere('countersale_number', 'like', $prefix . '%');
			})
			->get(['shared_serial', 'countersale_number']);

		foreach ($counterSerials as $row) {
			foreach ([$row->shared_serial, $row->countersale_number] as $serial) {
				if (!$serial) {
					continue;
				}
				$num = $this->parseSerialNumber($serial, $companyCode, $seriesCode);
				if ($num > $max) {
					$max = $num;
				}
			}
		}

		return $max;
	}

	protected function parseSerialNumber(string $serial, string $companyCode, string $seriesCode): int
	{
		$pattern = '/^' . preg_quote($companyCode, '/') . '\/' . preg_quote($seriesCode, '/') . '\/(\d+)$/i';

		if (preg_match($pattern, trim($serial), $matches)) {
			return (int) $matches[1];
		}

		return 0;
	}
}
