<div>
    <div class="row g-0">
        <div class="d-none d-sm-block col-6" style="background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%); min-height:100vh; position: relative; overflow: hidden;">

            <!-- Decorative Elements -->
            <div style="position: absolute; top: 10%; left: -10%; width: 300px; height: 300px; background: rgba(255,107,53,0.1); border-radius: 50%;"></div>
            <div style="position: absolute; bottom: 10%; right: -10%; width: 400px; height: 400px; background: rgba(255,107,53,0.08); border-radius: 50%;"></div>



            <div class="h-100 d-flex flex-column justify-content-center align-items-center px-5" style="position: relative; z-index: 2;">

            <!-- Logo Section -->
                <div class="text-start ">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('assets/images/logo.png') }}" class="img-fluid" style="max-width: 500px; object-fit: contain;" alt="CARNATE">
                    </a>
                </div>

                <!-- Main Content -->
                <div class="text-center text-white" style="margin-top: -90px;">
                    <h1 style="font-size: 3.2rem; font-weight: 700; margin-bottom: 0.5rem; background: linear-gradient(135deg, #ffffff 0%, #ff6b35 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                        WorkShop
                    </h1>
                    <h1 style="font-size: 3.2rem; font-weight: 700; margin-bottom: 0.5rem; color: white;">
                        Management
                    </h1>
                    <h1 style="font-size: 3.8rem; font-weight: 800; margin-bottom: 2rem; color: #ff6b35;">
                        Solution
                    </h1>

                    <div style="width: 80px; height: 3px; background: #ff6b35; margin: 0 auto 2rem auto;"></div>

                    {{-- <p style="font-size: 1rem; line-height: 1.7; opacity: 0.92; max-width: 500px; margin: 0 auto;">
                        CARNATE helps multiple luxury cars workshops manage job cards, inventory,<br>
                        invoicing, customer communication, spare parts ordering and workshop<br>
                        operations from one powerful cloud-based platform.
                    </p> --}}
                    <p>Welcome to CARNATE the smarter way to manage mordern workshops and automative service businesses.</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 min-vh-100 d-flex align-items-center justify-content-center px-3 px-md-4 px-lg-5" style="background: #ffffff;">
            <form class="w-100" wire:submit="login" style="max-width: 500px !important">
                <h2 class="text-center mb-2" style="color: #1a2a3a; font-weight: 700;">Login</h2>
                <!-- <p class="text-center text-muted mb-4" style="font-size: 0.9rem;">Login for Workshop & Spare Parts Vendors</p> -->

                @csrf

                @if ($loginType == 1)
                {{-- Phone Input --}}
                <div class="mb-3">
                    <label for="inputPhone" class="form-label fw-semibold mb-2" style="color: #1a2a3a;">Phone</label>
                    <input type="text" class="form-control" id="inputPhone" wire:model="phone"
                        placeholder="Enter your phone number" autocomplete="phone" autofocus
                        style="padding: 12px 15px; border-radius: 8px; border: 1px solid #e0e0e0; background: #fafafa;">
                    @error('phone')
                    <strong class="text-danger small">{{ $message }}</strong>
                    @enderror
                </div>
                @else
                {{-- Email Input --}}
                <div class="mb-3">
                    <label for="inputEmailAddress" class="form-label fw-semibold mb-2" style="color: #1a2a3a;">Email Address</label>
                    <input type="email" class="form-control" id="inputEmailAddress" wire:model="email"
                        placeholder="Enter your email address" autocomplete="email" autofocus
                        style="padding: 12px 15px; border-radius: 8px; border: 1px solid #e0e0e0; background: #fafafa;">
                    @error('email')
                    <strong class="text-danger small">{{ $message }}</strong>
                    @enderror
                </div>
                @endif

                {{-- Password Input --}}
                <div class="mb-3">
                    <label for="inputChoosePassword" class="form-label fw-semibold mb-2" style="color: #1a2a3a;">Enter Password</label>
                    <div class="input-group" id="show_hide_password">
                        <input type="password" class="form-control border-end-0 new_input" id="inputChoosePassword"
                            wire:model="password" placeholder="Enter your password" autocomplete="password"
                            style="padding: 12px 15px; border-radius: 8px 0 0 8px; border: 1px solid #e0e0e0; background: #fafafa;">
                        <a href="javascript:void(0);" class="input-group-text bg-transparent" style="border-radius: 0 8px 8px 0; border: 1px solid #e0e0e0; border-left: none; background: #fafafa;"
                            onclick="togglePassword()">
                            <i class='bx bx-hide' id="password-icon" style="color: #999;"></i>
                        </a>
                    </div>
                    @error('password')
                    <strong class="text-danger small">{{ $message }}</strong>
                    @enderror
                </div>

                {{-- Remember Me & Forgot Password --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember" wire:model="remember" style="border-color: #ff6b35;">
                        <label class="form-check-label small" for="remember" style="color: #666;">Remember Me</label>
                    </div>
                    <a href="{{ route('unified.password.request') }}" class="text-decoration-none small" style="color: #ff6b35; font-weight: 500;">Forgot Password?</a>
                </div>

                {{-- Session Error Message --}}
                @if (session()->has('error'))
                <div class="alert alert-danger small mb-3" style="border-radius: 8px;">{{ session('error') }}</div>
                @endif

                {{-- Submit Button --}}
                <div class="d-grid mb-3">
                    <button type="submit" class="btn py-2" style="background: #ff6b35; border: none; color: white; font-weight: 600; border-radius: 8px; transition: all 0.3s ease;"
                        onmouseover="this.style.background='#e55a2b'" onmouseout="this.style.background='#ff6b35'"
                        wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target.except="login_type">
                            <i class="bx bxs-lock-open"></i> Log In
                        </span>
                        <span wire:loading wire:target.except="login_type">
                            <i class="spinner-border spinner-border-sm" role="status"></i> Loading...
                        </span>
                    </button>
                </div>

                <div class="text-center my-4">
                    <span class="text-muted small" style="position: relative; background: #fff; padding: 0 10px;">OR</span>
                    <hr class="mt-0" style="border-top: 1px solid #e0e0e0; margin-top: -12px;">
                </div>

                {{-- Switch to Phone Login --}}
                <div class="d-grid">
                    <button type="button" class="btn py-2" style="background: #2c3e50; border: none; color: white; font-weight: 500; border-radius: 8px; transition: all 0.3s ease;"
                        onmouseover="this.style.background='#1a2a3a'" onmouseout="this.style.background='#2c3e50'"
                        wire:click="login_type({{ $loginType == 1 ? 0 : 1 }})" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="login_type">
                            @if ($loginType == 1)
                            <i class="bx bxs-envelope"></i> Log in with Email
                            @else
                            <i class="bx bxs-phone"></i> Log in with Phone
                            @endif
                        </span>
                        <span wire:loading.inline wire:target="login_type">
                            <i class="spinner-border spinner-border-sm" role="status"></i> Loading...
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
