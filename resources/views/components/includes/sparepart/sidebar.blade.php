<?php
use Illuminate\Support\Facades\Auth;

$sparePart = null;
if (Auth::guard('sparepart')->check()) {
    $id = Auth::guard('sparepart')->user()->id;
    $sparePart = App\Models\SparePartVendor::where('id', $id)->first();
}
?>
<div class="sidebar-wrapper customsidebar" data-simplebar="init">
    <div class="simplebar-wrapper" style="margin: 0px;">
        <div class="simplebar-height-auto-observer-wrapper">
            <div class="simplebar-height-auto-observer"></div>
        </div>
        <div class="simplebar-mask">
            <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                <div class="simplebar-content-wrapper" style="height: 100%;overflow: hidden scroll;">
                    <div class="simplebar-content mm-active" style="padding: 0px;">
                        <div class="sidebar-header">
                            <div>
                                <img src="{{ asset('assets/images/sidebarlogo.png') }}" class="logo-icon"
                                    alt="logo icon">
                            </div>
                            <div class="toggle-icon ms-auto"><i class="bx bx-arrow-to-left"></i>
                            </div>
                        </div>
                        <ul class="metismenu mm-show" id="menu">
                            <li>
                                <a href="{{ route('sparepart.dashboard') }}">
                                    <div class="parent-icon"><i class="bx bx-home-circle"></i>
                                    </div>
                                    <div class="menu-title">Dashboard</div>
                                </a>
                            </li>
                            @if (@$sparePart->hasPermissionTo('countersale-show'))
                                <li>
                                    <a href="{{ route('sparepart.countersale') }}">
                                        <div class="parent-icon"><i class="fas fa-cubes fs-5"></i>
                                        </div>
                                        <div class="menu-title">Counter Sale</div>
                                    </a>
                                </li>
                            @endif
                            <li class="d-none">
                                <div class="dropdown w-100">
                                    <a href="#">
                                        <div class="parent-icon"><i class="fas fa-car fs-5"></i>
                                        </div>
                                        <div class="menu-title w-100">Inventory </div><span
                                            class="fa fa-chevron-right dropdown-right-icon icon"> </span>
                                    </a>
                                    <div class="dropdown-content">
                                        @if (@$sparePart->hasPermissionTo('accessory-show'))
                                            <a href="{{ route('sparepart.accessory') }}"
                                                style="background-color: unset;">Accessory </a>
                                        @endif
                                        @if (@$sparePart->hasPermissionTo('part-show'))
                                            <a href="{{ route('sparepart.parts') }}"
                                                style="background-color: unset;">Parts </a>
                                        @endif
                                        @if (@$sparePart->hasPermissionTo('tools-show'))
                                            <a href="{{ route('sparepart.tools') }}"
                                                style="background-color: unset;">Tools </a>
                                        @endif
                                        @if (@$sparePart->hasPermissionTo('lubricant-show'))
                                            <a href="{{ route('sparepart.lubricants') }}"
                                                style="background-color: unset;">Lubricants </a>
                                        @endif
                                    </div>
                                </div>
                            </li>
                            @if (@$sparePart->hasPermissionTo('accessory-show'))
                                <li>
                                    <a href="{{ route('sparepart.accessory') }}">
                                        <div class="parent-icon"><i class="fa-solid fa-toolbox fs-5"></i>
                                        </div>
                                        <div class="menu-title">Accessory</div>
                                    </a>
                                </li>
                            @endif
                            @if (@$sparePart->hasPermissionTo('part-show'))
                                <li>
                                    <a href="{{ route('sparepart.parts') }}">
                                        <div class="parent-icon"><i class="fa-solid fa-cogs fs-5"></i>
                                        </div>
                                        <div class="menu-title">Parts</div>
                                    </a>
                                </li>
                            @endif
                            @if (@$sparePart->hasPermissionTo('tools-show'))
                                <li>
                                    <a href="{{ route('sparepart.tools') }}">
                                        <div class="parent-icon"><i class="fa-solid fa-wrench fs-5"></i>
                                        </div>
                                        <div class="menu-title">Tools</div>
                                    </a>
                                </li>
                            @endif
                            @if (@$sparePart->hasPermissionTo('lubricant-show'))
                                <li>
                                    <a href="{{ route('sparepart.lubricants') }}">
                                        <div class="parent-icon"><i class="fa-solid fa-oil-can fs-5"></i>
                                        </div>
                                        <div class="menu-title">Lubricants</div>
                                    </a>
                                </li>
                            @endif
                            <!-- manish -->
                            <li>
                                <div class="dropdown w-100">
                                    <a href="#">
                                        <div class="parent-icon"><i class="fas fa-boxes fs-5"></i>
                                        </div>
                                        <div class="menu-title w-100">Inventory</div><span
                                            class="fa fa-chevron-right dropdown-right-icon icon"> </span>
                                    </a>
                                    <div class="dropdown-content">
                                       
                                            <a href="{{ route('sparepart.suppliers') }}"
                                                style="background-color: unset;">Suppliers</a>
                                                <a href="{{ route('sparepart.purchaseorder') }}" 
                                                style="background-color: unset;">Purchase Order</a>
                                                <a href="{{ route('sparepart.stock.list') }}" style="background-color: unset;"> Stock List </a>
                                    </div>
                                </div>
                            </li>
                            @if (@$sparePart->hasPermissionTo('unit-show'))
                                <li>
                                    <a href="{{ route('sparepart.unit') }}">
                                        <div class="parent-icon"><i class="fas fa-cubes fs-5"></i>
                                        </div>
                                        <div class="menu-title">Unit</div>
                                    </a>
                                </li>
                            @endif

                            @if (@$sparePart->hasPermissionTo('category-show'))
                                <li>
                                    <a href="{{ route('sparepart.category') }}">
                                        <div class="parent-icon"><i class="fas fa-tags fs-5"></i>
                                        </div>
                                        <div class="menu-title">Category</div>
                                    </a>
                                </li>
                            @endif
                           
                            @if (@$sparePart->hasPermissionTo('wallet-show'))
                                <li>
                                    <a href="{{ route('sparepart.withdrawal') }}">
                                        <div class="parent-icon"><i class="fas fa-wallet fs-5"></i>
                                        </div>
                                        <div class="menu-title">Wallet</div>
                                    </a>
                                </li>
                            @endif
                            @if (@$sparePart->hasPermissionTo('staff-show'))
                                <li>
                                    <a href="{{ route('sparepart.sparepartstaff') }}">
                                        <div class="parent-icon"><i class="fas fa-users-cog fs-5"></i>
                                        </div>
                                        <div class="menu-title">Staff</div>
                                    </a>
                                </li>
                            @endif
                            @if (@$sparePart->hasPermissionTo('roles-show'))
                                <li>
                                    <a href="{{ route('sparepart.manageadminrole') }}">
                                        <div class="parent-icon"><i class="bx bx-shield"></i>
                                        </div>
                                        <div class="menu-title">Role</div>
                                    </a>
                                </li>
                            @endif
                            @if (@$sparePart->hasPermissionTo('order-show'))
                                <li class="">
                                    <div class="dropdown w-100">
                                        <a href="#">
                                            <div class="parent-icon"><i class="fas fa-shopping-cart fs-5"></i>
                                            </div>
                                            <div class="menu-title w-100">Order</div><span
                                                class="fa fa-chevron-right dropdown-right-icon icon"> </span>
                                        </a>
                                        <div class="dropdown-content">

                                            <a href="{{ route('sparepart.order') }}"
                                                style="background-color: unset;">Order</a>
                                            <a href="{{ route('sparepart.paid-order') }}"
                                                style="background-color: unset;">Paid Order</a>

                                        </div>
                                    </div>
                                </li>
                            @endif
                            <li>
                                <div class="dropdown w-100">
                                    <a href="#">
                                        <div class="parent-icon"><i class="fas fa-chart-line fs-5"></i>
                                        </div>
                                        <div class="menu-title w-100">Reports</div><span
                                            class="fa fa-chevron-right dropdown-right-icon icon"> </span>
                                    </a>
                                    <div class="dropdown-content">
                                        <a href="{{ route('sparepart.report.orders') }}"
                                            style="background-color: unset;">Orders Report</a>
                                        <a href="{{ route('sparepart.report.countersale') }}"
                                            style="background-color: unset;">Counter Sales Report</a>
                                        <a href="{{ route('sparepart.report.payments') }}"
                                            style="background-color: unset;">Payments Report</a>
                                        <a href="{{ route('sparepart.report.stock') }}"
                                            style="background-color: unset;">Stock Report</a>
                                        <a href="{{ route('sparepart.report.commission') }}"
                                            style="background-color: unset;">Commission Report</a>
                                        <a href="{{ route('sparepart.report.salary') }}"
                                            style="background-color: unset;">Salary Report</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="{{ route('sparepart.resetpassword') }}">
                                    <div class="parent-icon"><i class="bx bx-refresh"></i>
                                    </div>
                                    <div class="menu-title"> Reset Password </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('unified.logout') }}">
                                    <div class="parent-icon"><i class="bx bx-log-out-circle fs-5"></i>
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
