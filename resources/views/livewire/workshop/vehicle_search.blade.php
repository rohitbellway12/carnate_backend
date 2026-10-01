<style>
    /* =========================================================
       CARNATE - WORKSHOP SPARE PART SEARCH
       UI REDESIGN ONLY
       Livewire / Alpine / Routes / Methods preserved
    ========================================================= */

    .carnate-spare-search {
        --carnate-bg: #f7f8fa;
        --carnate-card: #ffffff;
        --carnate-text: #111827;
        --carnate-muted: #64748b;
        --carnate-border: #e2e8f0;
        --carnate-red: #e53935;
        --carnate-red-dark: #d32f2f;
        --carnate-red-soft: #fff5f5;
        --carnate-icon-bg: #f1f5f9;
    }

    .carnate-spare-search {
        color: var(--carnate-text);
    }

    /* ---------------------------------------------------------
       CARDS
    --------------------------------------------------------- */

    .carnate-spare-search .card {
        border: 1px solid var(--carnate-border);
        border-radius: 16px;
        background: var(--carnate-card);
        box-shadow: 0 3px 14px rgba(15, 23, 42, 0.045);
        overflow: hidden;
        margin-bottom: 20px;
    }

    .carnate-spare-search .card-header {
        min-height: 68px;
        padding: 16px 20px;
        background: #ffffff;
        border-bottom: 1px solid var(--carnate-border);
    }

    .carnate-spare-search .card-header h3 {
        margin: 0;
        color: var(--carnate-text) !important;
        font-size: 18px;
        line-height: 1.4;
        font-weight: 700;
        letter-spacing: -0.2px;
    }

    .carnate-spare-search .card-header h3 span {
        color: var(--carnate-red) !important;
    }

    /* Cart */
    .carnate-spare-search .cardIcon {
        padding-right: 0 !important;
    }

    .carnate-spare-search .cardIcon a {
        position: relative;
        width: 42px;
        height: 42px;
        border-radius: 11px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: var(--carnate-red-soft);
        color: var(--carnate-red);
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .carnate-spare-search .cardIcon a:hover {
        background: var(--carnate-red);
        color: #ffffff;
        transform: translateY(-1px);
    }

    .carnate-spare-search .cardIcon a i {
        font-size: 21px;
    }

    .carnate-spare-search .card_counter {
        position: absolute;
        top: -6px;
        right: -6px;
        min-width: 19px;
        height: 19px;
        padding: 0 5px;
        border-radius: 20px;
        background: var(--carnate-red) !important;
        color: #ffffff !important;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        font-weight: 700;
        line-height: 1;
        margin: 0 !important;
    }

    /* ---------------------------------------------------------
       VEHICLE FILTER
    --------------------------------------------------------- */

    .carnate-spare-search .vehicle-filter {
        background: #ffffff;
    }

    .carnate-spare-search .vehicle-filter-body {
        padding: 18px 20px 20px;
        background: #ffffff;
    }

    .carnate-spare-search .vehicle-filter-row {
        padding: 16px;
        background: #f8fafc;
        border: 1px solid var(--carnate-border);
        border-radius: 12px;
    }

    .carnate-spare-search .form-group {
        margin: 0;
    }

    /* ---------------------------------------------------------
       FORMS
    --------------------------------------------------------- */

    .carnate-spare-search .form-control,
    .carnate-spare-search .form-select {
        min-height: 42px;
        border: 1px solid var(--carnate-border);
        border-radius: 9px;
        background: #ffffff;
        color: var(--carnate-text);
        font-size: 13px;
        font-weight: 500;
        box-shadow: none;
        transition: all 0.2s ease;
    }

    .carnate-spare-search .form-control {
        padding: 9px 12px;
    }

    .carnate-spare-search .form-select {
        padding: 9px 32px 9px 12px;
    }

    .carnate-spare-search .form-control::placeholder {
        color: #94a3b8;
    }

    .carnate-spare-search .form-control:focus,
    .carnate-spare-search .form-select:focus {
        border-color: rgba(229, 57, 53, 0.55);
        box-shadow: 0 0 0 3px rgba(229, 57, 53, 0.08);
        outline: none;
    }

    /* ---------------------------------------------------------
       REMOVE OLD BLUE / CUSTOM BACKGROUNDS
    --------------------------------------------------------- */

    .carnate-spare-search .bg12477a {
        background: #f8fafc !important;
    }

    .carnate-spare-search .clr12477a {
        color: var(--carnate-text) !important;
    }

    .carnate-spare-search .clr59d8fd {
        color: var(--carnate-red) !important;
    }

    .carnate-spare-search .bg59d8fd {
        background: var(--carnate-red) !important;
    }

    /* ---------------------------------------------------------
       BUTTONS
    --------------------------------------------------------- */

    .carnate-spare-search .btn {
        min-height: 40px;
        border-radius: 9px;
        padding: 8px 15px;
        font-size: 13px;
        font-weight: 600;
        box-shadow: none;
        transition: all 0.2s ease;
    }

    .carnate-spare-search .btn-primary {
        background: var(--carnate-red);
        border-color: var(--carnate-red);
        color: #ffffff;
    }

    .carnate-spare-search .btn-primary:hover,
    .carnate-spare-search .btn-primary:focus {
        background: var(--carnate-red-dark);
        border-color: var(--carnate-red-dark);
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 5px 14px rgba(229, 57, 53, 0.18);
    }

    .carnate-spare-search .btn-outline-primary {
        color: var(--carnate-red);
        border-color: #f3a3a1;
        background: #ffffff;
    }

    .carnate-spare-search .btn-outline-primary:hover,
    .carnate-spare-search .btn-outline-primary:focus {
        color: #ffffff;
        background: var(--carnate-red);
        border-color: var(--carnate-red);
    }

    .carnate-spare-search .btn-danger {
        background: var(--carnate-red);
        border-color: var(--carnate-red);
    }

    /* ---------------------------------------------------------
       SEARCH AREA
    --------------------------------------------------------- */

    .carnate-spare-search .spare-search-header {
        gap: 12px;
    }

    .carnate-spare-search .spare-search-input {
        min-width: 240px;
    }

    .carnate-spare-search .api-search-group {
        width: 300px !important;
    }

    .carnate-spare-search .api-search-group .form-control {
        border-radius: 9px 0 0 9px;
    }

    .carnate-spare-search .api-search-group .btn {
        border-radius: 0 9px 9px 0;
        min-width: 72px;
    }

    .carnate-spare-search .api-search-group .btn i {
        margin-right: 3px;
    }

    /* ---------------------------------------------------------
       PRODUCT GRID
    --------------------------------------------------------- */

    .carnate-spare-search .product-grid {
        margin-top: 0 !important;
        row-gap: 18px;
    }

    .carnate-spare-search .product-grid > .col {
        display: flex;
    }

    .carnate-spare-search .product-card {
        width: 100%;
        height: 100% !important;
        min-height: 250px;
        border: 1px solid var(--carnate-border);
        border-radius: 14px;
        background: #ffffff;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(15, 23, 42, 0.035);
        transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
    }

    .carnate-spare-search .product-card:hover {
        transform: translateY(-3px);
        border-color: #cbd5e1;
        box-shadow: 0 10px 25px rgba(15, 23, 42, 0.08);
    }

    .carnate-spare-search .product-card-link {
        display: flex;
        width: 100%;
        height: 100%;
        min-height: 250px;
        padding: 18px;
        color: inherit;
        text-decoration: none;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
    }

    .carnate-spare-search .product-image-wrap {
        width: 100%;
        height: 120px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 8px;
        border-radius: 10px;
        background: #f8fafc;
    }

    .carnate-spare-search .product-image-wrap img {
        max-width: 100%;
        max-height: 105px;
        width: auto;
        height: auto;
        object-fit: contain;
        transition: transform 0.2s ease;
    }

    .carnate-spare-search .product-card:hover .product-image-wrap img {
        transform: scale(1.04);
    }

    .carnate-spare-search .product-info {
        width: 100%;
        margin-top: 12px;
        text-align: center;
    }

    .carnate-spare-search .product-name {
        display: block;
        color: var(--carnate-text);
        font-size: 13px;
        font-weight: 700;
        line-height: 1.4;
    }

    .carnate-spare-search .product-part-number {
        display: block;
        margin-top: 5px;
        color: var(--carnate-muted);
        font-size: 12px;
        font-weight: 500;
    }

    /* ---------------------------------------------------------
       API RESULT CARD
    --------------------------------------------------------- */

    .carnate-spare-search .api-product-card {
        position: relative;
        width: 100%;
        min-height: 250px;
        border: 1px solid var(--carnate-border);
        border-radius: 14px;
        background: #ffffff;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(15, 23, 42, 0.035);
        transition: all 0.2s ease;
    }

    .carnate-spare-search .api-product-card:hover {
        transform: translateY(-3px);
        border-color: #cbd5e1;
        box-shadow: 0 10px 25px rgba(15, 23, 42, 0.08);
    }

    .carnate-spare-search .api-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        z-index: 2;
        padding: 5px 9px;
        border-radius: 6px;
        background: var(--carnate-red) !important;
        color: #ffffff;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 0.2px;
    }

    .carnate-spare-search .api-product-body {
        min-height: 250px;
        padding: 20px 16px 16px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
    }

    .carnate-spare-search .api-product-image {
        width: 100%;
        height: 105px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 8px;
    }

    .carnate-spare-search .api-product-image img {
        max-width: 100%;
        max-height: 100px;
        object-fit: contain;
    }

    .carnate-spare-search .api-brand {
        display: block;
        color: var(--carnate-muted);
        font-size: 11px;
        margin-bottom: 4px;
    }

    .carnate-spare-search .api-product-name {
        display: block;
        color: var(--carnate-text);
        font-size: 13px;
        font-weight: 700;
        line-height: 1.35;
    }

    .carnate-spare-search .api-part-number {
        display: block;
        margin-top: 5px;
        color: var(--carnate-red) !important;
        font-size: 11px;
        font-weight: 700;
    }

    .carnate-spare-search .api-view-button {
        width: 100%;
        margin-top: 10px;
    }

    /* ---------------------------------------------------------
       SKELETON LOADING
    --------------------------------------------------------- */

    .carnate-spare-search .skeleton-card {
        width: 100%;
        min-height: 250px;
        padding: 16px;
        border: 1px solid var(--carnate-border);
        border-radius: 14px;
        background: #ffffff;
    }

    .carnate-spare-search .skeleton-image {
        height: 120px;
        width: 100%;
        background: #e2e8f0;
        border-radius: 10px;
        animation: carnateSkeletonPulse 1.5s infinite ease-in-out;
    }

    .carnate-spare-search .skeleton-text {
        height: 14px;
        width: 60%;
        margin: 14px auto 0;
        background: #e2e8f0;
        border-radius: 5px;
        animation: carnateSkeletonPulse 1.5s infinite ease-in-out;
    }

    @keyframes carnateSkeletonPulse {
        0% {
            opacity: 0.55;
        }

        50% {
            opacity: 1;
        }

        100% {
            opacity: 0.55;
        }
    }

    /* ---------------------------------------------------------
       SELECT2
    --------------------------------------------------------- */

    .carnate-spare-search .select2-container {
        width: 100% !important;
    }

    .carnate-spare-search .select2-container--default .select2-selection--single {
        height: 42px;
        border: 1px solid var(--carnate-border);
        border-radius: 9px;
        background: #ffffff;
    }

    .carnate-spare-search .select2-container--default
    .select2-selection--single
    .select2-selection__rendered {
        line-height: 40px;
        padding-left: 12px;
        color: var(--carnate-text);
        font-size: 13px;
        font-weight: 500;
    }

    .carnate-spare-search .select2-container--default
    .select2-selection--single
    .select2-selection__arrow {
        height: 40px;
        right: 7px;
    }

    /* ---------------------------------------------------------
       RESPONSIVE
    --------------------------------------------------------- */

    @media (max-width: 1199px) {
        .carnate-spare-search .spare-search-header {
            flex-wrap: wrap;
        }

        .carnate-spare-search .spare-search-input {
            min-width: 200px;
        }

        .carnate-spare-search .api-search-group {
            width: 260px !important;
        }
    }

    @media (max-width: 767px) {
        .carnate-spare-search .card-header {
            padding: 15px;
            align-items: flex-start !important;
            flex-direction: column;
            gap: 12px;
        }

        .carnate-spare-search .card-header h3 {
            font-size: 16px;
        }

        .carnate-spare-search .vehicle-filter-body {
            padding: 14px;
        }

        .carnate-spare-search .vehicle-filter-row {
            padding: 12px;
        }

        .carnate-spare-search .spare-search-header {
            width: 100%;
        }

        .carnate-spare-search .spare-search-input,
        .carnate-spare-search .api-search-group {
            width: 100% !important;
            min-width: 0;
        }

        .carnate-spare-search .product-card-link {
            padding: 14px;
        }
    }
