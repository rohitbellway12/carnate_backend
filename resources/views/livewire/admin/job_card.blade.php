<div class="carnate-jobcard-page">

    <style>
        .carnate-jobcard-page {
            --c-red: #e53935;
            --c-red-dark: #d32f2f;
            --c-red-light: #fff5f5;
            --c-bg: #f7f8fa;
            --c-white: #ffffff;
            --c-text: #111827;
            --c-secondary: #64748b;
            --c-muted: #94a3b8;
            --c-border: #e2e8f0;
            --c-hover: #f8fafc;

            --c-green: #16a34a;
            --c-green-light: #f0fdf4;

            --c-blue: #2563eb;
            --c-blue-light: #eff6ff;

            --c-orange: #f59e0b;
            --c-orange-light: #fffbeb;

            --c-danger: #dc2626;
            --c-danger-light: #fef2f2;
        }

        .carnate-jobcard-page {
            background: var(--c-bg);
            min-height: 100%;
            color: var(--c-text);
        }

        /* Success */
        .carnate-success-alert {
            border: 1px solid #bbf7d0;
            background: var(--c-green-light);
            color: #166534;
            border-radius: 10px;
            padding: 12px 16px;
            margin-bottom: 18px;
            font-size: 14px;
            font-weight: 500;
        }

        /* Page Header */
        .carnate-page-header {
            background: var(--c-white);
            border: 1px solid var(--c-border);
            border-radius: 14px;
            padding: 20px 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            box-shadow: 0 2px 8px rgba(15, 23, 42, .03);
        }

        .carnate-title-wrap {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .carnate-title-icon {
            width: 42px;
            height: 42px;
            border-radius: 11px;
            background: var(--c-red-light);
            color: var(--c-red);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
        }

        .carnate-page-title {
            margin: 0;
            color: var(--c-text);
            font-size: 19px;
            font-weight: 700;
            line-height: 1.2;
        }

        .carnate-page-subtitle {
            margin: 4px 0 0;
            color: var(--c-secondary);
            font-size: 13px;
        }

        /* Status Cards */
        .carnate-status-section {
            margin-top: 18px;
        }

        .carnate-status-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 14px;
        }

        .carnate-status-card {
            position: relative;
            min-height: 105px;
            padding: 18px;
            border: 1px solid var(--c-border);
            border-radius: 14px;
            background: var(--c-white);
            cursor: pointer;
            overflow: hidden;
            transition: all .2s ease;
            box-shadow: 0 2px 8px rgba(15, 23, 42, .025);
        }

        .carnate-status-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(15, 23, 42, .07);
        }

        .carnate-status-card.active {
            border-color: rgba(229, 57, 53, .35);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .07);
        }

        .carnate-status-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .carnate-status-label {
            display: flex;
            align-items: center;
            gap: 9px;
            color: var(--c-text);
            font-size: 13px;
            font-weight: 700;
        }

        .carnate-status-icon {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
        }

        .carnate-status-count {
            font-size: 24px;
            line-height: 1;
            font-weight: 750;
            color: var(--c-text);
        }

        .carnate-status-open .carnate-status-icon {
            background: var(--c-red-light);
            color: var(--c-red);
        }

        .carnate-status-confirmed .carnate-status-icon {
            background: var(--c-blue-light);
            color: var(--c-blue);
        }

        .carnate-status-completed .carnate-status-icon {
            background: var(--c-green-light);
            color: var(--c-green);
        }

        .carnate-status-closed .carnate-status-icon {
            background: var(--c-orange-light);
            color: var(--c-orange);
        }

        .carnate-status-bottom {
            margin-top: 10px;
            color: var(--c-muted);
            font-size: 11px;
        }

        .carnate-status-indicator {
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            border-radius: 14px 0 0 14px;
        }

        .carnate-status-open .carnate-status-indicator {
            background: var(--c-red);
        }

        .carnate-status-confirmed .carnate-status-indicator {
            background: var(--c-blue);
        }

        .carnate-status-completed .carnate-status-indicator {
            background: var(--c-green);
        }

        .carnate-status-closed .carnate-status-indicator {
            background: var(--c-orange);
        }

        /* Filter */
        .carnate-filter-card {
            margin-top: 18px;
            background: var(--c-white);
            border: 1px solid var(--c-border);
            border-radius: 14px;
            padding: 18px;
            box-shadow: 0 2px 8px rgba(15, 23, 42, .025);
        }

        .carnate-filter-grid {
            display: grid;
            grid-template-columns: minmax(250px, 1fr) auto;
            gap: 14px;
            align-items: end;
        }

        .carnate-field-label {
            display: block;
            margin-bottom: 7px;
            color: var(--c-text);
            font-size: 13px;
            font-weight: 600;
        }

        .carnate-form-control {
            width: 100%;
            height: 43px;
            padding: 0 13px;
            border: 1px solid var(--c-border);
            border-radius: 9px;
            background: #fff;
            color: var(--c-text);
            font-size: 14px;
            outline: none;
            transition: all .2s ease;
        }

        .carnate-form-control::placeholder {
            color: var(--c-muted);
        }

        .carnate-form-control:focus {
            border-color: rgba(229, 57, 53, .55);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        .carnate-clear-btn {
            height: 43px;
            padding: 0 17px;
            border: 1px solid var(--c-border);
            border-radius: 9px;
            background: #fff;
            color: var(--c-secondary);
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s ease;
        }

        .carnate-clear-btn:hover {
            background: var(--c-hover);
            color: var(--c-text);
            border-color: #cbd5e1;
        }

        /* Table Card */
        .carnate-table-card {
            margin-top: 18px;
            background: var(--c-white);
            border: 1px solid var(--c-border);
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(15, 23, 42, .025);
        }

        .carnate-table-header {
            padding: 17px 20px;
            border-bottom: 1px solid var(--c-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .carnate-table-heading {
            margin: 0;
            color: var(--c-text);
            font-size: 15px;
            font-weight: 700;
        }

        .carnate-table-count {
            padding: 5px 10px;
            border: 1px solid var(--c-border);
            border-radius: 20px;
            background: #f8fafc;
            color: var(--c-secondary);
            font-size: 12px;
            font-weight: 600;
        }

        .carnate-table-wrap {
            overflow-x: auto;
        }

        .carnate-table {
            width: 100%;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .carnate-table thead th {
            padding: 13px 15px;
            background: #f8fafc;
            border-bottom: 1px solid var(--c-border);
            color: var(--c-secondary);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .04em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .carnate-table tbody td {
            padding: 14px 15px;
            border-bottom: 1px solid #eef2f6;
            color: var(--c-text);
            font-size: 13px;
            vertical-align: middle;
            white-space: nowrap;
        }

        .carnate-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-table tbody tr {
            transition: background .15s ease;
        }

        .carnate-table tbody tr:hover {
            background: var(--c-hover);
        }

        .carnate-serial {
            color: var(--c-muted);
            font-weight: 600;
        }

        /* Table Cells */
        .carnate-date {
            color: var(--c-secondary);
            font-size: 12px;
        }

        .carnate-job-number {
            display: inline-flex;
            align-items: center;
            padding: 6px 10px;
            border-radius: 7px;
            background: var(--c-red-light);
            color: var(--c-red);
            font-size: 12px;
            font-weight: 700;
        }

        .carnate-customer-name {
            color: var(--c-text);
            font-weight: 600;
        }

        .carnate-vehicle-number {
            font-weight: 600;
            color: var(--c-text);
        }

        .carnate-vehicle {
            color: var(--c-secondary);
        }

        .carnate-amount {
            font-weight: 650;
            color: var(--c-text);
        }

        .carnate-advance {
            color: var(--c-green);
            font-weight: 600;
        }

        .carnate-balance {
            color: var(--c-orange);
            font-weight: 650;
        }

        /* Status Badge */
        .carnate-status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
        }

        .carnate-status-badge::before {
            content: "";
            width: 6px;
            height: 6px;
            border-radius: 50%;
        }

        .carnate-badge-open {
            color: var(--c-red);
            background: var(--c-red-light);
        }

        .carnate-badge-open::before {
            background: var(--c-red);
        }

        .carnate-badge-confirmed {
            color: var(--c-blue);
            background: var(--c-blue-light);
        }

        .carnate-badge-confirmed::before {
            background: var(--c-blue);
        }

        .carnate-badge-completed {
            color: var(--c-green);
            background: var(--c-green-light);
        }

        .carnate-badge-completed::before {
            background: var(--c-green);
        }

        .carnate-badge-closed {
            color: #b45309;
            background: var(--c-orange-light);
        }

        .carnate-badge-closed::before {
            background: var(--c-orange);
        }

        /* Pagination */
        .carnate-pagination {
            padding: 16px 20px;
            border-top: 1px solid var(--c-border);
        }

        /* Empty */
        .carnate-empty {
            padding: 55px 20px;
            text-align: center;
        }

        .carnate-empty-icon {
            width: 58px;
            height: 58px;
            margin: 0 auto 14px;
            border-radius: 15px;
            background: #f8fafc;
            color: var(--c-muted);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .carnate-empty-title {
            margin: 0 0 5px;
            color: var(--c-text);
            font-size: 15px;
            font-weight: 700;
        }

        .carnate-empty-text {
            margin: 0;
            color: var(--c-secondary);
            font-size: 13px;
        }

        /* Responsive */
        @media (max-width: 1100px) {
            .carnate-status-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 700px) {
            .carnate-status-grid {
                grid-template-columns: 1fr;
            }

            .carnate-filter-grid {
                grid-template-columns: 1fr;
            }

            .carnate-clear-btn {
                width: 100%;
            }
        }
    </style>

    {{-- Success Message --}}
    @if (session()->has('message'))
        <div class="carnate-success-alert">
            <i class="bx bx-check-circle me-1"></i>
            {{ session('message') }}
        </div>
    @endif

    {{-- Page Header --}}
    <div class="carnate-page-header">

        <div class="carnate-title-wrap">

            <div class="carnate-title-icon">
                <i class="fas fa-tasks"></i>
            </div>

            <div>
                <h4 class="carnate-page-title">
                    Job Cards
                </h4>

                <p class="carnate-page-subtitle">
                    Monitor and manage workshop job cards
                </p>
            </div>

        </div>

    </div>

    @if (!empty($jobcards) && $jobcards->count())

        {{-- Status Overview --}}
        <div class="carnate-status-section">

            <div class="carnate-status-grid">

                {{-- Open --}}
                <div
                    class="carnate-status-card carnate-status-open"
                    wire:click="$set('mode', 00)"
                >
                    <span class="carnate-status-indicator"></span>

                    <div class="carnate-status-top">

                        <div class="carnate-status-label">

                            <span class="carnate-status-icon">
                                <i class="fa-solid fa-unlock"></i>
                            </span>

                            Open

                        </div>

                        <span class="carnate-status-count">
                            {{ count($jobcardsCount->where('status', 0)) }}
                        </span>

                    </div>

                    <div class="carnate-status-bottom">
                        Job cards awaiting confirmation
                    </div>

                </div>

                {{-- Confirmed --}}
                <div
                    class="carnate-status-card carnate-status-confirmed"
                    wire:click="$set('mode', 1)"
                >
                    <span class="carnate-status-indicator"></span>

                    <div class="carnate-status-top">

                        <div class="carnate-status-label">

                            <span class="carnate-status-icon">
                                <i class="fa-solid fa-circle-check"></i>
                            </span>

                            Confirmed

                        </div>

                        <span class="carnate-status-count">
                            {{ count($jobcardsCount->where('status', 1)) }}
                        </span>

                    </div>

                    <div class="carnate-status-bottom">
                        Confirmed workshop jobs
                    </div>

                </div>

                {{-- Completed --}}
                <div
                    class="carnate-status-card carnate-status-completed"
                    wire:click="$set('mode', 2)"
                >
                    <span class="carnate-status-indicator"></span>

                    <div class="carnate-status-top">

                        <div class="carnate-status-label">

                            <span class="carnate-status-icon">
                                <i class="fa-solid fa-flag-checkered"></i>
                            </span>

                            Completed

                        </div>

                        <span class="carnate-status-count">
                            {{ count($jobcardsCount->where('status', 2)) }}
                        </span>

                    </div>

                    <div class="carnate-status-bottom">
                        Successfully completed jobs
                    </div>

                </div>

                {{-- Closed --}}
                <div
                    class="carnate-status-card carnate-status-closed"
                    wire:click="$set('mode', 3)"
                >
                    <span class="carnate-status-indicator"></span>

                    <div class="carnate-status-top">

                        <div class="carnate-status-label">

                            <span class="carnate-status-icon">
                                <i class="fa-solid fa-xmark"></i>
                            </span>

                            Closed

                        </div>

                        <span class="carnate-status-count">
                            {{ count($jobcardsCount->where('status', 3)) }}
                        </span>

                    </div>

                    <div class="carnate-status-bottom">
                        Closed job cards
                    </div>

                </div>

            </div>

        </div>

        {{-- Search --}}
        <div class="carnate-filter-card">

            <div class="carnate-filter-grid">

                <div>

                    <label class="carnate-field-label">
                        Search Job Card
                    </label>

                    <input
                        type="text"
                        class="carnate-form-control"
                        placeholder="Search Job-Card Number..."
                        wire:model.live="searchfilter"
                    >

                </div>

                <div>

                    <button
                        type="button"
                        class="carnate-clear-btn"
                        wire:click="resetFilter"
                    >
                        <i class="bx bx-refresh me-1"></i>
                        Clear
                    </button>

                </div>

            </div>

        </div>

        {{-- Job Cards Table --}}
        <div class="carnate-table-card">

            <div class="carnate-table-header">

                <h5 class="carnate-table-heading">
                    Job Cards
                </h5>

                <span class="carnate-table-count">
                    {{ $jobcards->total() }} Total
                </span>

            </div>

            <div class="carnate-table-wrap">

                <table class="carnate-table">

                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Entry Date</th>
                            <th>Job-Card Number</th>
                            <th>Customer Name</th>
                            <th>Vehicle Number</th>
                            <th>Vehicle</th>
                            <th>Bill Amount</th>
                            <th>Advance</th>
                            <th>Balance</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($jobcards as $index => $jobcard)

                            <tr>

                                {{-- S.No --}}
                                <td>
                                    <span class="carnate-serial">
                                        {{ $jobcards->total() - ($jobcards->firstItem() + $index) + 1 }}
                                    </span>
                                </td>

                                {{-- Entry Date --}}
                                <td>
                                    <span class="carnate-date">
                                        <i class="bx bx-calendar me-1"></i>
                                        {{ \Carbon\Carbon::parse($jobcard->entry_date)->format('d-m-Y h:i A') ?? '-' }}
                                    </span>
                                </td>

                                {{-- Job Card --}}
                                <td>
                                    <span class="carnate-job-number">
                                        {{ $jobcard->jobcard_number ?? '-' }}
                                    </span>
                                </td>

                                {{-- Customer --}}
                                <td>
                                    <span class="carnate-customer-name">
                                        {{ $jobcard->customer_name ?? '-' }}
                                    </span>
                                </td>

                                {{-- Vehicle Number --}}
                                <td>
                                    <span class="carnate-vehicle-number">
                                        {{ $jobcard->vehical_number ?? '-' }}
                                    </span>
                                </td>

                                {{-- Vehicle --}}
                                <td>
                                    <span class="carnate-vehicle">
                                        {{ $jobcard->vehical ?? '-' }}
                                    </span>
                                </td>

                                {{-- Bill Amount --}}
                                <td>
                                    <span class="carnate-amount">
                                        {{ $jobcard->amount ?? '-' }}
                                    </span>
                                </td>

                                {{-- Advance --}}
                                <td>
                                    <span class="carnate-advance">
                                        {{ $jobcard->advance ?? '-' }}
                                    </span>
                                </td>

                                {{-- Balance --}}
                                <td>
                                    <span class="carnate-balance">
                                        {{ $jobcard->balance_amount ?? '-' }}
                                    </span>
                                </td>

                                {{-- Status --}}
                                <td>

                                    @switch($jobcard->status)

                                        @case(1)
                                            <span class="carnate-status-badge carnate-badge-confirmed">
                                                Confirmed
                                            </span>
                                            @break

                                        @case(2)
                                            <span class="carnate-status-badge carnate-badge-completed">
                                                Completed
                                            </span>
                                            @break

                                        @case(3)
                                            <span class="carnate-status-badge carnate-badge-closed">
                                                Closed
                                            </span>
                                            @break

                                        @default
                                            <span class="carnate-status-badge carnate-badge-open">
                                                Open
                                            </span>

                                    @endswitch

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            {{-- Pagination --}}
            <div class="carnate-pagination">
                {{ $jobcards->links() }}
            </div>

        </div>

    @else

        {{-- Empty State --}}
        <div class="carnate-table-card">

            <div class="carnate-empty">

                <div class="carnate-empty-icon">
                    <i class="bx bx-clipboard"></i>
                </div>

                <h5 class="carnate-empty-title">
                    No Job Cards Found
                </h5>

                <p class="carnate-empty-text">
                    There are no job cards matching your current filters.
                </p>

            </div>

        </div>

    @endif

</div>

@section('footerscript')
@endsection