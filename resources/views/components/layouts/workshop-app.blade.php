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
    <style>
        /* Brand the global navigation / Livewire progress indicator. */
        .pace .pace-progress { background: #e53935 !important; }
        .pace .pace-progress-inner { box-shadow: 0 0 10px #e53935, 0 0 5px #e53935 !important; }
        .pace .pace-activity { border-top-color: #e53935 !important; border-left-color: #e53935 !important; }

        /* Brand Select2 highlight/selected color to Carnate Red */
        .select2-container--default .select2-results__option--highlighted[aria-selected],
        .select2-container--default .select2-results__option--highlighted,
        .select2-container--default .select2-results__option[aria-selected="true"],
        .select2-container--bootstrap4 .select2-results__option--highlighted,
        .select2-container--bootstrap4 .select2-results__option--highlighted.select2-results__option[aria-selected="true"],
        .select2-container--bootstrap4 .select2-dropdown .select2-results__option[aria-selected="true"],
        .select2-results__option--highlighted,
        .select2-results__option[aria-selected="true"] {
            background-color: #e53935 !important;
            color: #ffffff !important;
        }

        .select2-container--default.select2-container--focus .select2-selection--single,
        .select2-container--default.select2-container--open .select2-selection--single,
        .select2-container--bootstrap4.select2-container--focus .select2-selection--single,
        .select2-container--bootstrap4.select2-container--open .select2-selection--single {
            border-color: rgba(229, 57, 53, 0.6) !important;
            box-shadow: 0 0 0 3px rgba(229, 57, 53, 0.12) !important;
        }

        .select2-container--default .select2-search--dropdown .select2-search__field:focus,
        .select2-container--bootstrap4 .select2-search--dropdown .select2-search__field:focus {
            border-color: rgba(229, 57, 53, 0.6) !important;
            outline: none !important;
            box-shadow: 0 0 0 3px rgba(229, 57, 53, 0.12) !important;
        }

        /* Remove spinner arrows from number inputs across all browsers */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none !important;
            margin: 0 !important;
        }
        input[type="number"] {
            -moz-appearance: textfield !important;
            appearance: textfield !important;
        }

        /* Mobile / Tablet Sidebar Backdrop Overlay */
        .overlay {
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: rgba(15, 23, 42, 0.55);
            backdrop-filter: blur(2px);
            z-index: 1055;
            display: none;
            cursor: pointer;
        }
        .wrapper.toggled .overlay {
            display: block;
        }
        @media (min-width: 1025px) {
            .wrapper.toggled .overlay {
                display: none !important;
            }
        }
    </style>
    <script src="{{ asset('assets/js/pace.min.js') }}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link href="{{ asset('assets/css/vehicle_search.css') }}" rel="stylesheet">
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
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
    @yield('style')
    <!-- Scripts -->
    @livewireStyles
</head>

<body>
    <div id="app">
        <div class="wrapper">
            @include('components.includes.workshop.header')
            @include('components.includes.workshop.sidebar')

            <div class="page-wrapper">
                <div class="page-content">
                    {{ $slot }}
                </div>
            </div>

            <!-- Mobile sidebar backdrop overlay -->
            <div class="overlay nav-toggle-icon"></div>

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
    <script>
        $(document).ready(function() {
            // Ensure exactly one click handler on .mobile-toggle-menu
            $('.mobile-toggle-menu').off('click').on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                $('.wrapper').toggleClass('toggled');
            });
            // Close sidebar when clicking overlay
            $(document).on('click', '.overlay', function(e) {
                e.preventDefault();
                $('.wrapper').removeClass('toggled');
            });
            // Close sidebar when clicking arrow inside sidebar
            $(document).on('click', '.carnate-toggle', function(e) {
                if ($(window).width() <= 1024) {
                    $('.wrapper').removeClass('toggled');
                }
            });
            // Close on escape
            $(document).on('keydown', function(e) {
                if (e.key === 'Escape' && $(window).width() <= 1024) {
                    $('.wrapper').removeClass('toggled');
                }
            });
        });
    </script>
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

        // ==================== SWEET ALERT CONFIRM DIALOG ====================
        document.addEventListener('swal:confirm', event => {
            const {
                action,
                title,
                text,
                icon,
                showCancelButton,
                confirmButtonText
            } = event.detail[0];

            Swal.fire({
                title: title,
                text: text,
                icon: icon,
                showCancelButton: showCancelButton,
                confirmButtonColor: '#e53935',
                cancelButtonColor: '#d33',
                confirmButtonText: confirmButtonText,
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch(action)
                }
            });
        });

        // ==================== TOAST NOTIFICATIONS ====================
        window.addEventListener('swal:toast', event => {
            Toast.fire({
                title: event.detail[0].title,
                text: event.detail[0].message,
                icon: event.detail[0].type,
            });
        });

        // ==================== MODAL HANDLERS ====================
        window.addEventListener('bs:openmodal', event => {
            $("#" + event.detail.modal).modal("show");
        });

        window.addEventListener('bs:hidemodal', event => {
            $("#" + event.detail.modal).modal("hide");
        });

        // ==================== NOTIFICATION HANDLING ====================
        let notificationInterval = null;
        let isFetching = false;

        function checkNewOrders() {
            if (isFetching) {
                return;
            }

            isFetching = true;

            const notifUrl = '/workshop/get-notifications';
            const reminderUrl = '/workshop/check-appointment-reminders';

            Promise.all([
                fetch(notifUrl, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    credentials: 'same-origin'
                }).then(async response => {
                    const contentType = response.headers.get('content-type');
                    if (!contentType || !contentType.includes('application/json')) {
                        throw new Error('Server returned non-JSON response');
                    }
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                }),
                fetch(reminderUrl, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    credentials: 'same-origin'
                }).then(async response => {
                    const contentType = response.headers.get('content-type');
                    if (!contentType || !contentType.includes('application/json')) {
                        throw new Error('Server returned non-JSON response');
                    }
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                }).catch(err => {
                    return { status: false, data: [] };
                })
            ]).then(([notifData, reminderData]) => {
                if (!notifData.status) return;

                const notifications = Array.isArray(notifData.data) ? notifData.data : [];

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
                                <button type="button" class="btn btn-sm btn-light border-0 p-1" onclick="event.stopPropagation(); markHeaderNotifAsRead(${n.id})" title="Mark as read" style="min-width: 26px; height: 26px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
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
                    const lastSeenId = Number(localStorage.getItem('lastWorkshopNotifId') || 0);
                    const newUnread = unreadList.filter(n => Number(n.id) > lastSeenId);
                    const hasShownThisLoad = sessionStorage.getItem('workshopNotificationModalShown') === '1';
                    const maxUnreadId = Math.max(...unreadList.map(n => Number(n.id)));
                    const modalNotification = newUnread.length > 0 ?
                        newUnread[0] :
                        (!hasShownThisLoad ? unreadList[0] : null);

                    if (modalNotification) {
                        showNotificationModal(modalNotification);
                        sessionStorage.setItem('workshopNotificationModalShown', '1');
                        localStorage.setItem('lastWorkshopNotifId', String(maxUnreadId));
                    }
                }

                if (reminderData.status && reminderData.data && reminderData.data.length > 0) {
                    const ids = reminderData.data.map(r => Number(r.id));
                    const reminderMaxId = Math.max(...ids);
                    const lastSeenId = Number(localStorage.getItem('lastWorkshopNotifId') || 0);
                    if (reminderMaxId > lastSeenId) {
                        localStorage.setItem('lastWorkshopNotifId', String(reminderMaxId));
                    }

                    const firstReminder = reminderData.data[0];
                    const hasShownThisLoad = sessionStorage.getItem('workshopNotificationModalShown') === '1';
                    if (!hasShownThisLoad && firstReminder) {
                        showNotificationModal(firstReminder);
                        sessionStorage.setItem('workshopNotificationModalShown', '1');
                    }
                }
            })
            .catch(err => {
                // console.error('Notification check error:', err);
                // console.error('Error message:', err.message);
            })
            .finally(() => {
                isFetching = false;
            });
        }

        function markHeaderNotifAsRead(id) {
            const url = `/workshop/notifications/${id}/read`;
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
                                <button type="button" class="btn btn-danger px-4" style="background-color: #e53935; border-color: #e53935; font-weight: 600;" onclick="handleNotificationModalAction(${JSON.stringify(orderId)})">
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
                    bell.focus({
                        preventScroll: true
                    });
                }
            });

            modal.show();
        }

        function handleNotificationModalAction(orderId) {
            const modal = bootstrap.Modal.getInstance(document.getElementById('orderNotificationModal'));
            if (modal) modal.hide();

            if (orderId) {
                window.location.href = `/workshop/order-list`;
            }
        }

        function escapeHtml(text) {
            if (!text) return '';
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        function viewOrderAndClose(orderId) {
            const modal = bootstrap.Modal.getInstance(document.getElementById('orderNotificationModal'));
            if (modal) modal.hide();
            window.location.href = `/workshop/order-list`;
        }

        function stopNotificationInterval() {
            if (notificationInterval) {
                clearInterval(notificationInterval);
                notificationInterval = null;
                // console.log('Notification interval stopped');
            }
        }

        function startNotificationInterval() {
            if (notificationInterval) {
                // console.log('Interval already running');
                return;
            }
            notificationInterval = setInterval(checkNewOrders, 15000);
            // console.log('Notification interval started');
        }

        function initNotifications() {
            const checkInterval = setInterval(() => {
                if (document.getElementById('notif-count')) {
                    // console.log('User logged in, starting notifications');
                    clearInterval(checkInterval);
                    checkNewOrders();
                    startNotificationInterval();
                }
            }, 500);

            setTimeout(() => {
                clearInterval(checkInterval);
            }, 5000);
        }

        // ==================== SESSION MESSAGES ====================
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



        // ==================== LIVEWIRE NAVIGATION HANDLERS ====================
        if (typeof Livewire !== 'undefined') {
            document.addEventListener('livewire:navigating', () => {
                // console.log('Livewire navigating - stopping interval');
                stopNotificationInterval();
            });

            document.addEventListener('livewire:navigated', () => {
                // console.log('Livewire navigated - restarting interval');
                initNotifications();
            });
        }

        window.addEventListener('beforeunload', function() {
            stopNotificationInterval();
        });

        document.addEventListener('DOMContentLoaded', function() {
            initNotifications();
        });
    </script>

    <!-- Hidden audio element for notification sounds -->
    <audio id="notification-audio" style="display:none;"></audio>

    @include('components.includes.searchable-select-script')
    @yield('footerscript')
</body>

</html>
