<div class="carnate-expense-category-page">

    @php
        $user = App\Models\WorkShopVendor::where(
            'id',
            Auth::guard('workshop')->user()->id
        )->first();
    @endphp

    <style>
        .carnate-expense-category-page {
            --ec-red: #e53935;
            --ec-red-dark: #c62828;
            --ec-red-soft: #fff5f5;
            --ec-text: #111827;
            --ec-muted: #64748b;
            --ec-border: #e2e8f0;
            --ec-bg: #f7f8fa;
            --ec-card: #ffffff;
            --ec-shadow: 0 4px 20px rgba(15, 23, 42, .05);
        }

        .carnate-expense-category-page {
            color: var(--ec-text);
        }

        /* Header */
        .carnate-expense-category-page .ec-header {
            background: var(--ec-card);
            border: 1px solid var(--ec-border);
            border-radius: 14px;
            box-shadow: var(--ec-shadow);
            margin-bottom: 18px;
        }

        .carnate-expense-category-page .ec-header-body {
            min-height: 78px;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .carnate-expense-category-page .ec-title {
            margin: 0;
            color: var(--ec-text);
            font-size: 21px;
            font-weight: 700;
            line-height: 1.3;
        }

        .carnate-expense-category-page .ec-subtitle {
            margin: 4px 0 0;
            color: var(--ec-muted);
            font-size: 12px;
        }

        /* Buttons */
        .carnate-expense-category-page .ec-add-btn {
            min-height: 40px;
            padding: 9px 16px;
            border: 1px solid var(--ec-red);
            border-radius: 9px;
            background: var(--ec-red);
            color: #fff;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: all .18s ease;
        }

        .carnate-expense-category-page .ec-add-btn:hover {
            background: var(--ec-red-dark);
            border-color: var(--ec-red-dark);
            color: #fff;
            transform: translateY(-1px);
        }

        /* Search card */
        .carnate-expense-category-page .ec-filter-card {
            background: var(--ec-card);
            border: 1px solid var(--ec-border);
            border-radius: 14px;
            box-shadow: var(--ec-shadow);
            margin-bottom: 18px;
        }

        .carnate-expense-category-page .ec-filter-body {
            padding: 16px 18px;
        }

        .carnate-expense-category-page .ec-filter-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .carnate-expense-category-page .ec-search {
            width: 340px;
            max-width: 100%;
            position: relative;
        }

        .carnate-expense-category-page .ec-search-icon {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            z-index: 2;
        }

        .carnate-expense-category-page .form-control {
            min-height: 42px;
            border: 1px solid var(--ec-border);
            border-radius: 9px;
            color: var(--ec-text);
            background: #fff;
            box-shadow: none;
        }

        .carnate-expense-category-page .form-control:focus {
            border-color: rgba(229, 57, 53, .55);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        .carnate-expense-category-page .ec-clear-btn {
            min-height: 40px;
            padding: 9px 15px;
            border: 1px solid var(--ec-border);
            border-radius: 9px;
            background: #fff;
            color: #475569;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all .18s ease;
        }

        .carnate-expense-category-page .ec-clear-btn:hover {
            background: #f8fafc;
            color: var(--ec-text);
        }

        /* Table card */
        .carnate-expense-category-page .ec-table-card {
            background: var(--ec-card);
            border: 1px solid var(--ec-border);
            border-radius: 14px;
            box-shadow: var(--ec-shadow);
            overflow: hidden;
        }

        .carnate-expense-category-page .ec-table-wrap {
            overflow-x: auto;
        }

        .carnate-expense-category-page .ec-table {
            width: 100%;
            min-width: 700px;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .carnate-expense-category-page .ec-table thead th {
            padding: 13px 16px;
            background: #f8fafc;
            border-bottom: 1px solid var(--ec-border);
            color: #475569;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .4px;
            white-space: nowrap;
        }

        .carnate-expense-category-page .ec-table tbody td {
            padding: 14px 16px;
            border-bottom: 1px solid #eef2f7;
            color: #334155;
            font-size: 13px;
            vertical-align: middle;
        }

        .carnate-expense-category-page .ec-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-expense-category-page .ec-table tbody tr:hover {
            background: #fafbfc;
        }

        .carnate-expense-category-page .ec-index {
            width: 75px;
            color: #94a3b8 !important;
            font-weight: 600;
        }

        .carnate-expense-category-page .ec-category-name {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--ec-text);
            font-weight: 600;
        }

        .carnate-expense-category-page .ec-category-icon {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            background: var(--ec-red-soft);
            color: var(--ec-red);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 34px;
        }

        .carnate-expense-category-page .ec-date {
            color: var(--ec-muted);
            white-space: nowrap;
        }

        /* Actions */
        .carnate-expense-category-page .ec-actions {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .carnate-expense-category-page .ec-action-btn {
            width: 34px;
            height: 34px;
            padding: 0;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid transparent;
            background: transparent;
            cursor: pointer;
            transition: all .18s ease;
        }

        .carnate-expense-category-page .ec-edit {
            color: #2563eb;
            background: #eff6ff;
            border-color: #dbeafe;
        }

        .carnate-expense-category-page .ec-edit:hover {
            background: #dbeafe;
            transform: translateY(-1px);
        }

        .carnate-expense-category-page .ec-delete {
            color: #dc2626;
            background: var(--ec-red-soft);
            border-color: #fee2e2;
        }

        .carnate-expense-category-page .ec-delete:hover {
            background: #fee2e2;
            transform: translateY(-1px);
        }

        /* Empty state */
        .carnate-expense-category-page .ec-empty {
            padding: 55px 20px;
            text-align: center;
        }

        .carnate-expense-category-page .ec-empty-icon {
            width: 54px;
            height: 54px;
            margin: 0 auto 12px;
            border-radius: 14px;
            background: #f1f5f9;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .carnate-expense-category-page .ec-empty-title {
            color: var(--ec-text);
            font-size: 14px;
            font-weight: 700;
        }

        .carnate-expense-category-page .ec-empty-text {
            margin-top: 4px;
            color: var(--ec-muted);
            font-size: 12px;
        }

        /* Modal */
        .carnate-expense-category-page .ec-modal {
            position: fixed;
            inset: 0;
            z-index: 1055;
            background: rgba(6, 6, 6, .55);
            overflow-y: auto;
            padding: 30px 15px;
        }

        .carnate-expense-category-page .ec-modal-dialog {
            width: 100%;
            max-width: 650px;
            margin: 0 auto;
        }

        .carnate-expense-category-page .ec-modal-content {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 25px 70px rgba(15, 23, 42, .18);
        }

        .carnate-expense-category-page .ec-modal-header {
            padding: 18px 22px;
            border-bottom: 1px solid var(--ec-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .carnate-expense-category-page .ec-modal-title {
            margin: 0;
            color: var(--ec-text);
            font-size: 18px;
            font-weight: 700;
        }

        .carnate-expense-category-page .ec-modal-title i {
            color: var(--ec-red);
            margin-right: 7px;
        }

        .carnate-expense-category-page .ec-close {
            width: 34px;
            height: 34px;
            padding: 0;
            border: 1px solid var(--ec-border);
            border-radius: 8px;
            background: #fff;
            color: #64748b;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all .18s ease;
        }

        .carnate-expense-category-page .ec-close:hover {
            background: var(--ec-red-soft);
            border-color: #fecaca;
            color: var(--ec-red);
        }

        .carnate-expense-category-page .ec-modal-body {
            padding: 22px;
        }

        .carnate-expense-category-page .ec-label {
            display: block;
            margin-bottom: 7px;
            color: #475569;
            font-size: 12px;
            font-weight: 700;
        }

        .carnate-expense-category-page .ec-modal-footer {
            padding: 15px 22px;
            border-top: 1px solid var(--ec-border);
            background: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 9px;
        }

        .carnate-expense-category-page .ec-cancel {
            min-height: 40px;
            padding: 9px 16px;
            border: 1px solid var(--ec-border);
            border-radius: 9px;
            background: #fff;
            color: #475569;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
        }

        .carnate-expense-category-page .ec-submit {
            min-height: 40px;
            padding: 9px 17px;
            border: 1px solid var(--ec-red);
            border-radius: 9px;
            background: var(--ec-red);
            color: #fff;
            font-size: 13px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            cursor: pointer;
        }

        .carnate-expense-category-page .ec-submit:hover {
            background: var(--ec-red-dark);
            border-color: var(--ec-red-dark);
        }

        .carnate-expense-category-page .ec-error {
            display: block;
            margin-top: 6px;
            color: #dc2626;
            font-size: 11px;
        }

        .carnate-expense-category-page .ec-spinner {
            width: 14px;
            height: 14px;
            border-width: 2px;
        }

        .carnate-expense-category-page .pagination-wrapper {
            padding-top: 15px;
        }

        @media (max-width: 767px) {
            .carnate-expense-category-page .ec-header-body {
                align-items: flex-start;
                flex-direction: column;
            }

            .carnate-expense-category-page .ec-filter-row {
                align-items: stretch;
                flex-direction: column;
            }

            .carnate-expense-category-page .ec-search {
                width: 100%;
            }

            .carnate-expense-category-page .ec-modal {
                padding: 15px 10px;
            }

            .carnate-expense-category-page .ec-modal-body {
                padding: 17px;
            }
        }
    </style>


    {{-- ============================================================
        PAGE HEADER
    ============================================================= --}}

    <div class="ec-header">

        <div class="ec-header-body">

            <div>

                <h4 class="ec-title">
                    Expense Category
                </h4>

                <p class="ec-subtitle">
                    Manage and organize your expense categories
                </p>

            </div>

            <div>

                {{-- ORIGINAL FUNCTIONAL ACTION PRESERVED --}}
                {{-- @if (@$user->hasPermissionTo('expense-category-add')) --}}

                <a
                    href="javascript:;"
                    wire:click="create"
                    class="ec-add-btn">

                    <i class="bx bxs-plus-square"></i>

                    Add

                </a>

                {{-- @endif --}}

            </div>

        </div>

    </div>


    {{-- ============================================================
        SEARCH / FILTER
    ============================================================= --}}

    <div class="ec-filter-card">

        <div class="ec-filter-body">

            <div class="ec-filter-row">

                <div class="ec-search">

                    <i class="bx bx-search ec-search-icon"></i>

                    <input
                        type="text"
                        class="form-control"
                        style="padding-left:38px;"
                        placeholder="Search Title"
                        wire:model.live="searchfilter">

                </div>

                <button
                    type="button"
                    class="ec-clear-btn"
                    wire:click="resetFilter">

                    <i class="bx bx-reset"></i>

                    Clear

                </button>

            </div>

        </div>

    </div>


    {{-- ============================================================
        MODAL
        FUNCTIONAL LIVEWIRE STRUCTURE PRESERVED
    ============================================================= --}}

    <div
        class="ec-modal"
        tabindex="-1"
        style="
            opacity:1;
            display:@if ($showModal) block @else none @endif;
        ">

        <div class="ec-modal-dialog">

            <div class="ec-modal-content">

                <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">

                    <div class="ec-modal-header">

                        <h4 class="ec-modal-title">

                            <i class="bx bx-category"></i>

                            {{ $isEdit ? 'Edit Expense Category' : 'Add Expense Category' }}

                        </h4>

                        <button
                            type="button"
                            class="ec-close"
                            wire:click="closeModel">

                            <i class="bx bx-x"></i>

                        </button>

                    </div>


                    <div class="ec-modal-body">

                        @csrf

                        <div class="row g-3">

                            <div class="col-md-12">

                                <label class="ec-label">
                                    Expense Category
                                    <sup class="text-danger">*</sup>
                                </label>

                                <input
                                    type="text"
                                    wire:model="title"
                                    class="form-control"
                                    placeholder="Enter Expense Category">

                                @error('title')
                                    <span class="ec-error">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>

                        </div>

                    </div>


                    <div class="ec-modal-footer">

                        <button
                            type="button"
                            class="ec-cancel"
                            wire:click="closeModel">

                            Cancel

                        </button>

                        <button
                            type="submit"
                            class="ec-submit">

                            {{ $isEdit ? 'Update' : 'Create' }}

                            <i
                                class="spinner-border spinner-border-sm ec-spinner"
                                wire:loading>
                            </i>

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    {{-- ============================================================
        CATEGORY TABLE
    ============================================================= --}}

    <div class="ec-table-card">

        @if (!empty($categories) && $categories->count())

            <div class="ec-table-wrap">

                <table class="ec-table data-table">

                    <thead>

                        <tr>

                            <th>
                                S.No.
                            </th>

                            <th>
                                Title
                            </th>

                            <th>
                                Date
                            </th>

                            {{-- @if (@$user->hasPermissionTo('expense-category-edit') || @$user->hasPermissionTo('expense-category-delete')) --}}

                            <th>
                                Actions
                            </th>

                            {{-- @endif --}}

                        </tr>

                    </thead>


                    <tbody>

                        @foreach ($categories as $index => $category)

                            <tr>

                                <td class="ec-index">

                                    {{ $categories->firstItem() + $index }}

                                </td>


                                <td>

                                    <div class="ec-category-name">

                                        <span class="ec-category-icon">

                                            <i class="bx bx-category"></i>

                                        </span>

                                        <span>
                                            {{ $category->title }}
                                        </span>

                                    </div>

                                </td>


                                <td class="ec-date">

                                    {{ \Carbon\Carbon::parse($category->created_at)->format('d-m-Y h:i A') }}

                                </td>


                                {{-- @if (@$user->hasPermissionTo('expense-category-edit') || @$user->hasPermissionTo('expense-category-delete')) --}}

                                <td>

                                    <div class="ec-actions">

                                        {{-- @if (@$user->hasPermissionTo('expense-category-edit')) --}}

                                        <button
                                            type="button"
                                            wire:click="edit({{ $category->id }})"
                                            class="ec-action-btn ec-edit"
                                            title="Edit">

                                            <i class="bx bxs-edit"></i>

                                        </button>

                                        {{-- @endif --}}


                                        {{-- @if (@$user->hasPermissionTo('expense-category-delete')) --}}

                                        <button
                                            type="button"
                                            wire:click="confirmDelete({{ $category->id }})"
                                            class="ec-action-btn ec-delete"
                                            title="Delete">

                                            <i class="bx bx-trash"></i>

                                        </button>

                                        {{-- @endif --}}

                                    </div>

                                </td>

                                {{-- @endif --}}

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            <div class="px-3 pb-3">

                <div class="pagination-wrapper">

                    {{ $categories->links() }}

                </div>

            </div>

        @else

            <div class="ec-empty">

                <div class="ec-empty-icon">

                    <i class="bx bx-category"></i>

                </div>

                <div class="ec-empty-title">
                    No Expense Category found!
                </div>

                <div class="ec-empty-text">
                    Expense categories you create will appear here.
                </div>

            </div>

        @endif

    </div>

</div>