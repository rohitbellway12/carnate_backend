<?php

namespace App\Livewire\Workshop;

use App\Models\{Order, OrderItem, Payment, SparePart, WorkShopVendor};
use App\Models\Staff;
use Illuminate\Support\Facades\{Auth, DB};
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Razorpay\Api\Api;
use Livewire\Attributes\On;

#[Layout('components.layouts.workshop-app')]
class PurchaseOrderController extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $isEdit = false, $showModal = false, $isAdd = false;
    public $user_id, $order_items, $isView = false;

    public $orderId, $user;

    protected $listeners = ['delete'];
    public function mount()
    {
        $this->user = Auth::guard('workshop')->user();
        $this->user_id = $this->user->id;
    }
    public function render()
    {
        $workshopId = $this->user->is_user == 0 ? $this->user_id : $this->user->parent_id;
        $items = Order::where('workshop_id', $workshopId)->orderBy('id', 'desc')->paginate(10);

        return view('livewire.workshop.purchaseorder.index', compact('items'));
    }
    public function viewItem($id)
    {
        $this->isView = true;
        $this->order_items = OrderItem::where('order_id', $id)->get();
    }
    public function create()
    {
        $this->isAdd = true;
    }
    public function createOrder($order_id, $total_amount)
    {
        // $api_key = env('RAZORPAY_KEY');
        // $api_secret = env('RAZORPAY_SECRET');
        $api_key = config('services.razorpay.key');
$api_secret = config('services.razorpay.secret');

        $api = new Api($api_key, $api_secret);

        $orderData = [
            'amount' => $total_amount * 100, // Convert to paise
            'currency' => 'INR',
            'receipt' => 'receipt_' . time(),
        ];

        $order = $api->order->create($orderData);
        $this->orderId = $order->id;

        // Dispatch the event with the order details
        $this->dispatch('razorpay-show', [
            'amount' => $total_amount,
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

        $order = Order::find($paymentResponse['order_id']);
        $order->payment_status = 1;
        $order->save();


        $this->dispatch('swal:toast', [
            'type' => 'success',
            'title' => "Payment Paid successfully!",
        ]);

    }


}
