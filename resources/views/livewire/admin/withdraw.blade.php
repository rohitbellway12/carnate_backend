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
                <div><strong>Total Amount:</strong> ₹{{ number_format($totalAmount ?? 0, 2) }}</div>
                <div><strong>Withdrawn Amount:</strong> ₹{{ number_format($withdrawAmount ?? 0, 2) }}</div>
                <div><strong>Balance Amount:</strong> ₹{{ number_format($balanceAmount ?? 0, 2) }}</div>
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
            <div class="row">
            <div class="col-3">
                <input type="text" class="form-control" placeholder="Search " wire:model.live="searchfilter" fdprocessedid="blgf5">
            </div>
            <div class="col-9 text-right">
                <button type="button" class="mr-2 btn btn-info text-white rounded-0  float-end" wire:click="resetFilter" fdprocessedid="orntg">Clear</button>
             </div>
            </div>
            
        </div>
    </div> 
    <div class="card mt-4">
        @if (!empty($withdraws) && $withdraws->count())
        <div class="card-body ">
            <div class="table-responsive">
                <table class="table table--bordered data-table">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>User</th>
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
                            <td> {{ $withdraw->amount }} </td>
                            <td> {{ $withdraw->transaction_id ?? '-' }} </td>
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
                             <a wire:click="confirmApprove({{ $withdraw->id }},{{ $withdraw->amount}},{{ $withdraw->user_id}})" class="btn btn-sm p-0">  <span class="btn btn-sm btn-success">Approve</span>  <span class="small"></span></a>
                             @endif
                             @if (@$admin->hasPermissionTo('withdraw-delete')) 
                             <a wire:click="edit({{ $withdraw->id }},2,{{ $withdraw->amount}},{{ $withdraw->user_id}})" class="btn btn-sm p-0">  <span class="btn btn-sm btn-danger">Decline</span>  <span class="small"></span></a>
                             @endif
                             @else
                                <p>-</p>
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
</div>
@section('footerscript')
@endsection