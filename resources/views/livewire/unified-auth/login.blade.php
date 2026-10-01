<div class="carnate-login-page">

    <style>
        /* =========================================================
           CARNATE LOGIN — PREMIUM SAAS STYLE
        ========================================================= */

        .carnate-login-page {
            min-height: 100vh;
            width: 100%;
            background: #f7f8fa;
            color: #111827;
            overflow: hidden;
        }

        /* =========================================================
           MAIN LAYOUT
        ========================================================= */

        .carnate-login-page .login-layout {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 44% 56%;
        }

        /* =========================================================
           LEFT BRAND AREA
        ========================================================= */

        .carnate-login-page .brand-side {
            position: relative;
            min-height: 100vh;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 50px;

            background: #f1f4f7;

            border-right: 1px solid #e2e8f0;

            overflow: hidden;
        }

        .carnate-login-page .brand-side::before {
            content: "";

            position: absolute;

            width: 520px;
            height: 520px;

            left: -270px;
            top: -240px;

            border-radius: 50%;

            background: rgba(229, 57, 53, 0.05);

            pointer-events: none;
        }

        .carnate-login-page .brand-side::after {
            content: "";

            position: absolute;

            width: 460px;
            height: 460px;

            right: -260px;
            bottom: -240px;

            border-radius: 50%;

            background: rgba(15, 23, 42, 0.035);

            pointer-events: none;
        }

        /* =========================================================
           BRAND CONTENT
        ========================================================= */

        .carnate-login-page .brand-content {
            position: relative;

            z-index: 2;

            width: 100%;

            max-width: 560px;

            text-align: center;
        }

        /* =========================================================
           LOGO AREA
        ========================================================= */

        .carnate-login-page .brand-logo-wrapper {
            position: relative;

            width: 100%;
            max-width: 480px;

            height: 170px;

            margin: 0 auto 42px;

            padding: 25px 40px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: #0f0f0f;

            border: 1px solid #202020;

            border-radius: 22px;

            box-shadow:
                0 20px 50px rgba(15, 23, 42, 0.12);

            overflow: hidden;

            text-decoration: none;
        }

        .carnate-login-page .brand-logo-wrapper::before {
            content: "";

            position: absolute;

            width: 230px;
            height: 230px;

            left: -110px;
            top: -130px;

            border-radius: 50%;

            background: rgba(229, 57, 53, 0.13);

            pointer-events: none;
        }

        .carnate-login-page .brand-logo-wrapper::after {
            content: "";

            position: absolute;

            width: 200px;
            height: 200px;

            right: -100px;
            bottom: -130px;

            border-radius: 50%;

            background: rgba(255, 255, 255, 0.04);

            pointer-events: none;
        }

        .carnate-login-page .brand-logo {
            position: relative;

            z-index: 2;

            display: block;

            width: 100%;

            max-width: 370px;

            height: auto;

            max-height: 100px;

            object-fit: contain;
        }

        /* =========================================================
           BRAND TITLE
        ========================================================= */

        .carnate-login-page .brand-title {
            margin: 0 0 14px;

            color: #111827;

            font-size: 30px;

            font-weight: 700;

            line-height: 1.25;

            letter-spacing: -0.7px;
        }

        .carnate-login-page .brand-description {
            max-width: 450px;

            margin: 0 auto;

            color: #64748b;

            font-size: 15px;

            line-height: 1.7;
        }

        /* =========================================================
           FEATURES
        ========================================================= */

        .carnate-login-page .feature-list {
            display: flex;

            justify-content: center;

            align-items: center;

            gap: 10px;

            margin-top: 30px;

            flex-wrap: wrap;
        }

        .carnate-login-page .feature-item {
            display: inline-flex;

            align-items: center;

            gap: 7px;

            min-height: 38px;

            padding: 8px 13px;

            background: #ffffff;

            border: 1px solid #e2e8f0;

            border-radius: 9px;

            color: #64748b;

            font-size: 12px;

            font-weight: 500;

            box-shadow:
                0 3px 10px rgba(15, 23, 42, 0.025);
        }

        .carnate-login-page .feature-item i {
            color: #e53935;

            font-size: 15px;
        }

        /* =========================================================
           RIGHT FORM AREA
        ========================================================= */

        .carnate-login-page .form-side {
            min-height: 100vh;

            display: flex;

            align-items: center;

            justify-content: center;

            padding: 50px 70px;

            background: #ffffff;
        }

        /* =========================================================
           FORM CONTAINER
        ========================================================= */

        .carnate-login-page .login-container {
            width: 100%;

            max-width: 440px;
        }

        /* =========================================================
           MOBILE LOGO
        ========================================================= */

        .carnate-login-page .mobile-logo {
            display: none;

            width: 200px;

            max-height: 70px;

            height: auto;

            object-fit: contain;

            margin: 0 auto 35px;
        }

        /* =========================================================
           FORM HEADER
        ========================================================= */

        .carnate-login-page .login-header {
            margin-bottom: 32px;
        }

        .carnate-login-page .login-heading {
            margin: 0 0 9px;

            color: #111827;

            font-size: 32px;

            font-weight: 700;

            line-height: 1.2;

            letter-spacing: -0.8px;
        }

        .carnate-login-page .login-subtitle {
            margin: 0;

            color: #64748b;

            font-size: 14px;

            line-height: 1.6;
        }

        /* =========================================================
           FORM GROUP
        ========================================================= */

        .carnate-login-page .form-group {
            margin-bottom: 20px;
        }

        .carnate-login-page .form-label {
            display: block;

            margin-bottom: 8px;

            color: #334155;

            font-size: 13px;

            font-weight: 600;
        }

        .carnate-login-page .required {
            color: #e53935;
        }

        /* =========================================================
           INPUT
        ========================================================= */

        .carnate-login-page .form-control {
            width: 100%;

            height: 52px;

            padding: 0 15px;

            border: 1px solid #dbe2ea;

            border-radius: 9px;

            background: #ffffff;

            color: #111827;

            font-size: 14px;

            box-shadow: none;

            transition:
                border-color .2s ease,
                box-shadow .2s ease,
                background-color .2s ease;
        }

        .carnate-login-page .form-control::placeholder {
            color: #a1aab7;
        }

        .carnate-login-page .form-control:hover {
            border-color: #cbd5e1;
        }

        .carnate-login-page .form-control:focus {
            border-color: #e53935;

            background: #ffffff;

            box-shadow:
                0 0 0 3px rgba(229, 57, 53, 0.08);

            outline: none;
        }

        /* =========================================================
           PASSWORD
        ========================================================= */

        .carnate-login-page .password-wrapper {
            position: relative;
        }

        .carnate-login-page .password-wrapper .form-control {
            padding-right: 50px;
        }

        .carnate-login-page .password-toggle {
            position: absolute;

            top: 50%;
            right: 7px;

            width: 38px;
            height: 38px;

            display: flex;

            align-items: center;
            justify-content: center;

            transform: translateY(-50%);

            border: 0;

            border-radius: 7px;

            background: transparent;

            color: #64748b;

            cursor: pointer;

            font-size: 18px;

            transition: all .2s ease;
        }

        .carnate-login-page .password-toggle:hover {
            background: #f8fafc;

            color: #e53935;
        }

        /* =========================================================
           VALIDATION
        ========================================================= */

        .carnate-login-page .field-error {
            display: block;

            margin-top: 6px;

            color: #dc2626;

            font-size: 12px;

            line-height: 1.4;
        }

        .carnate-login-page .session-error {
            margin-bottom: 18px;

            padding: 11px 13px;

            border: 1px solid #fecaca;

            border-radius: 8px;

            background: #fef2f2;

            color: #b91c1c;

            font-size: 13px;
        }

        /* =========================================================
           REMEMBER ME
        ========================================================= */

        .carnate-login-page .remember-row {
            display: flex;

            align-items: center;

            justify-content: space-between;

            margin: 4px 0 25px;
        }

        .carnate-login-page .remember-row .forgot-link {
            color: #e53935;

            font-size: 13px;

            font-weight: 500;

            text-decoration: none;

            transition: color .2s ease, text-decoration .2s ease;
        }

        .carnate-login-page .remember-row .forgot-link:hover {
            color: #b91c1c;

            text-decoration: underline;
        }

        .carnate-login-page .remember-row .form-check-input {
            width: 18px;
            height: 18px;

            margin: 0;

            border: 1px solid #cbd5e1;

            border-radius: 5px;

            box-shadow: none;

            cursor: pointer;
        }

        .carnate-login-page .remember-row .form-check-input:checked {
            background-color: #e53935;

            border-color: #e53935;
        }

        .carnate-login-page .remember-row .form-check-label {
            margin-left: 9px;

            color: #64748b;

            font-size: 13px;

            cursor: pointer;
        }

        /* =========================================================
           LOGIN BUTTON
        ========================================================= */

        .carnate-login-page .login-btn {
            width: 100%;

            height: 52px;

            display: flex;

            align-items: center;
            justify-content: center;

            gap: 8px;

            border: 0;

            border-radius: 9px;

            background: #e53935;

            color: #ffffff;

            font-size: 14px;

            font-weight: 600;

            box-shadow:
                0 7px 18px rgba(229, 57, 53, 0.18);

            transition:
                background .2s ease,
                transform .2s ease,
                box-shadow .2s ease;
        }

        .carnate-login-page .login-btn:hover {
            background: #d92f2b;

            color: #ffffff;

            transform: translateY(-1px);

            box-shadow:
                0 10px 22px rgba(229, 57, 53, 0.22);
        }

        .carnate-login-page .login-btn:active {
            transform: translateY(0);
        }

        .carnate-login-page .login-btn:disabled {
            opacity: .7;

            cursor: not-allowed;

            transform: none;
        }

        /* =========================================================
           DIVIDER
        ========================================================= */

        .carnate-login-page .login-divider {
            display: flex;

            align-items: center;

            gap: 14px;

            margin: 25px 0;
        }

        .carnate-login-page .login-divider::before,
        .carnate-login-page .login-divider::after {
            content: "";

            flex: 1;

            height: 1px;

            background: #e2e8f0;
        }

        .carnate-login-page .login-divider span {
            color: #94a3b8;

            font-size: 11px;

            font-weight: 600;

            letter-spacing: 1px;
        }

        /* =========================================================
           SWITCH LOGIN
        ========================================================= */

        .carnate-login-page .switch-login-btn {
            width: 100%;

            height: 52px;

            display: flex;

            align-items: center;
            justify-content: center;

            gap: 8px;

            border: 1px solid #dbe2ea;

            border-radius: 9px;

            background: #ffffff;

            color: #334155;

            font-size: 14px;

            font-weight: 600;

            transition: all .2s ease;
        }

        .carnate-login-page .switch-login-btn:hover {
            border-color: #e53935;

            background: #fff5f5;

            color: #e53935;
        }

        .carnate-login-page .switch-login-btn:disabled {
            opacity: .7;

            cursor: not-allowed;
        }

        /* =========================================================
           LOADER
        ========================================================= */

        .carnate-login-page .spinner-border {
            width: 15px;

            height: 15px;

            border-width: 2px;
        }

        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 1100px) {

            .carnate-login-page .login-layout {
                grid-template-columns: 40% 60%;
            }

            .carnate-login-page .brand-side {
                padding: 35px;
            }

            .carnate-login-page .form-side {
                padding: 40px;
            }

            .carnate-login-page .brand-logo-wrapper {
                max-width: 400px;
            }

            .carnate-login-page .brand-title {
                font-size: 26px;
            }
        }

        @media (max-width: 767px) {

            .carnate-login-page {
                overflow-y: auto;
            }

            .carnate-login-page .login-layout {
                display: block;

                min-height: 100vh;
            }

            .carnate-login-page .brand-side {
                display: none;
            }

            .carnate-login-page .form-side {
                min-height: 100vh;

                padding: 35px 22px;
            }

            .carnate-login-page .mobile-logo {
                display: block;
            }

            .carnate-login-page .login-container {
                max-width: 430px;
            }

            .carnate-login-page .login-heading {
                font-size: 28px;
            }
        }

        @media (max-width: 400px) {

            .carnate-login-page .form-side {
                padding: 30px 18px;
            }

            .carnate-login-page .login-heading {
                font-size: 25px;
            }

            .carnate-login-page .brand-logo-wrapper {
                height: 150px;
            }
        }
    </style>


    {{-- =====================================================
         MAIN LAYOUT
    ====================================================== --}}

    <div class="login-layout">


        {{-- =================================================
             LEFT BRAND SIDE
        ================================================== --}}

        <div class="brand-side">

            <div class="brand-content">


                {{-- =================================================
                     CARNATE LOGO
                ================================================== --}}

                <a
                    href="{{ route('home') }}"
                    class="brand-logo-wrapper"
                >

                    <img
                        src="{{ asset('assets/images/logo.png') }}"
                        class="brand-logo"
                        alt="Carnate"
                    >

                </a>


                {{-- =================================================
                     BRAND TITLE
                ================================================== --}}

                <h2 class="brand-title">
                    Everything your workshop needs.
                </h2>


                {{-- =================================================
                     BRAND DESCRIPTION
                ================================================== --}}

                <p class="brand-description">

                    Manage customers, vehicles, job cards,
                    spare parts, payments and workshop
                    operations from one simple platform.

                </p>


                {{-- =================================================
                     FEATURES
                ================================================== --}}

                <div class="feature-list">

                    <div class="feature-item">

                        <i class="bx bx-check-circle"></i>

                        <span>
                            Workshop Management
                        </span>

                    </div>


                    <div class="feature-item">

                        <i class="bx bx-check-circle"></i>

                        <span>
                            Job Cards
                        </span>

                    </div>


                    <div class="feature-item">

                        <i class="bx bx-check-circle"></i>

                        <span>
                            Vehicle Management
                        </span>

                    </div>

                </div>

            </div>

        </div>


        {{-- =================================================
             RIGHT LOGIN SIDE
        ================================================== --}}

        <div class="form-side">

            <div class="login-container">


                {{-- =================================================
                     MOBILE LOGO
                ================================================== --}}

                <img
                    src="{{ asset('assets/images/logo.png') }}"
                    class="mobile-logo"
                    alt="Carnate"
                >


                {{-- =================================================
                     LOGIN HEADER
                ================================================== --}}

                <div class="login-header">

                    <h1 class="login-heading">
                        Workshop Login
                    </h1>

                    <p class="login-subtitle">
                        Sign in to access your workshop management dashboard.
                    </p>

                </div>


                {{-- =================================================
                     LOGIN FORM
                ================================================== --}}

                <form
                    wire:submit="login"
                >

                    @csrf


                    {{-- =================================================
                         EMAIL / PHONE
                    ================================================== --}}

                    @if ($loginType == 1)

                        {{-- PHONE LOGIN --}}

                        <div class="form-group">

                            <label
                                for="inputPhone"
                                class="form-label"
                            >
                                Phone
                                <span class="required">*</span>
                            </label>


                            <input
                                type="text"
                                class="form-control"
                                id="inputPhone"
                                wire:model="phone"
                                placeholder="Enter your phone number"
                                autocomplete="phone"
                                autofocus
                            >


                            @error('phone')

                                <span class="field-error">
                                    {{ $message }}
                                </span>

                            @enderror

                        </div>

                    @else

                        {{-- EMAIL LOGIN --}}

                        <div class="form-group">

                            <label
                                for="inputEmailAddress"
                                class="form-label"
                            >
                                Email Address
                                <span class="required">*</span>
                            </label>


                            <input
                                type="email"
                                class="form-control"
                                id="inputEmailAddress"
                                wire:model="email"
                                placeholder="Enter your email address"
                                autocomplete="email"
                                autofocus
                            >


                            @error('email')

                                <span class="field-error">
                                    {{ $message }}
                                </span>

                            @enderror

                        </div>

                    @endif


                    {{-- =================================================
                         PASSWORD
                    ================================================== --}}

                    <div class="form-group">

                        <label
                            for="inputChoosePassword"
                            class="form-label"
                        >
                            Password
                            <span class="required">*</span>
                        </label>


                        <div class="password-wrapper">

                            <input
                                type="password"
                                class="form-control"
                                id="inputChoosePassword"
                                wire:model="password"
                                placeholder="Enter your password"
                                autocomplete="current-password"
                            >


                            <button
                                type="button"
                                class="password-toggle"
                                onclick="togglePassword()"
                                aria-label="Show or hide password"
                            >

                                <i
                                    class="bx bx-hide"
                                    id="password-icon"
                                ></i>

                            </button>

                        </div>


                        @error('password')

                            <span class="field-error">
                                {{ $message }}
                            </span>

                        @enderror

                    </div>


                    {{-- =================================================
                         REMEMBER ME & FORGOT PASSWORD
                    ================================================== --}}

                    <div class="remember-row">

                        <div class="d-flex align-items-center">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                id="remember"
                                wire:model="remember"
                            >

                            <label
                                class="form-check-label"
                                for="remember"
                            >
                                Remember Me
                            </label>

                        </div>

                        <a href="{{ route('unified.password.request') }}" class="forgot-link">
                            Forgot Password?
                        </a>

                    </div>


                    {{-- =================================================
                         SESSION ERROR
                    ================================================== --}}

                    @if (session()->has('error'))

                        <div class="session-error">
                            {{ session('error') }}
                        </div>

                    @endif


                    {{-- =================================================
                         LOGIN BUTTON
                    ================================================== --}}

                    <button
                        type="submit"
                        class="login-btn"
                        wire:loading.attr="disabled"
                    >

                        <span
                            wire:loading.remove
                            wire:target.except="login_type"
                        >

                            <i class="bx bxs-lock-open"></i>

                            Log in

                        </span>


                        <span
                            wire:loading
                            wire:target.except="login_type"
                        >

                            <i
                                class="spinner-border spinner-border-sm"
                                role="status"
                            ></i>

                            Loading...

                        </span>

                    </button>


                    {{-- =================================================
                         DIVIDER
                    ================================================== --}}

                    <div class="login-divider">

                        <span>
                            OR
                        </span>

                    </div>


                    {{-- =================================================
                         SWITCH LOGIN TYPE
                    ================================================== --}}

                    <button
                        type="button"
                        class="switch-login-btn"
                        wire:click="login_type({{ $loginType == 1 ? 0 : 1 }})"
                        wire:loading.attr="disabled"
                    >

                        <span
                            wire:loading.remove
                            wire:target="login_type"
                        >

                            @if ($loginType == 1)

                                <i class="bx bxs-envelope"></i>

                                Log in with Email

                            @else

                                <i class="bx bxs-phone"></i>

                                Log in with Phone

                            @endif

                        </span>


                        <span
                            wire:loading.inline
                            wire:target="login_type"
                        >

                            <i
                                class="spinner-border spinner-border-sm"
                                role="status"
                            ></i>

                            Loading...

                        </span>

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>


@section('footerscript')

<script>

    function togglePassword() {

        const passwordInput =
            document.getElementById(
                "inputChoosePassword"
            );

        const passwordIcon =
            document.getElementById(
                "password-icon"
            );


        if (!passwordInput || !passwordIcon) {
            return;
        }


        if (
            passwordInput.type === "password"
        ) {

            passwordInput.type = "text";

            passwordIcon.classList.remove(
                "bx-hide"
            );

            passwordIcon.classList.add(
                "bx-show"
            );

        } else {

            passwordInput.type = "password";

            passwordIcon.classList.remove(
                "bx-show"
            );

            passwordIcon.classList.add(
                "bx-hide"
            );

        }

    }

</script>

@endsection