@php
    $headerBg = 'linear-gradient(135deg, #4b5563, #6b7280)'; // default for Total (mode 6)
    if ($mode === 0) {
        $headerBg = 'linear-gradient(135deg, #e63946, #ff6b6b)'; // Open (Red)
    } elseif ($mode == 5) {
        $headerBg = 'linear-gradient(135deg, #e63946, #ff6b6b)'; // Deleted (Red)
    } elseif ($mode == 4) {
        $headerBg = 'linear-gradient(135deg, #f39c12, #f1c40f)'; // Process (Yellow)
    } elseif ($mode == 1) {
        $headerBg = 'linear-gradient(135deg, #007bff, #409eff)'; // Confirmed (Blue)
    } elseif ($mode == 2) {
        $headerBg = 'linear-gradient(135deg, #28a745, #72d572)'; // Completed (Green)
    } elseif ($mode == 3) {
        $headerBg = 'linear-gradient(135deg, #17a2b8, #67d1f3)'; // Closed (Cyan)
    }
@endphp
<div>
    <style>
        .mode {
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            font-size: 14px;
        }

        .mode:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .jobcardtable td {
            cursor: pointer;
        }

        .jobcardtable td a:hover {
            color: #EA6B00;
        }

        .jobcardtable td a {
            color: inherit;
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

        .bg-warning {
            background: linear-gradient(135deg, #f39c12, #f1c40f);
        }

        .bg-success {
            background: linear-gradient(135deg, #28a745, #72d572);
        }

        /* Premium Table Header styling */
        .jobcardtable thead th {
            background-color: transparent !important;
            color: #ffffff !important;
            font-weight: 700 !important;
            font-size: 13px !important;
            border-bottom: 2px solid rgba(0,0,0,0.1) !important;
            padding: 12px 8px !important;
            vertical-align: middle;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.15);
        }

        /* Status row styling */
        .jobcardtable tbody tr {
            transition: all 0.2s ease;
        }

        .jobcardtable tbody tr:hover {
            filter: brightness(0.95);
        }

        /* Open & Deleted (Red) */
        .jobcard-row-status-0, .jobcard-row-status-5 {
            background-color: #fce8e6 !important; /* Soft red */
            border-left: 5px solid #e63946 !important;
        }
        .jobcard-row-status-0 td, .jobcard-row-status-5 td {
            color: #a8201a !important;
            font-weight: 500;
        }
        .jobcard-row-status-0 td a, .jobcard-row-status-5 td a {
            color: #a8201a !important;
            font-weight: 600;
        }

        /* Process (Yellow/Orange) */
        .jobcard-row-status-4 {
            background-color: #fef5e7 !important; /* Soft yellow/orange */
            border-left: 5px solid #f39c12 !important;
        }
        .jobcard-row-status-4 td {
            color: #b25e00 !important;
            font-weight: 500;
        }
        .jobcard-row-status-4 td a {
            color: #b25e00 !important;
            font-weight: 600;
        }

        /* Confirmed (Blue) */
        .jobcard-row-status-1 {
            background-color: #e8f4fd !important; /* Soft blue */
            border-left: 5px solid #007bff !important;
        }
        .jobcard-row-status-1 td {
            color: #0056b3 !important;
            font-weight: 500;
        }
        .jobcard-row-status-1 td a {
            color: #0056b3 !important;
            font-weight: 600;
        }

        /* Completed (Green) */
        .jobcard-row-status-2 {
            background-color: #eafaf1 !important; /* Soft green */
            border-left: 5px solid #28a745 !important;
        }
        .jobcard-row-status-2 td {
            color: #1e7e34 !important;
            font-weight: 500;
        }
        .jobcard-row-status-2 td a {
            color: #1e7e34 !important;
            font-weight: 600;
        }

        /* Closed (Teal/Cyan) */
        .jobcard-row-status-3 {
            background-color: #e6f7ff !important; /* Soft cyan/teal */
            border-left: 5px solid #17a2b8 !important;
        }
        .jobcard-row-status-3 td {
            color: #0f758a !important;
            font-weight: 500;
        }
        .jobcard-row-status-3 td a {
            color: #0f758a !important;
            font-weight: 600;
        }

        /* Hover effect for clickable links */
        .jobcardtable tbody tr td a:hover {
            color: #EA6B00 !important;
            text-decoration: underline !important;
        }
    </style>
    @if ($isAdd == true)
        @livewire('Workshop.JobCardAddController')
    @elseif($isEdit == true)
        @livewire('Workshop.JobCardEditController', ['id' => $jobId])
    @else
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="breadcrumb-title pe-2" style="border: none;">Job-Card</div>
                    <div class="row">
                        <div class="pe-3">
                            @if ($user->hasPermissionTo('Jobcard-add'))
                                <a href="{{ route('workshop.jobcardadd') }}"
                                    class="btn btn-primary radius-30 mt-2 mt-lg-0">
                                    <i class="bx bxs-plus-square"></i>Add
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row g-3 py-3">
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="" wire:click="$set('mode', 0)">
                            <div class="card-body  mode bg-danger text-white d-flex justify-content-between">
                                <span><b><i class="fa-solid fa-unlock"></i> Open</b></span>
                                <span><b>( {{ count($jobcardsCount->where('soft_delete', 0)->where('status', 0)) }}
                                        )</b></span>
                            </div>
                        </div>
                    </div>

                      <div class="col-lg-3 col-md-6 col-12">
                        <div class="" wire:click="$set('mode', 4)">
                            <div class="card-body mode bg-warning text-white d-flex justify-content-between">
                                <span><b><i class="fa-solid fa-cogs"></i> Process</b></span>
                                <span><b>( {{ count($jobcardsCount->where('soft_delete', 0)->where('status', 4)) }}
                                        )</b></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="" wire:click="$set('mode', 1)">
                            <div class="card-body mode bg-primary text-white d-flex justify-content-between">
                                <span><b><i class="fa-solid fa-circle-check"></i> Confirmed</b></span>
                                <span><b>( {{ count($jobcardsCount->where('soft_delete', 0)->where('status', 1)) }}
                                        )</b></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="" wire:click="$set('mode', 2)">
                            <div class="card-body mode bg-success text-white d-flex justify-content-between">
                                <span><b><i class="fa-solid fa-flag-checkered"></i> Completed</b></span>
                                <span><b>( {{ count($jobcardsCount->where('soft_delete', 0)->where('status', 2)) }}
                                        )</b></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="" wire:click="$set('mode', 3)">
                            <div class="card-body mode bg-info text-white d-flex justify-content-between" style>
                                <span><b><i class="fa-solid fa-close"></i> Closed</b></span>
                                <span><b>( {{ count($jobcardsCount->where('soft_delete', 0)->where('status', 3)) }}
                                        )</b></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="" wire:click="$set('mode', 5)">
                            <div class="card-body mode bg-danger text-white d-flex justify-content-between" style>
                                <span><b><i class="fa-solid fa-trash"></i> Deleted</b></span>
                                <span><b>( {{ count($jobcardsCount->where('soft_delete', 1)) }} )</b></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="" wire:click="$set('mode', 6)">
                            <div class="card-body mode bg-secondary text-white d-flex justify-content-between">
                                <span><b><i class="fa-solid fa-flag-checkered"></i> Total</b></span>
                                <span><b>( {{ count($jobcardsCount) }} )</b></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-3">
                        <input type="text" class="form-control" placeholder="Search Customer"
                            wire:model.live="searchjobcart" fdprocessedid="blgf5">
                    </div>
                    <div class="col-9 text-right">
                        <button type="button" class="mr-2 btn btn-info text-white rounded-0  float-end"
                            wire:click="resetFilter" fdprocessedid="orntg">Clear</button>
                    </div>
                </div>
                @if (!empty($items) && $items->count())
                    <div class="table-responsive mt-4">
                        <table class="table table-bordered data-table jobcardtable">
                            <thead style="background: {{ $headerBg }};">
                                <tr>
                                    <th>S.No.</th>
                                    <th>Entry Date</th>
                                    <th>Job-Card Number</th>
                                    @if ($items->contains('status', 2) || $items->contains('status', 3))
                                        <th>Invoice No.</th>
                                    @endif
                                    <!-- <th>Shared Serial</th> -->
                                    <th>Customer Name</th>
                                    <th>Vehicle Number</th>
                                    <th>Vehicle</th>
                                    <th>Bill Amount</th>
                                    <th>Advance</th>
                                    <th>Discount</th>
                                    <th>Paid</th>
                                    <th>Balance</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                         <tbody>
                                @foreach ($items as $index => $jobcard)
                                    <tr class="jobcard-row-status-{{ $jobcard->soft_delete == 1 ? 5 : $jobcard->status }}">
                                        <td>{{ $items->total() - ($items->firstItem() + $index) + 1 }}</td>
                                        <td>
                                            <a @if ($jobcard->soft_delete == 0) @if ($jobcard->soft_delete == 0)href="{{ route('workshop.jobcardedit', $jobcard->id) }}" @endif
                                                @endif>
                                                @if ($jobcard->entry_date)
                                                    {{ \Carbon\Carbon::parse($jobcard->entry_date)->format('d-m-Y') }}
                                                    <br>
                                                    {{ \Carbon\Carbon::parse($jobcard->entry_date)->format('h:i A') }}
                                                @else
                                                    -
                                                @endif
                                            </a>
                                        </td>
                                        <td>
                                            <a
                                                @if ($jobcard->soft_delete == 0) href="{{ route('workshop.jobcardedit', $jobcard->id) }}" @endif
                                                class="{{ $jobcard->status == 0 ? 'text-danger fw-bold' : '' }}">
                                                {{ $jobcard->jobcard_number ?? '-' }}
                                                @if($jobcard->status == 0)
                                                    <i class="bx bxs-circle font-10 ms-1"></i>
                                                @endif
                                            </a>
                                        </td>
                                        @if ($items->contains('status', 2) || $items->contains('status', 3))
                                            <td>
                                                @if ($jobcard->status == 2 || $jobcard->status == 3 )
                                                    <a
                                                       @if ($jobcard->soft_delete == 0) href="{{ route('workshop.jobcardedit', $jobcard->id) }}" @endif>
                                                       {{ $jobcard->shared_serial ?? '-' }}
                                                   </a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        @endif
                                        <td>
                                            <a
                                                @if ($jobcard->soft_delete == 0) href="{{ route('workshop.jobcardedit', $jobcard->id) }}" @endif>
                                                @if ($jobcard->cust_type == 1)
                                                    {{ 'M/S ' . $jobcard->company_name ?? ($jobcard->customer_name ?? '-') }}
                                                @else
                                                    {{ $jobcard->customer_name ?? '-' }}
                                                @endif
                                            </a>
                                        </td>
                                        <td>
                                            <a
                                                @if ($jobcard->soft_delete == 0) href="{{ route('workshop.jobcardedit', $jobcard->id) }}" @endif>
                                                {{ $jobcard->vehical_number ?? '-' }}
                                            </a>
                                        </td>
                                        <td  style="min-width:300px;max-width: 350px;text-wrap:wrap;">
                                            <a
                                                @if ($jobcard->soft_delete == 0) href="{{ route('workshop.jobcardedit', $jobcard->id) }}" @endif>
                                                {{ $jobcard->vehical ?? '-' }}
                                            </a>
                                        </td>
                                        <td>
                                            <a
                                                @if ($jobcard->soft_delete == 0) href="{{ route('workshop.jobcardedit', $jobcard->id) }}" @endif>
                                                {{ $jobcard->final_amount ?? '-' }}
                                            </a>
                                        </td>
                                        <td>
                                            {{ $jobcard->advance ?? '-' }}
                                        </td>
                                        <td>
                                            {{ $jobcard->final_discount ?? '-' }}
                                        </td>
                                        <td>
                                            {{ $jobcard->final_paid ?? '-' }}
                                        </td>
                                        <td>
                                            {{ $jobcard->balance_amount ?? '-' }}
                                        </td>
                                        <td>
                                            @if ($jobcard->soft_delete == 0)
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

                                                    @case(4)
                                                        <span class="badge bg-warning">Process</span>
                                                    @break

                                                    @default
                                                        <span class="badge bg-danger">Open</span>
                                                @endswitch
                                            @else
                                                <span class="badge bg-danger">Deleted</span>
                                            @endif
                                        </td>
                                        <td>

                                            @if ($jobcard->soft_delete == 0)
                                                @if ($user->hasPermissionTo('Jobcard-edit'))
                                                    <a href="{{ route('workshop.jobcardedit', $jobcard->id) }}"
                                                        class="btn btn-sm p-0">
                                                        <i class="bx bxs-edit"></i>
                                                    </a>
                                                @endif
                                                @if ($user->hasPermissionTo('Jobcard-delete'))
                                                    @if ($jobcard->status != 3)
                                                        <a wire:click="confirmDelete({{ $jobcard->id }})"
                                                            class="btn btn-sm p-0">
                                                            <i class="fadeIn animated bx bx-trash"></i>
                                                        </a>
                                                    @endif
                                                @endif
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>



                        </table>
                        <div class="pagination-wrapper">
                            {{ $items->links() }}
                        </div>
                    </div>
                @else
                    <div class="my-2">
                        <div class="alert alert-info">No Job-Card Found!</div>
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>
@section('footerscript')
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        document.addEventListener('livewire:init', function() {



            Livewire.hook('morphed', (message, component) => {
                $('.select2').select2().on('change', function(e) {
                    const selectedValues = $(this).val();
                    @this.set(e.target.dataset.property, selectedValues);
                });
            });


        });
        document.addEventListener('show-dent-modal', () => {

            const modal = document.querySelector('.modal');
            const backgroundCanvas = document.getElementById('backgroundCanvas');
            const overlayCanvas = document.getElementById('overlayCanvas');
            const bgCtx = backgroundCanvas.getContext('2d');
            const overlayCtx = overlayCanvas.getContext('2d');
            const carImageTag = document.getElementById('carImageTag');
            const carImage = new Image();


            // Set the source dynamically using Laravel's `asset()` helper function
            carImage.src = "{{ asset('assets/dentcar/car.png') }}"; // This will insert the correct URL

            // When modal is triggered
            const showModalButton = document.getElementById(
                'showModalButton'); // Assuming you have a button to show the modal
            if (showModalButton) {
                showModalButton.addEventListener('click', () => {
                    modal.classList.add('show');
                    modal.style.display = 'block'; // Make sure modal is visible
                    carImageTag.style.display = 'block'; // Ensure the image is also visible
                });
            }

            // Image load event to ensure image is drawn when fully loaded
            carImage.onload = () => {
                const scaleFactor = 0.7; // Resize image to 70%
                const newWidth = carImage.width * scaleFactor;
                const newHeight = carImage.height * scaleFactor;

                // Set canvas dimensions
                backgroundCanvas.width = newWidth;
                backgroundCanvas.height = newHeight;
                overlayCanvas.width = newWidth;
                overlayCanvas.height = newHeight;

                // Draw the image on the background canvas
                bgCtx.drawImage(carImage, 0, 0, newWidth, newHeight);
            };

            // Drawing Logic
            let drawing = false;
            let mode = 'dent'; // Default mode

            const penSettings = {
                dent: {
                    color: 'yellow',
                    size: 5
                },
                scratch: {
                    color: 'green',
                    size: 5
                },
                break: {
                    color: 'red',
                    size: 5
                },
                erase: {
                    size: 15
                } // Eraser size
            };

            // Mode Switching
            const buttons = document.querySelectorAll('.controls button');
            buttons.forEach(button => {
                button.addEventListener('click', () => {
                    buttons.forEach(btn => btn.classList.remove('active'));
                    button.classList.add('active');
                    mode = button.id.replace('Btn', '');
                });
            });

            // Overlay Canvas Event Listeners
            overlayCanvas.addEventListener('mousedown', () => {
                drawing = true;
                overlayCtx.beginPath();
            });
            overlayCanvas.addEventListener('mouseup', () => {
                drawing = false;
                overlayCtx.beginPath();
            });
            overlayCanvas.addEventListener('mousemove', draw);

            function draw(event) {
                if (!drawing) return;

                const rect = overlayCanvas.getBoundingClientRect();
                const x = event.clientX - rect.left;
                const y = event.clientY - rect.top;

                overlayCtx.lineCap = 'round';

                if (mode === 'erase') {
                    overlayCtx.globalCompositeOperation = 'destination-out';
                    overlayCtx.lineWidth = penSettings.erase.size;
                } else {
                    overlayCtx.globalCompositeOperation = 'source-over';
                    overlayCtx.strokeStyle = penSettings[mode].color;
                    overlayCtx.lineWidth = penSettings[mode].size;
                }

                overlayCtx.lineTo(x, y);
                overlayCtx.stroke();
                overlayCtx.beginPath();
                overlayCtx.moveTo(x, y);
            }

            // Clear Overlay Canvas
            document.getElementById('clearBtn').addEventListener('click', () => {
                overlayCtx.clearRect(0, 0, overlayCanvas.width, overlayCanvas.height);
            });
            let beta = 0;

            // Save Merged Image and Send to Laravel
            document.getElementById('saveBtn').addEventListener('click', () => {
                if (beta = 0) {
                    beta = 1;
                    if (!confirm("Are you sure you want to save the changes?")) return;
                }
                //    ekk variable banano bata name rahe 1 ho jaye agar


                const mergedCanvas = document.createElement('canvas');
                const mergedCtx = mergedCanvas.getContext('2d');

                mergedCanvas.width = backgroundCanvas.width;
                mergedCanvas.height = backgroundCanvas.height;

                mergedCtx.drawImage(backgroundCanvas, 0, 0);
                mergedCtx.drawImage(overlayCanvas, 0, 0);

                const mergedImageData = mergedCanvas.toDataURL('image/png');

                // Send the image data to Livewire
                Livewire.dispatch('saveImage', {
                    mergedImageData: mergedImageData
                });

            });
        });

        function validateMaxQuantity(input) {
            // Get the max quantity value
            var maxQuantity = parseInt(input.getAttribute('max'));

            // If the current value exceeds max quantity, reset it to max
            if (parseInt(input.value) > maxQuantity) {
                input.value = maxQuantity;
            }
        }


        document.addEventListener('razorpay-show', (event) => {
            // Access event data using event.detail

            amount = event.__livewire.params[0].amount;
            orderId = event.__livewire.params[0].orderId;

            var options = {
                "key": "{{ env('RAZORPAY_KEY') }}",
                "amount": amount * 100, // Convert to paise
                "currency": "INR",
                "order_id": orderId,
                "name": "Test Payment",
                "description": "Payment for product/service",
                "image": "https://example.com/your-logo.png",
                "handler": function(response) {
                    console.log(response)
                    // Example data to send
                    const paymentResponse = {
                        razorpay_payment_id: response.razorpay_payment_id,
                        razorpay_order_id: response.razorpay_order_id,
                        amount: amount,
                    };
                    Livewire.dispatch('storePayment', {
                        paymentResponse: paymentResponse
                    });

                },
                "prefill": {
                    "name": @json(Auth::guard('workshop')->user()->name),
                    "email": @json(Auth::guard('workshop')->user()->email),
                    "contact": @json(Auth::guard('workshop')->user()->mobile_no)
                },
                "theme": {
                    "color": "#009dec"
                }
            };

            var rzp1 = new Razorpay(options);
            rzp1.open();
            event.preventDefault();
        });
    </script>
@endsection
