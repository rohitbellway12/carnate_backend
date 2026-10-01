<div class="carnate-stock-report-page">

    {{-- =========================
        PAGE HEADER
    ========================== --}}
    <div class="carnate-page-header">

        <div>
            <span class="carnate-page-eyebrow">Reports</span>
            <h1>Stock Report</h1>
            <p>Monitor inventory levels, stock value and product availability.</p>
        </div>

    </div>


    {{-- =========================
        FILTERS
    ========================== --}}
    <div class="carnate-filter-card">

        <div class="carnate-filter-row">

            {{-- Search --}}
            <div class="carnate-search-box">

                <i class="bx bx-search"></i>

                <input type="text"
                    class="carnate-search-input"
                    placeholder="Search part name, brand, number..."
                    wire:model.live.debounce.300ms="search">

            </div>


            {{-- Category --}}
            <div class="carnate-filter-control">

                <select class="carnate-select"
                    wire:model.live="categoryFilter">

                    <option value="">All Categories</option>
                    <option value="1">Accessory</option>
                    <option value="2">Parts</option>
                    <option value="3">Tools</option>
                    <option value="4">Lubricants</option>

                </select>

            </div>


            {{-- Brand --}}
            <div class="carnate-filter-control">

                <select class="carnate-select"
                    wire:model.live="brandFilter">

                    <option value="">All Brands</option>

                    @foreach($brands as $brand)
                        <option value="{{ $brand }}">{{ $brand }}</option>
                    @endforeach

                </select>

            </div>


            {{-- Stock Status --}}
            <div class="carnate-filter-control">

                <select class="carnate-select"
                    wire:model.live="stockStatusFilter">

                    <option value="">All Stock Levels</option>
                    <option value="in">In Stock (> 5)</option>
                    <option value="low">Low Stock (1 - 5)</option>
                    <option value="out">Out of Stock (0)</option>

                </select>

            </div>


            {{-- Export --}}
            <div class="carnate-export-actions">

                <button type="button"
                    class="carnate-export-btn pdf"
                    wire:click="downloadPDF">

                    <i class="bx bxs-file-pdf"></i>
                    PDF

                </button>

                <button type="button"
                    class="carnate-export-btn excel"
                    wire:click="downloadExcel">

                    <i class="bx bxs-spreadsheet"></i>
                    Excel

                </button>

            </div>

        </div>

    </div>


    {{-- =========================
        SUMMARY CARDS
    ========================== --}}
    <div class="carnate-summary-grid">

        {{-- Total Products --}}
        <div class="carnate-summary-card">

            <div class="carnate-summary-content">

                <span class="carnate-summary-label">
                    Total Products
                </span>

                <strong class="carnate-summary-value">
                    {{ $totals['total_entries'] }}
                </strong>

            </div>

            <div class="carnate-summary-icon neutral">
                <i class="bx bx-layer"></i>
            </div>

        </div>


        {{-- Total Quantity --}}
        <div class="carnate-summary-card">

            <div class="carnate-summary-content">

                <span class="carnate-summary-label">
                    Total Stock Qty
                </span>

                <strong class="carnate-summary-value">
                    {{ number_format($totals['total_quantity']) }}
                </strong>

            </div>

            <div class="carnate-summary-icon blue">
                <i class="bx bx-package"></i>
            </div>

        </div>


        {{-- Total Value --}}
        <div class="carnate-summary-card">

            <div class="carnate-summary-content">

                <span class="carnate-summary-label">
                    Total Stock Value
                </span>

                <strong class="carnate-summary-value">
                    ₹{{ number_format((float)$totals['total_value'], 2) }}
                </strong>

            </div>

            <div class="carnate-summary-icon green">
                <i class="bx bx-wallet"></i>
            </div>

        </div>


        {{-- Alerts --}}
        <div class="carnate-summary-card alert-card">

            <div class="carnate-summary-content">

                <span class="carnate-summary-label">
                    Stock Alerts
                </span>

                <strong class="carnate-summary-value">
                    {{ $totals['low_stock'] + $totals['out_of_stock'] }}
                </strong>

                <span class="carnate-alert-subtext">
                    {{ $totals['out_of_stock'] }} Out of Stock
                </span>

            </div>

            <div class="carnate-summary-icon red">
                <i class="bx bx-error"></i>
            </div>

        </div>

    </div>


    {{-- =========================
        CATEGORY QUICK SUMMARY
    ========================== --}}
    @php
        $catConfig = [
            1 => [
                'label' => 'Accessory',
                'icon' => 'bx-car',
            ],
            2 => [
                'label' => 'Parts',
                'icon' => 'bx-cog',
            ],
            3 => [
                'label' => 'Tools',
                'icon' => 'bx-wrench',
            ],
            4 => [
                'label' => 'Lubricants',
                'icon' => 'bx-droplet',
            ],
        ];
    @endphp

    <div class="carnate-category-grid">

        @foreach($catConfig as $typeId => $cfg)

            <div class="carnate-category-card">

                <div class="carnate-category-icon">
                    <i class="bx {{ $cfg['icon'] }}"></i>
                </div>

                <div>

                    <span class="carnate-category-label">
                        {{ $cfg['label'] }}
                    </span>

                    <strong>
                        {{ $totals['by_category'][$typeId] }} items
                    </strong>

                </div>

            </div>

        @endforeach

    </div>


    {{-- =========================
        STOCK TABLE
    ========================== --}}
    <div class="carnate-stock-card">

        <div class="carnate-stock-card-header">

            <div>
                <h3>Stock Status List</h3>
                <p>Current inventory overview across all product categories.</p>
            </div>

            <div class="carnate-record-label">
                Inventory
            </div>

        </div>


        @php
            $categoryLabels = [
                1 => 'Accessory',
                2 => 'Parts',
                3 => 'Tools',
                4 => 'Lubricants'
            ];
        @endphp


        <div class="carnate-table-wrapper">

            <table class="carnate-stock-table">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Category</th>
                        <th>Part Name</th>
                        <th>Part Number</th>
                        <th>Brand</th>
                        <th class="text-center">Rack No</th>
                        <th class="text-center">Stock Qty</th>
                        <th class="text-end">Selling Price</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($stocks as $index => $s)

                        <tr>

                            {{-- Serial --}}
                            <td>
                                <span class="carnate-row-number">
                                    {{ ($stocks->currentPage() - 1) * $stocks->perPage() + $loop->iteration }}
                                </span>
                            </td>


                            {{-- Category --}}
                            <td>

                                @php
                                    $categoryClass = match($s->spare_part_type) {
                                        1 => 'accessory',
                                        2 => 'parts',
                                        3 => 'tools',
                                        4 => 'lubricants',
                                        default => 'other',
                                    };
                                @endphp

                                <span class="carnate-category-badge {{ $categoryClass }}">

                                    @if($s->spare_part_type == 1)
                                        <i class="bx bx-car"></i>
                                    @elseif($s->spare_part_type == 2)
                                        <i class="bx bx-cog"></i>
                                    @elseif($s->spare_part_type == 3)
                                        <i class="bx bx-wrench"></i>
                                    @elseif($s->spare_part_type == 4)
                                        <i class="bx bx-droplet"></i>
                                    @else
                                        <i class="bx bx-package"></i>
                                    @endif

                                    {{ $categoryLabels[$s->spare_part_type] ?? 'Other' }}

                                </span>

                            </td>


                            {{-- Part Name --}}
                            <td>

                                <div class="carnate-part-name">
                                    {{ $s->label->title ?? '-' }}
                                </div>

                            </td>


                            {{-- Part Number --}}
                            <td>

                                <div class="carnate-part-number">

                                    <code>
                                        {{ strtoupper($s->part_number ?: '-') }}
                                    </code>

                                    @if($s->part_number)

                                        <button type="button"
                                            class="carnate-copy-btn copy-part-number"
                                            data-part-number="{{ $s->part_number }}"
                                            title="Copy Part Number">

                                            <i class="bx bx-copy"></i>

                                        </button>

                                    @endif

                                </div>

                            </td>


                            {{-- Brand --}}
                            <td>
                                <span class="carnate-brand">
                                    {{ $s->brand ?: '-' }}
                                </span>
                            </td>


                            {{-- Rack --}}
                            <td class="text-center">

                                <span class="carnate-rack">
                                    {{ $s->rack_no ?: '-' }}
                                </span>

                            </td>


                            {{-- Stock --}}
                            <td class="text-center">

                                <div class="carnate-stock-quantity">

                                    <strong>
                                        {{ $s->stock }}
                                    </strong>

                                    <span>
                                        {{ $s->unit->name ?? 'pcs' }}
                                    </span>

                                </div>

                            </td>


                            {{-- Price --}}
                            <td class="text-end">

                                <strong class="carnate-price">
                                    ₹{{ number_format((float)$s->price, 2) }}
                                </strong>

                            </td>


                            {{-- Status --}}
                            <td class="text-center">

                                @if($s->stock <= 0)

                                    <span class="carnate-stock-status out">
                                        <i class="bx bx-x-circle"></i>
                                        Out of Stock
                                    </span>

                                @elseif($s->stock <= 5)

                                    <span class="carnate-stock-status low">
                                        <i class="bx bx-error-circle"></i>
                                        Low Stock
                                    </span>

                                @else

                                    <span class="carnate-stock-status in">
                                        <i class="bx bx-check-circle"></i>
                                        In Stock
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="9">

                                <div class="carnate-empty-state">

                                    <div class="carnate-empty-icon">
                                        <i class="bx bx-package"></i>
                                    </div>

                                    <h4>No Matching Stock Items</h4>

                                    <p>
                                        No inventory items were found for the selected filters.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        <div class="carnate-pagination">
            {{ $stocks->links() }}
        </div>

    </div>


    {{-- =========================
        STYLES
    ========================== --}}
    <style>
        .carnate-stock-report-page {
            --carnate-red: #e53935;
            --carnate-red-soft: #fff5f5;
            --carnate-text: #111827;
            --carnate-muted: #64748b;
            --carnate-border: #e2e8f0;

            min-height: calc(100vh - 70px);
            padding: 24px;
            background: #f7f8fa;
            color: var(--carnate-text);
        }

        .carnate-stock-report-page * {
            box-sizing: border-box;
        }

        /* Header */

        .carnate-page-header {
            margin-bottom: 22px;
        }

        .carnate-page-eyebrow {
            display: block;
            margin-bottom: 5px;
            color: var(--carnate-red);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: .12em;
            text-transform: uppercase;
        }

        .carnate-page-header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 750;
            letter-spacing: -.03em;
        }

        .carnate-page-header p {
            margin: 7px 0 0;
            color: var(--carnate-muted);
            font-size: 14px;
        }

        /* Filters */

        .carnate-filter-card {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid var(--carnate-border);
            border-radius: 15px;
            background: #fff;
            box-shadow: 0 4px 18px rgba(15, 23, 42, .035);
        }

        .carnate-filter-row {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 9px;
        }

        .carnate-search-box {
            position: relative;
            flex: 1 1 270px;
            max-width: 320px;
        }

        .carnate-search-box > i {
            position: absolute;
            top: 50%;
            left: 12px;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 17px;
            pointer-events: none;
        }

        .carnate-search-input,
        .carnate-select {
            width: 100%;
            height: 40px;
            border: 1px solid var(--carnate-border);
            border-radius: 9px;
            outline: none;
            background: #fff;
            color: var(--carnate-text);
            font-size: 12px;
            transition: .2s ease;
        }

        .carnate-search-input {
            padding: 8px 12px 8px 37px;
        }

        .carnate-select {
            min-width: 145px;
            padding: 8px 30px 8px 11px;
            cursor: pointer;
        }

        .carnate-search-input:focus,
        .carnate-select:focus {
            border-color: rgba(229, 57, 53, .45);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .07);
        }

        .carnate-filter-control {
            flex: 0 0 auto;
        }

        .carnate-export-actions {
            display: flex;
            gap: 7px;
            margin-left: auto;
        }

        .carnate-export-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            height: 40px;
            padding: 0 12px;
            border: 1px solid;
            border-radius: 9px;
            background: #fff;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s ease;
        }

        .carnate-export-btn.pdf {
            border-color: #fecaca;
            color: #dc2626;
        }

        .carnate-export-btn.pdf:hover {
            background: #fef2f2;
        }

        .carnate-export-btn.excel {
            border-color: #bbf7d0;
            color: #15803d;
        }

        .carnate-export-btn.excel:hover {
            background: #f0fdf4;
        }

        .carnate-export-btn i {
            font-size: 17px;
        }

        /* Summary */

        .carnate-summary-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 14px;
            margin-bottom: 18px;
        }

        .carnate-summary-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            min-height: 110px;
            padding: 18px;
            border: 1px solid var(--carnate-border);
            border-radius: 14px;
            background: #fff;
            box-shadow: 0 4px 16px rgba(15, 23, 42, .03);
        }

        .carnate-summary-content {
            min-width: 0;
        }

        .carnate-summary-label {
            display: block;
            margin-bottom: 7px;
            color: var(--carnate-muted);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .02em;
        }

        .carnate-summary-value {
            display: block;
            color: var(--carnate-text);
            font-size: 23px;
            font-weight: 750;
            letter-spacing: -.025em;
            line-height: 1.1;
        }

        .carnate-summary-icon {
            display: flex;
            flex: 0 0 auto;
            align-items: center;
            justify-content: center;
            width: 43px;
            height: 43px;
            border-radius: 11px;
            font-size: 21px;
        }

        .carnate-summary-icon.neutral {
            background: #f1f5f9;
            color: #475569;
        }

        .carnate-summary-icon.blue {
            background: #eff6ff;
            color: #2563eb;
        }

        .carnate-summary-icon.green {
            background: #f0fdf4;
            color: #16a34a;
        }

        .carnate-summary-icon.red {
            background: var(--carnate-red-soft);
            color: var(--carnate-red);
        }

        .carnate-alert-subtext {
            display: block;
            margin-top: 5px;
            color: #dc2626;
            font-size: 10px;
            font-weight: 700;
        }

        /* Categories */

        .carnate-category-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 10px;
            margin-bottom: 20px;
        }

        .carnate-category-card {
            display: flex;
            align-items: center;
            gap: 11px;
            min-height: 70px;
            padding: 12px 14px;
            border: 1px solid var(--carnate-border);
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 3px 12px rgba(15, 23, 42, .025);
        }

        .carnate-category-icon {
            display: flex;
            flex: 0 0 auto;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: #f1f5f9;
            color: #64748b;
            font-size: 19px;
        }

        .carnate-category-label {
            display: block;
            margin-bottom: 2px;
            color: #64748b;
            font-size: 11px;
            font-weight: 650;
        }

        .carnate-category-card strong {
            color: var(--carnate-text);
            font-size: 13px;
            font-weight: 750;
        }

        /* Main Stock Card */

        .carnate-stock-card {
            overflow: hidden;
            border: 1px solid var(--carnate-border);
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 4px 18px rgba(15, 23, 42, .035);
        }

        .carnate-stock-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 19px 20px;
            border-bottom: 1px solid var(--carnate-border);
        }

        .carnate-stock-card-header h3 {
            margin: 0;
            font-size: 16px;
            font-weight: 750;
        }

        .carnate-stock-card-header p {
            margin: 4px 0 0;
            color: var(--carnate-muted);
            font-size: 11px;
        }

        .carnate-record-label {
            padding: 6px 10px;
            border-radius: 7px;
            background: #f1f5f9;
            color: #64748b;
            font-size: 10px;
            font-weight: 750;
            text-transform: uppercase;
            letter-spacing: .05em;
        }

        /* Table */

        .carnate-table-wrapper {
            overflow-x: auto;
        }

        .carnate-stock-table {
            width: 100%;
            min-width: 1050px;
            border-collapse: collapse;
        }

        .carnate-stock-table thead th {
            padding: 13px 15px;
            border-bottom: 1px solid var(--carnate-border);
            background: #f8fafc;
            color: #64748b;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .06em;
            text-align: left;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .carnate-stock-table tbody td {
            padding: 13px 15px;
            border-bottom: 1px solid #edf1f5;
            color: var(--carnate-text);
            font-size: 12px;
            vertical-align: middle;
        }

        .carnate-stock-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-stock-table tbody tr:hover {
            background: #fafbfc;
        }

        .carnate-row-number {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            border-radius: 7px;
            background: #f1f5f9;
            color: #64748b;
            font-size: 10px;
            font-weight: 700;
        }

        /* Category Badge */

        .carnate-category-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 8px;
            border-radius: 7px;
            font-size: 10px;
            font-weight: 750;
            white-space: nowrap;
        }

        .carnate-category-badge.accessory {
            background: #f1f5f9;
            color: #475569;
        }

        .carnate-category-badge.parts {
            background: #fff7ed;
            color: #c2410c;
        }

        .carnate-category-badge.tools {
            background: #f5f3ff;
            color: #6d28d9;
        }

        .carnate-category-badge.lubricants {
            background: #f0fdf4;
            color: #15803d;
        }

        .carnate-category-badge.other {
            background: #f1f5f9;
            color: #64748b;
        }

        .carnate-category-badge i {
            font-size: 13px;
        }

        /* Product */

        .carnate-part-name {
            max-width: 220px;
            color: #334155;
            font-size: 12px;
            font-weight: 700;
        }

        .carnate-part-number {
            display: flex;
            align-items: center;
            gap: 7px;
            min-width: 130px;
        }

        .carnate-part-number code {
            color: #475569;
            font-size: 11px;
            font-weight: 650;
            word-break: break-word;
        }

        .carnate-copy-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 auto;
            width: 27px;
            height: 27px;
            padding: 0;
            border: 0;
            border-radius: 7px;
            background: #f1f5f9;
            color: #64748b;
            cursor: pointer;
            transition: .2s ease;
        }

        .carnate-copy-btn:hover {
            background: #e2e8f0;
            color: #334155;
        }

        .carnate-copy-btn i {
            font-size: 14px;
        }

        .carnate-brand {
            color: #475569;
            font-size: 12px;
        }

        .carnate-rack {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            padding: 5px 8px;
            border-radius: 7px;
            background: #f1f5f9;
            color: #64748b;
            font-size: 10px;
            font-weight: 700;
        }

        /* Stock */

        .carnate-stock-quantity {
            display: inline-flex;
            align-items: baseline;
            gap: 4px;
        }

        .carnate-stock-quantity strong {
            color: #334155;
            font-size: 13px;
        }

        .carnate-stock-quantity span {
            color: #94a3b8;
            font-size: 10px;
        }

        .carnate-price {
            color: #334155;
            font-size: 12px;
            white-space: nowrap;
        }

        /* Status */

        .carnate-stock-status {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 9px;
            border-radius: 8px;
            font-size: 10px;
            font-weight: 750;
            white-space: nowrap;
        }

        .carnate-stock-status.in {
            background: #f0fdf4;
            color: #15803d;
        }

        .carnate-stock-status.low {
            background: #fffbeb;
            color: #b45309;
        }

        .carnate-stock-status.out {
            background: #fef2f2;
            color: #dc2626;
        }

        .carnate-stock-status i {
            font-size: 14px;
        }

        /* Empty */

        .carnate-empty-state {
            display: flex;
            align-items: center;
            flex-direction: column;
            padding: 60px 20px;
            text-align: center;
        }

        .carnate-empty-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 56px;
            height: 56px;
            margin-bottom: 12px;
            border-radius: 14px;
            background: #f1f5f9;
            color: #94a3b8;
            font-size: 26px;
        }

        .carnate-empty-state h4 {
            margin: 0;
            color: var(--carnate-text);
            font-size: 15px;
            font-weight: 700;
        }

        .carnate-empty-state p {
            margin: 6px 0 0;
            color: var(--carnate-muted);
            font-size: 12px;
        }

        /* Pagination */

        .carnate-pagination {
            padding: 15px 18px;
            border-top: 1px solid var(--carnate-border);
        }

        /* Responsive */

        @media (max-width: 1200px) {
            .carnate-summary-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .carnate-category-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .carnate-export-actions {
                margin-left: 0;
            }
        }

        @media (max-width: 991px) {
            .carnate-filter-row {
                align-items: stretch;
            }

            .carnate-search-box {
                flex-basis: 100%;
                max-width: none;
            }

            .carnate-filter-control {
                flex: 1 1 180px;
            }

            .carnate-select {
                width: 100%;
            }
        }

        @media (max-width: 767px) {
            .carnate-stock-report-page {
                padding: 18px 14px;
            }

            .carnate-page-header h1 {
                font-size: 23px;
            }

            .carnate-page-header p {
                font-size: 12px;
            }

            .carnate-summary-grid,
            .carnate-category-grid {
                grid-template-columns: 1fr;
            }

            .carnate-filter-control {
                flex-basis: 100%;
            }

            .carnate-export-actions {
                width: 100%;
            }

            .carnate-export-btn {
                flex: 1;
            }

            .carnate-stock-card-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .carnate-record-label {
                align-self: flex-start;
            }
        }

        @media (max-width: 480px) {
            .carnate-summary-card {
                min-height: 95px;
                padding: 15px;
            }

            .carnate-summary-value {
                font-size: 20px;
            }

            .carnate-summary-icon {
                width: 38px;
                height: 38px;
                font-size: 18px;
            }
        }
    </style>


    {{-- =========================
        COPY PART NUMBER
    ========================== --}}
    <script>
        document.addEventListener('livewire:navigated', () => {

            document.querySelectorAll('.copy-part-number').forEach(btn => {

                btn.addEventListener('click', function() {

                    const partNumber = this.getAttribute('data-part-number');

                    navigator.clipboard.writeText(partNumber).then(() => {

                        const icon = this.querySelector('i');

                        icon.className = 'bx bx-check';

                        setTimeout(() => {
                            icon.className = 'bx bx-copy';
                        }, 1500);

                    });

                });

            });

        });
    </script>

</div>