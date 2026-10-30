@php
    $modeClass = match((int)$mode) {
        0 => 'thead-open',
        4 => 'thead-process',
        1 => 'thead-confirmed',
        2 => 'thead-completed',
        3 => 'thead-closed',
        5 => 'thead-deleted',
        default => 'thead-total',
    };
@endphp


<div class="carnate-jobcard-report">

    <style>
        .carnate-jobcard-report {
            --cj-bg: #f7f8fa;
            --cj-card: #ffffff;
            --cj-text: #111827;
            --cj-muted: #64748b;
            --cj-border: #e2e8f0;
            --cj-red: #e53935;
            --cj-red-soft: #fff5f5;
            --cj-shadow: 0 8px 24px rgba(15, 23, 42, .06);
            color: var(--cj-text);
        }

        .carnate-jobcard-report .cj-page {
            background: var(--cj-bg);
            border-radius: 18px;
            padding: 24px;
        }

        .carnate-jobcard-report .cj-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 22px;
        }

        .carnate-jobcard-report .cj-title-wrap {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .carnate-jobcard-report .cj-title-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--cj-red-soft);
            color: var(--cj-red);
            font-size: 20px;
        }

        .carnate-jobcard-report .cj-title {
            margin: 0;
            font-size: 23px;
            line-height: 1.2;
            font-weight: 750;
            letter-spacing: -.02em;
            color: var(--cj-text);
        }

        .carnate-jobcard-report .cj-subtitle {
            margin: 4px 0 0;
            color: var(--cj-muted);
            font-size: 13px;
        }

        .carnate-jobcard-report .cj-add-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            min-height: 42px;
            padding: 0 17px;
            border-radius: 10px;
            border: 1px solid var(--cj-red);
            background: var(--cj-red);
            color: #fff !important;
            font-size: 14px;
            font-weight: 650;
            text-decoration: none;
            box-shadow: 0 5px 14px rgba(229, 57, 53, .18);
            transition: all .2s ease;
        }

        .carnate-jobcard-report .cj-add-btn:hover {
            background: #d9322f;
            border-color: #d9322f;
            color: #fff !important;
            transform: translateY(-1px);
        }

        /* Status cards */
        .carnate-jobcard-report .cj-status-grid {
            display: grid;
            grid-template-columns: repeat(7, minmax(0, 1fr));
            gap: 12px;
            margin-bottom: 20px;
        }

        .carnate-jobcard-report .cj-status-card {
            position: relative;
            overflow: hidden;
            min-height: 94px;
            border-radius: 14px;
            padding: 16px;
            color: #fff;
            cursor: pointer;
            border: 0;
            box-shadow: 0 7px 20px rgba(15, 23, 42, .08);
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .carnate-jobcard-report .cj-status-card::after {
            content: "";
            position: absolute;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            right: -25px;
            bottom: -35px;
            background: rgba(255,255,255,.12);
        }

        .carnate-jobcard-report .cj-status-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 28px rgba(15, 23, 42, .13);
        }

        .carnate-jobcard-report .cj-status-card.active {
            box-shadow:
                0 0 0 3px rgba(229,57,53,.16),
                0 12px 28px rgba(15,23,42,.14);
        }

        .carnate-jobcard-report .cj-status-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
        }

        .carnate-jobcard-report .cj-status-icon {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,.16);
            font-size: 15px;
        }

        .carnate-jobcard-report .cj-status-count {
            font-size: 23px;
            line-height: 1;
            font-weight: 750;
        }

        .carnate-jobcard-report .cj-status-name {
            display: block;
            margin-top: 13px;
            font-size: 12px;
            font-weight: 650;
            opacity: .95;
        }

        .carnate-jobcard-report .cj-open {
            background: linear-gradient(135deg, #ca8a04, #eab308);
        }

        .carnate-jobcard-report .cj-process {
            background: linear-gradient(135deg, #ea580c, #f97316);
        }

        .carnate-jobcard-report .cj-confirmed {
            background: linear-gradient(135deg, #2563eb, #3b82f6);
        }

        .carnate-jobcard-report .cj-completed {
            background: linear-gradient(135deg, #16a34a, #22c55e);
        }

        .carnate-jobcard-report .cj-closed {
            background: linear-gradient(135deg, #0891b2, #06b6d4);
        }

        .carnate-jobcard-report .cj-deleted {
            background: linear-gradient(135deg, #dc2626, #ef4444);
        }

        .carnate-jobcard-report .cj-total {
            background: linear-gradient(135deg, #475569, #64748b);
        }

        /* Main table card */
        .carnate-jobcard-report .cj-table-card {
            background: var(--cj-card);
            border: 1px solid var(--cj-border);
            border-radius: 16px;
            box-shadow: var(--cj-shadow);
            overflow: hidden;
        }

        .carnate-jobcard-report .cj-table-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 18px 20px;
            border-bottom: 1px solid var(--cj-border);
        }

        .carnate-jobcard-report .cj-toolbar-title {
            font-size: 15px;
            font-weight: 700;
            color: var(--cj-text);
        }

        .carnate-jobcard-report .cj-toolbar-meta {
            margin-top: 3px;
            font-size: 12px;
            color: var(--cj-muted);
        }

        .carnate-jobcard-report .cj-filters {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .carnate-jobcard-report .cj-search {
            width: 270px;
            height: 40px;
            border: 1px solid var(--cj-border);
            border-radius: 9px;
            background: #fff;
            color: var(--cj-text);
            padding: 0 13px;
            font-size: 13px;
            outline: none;
            transition: border-color .2s ease, box-shadow .2s ease;
        }

        .carnate-jobcard-report .cj-search:focus {
            border-color: rgba(229,57,53,.55);
            box-shadow: 0 0 0 3px rgba(229,57,53,.08);
        }

        .carnate-jobcard-report .cj-clear {
            height: 40px;
            padding: 0 15px;
            border-radius: 9px;
            border: 1px solid var(--cj-border);
            background: #fff;
            color: #475569;
            font-size: 13px;
            font-weight: 600;
            transition: all .2s ease;
        }

        .carnate-jobcard-report .cj-clear:hover {
            border-color: #cbd5e1;
            background: #f8fafc;
            color: var(--cj-text);
        }

        .carnate-jobcard-report .cj-table-wrap {
            overflow-x: auto;
        }

        .carnate-jobcard-report .jobcardtable {
            width: 100%;
            min-width: 1200px;
            margin: 0;
            border: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .carnate-jobcard-report .jobcardtable thead th {
            border: 0 !important;
            padding: 13px 14px !important;
            font-size: 11px !important;
            font-weight: 700 !important;
            letter-spacing: .45px;
            text-transform: uppercase;
            white-space: nowrap;
            text-shadow: none !important;
            vertical-align: middle;
            color: #ffffff !important;
        }

        .carnate-jobcard-report .jobcardtable thead th:first-child {
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }

        .carnate-jobcard-report .jobcardtable thead th:last-child {
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .carnate-jobcard-report .jobcardtable thead.thead-open,
        .carnate-jobcard-report .jobcardtable thead.thead-open tr,
        .carnate-jobcard-report .jobcardtable thead.thead-open th {
            background: linear-gradient(135deg, #ca8a04, #eab308) !important;
            color: #ffffff !important;
        }

        .carnate-jobcard-report .jobcardtable thead.thead-process,
        .carnate-jobcard-report .jobcardtable thead.thead-process tr,
        .carnate-jobcard-report .jobcardtable thead.thead-process th {
            background: linear-gradient(135deg, #ea580c, #f97316) !important;
            color: #ffffff !important;
        }

        .carnate-jobcard-report .jobcardtable thead.thead-confirmed,
        .carnate-jobcard-report .jobcardtable thead.thead-confirmed tr,
        .carnate-jobcard-report .jobcardtable thead.thead-confirmed th {
            background: linear-gradient(135deg, #2563eb, #3b82f6) !important;
            color: #ffffff !important;
        }

        .carnate-jobcard-report .jobcardtable thead.thead-completed,
        .carnate-jobcard-report .jobcardtable thead.thead-completed tr,
        .carnate-jobcard-report .jobcardtable thead.thead-completed th {
            background: linear-gradient(135deg, #16a34a, #22c55e) !important;
            color: #ffffff !important;
        }

        .carnate-jobcard-report .jobcardtable thead.thead-closed,
        .carnate-jobcard-report .jobcardtable thead.thead-closed tr,
        .carnate-jobcard-report .jobcardtable thead.thead-closed th {
            background: linear-gradient(135deg, #0891b2, #06b6d4) !important;
            color: #ffffff !important;
        }

        .carnate-jobcard-report .jobcardtable thead.thead-deleted,
        .carnate-jobcard-report .jobcardtable thead.thead-deleted tr,
        .carnate-jobcard-report .jobcardtable thead.thead-deleted th {
            background: linear-gradient(135deg, #dc2626, #ef4444) !important;
            color: #ffffff !important;
        }

        .carnate-jobcard-report .jobcardtable thead.thead-total,
        .carnate-jobcard-report .jobcardtable thead.thead-total tr,
        .carnate-jobcard-report .jobcardtable thead.thead-total th {
            background: linear-gradient(135deg, #475569, #64748b) !important;
            color: #ffffff !important;
        }

        .carnate-jobcard-report .jobcardtable tbody td {
            padding: 13px 12px;
            border: 0;
            border-bottom: 1px solid #edf1f5;
            color: #334155;
            font-size: 13px;
            font-weight: 500;
            vertical-align: middle;
            white-space: nowrap;
        }

        .carnate-jobcard-report .jobcardtable tbody tr {
            transition: background .18s ease;
        }

        .carnate-jobcard-report .jobcardtable tbody tr:hover {
            filter: none !important;
        }

        .carnate-jobcard-report .jobcardtable tbody tr:hover td {
            background: rgba(248,250,252,.9);
        }

        .carnate-jobcard-report .jobcardtable tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-jobcard-report .jobcardtable td a {
            color: #334155;
            text-decoration: none;
            font-weight: 600;
        }

        .carnate-jobcard-report .jobcardtable td a:hover {
            color: var(--cj-red) !important;
            text-decoration: none !important;
        }

        .carnate-jobcard-report .jobcardtable td:first-child {
            color: #94a3b8;
            font-size: 12px;
            font-weight: 650;
        }

        .carnate-jobcard-report .jobcardtable td:nth-child(2) {
            color: #64748b;
        }

        .carnate-jobcard-report .jobcardtable td:nth-child(3) a {
            color: #111827;
            font-weight: 750;
        }

        /* Preserve status row meaning, but use much softer colors */
        .carnate-jobcard-report .jobcard-row-status-0 td {
            background: #fefce8;
            color: #854d0e !important;
        }

        .carnate-jobcard-report .jobcard-row-status-0 {
            border-left: 3px solid #eab308;
        }

        .carnate-jobcard-report .jobcard-row-status-5 td {
            background: #fff8f8;
            color: #7f1d1d !important;
        }

        .carnate-jobcard-report .jobcard-row-status-5 {
            border-left: 3px solid #dc2626;
        }

        .carnate-jobcard-report .jobcard-row-status-4 td {
            background: #fffbeb;
        }

        .carnate-jobcard-report .jobcard-row-status-4 {
            border-left: 3px solid #f59e0b;
        }

        .carnate-jobcard-report .jobcard-row-status-1 td {
            background: #f8fbff;
        }

        .carnate-jobcard-report .jobcard-row-status-1 {
            border-left: 3px solid #3b82f6;
        }

        .carnate-jobcard-report .jobcard-row-status-2 td {
            background: #f7fcf8;
        }

        .carnate-jobcard-report .jobcard-row-status-2 {
            border-left: 3px solid #22c55e;
        }

        .carnate-jobcard-report .jobcard-row-status-3 td {
            background: #f5fcfd;
        }

        .carnate-jobcard-report .jobcard-row-status-3 {
            border-left: 3px solid #06b6d4;
        }

        .carnate-jobcard-report .jobcard-row-status-4 td {
            color: #854d0e !important;
        }

        .carnate-jobcard-report .jobcard-row-status-1 td {
            color: #1e40af !important;
        }

        .carnate-jobcard-report .jobcard-row-status-2 td {
            color: #166534 !important;
        }

        .carnate-jobcard-report .jobcard-row-status-3 td {
            color: #155e75 !important;
        }

        .carnate-jobcard-report .jobcardtable .badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 76px;
            padding: 6px 9px;
            border-radius: 999px;
            font-size: 11px;
            line-height: 1;
            font-weight: 700;
            border: 0;
        }

        .carnate-jobcard-report .jobcardtable .badge.badge-open {
            background: #fef9c3 !important;
            color: #854d0e !important;
            border: 1px solid #fde047 !important;
        }

        .carnate-jobcard-report .text-open {
            color: #ca8a04 !important;
        }

        .carnate-jobcard-report .jobcardtable .badge.bg-danger {
            background: #fff0f0 !important;
            color: #dc2626 !important;
        }

        .carnate-jobcard-report .jobcardtable .badge.bg-warning {
            background: #fff7df !important;
            color: #b45309 !important;
        }

        .carnate-jobcard-report .jobcardtable .badge.bg-primary {
            background: #eff6ff !important;
            color: #2563eb !important;
        }

        .carnate-jobcard-report .jobcardtable .badge.bg-success {
            background: #ecfdf3 !important;
            color: #15803d !important;
        }

        .carnate-jobcard-report .jobcardtable .badge.bg-info {
            background: #ecfeff !important;
            color: #0e7490 !important;
        }

        .carnate-jobcard-report .cj-actions {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .carnate-jobcard-report .cj-action-btn {
            width: 32px;
            height: 32px;
            padding: 0 !important;
            border-radius: 8px;
            border: 1px solid var(--cj-border);
            background: #fff;
            color: #64748b;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all .18s ease;
        }

        .carnate-jobcard-report .cj-action-btn:hover {
            background: var(--cj-red-soft);
            border-color: rgba(229,57,53,.25);
            color: var(--cj-red);
        }

        .carnate-jobcard-report .cj-empty {
            padding: 48px 20px;
            text-align: center;
            background: #fff;
        }

        .carnate-jobcard-report .cj-empty-icon {
            width: 54px;
            height: 54px;
            margin: 0 auto 12px;
            border-radius: 14px;
            background: #f1f5f9;
            color: #94a3b8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .carnate-jobcard-report .cj-empty-title {
            margin: 0;
            color: #334155;
            font-size: 14px;
            font-weight: 700;
        }

        .carnate-jobcard-report .cj-empty-text {
            margin: 5px 0 0;
            color: #94a3b8;
            font-size: 12px;
        }

        .carnate-jobcard-report .cj-pagination {
            padding: 15px 20px;
            border-top: 1px solid var(--cj-border);
            background: #fff;
        }

        .carnate-jobcard-report .pagination-wrapper nav {
            margin: 0;
        }

        /* Add/Edit components remain untouched */
        .carnate-jobcard-report > style + div {
            width: 100%;
        }

        @media (max-width: 1400px) {
            .carnate-jobcard-report .cj-status-grid {
                grid-template-columns: repeat(4, minmax(0, 1fr));
            }
        }

        @media (max-width: 900px) {
            .carnate-jobcard-report .cj-page {
                padding: 16px;
            }

            .carnate-jobcard-report .cj-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .carnate-jobcard-report .cj-status-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .carnate-jobcard-report .cj-table-toolbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .carnate-jobcard-report .cj-filters {
                width: 100%;
            }

            .carnate-jobcard-report .cj-search {
                width: 100%;
            }
        }

        @media (max-width: 575px) {
            .carnate-jobcard-report .cj-page {
                padding: 12px;
                border-radius: 12px;
            }

            .carnate-jobcard-report .cj-status-grid {
                grid-template-columns: 1fr;
            }

            .carnate-jobcard-report .cj-filters {
                flex-direction: column;
                align-items: stretch;
            }

            .carnate-jobcard-report .cj-clear {
                width: 100%;
            }

            .carnate-jobcard-report .cj-title {
                font-size: 20px;
            }
        }
    </style>

    @if ($isAdd == true)
        @livewire('Workshop.JobCardAddController')

    @elseif($isEdit == true)
        @livewire('Workshop.JobCardEditController', ['id' => $jobId])

    @else

        <div class="cj-page">

            {{-- Page Header --}}
            <div class="cj-header">
                <div class="cj-title-wrap">
                    <div class="cj-title-icon">
                        <i class="fa-solid fa-clipboard-list"></i>
                    </div>

                    <div>
                        <h1 class="cj-title">Job Cards</h1>
                        <p class="cj-subtitle">Manage and track workshop job cards</p>
                    </div>
                </div>

                @if ($user->hasPermissionTo('Jobcard-add'))
                    <a href="{{ route('workshop.jobcardadd') }}" class="cj-add-btn">
                        <i class="bx bx-plus"></i>
                        <span>Add Job Card</span>
                    </a>
                @endif
            </div>

            {{-- Status Cards --}}
            <div class="cj-status-grid">

                <div class="cj-status-card cj-open {{ $mode === 0 ? 'active' : '' }}"
                     wire:click="$set('mode', 0)">
                    <div class="cj-status-top">
                        <span class="cj-status-icon">
                            <i class="fa-solid fa-unlock"></i>
                        </span>

                        <span class="cj-status-count">
                            {{ count($jobcardsCount->where('soft_delete', 0)->where('status', 0)) }}
                        </span>
                    </div>
                    <span class="cj-status-name">Open</span>
                </div>

                <div class="cj-status-card cj-process {{ $mode === 4 ? 'active' : '' }}"
                     wire:click="$set('mode', 4)">
                    <div class="cj-status-top">
                        <span class="cj-status-icon">
                            <i class="fa-solid fa-gears"></i>
                        </span>

                        <span class="cj-status-count">
                            {{ count($jobcardsCount->where('soft_delete', 0)->where('status', 4)) }}
                        </span>
                    </div>
                    <span class="cj-status-name">Process</span>
                </div>

                <div class="cj-status-card cj-confirmed {{ $mode === 1 ? 'active' : '' }}"
                     wire:click="$set('mode', 1)">
                    <div class="cj-status-top">
                        <span class="cj-status-icon">
                            <i class="fa-solid fa-circle-check"></i>
                        </span>

                        <span class="cj-status-count">
                            {{ count($jobcardsCount->where('soft_delete', 0)->where('status', 1)) }}
                        </span>
                    </div>
                    <span class="cj-status-name">Confirmed</span>
                </div>

                <div class="cj-status-card cj-completed {{ $mode === 2 ? 'active' : '' }}"
                     wire:click="$set('mode', 2)">
                    <div class="cj-status-top">
                        <span class="cj-status-icon">
                            <i class="fa-solid fa-flag-checkered"></i>
                        </span>

                        <span class="cj-status-count">
                            {{ count($jobcardsCount->where('soft_delete', 0)->where('status', 2)) }}
                        </span>
                    </div>
                    <span class="cj-status-name">Completed</span>
                </div>

                <div class="cj-status-card cj-closed {{ $mode === 3 ? 'active' : '' }}"
                     wire:click="$set('mode', 3)">
                    <div class="cj-status-top">
                        <span class="cj-status-icon">
                            <i class="fa-solid fa-xmark"></i>
                        </span>

                        <span class="cj-status-count">
                            {{ count($jobcardsCount->where('soft_delete', 0)->where('status', 3)) }}
                        </span>
                    </div>
                    <span class="cj-status-name">Closed</span>
                </div>

                <div class="cj-status-card cj-deleted {{ $mode === 5 ? 'active' : '' }}"
                     wire:click="$set('mode', 5)">
                    <div class="cj-status-top">
                        <span class="cj-status-icon">
                            <i class="fa-solid fa-trash"></i>
                        </span>

                        <span class="cj-status-count">
                            {{ count($jobcardsCount->where('soft_delete', 1)) }}
                        </span>
                    </div>
                    <span class="cj-status-name">Deleted</span>
                </div>

                <div class="cj-status-card cj-total {{ $mode === 6 ? 'active' : '' }}"
                     wire:click="$set('mode', 6)">
                    <div class="cj-status-top">
                        <span class="cj-status-icon">
                            <i class="fa-solid fa-layer-group"></i>
                        </span>

                        <span class="cj-status-count">
                            {{ count($jobcardsCount) }}
                        </span>
                    </div>
                    <span class="cj-status-name">Total</span>
                </div>

            </div>

            {{-- Table --}}
            <div class="cj-table-card">

                <div class="cj-table-toolbar">

                    <div>
                        <div class="cj-toolbar-title">Job Card List</div>
                        <div class="cj-toolbar-meta">
                            View and manage workshop job card records
                        </div>
                    </div>

                    <div class="cj-filters">
                        <input
                            type="text"
                            class="cj-search"
                            placeholder="Search Customer"
                            wire:model.live="searchjobcart"
                        >

                        <button
                            type="button"
                            class="cj-clear"
                            wire:click="resetFilter">
                            Clear
                        </button>
                    </div>

                </div>

                @if (!empty($items) && $items->count())

                    <div class="cj-table-wrap">
                        <table class="table jobcardtable">

                            <thead class="{{ $modeClass }}">
                                <tr>
                                    <th>S.No.</th>
                                    <th>Entry Date</th>
                                    <th>Job-Card Number</th>

                                    @if ($items->contains('status', 2) || $items->contains('status', 3))
                                        <th>Invoice No.</th>
                                    @endif

                                    <!-- <th>Shared Serial</th> -->

                                    <th>Customer Name</th>
                                    <th>Vehicle Number</th>
                                    <th>Vehicle</th>
                                    <th>Bill Amount</th>
                                    <th>Advance</th>
                                    <th>Discount</th>
                                    <th>Paid</th>
                                    <th>Balance</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($items as $index => $jobcard)

                                    <tr class="jobcard-row-status-{{ $jobcard->soft_delete == 1 ? 5 : $jobcard->status }}">

                                        <td>
                                            {{ $items->total() - ($items->firstItem() + $index) + 1 }}
                                        </td>

                                        <td>
                                            <a
                                                @if ($jobcard->soft_delete == 0)
                                                    href="{{ route('workshop.jobcardedit', $jobcard->id) }}"
                                                @endif
                                            >
                                                @if ($jobcard->entry_date)
                                                    {{ \Carbon\Carbon::parse($jobcard->entry_date)->format('d-m-Y') }}
                                                    <br>
                                                    <small>
                                                        {{ \Carbon\Carbon::parse($jobcard->entry_date)->format('h:i A') }}
                                                    </small>
                                                @else
                                                    -
                                                @endif
                                            </a>
                                        </td>

                                        <td>
                                            <a
                                                @if ($jobcard->soft_delete == 0)
                                                    href="{{ route('workshop.jobcardedit', $jobcard->id) }}"
                                                @endif
                                                class="{{ $jobcard->status == 0 ? 'text-open fw-bold' : '' }}"
                                            >
                                                {{ $jobcard->jobcard_number ?? '-' }}

                                                @if($jobcard->status == 0)
                                                    <i class="bx bxs-circle font-10 ms-1 text-open"></i>
                                                @endif
                                            </a>
                                        </td>

                                        @if ($items->contains('status', 2) || $items->contains('status', 3))

                                            <td>
                                                @if ($jobcard->status == 2 || $jobcard->status == 3)
                                                    <a
                                                        @if ($jobcard->soft_delete == 0)
                                                            href="{{ route('workshop.jobcardedit', $jobcard->id) }}"
                                                        @endif
                                                    >
                                                        {{ $jobcard->shared_serial ?? '-' }}
                                                    </a>
                                                @else
                                                    -
                                                @endif
                                            </td>

                                        @endif

                                        <td>
                                            <a
                                                @if ($jobcard->soft_delete == 0)
                                                    href="{{ route('workshop.jobcardedit', $jobcard->id) }}"
                                                @endif
                                            >
                                                @if ($jobcard->cust_type == 1)
                                                    {{ 'M/S ' . $jobcard->company_name ?? ($jobcard->customer_name ?? '-') }}
                                                @else
                                                    {{ $jobcard->customer_name ?? '-' }}
                                                @endif
                                            </a>
                                        </td>

                                        <td>
                                            <a
                                                @if ($jobcard->soft_delete == 0)
                                                    href="{{ route('workshop.jobcardedit', $jobcard->id) }}"
                                                @endif
                                            >
                                                {{ $jobcard->vehical_number ?? '-' }}
                                            </a>
                                        </td>

                                        <td>
                                            <a
                                                @if ($jobcard->soft_delete == 0)
                                                    href="{{ route('workshop.jobcardedit', $jobcard->id) }}"
                                                @endif
                                            >
                                                {{ $jobcard->vehical ?? '-' }}
                                            </a>
                                        </td>

                                        <td>
                                            <a
                                                @if ($jobcard->soft_delete == 0)
                                                    href="{{ route('workshop.jobcardedit', $jobcard->id) }}"
                                                @endif
                                            >
                                                {{ $jobcard->final_amount ?? '-' }}
                                            </a>
                                        </td>

                                        <td>
                                            {{ $jobcard->advance ?? '-' }}
                                        </td>

                                        <td>
                                            {{ $jobcard->final_discount ?? '-' }}
                                        </td>

                                        <td>
                                            {{ $jobcard->final_paid ?? '-' }}
                                        </td>

                                        <td>
                                            {{ $jobcard->balance_amount ?? '-' }}
                                        </td>

                                        <td>
                                            @if ($jobcard->soft_delete == 0)

                                                @switch($jobcard->status)

                                                    @case(1)
                                                        <span class="badge bg-primary">Confirmed</span>
                                                    @break

                                                    @case(2)
                                                        <span class="badge bg-success">Completed</span>
                                                    @break

                                                    @case(3)
                                                        <span class="badge bg-info">Closed</span>
                                                    @break

                                                    @case(4)
                                                        <span class="badge bg-warning">Process</span>
                                                    @break

                                                    @default
                                                        <span class="badge badge-open">Open</span>

                                                @endswitch

                                            @else

                                                <span class="badge bg-danger">Deleted</span>

                                            @endif
                                        </td>

                                        <td>
                                            @if ($jobcard->soft_delete == 0)

                                                <div class="cj-actions">

                                                    @if ($user->hasPermissionTo('Jobcard-edit'))
                                                        <a
                                                            href="{{ route('workshop.jobcardedit', $jobcard->id) }}"
                                                            class="cj-action-btn"
                                                            title="Edit Job Card"
                                                        >
                                                            <i class="bx bxs-edit"></i>
                                                        </a>
                                                    @endif

                                                    @if ($user->hasPermissionTo('Jobcard-delete'))
                                                        @if ($jobcard->status != 3)
                                                            <a
                                                                wire:click="confirmDelete({{ $jobcard->id }})"
                                                                class="cj-action-btn"
                                                                title="Delete Job Card"
                                                            >
                                                                <i class="bx bx-trash"></i>
                                                            </a>
                                                        @endif
                                                    @endif

                                                </div>

                                            @else
                                                -
                                            @endif
                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>
                    </div>

                    <div class="cj-pagination pagination-wrapper">
                        {{ $items->links() }}
                    </div>

                @else

                    <div class="cj-empty">
                        <div class="cj-empty-icon">
                            <i class="bx bx-clipboard"></i>
                        </div>

                        <p class="cj-empty-title">No Job Card Found</p>
                        <p class="cj-empty-text">
                            There are no job cards available for the selected filter.
                        </p>
                    </div>

                @endif

            </div>

        </div>

    @endif
</div>

@section('footerscript')

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <script>
        document.addEventListener('livewire:init', function() {

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


        document.addEventListener('show-dent-modal', () => {

            const modal = document.querySelector('.modal');
            const backgroundCanvas = document.getElementById('backgroundCanvas');
            const overlayCanvas = document.getElementById('overlayCanvas');
            const bgCtx = backgroundCanvas.getContext('2d');
            const overlayCtx = overlayCanvas.getContext('2d');
            const carImageTag = document.getElementById('carImageTag');
            const carImage = new Image();

            carImage.src = "{{ asset('assets/dentcar/car.png') }}";

            const showModalButton = document.getElementById('showModalButton');

            if (showModalButton) {

                showModalButton.addEventListener('click', () => {

                    modal.classList.add('show');
                    modal.style.display = 'block';
                    carImageTag.style.display = 'block';

                });

            }

            carImage.onload = () => {

                const scaleFactor = 0.7;

                const newWidth = carImage.width * scaleFactor;
                const newHeight = carImage.height * scaleFactor;

                backgroundCanvas.width = newWidth;
                backgroundCanvas.height = newHeight;

                overlayCanvas.width = newWidth;
                overlayCanvas.height = newHeight;

                bgCtx.drawImage(
                    carImage,
                    0,
                    0,
                    newWidth,
                    newHeight
                );

            };

            let drawing = false;
            let mode = 'dent';

            const penSettings = {

                dent: {
                    color: 'yellow',
                    size: 5
                },

                scratch: {
                    color: 'green',
                    size: 5
                },

                break: {
                    color: 'red',
                    size: 5
                },

                erase: {
                    size: 15
                }

            };

            const buttons = document.querySelectorAll('.controls button');

            buttons.forEach(button => {

                button.addEventListener('click', () => {

                    buttons.forEach(btn =>
                        btn.classList.remove('active')
                    );

                    button.classList.add('active');

                    mode = button.id.replace('Btn', '');

                });

            });

            overlayCanvas.addEventListener('mousedown', () => {

                drawing = true;
                overlayCtx.beginPath();

            });

            overlayCanvas.addEventListener('mouseup', () => {

                drawing = false;
                overlayCtx.beginPath();

            });

            overlayCanvas.addEventListener('mousemove', draw);

            function draw(event) {

                if (!drawing) return;

                const rect = overlayCanvas.getBoundingClientRect();

                const x = event.clientX - rect.left;
                const y = event.clientY - rect.top;

                overlayCtx.lineCap = 'round';

                if (mode === 'erase') {

                    overlayCtx.globalCompositeOperation =
                        'destination-out';

                    overlayCtx.lineWidth =
                        penSettings.erase.size;

                } else {

                    overlayCtx.globalCompositeOperation =
                        'source-over';

                    overlayCtx.strokeStyle =
                        penSettings[mode].color;

                    overlayCtx.lineWidth =
                        penSettings[mode].size;

                }

                overlayCtx.lineTo(x, y);
                overlayCtx.stroke();

                overlayCtx.beginPath();
                overlayCtx.moveTo(x, y);

            }

            document.getElementById('clearBtn').addEventListener(
                'click',
                () => {

                    overlayCtx.clearRect(
                        0,
                        0,
                        overlayCanvas.width,
                        overlayCanvas.height
                    );

                }
            );

            let beta = 0;

            document.getElementById('saveBtn').addEventListener(
                'click',
                () => {

                    if (beta = 0) {

                        beta = 1;

                        if (!confirm(
                            "Are you sure you want to save the changes?"
                        )) return;

                    }

                    const mergedCanvas =
                        document.createElement('canvas');

                    const mergedCtx =
                        mergedCanvas.getContext('2d');

                    mergedCanvas.width =
                        backgroundCanvas.width;

                    mergedCanvas.height =
                        backgroundCanvas.height;

                    mergedCtx.drawImage(
                        backgroundCanvas,
                        0,
                        0
                    );

                    mergedCtx.drawImage(
                        overlayCanvas,
                        0,
                        0
                    );

                    const mergedImageData =
                        mergedCanvas.toDataURL('image/png');

                    Livewire.dispatch('saveImage', {
                        mergedImageData: mergedImageData
                    });

                }
            );

        });


        function validateMaxQuantity(input) {

            var maxQuantity =
                parseInt(input.getAttribute('max'));

            if (parseInt(input.value) > maxQuantity) {

                input.value = maxQuantity;

            }

        }


        document.addEventListener('razorpay-show', (event) => {

            amount = event.__livewire.params[0].amount;
            orderId = event.__livewire.params[0].orderId;

            var options = {

                "key": "{{ env('RAZORPAY_KEY') }}",

                "amount": amount * 100,

                "currency": "INR",

                "order_id": orderId,

                "name": "Test Payment",

                "description": "Payment for product/service",

                "image": "https://example.com/your-logo.png",

                "handler": function(response) {

                    console.log(response);

                    const paymentResponse = {

                        razorpay_payment_id:
                            response.razorpay_payment_id,

                        razorpay_order_id:
                            response.razorpay_order_id,

                        amount: amount,

                    };

                    Livewire.dispatch('storePayment', {
                        paymentResponse: paymentResponse
                    });

                },

                "prefill": {

                    "name":
                        @json(Auth::guard('workshop')->user()->name),

                    "email":
                        @json(Auth::guard('workshop')->user()->email),

                    "contact":
                        @json(Auth::guard('workshop')->user()->mobile_no)

                },

                "theme": {
                    "color": "#009dec"
                }

            };

            var rzp1 = new Razorpay(options);

            rzp1.open();

            event.preventDefault();

        });
    </script>

@endsection