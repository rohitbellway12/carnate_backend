<?php

namespace App\Livewire\Workshop\Auth;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Session;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.guest')]
class Login extends Component
{
    public $email, $phone;
    public $password, $loginType = 0;
    public $remember = false;

    // public function login()
    // {
    //     $this->resetErrorBag();

    //     $rule = ['password' => 'required|min:6'];
    //     if ($this->loginType == 1) {
    //         $rule['phone'] = 'required|digits:10';
    //     } else {
    //         $rule['email'] = 'required|email';
    //     }
    //     $this->validate($rule);
    
    //     if ($this->loginType == 1) {
    //         $credentials = ['mobile_no' => $this->phone, 'password' => $this->password];
    //     } else {
    //         $credentials = ['email' => $this->email, 'password' => $this->password];
    //     }

    //     if (Auth::guard('workshop')->attempt($credentials,$this->remember)) {
    //         $this->dispatch('swal:toast', [
    //             'type' => 'success',
    //             'title' => '',
    //             'message' => 'Login successful!'
    //         ]);

    //         return redirect()->route('workshop.dashboard');
    //     } else {
    //         $this->dispatch('swal:toast', [
    //             'type' => 'error',
    //             'title' => '',
    //             'message' => 'Invalid credentials.'
    //         ]);
    //     }
    // }
    
    public function login()
{
    $this->resetErrorBag();

    $rule = ['password' => 'required|min:6'];
    if ($this->loginType == 1) {
        $rule['phone'] = 'required|digits:10';
    } else {
        $rule['email'] = 'required|email';
    }
    $this->validate($rule);

    // Prepare credentials
    if ($this->loginType == 1) {
        $credentials = ['mobile_no' => $this->phone, 'password' => $this->password];
        $user = \App\Models\WorkShopVendor::where('mobile_no', $this->phone)->first();
    } else {
        $credentials = ['email' => $this->email, 'password' => $this->password];
        $user = \App\Models\WorkShopVendor::where('email', $this->email)->first();
    }

    // Check if user exists
    if (!$user) {
        $this->dispatch('swal:toast', [
            'type' => 'error',
            'title' => '',
            'message' => 'User not found.'
        ]);
        return;
    }

    // Check if login is enabled
    if ($user->is_login != 1) {
        $this->dispatch('swal:toast', [
            'type' => 'error',
            'title' => '',
            'message' => 'Your login access is disabled.'
        ]);
        return;
    }

    // Attempt to login
    if (Auth::guard('workshop')->attempt($credentials, $this->remember)) {
        $this->dispatch('swal:toast', [
            'type' => 'success',
            'title' => '',
            'message' => 'Login successful!'
        ]);
        return redirect()->route('workshop.dashboard');
    } else {
        $this->dispatch('swal:toast', [
            'type' => 'error',
            'title' => '',
            'message' => 'Invalid credentials.'
        ]);
    }
}

    public function render()
    {
        return view('livewire.workshop.auth.login');
    }
    public function login_type($type)
    {
        if ($type == 1) {
            $this->loginType = 1;
        } else {
            $this->loginType = 0;
        }
        $this->reset('password');
        $this->resetErrorBag();

        $this->dispatch('swal:toast', ['type' => 'success', 'title' => '', 'message' => 'Success!']);
    }

    public function logout()
    {
        Auth::guard('workshop')->logout();
        // return redirect()->route('workshop.login');
        return redirect()->route('unified.login');
    }

}
