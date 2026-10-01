<div class="carnate-reset-password-page">

    <style>
        .carnate-reset-password-page {
            --rp-bg: #f7f8fa;
            --rp-card: #ffffff;
            --rp-text: #111827;
            --rp-muted: #64748b;
            --rp-border: #e2e8f0;
            --rp-red: #e53935;
            --rp-red-dark: #c92f2c;
            --rp-red-soft: #fff5f5;
            --rp-shadow: 0 12px 35px rgba(15, 23, 42, 0.08);

            width: 100%;
            min-height: calc(100vh - 100px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 35px 20px;
        }

        .carnate-reset-password-page .rp-card {
            width: 100%;
            max-width: 520px;
            background: var(--rp-card);
            border: 1px solid var(--rp-border);
            border-radius: 18px;
            box-shadow: var(--rp-shadow);
            overflow: hidden;
        }

        .carnate-reset-password-page .rp-header {
            padding: 28px 30px 22px;
            text-align: center;
            border-bottom: 1px solid var(--rp-border);
        }

        .carnate-reset-password-page .rp-icon {
            width: 52px;
            height: 52px;
            margin: 0 auto 13px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--rp-red-soft);
            color: var(--rp-red);
            font-size: 25px;
        }

        .carnate-reset-password-page .rp-title {
            margin: 0;
            color: var(--rp-text);
            font-size: 21px;
            line-height: 1.3;
            font-weight: 700;
        }

        .carnate-reset-password-page .rp-subtitle {
            margin: 6px 0 0;
            color: var(--rp-muted);
            font-size: 13px;
        }

        .carnate-reset-password-page .rp-body {
            padding: 28px 30px;
        }

        .carnate-reset-password-page .rp-field {
            margin-bottom: 20px;
        }

        .carnate-reset-password-page .rp-field:last-child {
            margin-bottom: 0;
        }

        .carnate-reset-password-page .rp-label {
            display: block;
            margin-bottom: 8px;
            color: #334155;
            font-size: 13px;
            font-weight: 600;
        }

        .carnate-reset-password-page .rp-input-wrap {
            position: relative;
        }

        .carnate-reset-password-page .rp-input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 18px;
            pointer-events: none;
            z-index: 2;
        }

        .carnate-reset-password-page .rp-input {
            width: 100%;
            height: 46px;
            border: 1px solid var(--rp-border);
            border-radius: 10px;
            background: #fff;
            color: var(--rp-text);
            font-size: 13px;
            padding: 0 14px 0 42px;
            outline: none;
            transition: all .2s ease;
            box-shadow: none;
        }

        .carnate-reset-password-page .rp-input::placeholder {
            color: #94a3b8;
        }

        .carnate-reset-password-page .rp-input:focus {
            border-color: rgba(229, 57, 53, .45);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        .carnate-reset-password-page .rp-input.is-invalid {
            border-color: #fca5a5;
        }

        .carnate-reset-password-page .rp-error {
            display: block;
            margin-top: 6px;
            color: #dc2626;
            font-size: 11px;
            font-weight: 500;
        }

        .carnate-reset-password-page .rp-footer {
            padding: 20px 30px 28px;
            border-top: 1px solid #f1f5f9;
        }

        .carnate-reset-password-page .rp-submit {
            width: 100%;
            min-height: 46px;
            border: 0;
            border-radius: 10px;
            background: var(--rp-red);
            color: #fff;
            font-size: 13px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
            transition: all .2s ease;
        }

        .carnate-reset-password-page .rp-submit:hover {
            background: var(--rp-red-dark);
            transform: translateY(-1px);
        }

        .carnate-reset-password-page .rp-submit:disabled {
            opacity: .7;
            cursor: not-allowed;
            transform: none;
        }

        .carnate-reset-password-page .rp-submit .spinner-border {
            width: 15px;
            height: 15px;
            border-width: 2px;
        }

        @media (max-width: 575.98px) {
            .carnate-reset-password-page {
                min-height: auto;
                padding: 20px 12px;
            }

            .carnate-reset-password-page .rp-header {
                padding: 24px 20px 20px;
            }

            .carnate-reset-password-page .rp-body {
                padding: 24px 20px;
            }

            .carnate-reset-password-page .rp-footer {
                padding: 18px 20px 22px;
            }

            .carnate-reset-password-page .rp-title {
                font-size: 19px;
            }
        }
    </style>

    <div class="rp-card">

        <form wire:submit.prevent="resetpassword">

            {{-- Header --}}
            <div class="rp-header">
                <div class="rp-icon">
                    <i class="bx bx-lock-alt"></i>
                </div>

                <h5 class="rp-title">Reset Password</h5>

                <p class="rp-subtitle">
                    Update your account password securely
                </p>
            </div>

            {{-- Form --}}
            <div class="rp-body">

                {{-- Current Password --}}
                <div class="rp-field">
                    <label class="rp-label">
                        Current Password
                        <sup class="text-danger">*</sup>
                    </label>

                    <div class="rp-input-wrap">
                        <i class="bx bx-lock rp-input-icon"></i>

                        <input type="password"
                            name="current_password"
                            class="rp-input @error('current_password') is-invalid @enderror"
                            wire:model="current_password"
                            placeholder="Enter Current Password Here...">
                    </div>

                    @error('current_password')
                        <span class="rp-error">{{ $message }}</span>
                    @enderror
                </div>

                {{-- New Password --}}
                <div class="rp-field">
                    <label class="rp-label">
                        New Password
                        <sup class="text-danger">*</sup>
                    </label>

                    <div class="rp-input-wrap">
                        <i class="bx bx-key rp-input-icon"></i>

                        <input type="password"
                            wire:model="password"
                            class="rp-input @error('password') is-invalid @enderror"
                            placeholder="Enter New Password Here...">
                    </div>

                    @error('password')
                        <span class="rp-error">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="rp-field">
                    <label for="password_confirmation" class="rp-label">
                        Confirm Password
                        <sup class="text-danger">*</sup>
                    </label>

                    <div class="rp-input-wrap">
                        <i class="bx bx-check-shield rp-input-icon"></i>

                        <input type="password"
                            wire:model="password_confirmation"
                            id="password_confirmation"
                            name="password_confirmation"
                            class="rp-input"
                            placeholder="Enter Confirm Password Here...">
                    </div>

                    @error('password_confirmation')
                        <span class="rp-error">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            {{-- Footer --}}
            <div class="rp-footer">
                <button type="submit"
                    class="rp-submit"
                    wire:loading.attr="disabled">

                    <span>Update Password</span>

                    <i class="st_loader spinner-border spinner-border-sm"
                        wire:loading>
                    </i>
                </button>
            </div>

        </form>

    </div>

</div>