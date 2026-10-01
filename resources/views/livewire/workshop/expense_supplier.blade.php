<div class="carnate-expense-supplier-page">

    @php
        $user = App\Models\WorkShopVendor::where(
            'id',
            Auth::guard('workshop')->user()->id
        )->first();
    @endphp

    <style>
        .carnate-expense-supplier-page {
            --es-red: #e53935;
            --es-red-dark: #c62828;
            --es-red-soft: #fff5f5;
            --es-text: #111827;
            --es-muted: #64748b;
            --es-border: #e2e8f0;
            --es-card: #ffffff;
            --es-bg: #f7f8fa;
            --es-shadow: 0 4px 20px rgba(15, 23, 42, .05);
        }

        .carnate-expense-supplier-page {
            color: var(--es-text);
        }

        /* =========================
           PAGE HEADER
        ========================== */

        .carnate-expense-supplier-page .es-header {
            background: var(--es-card);
            border: 1px solid var(--es-border);
            border-radius: 14px;
            box-shadow: var(--es-shadow);
            margin-bottom: 18px;
        }

        .carnate-expense-supplier-page .es-header-body {
            min-height: 78px;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .carnate-expense-supplier-page .es-title {
            margin: 0;
            color: var(--es-text);
            font-size: 21px;
            font-weight: 700;
        }

        .carnate-expense-supplier-page .es-subtitle {
            margin: 5px 0 0;
            color: var(--es-muted);
            font-size: 12px;
        }

        /* =========================
           ADD BUTTON
        ========================== */

        .carnate-expense-supplier-page .es-add-btn {
            min-height: 40px;
            padding: 9px 16px;
            border: 1px solid var(--es-red);
            border-radius: 9px;
            background: var(--es-red);
            color: #fff;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: all .18s ease;
        }

        .carnate-expense-supplier-page .es-add-btn:hover {
            background: var(--es-red-dark);
            border-color: var(--es-red-dark);
            color: #fff;
            transform: translateY(-1px);
        }

        /* =========================
           FILTER
        ========================== */

        .carnate-expense-supplier-page .es-filter-card {
            background: var(--es-card);
            border: 1px solid var(--es-border);
            border-radius: 14px;
            box-shadow: var(--es-shadow);
            margin-bottom: 18px;
        }

        .carnate-expense-supplier-page .es-filter-body {
            padding: 16px 18px;
        }

        .carnate-expense-supplier-page .es-filter-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .carnate-expense-supplier-page .es-search {
            width: 340px;
            max-width: 100%;
            position: relative;
        }

        .carnate-expense-supplier-page .es-search-icon {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            z-index: 2;
        }

        .carnate-expense-supplier-page .form-control {
            min-height: 42px;
            border: 1px solid var(--es-border);
            border-radius: 9px;
            color: var(--es-text);
            background: #fff;
            box-shadow: none;
        }

        .carnate-expense-supplier-page .form-control:focus {
            border-color: rgba(229, 57, 53, .55);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        .carnate-expense-supplier-page .es-clear-btn {
            min-height: 40px;
            padding: 9px 15px;
            border: 1px solid var(--es-border);
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

        .carnate-expense-supplier-page .es-clear-btn:hover {
            background: #f8fafc;
            color: var(--es-text);
        }

        /* =========================
           TABLE
        ========================== */

        .carnate-expense-supplier-page .es-table-card {
            background: var(--es-card);
            border: 1px solid var(--es-border);
            border-radius: 14px;
            box-shadow: var(--es-shadow);
            overflow: hidden;
        }

        .carnate-expense-supplier-page .es-table-wrap {
            overflow-x: auto;
        }

        .carnate-expense-supplier-page .es-table {
            width: 100%;
            min-width: 1050px;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .carnate-expense-supplier-page .es-table thead th {
            padding: 13px 15px;
            background: #f8fafc;
            border-bottom: 1px solid var(--es-border);
            color: #475569;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .4px;
            white-space: nowrap;
        }

        .carnate-expense-supplier-page .es-table tbody td {
            padding: 14px 15px;
            border-bottom: 1px solid #eef2f7;
            color: #334155;
            font-size: 13px;
            vertical-align: middle;
        }

        .carnate-expense-supplier-page .es-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-expense-supplier-page .es-table tbody tr:hover {
            background: #fafbfc;
        }

        .carnate-expense-supplier-page .es-index {
            width: 65px;
            color: #94a3b8 !important;
            font-weight: 600;
        }

        .carnate-expense-supplier-page .es-company {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--es-text);
            font-weight: 700;
            white-space: nowrap;
        }

        .carnate-expense-supplier-page .es-avatar {
            width: 34px;
            height: 34px;
            flex: 0 0 34px;
            border-radius: 9px;
            background: var(--es-red-soft);
            color: var(--es-red);
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .carnate-expense-supplier-page .es-owner {
            color: #334155;
            font-weight: 600;
            white-space: nowrap;
        }

        .carnate-expense-supplier-page .es-contact {
            color: #475569;
            white-space: nowrap;
        }

        .carnate-expense-supplier-page .es-email {
            color: #475569;
            white-space: nowrap;
        }

        .carnate-expense-supplier-page .es-address {
            max-width: 230px;
            color: var(--es-muted);
            white-space: normal;
            line-height: 1.5;
        }

        .carnate-expense-supplier-page .es-gstin {
            display: inline-flex;
            padding: 5px 8px;
            border-radius: 7px;
            background: #f8fafc;
            border: 1px solid #e8edf3;
            color: #475569;
            font-size: 11px;
            font-weight: 600;
            white-space: nowrap;
        }

        .carnate-expense-supplier-page .es-actions {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .carnate-expense-supplier-page .es-action-btn {
            width: 34px;
            height: 34px;
            padding: 0;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid transparent;
            cursor: pointer;
            transition: all .18s ease;
        }

        .carnate-expense-supplier-page .es-edit {
            background: #eff6ff;
            border-color: #dbeafe;
            color: #2563eb;
        }

        .carnate-expense-supplier-page .es-edit:hover {
            background: #dbeafe;
            transform: translateY(-1px);
        }

        .carnate-expense-supplier-page .es-delete {
            background: var(--es-red-soft);
            border-color: #fee2e2;
            color: #dc2626;
        }

        .carnate-expense-supplier-page .es-delete:hover {
            background: #fee2e2;
            transform: translateY(-1px);
        }

        /* =========================
           EMPTY
        ========================== */

        .carnate-expense-supplier-page .es-empty {
            padding: 55px 20px;
            text-align: center;
        }

        .carnate-expense-supplier-page .es-empty-icon {
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

        .carnate-expense-supplier-page .es-empty-title {
            color: var(--es-text);
            font-size: 14px;
            font-weight: 700;
        }

        .carnate-expense-supplier-page .es-empty-text {
            margin-top: 4px;
            color: var(--es-muted);
            font-size: 12px;
        }

        /* =========================
           MODAL
        ========================== */

        .carnate-expense-supplier-page .es-modal {
            position: fixed;
            inset: 0;
            z-index: 1055;
            background: rgba(6, 6, 6, .55);
            overflow-y: auto;
            padding: 30px 15px;
        }

        .carnate-expense-supplier-page .es-modal-dialog {
            width: 100%;
            max-width: 850px;
            margin: 0 auto;
        }

        .carnate-expense-supplier-page .es-modal-content {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 25px 70px rgba(15, 23, 42, .18);
        }

        .carnate-expense-supplier-page .es-modal-header {
            padding: 18px 22px;
            border-bottom: 1px solid var(--es-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .carnate-expense-supplier-page .es-modal-title {
            margin: 0;
            color: var(--es-text);
            font-size: 18px;
            font-weight: 700;
        }

        .carnate-expense-supplier-page .es-modal-title i {
            color: var(--es-red);
            margin-right: 7px;
        }

        .carnate-expense-supplier-page .es-close {
            width: 34px;
            height: 34px;
            padding: 0;
            border: 1px solid var(--es-border);
            border-radius: 8px;
            background: #fff;
            color: #64748b;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all .18s ease;
        }

        .carnate-expense-supplier-page .es-close:hover {
            background: var(--es-red-soft);
            border-color: #fecaca;
            color: var(--es-red);
        }

        .carnate-expense-supplier-page .es-modal-body {
            padding: 22px;
        }

        .carnate-expense-supplier-page .es-section {
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid var(--es-border);
        }

        .carnate-expense-supplier-page .es-section:first-child {
            margin-top: 0;
            padding-top: 0;
            border-top: 0;
        }

        .carnate-expense-supplier-page .es-section-title {
            margin: 0 0 15px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--es-text);
            font-size: 14px;
            font-weight: 700;
        }

        .carnate-expense-supplier-page .es-section-title i {
            color: var(--es-red);
            font-size: 18px;
        }

        .carnate-expense-supplier-page .es-label {
            display: block;
            margin-bottom: 7px;
            color: #475569;
            font-size: 12px;
            font-weight: 700;
        }

        .carnate-expense-supplier-page .es-required {
            color: var(--es-red);
        }

        .carnate-expense-supplier-page .es-error {
            display: block;
            margin-top: 5px;
            color: #dc2626;
            font-size: 11px;
        }

        .carnate-expense-supplier-page .es-modal-footer {
            padding: 15px 22px;
            border-top: 1px solid var(--es-border);
            background: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 9px;
        }

        .carnate-expense-supplier-page .es-cancel {
            min-height: 40px;
            padding: 9px 16px;
            border: 1px solid var(--es-border);
            border-radius: 9px;
            background: #fff;
            color: #475569;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
        }

        .carnate-expense-supplier-page .es-submit {
            min-height: 40px;
            padding: 9px 17px;
            border: 1px solid var(--es-red);
            border-radius: 9px;
            background: var(--es-red);
            color: #fff;
            font-size: 13px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            cursor: pointer;
        }

        .carnate-expense-supplier-page .es-submit:hover {
            background: var(--es-red-dark);
            border-color: var(--es-red-dark);
        }

        .carnate-expense-supplier-page .es-spinner {
            width: 14px;
            height: 14px;
            border-width: 2px;
        }

        /* =========================
           RESPONSIVE
        ========================== */

        @media (max-width: 767px) {
            .carnate-expense-supplier-page .es-header-body {
                align-items: flex-start;
                flex-direction: column;
            }

            .carnate-expense-supplier-page .es-filter-row {
                align-items: stretch;
                flex-direction: column;
            }

            .carnate-expense-supplier-page .es-search {
                width: 100%;
            }

            .carnate-expense-supplier-page .es-modal {
                padding: 15px 10px;
            }

            .carnate-expense-supplier-page .es-modal-body {
                padding: 17px;
            }
        }
    </style>


    {{-- ============================================================
        PAGE HEADER
    ============================================================= --}}

    <div class="es-header">

        <div class="es-header-body">

            <div>

                <h4 class="es-title">
                    Expense Suppliers
                </h4>

                <p class="es-subtitle">
                    Manage suppliers used for workshop expenses
                </p>

            </div>

            <div>

                {{-- ORIGINAL PERMISSION COMMENT PRESERVED --}}
                {{-- @if (@$user->hasPermissionTo('expense-supplier-add')) --}}

                <a
                    href="javascript:;"
                    wire:click="openModal"
                    class="es-add-btn">

                    <i class="bx bxs-plus-square"></i>

                    Add

                </a>

                {{-- @endif --}}

            </div>

        </div>

    </div>


    {{-- ============================================================
        SEARCH
    ============================================================= --}}

    <div class="es-filter-card">

        <div class="es-filter-body">

            <div class="es-filter-row">

                <div class="es-search">

                    <i class="bx bx-search es-search-icon"></i>

                    <input
                        type="text"
                        class="form-control"
                        style="padding-left:38px;"
                        placeholder="Search Business Name"
                        wire:model.live="search">

                </div>

                <button
                    type="button"
                    class="es-clear-btn"
                    wire:click="clearSearch">

                    <i class="bx bx-reset"></i>

                    Clear

                </button>

            </div>

        </div>

    </div>


    {{-- ============================================================
        ADD / EDIT SUPPLIER MODAL
        LIVEWIRE ACTIONS PRESERVED
    ============================================================= --}}

    <div
        class="es-modal"
        tabindex="-1"
        style="
            opacity:1;
            @if ($showModal)
                display:block;
            @else
                display:none;
            @endif
        ">

        <div class="es-modal-dialog">

            <div class="es-modal-content">

                <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">

                    {{-- Modal Header --}}

                    <div class="es-modal-header">

                        <h4 class="es-modal-title">

                            <i class="bx bx-store"></i>

                            {{ $isEdit ? 'Edit Supplier' : 'Add Supplier' }}

                        </h4>

                        <button
                            type="button"
                            class="es-close"
                            wire:click="closeModal"
                            data-bs-dismiss="modal"
                            aria-label="Close">

                            <i class="bx bx-x"></i>

                        </button>

                    </div>


                    {{-- Modal Body --}}

                    <div class="es-modal-body">

                        {{-- CONTACT INFO --}}

                        <div class="es-section">

                            <h5 class="es-section-title">

                                <i class="bx bx-phone"></i>

                                Contact Information

                            </h5>

                            <div class="row g-3">

                                <div class="col-md-6">

                                    <label class="es-label">

                                        Mobile No.

                                        <span class="es-required">*</span>

                                    </label>

                                    <input
                                        type="text"
                                        wire:model.lazy="mobile_no"
                                        class="form-control"
                                        placeholder="Enter Mobile No.">

                                    @error('mobile_no')
                                        <span class="es-error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>

                            </div>

                        </div>


                        {{-- BUSINESS INFO --}}

                        <div class="es-section">

                            <h5 class="es-section-title">

                                <i class="bx bx-buildings"></i>

                                Business Info

                            </h5>

                            <div class="row g-3">

                                <div class="col-md-6">

                                    <label class="es-label">

                                        Company Name

                                        <span class="es-required">*</span>

                                    </label>

                                    <input
                                        type="text"
                                        wire:model="business_first_name"
                                        class="form-control"
                                        placeholder="Enter Company Name">

                                    @error('business_first_name')
                                        <span class="es-error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>


                                <div class="col-md-6">

                                    <label class="es-label">
                                        GSTIN
                                    </label>

                                    <input
                                        type="text"
                                        wire:model="gstin"
                                        class="form-control"
                                        placeholder="Enter GSTIN">

                                    @error('gstin')
                                        <span class="es-error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>


                                <div class="col-md-12">

                                    <label class="es-label">
                                        Address
                                    </label>

                                    <input
                                        type="text"
                                        wire:model="business_address"
                                        class="form-control"
                                        placeholder="Enter Address">

                                    @error('business_address')
                                        <span class="es-error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>

                            </div>

                        </div>


                        {{-- OWNER INFO --}}

                        <div class="es-section">

                            <h5 class="es-section-title">

                                <i class="bx bx-user"></i>

                                Owner Info

                            </h5>

                            <div class="row g-3">

                                <div class="col-md-4">

                                    <label class="es-label">

                                        First Name

                                        <span class="es-required">*</span>

                                    </label>

                                    <input
                                        type="text"
                                        wire:model="owner_first_name"
                                        class="form-control"
                                        placeholder="Enter First Name">

                                    @error('owner_first_name')
                                        <span class="es-error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>


                                <div class="col-md-4">

                                    <label class="es-label">

                                        Contact 1

                                        <span class="es-required">*</span>

                                    </label>

                                    <input
                                        type="text"
                                        wire:model="contact_1"
                                        class="form-control"
                                        placeholder="Enter Contact 1">

                                    @error('contact_1')
                                        <span class="es-error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>


                                <div class="col-md-4">

                                    <label class="es-label">
                                        Contact 2
                                    </label>

                                    <input
                                        type="text"
                                        wire:model="contact_2"
                                        class="form-control"
                                        placeholder="Enter Contact 2">

                                    @error('contact_2')
                                        <span class="es-error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>


                                <div class="col-md-6">

                                    <label class="es-label">
                                        Email
                                    </label>

                                    <input
                                        type="email"
                                        wire:model="email"
                                        class="form-control"
                                        placeholder="Enter Email">

                                    @error('email')
                                        <span class="es-error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- Modal Footer --}}

                    <div class="es-modal-footer">

                        <button
                            type="button"
                            class="es-cancel"
                            wire:click="closeModal"
                            data-bs-dismiss="modal">

                            Cancel

                        </button>

                        <button
                            type="submit"
                            class="es-submit">

                            {{ $isEdit ? 'Update' : 'Save' }}

                            <i
                                class="spinner-border spinner-border-sm es-spinner"
                                wire:loading>
                            </i>

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    {{-- ============================================================
        SUPPLIER TABLE
    ============================================================= --}}

    <div class="es-table-card">

        <div class="es-table-wrap">

            <table class="es-table data-table">

                <thead>

                    <tr>

                        <th>
                            Sr No.
                        </th>

                        <th>
                            Company Name
                        </th>

                        <th>
                            Supplier Name
                        </th>

                        <th>
                            Contact No.
                        </th>

                        <th>
                            Email
                        </th>

                        <th>
                            Address
                        </th>

                        <th>
                            GSTIN
                        </th>

                        <th>
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @foreach ($suppliers as $supplier)

                        <tr>

                            <td class="es-index">

                                {{ $loop->iteration + ($suppliers->firstItem() - 1) }}

                            </td>


                            <td>

                                <div class="es-company">

                                    <span class="es-avatar">

                                        <i class="bx bx-buildings"></i>

                                    </span>

                                    <span>
                                        {{ $supplier->business_first_name }}
                                    </span>

                                </div>

                            </td>


                            <td class="es-owner">

                                {{ $supplier->owner_first_name }}

                            </td>


                            <td class="es-contact">

                                {{ $supplier->mobile_no }}

                            </td>


                            <td class="es-email">

                                {{ $supplier->email }}

                            </td>


                            <td class="es-address">

                                {{ $supplier->business_address }}

                            </td>


                            <td>

                                @if($supplier->gstin)

                                    <span class="es-gstin">

                                        {{ $supplier->gstin }}

                                    </span>

                                @else

                                    <span style="color:#94a3b8;">
                                        —
                                    </span>

                                @endif

                            </td>


                            <td>

                                <div class="es-actions">

                                    {{-- ORIGINAL EDIT ACTION PRESERVED --}}

                                    <button
                                        type="button"
                                        class="es-action-btn es-edit"
                                        wire:click="edit({{ $supplier->id }})"
                                        title="Edit">

                                        <i class="bx bxs-edit"></i>

                                    </button>


                                    {{-- ORIGINAL DELETE ACTION PRESERVED --}}

                                    <button
                                        type="button"
                                        class="es-action-btn es-delete"
                                        wire:click="confirmDelete({{ $supplier->id }})"
                                        title="Delete">

                                        <i class="bx bxs-trash"></i>

                                    </button>

                                </div>

                            </td>

                        </tr>

                    @endforeach


                    @if ($suppliers->isEmpty())

                        <tr>

                            <td
                                colspan="8"
                                class="text-center">

                                <div class="es-empty">

                                    <div class="es-empty-icon">

                                        <i class="bx bx-store"></i>

                                    </div>

                                    <div class="es-empty-title">

                                        No suppliers found.

                                    </div>

                                    <div class="es-empty-text">

                                        Suppliers you add will appear here.

                                    </div>

                                </div>

                            </td>

                        </tr>

                    @endif

                </tbody>

            </table>

        </div>

    </div>


    {{-- ============================================================
        PAGINATION
    ============================================================= --}}

    <div class="mt-3">

        {{ $suppliers->links() }}

    </div>

</div>