{{-- =========================================================
    CARNATE SIDEBAR
    FULL NATIVE SCROLL VERSION
========================================================= --}}

<style>

    /* =========================================================
       RESET / SIDEBAR
    ========================================================= */

    .sidebar-wrapper {
        position: fixed !important;

        top: 0 !important;
        left: 0 !important;
        bottom: 0 !important;

        width: 260px !important;
        height: 100vh !important;
        max-height: 100vh !important;

        margin: 0 !important;
        padding: 0 !important;

        background: #ffffff !important;

        border-right: 1px solid #e2e8f0 !important;

        z-index: 9999 !important;

        /*
         * IMPORTANT:
         * The wrapper itself does NOT scroll.
         */
        overflow: hidden !important;

        display: block !important;

        box-sizing: border-box !important;
    }


    .sidebar-wrapper *,
    .sidebar-wrapper *::before,
    .sidebar-wrapper *::after {
        box-sizing: border-box;
    }


    /* =========================================================
       SIDEBAR HEADER
    ========================================================= */

    .sidebar-wrapper .sidebar-header {
        position: absolute !important;

        top: 0 !important;
        left: 0 !important;
        right: 0 !important;

        width: 100% !important;

        height: 130px !important;
        min-height: 130px !important;
        max-height: 130px !important;

        margin: 0 !important;

        padding: 0 30px !important;

        display: flex !important;
        align-items: center !important;

        background: #ffffff !important;

        border-bottom: 1px solid #e2e8f0 !important;

        z-index: 100 !important;
    }


    .sidebar-wrapper .sidebar-header .logo-icon {
        width: 42px !important;
        height: 42px !important;

        object-fit: contain !important;

        display: block !important;
    }


    .sidebar-wrapper .sidebar-header .logo-text {
        margin: 0 0 0 10px !important;

        padding: 0 !important;

        color: #111827 !important;

        font-size: 20px !important;
        font-weight: 700 !important;

        line-height: 1.2 !important;
    }


    .sidebar-wrapper .sidebar-header .toggle-icon {
        margin-left: auto !important;

        width: 38px !important;
        height: 38px !important;

        display: flex !important;
        align-items: center !important;
        justify-content: center !important;

        color: #e53935 !important;

        font-size: 22px !important;

        cursor: pointer !important;

        border-radius: 8px !important;

        transition: all .2s ease;
    }


    .sidebar-wrapper .sidebar-header .toggle-icon:hover {
        background: #fff5f5 !important;
    }


    /* =========================================================
       ACTUAL SCROLL AREA
       
       THIS IS THE IMPORTANT PART.
       
       We are NOT using flex here.
       We are NOT using SimpleBar.
    ========================================================= */

    .sidebar-wrapper .carnate-sidebar-scroll {
        position: absolute !important;

        top: 130px !important;
        left: 0 !important;
        right: 0 !important;
        bottom: 0 !important;

        width: 100% !important;

        height: auto !important;
        max-height: none !important;

        margin: 0 !important;

        padding: 0 !important;

        /*
         * FORCE NATIVE SCROLL
         */
        overflow-y: auto !important;
        overflow-x: hidden !important;

        /*
         * Enable mouse wheel / touch scrolling
         */
        -webkit-overflow-scrolling: touch !important;

        /*
         * Don't allow other layout rules
         * to control this area.
         */
        float: none !important;

        display: block !important;

        scrollbar-width: auto !important;

        scrollbar-color: #cbd5e1 #f8fafc !important;

        overscroll-behavior: contain !important;

        z-index: 50 !important;
    }


    /* =========================================================
       FORCE CHROME / EDGE / SAFARI SCROLLBAR
    ========================================================= */

    .sidebar-wrapper .carnate-sidebar-scroll::-webkit-scrollbar {
        width: 9px !important;

        height: 9px !important;

        display: block !important;
    }


    .sidebar-wrapper .carnate-sidebar-scroll::-webkit-scrollbar-track {
        background: #f8fafc !important;

        border-radius: 10px !important;
    }


    .sidebar-wrapper .carnate-sidebar-scroll::-webkit-scrollbar-thumb {
        background: #cbd5e1 !important;

        border-radius: 10px !important;

        border: 2px solid #f8fafc !important;

        min-height: 40px !important;
    }


    .sidebar-wrapper .carnate-sidebar-scroll::-webkit-scrollbar-thumb:hover {
        background: #94a3b8 !important;
    }


    /* =========================================================
       MENU
    ========================================================= */

    .sidebar-wrapper #menu {
        position: relative !important;

        display: block !important;

        width: 100% !important;

        min-height: 100% !important;

        height: auto !important;

        margin: 0 !important;

        padding: 28px 0 70px 0 !important;

        list-style: none !important;

        overflow: visible !important;
    }


    /* =========================================================
       MENU ITEMS
    ========================================================= */

    .sidebar-wrapper #menu > li {
        display: block !important;

        width: 100% !important;

        margin: 0 !important;
        padding: 0 !important;

        list-style: none !important;
    }


    /* =========================================================
       SECTION TITLE
    ========================================================= */

    .sidebar-wrapper #menu > li.menu-section {
        display: block !important;

        width: 100% !important;

        min-height: auto !important;

        padding: 22px 30px 10px !important;

        color: #94a3b8 !important;

        font-size: 13px !important;

        font-weight: 700 !important;

        line-height: 1.4 !important;

        letter-spacing: 1px !important;

        text-transform: uppercase !important;

        background: transparent !important;

        cursor: default !important;
    }


    /* =========================================================
       MAIN MENU LINK
    ========================================================= */

    .sidebar-wrapper #menu > li > a {
        position: relative !important;

        display: flex !important;

        align-items: center !important;

        width: 100% !important;

        min-height: 58px !important;

        height: auto !important;

        margin: 0 !important;

        padding: 10px 30px !important;

        color: #64748b !important;

        background: transparent !important;

        border: 0 !important;

        text-decoration: none !important;

        cursor: pointer !important;

        transition:
            background-color .2s ease,
            color .2s ease !important;
    }


    .sidebar-wrapper #menu > li > a:hover {
        color: #e53935 !important;

        background: #fff5f5 !important;
    }


    /* =========================================================
       ICON
    ========================================================= */

    .sidebar-wrapper #menu .parent-icon {
        width: 34px !important;

        min-width: 34px !important;

        height: 30px !important;

        display: flex !important;

        align-items: center !important;

        justify-content: flex-start !important;

        color: #64748b !important;

        font-size: 21px !important;

        line-height: 1 !important;
    }


    .sidebar-wrapper #menu > li > a:hover .parent-icon {
        color: #e53935 !important;
    }


    /* =========================================================
       TITLE
    ========================================================= */

    .sidebar-wrapper #menu .menu-title {
        display: block !important;

        margin-left: 18px !important;

        padding: 0 !important;

        color: inherit !important;

        font-size: 16px !important;

        font-weight: 500 !important;

        line-height: 1.4 !important;

        white-space: nowrap !important;
    }


    /* =========================================================
       HAS ARROW
    ========================================================= */

    .sidebar-wrapper #menu .has-arrow {
        padding-right: 60px !important;
    }


    .sidebar-wrapper #menu .has-arrow::after {
        position: absolute !important;

        right: 30px !important;

        color: #94a3b8 !important;

        border-color: #94a3b8 !important;
    }


    .sidebar-wrapper #menu .has-arrow:hover::after {
        color: #e53935 !important;

        border-color: #e53935 !important;
    }


    /* =========================================================
       ACTIVE
    ========================================================= */

    .sidebar-wrapper #menu > li.mm-active > a {
        color: #e53935 !important;

        background: #fff5f5 !important;
    }


    .sidebar-wrapper #menu > li.mm-active > a .parent-icon {
        color: #e53935 !important;
    }


    /* =========================================================
       SUBMENU
    ========================================================= */

    .sidebar-wrapper #menu ul {
        position: relative !important;

        width: 100% !important;

        height: auto !important;

        margin: 0 !important;

        padding: 0 !important;

        list-style: none !important;

        overflow: visible !important;
    }


    .sidebar-wrapper #menu ul li {
        display: block !important;

        width: 100% !important;

        height: auto !important;

        margin: 0 !important;

        padding: 0 !important;
    }


    .sidebar-wrapper #menu ul li a {
        display: flex !important;

        align-items: center !important;

        width: 100% !important;

        min-height: 44px !important;

        padding: 8px 25px 8px 82px !important;

        color: #64748b !important;

        background: transparent !important;

        font-size: 14px !important;

        line-height: 1.4 !important;

        text-decoration: none !important;
    }


    .sidebar-wrapper #menu ul li a:hover {
        color: #e53935 !important;

        background: #fff5f5 !important;
    }


    .sidebar-wrapper #menu ul li a i {
        margin-right: 8px !important;

        font-size: 14px !important;
    }


    /* =========================================================
       MOBILE
    ========================================================= */

    @media (max-width: 991px) {

        .sidebar-wrapper {
            width: 260px !important;

            height: 100vh !important;
        }


        .sidebar-wrapper .sidebar-header {
            height: 70px !important;

            min-height: 70px !important;

            max-height: 70px !important;

            padding: 0 20px !important;
        }


        .sidebar-wrapper .carnate-sidebar-scroll {
            top: 70px !important;
        }


        .sidebar-wrapper #menu > li > a {
            padding-left: 22px !important;

            padding-right: 22px !important;
        }


        .sidebar-wrapper #menu > li.menu-section {
            padding-left: 22px !important;

            padding-right: 22px !important;
        }
    }


    @media (max-width: 575px) {

        .sidebar-wrapper {
            width: 250px !important;
        }


        .sidebar-wrapper .sidebar-header {
            padding: 0 16px !important;
        }


        .sidebar-wrapper #menu .menu-title {
            font-size: 15px !important;
        }
    }

