<?php

namespace App\Livewire\Workshop;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.workshop-app')]
class NotificationController extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshNotifications' => '$refresh'];

    public function render()
    {
        $workshopId = Auth::guard('workshop')->user()->id;
        
        $notifications = Notification::where('user_id', $workshopId)
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('livewire.workshop.notifications', compact('notifications'));
    }

    public function markAsRead($id)
    {
        $notification = Notification::find($id);
        if ($notification && $notification->user_id == Auth::guard('workshop')->user()->id) {
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
        $workshopId = Auth::guard('workshop')->user()->id;
        Notification::where('user_id', $workshopId)
            ->where('is_read', false)
            ->update(['is_read' => true]);
            
        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'All notifications marked as read!'
        ]);
    }
}
