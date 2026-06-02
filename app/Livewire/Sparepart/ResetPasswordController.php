<?php

namespace App\Livewire\Sparepart;

use App\Models\SparePartVendor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.spare-part-app')]
class ResetPasswordController extends Component
{
    public $current_password, $password, $password_confirmation;

    public function render()
    {
        return view('livewire.sparepart.reset_password');
    }

    public function resetpassword()
    {

        $this->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::guard('sparepart')->user();

        if (!Hash::check($this->current_password, $user->password)) {
            $this->addError('current_password', "current password doesn't match with our records.");
            $this->dispatch('swal:toast', [
                'type' => 'error',
                'message' => 'Invalid password!',
            ]);
            return;
        } else {
            $user->update([
                'password' => Hash::make($this->password),
            ]);

            $this->reset('password', 'current_password', 'password_confirmation');
            $this->dispatch('swal:toast', [
                'type' => 'success',
                'message' => 'Password updated successfully!',
            ]);
        }

    }
}
