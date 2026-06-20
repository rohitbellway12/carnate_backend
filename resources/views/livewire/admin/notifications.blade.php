<div>
    <div class="card shadow-sm border-0 radius-10">
        <div class="card-body p-4">
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center mb-4 gap-3">
                <div>
                    <h4 class="mb-1 text-dark fw-bold">Workshop Notifications</h4>
                    <p class="text-muted mb-0 small">Keep track of your order updates, handovers, and payments.</p>
                </div>
                <div>
                    @if($notifications->where('is_read', false)->count() > 0)
                        <button wire:click="markAllAsRead" class="btn btn-outline-primary radius-30 px-4">
                            <i class="bx bx-check-double me-1"></i>Mark All as Read
                        </button>
                    @endif
                </div>
            </div>

            @if($notifications->count() > 0)
                <div class="list-group list-group-flush gap-2">
                    @foreach($notifications as $notification)
                        <div class="list-group-item border-0 p-3 radius-10 mb-2 transition-all position-relative 
                            {{ !$notification->is_read ? 'bg-light-unread border-start border-4 border-primary' : 'bg-light-read border border-light border-start border-4 border-secondary' }}"
                            style="transition: all 0.2s ease-in-out;">
                            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                                <div class="d-flex gap-3 align-items-start">
                                    <div class="avatar-icon radius-10 p-2 d-flex align-items-center justify-content-center
                                        {{ !$notification->is_read ? 'bg-primary-subtle text-primary' : 'bg-secondary-subtle text-secondary' }}"
                                        style="width: 42px; height: 42px; min-width: 42px;">
                                        <i class="fa-solid fa-bell fs-5"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1 fw-bold text-dark d-flex align-items-center gap-2">
                                            {{ $notification->title }}
                                            @if(!$notification->is_read)
                                                <span class="badge bg-danger rounded-pill px-2 py-1" style="font-size: 0.65rem;">New</span>
                                            @endif
                                        </h6>
                                        <p class="mb-2 text-secondary small">{{ $notification->message }}</p>
                                        <div class="d-flex align-items-center gap-3">
                                            <span class="text-muted small">
                                                <i class="bx bx-time-five me-1"></i>{{ $notification->created_at->diffForHumans() }}
                                            </span>
                                            @if($notification->order_id)
                                                <a href="{{ route('admin.order-list') }}" class="btn btn-link btn-sm p-0 text-primary fw-bold text-decoration-none small">
                                                    <i class="bx bx-show me-1"></i>View Order
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center ps-5 ps-md-0">
                                    @if(!$notification->is_read)
                                        <button wire:click="markAsRead({{ $notification->id }})" 
                                            class="btn btn-sm btn-primary text-white d-flex align-items-center gap-1 radius-30 px-3 py-1.5"
                                            title="Mark as read">
                                            <i class="bx bx-check fs-6"></i> Mark as Read
                                        </button>
                                    @else
                                        <span class="badge bg-light text-secondary border px-3 py-2 radius-30 d-flex align-items-center gap-1">
                                            <i class="bx bx-check-double text-success fs-6"></i> Read
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="pagination-wrapper mt-4">
                    {{ $notifications->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-3 text-secondary">
                        <i class="fa-solid fa-bell-slash fs-1 opacity-25"></i>
                    </div>
                    <h5 class="text-secondary fw-bold">No Notifications Found</h5>
                    <p class="text-muted small">We'll alert you when something active happens.</p>
                </div>
            @endif
        </div>
    </div>
    <style>
        .bg-light-unread {
            background-color: #f0f6ff !important;
        }
        .bg-light-read {
            background-color: #ffffff !important;
        }
        .bg-primary-subtle {
            background-color: #dbeafe !important;
        }
        .bg-secondary-subtle {
            background-color: #f3f4f6 !important;
        }
        .list-group-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
    </style>
</div>
