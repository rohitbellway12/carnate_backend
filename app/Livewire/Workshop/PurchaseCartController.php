<?php

namespace App\Livewire\Workshop;

use App\Models\{Order, OrderItem, Payment, ProductStock, SparePart, WorkShopVendor, Notification};
use App\Models\Staff;
use Illuminate\Support\Facades\{Auth, DB};
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Razorpay\Api\Api;
use Livewire\Attributes\On;

#[Layout('components.layouts.workshop-app')]
class PurchaseCartController extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $orderIds = [];
    public $totalAmounts = [];
    public $orderStatus = [];
    public $decline_reason = [];

    public $isEdit = false, $showModal = false, $isAdd = false;
    public $user_id, $order_items, $showOrderItem, $showReasonModel = false;

    public $orderId, $user, $status = '', $checkItems = [];
    public $totalPayabaleAmount = 0, $payabaleOrderId = [], $checked = false, $statusReason, $sotreStatusValue;
    public $order, $orderItemId, $shoImageModel = false, $imageitem, $deleteItemId;

    protected $listeners = ['delete', 'orderConfirmed'];



    public function mount($id)
    {

        $user = Auth::guard('workshop')->user();
        $this->user_id = $user->id;
        $this->user = $user;

        $order = Order::where('is_confim', 0)->where('workshop_id', $this->user_id)->where('id',$id)->first();

        if (!$order) {
            return redirect()->route('workshop.vehicle_search')->with('error', 'Cart is empty!');
        }

        $this->order = $order;
        $this->showOrderItem = true;
        $this->orderItemId = $order->id;

        $this->order_items = OrderItem::where('order_id', $this->orderItemId)->get();

    }

    public function render()
    {
        return view('livewire.workshop.purchaseorder.purchasecart');
    }

    public function viewItem($id)
    {
        $this->showOrderItem = true;
        $this->orderItemId = $id;
    }

    public function back()
    {
        $this->showOrderItem = false;
        // $this->orderId = '';
    }

    public function received($id, $status)
    {
        $order_item = OrderItem::with(['order', 'SpareParts'])->find($id);
        
        if (!$order_item) {
            return $this->dispatch('swal:toast', ['type' => 'error', 'message' => 'Order item not found!']);
        }
        
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

        $order_item->status = $status;
        $order_item->save();

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
        
        // Notify sparepart vendor that workshop has received the item
        try {
            if ($order_item->order) {
                $sparepartVendorId = $order_item->user_id;
                if ($sparepartVendorId) {
                    $partName = $order_item->SpareParts->name ?? 'Spare part';
                    $workshopUser = Auth::guard('workshop')->user();
                    $workshopName = ($workshopUser->name ?? $workshopUser->company_name ?? 'Workshop');
                    
                    Notification::create([
                        'user_id'  => $sparepartVendorId,
                        'order_id' => $order_item->order_id,
                        'title'    => '✅ Item Received by Workshop',
                        'message'  => "Workshop '{$workshopName}' has confirmed receipt of '{$partName}' for Order #{$order_item->order_id}. The item has been received successfully.",
                        'sound'    => 'received.mp3',
                    ]);
                }
            }
        } catch (\Exception $e) {
            \Log::error('[RECEIVED] Exception: '.$e->getMessage().' at '.$e->getFile().':'.$e->getLine());
        }
            // Notify admins that workshop has received the item
            try {
                $adminIds = \App\Models\Admin::where('role_type', 21)->pluck('id');
                // Notify admins with a descriptive title that includes the workshop name
                $workshopUser = Auth::guard('workshop')->user();
                $workshopName = $workshopUser->company_name ?? $workshopUser->name ?? 'Workshop';
                foreach ($adminIds as $adminId) {
                    Notification::create([
                        'user_id'  => $adminId,
                        'order_id' => $order_item->order_id,
                        'title'    => "📦 Item Received – {$workshopName}",
                        'message'  => "Workshop '{$workshopName}' has confirmed receipt of an item for Order #{$order_item->order_id}.",
                        'sound'    => 'received.mp3',
                    ]);
                }
            } catch (\Exception $e) {
                \Log::error('[ADMIN RECEIVED NOTIF] Exception: '.$e->getMessage().' at '.$e->getFile().':'.$e->getLine());
            }
        
        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Received Successfully!']);
        return redirect()->route('workshop.orders');
    }



    public function create()
    {
        $this->isAdd = true;
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

    public function createOrder($order_id, $total_amount)
    {
        // echo "<pre>";print_r($order_id);
        // echo "<pre>";print_r($total_amount);die;

        $api_key = config('services.razorpay.key');
        $api_secret = config('services.razorpay.secret');
        
        $api = new Api($api_key, $api_secret);

        $orderData = [
            'amount' => (int) $total_amount * 100, // Convert to paise
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

        // Store database order IDs instead of Razorpay order ID
        $dbOrderId = $paymentResponse['order_id'] ?? null;

        $payment = Payment::create([
            'payment_id' => $paymentResponse['razorpay_payment_id'],
            'order_id' => $dbOrderId,
            'status' => 'success',
            'amount' => $paymentResponse['amount'],
            'user_id' => Auth::guard('workshop')->user()->id,
        ]);

        // $dbOrderId already set above (database integer order ID from JS)

        // Mark selected OrderItems as paid using $this->payabaleOrderId if available
        // Otherwise fall back to all unpaid items in the order
        if (!empty($this->payabaleOrderId)) {
            $paidItems = OrderItem::whereIn('id', $this->payabaleOrderId)->get();
        } elseif ($dbOrderId) {
            // Fallback: fetch all accepted but unpaid items for this order
            $paidItems = OrderItem::where('order_id', $dbOrderId)
                ->where('status', 1)
                ->where('payment_status', 0)
                ->get();
        } else {
            $paidItems = collect();
        }

        foreach ($paidItems as $orderItem) {
            $orderItem->payment_status = 1;
            $orderItem->save();
        }

        // Get all order items related to the affected orders
        $orderIds = $paidItems->pluck('order_id')->unique();
        $allOrderItems = OrderItem::whereIn('order_id', $orderIds)->get();
        $order = Order::whereIn('id', $orderIds)->first();

        if ($order) {
            $statusCounts = $allOrderItems->groupBy('status')->map->count();
            $paymentStatusCount = $allOrderItems->where('payment_status', 1)->count();

            $allPending = $statusCounts[0] ?? 0;
            $allDeclined = $statusCounts[2] ?? 0;
            $statusOneItems = $statusCounts[1] ?? 0;

            if ($allPending == 0 && $allDeclined == 0) {
                $order->payment_status = ($statusOneItems == $paymentStatusCount) ? 1 : 2;
            } else {
                $order->payment_status = ($allPending > 0) ? 2 : 1;
            }

            $order->is_cart = ($order->payment_status == 1) ? 1 : $order->is_cart;
            $order->payment_id = $payment->id;
            $order->save();
        }

        // Notify all sparepart vendors that payment was made
        // Use paidItems to get vendor IDs reliably
        $vendorIds = $paidItems->pluck('user_id')->unique()->filter();

        // Fallback: if paidItems is empty, try fetching by order_id directly
        if ($vendorIds->isEmpty() && $dbOrderId) {
            $vendorIds = OrderItem::where('order_id', $dbOrderId)
                ->pluck('user_id')
                ->unique()
                ->filter();
        }

        $workshopName = Auth::guard('workshop')->user()->company_name
            ?? Auth::guard('workshop')->user()->name
            ?? 'Workshop';

        $finalOrderId = $order ? $order->id : $dbOrderId;

        foreach ($vendorIds as $vendorId) {
            Notification::create([
                'user_id' => $vendorId,
                'order_id' => $finalOrderId,
                'title'   => '💰 Payment Received',
                'message' => "Workshop '{$workshopName}' has successfully made a payment for Order #{$finalOrderId}. Please check your orders.",
                'sound'   => 'payment.mp3',
            ]);
        }
            // Notify admins about the payment receipt as well
            $adminIds = \App\Models\Admin::where('role_type', 21)->pluck('id');
            // Notify admins with a clear title indicating the workshop and order
            foreach ($adminIds as $adminId) {
                Notification::create([
                    'user_id' => $adminId,
                    'order_id' => $finalOrderId,
                    'title'   => "💰 Payment Received – {$workshopName}",
                    'message' => "Workshop '{$workshopName}' has completed payment for Order #{$finalOrderId}.",
                    'sound'   => 'payment.mp3',
                ]);
            }


        $this->dispatch('swal:toast', [
            'type' => 'success',
            'title' => "Payment Paid successfully!",
        ]);
        return redirect()->route('workshop.orders');
    }


    public function confirmDelete($id)
    {
        $this->deleteItemId = $id;
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
        $orderItem =  OrderItem::with('order')->find($this->deleteItemId);
        $order = Order::where('id', $orderItem->order_id)->first();
        $order->total_quantity -= $orderItem->quantity;
        // $order->orderItem -= $orderItem->price;    
        $order->total_amount -= $orderItem->price;    
        $order->save();
        OrderItem::destroy($this->deleteItemId);
        $this->order_items = $this->order_items->reject(function ($item) {
            return $item->id == $this->deleteItemId;
        });
        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Item has been removed successfully!']);
        $this->reset('deleteItemId');
    }

    public function showdeclineorder($id, $status)
    {

        $this->showReasonModel = true;
        $this->sotreStatusValue[] = $id;
        $this->sotreStatusValue[] = $status;
        $order = OrderItem::where('id', $id)->first();
        $this->decline_reason = $order->reason;
        if ($status == 5) {
            $this->statusReason = 'Delayed';
        } else {
            $this->statusReason = 'Decline';
        }

    }

    public function declineorder($id, $status)
    {

        $this->showReasonModel = true;
        $this->sotreStatusValue[] = $id;
        $this->sotreStatusValue[] = $status;
        if ($status == 5) {
            $this->statusReason = 'Delayed';
        } else {
            $this->statusReason = 'Decline';
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

    public function confirmOrder($id)
    {
        $this->orderId = $id;
        $this->dispatch('swal:confirm', [
            'title' => 'Are you sure?',
            'text' => 'This action cannot be undone.',
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonText' => 'Yes, Confirm it!',
            'cancelButtonText' => 'Cancel',
            'action' => 'orderConfirmed',
        ]);
    }

    public function clodeReasonModel()
    {
        $this->showReasonModel = false;
        $this->decline_reason = '';
        $this->statusReason = '';
        $this->sotreStatusValue = [];
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
                $order->payment_status = 1;
            }

            $order->save();
            }

            // ------------------------------------------------------------
            // 5️⃣  Notify admins about the vendor's action (accept/decline)
            // ------------------------------------------------------------
            try {
                $adminIds = \App\Models\Admin::where('role_type', 21)->pluck('id');
                $workshopUser = Auth::guard('workshop')->user();
                $workshopName = $workshopUser->company_name ?? $workshopUser->name ?? 'Workshop';
                $vendor = \App\Models\SparePartVendor::find($order_item->user_id);
                $vendorName = $vendor->company_name ?? $vendor->name ?? 'Spare‑part Vendor';
                $partName = $order_item->SpareParts->name ?? 'Item';
                $action = $status == 1 ? 'accepted' : 'declined';
                $title = $status == 1 ? '✅ Order Item Accepted' : '❌ Order Item Declined';
                $message = "Spare‑part vendor {$vendorName} has {$action} the order item '{$partName}' for Order #{$order_item->order_id} placed by workshop {$workshopName}.";

                foreach ($adminIds as $adminId) {
                    Notification::create([
                        'user_id' => $adminId,
                        'order_id' => $order_item->order_id,
                        'title' => $title,
                        'message' => $message,
                        'sound' => 'order_update.mp3',
                    ]);
                }
            } catch (\Exception $e) {
                \Log::error('[ADMIN ORDER ITEM NOTIF] '.$e->getMessage().' at '.$e->getFile().':'.$e->getLine());
            }

            if ($status == 1) {
                $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Order Item Accepted!']);
            } else {
                $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Order Item Declined!']);
            }
    }

    public function orderConfirmed()
    {
        $order = Order::findOrFail($this->orderId);
        $order->update(['is_confim' => 1, 'order_date' => now()]);

        $orderItems = \App\Models\OrderItem::where('order_id', $order->id)->get();
        $vendorIds = $orderItems->pluck('user_id')->unique(); // user_id refers to spare‑part vendor
        // Notify each spare‑part vendor about the new order
        foreach ($vendorIds as $vendorId) {
            \App\Models\Notification::create([
                'user_id' => $vendorId,
                'order_id' => $order->id,
                'title'   => '🛒 New Order Received',
                'message' => "Workshop has placed a new order (Order #{$order->id}). Please review the order items and accept or decline them.",
                'sound'   => 'order.mp3',
            ]);
        }

        // ------------------------------------------------------------
        // 7️⃣  Notify the workshop itself that the order has been placed
        // ------------------------------------------------------------
        try {
            $workshopUser = Auth::guard('workshop')->user();
            $workshopName = $workshopUser->company_name ?? $workshopUser->name ?? 'Workshop';
            Notification::create([
                'user_id' => $workshopUser->id,
                'order_id' => $order->id,
                'title'   => "🛒 Order Placed – {$workshopName}",
                'message' => "Your order (Order #{$order->id}) has been successfully placed and sent to the relevant spare‑part vendors.",
                'sound'   => 'order.mp3',
            ]);
        } catch (\Exception $e) {
            \Log::error('[WORKSHOP ORDER NOTIF] '.$e->getMessage().' at '.$e->getFile().':'.$e->getLine());
        }

        // ------------------------------------------------------------
        // 6️⃣  Also notify admins about the same order placement
        // ------------------------------------------------------------
        // ------------------------------------------------------------
        // 6️⃣  Also notify admins about the same order placement
        // ------------------------------------------------------------
        // Provide a clear title that shows which workshop placed the order
        // and which spare‑part vendor is the recipient.
        try {
            $adminIds = \App\Models\Admin::where('role_type', 21)->pluck('id');
            $workshopUser = Auth::guard('workshop')->user();
            $workshopName = $workshopUser->company_name ?? $workshopUser->name ?? 'Workshop';
            foreach ($vendorIds as $vendorId) {
                $vendor = \App\Models\SparePartVendor::find($vendorId);
                $vendorName = $vendor->company_name ?? $vendor->name ?? 'Spare‑part Vendor';
                $title = "🛒 New Order from {$workshopName} to {$vendorName}";
                $message = "Workshop '{$workshopName}' has placed a new order (Order #{$order->id}) for vendor '{$vendorName}'.";
                foreach ($adminIds as $adminId) {
                    \App\Models\Notification::create([
                        'user_id' => $adminId,
                        'order_id' => $order->id,
                        'title'   => $title,
                        'message' => $message,
                        'sound'   => 'order.mp3',
                    ]);
                }
            }
        } catch (\Exception $e) {
            \Log::error('[ADMIN ORDER NOTIF] '.$e->getMessage().' at '.$e->getFile().':'.$e->getLine());
        }

        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Order confirmed successfully!']);
        return redirect()->route('workshop.orders')->with('success', 'Order confirmed successfully!');
    }

    public function shoImage($value)
    {
        $this->imageitem = OrderItem::with('SpareParts')->find($value);
        $this->shoImageModel = true;
    }

    public function clodeImageModel()
    {
        $this->shoImageModel = false;
    }


}
