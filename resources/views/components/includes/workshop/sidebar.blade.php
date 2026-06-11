<?php
$id = Auth::guard('workshop')->user()->id;

$user = App\Models\WorkShopVendor::where('id', $id)->first();

// echo "<pre>";print_r($user);die;
$logo = App\Models\WorkShopVendor::where('id', Auth::guard('workshop')->user()->id)->first();
  $uploadedLogo = null;
    if (!empty($logo->Image) && !empty($logo->Image->file)) {
        $fullPath = public_path($logo->Image->file);
        if (file_exists($fullPath)) {
            $uploadedLogo = 'data:image/png;base64,' . base64_encode(file_get_contents($fullPath));
        }
    }
// dd($logo->Image->file);
?>
<div class="sidebar-wrapper customsidebar" data-simplebar="init">
    <div class="simplebar-wrapper" style="margin: 0px;">
        <div class="simplebar-height-auto-observer-wrapper">
            <div class="simplebar-height-auto-observer"></div>
        </div>
        <div class="simplebar-mask">
            <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                <div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden scroll;">
                    <div class="simplebar-content mm-active" style="padding: 0px;">
                  <div class="sidebar-header" style="display: flex; align-items: center; justify-content: space-between; padding: 10px;">
    <!--<div>-->
                         <div>
                               <img src="{{ asset('assets/images/sidebarlogo.png') }}" class="logo-icon"
                                    alt="logo icon">

                                  {{--   <img src="{{ file_exists(public_path($logo->Image->file)) ? 'data:image/png;base64,' . base64_encode(file_get_contents(public_path($logo->Image->file))) : asset('path/to/default/image.png') }}"alt="Logo" class="logo-icon"> --}}
                                    {{--  <img
        src="{{ $uploadedLogo ?? asset('assets/images/sidebarlogo.png') }}" alt="Workshop Logo" class="logo-icon">  --}}

                            </div>
    <!--</div>-->
                             <div class="toggle-icon ms-auto" onclick="toggleSidebar()" style="cursor: pointer;">
                            <i class="bx bx-arrow-to-left"></i>
                          </div>
                           </div>

                        <ul class="metismenu mm-show" id="menu">
                            @if (@$user->hasPermissionTo('dashboard-show'))
                            <li>
                                <a href="{{ route('workshop.dashboard') }}">
                                    <div class="parent-icon"><i class="bx bx-home-circle"></i>
                                    </div>
                                    <div class="menu-title">Dashboard</div>
                                </a>
                            </li>
                            @endif
                            @if (@$user->hasPermissionTo('counter-sale-show'))
                                <li>
                                    <a href="{{ route('workshop.counter_sale') }}">
                                        <div class="parent-icon"><i class="fas fa-cubes fs-5"></i>
                                        </div>
                                        <div class="menu-title">Counter Sale</div>
                                    </a>
                                </li>
                            @endif

                            @if (@$user->hasPermissionTo('staff-show'))
                                <li>
                                    <a href="{{ route('workshop.staff') }}">
                                        <div class="parent-icon"><i class="fas fa-users-cog fs-5"></i>
                                        </div>
                                        <div class="menu-title">Staff</div>
                                    </a>
                                </li>
                            @endif
                            {{-- <li>
                                <a href="{{ route('workshop.labourchare') }}">
                                    <div class="parent-icon"><i class="fas fa-users-cog fs-5"></i>
                                    </div>
                                    <div class="menu-title">Labour Charge</div>
                                </a>
                            </li> --}}
                            @if (@$user->hasPermissionTo('customer-show'))
                                <li>
                                    <a href="{{ route('workshop.customer') }}">
                                        <div class="parent-icon"><i class="fas fa-handshake fs-5"></i>
                                        </div>
                                        <div class="menu-title">Customers</div>
                                    </a>
                                </li>
                            @endif
                            @if (@$user->hasPermissionTo('Jobcard-show'))
                                <li>
                                    <a href="{{ route('workshop.jobcard') }}">
                                        <div class="parent-icon"><i class="fas fa-tasks fs-5"></i>
                                        </div>
                                        <div class="menu-title">Job-Card</div>
                                    </a>
                                </li>
                            @endif
                            @if (@$user->hasPermissionTo('Appointment-show'))
                            <li>
                                <a href="{{ route('workshop.appointments') }}">
                                    <div class="parent-icon"><i class="bx bxs-calendar fs-5"></i>
                                    </div>
                                    <div class="menu-title">Appointments</div>
                                </a>
                            </li>
                            @endif
                            @if (@$user->hasPermissionTo('expenses-show'))
                                <li>
                                    <a href="{{ route('workshop.expenses') }}">
                                        <div class="parent-icon"><i
                                                class="fa-solid fa-clipboard-check margin-right-10px"></i>
                                        </div>
                                        <div class="menu-title">Expenses</div>
                                    </a>
                                </li>
                            @endif
                            @if (@$user->hasPermissionTo('online-store-show'))
                                <li>
                                    <a href="{{ route('workshop.vehicle_search') }}">
                                        <div class="parent-icon"><i class="bx bx-user"></i>
                                        </div>
                                        <div class="menu-title">Online store</div>
                                    </a>
                                </li>
                            @endif
                            {{-- @if (@$user->hasPermissionTo('purchaseorder-show'))
                                <li>
                                    <a href="{{ route('workshop.purchaseorder') }}">
                                        <div class="parent-icon"><i class="bx bx-box"></i>
                                        </div>
                                        <div class="menu-title">Purchase Stock</div>
                                    </a>
                                </li>
                            @endif --}}
                            {{-- @if (@$user->hasPermissionTo('purchasestock-show'))
                                <li>
                                    <a href="{{ route('workshop.productstock') }}">
                                        <div class="parent-icon"><i class="bx bx-user"></i>
                                        </div>
                                        <div class="menu-title">Add Stock</div>
                                    </a>
                                </li>
                            @endif --}}
                           {{--  @if (@$user->hasPermissionTo('purchasestock-show') || @$user->hasPermissionTo('labour-charge-show'))
                                <li>
                                    <div class="dropdown w-100">
                                        <a href="javascript:void(0)">
                                            <div class="parent-icon"><i class="fas fa-boxes fs-5"></i>
                                            </div>
                                            <div class="menu-title w-100">Inventory</div><span
                                                class="fa fa-chevron-right dropdown-right-icon icon"> </span>
                                        </a>
                                        <div class="dropdown-content">
                                            @if (@$user->hasPermissionTo('purchasestock-show'))
                                                <a href="{{ route('workshop.productstock') }}" class="ms-3"
                                                    style="background-color: unset;">
                                                    Stock
                                                </a>
                                            @endif
                                            @can('labour-charge-show')
                                                <a href="{{ route('workshop.labourchare') }}" class="ms-3"
                                                    style="background-color: unset;">
                                                    Labour Charge
                                                </a>
                                            @endcan
                                        </div>
                                    </div>
                                </li>
                            @endif --}}
                            <li>
    <div class="dropdown w-100">
        <a href="javascript:void(0)">
            <div class="parent-icon"><i class="fas fa-boxes fs-5"></i></div>
            <div class="menu-title w-100">Inventory</div>
            <span class="fa fa-chevron-right dropdown-right-icon icon"></span>
        </a>
        <div class="dropdown-content">
            {{-- Show stock only if permission exists --}}
            @if (@$user->hasPermissionTo('purchasestock-show'))
                <a href="{{ route('workshop.productstock') }}" class="ms-3" style="background-color: unset;">
                    Stock
                </a>
            @endif
