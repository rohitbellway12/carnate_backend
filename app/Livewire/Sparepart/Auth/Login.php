<?php

namespace App\Livewire\Sparepart\Auth;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Session;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.guest')] 
class Login extends Component
{
    public $email;
    public $password;
    public $remember = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    public function mount(){
      
    }
    public function login()
    {  
        $this->validate();

        $vendor = \App\Models\SparePartVendor::where('email', $this->email)->first();
        if ($vendor && $vendor->status != 1) {
            $this->dispatch('swal:toast', ['type' => 'error','title'=>'', 'message' => 'Your login access is disabled.']);
            return;
        }

        if (Auth::guard('sparepart')->attempt(['email' =>  $this->email, 'password' => $this->password])) {
            $this->dispatch('swal:toast', ['type' => 'success','title'=>'', 'message' => 'Login successful!']);
            return redirect()->route('sparepart.dashboard');
        }else{
           $this->dispatch('swal:toast', ['type' => 'error','title'=>'', 'message' => 'Invalid credentials.']);
        }
    }

    public function logout(){
        Auth::guard('sparepart')->logout();
        return redirect()->route('unified.login');
    }

    public function render()
    {
        return view('livewire.sparepart.auth.login');
    }

    
}
