<?php

namespace App\Livewire\Workshop;

use App\Models\{Order,OrderItem, Payment, SparePart, WorkShopVendor};
use App\Models\ProductStock;
use App\Models\Staff;
use Illuminate\Support\Facades\{Auth, DB};
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Razorpay\Api\Api;
use Livewire\Attributes\On;

#[Layout('components.layouts.workshop-app')]  
class PaidOrderController extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $orderIds = [];
    public  $totalAmounts = [];
    public  $orderStatus = [];
    public  $decline_reason = [];

    public $isEdit = false, $showModal = false, $isAdd = false;
    public $user_id,$order_items,$showOrderItem,$showReasonModel = false;
  
    public $orderId,$user,$status = '',$searchfilter,$statusReason,$sotreStatusValue,$shoImageModel=false,$imageitem,$startDate,$endDate;

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
            
            $orders = Order::with([ 'orderItem' ])->orderBy('id', 'DESC')->whereId($this->orderId)->where('workshop_id', $user->is_user == 0 ? $this->user_id : $user->parent_id)->whereIN('payment_status',[1,2])->where('is_cart',1)->first();
        } else {
            $items = Order:: where('workshop_id', $user->is_user == 0 ? $this->user_id : $user->parent_id)->orderBy('id', 'DESC')->whereIn('payment_status',[1,2])->where('is_cart',1);
            if($this->searchfilter){
                $items = $items->where('id',$this->searchfilter);
            }
            if($this->startDate ||  $this->endDate ){
                $items = $items ->whereRaw('DATE(order_date) BETWEEN ? AND ?', [$this->startDate, $this->endDate]);
            }
            $items=$items->paginate(10); 
        }
       
 
            
       
 
        return view('livewire.workshop.orders.paidorder', compact('items','orders'));
    }

    public function viewItem($id)
	{
        $user = WorkShopVendor::find($this->user_id);
        $this->showOrderItem = true;
        $this->orderId = $id;
      
   
		$this->order_items = OrderItem::where('order_id', $id)->get(); 
	}

    public function received($id, $status){

        $order_item = OrderItem::with('order')->find($id);
        $order_item = OrderItem::with('order')->where('id', $id)->first();
        $order_item->status = $status;
        $order_item->save();

        // Update Product Stock for Workshop
        $spare_part = SparePart::find($order_item->spare_part_id);
        if ($spare_part) {
            $offlinePrice = $spare_part->selling_amount ?? 0;
            if (($spare_part->tax_type ?? '') == 'exclude' && ($spare_part->tax_percentage ?? 0)) {
                $offlinePrice += ($offlinePrice * $spare_part->tax_percentage) / 100;
            }
            if ($offlinePrice <= 0) {
                $offlinePrice = $order_item->price;
            }

            $stockProduct = ProductStock::where([
                'label_id' => $spare_part->label_id,
                'price' => $offlinePrice,
                'user_id' => Auth::guard('workshop')->user()->id
            ])->first();

            if (empty($stockProduct)) {
                $stockProduct = new ProductStock;
                $stockProduct->label_id = $spare_part->label_id;
                $stockProduct->category_id = $order_item->category;
                $stockProduct->stock = $order_item->quantity;
                $stockProduct->price = $offlinePrice;
                $stockProduct->buy_price = $order_item->price;
                $stockProduct->brand = $spare_part->brand;
                $stockProduct->hsn_code = $spare_part->hsn_code;
                $stockProduct->unit_id = $spare_part->unit_id;
                $stockProduct->tax_type = $spare_part->tax_type;
                $stockProduct->tax_percentage = $spare_part->tax_percentage;
                $stockProduct->user_id = Auth::guard('workshop')->user()->id;
                $stockProduct->save();
            } else {
                $stockProduct->stock = $stockProduct->stock + $order_item->quantity;
                $stockProduct->price = $offlinePrice;
                $stockProduct->buy_price = $order_item->price;
                $stockProduct->tax_type = $spare_part->tax_type;
                $stockProduct->tax_percentage = $spare_part->tax_percentage;
                $stockProduct->save();
            }
        }

        // Update main order status
        $order = Order::find($order_item->order_id);
        if ($order) {
            $statuses = $order->orderItem->pluck('status');
            if ($statuses->every(fn($s) => $s == 4)) {
                $order->order_status = 4;
            } elseif ($statuses->contains(4) || $statuses->contains(3)) {
                $order->order_status = 3; 
            } elseif ($statuses->every(fn($s) => $s == 1)) {
                $order->order_status = 1;
            }
            $order->save();
        }

        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Received Successfully!']);
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



    public function createOrder($order_id,$total_amount)
    {
        // echo "<pre>";print_r($order_id);
        // echo "<pre>";print_r($total_amount);die;
        $total_amount = explode(',',$total_amount);

        // $api_key = env('RAZORPAY_KEY');
        // $api_secret = env('RAZORPAY_SECRET');
        
        $api_key = config('services.razorpay.key');
$api_secret = config('services.razorpay.secret');

        $api = new Api($api_key, $api_secret);

        $orderData = [
            'amount' => array_sum($total_amount) * 100, // Convert to paise
            'currency' => 'INR',
            'receipt' => 'receipt_' . time(),
        ];

        $order = $api->order->create($orderData);
        $this->orderId = $order->id;

        // Dispatch the event with the order details
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

        foreach(explode(',',$paymentResponse['order_id']) as $orderID){
            $order =  Order::find($orderID);
            $order->payment_status = 1;
            $order->is_cart = 1;
            $order->save();
        }
  

 
             $this->dispatch('swal:toast', [
                'type' => 'success',
                'title' => "Payment Paid successfully!",
            ]); 
    
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

    public function delete()
    {
        Order::destroy($this->orderId);
        $this->dispatch('swal:toast', ['message' => 'Order deleted successfully!']);
    }
    
    public function showdeclineorder($id,$status){

        $this->showReasonModel = true;
        $this->sotreStatusValue[] = $id; 
        $this->sotreStatusValue[] = $status; 
        $order = OrderItem::where('id',$id)->first();
        $this->decline_reason = $order->reason;
        if($status == 5){
            $this->statusReason = 'Delayed';
        }else{
            $this->statusReason = 'Decline';
        }
 
    } 
    
    public function clodeReasonModel(){
        $this->showReasonModel = false;
        $this->decline_reason ='';
        $this->statusReason ='';
        $this->sotreStatusValue =[];
    }

    public function declineorder($id,$status){

        $this->orderId = $id;
        $this->status = $status;
        $reasonData = Order::where('id', $id)->first(); 
        $this->decline_reason = @$reasonData->decline_reason;
        $this->showReasonModel = true;
 
    }

    public function resetFilter(){
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

    
}
