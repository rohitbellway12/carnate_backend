<?php

namespace App\Livewire\Sparepart\Inventory;

use App\Models\PurchaseOrderItem;
use App\Models\SparePart;
use Livewire\Component;
use App\Models\SparePartProductStock;
use App\Models\Unit;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Layout;
use App\Models\Modification;
use Illuminate\Support\Facades\Auth;
#[Layout('components.layouts.spare-part-app')]
class StockList extends Component
{
    public $stocks;
    public $editId = null;
    public $editData = [];
    public $stock_id;
    public $searchTerm = '';
    protected $listeners = ['delete'];
    public $editPart=[];
   public $editStock =[];
   public $showEditModal = false;

   // Part Fields
    public $name, $brand, $unit_id, $description, $image_id, $part_number, $sp_type;
    public $imagePreview, $imageId, $uploadedImageId, $uniqueId;

   // Stock Fields
    public $stock_quantity, $stock_rack_no, $stock_selling_price;
    public $units, $categories,$category ;
    public $part_suitable_for = [];
    // public $part_modifications = [];

    public $allModifications = [];

    public $selectAll = false;

    public $part_modifications;

    public $stock_unit_price = 0;


    public function mount()
    {
        $this->loadStocks();
        $this->units = Unit::all();

         $response = Http::withHeaders([
            'x-rapidapi-host' => 'auto-parts-catalog.p.rapidapi.com',
            'X-RapidAPI-Key' => config('services.rapidapi.key'),
        ])->get('https://auto-parts-catalog.p.rapidapi.com/category/category-products-groups-variant-2/19942/manufacturer-id/184/lang-id/4/country-filter-id/62/type-id/1');

        if ($response->successful()) {
            $data = $response->json();
            // Flatten the top-level categories
            if (isset($data['categories']) && is_array($data['categories'])) {
                $this->categories = array_map(function($cat) {
                    return [
                        'categoryId' => $cat['categoryId'],
                        'categoryName' => $cat['categoryName']
                    ];
                }, array_values($data['categories']));
            } else {
                $this->categories = [];
            }
        } else {
            $this->categories = [];
        }




    }

    public function loadStocks()
    {

        $query = SparePartProductStock::query()
            ->where('user_id', Auth::guard('sparepart')->user()->id);

        if ($this->searchTerm) {
            $query->where(function($q) {
                $q->where('partname', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('part_no', 'like', '%' . $this->searchTerm . '%');
            });
        }
        $this->stocks = $query->with('unit')->orderByDesc('id')->get();







    }

    public function updatedSearchTerm()
    {
        $this->loadStocks();
    }
    public function resetFilters()
    {
        $this->searchTerm = '';
        $this->loadStocks();
    }

// public function editFullDetails($stockId)
// {
//     $stock = SparePartProductStock::findOrFail($stockId);

//     // Find matching purchase order item for this stock
//     $purchaseOrderItem = PurchaseOrderItem::where('purchase_order_id', $stock->purchase_order_id)->first();

//     if (!$purchaseOrderItem || !$purchaseOrderItem->part) {
//         session()->flash('error', 'Part not found for this stock.');
//         return;
//     }

//     $this->editId = $stockId;
//     $this->editPart = $purchaseOrderItem->part->toArray();
//     $this->editStock = $stock->toArray();
//     $this->showEditModal = true;
// }


public function editFullDetails($stockId)
{
    $stock = SparePartProductStock::findOrFail($stockId);

    $purchaseOrderItem = PurchaseOrderItem::where('purchase_order_id', $stock->purchase_order_id)
    ->where('part_number', $stock->part_no)
    ->first();

    if (!$purchaseOrderItem || !$purchaseOrderItem->part) {
        session()->flash('error', 'Part not found for this stock.');
        return;
    }


    $part = $purchaseOrderItem->part;




    // Set Part fields
    $this->name = $part->name;
    $this->brand = $part->brand;
    // $this->unit = $part->unit;
    $this->unit_id = $part->unit_id;
    $this->category = $part->category_id;
    $this->description = $part->description;
    // $this->image_id = $part->image_id;
    $this->part_number = $part->part_number;
    // $this->sp_type = $part->sp_type;
    // $this->imagePreview = $part->image_id;
    // $this->imageId = $part->image_id;
    // $this->uploadedImageId = $part->image_id;
    $this->uniqueId = $part->id;

    // Set Stock fields
    $this->stock_quantity = $stock->quantity;
    $this->stock_rack_no = $stock->rack_no;
    $this->stock_selling_price = $stock->total_payable;


     if ($stock->quantity > 0) {
    $this->stock_unit_price = $stock->total_payable / $stock->quantity;
}


    $this->editId = $stockId;
    $this->showEditModal = true;


    //  $this->part_suitable_for = $part->suitable_for
    // ? explode(',', $part->suitable_for)
    // : [];

    $this->part_suitable_for = $part->suitable_for
    ? array_map('trim', explode(',', $part->suitable_for))
    : [];


    $this->part_modifications = Modification::where('status', 1)->get();





}

public function updatedStockQuantity($value)
{
    $this->stock_selling_price = $value * $this->stock_unit_price;
}

//  public function updatedSelectAll($value)
// {
//     if ($value) {
//         // Select all vehicles
//         $this->part_suitable_for = $this->part_modifications->map(function($mod) {
//             return trim($mod->brand_name . ' ' . $mod->variant_name . ' ' . $mod->year);
//         })->toArray();
//     } else {
//         // Unselect all
//         $this->part_suitable_for = [];
//     }
// }


public function updateFullDetails()
{
    $stock = SparePartProductStock::findOrFail($this->editId);

    $purchaseOrderItem = PurchaseOrderItem::where('purchase_order_id', $stock->purchase_order_id)
    ->where('part_number', $stock->part_no)
    ->first();

    if ($purchaseOrderItem && $purchaseOrderItem->part) {
        $part = $purchaseOrderItem->part;

        $part->update([
            // 'name' => $this->name,
            'brand' => $this->brand,
            'unit_id' => $this->unit_id,
            'description' => $this->description,
            'image_id' => $this->image_id,
            'part_number' => $this->part_number,
            'sp_type' => $this->sp_type,
            'rack_no' => $this->stock_rack_no,
            'category_id' => $this->category,
            'suitable_for' => implode(',', $this->part_suitable_for),
            // 'price' => $this->stock_selling_price,
            'stock' => $part->stock - $stock->quantity + $this->stock_quantity,

        ]);
    }

    $stock->update([
        'company_name' => $this->brand,
        'unit_id' => $this->unit_id,
        'part_number' => $this->part_number,
        'quantity' => $this->stock_quantity,
        'rack_no' => $this->stock_rack_no,
        'total_payable' => $this->stock_selling_price,
        'category' => $this->category,
        'user_id' => Auth::guard('sparepart')->user()->id, // <-- Use sparepart guard
    ]);

    $this->showEditModal = false;
    session()->flash('success', 'Part and stock updated successfully.');
    $this->loadStocks();
}

    public function confirmDelete($id)
    {
        $this->stock_id = $id;
        $this->dispatch('swal:confirm', [
            'title' => 'Are you sure?',
            'text' => 'This action cannot be undone.',
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonText' => 'Yes, delete it!',
            'cancelButtonText' => 'Cancel',
            'action' => 'delete',
        ]);
    }

    public function delete()
    {
        $stock = SparePartProductStock::findOrFail($this->stock_id);
        $stock->delete();
        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Stock deleted successfully!'
        ]);
        $this->loadStocks();
    }

    public function render()
    {
        return view('livewire.sparepart.inventory.stock-list');
    }
}
