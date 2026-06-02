<div class="sidebar-wrapper customsidebar" data-simplebar="init">
    <div class="simplebar-wrapper" style="margin: 0px;">
        <div class="simplebar-height-auto-observer-wrapper">
            <div class="simplebar-height-auto-observer"></div>
        </div>
        <div class="simplebar-mask">
            <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                <div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden scroll;">
                    <div class="simplebar-content mm-active" style="padding: 0px;">
                        <div class="sidebar-header">
                            <div>
                                <img src="{{ asset('assets/images/sidebarlogo.png') }}" class="logo-icon" alt="logo icon">
                            </div>
                            <div class="toggle-icon ms-auto"><i class="bx bx-arrow-to-left"></i>
                            </div>
                        </div>
                        <ul class="metismenu mm-show" id="menu">
                           <li>
                                <a href="{{route('workshop.dashboard')}}" >
                                    <div class="parent-icon"><i class="bx bx-home-circle"></i>
                                    </div>
                                    <div class="menu-title">Dashboard</div>
                                </a>
                            </li> 
                            <li>
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
