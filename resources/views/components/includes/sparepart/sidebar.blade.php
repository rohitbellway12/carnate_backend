<?php

use Illuminate\Support\Facades\Auth;

$sparePart = null;

if (Auth::guard('sparepart')->check()) {
    $id = Auth::guard('sparepart')->user()->id;
    $sparePart = App\Models\SparePartVendor::where('id', $id)->first();
}

?>

<style>

/* =========================================================
   CARNATE SPARE PART SIDEBAR
   NATIVE SCROLL VERSION
========================================================= */

.sidebar-wrapper.customsidebar {
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

    overflow: hidden !important;

    display: block !important;

    box-sizing: border-box !important;
}


/* =========================================================
   RESET
========================================================= */

.sidebar-wrapper.customsidebar *,
.sidebar-wrapper.customsidebar *::before,
.sidebar-wrapper.customsidebar *::after {
    box-sizing: border-box;
}


/* =========================================================
   HEADER
========================================================= */

.sidebar-wrapper.customsidebar .sidebar-header {

    position: absolute !important;

    top: 0 !important;
    left: 0 !important;
    right: 0 !important;

    width: 100% !important;

    height: 100px !important;
    min-height: 100px !important;
    max-height: 100px !important;

    margin: 0 !important;

    padding: 0 25px !important;

    display: flex !important;

    align-items: center !important;

    background: #ffffff !important;

    border-bottom: 1px solid #e2e8f0 !important;

    z-index: 100 !important;
}


/* Logo */

.sidebar-wrapper.customsidebar .sidebar-header .logo-icon {

    width: 145px !important;

    max-width: 100% !important;

    height: auto !important;

    max-height: 52px !important;

    object-fit: contain !important;

    object-position: left center !important;

    display: block !important;
}


/* Toggle */

.sidebar-wrapper.customsidebar .sidebar-header .toggle-icon {

    margin-left: auto !important;

    width: 38px !important;

    height: 38px !important;

    min-width: 38px !important;

    display: flex !important;

    align-items: center !important;

    justify-content: center !important;

    color: #e53935 !important;

    font-size: 21px !important;

    cursor: pointer !important;

    border-radius: 8px !important;

    transition: all .2s ease !important;
}


.sidebar-wrapper.customsidebar .sidebar-header .toggle-icon:hover {

    background: #fff5f5 !important;

    color: #c62828 !important;
}


/* =========================================================
   NATIVE SCROLL CONTAINER
========================================================= */

.sidebar-wrapper.customsidebar .carnate-sidebar-scroll {

    position: absolute !important;

    top: 100px !important;

    left: 0 !important;

    right: 0 !important;

    bottom: 0 !important;

    width: 100% !important;

    height: auto !important;

    max-height: none !important;

    margin: 0 !important;

    padding: 0 !important;

    overflow-y: auto !important;

    overflow-x: hidden !important;

    -webkit-overflow-scrolling: touch !important;

    float: none !important;

    display: block !important;

    scrollbar-width: auto !important;

    scrollbar-color: #cbd5e1 #f8fafc !important;

    overscroll-behavior: contain !important;

    z-index: 50 !important;
}


/* =========================================================
   CHROME / EDGE / SAFARI SCROLLBAR
========================================================= */

.sidebar-wrapper.customsidebar .carnate-sidebar-scroll::-webkit-scrollbar {

    width: 9px !important;

    height: 9px !important;

    display: block !important;
}


.sidebar-wrapper.customsidebar .carnate-sidebar-scroll::-webkit-scrollbar-track {

    background: #f8fafc !important;

    border-radius: 10px !important;
}


.sidebar-wrapper.customsidebar .carnate-sidebar-scroll::-webkit-scrollbar-thumb {

    background: #cbd5e1 !important;

    border-radius: 10px !important;

    border: 2px solid #f8fafc !important;

    min-height: 40px !important;
}


.sidebar-wrapper.customsidebar .carnate-sidebar-scroll::-webkit-scrollbar-thumb:hover {

    background: #94a3b8 !important;
}


/* =========================================================
   MENU
========================================================= */

.sidebar-wrapper.customsidebar #menu {

    position: relative !important;

    display: block !important;

    width: 100% !important;

    min-height: 100% !important;

    height: auto !important;

    margin: 0 !important;

    padding: 22px 0 60px 0 !important;

    list-style: none !important;

    overflow: visible !important;
}


/* =========================================================
   MENU ITEM
========================================================= */

.sidebar-wrapper.customsidebar #menu > li {

    display: block !important;

    width: 100% !important;

    margin: 0 !important;

    padding: 0 !important;

    list-style: none !important;
}


/* =========================================================
   SECTION TITLE
========================================================= */

.sidebar-wrapper.customsidebar #menu > li.menu-section {

    display: block !important;

    width: 100% !important;

    min-height: auto !important;

    padding: 22px 25px 9px !important;

    color: #94a3b8 !important;

    font-size: 12px !important;

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

