<div>
    <div class="row g-0">
        <div class="d-none d-sm-block col-6" style="background-color: #2a3f54;min-height:100vh;">
            <a href="{{ route('home') }}" class="h-100 w-100 d-flex justify-content-center align-items-center">
                <img src="{{ asset('assets/images/carnatebg.png') }}" class="img-fluid w-75" alt="loginlogo">
            </a>
        </div>
        <div class="col-12 col-sm-6 min-vh-100 d-flex align-items-center justify-content-center px-3 px-md-4 px-lg-5">
            <form class="w-100" wire:submit="login" style="max-width: 800px !important">
                <h3 class="text-center mb-4">Login</h3>
                <p class="text-center text-muted mb-4">Login for Workshop & Spare Parts Vendors</p>
                @csrf

                @if ($loginType == 1)
                    {{-- Phone Input --}}
                    <div class="mb-3">
                        <label for="inputPhone" class="form-label"><b>Phone</b></label>
                        <input type="text" class="form-control" id="inputPhone" wire:model="phone"
                            placeholder="Phone" autocomplete="phone" autofocus>
                        @error('phone')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                @else
                    {{-- Email Input --}}
                    <div class="mb-3">
                        <label for="inputEmailAddress" class="form-label"><b>Email Address</b></label>
                        <input type="email" class="form-control" id="inputEmailAddress" wire:model="email"
                            placeholder="Email Address" autocomplete="email" autofocus>
                        @error('email')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                @endif
                {{-- Password Input --}}
                <div class="mb-3">
                    <label for="inputChoosePassword" class="form-label"><b>Enter Password</b></label>
                    <div class="input-group" id="show_hide_password">
                        <input type="password" class="form-control border-end-0 new_input" id="inputChoosePassword"
                            wire:model="password" placeholder="Password" autocomplete="password">
                        <a href="javascript:void(0);" class="input-group-text bg-transparent"
                            onclick="togglePassword()">
                            <i class='bx bx-hide' id="password-icon"></i>
                        </a>
                    </div>
                    @error('password')
                        <strong class="text-danger">{{ $message }}</strong>
                    @enderror
                </div>

                {{-- Remember Me --}}
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check form-switch mb-0">
                        <input class="form-check-input" type="checkbox" id="remember" wire:model="remember">
                        <label class="form-check-label" for="remember">Remember Me</label>
                    </div>
                    <a href="{{ route('unified.password.request') }}" class="text-decoration-none">Forgot Password?</a>
                </div>

                {{-- Session Error Message --}}
                @if (session()->has('error'))
                    <div class="text-danger mb-3">{{ session('error') }}</div>
                @endif

                {{-- Submit Button --}}
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary py-2" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target.except="login_type">
                            <i class="bx bxs-lock-open"></i> Log in
                        </span>
                        <span wire:loading wire:target.except="login_type">
                            <i class="spinner-border spinner-border-sm" role="status"></i> Loading...
                        </span>
                    </button>
                </div>

                <h6 class="text-center my-3">OR</h6>

                {{-- Switch to Phone Login --}}
                <div class="d-grid">
                    <button type="button" class="btn btn-primary py-2"
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