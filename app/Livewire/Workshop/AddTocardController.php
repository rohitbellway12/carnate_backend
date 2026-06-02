<?php

namespace App\Livewire\Workshop;

use App\Models\{MakerType, Maker, Mmodel, ModelYear, Modification, Order, OrderItem, SparePart, VehicleSearch};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.workshop-app')]
class AddTocardController extends Component
{
    use WithPagination;

    public $sparePart, $sparePartId, $user_id, $increase_stock = 0;

    public $counterCard = 0,$cartOrderId = 0;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['delete'];
    public function mount($id)
    {
        $this->user_id = Auth::guard('workshop')->user()->id;

        $this->sparePartId = $id;
    
        $this->increase_stock = 1;

       
        $order = Order::where('is_confim', 0)->where('workshop_id', $this->user_id)->first();
        
        if($order){
            $this->counterCard = count($order->orderItem);
            $this->cartOrderId = $order->id;
        }
    }

    public function render()
    {
        $sparePartData = SparePart::find($this->sparePartId);
        return view('livewire.workshop.addtocard', compact('sparePartData'));
    }

    public function resetFilter()
    {
        $this->reset(['search', 'maker_type_id', 'maker_id', 'model_id', 'model_year_id', 'status_filter']);
    }

    public function updated()
    {
        $this->resetErrorBag();
    }

    public function store($spareId)
    {
        
        $sparePart = SparePart::findOrFail($spareId);

        if ($this->increase_stock <= 0) {
            $this->dispatch('swal:toast', ['type' => 'error', 'message' => 'Please Check the Stock Quantity!']);
            $this->addError('increase_stock', 'Please Check the Stock Quantity!');
            return;
        } else if ($this->increase_stock > $sparePart->stock) {
            $this->dispatch('swal:toast', ['type' => 'error', 'message' => 'Please Check the Stock Quantity!']);
            $this->addError('increase_stock', 'Please Check the Stock Quantity!');
            return;
        }


        // Find the latest unconfirmed order that has items, or just the latest if all are empty
        $isConfirmOrder = Order::where('is_confim', 0)
            ->where('workshop_id', $this->user_id)
            ->whereHas('orderItem')
            ->latest()
            ->first();

        if (!$isConfirmOrder) {
            $isConfirmOrder = Order::where('is_confim', 0)
                ->where('workshop_id', $this->user_id)
                ->latest()
                ->first();
        }

        if (!empty($isConfirmOrder)) {
            $orderItem = OrderItem::where('spare_part_id', $sparePart->id)->where('order_id', $isConfirmOrder->id)->first();
            if (!empty($orderItem)) {
                $orderItem->quantity += $this->increase_stock;
                $orderItem->total_amount += $sparePart->price * $this->increase_stock;

                $orderItem->spare_total_price += (float)($sparePart->amount) * $this->increase_stock;
                $orderItem->spare_tax_price += (($sparePart->amount * $this->increase_stock) * $sparePart->tax_percentage) / 100;
                
                $orderItem->save();

                $isConfirmOrder->total_item += $this->increase_stock;
                $isConfirmOrder->total_amount += $sparePart->price * $this->increase_stock;
                $isConfirmOrder->save();
            } else {
                $orderItem = new OrderItem();
                $orderItem->spare_part_id = $sparePart->id;
                $orderItem->user_id = $sparePart->user_id;
                $orderItem->quantity = $this->increase_stock;
                $orderItem->price = $sparePart->price;
                $orderItem->spare_price = $sparePart->amount;
                $orderItem->spare_total_price = $sparePart->amount * $this->increase_stock;
                $orderItem->spare_tax = $sparePart->tax_percentage ?? 0;
                $orderItem->spare_tax_type = $sparePart->tax_type ?? null;
                $orderItem->spare_tax_price = (($sparePart->amount * $this->increase_stock) * $sparePart->tax_percentage) / 100;
                $orderItem->total_amount = $sparePart->price*$this->increase_stock;
                $orderItem->category = $sparePart->spare_part_type;
                $orderItem->order_id = $isConfirmOrder->id;
                $orderItem->save();

                $isConfirmOrder->total_quantity += 1;
                $isConfirmOrder->total_item += $this->increase_stock;
                $isConfirmOrder->total_amount += $sparePart->price * $this->increase_stock;
                $isConfirmOrder->save();
            }
        } else {
            $order = new Order();
            $order->order_date = now();
            $order->total_amount = $sparePart->price;
            $order->total_quantity = 1;
            $order->total_item = $this->increase_stock;
            $order->workshop_id = $this->user_id;
            $order->payment_id = 1;
            $order->save();

            $orderItem = new OrderItem();
            $orderItem->spare_part_id = $sparePart->id;
            $orderItem->user_id = $sparePart->user_id;
            $orderItem->quantity = $this->increase_stock;
            $orderItem->price = $sparePart->price;
            $orderItem->spare_price = $sparePart->amount;
            $orderItem->spare_total_price = $sparePart->amount * $this->increase_stock;
            $orderItem->spare_tax = $sparePart->tax_percentage ?? 0;
            $orderItem->spare_tax_type = $sparePart->tax_type ?? null;
            $orderItem->spare_tax_price = (($sparePart->amount * $this->increase_stock) * $sparePart->tax_percentage) / 100;
            $orderItem->total_amount = $sparePart->price * $this->increase_stock;
            $orderItem->category = $sparePart->spare_part_type;
            $orderItem->order_id = $order->id;
            $orderItem->save();
        }
        // echo "<pre>";print_r($sparePart);die;

        // $this->counterCard = Order::where('is_cart', 0)->where('is_cart_payment', 0)->where('workshop_id', $this->user_id)->count();

        return redirect()->route('workshop.vehicle_search')->with('success','Item Added in cart successfully!');
    }

    public function updatedIncreaseStock()
    {

        if ($this->increase_stock > 1) {
            $sparePartData = SparePart::find($this->sparePartId);
            if ((int) $this->increase_stock > (int) $sparePartData->stock) {
                $this->increase_stock = 1;
                $this->dispatch('swal:toast', ['type' => 'info', 'message' => 'Stock is not match fill correct quantity!']);
                return;
            }
        }
    }


}
