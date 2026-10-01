<div class="carnate-profile-page">

    <form wire:submit="update">

        {{-- =========================
            OWNER DETAILS
        ========================== --}}
        <div class="carnate-section-card">

            <div class="carnate-section-header">
                <div class="carnate-section-heading">
                    <div class="carnate-section-icon">
                        <i class="bx bx-user"></i>
                    </div>

                    <div>
                        <span>Personal Information</span>
                        <h3>Owner Details</h3>
                        <p>Update the owner's contact and personal information.</p>
                    </div>
                </div>
            </div>

            <div class="carnate-section-body">
                <div class="carnate-form-grid">

                    {{-- First Name --}}
                    <div class="carnate-form-group">
                        <label for="first_name">
                            First Name <span>*</span>
                        </label>

                        <div class="carnate-name-input">
                            <select name="user_title"
                                id="user_title"
                                wire:model="user_title"
                                class="carnate-title-select">
                                <option value="mr">Mr.</option>
                                <option value="mrs">Mrs.</option>
                                <option value="miss">Miss</option>
                                <option value="ms">M.S.</option>
                            </select>

                            <input type="text"
                                wire:model="name"
                                name="first_name"
                                id="first_name"
                                class="carnate-input"
                                placeholder="Enter First Name">
                        </div>

                        @if ($errors->has('name') || $errors->has('user_title'))
                            <span class="carnate-error">
                                <i class="bx bx-error-circle"></i>
                                {{ $errors->first('name') ?? $errors->first('user_title') }}
                            </span>
                        @endif
                    </div>

                    {{-- Last Name --}}
                    <div class="carnate-form-group">
                        <label>
                            Last Name <span>*</span>
                        </label>

                        <input type="text"
                            wire:model="lastname"
                            class="carnate-input"
                            placeholder="Enter Last Name">

                        @error('lastname')
                            <span class="carnate-error">
                                <i class="bx bx-error-circle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="carnate-form-group">
                        <label>
                            Email <span>*</span>
                        </label>

                        <div class="carnate-input-wrap">
                            <i class="bx bx-envelope"></i>

                            <input type="email"
                                wire:model="email"
                                class="carnate-input with-icon"
                                placeholder="Enter Email">
                        </div>

                        @error('email')
                            <span class="carnate-error">
                                <i class="bx bx-error-circle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    {{-- Mobile --}}
                    <div class="carnate-form-group">
                        <label>
                            Mobile Number <span>*</span>
                        </label>

                        <div class="carnate-input-wrap">
                            <i class="bx bx-phone"></i>

                            <input type="number"
                                wire:model="mobile_no"
                                class="carnate-input with-icon"
                                placeholder="Enter Mobile Number">
                        </div>

                        @error('mobile_no')
                            <span class="carnate-error">
                                <i class="bx bx-error-circle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    {{-- Birth Date --}}
                    <div class="carnate-form-group">
                        <label>Birth Date</label>

                        <div class="carnate-input-wrap">
                            <i class="bx bx-calendar"></i>

                            <input type="date"
                                wire:model="birth_date"
                                class="carnate-input with-icon">
                        </div>

                        @error('birth_date')
                            <span class="carnate-error">
                                <i class="bx bx-error-circle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    {{-- Landline --}}
                    <div class="carnate-form-group">
                        <label>Landline Number</label>

                        <div class="carnate-input-wrap">
                            <i class="bx bx-phone-call"></i>

                            <input type="number"
                                wire:model="landline_no"
                                class="carnate-input with-icon"
                                placeholder="Enter Landline Number">
                        </div>

                        @error('landline_no')
                            <span class="carnate-error">
                                <i class="bx bx-error-circle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                </div>
            </div>
        </div>


        {{-- =========================
            COMPANY DETAILS
        ========================== --}}
        <div class="carnate-section-card">

            <div class="carnate-section-header">
                <div class="carnate-section-heading">

                    <div class="carnate-section-icon">
                        <i class="bx bx-buildings"></i>
                    </div>

                    <div>
                        <span>Business Information</span>
                        <h3>Company Details</h3>
                        <p>Manage company information, tax details and business address.</p>
                    </div>

                </div>
            </div>

            <div class="carnate-section-body">

                <div class="carnate-form-grid">

                    {{-- Company Name --}}
                    <div class="carnate-form-group">
                        <label>
                            Company Name <span>*</span>
                        </label>

                        <div class="carnate-input-wrap">
                            <i class="bx bx-buildings"></i>

                            <input type="text"
                                wire:model="company_name"
                                class="carnate-input with-icon"
                                placeholder="Enter Company Name">
                        </div>

                        @error('company_name')
                            <span class="carnate-error">
                                <i class="bx bx-error-circle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    {{-- Company Email --}}
                    <div class="carnate-form-group">
                        <label>
                            Company Email <span>*</span>
                        </label>

                        <div class="carnate-input-wrap">
                            <i class="bx bx-envelope"></i>

                            <input type="email"
                                wire:model="company_email"
                                class="carnate-input with-icon"
                                placeholder="Enter Company Email">
                        </div>

                        @error('company_email')
                            <span class="carnate-error">
                                <i class="bx bx-error-circle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    {{-- Company Number --}}
                    <div class="carnate-form-group">
                        <label>
                            Company Number <span>*</span>
                        </label>

                        <div class="carnate-input-wrap">
                            <i class="bx bx-phone"></i>

                            <input type="number"
                                wire:model="company_number"
                                class="carnate-input with-icon"
                                placeholder="Enter Company Number">
                        </div>

                        @error('company_number')
                            <span class="carnate-error">
                                <i class="bx bx-error-circle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    {{-- GST --}}
                    <div class="carnate-form-group">
                        <label>
                            Are you GST Registered? <span>*</span>
                        </label>

                        <select wire:model.live="is_gst"
                            class="carnate-input">
                            <option value="0">No (Cash Invoice)</option>
                            <option value="1">Yes (Tax Invoice)</option>
                        </select>

                        <small class="carnate-help-text">
                            <i class="bx bx-info-circle"></i>
                            If "Yes", Tax details and HSN will show on invoices.
                        </small>

                        @error('is_gst')
                            <span class="carnate-error">
                                <i class="bx bx-error-circle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    {{-- GST Number --}}
                    @if ($is_gst == 1)
                        <div class="carnate-form-group">
                            <label>GST Number</label>

                            <div class="carnate-input-wrap">
                                <i class="bx bx-receipt"></i>

                                <input type="text"
                                    wire:model="gst_no"
                                    class="carnate-input with-icon"
                                    placeholder="Enter GST Number">
                            </div>

                            @error('gst_no')
                                <span class="carnate-error">
                                    <i class="bx bx-error-circle"></i>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    @endif

                    {{-- Address --}}
                    <div class="carnate-form-group">
                        <label>
                            Company Address <span>*</span>
                        </label>

                        <textarea wire:model="address"
                            class="carnate-input carnate-textarea"
                            placeholder="Enter Company Address"></textarea>

                        @error('address')
                            <span class="carnate-error">
                                <i class="bx bx-error-circle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>


                    {{-- Company Logo --}}
                    <div class="carnate-media-group">

                        <div class="carnate-media-heading">
                            <div class="carnate-media-icon">
                                <i class="bx bx-image"></i>
                            </div>

                            <div>
                                <strong>Company Logo Image</strong>
                                <span>Upload your company logo.</span>
                            </div>
                        </div>

                        <div class="carnate-media-content">

                            <div class="carnate-upload-box">
                                <i class="bx bx-cloud-upload"></i>

                                <div>
                                    <strong>Choose Logo</strong>
                                    <span>Click to upload an image</span>
                                </div>

                                <input type="file"
                                    wire:model="image"
                                    class="carnate-file-input">
                            </div>

                            @if (!empty($image))
                                <div class="carnate-media-preview">
                                    <img src="{{ asset($image?->file) }}"
                                        alt="Company Logo">
                                </div>
                            @else
                                @if ($isEdit)
                                    <div class="carnate-media-preview">
                                        <img src="{{ asset($image?->file) }}"
                                            alt="Company Logo">
                                    </div>
                                @endif
                            @endif

                        </div>

                        @error('image')
                            <span class="carnate-error">
                                <i class="bx bx-error-circle"></i>
                                {{ $message }}
                            </span>
                        @enderror

                    </div>


                    {{-- Company Signature --}}
                    <div class="carnate-media-group">

                        <div class="carnate-media-heading">
                            <div class="carnate-media-icon">
                                <i class="bx bx-pen"></i>
                            </div>

                            <div>
                                <strong>Company Sign Image</strong>
                                <span>Upload the authorized company signature.</span>
                            </div>
                        </div>

                        <div class="carnate-media-content">

                            <div class="carnate-upload-box">
                                <i class="bx bx-cloud-upload"></i>

                                <div>
                                    <strong>Choose Signature</strong>
                                    <span>Click to upload an image</span>
                                </div>

                                <input type="file"
                                    wire:model="signImage"
                                    class="carnate-file-input">
                            </div>

                            @if (!empty($signImage))
                                <div class="carnate-media-preview">
                                    <img src="{{ asset($signImage?->file) }}"
                                        alt="Company Signature">
                                </div>
                            @else
                                @if ($isEdit)
                                    <div class="carnate-media-preview">
                                        <img src="{{ asset($signImage?->file) }}"
                                            alt="Company Signature">
                                    </div>
                                @endif
                            @endif

                        </div>

                        @error('signImage')
                            <span class="carnate-error">
                                <i class="bx bx-error-circle"></i>
                                {{ $message }}
                            </span>
                        @enderror

                    </div>


                    {{-- Country --}}
                    <div class="carnate-form-group">
                        <label>
                            Country <span>*</span>
                        </label>

                        <select class="carnate-input"
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
                            <span class="carnate-error">
                                <i class="bx bx-error-circle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>


                    {{-- State --}}
                    <div class="carnate-form-group">
                        <label>
                            State <span>*</span>
                        </label>

                        <select class="carnate-input"
                            wire:model="state_id"
                            wire:change="cityData($event.target.value,true)">

                            <option value="">Select State</option>

                            @foreach ($states as $state)
                                <option value="{{ $state->id }}"
                                    @selected($state->id == $state_id)>
                                    {{ $state->name }}
                                </option>
                            @endforeach

                        </select>

                        @error('state_id')
                            <span class="carnate-error">
                                <i class="bx bx-error-circle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>


                    {{-- City --}}
                    <div class="carnate-form-group">
                        <label>
                            City <span>*</span>
                        </label>

                        <select class="carnate-input"
                            wire:model="city_id">

                            <option value="">Select City</option>

                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}"
                                    @selected($city->id == $city_id)>
                                    {{ $city->name }}
                                </option>
                            @endforeach

                        </select>

                        @error('city_id')
                            <span class="carnate-error">
                                <i class="bx bx-error-circle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>


                    {{-- Pincode --}}
                    <div class="carnate-form-group">
                        <label for="pincode">
                            Pincode <span>*</span>
                        </label>

                        <input type="number"
                            name="pincode"
                            id="pincode"
                            wire:model="pincode"
                            class="carnate-input"
                            placeholder="Enter Pincode">

                        @error('pincode')
                            <span class="carnate-error">
                                <i class="bx bx-error-circle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                </div>
            </div>
        </div>


        {{-- Update --}}
        <div class="carnate-form-actions">

            <div class="carnate-save-note">
                <i class="bx bx-shield-check"></i>
                <span>Your changes will be saved securely.</span>
            </div>

            <button type="submit"
                class="carnate-btn carnate-btn-primary"
                wire:loading.attr="disabled">

                <i class="bx bx-save"></i>
                Update

                <span wire:loading class="carnate-spinner"></span>

            </button>

        </div>

    </form>


    {{-- IMPORTANT: style remains INSIDE the single Livewire root --}}
    <style>
        .carnate-profile-page {
            --carnate-red: #e53935;
            --carnate-red-soft: #fff5f5;
            --carnate-text: #111827;
            --carnate-muted: #64748b;
            --carnate-border: #e2e8f0;

            min-height: calc(100vh - 70px);
            padding: 24px;
            background: #f7f8fa;
            color: var(--carnate-text);
        }

        .carnate-profile-page * {
            box-sizing: border-box;
        }

        .carnate-section-card {
            margin-bottom: 20px;
            overflow: hidden;
            border: 1px solid var(--carnate-border);
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 4px 18px rgba(15, 23, 42, .035);
        }

        .carnate-section-header {
            padding: 20px 22px;
            border-bottom: 1px solid var(--carnate-border);
        }

        .carnate-section-heading {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .carnate-section-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
            flex: 0 0 44px;
            border-radius: 12px;
            background: var(--carnate-red-soft);
            color: var(--carnate-red);
            font-size: 21px;
        }

        .carnate-section-heading > div:last-child > span {
            display: block;
            margin-bottom: 3px;
            color: var(--carnate-red);
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .1em;
            text-transform: uppercase;
        }

        .carnate-section-heading h3 {
            margin: 0;
            font-size: 18px;
            font-weight: 750;
        }

        .carnate-section-heading p {
            margin: 5px 0 0;
            color: var(--carnate-muted);
            font-size: 12px;
        }

        .carnate-section-body {
            padding: 24px 22px;
        }

        .carnate-form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }

        .carnate-form-group {
            min-width: 0;
        }

        .carnate-form-group label {
            display: block;
            margin-bottom: 7px;
            color: #334155;
            font-size: 13px;
            font-weight: 700;
        }

        .carnate-form-group label > span {
            color: var(--carnate-red);
        }

        .carnate-input {
            width: 100%;
            min-height: 44px;
            padding: 10px 13px;
            border: 1px solid var(--carnate-border);
            border-radius: 10px;
            outline: none;
            background: #fff;
            color: var(--carnate-text);
            font-size: 13px;
            transition: .2s ease;
        }

        .carnate-input:focus {
            border-color: rgba(229, 57, 53, .45);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        .carnate-input-wrap {
            position: relative;
        }

        .carnate-input-wrap > i {
            position: absolute;
            top: 50%;
            left: 13px;
            z-index: 1;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 17px;
            pointer-events: none;
        }

        .carnate-input.with-icon {
            padding-left: 40px;
        }

        .carnate-name-input {
            display: flex;
        }

        .carnate-title-select {
            width: 82px;
            min-height: 44px;
            padding: 0 7px;
            border: 1px solid var(--carnate-border);
            border-right: 0;
            border-radius: 10px 0 0 10px;
            outline: none;
            background: #f8fafc;
            color: #475569;
            font-size: 12px;
        }

        .carnate-name-input .carnate-input {
            border-radius: 0 10px 10px 0;
        }

        .carnate-textarea {
            min-height: 105px;
            resize: vertical;
        }

        .carnate-help-text {
            display: flex;
            align-items: center;
            gap: 4px;
            margin-top: 7px;
            color: #94a3b8;
            font-size: 11px;
        }

        .carnate-error {
            display: flex;
            align-items: center;
            gap: 5px;
            margin-top: 6px;
            color: #dc2626;
            font-size: 12px;
        }

        .carnate-media-group {
            min-width: 0;
        }

        .carnate-media-heading {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 9px;
        }

        .carnate-media-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            border-radius: 9px;
            background: #f1f5f9;
            color: #64748b;
            font-size: 17px;
        }

        .carnate-media-heading strong {
            display: block;
            color: #334155;
            font-size: 13px;
        }

        .carnate-media-heading span {
            display: block;
            margin-top: 2px;
            color: #94a3b8;
            font-size: 10px;
        }

        .carnate-media-content {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .carnate-upload-box {
            position: relative;
            display: flex;
            align-items: center;
            gap: 11px;
            min-height: 70px;
            flex: 1;
            padding: 11px 13px;
            overflow: hidden;
            border: 1px dashed #cbd5e1;
            border-radius: 11px;
            background: #f8fafc;
        }

        .carnate-upload-box > i {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            flex: 0 0 38px;
            border-radius: 10px;
            background: #fff;
            color: var(--carnate-red);
            font-size: 20px;
        }

        .carnate-upload-box strong {
            display: block;
            color: #334155;
            font-size: 12px;
        }

        .carnate-upload-box span {
            display: block;
            margin-top: 3px;
            color: #94a3b8;
            font-size: 10px;
        }

        .carnate-file-input {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .carnate-media-preview {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 78px;
            height: 70px;
            flex: 0 0 78px;
            overflow: hidden;
            border: 1px solid var(--carnate-border);
            border-radius: 11px;
            background: #f8fafc;
        }

        .carnate-media-preview img {
            width: 100%;
            height: 100%;
            padding: 7px;
            object-fit: contain;
        }

        .carnate-form-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 4px 2px 20px;
        }

        .carnate-save-note {
            display: flex;
            align-items: center;
            gap: 7px;
            color: #64748b;
            font-size: 12px;
        }

        .carnate-save-note i {
            color: #16a34a;
            font-size: 17px;
        }

        .carnate-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            min-height: 44px;
            padding: 0 20px;
            border: 0;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s ease;
        }

        .carnate-btn-primary {
            background: var(--carnate-red);
            color: #fff;
            box-shadow: 0 5px 12px rgba(229, 57, 53, .14);
        }

        .carnate-btn-primary:hover {
            background: #d8322f;
            color: #fff;
        }

        .carnate-spinner {
            width: 14px;
            height: 14px;
            border: 2px solid rgba(255, 255, 255, .45);
            border-top-color: #fff;
            border-radius: 50%;
            animation: carnateSpin .65s linear infinite;
        }

        @keyframes carnateSpin {
            to {
                transform: rotate(360deg);
            }
        }

        @media (max-width: 767px) {
            .carnate-profile-page {
                padding: 16px;
            }

            .carnate-section-header,
            .carnate-section-body {
                padding: 18px;
            }

            .carnate-form-grid {
                grid-template-columns: 1fr;
                gap: 17px;
            }

            .carnate-form-actions {
                align-items: stretch;
                flex-direction: column;
            }

            .carnate-btn {
                width: 100%;
            }

            .carnate-save-note {
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .carnate-section-heading {
                align-items: flex-start;
            }

            .carnate-section-icon {
                width: 40px;
                height: 40px;
                flex-basis: 40px;
            }

            .carnate-section-heading h3 {
                font-size: 16px;
            }

            .carnate-media-content {
                align-items: stretch;
                flex-direction: column;
            }

            .carnate-media-preview {
                width: 100%;
                height: 90px;
                flex-basis: 90px;
            }
        }
    </style>

</div>