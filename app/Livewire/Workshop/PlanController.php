<?php

namespace App\Livewire\Workshop;

use App\Models\{Payment, Plan, PlanDescription, Subscription, WorkShopVendor,Role};
use DateTime;
use Livewire\Component;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.workshop-app')]  
class PlanController extends Component
{
    // Public variables
    public $plans, $orderId;
    public $plan_name, $is_trial, $validity, $status, $description, $plan_type, $planDescription = [];
    public $planId,$user,$latestPlan;
    public $amount = '';

    protected $rules = [];

    public function mount()
    {
        // dd(config('services.razorpay.key'));
        $this->plans = Plan::where('status', 1)
            ->with('planDescriptions')
            ->get();
 
        $this->user = Auth::guard('workshop')->user();

        $latestSubscription = Subscription::where('user_id', $this->user->id)->latest()->first();
        if ($latestSubscription) {
            $this->latestPlan = Plan::find($latestSubscription->plan_id);
        }
    }

    public function render()
    {
        return view('livewire.workshop.plan');
    }

    public function createOrder($id)
    {  
         $plan = Plan::where('id',$id)->first();
        $api_key = config('services.razorpay.key');
        $api_secret = config('services.razorpay.secret');
    
        $api = new Api($api_key, $api_secret);
    
        $orderData = [
            'amount' => $plan->amount * 100, // Convert to paise
            'currency' => 'INR',
            'receipt' => 'receipt_' . time(),
        ];
      
        $order = $api->order->create($orderData); 
        $this->orderId = $order->id;
    
        // Dispatch the event with the order details
        $this->dispatch('razorpay-show', [
            'amount' => $plan->amount,
            'orderId' => $this->orderId,
            'planId' => $id,
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
        

        $plan = Plan::where('id',$paymentResponse['planId'])->first(); 

        // echo "<pre>";print_r( $plan->plan_name);die;
        Subscription::create([
            'user_id' => Auth::guard('workshop')->user()->id,
            'plan_id' => $paymentResponse['planId'],
            'payment_id' => $paymentResponse['razorpay_payment_id'],
            'plan_name' => $plan->plan_name,
            'amount' => $paymentResponse['amount'],
            'plan_type' => $plan->plan_type,
        ]);

        $vendor = WorkShopVendor::findOrFail(Auth::guard('workshop')->user()->id);
        $vendor->is_subscribe = 1;
        $vendor->subscription_start_date = date('Y-m-d');  
        
        $days = (int) ($plan->days ?? 0);  
        $today = new DateTime();
        $vendor->subscription_end_date = $today->modify("+$days days")->format('Y-m-d');
        
        $vendor->save();
        

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'title' => "Payment Successfully Paid.",
        ]);

        return redirect()->route('workshop.dashboard');

    }
    
}