.sidebar-wrapper.customsidebar #menu > li > a,
.sidebar-wrapper.customsidebar #menu > li > .dropdown > a {

    position: relative !important;

    display: flex !important;

    align-items: center !important;

    width: 100% !important;

    min-height: 56px !important;

    height: auto !important;

    margin: 0 !important;

    padding: 10px 25px !important;

    color: #64748b !important;

    background: transparent !important;

    border: 0 !important;

    text-decoration: none !important;

    cursor: pointer !important;

    transition:
        background-color .2s ease,
        color .2s ease !important;
}


.sidebar-wrapper.customsidebar #menu > li > a:hover,
.sidebar-wrapper.customsidebar #menu > li > .dropdown > a:hover {

    color: #e53935 !important;

    background: #fff5f5 !important;
}


/* =========================================================
   ICON
========================================================= */

.sidebar-wrapper.customsidebar #menu .parent-icon {

    width: 34px !important;

    min-width: 34px !important;

    height: 30px !important;

    display: flex !important;

    align-items: center !important;

    justify-content: flex-start !important;

    color: #64748b !important;

    font-size: 20px !important;

    line-height: 1 !important;

    transition: color .2s ease !important;
}


.sidebar-wrapper.customsidebar #menu > li > a:hover .parent-icon,
.sidebar-wrapper.customsidebar #menu > li > .dropdown > a:hover .parent-icon {

    color: #e53935 !important;
}


/* =========================================================
   TITLE
========================================================= */

.sidebar-wrapper.customsidebar #menu .menu-title {

    display: block !important;

    margin-left: 18px !important;

    padding: 0 !important;

    color: inherit !important;

    font-size: 15px !important;

    font-weight: 500 !important;

    line-height: 1.4 !important;

    white-space: nowrap !important;

    overflow: hidden !important;

    text-overflow: ellipsis !important;
}


/* =========================================================
   DROPDOWN ARROW
========================================================= */

.sidebar-wrapper.customsidebar #menu .dropdown-right-icon {

    position: absolute !important;

    right: 25px !important;

    top: 50% !important;

    transform: translateY(-50%) !important;

    color: #94a3b8 !important;

    font-size: 11px !important;

    transition:
        color .2s ease,
        transform .2s ease !important;
}


.sidebar-wrapper.customsidebar #menu .dropdown > a:hover .dropdown-right-icon {

    color: #e53935 !important;
}


/* =========================================================
   ACTIVE MENU
========================================================= */

.sidebar-wrapper.customsidebar #menu > li.mm-active > a,
.sidebar-wrapper.customsidebar #menu > li.active > a {

    color: #e53935 !important;

    background: #fff5f5 !important;
}


.sidebar-wrapper.customsidebar #menu > li.mm-active > a .parent-icon,
.sidebar-wrapper.customsidebar #menu > li.active > a .parent-icon {

    color: #e53935 !important;
}


/* =========================================================
   DROPDOWN
========================================================= */

.sidebar-wrapper.customsidebar .dropdown-content {

    display: none;

    position: relative !important;

    width: 100% !important;

    margin: 0 !important;

    padding: 0 !important;

    background: #ffffff !important;

    border: 0 !important;

    box-shadow: none !important;

    overflow: visible !important;
}


/*
 * Dropdown opens on CLICK (.is-open), NOT on :hover.
 */

.sidebar-wrapper.customsidebar .dropdown.is-open > .dropdown-content {
    display: block !important;
}

.sidebar-wrapper.customsidebar .dropdown.is-open > a .dropdown-right-icon,
.sidebar-wrapper.customsidebar .dropdown.is-open > a .fa-chevron-right {
    transform: rotate(90deg) !important;
    color: #e53935 !important;
}

.sidebar-wrapper.customsidebar .dropdown.active > a,
.sidebar-wrapper.customsidebar .dropdown.is-open > a {
    color: #e53935 !important;
    background: #fff5f5 !important;
    font-weight: 600 !important;
}

.sidebar-wrapper.customsidebar .dropdown.active > a .parent-icon,
.sidebar-wrapper.customsidebar .dropdown.is-open > a .parent-icon {
    color: #e53935 !important;
}

.sidebar-wrapper.customsidebar .dropdown-content > a.active {
    color: #e53935 !important;
    background: #fff5f5 !important;
    font-weight: 600 !important;
}

.sidebar-wrapper.customsidebar .dropdown-content > a.active::before {
    background: #e53935 !important;
}


/* =========================================================
   DROPDOWN LINKS
========================================================= */

.sidebar-wrapper.customsidebar .dropdown-content > a {

    position: relative !important;

    display: flex !important;

    align-items: center !important;

    width: 100% !important;

    min-height: 43px !important;

    margin: 0 !important;

    padding: 8px 25px 8px 77px !important;

    color: #64748b !important;

    background: transparent !important;

    border: 0 !important;

    border-radius: 0 !important;

    font-size: 14px !important;

    font-weight: 400 !important;

    line-height: 1.4 !important;

    text-decoration: none !important;

    transition:
        background-color .2s ease,
        color .2s ease !important;
}


.sidebar-wrapper.customsidebar .dropdown-content > a:hover {

    color: #e53935 !important;

    background: #fff5f5 !important;
}


.sidebar-wrapper.customsidebar .dropdown-content > a::before {

    content: '';

    position: absolute;

    left: 59px;

    top: 50%;

    width: 5px;

    height: 5px;

    transform: translateY(-50%);

    background: #cbd5e1;

    border-radius: 50%;

    transition: background .2s ease;
}


