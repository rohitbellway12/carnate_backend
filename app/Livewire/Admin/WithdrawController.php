<?php

namespace App\Livewire\Admin;

use App\Models\SparePartVendor;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Withdraw;
use App\Models\Notification;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;

class WithdrawController extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $adminId,$searchfilter;
    public $showApproveModal = false;
    public $selectedWithdrawId;
    public $selectedWithdrawAmount;
    public $selectedWithdrawUserId;
    public $transaction_id;

    public $showVendorDetailModal = false;
    public $selectedVendorId;
    public $selectedVendorData;
    public $vendorWithdraws;
    public $vendorWalletHistories;

    public function mount(){
        $this->adminId = Auth::guard('admin')->user()->id;
    }
    public function render()
    {
        $withdrawQuery = Withdraw::with(['SparePartVendor']);

        if ($this->searchfilter) {
            $searchTerm = '%' . $this->searchfilter . '%';
            $withdrawQuery = $withdrawQuery->whereHas('SparePartVendor', function ($query) use ($searchTerm) {
                $query->whereRaw("CONCAT(name, '', lastname) LIKE ?", [$searchTerm]);
            });
        }

        $withdraws = (clone $withdrawQuery)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $withdrawItems = (clone $withdrawQuery)
            ->orderBy('created_at', 'desc')
            ->get();

        $vendors = SparePartVendor::whereIn('id', $withdrawItems->pluck('user_id'))
            ->get()
            ->keyBy('id');

        $groupedWithdraws = $withdrawItems
            ->groupBy('user_id')
            ->map(function ($items, $userId) use ($vendors) {
                $vendor = $vendors->get($userId);
                $vendorName = trim(($vendor->name ?? '') . ' ' . ($vendor->lastname ?? ''));

                return [
                    'user_id' => (int) $userId,
                    'vendor_name' => $vendorName ?: ('Vendor #' . $userId),
                    'wallet_amount' => (float) ($vendor->wallet ?? 0),
                    'total_amount' => $items->sum('amount'),
                    'withdraw_amount' => $items->where('status', 1)->sum('amount'),
                    'balance_amount' => $items->where('status', '!=', 1)->sum('amount'),
                    'withdraws' => $items->values(),
                ];
            })
            ->sortByDesc('total_amount')
            ->values();

        $totalAmount = $groupedWithdraws->sum('total_amount');
        $withdrawAmount = $groupedWithdraws->sum('withdraw_amount');
        $balanceAmount = $groupedWithdraws->sum('balance_amount');

        return view('livewire.admin.withdraw', compact('withdraws', 'groupedWithdraws', 'totalAmount', 'withdrawAmount', 'balanceAmount'));
    }

    public function viewVendorDetail($userId)
    {
        $vendor = SparePartVendor::where('id', $userId)->first();

        if (!$vendor) {
            $this->dispatch('swal:toast', [
                'type' => 'error',
                'message' => 'Vendor not found!',
            ]);
            return;
        }

        $this->selectedVendorId = $userId;
        $this->selectedVendorData = $vendor;

        $this->vendorWithdraws = Withdraw::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        $this->vendorWalletHistories = Wallet::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        $this->showVendorDetailModal = true;
    }

    public function confirmApprove($id, $amount, $user_id)
    {
        $this->selectedWithdrawId = $id;
        $this->selectedWithdrawAmount = $amount;
        $this->selectedWithdrawUserId = $user_id;
        $this->transaction_id = '';
        $this->showApproveModal = true;
    }

    public function approveWithdraw()
    {
        $this->validate([
            'transaction_id' => 'required|string|max:255',
        ]);

        $withdraw = Withdraw::findOrFail($this->selectedWithdrawId);
        $withdraw->status = 1;
        $withdraw->transaction_id = $this->transaction_id;
        $withdraw->save();

        $this->notifySparePartVendor($withdraw, 'Withdrawal Approved', "Your withdrawal request of ₹{$withdraw->amount} has been approved. Transaction ID: {$this->transaction_id}.");

        $this->showApproveModal = false;
        $this->transaction_id = '';

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Withdraw Process Accept Succesfully!',
        ]);
    }

    public function edit($id,$status,$amount,$user_id)
    { 
        if($status == 1){
            $this->confirmApprove($id, $amount, $user_id);
            return;
        }

        $withdraw = Withdraw::findOrFail($id); 
        $withdraw->status = $status;
        $withdraw->save(); 

        $this->notifySparePartVendor($withdraw, 'Withdrawal Declined', "Your withdrawal request of ₹{$withdraw->amount} has been declined by admin.");

        $sparepartvendor = SparePartVendor::where('id', $user_id)->first();
        if ($sparepartvendor) {
            $sparepartvendor->wallet = $sparepartvendor->wallet + $amount;
            $sparepartvendor->save();
        }

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'Withdraw Process Decline Succesfully!',
        ]);
 

    }

    private function notifySparePartVendor(Withdraw $withdraw, string $title, string $message)
    {
        Notification::create([
            'user_id' => $withdraw->user_id,
            'title' => $title,
            'message' => $message,
            'order_id' => null,
            'sound' => 'withdrawal.mp3',
        ]);
    }
    
    public function resetFilter(){
        $this->searchfilter ='';
    }
    public function updatedSearchfilter(){
       $this->resetPage();
    }
}
