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
use App\Models\Notification;

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
                    $order->decline_reason = $order_item->reason ?? $order->decline_reason;
                    $order->payment_status = 0;
                    $order->is_cart = 0;
                }elseif ($statuses->every(fn($status) => $status == 5)) {
                    $order->order_status = 0;
                } else {
                    $order->order_status = 3;  
                }
                
                $acceptedCount = $order_items->where('status', 1)->count();
                $pendingCount = $order_items->where('status', 0)->count();
                $delayedCount = $order_items->where('status', 5)->count();
                $paidAcceptedCount = $order_items->where('status', 1)->whereIn('payment_status', [1, 2])->count();

                if ($pendingCount <= 0 && $delayedCount <= 0 && $acceptedCount > 0 && ($acceptedCount == $paidAcceptedCount)) {
                    $order->is_cart = 1;
                    $order->payment_status = 1;
                } elseif ($order->order_status == 2) {
                    $order->is_cart = 0;
                    $order->payment_status = 0;
                }

                $order->save();
            }            

        // Notify workshop about acceptance/rejection
        if ($order_item->order) {
            $workshopId = $order_item->order->workShopVendor?->id ?? null;
            if ($workshopId) {
                $partName = $order_item->SpareParts->name ?? 'Spare part';
                $vendorName = $this->currentUser->company_name ?? $this->currentUser->name ?? 'Spare part vendor';
                
               if ($status == 1) {
    $title = '✅ Order Accepted';
    $message = "Your order item '{$partName}' for Order #{$order_item->order_id} has been Accepted and is currently being processed.";
} elseif ($status == 2) {
    $title = '❌ Order Update Required';
    $message = "Your order item '{$partName}' for Order #{$order_item->order_id} was not approved. Please review the order details.";
} else {
    $title = '⏳ Order Processing Delay';
    $message = "Processing of your order item '{$partName}' for Order #{$order_item->order_id} is taking longer than expected. We will update you once there is progress.";
}

                Notification::create([
                    'user_id' => $workshopId,
                    'order_id' => $order_item->order_id,
                    'title'   => $title,
                    'message' => $message,
                    'sound'   => 'order_update.mp3',
                ]);
                // ------------------------------------------------------------
                // Notify admins about the vendor's decision (accept/decline)
                // ------------------------------------------------------------
                try {
                    $adminIds = \App\Models\Admin::where('role_type', 21)->pluck('id');
                    $workshopUser = Auth::guard('workshop')->user();
                    $workshopName = $workshopUser->company_name ?? $workshopUser->name ?? 'Workshop';
                    $vendorName = $this->currentUser->company_name ?? $this->currentUser->name ?? 'Spare‑part Vendor';
                    $action = $status == 1 ? 'accepted' : 'declined';
                    $adminTitle = $status == 1 ? '✅ Vendor Accepted Item' : '❌ Vendor Declined Item';
                    $adminMessage = "Spare‑part vendor {$vendorName} has {$action} the order item '{$partName}' for Order #{$order_item->order_id} placed by workshop {$workshopName}.";
                    foreach ($adminIds as $adminId) {
                        Notification::create([
                            'user_id' => $adminId,
                            'order_id' => $order_item->order_id,
                            'title'   => $adminTitle,
                            'message' => $adminMessage,
                            'sound'   => 'order_update.mp3',
                        ]);
                    }
                } catch (\Exception $e) {
                    \Log::error('[ADMIN VENDOR ACTION NOTIF] '.$e->getMessage().' at '.$e->getFile().':'.$e->getLine());
                }
            }
        }

        if ($status == 1) {
            $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Order Item Accepted!']);
        } else {
            $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Order Item Declined!']);
        }
    }

    public function handover($id, $status){
        $order_item = OrderItem::with(['order.workShopVendor', 'SpareParts'])->where('id', $id)->first();
        
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

        $order_item->status = $status;
        $order_item->save();

        $order = Order::find($order_item->order_id);
        if ($order) {
            $statuses = $order->orderItem->pluck('status');
            if ($statuses->every(fn($s) => $s == 3)) {
                $order->order_status = 3;
            } elseif ($statuses->contains(3)) {
                $order->order_status = 3;
            }
            $order->save();
        }

        // Notify workshop that handover is done
        if ($order_item->order) {
            $workshopId = $order_item->order->workShopVendor?->id ?? null;
            if ($workshopId) {
                $partName = $order_item->SpareParts->name ?? 'Spare part';
                $vendorName = $this->currentUser->name ?? $this->currentUser->company_name ?? 'Spare part vendor';
               Notification::create([
    'user_id'  => $workshopId,
    'order_id' => $order_item->order_id,
    'title'    => '📦 Item Delivered',
    'message'  => "Your order item '{$partName}' (Order #{$order_item->order_id}) has been delivered. Please verify and confirm receipt.",
    'sound'    => 'handover.mp3',
]);
            }
        }

        // ------------------------------------------------------------
        // Notify admins that the workshop has marked the item as delivered
        // ------------------------------------------------------------
        try {
            $adminIds = \App\Models\Admin::where('role_type', 21)->pluck('id');
            $workshopUser = Auth::guard('workshop')->user();
            $workshopName = $workshopUser->company_name ?? $workshopUser->name ?? 'Workshop';
            foreach ($adminIds as $adminId) {
                Notification::create([
                    'user_id'  => $adminId,
                    'order_id' => $order_item->order_id,
                    'title'    => "📦 Item Delivered – {$workshopName}",
                    'message'  => "Workshop '{$workshopName}' has marked item delivery for Order #{$order_item->order_id}.",
                    'sound'    => 'handover.mp3',
                ]);
            }
        } catch (\Exception $e) {
            \Log::error('[ADMIN HANDOVER NOTIF] '.$e->getMessage().' at '.$e->getFile().':'.$e->getLine());
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

        $parentOrder = Order::find($order->order_id);
        if ($parentOrder) {
            $parentOrder->decline_reason = $this->decline_reason;
            $parentOrder->save();
        }
 
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
