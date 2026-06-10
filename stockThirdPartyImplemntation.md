# Reusable Vehicle Selector Component & Stock Compatibility Integration

We will create a standalone, reusable Livewire component called `VehicleSelector` to fetch and select vehicles using the RapidAPI catalog. When a vehicle modification is selected, it will be saved locally in the `modifications` table and dispatched as an event to any parent component (e.g., `ProductStockController` or later, sparepart vendor components) to link compatibility.

## User Review Required

> [!NOTE]
> We will keep the existing manual stock compatibility logic untouched, but extend it.
> 1. If "For All Vehicles" is checked, the component operates just like before.
> 2. If unchecked, the user can select vehicles from the catalog using the 4 dynamic dropdowns.
> 3. Each selected vehicle will be added to the compatibility list locally and synced on submit.

## Proposed Changes

---

### Reusable Vehicle Selector Component

#### [NEW] [VehicleSelector.php](file:///c:/Users/LENOVO/Downloads/carnate_live/car/app/Livewire/Workshop/VehicleSelector.php)
Create a new Livewire component `VehicleSelector` that handles:
- Fetching manufacturers, models, years, and modifications from `RapidApiVehicleService`.
- Finding or creating local entries in `MakerType`, `Maker`, and `Modification` when adding a vehicle.
- Emitting the `vehicleAdded` event with the local modification ID.

#### [NEW] [vehicle-selector.blade.php](file:///c:/Users/LENOVO/Downloads/carnate_live/car/resources/views/livewire/workshop/vehicle-selector.blade.php)
Create the corresponding Blade template for the 4-dropdown selector.
- Dropdown 1: Brand (Manufacturer)
- Dropdown 2: Model (Variant)
- Dropdown 3: Construction Year
- Dropdown 4: Modification/Type (Fuel & Engine codes)
- Button: "Add Vehicle" to register the vehicle modification and dispatch it to the parent component.

---

### Integration in Add Stock Flow

#### [MODIFY] [ProductStockController.php](file:///c:/Users/LENOVO/Downloads/carnate_live/car/app/Livewire/Workshop/ProductStockController.php)
- Import `Livewire\Attributes\On`.
- Add listener for `vehicleAdded` event to append the newly added/registered modification ID to the `$suitable_for` array.
- Add `removeCompatibleVehicle($index)` to allow removing a selected vehicle from the list.

#### [MODIFY] [index.blade.php](file:///c:/Users/LENOVO/Downloads/carnate_live/car/resources/views/livewire/workshop/purchasestock/index.blade.php)
- Replace the static select element for `suitable_for` with:
  1. The new reusable component: `@livewire('workshop.vehicle-selector')`.
  2. A badge list that displays the currently selected modifications from the `$suitable_for` array, allowing users to remove any modification with a click of a close button.

---

## Verification Plan

### Manual Verification
1. Open http://127.0.0.1:8000/workshop/stocks.
2. Click on "Add New Stock".
3. Verify that when "For All Vehicles" is unchecked, the 4-dropdown dynamic catalog selector appears.
4. Try selecting a brand, model, year, and modification from the catalog.
5. Click "Add to List". Verify it shows up in the "Selected Compatible Vehicles" list.
6. Verify you can remove it by clicking the cross icon.
7. Save the stock and verify in the database or UI that compatibility is preserved.
8. Edit the stock and verify that the previously selected compatibility loads correctly.
