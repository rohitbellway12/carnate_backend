<?php

namespace App\Livewire\Sparepart;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.spare-part-app')]
class NotificationController extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshNotifications' => '$refresh'];

    public function render()
    {
        $sparepartId = Auth::guard('sparepart')->user()->id;
        
        $notifications = Notification::where('user_id', $sparepartId)
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('livewire.sparepart.notifications', compact('notifications'));
    }

    public function markAsRead($id)
    {
        $notification = Notification::find($id);
        if ($notification && $notification->user_id == Auth::guard('sparepart')->user()->id) {
            $notification->is_read = true;
            $notification->save();
            $this->dispatch('swal:toast', [
                'type' => 'success',
                'message' => 'Notification marked as read!'
            ]);
        }
    }

    public function markAllAsRead()
    {
        $sparepartId = Auth::guard('sparepart')->user()->id;
        Notification::where('user_id', $sparepartId)
            ->where('is_read', false)
            ->update(['is_read' => true]);
            
        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'All notifications marked as read!'
        ]);
    }
}
