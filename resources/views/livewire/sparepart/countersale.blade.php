<div class="carnate-counter-sale">

    <style>
        /* =========================================================
           CARNATE COUNTER SALE
        ========================================================= */

        .carnate-counter-sale {
            --carnate-red: #e53935;
            --carnate-red-dark: #d92f2b;
            --carnate-red-soft: #fff5f5;

            --carnate-text: #111827;
            --carnate-muted: #64748b;
            --carnate-light: #94a3b8;

            --carnate-border: #e2e8f0;
            --carnate-border-light: #edf1f5;

            --carnate-bg: #f7f8fa;
            --carnate-white: #ffffff;

            color: var(--carnate-text);
        }


        /* =========================================================
           LEGACY / EXISTING CLASS SUPPORT
        ========================================================= */

        .carnate-counter-sale .mode {
            padding: 20px;

            background: #ffffff;

            border: 1px solid var(--carnate-border);

            border-radius: 12px;

            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.05);

            transition:
                transform .2s ease,
                box-shadow .2s ease;

            cursor: pointer;

            font-size: 14px;
        }

        .carnate-counter-sale .mode:hover {
            transform: translateY(-2px);

            box-shadow:
                0 10px 24px rgba(15, 23, 42, 0.08);
        }


        /* =========================================================
           TABLE LINKS
        ========================================================= */

        .carnate-counter-sale .countersaletable td {
            cursor: default;
        }

        .carnate-counter-sale .countersaletable td a {
            color: var(--carnate-text);

            text-decoration: none;

            transition: color .2s ease;
        }

        .carnate-counter-sale .countersaletable td a:hover {
            color: var(--carnate-red);
        }


        /* =========================================================
           MAIN CARD
        ========================================================= */

        .carnate-counter-sale .carnate-card {
            background: var(--carnate-white);

            border: 1px solid var(--carnate-border);

            border-radius: 14px;

            box-shadow:
                0 4px 16px rgba(15, 23, 42, 0.04);

            overflow: hidden;
        }


        /* =========================================================
           PAGE HEADER
        ========================================================= */

        .carnate-counter-sale .page-header {
            min-height: 76px;

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 20px;

            padding: 18px 22px;

            border-bottom: 1px solid var(--carnate-border-light);
        }


        .carnate-counter-sale .page-title-wrapper {
            display: flex;

            align-items: center;

            gap: 13px;
        }


        .carnate-counter-sale .page-title-icon {
            width: 42px;

            height: 42px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 10px;

            background: var(--carnate-red-soft);

            color: var(--carnate-red);

            font-size: 20px;
        }


        .carnate-counter-sale .page-title {
            margin: 0;

            color: var(--carnate-text);

            font-size: 20px;

            font-weight: 700;

            line-height: 1.3;

            letter-spacing: -0.2px;
        }


        .carnate-counter-sale .page-subtitle {
            margin: 3px 0 0;

            color: var(--carnate-muted);

            font-size: 12px;
        }


        /* =========================================================
           ADD BUTTON
        ========================================================= */

        .carnate-counter-sale .add-button {
            min-height: 42px;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 7px;

            padding: 0 17px;

            border: 0;

            border-radius: 9px;

            background: var(--carnate-red);

            color: #ffffff;

            font-size: 13px;

            font-weight: 600;

            text-decoration: none;

            box-shadow:
                0 5px 14px rgba(229, 57, 53, 0.16);

            transition:
                background .2s ease,
                transform .2s ease,
                box-shadow .2s ease;
        }


        .carnate-counter-sale .add-button:hover {
            background: var(--carnate-red-dark);

            color: #ffffff;

            transform: translateY(-1px);

            box-shadow:
                0 8px 18px rgba(229, 57, 53, 0.20);
        }


        .carnate-counter-sale .add-button i {
            font-size: 17px;
        }


        /* =========================================================
           FILTER CARD
        ========================================================= */

        .carnate-counter-sale .filter-card {
            margin-top: 18px;

            padding: 18px 22px;

            background: var(--carnate-white);

            border: 1px solid var(--carnate-border);

            border-radius: 14px;

            box-shadow:
                0 4px 16px rgba(15, 23, 42, 0.035);
        }


        .carnate-counter-sale .filter-row {
            display: flex;

            align-items: flex-end;

            justify-content: space-between;

            gap: 18px;
        }


        .carnate-counter-sale .search-wrapper {
            width: 100%;

            max-width: 380px;

            position: relative;
        }


        .carnate-counter-sale .search-label {
            display: block;

            margin-bottom: 7px;

            color: #334155;

            font-size: 12px;

            font-weight: 600;
        }


        .carnate-counter-sale .search-input-wrapper {
            position: relative;
        }


        .carnate-counter-sale .search-icon {
            position: absolute;

            left: 13px;

            top: 50%;

            transform: translateY(-50%);

            color: #94a3b8;

            font-size: 17px;

            pointer-events: none;
        }


        .carnate-counter-sale .search-input {
            width: 100%;

            height: 44px;

            padding: 0 14px 0 40px;

            border: 1px solid var(--carnate-border);

            border-radius: 9px;

            background: #ffffff;

            color: var(--carnate-text);

            font-size: 13px;

            outline: none;

            transition:
                border-color .2s ease,
                box-shadow .2s ease;
        }


        .carnate-counter-sale .search-input::placeholder {
            color: #a1aab7;
        }


        .carnate-counter-sale .search-input:hover {
            border-color: #cbd5e1;
        }


        .carnate-counter-sale .search-input:focus {
            border-color: var(--carnate-red);

            box-shadow:
                0 0 0 3px rgba(229, 57, 53, 0.07);
        }


        /* =========================================================
           CLEAR BUTTON
        ========================================================= */

        .carnate-counter-sale .clear-button {
            height: 44px;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 7px;

            padding: 0 16px;

            border: 1px solid var(--carnate-border);

            border-radius: 9px;

            background: #ffffff;

            color: #475569;

            font-size: 13px;

            font-weight: 600;

            transition: all .2s ease;
        }


        .carnate-counter-sale .clear-button:hover {
            border-color: var(--carnate-red);

            background: var(--carnate-red-soft);

            color: var(--carnate-red);
        }


        .carnate-counter-sale .clear-button i {
            font-size: 16px;
        }


        /* =========================================================
           TABLE CARD
        ========================================================= */

        .carnate-counter-sale .table-card {
            margin-top: 18px;

            background: var(--carnate-white);

            border: 1px solid var(--carnate-border);

            border-radius: 14px;

            box-shadow:
                0 4px 16px rgba(15, 23, 42, 0.035);

            overflow: hidden;
        }


        .carnate-counter-sale .table-card-header {
            display: flex;

            align-items: center;

            justify-content: space-between;

            padding: 17px 22px;

            border-bottom: 1px solid var(--carnate-border-light);
        }


        .carnate-counter-sale .table-card-title {
            display: flex;

            align-items: center;

            gap: 9px;

            margin: 0;

            color: var(--carnate-text);

            font-size: 14px;

            font-weight: 700;
        }


        .carnate-counter-sale .table-card-title i {
            color: var(--carnate-red);

            font-size: 18px;
        }


        /* =========================================================
           TABLE
        ========================================================= */

        .carnate-counter-sale .table-responsive {
            overflow-x: auto;

            -webkit-overflow-scrolling: touch;
        }


        .carnate-counter-sale .countersaletable {
            width: 100%;

            min-width: 900px;

            margin: 0;

            border: 0 !important;

            border-collapse: separate;

            border-spacing: 0;
        }


        .carnate-counter-sale .countersaletable thead th {
            padding: 13px 16px;

            background: #f8fafc;

            border: 0;

            border-bottom: 1px solid var(--carnate-border);

            color: #64748b;

            font-size: 11px;

            font-weight: 700;

            letter-spacing: .35px;

            text-transform: uppercase;

            white-space: nowrap;
        }


        .carnate-counter-sale .countersaletable tbody td {
            padding: 14px 16px;

            border: 0;

            border-bottom: 1px solid var(--carnate-border-light);

            color: #475569;

            font-size: 13px;

            vertical-align: middle;

            white-space: nowrap;
        }


        .carnate-counter-sale .countersaletable tbody tr {
            transition: background-color .15s ease;
        }


        .carnate-counter-sale .countersaletable tbody tr:hover {
            background: #fafbfc;
        }


        .carnate-counter-sale .countersaletable tbody tr:last-child td {
            border-bottom: 0;
        }


        /* =========================================================
           SERIAL NUMBER
        ========================================================= */

        .carnate-counter-sale .serial-number {
            color: #94a3b8;

            font-size: 12px;

            font-weight: 600;
        }


        /* =========================================================
           COUNTER SALE NUMBER
        ========================================================= */

        .carnate-counter-sale .sale-number {
            color: var(--carnate-text) !important;

            font-weight: 600;
        }


        .carnate-counter-sale .sale-number:hover {
            color: var(--carnate-red) !important;
        }


        /* =========================================================
           CUSTOMER
        ========================================================= */

        .carnate-counter-sale .customer-link {
            display: inline-flex;

            align-items: center;

            gap: 8px;
        }


        .carnate-counter-sale .customer-avatar {
            width: 30px;

            height: 30px;

            min-width: 30px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 8px;

            background: #f1f5f9;

            color: #64748b;

            font-size: 14px;
        }


        .carnate-counter-sale .customer-name {
            color: #334155 !important;

            font-weight: 500;
        }


        /* =========================================================
           AMOUNTS
        ========================================================= */

        .carnate-counter-sale .amount {
            color: #334155;

            font-weight: 600;
        }


        .carnate-counter-sale .paid-amount {
            color: #15803d;

            font-weight: 600;
        }


        .carnate-counter-sale .balance-amount {
            color: #dc2626;

            font-weight: 600;
        }


        /* =========================================================
           STATUS
        ========================================================= */

        .carnate-counter-sale .status-cell .badge {
            display: inline-flex;

            align-items: center;

            gap: 5px;

            padding: 6px 9px;

            border-radius: 999px;

            font-size: 11px;

            font-weight: 600;
        }


        .carnate-counter-sale .status-cell .badge i {
            font-size: 10px;
        }


        /* =========================================================
           ACTIONS
        ========================================================= */

        .carnate-counter-sale .action-cell {
            width: 100px;

            text-align: right;
        }


        .carnate-counter-sale .action-button {
            width: 34px;

            height: 34px;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            margin-left: 4px;

            padding: 0;

            border: 1px solid var(--carnate-border);

            border-radius: 8px;

            background: #ffffff;

            color: #64748b;

            transition: all .2s ease;
        }


        .carnate-counter-sale .action-button:hover {
            border-color: var(--carnate-red);

            background: var(--carnate-red-soft);

            color: var(--carnate-red);
        }


        .carnate-counter-sale .action-button.delete:hover {
            border-color: #fecaca;

            background: #fef2f2;

            color: #dc2626;
        }


        .carnate-counter-sale .action-button i {
            font-size: 16px;
        }


        /* =========================================================
           EMPTY STATE
        ========================================================= */

        .carnate-counter-sale .empty-state {
            padding: 65px 25px;

            text-align: center;
        }


        .carnate-counter-sale .empty-icon {
            width: 58px;

            height: 58px;

            display: flex;

            align-items: center;

            justify-content: center;

            margin: 0 auto 15px;

            border-radius: 14px;

            background: #f1f5f9;

            color: #94a3b8;

            font-size: 26px;
        }


        .carnate-counter-sale .empty-title {
            margin: 0 0 5px;

            color: #334155;

            font-size: 15px;

            font-weight: 700;
        }


        .carnate-counter-sale .empty-description {
            margin: 0;

            color: #94a3b8;

            font-size: 12px;
        }


        /* =========================================================
           PAGINATION
        ========================================================= */

        .carnate-counter-sale .pagination-wrapper {
            padding: 17px 20px;

            border-top: 1px solid var(--carnate-border-light);

            background: #ffffff;
        }


        .carnate-counter-sale .pagination-wrapper nav {
            margin: 0;
        }


        /* =========================================================
           MOBILE
        ========================================================= */

        @media (max-width: 767px) {

            .carnate-counter-sale .page-header {
                align-items: flex-start;

                flex-direction: column;

                padding: 17px;
            }


            .carnate-counter-sale .add-button {
                width: 100%;
            }


            .carnate-counter-sale .filter-card {
                padding: 16px;
            }


            .carnate-counter-sale .filter-row {
                align-items: stretch;

                flex-direction: column;
            }


            .carnate-counter-sale .search-wrapper {
                max-width: 100%;
            }


            .carnate-counter-sale .clear-button {
                width: 100%;
            }


            .carnate-counter-sale .table-card-header {
                padding: 15px 17px;
            }


            .carnate-counter-sale .countersaletable thead th,
            .carnate-counter-sale .countersaletable tbody td {
                padding-left: 12px;

                padding-right: 12px;
            }
        }
    </style>


    {{-- =========================================================
         COUNTER SALE ADD MODE
    ========================================================= --}}

    @php
        $sparePart = App\Models\SparePartVendor::where('id', $sparePartId)->first();
    @endphp


    @if ($isAdd == true)

        @livewire('Sparepart.ConterSaleAddController')

    @else


        {{-- =====================================================
             PAGE HEADER
        ====================================================== --}}

        <div class="carnate-card">

            <div class="page-header">

                <div class="page-title-wrapper">

                    <div class="page-title-icon">
                        <i class="bx bx-receipt"></i>
                    </div>

                    <div>

                        <h1 class="page-title">
                            Counter Sale
                        </h1>

                        <p class="page-subtitle">
                            Manage counter sales and customer transactions
                        </p>

                    </div>

                </div>


                @if (@$sparePart->hasPermissionTo('countersale-add'))

                    <a
                        href="{{ route('sparepart.countersaleadd') }}"
                        class="add-button"
                    >

                        <i class="bx bx-plus"></i>

                        Add Counter Sale

                    </a>

                @endif

            </div>

        </div>


        {{-- =====================================================
             SEARCH / FILTER
        ====================================================== --}}

        <div class="filter-card">

            <div class="filter-row">

                <div class="search-wrapper">

                    <label class="search-label">
                        Search Counter Sales
                    </label>

                    <div class="search-input-wrapper">

                        <i class="bx bx-search search-icon"></i>

                        <input
                            type="text"
                            class="search-input"
                            placeholder="Search by sale number, customer..."
                            wire:model.live="searchfilter"
                        >

                    </div>

                </div>


                <div>

                    <button
                        type="button"
                        class="clear-button"
                        wire:click="resetFilter"
                    >

                        <i class="bx bx-refresh"></i>

                        Clear Filter

                    </button>

                </div>

            </div>

        </div>


        {{-- =====================================================
             TABLE
        ====================================================== --}}

        <div class="table-card">

            @if (!empty($items) && $items->count())

                <div class="table-card-header">

                    <h2 class="table-card-title">

                        <i class="bx bx-list-ul"></i>

                        Counter Sale Records

                    </h2>

                </div>


                <div class="table-responsive">

                    <table class="table countersaletable">

                        <thead>

                            <tr>

                                <th>
                                    S.No.
                                </th>

                                <th>
                                    Entry Date
                                </th>

                                <th>
                                    Counter Sale Number
                                </th>

                                <th>
                                    Customer Name
                                </th>

                                <th>
                                    Bill Amount
                                </th>

                                <th>
                                    Total Paid
                                </th>

                                <th>
                                    Balance
                                </th>

                                <th>
                                    Status
                                </th>

                                @if (
                                    @$sparePart->hasPermissionTo('countersale-edit') ||
                                    @$sparePart->hasPermissionTo('countersale-delete')
                                )

                                    <th class="text-end">
                                        Action
                                    </th>

                                @endif

                            </tr>

                        </thead>


                        <tbody>

                            @foreach ($items as $index => $countersale)

                                <tr>

                                    {{-- =================================================
                                         SERIAL
                                    ================================================== --}}

                                    <td>

                                        <span class="serial-number">

                                            {{ $items->total() - ($items->firstItem() + $index) + 1 }}

                                        </span>

                                    </td>


                                    {{-- =================================================
                                         ENTRY DATE
                                    ================================================== --}}

                                    <td>

                                        <a
                                            href="{{ route('sparepart.countersaleedit', $countersale->id) }}"
                                        >

                                            {{ \Carbon\Carbon::parse($countersale->created_at)->format('d-m-Y h:i A') ?? '-' }}

                                        </a>

                                    </td>


                                    {{-- =================================================
                                         COUNTER SALE NUMBER
                                    ================================================== --}}

                                    <td>

                                        <a
                                            href="{{ route('sparepart.countersaleedit', $countersale->id) }}"
                                            class="sale-number"
                                        >

                                            {{ $countersale->countersale_number ?? '-' }}

                                        </a>

                                    </td>


                                    {{-- =================================================
                                         CUSTOMER
                                    ================================================== --}}

                                    <td>

                                        <a
                                            href="{{ route('sparepart.countersaleedit', $countersale->id) }}"
                                            class="customer-link"
                                        >

                                            <span class="customer-avatar">

                                                <i class="bx bx-user"></i>

                                            </span>

                                            <span class="customer-name">

                                                {{ $countersale->Customer->name ?? '-' }}

                                            </span>

                                        </a>

                                    </td>


                                    {{-- =================================================
                                         BILL AMOUNT
                                    ================================================== --}}

                                    <td>

                                        <a
                                            href="{{ route('sparepart.countersaleedit', $countersale->id) }}"
                                            class="amount"
                                        >

                                            {{ $countersale->subtotal ?? '-' }}

                                        </a>

                                    </td>


                                    {{-- =================================================
                                         TOTAL PAID
                                    ================================================== --}}

                                    <td>

                                        <a
                                            href="javascript:void(0);"
                                            class="paid-amount"
                                        >

                                            {{ $countersale->partial_amount ?? '-' }}

                                        </a>

                                    </td>


                                    {{-- =================================================
                                         BALANCE
                                    ================================================== --}}

                                    <td>

                                        <a
                                            href="javascript:void(0);"
                                            class="balance-amount"
                                        >

                                            {{ $countersale->balance_amount ?? '-' }}

                                        </a>

                                    </td>


                                    {{-- =================================================
                                         STATUS
                                    ================================================== --}}

                                    <td class="status-cell">

                                        {!! App\Models\CounterSale::$status[$countersale->status] ??
                                            '<span class="badge bg-danger"><i class="bx bx-x-circle"></i> Un-paid</span>' !!}

                                    </td>


                                    {{-- =================================================
                                         ACTIONS
                                    ================================================== --}}

                                    @if (
                                        @$sparePart->hasPermissionTo('countersale-edit') ||
                                        @$sparePart->hasPermissionTo('countersale-delete')
                                    )

                                        <td class="action-cell">

                                            @if (@$sparePart->hasPermissionTo('countersale-edit'))

                                                <a
                                                    href="{{ route('sparepart.countersaleedit', $countersale->id) }}"
                                                    class="action-button"
                                                    title="Edit"
                                                >

                                                    <i class="bx bx-edit"></i>

                                                </a>

                                            @endif


                                            @if (@$sparePart->hasPermissionTo('countersale-delete'))

                                                <a
                                                    href="javascript:void(0);"
                                                    wire:click="confirmDelete({{ $countersale->id }})"
                                                    class="action-button delete"
                                                    title="Delete"
                                                >

                                                    <i class="bx bx-trash"></i>

                                                </a>

                                            @endif

                                        </td>

                                    @endif

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>


                {{-- =================================================
                     PAGINATION
                ================================================== --}}

                <div class="pagination-wrapper">

                    {{ $items->links() }}

                </div>

            @else


                {{-- =================================================
                     EMPTY STATE
                ================================================== --}}

                <div class="empty-state">

                    <div class="empty-icon">

                        <i class="bx bx-receipt"></i>

                    </div>

                    <h3 class="empty-title">
                        No Counter Sale Found
                    </h3>

                    <p class="empty-description">
                        There are no counter sale records available.
                    </p>

                </div>

            @endif

        </div>

    @endif

