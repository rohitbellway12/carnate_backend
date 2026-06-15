<div>
    <style>
        .wallet-card {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-image: url('{{ asset('assets/img/wallet-bg.png') }}');
            background-size: cover;
            background-position: center;
            color: #fff;
            padding: 30px;
            /* Increased padding */
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* Increased width */
            margin: auto;
            position: relative;
        }

       
        .wallet-actions p,
        .wallet-actions h3 {
            color: #fff;
            /* Make text white */
        }

        .wallet-actions {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            margin-left: 20px;
            /* Space between button and wallet info */
        }

        .recharge-button {
            font-size: 16px;
            /* Increased font size */
            padding: 15px 30px;
            /* Increased padding */
            /* color: #fff; /* White text color for button */
            /* border-color: #fff; White border for the button */
            */
        }

        .recharge-button:hover {
            background-color: #444456;
        }

        .divider {
            width: 100%;
            border-top: 1px dotted #5a5a70;
            margin: 10px 0;
        }
    </style>
    @php
        $sparePart = $user;
    @endphp

    <div class="container p-0">
        <div class="card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div class="breadcrumb-title pe-2" style="border: none;">Wallet Management</div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="wallet-card">
                            <div class="text-center w-100">
                                <h2 class="text-white">Wallet Balance</h2>
                                <h2 class="text-white">₹{{ number_format($vendor_data->wallet, 2) }}</h2>
                                <hr class="divider">
                                <p class="m-0">last Transaction :
                                    {{ $wallet?->created_at->format('d.m.Y') ?? 'No data available' }}
                                </p>
                                <p clas="text-white m-0">
                                    ₹{{ number_format($wallet?->amount ?? 0, 2) }}
                                </p>
                                @if (@$sparePart->hasPermissionTo('wallet-add'))
                                    <button wire:click="rechargeWallet" class="recharge-button">
                                        <span>+</span> withdraw
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Withdraw History</h5>
                    </div>
                    <div class="card-body">
                        @if (!empty($withdraws) && $withdraws->count())
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-sm">
                                    <thead class="thead-light">
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
                                                <td>{{ $withdraws->total() - ($withdraws->firstItem() + $index) + 1 }}</td>
                                                <td>{{ $withdraw->amount }}</td>
                                                <td>{{ $withdraw->transaction_id ?? '-' }}</td>
                                                <td>
                                                    @switch($withdraw->status)
                                                        @case(0)
                                                            <span class="badge bg-danger">Processing</span>
                                                        @break

                                                        @case(1)
                                                            <span class="badge bg-success">Complete</span>
                                                        @break

                                                        @case(2)
                                                            <span class="badge bg-danger">Declined</span>
                                                        @break
                                                    @endswitch
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($withdraw->created_at)->format('d-m-Y h:i A') ?? '-' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- Withdraw Pagination -->
                                <div class="pagination-wrapper">
                                    {{ $withdraws->onEachSide(1)->withPath(route('sparepart.withdrawal'))->links('livewire.sparepart.custom-pagination') }}
                                </div>
                            </div>
                        @else
                            <div class="col-12 my-2">
                                <div class="alert alert-info text-center">No withdraw history found!</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Wallet History</h5>
                    </div>
                    <div class="card-body">
                        @if (!empty($walletHistories) && count($walletHistories) > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-sm">
                                    <thead class="thead-light">
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
                                                <td>{{ $walletHistories->total() - ($walletHistories->firstItem() + $index) + 1 }}</td>
                                                <td>{{ number_format($walletHistory->amount, 2) }}</td>
                                                <td>{{ number_format($walletHistory->total, 2) }}</td>
                                                <td>
                                                    @switch($walletHistory->type)
                                                        @case(0)
                                                            <span class="badge bg-success">Credit</span>
                                                        @break

                                                        @case(1)
                                                            <span class="badge bg-danger">Debit</span>
                                                        @break
                                                    @endswitch
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($walletHistory->created_at)->format('d-m-Y h:i A') ?? '-' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- Wallet Pagination -->
                                <div class="pagination-wrapper">
                                    {{ $walletHistories->onEachSide(1)->withPath(route('sparepart.withdrawal'))->links('livewire.sparepart.custom-pagination') }}
                                </div>
                            </div>
                        @else
                            <div class="alert alert-info text-center">No wallet history found!</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal @if ($showModal) show @endif" tabindex="-1"
        style="opacity:1; background-color:#0606068c; display:@if ($showModal) block @endif">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form wire:submit.prevent="{{ $isEdit ? 'store' : 'store' }}">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ $isEdit ? ' Withdraw' : ' Withdraw' }}</h4>
                        <button type="button" class="btn-close" wire:click="$set('showModal', false)"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-4">
                        @csrf
                        <div class="text-center mb-4">
                            <h6 class="fw-bold">Wallet Balance</h6>
                            <h4 class="text-success">₹{{ number_format($vendor_data->wallet) }}</h4>
                            <hr class="divider">
                        </div>

                        <!-- withdraw Amount -->
                        <div class="mb-3">
                            <label for="withdraw" class="form-label">Withdraw Amount</label>
                            <input type="number" wire:model="withdraw"
                                class="form-control @error('withdraw') is-invalid @enderror" id="withdraw"
                                placeholder="Enter withdraw amount" min="1" step="any" required
                                @disabled($vendor_data->wallet <= 0)>
                            @error('withdraw')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Conditional Error for Insufficient Funds -->
                        @if ($vendor_data->wallet <= 0)
                            <div class="alert alert-danger" role="alert">
                                Insufficient funds. Please check your balance.
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="$set('showModal', false)"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" @disabled($vendor_data->wallet <= 0)
                            wire:loading.attr="disabled">
                            {{ $isEdit ? ' withdraw' : ' withdraw' }}
                            <i class="spinner-border spinner-border-sm" wire:loading></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
