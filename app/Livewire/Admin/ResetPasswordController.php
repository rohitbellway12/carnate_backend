<?php

namespace App\Livewire\Admin;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ResetPasswordController extends Component
{
    public $old_password,$password,$confirmed;

    public function render()
    {
        return view('livewire.admin.reset_password');
    }

    public function resetpassword(){

        $this->validate([
            'password' => 'required',
            'old_password' => 'required',
            'confirmed' => 'required',
        ]);
        $admin =  Auth::guard('admin')->user();
            $user = Admin::find($admin->id);
            if($this->confirmed == $this->password){
                if (!Hash::check($this->old_password, $user->password)) {
                    return back()->with("message", "Old Password doesn't match");
                }else{
                    $user->password = Hash::make($this->password);
                    $user->save();
                    $this->resetForm();
                    return back()->with('message', "Password updated successfully!");
                    
                }
                return back()->with('message', 'Somthing went to wrong');
            }else{
                return back()->with('message', "confirmed Password doesn't match");
            }
            
    }

    private function resetForm()
    {
        // Reset form fields
        $this->password = '';
        $this->old_password = '';
        $this->confirmed = '';

    }
}   