</style>

<div class="carnate-spare-search"
    x-data="{
        pageLoading: false,
        hasMore: @json($hasMore),

        loadMore() {
            if (!this.hasMore || this.pageLoading) return;

            this.pageLoading = true;

            $wire.loadMore().then(() => {
                this.pageLoading = false;

                const hasMoreElement = document.getElementById('hasMorePages');

                if (hasMoreElement) {
                    this.hasMore = hasMoreElement.value == '1';
                }
            });
        }
    }"
    x-init="() => {
        window.addEventListener('scroll', () => {
            const scrollPos = window.innerHeight + window.scrollY;
            const docHeight = document.documentElement.offsetHeight;

            if (scrollPos >= docHeight - 100) {
                loadMore();
            }
        });
    }">

    <!-- =====================================================
         SEARCH BY VEHICLE
    ====================================================== -->

    <div class="card vehicle-filter">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h3>
                Search by <span>Vehicle</span>
            </h3>

            <div class="pe-3 cardIcon">
                <a href="{{ route('workshop.cart', $cartOrderId) }}">
                    <i class="bx bxs-cart-alt"></i>

                    <span class="card_counter">
                        {{ $counterCard }}
                    </span>
                </a>
            </div>

        </div>

        <div class="vehicle-filter-body">

            <div class="vehicle-filter-row">

                <div class="row g-3">

                    {{-- Brand Dropdown --}}
                    <div class="col-12 col-sm-6 col-lg-auto flex-grow-1">
                        <div class="form-group">

                            <select class="form-select select2"
                                wire:model.live="brand_name">

                                <option value="">
                                    Select Brand
                                </option>

                                @foreach ($brands as $brand)
                                    <option value="{{ $brand }}">
                                        {{ $brand }}
                                    </option>
                                @endforeach

                            </select>

                        </div>
                    </div>

                    {{-- Variant Dropdown --}}
                    <div class="col-12 col-sm-6 col-lg-auto flex-grow-1">
                        <div class="form-group">

                            <select class="form-select select2"
                                wire:model.live="variant_name">

                                <option value="">
                                    Select Variant
                                </option>

                                @foreach ($variants as $variant)
                                    <option value="{{ $variant }}">
                                        {{ $variant }}
                                    </option>
                                @endforeach

                            </select>

                        </div>
                    </div>

                    {{-- Year Dropdown --}}
                    <div class="col-12 col-sm-6 col-lg-auto flex-grow-1">
                        <div class="form-group">

                            <select class="form-select select2"
                                wire:model.live="selected_year">

                                <option value="">
                                    Select Year
                                </option>

                                @foreach ($years as $year)
                                    <option value="{{ $year }}">
                                        {{ $year }}
                                    </option>
                                @endforeach

                            </select>

                        </div>
                    </div>

                    {{-- Modification Dropdown --}}
                    <div class="col-12 col-sm-6 col-lg-auto flex-grow-1">
                        <div class="form-group">

                            <select class="form-select select2"
                                wire:model.live="modification_id">

                                <option value="">
                                    Select Modification
                                </option>

                                @foreach ($modifications as $key => $mod)
                                    <option value="{{ $key }}">
                                        {{ $mod }}
                                    </option>
                                @endforeach

                            </select>

                        </div>
                    </div>

                    {{-- Clear Filter --}}
                    <div class="col-12 col-sm-6 col-lg-auto">

                        <button type="button"
                            class="btn btn-primary w-100"
                            wire:click="resetFilter">
                            Clear
                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- =====================================================
         SEARCH BY SPARE PART
    ====================================================== -->

    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center spare-search-header">

            <h3>
                Search by <span>Spare Part's</span>
            </h3>

            <div class="d-flex gap-2 spare-search-header">

                <input type="text"
                    class="form-control spare-search-input"
                    placeholder="Local Search (Name/Number)"
                    wire:model.live="search">

                <div class="input-group api-search-group">

                    <input type="text"
                        class="form-control"
                        placeholder="Live API Search (Part #)"
                        wire:model.defer="apiPartNumber">

                    <button type="button"
                        class="btn btn-primary"
                        wire:click="searchPartViaApi">

                        <i class="bx bx-search-alt"></i>
                        API

                    </button>

                </div>

            </div>

        </div>


        <div class="card-body">

            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5 product-grid">

                {{-- =================================================
                     LIVE API RESULTS
                ================================================== --}}

                @foreach ($apiResults as $apiPart)

                    <div class="col">

                        <div class="api-product-card">

                            <span class="api-badge">
                                Live API
                            </span>

                            <div class="api-product-body">

                                <div class="api-product-image">

                                    @if (!empty($apiPart['image']))

                                        <img src="{{ $apiPart['image'] }}"
                                            alt="{{ $apiPart['name'] }}">

                                    @else

                                        <img src="{{ asset('img/spareparts.jpg') }}"
                                            alt="Part">

                                    @endif

                                </div>

                                <div class="text-center w-100">

                                    <small class="api-brand">
                                        {{ $apiPart['brand'] }}
                                    </small>

                                    <span class="api-product-name">
                                        {{ $apiPart['name'] }}
                                    </span>

                                    <small class="api-part-number">
                                        {{ $apiPart['part_number'] }}
                                    </small>

                                </div>

                                <div class="w-100">

                                    <button type="button"
                                        class="btn btn-outline-primary api-view-button"
                                        wire:click="loadApiPartDetails({{ $apiPart['id'] }})">

                                        View Details

                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>

                @endforeach


                {{-- =================================================
                     LOCAL DATABASE RESULTS
                ================================================== --}}

                @foreach ($spareParts as $sparePart)

                    <div class="col">

                        <div class="product-card">

                            <a class="product-card-link"
                                href="{{ route('workshop.addtocard', $sparePart->id) }}">

                                <div class="product-image-wrap">

                                    @if (!empty($sparePart->Image->file))

                                        <img src="{{ asset($sparePart->Image->file) }}"
                                            alt="Maintenance Service Parts">

                                    @else

                                        @if ($sparePart->spare_part_type == 1)

                                            <img src="{{ asset('img/accessory.png') }}"
                                                alt="Maintenance Service Parts">

                                        @elseif($sparePart->spare_part_type == 2)

                                            <img src="{{ asset('img/spareparts.jpg') }}"
                                                alt="Maintenance Service Parts">

                                        @elseif($sparePart->spare_part_type == 3)

                                            <img src="{{ asset('img/tools.jpg') }}"
                                                alt="Maintenance Service Parts">

                                        @else

                                            <img src="{{ asset('img/lubricant.jpg') }}"
                                                alt="Maintenance Service Parts">

                                        @endif

                                    @endif

                                </div>


                                <div class="product-info">

                                    @if ($sparePart->Label)

                                        <span class="product-name">
                                            {{ $sparePart->Label->title }}
                                        </span>

                                    @else

                                        <span class="product-name">
                                            Not Available
                                        </span>

                                    @endif

                                    <small class="product-part-number">
                                        {{ $sparePart->part_number }}
                                    </small>

                                </div>

                            </a>

                        </div>

                    </div>

                @endforeach


                {{-- =================================================
                     LOADING SKELETONS
                ================================================== --}}

                @for ($i = 0; $i < 20; $i++)

                    <div class="col"
                        x-show="pageLoading">

                        <div class="skeleton-card">

                            <div class="skeleton-image"></div>

                            <div class="skeleton-text"></div>

                        </div>

                    </div>

                @endfor

            </div>

        </div>


        <input type="hidden"
            id="hasMorePages"
            value="{{ $hasMore ? 1 : 0 }}">

    </div>

</div>