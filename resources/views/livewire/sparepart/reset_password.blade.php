<div class="carnate-reset-password-page">

    <div class="carnate-reset-wrapper">

        {{-- Header --}}
        <div class="carnate-page-header">
            <span class="carnate-page-eyebrow">Security</span>
            <h1>Reset Password</h1>
            <p>Update your account password to keep your account secure.</p>
        </div>

        {{-- Password Card --}}
        <div class="carnate-password-card">

            <div class="carnate-security-icon">
                <i class="bx bx-lock-alt"></i>
            </div>

            <div class="carnate-card-heading">
                <h3>Change your password</h3>
                <p>Enter your current password and choose a new password.</p>
            </div>

            <form wire:submit.prevent="resetpassword">

                <div class="carnate-form-body">

                    {{-- Current Password --}}
                    <div class="carnate-form-group">

                        <label for="current_password">
                            Current Password
                            <sup>*</sup>
                        </label>

                        <div class="carnate-input-wrapper">
                            <i class="bx bx-lock carnate-input-icon"></i>

                            <input type="password"
                                id="current_password"
                                name="current_password"
                                wire:model="current_password"
                                class="carnate-input @error('current_password') is-invalid @enderror"
                                placeholder="Enter current password">

                            <button type="button"
                                class="carnate-password-toggle"
                                onclick="toggleCarnatePassword('current_password', this)">
                                <i class="bx bx-show"></i>
                            </button>
                        </div>

                        @error('current_password')
                            <span class="carnate-error">
                                <i class="bx bx-error-circle"></i>
                                {{ $message }}
                            </span>
                        @enderror

                    </div>


                    {{-- New Password --}}
                    <div class="carnate-form-group">

                        <label for="password">
                            New Password
                            <sup>*</sup>
                        </label>

                        <div class="carnate-input-wrapper">
                            <i class="bx bx-lock-open carnate-input-icon"></i>

                            <input type="password"
                                id="password"
                                wire:model="password"
                                class="carnate-input @error('password') is-invalid @enderror"
                                placeholder="Enter new password">

                            <button type="button"
                                class="carnate-password-toggle"
                                onclick="toggleCarnatePassword('password', this)">
                                <i class="bx bx-show"></i>
                            </button>
                        </div>

                        @error('password')
                            <span class="carnate-error">
                                <i class="bx bx-error-circle"></i>
                                {{ $message }}
                            </span>
                        @enderror

                    </div>


                    {{-- Confirm Password --}}
                    <div class="carnate-form-group">

                        <label for="password_confirmation">
                            Confirm Password
                            <sup>*</sup>
                        </label>

                        <div class="carnate-input-wrapper">
                            <i class="bx bx-check-shield carnate-input-icon"></i>

                            <input type="password"
                                wire:model="password_confirmation"
                                id="password_confirmation"
                                name="password_confirmation"
                                class="carnate-input @error('password_confirmation') is-invalid @enderror"
                                placeholder="Confirm new password">

                            <button type="button"
                                class="carnate-password-toggle"
                                onclick="toggleCarnatePassword('password_confirmation', this)">
                                <i class="bx bx-show"></i>
                            </button>
                        </div>

                        @error('password_confirmation')
                            <span class="carnate-error">
                                <i class="bx bx-error-circle"></i>
                                {{ $message }}
                            </span>
                        @enderror

                    </div>

                </div>


                {{-- Footer --}}
                <div class="carnate-form-footer">

                    <div class="carnate-security-note">
                        <i class="bx bx-shield-quarter"></i>
                        <span>Your password is securely stored.</span>
                    </div>

                    <button type="submit"
                        class="carnate-update-btn"
                        wire:loading.attr="disabled">

                        <span wire:loading.remove>
                            <i class="bx bx-save"></i>
                            Update Password
                        </span>

                        <span wire:loading class="carnate-loading-state">
                            <i class="spinner-border spinner-border-sm"></i>
                            Updating...
                        </span>

                    </button>

                </div>

            </form>

        </div>

    </div>


    <style>
        .carnate-reset-password-page {
            --carnate-red: #e53935;
            --carnate-red-soft: #fff5f5;
            --carnate-text: #111827;
            --carnate-muted: #64748b;
            --carnate-border: #e2e8f0;

            min-height: calc(100vh - 70px);
            padding: 32px 24px;
            background: #f7f8fa;
            color: var(--carnate-text);
        }

        .carnate-reset-password-page * {
            box-sizing: border-box;
        }

        .carnate-reset-wrapper {
            width: 100%;
            max-width: 680px;
            margin: 0 auto;
        }

        /* Header */

        .carnate-page-header {
            margin-bottom: 20px;
        }

        .carnate-page-eyebrow {
            display: block;
            margin-bottom: 5px;
            color: var(--carnate-red);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: .12em;
            text-transform: uppercase;
        }

        .carnate-page-header h1 {
            margin: 0;
            color: var(--carnate-text);
            font-size: 28px;
            font-weight: 750;
            letter-spacing: -.03em;
        }

        .carnate-page-header p {
            margin: 7px 0 0;
            color: var(--carnate-muted);
            font-size: 14px;
        }

        /* Card */

        .carnate-password-card {
            overflow: hidden;
            border: 1px solid var(--carnate-border);
            border-radius: 18px;
            background: #fff;
            box-shadow: 0 6px 24px rgba(15, 23, 42, .045);
        }

        .carnate-security-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 52px;
            height: 52px;
            margin: 26px 26px 16px;
            border-radius: 14px;
            background: var(--carnate-red-soft);
            color: var(--carnate-red);
            font-size: 25px;
        }

        .carnate-card-heading {
            padding: 0 26px 21px;
            border-bottom: 1px solid var(--carnate-border);
        }

        .carnate-card-heading h3 {
            margin: 0;
            color: var(--carnate-text);
            font-size: 18px;
            font-weight: 750;
        }

        .carnate-card-heading p {
            margin: 5px 0 0;
            color: var(--carnate-muted);
            font-size: 12px;
        }

        /* Form */

        .carnate-form-body {
            padding: 24px 26px 5px;
        }

        .carnate-form-group {
            margin-bottom: 20px;
        }

        .carnate-form-group label {
            display: block;
            margin-bottom: 7px;
            color: #334155;
            font-size: 13px;
            font-weight: 700;
        }

        .carnate-form-group label sup {
            margin-left: 2px;
            color: var(--carnate-red);
            font-size: 12px;
        }

        .carnate-input-wrapper {
            position: relative;
        }

        .carnate-input-icon {
            position: absolute;
            top: 50%;
            left: 13px;
            z-index: 1;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 17px;
            pointer-events: none;
        }

        .carnate-input {
            width: 100%;
            min-height: 46px;
            padding: 11px 44px 11px 40px;
            border: 1px solid var(--carnate-border);
            border-radius: 10px;
            outline: none;
            background: #fff;
            color: var(--carnate-text);
            font-size: 13px;
            transition: border-color .2s ease, box-shadow .2s ease;
        }

        .carnate-input::placeholder {
            color: #94a3b8;
        }

        .carnate-input:focus {
            border-color: rgba(229, 57, 53, .45);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        .carnate-input.is-invalid {
            border-color: #fca5a5;
        }

        .carnate-input.is-invalid:focus {
            box-shadow: 0 0 0 3px rgba(239, 68, 68, .08);
        }

        .carnate-password-toggle {
            position: absolute;
            top: 50%;
            right: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            padding: 0;
            transform: translateY(-50%);
            border: 0;
            border-radius: 7px;
            background: transparent;
            color: #94a3b8;
            cursor: pointer;
        }

        .carnate-password-toggle:hover {
            background: #f1f5f9;
            color: #475569;
        }

        .carnate-password-toggle i {
            font-size: 17px;
        }

        .carnate-error {
            display: flex;
            align-items: center;
            gap: 5px;
            margin-top: 6px;
            color: #dc2626;
            font-size: 12px;
        }

        .carnate-error i {
            font-size: 14px;
        }

        /* Footer */

        .carnate-form-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 18px 26px;
            border-top: 1px solid var(--carnate-border);
            background: #fafbfc;
        }

        .carnate-security-note {
            display: flex;
            align-items: center;
            gap: 7px;
            color: #64748b;
            font-size: 11px;
        }

        .carnate-security-note i {
            color: #94a3b8;
            font-size: 16px;
        }

        .carnate-update-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            min-width: 155px;
            min-height: 43px;
            padding: 0 18px;
            border: 0;
            border-radius: 10px;
            background: var(--carnate-red);
            color: #fff;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 5px 12px rgba(229, 57, 53, .14);
            transition: .2s ease;
        }

        .carnate-update-btn:hover:not(:disabled) {
            background: #d8322f;
            transform: translateY(-1px);
        }

        .carnate-update-btn:disabled {
            opacity: .65;
            cursor: not-allowed;
        }

        .carnate-loading-state {
            display: inline-flex;
            align-items: center;
            gap: 7px;
        }

        .carnate-loading-state .spinner-border {
            width: 13px;
            height: 13px;
            border-width: 2px;
        }

        /* Responsive */

        @media (max-width: 767px) {
            .carnate-reset-password-page {
                padding: 20px 15px;
            }

            .carnate-page-header h1 {
                font-size: 23px;
            }

            .carnate-page-header p {
                font-size: 12px;
            }

            .carnate-security-icon {
                margin: 20px 20px 14px;
            }

            .carnate-card-heading {
                padding: 0 20px 18px;
            }

            .carnate-form-body {
                padding: 20px 20px 2px;
            }

            .carnate-form-footer {
                align-items: stretch;
                flex-direction: column;
                padding: 16px 20px;
            }

            .carnate-security-note {
                justify-content: center;
            }

            .carnate-update-btn {
                width: 100%;
            }
        }
    </style>


    <script>
        function toggleCarnatePassword(inputId, button) {
            const input = document.getElementById(inputId);

            if (!input) {
                return;
            }

            const icon = button.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bx-show');
                icon.classList.add('bx-hide');
            } else {
                input.type = 'password';
                icon.classList.remove('bx-hide');
                icon.classList.add('bx-show');
            }
        }
    </script>

</div>