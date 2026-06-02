<?php

namespace App\Livewire\Workshop;

use App\Models\{Order,SparePart,OrderItem};
use Illuminate\Support\Facades\{Auth, DB};
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.workshop-app')]  
class PurchaseOrderAddController extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $isEdit = false, $showModal = false, $isAdd = false,$canAddRow = false;
    public $user_id,$totalPrice,$qty,$items=[];
    public $rows = [];
    public $totalAmount = 0;
   
    

    protected $listeners = ['delete'];

    

    public function mount()
    {
        $this->user_id = Auth::guard('workshop')->user()->id;
        // $this->addRow();
        $this->rows[] = [
            'category' => '',
            'item' => '',
            'quantity' => '',
            'price' => 0,
            'total_price' => 0,
        ];
    }

    public function render()
    {      
        return view('livewire.workshop.purchaseorder.add');
    }

    public function addRow()
    {
        if(empty($this->canAddRow)){
            $this->dispatch('swal:toast', [
                'type' => 'error',
                'title' => "Item cannot be null.",
            ]);
        }else{
        $this->rows[] = [
            'category' => '',
            'item' => '',
            'quantity' => '',
            'price' => 0,
            'total_price' => 0,
        ];
        $this->canAddRow = false;
    }
    }

    public function removeRow($index)
    {
        unset($this->rows[$index]);
        $this->rows = array_values($this->rows); // Reindex the array
        $this->calculateTotal();
        $this->canAddRow = true;
    }
    public function getItem($index)
    {
        $category = $this->rows[$index]['category'];

        $items = SparePart::where('spare_part_type', $category)
            ->where('stock', '>', 0)
            ->whereNotIn('id', array_column($this->rows, 'item'))
            ->whereHas('vendor', function ($q) {
                $q->where('online_stock_status', 1);
            })
            ->get();
        $this->items[$index] = $items;
        if ($items->count() > 0) {
            $firstItem = $items->first();
            $this->rows[$index]['item'] = $firstItem->id;
            $this->rows[$index]['quantity'] = 1;
            $this->rows[$index]['max_quantity'] = $firstItem->stock;
            $this->rows[$index]['price'] = $firstItem->price;
            $this->rows[$index]['total_price'] = $firstItem->price * 1;
        }
     $this->canAddRow=true;
        $this->recalculateTotalPrice();
        $this->dispatch('livewire:init');
    }

    public function getAmount($index)
    {
        $itemId = $this->rows[$index]['item'];
        $item = SparePart::find($itemId);
    
        if ($item) {
            $this->rows[$index]['price'] = $item->price;
            $this->rows[$index]['max_quantity'] = $item->stock;
           
            $this->updateTotalPrice($index);
        }
        $this->dispatch('livewire:init');
    }
    
    public function updateTotalPrice($index)
    {
        $quantity = (int) ($this->rows[$index]['quantity'] ?? 0); // Cast to integer
        $price = (float) ($this->rows[$index]['price'] ?? 0);     // Cast to float
    
        // Update the total price for the row
        $this->rows[$index]['total_price'] = $quantity * $price;
        $this->recalculateTotalPrice();
        $this->dispatch('livewire:init');
    }
    
    public function recalculateTotalPrice()
    {
        $this->totalPrice = array_sum(array_column($this->rows, 'total_price'));
    }
    

    public function updated($propertyName)
    {
        // Trigger getItem() when category is updated
        if (str_contains($propertyName, 'rows.') && str_contains($propertyName, '.category')) {
            preg_match('/rows\.(\d+)\.category/', $propertyName, $matches);
            if (isset($matches[1])) {
                $this->getItem($matches[1]);
            }
        }
    }

    public function updatedRows()
    {
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->totalAmount = array_sum(array_column($this->rows, 'total_price'));
    }
    public function getCanSubmitProperty(): bool
{
    return !collect($this->rows)->contains(fn($row) => empty($row['quantity']) || $row['quantity'] == 0);
}

    public function store()
    {
    
        $order = new Order;
        $order->order_date = now();
        $order->total_amount = $this->totalPrice;
        $order->total_quantity = array_sum(array_column($this->rows, 'quantity'));
        $order->total_item = count($this->rows);
        $order->workshop_id = $this->user_id ;
        $order->payment_id = 1;
        $order->save();

        foreach ($this->rows as $row) {
            $userId = SparePart::where('id', $row['item'])->value('user_id');

            $orderItem = new OrderItem;
            $orderItem->spare_part_id = $row['item'];
            $orderItem->user_id = $userId;
            $orderItem->quantity = $row['quantity'];
            $orderItem->price = $row['price'];
            $orderItem->total_amount = $row['total_price'];
            $orderItem->category = $row['category'];
            $orderItem->order_id = $order->id;
            $orderItem->save();
        }

        // Reset the form or display success message
        $this->dispatch('swal:toast', [
            'type' => 'success',
            'title' => "Order submitted successfully!",
        ]); 

        return redirect()->route('workshop.purchaseorder');
  
    }


//     public function store()
//     {
    
//         $order = new Order;
//         $order->order_date = now();
//         $order->total_amount = $this->totalPrice;
//         $order->total_quantity = array_sum(array_column($this->rows, 'quantity'));
//         $order->total_item = count($this->rows);
//         $order->user_id = $this->user_id ;
//         $order->payment_id = 1;
//         $order->save();

//         foreach ($this->rows as $row) {
//             $userId = SparePart::where('id', $row['item'])->value('user_id');

//             $orderItem = new OrderItem;
//             $orderItem->spare_part_id = $row['item'];
//             $orderItem->user_id = $userId;
//             $orderItem->quantity = $row['quantity'];
//             $orderItem->price = $row['price'];
//             $orderItem->total_amount = $row['total_price'];
//             $orderItem->category = $row['category'];
//             $orderItem->order_id = $order->id;
//             $orderItem->save();
//         }

//         // Reset the form or display success message
//         $this->dispatch('swal:toast', [
//             'type' => 'success',
//             'title' => "Order submitted successfully!",
//         ]); 

//         return redirect()->route('workshop.puchaseorder');
  
// }

    
}
