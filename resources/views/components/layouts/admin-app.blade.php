<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Admin Dashboard</title>
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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
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
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
    
    @yield('style')
    <!-- Scripts -->
    @livewireStyles
</head>

<body>
    <div id="app">
        <div class="wrapper">
            @include('components.includes.admin.header')
            @include('components.includes.admin.sidebar')

            <div class="page-wrapper">
                <div class="page-content">
                    {{ $slot }}
                </div>
            </div>

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
    <script src="{{ asset('assets/plugins/toastr/toastr.min.js') }} "></script>
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
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: confirmButtonText,
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch(action)
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
            jQuery("#" + event.detail.modal).modal("show");
        });

        window.addEventListener('bs:hidemodal', event => {
            jQuery("#" + event.detail.modal).modal("hide");
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
        // ==================== ADMIN NOTIFICATION HANDLING ====================

let adminNotificationInterval = null;
let adminIsFetching = false;

function checkAdminNotifications() {

    if (adminIsFetching) {
        return;
    }

    const notifCountEl = document.getElementById('notif-count');
    const notifListEl = document.getElementById('notification-list');

    if (!notifCountEl || !notifListEl) {
        return;
    }

    adminIsFetching = true;

    fetch('/admin/get-notifications', {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        credentials: 'same-origin'
    })
    .then(response => {

        if (!response.ok) {
            throw new Error(`HTTP Error ${response.status}`);
        }

        return response.json();
    })
    .then(data => {

        if (!data.status) {
            return;
        }

        const notifications = Array.isArray(data.data)
            ? data.data
            : [];

        const unread = notifications.filter(
            n => Number(n.is_read) === 0
        );

        // Badge Count
        notifCountEl.textContent = unread.length;

        // Dropdown List
        notifListEl.innerHTML = '';

        if (unread.length === 0) {

            const li = document.createElement('li');

            li.className =
                'dropdown-item text-center text-muted small py-2';

            li.textContent = 'No new notifications';

            notifListEl.appendChild(li);

        } else {

            unread.slice(0, 10).forEach(notification => {

                const li = document.createElement('li');

                li.className =
                    'dropdown-item border-bottom py-2';

                li.innerHTML = `
                    <div class="d-flex justify-content-between align-items-center gap-2">
                        <div style="flex-grow:1;min-width:0;">
                            <strong class="text-wrap d-block text-dark"
                                style="font-size:.85rem;">
                                ${escapeHtml(notification.title)}
                            </strong>

                            <small class="text-wrap text-secondary d-block"
                                style="font-size:.75rem;line-height:1.2;">
                                ${escapeHtml(notification.message)}
                            </small>
                        </div>

                        <button
                            type="button"
                            class="btn btn-sm btn-light border-0 p-1"
                            onclick="event.stopPropagation(); markHeaderNotifAsReadSp(${notification.id})"
                            title="Mark as read">

                            <i class="bx bx-check text-success fs-5"></i>

                        </button>
                    </div>
                `;

                notifListEl.appendChild(li);

            });
        }

        // ================= POPUP MODAL =================

        const lastSeenId =
            localStorage.getItem('lastAdminNotifId') || 0;

        const newUnread = unread.filter(
            n => Number(n.id) > Number(lastSeenId)
        );

        if (newUnread.length > 0) {

            showAdminNotificationModal(newUnread[0]);

            localStorage.setItem(
                'lastAdminNotifId',
                Math.max(...unread.map(n => n.id))
            );
        }

    })
    .catch(() => {})
    .finally(() => {
        adminIsFetching = false;
    });
}

// ================= MARK AS READ =================

function markHeaderNotifAsReadSp(id) {

    fetch(`/admin/notifications/${id}/read`, {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector(
                'meta[name="csrf-token"]'
            ).content
        },
        credentials: 'same-origin'
    })
    .then(response => response.json())
    .then(data => {

        if (data.status) {

            checkAdminNotifications();

            if (typeof Livewire !== 'undefined') {
                Livewire.dispatch('refreshNotifications');
            }
        }

    })
    .catch(() => {});
}

// ================= POPUP MODAL =================

function showAdminNotificationModal(notification) {

    const oldModal =
        document.getElementById('adminNotificationModal');

    if (oldModal) {
        oldModal.remove();
    }

    const modalHtml = `
        <div class="modal fade"
            id="adminNotificationModal"
            tabindex="-1"
            data-bs-backdrop="static">

            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content">

                    <div class="modal-body text-center py-4">

                        <i class="fa-solid fa-bell"
                            style="font-size:35px;color:#ffcc00;"></i>

                        <h5 class="mt-3">
                            ${escapeHtml(notification.title)}
                        </h5>

                        <p>
                            ${escapeHtml(notification.message)}
                        </p>

                        <button
                            type="button"
                            class="btn btn-primary"
                            data-bs-dismiss="modal">

                            OK

                        </button>

                    </div>

                </div>

            </div>

        </div>
    `;

    document.body.insertAdjacentHTML(
        'beforeend',
        modalHtml
    );

    const modalEl = document.getElementById(
        'adminNotificationModal'
    );
    const modal = new bootstrap.Modal(modalEl);

    modalEl.addEventListener('hide.bs.modal', () => {
        if (
            document.activeElement &&
            modalEl.contains(document.activeElement)
        ) {
            document.activeElement.blur();
        }
    });

    modalEl.addEventListener('hidden.bs.modal', () => {
        modalEl.remove();

        const bell = document.getElementById(
            'adminNotificationDropdown'
        );

        if (bell) {
            bell.focus({ preventScroll: true });
        }
    });

    modal.show();
}

// ================= INTERVAL =================

function startAdminNotificationInterval() {

    if (adminNotificationInterval) {
        return;
    }

    adminNotificationInterval =
        setInterval(
            checkAdminNotifications,
            15000
        );
}

function stopAdminNotificationInterval() {

    if (adminNotificationInterval) {

        clearInterval(
            adminNotificationInterval
        );

        adminNotificationInterval = null;
    }
}

// ================= INIT =================

function initAdminNotifications() {

    const checkInterval = setInterval(() => {

        if (
            document.getElementById('notif-count')
        ) {

            clearInterval(checkInterval);

            checkAdminNotifications();

            startAdminNotificationInterval();
        }

    }, 500);

    setTimeout(() => {
        clearInterval(checkInterval);
    }, 3000);
}

// ================= HELPER =================

function escapeHtml(text) {

    if (!text) return '';

    const div = document.createElement('div');

    div.textContent = text;

    return div.innerHTML;
}

// ================= LIVEWIRE =================

if (typeof Livewire !== 'undefined') {

    document.addEventListener(
        'livewire:navigating',
        () => {
            stopAdminNotificationInterval();
        }
    );

    document.addEventListener(
        'livewire:navigated',
        () => {
            initAdminNotifications();
        }
    );
}

// ================= PAGE LOAD =================

window.addEventListener(
    'beforeunload',
    function () {
        stopAdminNotificationInterval();
    }
);

document.addEventListener(
    'DOMContentLoaded',
    function () {
        initAdminNotifications();
    }
);
    </script>

    @include('components.includes.searchable-select-script')
    @yield('footerscript')
</body>

</html>
