<div class="carnate-staff-page">

    <style>
        .carnate-staff-page {
            --carnate-red: #e53935;
            --carnate-red-soft: #fff5f5;
            --carnate-text: #111827;
            --carnate-muted: #64748b;
            --carnate-border: #e2e8f0;
            --carnate-bg: #f7f8fa;
            --carnate-icon: #f1f5f9;
            color: var(--carnate-text);
        }

        .carnate-staff-page .carnate-card {
            background: #fff;
            border: 1px solid var(--carnate-border);
            border-radius: 16px;
            box-shadow: 0 4px 18px rgba(15, 23, 42, .04);
        }

        /* Header */
        .carnate-staff-page .staff-page-header {
            padding: 20px 22px;
        }

        .carnate-staff-page .staff-page-title {
            margin: 0;
            font-size: 21px;
            font-weight: 700;
            letter-spacing: -.02em;
            color: var(--carnate-text);
        }

        .carnate-staff-page .staff-page-subtitle {
            margin: 5px 0 0;
            color: var(--carnate-muted);
            font-size: 13px;
        }

        /* Buttons */
        .carnate-staff-page .btn-carnate {
            background: var(--carnate-red);
            border-color: var(--carnate-red);
            color: #fff;
            border-radius: 9px;
            font-weight: 600;
            padding: 9px 16px;
            box-shadow: 0 5px 12px rgba(229, 57, 53, .14);
        }

        .carnate-staff-page .btn-carnate:hover,
        .carnate-staff-page .btn-carnate:focus {
            background: #d9322f;
            border-color: #d9322f;
            color: #fff;
        }

        .carnate-staff-page .btn-carnate-light {
            background: #fff;
            border: 1px solid var(--carnate-border);
            color: var(--carnate-muted);
            border-radius: 9px;
            font-weight: 600;
            padding: 9px 16px;
        }

        .carnate-staff-page .btn-carnate-light:hover {
            background: #f8fafc;
            color: var(--carnate-text);
            border-color: #cbd5e1;
        }

        /* Filters */
        .carnate-staff-page .filter-card {
            padding: 18px 20px;
        }

        .carnate-staff-page .filter-label,
        .carnate-staff-page .modal-form-label {
            display: block;
            margin-bottom: 7px;
            font-size: 12px;
            font-weight: 600;
            color: #475569;
        }

        .carnate-staff-page .form-control,
        .carnate-staff-page .form-select {
            min-height: 42px;
            border: 1px solid var(--carnate-border);
            border-radius: 9px;
            color: var(--carnate-text);
            background: #fff;
            box-shadow: none;
        }

        .carnate-staff-page textarea.form-control {
            min-height: 90px;
        }

        .carnate-staff-page .form-control:focus,
        .carnate-staff-page .form-select:focus {
            border-color: rgba(229, 57, 53, .45);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        .carnate-staff-page .input-group .form-select {
            border-radius: 9px 0 0 9px;
            min-width: 76px;
        }

        .carnate-staff-page .input-group .form-control {
            border-radius: 0 9px 9px 0;
        }

        /* Table */
        .carnate-staff-page .staff-table-card {
            overflow: hidden;
        }

        .carnate-staff-page .table-wrap {
            overflow-x: auto;
        }

        .carnate-staff-page .staff-table {
            margin: 0;
            min-width: 900px;
        }

        .carnate-staff-page .staff-table thead th {
            background: #f8fafc;
            border-bottom: 1px solid var(--carnate-border);
            border-top: 0;
            color: #475569;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
            padding: 14px 16px;
            white-space: nowrap;
        }

        .carnate-staff-page .staff-table tbody td {
            border-color: #eef2f7;
            padding: 14px 16px;
            color: #334155;
            font-size: 13px;
            vertical-align: middle;
        }

        .carnate-staff-page .staff-table tbody tr:hover {
            background: #fafafa;
        }

        .carnate-staff-page .staff-name {
            color: var(--carnate-text);
            font-weight: 650;
        }

        .carnate-staff-page .staff-email {
            color: var(--carnate-muted);
        }

        /* Role / state badges */
        .carnate-staff-page .role-badge {
            display: inline-flex;
            align-items: center;
            padding: 5px 9px;
            border-radius: 7px;
            background: #f1f5f9;
            color: #475569;
            font-size: 11px;
            font-weight: 600;
        }

        .carnate-staff-page .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 9px;
            border-radius: 7px;
            font-size: 11px;
            font-weight: 600;
        }

        .carnate-staff-page .status-badge.yes {
            background: #ecfdf5;
            color: #047857;
        }

        .carnate-staff-page .status-badge.no {
            background: #f8fafc;
            color: #64748b;
        }

        /* Login switch */
        .carnate-staff-page .login-switch {
            display: inline-flex;
            align-items: center;
            gap: 7px;
        }

        .carnate-staff-page .login-switch .form-check-input {
            width: 36px;
            height: 20px;
            margin: 0;
            cursor: pointer;
            box-shadow: none;
            border-color: #cbd5e1;
            background-color: #e2e8f0;
        }

        .carnate-staff-page .login-switch .form-check-input:checked {
            background-color: var(--carnate-red);
            border-color: var(--carnate-red);
        }

        .carnate-staff-page .login-switch .switch-text {
            min-width: 22px;
            font-size: 11px;
            font-weight: 600;
            color: var(--carnate-muted);
        }

        /* Action buttons */
        .carnate-staff-page .staff-actions {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            white-space: nowrap;
        }

        .carnate-staff-page .staff-action {
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            border: 1px solid var(--carnate-border);
            background: #fff;
            color: #64748b;
            cursor: pointer;
            transition: .2s ease;
        }

        .carnate-staff-page .staff-action:hover {
            background: #f8fafc;
            color: var(--carnate-text);
            border-color: #cbd5e1;
        }

        .carnate-staff-page .staff-action.view:hover {
            color: #2563eb;
            border-color: #bfdbfe;
            background: #eff6ff;
        }

        .carnate-staff-page .staff-action.edit:hover {
            color: #475569;
            background: #f1f5f9;
        }

        .carnate-staff-page .staff-action.delete:hover {
            color: var(--carnate-red);
            border-color: #fecaca;
            background: var(--carnate-red-soft);
        }

        .carnate-staff-page .add-user-btn {
            border: 0;
            background: #ecfdf5;
            color: #047857;
            border-radius: 8px;
            padding: 7px 10px;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .carnate-staff-page .add-user-btn:hover {
            background: #d1fae5;
            color: #065f46;
        }

        /* Empty */
        .carnate-staff-page .empty-state {
            padding: 55px 20px;
            text-align: center;
        }

        .carnate-staff-page .empty-icon {
            width: 54px;
            height: 54px;
            margin: 0 auto 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            background: var(--carnate-icon);
            color: #94a3b8;
            font-size: 24px;
        }

        .carnate-staff-page .empty-title {
            margin: 0;
            color: var(--carnate-text);
            font-size: 14px;
            font-weight: 700;
        }

        .carnate-staff-page .empty-text {
            margin: 5px 0 0;
            color: var(--carnate-muted);
            font-size: 12px;
        }

        /* Modal */
        .carnate-staff-page .modal {
            background: rgba(15, 23, 42, .55);
            backdrop-filter: blur(3px);
        }

        .carnate-staff-page .modal-dialog {
            margin-top: 45px;
        }

        .carnate-staff-page .modal-content {
            border: 1px solid var(--carnate-border);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 25px 70px rgba(15, 23, 42, .18);
        }

        .carnate-staff-page .modal-header {
            padding: 18px 22px;
            border-bottom: 1px solid var(--carnate-border);
            background: #fff;
        }

        .carnate-staff-page .modal-title {
            margin: 0;
            font-size: 17px;
            font-weight: 700;
            color: var(--carnate-text);
        }

        .carnate-staff-page .modal-body {
            padding: 22px;
            background: #fff;
        }

        .carnate-staff-page .modal-footer {
            padding: 15px 22px;
            border-top: 1px solid var(--carnate-border);
            background: #f8fafc;
        }

        .carnate-staff-page .btn-close {
            opacity: .65;
        }

        .carnate-staff-page .error {
            display: block;
            margin-top: 5px;
            font-size: 11px;
        }

        /* Details */
        .carnate-staff-page .detail-item {
            height: 100%;
            padding: 13px 14px;
            border: 1px solid var(--carnate-border);
            border-radius: 10px;
            background: #fafbfc;
        }

        .carnate-staff-page .detail-label {
            display: block;
            margin-bottom: 5px;
            color: #94a3b8;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .05em;
        }

        .carnate-staff-page .detail-value {
            margin: 0;
            color: var(--carnate-text);
            font-size: 13px;
            font-weight: 600;
            word-break: break-word;
        }

        .carnate-staff-page .staff-detail-image {
            max-width: 200px;
            max-height: 200px;
            object-fit: cover;
            border-radius: 12px;
            border: 1px solid var(--carnate-border);
            padding: 4px;
            background: #fff;
        }

        /* Image upload */
        .carnate-staff-page .upload-box {
            border: 1px dashed #cbd5e1;
            border-radius: 12px;
            padding: 14px;
            background: #fafbfc;
        }

        .carnate-staff-page .image-preview-box {
            min-width: 125px;
        }

        .carnate-staff-page .image-preview-card {
            width: 125px;
            padding: 5px;
            text-align: center;
            border: 1px solid var(--carnate-border);
            border-radius: 10px;
            background: #fff;
        }

        .carnate-staff-page .image-preview-card img {
            width: 113px;
            height: 100px;
            object-fit: cover;
            border-radius: 7px;
        }

        .carnate-staff-page .download-image-btn {
            display: block;
            width: 100%;
            margin-top: 5px;
            padding: 5px;
            border: 0;
            border-radius: 7px;
            background: #f1f5f9;
            color: #475569;
            font-size: 10px;
            font-weight: 600;
            text-decoration: none;
        }

        .carnate-staff-page .download-image-btn:hover {
            background: var(--carnate-red-soft);
            color: var(--carnate-red);
        }

        .carnate-staff-page .pagination-wrapper {
            padding-top: 18px;
        }

        .carnate-staff-page .alert-success {
            border: 1px solid #bbf7d0;
            border-radius: 10px;
            background: #f0fdf4;
            color: #166534;
            font-size: 13px;
        }

        @media (max-width: 767.98px) {
            .carnate-staff-page .staff-page-header {
                padding: 16px;
            }

            .carnate-staff-page .filter-card {
                padding: 15px;
            }

            .carnate-staff-page .modal-dialog {
                margin: 15px;
            }

            .carnate-staff-page .modal-body {
                padding: 16px;
            }
        }
    </style>

    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="alert alert-success mb-3">
            <i class="bx bx-check-circle me-1"></i>
            {{ session('message') }}
        </div>
    @endif

    <!-- ==================== CREATE USER MODAL ==================== -->
    <div class="modal @if ($showUserModal) show @endif"
         tabindex="-1"
         style="opacity:1; display:@if ($showUserModal) block @endif">

        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <form wire:submit.prevent="storeUser">

                    <div class="modal-header">
                        <div>
                            <h4 class="modal-title">Create User</h4>
                            <div class="staff-page-subtitle">Create login access for this staff member.</div>
                        </div>

                        <button type="button"
                                class="btn-close"
                                wire:click="$set('showUserModal', false)"
                                data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        @csrf

                        <div class="row g-3">

                            <!-- Email -->
                            <div class="col-md-6">
                                <label class="modal-form-label">
                                    Email <sup class="text-danger">*</sup>
                                </label>

                                <input type="email"
                                       wire:model="email"
                                       class="form-control"
                                       placeholder="Enter Email">

                                @error('email')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Password -->
                            @if ($isEdit == false)
                                <div class="col-md-6">
                                    <label class="modal-form-label">
                                        Password <sup class="text-danger">*</sup>
                                    </label>

                                    <input type="password"
                                           wire:model="password"
                                           class="form-control"
                                           placeholder="Enter Password">

                                    @error('password')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button"
                                class="btn btn-carnate-light"
                                wire:click="$set('showUserModal', false)"
                                data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button type="submit" class="btn btn-carnate">
                            <i class="bx bx-user-plus me-1"></i>
                            Create
                            <i class="spinner-border spinner-border-sm ms-1"
                               wire:loading></i>
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <!-- ==================== STAFF DETAILS MODAL ==================== -->
    <div class="modal @if ($showViewModal) show @endif"
         tabindex="-1"
         style="opacity:1; display:@if ($showViewModal) block @endif">

        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <div>
                        <h4 class="modal-title">Staff Details</h4>
                        <div class="staff-page-subtitle">Staff account and employment information.</div>
                    </div>

                    <button type="button"
                            class="btn-close"
                            wire:click="$set('showViewModal', false)"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    @if ($selectedStaff)

                        <div class="row g-3">

                            <div class="col-md-6">
                                <div class="detail-item">
                                    <span class="detail-label">Name</span>
                                    <p class="detail-value">
                                        {{ $selectedStaff->user_title }}
                                        {{ $selectedStaff->name }}
                                        {{ $selectedStaff->lastname }}
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="detail-item">
                                    <span class="detail-label">Email</span>
                                    <p class="detail-value">
                                        {{ $selectedStaff->email ?: '-' }}
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="detail-item">
                                    <span class="detail-label">Mobile Number</span>
                                    <p class="detail-value">
                                        {{ $selectedStaff->mobile_no }}
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="detail-item">
                                    <span class="detail-label">Role</span>
                                    <p class="detail-value">
                                        {{ $selectedStaff->Role?->name ?: '-' }}
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="detail-item">
                                    <span class="detail-label">Salary</span>
                                    <p class="detail-value">
                                        ₹{{ $selectedStaff->salary }}
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="detail-item">
                                    <span class="detail-label">Joining Date</span>
                                    <p class="detail-value">
                                        {{ $selectedStaff->joining_date }}
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="detail-item">
                                    <span class="detail-label">Monthly Target</span>
                                    <p class="detail-value">
                                        ₹{{ $selectedStaff->monthly_target ?: 0 }}
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="detail-item">
                                    <span class="detail-label">Incentives</span>
                                    <p class="detail-value">
                                        {{ $selectedStaff->incentives }}%
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="detail-item">
                                    <span class="detail-label">Address</span>
                                    <p class="detail-value">
                                        {{ $selectedStaff->address }}
                                        {{ $selectedStaff->pincode ? '(Pincode: ' . $selectedStaff->pincode . ')' : '' }}
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="detail-item">
                                    <span class="detail-label">User Account Created</span>
                                    <p class="detail-value">
                                        @if ($selectedStaff->is_user == 1)
                                            <span class="status-badge yes">
                                                <i class="bx bx-check-circle"></i> Yes
                                            </span>
                                        @else
                                            <span class="status-badge no">
                                                <i class="bx bx-x-circle"></i> No
                                            </span>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="detail-item">
                                    <span class="detail-label">Login Access</span>
                                    <p class="detail-value">
                                        @if ($selectedStaff->is_login)
                                            <span class="status-badge yes">
                                                <i class="bx bx-check-circle"></i> Enabled
                                            </span>
                                        @else
                                            <span class="status-badge no">
                                                <i class="bx bx-x-circle"></i> Disabled
                                            </span>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            @if($selectedStaff->file)
                                <div class="col-md-12 text-center pt-2">
                                    <label class="modal-form-label">Staff Image</label>

                                    <img src="{{ asset($selectedStaff->file) }}"
                                         class="staff-detail-image"
                                         alt="Staff Image">
                                </div>
                            @endif

                        </div>

                    @endif

                </div>

                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-carnate-light"
                            wire:click="$set('showViewModal', false)"
                            data-bs-dismiss="modal">
                        Close
                    </button>
                </div>

            </div>
        </div>
    </div>

    <!-- ==================== CREATE / EDIT STAFF MODAL ==================== -->
    <div class="modal @if ($showModal) show @endif"
         tabindex="-1"
         style="opacity:1; display:@if ($showModal) block @endif">

        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">

                    <div class="modal-header">
                        <div>
                            <h4 class="modal-title">
                                {{ $isEdit ? 'Edit Staff' : 'Create Staff' }}
                            </h4>

                            <div class="staff-page-subtitle">
                                {{ $isEdit ? 'Update staff information.' : 'Add a new staff member.' }}
                            </div>
                        </div>

                        <button type="button"
                                class="btn-close"
                                wire:click="$set('showModal', false)"
                                data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        @csrf

                        <div class="row g-3">

                            <!-- First Name -->
                            <div class="col-md-6">
                                <label for="first_name" class="modal-form-label">
                                    First Name <sup class="text-danger">*</sup>
                                </label>

                                <div class="input-group">
                                    <select name="user_title"
                                            id="user_title"
                                            wire:model="user_title"
                                            class="form-select"
                                            style="max-width:80px;">
                                        <option value="mr" selected>Mr.</option>
                                        <option value="mrs">Mrs.</option>
                                        <option value="miss">Miss</option>
                                        <!--<option value="ms">M.S.</option>-->
                                    </select>

                                    <input type="text"
                                           wire:model="name"
                                           name="first_name"
                                           id="first_name"
                                           class="form-control"
                                           placeholder="Enter First Name">
                                </div>

                                @if ($errors->has('name') || $errors->has('user_title'))
                                    <span class="text-danger error">
                                        {{ $errors->first('name') ?? $errors->first('user_title') }}
                                    </span>
                                @endif
                            </div>

                            <!-- Last Name -->
                            <div class="col-md-6">
                                <label class="modal-form-label">
                                    Last Name
                                    <span class="text-muted" style="font-size:11px;">(Optional)</span>
                                </label>

                                <input type="text"
                                       wire:model="lastname"
                                       class="form-control"
                                       placeholder="Enter Last Name">

                                @error('lastname')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Role -->
                            <div class="col-md-6">
                                <label class="modal-form-label">
                                    Staff Type <sup class="text-danger">*</sup>
                                </label>

                                <select class="form-select" wire:model="role">
                                    <option value="">Select Staff Type</option>

                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('role')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Joining Date -->
                            <div class="col-md-6">
                                <label class="modal-form-label">
                                    Joining Date <sup class="text-danger">*</sup>
                                </label>

                                <input type="date"
                                       wire:model="joining_date"
                                       class="form-control">

                                @error('joining_date')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Mobile -->
                            <div class="col-md-6">
                                <label class="modal-form-label">
                                    Mobile Number <sup class="text-danger">*</sup>
                                </label>

                                <input type="number"
                                       wire:model="mobile_no"
                                       class="form-control"
                                       placeholder="Enter Mobile Number">

                                @error('mobile_no')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Salary -->
                            <div class="col-md-6">
                                <label class="modal-form-label">
                                    Salary (₹) <sup class="text-danger">*</sup>
                                </label>

                                <input type="number"
                                       wire:model="salary"
                                       class="form-control"
                                       placeholder="Enter Salary">

                                @error('salary')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Monthly Target -->
                            <div class="col-md-6">
                                <label class="modal-form-label">
                                    Monthly Target (₹)
                                </label>

                                <input type="number"
                                       wire:model="monthly_target"
                                       class="form-control"
                                       placeholder="Enter Monthly Target e.g. 100000">

                                @error('monthly_target')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Incentives -->
                            <div class="col-md-6">
                                <label class="modal-form-label">
                                    Incentives (%) <sup class="text-danger">*</sup>
                                </label>

                                <input type="number"
                                       wire:model="incentives"
                                       class="form-control"
                                       placeholder="Enter Incentives">

                                @error('incentives')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Image Upload -->
                            <div class="col-md-12">
                                <label class="modal-form-label">Image</label>

                                <div class="upload-box">
                                    <div class="d-flex align-items-start gap-3 flex-wrap">

                                        <div class="flex-grow-1">
                                            <input type="file"
                                                   class="form-control"
                                                   id="staffImageInput"
                                                   wire:model="image"
                                                   accept="image/*"
                                                   onchange="previewStaffImage(event)">

                                            <small class="text-muted">
                                                Maximum file size: 2 MB
                                            </small>

                                            <div wire:loading
                                                 wire:target="image"
                                                 class="text-info mt-2 small">
                                                <span class="spinner-border spinner-border-sm me-1"
                                                      role="status"></span>
                                                Uploading image...
                                            </div>

                                            @error('image')
                                                <span class="text-danger error">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>

                                        <div id="staffImagePreviewBox"
                                             class="image-preview-box"
                                             style="display:{{ !empty($imageName) ? 'block' : 'none' }};">

                                            <div class="image-preview-card">

                                                <img id="staffImagePreview"
                                                     src="{{ !empty($imageName) ? asset($imageName) : '' }}"
                                                     alt="Preview">

                                                <a id="staffImageDownloadBtn"
                                                   href="{{ !empty($imageName) ? asset($imageName) : '#' }}"
                                                   download
                                                   class="download-image-btn"
                                                   style="display:{{ !empty($imageName) ? 'block' : 'none' }};">
                                                    <i class="bx bx-download me-1"></i>
                                                    Download
                                                </a>

                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- Address -->
                            <div class="col-md-12">
                                <label class="modal-form-label">
                                    Address <sup class="text-danger">*</sup>
                                </label>

                                <textarea wire:model="address"
                                          class="form-control"
                                          placeholder="Enter Address"></textarea>

                                @error('address')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">

                        <button type="button"
                                class="btn btn-carnate-light"
                                wire:click="$set('showModal', false)"
                                data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button type="submit" class="btn btn-carnate">

                            <i class="bx {{ $isEdit ? 'bx-save' : 'bx-user-plus' }} me-1"></i>

                            {{ $isEdit ? 'Update' : 'Create' }}

                            <i class="spinner-border spinner-border-sm ms-1"
                               wire:loading></i>

                        </button>

                    </div>

                </form>

            </div>
        </div>
    </div>

    <!-- ==================== PAGE HEADER ==================== -->
    <div class="carnate-card staff-page-header">

        <div class="d-flex justify-content-between align-items-center gap-3 flex-wrap">

            <div>
                <h1 class="staff-page-title">
                    Staff
                </h1>

                <p class="staff-page-subtitle">
                    Manage workshop staff, roles, access and performance information.
                </p>
            </div>

            {{-- @if ($user->hasPermissionTo('staff-add')) --}}
            <div>
                <a href="javascript:;"
                   wire:click="create"
                   class="btn btn-carnate">
                    <i class="bx bx-plus me-1"></i>
                    Add Staff
                </a>
            </div>
            {{-- @endif --}}

        </div>

    </div>

    <!-- ==================== FILTERS ==================== -->
    <div class="carnate-card filter-card mt-3">

        <div class="row g-3 align-items-end">

            <div class="col-lg-4 col-md-6">
                <label class="filter-label">Search Staff</label>

                <div class="position-relative">
                    <input type="text"
                           class="form-control"
                           placeholder="Search staff"
                           wire:model.live="searchStaff"
                           fdprocessedid="blgf5">
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <label class="filter-label">Role</label>

                <select class="form-select" wire:model.change="seachRole">
                    <option value="">All Role</option>

                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-lg-4 col-md-12 d-flex justify-content-lg-end">
                <button type="button"
                        class="btn btn-carnate-light"
                        wire:click="resetFilter"
                        fdprocessedid="orntg">
                    <i class="bx bx-reset me-1"></i>
                    Clear Filters
                </button>
            </div>

        </div>

    </div>

    <!-- ==================== STAFF TABLE ==================== -->
    <div class="carnate-card staff-table-card mt-3">

        @if (!empty($items) && $items->count())

            <div class="table-wrap">

                <table class="table staff-table align-middle">

                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile Number</th>
                            <th>Role</th>
                            <th>User</th>
                            <th>Login</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($items as $index => $item)

                            <tr>

                                <td>
                                    <span class="text-muted">
                                        {{ $items->total() - ($items->firstItem() + $index) + 1 }}
                                    </span>
                                </td>

                                <td>
                                    <div class="staff-name">
                                        {{ $item->name . ' ' . $item->lastname }}
                                    </div>
                                </td>

                                <td>
                                    <span class="staff-email">
                                        @if ($item->email != '')
                                            {{ $item->email }}
                                        @else
                                            -
                                        @endif
                                    </span>
                                </td>

                                <td>
                                    {{ $item->mobile_no }}
                                </td>

                                <td>
                                    <span class="role-badge">
                                        {{ $item->Role?->name }}
                                    </span>
                                </td>

                                <td>
                                    @if ($item->is_user == 1)
                                        <span class="status-badge yes">
                                            <i class="bx bx-check"></i>
                                            Yes
                                        </span>
                                    @else
                                        <span class="status-badge no">
                                            <i class="bx bx-x"></i>
                                            No
                                        </span>
                                    @endif
                                </td>

                                <td>

                                    <div class="login-switch">

                                        <input class="form-check-input"
                                               type="checkbox"
                                               role="switch"
                                               id="toggleSwitch{{ $item->id }}"
                                               wire:click="toggleLogin({{ $item->id }})"
                                               @if($item->is_login) checked @endif>

                                        <label class="switch-text"
                                               for="toggleSwitch{{ $item->id }}">
                                            {{ $item->is_login ? 'On' : 'Off' }}
                                        </label>

                                    </div>

                                </td>

                                <td>

                                    <div class="staff-actions">

                                        {{-- @if ($user->hasPermissionTo('staff-edit')) --}}

                                        <a wire:click="viewStaff({{ $item->id }})"
                                           class="staff-action view"
                                           title="View Details">
                                            <i class="bx bx-show"></i>
                                        </a>

                                        <a wire:click="edit({{ $item->id }})"
                                           class="staff-action edit"
                                           title="Edit Staff">
                                            <i class="bx bxs-edit"></i>
                                        </a>

                                        {{-- @endif  @if ($user->hasPermissionTo('staff-delete')) --}}

                                        <a wire:click="confirmDelete({{ $item->id }})"
                                           class="staff-action delete"
                                           title="Delete Staff">
                                            <i class="bx bx-trash"></i>
                                        </a>

                                        {{-- @endif --}}

                                        @if ($item->is_user == 0)

                                            <a wire:click="addUser({{ $item->id }})"
                                               class="add-user-btn"
                                               title="Create User">
                                                <i class="bx bx-user-plus me-1"></i>
                                                Add User
                                            </a>

                                        @endif

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            <div class="pagination-wrapper px-3 pb-3">
                {{ $items->links() }}
            </div>

        @else

            <div class="empty-state">

                <div class="empty-icon">
                    <i class="bx bx-group"></i>
                </div>

                <h5 class="empty-title">
                    No Staff Found
                </h5>

                <p class="empty-text">
                    No staff members match the current filters.
                </p>

            </div>

        @endif

    </div>

    <script>
        /**
         * Show a live preview when the user picks an image file.
         * Also updates the Download button href so it points to the blob URL.
         */
        function previewStaffImage(event) {
            const file = event.target.files[0];
            if (!file) return;

            const reader = new FileReader();

            reader.onload = function(e) {
                const previewBox  = document.getElementById('staffImagePreviewBox');
                const previewImg  = document.getElementById('staffImagePreview');
                const downloadBtn = document.getElementById('staffImageDownloadBtn');

                if (!previewBox || !previewImg || !downloadBtn) return;

                previewImg.src = e.target.result;
                previewBox.style.display = 'block';

                // For a freshly selected file, create a temporary object URL for download
                const blobUrl = URL.createObjectURL(file);

                downloadBtn.href = blobUrl;
                downloadBtn.download = file.name;
                downloadBtn.style.display = 'block';
            };

            reader.readAsDataURL(file);
        }

        document.addEventListener('livewire:init', function() {

            Livewire.hook('morphed', (message, component) => {
                $('.select2').select2().on('change', function(e) {
                    const selectedValues = $(this).val();
                    @this.set(e.target.dataset.property, selectedValues);
                });
            });

        });
    </script>

</div>