</style>


{{-- =========================================================
    SIDEBAR
========================================================= --}}

<div class="sidebar-wrapper">

    {{-- =====================================================
        HEADER
    ====================================================== --}}

    <div class="sidebar-header">

        <div>
            <img
                src="{{ asset('assets/images/logo.png') }}"
                class="logo-icon"
                alt="logo icon"
            >
        </div>

        <div>
            <h4 class="logo-text">
                CARNATE
            </h4>
        </div>

        <div class="toggle-icon">
            <i class="bx bx-arrow-to-left"></i>
        </div>

    </div>


    {{-- =====================================================
        NATIVE SCROLL CONTAINER
    ====================================================== --}}

    <div class="carnate-sidebar-scroll">

        <ul class="metismenu" id="menu">


            {{-- =================================================
                MAIN
            ================================================== --}}

            <li class="menu-section">
                MAIN
            </li>


            {{-- Dashboard --}}
            <li>

                <a href="#">

                    <div class="parent-icon">
                        <i class="bx bx-home"></i>
                    </div>

                    <div class="menu-title">
                        Dashboard
                    </div>

                </a>

            </li>


            {{-- Sub Admin --}}
            <li>

                <a href="#">

                    <div class="parent-icon">
                        <i class="bx bx-user-pin"></i>
                    </div>

                    <div class="menu-title">
                        Sub Admin
                    </div>

                </a>

            </li>


            {{-- =================================================
                FINANCE
            ================================================== --}}

            <li class="menu-section">
                FINANCE
            </li>


            {{-- Expenses --}}
            <li>

                <a
                    href="javascript:void(0);"
                    class="has-arrow"
                >

                    <div class="parent-icon">
                        <i class="bx bx-wallet"></i>
                    </div>

                    <div class="menu-title">
                        Expenses
                    </div>

                </a>


                <ul class="mm-collapse">

                    <li>

                        <a href="#">

                            <i class="bx bx-right-arrow-alt"></i>

                            Expense Category

                        </a>

                    </li>


                    <li>

                        <a href="#">

                            <i class="bx bx-right-arrow-alt"></i>

                            Expenses

                        </a>

                    </li>

                </ul>

            </li>


            {{-- =================================================
                WORKSHOP
            ================================================== --}}

            <li class="menu-section">
                WORKSHOP
            </li>


            {{-- Spare Part --}}
            <li>

                <a
                    href="javascript:void(0);"
                    class="has-arrow"
                >

                    <div class="parent-icon">
                        <i class="bx bx-wrench"></i>
                    </div>

                    <div class="menu-title">
                        Spare Part
                    </div>

                </a>


                <ul class="mm-collapse">

                    <li>

                        <a href="#">

                            <i class="bx bx-right-arrow-alt"></i>

                            Vendor

                        </a>

                    </li>


                    <li>

                        <a href="#">

                            <i class="bx bx-right-arrow-alt"></i>

                            Label

                        </a>

                    </li>


                    <li>

                        <a href="#">

                            <i class="bx bx-right-arrow-alt"></i>

                            Category

                        </a>

                    </li>


                    <li>

                        <a href="#">

                            <i class="bx bx-right-arrow-alt"></i>

                            Unit

                        </a>

                    </li>

                </ul>

            </li>


            {{-- Customer --}}
            <li>

                <a href="#">

                    <div class="parent-icon">
                        <i class="bx bx-user"></i>
                    </div>

                    <div class="menu-title">
                        Customer
                    </div>

                </a>

            </li>


            {{-- Job Cards --}}
            <li>

                <a href="#">

                    <div class="parent-icon">
                        <i class="bx bx-list-check"></i>
                    </div>

                    <div class="menu-title">
                        Job-Cards
                    </div>

                </a>

            </li>


            {{-- Workshop Vendor --}}
            <li>

                <a href="#">

                    <div class="parent-icon">
                        <i class="bx bx-user"></i>
                    </div>

                    <div class="menu-title">
                        Work Shop Vendor
                    </div>

                </a>

            </li>


            {{-- Subscription Plan --}}
            <li>

                <a href="#">

                    <div class="parent-icon">
                        <i class="bx bx-package"></i>
                    </div>

                    <div class="menu-title">
                        Subscription Plan
                    </div>

                </a>

            </li>


            {{-- =================================================
                ORDERS
            ================================================== --}}

            <li class="menu-section">
                ORDERS
            </li>


            {{-- Order --}}
            <li>

                <a href="#">

                    <div class="parent-icon">
                        <i class="bx bx-cart"></i>
                    </div>

                    <div class="menu-title">
                        Order
                    </div>

                </a>

            </li>


            {{-- =================================================
                VEHICLES
            ================================================== --}}

            <li class="menu-section">
                VEHICLES
            </li>


            {{-- Vehicles --}}
            <li>

                <a href="#">

                    <div class="parent-icon">
                        <i class="bx bx-car"></i>
                    </div>

                    <div class="menu-title">
                        Vehicles
                    </div>

                </a>

            </li>


            {{-- Vehicle Brands --}}
            <li>

                <a href="#">

                    <div class="parent-icon">
                        <i class="bx bx-car"></i>
                    </div>

                    <div class="menu-title">
                        Vehicle Brands
                    </div>

                </a>

            </li>


            {{-- Vehicle Models --}}
            <li>

                <a href="#">

                    <div class="parent-icon">
                        <i class="bx bx-car"></i>
                    </div>

                    <div class="menu-title">
                        Vehicle Models
                    </div>

                </a>

            </li>


            {{-- Vehicle Variants --}}
            <li>

                <a href="#">

                    <div class="parent-icon">
                        <i class="bx bx-car"></i>
                    </div>

                    <div class="menu-title">
                        Vehicle Variants
                    </div>

                </a>

            </li>


            {{-- Vehicle Modifications --}}
            <li>

                <a href="#">

                    <div class="parent-icon">
                        <i class="bx bx-car"></i>
                    </div>

                    <div class="menu-title">
                        Vehicle Modifications
                    </div>

                </a>

            </li>


            {{-- =================================================
                PAYMENTS
            ================================================== --}}

            <li class="menu-section">
                PAYMENTS
            </li>


            {{-- Payment --}}
            <li>

                <a href="#">

                    <div class="parent-icon">
                        <i class="bx bx-credit-card"></i>
                    </div>

                    <div class="menu-title">
                        Payment
                    </div>

                </a>

            </li>


            {{-- Withdraw --}}
            <li>

                <a href="#">

                    <div class="parent-icon">
                        <i class="bx bx-money"></i>
                    </div>

                    <div class="menu-title">
                        Withdraw
                    </div>

                </a>

            </li>


            {{-- =================================================
                REPORTS
            ================================================== --}}

            <li class="menu-section">
                REPORTS
            </li>


            {{-- Reports --}}
            <li>

                <a
                    href="javascript:void(0);"
                    class="has-arrow"
                >

                    <div class="parent-icon">
                        <i class="bx bx-bar-chart-alt-2"></i>
                    </div>

                    <div class="menu-title">
                        Reports
                    </div>

                </a>


                <ul class="mm-collapse">

                    <li>
                        <a href="#">
                            <i class="bx bx-right-arrow-alt"></i>
                            Workshops
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            <i class="bx bx-right-arrow-alt"></i>
                            Customers
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            <i class="bx bx-right-arrow-alt"></i>
                            Job Cards
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            <i class="bx bx-right-arrow-alt"></i>
                            Orders
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            <i class="bx bx-right-arrow-alt"></i>
                            Payments
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            <i class="bx bx-right-arrow-alt"></i>
                            Expenses
                        </a>
                    </li>

                </ul>

            </li>


            {{-- =================================================
                ADMIN
            ================================================== --}}

            <li class="menu-section">
                ADMIN
            </li>


            {{-- Roles --}}
            <li>

                <a href="#">

                    <div class="parent-icon">
                        <i class="bx bx-shield"></i>
                    </div>

                    <div class="menu-title">
                        Roles
                    </div>

                </a>

            </li>


            {{-- Permissions --}}
            <li>

                <a href="#">

                    <div class="parent-icon">
                        <i class="bx bx-lock"></i>
                    </div>

                    <div class="menu-title">
                        Permissions
                    </div>

                </a>

            </li>


            {{-- Profile --}}
            <li>

                <a href="#">

                    <div class="parent-icon">
                        <i class="bx bx-user-circle"></i>
                    </div>

                    <div class="menu-title">
                        Profile
                    </div>

                </a>

            </li>


            {{-- Logout --}}
            <li>

                <a href="">

                    <div class="parent-icon">
                        <i class="bx bx-log-out-circle"></i>
                    </div>

                    <div class="menu-title">
                        Logout
                    </div>

                </a>

            </li>

        </ul>

    </div>

