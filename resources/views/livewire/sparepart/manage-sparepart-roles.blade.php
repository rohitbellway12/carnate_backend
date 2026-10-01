<div class="carnate-role-page">

    <style>
        .carnate-role-page {
            --carnate-bg: #f7f8fa;
            --carnate-card: #ffffff;
            --carnate-text: #111827;
            --carnate-muted: #64748b;
            --carnate-border: #e2e8f0;
            --carnate-red: #e53935;
            --carnate-red-soft: #fff5f5;
            background: var(--carnate-bg);
            color: var(--carnate-text);
        }

        .carnate-role-page .carnate-page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 22px;
        }

        .carnate-role-page .carnate-title {
            margin: 0;
            font-size: 24px;
            line-height: 1.2;
            font-weight: 700;
            letter-spacing: -0.02em;
            color: var(--carnate-text);
        }

        .carnate-role-page .carnate-breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 6px;
            color: var(--carnate-muted);
            font-size: 13px;
        }

        .carnate-role-page .carnate-breadcrumb a {
            color: var(--carnate-muted);
            text-decoration: none;
        }

        .carnate-role-page .carnate-breadcrumb a:hover {
            color: var(--carnate-red);
        }

        .carnate-role-page .carnate-card {
            background: #fff;
            border: 1px solid var(--carnate-border);
            border-radius: 15px;
            box-shadow: 0 6px 24px rgba(15, 23, 42, .04);
            overflow: hidden;
        }

        .carnate-role-page .carnate-card-header {
            padding: 17px 20px;
            border-bottom: 1px solid var(--carnate-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .carnate-role-page .carnate-card-title {
            margin: 0;
            font-size: 16px;
            font-weight: 700;
            color: var(--carnate-text);
        }

        .carnate-role-page .carnate-card-subtitle {
            margin: 3px 0 0;
            font-size: 12px;
            color: var(--carnate-muted);
        }

        .carnate-role-page .carnate-add-btn {
            min-height: 40px;
            padding: 0 15px;
            border: 0;
            border-radius: 9px;
            background: var(--carnate-red);
            color: #fff;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: background .18s ease, transform .18s ease;
        }

        .carnate-role-page .carnate-add-btn:hover {
            background: #d9322f;
            color: #fff;
            transform: translateY(-1px);
        }

        .carnate-role-page .carnate-table-wrap {
            overflow-x: auto;
        }

        .carnate-role-page .carnate-table {
            width: 100%;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .carnate-role-page .carnate-table thead th {
            padding: 13px 18px;
            background: #f8fafc;
            border-bottom: 1px solid var(--carnate-border);
            color: #475569;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
            white-space: nowrap;
        }

        .carnate-role-page .carnate-table tbody td {
            padding: 14px 18px;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
            font-size: 13px;
            vertical-align: middle;
        }

        .carnate-role-page .carnate-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-role-page .carnate-table tbody tr:hover {
            background: #fafafa;
        }

        .carnate-role-page .carnate-serial {
            width: 70px;
            color: #94a3b8 !important;
            font-weight: 600;
        }

        .carnate-role-page .carnate-role-name {
            color: var(--carnate-text);
            font-weight: 600;
        }

        .carnate-role-page .carnate-actions {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .carnate-role-page .carnate-action {
            width: 34px;
            height: 34px;
            padding: 0;
            border: 1px solid var(--carnate-border);
            border-radius: 8px;
            background: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all .18s ease;
        }

        .carnate-role-page .carnate-edit {
            color: #64748b;
        }

        .carnate-role-page .carnate-edit:hover {
            color: var(--carnate-red);
            background: var(--carnate-red-soft);
            border-color: rgba(229, 57, 53, .2);
        }

        .carnate-role-page .carnate-delete {
            color: #64748b;
        }

        .carnate-role-page .carnate-delete:hover {
            color: #dc2626;
            background: #fef2f2;
            border-color: #fecaca;
        }

        .carnate-role-page .carnate-pagination {
            padding: 15px 18px;
            display: flex;
            justify-content: flex-end;
        }

        .carnate-role-page .carnate-empty {
            margin: 0;
            padding: 25px 20px;
            color: var(--carnate-muted);
            background: #fff;
            text-align: center;
            font-size: 13px;
        }

        .carnate-role-page .carnate-alert {
            margin-bottom: 18px;
            border: 1px solid #bbf7d0;
            background: #f0fdf4;
            color: #166534;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 13px;
        }

        /* Modal */
        .carnate-role-page .carnate-modal {
            position: fixed;
            inset: 0;
            z-index: 1055;
            background: rgba(15, 23, 42, .58);
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow-y: auto;
        }

        .carnate-role-page .carnate-modal.show {
            display: flex;
        }

        .carnate-role-page .carnate-modal-dialog {
            width: 100%;
            max-width: 900px;
            margin: auto;
        }

        .carnate-role-page .carnate-modal-content {
            background: #fff;
            border-radius: 16px;
            border: 1px solid var(--carnate-border);
            box-shadow: 0 20px 55px rgba(15, 23, 42, .18);
            overflow: hidden;
        }

        .carnate-role-page .carnate-modal-header {
            padding: 17px 20px;
            border-bottom: 1px solid var(--carnate-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .carnate-role-page .carnate-modal-title {
            margin: 0;
            font-size: 18px;
            font-weight: 700;
            color: var(--carnate-text);
        }

        .carnate-role-page .carnate-close {
            width: 34px;
            height: 34px;
            border: 0;
            border-radius: 8px;
            background: #f1f5f9;
            color: #64748b;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .carnate-role-page .carnate-close:hover {
            background: var(--carnate-red-soft);
            color: var(--carnate-red);
        }

        .carnate-role-page .carnate-modal-body {
            padding: 20px;
            max-height: calc(100vh - 220px);
            overflow-y: auto;
        }

        .carnate-role-page .carnate-form-label {
            display: block;
            margin-bottom: 7px;
            color: #334155;
            font-size: 13px;
            font-weight: 600;
        }

        .carnate-role-page .carnate-required {
            color: var(--carnate-red);
        }

        .carnate-role-page .carnate-form-control {
            width: 100%;
            min-height: 43px;
            padding: 9px 12px;
            border: 1px solid var(--carnate-border);
            border-radius: 9px;
            background: #fff;
            color: var(--carnate-text);
            font-size: 14px;
            outline: none;
        }

        .carnate-role-page .carnate-form-control:focus {
            border-color: rgba(229, 57, 53, .45);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        .carnate-role-page .carnate-error {
            display: block;
            margin-top: 6px;
            color: #dc2626;
            font-size: 12px;
        }

        .carnate-role-page .carnate-permission-header {
            margin-top: 20px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .carnate-role-page .carnate-permission-title {
            margin: 0;
            font-size: 14px;
            font-weight: 700;
            color: var(--carnate-text);
        }

        .carnate-role-page .carnate-permission-card {
            border: 1px solid var(--carnate-border);
            border-radius: 12px;
            overflow: hidden;
        }

        .carnate-role-page .carnate-permission-table {
            width: 100%;
            min-width: 650px;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .carnate-role-page .carnate-permission-table thead th {
            padding: 12px 14px;
            background: #f8fafc;
            color: #475569;
            border-bottom: 1px solid var(--carnate-border);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
            white-space: nowrap;
        }

        .carnate-role-page .carnate-permission-table tbody td,
        .carnate-role-page .carnate-permission-table tbody th {
            padding: 12px 14px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 13px;
            vertical-align: middle;
        }

        .carnate-role-page .carnate-permission-table tbody tr:last-child td,
        .carnate-role-page .carnate-permission-table tbody tr:last-child th {
            border-bottom: 0;
        }

        .carnate-role-page .carnate-menu-name {
            color: var(--carnate-text);
            font-weight: 600;
        }

        .carnate-role-page .carnate-checkbox {
            width: 17px;
            height: 17px;
            accent-color: var(--carnate-red);
            cursor: pointer;
        }

        .carnate-role-page .carnate-modal-footer {
            padding: 15px 20px;
            border-top: 1px solid var(--carnate-border);
            display: flex;
            justify-content: flex-end;
            gap: 9px;
        }

        .carnate-role-page .carnate-btn-secondary,
        .carnate-role-page .carnate-btn-primary {
            min-height: 40px;
            padding: 0 16px;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
        }

        .carnate-role-page .carnate-btn-secondary {
            border: 1px solid var(--carnate-border);
            background: #fff;
            color: #475569;
        }

        .carnate-role-page .carnate-btn-secondary:hover {
            background: #f8fafc;
        }

        .carnate-role-page .carnate-btn-primary {
            border: 1px solid var(--carnate-red);
            background: var(--carnate-red);
            color: #fff;
        }

        .carnate-role-page .carnate-btn-primary:hover {
            background: #d9322f;
            border-color: #d9322f;
        }

        @media (max-width: 767px) {
            .carnate-role-page .carnate-title {
                font-size: 20px;
            }

            .carnate-role-page .carnate-card-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .carnate-role-page .carnate-add-btn {
                width: 100%;
                justify-content: center;
            }

            .carnate-role-page .carnate-modal {
                padding: 10px;
            }

            .carnate-role-page .carnate-modal-body {
                padding: 15px;
            }

            .carnate-role-page .carnate-modal-footer {
                flex-direction: column-reverse;
            }

            .carnate-role-page .carnate-btn-secondary,
            .carnate-role-page .carnate-btn-primary {
                width: 100%;
            }
        }
    </style>

    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="carnate-alert">
            <i class="bx bx-check-circle me-1"></i>
            {{ session('message') }}
        </div>
    @endif

    <!-- Existing lookup preserved -->
    @php
        $sparePart = App\Models\SparePartVendor::where('id', $adminId)->first();
    @endphp

    <!-- Add / Edit Role Modal -->
    <div
        class="carnate-modal @if ($showModal) show @endif"
        tabindex="-1"
        style="opacity:1;"
    >
        <div class="carnate-modal-dialog">

            <div class="carnate-modal-content">

                <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">

                    <div class="carnate-modal-header">
                        <div>
                            <h4 class="carnate-modal-title">
                                {{ $isEdit ? 'Edit Role' : 'Create Role' }}
                            </h4>
                        </div>

                        <button
                            type="button"
                            class="carnate-close"
                            wire:click="$set('showModal', false)"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        >
                            <i class="bx bx-x fs-5"></i>
                        </button>
                    </div>

                    <div class="carnate-modal-body">

                        @csrf

                        <div>
                            <label class="carnate-form-label">
                                Role Name <sup class="carnate-required">*</sup>
                            </label>

                            <input
                                type="text"
                                wire:model="roleName"
                                class="carnate-form-control"
                                placeholder="Enter Role Name"
                            >

                            @error('roleName')
                                <span class="carnate-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="carnate-permission-header">
                            <h5 class="carnate-permission-title">
                                Permissions
                            </h5>
                        </div>

                        <div class="carnate-permission-card">
                            <div class="table-responsive">

                                <table class="carnate-permission-table">
                                    <thead>
                                        <tr>
                                            <th>Menu</th>
                                            <th class="text-center">List</th>
                                            <th class="text-center">Add</th>
                                            <th class="text-center">Edit</th>
                                            <th class="text-center">Delete</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($menus as $mkey => $mvalue)
                                            <tr>

                                                <th class="carnate-menu-name">
                                                    {{ ucfirst($mkey) }}
                                                </th>

                                                @foreach ($mvalue as $pkey => $pvalue)
                                                    <td class="text-center">
                                                        <input
                                                            class="carnate-checkbox name{{ $mkey }}"
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

                    <div class="carnate-modal-footer">

                        <button
                            type="button"
                            class="carnate-btn-secondary"
                            wire:click="$set('showModal', false)"
                            data-bs-dismiss="modal"
                        >
                            Cancel
                        </button>

                        <button
                            type="submit"
                            class="carnate-btn-primary"
                        >
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
    </div>

    <!-- Page Header -->
    <div class="carnate-page-header">

        <div>
            <h1 class="carnate-title">Roles</h1>

            <div class="carnate-breadcrumb">
                <a href="{{ route('sparepart.dashboard') }}">
                    <i class="bx bx-home-alt"></i>
                </a>
                <span>/</span>
                <span>Administration</span>
                <span>/</span>
                <span>Roles</span>
            </div>
        </div>

        @if ($user->hasPermissionTo('roles-add'))
            <a
                href="javascript:;"
                wire:click="create"
                class="carnate-add-btn"
            >
                <i class="bx bx-plus"></i>
                Add Role
            </a>
        @endif

    </div>

    <!-- Roles List -->
    <div class="carnate-card">

        @if (!empty($roles) && $roles->count())

            <div class="carnate-card-header">
                <div>
                    <h5 class="carnate-card-title">Role Management</h5>
                    <p class="carnate-card-subtitle">
                        Manage available roles and their permissions.
                    </p>
                </div>

                <span class="small text-muted">
                    {{ $roles->total() }} {{ $roles->total() == 1 ? 'Role' : 'Roles' }}
                </span>
            </div>

            <div class="carnate-table-wrap">

                <table class="carnate-table">

                    <thead>
                        <tr>
                            <th class="carnate-serial">S.No.</th>
                            <th>Name</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($roles as $index => $role)

                            <tr>

                                <td class="carnate-serial">
                                    {{ $roles->total() - ($roles->firstItem() + $index) + 1 }}
                                </td>

                                <td>
                                    <div class="carnate-role-name">
                                        {{ $role->name }}
                                    </div>
                                </td>

                                <td>
                                    <div class="carnate-actions justify-content-end">

                                        @if ($user->hasPermissionTo('roles-edit'))
                                            <button
                                                type="button"
                                                wire:click="edit({{ $role->id }})"
                                                class="carnate-action carnate-edit"
                                                title="Edit Role"
                                            >
                                                <i class="bx bx-edit-alt"></i>
                                            </button>
                                        @endif

                                        @if ($user->hasPermissionTo('roles-delete'))
                                            <button
                                                type="button"
                                                wire:click="confirmDelete({{ $role->id }})"
                                                class="carnate-action carnate-delete"
                                                title="Delete Role"
                                            >
                                                <i class="bx bx-trash"></i>
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
                {{ $roles->links() }}
            </div>

        @else

            <div class="carnate-empty">
                <i class="bx bx-shield-x fs-3 d-block mb-2 text-secondary"></i>
                No Roles Found!
            </div>

        @endif

    </div>

    <!-- Keep the existing Select2 Livewire hook -->
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

</div>