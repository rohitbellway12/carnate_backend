<div class="carnate-customers-report">
    <style>
        .carnate-customers-report {
            --cr-bg: #f7f8fa;
            --cr-card: #ffffff;
            --cr-text: #111827;
            --cr-muted: #64748b;
            --cr-border: #e2e8f0;
            --cr-red: #e53935;
            --cr-red-soft: #fff5f5;
            --cr-green: #16a34a;
            --cr-green-soft: #f0fdf4;
            --cr-amber: #d97706;
            --cr-amber-soft: #fffbeb;
            --cr-blue: #2563eb;
            --cr-blue-soft: #eff6ff;
            background: var(--cr-bg);
            padding: 20px;
            min-height: 100%;
            color: var(--cr-text);
        }

        .carnate-customers-report .cr-main-card {
            background: var(--cr-card);
            border: 1px solid var(--cr-border);
            border-radius: 16px;
            box-shadow: 0 4px 18px rgba(15, 23, 42, 0.04);
            overflow: hidden;
        }

        /* Header */
        .carnate-customers-report .cr-header {
            padding: 20px 22px;
            border-bottom: 1px solid var(--cr-border);
            background: #fff;
        }

        .carnate-customers-report .cr-title-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .carnate-customers-report .cr-title-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: var(--cr-red-soft);
            color: var(--cr-red);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 21px;
        }

        .carnate-customers-report .cr-title {
            margin: 0;
            font-size: 19px;
            font-weight: 700;
            color: var(--cr-text);
        }

        .carnate-customers-report .cr-subtitle {
            margin: 3px 0 0;
            color: var(--cr-muted);
            font-size: 13px;
        }

        .carnate-customers-report .cr-filters {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-end;
            justify-content: flex-end;
            gap: 10px;
        }

        .carnate-customers-report .cr-filter {
            min-width: 145px;
        }

        .carnate-customers-report .cr-filter.search-filter {
            min-width: 205px;
        }

        .carnate-customers-report .cr-filter label {
            display: block;
            margin-bottom: 5px;
            color: var(--cr-muted);
            font-size: 11px;
            font-weight: 600;
        }

        .carnate-customers-report .cr-control {
            height: 38px;
            border: 1px solid var(--cr-border);
            border-radius: 9px;
            background: #fff;
            color: var(--cr-text);
            font-size: 13px;
            box-shadow: none;
        }

        .carnate-customers-report .cr-control:focus {
            border-color: rgba(229, 57, 53, 0.45);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, 0.08);
        }

        .carnate-customers-report .cr-export {
            height: 38px;
            border: 0;
            border-radius: 9px;
            background: var(--cr-red);
            color: #fff;
            padding: 0 14px;
            font-size: 13px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            transition: .2s ease;
        }

        .carnate-customers-report .cr-export:hover {
            background: #c62828;
            color: #fff;
            transform: translateY(-1px);
        }

        /* Summary */
        .carnate-customers-report .cr-summary {
            padding: 18px 20px 8px;
        }

        .carnate-customers-report .cr-stat {
            height: 100%;
            background: #fff;
            border: 1px solid var(--cr-border);
            border-radius: 14px;
            padding: 15px 16px;
            position: relative;
            overflow: hidden;
            transition: .2s ease;
        }

        .carnate-customers-report .cr-stat:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 18px rgba(15, 23, 42, 0.06);
        }

        .carnate-customers-report .cr-stat::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background: var(--cr-red);
        }

        .carnate-customers-report .cr-stat.green::before {
            background: var(--cr-green);
        }

        .carnate-customers-report .cr-stat.amber::before {
            background: var(--cr-amber);
        }

        .carnate-customers-report .cr-stat.blue::before {
            background: var(--cr-blue);
        }

        .carnate-customers-report .cr-stat-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .carnate-customers-report .cr-stat-label {
            margin: 0 0 5px;
            color: var(--cr-muted);
            font-size: 12px;
            font-weight: 600;
        }

        .carnate-customers-report .cr-stat-value {
            display: block;
            color: var(--cr-text);
            font-size: 22px;
            line-height: 1;
            font-weight: 750;
        }

        .carnate-customers-report .cr-stat-icon {
            width: 40px;
            height: 40px;
            flex: 0 0 40px;
            border-radius: 11px;
            background: var(--cr-red-soft);
            color: var(--cr-red);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .carnate-customers-report .cr-stat.green .cr-stat-icon {
            background: var(--cr-green-soft);
            color: var(--cr-green);
        }

        .carnate-customers-report .cr-stat.amber .cr-stat-icon {
            background: var(--cr-amber-soft);
            color: var(--cr-amber);
        }

        .carnate-customers-report .cr-stat.blue .cr-stat-icon {
            background: var(--cr-blue-soft);
            color: var(--cr-blue);
        }

        /* Table */
        .carnate-customers-report .cr-table-wrap {
            margin-top: 10px;
            border-top: 1px solid var(--cr-border);
        }

        .carnate-customers-report .cr-table {
            margin: 0;
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .carnate-customers-report .cr-table thead th {
            padding: 13px 20px;
            background: #f8fafc;
            color: #475569;
            border-bottom: 1px solid var(--cr-border);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
            white-space: nowrap;
        }

        .carnate-customers-report .cr-table tbody td {
            padding: 14px 20px;
            border-bottom: 1px solid #edf1f5;
            color: var(--cr-text);
            font-size: 13px;
            vertical-align: middle;
        }

        .carnate-customers-report .cr-table tbody tr {
            transition: background .15s ease;
        }

        .carnate-customers-report .cr-table tbody tr:hover {
            background: #fafafa;
        }

        .carnate-customers-report .cr-number {
            color: var(--cr-muted);
            font-size: 12px;
            font-weight: 600;
        }

        .carnate-customers-report .cr-customer {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 650;
        }

        .carnate-customers-report .cr-avatar {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            background: var(--cr-red-soft);
            color: var(--cr-red);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            flex: 0 0 34px;
        }

        .carnate-customers-report .cr-email,
        .carnate-customers-report .cr-mobile {
            color: var(--cr-muted);
        }

        .carnate-customers-report .cr-view-btn {
            width: 34px;
            height: 34px;
            border: 1px solid var(--cr-border);
            border-radius: 9px;
            background: #fff;
            color: var(--cr-red);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            transition: .2s ease;
        }

        .carnate-customers-report .cr-view-btn:hover {
            background: var(--cr-red-soft);
            border-color: rgba(229, 57, 53, .2);
            color: var(--cr-red);
        }

        .carnate-customers-report .cr-empty {
            padding: 45px 20px !important;
            text-align: center;
            color: var(--cr-muted) !important;
        }

        .carnate-customers-report .cr-empty-icon {
            width: 46px;
            height: 46px;
            margin: 0 auto 10px;
            border-radius: 12px;
            background: #f1f5f9;
            color: #94a3b8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        /* Pagination */
        .carnate-customers-report .cr-pagination {
            padding: 13px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            flex-wrap: wrap;
            background: #fff;
        }

        .carnate-customers-report .cr-pagination-info {
            color: var(--cr-muted);
            font-size: 12px;
        }

        .carnate-customers-report .pagination {
            margin: 0;
        }

        /* Modal */
        .carnate-customers-report .cr-modal {
            background: rgba(15, 23, 42, .42);
            backdrop-filter: blur(3px);
        }

        .carnate-customers-report .cr-modal .modal-dialog {
            margin-top: 55px;
        }

        .carnate-customers-report .cr-modal .modal-content {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(15, 23, 42, .18);
        }

        .carnate-customers-report .cr-modal-header {
            padding: 17px 20px;
            border-bottom: 1px solid var(--cr-border);
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .carnate-customers-report .cr-modal-title {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0;
            color: var(--cr-text);
            font-size: 17px;
            font-weight: 700;
        }

        .carnate-customers-report .cr-modal-title-icon {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            background: var(--cr-red-soft);
            color: var(--cr-red);
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .carnate-customers-report .cr-close {
            width: 34px;
            height: 34px;
            border: 1px solid var(--cr-border);
            border-radius: 9px;
            background: #fff;
            color: var(--cr-muted);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }

        .carnate-customers-report .cr-modal-body {
            padding: 20px;
            background: #f8fafc;
        }

        .carnate-customers-report .cr-info-card {
            background: #fff;
            border: 1px solid var(--cr-border);
            border-radius: 13px;
            padding: 16px;
            margin-bottom: 20px;
        }

        .carnate-customers-report .cr-info-item {
            min-height: 58px;
            padding: 5px 0;
        }

        .carnate-customers-report .cr-info-label {
            margin-bottom: 4px;
            color: var(--cr-muted);
            font-size: 11px;
            font-weight: 600;
        }

        .carnate-customers-report .cr-info-value {
            color: var(--cr-text);
            font-size: 13px;
            font-weight: 600;
            word-break: break-word;
        }

        .carnate-customers-report .cr-section-title {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 10px;
        }

        .carnate-customers-report .cr-section-title h6 {
            margin: 0;
            color: var(--cr-text);
            font-size: 14px;
            font-weight: 700;
        }

        .carnate-customers-report .cr-section-count {
            padding: 4px 8px;
            border-radius: 20px;
            background: var(--cr-red-soft);
            color: var(--cr-red);
            font-size: 11px;
            font-weight: 700;
        }

        .carnate-customers-report .cr-vehicle-card {
            background: #fff;
            border: 1px solid var(--cr-border);
            border-radius: 13px;
            padding: 16px;
            margin-bottom: 10px;
        }

        .carnate-customers-report .cr-vehicle-top {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 13px;
            padding-bottom: 12px;
            border-bottom: 1px solid #edf1f5;
        }

        .carnate-customers-report .cr-vehicle-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: #f1f5f9;
            color: #475569;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .carnate-customers-report .cr-vehicle-name {
            color: var(--cr-text);
            font-size: 14px;
            font-weight: 700;
        }

        .carnate-customers-report .cr-vehicle-field {
            margin-bottom: 12px;
        }

        .carnate-customers-report .cr-vehicle-field:last-child {
            margin-bottom: 0;
        }

        .carnate-customers-report .cr-vehicle-label {
            margin-bottom: 3px;
            color: var(--cr-muted);
            font-size: 10px;
            font-weight: 650;
            text-transform: uppercase;
            letter-spacing: .035em;
        }

        .carnate-customers-report .cr-vehicle-value {
            color: var(--cr-text);
            font-size: 12px;
            font-weight: 600;
            word-break: break-word;
        }

        .carnate-customers-report .cr-no-vehicles {
            padding: 25px;
            border: 1px dashed var(--cr-border);
            border-radius: 12px;
            background: #fff;
            text-align: center;
            color: var(--cr-muted);
            font-size: 13px;
        }

        .carnate-customers-report .cr-modal-footer {
            padding: 13px 20px;
            border-top: 1px solid var(--cr-border);
            background: #fff;
        }

        .carnate-customers-report .cr-close-btn {
            min-width: 85px;
            border: 1px solid var(--cr-border);
            background: #fff;
            color: #475569;
            border-radius: 9px;
            padding: 8px 14px;
            font-size: 13px;
            font-weight: 600;
        }

        .carnate-customers-report .cr-close-btn:hover {
            background: #f8fafc;
        }

        @media (max-width: 991.98px) {
            .carnate-customers-report .cr-header {
                padding: 16px;
            }

            .carnate-customers-report .cr-header-inner {
                flex-direction: column;
                align-items: stretch !important;
                gap: 16px;
            }

            .carnate-customers-report .cr-filters {
                justify-content: flex-start;
            }
        }

        @media (max-width: 767.98px) {
            .carnate-customers-report {
                padding: 10px;
            }

            .carnate-customers-report .cr-filter,
            .carnate-customers-report .cr-filter.search-filter {
                min-width: 100%;
            }

            .carnate-customers-report .cr-export {
                width: 100%;
            }

            .carnate-customers-report .cr-pagination {
                align-items: flex-start;
                flex-direction: column;
            }

            .carnate-customers-report .cr-modal .modal-dialog {
                margin: 15px 10px;
            }

            .carnate-customers-report .cr-table thead th,
            .carnate-customers-report .cr-table tbody td {
                padding-left: 13px;
                padding-right: 13px;
            }
        }
    </style>

    <div class="cr-main-card">

        {{-- Header --}}
        <div class="cr-header">
            <div class="cr-header-inner d-flex align-items-center justify-content-between gap-3 flex-wrap">

                <div class="cr-title-wrap">
                    <div class="cr-title-icon">
                        <i class="bx bx-group"></i>
                    </div>

                    <div>
                        <h5 class="cr-title">Customers Report</h5>
                        <p class="cr-subtitle">View customer records and linked vehicle information.</p>
                    </div>
                </div>

                <div class="cr-filters">

                    {{-- Search --}}
                    <div class="cr-filter search-filter">
                        <label>Search</label>
                        <input
                            type="text"
                            class="form-control cr-control"
                            placeholder="Search customer..."
                            wire:model.live="search"
                        >
                    </div>

                    {{-- Filter Type --}}
                    <div class="cr-filter">
                        <label>Filter Type</label>
                        <select
                            class="form-select cr-control"
                            wire:model.live="filterType"
                        >
                            <option value="">All</option>
                            <option value="daily">Today</option>
                            <option value="weekly">This Week</option>
                            <option value="monthly">This Month</option>
                        </select>
                    </div>

                    {{-- From --}}
                    <div class="cr-filter">
                        <label>From</label>
                        <input
                            type="date"
                            class="form-control cr-control"
                            wire:model.lazy="fromDate"
                        >
                    </div>

                    {{-- To --}}
                    <div class="cr-filter">
                        <label>To</label>
                        <input
                            type="date"
                            class="form-control cr-control"
                            wire:model.lazy="toDate"
                        >
                    </div>

                    {{-- Export --}}
                    <div class="cr-filter">
                        <label>&nbsp;</label>
                        <button
                            type="button"
                            class="cr-export"
                            wire:click="downloadPDF"
                        >
                            <i class="bx bxs-file-pdf"></i>
                            Export PDF
                        </button>
                    </div>

                </div>
            </div>
        </div>

        {{-- Summary --}}
        <div class="cr-summary">
            <div class="row g-3">

                <div class="col-6 col-lg-3">
                    <div class="cr-stat">
                        <div class="cr-stat-content">
                            <div>
                                <p class="cr-stat-label">Total Customers</p>
                                <span class="cr-stat-value">
                                    {{ $totals['total_customers'] ?? 0 }}
                                </span>
                            </div>

                            <div class="cr-stat-icon">
                                <i class="bx bx-group"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-3">
                    <div class="cr-stat green">
                        <div class="cr-stat-content">
                            <div>
                                <p class="cr-stat-label">With Vehicle</p>
                                <span class="cr-stat-value">
                                    {{ $totals['with_vehicle'] ?? 0 }}
                                </span>
                            </div>

                            <div class="cr-stat-icon">
                                <i class="bx bx-car"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-3">
                    <div class="cr-stat amber">
                        <div class="cr-stat-content">
                            <div>
                                <p class="cr-stat-label">Without Vehicle</p>
                                <span class="cr-stat-value">
                                    {{ $totals['without_vehicle'] ?? 0 }}
                                </span>
                            </div>

                            <div class="cr-stat-icon">
                                <i class="bx bx-user"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-3">
                    <div class="cr-stat blue">
                        <div class="cr-stat-content">
                            <div>
                                <p class="cr-stat-label">Total Vehicles</p>
                                <span class="cr-stat-value">
                                    {{ $totals['total_vehicles'] ?? 0 }}
                                </span>
                            </div>

                            <div class="cr-stat-icon">
                                <i class="bx bx-car"></i>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- Customer Table --}}
        <div class="cr-table-wrap">
            <div class="table-responsive">
                <table class="cr-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($customers as $c)
                            <tr>
                                <td>
                                    <span class="cr-number">
                                        {{ $customers->total() - ($loop->index + ($customers->currentPage() - 1) * $customers->perPage()) }}
                                    </span>
                                </td>

                                <td>
                                    <div class="cr-customer">
                                        <span class="cr-avatar">
                                            <i class="bx bx-user"></i>
                                        </span>

                                        <span>
                                            {{ $c->name }} {{ $c->lastname }}
                                        </span>
                                    </div>
                                </td>

                                <td>
                                    <span class="cr-email">
                                        {{ $c->email }}
                                    </span>
                                </td>

                                <td>
                                    <span class="cr-mobile">
                                        {{ $c->mobile_no }}
                                    </span>
                                </td>

                                <td class="text-center">
                                    <button
                                        type="button"
                                        class="cr-view-btn"
                                        wire:click="viewCustomer({{ $c->id }})"
                                        title="View Customer"
                                    >
                                        <i class="bx bx-show"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="cr-empty">
                                    <div class="cr-empty-icon">
                                        <i class="bx bx-user-x"></i>
                                    </div>
                                    No customers found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="cr-pagination">
                <small class="cr-pagination-info">
                    Showing {{ $customers->firstItem() }}–{{ $customers->lastItem() }}
                    of {{ $customers->total() }}
                </small>

                {!! $customers->links() !!}
            </div>
        </div>
    </div>

    {{-- View Customer Modal --}}
    <div
        class="modal fade cr-modal @if($detail) show d-block @endif"
        tabindex="-1"
        @if($detail)
            style="display:block;"
        @else
            aria-hidden="true"
        @endif
    >
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">

                <div class="cr-modal-header">
                    <h5 class="cr-modal-title">
                        <span class="cr-modal-title-icon">
                            <i class="bx bx-user"></i>
                        </span>
                        Customer Details
                    </h5>

                    <button
                        type="button"
                        class="cr-close"
                        wire:click="$set('viewCustomerId', null)"
                        aria-label="Close"
                    >
                        <i class="bx bx-x"></i>
                    </button>
                </div>

                <div class="cr-modal-body">

                    @if($detail)

                        {{-- Customer Information --}}
                        <div class="cr-info-card">
                            <div class="row g-3">

                                <div class="col-md-6">
                                    <div class="cr-info-item">
                                        <div class="cr-info-label">Name</div>
                                        <div class="cr-info-value">
                                            {{ $detail->name }} {{ $detail->lastname }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="cr-info-item">
                                        <div class="cr-info-label">Email</div>
                                        <div class="cr-info-value">
                                            {{ $detail->email }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="cr-info-item">
                                        <div class="cr-info-label">Mobile</div>
                                        <div class="cr-info-value">
                                            {{ $detail->mobile_no }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="cr-info-item">
                                        <div class="cr-info-label">Address</div>
                                        <div class="cr-info-value">
                                            {{ $detail->address }}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        {{-- Vehicles --}}
                        <div class="cr-section-title">
                            <h6>
                                <i class="bx bx-car me-1"></i>
                                Vehicles
                            </h6>

                            @if($detail->vehicles)
                                <span class="cr-section-count">
                                    {{ $detail->vehicles->count() }}
                                </span>
                            @endif
                        </div>

                        @forelse($detail->vehicles as $v)

                            <div class="cr-vehicle-card">

                                <div class="cr-vehicle-top">
                                    <span class="cr-vehicle-icon">
                                        <i class="bx bx-car"></i>
                                    </span>

                                    <div class="cr-vehicle-name">
                                        {{ $v->brand ?? '-' }}
                                        @if(!empty($v->variant))
                                            · {{ $v->variant }}
                                        @endif
                                    </div>
                                </div>

                                <div class="row g-3">

                                    <div class="col-md-3">
                                        <div class="cr-vehicle-field">
                                            <div class="cr-vehicle-label">Brand</div>
                                            <div class="cr-vehicle-value">
                                                {{ $v->brand ?? '-' }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="cr-vehicle-field">
                                            <div class="cr-vehicle-label">Variant</div>
                                            <div class="cr-vehicle-value">
                                                {{ $v->variant ?? '-' }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="cr-vehicle-field">
                                            <div class="cr-vehicle-label">Modification</div>
                                            <div class="cr-vehicle-value">
                                                {{ $v->modification ?? '-' }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="cr-vehicle-field">
                                            <div class="cr-vehicle-label">Year</div>
                                            <div class="cr-vehicle-value">
                                                {{ $v->year ?? '-' }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="cr-vehicle-field">
                                            <div class="cr-vehicle-label">Number Plate</div>
                                            <div class="cr-vehicle-value">
                                                {{ $v->number_plate ?? '-' }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="cr-vehicle-field">
                                            <div class="cr-vehicle-label">Chassis No</div>
                                            <div class="cr-vehicle-value">
                                                {{ $v->chassis_no ?? '-' }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="cr-vehicle-field">
                                            <div class="cr-vehicle-label">Engine No</div>
                                            <div class="cr-vehicle-value">
                                                {{ $v->engineno ?? '-' }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="cr-vehicle-field">
                                            <div class="cr-vehicle-label">Manufacturing Date</div>
                                            <div class="cr-vehicle-value">
                                                {{ $v->date_of_manufacturing ?? '-' }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="cr-vehicle-field">
                                            <div class="cr-vehicle-label">Driver Name</div>
                                            <div class="cr-vehicle-value">
                                                {{ $v->driver_name ?? '-' }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="cr-vehicle-field">
                                            <div class="cr-vehicle-label">Driver Number</div>
                                            <div class="cr-vehicle-value">
                                                {{ $v->driver_number ?? '-' }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="cr-vehicle-field">
                                            <div class="cr-vehicle-label">Policy No</div>
                                            <div class="cr-vehicle-value">
                                                {{ $v->policy_number ?? '-' }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="cr-vehicle-field">
                                            <div class="cr-vehicle-label">Insurance</div>
                                            <div class="cr-vehicle-value">
                                                {{ $v->insurance_name ?? '-' }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="cr-vehicle-field">
                                            <div class="cr-vehicle-label">Pickup Address</div>
                                            <div class="cr-vehicle-value">
                                                {{ $v->pickup_address ?? '-' }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="cr-vehicle-field">
                                            <div class="cr-vehicle-label">Drop Address</div>
                                            <div class="cr-vehicle-value">
                                                {{ $v->drop_address ?? '-' }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="cr-vehicle-field">
                                            <div class="cr-vehicle-label">Policy Expiry</div>
                                            <div class="cr-vehicle-value">
                                                {{ $v->policy_expiry_date ?? '-' }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="cr-vehicle-field">
                                            <div class="cr-vehicle-label">GSTIN</div>
                                            <div class="cr-vehicle-value">
                                                {{ $v->gstin_number ?? '-' }}
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        @empty

                            <div class="cr-no-vehicles">
                                <i class="bx bx-car me-1"></i>
                                No vehicles linked.
                            </div>

                        @endforelse

                    @endif
                </div>

                <div class="cr-modal-footer d-flex justify-content-end">
                    <button
                        type="button"
                        class="cr-close-btn"
                        wire:click="$set('viewCustomerId', null)"
                    >
                        Close
                    </button>
                </div>

            </div>
        </div>
    </div>

    <script>
        window.addEventListener('show-customer-modal', () => {});
    </script>
</div>