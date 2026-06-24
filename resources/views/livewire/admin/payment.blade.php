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
            <div class="breadcrumb-title pe-2" style="border: none;"><i class="fas fa-coins fs-5"></i> Payment</div>
            
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-body">
            <div class="row">
                <div class="col-3">
                    <input type="text" class="form-control" placeholder="Search All" wire:model.live="searchfilter" fdprocessedid="blgf5">
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <select class="form-select" wire:model.live="status_filter">
                            <option value="">Select Status</option>
                            <option value="success">Success</option>
                            <option value="failed">Failed</option>
                        </select>
                    </div>
                </div>
                <div class="col-6 text-right">
                    <button type="button" class="mr-2 btn btn-info text-white rounded-0  float-end" wire:click="resetFilter" fdprocessedid="orntg">Clear</button>
                 </div>
            </div>
        </div>
    </div> 
    <div class="card mt-4">
        @if (!empty($payments) && $payments->count())
        <div class="card-body ">
            <div class="table-responsive">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>company name</th>
                            <th>Payment Id</th>
                            <th>Invoice Number</th>
                            <th>Status</th>
                            <th>Amount</th>
                            @if (@$admin->hasPermissionTo('payment-edit')||@$admin->hasPermissionTo('payment-delete')) 
                            {{-- <th>Actions</th> --}}
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $index => $payment)
                        {{-- @php 
                        dd($payment);
                        @endphp --}}
                        <tr>
                            <td>{{ $payments->total() - ($payments->firstItem() + $index) + 1 }}</td>
                            <td>{{ $payment->user ? $payment->user->company_name : 'N/A'}}</td>
                            <td>{{ $payment->payment_id }}</td>
                            <td> {{ getPaymentInvoiceNumbers($payment) }} </td>
                            <td> {{ ucfirst($payment->status) }} </td>
                            <td> {{ $payment->amount }} </td>
                            @if (@$admin->hasPermissionTo('payment-edit')||@$admin->hasPermissionTo('payment-delete')) 
                            {{-- <td>
                                @if (@$admin->hasPermissionTo('payment-edit')) 
                                <a wire:click="edit({{ $payment->id }})" class="btn btn-sm p-0"><i
                                        class="bx bxs-edit"></i> <span class="small"></span></a>
                                @endif
                                @if (@$admin->hasPermissionTo('payment-delete')) 
                                <a wire:click="confirmDelete({{ $payment->id }})"
                                    class="btn btn-sm p-0"><i class="fadeIn animated bx bx-trash"></i> <span
                                        class="small"></span></a>
                                 @endif
                            </td> --}}
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination-wrapper">
                    {{ $payments->links() }}
                </div>
            </div>
        </div>
        @else
        <div class="my-2">
            <div class="alert alert-info">No Payment found!</div>
        </div>
        @endif
    </div>

</div>
@section('footerscript')
@endsection