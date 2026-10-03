<div class="carnate-staff-report-page">

    <style>
        .carnate-staff-report-page {
            --st-bg: #f7f8fa;
            --st-card: #ffffff;
            --st-text: #111827;
            --st-muted: #64748b;
            --st-border: #e2e8f0;
            --st-red: #e53935;
            --st-red-dark: #c92f2c;
            --st-red-soft: #fff5f5;
            --st-green: #16a34a;
            --st-green-soft: #f0fdf4;
            --st-icon: #f1f5f9;
            --st-shadow: 0 8px 28px rgba(15, 23, 42, .06);

            color: var(--st-text);
        }

        /* =========================
           Header
        ========================== */
        .carnate-staff-report-page .st-header {
            background: var(--st-card);
            border: 1px solid var(--st-border);
            border-radius: 16px;
            padding: 18px 20px;
            box-shadow: var(--st-shadow);
            margin-bottom: 18px;
        }

        .carnate-staff-report-page .st-header-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .carnate-staff-report-page .st-title-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
        }

        .carnate-staff-report-page .st-title-icon {
            width: 43px;
            height: 43px;
            border-radius: 11px;
            background: var(--st-red-soft);
            color: var(--st-red);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 21px;
        }

        .carnate-staff-report-page .st-title {
            margin: 0;
            color: var(--st-text);
            font-size: 19px;
            font-weight: 700;
        }

        .carnate-staff-report-page .st-subtitle {
            margin: 3px 0 0;
            color: var(--st-muted);
            font-size: 12px;
        }

        /* =========================
           Filters
        ========================== */
        .carnate-staff-report-page .st-filters {
            display: flex;
            align-items: flex-end;
            justify-content: flex-end;
            gap: 9px;
            flex-wrap: wrap;
        }

        .carnate-staff-report-page .st-filter-item {
            min-width: 125px;
        }

        .carnate-staff-report-page .st-filter-item.search {
            width: 190px;
        }

        .carnate-staff-report-page .st-filter-label {
            display: block;
            margin-bottom: 5px;
            color: #64748b;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
        }

        .carnate-staff-report-page .st-input,
        .carnate-staff-report-page .st-select {
            height: 38px;
            width: 100%;
            border: 1px solid var(--st-border);
            border-radius: 9px;
            background: #fff;
            color: var(--st-text);
            font-size: 12px;
            padding: 0 11px;
            outline: none;
            box-shadow: none;
            transition: .2s ease;
        }

        .carnate-staff-report-page .st-input:focus,
        .carnate-staff-report-page .st-select:focus {
            border-color: rgba(229, 57, 53, .45);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        .carnate-staff-report-page .st-export {
            height: 38px;
            border: 0;
            border-radius: 9px;
            padding: 0 14px;
            background: var(--st-red);
            color: #fff;
            font-size: 12px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            transition: .2s ease;
        }

        .carnate-staff-report-page .st-export:hover {
            background: var(--st-red-dark);
            color: #fff;
            transform: translateY(-1px);
        }

        /* =========================
           Summary
        ========================== */
        .carnate-staff-report-page .st-summary-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
            margin-bottom: 18px;
        }

        .carnate-staff-report-page .st-summary-card {
            min-height: 92px;
            background: var(--st-card);
            border: 1px solid var(--st-border);
            border-radius: 14px;
            box-shadow: var(--st-shadow);
            padding: 17px;
        }

        .carnate-staff-report-page .st-summary-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 100%;
        }

        .carnate-staff-report-page .st-summary-label {
            margin: 0 0 5px;
            color: var(--st-muted);
            font-size: 11px;
            font-weight: 600;
        }

        .carnate-staff-report-page .st-summary-value {
            color: var(--st-text);
            font-size: 18px;
            font-weight: 800;
        }

        .carnate-staff-report-page .st-summary-icon {
            width: 40px;
            height: 40px;
            border-radius: 11px;
            background: var(--st-icon);
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .carnate-staff-report-page .st-summary-card.amount .st-summary-icon {
            background: var(--st-green-soft);
            color: var(--st-green);
        }

        /* =========================
           Main table
        ========================== */
        .carnate-staff-report-page .st-table-card {
            background: var(--st-card);
            border: 1px solid var(--st-border);
            border-radius: 16px;
            box-shadow: var(--st-shadow);
            overflow: hidden;
        }

        .carnate-staff-report-page .st-table-header {
            padding: 17px 20px;
            border-bottom: 1px solid var(--st-border);
        }

        .carnate-staff-report-page .st-table-title {
            margin: 0;
            color: var(--st-text);
            font-size: 15px;
            font-weight: 700;
        }

        .carnate-staff-report-page .st-table-subtitle {
            margin: 3px 0 0;
            color: var(--st-muted);
            font-size: 11px;
        }

        .carnate-staff-report-page .st-table-wrap {
            width: 100%;
            overflow-x: auto;
        }

        .carnate-staff-report-page .st-table {
            width: 100%;
            min-width: 850px;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .carnate-staff-report-page .st-table thead th {
            background: #f8fafc;
            color: #475569;
            border-bottom: 1px solid var(--st-border);
            padding: 13px 15px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
            white-space: nowrap;
        }

        .carnate-staff-report-page .st-table tbody td {
            padding: 14px 15px;
            border-bottom: 1px solid #eef2f7;
            color: #334155;
            background: #fff;
            font-size: 12px;
            vertical-align: middle;
        }

        .carnate-staff-report-page .st-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-staff-report-page .st-table tbody tr:hover td {
            background: #fafafa;
        }

        .carnate-staff-report-page .st-index {
            color: #94a3b8;
            font-weight: 600;
        }

        .carnate-staff-report-page .st-employee {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 150px;
        }

        .carnate-staff-report-page .st-avatar {
            width: 35px;
            height: 35px;
            border-radius: 9px;
            background: var(--st-icon);
            color: #64748b;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            flex-shrink: 0;
        }

        .carnate-staff-report-page .st-name {
            color: var(--st-text);
            font-weight: 700;
        }

        .carnate-staff-report-page .st-email {
            color: var(--st-muted);
        }

        .carnate-staff-report-page .st-role {
            display: inline-flex;
            align-items: center;
            padding: 5px 9px;
            border-radius: 7px;
            background: #f1f5f9;
            color: #475569;
            font-size: 10px;
            font-weight: 700;
        }

        .carnate-staff-report-page .st-salary {
            color: var(--st-text);
            font-weight: 700;
        }

        /* Action */
        .carnate-staff-report-page .st-view-btn {
            width: 34px;
            height: 34px;
            border: 1px solid var(--st-border);
            border-radius: 8px;
            background: #fff;
            color: #64748b;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            cursor: pointer;
            transition: .2s ease;
        }

        .carnate-staff-report-page .st-view-btn:hover {
            color: var(--st-red);
            border-color: rgba(229, 57, 53, .3);
            background: var(--st-red-soft);
        }

        .carnate-staff-report-page .st-view-btn i {
            font-size: 17px;
        }

        /* Footer */
        .carnate-staff-report-page .st-table-footer {
            min-height: 58px;
            padding: 12px 20px;
            border-top: 1px solid var(--st-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .carnate-staff-report-page .st-showing {
            color: var(--st-muted);
            font-size: 11px;
        }

        /* =========================
           View Modal
        ========================== */
        .carnate-staff-report-page .st-modal {
            z-index: 1055;
        }

        .carnate-staff-report-page .st-modal .modal-dialog {
            margin-top: 5vh;
        }

        .carnate-staff-report-page .st-modal .modal-content {
            border: 0;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 24px 70px rgba(15, 23, 42, .20);
        }

        .carnate-staff-report-page .st-modal .modal-header {
            padding: 18px 22px;
            border-bottom: 1px solid var(--st-border);
            background: #fff;
        }

        .carnate-staff-report-page .st-modal .modal-title {
            margin: 0;
            color: var(--st-text);
            font-size: 17px;
            font-weight: 700;
        }

        .carnate-staff-report-page .st-modal .modal-body {
            padding: 22px;
            background: #f8fafc;
        }

        .carnate-staff-report-page .st-modal .modal-footer {
            padding: 15px 22px;
            border-top: 1px solid var(--st-border);
            background: #fff;
        }

        /* Staff information */
        .carnate-staff-report-page .st-profile-card {
            background: #fff;
            border: 1px solid var(--st-border);
            border-radius: 13px;
            padding: 18px;
            margin-bottom: 20px;
        }

        .carnate-staff-report-page .st-info-item {
            min-height: 58px;
        }

        .carnate-staff-report-page .st-info-label {
            margin-bottom: 5px;
            color: #94a3b8;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
        }

        .carnate-staff-report-page .st-info-value {
            color: var(--st-text);
            font-size: 13px;
            font-weight: 600;
            word-break: break-word;
        }

        .carnate-staff-report-page .st-section-title {
            margin: 0 0 10px;
            color: var(--st-text);
            font-size: 14px;
            font-weight: 700;
        }

        /* Labour entries */
        .carnate-staff-report-page .st-labour-card {
            background: #fff;
            border: 1px solid var(--st-border);
            border-radius: 13px;
            overflow: hidden;
        }

        .carnate-staff-report-page .st-labour-table {
            width: 100%;
            min-width: 650px;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .carnate-staff-report-page .st-labour-table th {
            padding: 11px 13px;
            background: #f8fafc;
            border-bottom: 1px solid var(--st-border);
            color: #475569;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .carnate-staff-report-page .st-labour-table td {
            padding: 11px 13px;
            border-bottom: 1px solid #eef2f7;
            color: #334155;
            font-size: 11px;
            white-space: nowrap;
        }

        .carnate-staff-report-page .st-labour-table tr:last-child td {
            border-bottom: 0;
        }

        .carnate-staff-report-page .st-jobcard {
            color: var(--st-red);
            font-weight: 700;
        }

        .carnate-staff-report-page .st-empty {
            padding: 35px 15px !important;
            text-align: center;
            color: var(--st-muted);
        }

        .carnate-staff-report-page .st-close-btn {
            border: 1px solid var(--st-border);
            background: #fff;
            color: #475569;
            border-radius: 9px;
            padding: 8px 16px;
            font-size: 12px;
            font-weight: 600;
        }

        .carnate-staff-report-page .st-close-btn:hover {
            background: #f8fafc;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .carnate-staff-report-page .st-header-inner {
                align-items: flex-start;
                flex-direction: column;
            }

            .carnate-staff-report-page .st-filters {
                width: 100%;
                justify-content: flex-start;
            }
        }

        @media (max-width: 767.98px) {
            .carnate-staff-report-page .st-header {
                padding: 16px;
            }

            .carnate-staff-report-page .st-filters {
                display: grid;
                grid-template-columns: 1fr 1fr;
            }

            .carnate-staff-report-page .st-filter-item,
            .carnate-staff-report-page .st-filter-item.search {
                width: 100%;
                min-width: 0;
            }

            .carnate-staff-report-page .st-export {
                width: 100%;
            }

            .carnate-staff-report-page .st-summary-grid {
                grid-template-columns: 1fr 1fr;
            }

            .carnate-staff-report-page .st-table-footer {
                align-items: flex-start;
                flex-direction: column;
            }

            .carnate-staff-report-page .st-modal .modal-dialog {
                margin: 12px;
            }

            .carnate-staff-report-page .st-modal .modal-body {
                padding: 16px;
            }
        }

        @media (max-width: 480px) {
            .carnate-staff-report-page .st-filters,
            .carnate-staff-report-page .st-summary-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    {{-- =========================
         Header
    ========================== --}}
    <div class="st-header">

        <div class="st-header-inner">

            <div class="st-title-wrap">
                <div class="st-title-icon">
                    <i class="bx bx-group"></i>
                </div>

                <div>
                    <h5 class="st-title">Staff Report</h5>
                    <p class="st-subtitle">
                        Staff details, salary and labour activity
                    </p>
                </div>
            </div>

            {{-- Filters --}}
            <div class="st-filters">

                {{-- Search --}}
                <div class="st-filter-item search">
                    <label class="st-filter-label">Search</label>

                    <input type="text"
                        class="st-input"
                        placeholder="Search staff..."
                        wire:model.live="search">
                </div>

                {{-- Filter Type --}}
                <div class="st-filter-item">
                    <label class="st-filter-label">Filter Type</label>

                    <select class="st-select"
                        wire:model.live="filterType">
                        <option value="">All</option>
                        <option value="daily">Today</option>
                        <option value="weekly">This Week</option>
                        <option value="monthly">This Month</option>
                    </select>
                </div>

                {{-- From --}}
                <div class="st-filter-item">
                    <label class="st-filter-label">From</label>

                    <input type="date"
                        class="st-input"
                        wire:model.lazy="fromDate">
                </div>

                {{-- To --}}
                <div class="st-filter-item">
                    <label class="st-filter-label">To</label>

                    <input type="date"
                        class="st-input"
                        wire:model.lazy="toDate">
                </div>

                {{-- Export --}}
                <div>
                    <label class="st-filter-label">&nbsp;</label>

                    <button class="st-export"
                        wire:click="downloadPDF">
                        <i class="bx bxs-file-pdf"></i>
                        Export PDF
                    </button>
                </div>

            </div>

        </div>

    </div>

    {{-- =========================
         Summary Cards
    ========================== --}}
    <div class="st-summary-grid">

        {{-- Total Staff --}}
        <div class="st-summary-card">

            <div class="st-summary-inner">

                <div>
                    <p class="st-summary-label">Total Staff</p>

                    <span class="st-summary-value">
                        {{ $totals['total_staff'] ?? 0 }}
                    </span>
                </div>

                <div class="st-summary-icon">
                    <i class="bx bx-group"></i>
                </div>

            </div>

        </div>

        {{-- Total Labour Amount --}}
        <div class="st-summary-card amount">

            <div class="st-summary-inner">

                <div>
                    <p class="st-summary-label">Total Labour Amount</p>

                    <span class="st-summary-value">
                        ₹{{ number_format($totals['total_labour_amount'] ?? 0, 2) }}
                    </span>
                </div>

                <div class="st-summary-icon">
                    <i class="bx bx-wallet"></i>
                </div>

            </div>

        </div>

    </div>

    {{-- =========================
         Staff Table
    ========================== --}}
    <div class="st-table-card">

        <div class="st-table-header">
            <h6 class="st-table-title">Staff Details</h6>

            <p class="st-table-subtitle">
                Employee information and salary overview
            </p>
        </div>

        <div class="st-table-wrap">

            <table class="table st-table">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Role</th>
                        <th>Salary</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($staff as $s)

                        <tr>

                            <td>
                                <span class="st-index">
                                    {{ $staff->total() - ($loop->index + ($staff->currentPage() - 1) * $staff->perPage()) }}
                                </span>
                            </td>

                            <td>
                                <div class="st-employee">

                                    <span class="st-avatar">
                                        <i class="bx bx-user"></i>
                                    </span>

                                    <span class="st-name">
                                        {{ $s->name }} {{ $s->lastname }}
                                    </span>

                                </div>
                            </td>

                            <td>
                                <span class="st-email">
                                    {{ $s->email }}
                                </span>
                            </td>

                            <td>
                                {{ $s->mobile_no }}
                            </td>

                            <td>
                                <span class="st-role">
                                    {{ $s->Role->name ?? '-' }}
                                </span>
                            </td>

                            <td>
                                <span class="st-salary">
                                    {{ $s->salary ?? '-' }}
                                </span>
                            </td>

                            <td class="text-center">

                                <button type="button"
                                    class="st-view-btn"
                                    wire:click="viewStaff({{ $s->id }})"
                                    title="View Staff">
                                    <i class="bx bx-show"></i>
                                </button>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="st-empty">
                                <i class="bx bx-group"
                                    style="font-size:28px; display:block; margin-bottom:8px; color:#94a3b8;"></i>

                                No staff found.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="st-table-footer">

            <small class="st-showing">
                Showing {{ $staff->firstItem() }}–{{ $staff->lastItem() }}
                of {{ $staff->total() }}
            </small>

            <div>
                {!! $staff->links() !!}
            </div>

        </div>

    </div>

    {{-- =========================
         View Staff Modal
    ========================== --}}
    <div class="modal fade st-modal @if($detail) show d-block @endif"
        tabindex="-1"
        style="@if($detail) display:block; background:rgba(15,23,42,.48); @endif"
        @if(!$detail) aria-hidden="true" @endif>

        <div class="modal-dialog modal-xl modal-dialog-scrollable">

            <div class="modal-content">

                {{-- Modal Header --}}
                <div class="modal-header">

                    <div>
                        <h5 class="modal-title">
                            Staff Details
                        </h5>
                    </div>

                    <button type="button"
                        class="btn-close"
                        wire:click="$set('viewStaffId', null)"
                        aria-label="Close">
                    </button>

                </div>

                <div class="modal-body">

                    @if($detail)

                        {{-- Staff Information --}}
                        <div class="st-profile-card">

                            <div class="row g-3">

                                <div class="col-md-3">
                                    <div class="st-info-item">
                                        <div class="st-info-label">Name</div>
                                        <div class="st-info-value">
                                            {{ $detail->name }} {{ $detail->lastname }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="st-info-item">
                                        <div class="st-info-label">Email</div>
                                        <div class="st-info-value">
                                            {{ $detail->email }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="st-info-item">
                                        <div class="st-info-label">Mobile</div>
                                        <div class="st-info-value">
                                            {{ $detail->mobile_no }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="st-info-item">
                                        <div class="st-info-label">Salary</div>
                                        <div class="st-info-value">
                                            ₹{{ number_format($detail->salary ?? 0, 2) }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="st-info-item">
                                        <div class="st-info-label">Monthly Target</div>
                                        <div class="st-info-value">
                                            ₹{{ number_format($detail->monthly_target ?? 0, 2) }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="st-info-item">
                                        <div class="st-info-label">Incentive</div>
                                        <div class="st-info-value">
                                            {{ $detail->incentives ?? 0 }}%
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                        {{-- Labour Entries --}}
                        <h6 class="st-section-title">
                            Labour Entries
                        </h6>

                        <div class="st-labour-card">

                            <div class="table-responsive">

                                <table class="st-labour-table">

                                    <thead>
                                        <tr>
                                            <th>Jobcard</th>
                                            <th>Customer</th>
                                            <th>Plate</th>
                                            <th>Qty</th>
                                            <th>Amount</th>
                                            <th>GST</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @forelse($detail->labours as $l)

                                            <tr>

                                                <td>
                                                    <span class="st-jobcard">
                                                        {{ $l->jobcard_number }}
                                                    </span>
                                                </td>

                                                <td>
                                                    {{ $l->customer_name }}
                                                </td>

                                                <td>
                                                    {{ $l->vehical_number }}
                                                </td>

                                                <td>
                                                    {{ $l->qty ?? 1 }}
                                                </td>

                                                <td>
                                                    ₹{{ number_format($l->amount ?? 0, 2) }}
                                                </td>

                                                <td>
                                                    {{ $l->gst ?? 0 }}%
                                                </td>

                                                <td>
                                                    {{ optional($l->created_at)->format('d M Y') }}
                                                </td>

                                            </tr>

                                        @empty

                                            <tr>
                                                <td colspan="7" class="st-empty">
                                                    No labour entries.
                                                </td>
                                            </tr>

                                        @endforelse

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    @endif

                </div>

                {{-- Modal Footer --}}
                <div class="modal-footer">

                    <button type="button"
                        class="st-close-btn"
                        wire:click="$set('viewStaffId', null)">
                        Close
                    </button>

                </div>

            </div>

        </div>

    </div>

</div>