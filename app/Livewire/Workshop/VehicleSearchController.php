<?php

namespace App\Livewire\Workshop;

use App\Models\{MakerType, Maker, Mmodel, ModelYear, Modification, Order, OrderItem, SparePart, SparePartVehicleModification, VehicleSearch};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

use function Laravel\Prompts\search;

#[Layout('components.layouts.workshop-app')]
class VehicleSearchController extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $perPage = 20;
    public $counterCard = 0;
    // manish
    public $brand_name, $variant_name, $selected_year;

    // public $isEdit, $showModal;
    public $title, $maker_type_id, $maker_id, $model_id, $model_year_id, $modification_id, $status;
    // public $modification_id = false;
    public $brands = [], $variants = [], $models = [], $modelsyears = [], $modifications = [], $sparePartArray = [];
    public $search, $status_filter, $user_id;
    public $cartOrderId = 0, $years = [];
    public $apiPartNumber, $apiResults = [];
    protected $listeners = ['delete'];

    // public function mount()
    // {
    //     // $this->brands = MakerType::orderBy('id', 'DESC')->pluck('title', 'id');
    //     $this->brands = Modification::orderBy('id', 'DESC')->pluck('brand_name', 'id');
    //     $this->user_id = Auth::guard('workshop')->user()->id;

    //     $order = Order::where('is_confim', 0)->where('workshop_id', $this->user_id)->first();

    //     if ($order) {
    //         $this->counterCard = count($order->orderItem);
    //         $this->cartOrderId = $order->id;
    //     }

    //     // $startYear = 1990;
    //     // $currentYear = date('Y');
    //     // $this->years = range($currentYear, $startYear);
    //     $this->years=Modification::orderBy('id','DESC')->pluck('year','id');

    // }

    // manish
    // public function mount()
    //     {
    //         $this->brands = Modification::distinct()->pluck('brand_name')->filter()->values();
    //         $this->variants = Modification::distinct()->pluck('variant_name')->filter()->values();
    //         $this->years = Modification::distinct()->pluck('year')->filter()->values();

    //              $this->user_id = Auth::guard('workshop')->user()->id;

    //             $order = Order::where('is_confim', 0)->where('workshop_id', $this->user_id)->first();

    //             if ($order) {
    //                 $this->counterCard = count($order->orderItem);
    //                 $this->cartOrderId = $order->id;
    //             }
    //     }

    public function mount()
    {
        $this->brands = Modification::distinct()->pluck('brand_name')->filter()->values();
        $this->variants = [];
        $this->years = [];

        $this->user_id = Auth::guard('workshop')->user()->id;
        // Find the latest unconfirmed order that has items, or just the latest if all are empty
        $order = Order::where('is_confim', 0)
            ->where('workshop_id', $this->user_id)
            ->whereHas('orderItem')
            ->latest()
            ->first();

        if (!$order) {
            $order = Order::where('is_confim', 0)
                ->where('workshop_id', $this->user_id)
                ->latest()
                ->first();
        }

        if ($order) {
            $this->counterCard = count($order->orderItem);
            $this->cartOrderId = $order->id;
        }
    }


    public function render()
    {
        $spareParts = SparePart::query()
            ->with('label')
            ->whereHas('vendor', function ($q) {
                $q->where('online_stock_status', 1);
            });

        if (isset($this->search) && !empty($this->search)) {
            $search = trim($this->search);
            $spareParts->where(function ($q) use ($search) {
                $q->whereHas('Label', function ($q) use ($search) {
                    $q->where('title', 'like', '%' . $search . '%');
                })->orWhere('part_number', 'like', '%' . $search . '%');
            });
        }

        // if (isset($this->maker_type_id) || isset($this->maker_id) || isset($this->model_year_id) || isset($this->modification_id)) {
        //     $spareParts->whereHas('modifications.modification', function ($q) {
        //         if (isset($this->maker_type_id)) {
        //             $q->where('brand_id', $this->maker_type_id);
        //         }
        //         if (isset($this->maker_id)) {
        //             $q->where('variant_id', $this->maker_id);
        //         }
        //         if (isset($this->model_year_id)) {
        //             $q->where('year', $this->model_year_id);
        //         }
        //         if (isset($this->modification_id)) {
        //             $q->where('id', $this->modification_id);
        //         }
        //     });
        // }


        // manish
        if ($this->brand_name || $this->variant_name || $this->selected_year || $this->modification_id) {
            $spareParts->whereHas('modifications.modification', function ($q) {
                if (!empty($this->brand_name)) {
                    $q->where('brand_name', $this->brand_name);
                }
                if (!empty($this->variant_name)) {
                    $q->where('variant_name', $this->variant_name);
                }
                if (!empty($this->selected_year)) {
                    $q->where('year', $this->selected_year);
                }
                if (!empty($this->modification_id)) {
                    $q->where('id', $this->modification_id);
                }
            });
        }


        $spareParts = $spareParts->latest()
            ->paginate($this->perPage);
        //dd($spareParts);
        return view('livewire.workshop.vehicle_search', [
            'spareParts' => $spareParts,
            'hasMore' => $spareParts->hasMorePages(),
            'apiResults' => $this->apiResults,
        ]);
    }
    public function loadMore()
    {
        $this->perPage += 20;
    }

    public function updatedMakerTypeId($value)
    {
        if ($this->maker_type_id) {
            $this->variants = Maker::where('maker_type_id', $this->maker_type_id)->pluck('title', 'id');
        } else {
            $this->variants = [];
        }
        $this->reset('maker_id', 'model_year_id', 'modification_id', 'modifications');
    }
    public function updatedMakerId($value)
    {
        $this->reset('model_year_id', 'modification_id', 'modifications');
    }

    public function updatedModelYearId($value)
    {
        if ($this->model_year_id) {
            $modifications = Modification::query();
            if (isset($this->maker_type_id)) {
                $modifications->where('brand_id', $this->maker_type_id);
            }
            if (isset($this->maker_id)) {
                $modifications->where('variant_id', $this->maker_id);
            }
            if (isset($this->model_year_id)) {
                $modifications->where('year', $this->model_year_id);
            }
            $this->modifications = $modifications->pluck('title', 'id');
        } else {
            $this->modifications = [];
        }

        $this->reset('modification_id');
    }
    // public function resetFilter()
    // {
    //     $this->reset(['search', 'maker_type_id', 'maker_id','model_year_id', 'modification_id']);
    // }
    public function resetFilter()
    {
        // $this->reset(['search','brand_name','variant_name','selected_year','maker_type_id','maker_id',
        //     'model_year_id',
        //     'modification_id',
        //     'sparePartArray'
        // ]);

        // Optional: Also reset related dropdowns data if needed
        // $this->variants = [];
        // $this->modifications = [];

        $this->reset([
            'search',
            'brand_name',
            'variant_name',
            'selected_year',
            'maker_type_id',
            'maker_id',
            'model_year_id',
            'modification_id',
            'sparePartArray'
        ]);
        $this->variants = [];
        $this->years = [];
        $this->modifications = [];

    }

    public function searchVehicle()
    {
        $modification = SparePartVehicleModification::where('vehicle_modification_id', $this->modification_id)->get();

        foreach ($modification as $modificationData) {
            $this->sparePartArray[] = $modificationData->spare_part_id;
        }
        // $this->spareParts = SparePart::whereIn('id', $this->sparePartArray)->get();
    }

    public function updatedBrandName($value)
    {
        // Brand select hote hi, us brand ke variants laao
        $this->variant_name = '';
        $this->selected_year = '';
        $this->modification_id = '';
        $this->variants = Modification::where('brand_name', $value)
            ->distinct()
            ->pluck('variant_name')
            ->filter()
            ->values();
        $this->years = [];
        $this->modifications = [];
    }

    public function updatedVariantName($value)
    {
        // Variant select hote hi, us brand aur variant ke years laao
        $this->selected_year = '';
        $this->modification_id = '';
        $this->years = Modification::where('brand_name', $this->brand_name)
            ->where('variant_name', $value)
            ->distinct()
            ->pluck('year')
            ->filter()
            ->values();
        $this->modifications = [];
    }

    public function updatedSelectedYear($value)
    {
        // Year select hote hi, us brand, variant aur year ke modifications laao
        $this->modification_id = '';
        $mods = Modification::where('brand_name', $this->brand_name)
            ->where('variant_name', $this->variant_name)
            ->where('year', $value)
            ->get(['id', 'title', 'year', 'fuel_type', 'engine_name']);

        $this->modifications = $mods->mapWithKeys(function ($mod) {
            $enginePart = trim(($mod->engine_name ?? '') . ' ' . ($mod->fuel_type ?? ''));
            $displayText = $enginePart ?: ($mod->title . ' (' . $mod->year . ')');
            return [$mod->id => $displayText];
        });
    }

    public function searchPartViaApi()
    {
        if (empty($this->apiPartNumber)) {
            $this->apiResults = [];
            return;
        }

        $value = $this->apiPartNumber;
        $cleanValue = preg_replace('/[^A-Za-z0-9]/', '', $value);
        $foundResults = [];

        try {
            // Try Search-for-cross-numbers (most reliable for aftermarket)
            $response = \Illuminate\Support\Facades\Http::timeout(15)->withHeaders([
                'x-rapidapi-host' => 'auto-parts-catalog.p.rapidapi.com',
                'X-RapidAPI-Key' => config('services.rapidapi.key'),
            ])->get('https://auto-parts-catalog.p.rapidapi.com/artlookup/search-for-cross-numbers/lang-id/4/article-type/ArticleNumber/article-no/' . $cleanValue);

            if ($response->successful() && !empty($response['articles'])) {
                foreach ($response['articles'] as $article) {
                    $foundResults[] = [
                        'id' => $article['articleId'],
                        'name' => $article['articleProductName'] ?? 'Unknown Part',
                        'brand' => $article['supplierName'] ?? 'Unknown Brand',
                        'image' => $article['s3image'] ?? null,
                        'part_number' => $article['articleNo'] ?? $value,
                        'is_api' => true
                    ];
                }
            }

            $this->apiResults = $foundResults;
            if (empty($foundResults)) {
                $this->dispatch('swal:toast', ['type' => 'error', 'message' => 'No parts found in Live API.']);
            } else {
                $this->dispatch('swal:toast', ['type' => 'success', 'message' => count($foundResults) . ' parts found in Live API!']);
            }
        } catch (\Exception $e) {
            \Log::error('API Search Error: ' . $e->getMessage());
            $this->apiResults = [];
            $this->dispatch('swal:toast', ['type' => 'error', 'message' => 'Connection to Live API timed out or failed. Please check server network.']);
        }
    }

    public function loadApiPartDetails($articleId)
    {
        $found = collect($this->apiResults)->firstWhere('id', $articleId);
        if ($found) {
            return redirect()->route('workshop.api_part_details', $found['part_number']);
        }
    }

    public function closeApiModal()
    {
        $this->showApiModal = false;
        $this->apiPartDetails = null;
    }
}
