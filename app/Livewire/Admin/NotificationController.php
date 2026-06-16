<?php

namespace App\Livewire\Admin;

use App\Models\Notification;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Admin;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin-app')]

class NotificationController extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshNotifications' => '$refresh'];

    public function render()
    {
        $adminIds = Admin::where('role_type', 21)->pluck('id');

        $notifications = Notification::whereIn('user_id', $adminIds)
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('livewire.admin.notifications', compact('notifications'));
    }

    public function markAsRead($id)
    {
        $notification = Notification::find($id);

        if (!$notification) {
            return;
        }

        $adminIds = Admin::where('role_type', 21)->pluck('id');

        if ($adminIds->contains($notification->user_id)) {
            $notification->update([
                'is_read' => true
            ]);

            $this->dispatch('swal:toast', [
                'type' => 'success',
                'message' => 'Notification marked as read!'
            ]);
        }
    }

    public function markAllAsRead()
    {
        $adminIds = Admin::where('role_type', 21)->pluck('id');

        Notification::whereIn('user_id', $adminIds)
            ->where('is_read', false)
            ->update([
                'is_read' => true
            ]);

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'message' => 'All notifications marked as read!'
        ]);
    }
}