<div class="carnate-admin-permissions-page">

    {{-- Success Message --}}
    @if (session()->has('message'))
        <div class="carnate-success-alert">
            <i class="bx bx-check-circle"></i>
            <span>{{ session('message') }}</span>
        </div>
    @endif


    {{-- =========================
        PAGE HEADER
    ========================== --}}
    <div class="carnate-page-header">

        <div>
            <span class="carnate-page-eyebrow">Access Control</span>
            <h1>Admin Permissions</h1>
            <p>Manage permissions available for administrator access.</p>
        </div>

        <button type="button"
            wire:click="create"
            class="carnate-primary-btn">

            <i class="bx bx-plus"></i>
            Add Permission

        </button>

    </div>


    {{-- =========================
        PERMISSIONS LIST
    ========================== --}}
    <div class="carnate-permissions-card">

        {{-- Search Toolbar --}}
        <div class="carnate-toolbar">

            <div class="carnate-search-wrapper">

                <i class="bx bx-search"></i>

                <input type="text"
                    wire:model.live.debounce:30s="search"
                    class="carnate-search-input"
                    placeholder="Search permissions...">

            </div>

            <button type="button"
                wire:click="clearFilter"
                class="carnate-clear-btn">

                <i class="bx bx-reset"></i>
                Clear

            </button>

        </div>


        @if (!empty($permissions) && $permissions->count())

            {{-- Table --}}
            <div class="carnate-table-wrapper">

                <table class="carnate-permissions-table">

                    <thead>
                        <tr>
                            <th width="90">S.No.</th>
                            <th>Name</th>
                            <th width="90" class="text-end">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($permissions as $index => $permission)

                            <tr>

                                <td>
                                    <span class="carnate-index">
                                        {{ $permissions->total() - ($permissions->firstItem() + $index) + 1 }}
                                    </span>
                                </td>

                                <td>
                                    <div class="carnate-permission-name">

                                        <span class="carnate-permission-icon">
                                            <i class="bx bx-key"></i>
                                        </span>

                                        <span>
                                            {{ $permission->name }}
                                        </span>

                                    </div>
                                </td>

                                <td class="text-end">

                                    {{-- Edit functionality intentionally preserved as commented --}}
                                    {{--
                                    <a wire:click="edit({{ $permission->id }})"
                                        class="carnate-action-btn edit"
                                        title="Edit">
                                        <i class="bx bx-edit"></i>
                                    </a>
                                    --}}

                                    <button type="button"
                                        wire:click="confirmDelete({{ $permission->id }})"
                                        class="carnate-action-btn delete"
                                        title="Delete">

                                        <i class="bx bx-trash"></i>

                                    </button>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            {{-- Pagination --}}
            <div class="carnate-pagination">
                {{ $permissions->links() }}
            </div>

        @else

            {{-- Empty State --}}
            <div class="carnate-empty-state">

                <div class="carnate-empty-icon">
                    <i class="bx bx-key"></i>
                </div>

                <h4>No Admin Permission Found</h4>

                <p>There are no admin permissions to display.</p>

            </div>

        @endif

    </div>


    {{-- =========================
        ADD / EDIT MODAL
    ========================== --}}
    <div class="carnate-modal"
        style="display: @if ($showModal) flex @else none @endif;">

        <div class="carnate-modal-dialog">

            <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">

                <div class="carnate-modal-header">

                    <div>
                        <span class="carnate-modal-eyebrow">
                            Access Control
                        </span>

                        <h4>
                            {{ $isEdit ? 'Edit Permission' : 'Create Permission' }}
                        </h4>
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

                    @csrf

                    <div class="carnate-form-group">

                        <label for="permissionName">
                            Permission Name
                            <sup>*</sup>
                        </label>

                        <div class="carnate-input-wrapper">

                            <i class="bx bx-key carnate-input-icon"></i>

                            <input type="text"
                                id="permissionName"
                                wire:model="permissionName"
                                class="carnate-input @error('permissionName') is-invalid @enderror"
                                placeholder="Enter permission name">

                        </div>

                        @error('permissionName')
                            <span class="carnate-error">
                                <i class="bx bx-error-circle"></i>
                                {{ $message }}
                            </span>
                        @enderror

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

                        <span wire:loading.remove>
                            <i class="bx bx-check"></i>
                            {{ $isEdit ? 'Update' : 'Create' }}
                        </span>

                        <span wire:loading class="carnate-loading-state">
                            <i class="spinner-border spinner-border-sm"></i>
                            Processing...
                        </span>

                    </button>

                </div>

            </form>

        </div>

    </div>


    <style>
        .carnate-admin-permissions-page {
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

        .carnate-admin-permissions-page * {
            box-sizing: border-box;
        }

        /* Success Message */

        .carnate-success-alert {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 12px 15px;
            margin-bottom: 18px;
            border: 1px solid #bbf7d0;
            border-radius: 10px;
            background: #f0fdf4;
            color: #15803d;
            font-size: 13px;
            font-weight: 600;
        }

        .carnate-success-alert i {
            font-size: 18px;
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

        /* Primary Button */

        .carnate-primary-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            min-height: 42px;
            padding: 0 17px;
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

        .carnate-primary-btn:hover {
            background: #d8322f;
            color: #fff;
            transform: translateY(-1px);
        }

        .carnate-primary-btn i {
            font-size: 18px;
        }

        /* Card */

        .carnate-permissions-card {
            overflow: hidden;
            border: 1px solid var(--carnate-border);
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 4px 18px rgba(15, 23, 42, .035);
        }

        /* Toolbar */

        .carnate-toolbar {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 16px 18px;
            border-bottom: 1px solid var(--carnate-border);
        }

        .carnate-search-wrapper {
            position: relative;
            width: 330px;
        }

        .carnate-search-wrapper > i {
            position: absolute;
            top: 50%;
            left: 12px;
            z-index: 1;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 17px;
            pointer-events: none;
        }

        .carnate-search-input {
            width: 100%;
            min-height: 40px;
            padding: 9px 12px 9px 37px;
            border: 1px solid var(--carnate-border);
            border-radius: 9px;
            outline: none;
            background: #fff;
            color: var(--carnate-text);
            font-size: 12px;
            transition: .2s ease;
        }

        .carnate-search-input::placeholder {
            color: #94a3b8;
        }

        .carnate-search-input:focus {
            border-color: rgba(229, 57, 53, .45);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .07);
        }

        .carnate-clear-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            min-height: 40px;
            padding: 0 13px;
            border: 1px solid var(--carnate-border);
            border-radius: 9px;
            background: #fff;
            color: #64748b;
            font-size: 12px;
            font-weight: 650;
            cursor: pointer;
            transition: .2s ease;
        }

        .carnate-clear-btn:hover {
            border-color: #cbd5e1;
            background: #f8fafc;
            color: #334155;
        }

        .carnate-clear-btn i {
            font-size: 15px;
        }

        /* Table */

        .carnate-table-wrapper {
            overflow-x: auto;
        }

        .carnate-permissions-table {
            width: 100%;
            border-collapse: collapse;
        }

        .carnate-permissions-table thead th {
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

        .carnate-permissions-table tbody td {
            padding: 13px 18px;
            border-bottom: 1px solid #edf1f5;
            color: var(--carnate-text);
            font-size: 13px;
            vertical-align: middle;
        }

        .carnate-permissions-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-permissions-table tbody tr:hover {
            background: #fafbfc;
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

        .carnate-permission-name {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: #334155;
            font-size: 13px;
            font-weight: 650;
        }

        .carnate-permission-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            border-radius: 9px;
            background: #f1f5f9;
            color: #64748b;
            font-size: 17px;
        }

        .carnate-action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            padding: 0;
            border: 0;
            border-radius: 8px;
            cursor: pointer;
            transition: .2s ease;
        }

        .carnate-action-btn.delete {
            background: #fef2f2;
            color: #dc2626;
        }

        .carnate-action-btn.delete:hover {
            background: #fee2e2;
            color: #b91c1c;
        }

        .carnate-action-btn i {
            font-size: 16px;
        }

        /* Pagination */

        .carnate-pagination {
            padding: 15px 18px;
            border-top: 1px solid var(--carnate-border);
        }

        /* Empty State */

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
            width: 58px;
            height: 58px;
            margin-bottom: 13px;
            border-radius: 15px;
            background: #f1f5f9;
            color: #94a3b8;
            font-size: 27px;
        }

        .carnate-empty-state h4 {
            margin: 0;
            color: var(--carnate-text);
            font-size: 16px;
            font-weight: 700;
        }

        .carnate-empty-state p {
            margin: 6px 0 0;
            color: var(--carnate-muted);
            font-size: 12px;
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
            max-width: 500px;
            overflow: hidden;
            border: 1px solid var(--carnate-border);
            border-radius: 18px;
            background: #fff;
            box-shadow: 0 24px 70px rgba(15, 23, 42, .18);
            animation: carnateModalIn .18s ease-out;
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
            color: var(--carnate-text);
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
            min-height: 44px;
            padding: 10px 13px 10px 40px;
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

        .carnate-input:focus {
            border-color: rgba(229, 57, 53, .45);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        .carnate-input.is-invalid {
            border-color: #fca5a5;
        }

        .carnate-error {
            display: flex;
            align-items: center;
            gap: 5px;
            margin-top: 6px;
            color: #dc2626;
            font-size: 12px;
        }

        .carnate-modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 9px;
            padding: 16px 22px;
            border-top: 1px solid var(--carnate-border);
            background: #fafbfc;
        }

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
        }

        .carnate-btn-secondary {
            background: #f1f5f9;
            color: #475569;
        }

        .carnate-btn-secondary:hover {
            background: #e2e8f0;
        }

        .carnate-loading-state {
            display: inline-flex;
            align-items: center;
            gap: 7px;
        }

        .carnate-loading-state .spinner-border {
            width: 14px;
            height: 14px;
            border-width: 2px;
        }

        /* Responsive */

        @media (max-width: 767px) {
            .carnate-admin-permissions-page {
                padding: 18px 14px;
            }

            .carnate-page-header {
                align-items: stretch;
                flex-direction: column;
            }

            .carnate-page-header h1 {
                font-size: 23px;
            }

            .carnate-primary-btn {
                width: 100%;
            }

            .carnate-toolbar {
                align-items: stretch;
                flex-direction: column;
            }

            .carnate-search-wrapper {
                width: 100%;
            }

            .carnate-clear-btn {
                width: 100%;
            }

            .carnate-table-wrapper {
                overflow-x: auto;
            }

            .carnate-permissions-table {
                min-width: 620px;
            }

            .carnate-modal {
                padding: 12px;
            }

            .carnate-modal-header,
            .carnate-modal-body {
                padding: 17px;
            }

            .carnate-modal-footer {
                padding: 13px 17px;
            }
        }
    </style>

    {{-- Keep the existing Livewire/Select2 hook --}}
    <script>
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