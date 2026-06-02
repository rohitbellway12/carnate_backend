<div>
    <div class="card">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div class="breadcrumb-title pe-2" style="border: none;">
                <a href="{{ route('workshop.vehicle_search') }}">
                    <i class="fa-solid fa-arrow-left"></i>
                    Part
                </a>
            </div>
            <div class="pe-3 cardIcon">
                <a href="{{ route('workshop.cart',$cartOrderId) }}">
                    <i class='bx bxs-cart-alt'></i>
                    <span class="card_counter me-4 text-white">{{ $counterCard }}</span>
                </a>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="row g-0">
            <div class="col-md-4 border-end ">
                @if (!empty($sparePartData->Image->file))
                    <img src="{{ asset($sparePartData->Image->file) }}" alt="Maintenance Service Parts"
                        class="img-fluid h-100">
                @else
                    @if ($sparePartData->spare_part_type == 1)
                        <img src="{{ asset('img/accessory.png') }}" alt="Maintenance Service Parts"
                            class="img-fluid h-100">
                    @elseif($sparePartData->spare_part_type == 2)
                        <img src="{{ asset('img/spareparts.jpg') }}" alt="Maintenance Service Parts"
                            class="img-fluid h-100">
                    @elseif($sparePartData->spare_part_type == 3)
                        <img src="{{ asset('img/tools.jpg') }}" alt="Maintenance Service Parts" class="img-fluid h-100">
                    @else
                        <img src="{{ asset('img/lubricant.jpg') }}" alt="Maintenance Service Parts"
                            class="img-fluid h-100">
                    @endif
                @endif
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h4 class="card-title">{{ $sparePartData->Label->title }}</h4>

                    <div class="mb-3">
                        <span class="price h4">₹ {{ number_format((float) @$sparePartData->price, 2) }}</span>
                        @if(!empty($sparePartData->selling_amount) && $sparePartData->selling_amount > $sparePartData->price)
                            <span class="text-danger fw-semibold fs-5 ms-2" style="text-decoration: line-through;">₹ {{ number_format((float) $sparePartData->selling_amount, 2) }}</span>
                        @endif

                        <!--<span class="text-muted">/Per Peace</span>-->
                        <span class="text-muted">/per {{ $sparePartData->unit->title }}</span>
                    </div>
                    <div class="mb-3">
                        <span class="price text-primary fw-bolder">{{ $sparePartData->stock }} in stock</span>
                    </div>

                    <p class="card-text fs-6">{{ $sparePartData->description }}</p>
                    <dl class="row">
                        @if ($sparePartData->spare_part_type == 2)
                            <dt class="col-sm-3">Part Number#</dt>
                            <dd class="col-sm-9">{{ $sparePartData->part_number }}</dd>
                        @endif
                        <dt class="col-sm-3">Sp Type</dt>
                        <dd class="col-sm-9">
                            @if ($sparePartData->sp_type == 0)
                                New
                            @else
                                Used
                            @endif
                        </dd>

                        <dt class="col-sm-3">Brand</dt>
                        <dd class="col-sm-9">{{ $sparePartData->brand }} </dd>
                    </dl>
                    <hr>
                    <div class="d-flex gap-3 mt-3">
                        <div class="mt-3">
                            <button type="button" class="btn btn-outline-primary" wire:loading.attr="disabled"
                                wire:click="store({{ $sparePartData->id }})">
                                Add to cart<i class='bx bxs-cart-alt'></i>
                            </button>
                        </div>
                        <div class="input-group mt-3" style="width: 111px;">
                          <span class="input-group-text" id="basic-addon1">Qty</span>
                          <input type="number" class="form-control text-center pe-0 @error('increase_stock') is-invalid @enderror"
                                wire:model.change="increase_stock" step="1" min="0"
                                max="{{ $sparePartData->stock }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