</div>


{{-- =========================================================
     FOOTER SCRIPTS
========================================================= --}}

@section('footerscript')

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>


    <script>

        /* =========================================================
           LIVEWIRE / SELECT2
        ========================================================= */

        document.addEventListener('livewire:init', function () {

            Livewire.hook('morphed', (message, component) => {

                $('.select2').select2().on('change', function (e) {

                    const selectedValues = $(this).val();

                    @this.set(
                        e.target.dataset.property,
                        selectedValues
                    );

                });

            });

        });


        /* =========================================================
           DENT MODAL
        ========================================================= */

        document.addEventListener('show-dent-modal', () => {

            const modal =
                document.querySelector('.modal');

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

            const carImage =
                new Image();


            /*
             * Set the source dynamically using Laravel
             */

            carImage.src =
                "{{ asset('assets/dentcar/car.png') }}";


            /*
             * Show modal
             */

            const showModalButton =
                document.getElementById('showModalButton');


            if (showModalButton) {

                showModalButton.addEventListener('click', () => {

                    modal.classList.add('show');

                    modal.style.display = 'block';

                    carImageTag.style.display = 'block';

                });

            }


            /*
             * Image load
             */

            carImage.onload = () => {

                const scaleFactor = 0.7;

                const newWidth =
                    carImage.width * scaleFactor;

                const newHeight =
                    carImage.height * scaleFactor;


                backgroundCanvas.width =
                    newWidth;

                backgroundCanvas.height =
                    newHeight;

                overlayCanvas.width =
                    newWidth;

                overlayCanvas.height =
                    newHeight;


                bgCtx.drawImage(
                    carImage,
                    0,
                    0,
                    newWidth,
                    newHeight
                );

            };


            /* =====================================================
               DRAWING LOGIC
            ====================================================== */

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


            /* =====================================================
               MODE SWITCHING
            ====================================================== */

            const buttons =
                document.querySelectorAll('.controls button');


            buttons.forEach(button => {

                button.addEventListener('click', () => {

                    buttons.forEach(btn => {

                        btn.classList.remove('active');

                    });

                    button.classList.add('active');

                    mode =
                        button.id.replace('Btn', '');

                });

            });


            /* =====================================================
               CANVAS MOUSE EVENTS
            ====================================================== */

            overlayCanvas.addEventListener(
                'mousedown',
                () => {

                    drawing = true;

                    overlayCtx.beginPath();

                }
            );


            overlayCanvas.addEventListener(
                'mouseup',
                () => {

                    drawing = false;

                    overlayCtx.beginPath();

                }
            );


            overlayCanvas.addEventListener(
                'mousemove',
                draw
            );


            function draw(event) {

                if (!drawing) {
                    return;
                }


                const rect =
                    overlayCanvas.getBoundingClientRect();


                const x =
                    event.clientX - rect.left;

                const y =
                    event.clientY - rect.top;


                overlayCtx.lineCap =
                    'round';


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


                overlayCtx.lineTo(
                    x,
                    y
                );

                overlayCtx.stroke();

                overlayCtx.beginPath();

                overlayCtx.moveTo(
                    x,
                    y
                );

            }


            /* =====================================================
               CLEAR CANVAS
            ====================================================== */

            const clearButton =
                document.getElementById('clearBtn');


            if (clearButton) {

                clearButton.addEventListener(
                    'click',
                    () => {

                        overlayCtx.clearRect(
                            0,
                            0,
                            overlayCanvas.width,
                            overlayCanvas.height
                        );

                    }
                );

            }


            /* =====================================================
               SAVE IMAGE
            ====================================================== */

            let beta = 0;


            const saveButton =
                document.getElementById('saveBtn');


            if (saveButton) {

                saveButton.addEventListener(
                    'click',
                    () => {

                        if (beta = 0) {

                            beta = 1;

                            if (
                                !confirm(
                                    "Are you sure you want to save the changes?"
                                )
                            ) {
                                return;
                            }

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
                            mergedCanvas.toDataURL(
                                'image/png'
                            );


                        Livewire.dispatch(
                            'saveImage',
                            {
                                mergedImageData:
                                    mergedImageData
                            }
                        );

                    }
                );

            }

        });


        /* =========================================================
           MAX QUANTITY VALIDATION
        ========================================================= */

        function validateMaxQuantity(input) {

            var maxQuantity =
                parseInt(
                    input.getAttribute('max')
                );


            if (
                parseInt(input.value) >
                maxQuantity
            ) {

                input.value =
                    maxQuantity;

            }

        }

    </script>

@endsection