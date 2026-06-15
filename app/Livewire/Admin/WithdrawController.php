<?php

namespace App\Livewire\Admin;

use App\Models\SparePartVendor;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Payment;
use App\Models\Withdraw;
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

    public function mount(){
        $this->adminId = Auth::guard('admin')->user()->id;
    }
    public function render()
    {
        $withdraws = Withdraw::with(['SparePartVendor']);

            if ($this->searchfilter) {
                $searchTerm = '%' . $this->searchfilter . '%';

                $withdraws = $withdraws->whereHas('SparePartVendor', function ($query) use ($searchTerm) {
                    $query->whereRaw("CONCAT(name, '', lastname) LIKE ?", [$searchTerm]);
                });
            }

            $withdraws = $withdraws->orderBy('created_at', 'desc')->paginate(10);

        
 
        return view('livewire.admin.withdraw', compact('withdraws'));
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
    
    public function resetFilter(){
        $this->searchfilter ='';
    }
    public function updatedSearchfilter(){
       $this->resetPage();
    }
}
