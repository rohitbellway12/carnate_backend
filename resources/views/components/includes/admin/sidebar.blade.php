<?php
$id = Auth::guard('admin')->user()->id;

$admin = App\Models\Admin::where('id', $id)->first();

// echo "<pre>";print_r($user);die;

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
                                <a href="{{ route('admin.dashboard') }}">
                                    <div class="parent-icon"><i class="bx bx-home-circle  fs-5"></i>
                                    </div>
                                    <div class="menu-title">Dashboard</div>
                                </a>
                            </li>
                            @if (@$admin->hasPermissionTo('sub-admin-show'))
                                <li>
                                    <a href="{{ route('admin.sub.admin') }}">
                                        <div class="parent-icon"><i class="fas fa-user-shield  fs-5"></i>
                                        </div>
                                        <div class="menu-title">Sub Admin</div>
                                    </a>
                                </li>
                            @endif
                             @if (@$admin->hasPermissionTo('expense-category-show') || @$admin->hasPermissionTo('expenses-show'))
                                <li>
                                    <div class="dropdown w-100">
                                        <a href="#">
                                            <div class="parent-icon"><i class="fas fa-money-bill-wave fs-5"></i></div>
                                            <div class="menu-title w-100">Expenses</div><span class="fa fa-chevron-right dropdown-right-icon icon"></span>
                                        </a>
                                        <div class="dropdown-content">
                                            @if (@$admin->hasPermissionTo('expense-category-show'))
                                                <a href="{{ route('admin.expense.category') }}" style="background-color: unset;">Expense Category</a>
                                            {{-- @endif
                                            @if (@$admin->hasPermissionTo('expenses-show')) --}}
                                                <a href="{{ route('admin.expenses') }}" style="background-color: unset;">Expenses</a>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                            @endif
                            <li class="">

                                <div class="dropdown w-100">
                                    <a href="#">
                                        <div class="parent-icon"><i class="fas fa-tools fs-5"></i>
                                        </div>
                                        <div class="menu-title w-100">Spare Part</div><span
                                            class="fa fa-chevron-right dropdown-right-icon icon"> </span>
                                    </a>
                                    <div class="dropdown-content">
                                        @if (@$admin->hasPermissionTo('spare-part-vendor-show'))
                                            <a href="{{ route('admin.spare.part.vendor') }}"
                                                style="background-color: unset;">Spare Part vendor</a>
                                        @endif
                                        @if (@$admin->hasPermissionTo('spare-part-label-show'))
                                            <a href="{{ route('admin.spare.part.label') }}"
                                                style="background-color: unset;">Spare Part label</a>
                                        @endif
                                        @if (@$admin->hasPermissionTo('spare-part-category-show'))
                                            <a href="{{ route('admin.spare.part.category') }}"
                                                style="background-color: unset;">Spare Part category</a>
                                        @endif
                                        @if (@$admin->hasPermissionTo('spare-part-unit-show'))
                                            <a href="{{ route('admin.spare.part.unit') }}"
                                                style="background-color: unset;">Spare Part units</a>
                                        @endif
                                    </div>
                                </div>
                            </li>
                           
                            @if (@$admin->hasPermissionTo('customer-show'))
                                <li>
                                    <a href="{{ route('admin.customer') }}">
                                        <div class="parent-icon"><i class="fas fa-handshake fs-5"></i>
                                        </div>
                                        <div class="menu-title">Customer</div>
                                    </a>
                                </li>
                            @endif
                            @if (@$admin->hasPermissionTo('jobcard-show'))
                                <li>
                                    <a href="{{ route('admin.job.card') }}">
                                        <div class="parent-icon"><i class="fas fa-tasks fs-5"></i>
                                        </div>
                                        <div class="menu-title">Job-Cards</div>
                                    </a>
                                </li>
                            @endif
                            @if (@$admin->hasPermissionTo('work-shop-vendor-show'))
                                <li>
                                    <a href="{{ route('admin.work.shop.vendor') }}">
                                        <div class="parent-icon"><i class="bx bx-user fs-5"></i>
                                        </div>
                                        <div class="menu-title">Work Shop Vendor</div>
                                    </a>
                                </li>
                            @endif
                            @if (@$admin->hasPermissionTo('plan-show'))
                                <li>
                                    <a href="{{ route('admin.plan') }}">
                                        <div class="parent-icon"><i class="fas fa-file-contract fs-5"></i>
                                        </div>
                                        <div class="menu-title">Subscription Plan</div>
                                    </a>
                                </li>
                            @endif
                            <li>
                                <a href="{{ route('admin.order-list') }}">
                                    <div class="parent-icon"><i class="fas fa-shopping-cart fs-5"></i>
                                    </div>
                                    <div class="menu-title">Order</div>
                                </a>
                            </li>
                            <li class="">
                                <div class="dropdown w-100">
                                    <a href="#">
                                        <div class="parent-icon"><i class="fas fa-car fs-5"></i>
                                        </div>
                                        <div class="menu-title w-100">Vehicles</div><span
                                            class="fa fa-chevron-right dropdown-right-icon icon"> </span>
                                    </a>
                                    <div class="dropdown-content">
                                        @if (@$admin->hasPermissionTo('vehicle-show'))
                                            <a href="{{ route('admin.vehicle') }}"
                                                style="background-color: unset;">Vehicle
                                                List</a>
                                        @endif
                                        @if (@$admin->hasPermissionTo('makers-type-show'))
                                            <a href="{{ route('admin.makers_type') }}"
                                                style="background-color: unset;">Brand</a>
                                        @endif
                                        @if (@$admin->hasPermissionTo('maker-show'))
                                            <a href="{{ route('admin.maker') }}"
                                                style="background-color: unset;">Variant</a>
                                        @endif
                                        {{-- @if (@$admin->hasPermissionTo('models-show'))
                                            <a href="{{ route('admin.models') }}"
                                            style="background-color: unset;">Models</a>
                                            @endif
                                            
                                            @if (@$admin->hasPermissionTo('model-year-show'))   
                                            <a href="{{ route('admin.model_year') }}"
                                            style="background-color: unset;">Model Year</a>   
                                            @endif --}}
                                        @if (@$admin->hasPermissionTo('modification-show'))
                                            <a href="{{ route('admin.modification') }}"
                                                style="background-color: unset;">Modification</a>
                                        @endif
                                    </div>
                                </div>
                            </li>
                            @if (@$admin->hasPermissionTo('payment-show'))
                                <li>
                                    <a href="{{ route('admin.payment') }}">
                                        <div class="parent-icon"><i class="fas fa-coins fs-5"></i>
                                        </div>
                                        <div class="menu-title">Payment</div>
                                    </a>
                                </li>
                            @endif
                            @if (@$admin->hasPermissionTo('withdraw-show'))
                                <li>
                                    <a href="{{ route('admin.withdraw') }}">
                                        <div class="parent-icon"><i class="fas fa-coins fs-5"></i>
                                        </div>
                                        <div class="menu-title">Withdraw</div>
                                    </a>
                                </li>
                            @endif
                            @if (@$admin->hasPermissionTo('admin-role-show'))
                                <li>
                                    <a href="{{ route('admin.manageadminrole') }}">
                                        <div class="parent-icon"><i class="bx bx-shield"></i>
                                        </div>
                                        <div class="menu-title">Role</div>
                                    </a>
                                </li>
                            @endif
                            <li>
                                <div class="dropdown w-100">
                                    <a href="#">
                                        <div class="parent-icon"><i class="fas fa-chart-line fs-5"></i>
                                        </div>
                                        <div class="menu-title w-100">Report</div><span
                                            class="fa fa-chevron-right dropdown-right-icon icon"> </span>
                                    </a>
                                    <div class="dropdown-content">
                                        <a href="{{ route('admin.report.workshops') }}" style="background-color: unset;">Workshops Report</a>
                                        <a href="{{ route('admin.report.customers') }}" style="background-color: unset;">Customers Report</a>
                                        <a href="{{ route('admin.report.jobcards') }}" style="background-color: unset;">Job Cards Report</a>
                                        <a href="{{ route('admin.report.orders') }}" style="background-color: unset;">Orders Report</a>
                                        <a href="{{ route('admin.report.payments') }}" style="background-color: unset;">Payments Report</a>
                                        <a href="{{ route('admin.report.expenses') }}" style="background-color: unset;">Expenses Report</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="{{ route('admin.resetpassword') }}">
                                    <div class="parent-icon"><i class="bx bx-refresh"></i>
                                    </div>
                                    <div class="menu-title"> Reset Password </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.logout') }}">
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
