<?php

namespace App\Livewire\Sparepart;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductStock;
use App\Models\SparePart;
use App\Models\StockHistory;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.spare-part-app')]
class OrderController extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $showOrderItem = false;
    public $currentUser, $orderId,$showReasonModel,$decline_reason,$status,$searchfilter,$sotreStatusValue,$statusReason,$startDate,$endDate,$shoImageModel=false,$imageitem;

    public function mount()
    {
        $this->currentUser = Auth::guard('sparepart')->user();
    }
    public function render()
    {
         if ($this->showOrderItem) {
            $orders = Order::with([
                'orderItem' => function ($qry) {
                    $qry->where('user_id', $this->currentUser->id);
                }
            ])->orderBy('id', 'DESC')->whereHas('orderItem', function ($qry) {
                $qry->where('user_id', $this->currentUser->id);
            })->whereId($this->orderId)->where('is_confim',1)->where('is_confim',1)->first();
        } else {
            $orders = Order::with([
                'orderItem' => function ($qry) {
                    $qry->where('user_id', $this->currentUser->id);
                }
            ])->orderBy('id', 'DESC');
            if($this->searchfilter){
                $orders=$orders->where('id',  $this->searchfilter );
            }
            if($this->startDate ||  $this->endDate ){
                $orders = $orders ->whereRaw('DATE(order_date) BETWEEN ? AND ?', [$this->startDate, $this->endDate]);
            }
            $orders = $orders->whereHas('orderItem', function ($qry) {
                $qry->where('user_id', $this->currentUser->id);
            })->whereIn('payment_status',[0,2])->where('is_confim',1)
                ->paginate(10);
        }

        return view('livewire.sparepart.order', compact('orders'));
    }

    public function view($id)
    {
        $this->showOrderItem = true;
        $this->orderId = $id;

    }
    public function back()
    {
        $this->showOrderItem = false;
        $this->orderId = '';
    }
    public function changeItemStatus($id, $status)
    {

        $order_item = OrderItem::with('order')->find($id);

            if (!$order_item) {
                return   $this->dispatch('swal:toast', ['type' => 'error', 'message' => 'Order item not found!']);  
            }

            $order_item->status = $status;
            $order_item->save();

            $order_items = OrderItem::where('order_id', $order_item->order_id)->get();
            $order = Order::find($order_item->order_id);
            if ($order) {
                $statuses = $order->orderItem->pluck('status'); 
            
               if ($statuses->every(fn($status) => $status == 0)) {
                    $order->order_status = 0;
                } elseif ($statuses->every(fn($status) => $status == 1)) {
                    $order->order_status = 1;
                }elseif ($statuses->every(fn($status) => $status == 2)) {
                    $order->order_status = 2;
                }elseif ($statuses->every(fn($status) => $status == 5)) {
                    $order->order_status = 0;
                } else {
                    $order->order_status = 3;  
                }
                
                if($order_items->where('status',0)->count() <= 0 && $order_items->where('status',5)->count() <= 0 && ($order_items->where('status',1)->count() == $order_items->where('status',1)->whereIn('payment_status',[1,2])->count())){
                    $order->is_cart = 1;
                    $order->payment_status = 1;
                }

                $order->save();
            }            

            // echo "<prE>";print_r($order_item->order->user_id);die;    


        // if ($status == 1) {

        //     $sparepartStock = $spare_part = SparePart::where('id', $order_item->spare_part_id)->first();
        //     $spare_part->stock = $spare_part->stock - $order_item->quantity;
        //     $spare_part->save();

        //     $stockProduct = ProductStock::where(['label_id' => $spare_part->label_id, 'price' => $order_item->price,'user_id'=>$order_item->order->user_id])->first();
        //     if (empty($stockProduct)) {
        //         $stockProducts = new ProductStock;
        //         $stockProducts->label_id = $spare_part->label_id;
        //         $stockProducts->category_id = $order_item->category;
        //         $stockProducts->stock = $order_item->quantity;
        //         $stockProducts->price = $order_item->price;
        //         $stockProducts->user_id = $order_item->order->user_id;
        //         $stockProducts->save();
        //     } else {
        //         $stockProduct->stock = $stockProduct->stock + $order_item->quantity;
        //         $stockProduct->price = $order_item->price;
        //         $stockProduct->save();
        //     }

        //     $stockHistory = new StockHistory;
        //     $stockHistory->label_id = $spare_part->label_id;
        //     $stockHistory->spare_part_id = $order_item->spare_part_id;
        //     $stockHistory->category = $order_item->category;
        //     $stockHistory->user_id = $this->currentUser->id;
        //     $stockHistory->last_stock = $sparepartStock->stock;
        //     $stockHistory->current_stock = $sparepartStock->stock - $order_item->quantity;
        //     $stockHistory->stock_type = 'removal';
        //     $stockHistory->remarks = "Stock removal for order accept";
        //     $stockHistory->save();

        //     $payableAmount = $order_item->total_amount;

        //     $commision = getCommission($order_item->category);
        //     if (!empty($commision)) {
        //         $payableAmount = $order_item->total_amount - (($order_item->total_amount * $commision) / 100);
        //     }

        //     if ($payableAmount > 0) {
        //         $wallet = new Wallet;
        //         $wallet->amount = $payableAmount;
        //         $wallet->type = 0;
        //         $wallet->total = $this->currentUser->wallet + $payableAmount;
        //         $wallet->user_id = $this->currentUser->id;
        //         $wallet->order_id = $order_item->order?->id ?? 0;
        //         $wallet->save();

        //         $this->currentUser->increment('wallet', $payableAmount);
        //     }

        // }


        // $order = Order::where('id', $order_item->order_id)->first();
        // if (!in_array('2', $order_status) && in_array('1', $order_status) && in_array('0', $order_status)) {
        //     $order->status = 3;
        //     $order->save();
        // } elseif (in_array('2', $order_status) && in_array('1', $order_status) && !in_array('0', $order_status)) {
        //     $order->status = 4;
        //     $order->save();
        // } elseif (!in_array('2', $order_status) && in_array('1', $order_status) && !in_array('0', $order_status)) {
        //     $order->status = 1;
        //     $order->save();
        // } elseif (in_array('2', $order_status) && !in_array('1', $order_status) && !in_array('0', $order_status)) {
        //     $order->status = 2;
        //     $order->save();
        // }

        if ($status == 1) {
            $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Order Item Accepted!']);
        } else {
            $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Order Item Declined!']);
        }
    }

    public function handover($id, $status){
        $order_item = OrderItem::with('order')->where('id', $id)->first();
        
        $sparepartStock = $spare_part = SparePart::where('id', $order_item->spare_part_id)->first();
        $spare_part->stock = $spare_part->stock - $order_item->quantity;
        $spare_part->save();

            $stockHistory = new StockHistory;
            $stockHistory->label_id = $spare_part->label_id;
            $stockHistory->spare_part_id = $order_item->spare_part_id;
            $stockHistory->category = $order_item->category;
            $stockHistory->user_id = $this->currentUser->id;
            $stockHistory->last_stock = $sparepartStock->stock;
            $stockHistory->current_stock = $sparepartStock->stock - $order_item->quantity;
            $stockHistory->stock_type = 'removal';
            $stockHistory->remarks = "Stock removal for item accept";
            $stockHistory->save();

            $payableAmount = $order_item->total_amount;

            $commision = getCommission($order_item->category);
            if (!empty($commision)) {
                $payableAmount = $order_item->total_amount - (($order_item->total_amount * $commision) / 100);
            }

            if ($payableAmount > 0) {
                $wallet = new Wallet;
                $wallet->amount = $payableAmount;
                $wallet->type = 0;
                $wallet->total = $this->currentUser->wallet + $payableAmount;
                $wallet->user_id = $this->currentUser->id;
                $wallet->order_id = $order_item->order?->id ?? 0;
                $wallet->save();

                $this->currentUser->increment('wallet', $payableAmount);
            }

        $order_item = OrderItem::with('order')->where('id', $id)->first();
        $order_item->status = $status;
        $order_item->save();

        $order = Order::find($order_item->order_id);
        if ($order) {
            $statuses = $order->orderItem->pluck('status');
            if ($statuses->every(fn($s) => $s == 3)) {
                $order->order_status = 3;
            } elseif ($statuses->contains(3)) {
                $order->order_status = 3; // Or a new status for partially handover if needed
            }
            $order->save();
        }

        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Hand over Successfully!']);
    }

    public function changeOrderStatus($id, $status)
    {
      
        $order = Order::where('id',$id)->first();
        $order->order_status = $status; 
        $order->save(); 
        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Order Accepted Successfully !']);
        
    }

    public function declineorder($id,$status){

         $this->showReasonModel = true;
        $this->sotreStatusValue[] = $id; 
        $this->sotreStatusValue[] = $status; 
        $order = OrderItem::where('id',$id)->first();
        $this->decline_reason = $order->reason;
        if($status == 5){
            $this->statusReason = 'Delayed';
            $this->status = 5;
        }else{
            $this->statusReason = 'Decline';
            $this->status = 2;
        }
 
    }
    
    public function clodeReasonModel(){
        $this->showReasonModel = false;
        $this->decline_reason ='';
        $this->statusReason ='';
        $this->sotreStatusValue =[];
    }

    public function declinereasonStore(){

        $this->validate([
            'decline_reason' => 'required',
        ],[
            'decline_reason.required' => 'The reason field is required.',
        ]);
 
        $order = OrderItem::where('id', $this->sotreStatusValue[0])->first();
        $order->reason = $this->decline_reason;
        $order->save();
 
        $this->changeItemStatus($this->sotreStatusValue[0], $this->sotreStatusValue[1]);
        $this->showReasonModel = false;
        $this->decline_reason = '';
        $this->statusReason = '';
        $this->sotreStatusValue = [];
        
        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Order Declined Successfully!']);
        $this->showReasonModel = false;
        
        return;


    }
    
    
    public function resetFilter(){
        $this->searchfilter ='';
        $this->startDate = '';
        $this->endDate = '';
    }
    
    public function shoImage($value){
        $this->imageitem = OrderItem::with('SpareParts')->find($value); 
        $this->shoImageModel = true;
    }
    
    public function clodeImageModel(){
        $this->shoImageModel = false;
    }



}
