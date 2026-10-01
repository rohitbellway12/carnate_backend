<div class="carnate-permission-page">

    <style>
        .carnate-permission-page {
            --permission-card: #ffffff;
            --permission-text: #111827;
            --permission-muted: #64748b;
            --permission-border: #e2e8f0;
            --permission-red: #e53935;
            --permission-red-dark: #c92f2c;
            --permission-red-soft: #fff5f5;
            --permission-icon: #f1f5f9;
            --permission-shadow: 0 8px 28px rgba(15, 23, 42, .06);
        }

        /* Cards */
        .carnate-permission-page .permission-card {
            background: var(--permission-card);
            border: 1px solid var(--permission-border);
            border-radius: 16px;
            box-shadow: var(--permission-shadow);
            overflow: hidden;
        }

        /* Page header */
        .carnate-permission-page .permission-page-header {
            min-height: 72px;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .carnate-permission-page .permission-title-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .carnate-permission-page .permission-title-icon {
            width: 42px;
            height: 42px;
            border-radius: 11px;
            background: var(--permission-red-soft);
            color: var(--permission-red);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        .carnate-permission-page .permission-page-title {
            margin: 0;
            color: var(--permission-text);
            font-size: 19px;
            font-weight: 700;
            text-transform: capitalize;
        }

        .carnate-permission-page .permission-page-subtitle {
            margin: 3px 0 0;
            color: var(--permission-muted);
            font-size: 12px;
        }

        /* Add */
        .carnate-permission-page .permission-add-btn {
            min-height: 40px;
            padding: 0 15px;
            border: 0;
            border-radius: 9px;
            background: var(--permission-red);
            color: #fff !important;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            transition: .2s ease;
        }

        .carnate-permission-page .permission-add-btn:hover {
            background: var(--permission-red-dark);
            color: #fff !important;
            transform: translateY(-1px);
        }

        .carnate-permission-page .permission-add-btn i {
            font-size: 18px;
        }

        /* Filter */
        .carnate-permission-page .permission-filter {
            margin-top: 16px;
        }

        .carnate-permission-page .permission-filter-body {
            padding: 17px 20px;
        }

        .carnate-permission-page .permission-filter-row {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .carnate-permission-page .permission-search-wrap {
            position: relative;
            width: 320px;
            max-width: 100%;
        }

        .carnate-permission-page .permission-search-icon {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 17px;
            pointer-events: none;
        }

        .carnate-permission-page .permission-search {
            height: 42px;
            padding-left: 39px;
            border: 1px solid var(--permission-border);
            border-radius: 9px;
            color: var(--permission-text);
            background: #fff;
            font-size: 13px;
            box-shadow: none !important;
        }

        .carnate-permission-page .permission-search:focus {
            border-color: rgba(229, 57, 53, .45);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08) !important;
        }

        .carnate-permission-page .permission-clear-btn {
            height: 42px;
            padding: 0 15px;
            border: 1px solid var(--permission-border);
            border-radius: 9px;
            background: #fff;
            color: var(--permission-muted);
            font-size: 12px;
            font-weight: 600;
            transition: .2s ease;
        }

        .carnate-permission-page .permission-clear-btn:hover {
            border-color: var(--permission-red);
            color: var(--permission-red);
            background: var(--permission-red-soft);
        }

        /* Table */
        .carnate-permission-page .permission-table-card {
            margin-top: 16px;
        }

        .carnate-permission-page .permission-table-body {
            padding: 0;
        }

        .carnate-permission-page .permission-table-wrap {
            overflow-x: auto;
        }

        .carnate-permission-page .permission-table {
            width: 100%;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .carnate-permission-page .permission-table thead th {
            padding: 13px 18px;
            background: #f8fafc;
            color: #64748b;
            border-bottom: 1px solid var(--permission-border);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
            white-space: nowrap;
        }

        .carnate-permission-page .permission-table tbody td {
            padding: 14px 18px;
            color: var(--permission-text);
            border-bottom: 1px solid #eef2f7;
            font-size: 13px;
            vertical-align: middle;
        }

        .carnate-permission-page .permission-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-permission-page .permission-table tbody tr {
            transition: .15s ease;
        }

        .carnate-permission-page .permission-table tbody tr:hover {
            background: #fafafa;
        }

        .carnate-permission-page .permission-number {
            color: #94a3b8;
            font-size: 12px;
            font-weight: 600;
        }

        .carnate-permission-page .permission-name-cell {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .carnate-permission-page .permission-name-icon {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            background: var(--permission-icon);
            color: #475569;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 16px;
        }

        .carnate-permission-page .permission-name {
            color: var(--permission-text);
            font-size: 13px;
            font-weight: 600;
        }

        .carnate-permission-page .permission-action-btn {
            width: 34px;
            height: 34px;
            padding: 0;
            border: 1px solid var(--permission-border);
            border-radius: 8px;
            background: #fff;
            color: #64748b;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: .2s ease;
        }

        .carnate-permission-page .permission-action-btn:hover {
            color: #dc2626;
            border-color: #fecaca;
            background: #fef2f2;
        }

        .carnate-permission-page .permission-action-btn i {
            font-size: 16px;
        }

        /* Empty state */
        .carnate-permission-page .permission-empty {
            padding: 55px 20px;
            text-align: center;
        }

        .carnate-permission-page .permission-empty-icon {
            width: 56px;
            height: 56px;
            margin: 0 auto 13px;
            border-radius: 14px;
            background: var(--permission-icon);
            color: #94a3b8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 25px;
        }

        .carnate-permission-page .permission-empty-title {
            margin: 0;
            color: var(--permission-text);
            font-size: 14px;
            font-weight: 700;
        }

        .carnate-permission-page .permission-empty-text {
            margin: 5px 0 0;
            color: var(--permission-muted);
            font-size: 12px;
        }

        /* Pagination */
        .carnate-permission-page .permission-pagination {
            padding: 15px 18px;
            border-top: 1px solid #eef2f7;
        }

        /* Modal */
        .carnate-permission-page .permission-modal {
            position: fixed;
            inset: 0;
            z-index: 1055;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: rgba(15, 23, 42, .48);
            backdrop-filter: blur(2px);
            overflow-y: auto;
        }

        .carnate-permission-page .permission-modal-dialog {
            width: min(560px, 100%);
        }

        .carnate-permission-page .permission-modal-content {
            background: #fff;
            border: 1px solid var(--permission-border);
            border-radius: 16px;
            box-shadow: 0 25px 70px rgba(15, 23, 42, .18);
            overflow: hidden;
        }

        .carnate-permission-page .permission-modal-header {
            padding: 17px 20px;
            border-bottom: 1px solid var(--permission-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .carnate-permission-page .permission-modal-title-wrap {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .carnate-permission-page .permission-modal-icon {
            width: 36px;
            height: 36px;
            border-radius: 9px;
            background: var(--permission-red-soft);
            color: var(--permission-red);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .carnate-permission-page .permission-modal-title {
            margin: 0;
            color: var(--permission-text);
            font-size: 16px;
            font-weight: 700;
        }

        .carnate-permission-page .permission-close {
            width: 34px;
            height: 34px;
            padding: 0;
            border: 1px solid var(--permission-border);
            border-radius: 8px;
            background: #fff;
            color: #64748b;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .carnate-permission-page .permission-close:hover {
            color: var(--permission-red);
            border-color: rgba(229, 57, 53, .25);
            background: var(--permission-red-soft);
        }

        .carnate-permission-page .permission-modal-body {
            padding: 20px;
        }

        .carnate-permission-page .permission-label {
            display: block;
            margin-bottom: 7px;
            color: var(--permission-text);
            font-size: 12px;
            font-weight: 700;
        }

        .carnate-permission-page .permission-required {
            color: var(--permission-red);
        }

        .carnate-permission-page .permission-input {
            width: 100%;
            height: 43px;
            padding: 0 12px;
            border: 1px solid var(--permission-border);
            border-radius: 9px;
            background: #fff;
            color: var(--permission-text);
            font-size: 13px;
            outline: none;
            box-shadow: none !important;
        }

        .carnate-permission-page .permission-input:focus {
            border-color: rgba(229, 57, 53, .45);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08) !important;
        }

        .carnate-permission-page .permission-error {
            display: block;
            margin-top: 5px;
            color: #dc2626;
            font-size: 11px;
        }

        .carnate-permission-page .permission-modal-footer {
            padding: 14px 20px;
            border-top: 1px solid var(--permission-border);
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 8px;
        }

        .carnate-permission-page .permission-cancel-btn {
            min-height: 40px;
            padding: 0 15px;
            border: 1px solid var(--permission-border);
            border-radius: 9px;
            background: #fff;
            color: var(--permission-muted);
            font-size: 12px;
            font-weight: 600;
        }

        .carnate-permission-page .permission-cancel-btn:hover {
            background: #f8fafc;
            color: var(--permission-text);
        }

        .carnate-permission-page .permission-submit-btn {
            min-height: 40px;
            min-width: 105px;
            padding: 0 16px;
            border: 0;
            border-radius: 9px;
            background: var(--permission-red);
            color: #fff;
            font-size: 12px;
            font-weight: 700;
        }

        .carnate-permission-page .permission-submit-btn:hover {
            background: var(--permission-red-dark);
        }

        .carnate-permission-page .permission-submit-btn .spinner-border {
            width: 13px;
            height: 13px;
            margin-left: 5px;
            border-width: 2px;
            vertical-align: middle;
        }

        /* Alert */
        .carnate-permission-page .permission-success {
            border: 1px solid #bbf7d0;
            border-radius: 10px;
            background: #f0fdf4;
            color: #166534;
            font-size: 12px;
        }

        @media (max-width: 767.98px) {
            .carnate-permission-page .permission-page-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .carnate-permission-page .permission-add-btn {
                width: 100%;
                justify-content: center;
            }

            .carnate-permission-page .permission-filter-row {
                align-items: stretch;
                flex-direction: column;
            }

            .carnate-permission-page .permission-search-wrap {
                width: 100%;
            }

            .carnate-permission-page .permission-clear-btn {
                width: 100%;
            }

            .carnate-permission-page .permission-modal {
                padding: 10px;
            }
        }
    </style>

    {{-- Success Message --}}
    @if (session()->has('message'))
        <div class="alert permission-success mb-3">
            {{ session('message') }}
        </div>
    @endif

    {{-- Add / Edit Modal --}}
    @if ($showModal)
        <div class="permission-modal">

            <div class="permission-modal-dialog">

                <div class="permission-modal-content">

                    <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">

                        <div class="permission-modal-header">

                            <div class="permission-modal-title-wrap">

                                <div class="permission-modal-icon">
                                    <i class="bx {{ $isEdit ? 'bx-edit-alt' : 'bx-key' }}"></i>
                                </div>

                                <h4 class="permission-modal-title">
                                    {{ $isEdit ? 'Edit Permission' : 'Create Permission' }}
                                </h4>

                            </div>

                            <button type="button"
                                class="permission-close"
                                wire:click="$set('showModal', false)"
                                data-bs-dismiss="modal"
                                aria-label="Close">

                                <i class="bx bx-x"></i>

                            </button>

                        </div>

                        <div class="permission-modal-body">

                            @csrf

                            <label class="permission-label">
                                Permission Name
                                <span class="permission-required">*</span>
                            </label>

                            <input type="text"
                                wire:model="permissionName"
                                class="permission-input"
                                placeholder="Enter permission Name">

                            @error('permissionName')
                                <span class="permission-error">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>

                        <div class="permission-modal-footer">

                            <button type="button"
                                class="permission-cancel-btn"
                                wire:click="$set('showModal', false)"
                                data-bs-dismiss="modal">
                                Cancel
                            </button>

                            <button type="submit"
                                class="permission-submit-btn">

                                {{ $isEdit ? 'Update' : 'Create' }}

                                <i class="spinner-border spinner-border-sm"
                                    wire:loading></i>

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>
    @endif

    {{-- Page Header --}}
    <div class="permission-card">

        <div class="permission-page-header">

            <div class="permission-title-wrap">

                <div class="permission-title-icon">
                    <i class="bx bx-key"></i>
                </div>

                <div>
                    <h4 class="permission-page-title">
                        Permissions
                    </h4>

                    <p class="permission-page-subtitle">
                        Manage system permissions and access controls
                    </p>
                </div>

            </div>

            <a href="javascript:;"
                wire:click="create"
                class="permission-add-btn">

                <i class="bx bx-plus"></i>
                Add Permission

            </a>

        </div>

    </div>

    {{-- Filters --}}
    <div class="permission-card permission-filter">

        <div class="permission-filter-body">

            <div class="permission-filter-row">

                <div class="permission-search-wrap">

                    <i class="bx bx-search permission-search-icon"></i>

                    <input type="text"
                        wire:model.live.debounce:30s="search"
                        class="form-control permission-search"
                        placeholder="Search permission">

                </div>

                <button type="button"
                    class="permission-clear-btn"
                    wire:click="clearFilter">

                    <i class="bx bx-reset me-1"></i>
                    Clear

                </button>

            </div>

        </div>

    </div>

    {{-- Permission List --}}
    <div class="permission-card permission-table-card">

        @if (!empty($permissions) && $permissions->count())

            <div class="permission-table-body">

                <div class="permission-table-wrap">

                    <table class="permission-table">

                        <thead>
                            <tr>
                                <th style="width: 90px;">
                                    S.No.
                                </th>

                                <th>
                                    Name
                                </th>

                                <th style="width: 100px;">
                                    Action
                                </th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($permissions as $index => $permission)

                                <tr>

                                    <td>
                                        <span class="permission-number">
                                            {{ $permissions->total() - ($permissions->firstItem() + $index) + 1 }}
                                        </span>
                                    </td>

                                    <td>

                                        <div class="permission-name-cell">

                                            <div class="permission-name-icon">
                                                <i class="bx bx-key"></i>
                                            </div>

                                            <span class="permission-name">
                                                {{ $permission->name }}
                                            </span>

                                        </div>

                                    </td>

                                    <td>

                                        <a wire:click="confirmDelete({{ $permission->id }})"
                                            class="permission-action-btn"
                                            title="Delete">

                                            <i class="bx bx-trash"></i>

                                        </a>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                <div class="permission-pagination">
                    {{ $permissions->links() }}
                </div>

            </div>

        @else

            <div class="permission-empty">

                <div class="permission-empty-icon">
                    <i class="bx bx-key"></i>
                </div>

                <p class="permission-empty-title">
                    No Permission Found!
                </p>

                <p class="permission-empty-text">
                    No permissions match your current search.
                </p>

            </div>

        @endif

    </div>

    {{-- Original Select2 Livewire hook preserved --}}
    <script>
        document.addEventListener('livewire:init', function() {

            Livewire.hook('morphed', (message, component) => {

                $('.select2').select2().on('change', function(e) {

                    const selectedValues = $(this).val();

                    @this.set(
                        e.target.dataset.property,
                        selectedValues
                    );

                });

            });

        });
    </script>

</div>