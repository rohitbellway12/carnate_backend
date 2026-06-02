<div x-data="{
    pageLoading: false,
    hasMore: @json($hasMore),
    loadMore() {
        if (!this.hasMore || this.pageLoading) return;
        this.pageLoading = true;
        $wire.loadMore().then(() => {
            this.pageLoading = false;
            this.hasMore = document.getElementById('hasMorePages').value == '1';
        });
    }
}" x-init="() => {
    window.addEventListener('scroll', () => {
        const scrollPos = window.innerHeight + window.scrollY;
        const docHeight = document.documentElement.offsetHeight;

        if (scrollPos >= docHeight - 100) {
            loadMore();
        }
    });
}">
    <style>
        .skeleton-image {
            height: 120px;
            background: #ddd;
            border-radius: 8px;
            animation: pulse 1.5s infinite ease-in-out;
        }

        .skeleton-text {
            height: 16px;
            width: 60%;
            margin: 10px auto 0;
            background: #ddd;
            border-radius: 4px;
            animation: pulse 1.5s infinite ease-in-out;
        }

        @keyframes pulse {
            0% {
                background-color: #eee;
            }

            50% {
                background-color: #ddd;
            }

            100% {
                background-color: #eee;
            }
        }
    </style>
    

    <!-- new 30/062025 manish -->
    <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="clr12477a"> Search by <span class="clr59d8fd">Vehicle</span></h3>
        <div class="pe-3 cardIcon">
            <a href="{{ route('workshop.cart', $cartOrderId) }}">
                <i class='bx bxs-cart-alt'></i>
                <span class="card_counter me-4 text-white">{{ $counterCard }}</span>
            </a>
        </div>
    </div>

    <div class="card-body">
        <div class="row bg12477a pb-3 px-1 g-3 rounded">

            {{-- 🔹 Brand Dropdown --}}
            <div class="col-auto">
                <div class="form-group">
                    <select class="form-select select2 py-lg-2 py-md-1" wire:model.live="brand_name">
                        <option value="">Select Brand</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand }}">{{ $brand }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- 🔹 Variant Dropdown --}}
            <div class="col-auto">
                <div class="form-group">
                    <select class="form-select select2 py-lg-2 py-md-1" wire:model.live="variant_name">
                        <option value="">Select Variant</option>
                        @foreach ($variants as $variant)
                            <option value="{{ $variant }}">{{ $variant }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- 🔹 Year Dropdown --}}
            <div class="col-auto">
                <div class="form-group">
                    <select class="form-select select2 py-lg-2 py-md-1" wire:model.live="selected_year">
                        <option value="">Select Year</option>
                        @foreach ($years as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- 🔹 Modification Dropdown (Optional) --}}
            <div class="col-auto">
                <div class="form-group">
                    <select class="form-select select2 py-lg-2 py-md-1" wire:model.live="modification_id">
                        <option value="">Select Modification</option>
                        @foreach ($modifications as $key => $mod) 
                            <option value="{{ $key }}">{{ $mod }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- 🔹 Clear Filter Button --}}
            <div class="col-auto">
                <button class="btn btn-block text-uppercase border-0 text-white bg59d8fd py-lg-2 py-md-1"
                    wire:click="resetFilter">Clear</button>
            </div>

        </div>
    </div>
</div>

    <div class="card clr12477a">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="clr12477a"> Search by <span class="clr59d8fd">Spare Part's</span></h3>
            <div class="d-flex gap-2">
                <input type="text" class="form-control" placeholder="Local Search (Name/Number)" wire:model.live="search">
                <div class="input-group" style="width: 300px;">
                    <input type="text" class="form-control" placeholder="Live API Search (Part #)" wire:model.defer="apiPartNumber">
                    <button class="btn btn-primary" wire:click="searchPartViaApi">
                        <i class='bx bx-search-alt'></i> API
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body gap-2">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5 mt-4 product-grid">
                {{-- 🔹 Live API Results --}}
                @foreach ($apiResults as $apiPart)
                    <div class="col">
                        <div class="card position-relative shadow-sm h-100">
                            <span class="badge bg-danger position-absolute top-0 start-0 m-2">Live API</span>
                            <div class="card-body text-center py-4 d-flex flex-column align-items-center justify-content-between">
                                <div class="col-12">
                                    @if (!empty($apiPart['image']))
                                        <img src="{{ $apiPart['image'] }}" alt="{{ $apiPart['name'] }}"
                                            height="100" style="max-width: 100%; object-fit: contain;">
                                    @else
                                        <img src="{{ asset('img/spareparts.jpg') }}" alt="Part"
                                            height="100" style="max-width: 100%; object-fit: contain;">
                                    @endif
                                </div>
                                <div class="col-12 mt-2">
                                    <small class="text-muted d-block">{{ $apiPart['brand'] }}</small>
                                    <span class="fw-bold clr12477a" style="font-size: 0.9rem; line-height: 1.2;">{{ $apiPart['name'] }}</span>
                                    <br>
                                    <small class="text-primary fw-bold">{{ $apiPart['part_number'] }}</small>
                                </div>
                                <div class="col-12 mt-2">
                                    <button class="btn btn-sm btn-outline-primary w-100" wire:click="loadApiPartDetails({{ $apiPart['id'] }})">View Details</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                {{-- 🔹 Local Database Results --}}
                @foreach ($spareParts as $sparePart)
                    <div class="col">
                        <div class="card" style="height: 250px;">
                            <a class="card-body text-center py-4 d-flex flex-column align-items-center justify-content-between"
                                href="{{ route('workshop.addtocard', $sparePart->id) }}">
                                <div class="col-12">
                                    @if (!empty($sparePart->Image->file))
                                        <img src="{{ asset($sparePart->Image->file) }}" alt="Maintenance Service Parts"
                                            height="100" style="max-width: 100%; object-fit: contain;">
                                    @else
                                        @if ($sparePart->spare_part_type == 1)
                                            <img src="{{ asset('img/accessory.png') }}" alt="Maintenance Service Parts"
                                                height="100" style="max-width: 100%; object-fit: contain;">
                                        @elseif($sparePart->spare_part_type == 2)
                                            <img src="{{ asset('img/spareparts.jpg') }}"
                                                alt="Maintenance Service Parts" height="100" style="max-width: 100%; object-fit: contain;">
                                        @elseif($sparePart->spare_part_type == 3)
                                            <img src="{{ asset('img/tools.jpg') }}" alt="Maintenance Service Parts"
                                                height="100" style="max-width: 100%; object-fit: contain;">
                                        @else
                                            <img src="{{ asset('img/lubricant.jpg') }}" alt="Maintenance Service Parts"
                                                height="100" style="max-width: 100%; object-fit: contain;">
                                        @endif
                                    @endif
                                </div>
                                <div class="col-12 mt-2">
                                    @if($sparePart->Label)
                                        <span class="fw-bold" style="font-size: 0.9rem;">{{ $sparePart->Label->title }}</span>
                                    @else
                                        Not Available
                                    @endif
                                    <br>
                                    <small class="text-muted">{{ $sparePart->part_number }}</small>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
                @for ($i = 0; $i < 20; $i++)
                    <div class="card col" x-show="pageLoading" style="height: 250px;">
                        <div class="skeleton-image"></div>
                        <div class="skeleton-text"></div>
                    </div>
                @endfor
            </div>
        </div>
    <input type="hidden" id="hasMorePages" value="{{ $hasMore ? 1 : 0 }}">

    <input type="hidden" id="hasMorePages" value="{{ $hasMore ? 1 : 0 }}">
</div>
