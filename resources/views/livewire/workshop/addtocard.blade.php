<div class="carnate-product-page">

    <style>
        .carnate-product-page {
            --carnate-red: #e53935;
            --carnate-red-hover: #d32f2f;
            --carnate-red-soft: #fff5f5;
            --carnate-red-border: #fecaca;
            --carnate-text: #111827;
            --carnate-muted: #64748b;
            --carnate-border: #e2e8f0;
            --carnate-bg-subtle: #f8fafc;
            --carnate-green: #16a34a;
            --carnate-green-soft: #f0fdf4;
            --carnate-green-border: #bbf7d0;
            color: var(--carnate-text);
        }

        /* ---------------------------------------------------------
           NAV / HEADER BAR
        --------------------------------------------------------- */
        .carnate-nav-card {
            background: #ffffff;
            border: 1px solid var(--carnate-border);
            border-radius: 14px;
            padding: 14px 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(15, 23, 42, 0.03);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .carnate-back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--carnate-muted);
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            padding: 7px 14px;
            border-radius: 9px;
            background: var(--carnate-bg-subtle);
            border: 1px solid var(--carnate-border);
            transition: all 0.2s ease;
        }

        .carnate-back-btn:hover {
            color: var(--carnate-red);
            border-color: var(--carnate-red-border);
            background: var(--carnate-red-soft);
            transform: translateX(-2px);
        }

        .carnate-back-btn i {
            font-size: 16px;
        }

        .carnate-cart-pill {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
            border-radius: 11px;
            background: var(--carnate-red-soft);
            color: var(--carnate-red);
            border: 1px solid var(--carnate-red-border);
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .carnate-cart-pill:hover {
            background: var(--carnate-red);
            color: #ffffff;
            border-color: var(--carnate-red);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(229, 57, 53, 0.25);
        }

        .carnate-cart-pill i {
            font-size: 22px;
        }

        .carnate-cart-counter {
            position: absolute;
            top: -6px;
            right: -6px;
            min-width: 20px;
            height: 20px;
            padding: 0 6px;
            border-radius: 20px;
            background: var(--carnate-red);
            color: #ffffff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: 800;
            line-height: 1;
            box-shadow: 0 2px 5px rgba(229, 57, 53, 0.35);
        }

        /* ---------------------------------------------------------
           MAIN DETAIL CARD
        --------------------------------------------------------- */
        .carnate-detail-card {
            background: #ffffff;
            border: 1px solid var(--carnate-border);
            border-radius: 18px;
            box-shadow: 0 4px 20px rgba(15, 23, 42, 0.04);
            overflow: hidden;
        }

        /* Left Column: Image */
        .carnate-image-wrap {
            padding: 30px;
            background: #fafbfc;
            border-right: 1px solid var(--carnate-border);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 380px;
            height: 100%;
            position: relative;
        }

        .carnate-image-frame {
            width: 100%;
            max-width: 320px;
            height: 320px;
            background: #ffffff;
            border: 1px solid var(--carnate-border);
            border-radius: 16px;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 16px rgba(15, 23, 42, 0.03);
            overflow: hidden;
            position: relative;
        }

        .carnate-image-frame img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        .carnate-image-frame img:hover {
            transform: scale(1.04);
        }

        .carnate-no-image-placeholder {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 8px;
            color: #94a3b8;
            text-align: center;
            width: 100%;
            height: 100%;
        }

        .carnate-no-image-placeholder i {
            font-size: 48px;
            color: #cbd5e1;
        }

        .carnate-no-image-placeholder span {
            font-size: 13px;
            font-weight: 500;
        }

        /* Right Column: Details */
        .carnate-info-wrap {
            padding: 32px 36px;
        }

        .carnate-badge-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 12px;
            flex-wrap: wrap;
        }

        .carnate-type-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 700;
            background: var(--carnate-red-soft);
            color: var(--carnate-red);
            border: 1px solid var(--carnate-red-border);
        }

        .carnate-product-title {
            font-size: 24px;
            font-weight: 750;
            color: var(--carnate-text);
            line-height: 1.35;
            margin: 0 0 16px 0;
            letter-spacing: -0.3px;
        }

        /* Pricing Area */
        .carnate-price-box {
            display: flex;
            align-items: baseline;
            gap: 12px;
            padding: 14px 18px;
            border-radius: 12px;
            background: var(--carnate-bg-subtle);
            border: 1px solid var(--carnate-border);
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .carnate-price-current {
            font-size: 28px;
            font-weight: 800;
            color: var(--carnate-text);
            letter-spacing: -0.5px;
        }

        .carnate-price-strike {
            font-size: 18px;
            color: #94a3b8;
            text-decoration: line-through;
            font-weight: 600;
        }

        .carnate-discount-tag {
            font-size: 12px;
            font-weight: 800;
            padding: 3px 8px;
            border-radius: 6px;
            background: #fee2e2;
            color: var(--carnate-red);
        }

        .carnate-unit-label {
            font-size: 13px;
            color: var(--carnate-muted);
            font-weight: 500;
        }

        .carnate-stock-indicator {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }

        .carnate-stock-indicator.in-stock {
            background: var(--carnate-green-soft);
            color: var(--carnate-green);
            border: 1px solid var(--carnate-green-border);
        }

        .carnate-stock-indicator.out-of-stock {
            background: #fef2f2;
            color: var(--carnate-red);
            border: 1px solid var(--carnate-red-border);
        }

        /* Attribute Spec Grid */
        .carnate-attrs-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 12px;
            margin-bottom: 22px;
        }

        .carnate-attr-item {
            padding: 12px 14px;
            background: #ffffff;
            border: 1px solid var(--carnate-border);
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            gap: 3px;
            transition: all 0.2s ease;
        }

        .carnate-attr-item:hover {
            border-color: #cbd5e1;
            background: #fcfdfd;
        }

        .carnate-attr-name {
            font-size: 11px;
            font-weight: 700;
            color: var(--carnate-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .carnate-attr-value {
            font-size: 14px;
            font-weight: 700;
            color: var(--carnate-text);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Technical Description Box */
        .carnate-specs-container {
            border: 1px solid var(--carnate-border);
            border-radius: 12px;
            background: var(--carnate-bg-subtle);
            overflow: hidden;
            margin-bottom: 24px;
        }

        .carnate-specs-body {
            padding: 14px 16px;
            font-size: 13px;
            line-height: 1.6;
            color: #334155;
            white-space: pre-line;
            max-height: 180px;
            overflow-y: auto;
        }

        /* Purchase Action Box */
        .carnate-actions-card {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 18px;
            background: #ffffff;
            border: 1px solid var(--carnate-border);
            border-radius: 14px;
            box-shadow: 0 2px 10px rgba(15, 23, 42, 0.03);
            margin-top: 20px;
            flex-wrap: wrap;
        }

        /* Stepper */
        .carnate-stepper {
            display: inline-flex;
            align-items: center;
            border: 1px solid var(--carnate-border);
            border-radius: 10px;
            background: #ffffff;
            overflow: hidden;
            height: 46px;
        }

        .carnate-stepper-btn {
            width: 42px;
            height: 100%;
            background: var(--carnate-bg-subtle);
            border: none;
            color: var(--carnate-text);
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.15s ease;
        }

        .carnate-stepper-btn:hover:not(:disabled) {
            background: var(--carnate-red-soft);
            color: var(--carnate-red);
        }

        .carnate-stepper-btn:disabled {
            opacity: 0.45;
            cursor: not-allowed;
        }

        .carnate-stepper-input {
            width: 54px;
            height: 100%;
            border: none;
            border-left: 1px solid var(--carnate-border);
            border-right: 1px solid var(--carnate-border);
            text-align: center;
            font-size: 15px;
            font-weight: 750;
            color: var(--carnate-text);
            outline: none;
            -moz-appearance: textfield;
        }

        .carnate-stepper-input::-webkit-outer-spin-button,
        .carnate-stepper-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Add to Cart Button */
        .carnate-add-btn {
            flex: 1;
            min-width: 180px;
            height: 46px;
            border: none;
            border-radius: 10px;
            background: var(--carnate-red);
            color: #ffffff;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 0.2px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(229, 57, 53, 0.28);
            transition: all 0.2s ease;
        }

        .carnate-add-btn:hover:not(:disabled) {
            background: var(--carnate-red-hover);
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(229, 57, 53, 0.35);
        }

        .carnate-add-btn:disabled {
            background: #cbd5e1;
            box-shadow: none;
            cursor: not-allowed;
            color: #64748b;
        }

        .carnate-add-btn i {
            font-size: 20px;
        }

        @media (max-width: 768px) {
            .carnate-image-wrap {
                border-right: none;
                border-bottom: 1px solid var(--carnate-border);
                min-height: 260px;
                padding: 20px;
            }

            .carnate-image-frame {
                max-width: 240px;
                height: 240px;
            }

            .carnate-info-wrap {
                padding: 24px 20px;
            }

            .carnate-product-title {
                font-size: 20px;
            }

            .carnate-price-current {
                font-size: 24px;
            }

            .carnate-actions-card {
                flex-direction: column;
                align-items: stretch;
            }

            .carnate-stepper {
                width: 100%;
                justify-content: space-between;
            }

            .carnate-stepper-btn {
                flex: 1;
            }

            .carnate-stepper-input {
                flex: 2;
                width: auto;
            }

            .carnate-add-btn {
                width: 100%;
            }
        }
    </style>

    {{-- =========================================================
       TOP NAV / HEADER BAR
    ========================================================= --}}
    <div class="carnate-nav-card">
        <a href="{{ route('workshop.vehicle_search') }}" class="carnate-back-btn">
            <i class="bx bx-arrow-back"></i>
            <span>Back to Store</span>
        </a>

        <a href="{{ route('workshop.cart', $cartOrderId) }}" class="carnate-cart-pill" title="View Cart">
            <i class="bx bx-cart"></i>
            <span class="carnate-cart-counter">{{ $counterCard }}</span>
        </a>
    </div>

    {{-- =========================================================
       MAIN PRODUCT DETAIL CARD
    ========================================================= --}}
    <div class="carnate-detail-card">
        <div class="row g-0">

            {{-- Left Column: Product Image (Only from Database, no static/default images) --}}
            <div class="col-md-5 col-lg-4">
                <div class="carnate-image-wrap">
                    @php
                        $dbImageExists = !empty($sparePartData->Image->file) && file_exists(public_path($sparePartData->Image->file));
                    @endphp

                    <div class="carnate-image-frame">
                        @if ($dbImageExists)
                            <img src="{{ asset($sparePartData->Image->file) }}"
                                 alt="{{ $sparePartData->Label->title ?? $sparePartData->name ?? '' }}"
                                 class="img-fluid"
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div class="carnate-no-image-placeholder" style="display: none;">
                                <i class="bx bx-image"></i>
                                <span>No Image Available</span>
                            </div>
                        @else
                            <div class="carnate-no-image-placeholder">
                                <i class="bx bx-image"></i>
                                <span>No Image Available</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Right Column: Product Information & Purchase Action --}}
            <div class="col-md-7 col-lg-8">
                <div class="carnate-info-wrap">

                    {{-- Badges / Tags (Only if dynamic data exists) --}}
                    <div class="carnate-badge-row">
                        @if (!empty($sparePartData->categorey->name))
                            <span class="carnate-type-badge">
                                <i class="bx bx-purchase-tag-alt"></i>
                                {{ $sparePartData->categorey->name }}
                            </span>
                        @endif

                        @if (isset($sparePartData->stock))
                            <span class="carnate-stock-indicator {{ $sparePartData->stock > 0 ? 'in-stock' : 'out-of-stock' }}">
                                <i class="bx {{ $sparePartData->stock > 0 ? 'bx-check-circle' : 'bx-x-circle' }}"></i>
                                {{ $sparePartData->stock }} in stock
                            </span>
                        @endif
                    </div>

                    {{-- Title (From DB) --}}
                    @if (!empty($sparePartData->Label->title) || !empty($sparePartData->name))
                        <h1 class="carnate-product-title">{{ $sparePartData->Label->title ?? $sparePartData->name }}</h1>
                    @endif

                    {{-- Pricing Area (Only from DB) --}}
                    <div class="carnate-price-box">
                        @if (isset($sparePartData->price))
                            <span class="carnate-price-current">₹{{ number_format((float) $sparePartData->price, 2) }}</span>
                        @endif

                        @if (!empty($sparePartData->selling_amount) && $sparePartData->selling_amount > $sparePartData->price)
                            <span class="carnate-price-strike">₹{{ number_format((float) $sparePartData->selling_amount, 2) }}</span>
                            @php
                                $discountPercent = round((($sparePartData->selling_amount - $sparePartData->price) / $sparePartData->selling_amount) * 100);
                            @endphp
                            @if ($discountPercent > 0)
                                <span class="carnate-discount-tag">-{{ $discountPercent }}% OFF</span>
                            @endif
                        @endif

                        @if (!empty($sparePartData->unit->title))
                            <span class="carnate-unit-label">/ per {{ $sparePartData->unit->title }}</span>
                        @endif
                    </div>

                    {{-- Specifications Grid (Only items with dynamic DB values) --}}
                    @php
                        $hasPartNumber = ($sparePartData->spare_part_type == 2 && !empty($sparePartData->part_number));
                        $hasSpType = isset($sparePartData->sp_type);
                        $hasBrand = !empty($sparePartData->brand);
                        $hasUnit = !empty($sparePartData->unit->title);
                    @endphp

                    @if ($hasPartNumber || $hasSpType || $hasBrand || $hasUnit)
                        <div class="carnate-attrs-grid">
                            @if ($hasPartNumber)
                                <div class="carnate-attr-item">
                                    <span class="carnate-attr-name">Part Number#</span>
                                    <span class="carnate-attr-value">{{ $sparePartData->part_number }}</span>
                                </div>
                            @endif

                            @if ($hasSpType)
                                <div class="carnate-attr-item">
                                    <span class="carnate-attr-name">Sp Type</span>
                                    <span class="carnate-attr-value">{{ $sparePartData->sp_type == 0 ? 'New' : 'Used' }}</span>
                                </div>
                            @endif

                            @if ($hasBrand)
                                <div class="carnate-attr-item">
                                    <span class="carnate-attr-name">Brand</span>
                                    <span class="carnate-attr-value">{{ $sparePartData->brand }}</span>
                                </div>
                            @endif

                            @if ($hasUnit)
                                <div class="carnate-attr-item">
                                    <span class="carnate-attr-name">Unit</span>
                                    <span class="carnate-attr-value">{{ $sparePartData->unit->title }}</span>
                                </div>
                            @endif
                        </div>
                    @endif

                    {{-- Technical Specifications / Description (Only if dynamic data exists) --}}
                    @if (!empty($sparePartData->description))
                        <div class="carnate-specs-container">
                            <div class="carnate-specs-body">{{ $sparePartData->description }}</div>
                        </div>
                    @endif

                    {{-- Purchase Action Box --}}
                    <div class="carnate-actions-card">
                        {{-- Quantity Stepper --}}
                        <div class="carnate-stepper">
                            <button type="button"
                                    class="carnate-stepper-btn"
                                    wire:click="decrementQuantity"
                                    {{ $increase_stock <= 1 ? 'disabled' : '' }}
                                    title="Decrease Quantity">
                                <i class="bx bx-minus"></i>
                            </button>

                            <input type="number"
                                   class="carnate-stepper-input @error('increase_stock') is-invalid @enderror"
                                   wire:model.change="increase_stock"
                                   step="1"
                                   min="1"
                                   max="{{ $sparePartData->stock }}">

                            <button type="button"
                                    class="carnate-stepper-btn"
                                    wire:click="incrementQuantity"
                                    {{ $increase_stock >= $sparePartData->stock ? 'disabled' : '' }}
                                    title="Increase Quantity">
                                <i class="bx bx-plus"></i>
                            </button>
                        </div>

                        {{-- Add to Cart Button --}}
                        <button type="button"
                                class="carnate-add-btn"
                                wire:loading.attr="disabled"
                                wire:click="store({{ $sparePartData->id }})"
                                {{ $sparePartData->stock <= 0 ? 'disabled' : '' }}>
                            <i class="bx bxs-cart-add"></i>
                            <span>Add to Cart</span>
                            <span class="spinner-border spinner-border-sm ms-1" wire:loading wire:target="store"></span>
                        </button>
                    </div>

                    @error('increase_stock')
                        <div class="alert alert-danger py-2 px-3 mt-3 mb-0" style="font-size: 13px; border-radius: 8px;">
                            {{ $message }}
                        </div>
                    @enderror

                </div>
            </div>

        </div>
    </div>

</div>
