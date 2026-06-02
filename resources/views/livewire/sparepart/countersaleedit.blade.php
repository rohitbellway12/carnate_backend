<div>
    <div class="modal @if ($showModal) show @endif" tabindex="-1"
        style="opacity:1; background-color:#0606068c; display:@if ($showModal) block @endif">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form wire:submit.prevent="{{ $add ? 'storeCustomer' : 'storeCustomer' }}">
                    <div class="modal-header">
                        <h4 class="modal-title">Customer Details</h4>
                        <button type="button" class="btn-close" wire:click="$set('showModal', false)"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-3">
                        @csrf

                        <div class="row g-3">
                            <!-- Name -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Name<sup class="text-danger">*</sup></label>
                                    <input type="text" wire:model="name" class="form-control"
                                        placeholder="Enter Name">
                                </div>
                                @error('name')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Email<sup class="text-danger">*</sup></label>
                                    <input type="email" wire:model="email" class="form-control"
                                        placeholder="Enter Email">
                                </div>
                                @error('email')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Mobile Number -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Mobile Number<sup class="text-danger">*</sup></label>
                                    <input type="text" wire:model="mobile_no" class="form-control"
                                        placeholder="Enter Mobile Number">
                                </div>
                                @error('mobile_no')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- <div class="col-md-6">
                            <label class="form-label">Number Plate<sup class="text-danger">*</sup></label>
                            <input type="text" wire:model="numberPlate" class="form-control"
                                placeholder="Enter Number Plate">
                            @error('numberPlate')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div> --}}

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">GST Number</label>
                                    <input type="text" wire:model="gst_no" class="form-control"
                                        placeholder="Enter GST Number">
                                </div>
                            </div>
                            <!-- Address -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Address<sup class="text-danger">*</sup></label>
                                    <textarea wire:model="address" class="form-control" placeholder="Enter Address"></textarea>
                                </div>
                                @error('address')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="$set('showModal', false)"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create
                            <i class="spinner-border spinner-border-sm" wire:loading></i>
                        </button>
                    </div>
                </form>



            </div>
        </div>
    </div>
    <div class="py-3">
        <div class="card h-100">
            <div class="card-body">
                <div class="page-title ">
                    <div class="nav_menu">
                        <nav class="d-flex align-items-center justify-content-between mb-3">
                            <!-- Navigation Toggle and Back Link -->
                            <div class="nav toggle">
                                <a href="{{ route('sparepart.countersale') }}" class="d-flex align-items-center">
                                    <img src="{{ asset('supplier/Back Arrow.png') }}" class="back-arrow me-2">
                                    <div class="breadcrumb-title pe-2 text-dark" style="border: none;">Create Counter
                                        Sale
                                    </div>
                                </a>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="card h-100">
                    <div class="card-body">
                        <h6 class="text-center m-0">
                            <b>Search or Create New User</b>
                        </h6>
                        <hr>
                        <label for="customer-dropdown" class="form-label">Customer Name</label>
                        <div class="input-group mb-3" wire:ignore.self>
                            <select id="customer_name" wire:model="customer_name" class="form-select select2"
                                data-property="customer_name">
                                <option value="">--Select Customer--</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">
                                        {{ $customer->name . ' ' . $customer->lastname }}</option>
                                @endforeach
                            </select>
                            <button type="button"
                                class="btn btn-outline-secondary text-light bg-primary fl margin-left-0"
                                wire:click="addCustomer">
                                {{ trans('+') }}
                            </button>
                            @error('customer_name')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                        @if (!empty($customer_data))
                            <p class="my-2" style="color: #0dcaf0;">Customer :-
                                {{ @$customer_data->name }}</p>
                            <p class="my-2" style="color: #0dcaf0;">Mobile No. :- {{ @$customer_data->mobile_no }}
                            </p>
                            {{-- <p class="my-2" style="color: #0dcaf0;">Vehicle :- {{ @$customer_data->number_plate }}
                            </p> --}}
                            <p class="my-2" style="color: #0dcaf0;">GST :- {{ @$customer_data->gst_number }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h6 class="m-0"><b>Counter Sale Details</b></h6>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12">

                                <div class="ulprofile">
                                    <div class="input-group mt-2">
                                        <span class="input-group-text">Counter Sale No.</span>
                                        <input type="text" form="form-control" id="countersale_number"
                                            wire:model="countersale_number" class="form-control bg-light" readonly
                                            placeholder="Job-Card Number" aria-label="Job-Card Number">
                                        <span class="input-group-text">Date</span>
                                        <input type="text" class="form-control bg-light"
                                            value="{{ now()->format('d-m-Y') }}" readonly placeholder="Date"
                                            aria-label="Date">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-12 mt-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h6 class="m-0"><b>Spare & Lube Details</b></h6>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12">

                                <div class="mt-4 table-view overflow-auto w-100" id="spare-table"
                                    style="display: {{ $showTable == 2 ? 'block' : 'none' }}">
                                    <table class="table table-bordered" id="spare-part-table">
                                        <thead>
                                            <tr>
                                                <th>Particulars</th>
                                                <th>Quantity</th>
                                                <th>Unit Price(Rs)</th>
                                                <th>Discount</th>
                                                <th>Amount</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($spareParts as $index => $part)
                                                <tr>
                                                    <td><input type="text" class="form-control"
                                                            wire:model="spareParts.{{ $index }}.part_name"
                                                            placeholder="Part Name"
                                                            id="spareParts.{{ $index }}.part_name"></td>
                                                    <td><input type="number" class="form-control"
                                                            wire:model.lazy="spareParts.{{ $index }}.quantity"
                                                            id="spareParts.{{ $index }}.unit_price">
                                                    </td>
                                                    <td><input type="number" class="form-control"
                                                            wire:model.lazy="spareParts.{{ $index }}.unit_price">
                                                    </td>
                                                    <td>
                                                        <div class="input-group flex-nowrap">
                                                            <input type="number" class="form-control"
                                                                wire:model.lazy="spareParts.{{ $index }}.discount"
                                                                id="spareParts.{{ $index }}.discount"
                                                                step="1" min="0" placeholder="Discount"
                                                                style="min-width: 70px;">
                                                            <select class="form-select"
                                                                id="spareParts.{{ $index }}.discount_type"
                                                                wire:model.lazy="spareParts.{{ $index }}.discount_type"
                                                                style="min-width: 60px !important; max-width: 60px !important;">
                                                                <option value="1">₹</option>
                                                                <option value="2">%</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td><input type="text" class="form-control bg-light"
                                                            wire:model="spareParts.{{ $index }}.final_amount"
                                                            id="spareParts.{{ $index }}.final_amount" readonly>
                                                    </td>
                                                    <td>
                                                        <button
                                                            class="btn btn-sm btn-danger rounded border-0 text-white"
                                                            wire:click="removeRow('spareParts', {{ $index }})"
                                                            id="{{ $index }}">
                                                            Remove
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <td>
                                                    <div class="d-flex" style="width: 425px;">

                                                        <select id="spare_parts_data"
                                                            wire:model.live="spare_parts_data"
                                                            class="form-control select2"
                                                            data-property="spare_parts_data">
                                                            <option value="">--Select Spare Part --
                                                            </option>
                                                            @foreach ($spare as $item)
                                                                @php
                                                                    $itemOfflinePrice = $item->selling_amount;
                                                                    if ($item->tax_type == 'exclude' && $item->tax_percentage) {
                                                                        $itemOfflinePrice += ($itemOfflinePrice * $item->tax_percentage) / 100;
                                                                    }
                                                                @endphp
                                                                <option value="{{ $item->id }}">
                                                                    {{ $item->name ?? 'No Name' }}
                                                                    <small>(Current Qty:
                                                                        {{ $item->stock ?? 0 }})</small>,
                                                                    <small class="text-danger">(Price:
                                                                        ₹{{ number_format($itemOfflinePrice, 2) }})</small>
                                                                </option>
                                                            @endforeach
                                                        </select>


                                                    </div>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-6 mt-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h6 class="text-center m-0">
                            <b>Note to display on Invoice</b>
                        </h6>
                        <hr>
                        <textarea wire:model="note" class="form-control" placeholder=""></textarea>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-2">
                                <a href="{{ route('getCountersalesinvoPdf', [$counterSaleId, 1]) }}" target="_blank"
                                    class="btn btn-outline-secondary mx-1">
                                    <i class="fa fa-print"></i></a>
                            </div>
                            <div class="col-2">
                                <a href="{{ route('getCountersalesinvoPdf', [$counterSaleId, 0]) }}"
                                    class="btn btn-outline-secondary mx-1">
                                    <i class="fa fa-file-pdf"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 mt-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h6 class="m-0"><b>Billing Details</b></h6>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="final-amount" class="form-label">Total Payable</label>
                                    <input type="text" id="subtotal" wire:model="totalAmount"
                                        class="form-control bg-secondary text-white rounded" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="final-amount" class="form-label">Subtotal</label>
                                    <input type="text" id="final-amount" wire:model="final_amount"
                                        class="form-control bg-secondary text-white rounded" readonly>
                                    @error('final_amount')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Payment Type Selection -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Payment Type</label>
                                    <select wire:model.live="payment_type" class="form-control">
                                        <option value="">--Choose Payment Type--</option>
                                        <option value="total">Total</option>
                                        <option value="partial">Partial</option>
                                    </select>
                                </div>
                                @error('payment_type')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            @if ($payment_type === 'partial')
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Partial Amount</label>
                                        <input type="number" wire:model.live="partial_amount" class="form-control"
                                            min="0">
                                    </div>
                                </div>
                            @elseif ($payment_type === 'total')
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Total Amount</label>
                                        <input type="number" wire:model.live="total_amount" readonly
                                            class="form-control" min="0">
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Paid and Balance -->
                        <div class="row">
                            {{-- <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Paid</label>
                                    <input type="number" wire:model.live="total_paid_amount" class="form-control"
                                        readonly min="0" step="1">
                                </div>
                            </div> --}}
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Remaining Balance</label>
                                    <input type="text" wire:model.live="balance_amount"
                                        class="form-control bg-secondary text-white rounded" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>
    <div class="footer align-items-center">
        <div class="row">
            <!-- Create Job-Card Button Section -->
            <div class="col-auto ms-auto">
                <button wire:click="updateCustomerCounter" class="btn btn-primary rounded border-0 text-white">Update
                    Counter
                    Sale</button>
            </div>
        </div>
    </div>



</div>


@section('footerscript')
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        document.addEventListener('livewire:init', () => {

            $('#spare_parts_data').select2({
                placeholder: "Select Spare Part"
            }).on('change', function() {
                let selectedValue = $(this).val();
                @this.set('spare_parts_data', selectedValue);
            });

            Livewire.hook('morphed', (message, component) => {
                $('#spare_parts_data').select2({
                    placeholder: "Select Spare part"
                });
            });

        });





        document.addEventListener('livewire:init', () => {

            $('#customer_name').select2({
                placeholder: "Select Customer or Vehicle",
                ajax: {
                    url: '/workshop/countercustomers',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term,
                            page: params.page || 1,
                        };
                    },
                    processResults: function(data, params) {
                        console.log(data); // Log the response to inspect data structure
                        params.page = params.page || 1;


                        const results = Array.isArray(data.data) ? data.data.map(item => ({
                            id: item.id,
                            text: `${item.name || ''} ${item.lastname || ''}/${item.mobile_no || ''}/${item.number_plate || ''}`,
                        })) : [];

                        return {
                            results: results,
                            pagination: {
                                more: data.next_page_url != null
                            }
                        };
                    },
                    cache: true,
                }
            }).on('change', function() {
                let selectedValue = $(this).val(); // Get the selected value
                console.log('Selected Value:', selectedValue); // Debug log
                @this.set('customer_name', selectedValue);
            });










            Livewire.hook('morphed', (message, component) => {
                $('#customer_name').select2({
                    placeholder: "Select Customer or Vehicle",
                    ajax: {
                        url: '/workshop/countercustomers',
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                search: params.term,
                                page: params.page || 1,
                            };
                        },
                        processResults: function(data, params) {
                            console.log(data); // Log the response to inspect data structure
                            params.page = params.page || 1;

                            // Ensure data.data is an array before calling map()
                            const results = Array.isArray(data.data) ? data.data.map(item => ({
                                id: item.id,
                                text: `${item.name || ''} ${item.lastname || ''}/${item.mobile_no || ''}/${item.number_plate || ''}`,
                            })) : [];

                            return {
                                results: results,
                                pagination: {
                                    more: data.next_page_url != null
                                }
                            };
                        },
                        cache: true,
                    }
                });

            });
        });
    </script>
@endsection
