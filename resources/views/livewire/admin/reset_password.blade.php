<div class="carnate-reset-password">

    <style>
        .carnate-reset-password {
            --carnate-bg: #f7f8fa;
            --carnate-card: #ffffff;
            --carnate-text: #111827;
            --carnate-muted: #64748b;
            --carnate-border: #e2e8f0;
            --carnate-red: #e53935;
            --carnate-red-dark: #c92f2c;
            --carnate-red-soft: #fff5f5;

            background: var(--carnate-bg);
            min-height: 100%;
            padding: 20px;
            color: var(--carnate-text);
        }

        .carnate-reset-password .password-card {
            max-width: 720px;
            margin: 0 auto;
            background: var(--carnate-card);
            border: 1px solid var(--carnate-border);
            border-radius: 18px;
            box-shadow: 0 5px 22px rgba(15, 23, 42, 0.05);
            overflow: hidden;
        }

        .carnate-reset-password .password-header {
            padding: 22px 24px;
            border-bottom: 1px solid var(--carnate-border);
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .carnate-reset-password .password-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: var(--carnate-red-soft);
            color: var(--carnate-red);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 21px;
            flex-shrink: 0;
        }

        .carnate-reset-password .password-title {
            margin: 0;
            font-size: 19px;
            font-weight: 700;
            color: var(--carnate-text);
        }

        .carnate-reset-password .password-subtitle {
            margin: 4px 0 0;
            color: var(--carnate-muted);
            font-size: 13px;
        }

        .carnate-reset-password .success-alert {
            max-width: 720px;
            margin: 0 auto 16px;
            border: 1px solid #bbf7d0;
            background: #f0fdf4;
            color: #166534;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 13px;
        }

        .carnate-reset-password .password-body {
            padding: 24px;
        }

        .carnate-reset-password .password-field {
            margin-bottom: 20px;
        }

        .carnate-reset-password .password-label {
            display: block;
            margin-bottom: 7px;
            color: #334155;
            font-size: 13px;
            font-weight: 600;
        }

        .carnate-reset-password .required {
            color: var(--carnate-red);
        }

        .carnate-reset-password .input-wrap {
            position: relative;
        }

        .carnate-reset-password .password-input {
            width: 100%;
            min-height: 44px;
            padding: 10px 13px;
            border: 1px solid var(--carnate-border);
            border-radius: 10px;
            background: #fff;
            color: var(--carnate-text);
            font-size: 13px;
            outline: none;
            transition: .2s ease;
        }

        .carnate-reset-password .password-input:focus {
            border-color: rgba(229, 57, 53, .5);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        .carnate-reset-password .password-input::placeholder {
            color: #94a3b8;
        }

        .carnate-reset-password .field-error {
            display: block;
            margin-top: 6px;
            color: #dc2626;
            font-size: 12px;
        }

        .carnate-reset-password .password-footer {
            margin: 4px -24px -24px;
            padding: 16px 24px;
            border-top: 1px solid var(--carnate-border);
            display: flex;
            justify-content: flex-end;
            background: #fafbfc;
        }

        .carnate-reset-password .save-btn {
            min-height: 42px;
            padding: 0 19px;
            border: 0;
            border-radius: 9px;
            background: var(--carnate-red);
            color: #fff;
            font-size: 13px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
            transition: .2s ease;
        }

        .carnate-reset-password .save-btn:hover {
            background: var(--carnate-red-dark);
            transform: translateY(-1px);
        }

        .carnate-reset-password .save-btn:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .12);
        }

        @media (max-width: 767px) {
            .carnate-reset-password {
                padding: 12px;
            }

            .carnate-reset-password .password-header {
                padding: 18px;
            }

            .carnate-reset-password .password-body {
                padding: 18px;
            }

            .carnate-reset-password .password-footer {
                margin: 4px -18px -18px;
                padding: 15px 18px;
            }
        }
    </style>

    {{-- Success Message --}}
    @if (session()->has('message'))
        <div class="success-alert">
            <i class="bx bx-check-circle me-1"></i>
            {{ session('message') }}
        </div>
    @endif

    <div class="password-card">

        {{-- Header --}}
        <div class="password-header">
            <div class="password-icon">
                <i class="bx bx-lock-alt"></i>
            </div>

            <div>
                <h4 class="password-title">Reset Password</h4>
                <p class="password-subtitle">
                    Update your account password securely.
                </p>
            </div>
        </div>

        {{-- Form --}}
        <div class="password-body">
            <form wire:submit.prevent="{{ 'resetpassword' }}">
                @csrf

                <div class="password-field">
                    <label class="password-label">
                        Old Password <sup class="required">*</sup>
                    </label>

                    <div class="input-wrap">
                        <input
                            type="password"
                            name="name"
                            class="password-input"
                            wire:model="old_password"
                            placeholder="Enter old password..."
                            value=""
                        >
                    </div>

                    @error('old_password')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="password-field">
                    <label class="password-label">
                        New Password <sup class="required">*</sup>
                    </label>

                    <div class="input-wrap">
                        <input
                            type="text"
                            wire:model="password"
                            class="password-input"
                            placeholder="Enter new password..."
                            value=""
                        >
                    </div>

                    @error('password')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="password-field">
                    <label class="password-label">
                        Confirm Password <sup class="required">*</sup>
                    </label>

                    <div class="input-wrap">
                        <input
                            type="text"
                            wire:model="confirmed"
                            class="password-input"
                            placeholder="Confirm new password..."
                            value=""
                        >
                    </div>

                    @error('confirmed')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="password-footer">
                    <button type="submit" class="save-btn">
                        <i class="bx bx-save"></i>
                        Save
                        <i
                            class="st_loader spinner-border spinner-border-sm"
                            style="display:none;"
                        ></i>
                    </button>
                </div>

            </form>
        </div>

    </div>

</div>