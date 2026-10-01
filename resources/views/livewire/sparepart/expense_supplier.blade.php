<div class="carnate-expense-suppliers-page">

    @php
        $sparePart = \App\Models\SparePartVendor::where(
            'id',
            \Illuminate\Support\Facades\Auth::guard('sparepart')->user()->id
        )->first();
    @endphp

    <style>
        .carnate-expense-suppliers-page {
            background: #f7f8fa;
            color: #111827;
        }

        .carnate-expense-suppliers-page .page-card,
        .carnate-expense-suppliers-page .filter-card,
        .carnate-expense-suppliers-page .table-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            box-shadow: 0 4px 18px rgba(15, 23, 42, .04);
        }

        .carnate-expense-suppliers-page .page-card {
            padding: 22px 24px;
        }

        .carnate-expense-suppliers-page .page-heading {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .carnate-expense-suppliers-page .page-icon {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: #fff5f5;
            color: #e53935;
            font-size: 21px;
        }

        .carnate-expense-suppliers-page .page-title {
            margin: 0;
            font-size: 20px;
            font-weight: 700;
            color: #111827;
        }

        .carnate-expense-suppliers-page .page-subtitle {
            margin: 3px 0 0;
            color: #64748b;
            font-size: 13px;
        }

        .carnate-expense-suppliers-page .add-btn {
            min-height: 42px;
            padding: 0 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border: 0;
            border-radius: 10px;
            background: #e53935;
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: all .2s ease;
        }

        .carnate-expense-suppliers-page .add-btn:hover {
            background: #c62828;
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 6px 14px rgba(229, 57, 53, .18);
        }

        .carnate-expense-suppliers-page .add-btn i {
            font-size: 18px;
        }

        .carnate-expense-suppliers-page .filter-card {
            margin-top: 18px;
            padding: 18px 20px;
        }

        .carnate-expense-suppliers-page .filter-row {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .carnate-expense-suppliers-page .search-wrapper {
            position: relative;
            width: 340px;
            max-width: 100%;
        }

        .carnate-expense-suppliers-page .search-wrapper i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 18px;
            pointer-events: none;
        }

        .carnate-expense-suppliers-page .search-input {
            height: 44px;
            padding-left: 42px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            color: #111827;
            background: #fff;
            box-shadow: none;
        }

        .carnate-expense-suppliers-page .search-input:focus {
            border-color: #cbd5e1;
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        .carnate-expense-suppliers-page .clear-btn {
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

        .carnate-expense-suppliers-page .clear-btn:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
            color: #111827;
        }

        /* Table */
        .carnate-expense-suppliers-page .table-card {
            margin-top: 18px;
            overflow: hidden;
        }

        .carnate-expense-suppliers-page .table-header {
            padding: 20px 22px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .carnate-expense-suppliers-page .table-title {
            margin: 0;
            font-size: 16px;
            font-weight: 700;
            color: #111827;
        }

        .carnate-expense-suppliers-page .table-count {
            padding: 5px 10px;
            border-radius: 20px;
            background: #f1f5f9;
            color: #64748b;
            font-size: 12px;
            font-weight: 600;
        }

        .carnate-expense-suppliers-page .table-wrap {
            overflow-x: auto;
        }

        .carnate-expense-suppliers-page table {
            width: 100%;
            min-width: 1000px;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .carnate-expense-suppliers-page thead th {
            padding: 14px 18px;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            color: #64748b;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
            white-space: nowrap;
        }

        .carnate-expense-suppliers-page tbody td {
            padding: 15px 18px;
            border-bottom: 1px solid #f1f5f9;
            color: #475569;
            font-size: 14px;
            vertical-align: middle;
        }

        .carnate-expense-suppliers-page tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-expense-suppliers-page tbody tr {
            transition: background .15s ease;
        }

        .carnate-expense-suppliers-page tbody tr:hover {
            background: #fafafa;
        }

        .carnate-expense-suppliers-page .serial {
            width: 70px;
            color: #94a3b8;
            font-weight: 600;
        }

        .carnate-expense-suppliers-page .company-cell,
        .carnate-expense-suppliers-page .supplier-cell {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 170px;
        }

        .carnate-expense-suppliers-page .avatar {
            width: 36px;
            height: 36px;
            flex: 0 0 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: #f1f5f9;
            color: #475569;
            font-size: 17px;
        }

        .carnate-expense-suppliers-page .company-name,
        .carnate-expense-suppliers-page .supplier-name {
            color: #111827;
            font-weight: 600;
        }

        .carnate-expense-suppliers-page .secondary-text {
            color: #64748b;
        }

        .carnate-expense-suppliers-page .contact-cell {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            white-space: nowrap;
        }

        .carnate-expense-suppliers-page .contact-cell i {
            color: #94a3b8;
            font-size: 16px;
        }

        .carnate-expense-suppliers-page .email-cell {
            color: #475569;
            white-space: nowrap;
        }

        .carnate-expense-suppliers-page .address-cell {
            max-width: 220px;
            color: #64748b;
        }

        .carnate-expense-suppliers-page .gst-badge {
            display: inline-flex;
            align-items: center;
            padding: 5px 9px;
            border-radius: 7px;
            background: #f1f5f9;
            color: #475569;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }

        .carnate-expense-suppliers-page .actions {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .carnate-expense-suppliers-page .action-btn {
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

        .carnate-expense-suppliers-page .action-btn.edit:hover {
            background: #fff5f5;
            border-color: #fecaca;
            color: #e53935;
        }

        .carnate-expense-suppliers-page .action-btn.delete:hover {
            background: #fef2f2;
            border-color: #fecaca;
            color: #dc2626;
        }

        .carnate-expense-suppliers-page .action-btn i {
            font-size: 17px;
        }

        .carnate-expense-suppliers-page .empty-state {
            padding: 55px 20px;
            text-align: center;
        }

        .carnate-expense-suppliers-page .empty-icon {
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

        .carnate-expense-suppliers-page .empty-title {
            margin: 0;
            color: #334155;
            font-size: 15px;
            font-weight: 600;
        }

        .carnate-expense-suppliers-page .pagination-wrapper {
            padding: 18px 20px;
            border-top: 1px solid #f1f5f9;
        }

        /* Modal */
        .carnate-expense-suppliers-page .carnate-modal {
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

        .carnate-expense-suppliers-page .carnate-modal-dialog {
            width: 100%;
            max-width: 760px;
            max-height: calc(100vh - 40px);
            margin: 0;
        }

        .carnate-expense-suppliers-page .carnate-modal-content {
            max-height: calc(100vh - 40px);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            background: #fff;
            box-shadow: 0 24px 60px rgba(15, 23, 42, .18);
        }

        .carnate-expense-suppliers-page .modal-head {
            flex: 0 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 22px;
            border-bottom: 1px solid #e2e8f0;
        }

        .carnate-expense-suppliers-page .modal-title-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .carnate-expense-suppliers-page .modal-icon {
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

        .carnate-expense-suppliers-page .modal-title {
            margin: 0;
            color: #111827;
            font-size: 17px;
            font-weight: 700;
        }

        .carnate-expense-suppliers-page .modal-close {
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

        .carnate-expense-suppliers-page .modal-close:hover {
            background: #fef2f2;
            color: #dc2626;
        }

        .carnate-expense-suppliers-page .modal-body {
            flex: 1 1 auto;
            overflow-y: auto;
            padding: 22px;
        }

        .carnate-expense-suppliers-page .form-section {
            margin-bottom: 24px;
        }

        .carnate-expense-suppliers-page .form-section:last-child {
            margin-bottom: 0;
        }

        .carnate-expense-suppliers-page .section-heading {
            display: flex;
            align-items: center;
            gap: 9px;
            margin: 0 0 16px;
            padding-bottom: 10px;
            border-bottom: 1px solid #e2e8f0;
            color: #334155;
            font-size: 14px;
            font-weight: 700;
        }

        .carnate-expense-suppliers-page .section-heading i {
            color: #e53935;
            font-size: 18px;
        }

        .carnate-expense-suppliers-page .form-label {
            margin-bottom: 7px;
            color: #334155;
            font-size: 13px;
            font-weight: 600;
        }

        .carnate-expense-suppliers-page .required {
            color: #e53935;
        }

        .carnate-expense-suppliers-page .form-control {
            min-height: 45px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            color: #111827;
            box-shadow: none;
        }

        .carnate-expense-suppliers-page .form-control:focus {
            border-color: #cbd5e1;
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        .carnate-expense-suppliers-page .error {
            display: block;
            margin-top: 5px;
            font-size: 12px;
        }

        .carnate-expense-suppliers-page .modal-footer {
            flex: 0 0 auto;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            padding: 16px 22px;
            border-top: 1px solid #e2e8f0;
        }

        .carnate-expense-suppliers-page .cancel-btn {
            min-height: 42px;
            padding: 0 17px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            background: #fff;
            color: #475569;
            font-size: 14px;
            font-weight: 600;
        }

        .carnate-expense-suppliers-page .submit-btn {
            min-height: 42px;
            padding: 0 19px;
            border: 0;
            border-radius: 10px;
            background: #e53935;
            color: #fff;
            font-size: 14px;
            font-weight: 600;
        }

        .carnate-expense-suppliers-page .submit-btn:hover {
            background: #c62828;
        }

        .carnate-expense-suppliers-page .submit-btn .spinner-border {
            margin-left: 7px;
            width: 14px;
            height: 14px;
            border-width: 2px;
        }

        @media (max-width: 767px) {
            .carnate-expense-suppliers-page .page-card {
                padding: 18px;
                align-items: flex-start !important;
                gap: 15px;
            }

            .carnate-expense-suppliers-page .page-card .add-btn {
                width: 100%;
            }

            .carnate-expense-suppliers-page .filter-row {
                display: block;
            }

            .carnate-expense-suppliers-page .search-wrapper {
                width: 100%;
            }

            .carnate-expense-suppliers-page .clear-btn {
                width: 100%;
                margin-top: 10px;
            }

            .carnate-expense-suppliers-page .modal-head,
            .carnate-expense-suppliers-page .modal-body,
            .carnate-expense-suppliers-page .modal-footer {
                padding-left: 18px;
                padding-right: 18px;
            }

            .carnate-expense-suppliers-page .carnate-modal {
                padding: 10px;
            }

            .carnate-expense-suppliers-page .carnate-modal-dialog,
            .carnate-expense-suppliers-page .carnate-modal-content {
                max-height: calc(100vh - 20px);
            }
        }
    </style>

    {{-- Page Header --}}
    <div class="page-card d-flex justify-content-between align-items-center">
        <div class="page-heading">
            <div class="page-icon">
                <i class="bx bx-store-alt"></i>
            </div>

            <div>
                <h1 class="page-title">Expense Suppliers</h1>
                <p class="page-subtitle">Manage suppliers used for business expenses</p>
            </div>
        </div>

        <a href="javascript:;" wire:click="create" class="add-btn">
            <i class="bx bx-plus"></i>
            <span>Add Supplier</span>
        </a>
    </div>

    {{-- Search --}}
    <div class="filter-card">
        <div class="filter-row">
            <div class="search-wrapper">
                <i class="bx bx-search"></i>

                <input
                    type="text"
                    class="form-control search-input"
                    placeholder="Search Business Name"
                    wire:model.live="search"
                >
            </div>

            <button type="button" class="clear-btn" wire:click="clearSearch">
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

                        <div class="modal-head">
                            <div class="modal-title-wrap">
                                <div class="modal-icon">
                                    <i class="bx {{ $isEdit ? 'bx-edit-alt' : 'bx-store-alt' }}"></i>
                                </div>

                                <h4 class="modal-title">
                                    {{ $isEdit ? 'Edit Supplier' : 'Add Supplier' }}
                                </h4>
                            </div>

                            <button
                                type="button"
                                class="modal-close"
                                wire:click="closeModal"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                            >
                                <i class="bx bx-x"></i>
                            </button>
                        </div>

                        <div class="modal-body">

                            {{-- Contact Information --}}
                            <div class="form-section">
                                <h5 class="section-heading">
                                    <i class="bx bx-phone"></i>
                                    Contact Information
                                </h5>

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">
                                            Mobile No.
                                            <span class="required">*</span>
                                        </label>

                                        <input
                                            type="text"
                                            wire:model.lazy="mobile_no"
                                            class="form-control"
                                            placeholder="Enter Mobile No."
                                        >

                                        @error('mobile_no')
                                            <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Business Information --}}
                            <div class="form-section">
                                <h5 class="section-heading">
                                    <i class="bx bx-buildings"></i>
                                    Business Information
                                </h5>

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">
                                            Company Name
                                            <span class="required">*</span>
                                        </label>

                                        <input
                                            type="text"
                                            wire:model="business_first_name"
                                            class="form-control"
                                            placeholder="Enter Company Name"
                                        >

                                        @error('business_first_name')
                                            <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">GSTIN</label>

                                        <input
                                            type="text"
                                            wire:model="gstin"
                                            class="form-control"
                                            placeholder="Enter GSTIN"
                                        >

                                        @error('gstin')
                                            <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label">Address</label>

                                        <input
                                            type="text"
                                            wire:model="business_address"
                                            class="form-control"
                                            placeholder="Enter Address"
                                        >

                                        @error('business_address')
                                            <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Owner Information --}}
                            <div class="form-section">
                                <h5 class="section-heading">
                                    <i class="bx bx-user"></i>
                                    Owner Information
                                </h5>

                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label">
                                            First Name
                                            <span class="required">*</span>
                                        </label>

                                        <input
                                            type="text"
                                            wire:model="owner_first_name"
                                            class="form-control"
                                            placeholder="Enter First Name"
                                        >

                                        @error('owner_first_name')
                                            <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">
                                            Contact 1
                                            <span class="required">*</span>
                                        </label>

                                        <input
                                            type="text"
                                            wire:model="contact_1"
                                            class="form-control"
                                            placeholder="Enter Contact 1"
                                        >

                                        @error('contact_1')
                                            <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Contact 2</label>

                                        <input
                                            type="text"
                                            wire:model="contact_2"
                                            class="form-control"
                                            placeholder="Enter Contact 2"
                                        >

                                        @error('contact_2')
                                            <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Email</label>

                                        <input
                                            type="email"
                                            wire:model="email"
                                            class="form-control"
                                            placeholder="Enter Email"
                                        >

                                        @error('email')
                                            <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button
                                type="button"
                                class="cancel-btn"
                                wire:click="closeModal"
                                data-bs-dismiss="modal"
                            >
                                Cancel
                            </button>

                            <button type="submit" class="submit-btn">
                                {{ $isEdit ? 'Update' : 'Save' }}
                                <i class="spinner-border spinner-border-sm" wire:loading></i>
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    @endif

    {{-- Supplier Table --}}
    <div class="table-card">

        <div class="table-header">
            <h2 class="table-title">Expense Suppliers</h2>

            <span class="table-count">
                {{ $suppliers->total() }} Suppliers
            </span>
        </div>

        <div class="table-wrap">
            <table class="table">
                <thead>
                    <tr>
                        <th class="serial">Sr No.</th>
                        <th>Company Name</th>
                        <th>Supplier Name</th>
                        <th>Contact No.</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>GSTIN</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($suppliers as $supplier)
                        <tr>
                            <td class="serial">
                                {{ $loop->iteration + ($suppliers->firstItem() - 1) }}
                            </td>

                            <td>
                                <div class="company-cell">
                                    <span class="avatar">
                                        <i class="bx bx-buildings"></i>
                                    </span>

                                    <span class="company-name">
                                        {{ $supplier->business_first_name }}
                                    </span>
                                </div>
                            </td>

                            <td>
                                <div class="supplier-cell">
                                    <span class="avatar">
                                        <i class="bx bx-user"></i>
                                    </span>

                                    <span class="supplier-name">
                                        {{ $supplier->owner_first_name }}
                                    </span>
                                </div>
                            </td>

                            <td>
                                <span class="contact-cell">
                                    <i class="bx bx-phone"></i>
                                    {{ $supplier->mobile_no }}
                                </span>
                            </td>

                            <td>
                                <span class="email-cell">
                                    {{ $supplier->email }}
                                </span>
                            </td>

                            <td>
                                <span class="address-cell">
                                    {{ $supplier->business_address }}
                                </span>
                            </td>

                            <td>
                                @if ($supplier->gstin)
                                    <span class="gst-badge">
                                        {{ $supplier->gstin }}
                                    </span>
                                @else
                                    <span class="secondary-text">—</span>
                                @endif
                            </td>

                            <td>
                                <div class="actions">
                                    <button
                                        type="button"
                                        class="action-btn edit"
                                        wire:click="edit({{ $supplier->id }})"
                                        title="Edit"
                                    >
                                        <i class="bx bx-edit-alt"></i>
                                    </button>

                                    <button
                                        type="button"
                                        class="action-btn delete"
                                        wire:click="confirmDelete({{ $supplier->id }})"
                                        title="Delete"
                                    >
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    @if ($suppliers->isEmpty())
                        <tr>
                            <td colspan="8">
                                <div class="empty-state">
                                    <div class="empty-icon">
                                        <i class="bx bx-store-alt"></i>
                                    </div>

                                    <p class="empty-title">No suppliers found.</p>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <div class="pagination-wrapper">
            {{ $suppliers->links() }}
        </div>

    </div>

</div>