<?php

namespace App\Livewire\Workshop;

use App\Models\{Order,OrderItem, Payment, SparePart, WorkShopVendor};
use App\Models\Staff;
use Illuminate\Support\Facades\{Auth, DB};
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Razorpay\Api\Api;
use Livewire\Attributes\On;

#[Layout('components.layouts.workshop-app')]  
class OrderController extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $orderIds = [];
    public  $totalAmounts = [];
    public  $orderStatus = [];
    public  $decline_reason = [];

    public $isEdit = false, $showModal = false, $isAdd = false;
    public $user_id,$order_items,$showOrderItem,$showReasonModel = false;
  
    public $orderId,$user,$status = '',$searchfilter,$statusReason,$sotreStatusValue,$shoImageModel=false,$imageitem, $startDate,$endDate; 
    public $checked = false,$totalPayabaleAmount =0,$payabaleOrderId = [];

    protected $listeners = ['delete'];

    

    public function mount()
    { 
        $this->user_id = Auth::guard('workshop')->user()->id;
        $this->user = WorkShopVendor::where('id', $this->user_id)->first();

    }

    public function render()
    {
        $user = WorkShopVendor::find($this->user_id);
        $orders= '';
        $items= '';
        if ($this->showOrderItem) {
            
            $orders = Order::with([ 'orderItem' ])->whereId($this->orderId)->where('workshop_id', $user->is_user == 0 ? $this->user_id : $user->parent_id)->where('payment_status',0)->where('is_confim', 1)->first();
        } else {
            $items = Order::with('orderItem')->where('workshop_id', $user->is_user == 0 ? $this->user_id : $user->parent_id)->where('payment_status',0)->where('is_confim', 1);
                if($this->searchfilter){
                    $items = $items->where('id',$this->searchfilter);
                }
                if($this->startDate ||  $this->endDate ){
                    $items = $items ->whereRaw('DATE(order_date) BETWEEN ? AND ?', [$this->startDate, $this->endDate]);
                }
                
                // $items=$items->paginate(10); 
                $items=$items->orderBy('created_at', 'desc')->paginate(10); 
        }

        return view('livewire.workshop.orders.order', compact('items','orders'));
    }

    public function viewItem($id)
	{
        $user = WorkShopVendor::find($this->user_id);
        $this->showOrderItem = true;
        $this->orderId = $id;
      
   
		$this->order_items = OrderItem::where('order_id', $id)->get(); 
	}


    
    public function create()
    {
            $this->isAdd = true;
    }

    public function back()
    {
        $this->showOrderItem = false;
        $this->orderId = '';
    }



    // public function createOrder($order_id,$total_amount)
    // {
    //     // echo "<pre>";print_r($order_id);
    //     // echo "<pre>";print_r($total_amount);die;
    //     $total_amount = explode(',',$total_amount);

    //     $api_key = env('RAZORPAY_KEY');
    //     $api_secret = env('RAZORPAY_SECRET');

    //     $api = new Api($api_key, $api_secret);

    //     $orderData = [
    //         'amount' => (int) round(array_sum($total_amount) * 100),
    //         'currency' => 'INR',
    //         'receipt' => 'receipt_' . time(),
    //     ];

    //     $order = $api->order->create($orderData);
    //     $this->orderId = $order->id;

    //     // Dispatch the event with the order details
    //     $this->dispatch('razorpay-show', [
    //         'amount' => array_sum($total_amount),
    //         'orderId' => $this->orderId,
    //         'order_id' => $order_id,
    //     ]);

    //     \Log::info('Razorpay Order Response:', (array) $order);
    // }