<!-- manish -->
            {{-- Supplier link below Stock --}}
            <a href="{{ route('workshop.suppliers') }}" class="ms-3" style="background-color: unset;">
                Supplier
            </a>

            {{-- Always show Labour Charge --}}
            <a href="{{ route('workshop.labourchare') }}" class="ms-3" style="background-color: unset;">
                Labour Charge
            </a>
        </div>
    </div>
</li>

                            @if (@$user->hasPermissionTo('role-show'))
                                <li>
                                    <a href="{{ route('workshop.managerole') }}">
                                        <div class="parent-icon"><i class="bx bx-shield"></i>
                                        </div>
                                        <div class="menu-title">Role</div>
                                    </a>
                                </li>
                            @endif
                            <li class="d-none">
                                <a href="{{ route('workshop.managepermission') }}">
                                    <div class="parent-icon"><i class="bx bx-user"></i>
                                    </div>
                                    <div class="menu-title">Permission</div>
                                </a>
                            </li>
                            {{-- <li>
                                <a href="{{ route('workshop.plan') }}">
                                    <div class="parent-icon"><i class="bx bx-star"></i>
                                    </div>
                                    <div class="menu-title"> Subscription </div>
                                </a>
                            </li> --}}
                            @if (@$user->hasPermissionTo('reset_password-show'))
                                <li>
                                    <a href="{{ route('workshop.resetpassword') }}">
                                        <div class="parent-icon"><i class="bx bx-refresh"></i>
                                        </div>
                                        <div class="menu-title"> Reset Password </div>
                                    </a>
                                </li>
                            @endif
                            @if (@$user->hasPermissionTo('order-show'))
                                <li>
                                    <a href="{{ route('workshop.orders') }}">
                                        <div class="parent-icon"><i class="fas fa-shopping-cart fs-5"></i>
                                        </div>
                                        <div class="menu-title"> Order </div>
                                    </a>
                                </li>
                            @endif
                            @if (@$user->hasPermissionTo('paid-order-show'))
                                <li>
                                    <a href="{{ route('workshop.paid-orders') }}">
                                        <div class="parent-icon"><i class="fas fa-shopping-cart fs-5"></i>
                                        </div>
                                        <div class="menu-title"> Paid-Order </div>
                                    </a>
                                </li>
                            @endif
                            @if (@$user->hasPermissionTo('report-show'))
                                <li>
                                    <div class="dropdown w-100">
                                        <a href="javascript:void(0)">
                                            <div class="parent-icon"><i class="fas fa-chart-line fs-5"></i></div>
                                            <div class="menu-title w-100">Report</div>
                                            <span class="fa fa-chevron-right dropdown-right-icon icon"></span>
                                        </a>
                                        <div class="dropdown-content">
                                            <a href="{{ route('workshop.report.salary') }}" class="ms-3" style="background-color: unset;">Salary Report</a>
                                            <a href="{{ route('workshop.report.customers') }}" class="ms-3" style="background-color: unset;">Customers Report</a>
                                            <a href="{{ route('workshop.report.jobcards') }}" class="ms-3" style="background-color: unset;">Job Cards Report</a>
                                            <a href="{{ route('workshop.report.staff') }}" class="ms-3" style="background-color: unset;">Staff Report</a>
                                            <a href="{{ route('workshop.report.expenses') }}" class="ms-3" style="background-color: unset;">Expenses Report</a>
                                            <a href="{{ route('workshop.report.inventory') }}" class="ms-3" style="background-color: unset;">Inventory Report</a>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @if (@$user->hasPermissionTo('support-show'))
                                <li style="list-style:none; margin:8px 0;">
    <div class="dropdown w-100" style="position:relative;">

        <a href="javascript:void(0)"
            style="
                display:flex;
                align-items:center;
                justify-content:space-between;
                padding:12px 18px;
                text-decoration:none;
                background:linear-gradient(135deg,#2c3e50,#4ca1af);
                border-radius:14px;
                color:#fff;
                box-shadow:0 5px 15px rgba(0,0,0,0.15);
                transition:0.3s;
            ">

            <div style="display:flex;align-items:center;">
                <div class="parent-icon"
                    style="
                        width:38px;
                        height:38px;
                        border-radius:50%;
                        background:rgba(255,255,255,0.15);
                        display:flex;
                        align-items:center;
                        justify-content:center;
                        margin-right:12px;
                    ">
                    <i class="fa-solid fa-circle-info"></i>
                </div>

                <div class="menu-title"
                    style="font-size:16px;font-weight:600;letter-spacing:0.5px;">
                    Support
                </div>
            </div>

            <span class="fa fa-chevron-down"
                style="font-size:13px;color:#fff;"></span>
        </a>

        <div class="dropdown-content"
            style="
                background:#fff;
                margin-top:8px;
                border-radius:12px;
                overflow:hidden;
                box-shadow:0 8px 20px rgba(0,0,0,0.12);
            ">

            <a href="tel:+918147938343"
                style="
                    display:flex;
                    align-items:center;
                    gap:10px;
                    padding:12px 18px;
                    color:#333;
                    text-decoration:none;
                    border-bottom:1px solid #f1f1f1;
                ">
                <i class="fa-solid fa-phone" style="color:#4ca1af;"></i>
                +91 8147 938 343
            </a>

            <a href="mailto:carnateindia@gmail.com"
                style="
                    display:flex;
                    align-items:center;
                    gap:10px;
                    padding:12px 18px;
                    color:#333;
                    text-decoration:none;
                ">
                <i class="fa-solid fa-envelope" style="color:#4ca1af;"></i>
                carnateindia@gmail.com
            </a>

        </div>
    </div>
</li>
                            @endif
                            <li>
                                <!-- <a href="{{ route('workshop.logout') }}"> -->
                                <a href="{{ route('unified.logout') }}">
                                    <div class="parent-icon"><i class="bx bx-log-out-circle"></i>
                                    </div>
                                    <div class="menu-title"> Logout </div>
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="simplebar-placeholder" style="width: auto; height: 1391px;"></div>
    </div>
    <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
        <div class="simplebar-scrollbar simplebar-visible" style="width: 0px; display: none;"></div>
    </div>
    <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
        <div class="simplebar-scrollbar simplebar-visible"
            style="height: 78px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
    </div>
</div>
// <script>
//     let isCollapsed = false;
//     function toggleSidebar() {
//         const logo = document.getElementById('sidebar-logo');
//         const sidebar = document.querySelector('.customsidebar');

//         if (!isCollapsed) {
//             // Collapse mode: chhoti height
//             logo.style.height = '5px';
//             logo.style.width = 'auto';
//             sidebar.style.width = '10px'; // Optional: collapse width
//         } else {
//             // Expand mode: normal height
//             logo.style.height = '30px';
//             logo.style.width = 'auto';
//             sidebar.style.width = '250px'; // Optional: full width
//         }

//         isCollapsed = !isCollapsed;
//     }
// </script>

