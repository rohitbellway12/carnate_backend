<?php

namespace App\Livewire\Workshop;

use App\Models\{Accessory, Category, OrderItem, Stock, SparePartLabel, Unit, WorkShopVendor, Modification, SparePartVehicleModification, WorkshopSupplier};
use App\Models\ProductStock;
use App\Models\Staff;
use Illuminate\Support\Facades\{Auth, DB};
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.workshop-app')]
class ProductStockController extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $isAdd = false, $showModal;
    public $user_id, $order_items, $showAdd, $sparePartLabels = [];
    public $name, $user, $category_id, $price, $stock;
    public $showSpariOartesModal = false, $isEdit = false;
    public $units = [], $categories = [];
    public $brand, $purchase_amount, $amount, $unit, $tax_type, $hsn_code, $category, $tax_percentage, $stockId, $name_title , $sp_type;
    public $search, $search_category, $part_number;
    public $editingPriceId = null, $newPrice;
     public $forAllVehicles = false, $modifications = [],$suitable_for = [];
    public $suppliers;
    public $supplier_id;
    public $is_self_stock = true;
    public $activeTab = 'manual';

    protected $listeners = ['delete'];
   
    public function mount()
    {
        $this->user_id = Auth::guard('workshop')->user()->id;
        $this->user = WorkShopVendor::where('id', $this->user_id)->first();
        $this->suppliers = WorkshopSupplier::orderBy('id', 'desc')
        ->where('user_id', Auth::guard('workshop')->id())
        ->get();
       
        // dd( $this->suppliers);
    }
    public function render()
    {
      
        $user = WorkShopVendor::find($this->user_id);
        $this->sparePartLabels = SparePartLabel::select('id', 'title')->get();
        $items = ProductStock::with('label')->where('user_id', $user->is_user == 0 ? $this->user_id : $user->parent_id);
        if (!empty($this->search)) {
            $items = $items->whereHas('label', function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                    ->Orwhere('brand', 'like', '%' . $this->search . '%');
            });
        }
        if ($this->activeTab == 'manual') {
            $items = $items->where('self_stock', 1);
        } else {
            $items = $items->where(function($query) {
                $query->where('self_stock', 0)->orWhereNull('self_stock');
            });
        }

        if ($this->search_category) {
            $items = $items->where('category_id', $this->search_category);
        }
        $items = $items->orderBy('id', 'DESC')->paginate(10);
        //dd($items);
       
        return view('livewire.workshop.purchasestock.index', compact('items'));
    }
   
    public function create()
    {
          $this->resetErrorBag();
        $this->isAdd = false;
        $this->showModal = true;
        $this->units = Unit::all();
        $this->categories = Category::all();
        $this->modifications = Modification::where('status', 1)->get();

    }

    public function modalClose()
    {
        $this->reset(['name', 'category_id','supplier_id', 'price', 'stock', 'amount', 'stock', 'brand','part_number', 'purchase_amount', 'tax_type', 'sp_type','tax_percentage', 'unit', 'hsn_code', 'category','suitable_for','forAllVehicles']);
        $this->isAdd = true;
        $this->showModal = false;
    }

    public function edit($id)
    {
  $this->resetErrorBag();
        $this->isAdd = true;
        $this->showModal = true;
        $this->units = Unit::all();
        $this->categories = Category::all();
        $this->stockId = $id;
        $productStock = ProductStock::find($id);
        $this->name = $productStock->label_id;
        $this->user_id = $productStock->user_id;
        $this->category_id = $productStock->category_id;
        $this->supplier_id = $productStock->supplier_id;
        $this->category = $productStock->categories_id;
        $this->amount = $productStock->price;
        $this->stock = $productStock->stock;
        $this->brand = $productStock->brand;
        $this->purchase_amount = $productStock->buy_price;
        $this->amount = $productStock->price;
        $this->sp_type = $productStock->sp_type;
        $this->tax_type = $productStock->tax_type;
        $this->tax_percentage = $productStock->tax_percentage;
        $this->unit = $productStock->unit_id;
        $this->hsn_code = $productStock->hsn_code;
        $this->part_number = $productStock->part_number;
        $this->forAllVehicles = $productStock->forAllVehicles ? true : false;
        $this->is_self_stock = $productStock->self_stock == 1;
       
    // 👇 Pre-fill suitable_for for Select2 multi select
    $this->suitable_for = SparePartVehicleModification::where('spare_part_id', $productStock->id)
        ->pluck('vehicle_modification_id')
        ->toArray();
       

    }


    public function store()
    {

        $valArr = [
            'name' => ["required"],
            'category_id' => ["required"],
            'purchase_amount' => ["required", "min:1"],
            'amount' => ["required", "min:1"],
            'stock' => ["required", "min:1"],
            'brand' => ["required"],
            'tax_type' => ["required"],
            'unit' => ["required"],
            'hsn_code' => ["nullable"],
            'category' => ["required"],
            'part_number' => "nullable",
            'supplier_id'=>["required"],
        ];
        $this->validate($valArr);
        //dd( $this->validate($valArr));
        $productStock = ProductStock::where([
            'user_id' => $this->user_id,
            'label_id' => $this->name,
            'price' => $this->amount,
            'category_id' => $this->category_id,
            'brand' => $this->brand,
            'unit_id' => $this->unit,
            'supplier_id'=>$this->supplier_id,
        ])->first();

        if ($productStock) {
            $productStock->stock += $this->stock;
            $productStock->save();
        } else {
            $productStock = new ProductStock;
            $productStock->user_id = $this->user_id;
            $productStock->label_id = $this->name;
            $productStock->category_id = $this->category_id;
            $productStock->categories_id = $this->category;
            $productStock->price = $this->amount;
            $productStock->stock = $this->stock;
            $productStock->brand = $this->brand;
            $productStock->buy_price = $this->purchase_amount;
            $productStock->price = $this->amount;
            $productStock->sp_type =  $this->sp_type ;
            $productStock->tax_type = $this->tax_type;
            $productStock->tax_percentage = $this->tax_percentage;
            $productStock->unit_id = $this->unit;
            $productStock->hsn_code = $this->hsn_code;
            $productStock->forAllVehicles = $this->forAllVehicles ? 1 : 0;
            $productStock->self_stock = 1;
            $productStock->part_number = $this->part_number;
            $productStock->supplier_id = $this->supplier_id;
            $productStock->save();
        }

 if ($this->forAllVehicles) {
            $suitableForData = Modification::where('status', 1)->pluck('id')->toArray();
        } else {
            $suitableForData = $this->suitable_for;
        }

        foreach ($suitableForData as $sutaiblefor) {
            SparePartVehicleModification::create([
                'spare_part_id' => $productStock->id,
                'vehicle_modification_id' => $sutaiblefor
            ]);
        }
        $this->dispatch('swal:toast', [
            'type' => 'success',
            'title' => "Stock Updated Successfully",
        ]);
        $this->reset(['name', 'category_id','supplier_id', 'price', 'stock', 'amount', 'stock', 'brand', 'purchase_amount', 'tax_type','sp_type', 'tax_percentage', 'unit', 'hsn_code', 'category', 'part_number','suitable_for']);
          $this->resetErrorBag();
        $this->showModal = false;

    }

    public function getFinalPriceProperty()
    {
        $amount = (float)($this->amount ?? 0);
        $taxPercentage = (float)($this->tax_percentage ?? 0);
        
        if ($this->tax_type == 'exclude') {
            return $amount + ($amount * $taxPercentage / 100);
        }
        
        return $amount;
    }

    public function update()
    {

        $valArr = [
            'name' => ["required"],
            'category_id' => ["required"],
            'purchase_amount' => ["required", "min:1"],
            'amount' => ["required", "min:1"],
            'stock' => ["required", "min:1"],
            'part_number' => "nullable",
        ];
        $this->validate($valArr);

        $productStock = ProductStock::find($this->stockId);

        $productStock->label_id = $this->name;
        $productStock->category_id = $this->category_id;
        $productStock->categories_id = $this->category;
        $productStock->price = $this->amount;
        $productStock->stock = $this->stock;
        $productStock->brand = $this->brand;
        $productStock->buy_price = $this->purchase_amount;
        $productStock->price = $this->amount;
         $productStock->sp_type=  $this->sp_type ;
        $productStock->tax_type = $this->tax_type;
        $productStock->tax_percentage = $this->tax_percentage;
        $productStock->unit_id = $this->unit;
        $productStock->hsn_code = $this->hsn_code;
        $productStock->part_number = $this->part_number;
           $productStock->forAllVehicles = $this->forAllVehicles ? 1 : 0;
           $productStock->supplier_id = $this->supplier_id;
    $productStock->save();

    // ✅ Clear old vehicle modification associations
    SparePartVehicleModification::where('spare_part_id', $productStock->id)->delete();

    // ✅ Insert updated suitable_for relationships
    if ($this->forAllVehicles) {
        $suitableForData = Modification::where('status', 1)->pluck('id')->toArray();
    } else {
        $suitableForData = $this->suitable_for ?? [];
    }

    foreach ($suitableForData as $modificationId) {
        SparePartVehicleModification::create([
            'spare_part_id' => $productStock->id,
            'vehicle_modification_id' => $modificationId,
        ]);
    }

        $this->reset(['name', 'category_id','supplier_id', 'price', 'stock', 'amount', 'stock', 'brand', 'purchase_amount', 'tax_type', 'sp_type','tax_percentage', 'unit', 'hsn_code', 'category', 'part_number','suitable_for']);
        $this->showModal = false;
        $this->isAdd = false;

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'title' => "Stock Updated Successfully",
        ]);
    }

    public function setdata()
    {
        $this->name;
        SparePartLabel::select('id', 'title')->get();
    }

    public function addSparets()
    {
        if (empty($this->category_id)) {
            return $this->dispatch('swal:toast', [
                'type' => 'error',
                'title' => "Please Select Category ",
            ]);
        }
        $this->showModal = false;
        $this->showSpariOartesModal = true;

    }

    public function closeSpariOartesModal()
    {
            $this->reset(['name']);
        $this->showModal = true;
        $this->showSpariOartesModal = false;
    
    }

    public function storeSpareParts()
    {

        $valArr = [
            'name' => ["required"],
        ];

        $this->validate($valArr);

        $sparePartLabel = SparePartLabel::firstOrCreate(
            ['title' => $this->name],
            ['title' => $this->name, 'spare_part_type' => $this->category_id]
        );


        $this->reset(['name']);
        $this->showModal = true;
        $this->showSpariOartesModal = false;
        return $this->dispatch('swal:toast', [
            'type' => 'success',
            'title' => "Data Add Successfully",
        ]);

    }

    public function resetFilter()
    {
        $this->reset('search_category', 'search');
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function updatedSearchCategory()
    {
        $this->resetPage();
    }
    
    public function setTab($tab)
    {
        $this->activeTab = $tab;
        $this->resetPage();
    }
    
    
    
    public function confirmDelete($id)
    {
        $this->customerId = $id;
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
     public function confirmDeleteStock($id)
    {
        $this->stockId = $id;
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
        $product = ProductStock::findOrFail($this->stockId);
        $product->delete();

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Product stock deleted successfully!'
        ]);
    }

    public function editPrice($id, $currentPrice)
    {
        $this->editingPriceId = $id;
        $this->newPrice = $currentPrice;
    }

    public function updatePrice($id)
    {
        $this->validate([
            'newPrice' => 'required|numeric|min:0'
        ]);

        $productStock = ProductStock::find($id);
        if ($productStock) {
            $productStock->price = $this->newPrice;
            $productStock->save();
        }

        $this->editingPriceId = null;
        $this->dispatch('swal:toast', [
            'type' => 'success',
            'title' => "Price Updated Successfully",
        ]);
    }

    public function cancelEdit()
    {
        $this->editingPriceId = null;
    }

}
