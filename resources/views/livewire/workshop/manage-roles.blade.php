<div class="carnate-role-page">

    <style>
        .carnate-role-page {
            --role-bg: #f7f8fa;
            --role-card: #ffffff;
            --role-text: #111827;
            --role-muted: #64748b;
            --role-border: #e2e8f0;
            --role-red: #e53935;
            --role-red-dark: #c92f2c;
            --role-red-soft: #fff5f5;
            --role-icon: #f1f5f9;
            --role-green: #16a34a;
            --role-shadow: 0 8px 28px rgba(15, 23, 42, .06);
        }

        .carnate-role-page .role-card {
            background: var(--role-card);
            border: 1px solid var(--role-border);
            border-radius: 16px;
            box-shadow: var(--role-shadow);
            overflow: hidden;
        }

        /* Page Header */
        .carnate-role-page .role-page-header {
            min-height: 72px;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .carnate-role-page .role-title-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .carnate-role-page .role-title-icon {
            width: 42px;
            height: 42px;
            border-radius: 11px;
            background: var(--role-red-soft);
            color: var(--role-red);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        .carnate-role-page .role-page-title {
            margin: 0;
            color: var(--role-text);
            font-size: 19px;
            font-weight: 700;
        }

        .carnate-role-page .role-page-subtitle {
            margin: 3px 0 0;
            color: var(--role-muted);
            font-size: 12px;
        }

        /* Add Button */
        .carnate-role-page .role-add-btn {
            min-height: 40px;
            padding: 0 15px;
            border: 0;
            border-radius: 9px;
            background: var(--role-red);
            color: #fff !important;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            transition: .2s ease;
        }

        .carnate-role-page .role-add-btn i {
            font-size: 18px;
        }

        .carnate-role-page .role-add-btn:hover {
            background: var(--role-red-dark);
            color: #fff !important;
            transform: translateY(-1px);
        }

        /* Search */
        .carnate-role-page .role-filter-card {
            margin-top: 16px;
        }

        .carnate-role-page .role-filter-body {
            padding: 17px 20px;
        }

        .carnate-role-page .role-filter-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
        }

        .carnate-role-page .role-search-wrap {
            position: relative;
            width: 320px;
            max-width: 100%;
        }

        .carnate-role-page .role-search-icon {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 17px;
            pointer-events: none;
        }

        .carnate-role-page .role-search {
            height: 42px;
            padding-left: 39px;
            border: 1px solid var(--role-border);
            border-radius: 9px;
            color: var(--role-text);
            background: #fff;
            font-size: 13px;
            box-shadow: none !important;
        }

        .carnate-role-page .role-search:focus {
            border-color: rgba(229, 57, 53, .45);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08) !important;
        }

        .carnate-role-page .role-clear-btn {
            height: 42px;
            padding: 0 15px;
            border: 1px solid var(--role-border);
            border-radius: 9px;
            background: #fff;
            color: var(--role-muted);
            font-size: 12px;
            font-weight: 600;
            transition: .2s ease;
        }

        .carnate-role-page .role-clear-btn:hover {
            border-color: var(--role-red);
            color: var(--role-red);
            background: var(--role-red-soft);
        }

        /* Table */
        .carnate-role-page .role-table-card {
            margin-top: 16px;
        }

        .carnate-role-page .role-table-body {
            padding: 0;
        }

        .carnate-role-page .role-table-wrap {
            overflow-x: auto;
        }

        .carnate-role-page .role-table {
            width: 100%;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .carnate-role-page .role-table thead th {
            padding: 13px 18px;
            background: #f8fafc;
            color: #64748b;
            border-bottom: 1px solid var(--role-border);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
            white-space: nowrap;
        }

        .carnate-role-page .role-table tbody td {
            padding: 14px 18px;
            color: var(--role-text);
            border-bottom: 1px solid #eef2f7;
            font-size: 13px;
            vertical-align: middle;
        }

        .carnate-role-page .role-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-role-page .role-table tbody tr {
            transition: .15s ease;
        }

        .carnate-role-page .role-table tbody tr:hover {
            background: #fafafa;
        }

        .carnate-role-page .role-number {
            color: #94a3b8;
            font-size: 12px;
            font-weight: 600;
        }

        .carnate-role-page .role-name-cell {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .carnate-role-page .role-avatar {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            background: var(--role-icon);
            color: #475569;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            flex-shrink: 0;
        }

        .carnate-role-page .role-name {
            color: var(--role-text);
            font-size: 13px;
            font-weight: 700;
        }

        .carnate-role-page .role-actions {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .carnate-role-page .role-action-btn {
            width: 34px;
            height: 34px;
            padding: 0;
            border: 1px solid var(--role-border);
            border-radius: 8px;
            background: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            cursor: pointer;
            transition: .2s ease;
        }

        .carnate-role-page .role-action-btn.edit:hover {
            color: var(--role-red);
            border-color: rgba(229, 57, 53, .25);
            background: var(--role-red-soft);
        }

        .carnate-role-page .role-action-btn.delete:hover {
            color: #dc2626;
            border-color: #fecaca;
            background: #fef2f2;
        }

        .carnate-role-page .role-action-btn i {
            font-size: 16px;
        }

        /* Empty State */
        .carnate-role-page .role-empty {
            padding: 50px 20px;
            text-align: center;
        }

        .carnate-role-page .role-empty-icon {
            width: 54px;
            height: 54px;
            margin: 0 auto 12px;
            border-radius: 14px;
            background: var(--role-icon);
            color: #94a3b8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .carnate-role-page .role-empty-title {
            margin: 0;
            color: var(--role-text);
            font-size: 14px;
            font-weight: 700;
        }

        .carnate-role-page .role-empty-text {
            margin: 5px 0 0;
            color: var(--role-muted);
            font-size: 12px;
        }

        /* Pagination */
        .carnate-role-page .role-pagination {
            padding: 15px 18px;
            border-top: 1px solid #eef2f7;
        }

        .carnate-role-page .role-pagination nav {
            margin: 0;
        }

        /* Modal */
        .carnate-role-page .role-modal {
            position: fixed;
            inset: 0;
            z-index: 1055;
            background: rgba(15, 23, 42, .48);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow-y: auto;
            backdrop-filter: blur(2px);
        }

        .carnate-role-page .role-modal-dialog {
            width: min(1050px, 100%);
            max-height: calc(100vh - 40px);
            display: flex;
            flex-direction: column;
        }

        .carnate-role-page .role-modal-content {
            background: #fff;
            border: 1px solid var(--role-border);
            border-radius: 16px;
            box-shadow: 0 25px 70px rgba(15, 23, 42, .18);
            overflow: hidden;
        }

        .carnate-role-page .role-modal-header {
            padding: 17px 20px;
            border-bottom: 1px solid var(--role-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .carnate-role-page .role-modal-title-wrap {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .carnate-role-page .role-modal-icon {
            width: 36px;
            height: 36px;
            border-radius: 9px;
            background: var(--role-red-soft);
            color: var(--role-red);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .carnate-role-page .role-modal-title {
            margin: 0;
            color: var(--role-text);
            font-size: 16px;
            font-weight: 700;
        }

        .carnate-role-page .role-close {
            width: 34px;
            height: 34px;
            padding: 0;
            border: 1px solid var(--role-border);
            border-radius: 8px;
            background: #fff;
            color: #64748b;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .carnate-role-page .role-close:hover {
            color: var(--role-red);
            border-color: rgba(229, 57, 53, .25);
            background: var(--role-red-soft);
        }

        .carnate-role-page .role-modal-body {
            padding: 20px;
            max-height: calc(100vh - 190px);
            overflow-y: auto;
        }

        .carnate-role-page .role-form-label {
            display: block;
            margin-bottom: 7px;
            color: var(--role-text);
            font-size: 12px;
            font-weight: 700;
        }

        .carnate-role-page .role-required {
            color: var(--role-red);
        }

        .carnate-role-page .role-input {
            width: 100%;
            height: 42px;
            border: 1px solid var(--role-border);
            border-radius: 9px;
            padding: 0 12px;
            color: var(--role-text);
            background: #fff;
            font-size: 13px;
            outline: none;
            box-shadow: none !important;
        }

        .carnate-role-page .role-input:focus {
            border-color: rgba(229, 57, 53, .45);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08) !important;
        }

        .carnate-role-page .role-error {
            display: block;
            margin-top: 5px;
            color: #dc2626;
            font-size: 11px;
        }

        /* Permission heading */
        .carnate-role-page .permission-heading {
            margin-top: 20px;
            margin-bottom: 9px;
            color: var(--role-text);
            font-size: 12px;
            font-weight: 700;
        }

        .carnate-role-page .permission-box {
            border: 1px solid var(--role-border);
            border-radius: 12px;
            background: #fff;
            overflow: hidden;
        }

        .carnate-role-page .permission-scroll {
            max-height: 400px;
            overflow: auto;
        }

        .carnate-role-page .permission-scroll::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        .carnate-role-page .permission-scroll::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .carnate-role-page .permission-table {
            width: 100%;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
            min-width: 850px;
        }

        .carnate-role-page .permission-table thead th {
            position: sticky;
            top: 0;
            z-index: 5;
            padding: 12px 13px;
            background: #f8fafc;
            border-bottom: 1px solid var(--role-border);
            color: #64748b;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
            white-space: nowrap;
        }

        .carnate-role-page .permission-table tbody td,
        .carnate-role-page .permission-table tbody th {
            padding: 11px 13px;
            border-bottom: 1px solid #eef2f7;
            vertical-align: middle;
        }

        .carnate-role-page .permission-table tbody tr:last-child td,
        .carnate-role-page .permission-table tbody tr:last-child th {
            border-bottom: 0;
        }

        .carnate-role-page .permission-table tbody tr:hover {
            background: #fafafa;
        }

        .carnate-role-page .module-name {
            color: var(--role-text);
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        .carnate-role-page .permission-check {
            width: 17px !important;
            height: 17px !important;
            margin: 0;
            cursor: pointer;
            accent-color: var(--role-red);
            vertical-align: middle;
        }

        .carnate-role-page .permission-dash {
            color: #cbd5e1;
            font-size: 12px;
        }

        .carnate-role-page .custom-permissions {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .carnate-role-page .custom-permission {
            display: flex;
            align-items: center;
            gap: 7px;
            margin: 0;
        }

        .carnate-role-page .custom-permission-label {
            color: #475569;
            font-size: 11px;
            font-weight: 500;
            line-height: 1.25;
            cursor: pointer;
        }

        .carnate-role-page .role-modal-footer {
            padding: 14px 20px;
            border-top: 1px solid var(--role-border);
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 8px;
        }

        .carnate-role-page .role-cancel-btn {
            min-height: 40px;
            padding: 0 15px;
            border: 1px solid var(--role-border);
            border-radius: 9px;
            background: #fff;
            color: #64748b;
            font-size: 12px;
            font-weight: 600;
        }

        .carnate-role-page .role-cancel-btn:hover {
            background: #f8fafc;
            color: var(--role-text);
        }

        .carnate-role-page .role-submit-btn {
            min-height: 40px;
            min-width: 105px;
            padding: 0 16px;
            border: 0;
            border-radius: 9px;
            background: var(--role-red);
            color: #fff;
            font-size: 12px;
            font-weight: 700;
        }

        .carnate-role-page .role-submit-btn:hover {
            background: var(--role-red-dark);
        }

        .carnate-role-page .role-submit-btn .spinner-border {
            width: 13px;
            height: 13px;
            margin-left: 5px;
            border-width: 2px;
            vertical-align: middle;
        }

        @media (max-width: 767.98px) {
            .carnate-role-page .role-page-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .carnate-role-page .role-add-btn {
                width: 100%;
                justify-content: center;
            }

            .carnate-role-page .role-filter-row {
                align-items: stretch;
                flex-direction: column;
            }

            .carnate-role-page .role-search-wrap {
                width: 100%;
            }

            .carnate-role-page .role-clear-btn {
                width: 100%;
            }

            .carnate-role-page .role-modal {
                padding: 10px;
            }

            .carnate-role-page .role-modal-body {
                padding: 15px;
            }

            .carnate-role-page .role-modal-footer {
                padding: 12px 15px;
            }
        }
    </style>

    {{-- Success Message --}}
    @if (session()->has('message'))
        <div class="alert alert-success mb-3">
            {{ session('message') }}
        </div>
    @endif

    {{-- Add / Edit Modal --}}
    @if ($showModal)
        <div class="role-modal">

            <div class="role-modal-dialog">

                <div class="role-modal-content">

                    <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">

                        <div class="role-modal-header">

                            <div class="role-modal-title-wrap">
                                <div class="role-modal-icon">
                                    <i class="bx {{ $isEdit ? 'bx-edit-alt' : 'bx-shield-quarter' }}"></i>
                                </div>

                                <h4 class="role-modal-title">
                                    {{ $isEdit ? 'Edit Role' : 'Create Role' }}
                                </h4>
                            </div>

                            <button type="button"
                                class="role-close"
                                wire:click="$set('showModal', false)"
                                data-bs-dismiss="modal"
                                aria-label="Close">
                                <i class="bx bx-x"></i>
                            </button>

                        </div>

                        <div class="role-modal-body">

                            @csrf

                            {{-- Role Name --}}
                            <div>
                                <label class="role-form-label">
                                    Role Name <span class="role-required">*</span>
                                </label>

                                <input type="text"
                                    wire:model="roleName"
                                    class="role-input"
                                    placeholder="Enter Role Name">

                                @error('roleName')
                                    <span class="role-error">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Permissions --}}
                            <div class="permission-heading">
                                Permissions
                            </div>

                            <div class="permission-box">

                                <div class="permission-scroll">

                                    <table class="permission-table">

                                        <thead>
                                            <tr>
                                                <th style="min-width:150px;">
                                                    Menu / Module
                                                </th>

                                                <th class="text-center" style="width:10%;">
                                                    List
                                                </th>

                                                <th class="text-center" style="width:10%;">
                                                    Add
                                                </th>

                                                <th class="text-center" style="width:10%;">
                                                    Edit
                                                </th>

                                                <th class="text-center" style="width:10%;">
                                                    Delete
                                                </th>

                                                <th style="min-width:250px;">
                                                    Additional Permissions
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            @foreach ($menus as $mkey => $mvalue)

                                                @php
                                                    $showPerm = null;
                                                    $addPerm = null;
                                                    $editPerm = null;
                                                    $deletePerm = null;
                                                    $customPerms = [];

                                                    foreach ($mvalue as $p) {
                                                        $name = $p['name'];

                                                        if (strcasecmp($name, $mkey . '-show') === 0) {
                                                            $showPerm = $p;
                                                        } elseif (strcasecmp($name, $mkey . '-add') === 0) {
                                                            $addPerm = $p;
                                                        } elseif (strcasecmp($name, $mkey . '-edit') === 0) {
                                                            $editPerm = $p;
                                                        } elseif (strcasecmp($name, $mkey . '-delete') === 0) {
                                                            $deletePerm = $p;
                                                        } else {
                                                            $customPerms[] = $p;
                                                        }
                                                    }
                                                @endphp

                                                <tr>

                                                    <th scope="row">
                                                        <div class="module-name">
                                                            {{ ucwords(str_replace(['-', '_'], ' ', $mkey)) }}
                                                        </div>
                                                    </th>

                                                    {{-- List --}}
                                                    <td class="text-center">

                                                        @if ($showPerm)

                                                            <input
                                                                type="checkbox"
                                                                value="{{ $showPerm['name'] }}"
                                                                wire:model="permissions"
                                                                class="permission-check"
                                                                @if(in_array($showPerm['name'], $permissions)) checked @endif
                                                            >

                                                        @else

                                                            <span class="permission-dash">—</span>

                                                        @endif

                                                    </td>

                                                    {{-- Add --}}
                                                    <td class="text-center">

                                                        @if ($addPerm)

                                                            <input
                                                                type="checkbox"
                                                                value="{{ $addPerm['name'] }}"
                                                                wire:model="permissions"
                                                                class="permission-check"
                                                                @if(in_array($addPerm['name'], $permissions)) checked @endif
                                                            >

                                                        @else

                                                            <span class="permission-dash">—</span>

                                                        @endif

                                                    </td>

                                                    {{-- Edit --}}
                                                    <td class="text-center">

                                                        @if ($editPerm)

                                                            <input
                                                                type="checkbox"
                                                                value="{{ $editPerm['name'] }}"
                                                                wire:model="permissions"
                                                                class="permission-check"
                                                                @if(in_array($editPerm['name'], $permissions)) checked @endif
                                                            >

                                                        @else

                                                            <span class="permission-dash">—</span>

                                                        @endif

                                                    </td>

                                                    {{-- Delete --}}
                                                    <td class="text-center">

                                                        @if ($deletePerm)

                                                            <input
                                                                type="checkbox"
                                                                value="{{ $deletePerm['name'] }}"
                                                                wire:model="permissions"
                                                                class="permission-check"
                                                                @if(in_array($deletePerm['name'], $permissions)) checked @endif
                                                            >

                                                        @else

                                                            <span class="permission-dash">—</span>

                                                        @endif

                                                    </td>

                                                    {{-- Additional Permissions --}}
                                                    <td>

                                                        @if (count($customPerms) > 0)

                                                            <div class="custom-permissions">

                                                                @foreach ($customPerms as $cp)

                                                                    <div class="custom-permission">

                                                                        <input
                                                                            type="checkbox"
                                                                            value="{{ $cp['name'] }}"
                                                                            wire:model="permissions"
                                                                            class="permission-check"
                                                                            id="perm_{{ $cp['id'] }}"
                                                                            @if(in_array($cp['name'], $permissions)) checked @endif
                                                                        >

                                                                        <label
                                                                            class="custom-permission-label"
                                                                            for="perm_{{ $cp['id'] }}">
                                                                            {{ ucwords(str_replace(['-', '_'], ' ', $cp['name'])) }}
                                                                        </label>

                                                                    </div>

                                                                @endforeach

                                                            </div>

                                                        @else

                                                            <span class="permission-dash">—</span>

                                                        @endif

                                                    </td>

                                                </tr>

                                            @endforeach

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                        <div class="role-modal-footer">

                            <button type="button"
                                class="role-cancel-btn"
                                wire:click="$set('showModal', false)"
                                data-bs-dismiss="modal">
                                Cancel
                            </button>

                            <button type="submit" class="role-submit-btn">

                                {{ $isEdit ? 'Update' : 'Create' }}

                                <i class="spinner-border spinner-border-sm" wire:loading></i>

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>
    @endif

    {{-- Page Header --}}
    <div class="role-card">

        <div class="role-page-header">

            <div class="role-title-wrap">

                <div class="role-title-icon">
                    <i class="bx bx-shield-quarter"></i>
                </div>

                <div>
                    <h4 class="role-page-title">Roles</h4>
                    <p class="role-page-subtitle">
                        Manage roles and their permissions
                    </p>
                </div>

            </div>

            @if ($user->hasPermissionTo('role-add'))

                <a href="javascript:;"
                    wire:click="create"
                    class="role-add-btn">

                    <i class="bx bx-plus"></i>
                    Add Role

                </a>

            @endif

        </div>

    </div>

    {{-- Filters --}}
    <div class="role-card role-filter-card">

        <div class="role-filter-body">

            <div class="role-filter-row">

                <div class="role-search-wrap">

                    <i class="bx bx-search role-search-icon"></i>

                    <input type="text"
                        class="form-control role-search"
                        placeholder="Search role name"
                        wire:model.live="searchfilter">

                </div>

                <button type="button"
                    class="role-clear-btn"
                    wire:click="resetFilter">

                    <i class="bx bx-reset me-1"></i>
                    Clear

                </button>

            </div>

        </div>

    </div>

    {{-- Roles Table --}}
    <div class="role-card role-table-card">

        @if (!empty($roles) && $roles->count())

            <div class="role-table-body">

                <div class="role-table-wrap">

                    <table class="role-table">

                        <thead>
                            <tr>
                                <th style="width:90px;">S.No.</th>
                                <th>Name</th>
                                <th style="width:130px;">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($roles as $index => $role)

                                <tr>

                                    <td>
                                        <span class="role-number">
                                            {{ $roles->total() - ($roles->firstItem() + $index) + 1 }}
                                        </span>
                                    </td>

                                    <td>

                                        <div class="role-name-cell">

                                            <div class="role-avatar">
                                                <i class="bx bx-shield"></i>
                                            </div>

                                            <span class="role-name">
                                                {{ $role->name }}
                                            </span>

                                        </div>

                                    </td>

                                    <td>

                                        <div class="role-actions">

                                            {{-- Original edit action preserved --}}
                                            <a wire:click="edit({{ $role->id }})"
                                                class="role-action-btn edit"
                                                title="Edit">

                                                <i class="bx bx-edit-alt"></i>

                                            </a>

                                            {{-- Original delete action preserved --}}
                                            <a wire:click="confirmDelete({{ $role->id }})"
                                                class="role-action-btn delete"
                                                title="Delete">

                                                <i class="bx bx-trash"></i>

                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                <div class="role-pagination">
                    {{ $roles->links() }}
                </div>

            </div>

        @else

            <div class="role-empty">

                <div class="role-empty-icon">
                    <i class="bx bx-shield-quarter"></i>
                </div>

                <p class="role-empty-title">
                    No Roles Found!
                </p>

                <p class="role-empty-text">
                    No roles match your current search.
                </p>

            </div>

        @endif

    </div>

    {{-- Original Select2 hook preserved --}}
    <script>
        document.addEventListener('livewire:init', function () {

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