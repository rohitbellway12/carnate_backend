<div>
    <style>
          .mode {
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            font-size: 18px;
        }

        .mode:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .bg-danger {
            background: linear-gradient(135deg, #e63946, #ff6b6b);
        }

        .bg-primary {
            background: linear-gradient(135deg, #007bff, #409eff);
        }

        .bg-info {
            background: linear-gradient(135deg, #17a2b8, #67d1f3);
        }

        .bg-success {
            background: linear-gradient(135deg, #28a745, #72d572);
        }
 
        
    </style>
    <!-- Success Message -->
    @if (session()->has('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <div class="card">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div class="breadcrumb-title pe-2" style="border: none;"><i class="fas fa-tasks fs-5"></i> Job-Card</div>
            <div class="pe-3">
                
            </div>
        </div>
    </div>
   
    <div class="card mt-4">
        @if (!empty($jobcards) && $jobcards->count())
        <div class="card-body ">
            <div class="row p-3">
                <div class="col-lg-3 col-md-6 col-12 mb-3">
                    <div class="card overflow-hidden" wire:click="$set('mode', 00)">
                        <div class="card-body  mode bg-danger text-white d-flex justify-content-between">
                            <span><b><i class="fa-solid fa-unlock"></i> Open</b></span>
                            <span><b>( {{ count($jobcardsCount->where('status', 0)) }} )</b></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mb-3">
                    <div class="card overflow-hidden" wire:click="$set('mode', 1)">
                        <div class="card-body mode bg-primary text-white d-flex justify-content-between">
                            <span><b><i class="fa-solid fa-circle-check"></i> Confirmed</b></span>
                            <span><b>( {{ count($jobcardsCount->where('status', 1)) }} )</b></span>
                        </div>
                    </div>
                </div>  
                <div class="col-lg-3 col-md-6 col-12 mb-3">
                    <div class="card overflow-hidden" wire:click="$set('mode', 2)">
                        <div class="card-body mode bg-success text-white d-flex justify-content-between">
                            <span><b><i class="fa-solid fa-flag-checkered"></i> Completed</b></span>
                            <span><b>( {{ count($jobcardsCount->where('status', 2)) }} )</b></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mb-3">
                    <div class="card overflow-hidden" wire:click="$set('mode', 3)">
                        <div class="card-body mode bg-info text-white d-flex justify-content-between" style>
                            <span ><b><i class="fa-solid fa-close"></i> Closed</b></span>
                            <span><b>( {{ count($jobcardsCount->where('status', 3)) }} )</b></span>
                        </div>
                    </div>
                </div>
                </div>
                
                <div class="card-body">
                    <div class="row">
                    <div class="col-3">
                        <input type="text" class="form-control" placeholder="Search Job-Card Number" wire:model.live="searchfilter" fdprocessedid="blgf5">
                    </div>
                    <div class="col-9 text-right">
                        <button type="button" class="mr-2 btn btn-info text-white rounded-0  float-end" wire:click="resetFilter" fdprocessedid="orntg">Clear</button>
                        </div>
                    </div>
                    
                </div>
            <div class="table-responsive">
                <table class="table table-bordered data-table">
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
                                <td>{{ $jobcards->total() - ($jobcards->firstItem() + $index) + 1 }}</td>
                                <td>
                                    <a>
                                        {{ \Carbon\Carbon::parse($jobcard->entry_date)->format('d-m-Y h:i A') ?? '-' }}
                                    </a>
                                </td>
                                <td>
                                    <a>
                                        {{ $jobcard->jobcard_number ?? '-' }}
                                    </a>
                                </td>
                                <td>
                                    <a>
                                        {{ $jobcard->customer_name ?? '-' }}
                                    </a>
                                </td>
                                <td>
                                    <a>
                                        {{ $jobcard->vehical_number ?? '-' }}
                                    </a>
                                </td>
                                <td>
                                    <a>
                                        {{ $jobcard->vehical ?? '-' }}
                                    </a>
                                </td>
                                <td>
                                    <a>
                                        {{ $jobcard->amount ?? '-' }}
                                    </a>
                                </td>
                                <td>
                                    <a style="color: black;">
                                        {{ $jobcard->advance ?? '-' }}
                                    </a>
                                </td>
                                <td>
                                    <a style="color: black;">
                                        {{ $jobcard->balance_amount ?? '-' }}
                                    </a>
                                </td>
                                <td>
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
                                        @default
                                            <span class="badge bg-danger">Open</span>
                                    @endswitch
                                </td>
                               
                            </tr>
                        @endforeach
                    </tbody>
                    
                </table>
                <div class="pagination-wrapper">
                    {{ $jobcards->links() }}
                </div>
            </div>
        </div>
        @else
        <div class="my-2">
            <div class="alert alert-info">No Job-Card found!</div>
        </div>
        @endif
    </div>

</div>
@section('footerscript')
@endsection