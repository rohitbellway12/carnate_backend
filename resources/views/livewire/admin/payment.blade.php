<div class="carnate-payment-page">

    <style>
        .carnate-payment-page {
            --cp-white: #ffffff;
            --cp-text: #111827;
            --cp-muted: #64748b;
            --cp-border: #e2e8f0;
            --cp-red: #e53935;
            --cp-red-soft: #fff5f5;
            --cp-icon: #f1f5f9;
            --cp-green: #16a34a;
            --cp-green-soft: #ecfdf3;
            --cp-danger: #dc2626;
            --cp-danger-soft: #fef2f2;
        }

        .carnate-payment-page .cp-card {
            background: var(--cp-white);
            border: 1px solid var(--cp-border);
            border-radius: 14px;
            box-shadow: 0 4px 18px rgba(15, 23, 42, .04);
            overflow: hidden;
        }

        .carnate-payment-page .cp-alert {
            margin-bottom: 18px;
            padding: 12px 15px;
            border: 1px solid #bbf7d0;
            border-radius: 10px;
            background: #f0fdf4;
            color: #166534;
            font-size: 14px;
        }

        /* Header */
        .carnate-payment-page .cp-page-header {
            padding: 20px 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .carnate-payment-page .cp-title-icon {
            width: 42px;
            height: 42px;
            border-radius: 11px;
            background: var(--cp-red-soft);
            color: var(--cp-red);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .carnate-payment-page .cp-page-title {
            margin: 0;
            color: var(--cp-text);
            font-size: 20px;
            font-weight: 700;
            letter-spacing: -.2px;
        }

        .carnate-payment-page .cp-page-subtitle {
            margin: 3px 0 0;
            color: var(--cp-muted);
            font-size: 13px;
        }

        /* Filters */
        .carnate-payment-page .cp-filter-card {
            margin-top: 20px;
            padding: 20px 22px;
        }

        .carnate-payment-page .cp-filter-heading {
            margin: 0;
            color: var(--cp-text);
            font-size: 16px;
            font-weight: 700;
        }

        .carnate-payment-page .cp-filter-subtitle {
            margin: 4px 0 18px;
            color: var(--cp-muted);
            font-size: 12px;
        }

        .carnate-payment-page .cp-input,
        .carnate-payment-page .cp-select {
            width: 100%;
            min-height: 44px;
            padding: 9px 13px;
            border: 1px solid var(--cp-border);
            border-radius: 9px;
            background: #fff;
            color: var(--cp-text);
            font-size: 14px;
            outline: none;
            transition: all .2s ease;
        }

        .carnate-payment-page .cp-input::placeholder {
            color: #94a3b8;
        }

        .carnate-payment-page .cp-input:focus,
        .carnate-payment-page .cp-select:focus {
            border-color: rgba(229, 57, 53, .5);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        .carnate-payment-page .cp-search-wrap {
            position: relative;
        }

        .carnate-payment-page .cp-search-wrap i {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 17px;
            z-index: 2;
        }

        .carnate-payment-page .cp-search-input {
            padding-left: 39px;
        }

        .carnate-payment-page .cp-clear-btn {
            min-height: 44px;
            padding: 9px 17px;
            border: 1px solid var(--cp-border);
            border-radius: 9px;
            background: #f8fafc;
            color: #475569;
            font-size: 13px;
            font-weight: 600;
            transition: all .2s ease;
        }

        .carnate-payment-page .cp-clear-btn:hover {
            background: #e2e8f0;
            color: var(--cp-text);
        }

        /* Table */
        .carnate-payment-page .cp-table-card {
            margin-top: 20px;
        }

        .carnate-payment-page .cp-table-header {
            padding: 18px 22px;
            border-bottom: 1px solid var(--cp-border);
        }

        .carnate-payment-page .cp-table-title {
            margin: 0;
            color: var(--cp-text);
            font-size: 16px;
            font-weight: 700;
        }

        .carnate-payment-page .cp-table-subtitle {
            margin: 3px 0 0;
            color: var(--cp-muted);
            font-size: 12px;
        }

        .carnate-payment-page .cp-table-wrap {
            overflow-x: auto;
        }

        .carnate-payment-page .cp-table {
            width: 100%;
            min-width: 850px;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .carnate-payment-page .cp-table thead th {
            padding: 14px 18px;
            background: #f8fafc;
            border-bottom: 1px solid var(--cp-border);
            color: #64748b;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
            white-space: nowrap;
        }

        .carnate-payment-page .cp-table tbody td {
            padding: 15px 18px;
            border-bottom: 1px solid #edf2f7;
            color: var(--cp-text);
            font-size: 14px;
            vertical-align: middle;
        }

        .carnate-payment-page .cp-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-payment-page .cp-table tbody tr {
            transition: background .15s ease;
        }

        .carnate-payment-page .cp-table tbody tr:hover {
            background: #fafafa;
        }

        .carnate-payment-page .cp-number {
            width: 65px;
            color: #94a3b8 !important;
            font-size: 13px !important;
            font-weight: 600;
        }

        .carnate-payment-page .cp-company {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .carnate-payment-page .cp-company-icon {
            width: 35px;
            height: 35px;
            flex: 0 0 35px;
            border-radius: 9px;
            background: var(--cp-icon);
            color: #475569;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
        }

        .carnate-payment-page .cp-company-name {
            color: var(--cp-text);
            font-weight: 600;
        }

        .carnate-payment-page .cp-payment-id {
            color: #334155;
            font-size: 13px;
            font-weight: 600;
            font-family: monospace;
        }

        .carnate-payment-page .cp-invoice {
            color: #475569;
            font-size: 13px;
            font-weight: 500;
        }

        .carnate-payment-page .cp-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        .carnate-payment-page .cp-status-success {
            background: var(--cp-green-soft);
            color: #15803d;
        }

        .carnate-payment-page .cp-status-failed {
            background: var(--cp-danger-soft);
            color: #b91c1c;
        }

        .carnate-payment-page .cp-status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        .carnate-payment-page .cp-amount {
            color: var(--cp-text);
            font-weight: 700;
            white-space: nowrap;
        }

        .carnate-payment-page .cp-pagination {
            padding: 16px 20px;
            border-top: 1px solid var(--cp-border);
        }

        /* Empty */
        .carnate-payment-page .cp-empty {
            padding: 55px 20px;
            text-align: center;
        }

        .carnate-payment-page .cp-empty-icon {
            width: 52px;
            height: 52px;
            margin: 0 auto 13px;
            border-radius: 13px;
            background: var(--cp-icon);
            color: #94a3b8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .carnate-payment-page .cp-empty-title {
            margin: 0;
            color: var(--cp-text);
            font-size: 15px;
            font-weight: 600;
        }

        .carnate-payment-page .cp-empty-text {
            margin: 5px 0 0;
            color: var(--cp-muted);
            font-size: 13px;
        }

        @media (max-width: 767px) {
            .carnate-payment-page .cp-page-header {
                padding: 16px;
            }

            .carnate-payment-page .cp-page-title {
                font-size: 17px;
            }

            .carnate-payment-page .cp-filter-card {
                padding: 17px;
            }

            .carnate-payment-page .cp-clear-btn {
                width: 100%;
            }
        }
    </style>

    @php
        $admin = App\Models\Admin::where('id', $adminId)->first();
    @endphp

    {{-- Success Message --}}
    @if (session()->has('message'))
        <div class="cp-alert">
            <i class="bx bx-check-circle me-1"></i>
            {{ session('message') }}
        </div>
    @endif

    {{-- Page Header --}}
    <div class="cp-card">
        <div class="cp-page-header">

            <div class="cp-title-icon">
                <i class="fas fa-coins"></i>
            </div>

            <div>
                <h4 class="cp-page-title">Payment</h4>
                <p class="cp-page-subtitle">
                    View and manage payment transactions
                </p>
            </div>

        </div>
    </div>

    {{-- Filters --}}
    <div class="cp-card cp-filter-card">

        <h5 class="cp-filter-heading">
            Search & Filters
        </h5>

        <p class="cp-filter-subtitle">
            Search payments or filter transactions by payment status
        </p>

        <div class="row g-3">

            <div class="col-lg-3 col-md-6">

                <div class="cp-search-wrap">
                    <i class="bx bx-search"></i>

                    <input type="text"
                        class="cp-input cp-search-input"
                        placeholder="Search All"
                        wire:model.live="searchfilter"
                        fdprocessedid="blgf5">
                </div>

            </div>

            <div class="col-lg-3 col-md-6">

                <select class="cp-select"
                    wire:model.live="status_filter">

                    <option value="">Select Status</option>
                    <option value="success">Success</option>
                    <option value="failed">Failed</option>

                </select>

            </div>

            <div class="col-lg-6 col-md-12 d-flex justify-content-end align-items-end">

                <button type="button"
                    class="cp-clear-btn"
                    wire:click="resetFilter"
                    fdprocessedid="orntg">

                    <i class="bx bx-reset me-1"></i>
                    Clear

                </button>

            </div>

        </div>

    </div>

    {{-- Payment List --}}
    <div class="cp-card cp-table-card">

        @if (!empty($payments) && $payments->count())

            <div class="cp-table-header">

                <h5 class="cp-table-title">
                    Payment Transactions
                </h5>

                <p class="cp-table-subtitle">
                    View payment IDs, invoices, status and transaction amounts
                </p>

            </div>

            <div class="cp-table-wrap">

                <table class="cp-table">

                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Company Name</th>
                            <th>Payment ID</th>
                            <th>Invoice Number</th>
                            <th>Status</th>
                            <th>Amount</th>

                            @if (@$admin->hasPermissionTo('payment-edit') || @$admin->hasPermissionTo('payment-delete'))
                                {{-- <th>Actions</th> --}}
                            @endif
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($payments as $index => $payment)

                            <tr>

                                <td class="cp-number">
                                    {{ $payments->total() - ($payments->firstItem() + $index) + 1 }}
                                </td>

                                <td>
                                    <div class="cp-company">

                                        <span class="cp-company-icon">
                                            <i class="bx bx-building"></i>
                                        </span>

                                        <span class="cp-company-name">
                                            {{ $payment->user ? $payment->user->company_name : 'N/A' }}
                                        </span>

                                    </div>
                                </td>

                                <td>
                                    <span class="cp-payment-id">
                                        {{ $payment->payment_id }}
                                    </span>
                                </td>

                                <td>
                                    <span class="cp-invoice">
                                        {{ getPaymentInvoiceNumbers($payment) }}
                                    </span>
                                </td>

                                <td>

                                    @if (strtolower($payment->status) === 'success')

                                        <span class="cp-status cp-status-success">
                                            <span class="cp-status-dot"></span>
                                            {{ ucfirst($payment->status) }}
                                        </span>

                                    @elseif (strtolower($payment->status) === 'failed')

                                        <span class="cp-status cp-status-failed">
                                            <span class="cp-status-dot"></span>
                                            {{ ucfirst($payment->status) }}
                                        </span>

                                    @else

                                        <span class="cp-status"
                                            style="background:#f1f5f9;color:#64748b;">
                                            <span class="cp-status-dot"></span>
                                            {{ ucfirst($payment->status) }}
                                        </span>

                                    @endif

                                </td>

                                <td>
                                    <span class="cp-amount">
                                        {{ $payment->amount }}
                                    </span>
                                </td>

                                @if (@$admin->hasPermissionTo('payment-edit') || @$admin->hasPermissionTo('payment-delete'))
                                    {{-- <td>
                                        @if (@$admin->hasPermissionTo('payment-edit'))
                                            <a wire:click="edit({{ $payment->id }})"
                                                class="btn btn-sm p-0">
                                                <i class="bx bxs-edit"></i>
                                            </a>
                                        @endif

                                        @if (@$admin->hasPermissionTo('payment-delete'))
                                            <a wire:click="confirmDelete({{ $payment->id }})"
                                                class="btn btn-sm p-0">
                                                <i class="fadeIn animated bx bx-trash"></i>
                                            </a>
                                        @endif
                                    </td> --}}
                                @endif

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            <div class="cp-pagination">
                {{ $payments->links() }}
            </div>

        @else

            <div class="cp-empty">

                <div class="cp-empty-icon">
                    <i class="fas fa-coins"></i>
                </div>

                <h5 class="cp-empty-title">
                    No Payment found!
                </h5>

                <p class="cp-empty-text">
                    Payment transactions will appear here once available.
                </p>

            </div>

        @endif

    </div>

</div>

@section('footerscript')
@endsection