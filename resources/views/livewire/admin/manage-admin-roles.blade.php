<div class="carnate-role-page">

    <style>
        .carnate-role-page {
            --cr-bg: #f7f8fa;
            --cr-card: #ffffff;
            --cr-text: #111827;
            --cr-muted: #64748b;
            --cr-border: #e2e8f0;
            --cr-soft: #f1f5f9;
            --cr-red: #e53935;
            --cr-red-soft: #fff5f5;
            --cr-green: #16a34a;
            background: var(--cr-bg);
            color: var(--cr-text);
        }

        .carnate-role-page .cr-alert {
            border: 1px solid #bbf7d0;
            background: #f0fdf4;
            color: #166534;
            border-radius: 12px;
            padding: 12px 16px;
            margin-bottom: 18px;
            font-size: 14px;
        }

        .carnate-role-page .cr-card {
            background: var(--cr-card);
            border: 1px solid var(--cr-border);
            border-radius: 16px;
            box-shadow: 0 4px 18px rgba(15, 23, 42, 0.04);
        }

        .carnate-role-page .cr-header {
            padding: 20px 22px;
        }

        .carnate-role-page .cr-title-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .carnate-role-page .cr-title-icon {
            width: 42px;
            height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: var(--cr-red-soft);
            color: var(--cr-red);
            font-size: 19px;
        }

        .carnate-role-page .cr-title {
            margin: 0;
            font-size: 21px;
            line-height: 1.2;
            font-weight: 700;
            color: var(--cr-text);
        }

        .carnate-role-page .cr-subtitle {
            margin: 4px 0 0;
            color: var(--cr-muted);
            font-size: 12px;
        }

        .carnate-role-page .cr-add-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            min-height: 40px;
            padding: 0 16px;
            border: 0;
            border-radius: 9px;
            background: var(--cr-red);
            color: #fff !important;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            box-shadow: 0 5px 14px rgba(229, 57, 53, 0.16);
            transition: all .2s ease;
        }

        .carnate-role-page .cr-add-btn:hover {
            background: #d9322f;
            color: #fff !important;
            transform: translateY(-1px);
        }

        .carnate-role-page .cr-table-card {
            margin-top: 18px;
            overflow: hidden;
        }

        .carnate-role-page .cr-table-wrap {
            overflow-x: auto;
        }

        .carnate-role-page .cr-table {
            width: 100%;
            min-width: 600px;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .carnate-role-page .cr-table thead th {
            padding: 14px 18px;
            background: #f8fafc;
            border-bottom: 1px solid var(--cr-border);
            color: #475569;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .025em;
            white-space: nowrap;
        }

        .carnate-role-page .cr-table tbody td {
            padding: 15px 18px;
            border-bottom: 1px solid #eef2f7;
            color: var(--cr-text);
            font-size: 13px;
            vertical-align: middle;
        }

        .carnate-role-page .cr-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-role-page .cr-table tbody tr:hover {
            background: #fafafa;
        }

        .carnate-role-page .cr-sno {
            color: var(--cr-muted);
            font-weight: 600;
        }

        .carnate-role-page .cr-role-name {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            font-weight: 600;
            color: var(--cr-text);
        }

        .carnate-role-page .cr-role-icon {
            width: 34px;
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 9px;
            background: var(--cr-soft);
            color: #475569;
        }

        .carnate-role-page .cr-actions {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .carnate-role-page .cr-action {
            width: 34px;
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 0;
            border-radius: 8px;
            background: var(--cr-soft);
            color: #64748b;
            transition: all .2s ease;
        }

        .carnate-role-page .cr-action:hover {
            background: var(--cr-red-soft);
            color: var(--cr-red);
        }

        .carnate-role-page .cr-delete:hover {
            background: #fef2f2;
            color: #dc2626;
        }

        .carnate-role-page .cr-pagination {
            padding: 16px 18px;
            border-top: 1px solid var(--cr-border);
        }

        .carnate-role-page .cr-empty {
            padding: 44px 20px;
            text-align: center;
        }

        .carnate-role-page .cr-empty-icon {
            width: 52px;
            height: 52px;
            margin: 0 auto 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            background: var(--cr-soft);
            color: #94a3b8;
            font-size: 21px;
        }

        .carnate-role-page .cr-empty-title {
            color: #475569;
            font-size: 14px;
            font-weight: 700;
        }

        .carnate-role-page .cr-empty-text {
            margin-top: 4px;
            color: var(--cr-muted);
            font-size: 12px;
        }

        /* Modal */
        .carnate-role-page .cr-modal {
            position: fixed;
            inset: 0;
            z-index: 1055;
            overflow-x: hidden;
            overflow-y: auto;
        }

        .carnate-role-page .cr-modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.58);
            backdrop-filter: blur(2px);
        }

        .carnate-role-page .cr-modal-dialog {
            position: relative;
            z-index: 2;
            max-width: 900px;
            margin: 45px auto;
            padding: 0 15px;
        }

        .carnate-role-page .cr-modal-content {
            background: #fff;
            border: 1px solid var(--cr-border);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 25px 70px rgba(15, 23, 42, 0.22);
        }

        .carnate-role-page .cr-modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 22px;
            border-bottom: 1px solid var(--cr-border);
        }

        .carnate-role-page .cr-modal-title {
            margin: 0;
            color: var(--cr-text);
            font-size: 18px;
            font-weight: 700;
        }

        .carnate-role-page .cr-modal-subtitle {
            margin-top: 4px;
            color: var(--cr-muted);
            font-size: 12px;
        }

        .carnate-role-page .cr-close {
            width: 35px;
            height: 35px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 0;
            border-radius: 9px;
            background: var(--cr-soft);
            color: #64748b;
            opacity: 1;
        }

        .carnate-role-page .cr-close:hover {
            background: var(--cr-red-soft);
            color: var(--cr-red);
        }

        .carnate-role-page .cr-modal-body {
            padding: 22px;
        }

        .carnate-role-page .cr-field-label {
            display: block;
            margin-bottom: 7px;
            color: #334155;
            font-size: 13px;
            font-weight: 700;
        }

        .carnate-role-page .cr-required {
            color: var(--cr-red);
        }

        .carnate-role-page .cr-input {
            height: 44px;
            border: 1px solid var(--cr-border);
            border-radius: 10px;
            box-shadow: none;
            color: var(--cr-text);
            background: #fff;
        }

        .carnate-role-page .cr-input:focus {
            border-color: rgba(229, 57, 53, .45);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        .carnate-role-page .cr-permission-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
        }

        .carnate-role-page .cr-permission-title {
            display: flex;
            align-items: center;
            gap: 9px;
            margin: 0;
            color: var(--cr-text);
            font-size: 14px;
            font-weight: 700;
        }

        .carnate-role-page .cr-permission-title-icon {
            width: 30px;
            height: 30px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background: var(--cr-soft);
            color: #475569;
        }

        .carnate-role-page .cr-permission-box {
            border: 1px solid var(--cr-border);
            border-radius: 13px;
            overflow: hidden;
        }

        .carnate-role-page .cr-permission-table {
            width: 100%;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .carnate-role-page .cr-permission-table thead th {
            padding: 12px 14px;
            background: #f8fafc;
            border-bottom: 1px solid var(--cr-border);
            color: #64748b;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .035em;
        }

        .carnate-role-page .cr-permission-table tbody th,
        .carnate-role-page .cr-permission-table tbody td {
            padding: 12px 14px;
            border-bottom: 1px solid #eef2f7;
            font-size: 13px;
            vertical-align: middle;
        }

        .carnate-role-page .cr-permission-table tbody tr:last-child th,
        .carnate-role-page .cr-permission-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-role-page .cr-permission-table tbody tr:hover {
            background: #fafafa;
        }

        .carnate-role-page .cr-menu-name {
            color: var(--cr-text);
            font-weight: 700;
        }

        .carnate-role-page .cr-checkbox {
            width: 17px;
            height: 17px;
            margin: 0;
            accent-color: var(--cr-red);
            cursor: pointer;
        }

        .carnate-role-page .cr-modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 9px;
            padding: 15px 22px;
            border-top: 1px solid var(--cr-border);
            background: #fafafa;
        }

        .carnate-role-page .cr-btn {
            min-height: 40px;
            padding: 0 17px;
            border: 0;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 700;
            transition: all .2s ease;
        }

        .carnate-role-page .cr-btn-secondary {
            background: var(--cr-soft);
            color: #475569;
        }

        .carnate-role-page .cr-btn-secondary:hover {
            background: #e2e8f0;
        }

        .carnate-role-page .cr-btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: var(--cr-red);
            color: #fff;
        }

        .carnate-role-page .cr-btn-primary:hover {
            background: #d9322f;
        }

        .carnate-role-page .cr-error {
            display: block;
            margin-top: 5px;
            font-size: 12px;
        }

        @media (max-width: 767px) {
            .carnate-role-page .cr-header {
                gap: 16px;
            }

            .carnate-role-page .cr-header,
            .carnate-role-page .cr-header > div {
                width: 100%;
            }

            .carnate-role-page .cr-add-btn {
                justify-content: center;
                width: 100%;
            }

            .carnate-role-page .cr-modal-dialog {
                margin: 20px auto;
            }

            .carnate-role-page .cr-modal-body {
                padding: 16px;
            }

            .carnate-role-page .cr-modal-header,
            .carnate-role-page .cr-modal-footer {
                padding-left: 16px;
                padding-right: 16px;
            }

            .carnate-role-page .cr-permission-box {
                overflow-x: auto;
            }

            .carnate-role-page .cr-permission-table {
                min-width: 650px;
            }
        }
    </style>

    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="cr-alert">
            <i class="bx bx-check-circle me-1"></i>
            {{ session('message') }}
        </div>
    @endif

    @php
        $admin = App\Models\Admin::where('id', $adminId)->first();
    @endphp

    <!-- Add/Edit Modal -->
    <div
        class="cr-modal"
        tabindex="-1"
        style="display:@if ($showModal) block @else none @endif">

        <div class="cr-modal-backdrop"></div>

        <div class="cr-modal-dialog">

            <div class="cr-modal-content">

                <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">

                    <div class="cr-modal-header">
                        <div>
                            <h4 class="cr-modal-title">
                                {{ $isEdit ? 'Edit Role' : 'Create Role' }}
                            </h4>
                            <div class="cr-modal-subtitle">
                                Configure the role name and access permissions.
                            </div>
                        </div>

                        <button
                            type="button"
                            class="cr-close"
                            wire:click="$set('showModal', false)"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="bx bx-x fs-5"></i>
                        </button>
                    </div>

                    <div class="cr-modal-body">

                        @csrf

                        <div class="row g-4">

                            <!-- Name -->
                            <div class="col-md-12">
                                <label class="cr-field-label">
                                    Role Name
                                    <sup class="cr-required">*</sup>
                                </label>

                                <input
                                    type="text"
                                    wire:model="roleName"
                                    class="form-control cr-input"
                                    placeholder="Enter Role Name">

                                @error('roleName')
                                    <span class="text-danger cr-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Permissions -->
                            <div class="col-md-12">

                                <div class="cr-permission-header">
                                    <h5 class="cr-permission-title">
                                        <span class="cr-permission-title-icon">
                                            <i class="bx bx-shield-quarter"></i>
                                        </span>
                                        Permissions
                                    </h5>
                                </div>

                                <div class="cr-permission-box">
                                    <div class="table-responsive">
                                        <table class="cr-permission-table">

                                            <thead>
                                                <tr>
                                                    <th scope="col">Menu</th>
                                                    <th scope="col">List</th>
                                                    <th scope="col">Add</th>
                                                    <th scope="col">Edit</th>
                                                    <th scope="col">Delete</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                                @foreach ($menus as $mkey => $mvalue)

                                                    <tr>

                                                        <th scope="row">
                                                            <span class="cr-menu-name">
                                                                {{ ucfirst($mkey) }}
                                                            </span>
                                                        </th>

                                                        @foreach ($mvalue as $pkey => $pvalue)

                                                            <td>
                                                                <input
                                                                    class="cr-checkbox name{{ $mkey }}"
                                                                    type="checkbox"
                                                                    value="{{ $pvalue['name'] }}"
                                                                    wire:model="permissions"
                                                                    @if(in_array($pvalue['name'], $permissions)) checked @endif
                                                                >
                                                            </td>

                                                        @endforeach

                                                    </tr>

                                                @endforeach

                                            </tbody>

                                        </table>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="cr-modal-footer">

                        <button
                            type="button"
                            class="cr-btn cr-btn-secondary"
                            wire:click="$set('showModal', false)"
                            data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button type="submit" class="cr-btn cr-btn-primary">

                            <i class="{{ $isEdit ? 'bx bx-save' : 'bx bx-plus' }}"></i>

                            {{ $isEdit ? 'Update' : 'Create' }}

                            <i
                                class="spinner-border spinner-border-sm"
                                wire:loading></i>

                        </button>

                    </div>

                </form>

            </div>
        </div>
    </div>

    <!-- Page Header -->
    <div class="cr-card cr-header d-flex justify-content-between align-items-center">

        <div class="cr-title-wrap">
            <span class="cr-title-icon">
                <i class="bx bx-shield-quarter"></i>
            </span>

            <div>
                <h1 class="cr-title">Roles</h1>
                <p class="cr-subtitle">Manage administrator roles and permissions</p>
            </div>
        </div>

        <div>
            @if ($user->hasPermissionTo('admin-role-add'))

                <a
                    href="javascript:;"
                    wire:click="create"
                    class="cr-add-btn">
                    <i class="bx bx-plus"></i>
                    Add Role
                </a>

            @endif
        </div>

    </div>

    <!-- Roles Table -->
    <div class="cr-card cr-table-card">

        @if (!empty($roles) && $roles->count())

            <div class="cr-table-wrap">

                <table class="cr-table">

                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($roles as $index => $role)

                            <tr>

                                <td>
                                    <span class="cr-sno">
                                        {{ $roles->total() - ($roles->firstItem() + $index) + 1 }}
                                    </span>
                                </td>

                                <td>
                                    <div class="cr-role-name">
                                        <span class="cr-role-icon">
                                            <i class="bx bx-shield"></i>
                                        </span>

                                        {{ $role->name }}
                                    </div>
                                </td>

                                <td>

                                    <div class="cr-actions">

                                        @if ($user->hasPermissionTo('admin-role-add'))

                                            <a
                                                wire:click="edit({{ $role->id }})"
                                                class="cr-action"
                                                title="Edit Role">
                                                <i class="bx bx-edit-alt"></i>
                                            </a>

                                        @endif

                                        @if ($user->hasPermissionTo('admin-role-delete'))

                                            <a
                                                wire:click="confirmDelete({{ $role->id }})"
                                                class="cr-action cr-delete"
                                                title="Delete Role">
                                                <i class="bx bx-trash"></i>
                                            </a>

                                        @endif

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            <div class="cr-pagination">
                {{ $roles->links() }}
            </div>

        @else

            <div class="cr-empty">

                <div class="cr-empty-icon">
                    <i class="bx bx-shield"></i>
                </div>

                <div class="cr-empty-title">
                    No Roles Found!
                </div>

                <div class="cr-empty-text">
                    There are currently no roles available.
                </div>

            </div>

        @endif

    </div>

</div>


@section('footerscript')

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