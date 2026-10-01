<div class="carnate-wallet-page">

    @php
        $sparePart = $user;
    @endphp

    {{-- =========================
        PAGE HEADER
    ========================== --}}
    <div class="carnate-page-header">
        <div>
            <span class="carnate-page-eyebrow">Finance</span>
            <h1>Wallet Management</h1>
            <p>Manage your wallet balance, withdrawals and transaction history.</p>
        </div>
    </div>


    {{-- =========================
        MAIN CONTENT
    ========================== --}}
    <div class="carnate-wallet-grid">

        {{-- =========================
            WALLET CARD
        ========================== --}}
        <div class="carnate-wallet-summary">

            <div class="carnate-wallet-card">

                <div class="carnate-wallet-top">
                    <div>
                        <span class="carnate-wallet-label">
                            Available Balance
                        </span>

                        <h2>
                            ₹{{ number_format($vendor_data->wallet, 2) }}
                        </h2>
                    </div>

                    <div class="carnate-wallet-icon">
                        <i class="bx bx-wallet"></i>
                    </div>
                </div>

                <div class="carnate-wallet-divider"></div>

                <div class="carnate-last-transaction">
                    <div>
                        <span>Last Transaction</span>

                        <strong>
                            {{ $wallet?->created_at->format('d.m.Y') ?? 'No data available' }}
                        </strong>
                    </div>

                    <div class="carnate-last-amount">
                        ₹{{ number_format($wallet?->amount ?? 0, 2) }}
                    </div>
                </div>

                @if (@$sparePart->hasPermissionTo('wallet-add'))
                    <button wire:click="rechargeWallet"
                        class="carnate-withdraw-btn">

                        <i class="bx bx-arrow-to-bottom"></i>
                        Withdraw Funds

                    </button>
                @endif

            </div>

        </div>


        {{-- =========================
            HISTORY CARD
        ========================== --}}
        <div class="carnate-history-card">

            <div class="carnate-tabs">

                <button class="carnate-tab active"
                    id="withdraw-history-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#withdrawHistory"
                    type="button"
                    role="tab">

                    <i class="bx bx-money-withdraw"></i>
                    Withdraw History

                </button>

                <button class="carnate-tab"
                    id="wallet-history-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#walletHistory"
                    type="button"
                    role="tab">

                    <i class="bx bx-history"></i>
                    Wallet History

                </button>

            </div>


            <div class="tab-content">

                {{-- =========================
                    WITHDRAW HISTORY
                ========================== --}}
                <div class="tab-pane fade show active"
                    id="withdrawHistory"
                    role="tabpanel">

                    @if (!empty($withdraws) && $withdraws->count())

                        <div class="carnate-table-wrap">

                            <table class="carnate-table">

                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Amount</th>
                                        <th>Transaction ID / UTR</th>
                                        <th>Status</th>
                                        <th>Date Withdraw</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach ($withdraws as $index => $withdraw)

                                        <tr>

                                            <td>
                                                <span class="carnate-index">
                                                    {{ $withdraws->total() - ($withdraws->firstItem() + $index) + 1 }}
                                                </span>
                                            </td>

                                            <td>
                                                <strong class="carnate-amount">
                                                    ₹{{ number_format($withdraw->amount, 2) }}
                                                </strong>
                                            </td>

                                            <td>
                                                @if ($withdraw->transaction_id)
                                                    <span class="carnate-transaction">
                                                        <i class="bx bx-receipt"></i>
                                                        {{ $withdraw->transaction_id }}
                                                    </span>
                                                @else
                                                    <span class="carnate-na">—</span>
                                                @endif
                                            </td>

                                            <td>

                                                @switch($withdraw->status)

                                                    @case(0)
                                                        <span class="carnate-status processing">
                                                            <i class="bx bx-time-five"></i>
                                                            Processing
                                                        </span>
                                                    @break

                                                    @case(1)
                                                        <span class="carnate-status complete">
                                                            <i class="bx bx-check-circle"></i>
                                                            Complete
                                                        </span>
                                                    @break

                                                    @case(2)
                                                        <span class="carnate-status declined">
                                                            <i class="bx bx-x-circle"></i>
                                                            Declined
                                                        </span>
                                                    @break

                                                @endswitch

                                            </td>

                                            <td>
                                                <span class="carnate-date">
                                                    {{ \Carbon\Carbon::parse($withdraw->created_at)->format('d-m-Y h:i A') ?? '-' }}
                                                </span>
                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                        <div class="carnate-pagination">
                            {{ $withdraws->onEachSide(1)->withPath(route('sparepart.withdrawal'))->links('livewire.sparepart.custom-pagination') }}
                        </div>

                    @else

                        <div class="carnate-empty-state">

                            <div class="carnate-empty-icon">
                                <i class="bx bx-money-withdraw"></i>
                            </div>

                            <h4>No Withdraw History</h4>

                            <p>No withdrawal transactions are available yet.</p>

                        </div>

                    @endif

                </div>


                {{-- =========================
                    WALLET HISTORY
                ========================== --}}
                <div class="tab-pane fade"
                    id="walletHistory"
                    role="tabpanel">

                    @if (!empty($walletHistories) && count($walletHistories) > 0)

                        <div class="carnate-table-wrap">

                            <table class="carnate-table">

                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Amount</th>
                                        <th>Balance</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach ($walletHistories as $index => $walletHistory)

                                        <tr>

                                            <td>
                                                <span class="carnate-index">
                                                    {{ $walletHistories->total() - ($walletHistories->firstItem() + $index) + 1 }}
                                                </span>
                                            </td>

                                            <td>
                                                <strong class="carnate-amount">
                                                    ₹{{ number_format($walletHistory->amount, 2) }}
                                                </strong>
                                            </td>

                                            <td>
                                                <strong class="carnate-balance">
                                                    ₹{{ number_format($walletHistory->total, 2) }}
                                                </strong>
                                            </td>

                                            <td>

                                                @switch($walletHistory->type)

                                                    @case(0)
                                                        <span class="carnate-status complete">
                                                            <i class="bx bx-trending-up"></i>
                                                            Credit
                                                        </span>
                                                    @break

                                                    @case(1)
                                                        <span class="carnate-status declined">
                                                            <i class="bx bx-trending-down"></i>
                                                            Debit
                                                        </span>
                                                    @break

                                                @endswitch

                                            </td>

                                            <td>
                                                <span class="carnate-date">
                                                    {{ \Carbon\Carbon::parse($walletHistory->created_at)->format('d-m-Y h:i A') ?? '-' }}
                                                </span>
                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                        <div class="carnate-pagination">
                            {{ $walletHistories->onEachSide(1)->withPath(route('sparepart.withdrawal'))->links('livewire.sparepart.custom-pagination') }}
                        </div>

                    @else

                        <div class="carnate-empty-state">

                            <div class="carnate-empty-icon">
                                <i class="bx bx-history"></i>
                            </div>

                            <h4>No Wallet History</h4>

                            <p>No wallet transactions are available yet.</p>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>


    {{-- =========================
        WITHDRAW MODAL
    ========================== --}}
    <div class="carnate-modal"
        style="display: @if ($showModal) flex @else none @endif;">

        <div class="carnate-modal-dialog">

            <form wire:submit.prevent="{{ $isEdit ? 'store' : 'store' }}">

                <div class="carnate-modal-header">

                    <div>
                        <span class="carnate-modal-eyebrow">
                            Wallet Management
                        </span>

                        <h4>Withdraw Funds</h4>
                    </div>

                    <button type="button"
                        class="carnate-modal-close"
                        wire:click="$set('showModal', false)"
                        data-bs-dismiss="modal"
                        aria-label="Close">

                        <i class="bx bx-x"></i>

                    </button>

                </div>


                <div class="carnate-modal-body">

                    @csrf

                    {{-- Balance --}}
                    <div class="carnate-modal-balance">

                        <div class="carnate-modal-balance-icon">
                            <i class="bx bx-wallet"></i>
                        </div>

                        <div>
                            <span>Current Wallet Balance</span>

                            <strong>
                                ₹{{ number_format($vendor_data->wallet) }}
                            </strong>
                        </div>

                    </div>


                    {{-- Withdraw Amount --}}
                    <div class="carnate-form-group">

                        <label for="withdraw">
                            Withdraw Amount
                        </label>

                        <div class="carnate-input-wrap">

                            <span class="carnate-currency-symbol">₹</span>

                            <input type="number"
                                wire:model="withdraw"
                                class="carnate-input with-currency @error('withdraw') is-invalid @enderror"
                                id="withdraw"
                                placeholder="Enter withdraw amount"
                                min="1"
                                step="any"
                                required
                                @disabled($vendor_data->wallet <= 0)>

                        </div>

                        @error('withdraw')
                            <span class="carnate-error">
                                <i class="bx bx-error-circle"></i>
                                {{ $message }}
                            </span>
                        @enderror

                    </div>


                    {{-- Insufficient Funds --}}
                    @if ($vendor_data->wallet <= 0)

                        <div class="carnate-insufficient-alert">

                            <i class="bx bx-error-circle"></i>

                            <div>
                                <strong>Insufficient funds</strong>
                                <span>Please check your wallet balance before making a withdrawal.</span>
                            </div>

                        </div>

                    @endif

                </div>


                <div class="carnate-modal-footer">

                    <button type="button"
                        class="carnate-btn carnate-btn-secondary"
                        wire:click="$set('showModal', false)"
                        data-bs-dismiss="modal">

                        Cancel

                    </button>

                    <button type="submit"
                        class="carnate-btn carnate-btn-primary"
                        @disabled($vendor_data->wallet <= 0)
                        wire:loading.attr="disabled">

                        <i class="bx bx-money-withdraw"></i>
                        Withdraw

                        <span wire:loading class="carnate-spinner"></span>

                    </button>

                </div>

            </form>

        </div>

    </div>


    <style>
        .carnate-wallet-page {
            --carnate-red: #e53935;
            --carnate-red-soft: #fff5f5;
            --carnate-text: #111827;
            --carnate-muted: #64748b;
            --carnate-border: #e2e8f0;
            --carnate-green: #16a34a;
            --carnate-green-soft: #f0fdf4;
            --carnate-yellow: #d97706;
            --carnate-yellow-soft: #fffbeb;

            min-height: calc(100vh - 70px);
            padding: 24px;
            background: #f7f8fa;
            color: var(--carnate-text);
        }

        .carnate-wallet-page * {
            box-sizing: border-box;
        }

        /* Page Header */
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

        /* Main Grid */
        .carnate-wallet-grid {
            display: grid;
            grid-template-columns: minmax(290px, .72fr) minmax(0, 1.8fr);
            gap: 20px;
            align-items: start;
        }

        /* Wallet */
        .carnate-wallet-summary {
            position: sticky;
            top: 20px;
        }

        .carnate-wallet-card {
            position: relative;
            overflow: hidden;
            min-height: 285px;
            padding: 25px;
            border-radius: 18px;
            background:
                linear-gradient(135deg, rgba(17, 24, 39, .97), rgba(31, 41, 55, .94)),
                url('{{ asset('assets/img/wallet-bg.png') }}');
            background-size: cover;
            background-position: center;
            color: #fff;
            box-shadow: 0 12px 30px rgba(15, 23, 42, .12);
        }

        .carnate-wallet-card::after {
            position: absolute;
            top: -70px;
            right: -70px;
            width: 190px;
            height: 190px;
            border: 1px solid rgba(255, 255, 255, .08);
            border-radius: 50%;
            content: "";
        }

        .carnate-wallet-top {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 15px;
        }

        .carnate-wallet-label {
            display: block;
            margin-bottom: 9px;
            color: rgba(255, 255, 255, .65);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .carnate-wallet-top h2 {
            margin: 0;
            color: #fff;
            font-size: 30px;
            font-weight: 750;
            letter-spacing: -.03em;
        }

        .carnate-wallet-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
            border: 1px solid rgba(255, 255, 255, .13);
            border-radius: 12px;
            background: rgba(255, 255, 255, .08);
            color: #fff;
            font-size: 22px;
        }

        .carnate-wallet-divider {
            position: relative;
            z-index: 1;
            width: 100%;
            margin: 28px 0 17px;
            border-top: 1px dashed rgba(255, 255, 255, .2);
        }

        .carnate-last-transaction {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 15px;
        }

        .carnate-last-transaction span {
            display: block;
            margin-bottom: 4px;
            color: rgba(255, 255, 255, .55);
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: .06em;
        }

        .carnate-last-transaction strong {
            color: #fff;
            font-size: 12px;
            font-weight: 600;
        }

        .carnate-last-amount {
            color: #fff;
            font-size: 16px;
            font-weight: 700;
        }

        .carnate-withdraw-btn {
            position: relative;
            z-index: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            width: 100%;
            min-height: 43px;
            margin-top: 24px;
            border: 1px solid rgba(255, 255, 255, .14);
            border-radius: 10px;
            background: #fff;
            color: #111827;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s ease;
        }

        .carnate-withdraw-btn:hover {
            background: #f8fafc;
            transform: translateY(-1px);
        }

        /* History */
        .carnate-history-card {
            overflow: hidden;
            border: 1px solid var(--carnate-border);
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 4px 18px rgba(15, 23, 42, .035);
        }

        .carnate-tabs {
            display: flex;
            align-items: center;
            gap: 5px;
            padding: 8px 20px 0;
            border-bottom: 1px solid var(--carnate-border);
        }

        .carnate-tab {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            min-height: 50px;
            padding: 0 14px;
            border: 0;
            background: transparent;
            color: #64748b;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
        }

        .carnate-tab::after {
            position: absolute;
            right: 10px;
            bottom: -1px;
            left: 10px;
            height: 2px;
            background: transparent;
            content: "";
        }

        .carnate-tab.active {
            color: var(--carnate-red);
        }

        .carnate-tab.active::after {
            background: var(--carnate-red);
        }

        .carnate-tab i {
            font-size: 17px;
        }

        .carnate-history-card .tab-content {
            padding: 0;
        }

        /* Tables */
        .carnate-table-wrap {
            overflow-x: auto;
        }

        .carnate-table {
            width: 100%;
            min-width: 700px;
            border-collapse: collapse;
        }

        .carnate-table thead th {
            padding: 13px 18px;
            border-bottom: 1px solid var(--carnate-border);
            background: #f8fafc;
            color: #64748b;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .07em;
            text-align: left;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .carnate-table tbody td {
            padding: 14px 18px;
            border-bottom: 1px solid #edf1f5;
            color: var(--carnate-text);
            font-size: 13px;
            vertical-align: middle;
        }

        .carnate-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-table tbody tr:hover {
            background: #fafbfc;
        }

        .carnate-index {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            border-radius: 8px;
            background: #f1f5f9;
            color: #64748b;
            font-size: 11px;
            font-weight: 700;
        }

        .carnate-amount {
            color: var(--carnate-text);
            font-size: 13px;
            font-weight: 700;
            white-space: nowrap;
        }

        .carnate-balance {
            color: #334155;
            font-size: 13px;
            font-weight: 700;
            white-space: nowrap;
        }

        .carnate-transaction {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #475569;
            font-size: 12px;
        }

        .carnate-transaction i {
            color: #94a3b8;
            font-size: 15px;
        }

        .carnate-date {
            color: #64748b;
            font-size: 12px;
            white-space: nowrap;
        }

        .carnate-na {
            color: #94a3b8;
        }

        /* Status */
        .carnate-status {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 9px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .carnate-status.processing {
            background: var(--carnate-yellow-soft);
            color: var(--carnate-yellow);
        }

        .carnate-status.complete {
            background: var(--carnate-green-soft);
            color: var(--carnate-green);
        }

        .carnate-status.declined {
            background: #fef2f2;
            color: #dc2626;
        }

        /* Pagination */
        .carnate-pagination {
            padding: 15px 18px;
            border-top: 1px solid var(--carnate-border);
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
            width: 58px;
            height: 58px;
            margin-bottom: 13px;
            border-radius: 15px;
            background: #f1f5f9;
            color: #94a3b8;
            font-size: 27px;
        }

        .carnate-empty-state h4 {
            margin: 0;
            font-size: 16px;
            font-weight: 700;
        }

        .carnate-empty-state p {
            margin: 6px 0 0;
            color: var(--carnate-muted);
            font-size: 12px;
        }

        /* Modal */
        .carnate-modal {
            position: fixed;
            inset: 0;
            z-index: 9999;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: rgba(15, 23, 42, .52);
            backdrop-filter: blur(3px);
        }

        .carnate-modal-dialog {
            width: 100%;
            max-width: 500px;
            overflow: hidden;
            border: 1px solid var(--carnate-border);
            border-radius: 18px;
            background: #fff;
            box-shadow: 0 24px 70px rgba(15, 23, 42, .18);
            animation: carnateModalIn .18s ease-out;
        }

        @keyframes carnateModalIn {
            from {
                opacity: 0;
                transform: translateY(8px) scale(.985);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .carnate-modal-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 15px;
            padding: 20px 22px;
            border-bottom: 1px solid var(--carnate-border);
        }

        .carnate-modal-eyebrow {
            display: block;
            margin-bottom: 4px;
            color: var(--carnate-red);
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .1em;
            text-transform: uppercase;
        }

        .carnate-modal-header h4 {
            margin: 0;
            font-size: 19px;
            font-weight: 750;
        }

        .carnate-modal-close {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            padding: 0;
            border: 0;
            border-radius: 9px;
            background: #f1f5f9;
            color: #64748b;
            cursor: pointer;
        }

        .carnate-modal-close:hover {
            background: #fee2e2;
            color: var(--carnate-red);
        }

        .carnate-modal-close i {
            font-size: 20px;
        }

        .carnate-modal-body {
            padding: 22px;
        }

        .carnate-modal-balance {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px;
            margin-bottom: 22px;
            border: 1px solid var(--carnate-border);
            border-radius: 12px;
            background: #f8fafc;
        }

        .carnate-modal-balance-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            border-radius: 11px;
            background: var(--carnate-red-soft);
            color: var(--carnate-red);
            font-size: 20px;
        }

        .carnate-modal-balance span {
            display: block;
            margin-bottom: 3px;
            color: #64748b;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .05em;
        }

        .carnate-modal-balance strong {
            display: block;
            color: var(--carnate-text);
            font-size: 20px;
            font-weight: 750;
        }

        .carnate-form-group label {
            display: block;
            margin-bottom: 7px;
            color: #334155;
            font-size: 13px;
            font-weight: 700;
        }

        .carnate-input-wrap {
            position: relative;
        }

        .carnate-currency-symbol {
            position: absolute;
            top: 50%;
            left: 13px;
            z-index: 1;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 14px;
            font-weight: 700;
        }

        .carnate-input {
            width: 100%;
            min-height: 44px;
            padding: 10px 13px 10px 32px;
            border: 1px solid var(--carnate-border);
            border-radius: 10px;
            outline: none;
            background: #fff;
            color: var(--carnate-text);
            font-size: 13px;
            transition: .2s ease;
        }

        .carnate-input:focus {
            border-color: rgba(229, 57, 53, .45);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        .carnate-input.is-invalid {
            border-color: #fca5a5;
        }

        .carnate-error {
            display: flex;
            align-items: center;
            gap: 5px;
            margin-top: 6px;
            color: #dc2626;
            font-size: 12px;
        }

        .carnate-insufficient-alert {
            display: flex;
            gap: 11px;
            padding: 13px 14px;
            margin-top: 18px;
            border: 1px solid #fecaca;
            border-radius: 11px;
            background: #fef2f2;
            color: #991b1b;
        }

        .carnate-insufficient-alert > i {
            flex: 0 0 auto;
            font-size: 20px;
        }

        .carnate-insufficient-alert strong {
            display: block;
            font-size: 12px;
        }

        .carnate-insufficient-alert span {
            display: block;
            margin-top: 3px;
            font-size: 11px;
        }

        .carnate-modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 9px;
            padding: 16px 22px;
            border-top: 1px solid var(--carnate-border);
            background: #fafbfc;
        }

        .carnate-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            min-height: 42px;
            padding: 0 17px;
            border: 0;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s ease;
        }

        .carnate-btn-primary {
            background: var(--carnate-red);
            color: #fff;
            box-shadow: 0 5px 12px rgba(229, 57, 53, .14);
        }

        .carnate-btn-primary:hover:not(:disabled) {
            background: #d8322f;
            color: #fff;
            transform: translateY(-1px);
        }

        .carnate-btn-primary:disabled {
            opacity: .55;
            cursor: not-allowed;
        }

        .carnate-btn-secondary {
            background: #f1f5f9;
            color: #475569;
        }

        .carnate-btn-secondary:hover {
            background: #e2e8f0;
        }

        .carnate-spinner {
            width: 14px;
            height: 14px;
            border: 2px solid rgba(255, 255, 255, .45);
            border-top-color: #fff;
            border-radius: 50%;
            animation: carnateSpin .65s linear infinite;
        }

        @keyframes carnateSpin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Responsive */
        @media (max-width: 991px) {
            .carnate-wallet-grid {
                grid-template-columns: 1fr;
            }

            .carnate-wallet-summary {
                position: static;
            }

            .carnate-wallet-card {
                min-height: auto;
            }
        }

        @media (max-width: 767px) {
            .carnate-wallet-page {
                padding: 16px;
            }

            .carnate-page-header h1 {
                font-size: 23px;
            }

            .carnate-page-header p {
                font-size: 12px;
            }

            .carnate-wallet-card {
                padding: 20px;
            }

            .carnate-wallet-top h2 {
                font-size: 26px;
            }

            .carnate-tabs {
                padding-left: 10px;
                padding-right: 10px;
            }

            .carnate-tab {
                padding: 0 9px;
                font-size: 12px;
            }

            .carnate-modal {
                padding: 12px;
            }

            .carnate-modal-header,
            .carnate-modal-body {
                padding: 17px;
            }

            .carnate-modal-footer {
                padding: 13px 17px;
            }
        }

        @media (max-width: 480px) {
            .carnate-wallet-top {
                align-items: center;
            }

            .carnate-wallet-top h2 {
                font-size: 23px;
            }

            .carnate-wallet-icon {
                width: 40px;
                height: 40px;
            }

            .carnate-last-transaction {
                align-items: flex-start;
                flex-direction: column;
            }

            .carnate-last-amount {
                font-size: 15px;
            }

            .carnate-tabs {
                overflow-x: auto;
            }

            .carnate-tab {
                flex: 0 0 auto;
                white-space: nowrap;
            }

            .carnate-modal-footer .carnate-btn {
                flex: 1;
            }
        }
    </style>

</div>