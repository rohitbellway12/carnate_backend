<div class="carnate-expense-category-page">

    @php
        $sparePart = \App\Models\SparePartVendor::where(
            'id',
            \Illuminate\Support\Facades\Auth::guard('sparepart')->user()->id
        )->first();
    @endphp

    <style>
        .carnate-expense-category-page {
            background: #f7f8fa;
            color: #111827;
        }

        .carnate-expense-category-page .page-card,
        .carnate-expense-category-page .filter-card,
        .carnate-expense-category-page .table-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            box-shadow: 0 4px 18px rgba(15, 23, 42, 0.04);
        }

        .carnate-expense-category-page .page-card {
            padding: 22px 24px;
        }

        .carnate-expense-category-page .page-heading {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .carnate-expense-category-page .page-heading-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff5f5;
            color: #e53935;
            font-size: 20px;
        }

        .carnate-expense-category-page .page-title {
            margin: 0;
            font-size: 20px;
            font-weight: 700;
            color: #111827;
        }

        .carnate-expense-category-page .page-subtitle {
            margin: 3px 0 0;
            font-size: 13px;
            color: #64748b;
        }

        .carnate-expense-category-page .add-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            min-height: 42px;
            padding: 0 18px;
            border: 0;
            border-radius: 10px;
            background: #e53935;
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: all .2s ease;
        }

        .carnate-expense-category-page .add-btn:hover {
            background: #c62828;
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 6px 14px rgba(229, 57, 53, .18);
        }

        .carnate-expense-category-page .add-btn i {
            font-size: 18px;
        }

        .carnate-expense-category-page .filter-card {
            margin-top: 18px;
            padding: 18px 20px;
        }

        .carnate-expense-category-page .filter-row {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .carnate-expense-category-page .search-wrapper {
            position: relative;
            width: 320px;
            max-width: 100%;
        }

        .carnate-expense-category-page .search-wrapper i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 18px;
            pointer-events: none;
        }

        .carnate-expense-category-page .search-input {
            height: 44px;
            padding-left: 42px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            color: #111827;
            background: #fff;
            box-shadow: none;
        }

        .carnate-expense-category-page .search-input:focus {
            border-color: #cbd5e1;
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        .carnate-expense-category-page .clear-btn {
            height: 44px;
            padding: 0 17px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            background: #fff;
            color: #475569;
            font-size: 14px;
            font-weight: 600;
            transition: all .2s ease;
        }

        .carnate-expense-category-page .clear-btn:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
            color: #111827;
        }

        .carnate-expense-category-page .table-card {
            margin-top: 18px;
            overflow: hidden;
        }

        .carnate-expense-category-page .table-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 22px;
            border-bottom: 1px solid #e2e8f0;
        }

        .carnate-expense-category-page .table-heading {
            margin: 0;
            font-size: 16px;
            font-weight: 700;
            color: #111827;
        }

        .carnate-expense-category-page .table-count {
            display: inline-flex;
            align-items: center;
            padding: 5px 10px;
            border-radius: 20px;
            background: #f1f5f9;
            color: #64748b;
            font-size: 12px;
            font-weight: 600;
        }

        .carnate-expense-category-page .table-wrap {
            overflow-x: auto;
        }

        .carnate-expense-category-page table {
            margin: 0;
            width: 100%;
            min-width: 650px;
            border-collapse: separate;
            border-spacing: 0;
        }

        .carnate-expense-category-page thead th {
            padding: 14px 20px;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            color: #64748b;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
            white-space: nowrap;
        }

        .carnate-expense-category-page tbody td {
            padding: 16px 20px;
            border-bottom: 1px solid #f1f5f9;
            color: #475569;
            font-size: 14px;
            vertical-align: middle;
        }

        .carnate-expense-category-page tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-expense-category-page tbody tr {
            transition: background .15s ease;
        }

        .carnate-expense-category-page tbody tr:hover {
            background: #fafafa;
        }

        .carnate-expense-category-page .serial {
            width: 70px;
            color: #94a3b8;
            font-weight: 600;
        }

        .carnate-expense-category-page .category-name {
            display: flex;
            align-items: center;
            gap: 11px;
            color: #111827;
            font-weight: 600;
        }

        .carnate-expense-category-page .category-icon {
            width: 34px;
            height: 34px;
            flex: 0 0 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 9px;
            background: #f1f5f9;
            color: #475569;
            font-size: 17px;
        }

        .carnate-expense-category-page .date-text {
            color: #64748b;
            white-space: nowrap;
        }

        .carnate-expense-category-page .actions {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .carnate-expense-category-page .action-btn {
            width: 34px;
            height: 34px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #e2e8f0;
            border-radius: 9px;
            background: #fff;
            color: #64748b;
            cursor: pointer;
            transition: all .2s ease;
        }

        .carnate-expense-category-page .action-btn.edit:hover {
            background: #fff5f5;
            border-color: #fecaca;
            color: #e53935;
        }

        .carnate-expense-category-page .action-btn.delete:hover {
            background: #fef2f2;
            border-color: #fecaca;
            color: #dc2626;
        }

        .carnate-expense-category-page .action-btn i {
            font-size: 17px;
        }

        .carnate-expense-category-page .pagination-wrapper {
            padding: 18px 20px;
            border-top: 1px solid #f1f5f9;
        }

        .carnate-expense-category-page .empty-state {
            padding: 55px 20px;
            text-align: center;
        }

        .carnate-expense-category-page .empty-icon {
            width: 56px;
            height: 56px;
            margin: 0 auto 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            background: #f1f5f9;
            color: #94a3b8;
            font-size: 26px;
        }

        .carnate-expense-category-page .empty-title {
            margin: 0;
            color: #334155;
            font-size: 15px;
            font-weight: 600;
        }

        /* Modal */
        .carnate-expense-category-page .carnate-modal {
            position: fixed;
            inset: 0;
            z-index: 1055;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: rgba(15, 23, 42, .48);
            backdrop-filter: blur(3px);
        }

        .carnate-expense-category-page .carnate-modal-dialog {
            width: 100%;
            max-width: 620px;
            margin: 0;
        }

        .carnate-expense-category-page .carnate-modal-content {
            overflow: hidden;
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            background: #fff;
            box-shadow: 0 24px 60px rgba(15, 23, 42, .18);
        }

        .carnate-expense-category-page .modal-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 22px;
            border-bottom: 1px solid #e2e8f0;
        }

        .carnate-expense-category-page .modal-title-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .carnate-expense-category-page .modal-icon {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: #fff5f5;
            color: #e53935;
            font-size: 19px;
        }

        .carnate-expense-category-page .modal-title {
            margin: 0;
            color: #111827;
            font-size: 17px;
            font-weight: 700;
        }

        .carnate-expense-category-page .modal-close {
            width: 34px;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 0;
            border-radius: 9px;
            background: #f1f5f9;
            color: #64748b;
            cursor: pointer;
            transition: all .2s ease;
        }

        .carnate-expense-category-page .modal-close:hover {
            background: #fef2f2;
            color: #dc2626;
        }

        .carnate-expense-category-page .modal-body {
            padding: 22px;
        }

        .carnate-expense-category-page .form-label {
            margin-bottom: 8px;
            color: #334155;
            font-size: 13px;
            font-weight: 600;
        }

        .carnate-expense-category-page .required {
            color: #e53935;
        }

        .carnate-expense-category-page .form-control {
            min-height: 46px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            color: #111827;
            box-shadow: none;
        }

        .carnate-expense-category-page .form-control:focus {
            border-color: #cbd5e1;
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        .carnate-expense-category-page .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            padding: 16px 22px;
            border-top: 1px solid #e2e8f0;
        }

        .carnate-expense-category-page .cancel-btn {
            min-height: 42px;
            padding: 0 17px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            background: #fff;
            color: #475569;
            font-size: 14px;
            font-weight: 600;
        }

        .carnate-expense-category-page .submit-btn {
            min-height: 42px;
            padding: 0 18px;
            border: 0;
            border-radius: 10px;
            background: #e53935;
            color: #fff;
            font-size: 14px;
            font-weight: 600;
        }

        .carnate-expense-category-page .submit-btn:hover {
            background: #c62828;
        }

        .carnate-expense-category-page .submit-btn .spinner-border {
            margin-left: 7px;
            width: 14px;
            height: 14px;
            border-width: 2px;
        }

        @media (max-width: 767px) {
            .carnate-expense-category-page .page-card {
                padding: 18px;
            }

            .carnate-expense-category-page .page-card,
            .carnate-expense-category-page .filter-row {
                flex-wrap: wrap;
            }

            .carnate-expense-category-page .page-card {
                align-items: flex-start !important;
            }

            .carnate-expense-category-page .add-btn {
                width: 100%;
                justify-content: center;
            }

            .carnate-expense-category-page .filter-row {
                display: block;
            }

            .carnate-expense-category-page .search-wrapper {
                width: 100%;
            }

            .carnate-expense-category-page .clear-btn {
                width: 100%;
                margin-top: 10px;
            }

            .carnate-expense-category-page .table-header {
                padding: 16px;
            }

            .carnate-expense-category-page .modal-body {
                padding: 18px;
            }

            .carnate-expense-category-page .modal-head,
            .carnate-expense-category-page .modal-footer {
                padding-left: 18px;
                padding-right: 18px;
            }
        }
    </style>

    {{-- Page Header --}}
    <div class="page-card d-flex justify-content-between align-items-center">
        <div class="page-heading">
            <div class="page-heading-icon">
                <i class="bx bx-category"></i>
            </div>

            <div>
                <h1 class="page-title">Expense Category</h1>
                <p class="page-subtitle">Manage your expense categories</p>
            </div>
        </div>

        {{-- @if (@$sparePart->hasPermissionTo('expense-category-add')) --}}
        <a href="javascript:;" wire:click="create" class="add-btn">
            <i class="bx bx-plus"></i>
            <span>Add Category</span>
        </a>
        {{-- @endif --}}
    </div>

    {{-- Filters --}}
    <div class="filter-card">
        <div class="filter-row">
            <div class="search-wrapper">
                <i class="bx bx-search"></i>
                <input
                    type="text"
                    class="form-control search-input"
                    placeholder="Search Title"
                    wire:model.live="searchfilter"
                >
            </div>

            <button type="button" class="clear-btn" wire:click="resetFilter">
                <i class="bx bx-reset me-1"></i>
                Clear
            </button>
        </div>
    </div>

    {{-- Add / Edit Modal --}}
    @if ($showModal)
        <div class="carnate-modal">
            <div class="carnate-modal-dialog">
                <div class="carnate-modal-content">

                    <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">
                        @csrf

                        <div class="modal-head">
                            <div class="modal-title-wrap">
                                <div class="modal-icon">
                                    <i class="bx {{ $isEdit ? 'bx-edit-alt' : 'bx-plus' }}"></i>
                                </div>

                                <h4 class="modal-title">
                                    {{ $isEdit ? 'Edit Expense Category' : 'Add Expense Category' }}
                                </h4>
                            </div>

                            <button type="button" class="modal-close" wire:click="closeModel">
                                <i class="bx bx-x"></i>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div>
                                <label class="form-label">
                                    Expense Category
                                    <sup class="required">*</sup>
                                </label>

                                <input
                                    type="text"
                                    wire:model="title"
                                    class="form-control"
                                    placeholder="Enter Expense Category"
                                >

                                @error('title')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button
                                type="button"
                                class="cancel-btn"
                                wire:click="closeModel"
                            >
                                Cancel
                            </button>

                            <button type="submit" class="submit-btn">
                                {{ $isEdit ? 'Update' : 'Create' }}
                                <i class="spinner-border spinner-border-sm" wire:loading></i>
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    @endif

    {{-- Categories Table --}}
    <div class="table-card">
        @if (!empty($categories) && $categories->count())

            <div class="table-header">
                <h2 class="table-heading">Expense Categories</h2>

                <span class="table-count">
                    {{ $categories->total() }} Categories
                </span>
            </div>

            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="serial">S.No.</th>
                            <th>Title</th>
                            <th>Date</th>

                            {{-- @if (@$sparePart->hasPermissionTo('expense-category-edit') || @$sparePart->hasPermissionTo('expense-category-delete')) --}}
                            <th>Actions</th>
                            {{-- @endif --}}
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($categories as $index => $category)
                            <tr>
                                <td class="serial">
                                    {{ $categories->firstItem() + $index }}
                                </td>

                                <td>
                                    <div class="category-name">
                                        <span class="category-icon">
                                            <i class="bx bx-receipt"></i>
                                        </span>

                                        <span>{{ $category->title }}</span>
                                    </div>
                                </td>

                                <td>
                                    <span class="date-text">
                                        {{ \Carbon\Carbon::parse($category->created_at)->format('d-m-Y h:i A') }}
                                    </span>
                                </td>

                                {{-- @if (@$sparePart->hasPermissionTo('expense-category-edit') || @$sparePart->hasPermissionTo('expense-category-delete')) --}}
                                <td>
                                    <div class="actions">

                                        {{-- @if (@$sparePart->hasPermissionTo('expense-category-edit')) --}}
                                        <a
                                            wire:click="edit({{ $category->id }})"
                                            class="action-btn edit"
                                            title="Edit"
                                        >
                                            <i class="bx bx-edit-alt"></i>
                                        </a>
                                        {{-- @endif --}}

                                        {{-- @if (@$sparePart->hasPermissionTo('expense-category-delete')) --}}
                                        <a
                                            wire:click="confirmDelete({{ $category->id }})"
                                            class="action-btn delete"
                                            title="Delete"
                                        >
                                            <i class="bx bx-trash"></i>
                                        </a>
                                        {{-- @endif --}}

                                    </div>
                                </td>
                                {{-- @endif --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pagination-wrapper">
                {{ $categories->links() }}
            </div>

        @else

            <div class="empty-state">
                <div class="empty-icon">
                    <i class="bx bx-category"></i>
                </div>

                <p class="empty-title">No Expense Category found!</p>
            </div>

        @endif
    </div>

</div>