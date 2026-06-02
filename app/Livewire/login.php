<?php

namespace App\Livewire\UnifiedAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\WorkShopVendor;
use App\Models\SparePartVendor;

#[Layout('components.layouts.guest')] 
class Login extends Component
{
    public $email, $phone;
    public $password, $loginType = 0;
    public $remember = false;

    protected $rules = [
        'password' => 'required|min:6',
    ];

    public function mount(){
      
    }

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
            $workshopUser = WorkShopVendor::where('mobile_no', $this->phone)->first();
            $sparepartUser = SparePartVendor::where('mobile_no', $this->phone)->first();
        } else {
            $credentials = ['email' => $this->email, 'password' => $this->password];
            $workshopUser = WorkShopVendor::where('email', $this->email)->first();
            $sparepartUser = SparePartVendor::where('email', $this->email)->first();
        }

        // Check if user exists
        if (!$workshopUser && !$sparepartUser) {
            $this->dispatch('swal:toast', [
                'type' => 'error',
                'title' => '',
                'message' => 'User not found.'
            ]);
            return;
        }

        // Try Workshop login first
        if ($workshopUser) {
            if ($workshopUser->is_login != 1) {
                $this->dispatch('swal:toast', [
                    'type' => 'error',
                    'title' => '',
                    'message' => 'Your login access is disabled.'
                ]);
                return;
            }

            if (Auth::guard('workshop')->attempt($credentials, $this->remember)) {
                $this->dispatch('swal:toast', [
                    'type' => 'success',
                    'title' => '',
                    'message' => 'Login successful!'
                ]);
                return redirect()->route('workshop.dashboard');
            }
        }

        // Try Sparepart login
        if ($sparepartUser) {
            if ($sparepartUser->status != 1) {
                $this->dispatch('swal:toast', [
                    'type' => 'error',
                    'title' => '',
                    'message' => 'Your login access is disabled.'
                ]);
                return;
            }

            if (Auth::guard('sparepart')->attempt($credentials, $this->remember)) {
                $this->dispatch('swal:toast', [
                    'type' => 'success',
                    'title' => '',
                    'message' => 'Login successful!'
                ]);
                return redirect()->route('sparepart.dashboard');
            }
        }

        // If we reach here, credentials were invalid
        $this->dispatch('swal:toast', [
            'type' => 'error',
            'title' => '',
            'message' => 'Invalid credentials.'
        ]);
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

    public function logout(){
        // Logout from both guards
        Auth::guard('workshop')->logout();
        Auth::guard('sparepart')->logout();
        
        // Clear all sessions
        Session::flush();
        
        return redirect()->route('unified.login');
    }

    public function render()
    {
        return view('livewire.unified-auth.login');
    }
} 