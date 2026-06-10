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
    <link rel="stylesheet" href="{{ asset('assets/css/customcustomer.min.css') }}">
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
        <div class="content">
            @include('components.includes.customer.header')
            @include('components.includes.customer.sidebar')

            <div class="page-wrapper">
                <div class="page-content"> 
                    @yield('content')
                </div>
            </div>

            @include('components.includes.customer.footer')
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
    {{-- <script src="{{ asset("assets/js/index2.js") }}"></script> --}}
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

            //console.log(window.Livewire);

            // Destructure the event detail correctly
            const {
                action,
                title,
                text,
                icon,
                showCancelButton,
                confirmButtonText
            } = event.detail[0];

            // Show the confirmation Swal dialog
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
    </script>

    <!-- Notification handling script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Determine the logged‑in user ID for the appropriate guard (workshop, sparepart or default web)
            const userId = {{ Auth::guard('workshop')->id() ?? Auth::guard('sparepart')->id() ?? auth()->id() ?? 'null' }};
            if (!userId) return;

            const notifCountEl = document.getElementById('notif-count');
            const notifListEl = document.getElementById('notification-list');
            const audioEl = document.getElementById('notification-audio');

            function fetchNotifications() {
                fetch(`/api/notifications/${userId}`)
                    .then(res => res.json())
                    .then(data => {
                        if (!data.status) return;
                        const notifications = data.data;
                        const unread = notifications.filter(n => !n.is_read);
                        notifCountEl.textContent = unread.length;
                        notifListEl.innerHTML = '';
                        notifications.slice(0, 10).forEach(n => {
                            const li = document.createElement('li');
                            li.className = 'dropdown-item';
                            li.innerHTML = `<strong>${n.title}</strong><br><small>${n.message}</small>`;
                            notifListEl.appendChild(li);
                        });

                        // Play sound for the newest unread notification (if any)
                        if (unread.length && audioEl && unread[0].sound) {
                            audioEl.src = `/sounds/${unread[0].sound}`;
                            audioEl.play();
                        }

                        // Show toast for new unread notifications (avoid repeats)
                        const lastSeenId = localStorage.getItem('lastNotificationId') || 0;
                        const newUnread = unread.filter(n => n.id > lastSeenId);
                        if (newUnread.length) {
                            // Show the most recent one as a toast
                            const n = newUnread[0];
                            Toast.fire({
                                title: n.title,
                                text: n.message,
                                icon: 'info',
                            });
                            // Update last seen id
                            localStorage.setItem('lastNotificationId', n.id);
                        }
                    })
                    .catch(err => console.error('Notification fetch error', err));
            }

            fetchNotifications();
            setInterval(fetchNotifications, 30000); // every 30 sec
        });
    </script>

    @include('components.includes.searchable-select-script')
    @yield('footerscript')

    <!-- Hidden audio element for notification sounds -->
    <audio id="notification-audio" style="display:none;"></audio>
</body>

</html>
