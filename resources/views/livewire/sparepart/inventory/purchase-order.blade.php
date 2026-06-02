<div>
<!-- <h1>hello</h1> -->
<div class="card mt-4">
    <div class="card-body d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Purchase Orders</h4>
        <button wire:click="goToCreate" class="btn btn-primary radius-30 mt-2 mt-lg-0">
            <i class="bx bxs-plus-square"></i> Create PO
        </button>
    </div>
</div>
  <!-- Summary Cards -->
<!-- Summary Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card shadow-sm h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1 fw-semibold">Total Purchase Order</p>
                    <h4 class="mb-0">{{ $totalOrders }}</h4>
                </div>
                <img src="https://cdn-icons-png.flaticon.com/512/3209/3209265.png" alt="Invoice"
                     style="width: 48px; height: 48px;" />
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1 fw-semibold">Total Amount Paid</p>
                    <h4 class="mb-0">₹ {{ number_format($totalPaid) }}</h4>
                </div>
                <img src="https://cdn-icons-png.flaticon.com/512/4058/4058611.png" alt="Amount"
                     style="width: 48px; height: 48px;" />
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1 fw-semibold">Pending Balance</p>
                    <h4 class="mb-0">₹ {{ number_format($totalPending) }}</h4>
                </div>
                <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Pending"
                     style="width: 48px; height: 48px; filter: hue-rotate(90deg);" />
            </div>
        </div>
    </div>
</div>
 
 
<!-- Global Filter (Static) -->
 
 
 
        <div class="row g-3 mb-4">
    <!-- Search Input -->
    <div class="col-md-5">
        <div class="input-group shadow-sm">
            <span class="input-group-text bg-white border-end-0">
                <i class="bx bx-search"></i>
            </span>
            <input type="text" wire:model.live="search" class="form-control" placeholder="Search by Supplier or Bill No">
        </div>
    </div>
 
    <!-- Date Range Input -->
 <div class="col-md-5">
    <div class="input-group shadow-sm">
        <span class="input-group-text bg-white border-end-0">
            <i class="bx bx-calendar"></i>
        </span>
        <input type="text" wire:model.live="date_range" id="dateRangePicker" class="form-control" placeholder="Select Date Range">
    </div>
</div>
 
    <!-- Search Button -->
    <div class="col-md-2">
        <button wire:click="applyFilters" class="btn btn-primary w-100">
            <i class="bx bx-filter-alt"></i> Filter
        </button>
    </div>
</div>
<!-- table list -->
<div class="card mt-3">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>PO Date</th>
                        <th>PO No.</th>
                        <th>Supplier</th>
                        <th>Contact No.</th>

                        <!-- <th>Bill No</th> -->
                        <th>Bill Date</th>
                        <th>paid Amount</th>
                        <th>pending Amount</th>
                        <th>Status</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @forelse($po_list as $po)
                        @php
                            $statusClass = match($po->po_status) {
                                'Open' => 'badge-status-open',
                                'Placed' => 'badge-status-placed',
                                'Received' => 'badge-status-received',
                                'Closed' => 'badge-status-closed',
                                'Cancelled' => 'badge-status-cancelled',
                                default => 'badge-status-open'
                            };
                        @endphp
                        <tr>
                            <td>{{ $po->po_date }}</td>
                            <td><a href="#" wire:click.prevent="editPO({{ $po->id }})">{{ $po->po_no }}</a></td>
                            <td>{{ $po->supplier->business_first_name ?? '-' }}</td>
                            <td>{{ $po->supplier->mobile_no ?? '-' }}</td>
                           
                            <!-- <td>{{ $po->bill_no }}</td> -->
                            <td>{{ $po->bill_date }}</td>
                            <!-- <td>{{$po->subtotal - $po->total_payable}}</td>
                            <td>{{$po->total_payable}}</td> -->
                            <td>{{$po->paid}}</td>
                            <td>{{$po->balance}}</td>
                            <td>
                                <span class="badge {{ $statusClass }}">{{ $po->po_status }}</span>
                            </td>
                           
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No Purchase Orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<style>
.badge-status-open {
    background: #007bff !important;
    color: #fff !important;
}
.badge-status-placed {
    background: rgb(226, 149, 41) !important;
    color: #fff !important;
}
.badge-status-received {
    background: rgb(32, 184, 45) !important;
    color: #fff !important;
}
.badge-status-closed {
    background: #b3b300 !important;
    color: #fff !important;
}
.badge-status-cancelled {
    background: #dc3545 !important;
    color: #fff !important;
}
</style>

<!-- Date Range Picker Scripts -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
function attachDateRangePicker() {
    $('#dateRangePicker').daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear',
            format: 'DD-MM-YYYY'
        }
    });

    $('#dateRangePicker').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
        // Livewire v3 compatible property update
        if (window.Livewire && window.Livewire.first) {
            window.Livewire.first().set('date_range', $(this).val());
        }
    });

    $('#dateRangePicker').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
        if (window.Livewire && window.Livewire.first) {
            window.Livewire.first().set('date_range', '');
        }
    });
}

window.addEventListener('DOMContentLoaded', function () {
    attachDateRangePicker();
});
document.addEventListener('livewire:load', function () {
    attachDateRangePicker();
    if (window.livewire) {
        window.livewire.on('message.processed', function () {
            attachDateRangePicker();
        });
    }
});
</script>
</div>
