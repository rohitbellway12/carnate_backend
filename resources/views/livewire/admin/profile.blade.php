<div class="carnate-profile-page">

    <style>
        .carnate-profile-page {
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
            padding: 18px;
            color: var(--carnate-text);
        }

        .carnate-profile-page .profile-card {
            background: var(--carnate-card);
            border: 1px solid var(--carnate-border);
            border-radius: 16px;
            box-shadow: 0 4px 18px rgba(15, 23, 42, .04);
            overflow: hidden;
        }

        .carnate-profile-page .page-header {
            padding: 20px 22px;
            display: flex;
            align-items: center;
            gap: 13px;
            border-bottom: 1px solid var(--carnate-border);
        }

        .carnate-profile-page .header-icon {
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

        .carnate-profile-page .page-title {
            margin: 0;
            font-size: 20px;
            font-weight: 700;
            color: var(--carnate-text);
        }

        .carnate-profile-page .page-subtitle {
            margin: 4px 0 0;
            color: var(--carnate-muted);
            font-size: 13px;
        }

        .carnate-profile-page .form-section {
            padding: 24px 22px;
        }

        .carnate-profile-page .section-heading {
            margin-bottom: 18px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--carnate-border);
        }

        .carnate-profile-page .section-heading h6 {
            margin: 0;
            font-size: 14px;
            font-weight: 700;
            color: var(--carnate-text);
        }

        .carnate-profile-page .section-heading p {
            margin: 4px 0 0;
            font-size: 12px;
            color: var(--carnate-muted);
        }

        .carnate-profile-page .field-group {
            margin-bottom: 2px;
        }

        .carnate-profile-page .form-label {
            color: #334155;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 7px;
        }

        .carnate-profile-page .required {
            color: var(--carnate-red);
        }

        .carnate-profile-page .form-control,
        .carnate-profile-page .form-select {
            min-height: 43px;
            border: 1px solid var(--carnate-border);
            border-radius: 9px;
            color: var(--carnate-text);
            background: #fff;
            font-size: 13px;
            box-shadow: none;
            transition: .2s ease;
        }

        .carnate-profile-page textarea.form-control {
            min-height: 105px;
            resize: vertical;
        }

        .carnate-profile-page .form-control:focus,
        .carnate-profile-page .form-select:focus {
            border-color: rgba(229, 57, 53, .45);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        .carnate-profile-page .form-control::placeholder {
            color: #94a3b8;
        }

        .carnate-profile-page .field-error {
            display: block;
            margin-top: 6px;
            color: #dc2626;
            font-size: 12px;
        }

        .carnate-profile-page .upload-section {
            margin-top: 6px;
            padding-top: 22px;
            border-top: 1px solid var(--carnate-border);
        }

        .carnate-profile-page .upload-box {
            border: 1px solid var(--carnate-border);
            border-radius: 12px;
            padding: 15px;
            background: #fafbfc;
        }

        .carnate-profile-page .upload-box .form-control {
            background: #fff;
        }

        .carnate-profile-page .preview-box {
            height: 76px;
            width: 100%;
            max-width: 120px;
            border: 1px dashed #cbd5e1;
            border-radius: 10px;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            margin-left: auto;
        }

        .carnate-profile-page .preview-box img {
            max-width: 100%;
            max-height: 70px;
            object-fit: contain;
        }

        .carnate-profile-page .preview-placeholder {
            color: #94a3b8;
            font-size: 11px;
            text-align: center;
        }

        .carnate-profile-page .action-footer {
            padding: 16px 22px;
            border-top: 1px solid var(--carnate-border);
            background: #fafbfc;
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }

        .carnate-profile-page .save-btn {
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

        .carnate-profile-page .save-btn:hover {
            background: var(--carnate-red-dark);
            color: #fff;
            transform: translateY(-1px);
        }

        .carnate-profile-page .save-btn:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .12);
        }

        .carnate-profile-page .save-btn .spinner-border {
            width: 15px;
            height: 15px;
            border-width: 2px;
        }

        @media (max-width: 767px) {
            .carnate-profile-page {
                padding: 12px;
            }

            .carnate-profile-page .page-header,
            .carnate-profile-page .form-section {
                padding: 17px;
            }

            .carnate-profile-page .action-footer {
                padding: 14px 17px;
            }

            .carnate-profile-page .preview-box {
                margin: 10px 0 0;
                max-width: 140px;
            }
        }
    </style>

    <div class="profile-card">

        {{-- Header --}}
        <div class="page-header">
            <div class="header-icon">
                <i class="bx bx-user"></i>
            </div>

            <div>
                <h4 class="page-title">Update Profile</h4>
                <p class="page-subtitle">
                    Update your company and contact information.
                </p>
            </div>
        </div>

        <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">
            @csrf

            <div class="form-section">

                <div class="section-heading">
                    <h6>Company Information</h6>
                    <p>Manage your company details and contact information.</p>
                </div>

                <div class="row g-4">

                    {{-- Company Name --}}
                    <div class="col-md-6">
                        <div class="field-group">
                            <label for="first_name" class="form-label">
                                Company Name <sup class="required">*</sup>
                            </label>

                            <input
                                type="text"
                                wire:model="name"
                                name="first_name"
                                id="first_name"
                                class="form-control"
                                placeholder="Enter Company Name"
                            >

                            @if ($errors->has('name'))
                                <span class="field-error">
                                    {{ $errors->first('name') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="col-md-6">
                        <div class="field-group">
                            <label class="form-label">
                                Email <sup class="required">*</sup>
                            </label>

                            <input
                                type="email"
                                wire:model="email"
                                class="form-control"
                                placeholder="Enter Email"
                            >

                            @error('email')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Mobile --}}
                    <div class="col-md-6">
                        <div class="field-group">
                            <label class="form-label">
                                Mobile Number <sup class="required">*</sup>
                            </label>

                            <input
                                type="text"
                                wire:model="mobile_no"
                                class="form-control"
                                placeholder="Enter Mobile Number"
                            >

                            @error('mobile_no')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Birth Date --}}
                    <div class="col-md-6">
                        <div class="field-group">
                            <label class="form-label">
                                Birth Date <sup class="required">*</sup>
                            </label>

                            <input
                                type="date"
                                wire:model="birth_date"
                                class="form-control"
                            >

                            @error('birth_date')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- GST --}}
                    <div class="col-md-6">
                        <div class="field-group">
                            <label class="form-label">GST Number</label>

                            <input
                                type="text"
                                wire:model="gst_number"
                                class="form-control"
                                placeholder="Enter GST Number"
                            >

                            @error('gst_number')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>

                {{-- Location --}}
                <div class="section-heading mt-4">
                    <h6>Location Details</h6>
                    <p>Select your country, state, city and address.</p>
                </div>

                <div class="row g-4">

                    {{-- Country --}}
                    <div class="col-md-6">
                        <div class="field-group">
                            <label class="form-label">
                                Country <sup class="required">*</sup>
                            </label>

                            <select
                                class="form-select"
                                wire:model="country_id"
                                wire:change="stateData($event.target.value)"
                            >
                                <option value="">Select Country</option>

                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">
                                        {{ $country->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('country_id')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- State --}}
                    <div class="col-md-6">
                        <div class="field-group">
                            <label class="form-label">
                                State <sup class="required">*</sup>
                            </label>

                            <select
                                class="form-select"
                                wire:model="state_id"
                                wire:change="cityData($event.target.value)"
                            >
                                <option value="">Select State</option>

                                @foreach ($states as $state)
                                    <option value="{{ $state->id }}">
                                        {{ $state->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('state_id')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- City --}}
                    <div class="col-md-6">
                        <div class="field-group">
                            <label class="form-label">
                                City <sup class="required">*</sup>
                            </label>

                            <select
                                class="form-select"
                                wire:model="city_id"
                            >
                                <option value="">Select City</option>

                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}">
                                        {{ $city->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('city_id')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Pincode --}}
                    <div class="col-md-6">
                        <div class="field-group">
                            <label class="form-label" for="pincode">
                                Pincode <sup class="required">*</sup>
                            </label>

                            <input
                                type="number"
                                id="pincode"
                                class="form-control"
                                wire:model="pincode"
                                placeholder="Enter Pincode"
                            >

                            @error('pincode')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Address --}}
                    <div class="col-md-12">
                        <div class="field-group">
                            <label class="form-label">
                                Address <sup class="required">*</sup>
                            </label>

                            <textarea
                                wire:model="address"
                                class="form-control"
                                placeholder="Enter Address"
                            ></textarea>

                            @error('address')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>

                {{-- Images --}}
                <div class="upload-section">

                    <div class="section-heading">
                        <h6>Company Branding</h6>
                        <p>Upload your company logo and signature image.</p>
                    </div>

                    <div class="row g-4">

                        {{-- Company Logo --}}
                        <div class="col-12">
                            <div class="upload-box">
                                <div class="row align-items-center g-3">

                                    <div class="col-md-9">
                                        <label class="form-label">
                                            Company Logo Image
                                        </label>

                                        <input
                                            type="file"
                                            class="form-control"
                                            wire:model="image"
                                        >

                                        @error('image')
                                            <span class="field-error">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-3">
                                        <div class="preview-box">
                                            @if ($image)
                                                <img
                                                    src="{{ method_exists($image, 'temporaryUrl') ? $image->temporaryUrl() : asset($image->file) }}"
                                                    alt="Company Logo"
                                                >
                                            @else
                                                <div class="preview-placeholder">
                                                    Logo preview
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        {{-- Company Sign --}}
                        <div class="col-12">
                            <div class="upload-box">
                                <div class="row align-items-center g-3">

                                    <div class="col-md-9">
                                        <label class="form-label">
                                            Company Sign Image
                                        </label>

                                        <input
                                            type="file"
                                            class="form-control"
                                            wire:model="signImage"
                                        >

                                        @error('signImage')
                                            <span class="field-error">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-3">
                                        <div class="preview-box">
                                            @if ($signImage)
                                                <img
                                                    src="{{ method_exists($signImage, 'temporaryUrl') ? $signImage->temporaryUrl() : asset($signImage->file) }}"
                                                    alt="Company Sign"
                                                >
                                            @else
                                                <div class="preview-placeholder">
                                                    Signature preview
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            {{-- Footer --}}
            <div class="action-footer">
                <button type="submit" class="save-btn">
                    <i class="bx bx-save"></i>

                    {{ $isEdit ? 'Update' : 'Create' }}

                    <i
                        class="spinner-border spinner-border-sm"
                        wire:loading
                    ></i>
                </button>
            </div>

        </form>

    </div>

</div>