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

    public function edit($id,$status,$amount,$user_id)
    { 
        $withdraw = Withdraw::findOrFail($id); 
        $withdraw->status = $status;
        $withdraw->save(); 

        if($status == 1){
            $this->dispatch('swal:toast', [
                'type' => 'success',
                'message' => 'Withdraw Process Accept Succesfully!',
            ]);
        }else{


           $sparepartvendor = SparePartVendor::where('id', $user_id)->first();
           $sparepartvendor->wallet = $sparepartvendor->wallet + $amount;
           $sparepartvendor->save();

            $this->dispatch('swal:toast', [
                'type' => 'success',
                'message' => 'Withdraw Process Decline Succesfully!',
            ]);
        }
 

    }
    
    public function resetFilter(){
        $this->searchfilter ='';
    }
    public function updatedSearchfilter(){
       $this->resetPage();
    }
}