.sidebar-wrapper.customsidebar .dropdown-content > a:hover::before {

    background: #e53935;
}


/* =========================================================
   HIDDEN LEGACY INVENTORY
========================================================= */

.sidebar-wrapper.customsidebar #menu > li.d-none {

    display: none !important;
}


/* =========================================================
   SUPPORT
========================================================= */

.sidebar-wrapper.customsidebar .support-item {

    margin: 10px 20px !important;
}


.sidebar-wrapper.customsidebar .support-card {

    position: relative !important;

    overflow: hidden !important;

    border-radius: 10px !important;

    background: #111827 !important;

    border: 1px solid #1f2937 !important;

    box-shadow: none !important;
}


.sidebar-wrapper.customsidebar .support-card::before {

    content: '';

    position: absolute;

    width: 90px;

    height: 90px;

    right: -35px;

    top: -35px;

    border-radius: 50%;

    background: rgba(229, 57, 53, .12);
}


.sidebar-wrapper.customsidebar .support-card > a {

    position: relative !important;

    z-index: 2 !important;

    min-height: 58px !important;

    padding: 9px 12px !important;

    color: #ffffff !important;

    background: transparent !important;

    border-radius: 10px !important;
}


.sidebar-wrapper.customsidebar .support-card > a:hover {

    color: #ffffff !important;

    background: rgba(255,255,255,.04) !important;
}


.sidebar-wrapper.customsidebar .support-card .parent-icon {

    width: 34px !important;

    min-width: 34px !important;

    height: 34px !important;

    margin: 0 !important;

    color: #ffffff !important;

    background: rgba(255,255,255,.08) !important;

    border-radius: 8px !important;
}


.sidebar-wrapper.customsidebar .support-card .menu-title {

    margin-left: 12px !important;

    color: #ffffff !important;

    font-size: 14px !important;

    font-weight: 600 !important;
}


.sidebar-wrapper.customsidebar .support-card .dropdown-right-icon {

    right: 14px !important;

    color: #ffffff !important;
}


.sidebar-wrapper.customsidebar .support-card .dropdown-content {

    position: relative !important;

    z-index: 3 !important;

    margin: 0 7px 7px !important;

    width: auto !important;

    background: #ffffff !important;

    border-radius: 8px !important;

    overflow: hidden !important;
}


.sidebar-wrapper.customsidebar .support-card .dropdown-content > a {

    min-height: 40px !important;

    padding: 8px 10px !important;

    color: #475569 !important;

    background: #ffffff !important;

    gap: 8px !important;

    font-size: 12px !important;
}


.sidebar-wrapper.customsidebar .support-card .dropdown-content > a:hover {

    color: #e53935 !important;

    background: #fff5f5 !important;
}


.sidebar-wrapper.customsidebar .support-card .dropdown-content > a::before {

    display: none !important;
}


.sidebar-wrapper.customsidebar .support-card .dropdown-content i {

    width: 18px !important;

    color: #e53935 !important;

    text-align: center !important;
}


/* =========================================================
   LOGOUT
========================================================= */

.sidebar-wrapper.customsidebar #menu > li:last-child {

    margin-top: 10px !important;

    padding-top: 10px !important;

    border-top: 1px solid #e2e8f0 !important;
}


.sidebar-wrapper.customsidebar #menu > li:last-child > a:hover {

    color: #dc2626 !important;

    background: #fff5f5 !important;
}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 991px) {

    .sidebar-wrapper.customsidebar {

        width: 260px !important;

        height: 100vh !important;
    }


    .sidebar-wrapper.customsidebar .sidebar-header {

        height: 70px !important;

        min-height: 70px !important;

        max-height: 70px !important;

        padding: 0 20px !important;
    }


    .sidebar-wrapper.customsidebar .carnate-sidebar-scroll {

        top: 70px !important;
    }


    .sidebar-wrapper.customsidebar #menu > li > a,
    .sidebar-wrapper.customsidebar #menu > li > .dropdown > a {

        padding-left: 22px !important;

        padding-right: 22px !important;
    }


    .sidebar-wrapper.customsidebar #menu > li.menu-section {

        padding-left: 22px !important;

        padding-right: 22px !important;
    }


    .sidebar-wrapper.customsidebar .dropdown-content > a {

        padding-left: 70px !important;
    }


    .sidebar-wrapper.customsidebar .dropdown-content > a::before {

        left: 52px;
    }

}


@media (max-width: 575px) {

    .sidebar-wrapper.customsidebar {

        width: 250px !important;
    }


    .sidebar-wrapper.customsidebar .sidebar-header {

        padding: 0 16px !important;
    }


    .sidebar-wrapper.customsidebar .sidebar-header .logo-icon {

        width: 130px !important;
    }


    .sidebar-wrapper.customsidebar #menu .menu-title {

        font-size: 14px !important;
    }

}

</style>

<style>
/* Keep the spare-parts navigation visually in lockstep with the admin shell. */
.sidebar-wrapper.customsidebar.sparepart-carnate-sidebar {
    width: 270px !important;
    height: 100vh !important;
    height: 100dvh !important;
    display: flex !important;
    flex-direction: column !important;
    background: #ffffff !important;
    border-right: 1px solid #e2e8f0 !important;
    box-shadow: 4px 0 20px rgba(15, 23, 42, .035) !important;
    z-index: 1050 !important;
}

