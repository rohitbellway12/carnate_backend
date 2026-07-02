<div>
    <div class="row g-0 min-vh-100">
        <!-- Left Side - Branding Section -->
        <div class="d-none d-sm-block col-lg-6" style="background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%); position: relative; overflow: hidden; min-height: 100vh;">

            <!-- Decorative Elements -->
            <div style="position: absolute; top: 5%; left: -10%; width: 300px; height: 300px; background: rgba(255,107,53,0.08); border-radius: 50%;"></div>
            <div style="position: absolute; bottom: 5%; right: -10%; width: 400px; height: 400px; background: rgba(255,107,53,0.06); border-radius: 50%;"></div>
            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 500px; height: 500px; background: rgba(255,107,53,0.03); border-radius: 50%;"></div>

            <div class="h-100 d-flex flex-column justify-content-center align-items-center px-4 px-xl-5" style="position: relative; z-index: 2;">
                
                <!-- Logo -->
                <div class="text-center mb-4">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('assets/images/logo.png') }}" 
                             class="img-fluid" 
                             style="max-width: 220px; width: 100%; height: auto; object-fit: contain;" 
                             alt="CARNATE">
                    </a>
                </div>

                <!-- Main Heading -->
                <div class="text-center text-white">
                    <h1 style="font-size: clamp(2rem, 5vw, 3.5rem); font-weight: 700; margin-bottom: 0.25rem; background: linear-gradient(135deg, #ffffff 0%, #ff6b35 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                        WorkShop
                    </h1>
                    <h1 style="font-size: clamp(2rem, 5vw, 3.5rem); font-weight: 700; margin-bottom: 0.25rem; color: #ffffff;">
                        Management
                    </h1>
                    <h1 style="font-size: clamp(2.4rem, 6vw, 4.2rem); font-weight: 800; margin-bottom: 1.5rem; color: #ff6b35;">
                        Solution
                    </h1>

                    <div style="width: 60px; height: 3px; background: #ff6b35; margin: 0 auto 1.5rem auto; border-radius: 2px;"></div>

                    <p style="font-size: clamp(0.85rem, 1.2vw, 1.05rem); line-height: 1.8; opacity: 0.9; max-width: 480px; margin: 0 auto; color: #e0e0e0;">
                        Welcome to CARNATE the smarter way to manage modern workshops and automotive service businesses.
                    </p>
                </div>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="col-12 col-lg-6 d-flex align-items-center justify-content-center px-3 px-md-4 px-lg-5" style="background: #ffffff; min-height: 100vh;">
            <form class="w-100" wire:submit="login" style="max-width: 440px; padding: 20px 0;">
                
                <!-- Login Heading -->
                <div class="text-center mb-4">
                    <h2 style="color: #1a2a3a; font-weight: 700; font-size: clamp(1.5rem, 2.5vw, 2rem); margin-bottom: 0.25rem;">Login</h2>
                    <p class="text-muted" style="font-size: 0.85rem; margin-bottom: 0;">Welcome back! Please login to your account</p>
                </div>

                @csrf

                @if ($loginType == 1)
                <!-- Phone Input -->
                <div class="mb-3">
                    <label for="inputPhone" class="form-label fw-semibold mb-1" style="color: #1a2a3a; font-size: 0.9rem;">Phone</label>
                    <input type="text" 
                           class="form-control" 
                           id="inputPhone" 
                           wire:model="phone"
                           placeholder="Enter your phone number" 
                           autocomplete="phone" 
                           autofocus
                           style="padding: 11px 15px; border-radius: 8px; border: 1px solid #e0e0e0; background: #fafafa; font-size: 0.95rem;">
                    @error('phone')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                @else
                <!-- Email Input -->
                <div class="mb-3">
                    <label for="inputEmailAddress" class="form-label fw-semibold mb-1" style="color: #1a2a3a; font-size: 0.9rem;">Email Address</label>
                    <input type="email" 
                           class="form-control" 
                           id="inputEmailAddress" 
                           wire:model="email"
                           placeholder="Enter your email address" 
                           autocomplete="email" 
                           autofocus
                           style="padding: 11px 15px; border-radius: 8px; border: 1px solid #e0e0e0; background: #fafafa; font-size: 0.95rem;">
                    @error('email')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                @endif

                <!-- Password Input -->
                <div class="mb-3">
                    <label for="inputChoosePassword" class="form-label fw-semibold mb-1" style="color: #1a2a3a; font-size: 0.9rem;">Enter Password</label>
                    <div class="input-group" id="show_hide_password">
                        <input type="password" 
                               class="form-control border-end-0" 
                               id="inputChoosePassword"
                               wire:model="password" 
                               placeholder="Enter your password" 
                               autocomplete="password"
                               style="padding: 11px 15px; border-radius: 8px 0 0 8px; border: 1px solid #e0e0e0; background: #fafafa; font-size: 0.95rem;">
                        <a href="javascript:void(0);" 
                           class="input-group-text bg-transparent" 
                           style="border-radius: 0 8px 8px 0; border: 1px solid #e0e0e0; border-left: none; background: #fafafa; padding: 11px 15px;"
                           onclick="togglePassword()">
                            <i class='bx bx-hide' id="password-icon" style="color: #999; font-size: 1.2rem;"></i>
                        </a>
                    </div>
                    @error('password')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" 
                               type="checkbox" 
                               id="remember" 
                               wire:model="remember" 
                               style="border-color: #ff6b35; cursor: pointer;">
                        <label class="form-check-label small" for="remember" style="color: #666; cursor: pointer;">Remember Me</label>
                    </div>
                    <a href="{{ route('unified.password.request') }}" 
                       class="text-decoration-none small" 
                       style="color: #ff6b35; font-weight: 500;">
                        Forgot Password?
                    </a>
                </div>

                <!-- Session Error Message -->
                @if (session()->has('error'))
                <div class="alert alert-danger small mb-3" style="border-radius: 8px; padding: 10px 15px;">
                    {{ session('error') }}
                </div>
                @endif

                <!-- Login Button -->
                <div class="d-grid mb-3">
                    <button type="submit" 
                            class="btn py-2" 
                            style="background: #ff6b35; border: none; color: white; font-weight: 600; border-radius: 8px; font-size: 1rem; transition: all 0.3s ease;"
                            onmouseover="this.style.background='#e55a2b'" 
                            onmouseout="this.style.background='#ff6b35'"
                            wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target.except="login_type">
                            <i class="bx bxs-lock-open me-1"></i> Log In
                        </span>
                        <span wire:loading wire:target.except="login_type">
                            <i class="spinner-border spinner-border-sm me-1" role="status"></i> Loading...
                        </span>
                    </button>
                </div>

                <!-- OR Divider -->
                <div class="text-center my-3 position-relative">
                    <hr style="border-top: 1px solid #e0e0e0;">
                    <span class="text-muted small px-3" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: #ffffff; font-size: 0.85rem;">OR</span>
                </div>

                <!-- Switch Login Type Button -->
                <div class="d-grid">
                    <button type="button" 
                            class="btn py-2" 
                            style="background: #2c3e50; border: none; color: white; font-weight: 500; border-radius: 8px; font-size: 0.95rem; transition: all 0.3s ease;"
                            onmouseover="this.style.background='#1a2a3a'" 
                            onmouseout="this.style.background='#2c3e50'"
                            wire:click="login_type({{ $loginType == 1 ? 0 : 1 }})" 
                            wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="login_type">
                            @if ($loginType == 1)
                            <i class="bx bxs-envelope me-1"></i> Log in with Email
                            @else
                            <i class="bx bxs-phone me-1"></i> Log in with Phone
                            @endif
                        </span>
                        <span wire:loading.inline wire:target="login_type">
                            <i class="spinner-border spinner-border-sm me-1" role="status"></i> Loading...
                        </span>
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

@section('footerscript')
<script>
    function togglePassword() {
        const passwordInput = document.getElementById("inputChoosePassword");
        const passwordIcon = document.getElementById("password-icon");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            passwordIcon.classList.remove("bx-hide");
            passwordIcon.classList.add("bx-show");
        } else {
            passwordInput.type = "password";
            passwordIcon.classList.remove("bx-show");
            passwordIcon.classList.add("bx-hide");
        }
    }
</script>
@endsection