<div class="carnate-customers-report">

    <style>
        .carnate-customers-report {
            --ccr-bg: #f7f8fa;
            --ccr-card: #ffffff;
            --ccr-text: #111827;
            --ccr-muted: #64748b;
            --ccr-border: #e2e8f0;
            --ccr-soft: #f1f5f9;
            --ccr-red: #e53935;
            --ccr-red-soft: #fff5f5;
            --ccr-green: #16a34a;
            --ccr-green-soft: #f0fdf4;
            --ccr-orange: #d97706;
            --ccr-orange-soft: #fffbeb;
            --ccr-blue: #2563eb;
            --ccr-blue-soft: #eff6ff;
            background: var(--ccr-bg);
            color: var(--ccr-text);
        }

        .carnate-customers-report .ccr-card {
            background: var(--ccr-card);
            border: 1px solid var(--ccr-border);
            border-radius: 16px;
            box-shadow: 0 4px 18px rgba(15, 23, 42, 0.04);
        }

        .carnate-customers-report .ccr-header {
            padding: 20px 22px;
        }

        .carnate-customers-report .ccr-title-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .carnate-customers-report .ccr-title-icon {
            width: 42px;
            height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: var(--ccr-red-soft);
            color: var(--ccr-red);
            font-size: 19px;
        }

        .carnate-customers-report .ccr-title {
            margin: 0;
            color: var(--ccr-text);
            font-size: 21px;
            font-weight: 700;
        }

        .carnate-customers-report .ccr-subtitle {
            margin: 4px 0 0;
            color: var(--ccr-muted);
            font-size: 12px;
        }

        .carnate-customers-report .ccr-filters {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-end;
            justify-content: flex-end;
            gap: 12px;
        }

        .carnate-customers-report .ccr-filter {
            min-width: 135px;
        }

        .carnate-customers-report .ccr-search-filter {
            min-width: 190px;
        }

        .carnate-customers-report .ccr-filter-label {
            display: block;
            margin-bottom: 6px;
            color: #475569;
            font-size: 11px;
            font-weight: 700;
        }

        .carnate-customers-report .form-control,
        .carnate-customers-report .form-select {
            min-height: 40px;
            border: 1px solid var(--ccr-border);
            border-radius: 9px;
            background: #fff;
            color: var(--ccr-text);
            box-shadow: none;
            font-size: 13px;
        }

        .carnate-customers-report .form-control:focus,
        .carnate-customers-report .form-select:focus {
            border-color: rgba(229, 57, 53, .45);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        .carnate-customers-report .ccr-export-btn {
            min-height: 40px;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 0 14px;
            border: 1px solid var(--ccr-border);
            border-radius: 9px;
            background: #fff;
            color: #dc2626;
            font-size: 12px;
            font-weight: 700;
            transition: all .2s ease;
        }

        .carnate-customers-report .ccr-export-btn:hover {
            background: var(--ccr-red-soft);
            border-color: #fecaca;
            color: #dc2626;
        }

        /* Summary */
        .carnate-customers-report .ccr-summary {
            padding: 18px 20px 0;
        }

        .carnate-customers-report .ccr-summary-card {
            height: 100%;
            padding: 17px 18px;
            border: 1px solid var(--ccr-border);
            border-radius: 14px;
            background: #fff;
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .carnate-customers-report .ccr-summary-card:hover {
            transform: translateY(-1px);
            box-shadow: 0 7px 20px rgba(15, 23, 42, .06);
        }

        .carnate-customers-report .ccr-summary-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .carnate-customers-report .ccr-summary-label {
            margin: 0 0 5px;
            color: var(--ccr-muted);
            font-size: 12px;
            font-weight: 600;
        }

        .carnate-customers-report .ccr-summary-value {
            color: var(--ccr-text);
            font-size: 25px;
            line-height: 1;
            font-weight: 750;
        }

        .carnate-customers-report .ccr-summary-icon {
            width: 44px;
            height: 44px;
            flex: 0 0 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 18px;
        }

        .carnate-customers-report .ccr-total .ccr-summary-icon {
            color: var(--ccr-blue);
            background: var(--ccr-blue-soft);
        }

        .carnate-customers-report .ccr-with-vehicle .ccr-summary-icon {
            color: var(--ccr-green);
            background: var(--ccr-green-soft);
        }

        .carnate-customers-report .ccr-without-vehicle .ccr-summary-icon {
            color: var(--ccr-orange);
            background: var(--ccr-orange-soft);
        }

        .carnate-customers-report .ccr-vehicles .ccr-summary-icon {
            color: var(--ccr-red);
            background: var(--ccr-red-soft);
        }

        /* Table */
        .carnate-customers-report .ccr-table-card {
            margin-top: 18px;
            overflow: hidden;
        }

        .carnate-customers-report .ccr-table-wrap {
            overflow-x: auto;
        }

        .carnate-customers-report .ccr-table {
            width: 100%;
            min-width: 760px;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .carnate-customers-report .ccr-table thead th {
            padding: 14px 17px;
            background: #f8fafc;
            border-bottom: 1px solid var(--ccr-border);
            color: #475569;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .035em;
            white-space: nowrap;
        }

        .carnate-customers-report .ccr-table tbody td {
            padding: 14px 17px;
            border-bottom: 1px solid #eef2f7;
            color: var(--ccr-text);
            font-size: 13px;
            vertical-align: middle;
        }

        .carnate-customers-report .ccr-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-customers-report .ccr-table tbody tr:hover {
            background: #fafafa;
        }

        .carnate-customers-report .ccr-sno {
            color: var(--ccr-muted);
            font-weight: 600;
        }

        .carnate-customers-report .ccr-customer {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 170px;
        }

        .carnate-customers-report .ccr-avatar {
            width: 36px;
            height: 36px;
            flex: 0 0 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: var(--ccr-red-soft);
            color: var(--ccr-red);
            font-size: 15px;
        }

        .carnate-customers-report .ccr-name {
            color: var(--ccr-text);
            font-weight: 650;
        }

        .carnate-customers-report .ccr-email {
            color: #475569;
        }

        .carnate-customers-report .ccr-mobile {
            white-space: nowrap;
        }

        .carnate-customers-report .ccr-view-btn {
            width: 34px;
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--ccr-border);
            border-radius: 9px;
            background: #fff;
            color: #64748b;
            transition: all .2s ease;
        }

        .carnate-customers-report .ccr-view-btn:hover {
            background: var(--ccr-red-soft);
            border-color: #fecaca;
            color: var(--ccr-red);
        }

        .carnate-customers-report .ccr-pagination {
            padding: 15px 18px;
            border-top: 1px solid var(--ccr-border);
        }

        .carnate-customers-report .ccr-showing {
            color: var(--ccr-muted);
            font-size: 12px;
        }

        .carnate-customers-report .ccr-empty {
            padding: 45px 20px;
            text-align: center;
        }

        .carnate-customers-report .ccr-empty-icon {
            width: 52px;
            height: 52px;
            margin: 0 auto 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            background: var(--ccr-soft);
            color: #94a3b8;
            font-size: 21px;
        }

        .carnate-customers-report .ccr-empty-title {
            color: #475569;
            font-size: 14px;
            font-weight: 700;
        }

        /* Modal */
        .carnate-customers-report .ccr-modal {
            position: fixed;
            inset: 0;
            z-index: 1055;
            overflow-x: hidden;
            overflow-y: auto;
        }

        .carnate-customers-report .ccr-modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, .58);
            backdrop-filter: blur(2px);
        }

        .carnate-customers-report .ccr-modal-dialog {
            position: relative;
            z-index: 2;
            max-width: 900px;
            margin: 35px auto;
            padding: 0 15px;
        }

        .carnate-customers-report .ccr-modal-content {
            background: #fff;
            border: 1px solid var(--ccr-border);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 25px 70px rgba(15, 23, 42, .22);
        }

        .carnate-customers-report .ccr-modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 22px;
            border-bottom: 1px solid var(--ccr-border);
        }

        .carnate-customers-report .ccr-modal-title {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0;
            color: var(--ccr-text);
            font-size: 17px;
            font-weight: 700;
        }

        .carnate-customers-report .ccr-modal-title-icon {
            width: 35px;
            height: 35px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 9px;
            background: var(--ccr-red-soft);
            color: var(--ccr-red);
        }

        .carnate-customers-report .ccr-close {
            width: 35px;
            height: 35px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 0;
            border-radius: 9px;
            background: var(--ccr-soft);
            color: #64748b;
            opacity: 1;
        }

        .carnate-customers-report .ccr-close:hover {
            background: var(--ccr-red-soft);
            color: var(--ccr-red);
        }

        .carnate-customers-report .ccr-modal-body {
            padding: 22px;
        }

        .carnate-customers-report .ccr-profile-card,
        .carnate-customers-report .ccr-vehicle-card {
            border: 1px solid var(--ccr-border);
            border-radius: 13px;
            background: #fff;
        }

        .carnate-customers-report .ccr-profile-card {
            padding: 18px;
        }

        .carnate-customers-report .ccr-profile-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .carnate-customers-report .ccr-detail-label {
            display: block;
            margin-bottom: 4px;
            color: var(--ccr-muted);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .035em;
        }

        .carnate-customers-report .ccr-detail-value {
            color: var(--ccr-text);
            font-size: 13px;
            font-weight: 600;
            line-height: 1.5;
            word-break: break-word;
        }

        .carnate-customers-report .ccr-section-title {
            display: flex;
            align-items: center;
            gap: 9px;
            margin: 22px 0 12px;
            color: var(--ccr-text);
            font-size: 14px;
            font-weight: 700;
        }

        .carnate-customers-report .ccr-section-title-icon {
            width: 30px;
            height: 30px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background: var(--ccr-soft);
            color: #475569;
        }

        .carnate-customers-report .ccr-vehicle-card {
            padding: 17px;
            margin-bottom: 12px;
        }

        .carnate-customers-report .ccr-vehicle-card:last-child {
            margin-bottom: 0;
        }

        .carnate-customers-report .ccr-vehicle-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
        }

        .carnate-customers-report .ccr-vehicle-grid .ccr-wide {
            grid-column: span 2;
        }

        .carnate-customers-report .ccr-no-data {
            padding: 28px;
            text-align: center;
            color: var(--ccr-muted);
            font-size: 13px;
            border: 1px dashed var(--ccr-border);
            border-radius: 12px;
            background: #fafafa;
        }

        .carnate-customers-report .ccr-modal-footer {
            display: flex;
            justify-content: flex-end;
            padding: 15px 22px;
            border-top: 1px solid var(--ccr-border);
            background: #fafafa;
        }

        .carnate-customers-report .ccr-close-btn {
            min-height: 40px;
            padding: 0 17px;
            border: 0;
            border-radius: 9px;
            background: var(--ccr-soft);
            color: #475569;
            font-size: 13px;
            font-weight: 700;
        }

        .carnate-customers-report .ccr-close-btn:hover {
            background: #e2e8f0;
        }

        @media (max-width: 1199px) {
            .carnate-customers-report .ccr-header {
                gap: 20px;
            }

            .carnate-customers-report .ccr-filters {
                width: 100%;
                justify-content: flex-start;
            }

            .carnate-customers-report .ccr-vehicle-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        @media (max-width: 767px) {
            .carnate-customers-report .ccr-header {
                padding: 18px;
            }

            .carnate-customers-report .ccr-title {
                font-size: 18px;
            }

            .carnate-customers-report .ccr-filters {
                display: grid;
                grid-template-columns: 1fr 1fr;
            }

            .carnate-customers-report .ccr-filter,
            .carnate-customers-report .ccr-search-filter {
                min-width: 0;
                width: 100%;
            }

            .carnate-customers-report .ccr-export-btn {
                width: 100%;
                justify-content: center;
            }

            .carnate-customers-report .ccr-profile-grid {
                grid-template-columns: 1fr;
                gap: 14px;
            }

            .carnate-customers-report .ccr-vehicle-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .carnate-customers-report .ccr-vehicle-grid .ccr-wide {
                grid-column: span 2;
            }

            .carnate-customers-report .ccr-modal-dialog {
                margin: 20px auto;
            }

            .carnate-customers-report .ccr-modal-body {
                padding: 16px;
            }

            .carnate-customers-report .ccr-modal-header,
            .carnate-customers-report .ccr-modal-footer {
                padding-left: 16px;
                padding-right: 16px;
            }
        }

        @media (max-width: 480px) {
            .carnate-customers-report .ccr-filters {
                grid-template-columns: 1fr;
            }

            .carnate-customers-report .ccr-vehicle-grid {
                grid-template-columns: 1fr;
            }

            .carnate-customers-report .ccr-vehicle-grid .ccr-wide {
                grid-column: auto;
            }
        }
    </style>

    <div class="ccr-card">

        <!-- Header + Filters -->
        <div class="ccr-header d-flex flex-wrap align-items-center justify-content-between">

            <div class="ccr-title-wrap">
                <span class="ccr-title-icon">
                    <i class="fas fa-users"></i>
                </span>

                <div>
                    <h5 class="ccr-title">Customers Report</h5>
                    <p class="ccr-subtitle">Customer overview and vehicle ownership report</p>
                </div>
            </div>

            <div class="ccr-filters">

                <!-- Search -->
                <div class="ccr-filter ccr-search-filter">
                    <label class="ccr-filter-label">Search</label>
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Search customer..."
                        wire:model.live="search">
                </div>

                <!-- Filter Type -->
                <div class="ccr-filter">
                    <label class="ccr-filter-label">Filter Type</label>
                    <select
                        class="form-select"
                        wire:model.live="filterType">
                        <option value="">All</option>
                        <option value="daily">Today</option>
                        <option value="weekly">This Week</option>
                        <option value="monthly">This Month</option>
                    </select>
                </div>

                <!-- From -->
                <div class="ccr-filter">
                    <label class="ccr-filter-label">From</label>
                    <input
                        type="date"
                        class="form-control"
                        wire:model.lazy="fromDate">
                </div>

                <!-- To -->
                <div class="ccr-filter">
                    <label class="ccr-filter-label">To</label>
                    <input
                        type="date"
                        class="form-control"
                        wire:model.lazy="toDate">
                </div>

                <!-- Export PDF -->
                <div>
                    <label class="ccr-filter-label">&nbsp;</label>

                    <button
                        class="ccr-export-btn"
                        wire:click="downloadPDF">
                        <i class="bx bxs-file-pdf"></i>
                        Export PDF
                    </button>
                </div>

            </div>
        </div>

        <!-- Summary Cards -->
        <div class="ccr-summary">

            <div class="row g-3">

                <!-- Total Customers -->
                <div class="col-6 col-md-3">

                    <div class="ccr-summary-card ccr-total">

                        <div class="ccr-summary-content">

                            <div>
                                <p class="ccr-summary-label">Total Customers</p>

                                <span class="ccr-summary-value">
                                    {{ $totals['total_customers'] ?? 0 }}
                                </span>
                            </div>

                            <span class="ccr-summary-icon">
                                <i class="fas fa-users"></i>
                            </span>

                        </div>

                    </div>

                </div>

                <!-- With Vehicle -->
                <div class="col-6 col-md-3">

                    <div class="ccr-summary-card ccr-with-vehicle">

                        <div class="ccr-summary-content">

                            <div>
                                <p class="ccr-summary-label">With Vehicle</p>

                                <span class="ccr-summary-value">
                                    {{ $totals['with_vehicle'] ?? 0 }}
                                </span>
                            </div>

                            <span class="ccr-summary-icon">
                                <i class="fas fa-car"></i>
                            </span>

                        </div>

                    </div>

                </div>

                <!-- Without Vehicle -->
                <div class="col-6 col-md-3">

                    <div class="ccr-summary-card ccr-without-vehicle">

                        <div class="ccr-summary-content">

                            <div>
                                <p class="ccr-summary-label">Without Vehicle</p>

                                <span class="ccr-summary-value">
                                    {{ $totals['without_vehicle'] ?? 0 }}
                                </span>
                            </div>

                            <span class="ccr-summary-icon">
                                <i class="fas fa-user"></i>
                            </span>

                        </div>

                    </div>

                </div>

                <!-- Total Vehicles -->
                <div class="col-6 col-md-3">

                    <div class="ccr-summary-card ccr-vehicles">

                        <div class="ccr-summary-content">

                            <div>
                                <p class="ccr-summary-label">Total Vehicles</p>

                                <span class="ccr-summary-value">
                                    {{ $totals['total_vehicles'] ?? 0 }}
                                </span>
                            </div>

                            <span class="ccr-summary-icon">
                                <i class="fas fa-car-side"></i>
                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- Customer Table -->
        <div class="ccr-table-card">

            <div class="ccr-table-wrap">

                <table class="ccr-table">

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
                                    <span class="ccr-sno">
                                        {{ $loop->iteration + ($customers->currentPage()-1)*$customers->perPage() }}
                                    </span>
                                </td>

                                <td>

                                    <div class="ccr-customer">

                                        <span class="ccr-avatar">
                                            <i class="bx bx-user"></i>
                                        </span>

                                        <span class="ccr-name">
                                            {{ $c->name }} {{ $c->lastname }}
                                        </span>

                                    </div>

                                </td>

                                <td>
                                    <span class="ccr-email">
                                        {{ $c->email }}
                                    </span>
                                </td>

                                <td>
                                    <span class="ccr-mobile">
                                        {{ $c->mobile_no }}
                                    </span>
                                </td>

                                <td class="text-center">

                                    <button
                                        type="button"
                                        class="ccr-view-btn"
                                        wire:click="viewCustomer({{ $c->id }})"
                                        title="View">
                                        <i class="bx bx-show"></i>
                                    </button>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="6">

                                    <div class="ccr-empty">

                                        <div class="ccr-empty-icon">
                                            <i class="fas fa-users"></i>
                                        </div>

                                        <div class="ccr-empty-title">
                                            No customers found.
                                        </div>

                                    </div>

                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="ccr-pagination d-flex justify-content-between align-items-center flex-wrap gap-2">

                <small class="ccr-showing">
                    Showing
                    {{ $customers->firstItem() }}
                    –
                    {{ $customers->lastItem() }}
                    of
                    {{ $customers->total() }}
                </small>

                {!! $customers->links() !!}

            </div>

        </div>

    </div>

    <!-- View Modal -->
    <div
        class="ccr-modal"
        tabindex="-1"
        style="@if($detail) display:block; @else display:none; @endif"
        @if(!$detail) aria-hidden="true" @endif>

        <div class="ccr-modal-backdrop"></div>

        <div class="ccr-modal-dialog">

            <div class="ccr-modal-content">

                <div class="ccr-modal-header">

                    <h5 class="ccr-modal-title">
                        <span class="ccr-modal-title-icon">
                            <i class="fas fa-user"></i>
                        </span>
                        Customer Details
                    </h5>

                    <button
                        type="button"
                        class="ccr-close"
                        wire:click="$set('viewCustomerId', null)"
                        aria-label="Close">
                        <i class="bx bx-x fs-5"></i>
                    </button>

                </div>

                <div class="ccr-modal-body">

                    @if($detail)

                        <!-- Customer Profile -->
                        <div class="ccr-profile-card">

                            <div class="ccr-profile-grid">

                                <div>
                                    <span class="ccr-detail-label">Name</span>
                                    <div class="ccr-detail-value">
                                        {{ $detail->name }} {{ $detail->lastname }}
                                    </div>
                                </div>

                                <div>
                                    <span class="ccr-detail-label">Email</span>
                                    <div class="ccr-detail-value">
                                        {{ $detail->email }}
                                    </div>
                                </div>

                                <div>
                                    <span class="ccr-detail-label">Mobile</span>
                                    <div class="ccr-detail-value">
                                        {{ $detail->mobile_no }}
                                    </div>
                                </div>

                                <div>
                                    <span class="ccr-detail-label">Address</span>
                                    <div class="ccr-detail-value">
                                        {{ $detail->address }}
                                    </div>
                                </div>

                            </div>

                        </div>

                        <!-- Vehicles -->
                        <div class="ccr-section-title">
                            <span class="ccr-section-title-icon">
                                <i class="fas fa-car"></i>
                            </span>
                            Vehicles
                        </div>

                        @forelse($detail->vehicles as $v)

                            <div class="ccr-vehicle-card">

                                <div class="ccr-vehicle-grid">

                                    <div>
                                        <span class="ccr-detail-label">Brand</span>
                                        <div class="ccr-detail-value">
                                            {{ $v->brand ?? '-' }}
                                        </div>
                                    </div>

                                    <div>
                                        <span class="ccr-detail-label">Variant</span>
                                        <div class="ccr-detail-value">
                                            {{ $v->variant ?? '-' }}
                                        </div>
                                    </div>

                                    <div>
                                        <span class="ccr-detail-label">Modification</span>
                                        <div class="ccr-detail-value">
                                            {{ $v->modification ?? '-' }}
                                        </div>
                                    </div>

                                    <div>
                                        <span class="ccr-detail-label">Year</span>
                                        <div class="ccr-detail-value">
                                            {{ $v->year ?? '-' }}
                                        </div>
                                    </div>

                                    <div>
                                        <span class="ccr-detail-label">Number Plate</span>
                                        <div class="ccr-detail-value">
                                            {{ $v->number_plate ?? '-' }}
                                        </div>
                                    </div>

                                    <div>
                                        <span class="ccr-detail-label">Chassis No</span>
                                        <div class="ccr-detail-value">
                                            {{ $v->chassis_no ?? '-' }}
                                        </div>
                                    </div>

                                    <div>
                                        <span class="ccr-detail-label">Engine No</span>
                                        <div class="ccr-detail-value">
                                            {{ $v->engineno ?? '-' }}
                                        </div>
                                    </div>

                                    <div>
                                        <span class="ccr-detail-label">Manufacturing Date</span>
                                        <div class="ccr-detail-value">
                                            {{ $v->date_of_manufacturing ?? '-' }}
                                        </div>
                                    </div>

                                    <div>
                                        <span class="ccr-detail-label">Driver Name</span>
                                        <div class="ccr-detail-value">
                                            {{ $v->driver_name ?? '-' }}
                                        </div>
                                    </div>

                                    <div>
                                        <span class="ccr-detail-label">Driver Number</span>
                                        <div class="ccr-detail-value">
                                            {{ $v->driver_number ?? '-' }}
                                        </div>
                                    </div>

                                    <div>
                                        <span class="ccr-detail-label">Policy No</span>
                                        <div class="ccr-detail-value">
                                            {{ $v->policy_number ?? '-' }}
                                        </div>
                                    </div>

                                    <div>
                                        <span class="ccr-detail-label">Insurance</span>
                                        <div class="ccr-detail-value">
                                            {{ $v->insurance_name ?? '-' }}
                                        </div>
                                    </div>

                                    <div class="ccr-wide">
                                        <span class="ccr-detail-label">Pickup Address</span>
                                        <div class="ccr-detail-value">
                                            {{ $v->pickup_address ?? '-' }}
                                        </div>
                                    </div>

                                    <div class="ccr-wide">
                                        <span class="ccr-detail-label">Drop Address</span>
                                        <div class="ccr-detail-value">
                                            {{ $v->drop_address ?? '-' }}
                                        </div>
                                    </div>

                                    <div>
                                        <span class="ccr-detail-label">Policy Expiry</span>
                                        <div class="ccr-detail-value">
                                            {{ $v->policy_expiry_date ?? '-' }}
                                        </div>
                                    </div>

                                    <div>
                                        <span class="ccr-detail-label">GSTIN</span>
                                        <div class="ccr-detail-value">
                                            {{ $v->gstin_number ?? '-' }}
                                        </div>
                                    </div>

                                </div>

                            </div>

                        @empty

                            <div class="ccr-no-data">
                                <i class="bx bx-car me-1"></i>
                                No vehicles linked.
                            </div>

                        @endforelse

                    @endif

                </div>

                <div class="ccr-modal-footer">

                    <button
                        class="ccr-close-btn"
                        wire:click="$set('viewCustomerId', null)">
                        Close
                    </button>

                </div>

            </div>

        </div>

    </div>

    <script>
        window.addEventListener('show-customer-modal', () => {})
    </script>

</div>