.sidebar-wrapper.customsidebar.sparepart-carnate-sidebar .sidebar-header {
    position: relative !important;
    flex: 0 0 72px !important;
    width: 100% !important;
    height: 72px !important;
    min-height: 72px !important;
    max-height: 72px !important;
    padding: 0 18px !important;
    z-index: 2 !important;
}

.sparepart-carnate-sidebar .sparepart-logo-wrapper {
    display: flex;
    align-items: center;
    min-width: 0;
    flex: 1;
}

.sidebar-wrapper.customsidebar.sparepart-carnate-sidebar .sidebar-header .logo-icon {
    width: auto !important;
    max-width: 165px !important;
    max-height: none !important;
}

.sidebar-wrapper.customsidebar.sparepart-carnate-sidebar .sidebar-header .toggle-icon {
    width: 34px !important;
    min-width: 34px !important;
    height: 34px !important;
    font-size: 20px !important;
    border-radius: 9px !important;
}

.sidebar-wrapper.customsidebar.sparepart-carnate-sidebar .carnate-sidebar-scroll {
    position: relative !important;
    top: auto !important;
    flex: 1 1 auto !important;
    width: 100% !important;
    min-height: 0 !important;
    overflow-y: scroll !important;
    scrollbar-width: thin !important;
    scrollbar-color: #cbd5e1 transparent !important;
}

.sidebar-wrapper.customsidebar.sparepart-carnate-sidebar #menu.carnate-menu {
    min-height: auto !important;
    padding: 14px 12px 20px !important;
    background: #ffffff !important;
}

.sidebar-wrapper.customsidebar.sparepart-carnate-sidebar #menu > li {
    margin: 2px 0 !important;
}

.sidebar-wrapper.customsidebar.sparepart-carnate-sidebar #menu > li.menu-section {
    padding: 12px 10px 7px !important;
    color: #94a3b8 !important;
    font-size: 10px !important;
    line-height: 1.2 !important;
    letter-spacing: .1em !important;
}

.sidebar-wrapper.customsidebar.sparepart-carnate-sidebar #menu > li > a,
.sidebar-wrapper.customsidebar.sparepart-carnate-sidebar #menu > li > .dropdown > a {
    min-height: 44px !important;
    padding: 10px 12px !important;
    gap: 11px !important;
    border: 1px solid transparent !important;
    border-radius: 9px !important;
    color: #64748b !important;
    font-size: 14px !important;
    font-weight: 500 !important;
}

.sidebar-wrapper.customsidebar.sparepart-carnate-sidebar #menu > li > a:hover,
.sidebar-wrapper.customsidebar.sparepart-carnate-sidebar #menu > li > .dropdown > a:hover {
    color: #111827 !important;
    background: #f8fafc !important;
}

.sidebar-wrapper.customsidebar.sparepart-carnate-sidebar #menu .parent-icon {
    width: 20px !important;
    min-width: 20px !important;
    height: auto !important;
    justify-content: center !important;
    color: #64748b !important;
    font-size: 18px !important;
}

.sidebar-wrapper.customsidebar.sparepart-carnate-sidebar #menu .menu-title {
    margin-left: 0 !important;
    font-size: 14px !important;
}

.sidebar-wrapper.customsidebar.sparepart-carnate-sidebar #menu > li.mm-active > a,
.sidebar-wrapper.customsidebar.sparepart-carnate-sidebar #menu > li.active > a {
    color: #e53935 !important;
    background: #fff5f5 !important;
    border-color: rgba(229, 57, 53, .08) !important;
    font-weight: 600 !important;
}

.sidebar-wrapper.customsidebar.sparepart-carnate-sidebar #menu > li.mm-active > a .parent-icon,
.sidebar-wrapper.customsidebar.sparepart-carnate-sidebar #menu > li.active > a .parent-icon {
    color: #e53935 !important;
}

.sidebar-wrapper.customsidebar.sparepart-carnate-sidebar .dropdown-content {
    margin: 4px 0 7px 18px !important;
    padding: 2px 0 2px 12px !important;
    border-left: 1px solid #e2e8f0 !important;
    background: transparent !important;
}

.sidebar-wrapper.customsidebar.sparepart-carnate-sidebar .dropdown-content > a {
    min-height: 36px !important;
    padding: 8px 10px !important;
    border-radius: 7px !important;
    color: #64748b !important;
    font-size: 13px !important;
    font-weight: 500 !important;
}

.sidebar-wrapper.customsidebar.sparepart-carnate-sidebar .dropdown-content > a::before {
    display: none !important;
}

.sidebar-wrapper.customsidebar.sparepart-carnate-sidebar .dropdown-content > a:hover {
    color: #111827 !important;
    background: #f8fafc !important;
}

.sidebar-wrapper.customsidebar.sparepart-carnate-sidebar #menu > li:last-child {
    margin-top: 5px !important;
}

.sidebar-wrapper.customsidebar.sparepart-carnate-sidebar {
    transition: width 0.25s cubic-bezier(0.4, 0, 0.2, 1), left 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
}

