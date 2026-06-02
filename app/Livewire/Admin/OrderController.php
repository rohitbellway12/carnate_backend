<?php

namespace App\Livewire\Admin;

use App\Models\Admin;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\SparePartVendor;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class OrderController extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $showOrderItem = false;
    public $currentUser, $orderId, $showReasonModel, $decline_reason, $status, $searchfilter, $sotreStatusValue, $statusReason, $startDate, $endDate, $shoImageModel = false, $imageitem;
    public $showInvoiceModal = false, $invoiceId;

    public $invoiceType = 0, $spareInvoice, $sparePartVendor;

    public function render()
    {
        if ($this->showOrderItem) {
            // $orders = Order::with([ 'orderItem' ])->find($this->orderId);
            $orders = Order::with(['orderItem.sparePartVendor', 'workShopVendor', 'sparePartVendor'])->where('is_confim', 1)->find($this->orderId);
        } else {
            $orders = Order::with([
                'orderItem'
            ])->where('is_confim', 1);
            if ($this->searchfilter) {
                $orders = $orders->where('id', $this->searchfilter);

            }
            if ($this->startDate || $this->endDate) {
                $orders = $orders->whereRaw('DATE(order_date) BETWEEN ? AND ?', [$this->startDate, $this->endDate]);
            }
            $orders = $orders->orderBy('created_at', 'desc')
                ->paginate(10);
        }

        return view('livewire.admin.order', compact('orders'));
    }

    public function view($id)
    {
        $this->showOrderItem = true;
        $this->orderId = $id;

    }

    public function pdtPopUp()
    {

    }

    public function back()
    {
        $this->showOrderItem = false;
        $this->orderId = '';
    }

    public function resetFilter()
    {
        $this->searchfilter = '';
        $this->startDate = '';
        $this->endDate = '';
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

    public function shoImage($value)
    {
        $this->imageitem = OrderItem::with('SpareParts')->find($value);
        $this->shoImageModel = true;
    }

    public function clodeImageModel()
    {
        $this->shoImageModel = false;
    }

    public function invoice($id)
    {
        $this->showInvoiceModal = true;
        $this->invoiceId = $id;
    }
    public function closeInvoiceModal()
    {
        $this->reset('showInvoiceModal', 'invoiceId','spareInvoice','sparePartVendor','invoiceType');
    }
    public function updatedInvoiceType($value)
    {
        if ($value == 1) {
            $this->spareInvoice = true;
            $this->sparePartVendor = OrderItem::with('sparePartVendor')
                ->where('order_id', $this->invoiceId)
                ->get()
                ->mapWithKeys(fn($item) => [
                    $item->sparePartVendor->id ?? null =>
                        trim(($item->sparePartVendor->name ?? '') . ' ' . ($item->sparePartVendor->lastname ?? ''))
                ])
                ->filter();

        } else {
            $this->reset('spareInvoice', 'sparePartVendor');
        }
    }

    public function sparePartInvoice($spareId, $invoiceType)
    {
        $sparepartId = $spareId;
        $ordertId = $this->invoiceId;

        $order = Order::with([
            'orderItem' => function ($qry) use ($sparepartId) {
                $qry->where('user_id', $sparepartId);
            }
        ])->findOrFail($ordertId);


        $sparepartItemId = $order->orderItem->pluck('id')->toArray();
        $sparepartItemId = implode('-', $sparepartItemId);
        
        if($invoiceType == 0){
            $this->dispatch('swal:toast', [
                'type' => 'success',
                'message' => 'Invoice Downloaded successfully.',
            ]);
        }
        
        $this->reset('showInvoiceModal', 'invoiceId','spareInvoice','sparePartVendor','invoiceType');
        $this->dispatch('downloadInvoice', route('getSparePartinvoPdf',[encrypt($sparepartId), encrypt($sparepartItemId), encrypt($ordertId), encrypt($invoiceType)]));
        // return;
        // return redirect()->route('getSparePartinvoPdf', [encrypt($sparepartId), encrypt($sparepartItemId), encrypt($ordertId), encrypt($invoiceType)]);
    }
}