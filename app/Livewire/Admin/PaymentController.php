<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $adminId,$searchfilter,$status_filter;

    public function mount(){
        $this->adminId = Auth::guard('admin')->user()->id;
    }

    public function render()
    {
        $payments = Payment::with(['user', 'order'])
            ->orderBy('created_at', 'desc')
            ->when(filled($this->searchfilter), function ($query) {
                $query->where(function ($q) {
                    $q->whereHas('user', function ($q) {
                        $q->where('name', 'like', '%' . $this->searchfilter . '%');
                    })
                    ->orWhereHas('order', function ($q) {
                        $q->where('invoice_number', 'like', '%' . $this->searchfilter . '%');
                    })
                    ->orWhereIn('id', function($subQuery) {
                        $subQuery->select('payment_id')
                            ->from('orders')
                            ->where('invoice_number', 'like', '%' . $this->searchfilter . '%');
                    })
                    ->orWhere(function($orQ) {
                        $matchingOrderIds = \App\Models\Order::where('invoice_number', 'like', '%' . $this->searchfilter . '%')
                            ->pluck('id')
                            ->toArray();
                        foreach ($matchingOrderIds as $orderId) {
                            $orQ->orWhereRaw("FIND_IN_SET(?, order_id)", [$orderId])
                                ->orWhere('order_id', '=', (string)$orderId);
                        }
                    })
                    ->orWhere('payment_id', 'like', '%' . $this->searchfilter . '%')
                    ->orWhere('order_id', 'like', '%' . $this->searchfilter . '%')
                    ->orWhere('amount', 'like', '%' . $this->searchfilter . '%');
                });
            })
            ->when(filled($this->status_filter), function ($query) {
                $query->where('status', $this->status_filter);
            })
            ->paginate(10);    


        return view('livewire.admin.payment', compact('payments'));
    }
    
    public function resetFilter(){
        $this->searchfilter ='';
        $this->status_filter ='';
    }

    public function updatedSearchfilter(){
        $this->resetPage();
    }   
    public function updatedStatusFilter(){
        $this->resetPage();
    }   
}