@media (min-width: 1025px) {
    html .wrapper.toggled:not(.sidebar-hovered) .sidebar-wrapper.customsidebar.sparepart-carnate-sidebar { width: 70px !important; }
    html .wrapper.toggled:not(.sidebar-hovered) .page-wrapper { margin-left: 70px !important; }
    html .wrapper.toggled:not(.sidebar-hovered) .topbar,
    html .wrapper.toggled:not(.sidebar-hovered) .page-footer { left: 70px !important; }
    html .wrapper.toggled:not(.sidebar-hovered) .sidebar-wrapper.customsidebar.sparepart-carnate-sidebar .sidebar-header { padding: 0 10px !important; justify-content: center !important; }
    html .wrapper.toggled:not(.sidebar-hovered) .sparepart-logo-wrapper { display: none !important; }
    html .wrapper.toggled:not(.sidebar-hovered) .sidebar-header .toggle-icon { margin: 0 !important; }
    html .wrapper.toggled:not(.sidebar-hovered) .sparepart-carnate-sidebar #menu .menu-title { display: none !important; }
    html .wrapper.toggled:not(.sidebar-hovered) .sparepart-carnate-sidebar #menu .dropdown-right-icon { display: none !important; }
    html .wrapper.toggled:not(.sidebar-hovered) .sparepart-carnate-sidebar .dropdown-content { display: none !important; }
    html .wrapper.toggled:not(.sidebar-hovered) .sparepart-carnate-sidebar #menu > li.menu-section {
        height: 1px !important;
        padding: 0 !important;
        margin: 8px 6px !important;
        border-top: 1px solid #e2e8f0 !important;
        overflow: hidden !important;
        font-size: 0 !important;
        color: transparent !important;
    }
    html .wrapper.toggled:not(.sidebar-hovered) .sparepart-carnate-sidebar #menu > li > a { justify-content: center !important; padding: 10px 0 !important; gap: 0 !important; }
    html .wrapper.toggled:not(.sidebar-hovered) .sparepart-carnate-sidebar #menu .parent-icon { margin: 0 auto !important; font-size: 20px !important; }
}

@media (max-width: 1024px) {
    html .sidebar-wrapper.customsidebar.sparepart-carnate-sidebar { left: -270px !important; }
    html .page-wrapper { margin-left: 0 !important; }
    html .page-footer { left: 0 !important; }
    html .topbar { left: 0 !important; }
    html .wrapper.toggled .sidebar-wrapper.customsidebar.sparepart-carnate-sidebar { left: 0 !important; box-shadow: 4px 0 25px rgba(0,0,0,0.18) !important; }
}

@media (max-width: 767px) {
    .sidebar-wrapper.customsidebar.sparepart-carnate-sidebar { width: 260px !important; }
    .sidebar-wrapper.customsidebar.sparepart-carnate-sidebar .sidebar-header {
        flex-basis: 64px !important;
        height: 64px !important;
        min-height: 64px !important;
        max-height: 64px !important;
    }
    .sidebar-wrapper.customsidebar.sparepart-carnate-sidebar .sidebar-header .logo-icon {
        max-width: 145px !important;
    }
}
</style>


{{-- =========================================================
    CARNATE SPARE PART SIDEBAR
========================================================= --}}

