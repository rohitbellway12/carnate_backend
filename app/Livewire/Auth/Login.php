<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;
    public $remember = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    public function login()
    {
        $this->validate();

        if (Auth::guard('web')->attempt(['email' =>  $this->email, 'password' => $this->password])) {
            session()->flash('success', 'Login successful!');
            // return redirect()->intended('user.dashboard');
            return redirect()->route('user.dashboard');
        }else{
           session()->flash('error', 'Invalid credentials.');
        }
    }

    public function logout(){
        Auth::guard('web')->logout();
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
