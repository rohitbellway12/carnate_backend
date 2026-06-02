# Vehicle Data Flow and Table Structure

## Overview
This document explains how vehicle data is stored and managed in the lubricant system.

## Database Tables Structure

### 1. Main Vehicle Tables

#### `vehicle_types` table
- **Purpose**: Stores vehicle types (Car, Bike, Truck, etc.)
- **Key Fields**: `id`, `vehicle_type`
- **Model**: `VehicleType`

#### `vehicle_brands` table
- **Purpose**: Stores vehicle brands (Honda, Toyota, etc.)
- **Key Fields**: `id`, `vehicle_type_id`, `vehicle_brand`
- **Model**: `Vehiclebrand`

#### `model_names` table
- **Purpose**: Stores vehicle models
- **Key Fields**: `id`, `brand_id`, `model_name`
- **Model**: `VehicleModel`

#### `vehicles` table
- **Purpose**: Stores actual customer vehicles
- **Key Fields**: `id`, `customer_id`, `vehicletype_id`, `vehiclebrand_id`, `modelname`, `number_plate`, etc.
- **Model**: `Vehicle`

### 2. Spare Parts Related Tables

#### `modifications` table
- **Purpose**: Stores vehicle modifications/variants for spare part compatibility
- **Key Fields**: 
  - `id`, `title`, `brand_id`, `brand_name`, `variant_id`, `variant_name`, `year`, `status`
- **Model**: `Modification`
- **Usage**: Links spare parts to specific vehicle models

#### `spare_parts` table
- **Purpose**: Stores all spare parts (including lubricants)
- **Key Fields**:
  - `id`, `user_id`, `spare_part_type`, `label_id`, `suitable_for`, `forAllVehicles`
  - `spare_part_type = 4` for lubricants
- **Models**: `Lubricant`, `Part`, `Accessory`, `Tools` (all use same table)

#### `spare_part_vehicle_modifications` table (Pivot Table)
- **Purpose**: Many-to-many relationship between spare parts and vehicle modifications
- **Key Fields**: `spare_part_id`, `vehicle_modification_id`
- **Model**: `SparePartVehicleModification`

## Data Flow for Lubricant Vehicle Selection

### 1. User Selection Process
```
User selects vehicles from dropdown → 
Two options:
- API vehicles (from external API)
- Existing modifications (from database)
```

### 2. Data Storage Process

#### For API Vehicles:
1. **Check if vehicle exists** in `modifications` table
2. **If not exists**: Create new record in `modifications` table
3. **Save vehicle names** as comma-separated string in `suitable_for` field
4. **Create relationships** in `spare_part_vehicle_modifications` table

#### For Existing Modifications:
1. **Use existing modification IDs**
2. **Build vehicle names** from modification data
3. **Save as string** in `suitable_for` field
4. **Create relationships** in pivot table

#### For "All Vehicles":
1. **Set `suitable_for`** to "All Vehicles" string
2. **Get all active modifications** from database
3. **Create relationships** for all modifications

### 3. Dual Storage Strategy

#### String Storage (Backward Compatibility)
- **Table**: `spare_parts.suitable_for`
- **Format**: "Honda City 2020, Toyota Camry 2019"
- **Purpose**: Easy display and backward compatibility

#### Relationship Storage (For Queries)
- **Table**: `spare_part_vehicle_modifications`
- **Purpose**: Efficient vehicle-based searches and filtering

## Logging System

### Log File Location
- **Path**: `storage/logs/vehicle_saving.log`
- **Format**: JSON with detailed information

### Logged Information
- Timestamp and action type
- User ID and lubricant details
- Selected vehicles and processing type
- API vehicle data (if applicable)
- Modification creation/usage details
- Pivot table records created

## Testing and Verification

### 1. Check Log File
```php
// In LubricantController
$logContent = $this->checkVehicleLog();
echo $logContent;
```

### 2. Database Queries
```sql
-- Check recent lubricants with vehicle data
SELECT id, name, suitable_for, forAllVehicles 
FROM spare_parts 
WHERE spare_part_type = 4 
ORDER BY created_at DESC 
LIMIT 5;

-- Check vehicle modifications
SELECT * FROM modifications 
WHERE status = 1 
ORDER BY created_at DESC 
LIMIT 10;

-- Check pivot relationships
SELECT spvm.*, m.brand_name, m.variant_name, m.year
FROM spare_part_vehicle_modifications spvm
JOIN modifications m ON spvm.vehicle_modification_id = m.id
ORDER BY spvm.created_at DESC
LIMIT 10;
```

### 3. Test Script
Run `test_vehicle_tables.php` to check all vehicle-related data.

## Troubleshooting

### Common Issues
1. **Vehicle details not saving**: Check log file for errors
2. **API vehicles not appearing**: Verify API response format
3. **Existing modifications not loading**: Check modification status

### Debug Steps
1. Check the log file: `storage/logs/vehicle_saving.log`
2. Verify database tables have data
3. Test with both API and existing vehicles
4. Check pivot table relationships

## Summary

The system now properly saves vehicle details in both:
- **String format** (for display and compatibility)
- **Relationship format** (for efficient queries)

All vehicle saving activities are logged for debugging and verification. 