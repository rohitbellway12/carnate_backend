<div>
    <style>
        /* =========================================================
           CARNATE COUNTER SALE LIST
           UI REDESIGN ONLY — FUNCTIONALITY PRESERVED
        ========================================================= */

        .carnate-counter-sale {
            --cs-bg: #f7f8fa;
            --cs-white: #ffffff;
            --cs-text: #111827;
            --cs-muted: #64748b;
            --cs-light: #94a3b8;
            --cs-border: #e2e8f0;

            --cs-red: #e53935;
            --cs-red-soft: #fff5f5;

            --cs-green: #16a34a;
            --cs-green-soft: #f0fdf4;

            --cs-blue: #2563eb;
            --cs-blue-soft: #eff6ff;

            --cs-gray-soft: #f1f5f9;

            width: 100%;
            color: var(--cs-text);
        }

        .carnate-counter-sale *,
        .carnate-counter-sale *::before,
        .carnate-counter-sale *::after {
            box-sizing: border-box;
        }

        /* =========================================================
           PAGE HEADER
        ========================================================= */

        .carnate-counter-sale .cs-page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;

            padding: 22px 24px;
            margin-bottom: 18px;

            background: var(--cs-white);
            border: 1px solid var(--cs-border);
            border-radius: 16px;

            box-shadow: 0 4px 16px rgba(15, 23, 42, .035);
        }

        .carnate-counter-sale .cs-title-wrap {
            min-width: 0;
        }

        .carnate-counter-sale .cs-breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;

            margin-bottom: 5px;

            color: var(--cs-muted);
            font-size: 12px;
            font-weight: 500;
        }

        .carnate-counter-sale .cs-breadcrumb i {
            color: var(--cs-light);
            font-size: 14px;
        }

        .carnate-counter-sale .cs-title {
            margin: 0;

            color: var(--cs-text);
            font-size: 22px;
            font-weight: 700;
            letter-spacing: -.3px;
        }

        .carnate-counter-sale .cs-subtitle {
            margin: 5px 0 0;

            color: var(--cs-muted);
            font-size: 13px;
        }

        .carnate-counter-sale .cs-add-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;

            min-height: 42px;
            padding: 0 17px;

            border: 1px solid var(--cs-red);
            border-radius: 10px;

            background: var(--cs-red);
            color: #fff !important;

            font-size: 13px;
            font-weight: 650;
            text-decoration: none;

            box-shadow: 0 5px 14px rgba(229, 57, 53, .16);

            transition: all .2s ease;
        }

        .carnate-counter-sale .cs-add-btn:hover {
            background: #d93431;
            border-color: #d93431;
            color: #fff !important;
            transform: translateY(-1px);
            box-shadow: 0 8px 18px rgba(229, 57, 53, .22);
        }

        .carnate-counter-sale .cs-add-btn i {
            font-size: 17px;
        }


        /* =========================================================
           FILTER CARD
        ========================================================= */

        .carnate-counter-sale .cs-filter-card {
            margin-bottom: 18px;

            padding: 18px 20px;

            background: var(--cs-white);
            border: 1px solid var(--cs-border);
            border-radius: 16px;

            box-shadow: 0 4px 16px rgba(15, 23, 42, .035);
        }

        .carnate-counter-sale .cs-filter-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
        }

        .carnate-counter-sale .cs-search-wrap {
            position: relative;
            width: 340px;
            max-width: 100%;
        }

        .carnate-counter-sale .cs-search-icon {
            position: absolute;
            left: 13px;
            top: 50%;

            transform: translateY(-50%);

            color: var(--cs-light);
            font-size: 17px;

            pointer-events: none;
        }

        .carnate-counter-sale .cs-search {
            width: 100%;
            height: 42px;

            padding: 0 14px 0 39px;

            border: 1px solid var(--cs-border);
            border-radius: 10px;

            background: #fff;
            color: var(--cs-text);

            font-size: 13px;

            outline: none;

            transition: all .2s ease;
        }

        .carnate-counter-sale .cs-search::placeholder {
            color: #94a3b8;
        }

        .carnate-counter-sale .cs-search:focus {
            border-color: rgba(229, 57, 53, .55);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        .carnate-counter-sale .cs-clear-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;

            height: 42px;
            padding: 0 16px;

            border: 1px solid var(--cs-border);
            border-radius: 10px;

            background: var(--cs-gray-soft);
            color: #475569;

            font-size: 13px;
            font-weight: 600;

            transition: all .2s ease;
        }

        .carnate-counter-sale .cs-clear-btn:hover {
            border-color: #cbd5e1;
            background: #e8edf3;
            color: var(--cs-text);
        }

        .carnate-counter-sale .cs-clear-btn i {
            font-size: 16px;
        }


        /* =========================================================
           TABLE CARD
        ========================================================= */

        .carnate-counter-sale .cs-table-card {
            overflow: hidden;

            background: var(--cs-white);
            border: 1px solid var(--cs-border);
            border-radius: 16px;

            box-shadow: 0 4px 16px rgba(15, 23, 42, .035);
        }

        .carnate-counter-sale .cs-table-header {
            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 17px 20px;

            border-bottom: 1px solid var(--cs-border);
        }

        .carnate-counter-sale .cs-table-title {
            margin: 0;

            color: var(--cs-text);
            font-size: 16px;
            font-weight: 700;
        }

        .carnate-counter-sale .cs-table-count {
            display: inline-flex;
            align-items: center;

            padding: 5px 9px;

            border-radius: 7px;

            background: var(--cs-gray-soft);
            color: var(--cs-muted);

            font-size: 11px;
            font-weight: 650;
        }

        .carnate-counter-sale .cs-table-body {
            padding: 0;
        }

        .carnate-counter-sale .cs-table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        .carnate-counter-sale .countersaletable {
            width: 100%;
            min-width: 950px;

            margin: 0;

            border-collapse: separate;
            border-spacing: 0;
        }

        .carnate-counter-sale .countersaletable thead th {
            padding: 13px 15px;

            border: 0;
            border-bottom: 1px solid var(--cs-border);

            background: #f8fafc;
            color: #64748b;

            font-size: 11px;
            font-weight: 700;

            text-transform: uppercase;
            letter-spacing: .35px;

            white-space: nowrap;
        }

        .carnate-counter-sale .countersaletable tbody td {
            padding: 15px;

            border: 0;
            border-bottom: 1px solid #f1f5f9;

            background: #fff;
            color: #475569;

            font-size: 13px;
            vertical-align: middle;

            white-space: nowrap;
        }

        .carnate-counter-sale .countersaletable tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-counter-sale .countersaletable tbody tr {
            transition: background .15s ease;
        }

        .carnate-counter-sale .countersaletable tbody tr:hover td {
            background: #fafafa;
        }

        .carnate-counter-sale .countersaletable td a {
            color: var(--cs-text);
            font-weight: 500;
            text-decoration: none;
            transition: color .15s ease;
        }

        .carnate-counter-sale .countersaletable td a:hover {
            color: var(--cs-red);
        }

        .carnate-counter-sale .cs-serial {
            color: var(--cs-light);
            font-size: 12px;
            font-weight: 600;
        }

        .carnate-counter-sale .cs-number {
            color: var(--cs-text) !important;
            font-weight: 700 !important;
        }

        .carnate-counter-sale .cs-customer {
            color: #334155 !important;
            font-weight: 600 !important;
        }

        .carnate-counter-sale .cs-amount {
            color: var(--cs-text);
            font-weight: 650;
        }

        .carnate-counter-sale .cs-balance {
            color: var(--cs-red);
            font-weight: 700;
        }

        .carnate-counter-sale .cs-paid {
            color: var(--cs-green);
            font-weight: 650;
        }


        /* =========================================================
           STATUS BADGES
        ========================================================= */

        .carnate-counter-sale .cs-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;

            padding: 6px 9px;

            border-radius: 7px;

            font-size: 11px;
            font-weight: 650;
            line-height: 1;
        }

        .carnate-counter-sale .cs-status-partial {
            background: var(--cs-blue-soft);
            color: var(--cs-blue);
        }

        .carnate-counter-sale .cs-status-paid {
            background: var(--cs-green-soft);
            color: var(--cs-green);
        }

        .carnate-counter-sale .cs-status-dot {
            width: 6px;
            height: 6px;

            border-radius: 50%;

            background: currentColor;
        }


        /* =========================================================
           ACTION BUTTONS
        ========================================================= */

        .carnate-counter-sale .cs-actions {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .carnate-counter-sale .cs-action-btn {
            width: 32px;
            height: 32px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            padding: 0;

            border: 1px solid var(--cs-border);
            border-radius: 8px;

            background: #fff;
            color: #64748b;

            text-decoration: none;

            cursor: pointer;

            transition: all .2s ease;
        }

        .carnate-counter-sale .cs-action-btn:hover {
            border-color: rgba(229, 57, 53, .25);
            background: var(--cs-red-soft);
            color: var(--cs-red);
        }

        .carnate-counter-sale .cs-action-btn.delete:hover {
            border-color: rgba(229, 57, 53, .3);
            background: var(--cs-red-soft);
            color: var(--cs-red);
        }

        .carnate-counter-sale .cs-action-btn i {
            font-size: 16px;
        }


        /* =========================================================
           PAGINATION
        ========================================================= */

        .carnate-counter-sale .pagination-wrapper {
            padding: 16px 20px;

            border-top: 1px solid var(--cs-border);

            background: #fff;
        }

        .carnate-counter-sale .pagination-wrapper .pagination {
            margin: 0;
            justify-content: flex-end;
        }


        /* =========================================================
           EMPTY STATE
        ========================================================= */

        .carnate-counter-sale .cs-empty {
            padding: 55px 20px;
            text-align: center;
        }

        .carnate-counter-sale .cs-empty-icon {
            width: 58px;
            height: 58px;

            display: flex;
            align-items: center;
            justify-content: center;

            margin: 0 auto 14px;

            border-radius: 16px;

            background: var(--cs-gray-soft);
            color: #64748b;

            font-size: 25px;
        }

        .carnate-counter-sale .cs-empty-title {
            margin: 0 0 5px;

            color: var(--cs-text);
            font-size: 15px;
            font-weight: 700;
        }

        .carnate-counter-sale .cs-empty-text {
            margin: 0;

            color: var(--cs-muted);
            font-size: 13px;
        }


        /* =========================================================
           OLD .MODE SUPPORT
        ========================================================= */

        .carnate-counter-sale .mode {
            padding: 20px;

            border-radius: 12px;

            box-shadow: 0 4px 6px rgba(15, 23, 42, .06);

            transition: transform .3s ease, box-shadow .3s ease;

            cursor: pointer;
            font-size: 14px;
        }

        .carnate-counter-sale .mode:hover {
            transform: scale(1.02);
            box-shadow: 0 8px 18px rgba(15, 23, 42, .10);
        }


        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 767px) {

            .carnate-counter-sale .cs-page-header {
                flex-direction: column;
                align-items: flex-start;
                padding: 18px;
            }

            .carnate-counter-sale .cs-add-btn {
                width: 100%;
            }

            .carnate-counter-sale .cs-filter-row {
                flex-direction: column;
                align-items: stretch;
            }

            .carnate-counter-sale .cs-search-wrap {
                width: 100%;
            }

            .carnate-counter-sale .cs-clear-btn {
                width: 100%;
            }

            .carnate-counter-sale .cs-table-header {
                padding: 15px;
            }
        }
    </style>


    @php
        //  $sparePart = App\Models\WorkShopVendor::where('id', $workshop)->first();
    @endphp


    @if ($isAdd == true)

        @livewire('Sparepart.ConterSaleAddController')

    @else

        <div class="carnate-counter-sale">

            {{-- =====================================================
                 PAGE HEADER
            ====================================================== --}}

            <div class="cs-page-header">

                <div class="cs-title-wrap">

                    <div class="cs-breadcrumb">
                        <i class="bx bx-home-alt"></i>
                        <span>Workshop</span>
                        <i class="bx bx-chevron-right"></i>
                        <span>Sales</span>
                    </div>

                    <h4 class="cs-title">
                        Counter Sale
                    </h4>

                    <p class="cs-subtitle">
                        Manage counter sales, payments and outstanding balances.
                    </p>

                </div>


                @php
                    $user = auth('workshop')->user();
                @endphp


                @if ($user && $user->can('counter-sale-show'))

                    <a
                        href="{{ route('workshop.addcountersale') }}"
                        class="cs-add-btn"
                    >
                        <i class="bx bx-plus"></i>
                        <span>Add Counter Sale</span>
                    </a>

                @endif

            </div>


            {{-- =====================================================
                 FILTERS
            ====================================================== --}}

            <div class="cs-filter-card">

                <div class="cs-filter-row">

                    <div class="cs-search-wrap">

                        <i class="bx bx-search cs-search-icon"></i>

                        <input
                            type="text"
                            class="cs-search"
                            placeholder="Search counter sale..."
                            wire:model.live="searchfilter"
                            fdprocessedid="blgf5"
                        >

                    </div>


                    <button
                        type="button"
                        class="cs-clear-btn"
                        wire:click="resetFilter"
                        fdprocessedid="orntg"
                    >
                        <i class="bx bx-refresh"></i>
                        <span>Clear</span>
                    </button>

                </div>

            </div>


            {{-- =====================================================
                 SALES TABLE
            ====================================================== --}}

            <div class="cs-table-card">

                @if (!empty($items) && $items->count())

                    <div class="cs-table-header">

                        <h6 class="cs-table-title">
                            Counter Sales
                        </h6>

                        <span class="cs-table-count">
                            {{ $items->total() }} Records
                        </span>

                    </div>


                    <div class="cs-table-body">

                        <div class="cs-table-responsive">

                            <table class="table countersaletable">

                                <thead>

                                    <tr>
                                        <th>S.No.</th>
                                        <th>Entry Date</th>
                                        <th>Counter Sale Number</th>
                                        <th>Customer Name</th>
                                        <th>Bill Amount</th>
                                        <th>Total Paid</th>
                                        <th>Balance</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>

                                </thead>


                                <tbody>

                                    @foreach ($items as $index => $countersale)

                                        <tr>

                                            {{-- SERIAL --}}

                                            <td>
                                                <span class="cs-serial">
                                                    {{ $items->total() - ($items->firstItem() + $index) + 1 }}
                                                </span>
                                            </td>


                                            {{-- ENTRY DATE --}}

                                            <td>

                                                <a
                                                    href="{{ route('workshop.editcountersalee', $countersale->id) }}"
                                                >
                                                    <i class="bx bx-calendar me-1"
                                                       style="color:#94a3b8;"></i>

                                                    {{ \Carbon\Carbon::parse($countersale->created_at)->format('d-m-Y h:i A') ?? '-' }}
                                                </a>

                                            </td>


                                            {{-- COUNTER SALE NUMBER --}}

                                            <td>

                                                <a
                                                    href="{{ route('workshop.editcountersalee', $countersale->id) }}"
                                                    class="cs-number"
                                                >
                                                    {{ $countersale->countersale_number ?? '-' }}
                                                </a>

                                            </td>


                                            {{-- CUSTOMER --}}

                                            <td>

                                                <a
                                                    href="{{ route('workshop.editcountersalee', $countersale->id) }}"
                                                    class="cs-customer"
                                                >
                                                    {{ $countersale->Customer->name ?? '-' }}
                                                </a>

                                            </td>


                                            {{-- BILL AMOUNT --}}

                                            <td>

                                                <a
                                                    href="{{ route('workshop.editcountersalee', $countersale->id) }}"
                                                    class="cs-amount"
                                                >
                                                    {{ $countersale->subtotal ?? '-' }}
                                                </a>

                                            </td>


                                            {{-- PAID --}}

                                            <td>

                                                <span class="cs-paid">
                                                    {{ $countersale->partial_amount ?? '-' }}
                                                </span>

                                            </td>


                                            {{-- BALANCE --}}

                                            <td>

                                                <span class="cs-balance">
                                                    {{ $countersale->balance_amount ?? '-' }}
                                                </span>

                                            </td>


                                            {{-- STATUS --}}

                                            <td>

                                                @switch($countersale->status)

                                                    @case(0)

                                                        <span class="cs-status cs-status-partial">
                                                            <span class="cs-status-dot"></span>
                                                            Partial Payment
                                                        </span>

                                                    @break


                                                    @case(1)

                                                        <span class="cs-status cs-status-paid">
                                                            <span class="cs-status-dot"></span>
                                                            Full Paid
                                                        </span>

                                                    @break

                                                @endswitch

                                            </td>


                                            {{-- ACTIONS --}}

                                            @if (@$user->hasPermissionTo('counter-sale-edit') || @$user->hasPermissionTo('counter-sale-delete'))

                                                <td>

                                                    <div class="cs-actions">

                                                        @if ($user && $user->can('counter-sale-edit'))

                                                            <a
                                                                href="{{ route('workshop.editcountersalee', $countersale->id) }}"
                                                                class="cs-action-btn"
                                                                title="Edit"
                                                            >
                                                                <i class="bx bx-edit-alt"></i>
                                                            </a>

                                                        @endif


                                                        @if ($user && $user->can('counter-sale-delete'))

                                                            <a
                                                                wire:click="confirmDelete({{ $countersale->id }})"
                                                                class="cs-action-btn delete"
                                                                title="Delete"
                                                            >
                                                                <i class="bx bx-trash"></i>
                                                            </a>

                                                        @endif

                                                    </div>

                                                </td>

                                            @endif

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>


                        <div class="pagination-wrapper">
                            {{ $items->links() }}
                        </div>

                    </div>

                @else

                    <div class="cs-empty">

                        <div class="cs-empty-icon">
                            <i class="bx bx-receipt"></i>
                        </div>

                        <h6 class="cs-empty-title">
                            No Counter Sale Found
                        </h6>

                        <p class="cs-empty-text">
                            There are no counter sales matching your current search.
                        </p>

                    </div>

                @endif

            </div>

        </div>

    @endif


    @section('footerscript')

        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

        <script>
            document.addEventListener('livewire:init', function() {

                Livewire.hook('morphed', (message, component) => {

                    $('.select2').select2().on('change', function(e) {

                        const selectedValues = $(this).val();

                        @this.set(
                            e.target.dataset.property,
                            selectedValues
                        );

                    });

                });

            });


            document.addEventListener('show-dent-modal', () => {

                const modal = document.querySelector('.modal');

                const backgroundCanvas =
                    document.getElementById('backgroundCanvas');

                const overlayCanvas =
                    document.getElementById('overlayCanvas');

                const bgCtx =
                    backgroundCanvas.getContext('2d');

                const overlayCtx =
                    overlayCanvas.getContext('2d');

                const carImageTag =
                    document.getElementById('carImageTag');

                const carImage = new Image();


                // Set the source dynamically using Laravel's asset() helper
                carImage.src = "{{ asset('assets/dentcar/car.png') }}";


                // When modal is triggered
                const showModalButton =
                    document.getElementById('showModalButton');

                if (showModalButton) {

                    showModalButton.addEventListener('click', () => {

                        modal.classList.add('show');

                        modal.style.display = 'block';

                        carImageTag.style.display = 'block';

                    });

                }


                // Image load event
                carImage.onload = () => {

                    const scaleFactor = 0.7;

                    const newWidth =
                        carImage.width * scaleFactor;

                    const newHeight =
                        carImage.height * scaleFactor;


                    backgroundCanvas.width = newWidth;
                    backgroundCanvas.height = newHeight;

                    overlayCanvas.width = newWidth;
                    overlayCanvas.height = newHeight;


                    bgCtx.drawImage(
                        carImage,
                        0,
                        0,
                        newWidth,
                        newHeight
                    );

                };


                // Drawing Logic
                let drawing = false;

                let mode = 'dent';


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
                    }

                };


                // Mode Switching
                const buttons =
                    document.querySelectorAll('.controls button');

                buttons.forEach(button => {

                    button.addEventListener('click', () => {

                        buttons.forEach(btn =>
                            btn.classList.remove('active')
                        );

                        button.classList.add('active');

                        mode =
                            button.id.replace('Btn', '');

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


                    const rect =
                        overlayCanvas.getBoundingClientRect();

                    const x =
                        event.clientX - rect.left;

                    const y =
                        event.clientY - rect.top;


                    overlayCtx.lineCap = 'round';


                    if (mode === 'erase') {

                        overlayCtx.globalCompositeOperation =
                            'destination-out';

                        overlayCtx.lineWidth =
                            penSettings.erase.size;

                    } else {

                        overlayCtx.globalCompositeOperation =
                            'source-over';

                        overlayCtx.strokeStyle =
                            penSettings[mode].color;

                        overlayCtx.lineWidth =
                            penSettings[mode].size;

                    }


                    overlayCtx.lineTo(x, y);

                    overlayCtx.stroke();

                    overlayCtx.beginPath();

                    overlayCtx.moveTo(x, y);

                }


                // Clear Overlay Canvas
                document
                    .getElementById('clearBtn')
                    .addEventListener('click', () => {

                        overlayCtx.clearRect(
                            0,
                            0,
                            overlayCanvas.width,
                            overlayCanvas.height
                        );

                    });


                let beta = 0;


                // Save Merged Image and Send to Laravel
                document
                    .getElementById('saveBtn')
                    .addEventListener('click', () => {

                        if (beta = 0) {

                            beta = 1;

                            if (!confirm(
                                "Are you sure you want to save the changes?"
                            )) return;

                        }


                        const mergedCanvas =
                            document.createElement('canvas');

                        const mergedCtx =
                            mergedCanvas.getContext('2d');


                        mergedCanvas.width =
                            backgroundCanvas.width;

                        mergedCanvas.height =
                            backgroundCanvas.height;


                        mergedCtx.drawImage(
                            backgroundCanvas,
                            0,
                            0
                        );

                        mergedCtx.drawImage(
                            overlayCanvas,
                            0,
                            0
                        );


                        const mergedImageData =
                            mergedCanvas.toDataURL('image/png');


                        // Send image data to Livewire
                        Livewire.dispatch('saveImage', {
                            mergedImageData: mergedImageData
                        });

                    });

            });


            function validateMaxQuantity(input) {

                // Get max quantity
                var maxQuantity =
                    parseInt(input.getAttribute('max'));


                // If current value exceeds max quantity
                if (parseInt(input.value) > maxQuantity) {

                    input.value = maxQuantity;

                }

            }
        </script>

    @endsection

</div>