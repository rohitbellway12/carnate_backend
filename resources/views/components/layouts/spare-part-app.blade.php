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
            <div class="modal fade" id="bellModal" tabindex="-1" aria-hidden="true"  role="dialog" aria-labelledby="bellModal" aria-hidden="true" data-bs-backdrop="static" 
            data-bs-keyboard="true">
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
        function openBellModal() {
            let sound = $("#bellSound")[0];
            let modal = new bootstrap.Modal(document.getElementById("bellModal"));
            modal.show();

            // Play bell sound
            sound.currentTime = 0;
            sound.play().catch(error => console.log("Audio play error:", error));
        }
        @if(checkOrder(Auth::guard('sparepart')->user()->id) > 0)
            setInterval(() => {
                openBellModal();
            }, 3000); // Adjust time interval as needed
        @endif
        function closepopup() {
            let modal = bootstrap.Modal.getInstance(document.getElementById("bellModal"));
            modal.hide(); // Close the modal

            setTimeout(() => {
                window.location.href = "{{ route('sparepart.order') }}";
            }, 500); // Adjust the delay if needed

            return true; // Allow the form submission to proceed
        }
    </script>
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







    @yield('footerscript')
</body>

</html>