</div>


{{-- =========================================================
    FORCE SIDEBAR SCROLL
========================================================= --}}

<script>

    (function () {

        function initCarnateSidebarScroll() {

            const sidebar = document.querySelector(
                '.sidebar-wrapper'
            );

            const scrollArea = document.querySelector(
                '.carnate-sidebar-scroll'
            );

            if (!sidebar || !scrollArea) {
                return;
            }


            /*
             * Force the exact dimensions from JavaScript.
             * This protects against existing theme CSS.
             */

            function resizeSidebar() {

                const header = sidebar.querySelector(
                    '.sidebar-header'
                );

                const headerHeight = header
                    ? header.offsetHeight
                    : 130;

                const viewportHeight = window.innerHeight;

                sidebar.style.setProperty(
                    'height',
                    viewportHeight + 'px',
                    'important'
                );

                scrollArea.style.setProperty(
                    'height',
                    (viewportHeight - headerHeight) + 'px',
                    'important'
                );

                scrollArea.style.setProperty(
                    'max-height',
                    (viewportHeight - headerHeight) + 'px',
                    'important'
                );

                scrollArea.style.setProperty(
                    'overflow-y',
                    'auto',
                    'important'
                );

                scrollArea.style.setProperty(
                    'overflow-x',
                    'hidden',
                    'important'
                );
            }


            resizeSidebar();


            /*
             * Resize when browser size changes.
             */

            window.addEventListener(
                'resize',
                resizeSidebar
            );


            /*
             * Some admin themes prevent wheel events
             * on sidebar elements.
             *
             * This makes the wheel explicitly scroll
             * the Carnate sidebar.
             */

            scrollArea.addEventListener(
                'wheel',
                function (event) {

                    const canScroll =
                        scrollArea.scrollHeight >
                        scrollArea.clientHeight;

                    if (!canScroll) {
                        return;
                    }

                    /*
                     * Only handle vertical scrolling.
                     */

                    if (Math.abs(event.deltaY) > 0) {

                        event.preventDefault();

                        scrollArea.scrollTop += event.deltaY;
                    }

                },
                {
                    passive: false,
                    capture: true
                }
            );


            /*
             * Touch scrolling.
             */

            let touchStartY = 0;

            scrollArea.addEventListener(
                'touchstart',
                function (event) {

                    if (
                        event.touches &&
                        event.touches.length
                    ) {

                        touchStartY =
                            event.touches[0].clientY;
                    }

                },
                {
                    passive: true
                }
            );


            scrollArea.addEventListener(
                'touchmove',
                function (event) {

                    if (
                        !event.touches ||
                        !event.touches.length
                    ) {
                        return;
                    }

                    const currentY =
                        event.touches[0].clientY;

                    const difference =
                        touchStartY - currentY;

                    if (Math.abs(difference) > 0) {

                        scrollArea.scrollTop += difference;

                        touchStartY = currentY;

                    }

                },
                {
                    passive: true
                }
            );


            /*
             * When submenu opens/closes,
             * make sure the scroll container
             * remains active.
             */

            document.addEventListener(
                'click',
                function (event) {

                    const arrow =
                        event.target.closest(
                            '.sidebar-wrapper .has-arrow'
                        );

                    if (!arrow) {
                        return;
                    }

                    setTimeout(
                        function () {

                            resizeSidebar();

                        },
                        350
                    );

                }
            );

        }


        /*
         * Initial load.
         */

        if (
            document.readyState === 'loading'
        ) {

            document.addEventListener(
                'DOMContentLoaded',
                initCarnateSidebarScroll
            );

        } else {

            initCarnateSidebarScroll();

        }


        /*
         * Livewire navigation.
         */

        document.addEventListener(
            'livewire:navigated',
            function () {

                setTimeout(
                    initCarnateSidebarScroll,
                    300
                );

            }
        );

    })();

</script>