<div class="carnate-staff-page">

    @php
        $sparePart = App\Models\SparePartVendor::where('id', $sparepartId)->first();
    @endphp

    {{-- Success Message --}}
    @if (session()->has('message'))
        <div class="carnate-alert-success">
            <i class="bx bx-check-circle"></i>
            <span>{{ session('message') }}</span>
        </div>
    @endif

    {{-- =========================
        CREATE USER MODAL
    ========================== --}}
    <div class="carnate-modal"
        style="display: @if ($showUserModal) flex @else none @endif;">

        <div class="carnate-modal-dialog carnate-modal-user">

            <form wire:submit.prevent="storeUser">

                <div class="carnate-modal-header">
                    <div>
                        <span class="carnate-modal-eyebrow">User Access</span>
                        <h4>Create User</h4>
                    </div>

                    <button type="button"
                        class="carnate-modal-close"
                        wire:click="$set('showUserModal', false)"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="bx bx-x"></i>
                    </button>
                </div>

                <div class="carnate-modal-body">
                    @csrf

                    <div class="carnate-form-grid">

                        {{-- Email --}}
                        <div class="carnate-form-group">
                            <label>
                                Email
                                <span>*</span>
                            </label>

                            <div class="carnate-input-wrap">
                                <i class="bx bx-envelope"></i>
                                <input type="email"
                                    wire:model="email"
                                    class="carnate-input with-icon"
                                    placeholder="Enter email address">
                            </div>

                            @error('email')
                                <span class="carnate-error">
                                    <i class="bx bx-error-circle"></i>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        {{-- Password --}}
                        @if ($isEdit == false)
                            <div class="carnate-form-group">
                                <label>
                                    Password
                                    <span>*</span>
                                </label>

                                <div class="carnate-input-wrap">
                                    <i class="bx bx-lock-alt"></i>
                                    <input type="password"
                                        wire:model="password"
                                        class="carnate-input with-icon"
                                        placeholder="Enter password">
                                </div>

                                @error('password')
                                    <span class="carnate-error">
                                        <i class="bx bx-error-circle"></i>
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        @endif

                    </div>
                </div>

                <div class="carnate-modal-footer">
                    <button type="button"
                        class="carnate-btn carnate-btn-secondary"
                        wire:click="$set('showUserModal', false)"
                        data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit"
                        class="carnate-btn carnate-btn-primary">
                        <i class="bx bx-user-plus"></i>
                        Create User
                        <span wire:loading class="carnate-spinner"></span>
                    </button>
                </div>

            </form>

        </div>
    </div>


    {{-- =========================
        CREATE / EDIT STAFF MODAL
    ========================== --}}
    <div class="carnate-modal"
        style="display: @if ($showModal) flex @else none @endif;">

        <div class="carnate-modal-dialog carnate-modal-large">

            <form wire:submit.prevent="save">

                <div class="carnate-modal-header">
                    <div>
                        <span class="carnate-modal-eyebrow">Staff Management</span>
                        <h4>{{ $isEdit ? 'Edit Staff' : 'Create Staff' }}</h4>
                    </div>

                    <button type="button"
                        class="carnate-modal-close"
                        wire:click="$set('showModal', false)"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="bx bx-x"></i>
                    </button>
                </div>

                <div class="carnate-modal-body">

                    {{-- Validation Summary --}}
                    @if ($errors->any())
                        <div class="carnate-validation-alert">
                            <div class="carnate-validation-icon">
                                <i class="bx bx-error-circle"></i>
                            </div>

                            <div>
                                <strong>Please check the following fields</strong>

                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    @csrf

                    <div class="carnate-form-grid">

                        {{-- First Name --}}
                        <div class="carnate-form-group">
                            <label for="first_name">
                                First Name
                                <span>*</span>
                            </label>

                            <div class="carnate-name-input">
                                <select name="user_title"
                                    id="user_title"
                                    wire:model="user_title"
                                    class="carnate-title-select">
                                    <option value="">Select</option>
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
                                    placeholder="Enter first name">
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
                                Last Name
                                <span>*</span>
                            </label>

                            <input type="text"
                                wire:model="lastname"
                                class="carnate-input"
                                placeholder="Enter last name">

                            @error('lastname')
                                <span class="carnate-error">
                                    <i class="bx bx-error-circle"></i>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        {{-- Staff Type --}}
                        <div class="carnate-form-group">
                            <label>
                                Staff Type
                                <span>*</span>
                            </label>

                            <select class="carnate-input"
                                wire:model="role">
                                <option value="">Select Staff Type</option>

                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('role')
                                <span class="carnate-error">
                                    <i class="bx bx-error-circle"></i>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        {{-- Joining Date --}}
                        <div class="carnate-form-group">
                            <label>Joining Date</label>

                            <input type="date"
                                wire:model="joining_date"
                                class="carnate-input">
                        </div>

                        {{-- Mobile --}}
                        <div class="carnate-form-group">
                            <label>
                                Mobile Number
                                <span>*</span>
                            </label>

                            <div class="carnate-input-wrap">
                                <i class="bx bx-phone"></i>
                                <input type="number"
                                    wire:model="mobile_no"
                                    class="carnate-input with-icon"
                                    placeholder="Enter mobile number">
                            </div>

                            @error('mobile_no')
                                <span class="carnate-error">
                                    <i class="bx bx-error-circle"></i>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        {{-- Salary --}}
                        <div class="carnate-form-group">
                            <label>Salary (₹)</label>

                            <div class="carnate-input-wrap">
                                <span class="carnate-input-prefix">₹</span>
                                <input type="number"
                                    wire:model="salary"
                                    class="carnate-input with-prefix"
                                    placeholder="Enter salary">
                            </div>
                        </div>

                        {{-- Monthly Target --}}
                        <div class="carnate-form-group">
                            <label>Monthly Target (₹)</label>

                            <div class="carnate-input-wrap">
                                <span class="carnate-input-prefix">₹</span>
                                <input type="number"
                                    wire:model="monthly_target"
                                    class="carnate-input with-prefix"
                                    placeholder="Enter monthly target">
                            </div>
                        </div>

                        {{-- Incentives --}}
                        <div class="carnate-form-group">
                            <label>Incentives (%)</label>

                            <div class="carnate-input-wrap">
                                <span class="carnate-input-prefix">%</span>
                                <input type="number"
                                    wire:model="incentives"
                                    class="carnate-input with-prefix"
                                    placeholder="Enter incentives">
                            </div>
                        </div>

                        {{-- Image --}}
                        <div class="carnate-form-group carnate-full-width">
                            <label>Profile Image</label>

                            <div class="carnate-upload-row">

                                <div class="carnate-upload-box">
                                    <i class="bx bx-cloud-upload"></i>

                                    <div>
                                        <strong>Upload profile image</strong>
                                        <span>Choose an image from your device</span>
                                    </div>

                                    <input type="file"
                                        wire:model="document"
                                        class="carnate-file-input">
                                </div>

                                @if ($document)
                                    <div class="carnate-image-preview">
                                        <a href="{{ $document->temporaryUrl() }}" download>
                                            <img src="{{ $document->temporaryUrl() }}"
                                                alt="Document Preview">
                                        </a>
                                    </div>
                                @else
                                    <div class="carnate-image-preview">
                                        <a href="{{ asset($oldDocument) }}" download>
                                            <img src="{{ asset($oldDocument) }}"
                                                alt="Document Preview">
                                        </a>
                                    </div>
                                @endif

                            </div>

                            @error('document')
                                <span class="carnate-error">
                                    <i class="bx bx-error-circle"></i>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        {{-- Address --}}
                        <div class="carnate-form-group carnate-full-width">
                            <label>
                                Address
                                <span>*</span>
                            </label>

                            <textarea wire:model="address"
                                class="carnate-input carnate-textarea"
                                placeholder="Enter address"></textarea>

                            @error('address')
                                <span class="carnate-error">
                                    <i class="bx bx-error-circle"></i>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                    </div>
                </div>

                <div class="carnate-modal-footer">

                    <button type="button"
                        class="carnate-btn carnate-btn-secondary"
                        wire:click="$set('showModal', false)"
                        data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit"
                        class="carnate-btn carnate-btn-primary"
                        wire:loading.attr="disabled">

                        <i class="bx bx-check"></i>
                        {{ $isEdit ? 'Update Staff' : 'Create Staff' }}

                        <span wire:loading
                            wire:target="save"
                            class="carnate-spinner"></span>
                    </button>

                </div>

            </form>

        </div>
    </div>


    {{-- =========================
        PAGE HEADER
    ========================== --}}
    <div class="carnate-page-header">

        <div>
            <span class="carnate-page-eyebrow">Team Management</span>

            <h1>Staff</h1>

            <p>
                Manage staff members, roles and user access.
            </p>
        </div>

        @if ($user->hasPermissionTo('staff-add'))
            <button type="button"
                wire:click="create"
                class="carnate-btn carnate-btn-primary">
                <i class="bx bx-plus"></i>
                Add Staff
            </button>
        @endif

    </div>


    {{-- =========================
        FILTER CARD
    ========================== --}}
    <div class="carnate-filter-card">

        <div class="carnate-filter-heading">
            <div class="carnate-filter-icon">
                <i class="bx bx-filter-alt"></i>
            </div>

            <div>
                <h3>Staff Directory</h3>
                <p>Search and manage your staff members.</p>
            </div>
        </div>

        <div class="carnate-filter-controls">

            <div class="carnate-search-box">
                <i class="bx bx-search"></i>

                <input type="text"
                    placeholder="Search staff..."
                    wire:model.live="searchfilter">
            </div>

            <button type="button"
                class="carnate-clear-btn"
                wire:click="resetFilter">
                <i class="bx bx-reset"></i>
                Clear
            </button>

        </div>

    </div>


    {{-- =========================
        STAFF TABLE
    ========================== --}}
    <div class="carnate-card">

        @if (!empty($items) && $items->count())

            <div class="carnate-table-header">

                <div>
                    <h3>Staff List</h3>
                    <p>All registered staff members</p>
                </div>

                <div class="carnate-list-count">
                    {{ $items->total() }}
                    <span>Staff</span>
                </div>

            </div>

            <div class="carnate-table-wrap">

                <table class="carnate-table">

                    <thead>
                        <tr>
                            <th class="carnate-col-number">S.No.</th>
                            <th>Profile</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile Number</th>
                            <th>Role</th>
                            <th>User Access</th>
                            <th class="carnate-col-actions">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($items as $index => $item)

                            <tr>

                                {{-- S.No --}}
                                <td>
                                    <span class="carnate-index">
                                        {{ $items->total() - ($items->firstItem() + $index) + 1 }}
                                    </span>
                                </td>

                                {{-- Profile --}}
                                <td>
                                    <div class="carnate-profile">

                                        <img src="{{ asset($item->profileImage?->file) }}"
                                            alt="">

                                    </div>
                                </td>

                                {{-- Name --}}
                                <td>
                                    <div class="carnate-staff-name">

                                        <strong>
                                            {{ $item->name . ' ' . $item->lastname }}
                                        </strong>

                                        <span>
                                            Staff Member
                                        </span>

                                    </div>
                                </td>

                                {{-- Email --}}
                                <td>
                                    @if ($item->email != '')
                                        <div class="carnate-contact">
                                            <i class="bx bx-envelope"></i>
                                            <span>{{ $item->email }}</span>
                                        </div>
                                    @else
                                        <span class="carnate-na">—</span>
                                    @endif
                                </td>

                                {{-- Mobile --}}
                                <td>
                                    <div class="carnate-contact">
                                        <i class="bx bx-phone"></i>
                                        <span>{{ $item->mobile_no }}</span>
                                    </div>
                                </td>

                                {{-- Role --}}
                                <td>
                                    <span class="carnate-role-badge">
                                        <i class="bx bx-shield-quarter"></i>
                                        {{ @$item->Role?->name }}
                                    </span>
                                </td>

                                {{-- User --}}
                                <td>
                                    @if ($item->is_user == 1)
                                        <span class="carnate-status-badge success">
                                            <i class="bx bx-check-circle"></i>
                                            User Enabled
                                        </span>
                                    @else
                                        <span class="carnate-status-badge neutral">
                                            <i class="bx bx-user-x"></i>
                                            No User
                                        </span>
                                    @endif
                                </td>

                                {{-- Actions --}}
                                <td>

                                    <div class="carnate-actions">

                                        @if ($user->hasPermissionTo('staff-edit'))
                                            <button type="button"
                                                wire:click="edit({{ $item->id }})"
                                                class="carnate-action-btn edit"
                                                title="Edit Staff">
                                                <i class="bx bx-edit-alt"></i>
                                            </button>
                                        @endif

                                        @if ($user->hasPermissionTo('staff-delete'))
                                            <button type="button"
                                                wire:click="confirmDelete({{ $item->id }})"
                                                class="carnate-action-btn delete"
                                                title="Delete Staff">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        @endif

                                        @if ($item->is_user == 0)
                                            <button type="button"
                                                wire:click="addUser({{ $item->id }})"
                                                class="carnate-action-user"
                                                title="Create User">
                                                <i class="bx bx-user-plus"></i>
                                                <span>Add User</span>
                                            </button>
                                        @endif

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            <div class="carnate-pagination">
                {{ $items->links() }}
            </div>

        @else

            <div class="carnate-empty-state">

                <div class="carnate-empty-icon">
                    <i class="bx bx-group"></i>
                </div>

                <h4>No Staff Found</h4>

                <p>
                    There are no staff members matching your search.
                </p>

                @if ($user->hasPermissionTo('staff-add'))
                    <button type="button"
                        wire:click="create"
                        class="carnate-btn carnate-btn-primary">
                        <i class="bx bx-plus"></i>
                        Add Staff
                    </button>
                @endif

            </div>

        @endif

    </div>

