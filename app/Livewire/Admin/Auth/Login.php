<?php

namespace App\Livewire\Admin\Auth;
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

        if (Auth::guard('admin')->attempt(['email' =>  $this->email, 'password' => $this->password])) {
            $this->dispatch('swal:toast', ['type' => 'success','title'=>'', 'message' => 'Login successful!']);
            return redirect()->route('admin.dashboard');
        }else{
           $this->dispatch('swal:toast', ['type' => 'error','title'=>'', 'message' => 'Invalid credentials.']);
        }
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function render()
    {
        return view('livewire.admin.auth.login');
    }

    
}
