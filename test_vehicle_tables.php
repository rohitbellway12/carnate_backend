<?php

// Test script to check vehicle tables and data
require_once 'vendor/autoload.php';

use Illuminate\Support\Facades\DB;
use App\Models\Modification;
use App\Models\SparePartVehicleModification;
use App\Models\Lubricant;
use App\Models\Part;
use App\Models\Accessory;

echo "=== Vehicle Tables Data Check ===\n\n";

// Check modifications table
echo "1. Modifications Table:\n";
$modifications = Modification::all();
echo "Total modifications: " . $modifications->count() . "\n";
if ($modifications->count() > 0) {
    echo "Sample modifications:\n";
    foreach ($modifications->take(5) as $mod) {
        echo "- ID: {$mod->id}, Title: {$mod->title}, Brand: {$mod->brand_name}, Variant: {$mod->variant_name}, Year: {$mod->year}\n";
    }
}
echo "\n";

// Check spare_part_vehicle_modifications table
echo "2. Spare Part Vehicle Modifications Table:\n";
$sparePartVehicleModifications = SparePartVehicleModification::all();
echo "Total pivot records: " . $sparePartVehicleModifications->count() . "\n";
if ($sparePartVehicleModifications->count() > 0) {
    echo "Sample pivot records:\n";
    foreach ($sparePartVehicleModifications->take(5) as $pivot) {
        echo "- Spare Part ID: {$pivot->spare_part_id}, Vehicle Modification ID: {$pivot->vehicle_modification_id}\n";
    }
}
echo "\n";

// Check lubricants table
echo "3. Lubricants Table (spare_parts with type 4):\n";
$lubricants = Lubricant::where('spare_part_type', 4)->get();
echo "Total lubricants: " . $lubricants->count() . "\n";
if ($lubricants->count() > 0) {
    echo "Sample lubricants:\n";
    foreach ($lubricants->take(5) as $lubricant) {
        echo "- ID: {$lubricant->id}, Name: {$lubricant->name}, Part Number: {$lubricant->part_number}, Suitable For: {$lubricant->suitable_for}\n";
    }
}
echo "\n";

// Check parts table
echo "4. Parts Table (spare_parts with type 2):\n";
$parts = Part::where('spare_part_type', 2)->get();
echo "Total parts: " . $parts->count() . "\n";
if ($parts->count() > 0) {
    echo "Sample parts:\n";
    foreach ($parts->take(5) as $part) {
        echo "- ID: {$part->id}, Name: {$part->name}, Part Number: {$part->part_number}, Suitable For: {$part->suitable_for}\n";
    }
}
echo "\n";

// Check accessories table
echo "5. Accessories Table (spare_parts with type 1):\n";
$accessories = Accessory::where('spare_part_type', 1)->get();
echo "Total accessories: " . $accessories->count() . "\n";
if ($accessories->count() > 0) {
    echo "Sample accessories:\n";
    foreach ($accessories->take(5) as $accessory) {
        echo "- ID: {$accessory->id}, Name: {$accessory->name}, Part Number: {$accessory->part_number}, Suitable For: {$accessory->suitable_for}\n";
    }
}
echo "\n";

// Check part_number field specifically for all types
echo "6. Part Number Field Check:\n";
$lubricantsWithPartNumber = Lubricant::where('spare_part_type', 4)->whereNotNull('part_number')->where('part_number', '!=', '')->get();
$partsWithPartNumber = Part::where('spare_part_type', 2)->whereNotNull('part_number')->where('part_number', '!=', '')->get();
$accessoriesWithPartNumber = Accessory::where('spare_part_type', 1)->whereNotNull('part_number')->where('part_number', '!=', '')->get();

echo "Lubricants with part number: " . $lubricantsWithPartNumber->count() . "\n";
echo "Parts with part number: " . $partsWithPartNumber->count() . "\n";
echo "Accessories with part number: " . $accessoriesWithPartNumber->count() . "\n";

if ($lubricantsWithPartNumber->count() > 0) {
    echo "Lubricants with part numbers:\n";
    foreach ($lubricantsWithPartNumber->take(5) as $lubricant) {
        echo "- ID: {$lubricant->id}, Name: {$lubricant->name}, Part Number: '{$lubricant->part_number}'\n";
    }
}

if ($partsWithPartNumber->count() > 0) {
    echo "Parts with part numbers:\n";
    foreach ($partsWithPartNumber->take(5) as $part) {
        echo "- ID: {$part->id}, Name: {$part->name}, Part Number: '{$part->part_number}'\n";
    }
}

if ($accessoriesWithPartNumber->count() > 0) {
    echo "Accessories with part numbers:\n";
    foreach ($accessoriesWithPartNumber->take(5) as $accessory) {
        echo "- ID: {$accessory->id}, Name: {$accessory->name}, Part Number: '{$accessory->part_number}'\n";
    }
}
echo "\n";

// Check recent log entries
echo "7. Recent Vehicle Saving Log:\n";
$logFile = storage_path('logs/vehicle_saving.log');
if (file_exists($logFile)) {
    $logContent = file_get_contents($logFile);
    $logEntries = explode(str_repeat('-', 80), $logContent);
    $recentEntries = array_slice($logEntries, -5); // Get last 5 entries
    
    foreach ($recentEntries as $index => $entry) {
        if (trim($entry)) {
            echo "Log Entry " . ($index + 1) . ":\n";
            $data = json_decode($entry, true);
            if ($data) {
                echo "- Action: " . ($data['action'] ?? 'N/A') . "\n";
                echo "- Timestamp: " . ($data['timestamp'] ?? 'N/A') . "\n";
                echo "- Part Number: " . ($data['part_number'] ?? 'N/A') . "\n";
                if (isset($data['lubricant_name'])) {
                    echo "- Lubricant Name: " . $data['lubricant_name'] . "\n";
                }
                if (isset($data['part_name'])) {
                    echo "- Part Name: " . $data['part_name'] . "\n";
                }
                if (isset($data['accessory_name'])) {
                    echo "- Accessory Name: " . $data['accessory_name'] . "\n";
                }
                if (isset($data['lubricant_data'])) {
                    echo "- Saved Part Number: " . ($data['lubricant_data']['part_number'] ?? 'N/A') . "\n";
                }
                if (isset($data['part_data'])) {
                    echo "- Saved Part Number: " . ($data['part_data']['part_number'] ?? 'N/A') . "\n";
                }
                if (isset($data['accessory_data'])) {
                    echo "- Saved Part Number: " . ($data['accessory_data']['part_number'] ?? 'N/A') . "\n";
                }
                echo "\n";
            }
        }
    }
} else {
    echo "Log file not found!\n";
}

echo "=== Test Complete ===\n"; 