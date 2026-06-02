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
                             <a wire:click="edit({{ $withdraw->id }},1,{{ $withdraw->amount}},{{ $withdraw->user_id}})" class="btn btn-sm p-0">  <span class="btn btn-sm btn-success">Approve</span>  <span class="small"></span></a>
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

</div>
@section('footerscript')
@endsection