public function createOrder($order_id, $total_amount)
{
    $total_amount = explode(',', $total_amount);

    $api_key = config('services.razorpay.key');
    $api_secret = config('services.razorpay.secret');

    $api = new Api($api_key, $api_secret);

    $orderData = [
        'amount' => (int) round(array_sum($total_amount) * 100),
        'currency' => 'INR',
        'receipt' => 'receipt_' . time(),
    ];

    $order = $api->order->create($orderData);

    $this->orderId = $order->id;

    $this->dispatch('razorpay-show', [
        'amount' => array_sum($total_amount),
        'orderId' => $this->orderId,
        'order_id' => $order_id,
    ]);

    \Log::info('Razorpay Order Response:', (array) $order);
}

    #[On('storePayment')]
    public function handlePayment($paymentResponse)
    {
 
        $payment = Payment::create([
            'payment_id' => $paymentResponse['razorpay_payment_id'],
            'order_id' => $paymentResponse['razorpay_order_id'],
            'status' => 'success',
            'amount' => $paymentResponse['amount'],
            'user_id' => Auth::guard('workshop')->user()->id,
        ]);
 
        // echo "<pre>";print_r($paymentResponse['order_id']);die;
 
        // foreach(explode(',',$paymentResponse['order_id']) as $orderID){
        //     $order =  Order::find($orderID);
        //     $order->payment_status = 1;
        //     $order->is_cart = 1;
        //     $order->save();
        // }
 
        $orderItems = OrderItem::whereIn('id', $this->payabaleOrderId)->get();
        foreach ($orderItems as $orderItem) {
            $orderItem->payment_status = 1;
            $orderItem->save();
        }
 
        $orderItems = OrderItem::whereIn('order_id', $orderItems->pluck('order_id'))->get();
        $order = Order::whereIn('id', $orderItems->pluck('order_id'))->first();
 
        if ($order) {
            $statusCounts = $orderItems->groupBy('status')->map->count();
            $paymentStatusCount = $orderItems->where('payment_status', 1)->count();
 
            $allPending = $statusCounts[0] ?? 0;
            $allDeclined = $statusCounts[2] ?? 0;
            $statusOneItems = $statusCounts[1] ?? 0;
 
            if ($allPending == 0 && $allDeclined == 0) {
                $order->payment_status = ($statusOneItems == $paymentStatusCount) ? 1 : 2;
            } else {
                $order->payment_status = ($allPending > 0) ? 2 : 1;
            }
 
            $order->is_cart = ($order->payment_status == 1) ? 1 : $order->is_cart;
            $order->save();
        }
 
 
        $this->dispatch('swal:toast', [
            'type' => 'success',
            'title' => "Payment Paid successfully!",
        ]);
        return redirect()->route('workshop.orders');
   
    }


    public function confirmDelete($id)
    {
        $this->orderId = $id;
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

    #[On('delete')]
    public function delete()
    {
        OrderItem::where('order_id', $this->orderId)->delete();
        Order::destroy($this->orderId);
        $this->dispatch('swal:toast', ['type' => 'success', 'title' => 'Order cancelled successfully!']);
    }

    public function declineorder($id,$status){

        $this->orderId = $id;
        $this->status = $status;
        $reasonData = Order::where('id', $id)->first(); 
        $this->decline_reason = @$reasonData->decline_reason;
        $this->showReasonModel = true;
 
    }
    
    public function showdeclineorder($id,$status){
 
        $this->showReasonModel = true;
        $this->sotreStatusValue[] = $id;
        $this->sotreStatusValue[] = $status;
        $order = OrderItem::where('id',$id)->first();
        if($status == 5){
            $this->statusReason = 'Delayed';
            $this->decline_reason = $order->reason;
        }else{
            $this->statusReason = 'Decline';
            $this->decline_reason = $order->decline_reason;
        }
 
    } 
    
    public function clodeReasonModel(){
        $this->showReasonModel = false;
        $this->decline_reason ='';
        $this->statusReason ='';
        $this->sotreStatusValue =[];
    }
    
    public function resetFilter(){
       $this->startDate = '';
       $this->endDate = '';
       $this->searchfilter = '';
    }

    public function updatedSearchfilter(){
        $this->resetPage();
    }
    
     public function shoImage($value){
        $this->imageitem = OrderItem::with('SpareParts')->find($value); 
        $this->shoImageModel = true;
    }

    public function clodeImageModel(){
        $this->shoImageModel = false;
    }

    public function toggleCheckbox($id, $value, $checked)
    {
        $orderItem = OrderItem::where('status', 1)->where('payment_status', 0)->find($id);
 
        if (!$orderItem) {
            return $this->dispatch('swal:toast', [
                'type' => 'info',
                'title' => "Paid Item is also add!",
            ]);
 
        }
        if ($checked) {
            if (!in_array($orderItem->id, $this->payabaleOrderId)) {
                $this->totalPayabaleAmount += $orderItem->total_amount;
                $this->payabaleOrderId[] = $orderItem->id;
            }
        } else {
            $key = array_search($orderItem->id, $this->payabaleOrderId);
            if ($key !== false) {
                $this->totalPayabaleAmount -= $orderItem->total_amount;
                unset($this->payabaleOrderId[$key]);
                $this->payabaleOrderId = array_values($this->payabaleOrderId);
            }
        }
    }
 
    public function toggleCheckboxAll($checked, $order_id)
    {
        if ($checked) {
            $orderItems = OrderItem::where('order_id', $order_id)->where('status', 1)->where('payment_status', 0)->get();
            $this->payabaleOrderId = [];
            $this->totalPayabaleAmount = 0;
            if (!empty($orderItems)) {
                foreach ($orderItems as $orderItem) {
                    $this->payabaleOrderId[] = $orderItem->id;
                    $this->totalPayabaleAmount += $orderItem->total_amount;
                    $this->checked = true;
                }
            } else {
                $this->dispatch('swal:toast', [
                    'type' => 'info',
                    'title' => "Paid Item is also add!",
                ]);
            }
 
        } else {
            $this->payabaleOrderId = [];
            $this->totalPayabaleAmount = 0;
            $this->checked = false;
        }
    }
 
    public function declinereasonStore()
    {
        $order = OrderItem::where('id', $this->sotreStatusValue[0])->first();
        $order->reason = $this->decline_reason;
        $order->save();
 
        $this->changeItemStatus($this->sotreStatusValue[0], $this->sotreStatusValue[1]);
        $this->showReasonModel = false;
        $this->decline_reason = '';
        $this->statusReason = '';
        $this->sotreStatusValue = [];
        return;
 
    }

    public function changeItemStatus($id, $status)
    {
 
        $order_item = OrderItem::with('order')->find($id);
 
        if (!$order_item) {
            return $this->dispatch('swal:toast', ['type' => 'error', 'message' => 'Order item not found!']);
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
            } elseif ($statuses->every(fn($status) => $status == 2)) {
                $order->order_status = 2;
            } elseif ($statuses->every(fn($status) => $status == 5)) {
                $order->order_status = 0;
            } else {
                $order->order_status = 3;
            }
 
            if ($order_items->where('status', 0)->count() <= 0 && $order_items->where('status', 5)->count() <= 0 && ($order_items->where('status', 1)->count() == $order_items->where('status', 1)->whereIn('payment_status', [1, 2])->count())) {
                $order->is_cart = 1;
                // $order->payment_status = 1;
            }
 
            $order->save();
        }
 
        if ($status == 1) {
            $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Order Item Accepted!']);
        } else {
            $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Order Item Declined!']);
        }
    }
}
