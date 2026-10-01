<div class="carnate-owner-profile-page">

    <style>
        .carnate-owner-profile-page {
            --op-bg: #f7f8fa;
            --op-card: #ffffff;
            --op-text: #111827;
            --op-muted: #64748b;
            --op-border: #e2e8f0;
            --op-red: #e53935;
            --op-red-dark: #c92f2c;
            --op-red-soft: #fff5f5;
            --op-icon: #f1f5f9;
            --op-shadow: 0 8px 28px rgba(15, 23, 42, .06);

            color: var(--op-text);
        }

        .carnate-owner-profile-page .op-section {
            background: var(--op-card);
            border: 1px solid var(--op-border);
            border-radius: 16px;
            box-shadow: var(--op-shadow);
            overflow: hidden;
            margin-bottom: 18px;
        }

        .carnate-owner-profile-page .op-section-header {
            padding: 18px 22px;
            border-bottom: 1px solid var(--op-border);
            background: #fff;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .carnate-owner-profile-page .op-section-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: var(--op-red-soft);
            color: var(--op-red);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        .carnate-owner-profile-page .op-section-title {
            margin: 0;
            color: var(--op-text);
            font-size: 16px;
            font-weight: 700;
        }

        .carnate-owner-profile-page .op-section-subtitle {
            margin: 3px 0 0;
            color: var(--op-muted);
            font-size: 11px;
        }

        .carnate-owner-profile-page .op-section-body {
            padding: 22px;
        }

        .carnate-owner-profile-page .op-label {
            display: block;
            margin-bottom: 7px;
            color: #334155;
            font-size: 12px;
            font-weight: 600;
        }

        .carnate-owner-profile-page .op-required {
            color: var(--op-red);
        }

        .carnate-owner-profile-page .op-input,
        .carnate-owner-profile-page .op-select,
        .carnate-owner-profile-page textarea.op-input {
            width: 100%;
            min-height: 42px;
            border: 1px solid var(--op-border);
            border-radius: 9px;
            background: #fff;
            color: var(--op-text);
            font-size: 13px;
            padding: 9px 12px;
            outline: none;
            box-shadow: none;
            transition: .2s ease;
        }

        .carnate-owner-profile-page textarea.op-input {
            min-height: 92px;
            resize: vertical;
        }

        .carnate-owner-profile-page .op-input:focus,
        .carnate-owner-profile-page .op-select:focus,
        .carnate-owner-profile-page textarea.op-input:focus {
            border-color: rgba(229, 57, 53, .45);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        .carnate-owner-profile-page .op-name-group {
            display: flex;
        }

        .carnate-owner-profile-page .op-title-select {
            width: 82px;
            flex: 0 0 82px;
            border-radius: 9px 0 0 9px;
            border-right: 0;
        }

        .carnate-owner-profile-page .op-name-input {
            border-radius: 0 9px 9px 0;
        }

        .carnate-owner-profile-page .op-error {
            display: block;
            margin-top: 6px;
            color: #dc2626;
            font-size: 11px;
            font-weight: 500;
        }

        /* GST */
        .carnate-owner-profile-page .op-gst-hidden {
            display: none;
        }

        /* Upload fields */
        .carnate-owner-profile-page .op-upload-row {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 110px;
            gap: 18px;
            align-items: center;
            margin-top: 6px;
        }

        .carnate-owner-profile-page .op-preview {
            width: 100px;
            height: 70px;
            border: 1px solid var(--op-border);
            border-radius: 10px;
            background: #f8fafc;
            padding: 6px;
            object-fit: contain;
        }

        .carnate-owner-profile-page .op-preview-empty {
            width: 100px;
            height: 70px;
            border: 1px dashed #cbd5e1;
            border-radius: 10px;
            background: #f8fafc;
            color: #94a3b8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .carnate-owner-profile-page .op-file-input {
            cursor: pointer;
        }

        /* Footer */
        .carnate-owner-profile-page .op-submit-wrap {
            display: flex;
            justify-content: flex-end;
            margin-top: 4px;
            margin-bottom: 8px;
        }

        .carnate-owner-profile-page .op-submit {
            min-width: 120px;
            min-height: 43px;
            border: 0;
            border-radius: 9px;
            padding: 0 18px;
            background: var(--op-red);
            color: #fff;
            font-size: 13px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            transition: .2s ease;
        }

        .carnate-owner-profile-page .op-submit:hover {
            background: var(--op-red-dark);
            color: #fff;
            transform: translateY(-1px);
        }

        .carnate-owner-profile-page .op-submit .spinner-border {
            width: 14px;
            height: 14px;
            border-width: 2px;
        }

        @media (max-width: 767.98px) {
            .carnate-owner-profile-page .op-section-header {
                padding: 16px;
            }

            .carnate-owner-profile-page .op-section-body {
                padding: 16px;
            }

            .carnate-owner-profile-page .op-upload-row {
                grid-template-columns: 1fr;
            }

            .carnate-owner-profile-page .op-preview,
            .carnate-owner-profile-page .op-preview-empty {
                width: 100px;
            }

            .carnate-owner-profile-page .op-submit-wrap {
                justify-content: stretch;
            }

            .carnate-owner-profile-page .op-submit {
                width: 100%;
            }
        }
    </style>

    <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">
        @csrf

        {{-- =====================================================
             OWNER DETAILS
        ====================================================== --}}
        <div class="op-section">

            <div class="op-section-header">
                <div class="op-section-icon">
                    <i class="bx bx-user"></i>
                </div>

                <div>
                    <h4 class="op-section-title">Owner Details</h4>
                    <p class="op-section-subtitle">
                        Personal and contact information
                    </p>
                </div>
            </div>

            <div class="op-section-body">

                <div class="row g-3">

                    {{-- First Name --}}
                    <div class="col-md-6">

                        <label for="first_name" class="op-label">
                            First Name
                            <sup class="op-required">*</sup>
                        </label>

                        <div class="op-name-group">

                            <select name="user_title"
                                id="user_title"
                                wire:model="user_title"
                                class="op-select op-title-select">

                                <option value="mr">Mr.</option>
                                <option value="mrs">Mrs.</option>
                                <option value="miss">Miss</option>
                                <option value="ms">M.S.</option>

                            </select>

                            <input type="text"
                                wire:model="name"
                                name="first_name"
                                id="first_name"
                                class="op-input op-name-input"
                                placeholder="Enter First Name">

                        </div>

                        @if ($errors->has('name') || $errors->has('user_title'))
                            <span class="op-error">
                                {{ $errors->first('name') ?? $errors->first('user_title') }}
                            </span>
                        @endif

                    </div>

                    {{-- Last Name --}}
                    <div class="col-md-6">

                        <label class="op-label">
                            Last Name
                            <sup class="op-required">*</sup>
                        </label>

                        <input type="text"
                            wire:model="lastname"
                            class="op-input"
                            placeholder="Enter Last Name">

                        @error('lastname')
                            <span class="op-error">{{ $message }}</span>
                        @enderror

                    </div>

                    {{-- Email --}}
                    <div class="col-md-6">

                        <label class="op-label">
                            Email
                            <sup class="op-required">*</sup>
                        </label>

                        <input type="email"
                            wire:model="email"
                            class="op-input"
                            placeholder="Enter Email">

                        @error('email')
                            <span class="op-error">{{ $message }}</span>
                        @enderror

                    </div>

                    {{-- Mobile --}}
                    <div class="col-md-6">

                        <label class="op-label">
                            Mobile Number
                            <sup class="op-required">*</sup>
                        </label>

                        <input type="text"
                            wire:model="mobile_no"
                            class="op-input"
                            placeholder="Enter Mobile Number">

                        @error('mobile_no')
                            <span class="op-error">{{ $message }}</span>
                        @enderror

                    </div>

                    {{-- Birth Date --}}
                    <div class="col-md-6">

                        <label class="op-label">
                            Birth Date
                        </label>

                        <input type="date"
                            wire:model="birth_date"
                            class="op-input">

                    </div>

                    {{-- Landline --}}
                    <div class="col-md-6">

                        <label class="op-label">
                            Landline Number
                        </label>

                        <input type="text"
                            wire:model="landline_no"
                            class="op-input"
                            placeholder="Enter Landline Number">

                        @error('landline_no')
                            <span class="op-error">{{ $message }}</span>
                        @enderror

                    </div>

                </div>

            </div>

        </div>

        {{-- =====================================================
             COMPANY DETAILS
        ====================================================== --}}
        <div class="op-section">

            <div class="op-section-header">
                <div class="op-section-icon">
                    <i class="bx bx-buildings"></i>
                </div>

                <div>
                    <h4 class="op-section-title">Company Details</h4>
                    <p class="op-section-subtitle">
                        Company information, branding and billing details
                    </p>
                </div>
            </div>

            <div class="op-section-body">

                <div class="row g-3">

                    {{-- Company Name --}}
                    <div class="col-md-6">

                        <label class="op-label">
                            Company Name
                            <sup class="op-required">*</sup>
                        </label>

                        <input type="text"
                            class="op-input"
                            wire:model="company_name"
                            placeholder="Company Name">

                        @error('company_name')
                            <span class="op-error">{{ $message }}</span>
                        @enderror

                    </div>

                    {{-- Company Email --}}
                    <div class="col-md-6">

                        <label class="op-label">
                            Company Email
                            <sup class="op-required">*</sup>
                        </label>

                        <input type="email"
                            wire:model="branch_email"
                            class="op-input"
                            placeholder="Enter Branch Email">

                        @error('branch_email')
                            <span class="op-error">{{ $message }}</span>
                        @enderror

                    </div>

                    {{-- Company Number --}}
                    <div class="col-md-6">

                        <label class="op-label">
                            Company Number
                            <sup class="op-required">*</sup>
                        </label>

                        <input type="text"
                            wire:model="branch_number"
                            class="op-input"
                            placeholder="Enter Branch Number">

                        @error('branch_number')
                            <span class="op-error">{{ $message }}</span>
                        @enderror

                    </div>

                    {{-- GST Billing --}}
                    <div class="col-md-6">

                        <label class="op-label">
                            GST Billing
                        </label>

                        <select class="op-select"
                            wire:model.live="is_gst">

                            <option value="0">No</option>
                            <option value="1">Yes</option>

                        </select>

                        @error('is_gst')
                            <span class="op-error">{{ $message }}</span>
                        @enderror

                    </div>

                    {{-- GST Number --}}
                    <div class="col-md-6"
                        @if($is_gst == 0) style="display:none;" @endif>

                        <label class="op-label">
                            GST Number
                        </label>

                        <input type="text"
                            wire:model="gst"
                            placeholder="Enter GST"
                            class="op-input">

                        @error('gst')
                            <span class="op-error">{{ $message }}</span>
                        @enderror

                    </div>

                    {{-- Company Logo --}}
                    <div class="col-12">

                        <div class="op-upload-row">

                            <div>
                                <label class="op-label">
                                    Company Logo Image
                                    <span class="op-required">*</span>
                                </label>

                                <input type="file"
                                    class="op-input op-file-input"
                                    wire:model="image">
                            </div>

                            <div>
                                @if (!empty($image))
                                    <img class="op-preview"
                                        src="{{ asset($image?->file) }}">
                                @else
                                    @if ($isEdit)
                                        <img class="op-preview"
                                            src="{{ asset($image?->file) }}">
                                    @else
                                        <div class="op-preview-empty">
                                            <i class="bx bx-image"></i>
                                        </div>
                                    @endif
                                @endif
                            </div>

                        </div>

                        @error('image')
                            <span class="op-error">{{ $message }}</span>
                        @enderror

                    </div>

                    {{-- Company Sign --}}
                    <div class="col-12">

                        <div class="op-upload-row">

                            <div>
                                <label class="op-label">
                                    Company Sign Image
                                    <span class="op-required">*</span>
                                </label>

                                <input type="file"
                                    class="op-input op-file-input"
                                    wire:model="signImage">
                            </div>

                            <div>
                                @if (!empty($signImage))
                                    <img class="op-preview"
                                        src="{{ asset($signImage?->file) }}">
                                @else
                                    @if ($isEdit)
                                        <img class="op-preview"
                                            src="{{ asset($signImage?->file) }}">
                                    @else
                                        <div class="op-preview-empty">
                                            <i class="bx bx-image"></i>
                                        </div>
                                    @endif
                                @endif
                            </div>

                        </div>

                        @error('signImage')
                            <span class="op-error">{{ $message }}</span>
                        @enderror

                    </div>

                    {{-- Tagline --}}
                    <div class="col-md-12">

                        <label class="op-label">
                            Tagline
                        </label>

                        <input type="text"
                            wire:model="tagline"
                            placeholder="Enter Tagline"
                            class="op-input"
                            value="">

                        @error('tagline')
                            <span class="op-error">{{ $message }}</span>
                        @enderror

                    </div>

                    {{-- Company Address --}}
                    <div class="col-md-12">

                        <label class="op-label">
                            Company Address
                            <span class="op-required">*</span>
                        </label>

                        <textarea wire:model="address"
                            class="op-input"
                            placeholder="Enter Address"></textarea>

                        @error('address')
                            <span class="op-error">{{ $message }}</span>
                        @enderror

                    </div>

                    {{-- Country --}}
                    <div class="@if ($isEdit == true) col-md-6 @else col-md-4 @endif">

                        <label class="op-label">
                            Country
                            <span class="op-required">*</span>
                        </label>

                        <select class="op-select"
                            wire:change="stateData($event.target.value,true)"
                            wire:model="country_id">

                            <option value="">Select Country</option>

                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">
                                    {{ $country->name }}
                                </option>
                            @endforeach

                        </select>

                        @error('country_id')
                            <span class="op-error">{{ $message }}</span>
                        @enderror

                    </div>

                    {{-- State --}}
                    <div class="@if ($isEdit == true) col-md-6 @else col-md-4 @endif">

                        <label class="op-label">
                            State
                            <span class="op-required">*</span>
                        </label>

                        <select class="op-select select2"
                            wire:model="state_id"
                            wire:change="cityData($event.target.value,true)">

                            <option value="">Select State</option>

                            @foreach ($states as $state)
                                <option value="{{ $state->id }}"
                                    @selected($state_id == $state->id)>
                                    {{ $state->name }}
                                </option>
                            @endforeach

                        </select>

                        @error('state_id')
                            <span class="op-error">{{ $message }}</span>
                        @enderror

                    </div>

                    {{-- City --}}
                    <div class="@if ($isEdit == true) col-md-6 @else col-md-4 @endif">

                        <label class="op-label">
                            City
                            <span class="op-required">*</span>
                        </label>

                        <select class="op-select"
                            wire:model="city_id">

                            <option value="">Select City</option>

                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}"
                                    @selected($city_id == $city->id)>
                                    {{ $city->name }}
                                </option>
                            @endforeach

                        </select>

                        @error('city_id')
                            <span class="op-error">{{ $message }}</span>
                        @enderror

                    </div>

                    {{-- Pincode --}}
                    <div class="col-md-6">

                        <label class="op-label" for="pincode">
                            Pincode
                            <sup class="op-required">*</sup>
                        </label>

                        <input type="text"
                            name="pincode"
                            id="pincode"
                            wire:model="pincode"
                            class="op-input"
                            placeholder="Pincode">

                        @error('pincode')
                            <span class="op-error">{{ $message }}</span>
                        @enderror

                    </div>

                </div>

            </div>

        </div>

        {{-- Submit --}}
        <div class="op-submit-wrap">
            <button type="submit" class="op-submit">

                {{ $isEdit ? 'Update' : 'Create' }}

                <i class="spinner-border spinner-border-sm"
                    wire:loading>
                </i>

            </button>
        </div>

    </form>

</div>