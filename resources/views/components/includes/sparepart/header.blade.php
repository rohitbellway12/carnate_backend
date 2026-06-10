<?php
    use App\Models\UploadImage;
    use Illuminate\Support\Facades\Auth;

    $sparepart = Auth::guard('sparepart')->user(); // get sparepart user
    $image = null;

    if ($sparepart && $sparepart->branch_logo) {
        $uploadImage = UploadImage::find($sparepart->branch_logo);
        if ($uploadImage && $uploadImage->file) {
            $image = asset($uploadImage->file); // or public path based on setup
        }
    }

    if (!$image) {
        $image = asset('assets/images/sidebarlogo.png'); // fallback default image
    }
?>


<header>
    <div class="topbar d-flex align-items-center topbarcarnet">
        <nav class="navbar navbar-expand">
            <div class="mobile-toggle-menu"><i class="bx bx-menu"></i>
            </div>
            <div class="search-bar flex-grow-1">
            </div>

   <!-- Notification bell for sparepart users -->
            <div class="notification-box dropdown ms-3">
                <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <!-- Font Awesome bell icon (layout already loads FA) -->
                    <i class="fa-solid fa-bell"></i>
                    <span class="badge bg-danger" id="notif-count">0</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown" style="width:300px; max-height:400px; overflow-y:auto;">
                    <li class="dropdown-header">Notifications</li>
                    <div id="notification-list"></div>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-center text-primary fw-bold" href="{{ route('sparepart.notifications') }}">View All Notifications</a></li>
                </ul>
            </div>

            <div class="user-box dropdown">
                <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#"
                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
               <img src="{{ $image }}" class="user-img" alt="user avatar">

                    <div class="user-info ps-3">
                        <p class="user-name mb-0">{{ 'Spare Part' }}</p>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{ route('sparepart.profile') }}">
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