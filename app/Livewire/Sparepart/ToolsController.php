<?php

namespace App\Livewire\Sparepart;

use App\Models\{Category, Tools, Unit, SparePartLabel, UploadImage, SparePartVehicleModification, Modification, ProductStock, StockHistory};
use App\Services\SparePartCategoryService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;

#[Layout('components.layouts.spare-part-app')]

class ToolsController extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $isEdit = false, $showModal = false;
    public $name, $unit, $stock, $description, $image_id, $imagePreview, $imageId, $uploadedImageId, $uniqueId;
    public $toolsId, $sparepartId, $reflectedPrice, $showToolsModel, $tools_label, $sparePartLabels, $modifications;

    public $forAllVehicles = false;
    public $suitable_for = [];
    public $suitableForData = [];
    public $commission = 0;
    public $price = 0;
    public $amount = 0;
    public $discount = 0;
    public $purchase_amount = 0;
    public $discount_type = 1;
    public $hsn_code, $rack_no;
    public $tax_type, $tax_percentage, $category, $customerPrice = 0, $selling_amount = 0, $searchfilter;
    public $imageName, $imageImage, $image;
    public $units, $categories;
    protected $listeners = ['delete'];

    protected $rules = [
        'name' => 'required',
       'purchase_amount' => 'required|numeric|min:1',
        'selling_amount' => 'required|numeric|min:1',
        'unit' => 'required|integer',
        'stock' => 'required|integer|min:0',
        // 'suitable_for' => 'nullable|string',
        'discount' => 'nullable|numeric|min:0',
        'description' => 'nullable|string',
        // 'image_id' => 'nullable|string',
        'category' => 'required|integer',
    ];

    public function mount()
    {
        $this->sparepartId = Auth::guard('sparepart')->user()->id;
        $this->resetForm();
        $this->commission = getCommission(4);
        $this->sparePartLabels = SparePartLabel::select('id', 'title')->where('spare_part_type', 3)->get();
        $this->modifications = Modification::where('status', 1)->get();
        $this->imageName = '';
        $this->imageImage = '';

        $this->units = Unit::all();
        $this->categories = SparePartCategoryService::getDropdownCategories();
    }


    public function updatedForAllVehicles($value)
    {
        if ($value == true) {
            $this->suitable_for = [];
            $this->forAllVehicles = true;
        } else {
            $this->forAllVehicles = false;
        }
    }

    public function render()
    {
        $tools = Tools::with('unit', 'label')->where('spare_part_type', 3);
        if ($this->searchfilter) {
            $search = trim($this->searchfilter);
            $tools->where(function ($query) use ($search) {
                $query->whereHas('label', function ($query)use ($search) {
                    $query->where('title', 'like', '%' . $search . '%');
                })
                    ->OrwhereHas('unit', function ($query) use ($search){
                        $query->where('title', 'like', '%' . $search . '%');
                    })
                    ->orWhere('hsn_code', 'like', '%' . $search . '%')
                    ->orWhere('rack_no', 'like', '%' . $search . '%');
            });
        }
        $tools = $tools->where('user_id', $this->sparepartId)->orderBy('created_at', 'desc')->paginate(10);

        return view('livewire.sparepart.tools', compact('tools'));
    }

    public function create()
    {
        $this->resetForm();
        $this->isEdit = false;
        $this->showModal = true;
        $this->reset('selling_amount', 'tax_type', 'category', 'forAllVehicles', 'suitable_for');
    }

    public function store()
    {

        $this->validate();

        if (!$this->forAllVehicles && empty($this->suitable_for)) {
            $this->addError('suitable_for', "The Vehicle field is required");
            return;
        }

        $sparePartLabel = SparePartLabel::firstOrCreate(
            ['title' => $this->name],
            ['title' => $this->name, 'spare_part_type' => 3]
        );

        if (!empty($this->image)) {
            $this->image_id = $this->image->id;
        }

        $tool = Tools::create([
            'user_id' => $this->sparepartId,
            'spare_part_type' => 3,
            'label_id' => $sparePartLabel->id,
            'price' => $this->customerPrice,
            'amount' => $this->price,
            'unit_id' => $this->unit,
            // 'suitable_for' => $this->suitable_for ?? '',
            'discount' => $this->discount ?? 0,
            'stock' => $this->stock,
            'description' => $this->description ?? '',
            'image' => $this->image_id,
            'hsn_code' => $this->hsn_code,
            'rack_no' => $this->rack_no,
            'purchase_price' => $this->purchase_amount,
            'tax_type' => $this->tax_type,
            'tax_percentage' => $this->tax_percentage,
            'category_id' => $this->category,
            'selling_amount' => $this->selling_amount,
            'discount_type' => $this->discount_type,
            'platform_charge' => $this->commission,
            'forAllVehicles' => $this->forAllVehicles ? 1 : 0,
        ]);


        $stockProduct = ProductStock::where(['label_id' => $sparePartLabel->id, 'price' => $this->price, 'user_id' => $this->sparepartId])->first();

        if (empty($stockProduct)) {
            $stockProducts = new ProductStock;
            $stockProducts->label_id = $sparePartLabel->id;
            $stockProducts->category_id = 3;
            $stockProducts->stock = $this->stock;
            $stockProducts->price = $this->price;
            $stockProducts->user_id = $this->sparepartId;
            $stockProducts->save();
        } else {
            $stockProduct->stock = $stockProduct->stock + $this->stock;
            $stockProduct->price = $this->price;
            $stockProduct->save();
        }

        $stockHistory = new StockHistory();
        $stockHistory->label_id = $sparePartLabel->id;
        $stockHistory->spare_part_id = $tool->id;
        $stockHistory->category = 3;
        $stockHistory->user_id = $this->sparepartId;
        $stockHistory->last_stock = $this->stock;
        $stockHistory->current_stock = $this->stock;
        $stockHistory->stock_type = 'addition';
        $stockHistory->remarks = "Stock add by spare part vendor.";
        $stockHistory->save();

        if ($this->forAllVehicles) {
            $this->suitableForData = Modification::where('status', 1)->pluck('id')->toArray();
        } else {
            $this->suitableForData = $this->suitable_for;
        }



        // echo "<pre>";print_r($this->suitableForData);die;
        foreach ($this->suitableForData as $sutaiblefor) {

            SparePartVehicleModification::create([
                'spare_part_id' => $tool->id,
                'vehicle_modification_id' => $sutaiblefor
            ]);

        }


        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Tools added successfully!']);
        $this->resetForm();
        $this->showModal = false;
    }

    public function edit($id)
    {
        $this->isEdit = true;
        $tools = Tools::findOrFail($id);

        $this->toolsId = $tools->id;
        $this->name = $tools->name;
        $this->unit = $tools->unit_id;
        $this->selling_amount = $tools->selling_amount;
        $this->suitable_for = $tools->suitable_for;
        $this->discount = $tools->discount;
        $this->stock = $tools->stock;
        $this->description = $tools->description;
        $this->image_id = $tools->image;
        $this->tax_type = $tools->tax_type;
        $this->tax_percentage = $tools->tax_percentage;
        $this->purchase_amount = $tools->purchase_price;
        $this->hsn_code = $tools->hsn_code;
        $this->rack_no = $tools->rack_no;
        $this->category = $tools->category_id;
        SparePartCategoryService::ensureCategoryInDropdown($this->categories, (int) $tools->category_id);
        $this->discount_type = $tools->discount_type;
        $this->customerPrice = $tools->price;
        $image = UploadImage::find($tools->image);
        // echo "<pre>"; print_r($image->toArray()); die;
        $this->image = $image ? $image : null;
        $this->imageImage = $image ? $image->file : null;
        $this->showModal = true;
        $this->reflectedPrice = $tools->amount;
        $this->price = $tools->amount;

        if ($tools->forAllVehicles == 1) {
            $this->forAllVehicles = true;
        } else {
            $sparePartVehicleModification = SparePartVehicleModification::where('spare_part_id', $tools->id)->get();

            $this->suitable_for = $sparePartVehicleModification->pluck('vehicle_modification_id')->toArray();
        }
    }

    public function update()
    {
        $this->validate();

        if (!$this->forAllVehicles && empty($this->suitable_for)) {
            $this->addError('suitable_for', "The Vehicle field is required");
            return;
        }

        $tools = Tools::findOrFail($this->toolsId);

        $sparePartLabel = SparePartLabel::firstOrCreate(
            ['title' => $this->name],
            ['title' => $this->name, 'spare_part_type' => 3]
        );

        SparePartVehicleModification::where('spare_part_id', $tools->id)->delete();

        if ($this->forAllVehicles) {
            foreach ($this->modifications as $sparePartVehicle) {
                SparePartVehicleModification::create([
                    'spare_part_id' => $tools->id,
                    'vehicle_modification_id' => $sparePartVehicle->id
                ]);
            }

        } else {

            foreach ($this->suitable_for as $sparePartVehicle) {
                SparePartVehicleModification::create([
                    'spare_part_id' => $tools->id,
                    'vehicle_modification_id' => $sparePartVehicle
                ]);
            }
        }

        if (!empty($this->image)) {
            $this->image_id = $this->image->id;
        }

        $tools->update([
            'user_id' => $this->sparepartId,
            'spare_part_type' => 3,
            'label_id' => $sparePartLabel->id,
            'price' => $this->customerPrice,
            'amount' => $this->reflectedPrice,
            'unit_id' => $this->unit,
            // 'suitable_for' => $this->suitable_for ?? '',
            'discount' => $this->discount ?? 0,
            'stock' => $this->stock,
            'description' => $this->description ?? '',
            'image' => $this->image_id,
            'hsn_code' => $this->hsn_code,
            'rack_no' => $this->rack_no,
            'tax_type' => $this->tax_type,
            'tax_percentage' => $this->tax_percentage,
            'purchase_price' => $this->purchase_amount,
            'category_id' => $this->category,
            'selling_amount' => $this->selling_amount,
            'discount_type' => $this->discount_type,
            'platform_charge' => $this->commission,
            'forAllVehicles' => $this->forAllVehicles ? 1 : 0,
        ]);

        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Tools updated successfully!']);
        $this->resetForm();
        $this->showModal = false;
    }


    public function confirmDelete($id)
    {
        $this->toolsId = $id;
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
        // echo "<prE>";print_r()
        Tools::destroy($this->toolsId);
        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Tools deleted successfully!']);
    }


    #[On('imageUploaded')]
    public function handleImageUploaded($payload)
    {
        $this->uploadedImageId = $payload['imageId'];
        $this->uniqueId = $payload['uniqueId'];
        $uniq = $payload['uniqueId'];

        $this->$uniq = $this->uploadedImageId;

        if ($this->isEdit) {
            $this->editImage();
        }
    }

    public function editImage()
    {
        $tool = Tools::where('id', $this->toolsId)->first();
        $tool->update([
            'image' => $this->image_id ?? 0,

        ]);
    }



    public function addToolsLabel()
    {
        $this->showToolsModel = true;
    }


    public function toolsLabelStore()
    {

        $valArr = [
            'tools_label' => ["required"],
        ];

        $this->validate($valArr);


        $category = SparePartLabel::create([
            'title' => $this->tools_label,
            'spare_part_type' => 3,
        ]);

        $this->sparePartLabels = SparePartLabel::select('id', 'title')->where('spare_part_type', 3)->get();

        $this->dispatch('swal:toast', ['message' => 'tools Label added successfully!']);
        $this->resetForm();
        $this->tools_label = '';
        $this->showToolsModel = false;
    }


    private function resetForm()
    {
        $this->name = '';
        $this->price = '';
        $this->unit = null;
        $this->suitable_for = '';
        $this->discount = '';
        $this->stock = '';
        $this->purchase_amount = '';
        $this->description = '';
        $this->hsn_code = '';
        $this->rack_no = '';
        $this->image_id = null;
        $this->imagePreview = null;
        $this->image = '';
        $this->imageName = '';
        $this->toolsId = null;
        $this->tax_percentage = 0;
        $this->reflectedPrice = 0;
        $this->customerPrice = 0;
    }
    public function updatedSellingAmount($value)
    {
        // $price = floatval($value) - floatval($this->discount);
        // $this->price = $price;
        // $this->reflectedPrice = $price - (($price * $this->commission) / 100);
        $this->calculatePrice();
    }
    // public function updatedDiscount($value){
    //     $price = floatval($this->amount) - floatval($value);
    //     $this->price = $price;
    //     $this->reflectedPrice = $price - (($price * $this->commission) / 100);
    // }

    public function updatedDiscount($value)
    {
        $this->calculatePrice();
    }

    public function updatedDiscountType($value)
    {
        $this->calculatePrice();
    }

    public function updatedTaxType($value)
    {
        $this->calculatePrice();
    }

    public function updatedTaxPercentage($value)
    {
        $this->calculatePrice();
    }

    private function calculatePrice()
    {
        $price = 0;
        // Ensure all properties are floats
        $sellingAmount = floatval($this->selling_amount);
        $taxPercentage = floatval($this->tax_percentage);
        $discount = floatval($this->discount);
        $commission = floatval($this->commission);

        if ($this->tax_type == 'include' && $taxPercentage) {
            $includedPrice = $sellingAmount / ($taxPercentage / 100 + 1);
            $price = round($includedPrice);
        } elseif ($this->tax_type == 'exclude' && $taxPercentage) {
            $tax = ($sellingAmount * $taxPercentage) / 100;
            $price = $sellingAmount + $tax;
        } else {
            $price = $sellingAmount;
        }

        if ($this->discount_type == 1) {
            $price -= $discount;
        } elseif ($this->discount_type == 2) {
            $discountAmount = ($price * $discount) / 100;
            $price -= $discountAmount;
        }

        $this->reflectedPrice = $this->price = $price;
        $totalCommission = ($price * $commission) / 100;
        $this->customerPrice = $price + $totalCommission;
    }


    public function updateSuitableFor($selectedValues)
    {
        $this->suitable_for = $selectedValues;
    }

    public function updatedImage()
    {
        if (!empty($this->image)) {
            $this->imageName = $this->image->store("uploads", "public_root");
            $uploadid = UploadImage::create([
                "file" => $this->imageName,
            ]);
            $this->image = $uploadid;
        }

        $this->dispatch('swal:toast', ['type' => 'success', 'title' => 'Image uploaded',]);
    }

    public function resetFilter()
    {
        $this->searchfilter = '';
    }

    public function updatedResetfilter()
    {
        $this->resetPage();
    }
    public function updated()
    {
        $this->resetErrorBag();
    }
    public function updatedSearchfilter(){
        $this->resetPage();
    }
}
