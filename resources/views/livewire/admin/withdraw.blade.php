<div class="carnate-withdraw-page">

    <style>
        .carnate-withdraw-page {
            --cw-bg: #f7f8fa;
            --cw-card: #ffffff;
            --cw-text: #111827;
            --cw-muted: #64748b;
            --cw-border: #e2e8f0;
            --cw-soft: #f1f5f9;
            --cw-red: #e53935;
            --cw-red-soft: #fff5f5;
            --cw-green: #16a34a;
            --cw-green-soft: #f0fdf4;
            --cw-orange: #d97706;
            --cw-orange-soft: #fffbeb;
            --cw-blue: #2563eb;
            --cw-blue-soft: #eff6ff;
            background: var(--cw-bg);
            color: var(--cw-text);
        }

        .carnate-withdraw-page .cw-alert {
            border: 1px solid #bbf7d0;
            background: var(--cw-green-soft);
            color: #166534;
            border-radius: 12px;
            padding: 12px 16px;
            margin-bottom: 18px;
            font-size: 14px;
        }

        .carnate-withdraw-page .cw-card {
            background: var(--cw-card);
            border: 1px solid var(--cw-border);
            border-radius: 16px;
            box-shadow: 0 4px 18px rgba(15, 23, 42, 0.04);
        }

        .carnate-withdraw-page .cw-header {
            padding: 20px 22px;
        }

        .carnate-withdraw-page .cw-page-title {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 21px;
            font-weight: 700;
            color: var(--cw-text);
        }

        .carnate-withdraw-page .cw-page-title-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--cw-red-soft);
            color: var(--cw-red);
            font-size: 18px;
        }

        .carnate-withdraw-page .cw-summary {
            display: flex;
            align-items: stretch;
            gap: 12px;
            flex-wrap: wrap;
        }

        .carnate-withdraw-page .cw-summary-item {
            min-width: 175px;
            padding: 11px 14px;
            border: 1px solid var(--cw-border);
            border-radius: 12px;
            background: #fff;
        }

        .carnate-withdraw-page .cw-summary-label {
            display: block;
            color: var(--cw-muted);
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .carnate-withdraw-page .cw-summary-value {
            display: block;
            color: var(--cw-text);
            font-size: 15px;
            font-weight: 700;
        }

        .carnate-withdraw-page .cw-filter-card {
            margin-top: 18px;
            padding: 18px 20px;
        }

        .carnate-withdraw-page .cw-filter-card .form-control,
        .carnate-withdraw-page .cw-modal .form-control {
            height: 44px;
            border: 1px solid var(--cw-border);
            border-radius: 10px;
            box-shadow: none;
            color: var(--cw-text);
            background: #fff;
        }

        .carnate-withdraw-page .cw-filter-card .form-control:focus,
        .carnate-withdraw-page .cw-modal .form-control:focus {
            border-color: rgba(229, 57, 53, 0.45);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, 0.08);
        }

        .carnate-withdraw-page .cw-tabs {
            display: inline-flex;
            gap: 5px;
            padding: 4px;
            background: var(--cw-soft);
            border-radius: 11px;
            border: 1px solid var(--cw-border);
        }

        .carnate-withdraw-page .cw-tabs .nav-link {
            border: 0 !important;
            border-radius: 8px;
            padding: 9px 15px;
            color: var(--cw-muted);
            background: transparent;
            font-size: 13px;
            font-weight: 600;
            white-space: nowrap;
        }

        .carnate-withdraw-page .cw-tabs .nav-link:hover {
            color: var(--cw-text);
            background: #fff;
        }

        .carnate-withdraw-page .cw-tabs .nav-link.active {
            color: var(--cw-red);
            background: #fff;
            box-shadow: 0 2px 8px rgba(15, 23, 42, 0.07);
        }

        .carnate-withdraw-page .cw-clear-btn {
            height: 42px;
            padding: 0 18px;
            border: 1px solid var(--cw-border);
            border-radius: 10px !important;
            background: #fff;
            color: var(--cw-muted);
            font-size: 13px;
            font-weight: 600;
            transition: all .2s ease;
        }

        .carnate-withdraw-page .cw-clear-btn:hover {
            color: var(--cw-red);
            border-color: rgba(229, 57, 53, 0.25);
            background: var(--cw-red-soft);
        }

        .carnate-withdraw-page .cw-tab-content {
            margin-top: 18px;
        }

        .carnate-withdraw-page .cw-table-card {
            overflow: hidden;
        }

        .carnate-withdraw-page .cw-table-wrap {
            overflow-x: auto;
        }

        .carnate-withdraw-page .cw-table {
            width: 100%;
            min-width: 950px;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .carnate-withdraw-page .cw-table thead th {
            padding: 14px 16px;
            background: #f8fafc;
            color: #475569;
            border-bottom: 1px solid var(--cw-border);
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
            text-transform: uppercase;
            letter-spacing: .025em;
        }

        .carnate-withdraw-page .cw-table tbody td {
            padding: 15px 16px;
            color: var(--cw-text);
            border-bottom: 1px solid #eef2f7;
            font-size: 13px;
            vertical-align: middle;
        }

        .carnate-withdraw-page .cw-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-withdraw-page .cw-table tbody tr:hover {
            background: #fafafa;
        }

        .carnate-withdraw-page .cw-sno {
            color: var(--cw-muted);
            font-weight: 600;
        }

        .carnate-withdraw-page .cw-user {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 170px;
        }

        .carnate-withdraw-page .cw-user-avatar {
            width: 36px;
            height: 36px;
            flex: 0 0 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: var(--cw-red-soft);
            color: var(--cw-red);
            font-size: 14px;
        }

        .carnate-withdraw-page .cw-user-name {
            font-weight: 600;
            color: var(--cw-text);
        }

        .carnate-withdraw-page .cw-amount {
            font-weight: 700;
            white-space: nowrap;
        }

        .carnate-withdraw-page .cw-muted {
            color: var(--cw-muted);
        }

        .carnate-withdraw-page .cw-transaction {
            color: #475569;
            font-family: monospace;
            font-size: 12px;
            white-space: nowrap;
        }

        .carnate-withdraw-page .cw-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .carnate-withdraw-page .cw-status.processing {
            color: var(--cw-orange);
            background: var(--cw-orange-soft);
        }

        .carnate-withdraw-page .cw-status.complete {
            color: #15803d;
            background: var(--cw-green-soft);
        }

        .carnate-withdraw-page .cw-status.declined {
            color: #dc2626;
            background: var(--cw-red-soft);
        }

        .carnate-withdraw-page .cw-actions {
            display: flex;
            align-items: center;
            gap: 7px;
            white-space: nowrap;
        }

        .carnate-withdraw-page .cw-action-btn {
            border: 0;
            border-radius: 8px;
            padding: 7px 11px;
            font-size: 12px;
            font-weight: 700;
            transition: all .2s ease;
        }

        .carnate-withdraw-page .cw-approve {
            color: #15803d;
            background: var(--cw-green-soft);
        }

        .carnate-withdraw-page .cw-approve:hover {
            background: #dcfce7;
        }

        .carnate-withdraw-page .cw-decline {
            color: #dc2626;
            background: var(--cw-red-soft);
        }

        .carnate-withdraw-page .cw-decline:hover {
            background: #fee2e2;
        }

        .carnate-withdraw-page .cw-view-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: 1px solid var(--cw-border);
            border-radius: 9px;
            padding: 8px 12px;
            background: #fff;
            color: #475569;
            font-size: 12px;
            font-weight: 700;
            transition: all .2s ease;
        }

        .carnate-withdraw-page .cw-view-btn:hover {
            color: var(--cw-red);
            border-color: rgba(229, 57, 53, 0.25);
            background: var(--cw-red-soft);
        }

        .carnate-withdraw-page .cw-pagination {
            padding: 16px 18px;
            border-top: 1px solid var(--cw-border);
        }

        .carnate-withdraw-page .cw-empty {
            padding: 42px 20px;
            text-align: center;
            color: var(--cw-muted);
        }

        .carnate-withdraw-page .cw-empty-icon {
            width: 52px;
            height: 52px;
            margin: 0 auto 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            background: var(--cw-soft);
            color: #94a3b8;
            font-size: 21px;
        }

        .carnate-withdraw-page .cw-empty-title {
            font-size: 14px;
            font-weight: 700;
            color: #475569;
        }

        .carnate-withdraw-page .cw-empty-text {
            margin-top: 4px;
            font-size: 12px;
            color: var(--cw-muted);
        }

        .carnate-withdraw-page .cw-section-title {
            display: flex;
            align-items: center;
            gap: 9px;
            margin-bottom: 14px;
            color: var(--cw-text);
            font-size: 14px;
            font-weight: 700;
        }

        .carnate-withdraw-page .cw-section-title i {
            width: 30px;
            height: 30px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background: var(--cw-soft);
            color: #475569;
        }

        .carnate-withdraw-page .cw-modal {
            position: fixed;
            inset: 0;
            z-index: 1055;
            overflow-x: hidden;
            overflow-y: auto;
        }

        .carnate-withdraw-page .cw-modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.58);
            backdrop-filter: blur(2px);
        }

        .carnate-withdraw-page .cw-modal-dialog {
            position: relative;
            z-index: 2;
            margin: 60px auto;
            padding: 0 15px;
        }

        .carnate-withdraw-page .cw-modal-md {
            max-width: 560px;
        }

        .carnate-withdraw-page .cw-modal-xl {
            max-width: 1180px;
        }

        .carnate-withdraw-page .cw-modal-content {
            position: relative;
            background: #fff;
            border: 1px solid var(--cw-border);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 24px 70px rgba(15, 23, 42, 0.22);
        }

        .carnate-withdraw-page .cw-modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 22px;
            border-bottom: 1px solid var(--cw-border);
        }

        .carnate-withdraw-page .cw-modal-title {
            margin: 0;
            color: var(--cw-text);
            font-size: 17px;
            font-weight: 700;
        }

        .carnate-withdraw-page .cw-close {
            width: 34px;
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 0;
            border-radius: 9px;
            background: var(--cw-soft);
            color: #64748b;
            opacity: 1;
        }

        .carnate-withdraw-page .cw-close:hover {
            color: var(--cw-red);
            background: var(--cw-red-soft);
        }

        .carnate-withdraw-page .cw-modal-body {
            padding: 22px;
        }

        .carnate-withdraw-page .cw-modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 9px;
            padding: 15px 22px;
            border-top: 1px solid var(--cw-border);
            background: #fafafa;
        }

        .carnate-withdraw-page .cw-label {
            display: block;
            margin-bottom: 7px;
            color: #334155;
            font-size: 13px;
            font-weight: 700;
        }

        .carnate-withdraw-page .cw-required {
            color: var(--cw-red);
        }

        .carnate-withdraw-page .cw-display-amount {
            padding: 12px 14px;
            border: 1px solid var(--cw-border);
            border-radius: 10px;
            background: var(--cw-soft);
            color: var(--cw-text);
            font-size: 16px;
            font-weight: 700;
        }

        .carnate-withdraw-page .cw-btn {
            min-height: 40px;
            padding: 0 16px;
            border: 0;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 700;
            transition: all .2s ease;
        }

        .carnate-withdraw-page .cw-btn-secondary {
            color: #475569;
            background: var(--cw-soft);
        }

        .carnate-withdraw-page .cw-btn-secondary:hover {
            background: #e2e8f0;
        }

        .carnate-withdraw-page .cw-btn-success {
            color: #fff;
            background: var(--cw-green);
        }

        .carnate-withdraw-page .cw-btn-success:hover {
            background: #15803d;
        }

        .carnate-withdraw-page .cw-vendor-info {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-bottom: 25px;
        }

        .carnate-withdraw-page .cw-info-card {
            padding: 14px 16px;
            border: 1px solid var(--cw-border);
            border-radius: 12px;
            background: #fafafa;
        }

        .carnate-withdraw-page .cw-info-label {
            display: block;
            margin-bottom: 5px;
            color: var(--cw-muted);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
        }

        .carnate-withdraw-page .cw-info-value {
            color: var(--cw-text);
            font-size: 14px;
            font-weight: 700;
        }

        .carnate-withdraw-page .cw-history-table {
            min-width: 700px;
        }

        @media (max-width: 1199px) {
            .carnate-withdraw-page .cw-header {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 18px;
            }

            .carnate-withdraw-page .cw-summary {
                width: 100%;
            }

            .carnate-withdraw-page .cw-summary-item {
                flex: 1;
            }

            .carnate-withdraw-page .cw-vendor-info {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 767px) {
            .carnate-withdraw-page .cw-page-title {
                font-size: 18px;
            }

            .carnate-withdraw-page .cw-summary {
                display: grid;
                grid-template-columns: 1fr;
                width: 100%;
            }

            .carnate-withdraw-page .cw-summary-item {
                width: 100%;
            }

            .carnate-withdraw-page .cw-tabs {
                width: 100%;
                overflow-x: auto;
            }

            .carnate-withdraw-page .cw-tabs .nav-link {
                flex: 0 0 auto;
            }

            .carnate-withdraw-page .cw-vendor-info {
                grid-template-columns: 1fr;
            }

            .carnate-withdraw-page .cw-modal-dialog {
                margin: 20px auto;
            }

            .carnate-withdraw-page .cw-modal-body {
                padding: 16px;
            }
        }
    </style>

    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="cw-alert">
            <i class="bx bx-check-circle me-1"></i>
            {{ session('message') }}
        </div>
    @endif

    @php
        $admin = App\Models\Admin::where('id', $adminId)->first();
    @endphp

    <!-- Page Header -->
    <div class="cw-card cw-header d-flex justify-content-between align-items-center">
        <div class="cw-page-title">
            <span class="cw-page-title-icon">
                <i class="fas fa-coins"></i>
            </span>
            <span>Withdraw</span>
        </div>

        {{-- Summary of amounts --}}
        <div class="cw-summary">
            <div class="cw-summary-item">
                <span class="cw-summary-label">Total Requested</span>
                <span class="cw-summary-value">
                    ₹{{ number_format($totalAmount ?? 0, 2) }}
                </span>
            </div>

            <div class="cw-summary-item">
                <span class="cw-summary-label">Total Approved</span>
                <span class="cw-summary-value">
                    ₹{{ number_format($withdrawAmount ?? 0, 2) }}
                </span>
            </div>

            <div class="cw-summary-item">
                <span class="cw-summary-label">Total Pending / Declined</span>
                <span class="cw-summary-value">
                    ₹{{ number_format($balanceAmount ?? 0, 2) }}
                </span>
            </div>
        </div>

        {{-- @if (@$admin->hasPermissionTo('withdraw-add')) 
        <div class="pe-3">
            <a href="javascript:;" wire:click="create" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i
                    class="bx bxs-plus-square"></i>Add</a>
        </div>
        @endif--}}
    </div>

    <!-- Filters -->
    <div class="cw-card cw-filter-card">
        <div class="row align-items-center g-3">

            <div class="col-xl-3 col-lg-4 col-md-5">
                <input
                    type="text"
                    class="form-control"
                    placeholder="Search"
                    wire:model.live="searchfilter">
            </div>

            <div class="col-xl-6 col-lg-5 col-md-7">
                <ul class="nav nav-tabs cw-tabs mb-0" role="tablist">

                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link active"
                            id="withdraw-requests-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#withdrawRequests"
                            type="button"
                            role="tab">
                            <i class="bx bx-transfer-alt me-1"></i>
                            Withdraw Requests
                        </button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link"
                            id="vendor-wise-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#vendorWiseSummary"
                            type="button"
                            role="tab">
                            <i class="bx bx-group me-1"></i>
                            Vendor Wise Summary
                        </button>
                    </li>

                </ul>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-12 text-md-end">
                <button
                    type="button"
                    class="cw-clear-btn"
                    wire:click="resetFilter">
                    <i class="bx bx-refresh me-1"></i>
                    Clear
                </button>
            </div>

        </div>
    </div>

    <!-- Tabs -->
    <div class="tab-content cw-tab-content">

        <!-- Withdraw Requests -->
        <div class="tab-pane fade show active" id="withdrawRequests" role="tabpanel">

            <div class="cw-card cw-table-card">

                @if (!empty($withdraws) && $withdraws->count())

                    <div class="cw-table-wrap">
                        <table class="cw-table">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>User</th>
                                    <th>Wallet Amount</th>
                                    <th>Amount</th>
                                    <th>Transaction ID / UTR</th>
                                    <th>Status</th>

                                    @if (@$admin->hasPermissionTo('withdraw-edit') || @$admin->hasPermissionTo('withdraw-delete'))
                                        <th>Actions</th>
                                    @endif
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($withdraws as $index => $withdraw)

                                    <tr>
                                        <td>
                                            <span class="cw-sno">
                                                {{ $withdraws->total() - ($withdraws->firstItem() + $index) + 1 }}
                                            </span>
                                        </td>

                                        <td>
                                            <div class="cw-user">
                                                <span class="cw-user-avatar">
                                                    <i class="bx bx-user"></i>
                                                </span>
                                                <span class="cw-user-name">
                                                    {{ @$withdraw->SparePartVendor->name .' '.  @$withdraw->SparePartVendor->lastname  }}
                                                </span>
                                            </div>
                                        </td>

                                        <td>
                                            <span class="cw-amount">
                                                ₹{{ number_format(@$withdraw->SparePartVendor->wallet ?? 0, 2) }}
                                            </span>
                                        </td>

                                        <td>
                                            <span class="cw-amount">
                                                ₹{{ number_format($withdraw->amount, 2) }}
                                            </span>
                                        </td>

                                        <td>
                                            <span class="cw-transaction">
                                                {{ $withdraw->transaction_id ?? '-' }}
                                            </span>
                                        </td>

                                        <td>
                                            @switch($withdraw->status)

                                                @case(0)
                                                    <span class="cw-status processing">
                                                        <i class="bx bx-time-five"></i>
                                                        Processing
                                                    </span>
                                                @break

                                                @case(1)
                                                    <span class="cw-status complete">
                                                        <i class="bx bx-check-circle"></i>
                                                        Complete
                                                    </span>
                                                @break

                                                @case(2)
                                                    <span class="cw-status declined">
                                                        <i class="bx bx-x-circle"></i>
                                                        Declined
                                                    </span>
                                                @break

                                            @endswitch
                                        </td>

                                        @if (@$admin->hasPermissionTo('withdraw-edit') || @$admin->hasPermissionTo('withdraw-delete'))
                                            <td>
                                                @if($withdraw->status == 0)

                                                    <div class="cw-actions">

                                                        @if (@$admin->hasPermissionTo('withdraw-edit'))
                                                            <a
                                                                wire:click="confirmApprove({{ $withdraw->id }},{{ $withdraw->amount}},{{ $withdraw->user_id}})"
                                                                class="cw-action-btn cw-approve">
                                                                <i class="bx bx-check me-1"></i>
                                                                Approve
                                                            </a>
                                                        @endif

                                                        @if (@$admin->hasPermissionTo('withdraw-delete'))
                                                            <a
                                                                wire:click="edit({{ $withdraw->id }},2,{{ $withdraw->amount}},{{ $withdraw->user_id}})"
                                                                class="cw-action-btn cw-decline">
                                                                <i class="bx bx-x me-1"></i>
                                                                Decline
                                                            </a>
                                                        @endif

                                                    </div>

                                                @else
                                                    <span class="cw-muted">-</span>
                                                @endif
                                            </td>
                                        @endif

                                    </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="cw-pagination">
                        {{ $withdraws->links() }}
                    </div>

                @else

                    <div class="cw-empty">
                        <div class="cw-empty-icon">
                            <i class="bx bx-wallet"></i>
                        </div>
                        <div class="cw-empty-title">No withdraw found!</div>
                        <div class="cw-empty-text">There are currently no withdrawal requests to display.</div>
                    </div>

                @endif

            </div>
        </div>

        <!-- Vendor Wise Summary -->
        <div class="tab-pane fade" id="vendorWiseSummary" role="tabpanel">

            <div class="cw-card cw-table-card">

                @if (!empty($groupedWithdraws) && $groupedWithdraws->count())

                    <div class="cw-table-wrap">
                        <table class="cw-table">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Vendor</th>
                                    <th>Vendor Wallet</th>
                                    <th>Total Requested</th>
                                    <th>Total Approved</th>
                                    <th>Pending / Declined</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php $summaryNo = 1; @endphp

                                @forelse ($groupedWithdraws as $vendorWithdraw)

                                    <tr>
                                        <td>
                                            <span class="cw-sno">{{ $summaryNo++ }}</span>
                                        </td>

                                        <td>
                                            <div class="cw-user">
                                                <span class="cw-user-avatar">
                                                    <i class="bx bx-store-alt"></i>
                                                </span>
                                                <span class="cw-user-name">
                                                    {{ $vendorWithdraw['vendor_name'] }}
                                                </span>
                                            </div>
                                        </td>

                                        <td>
                                            <span class="cw-amount">
                                                ₹{{ number_format($vendorWithdraw['wallet_amount'], 2) }}
                                            </span>
                                        </td>

                                        <td>
                                            <span class="cw-amount">
                                                ₹{{ number_format($vendorWithdraw['total_amount'], 2) }}
                                            </span>
                                        </td>

                                        <td>
                                            <span class="cw-amount">
                                                ₹{{ number_format($vendorWithdraw['withdraw_amount'], 2) }}
                                            </span>
                                        </td>

                                        <td>
                                            <span class="cw-amount">
                                                ₹{{ number_format($vendorWithdraw['balance_amount'], 2) }}
                                            </span>
                                        </td>

                                        <td>
                                            <button
                                                wire:click="viewVendorDetail({{ $vendorWithdraw['user_id'] }})"
                                                class="cw-view-btn"
                                                title="View Details">
                                                <i class="bx bx-show"></i>
                                                View Details
                                            </button>
                                        </td>
                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="7" class="text-center py-4 cw-muted">
                                            No vendor withdraw data found.
                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>
                        </table>
                    </div>

                @else

                    <div class="cw-empty">
                        <div class="cw-empty-icon">
                            <i class="bx bx-store"></i>
                        </div>
                        <div class="cw-empty-title">No vendor withdraw data found!</div>
                    </div>

                @endif

            </div>
        </div>

    </div>

    <!-- Approve Withdraw Modal -->
    <div
        class="cw-modal"
        tabindex="-1"
        style="display: @if ($showApproveModal) block @else none @endif">

        <div class="cw-modal-backdrop"></div>

        <div class="cw-modal-dialog cw-modal-md">

            <div class="cw-modal-content">

                <form wire:submit.prevent="approveWithdraw">

                    <div class="cw-modal-header">
                        <h5 class="cw-modal-title">Approve Withdrawal Request</h5>

                        <button
                            type="button"
                            class="cw-close"
                            wire:click="$set('showApproveModal', false)"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="bx bx-x fs-5"></i>
                        </button>
                    </div>

                    <div class="cw-modal-body">

                        @csrf

                        <div class="mb-4">
                            <label class="cw-label">Amount</label>
                            <div class="cw-display-amount">
                                ₹{{ number_format($selectedWithdrawAmount, 2) }}
                            </div>
                        </div>

                        <div class="mb-2">
                            <label for="transaction_id" class="cw-label">
                                Transaction ID / UTR Number
                                <span class="cw-required">*</span>
                            </label>

                            <input
                                type="text"
                                id="transaction_id"
                                class="form-control"
                                wire:model="transaction_id"
                                placeholder="Enter Transaction ID or UTR number"
                                required>

                            @error('transaction_id')
                                <div class="text-danger mt-1 small">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="cw-modal-footer">

                        <button
                            type="button"
                            class="cw-btn cw-btn-secondary"
                            wire:click="$set('showApproveModal', false)"
                            data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button type="submit" class="cw-btn cw-btn-success">
                            Approve
                            <i
                                class="spinner-border spinner-border-sm ms-1"
                                wire:loading
                                wire:target="approveWithdraw"></i>
                        </button>

                    </div>

                </form>

            </div>
        </div>
    </div>

    {{-- Vendor Detail Modal --}}
    <div
        class="cw-modal"
        tabindex="-1"
        style="display: @if ($showVendorDetailModal) block @else none @endif">

        <div class="cw-modal-backdrop"></div>

        <div class="cw-modal-dialog cw-modal-xl">

            <div class="cw-modal-content">

                <div class="cw-modal-header">
                    <h5 class="cw-modal-title">
                        Vendor Details -
                        {{ $selectedVendorData->name ?? '' }}
                        {{ $selectedVendorData->lastname ?? '' }}
                    </h5>

                    <button
                        type="button"
                        class="cw-close"
                        wire:click="$set('showVendorDetailModal', false)"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="bx bx-x fs-5"></i>
                    </button>
                </div>

                <div class="cw-modal-body">

                    @if ($showVendorDetailModal && $selectedVendorData)

                        <div class="cw-vendor-info">

                            <div class="cw-info-card">
                                <span class="cw-info-label">Vendor</span>
                                <span class="cw-info-value">
                                    {{ $selectedVendorData->name }} {{ $selectedVendorData->lastname }}
                                </span>
                            </div>

                            <div class="cw-info-card">
                                <span class="cw-info-label">Company</span>
                                <span class="cw-info-value">
                                    {{ $selectedVendorData->company_name ?? '-' }}
                                </span>
                            </div>

                            <div class="cw-info-card">
                                <span class="cw-info-label">Current Wallet</span>
                                <span class="cw-info-value">
                                    ₹{{ number_format($selectedVendorData->wallet ?? 0, 2) }}
                                </span>
                            </div>

                        </div>

                        <!-- Withdraw History -->
                        <div class="cw-section-title">
                            <i class="bx bx-transfer-alt"></i>
                            <span>Withdraw History</span>
                        </div>

                        <div class="cw-table-wrap mb-4">
                            <table class="cw-table cw-history-table">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Amount</th>
                                        <th>Transaction ID / UTR</th>
                                        <th>Status</th>
                                        <th>Requested Date</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if (!empty($vendorWithdraws) && $vendorWithdraws->count())

                                        @foreach ($vendorWithdraws as $index => $withdraw)

                                            <tr>
                                                <td>
                                                    <span class="cw-sno">{{ $index + 1 }}</span>
                                                </td>

                                                <td>
                                                    <span class="cw-amount">
                                                        ₹{{ number_format($withdraw->amount, 2) }}
                                                    </span>
                                                </td>

                                                <td>
                                                    <span class="cw-transaction">
                                                        {{ $withdraw->transaction_id ?? '-' }}
                                                    </span>
                                                </td>

                                                <td>
                                                    @switch($withdraw->status)

                                                        @case(0)
                                                            <span class="cw-status processing">
                                                                <i class="bx bx-time-five"></i>
                                                                Processing
                                                            </span>
                                                        @break

                                                        @case(1)
                                                            <span class="cw-status complete">
                                                                <i class="bx bx-check-circle"></i>
                                                                Complete
                                                            </span>
                                                        @break

                                                        @case(2)
                                                            <span class="cw-status declined">
                                                                <i class="bx bx-x-circle"></i>
                                                                Declined
                                                            </span>
                                                        @break

                                                    @endswitch
                                                </td>

                                                <td>
                                                    {{ \Carbon\Carbon::parse($withdraw->created_at)->format('d-m-Y h:i A') ?? '-' }}
                                                </td>
                                            </tr>

                                        @endforeach

                                    @else

                                        <tr>
                                            <td colspan="5" class="text-center py-4 cw-muted">
                                                No withdraw history found.
                                            </td>
                                        </tr>

                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <!-- Wallet History -->
                        <div class="cw-section-title">
                            <i class="bx bx-wallet"></i>
                            <span>Wallet History</span>
                        </div>

                        <div class="cw-table-wrap">
                            <table class="cw-table cw-history-table">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Amount</th>
                                        <th>Balance</th>
                                        <th>Type</th>
                                        <th>Created Date</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if (!empty($vendorWalletHistories) && $vendorWalletHistories->count())

                                        @foreach ($vendorWalletHistories as $index => $wallet)

                                            <tr>
                                                <td>
                                                    <span class="cw-sno">{{ $index + 1 }}</span>
                                                </td>

                                                <td>
                                                    <span class="cw-amount">
                                                        ₹{{ number_format($wallet->amount, 2) }}
                                                    </span>
                                                </td>

                                                <td>
                                                    <span class="cw-amount">
                                                        ₹{{ number_format($wallet->total, 2) }}
                                                    </span>
                                                </td>

                                                <td>
                                                    @switch($wallet->type)

                                                        @case(0)
                                                            <span class="cw-status complete">
                                                                <i class="bx bx-plus-circle"></i>
                                                                Credit
                                                            </span>
                                                        @break

                                                        @case(1)
                                                            <span class="cw-status declined">
                                                                <i class="bx bx-minus-circle"></i>
                                                                Debit
                                                            </span>
                                                        @break

                                                        @case(2)
                                                            <span class="cw-status processing">
                                                                <i class="bx bx-revision"></i>
                                                                Refund
                                                            </span>
                                                        @break

                                                    @endswitch
                                                </td>

                                                <td>
                                                    {{ \Carbon\Carbon::parse($wallet->created_at)->format('d-m-Y h:i A') ?? '-' }}
                                                </td>
                                            </tr>

                                        @endforeach

                                    @else

                                        <tr>
                                            <td colspan="5" class="text-center py-4 cw-muted">
                                                No wallet history found.
                                            </td>
                                        </tr>

                                    @endif
                                </tbody>
                            </table>
                        </div>

                    @endif

                </div>

                <div class="cw-modal-footer">
                    <button
                        type="button"
                        class="cw-btn cw-btn-secondary"
                        wire:click="$set('showVendorDetailModal', false)"
                        data-bs-dismiss="modal">
                        Close
                    </button>
                </div>

            </div>
        </div>
    </div>

</div>

@section('footerscript')
@endsection