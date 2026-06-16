<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!--favicon-->
    <link rel="icon" href="{{ asset('assets/images/fevicon.png') }}" type="image/png">
    <!--plugins-->
    <link href="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet">
    <!-- loader-->
    <link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/js/pace.min.js') }}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/dark-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/semi-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/header-colors.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/carnet.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toastr/toastr.min.css') }}">

    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    @yield('style')
    <!-- Scripts -->
    @livewireStyles
</head>

<body>
    <div id="app">
        <div class="wrapper">

            @include('components.includes.sparepart.header')
            @include('components.includes.sparepart.sidebar')

            <div class="page-wrapper">
                <div class="page-content">
                    {{ $slot }}
                </div>
            </div>

            <!-- Bell Modal for Order Notifications -->
            <div class="modal fade" id="bellModal" tabindex="-1" aria-hidden="true" role="dialog" aria-labelledby="bellModalLabel" data-bs-backdrop="static" data-bs-keyboard="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body text-center py-4">
                            <audio id="bellSound" src="{{ asset('img/audio/traveloka.mp3') }}"></audio>
                            <p>Your order, please check <span class="badge bg-info">{{ checkOrder(Auth::guard('sparepart')->user()->id) }}</span></p>
                            <i class="fa-solid fa-bell bell-icon ring" style="font-size: 35px; color: #ffcc00;"></i>
                            <div class="mt-3">
                                <form method="POST" action="{{ route('sparepart.update-order-check') }}" onsubmit="closepopup()">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">OK</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bell Sound -->
            @include('components.includes.admin.footer')
        </div>
    </div>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <!--plugins-->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <!--app JS-->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('assets/plugins/chartjs/js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/chartjs/js/Chart.extension.js') }}"></script>
    <script src="{{ asset('assets/plugins/sparkline-charts/jquery.sparkline.min.js') }}"></script>
    <!--Morris JavaScript -->
    <script src="{{ asset('assets/plugins/raphael/raphael-min.js') }}"></script>
    <script src="{{ asset('assets/plugins/morris/js/morris.js') }}"></script>
    <script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/js/crud.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    @livewireScripts

    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        // Global variables for notification handling
        let notificationInterval = null;
        let isFetching = false;
        let bellModalInterval = null;

        // Notification handling for sparepart users
        function checkNewOrders() {
            const userId = {{ auth()->guard('sparepart')->id() ?? 'null' }};
            if (!userId) return;

            // Prevent multiple simultaneous requests
            if (isFetching) {
                // console.log('Already fetching notifications, skipping...');
                return;
            }

            isFetching = true;

            fetch(`/sparepart/get-notifications`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    credentials: 'same-origin'
                })
                .then(res => res.json())
                .then(data => {
                    // console.log('Notification fetch result:', data);
                    if (!data.status) return;
                    
                    const notifications = Array.isArray(data.data) ? data.data : [];
                    
                    // Update badge and dropdown list
                    const notifCountEl = document.getElementById('notif-count');
                    const notifListEl = document.getElementById('notification-list');
 
                    if (notifCountEl && notifListEl) {
                        const unread = notifications.filter(n => !n.is_read);
                        notifCountEl.textContent = unread.length;
 
                        notifListEl.innerHTML = '';
                        if (unread.length === 0) {
                            const li = document.createElement('li');
                            li.className = 'dropdown-item text-center text-muted small py-2';
                            li.textContent = 'No new notifications';
                            notifListEl.appendChild(li);
                        } else {
                            unread.slice(0, 10).forEach(n => {
                                const li = document.createElement('li');
                                li.className = 'dropdown-item border-bottom py-2';
                                li.innerHTML = `
                                    <div class="d-flex justify-content-between align-items-center gap-2">
                                        <div style="flex-grow: 1; min-width: 0;">
                                            <strong class="text-wrap d-block text-dark" style="font-size: 0.85rem;">${escapeHtml(n.title)}</strong>
                                            <small class="text-wrap text-secondary d-block" style="font-size: 0.75rem; line-height: 1.2;">${escapeHtml(n.message)}</small>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-light border-0 p-1" onclick="event.stopPropagation(); markHeaderNotifAsReadSp(${n.id})" title="Mark as read" style="min-width: 26px; height: 26px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                            <i class="bx bx-check text-success fs-5"></i>
                                        </button>
                                    </div>
                                `;
                                notifListEl.appendChild(li);
                            });
                        }
                    }
                    
                    const unreadList = notifications.filter(n => n && n.is_read == 0);
                    
                    if (unreadList.length > 0) {
                        const lastSeenId = Number(localStorage.getItem('lastSparepartNotifId') || 0);
                        const newUnread = unreadList.filter(n => Number(n.id) > lastSeenId);
                        const hasShownThisLoad = sessionStorage.getItem('sparepartNotificationModalShown') === '1';
                        const maxUnreadId = Math.max(...unreadList.map(n => Number(n.id)));
                        const modalNotification = newUnread.length > 0
                            ? newUnread[0]
                            : (!hasShownThisLoad ? unreadList[0] : null);

                        if (modalNotification) {
                            showNotificationModal(modalNotification);
                            sessionStorage.setItem('sparepartNotificationModalShown', '1');
                            localStorage.setItem('lastSparepartNotifId', String(maxUnreadId));
                        }
                    }
                })
                .catch(err => {
                    // console.error('Notification check error', err)
                })
                .finally(() => {
                    isFetching = false;
                });
        }
 
        function markHeaderNotifAsReadSp(id) {
            const url = `/sparepart/notifications/${id}/read`;
            fetch(url, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                credentials: 'same-origin'
            })
            .then(async response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.status) {
                    checkNewOrders();
                    if (typeof Livewire !== 'undefined') {
                        Livewire.dispatch('refreshNotifications');
                    }
                }
            })
            .catch(err => {
                console.error('Error marking notification as read:', err);
            });
        }

        function showNotificationModal(notification) {
            // Remove existing modal if any
            const existingModal = document.getElementById('orderNotificationModal');
            if (existingModal) {
                existingModal.remove();
            }
            
            const orderId = notification.order_id || null;
            const modalHtml = `
                <div class="modal fade" id="orderNotificationModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body text-center py-4">
                                <i class="fa-solid fa-bell bell-icon" style="font-size: 35px; color: #ffcc00;"></i>
                                <h5 class="mt-3">${escapeHtml(notification.title)}</h5>
                                <p>${escapeHtml(notification.message)}</p>
                                <button type="button" class="btn btn-primary" onclick="handleNotificationModalActionSp(${JSON.stringify(orderId)})">
                                    ${orderId ? 'View Order' : 'OK'}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            document.body.insertAdjacentHTML('beforeend', modalHtml);
            const modalEl = document.getElementById('orderNotificationModal');
            const modal = new bootstrap.Modal(modalEl);

            modalEl.addEventListener('hide.bs.modal', () => {
                if (document.activeElement && modalEl.contains(document.activeElement)) {
                    document.activeElement.blur();
                }
            });

            modalEl.addEventListener('hidden.bs.modal', () => {
                modalEl.remove();

                const bell = document.getElementById('notificationDropdown');
                if (bell) {
                    bell.focus({ preventScroll: true });
                }
            });

            modal.show();
        }

        function handleNotificationModalActionSp(orderId) {
            const modal = bootstrap.Modal.getInstance(document.getElementById('orderNotificationModal'));
            if (modal) modal.hide();

            if (orderId) {
                window.location.href = `/sparepart/order`;
            }
        }

        // Helper function to escape HTML
        function escapeHtml(text) {
            if (!text) return '';
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        // Function to stop notification interval
        function stopNotificationInterval() {
            if (notificationInterval) {
                clearInterval(notificationInterval);
                notificationInterval = null;
                // console.log('Notification interval stopped');
            }
        }

        // Function to start notification interval
        function startNotificationInterval() {
            if (notificationInterval) {
                // console.log('Notification interval already running');
                return;
            }
            notificationInterval = setInterval(checkNewOrders, 10000);
            // console.log('Notification interval started');
        }

        // Bell Modal Functions
        function openBellModal() {
            let sound = document.getElementById("bellSound");
            let modalElement = document.getElementById("bellModal");
            
            if (!modalElement) return;
            
            let modal = new bootstrap.Modal(modalElement);
            modal.show();

            // Play bell sound
            if (sound) {
                sound.currentTime = 0;
                sound.play().catch(error => {
                    // console.log("Audio play error:", error)
                });
            }
        }

        function closepopup() {
            let modal = bootstrap.Modal.getInstance(document.getElementById("bellModal"));
            if (modal) modal.hide();

            setTimeout(() => {
                window.location.href = "{{ route('sparepart.order') }}";
            }, 500);

            return true;
        }

        // Function to stop bell modal interval
        function stopBellModalInterval() {
            if (bellModalInterval) {
                clearInterval(bellModalInterval);
                bellModalInterval = null;
                // console.log('Bell modal interval stopped');
            }
        }

        // Function to start bell modal interval
        function startBellModalInterval() {
            @if(Auth::guard('sparepart')->check() && checkOrder(Auth::guard('sparepart')->user()->id) > 0)
                if (!bellModalInterval) {
                    bellModalInterval = setInterval(() => {
                        openBellModal();
                    }, 3000);
                    // console.log('Bell modal interval started');
                }
            @endif
        }

        // Initialize all notifications
        function initNotifications() {
            // Initial check for new orders
            checkNewOrders();
            // Start notification interval
            startNotificationInterval();
            // Start bell modal interval if needed
            startBellModalInterval();
        }

        // Handle Livewire navigation if Livewire is present
        if (typeof Livewire !== 'undefined') {
            document.addEventListener('livewire:navigating', () => {
                // console.log('Livewire navigating - stopping all intervals');
                stopNotificationInterval();
                stopBellModalInterval();
            });

            document.addEventListener('livewire:navigated', () => {
                // console.log('Livewire navigated - restarting intervals');
                initNotifications();
            });
        }

        // Handle regular page navigation
        window.addEventListener('beforeunload', function() {
            stopNotificationInterval();
            stopBellModalInterval();
        });

        // Start when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            initNotifications();
        });

        // SweetAlert and Livewire event handlers
        document.addEventListener('swal:confirm', event => {
            const { action, title, text, icon, showCancelButton, confirmButtonText } = event.detail[0];

            Swal.fire({
                title: title,
                text: text,
                icon: icon,
                showCancelButton: showCancelButton,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: confirmButtonText,
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch(action);
                }
            });
        });

        window.addEventListener('swal:toast', event => {
            Toast.fire({
                title: event.detail[0].title,
                text: event.detail[0].message,
                icon: event.detail[0].type,
            });
        });

        window.addEventListener('bs:openmodal', event => {
            $("#" + event.detail.modal).modal("show");
        });

        window.addEventListener('bs:hidemodal', event => {
            $("#" + event.detail.modal).modal("hide");
        });

        @if (Session::has('success'))
            Toast.fire({
                title: '{!! Session::get('success') !!}',
                icon: "success",
                showCloseButton: true,
            });
        @endif
        @if (Session::has('error'))
            Toast.fire({
                title: '{!! Session::get('error') !!}',
                icon: "error",
                showCloseButton: true,
            });
        @endif
        @if (Session::has('warning'))
            Toast.fire({
                title: '{!! Session::get('warning') !!}',
                icon: "warning",
                showCloseButton: true,
            });
        @endif
        @if (Session::has('info'))
            Toast.fire({
                title: '{!! Session::get('info') !!}',
                icon: "info",
                showCloseButton: true,
            });
        @endif

        $(document).ready(function() {
            $(".dropdown > a").click(function(e) {
                e.preventDefault();
                $(this).next(".dropdown-content").slideToggle()
                    .parent().siblings().find(".dropdown-content").slideUp();
                $(this).find(".dropdown-right-icon").toggleClass("fa-chevron-right fa-chevron-down")
                    .closest(".dropdown").siblings().find(".dropdown-right-icon").removeClass(
                        "fa-chevron-down").addClass("fa-chevron-right");
            });
        });
    </script>

    <!-- Hidden audio element for notification sounds -->
    <audio id="notification-audio" style="display:none;"></audio>

    @include('components.includes.searchable-select-script')
    @yield('footerscript')
</body>

</html>