</div>


@section('footerscript')

<style>
    .carnate-staff-page {
        --carnate-red: #e53935;
        --carnate-red-soft: #fff5f5;
        --carnate-text: #111827;
        --carnate-muted: #64748b;
        --carnate-border: #e2e8f0;
        --carnate-bg: #f7f8fa;
        --carnate-white: #ffffff;

        padding: 24px;
        min-height: calc(100vh - 70px);
        background: #f7f8fa;
        color: var(--carnate-text);
    }

    .carnate-staff-page * {
        box-sizing: border-box;
    }

    /* Alert */
    .carnate-alert-success {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 13px 16px;
        margin-bottom: 20px;
        border: 1px solid #bbf7d0;
        border-radius: 12px;
        background: #f0fdf4;
        color: #15803d;
        font-size: 14px;
        font-weight: 600;
    }

    .carnate-alert-success i {
        font-size: 20px;
    }

    /* Page Header */
    .carnate-page-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 22px;
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
        font-size: 28px;
        line-height: 1.2;
        font-weight: 750;
        letter-spacing: -.03em;
    }

    .carnate-page-header p {
        margin: 7px 0 0;
        color: var(--carnate-muted);
        font-size: 14px;
    }

    /* Buttons */
    .carnate-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        min-height: 42px;
        padding: 0 17px;
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
        transform: translateY(-1px);
    }

    .carnate-btn-secondary {
        background: #f1f5f9;
        color: #475569;
    }

    .carnate-btn-secondary:hover {
        background: #e2e8f0;
    }

    /* Filter Card */
    .carnate-filter-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        padding: 18px 20px;
        margin-bottom: 20px;
        border: 1px solid var(--carnate-border);
        border-radius: 16px;
        background: #fff;
        box-shadow: 0 4px 18px rgba(15, 23, 42, .035);
    }

    .carnate-filter-heading {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .carnate-filter-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 11px;
        background: var(--carnate-red-soft);
        color: var(--carnate-red);
        font-size: 20px;
    }

    .carnate-filter-heading h3 {
        margin: 0;
        font-size: 15px;
        font-weight: 700;
    }

    .carnate-filter-heading p {
        margin: 3px 0 0;
        color: var(--carnate-muted);
        font-size: 12px;
    }

    .carnate-filter-controls {
        display: flex;
        align-items: center;
        gap: 10px;
        width: min(500px, 100%);
    }

    .carnate-search-box {
        position: relative;
        flex: 1;
    }

    .carnate-search-box i {
        position: absolute;
        top: 50%;
        left: 13px;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 18px;
    }

    .carnate-search-box input {
        width: 100%;
        height: 42px;
        padding: 0 14px 0 39px;
        border: 1px solid var(--carnate-border);
        border-radius: 10px;
        outline: none;
        background: #fff;
        color: var(--carnate-text);
        font-size: 13px;
        transition: .2s ease;
    }

    .carnate-search-box input:focus,
    .carnate-input:focus {
        border-color: rgba(229, 57, 53, .45);
        box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
    }

    .carnate-clear-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        height: 42px;
        padding: 0 15px;
        border: 1px solid var(--carnate-border);
        border-radius: 10px;
        background: #fff;
        color: #475569;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
    }

    .carnate-clear-btn:hover {
        background: #f8fafc;
    }

    /* Main Card */
    .carnate-card {
        overflow: hidden;
        border: 1px solid var(--carnate-border);
        border-radius: 16px;
        background: #fff;
        box-shadow: 0 4px 18px rgba(15, 23, 42, .035);
    }

    .carnate-table-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 20px 22px 17px;
        border-bottom: 1px solid var(--carnate-border);
    }

    .carnate-table-header h3 {
        margin: 0;
        font-size: 18px;
        font-weight: 700;
    }

    .carnate-table-header p {
        margin: 5px 0 0;
        color: var(--carnate-muted);
        font-size: 13px;
    }

    .carnate-list-count {
        min-width: 65px;
        padding: 7px 10px;
        border: 1px solid var(--carnate-border);
        border-radius: 9px;
        background: #f8fafc;
        text-align: center;
        font-size: 13px;
        font-weight: 700;
    }

    .carnate-list-count span {
        display: block;
        color: var(--carnate-muted);
        font-size: 9px;
        font-weight: 600;
        letter-spacing: .06em;
        text-transform: uppercase;
    }

    /* Table */
    .carnate-table-wrap {
        overflow-x: auto;
    }

    .carnate-table {
        width: 100%;
        min-width: 1050px;
        border-collapse: collapse;
    }

    .carnate-table thead th {
        padding: 13px 18px;
        border-bottom: 1px solid var(--carnate-border);
        background: #f8fafc;
        color: #64748b;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .07em;
        text-align: left;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .carnate-table tbody td {
        padding: 14px 18px;
        border-bottom: 1px solid #edf1f5;
        color: var(--carnate-text);
        font-size: 13px;
        vertical-align: middle;
    }

    .carnate-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .carnate-table tbody tr {
        transition: background .15s ease;
    }

    .carnate-table tbody tr:hover {
        background: #fafbfc;
    }

    .carnate-col-number {
        width: 65px;
    }

    .carnate-col-actions {
        width: 185px;
        text-align: right !important;
    }

    .carnate-index {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 30px;
        height: 30px;
        border-radius: 8px;
        background: #f1f5f9;
        color: #64748b;
        font-size: 11px;
        font-weight: 700;
    }

    /* Profile */
    .carnate-profile {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 42px;
        height: 42px;
        overflow: hidden;
        border: 1px solid var(--carnate-border);
        border-radius: 11px;
        background: #f8fafc;
    }

    .carnate-profile img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Staff Name */
    .carnate-staff-name strong {
        display: block;
        font-size: 13px;
        font-weight: 700;
        white-space: nowrap;
    }

    .carnate-staff-name span {
        display: block;
        margin-top: 3px;
        color: #94a3b8;
        font-size: 11px;
    }

    /* Contact */
    .carnate-contact {
        display: flex;
        align-items: center;
        gap: 7px;
        color: #475569;
        white-space: nowrap;
    }

    .carnate-contact i {
        color: #94a3b8;
        font-size: 16px;
    }

    .carnate-na {
        color: #94a3b8;
    }

    /* Role */
    .carnate-role-badge,
    .carnate-status-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 7px 9px;
        border-radius: 8px;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
    }

    .carnate-role-badge {
        background: #f1f5f9;
        color: #475569;
    }

    .carnate-role-badge i {
        font-size: 14px;
    }

    .carnate-status-badge.success {
        background: #f0fdf4;
        color: #15803d;
    }

    .carnate-status-badge.neutral {
        background: #f8fafc;
        color: #64748b;
    }

    /* Actions */
    .carnate-actions {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 6px;
    }

    .carnate-action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        padding: 0;
        border: 1px solid var(--carnate-border);
        border-radius: 9px;
        background: #fff;
        color: #64748b;
        cursor: pointer;
        transition: .2s ease;
    }

    .carnate-action-btn i {
        font-size: 16px;
    }

    .carnate-action-btn.edit:hover {
        border-color: rgba(229, 57, 53, .2);
        background: var(--carnate-red-soft);
        color: var(--carnate-red);
    }

    .carnate-action-btn.delete:hover {
        border-color: #fecaca;
        background: #fef2f2;
        color: #dc2626;
    }

    .carnate-action-user {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        min-height: 34px;
        padding: 0 10px;
        border: 1px solid #bbf7d0;
        border-radius: 9px;
        background: #f0fdf4;
        color: #15803d;
        font-size: 11px;
        font-weight: 700;
        cursor: pointer;
        transition: .2s ease;
    }

    .carnate-action-user:hover {
        background: #dcfce7;
    }

    /* Pagination */
    .carnate-pagination {
        padding: 16px 20px;
        border-top: 1px solid var(--carnate-border);
    }

    /* Empty */
    .carnate-empty-state {
        display: flex;
        align-items: center;
        flex-direction: column;
        padding: 65px 20px;
        text-align: center;
    }

    .carnate-empty-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 64px;
        height: 64px;
        margin-bottom: 15px;
        border-radius: 17px;
        background: #f1f5f9;
        color: #94a3b8;
        font-size: 30px;
    }

    .carnate-empty-state h4 {
        margin: 0;
        font-size: 17px;
        font-weight: 700;
    }

    .carnate-empty-state p {
        margin: 6px 0 18px;
        color: var(--carnate-muted);
        font-size: 13px;
    }

    /* Modal */
    .carnate-modal {
        position: fixed;
        inset: 0;
        z-index: 9999;
        align-items: center;
        justify-content: center;
        padding: 20px;
        background: rgba(15, 23, 42, .52);
        backdrop-filter: blur(3px);
    }

    .carnate-modal-dialog {
        width: 100%;
        max-width: 570px;
        overflow: hidden;
        border: 1px solid var(--carnate-border);
        border-radius: 18px;
        background: #fff;
        box-shadow: 0 24px 70px rgba(15, 23, 42, .18);
        animation: carnateModalIn .18s ease-out;
    }

    .carnate-modal-large {
        max-width: 850px;
        max-height: calc(100vh - 40px);
        overflow-y: auto;
    }

    .carnate-modal-user {
        max-width: 570px;
    }

    @keyframes carnateModalIn {
        from {
            opacity: 0;
            transform: translateY(8px) scale(.985);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .carnate-modal-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 15px;
        padding: 20px 22px;
        border-bottom: 1px solid var(--carnate-border);
    }

    .carnate-modal-eyebrow {
        display: block;
        margin-bottom: 4px;
        color: var(--carnate-red);
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .1em;
        text-transform: uppercase;
    }

    .carnate-modal-header h4 {
        margin: 0;
        font-size: 19px;
        font-weight: 750;
    }

    .carnate-modal-close {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        padding: 0;
        border: 0;
        border-radius: 9px;
        background: #f1f5f9;
        color: #64748b;
        cursor: pointer;
    }

    .carnate-modal-close:hover {
        background: #fee2e2;
        color: var(--carnate-red);
    }

    .carnate-modal-close i {
        font-size: 20px;
    }

    .carnate-modal-body {
        padding: 22px;
    }

    .carnate-modal-footer {
        display: flex;
        justify-content: flex-end;
        gap: 9px;
        padding: 16px 22px;
        border-top: 1px solid var(--carnate-border);
        background: #fafbfc;
    }

    /* Form */
    .carnate-form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    .carnate-full-width {
        grid-column: 1 / -1;
    }

    .carnate-form-group label {
        display: block;
        margin-bottom: 7px;
        color: #334155;
        font-size: 13px;
        font-weight: 700;
    }

    .carnate-form-group label span {
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

    .carnate-input::placeholder {
        color: #94a3b8;
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
    }

    .carnate-input.with-icon {
        padding-left: 39px;
    }

    .carnate-input-prefix {
        position: absolute;
        top: 50%;
        left: 13px;
        z-index: 1;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 13px;
        font-weight: 700;
    }

    .carnate-input.with-prefix {
        padding-left: 31px;
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
        min-height: 100px;
        resize: vertical;
    }

    .carnate-error {
        display: flex;
        align-items: center;
        gap: 5px;
        margin-top: 6px;
        color: #dc2626;
        font-size: 12px;
    }

    /* Validation */
    .carnate-validation-alert {
        display: flex;
        gap: 12px;
        padding: 13px 15px;
        margin-bottom: 20px;
        border: 1px solid #fecaca;
        border-radius: 11px;
        background: #fef2f2;
        color: #991b1b;
    }

    .carnate-validation-icon {
        flex: 0 0 auto;
        font-size: 20px;
    }

    .carnate-validation-alert strong {
        display: block;
        margin-bottom: 5px;
        font-size: 12px;
    }

    .carnate-validation-alert ul {
        margin: 0;
        padding-left: 17px;
        font-size: 11px;
    }

    /* Upload */
    .carnate-upload-row {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .carnate-upload-box {
        position: relative;
        display: flex;
        align-items: center;
        gap: 12px;
        flex: 1;
        min-height: 76px;
        padding: 12px 15px;
        overflow: hidden;
        border: 1px dashed #cbd5e1;
        border-radius: 12px;
        background: #f8fafc;
    }

    .carnate-upload-box > i {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 42px;
        height: 42px;
        border-radius: 10px;
        background: var(--carnate-red-soft);
        color: var(--carnate-red);
        font-size: 21px;
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

    .carnate-image-preview {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 76px;
        height: 76px;
        flex: 0 0 76px;
        overflow: hidden;
        border: 1px solid var(--carnate-border);
        border-radius: 12px;
        background: #f8fafc;
    }

    .carnate-image-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Spinner */
    .carnate-spinner {
        width: 14px;
        height: 14px;
        margin-left: 2px;
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

    /* Responsive */
    @media (max-width: 1100px) {
        .carnate-table {
            min-width: 1000px;
        }
    }

    @media (max-width: 767px) {
        .carnate-staff-page {
            padding: 16px;
        }

        .carnate-page-header {
            align-items: flex-start;
        }

        .carnate-page-header h1 {
            font-size: 23px;
        }

        .carnate-page-header p {
            font-size: 12px;
        }

        .carnate-filter-card {
            align-items: stretch;
            flex-direction: column;
        }

        .carnate-filter-controls {
            width: 100%;
        }

        .carnate-form-grid {
            grid-template-columns: 1fr;
        }

        .carnate-full-width {
            grid-column: auto;
        }

        .carnate-modal {
            padding: 12px;
        }

        .carnate-modal-large {
            max-height: calc(100vh - 24px);
        }

        .carnate-modal-header,
        .carnate-modal-body {
            padding: 17px;
        }

        .carnate-modal-footer {
            padding: 13px 17px;
        }

        .carnate-upload-row {
            align-items: stretch;
        }

        .carnate-image-preview {
            width: 70px;
            height: 70px;
            flex-basis: 70px;
        }
    }

    @media (max-width: 480px) {
        .carnate-page-header {
            display: block;
        }

        .carnate-page-header .carnate-btn {
            width: 100%;
            margin-top: 15px;
        }

        .carnate-filter-controls {
            align-items: stretch;
            flex-direction: column;
        }

        .carnate-clear-btn {
            width: 100%;
        }

        .carnate-table-header {
            padding: 17px;
        }

        .carnate-list-count {
            display: none;
        }

        .carnate-upload-row {
            flex-direction: column;
        }

        .carnate-image-preview {
            width: 76px;
            height: 76px;
        }

        .carnate-modal-footer .carnate-btn {
            flex: 1;
        }
    }
</style>

<script>
    document.addEventListener('livewire:init', function () {

        Livewire.hook('morphed', (message, component) => {
            $('.select2').select2().on('change', function(e) {
                const selectedValues = $(this).val();
                @this.set(e.target.dataset.property, selectedValues);
            });
        });

    });
</script>

@endsection