<div class="sidebar-wrapper customsidebar sparepart-carnate-sidebar">


    {{-- =====================================================
        HEADER
    ====================================================== --}}

    <div class="sidebar-header">

        <div class="sparepart-logo-wrapper">

            <img
                src="{{ asset('assets/images/sidebarlogo.png') }}"
                class="logo-icon"
                alt="logo icon"
            >

        </div>


        <div class="toggle-icon">

            <i class="bx bx-arrow-to-left"></i>

        </div>

    </div>


    {{-- =====================================================
        NATIVE SCROLL AREA
    ====================================================== --}}

    <div class="carnate-sidebar-scroll">

        <ul class="metismenu carnate-menu" id="menu">


            {{-- =================================================
                MAIN
            ================================================== --}}

            <li class="menu-section">
                MAIN
            </li>


            {{-- Dashboard --}}

            @if (
                !$sparePart ||
                !$sparePart->roles->count() ||
                @$sparePart->hasPermissionTo('dashboard-show')
            )

                <li>

                    <a href="{{ route('sparepart.dashboard') }}">

                        <div class="parent-icon">

                            <i class="bx bx-home-circle"></i>

                        </div>


                        <div class="menu-title">

                            Dashboard

                        </div>

                    </a>

                </li>

            @endif


            {{-- Counter Sale --}}

            @if (@$sparePart->hasPermissionTo('countersale-show'))

                <li>

                    <a href="{{ route('sparepart.countersale') }}">

                        <div class="parent-icon">

                            <i class="fas fa-cubes"></i>

                        </div>


                        <div class="menu-title">

                            Counter Sale

                        </div>

                    </a>

                </li>

            @endif



            {{-- =================================================
                INVENTORY
            ================================================== --}}

            <li class="menu-section">

                INVENTORY

            </li>


            {{-- Parts --}}

            @if (@$sparePart->hasPermissionTo('part-show'))

                <li class="{{ request()->routeIs('sparepart.parts*') ? 'mm-active active' : '' }}">

                    <a href="{{ route('sparepart.parts') }}">

                        <div class="parent-icon">

                            <i class="fa-solid fa-cogs"></i>

                        </div>


                        <div class="menu-title">

                            Parts

                        </div>

                    </a>

                </li>

            @endif


            {{-- Accessory --}}

            @if (@$sparePart->hasPermissionTo('accessory-show'))

                <li class="{{ request()->routeIs('sparepart.accessory*') ? 'mm-active active' : '' }}">

                    <a href="{{ route('sparepart.accessory') }}">

                        <div class="parent-icon">

                            <i class="fa-solid fa-toolbox"></i>

                        </div>


                        <div class="menu-title">

                            Accessory

                        </div>

                    </a>

                </li>

            @endif


            {{-- Lubricants --}}

            @if (@$sparePart->hasPermissionTo('lubricant-show'))

                <li>

                    <a href="{{ route('sparepart.lubricants') }}">

                        <div class="parent-icon">

                            <i class="fa-solid fa-oil-can"></i>

                        </div>


                        <div class="menu-title">

                            Lubricants

                        </div>

                    </a>

                </li>

            @endif


            {{-- Tools --}}

            @if (@$sparePart->hasPermissionTo('tools-show'))

                <li>

                    <a href="{{ route('sparepart.tools') }}">

                        <div class="parent-icon">

                            <i class="fa-solid fa-wrench"></i>

                        </div>


                        <div class="menu-title">

                            Tools

                        </div>

                    </a>

                </li>

            @endif


            {{-- Inventory Dropdown --}}

            @php
                $isInvActive = request()->routeIs('sparepart.suppliers*') || request()->routeIs('sparepart.purchaseorder*') || request()->routeIs('sparepart.stock.list*');
            @endphp

            <li>

                <div class="dropdown w-100 {{ $isInvActive ? 'is-open active' : '' }}">

                    <a href="javascript:void(0)">

                        <div class="parent-icon">

                            <i class="fas fa-boxes"></i>

                        </div>


                        <div class="menu-title">

                            Inventory

                        </div>


                        <span class="fa fa-chevron-right dropdown-right-icon icon"></span>

                    </a>


                    <div class="dropdown-content">

                        <a href="{{ route('sparepart.suppliers') }}" class="{{ request()->routeIs('sparepart.suppliers*') ? 'active' : '' }}">

                            Suppliers

                        </a>


                        <a href="{{ route('sparepart.purchaseorder') }}" class="{{ request()->routeIs('sparepart.purchaseorder*') ? 'active' : '' }}">

                            Purchase Order

                        </a>


                        <a href="{{ route('sparepart.stock.list') }}" class="{{ request()->routeIs('sparepart.stock.list*') ? 'active' : '' }}">

                            Stock List

                        </a>

                    </div>

                </div>

            </li>



            {{-- =================================================
                ORDERS
            ================================================== --}}

            <li class="menu-section">

                ORDERS

            </li>


            {{-- Order --}}

            @if (@$sparePart->hasPermissionTo('order-show'))

                @php
                    $isOrderActive = request()->routeIs('sparepart.order*') || request()->routeIs('sparepart.paid-order*');
                @endphp

                <li>

                    <div class="dropdown w-100 {{ $isOrderActive ? 'is-open active' : '' }}">

                        <a href="javascript:void(0)">

                            <div class="parent-icon">

                                <i class="fas fa-shopping-cart"></i>

                            </div>


                            <div class="menu-title">

                                Order

                            </div>


                            <span class="fa fa-chevron-right dropdown-right-icon icon"></span>

                        </a>


                        <div class="dropdown-content">

                            <a href="{{ route('sparepart.order') }}" class="{{ request()->routeIs('sparepart.order*') ? 'active' : '' }}">

                                Order

                            </a>


                            <a href="{{ route('sparepart.paid-order') }}" class="{{ request()->routeIs('sparepart.paid-order*') ? 'active' : '' }}">

                                Paid Order

                            </a>

                        </div>

                    </div>

                </li>

            @endif



            {{-- =================================================
                FINANCE
            ================================================== --}}

            <li class="menu-section">

                FINANCE

            </li>


            {{-- Expenses Master --}}

            @if (@$sparePart->hasPermissionTo('expenses-show'))

                @php
                    $isExpenseActive = request()->routeIs('sparepart.expenses*') || request()->routeIs('sparepart.expense.*');
                @endphp

                <li>

                    <div class="dropdown w-100 {{ $isExpenseActive ? 'is-open active' : '' }}">

                        <a href="javascript:void(0)">

                            <div class="parent-icon">

                                <i class="fas fa-file-invoice"></i>

                            </div>


                            <div class="menu-title">

                                Expenses Master

                            </div>


                            <span class="fa fa-chevron-right dropdown-right-icon icon"></span>

                        </a>


                        <div class="dropdown-content">

                            <a href="{{ route('sparepart.expenses') }}" class="{{ request()->routeIs('sparepart.expenses*') ? 'active' : '' }}">

                                Expenses

                            </a>


                            <a href="{{ route('sparepart.expense.category') }}" class="{{ request()->routeIs('sparepart.expense.category*') ? 'active' : '' }}">

                                Expense Category

                            </a>


                            <a href="{{ route('sparepart.expense.supplier') }}" class="{{ request()->routeIs('sparepart.expense.supplier*') ? 'active' : '' }}">

                                Expense Supplier

                            </a>

                        </div>

                    </div>

                </li>

            @endif


            {{-- Wallet --}}

            @if (@$sparePart->hasPermissionTo('wallet-show'))

                <li>

                    <a href="{{ route('sparepart.withdrawal') }}">

                        <div class="parent-icon">

                            <i class="fas fa-wallet"></i>

                        </div>


                        <div class="menu-title">

                            Wallet

                        </div>

                    </a>

                </li>

            @endif



            {{-- =================================================
                CATALOG
            ================================================== --}}

            <li class="menu-section">

                CATALOG

            </li>


            {{-- Category --}}

            @if (@$sparePart->hasPermissionTo('category-show'))

                <li>

                    <a href="{{ route('sparepart.category') }}">

                        <div class="parent-icon">

                            <i class="fas fa-tags"></i>

                        </div>


                        <div class="menu-title">

                            Category

                        </div>

                    </a>

                </li>

            @endif


            {{-- Unit --}}

            @if (@$sparePart->hasPermissionTo('unit-show'))

                <li>

                    <a href="{{ route('sparepart.unit') }}">

                        <div class="parent-icon">

                            <i class="fas fa-cubes"></i>

                        </div>


                        <div class="menu-title">

                            Unit

                        </div>

                    </a>

                </li>

            @endif



            {{-- =================================================
                HIDDEN LEGACY INVENTORY
            ================================================== --}}

            <li class="d-none">

                <div class="dropdown w-100">

                    <a href="#">

                        <div class="parent-icon">

                            <i class="fas fa-car"></i>

                        </div>


                        <div class="menu-title">

                            Inventory

                        </div>


                        <span class="fa fa-chevron-right dropdown-right-icon icon"></span>

                    </a>


                    <div class="dropdown-content">

                        @if (@$sparePart->hasPermissionTo('part-show'))

                            <a href="{{ route('sparepart.parts') }}">

                                Parts

                            </a>

                        @endif


                        @if (@$sparePart->hasPermissionTo('accessory-show'))

                            <a href="{{ route('sparepart.accessory') }}">

                                Accessory

                            </a>

                        @endif


                        @if (@$sparePart->hasPermissionTo('tools-show'))

                            <a href="{{ route('sparepart.tools') }}">

                                Tools

                            </a>

                        @endif


                        @if (@$sparePart->hasPermissionTo('lubricant-show'))

                            <a href="{{ route('sparepart.lubricants') }}">

                                Lubricants

                            </a>

                        @endif

                    </div>

                </div>

            </li>



            {{-- =================================================
                ADMIN
            ================================================== --}}

            <li class="menu-section">

                ADMIN

            </li>


            {{-- Reports --}}

            @if (
                !$sparePart ||
                !$sparePart->roles->count() ||
                @$sparePart->hasPermissionTo('report-show')
            )

                @php
                    $isReportsActive = request()->routeIs('sparepart.report.*');
                @endphp

                <li>

                    <div class="dropdown w-100 {{ $isReportsActive ? 'is-open active' : '' }}">

                        <a href="javascript:void(0)">

                            <div class="parent-icon">

                                <i class="fas fa-chart-line"></i>

                            </div>


                            <div class="menu-title">

                                Reports

                            </div>


                            <span class="fa fa-chevron-right dropdown-right-icon icon"></span>

                        </a>


                        <div class="dropdown-content">

                            <a href="{{ route('sparepart.report.orders') }}" class="{{ request()->routeIs('sparepart.report.orders*') ? 'active' : '' }}">

                                Orders Report

                            </a>


                            <a href="{{ route('sparepart.report.countersale') }}" class="{{ request()->routeIs('sparepart.report.countersale*') ? 'active' : '' }}">

                                Counter Sales Report

                            </a>


                            <a href="{{ route('sparepart.report.payments') }}" class="{{ request()->routeIs('sparepart.report.payments*') ? 'active' : '' }}">

                                Payments Report

                            </a>


                            <a href="{{ route('sparepart.report.stock') }}" class="{{ request()->routeIs('sparepart.report.stock*') ? 'active' : '' }}">

                                Stock Report

                            </a>


                            <a href="{{ route('sparepart.report.commission') }}" class="{{ request()->routeIs('sparepart.report.commission*') ? 'active' : '' }}">

                                Commission Report

                            </a>


                            <a href="{{ route('sparepart.report.salary') }}" class="{{ request()->routeIs('sparepart.report.salary*') ? 'active' : '' }}">

                                Salary Report

                            </a>


                            <a href="{{ route('sparepart.report.expenses') }}" class="{{ request()->routeIs('sparepart.report.expenses*') ? 'active' : '' }}">

                                Expenses Report

                            </a>

                            <a href="{{ route('sparepart.report.profit-loss') }}" class="{{ request()->routeIs('sparepart.report.profit-loss*') ? 'active' : '' }}">

                                Profit & Loss Report

                            </a>

                        </div>

                    </div>

                </li>

            @endif


            {{-- Staff --}}

            @if (@$sparePart->hasPermissionTo('staff-show'))

                <li>

                    <a href="{{ route('sparepart.sparepartstaff') }}">

                        <div class="parent-icon">

                            <i class="fas fa-users-cog"></i>

                        </div>


                        <div class="menu-title">

                            Staff

                        </div>

                    </a>

                </li>

            @endif


            {{-- Role --}}

            @if (@$sparePart->hasPermissionTo('roles-show'))

                <li>

                    <a href="{{ route('sparepart.manageadminrole') }}">

                        <div class="parent-icon">

                            <i class="bx bx-shield"></i>

                        </div>


                        <div class="menu-title">

                            Role

                        </div>

                    </a>

                </li>

            @endif


            {{-- Reset Password --}}

            <li>

                <a href="{{ route('sparepart.resetpassword') }}">

                    <div class="parent-icon">

                        <i class="bx bx-refresh"></i>

                    </div>


                    <div class="menu-title">

                        Reset Password

                    </div>

                </a>

            </li>



            {{-- =================================================
                SUPPORT
            ================================================== --}}

            @if (
                !$sparePart ||
                !$sparePart->roles->count() ||
                @$sparePart->hasPermissionTo('support-show')
            )

                <li class="support-item">

                    <div class="dropdown w-100 support-card">

                        <a href="javascript:void(0)">

                            <div class="d-flex align-items-center">

                                <div class="parent-icon">

                                    <i class="fa-solid fa-circle-info"></i>

                                </div>


                                <div class="menu-title">

                                    Support

                                </div>

                            </div>


                            <span class="fa fa-chevron-right dropdown-right-icon"></span>

                        </a>


                        <div class="dropdown-content">

                            <a href="tel:+918147938343">

                                <i class="fa-solid fa-phone"></i>

                                <span>
                                    +91 8147 938 343
                                </span>

                            </a>


                            <a href="mailto:carnateindia@gmail.com">

                                <i class="fa-solid fa-envelope"></i>

                                <span>
                                    carnateindia@gmail.com
                                </span>

                            </a>

                        </div>

                    </div>

                </li>

            @endif



            {{-- =================================================
                LOGOUT
            ================================================== --}}

            <li>

                <a href="{{ route('unified.logout') }}">

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
    FORCE NATIVE SIDEBAR SCROLL
