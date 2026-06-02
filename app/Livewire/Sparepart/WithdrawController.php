<?php
namespace App\Livewire\Sparepart;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Wallet;
use App\Models\Withdraw;
use App\Models\SparePartVendor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.spare-part-app')]
class WithdrawController extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $walletsPage = 1;
    public $withdrawsPage = 1;

    public $user,$user_id, $showModal, $isEdit, $withdraw;
    public $wallet;
    public $vendor_data;

    public function mount()
    {
        $this->user = Auth::guard('sparepart')->user();
        $this->user_id = $this->user->id;

    }

    public function updatingWithdrawsPage()
    {
        $this->resetPage('walletsPage');
    }

    public function updatingWalletsPage()
    {
        $this->resetPage('withdrawsPage');
    }

    public function render()
    {

        $this->wallet = Wallet::where('user_id', $this->user_id)
            ->latest()
            ->first();

        $this->vendor_data = SparePartVendor::where('id', $this->user_id)->first();


        $wallets = Wallet::where('user_id', $this->user_id)
            ->orderBy('created_at', 'desc')
            ->paginate(10, ['*'], 'walletsPage');


        $withdraws = Withdraw::where('user_id', $this->user_id)
            ->orderBy('created_at', 'desc')
            ->paginate(5, ['*'], 'withdrawsPage');

        return view('livewire.sparepart.withdraw', [
            'walletHistories' => $wallets,
            'withdraws' => $withdraws
        ]);
    }


    public function rechargeWallet()
    {
        $this->isEdit = false;
        $this->showModal = true;
    }
    public function updated()
    {
        $this->resetErrorBag();
    }

    public function store()
    {
        $this->validate([
            'withdraw' => 'required|numeric:min:1'
        ]);
    
        if($this->withdraw > $this->user->wallet){
            $this->addError('withdraw', "The withdrawal amount must be less than or equal to the wallet balance.");
            return;
        }

        // dd('saasd');
        Withdraw::create([
            'user_id' => $this->user_id,
            'amount' => $this->withdraw,
            'status' => 0,
            'withdraw_date' => now(),
        ]);

        $amount = $this->vendor_data->wallet - $this->withdraw;

        Wallet::create([
            'user_id' => $this->user_id,
            'amount' => $this->withdraw,
            'total' => $amount,
            'order_id' => 0,
            'type' => 1,
        ]);

        $sparePart = SparePartVendor::where('id', $this->user_id)->first();
        $sparePart->wallet = $amount;
        $sparePart->save();

        $this->withdraw = '';
        $this->showModal = false;
        $this->dispatch('swal:toast', [
            'type' => 'success',
            'title' => 'Withdrawal submitted successfully.',

        ]);

    }

}