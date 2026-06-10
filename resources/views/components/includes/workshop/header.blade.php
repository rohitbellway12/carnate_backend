<?php
$id = Auth::guard('workshop')->user()->id;

$user = App\Models\WorkShopVendor::where('id', $id)->first();

// echo "<pre>";print_r($user);die;  
$logo = App\Models\WorkShopVendor::where('id', Auth::guard('workshop')->user()->id)->first();

   $defaultLogo = asset('assets/images/sidebarlogo.png');
    $uploadedLogo = $defaultLogo;

    if (!empty($logo->Image) && !empty($logo->Image->file)) {
        $fullPath = public_path($logo->Image->file);
        if (file_exists($fullPath)) {
            $uploadedLogo = 'data:image/png;base64,' . base64_encode(file_get_contents($fullPath));
        }
    }
// dd($logo->Image->file);
?>
<header>
    <div class="topbar d-flex align-items-center topbarcarnet">
        <nav class="navbar navbar-expand">
            <div class="mobile-toggle-menu"><i class="bx bx-menu"></i>
            </div>
            <div class="search-bar flex-grow-1">
            </div>
 <!-- Notification bell for workshop users -->
            <div class="notification-box dropdown ms-3">
                <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-bell"></i>
                    <span class="badge bg-danger" id="notif-count">0</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown" style="width:300px; max-height:400px; overflow-y:auto;">
                    <li class="dropdown-header">Notifications</li>
                    <div id="notification-list"></div>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-center text-primary fw-bold" href="{{ route('workshop.notifications') }}">View All Notifications</a></li>
                </ul>
            </div>
            <div class="user-box dropdown">
                <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#"
                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  {{--  <img src="{{ asset('assets/images/sidebarlogo.png') }}" class="user-img" alt="user avatar">
                      <img src="{{ asset('assets/images/sidebarlogo.png') }}" class="user-img" alt="user avatar">
                       <img src="{{ file_exists(public_path($logo->Image->file)) ? 'data:image/png;base64,' . base64_encode(file_get_contents(public_path($logo->Image->file))) : 'path/to/default/image.png' }}" alt="Logo" class="user-img"> --}}

                  <img src="{{ $uploadedLogo }}" class="user-img" alt="user avatar">
                    <div class="user-info ps-3"> 
                        <p class="user-name mb-0">{{ 'Workshop' }}</p>    
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{ route('workshop.profile') }}">
                            <i class="bx bx-user"></i>
                            <span>Profile</span>
                        </a>
                    </li>
                    <li><a class="dropdown-item" href="{{route('unified.logout')}}"><i
                                class="bx bx-log-out-circle"></i><span>Logout</span></a>
                    </li>
                </ul>
            </div>
           
 
        </nav>
    </div>
</header>