========================================================= --}}

<script>

(function () {

    function initCarnateSidebarScroll() {

        const sidebar = document.querySelector(
            '.sidebar-wrapper.customsidebar'
        );

        const scrollArea = document.querySelector(
            '.sidebar-wrapper.customsidebar .carnate-sidebar-scroll'
        );

        if (!sidebar || !scrollArea) {
            return;
        }


        function resizeSidebar() {

            const header = sidebar.querySelector(
                '.sidebar-header'
            );

            const headerHeight = header
                ? header.offsetHeight
                : 100;

            const viewportHeight =
                window.innerHeight;


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


        window.addEventListener(
            'resize',
            resizeSidebar
        );


        /*
         * Recalculate after dropdown state changes.
         */

        document.addEventListener(
            'click',
            function (event) {

                const dropdownTrigger =
                    event.target.closest(
                        '.sidebar-wrapper.customsidebar .dropdown > a'
                    );

                if (!dropdownTrigger) {
                    return;
                }


                setTimeout(
                    function () {

                        resizeSidebar();

                    },
                    300
                );

            }
        );

    }


    function initCarnateSidebarDropdowns() {
        // Toggle submenus on CLICK only (no hover)
        document.querySelectorAll('.sidebar-wrapper.customsidebar .dropdown > a').forEach(function (toggleLink) {
            if (toggleLink.dataset.dropdownInit) return;
            toggleLink.dataset.dropdownInit = 'true';

            toggleLink.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                var parentDropdown = this.closest('.dropdown');
                if (parentDropdown) {
                    var willOpen = !parentDropdown.classList.contains('is-open');
                    parentDropdown.classList.toggle('is-open', willOpen);
                }
            });
        });

        // Ensure active dropdowns remain open and visually highlighted based on current URL
        var currentUrl = window.location.href.split(/[?#]/)[0];
        document.querySelectorAll('.sidebar-wrapper.customsidebar .dropdown-content a').forEach(function (subLink) {
            var linkUrl = (subLink.href || '').split(/[?#]/)[0];
            if (linkUrl && currentUrl === linkUrl) {
                subLink.classList.add('active');
                var parentDropdown = subLink.closest('.dropdown');
                if (parentDropdown) {
                    parentDropdown.classList.add('is-open', 'active');
                }
            }
        });
    }


    if (
        document.readyState === 'loading'
    ) {

        document.addEventListener(
            'DOMContentLoaded',
            function () {
                initCarnateSidebarScroll();
                initCarnateSidebarDropdowns();
            }
        );

    } else {

        initCarnateSidebarScroll();
        initCarnateSidebarDropdowns();

    }


    document.addEventListener(
        'livewire:navigated',
        function () {

            setTimeout(
                function () {
                    initCarnateSidebarScroll();
                    initCarnateSidebarDropdowns();
                },
                300
            );

        }
    );

})();

</script>
