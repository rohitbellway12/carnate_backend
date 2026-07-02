<div>
    <!-- Success Message -->
    @if (session()->has('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    @php
    $admin = App\Models\Admin::where('id', $adminId)->first();
  @endphp

    <div class="card">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div class="breadcrumb-title pe-2" style="border: none;"><i class="fas fa-coins fs-5"></i> Withdraw</div>
            {{-- Summary of amounts --}}
            <div class="d-flex gap-4">
                <div><strong>Total Requested:</strong> ₹{{ number_format($totalAmount ?? 0, 2) }}</div>
                <div><strong>Total Approved:</strong> ₹{{ number_format($withdrawAmount ?? 0, 2) }}</div>
                <div><strong>Total Pending / Declined:</strong> ₹{{ number_format($balanceAmount ?? 0, 2) }}</div>
            </div>
            {{-- @if (@$admin->hasPermissionTo('withdraw-add')) 
            <div class="pe-3">
                <a href="javascript:;" wire:click="create" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i
                        class="bx bxs-plus-square"></i>Add</a>
            </div>
            @endif--}}
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-body">
            <div class="row align-items-center g-2">
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Search " wire:model.live="searchfilter">
                </div>
                <div class="col-md-6">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="withdraw-requests-tab" data-bs-toggle="tab" data-bs-target="#withdrawRequests" type="button" role="tab">
                                Withdraw Requests
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="vendor-wise-tab" data-bs-toggle="tab" data-bs-target="#vendorWiseSummary" type="button" role="tab">
                                Vendor Wise Summary
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3 text-end">
                    <button type="button" class="btn btn-info text-white rounded-0" wire:click="resetFilter">Clear</button>
                </div>
            </div>
        </div>
    </div>

    <div class="tab-content mt-4">
        <div class="tab-pane fade show active" id="withdrawRequests" role="tabpanel">
            <div class="card">
                @if (!empty($withdraws) && $withdraws->count())
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table--bordered data-table">
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
                                    <td>{{ $withdraws->total() - ($withdraws->firstItem() + $index) + 1 }}</td>
                                    <td>{{ @$withdraw->SparePartVendor->name .' '.  @$withdraw->SparePartVendor->lastname  }}</td>
                                    <td>₹{{ number_format(@$withdraw->SparePartVendor->wallet ?? 0, 2) }}</td>
                                    <td>₹{{ number_format($withdraw->amount, 2) }}</td>
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
                                    @if (@$admin->hasPermissionTo('withdraw-edit') || @$admin->hasPermissionTo('withdraw-delete'))
                                    <td>
                                        @if($withdraw->status == 0)
                                            @if (@$admin->hasPermissionTo('withdraw-edit'))
                                            <a wire:click="confirmApprove({{ $withdraw->id }},{{ $withdraw->amount}},{{ $withdraw->user_id}})" class="btn btn-sm p-0">
                                                <span class="btn btn-sm btn-success">Approve</span>
                                            </a>
                                            @endif
                                            @if (@$admin->hasPermissionTo('withdraw-delete'))
                                            <a wire:click="edit({{ $withdraw->id }},2,{{ $withdraw->amount}},{{ $withdraw->user_id}})" class="btn btn-sm p-0">
                                                <span class="btn btn-sm btn-danger">Decline</span>
                                            </a>
                                            @endif
                                        @else
                                            <p class="mb-0">-</p>
                                        @endif
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper">
                            {{ $withdraws->links() }}
                        </div>
                    </div>
                </div>
                @else
                <div class="my-2">
                    <div class="alert alert-info">No withdraw found!</div>
                </div>
                @endif
            </div>
        </div>

            <div class="tab-pane fade" id="vendorWiseSummary" role="tabpanel">
                <div class="card">
                    @if (!empty($groupedWithdraws) && $groupedWithdraws->count())
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table--bordered mb-0">
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
                                            <td>{{ $summaryNo++ }}</td>
                                            <td>{{ $vendorWithdraw['vendor_name'] }}</td>
                                            <td>₹{{ number_format($vendorWithdraw['wallet_amount'], 2) }}</td>
                                            <td>₹{{ number_format($vendorWithdraw['total_amount'], 2) }}</td>
                                            <td>₹{{ number_format($vendorWithdraw['withdraw_amount'], 2) }}</td>
                                            <td>₹{{ number_format($vendorWithdraw['balance_amount'], 2) }}</td>
                                            <td>
                                                <button wire:click="viewVendorDetail({{ $vendorWithdraw['user_id'] }})" class="btn btn-sm btn-info text-white" title="View Details">
                                                    <i class="bx bx-show"></i> Action
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-3">No vendor withdraw data found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @else
                    <div class="my-2">
                        <div class="alert alert-info">No vendor withdraw data found!</div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Approve Withdraw Modal -->
        <div class="modal @if ($showApproveModal) show @endif" tabindex="-1"
            style="opacity: 1; background-color: #0606068c; display: @if ($showApproveModal) block @else none @endif">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <form wire:submit.prevent="approveWithdraw">
                        <div class="modal-header">
                            <h5 class="modal-title">Approve Withdrawal Request</h5>
                            <button type="button" class="btn-close" wire:click="$set('showApproveModal', false)"
                                data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body py-3">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-bold">Amount</label>
                                <div>₹{{ number_format($selectedWithdrawAmount, 2) }}</div>
                            </div>
                            <div class="mb-3">
                                <label for="transaction_id" class="form-label fw-bold">Transaction ID / UTR Number <span class="text-danger">*</span></label>
                                <input type="text" id="transaction_id" class="form-control" wire:model="transaction_id" placeholder="Enter Transaction ID or UTR number" required>
                                @error('transaction_id')
                                    <div class="text-danger mt-1 small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" wire:click="$set('showApproveModal', false)"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">
                                Approve
                                <i class="spinner-border spinner-border-sm" wire:loading wire:target="approveWithdraw"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Vendor Detail Modal --}}
        <div class="modal @if ($showVendorDetailModal) show @endif" tabindex="-1"
            style="opacity: 1; background-color: #0606068c; display: @if ($showVendorDetailModal) block @else none @endif">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Vendor Details - {{ $selectedVendorData->name ?? '' }} {{ $selectedVendorData->lastname ?? '' }}</h5>
                        <button type="button" class="btn-close" wire:click="$set('showVendorDetailModal', false)" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if ($showVendorDetailModal && $selectedVendorData)
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <strong>Vendor:</strong> {{ $selectedVendorData->name }} {{ $selectedVendorData->lastname }}
                                </div>
                                <div class="col-md-4">
                                    <strong>Company:</strong> {{ $selectedVendorData->company_name ?? '-' }}
                                </div>
                                <div class="col-md-4">
                                    <strong>Current Wallet:</strong> ₹{{ number_format($selectedVendorData->wallet ?? 0, 2) }}
                                </div>
                            </div>

                            <h6 class="fw-bold mb-3">Withdraw History</h6>
                            <div class="table-responsive mb-4">
                                <table class="table table-bordered table-hover table-sm mb-0">
                                    <thead class="thead-light">
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
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>₹{{ number_format($withdraw->amount, 2) }}</td>
                                                    <td>{{ $withdraw->transaction_id ?? '-' }}</td>
                                                    <td>
                                                        @switch($withdraw->status)
                                                            @case(0)
                                                                <span class="badge bg-warning text-dark">Processing</span>
                                                            @break
                                                            @case(1)
                                                                <span class="badge bg-success">Complete</span>
                                                            @break
                                                            @case(2)
                                                                <span class="badge bg-danger">Declined</span>
                                                            @break
                                                        @endswitch
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($withdraw->created_at)->format('d-m-Y h:i A') ?? '-' }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5" class="text-center text-muted">No withdraw history found.</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <h6 class="fw-bold mb-3">Wallet History</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-sm mb-0">
                                    <thead class="thead-light">
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
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>₹{{ number_format($wallet->amount, 2) }}</td>
                                                    <td>₹{{ number_format($wallet->total, 2) }}</td>
                                                    <td>
                                                        @switch($wallet->type)
                                                            @case(0)
                                                                <span class="badge bg-success">Credit</span>
                                                            @break
                                                            @case(1)
                                                                <span class="badge bg-danger">Debit</span>
                                                            @break
                                                            @case(2)
                                                                <span class="badge bg-info">Refund</span>
                                                            @break
                                                        @endswitch
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($wallet->created_at)->format('d-m-Y h:i A') ?? '-' }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5" class="text-center text-muted">No wallet history found.</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="$set('showVendorDetailModal', false)" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('footerscript')
@endsection