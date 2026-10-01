<div class="carnate-jobcard-create">
    <style>
        /* Job card create page — aligned with the current workshop UI. */
        .carnate-jobcard-create {
            --jc-bg: #f7f8fa;
            --jc-card: #fff;
            --jc-text: #111827;
            --jc-muted: #64748b;
            --jc-border: #e2e8f0;
            --jc-red: #e53935;
            --jc-red-soft: #fff5f5;
            color: var(--jc-text);
        }

        .carnate-jobcard-create *, .carnate-jobcard-create *::before, .carnate-jobcard-create *::after { box-sizing: border-box; }
        .carnate-jobcard-create .jc-page { padding: 24px 0 28px; }
        .carnate-jobcard-create .jc-page-header,
        .carnate-jobcard-create .jc-card {
            background: var(--jc-card);
            border: 1px solid var(--jc-border) !important;
            border-radius: 16px !important;
            box-shadow: 0 4px 16px rgba(15, 23, 42, .035);
            overflow: hidden;
        }
        .carnate-jobcard-create .jc-page-header { margin-bottom: 18px; }
        .carnate-jobcard-create .jc-page-header .card-body { padding: 18px 22px; }
        .carnate-jobcard-create .jc-back-link {
            display: inline-flex; align-items: center; gap: 10px; color: var(--jc-text);
            font-size: 18px; font-weight: 700; text-decoration: none;
        }
        .carnate-jobcard-create .jc-back-link:hover { color: var(--jc-red); }
        .carnate-jobcard-create .back-arrow {
            width: 34px; height: 34px; padding: 8px; border-radius: 9px; background: #f1f5f9; object-fit: contain;
        }
        .carnate-jobcard-create .breadcrumb-title { font-size: inherit; font-weight: inherit; }
        .carnate-jobcard-create .ulprofile .input-group-text,
        .carnate-jobcard-create .ulprofile .form-control {
            min-height: 38px; border-color: var(--jc-border); background: #f8fafc !important; color: #475569;
            font-size: 12px; font-weight: 600;
        }
        .carnate-jobcard-create .ulprofile .input-group-text { border-radius: 8px 0 0 8px; }
        .carnate-jobcard-create .ulprofile .form-control { border-radius: 0 8px 8px 0; }
        .carnate-jobcard-create .jc-card { height: 100%; }
        .carnate-jobcard-create .jc-card .card-body { padding: 22px; }
        .carnate-jobcard-create .jc-card-title { color: var(--jc-text); font-size: 16px; font-weight: 700; }
        .carnate-jobcard-create .jc-card hr { margin: 16px 0; border-color: var(--jc-border); opacity: 1; }
        .carnate-jobcard-create .form-label { margin-bottom: 7px; color: #334155; font-size: 12px; font-weight: 650; }
        .carnate-jobcard-create .form-control,
        .carnate-jobcard-create .form-select {
            min-height: 42px; border-color: var(--jc-border); border-radius: 9px; color: var(--jc-text);
            font-size: 13px; box-shadow: none;
        }
        .carnate-jobcard-create .form-control:focus,
        .carnate-jobcard-create .form-select:focus {
            border-color: rgba(229, 57, 53, .5); box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }
        .carnate-jobcard-create .select2-container { flex: 1; min-width: 0; }
        .carnate-jobcard-create .select2-container .select2-selection--single {
            height: 42px !important; border: 1px solid var(--jc-border) !important; border-radius: 9px !important;
        }
        .carnate-jobcard-create .select2-container .select2-selection__rendered { line-height: 40px !important; padding-left: 13px !important; font-size: 13px; }
        .carnate-jobcard-create .select2-container .select2-selection__arrow { height: 40px !important; }

        /* Select2 Dropdown Highlight - Brand Red */
        .select2-dropdown {
            border: 1px solid #e2e8f0 !important;
            border-radius: 10px !important;
            box-shadow: 0 10px 25px rgba(15, 23, 42, .12) !important;
            overflow: hidden !important;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected],
        .select2-container--default .select2-results__option--highlighted,
        .select2-container--default .select2-results__option[aria-selected="true"],
        .select2-container--bootstrap4 .select2-results__option--highlighted,
        .select2-container--bootstrap4 .select2-results__option--highlighted.select2-results__option[aria-selected="true"],
        .select2-container--bootstrap4 .select2-dropdown .select2-results__option[aria-selected="true"],
        .select2-results__option--highlighted,
        .select2-results__option[aria-selected="true"] {
            background-color: var(--jc-red, #e53935) !important;
            color: #ffffff !important;
        }

        .select2-container--default .select2-results__option,
        .select2-container--bootstrap4 .select2-results__option {
            padding: 9px 13px !important;
            font-size: 13px !important;
            font-weight: 500 !important;
            color: #334155;
            transition: background-color .15s ease, color .15s ease;
        }

        .select2-container--default.select2-container--focus .select2-selection--single,
        .select2-container--default.select2-container--open .select2-selection--single,
        .select2-container--bootstrap4.select2-container--focus .select2-selection--single,
        .select2-container--bootstrap4.select2-container--open .select2-selection--single {
            border-color: rgba(229, 57, 53, .65) !important;
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .1) !important;
        }

        .carnate-jobcard-create .jc-add-customer {
            width: 42px; min-width: 42px; height: 42px; padding: 0; border: 1px solid var(--jc-red) !important;
            border-radius: 9px !important; background: var(--jc-red) !important; color: #fff !important; font-size: 20px;
        }
        .carnate-jobcard-create .jc-add-customer:hover { background: #d93431 !important; border-color: #d93431 !important; }
        .carnate-jobcard-create .info-table { margin: 16px 0 0; border: 1px solid var(--jc-border); border-radius: 10px; overflow: hidden; }
        .carnate-jobcard-create .info-table td { padding: 9px 10px !important; border-color: var(--jc-border) !important; color: #475569; font-size: 12px; }
        .carnate-jobcard-create .info-table td b { color: #334155; }
        .carnate-jobcard-create .form-floating > label { color: var(--jc-muted); font-size: 12px; }
        .carnate-jobcard-create .jc-history-btn { border: 1px solid #bfdbfe; border-radius: 8px; background: #eff6ff; color: #2563eb; font-weight: 650; }
        .carnate-jobcard-create .jc-inspection-actions { gap: 8px; margin-top: 15px; }
        .carnate-jobcard-create .jc-inspection-actions > a {
            flex: 1; min-width: 76px; align-items: center; border: 1px solid var(--jc-border); border-radius: 10px;
            background: #fafbfc; color: #334155; text-decoration: none; transition: border-color .2s, transform .2s;
        }
        .carnate-jobcard-create .jc-inspection-actions > a:hover { border-color: rgba(229, 57, 53, .4); transform: translateY(-1px); }
        .carnate-jobcard-create .jc-inspection-actions img { width: 52px !important; height: 52px; border-radius: 9px; object-fit: cover; }
        .carnate-jobcard-create .jc-inspection-actions p { font-size: 12px !important; font-weight: 600; }
        .carnate-jobcard-create .list-count { top: 7px; right: 7px; display: inline-flex; align-items: center; justify-content: center; background: var(--jc-red) !important; font-size: 11px; }
        .carnate-jobcard-create .jc-footer { margin-top: 20px; padding: 18px 0; }
        .carnate-jobcard-create .jc-footer .form-check-label { color: #475569; font-size: 13px !important; font-weight: 600; }
        .carnate-jobcard-create .jc-create-btn {
            min-height: 44px; padding: 0 22px; border: 1px solid var(--jc-red) !important; border-radius: 10px !important;
            background: var(--jc-red) !important; color: #fff !important; font-size: 13px; font-weight: 700;
            box-shadow: 0 5px 14px rgba(229, 57, 53, .16);
        }
        .carnate-jobcard-create .jc-create-btn:hover { background: #d93431 !important; border-color: #d93431 !important; transform: translateY(-1px); }
        .carnate-jobcard-create .text-danger { color: var(--jc-red) !important; }
        /* All job-card workflows use the same modal system, including the
           customer, inspection, photo and vehicle-detail popups. */
        .carnate-jobcard-create .modal { z-index: 1060; overflow-y: auto; }
        .carnate-jobcard-create .modal-dialog { margin: 1.75rem auto; }
        .carnate-jobcard-create .modal-content {
            overflow: visible; border: 0; border-radius: 16px;
            box-shadow: 0 20px 50px rgba(15, 23, 42, .18);
        }
        .carnate-jobcard-create .modal-header {
            min-height: 68px; padding: 18px 22px; border-bottom: 1px solid var(--jc-border);
            background: #fff;
        }
        .carnate-jobcard-create .modal-title { color: var(--jc-text); font-size: 18px; font-weight: 700; }
        .carnate-jobcard-create .modal-header .btn { margin: 0 !important; }
        .carnate-jobcard-create .modal-body { padding: 22px !important; background: #fff; }
        .carnate-jobcard-create .modal-footer { padding: 15px 22px; border-top: 1px solid var(--jc-border); background: #fff; }
        .carnate-jobcard-create .modal .btn {
            min-height: 40px; border-radius: 9px; font-size: 13px; font-weight: 650;
            box-shadow: none;
        }
        .carnate-jobcard-create .modal .btn-primary,
        .carnate-jobcard-create .modal .btn-success,
        .carnate-jobcard-create .modal .btn-info {
            border-color: var(--jc-red) !important; background: var(--jc-red) !important; color: #fff !important;
        }
        .carnate-jobcard-create .modal .btn-primary:hover,
        .carnate-jobcard-create .modal .btn-success:hover,
        .carnate-jobcard-create .modal .btn-info:hover { border-color: #d93431 !important; background: #d93431 !important; }
        .carnate-jobcard-create .modal .btn-secondary,
        .carnate-jobcard-create .modal .btn-light {
            border-color: var(--jc-border) !important; background: #fff !important; color: #475569 !important;
        }
        .carnate-jobcard-create .modal .btn-danger { border-color: #fecaca !important; background: var(--jc-red-soft) !important; color: var(--jc-red) !important; }
        .carnate-jobcard-create .modal .card { border: 1px solid var(--jc-border); border-radius: 12px; box-shadow: none; overflow: hidden; }
        .carnate-jobcard-create .modal .card + .card { margin-top: 16px; }
        .carnate-jobcard-create .modal .card-header { padding: 14px 17px; border-bottom: 1px solid var(--jc-border); background: #f8fafc; }
        .carnate-jobcard-create .modal .card-header h5 { margin: 0; color: #334155; font-size: 13px; font-weight: 700; letter-spacing: .02em; }
        .carnate-jobcard-create .modal .card-body { padding: 18px; }
        .carnate-jobcard-create .modal textarea.form-control { min-height: 90px; resize: vertical; }
        .carnate-jobcard-create .modal .input-group-text { border-color: var(--jc-border); background: #f8fafc; color: #475569; font-size: 13px; }
        .carnate-jobcard-create .modal .badge.bg-primary { background: var(--jc-red) !important; border-radius: 8px; font-size: 13px !important; font-weight: 600; }
        .carnate-jobcard-create .modal .list-group { overflow: hidden; border: 1px solid var(--jc-border); border-radius: 9px; box-shadow: 0 8px 20px rgba(15,23,42,.1); }
        .carnate-jobcard-create .modal .list-group-item { padding:11px 13px; border-color: var(--jc-border); color: #475569; font-size: 13px; }
        .carnate-jobcard-create .modal .list-group-item-action:hover { background: var(--jc-red-soft); color: var(--jc-red); }
        .carnate-jobcard-create .modal .list-group { max-height: min(300px, calc(100dvh - 330px)) !important; }
        .carnate-jobcard-create .jc-search-title { margin: 0 0 12px; color: #334155; font-size: 15px; font-weight: 700; text-align: left !important; }
        .carnate-jobcard-create .modal .img-thumbnail { border-color: var(--jc-border); border-radius: 10px; padding: 3px; }
        .carnate-jobcard-create .modal #toggleDetailsBtn { border-color: var(--jc-red); background: var(--jc-red); }
        .carnate-jobcard-create .modal .controls { gap: 8px; padding-bottom: 16px; border-bottom: 1px solid var(--jc-border); }
        .carnate-jobcard-create .modal .controls .btn-group { border: 0 !important; border-radius: 9px !important; overflow: hidden; }
        .carnate-jobcard-create .modal .controls .btn { min-height: 34px; border-radius: 0; }
        .carnate-jobcard-create .modal #dentBtn { border-color: var(--jc-red) !important; background: var(--jc-red) !important; color: #fff; }
        .carnate-jobcard-create .modal #scratchBtn { border-color: #f59e0b !important; background: #fffbeb !important; color: #b45309 !important; }
        .carnate-jobcard-create .modal #breakBtn { border-color: #fecaca !important; background: var(--jc-red-soft) !important; color: var(--jc-red) !important; }
        .carnate-jobcard-create .modal #eraseBtn, .carnate-jobcard-create .modal #clearBtn { border-color: var(--jc-border) !important; background: #f8fafc !important; color: #475569 !important; }
        .carnate-jobcard-create .modal #saveBtn { border-color: var(--jc-red) !important; background: var(--jc-red) !important; color: #fff !important; }
        @media (max-width: 767px) {
            .carnate-jobcard-create .jc-page { padding-top: 16px; }
            .carnate-jobcard-create .jc-page-header .card-body, .carnate-jobcard-create .jc-card .card-body { padding: 17px; }
            .carnate-jobcard-create .jc-page-header nav { gap: 14px; align-items: flex-start !important; }
            .carnate-jobcard-create .jc-inspection-actions > a { min-width: calc(33.333% - 8px); }
            .carnate-jobcard-create .jc-footer .row { gap: 14px; }
            .carnate-jobcard-create .jc-footer .col-auto { width: 100%; }
            .carnate-jobcard-create .jc-create-btn { width: 100%; }
            .carnate-jobcard-create .modal-dialog { margin: .75rem; }
            .carnate-jobcard-create .modal-header, .carnate-jobcard-create .modal-body { padding: 17px !important; }
            .carnate-jobcard-create .modal-footer { padding: 13px 17px; }
        }
    </style>
    <div class="modal @if ($showDentCar) show @endif" tabindex="-1"
        style="opacity: 1; background-color: #0606068c; display: @if ($showDentCar) block @else none @endif;">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                {{-- <form wire:submit.prevent="{{ $showDentCar ? 'saveImage' : 'saveImage' }}"> --}}
                <div class="modal-header d-flex justify-content-between align-items-center">
                    <h5 class="modal-title">Dent Marks</h5>
                    <button type="button" class="btn-close" wire:click="closeModal" aria-label="Close"></button>
                </div>

                @if (!empty($jobCardsDentImage))
                    <img id="carImageTag" src="{{ asset($jobCardsDentImage->Image?->file) }}">
                    <div class="row">
                        <div class="col-6 mx-2">
                            <button id="deleteBtn" wire:click="deleteDentImage()"
                                wire:confirm="Are You Sure! This action can't be undone."
                                class="btn btn-danger mt-3 rounded text-white border-white" fdprocessedid="3j5af">
                                Delete Image
                            </button>
                        </div>
                    </div>
                @else
                    <div class="modal-body py-3">
                        <!-- Control Buttons -->

                        <div class="btn-toolbar controls" role="toolbar" aria-label="Toolbar with button groups">
                            <div class="btn-group me-2 border rounded" role="group" aria-label="First group">
                                <button id="dentBtn" class="btn btn-sm btn-warning active">Dent</button>
                                <button id="scratchBtn" class="btn btn-sm btn-success">Scratch</button>
                                <button id="breakBtn" class="btn btn-sm btn-danger">Break</button>
                            </div>
                            <div class="btn-group me-2 border rounded" role="group" aria-label="Second group">
                                <button id="eraseBtn" class="btn btn-sm btn-secondary">Erase</button>
                                <button id="clearBtn" class="btn btn-sm btn-light">Clear All</button>
                            </div>
                            <div class="btn-group border rounded" role="group" aria-label="Third group">
                                <button id="saveBtn" class="btn btn-sm btn-primary">Save Image</button>
                            </div>
                        </div>

                        <!-- Car Image -->
                        <img id="carImageTag" src="{{ asset('assets/dentcar/car.jpg') }}" style="display:none;"
                            alt="Car Image">

                        <!-- Canvas Container -->
                        <div class="canvas-container" style="position: relative;">
                            <!-- Background Canvas -->
                            <canvas id="backgroundCanvas"></canvas>
                            <!-- Overlay Canvas (For Drawing) -->
                            <canvas id="overlayCanvas" style="position: absolute; top: 0; left: 0;"></canvas>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="modal @if ($showModal) show @endif" tabindex="-1"
        style="opacity:1; background-color:#0606068c; display:@if ($showModal) block @endif">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form wire:submit.prevent="{{ $add ? 'storeCustomer' : 'storeCustomer' }}">
                    <div class="modal-header">
                        <h5 class="modal-title">Customer Add</h5>
                        <button type="button" class="btn-close" wire:click="$set('showModal', false)"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-3">
                        @csrf
                        @include('livewire.workshop.jobcard.includes.customer-add-form')
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="$set('showModal', false)"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                            {{ $add ? 'Update' : 'Create' }}
                            <i class="spinner-border spinner-border-sm" wire:loading></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal @if ($showCustomerVoice) show @endif" tabindex="-1"
        style="opacity:1; background-color:#0606068c; display:@if ($showCustomerVoice) block @endif">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form wire:submit.prevent="{{ $add ? 'customerVoice' : 'customerVoice' }}">
                    <div class="modal-header">
                        <div class="d-flex justify-content-between w-100 align-items-center">
                            <h4 class="modal-title">Customer Voice {{ $customerVoiceCount }} </h4>

                            @if ($showCustomerVoiceInput)
                                <p class="btn btn-danger rounded me-4 mb-0 mt-2" wire:click="cancelVoiceField"> Cancel
                                    Voice</p>
                            @else
                                <p class="btn btn-success rounded me-4 mb-0 mt-2" wire:click="addField"> Add New Voice
                                </p>
                            @endif
                        </div>


                        <button type="button" class="btn-close" wire:click="$set('showCustomerVoice', false)"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-3 border-responsive">
                        <div class="row">

                            @if ($showCustomerVoiceInput)
                                <div class="mb-3 col-lg-12 dynamic-field  text-center">
                                    <div class="row align-items-center">
                                        <div class="col-11">
                                            <label for="validationCustom01" class="form-label"
                                                style="font-size:18px;">Customer
                                                Voice</label><br>
                                            <input type="text"
                                                class="form-control  @error('customerVoices') is-invalid @enderror"
                                                placeholder="Customer Voice" wire:model="customerVoiceInpt">

                                        </div>
                                        <div class="col-1 mt-2">
                                            <button type="button"
                                                class="btn btn-info btn-xs p-1 remove-field rounded text-white border-white  mt-3"
                                                wire:click="addCustomerInptVoice"
                                                style="font-size: 12px; width: 27px; height: 30px; display: flex; align-items: center; ">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            @endif

                            <div class="d-flex flex-wrap gap-1">
                                @foreach ($customerVoices as $index => $voice)
                                    @if (!empty($voice))
                                        <div class="">
                                            <span class="badge bg-primary position-relative mb-2 py-1"
                                                style="padding-right: 1.8rem; font-size:19px;">
                                                {{ $voice }}
                                                <a class="btn-close btn-close-white position-absolute"
                                                    style="top: 1px; right: 5px; width: 0.8rem; height: 0.8rem; background: unset; opacity: 1; cursor: pointer;"
                                                    aria-label="Close"
                                                    wire:click="removeCustomerVoice({{ $index }})">
                                                    <i class="fa-solid fa-xmark text-dark"></i>
                                                </a>

                                            </span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            <div class="col-12 position-relative">
                                <!-- Search Input -->
                                <input type="text" class="form-control" placeholder="Search Voice..."
                                    autocomplete="off" id="customerVoiceInput">

                                <!-- Dropdown -->
                                <ul class="list-group position-absolute  mt-1"
                                    style="max-height: 300px; overflow-y: auto; z-index: 999; display: none; width:97.5% !important;"
                                    id="customerVoiceDropdown">
                                    @php
                                        $customersVoiceData = $customerVoicesData->where('is_customer_voice', 1);
                                        if (count($customerVoices) > 1 && !empty($customerVoices[0])) {
                                            $customersVoiceData = $customersVoiceData->whereNotIn(
                                                'customer_voice',
                                                $customerVoices,
                                            );
                                        }
                                    @endphp

                                    @forelse ($customersVoiceData as $voice)
                                        <li class="list-group-item list-group-item-action customer-voice-item"
                                            style="cursor: pointer;"
                                            wire:click="updateSelectedItemsCustomerVoice('{{ $voice->customer_voice }}')">
                                            {{ $voice->customer_voice }}
                                        </li>
                                    @empty
                                        <li class="list-group-item text-muted text-center no-results"
                                            style="display: none;">
                                            No results found
                                        </li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div>
        <div class="modal @if ($showPhoto) show @endif" tabindex="-1"
            style="opacity:1; background-color:#0606068c; display:@if ($showPhoto) block @endif">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form wire:submit.prevent="upload_property">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">{{ $images ? 'Change Photo' : 'Add Photo' }}</h4>
                            <button type="button" class="btn-close" wire:click="$set('showPhoto', false)"
                                data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body py-3">
                            <div class="mb-3">
                                <label for="photos" class="form-label">Car Images</label>

                                <input type="file" class="form-control file-field shadow-sm" id="photos"
                                    wire:model="photos" name="photos[]" multiple accept="image/*" />

                                <!-- Validation Error -->
                                @error('photos')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Preview Selected Images -->
                            @if ($photos)
                                <div class="row g-3">
                                    @foreach ($photos as $image)
                                        <div class="col-lg-3 col-md-4 col-6">
                                            <img src="{{ $image->temporaryUrl() }}" class="img-thumbnail"
                                                alt="Preview" style="width: 100%;height: 200px;object-fit:cover;">
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="row g-3">
                                    @foreach ($images as $image)
                                        <div class="col-lg-3 col-md-4 col-6">
                                            <img src="{{ Storage::url($image->file) }}" class="img-thumbnail"
                                                alt="Preview" style="width: 100%;height: 200px;object-fit:cover;">
                                        </div>
                                    @endforeach
                                </div>

                            @endif
                        </div>

                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" wire:click="$set('showPhoto', false)"
                                wire:loading.attr="disabled" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                                {{ $images ? 'Update' : 'Save' }}
                                <i class="spinner-border spinner-border-sm" wire:loading
                                    wire:loading.attr="disabled"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal @if ($showAccessoriesVoice) show @endif" tabindex="-1"
        style="opacity:1; background-color:#0606068c; display:@if ($showAccessoriesVoice) block @endif">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form wire:submit.prevent="{{ $add ? 'accessoriesVoice' : 'accessoriesVoice' }}">
                    <div class="modal-header">
                        <div class="d-flex justify-content-between w-100 align-items-center">

                            <h4 class="modal-title">{{ $addAccessoriesVoice ? 'Accessories' : 'Accessories' }}
                                {{ $accessariesCount }} </h4>
                            @if ($showAccessoriesInput)
                                <p class="btn btn-danger rounded me-4 mb-0 mt-2" wire:click="cancelAccessoriesField">
                                    Cancel Voice</p>
                            @else
                                <p class="btn btn-success rounded me-4 mb-0 mt-2" wire:click="addAccessorieField"> Add
                                    New</p>
                            @endif
                        </div>
                        <button type="button" class="btn-close" wire:click="$set('showAccessoriesVoice', false)"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-3">
                        <div class="row">

                            @if ($showAccessoriesInput)
                                <div class="mb-3 col-lg-12 dynamic-field  text-center">
                                    <div class="row align-items-center">
                                        <div class="col-11">
                                            <label for="validationCustom01" class="form-label"
                                                style="font-size:18px;">Accessories</label><br>
                                            <input type="text" class="form-control" placeholder="Accessories"
                                                wire:model="accessoriesVoicesInput">

                                        </div>
                                        <div class="col-1 mt-2">
                                            <button type="button"
                                                class="btn btn-info btn-xs p-1 remove-field rounded text-white border-white  mt-3"
                                                wire:click="addAccessoriesInptVoice"
                                                style="font-size: 12px; width: 27px; height: 30px; display: flex; align-items: center; ">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            @endif

                            <div class="d-flex flex-wrap gap-1">
                                @foreach ($accessoriesVoices as $index => $voice)
                                    @if (!empty($voice))
                                        <div class="">
                                            <span class="badge bg-primary position-relative mb-2 py-1"
                                                style="padding-right: 1.8rem; font-size:19px;">
                                                {{ $voice }}
                                                <a class="btn-close btn-close-white position-absolute"
                                                    style="top: 1px; right: 5px; width: 0.8rem; height: 0.8rem; background: unset; opacity: 1; cursor: pointer;"
                                                    aria-label="Close"
                                                    wire:click="removeAccessoriesVoice({{ $index }})">
                                                    <i class="fa-solid fa-xmark text-dark"></i>
                                                </a>

                                            </span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="col-12 position-relative">
                                <!-- Search Input -->
                                <h3 class="jc-search-title">Search Accessories</h3>
                                <input type="text" class="form-control" placeholder="Search Accessory..."
                                    autocomplete="off" wire:model.live="search_accessory" id="accessoryVoiceInput">

                                <!-- Dropdown -->
                                <ul class="list-group position-absolute mt-1"
                                    style="max-height: 300px; overflow-y: auto; z-index: 999; width:97.5% !important;">
                                    @php
                                        $AccessoryVoiceData = $accessoryData->where('is_customer_voice', 2);
                                        if (count($customerVoices) > 1 && !empty($customerVoices[0])) {
                                            $AccessoryVoiceData = $AccessoryVoiceData->whereNotIn(
                                                'customer_voice',
                                                $customerVoices,
                                            );
                                        }

                                        if (!empty($search_accessory)) {
                                            $AccessoryVoiceData = $AccessoryVoiceData->filter(function ($item) use (
                                                $search_accessory,
                                            ) {
                                                return stripos($item->customer_voice, $search_accessory) !== false;
                                            });
                                        }
                                    @endphp

                                    @forelse ($AccessoryVoiceData as $voice)
                                        <li class="list-group-item list-group-item-action" style="cursor: pointer;"
                                            wire:click="updateSelectedItemsAccessoryVoice('{{ $voice->customer_voice }}')">
                                            {{ $voice->customer_voice }}
                                        </li>
                                    @empty
                                        <li class="list-group-item text-muted text-center">Data Not Available</li>
                                    @endforelse
                                </ul>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal @if ($showWorkNote) show @endif" tabindex="-1"
        style="opacity:1; background-color:#0606068c; display:@if ($showWorkNote) block @endif">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form wire:submit.prevent="{{ $add ? 'workVoice' : 'workVoice' }}">
                    <div class="modal-header">
                        <div class="d-flex justify-content-between w-100 align-items-center">

                            <h4 class="modal-title">{{ $addWorkNote ? 'Work Note' : 'Work Note' }}
                                {{ $workNoteCount }} </h4>
                            @if ($showWorkNoteInput)
                                <p class="btn btn-danger rounded me-4 mb-0 mt-2" wire:click="cancelworknewvoice">
                                    Cancel Voice</p>
                            @else
                                <p class="btn btn-success rounded me-4 mb-0 mt-2" wire:click="addWorkField"> Add New
                                </p>
                            @endif
                        </div>
                        <button type="button" class="btn-close" wire:click="$set('showWorkNote', false)"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-3">

                        <div class="row">

                            @if ($showWorkNoteInput)
                                <div class="mb-3 col-lg-12 dynamic-field">
                                    <div class="row">
                                        <div class="col-11">
                                            <label for="validationCustom01" class="form-label">Work Note</label><br>
                                            <input type="text" class="form-control" placeholder="Work Note"
                                                wire:model="workNotInpt">
                                        </div>
                                        <div class="col-1 mt-3">
                                            <button type="button"
                                                class="btn btn-info btn-xs p-1 remove-field rounded text-white border-white  mt-3"
                                                wire:click="addWorkNotInptVoice"
                                                style="font-size: 12px; width: 27px; height: 30px; display: flex; align-items: center; ">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            @endif
                            <div class="d-flex flex-wrap gap-1">
                                @foreach ($workVoices as $index => $voice)
                                    @if (!empty($voice))
                                        <div class="">
                                            <span class="badge bg-primary position-relative mb-2 py-1"
                                                style="padding-right: 1.8rem; font-size:19px;">
                                                {{ $voice }}
                                                <a class="btn-close btn-close-white position-absolute"
                                                    style="top: 1px; right: 5px; width: 0.8rem; height: 0.8rem; background: unset; opacity: 1; cursor: pointer;"
                                                    aria-label="Close"
                                                    wire:click="removeWorkNotVoice({{ $index }})">
                                                    <i class="fa-solid fa-xmark text-dark"></i>
                                                </a>

                                            </span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            <!-- <div class="col-6">
                                <select id="search_work_notes" wire:model="search_work_notes"
                                    class="form-select select2" data-property="search_work_notes"></select>
                            </div> -->
                            <!--<div class="col-12">-->
                            <!--    <div class="my-3 w-100 m-auto">-->
                            <!--        <div class="card bg-light">-->
                            <!--            <div class="card-body pb-2">-->
                            <!--                <p class="text-center"><b>Search Work Note</b></p>-->
                            <!--<input type="text" class="form-control"-->
                            <!--    wire:model.live="search_work_notes" placeholder="Search Work Note...">-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <div class="col-12 position-relative">
                                <!-- Search Input -->
                                <h3 class="jc-search-title">Search Work Note</h3>
                                <input type="text" class="form-control" placeholder="Search Work Note..."
                                    autocomplete="off" wire:model.live="search_work_notes" id="workNoteInput">

                                <!-- Dropdown -->
                                <ul class="list-group position-absolute  mt-1"
                                    style="max-height: 300px; overflow-y: auto; z-index: 999; width:97.5% !important;">
                                    @php
                                        $WorkNotVoiceData = $worknotVoicesData->where('is_customer_voice', 0);

                                        if (count($workVoices) > 1 && !empty($workVoices[0])) {
                                            $WorkNotVoiceData = $WorkNotVoiceData->whereNotIn(
                                                'customer_voice',
                                                $workVoices,
                                            );
                                        }

                                        if (!empty($search_work_notes)) {
                                            $WorkNotVoiceData = $WorkNotVoiceData->filter(function ($item) use (
                                                $search_work_notes,
                                            ) {
                                                return stripos($item->customer_voice, $search_work_notes) !== false;
                                            });
                                        }
                                    @endphp

                                    @forelse ($WorkNotVoiceData as $voice)
                                        <li class="list-group-item list-group-item-action" style="cursor: pointer;"
                                            wire:click="updateSelectedItemsWorkNotesVoice('{{ $voice->customer_voice }}')">
                                            {{ $voice->customer_voice }}
                                        </li>
                                    @empty
                                        <li class="list-group-item text-muted text-center">Data Not Available</li>
                                    @endforelse
                                </ul>
                            </div>


                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('livewire.workshop.jobcard.vehical_modal')


    <div class="py-3 jc-page">
        <div class="card h-100 jc-page-header">
            <div class="card-body">
                <div class="page-title ">
                    <div class="nav_menu">
                        <nav class="d-flex align-items-center justify-content-between flex-wrap">
                            <!-- Navigation Toggle and Back Link -->
                            <div class="nav toggle">
                                <a href="{{ route('workshop.jobcard') }}" class="jc-back-link">
                                    <img src="{{ asset('supplier/Back Arrow.png') }}" class="back-arrow me-2">
                                    <div class="breadcrumb-title pe-2 text-dark" style="border: none;">Add Job-Card
                                    </div>
                                </a>
                            </div>

                            <!-- Job-Card Details -->
                            <div class="ulprofile d-flex flex-wrap">
                                <div class="input-group d-none" style="width: fit-content">
                                    <span class="input-group-text">Job-Card No.</span>
                                    <input type="text" form="jobcard-form" id="jobcard_number"
                                        name="jobcard_number" class="form-control bg-light"
                                        value="{{ $jobcardNumbers }}" readonly placeholder="Job-Card Number"
                                        aria-label="Job-Card Number">
                                </div>
                                <div class="input-group" style="width: fit-content">
                                    <span class="input-group-text">Date</span>
                                    <input type="text" class="form-control bg-light"
                                        value="{{ now()->format('d-m-Y') }}" readonly placeholder="Date">
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        @csrf
        <div class="row g-3">
            <div class="col-lg-6">
                <div class="card h-100 jc-card">
                    <div class="card-body">
                        <div class="text-center">
                            <h6 class="fw-bold m-0 jc-card-title">Search or Create New User</h6>
                        </div>
                        <hr>
                        <label for="customer-dropdown" class="form-label">Customer Name Or Vehicle</label>
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
                                class="btn btn-outline-secondary text-light bg-primary fl margin-left-0 jc-add-customer"
                                wire:click="addCustomer">
                                {{ trans('+') }}
                            </button>
                        </div>
                        @error('customer_name')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                        @if (!empty($customer_data))
                            <style>
                                .info-table td {
                                    border-bottom: 1px solid #e0e0e0;
                                    /* Light grey line */
                                    padding: 6px 8px;
                                    vertical-align: top;
                                }
                            </style>

                            <table class="table table-sm info-table" style="width: 100%;">
                                <tbody>
                                    <tr>
                                        <td style="white-space: nowrap;"><b>Customer</b></td>
                                        <td style="width: 25%;">
                                            {{ $customer_data->cust_type == 1 ? 'M/S ' . ($customer_data->company_name ?? $fullName) : trim(($customer_data->name ?? '') . ' ' . ($customer_data->lastname ?? '')) }}
                                        </td>

                                        <td style="white-space: normal; word-break: break-word;"><b>Vehicle Name &
                                                Color</b>
                                        </td>
                                        <td style="width: 25%;">
                                            @if (!empty($vehicle_data) && !empty($vehicle_data->brand))
                                                {{ $vehicle_data->brand . '/' . $vehicle_data->variant . '/' . $vehicle_data->modification }}
                                                @if (!empty($vehicle_data->vehicle_color))
                                                    ({{ $vehicle_data->vehicle_color }})
                                                @endif
                                            @else
                                                <span class="text-muted">—</span>
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><b>Mobile No.</b></td>
                                        <td>{{ $customer_data->mobile_no ?? '' }}</td>

                                        <td><b>Vehicle No.</b></td>
                                        <td>{{ $vehicle_data->number_plate ?? '' }}</td>
                                    </tr>

                                    <tr>
                                        <td><b>Address</b></td>
                                        <td>{{ $customer_data->address ?? '' }}</td>

                                        <td><b>Chassis No. </b></td>
                                        <td>{{ $vehicle_data->chassis_no ?? '' }} </td>
                                    </tr>

                                    <tr>
                                        <td><b>GST</b></td>
                                        <td>{{ $customer_data->gst_number ?? '' }}</td>

                                        <td><b>Engine No</b></td>
                                        <td>{{ $vehicle_data->engineno ?? '' }}</td>
                                    </tr>

                                    <tr>
                                        <td><b>Pickup Address</b></td>
                                        <td>{{ $vehicle_data->pickup_address ?? '' }}</td>

                                        <td><b>Drop Address</b></td>
                                        <td>{{ $vehicle_data->drop_address ?? '' }}</td>


                                    </tr>

                                    <tr>
                                        <td><b>Driver Name</b></td>
                                        <td>{{ $vehicle_data->driver_name ?? '' }}</td>

                                        <td><b>Driver Number</b></td>
                                        <td>{{ $vehicle_data->driver_number ?? '' }}</td>
                                    </tr>


                                </tbody>
                            </table>
                        @endif

                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card h-100 jc-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="fw-bold m-0 jc-card-title">Job-Card Details</h6>
                            <button type="button" class="btn btn-sm btn-info py-0 jc-history-btn"><small>Last
                                    History</small></button>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-floating mb-3">
                                    <input type="number" wire:model="km_reading" class="form-control"
                                        id="km_reading" value="0" min="0">
                                    <label for="km_reading">KM Reading</label>
                                </div>
                                @error('km_reading')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-4">
                                <label for="fual level" class="form-label">Fuel Level</label>
                                <input type="range" class="form-range" id="fual level" wire:model="fual_level"
                                    min="0" max="100">
                                @error('fual_level')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="col-4">
                                <div class="form-floating">
                                    <select class="form-select" id="supervisor" wire:model="supervisor"
                                        aria-label="Floating label select example">
                                        <option value="">--Attended By--</option>
                                        @foreach ($supervisors as $supervisor)
                                            <option value="{{ $supervisor->id }}">
                                                {{ $supervisor->name . ' ' . $supervisor->lastname }}</option>
                                        @endforeach
                                    </select>
                                    <label for="supervisor">Attended By</label>
                                </div>
                                @error('supervisor')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="d-flex justify-content-between flex-wrap jc-inspection-actions">
                            <a href="javascript:void(0)" wire:click="addVoice"
                                class="text-center p-2 position-relative d-flex flex-column justify-content-between">
                                <img src="{{ asset('assets/jobcard_img/customer_voice2.jpg') }}" alt="image"
                                    width="80">
                                <p class="my-2" style="font-size: 16px;">Customer voice</p>
                                <p class="position-absolute list-count rounded-circle bg-primary text-white  customerVoiceCount"
                                    style="width: 18px !important;height:18px !important;">
                                    {{ $customerVoiceCount }}
                                </p>
                            </a>
                            <a href="javascript:void(0)" wire:click="showDent"
                                class="text-center p-2 position-relative d-flex flex-column justify-content-between">
                                <img src="{{ asset('assets/jobcard_img/dent.jpg') }}" alt="image" width="80">
                                <p class="my-2" style="font-size: 16px;">Dent Marks</p>
                                <p class="position-absolute list-count rounded-circle bg-primary text-white"
                                    style="width: 18px !important;height:18px !important;">
                                    {{ $jobcarddentCount }}
                                </p>
                            </a>
                            <a href="javascript:void(0)" wire:click="addImage"
                                class="text-center p-2 position-relative d-flex flex-column justify-content-between">
                                <img src="{{ asset('assets/jobcard_img/photo.jpg') }}" alt="image"
                                    width="80">
                                <p class="my-2" style="font-size: 16px;">Photos</p>
                                <p class="position-absolute list-count rounded-circle bg-primary text-white jobcardImage"
                                    style="width: 18px !important;height:18px !important;">
                                    {{ $photosCount }}
                                </p>
                            </a>
                            <a href="javascript:void(0)" wire:click="addAccessorie"
                                class="text-center p-2 position-relative d-flex flex-column justify-content-between">
                                <img src="{{ asset('assets/jobcard_img/accessory.jpg') }}" alt="image"
                                    width="80">
                                <p class="my-2" style="font-size: 16px;">Accessories</p>
                                <p class="accessaryCount position-absolute list-count rounded-circle bg-primary text-white"
                                    style="width: 18px !important;height:18px !important;">
                                    {{ $accessariesCount }}
                                </p>
                            </a>
                            <a href="javascript:void(0)" wire:click="addWork"
                                class="text-center p-2 position-relative d-flex flex-column justify-content-between">
                                <img src="{{ asset('assets/jobcard_img/work_note.jpg') }}" alt="image"
                                    width="80">
                                <p class="my-2" style="font-size: 16px;">Work Note</p>
                                <p class="workNoteCount position-absolute list-count rounded-circle bg-primary text-white worknotecount"
                                    style="width: 18px !important;height:18px !important;">
                                    {{ $workNoteCount }}
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <div class="footer align-items-center jc-footer">
        <div class="row">
            <!-- SMS Alert Section -->
            <div class="col-auto">
                <div class="form-check form-switch">
                    <input wire:model="smsAlert" class="form-check-input fs-6" type="checkbox" role="switch"
                        id="sms-alert">
                    <label class="form-check-label fs-5" for="sms-alert">SMS Alert</label>
                </div>
            </div>

            <!-- Create Job-Card Button Section -->
            <div class="col-auto ms-auto">
                <button wire:click="createJobCard" wire:loading.attr="disabled"
                    class="btn btn-primary rounded border-0 text-white jc-create-btn">Create Job
                    Card</button>
            </div>
        </div>
    </div>



</div>


@section('footerscript')
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        document.addEventListener('livewire:init', () => {
            $('#customer_name').select2({
                placeholder: "Select Customer or Vehicle",
                ajax: {
                    url: '/workshop/customers',
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
                            text: `${item.name || ''} ${item.lastname || ''}/${item.mobile_no || ''}/${item.brand || ''}-${item.variant || ''}/${item.modification || item.modification_title}/${item.number_plate || ''}`,
                            // text: `${item.name || ''} ${item.lastname || ''}/${item.mobile_no || ''}/${item.number_plate || ''}`,
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


            $('#search_customer_voice').select2({
                placeholder: "Search Customer Voices",
                ajax: {
                    url: '/workshop/customers-voice',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term,
                            page: params.page || 1,
                        };
                    },
                    processResults: function(data, params) {

                        params.page = params.page || 1;


                        const results = Array.isArray(data.data) ? data.data.map(item => ({
                            id: item.id,
                            text: `${item.customer_voice || ''}`,
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
                @this.set('search_customer_voice', selectedValue);
            });


            $('#search_accessory').select2({
                placeholder: "Search Accessory",
                ajax: {
                    url: '/workshop/accessory',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term,
                            page: params.page || 1,
                        };
                    },
                    processResults: function(data, params) {

                        params.page = params.page || 1;


                        const results = Array.isArray(data.data) ? data.data.map(item => ({
                            id: item.id,
                            text: `${item.customer_voice || ''}`,
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
                @this.set('search_accessory', selectedValue);
            });


            $('#search_vehicle').select2({
                placeholder: "Search Vehicle",
                ajax: {
                    url: '/workshop/vehicle',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term,
                            page: params.page || 1,
                        };
                    },
                    processResults: function(data, params) {

                        params.page = params.page || 1;

                        const results = Array.isArray(data.data) ? data.data.map(item => ({
                            id: item.id,
                            text: `${item.vehicle_details || ''}`,
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
                @this.set('search_vehicle', $(this).val());
            });



            $('#search_work_notes').select2({
                placeholder: "Search Work Notes",
                ajax: {
                    url: '/workshop/worknotes',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term,
                            page: params.page || 1,
                        };
                    },
                    processResults: function(data, params) {

                        params.page = params.page || 1;


                        const results = Array.isArray(data.data) ? data.data.map(item => ({
                            id: item.id,
                            text: `${item.customer_voice || ''}`,
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
                @this.set('search_work_notes', selectedValue);
            });





            Livewire.hook('morphed', (message, component) => {
                $('#customer_name').select2({
                    placeholder: "Select Customer or Vehicle",
                    ajax: {
                        url: '/workshop/customers',
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
                                text: `${item.name || ''} ${item.lastname || ''}/${item.mobile_no || ''}${item.modification || item.modification_title}/${item.number_plate || ''}`,
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

                $('#search_customer_voice').select2({
                    placeholder: "Search Customer Voices",
                    ajax: {
                        url: '/workshop/customers-voice',
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
                                text: `${item.customer_voice || ''}`,
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


                $('#search_accessory').select2({
                    placeholder: "Search Accessory",
                    ajax: {
                        url: '/workshop/accessory',
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
                                text: `${item.customer_voice || ''}`,
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

                $('#search_vehicle').select2({
                    placeholder: "Search Vehicle",
                    ajax: {
                        url: '/workshop/vehicle',
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                search: params.term,
                                page: params.page || 1,
                            };
                        },
                        processResults: function(data, params) {

                            params.page = params.page || 1;


                            const results = Array.isArray(data.data) ? data.data.map(item => ({
                                id: item.id,
                                text: `${item.vehicle_details || ''}`,
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
                    @this.set('search_vehicle', selectedValue);
                });



                $('#search_work_notes').select2({
                    placeholder: "Search Work Notes",
                    ajax: {
                        url: '/workshop/worknotes',
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
                                text: `${item.customer_voice || ''}`,
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

        document.addEventListener('show-dent-modal', () => {

            const modal = document.querySelector('.modal');
            const backgroundCanvas = document.getElementById('backgroundCanvas');
            const overlayCanvas = document.getElementById('overlayCanvas');
            const bgCtx = backgroundCanvas.getContext('2d');
            const overlayCtx = overlayCanvas.getContext('2d');
            const carImageTag = document.getElementById('carImageTag');
            const carImage = new Image();


            // Set the source dynamically using Laravel's `asset()` helper function
            carImage.src = "{{ asset('assets/dentcar/car.jpg') }}"; // This will insert the correct URL

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
                // "key": "{{ env('RAZORPAY_KEY') }}",
                "key": "{{ config('services.razorpay.key') }}",
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
        document.addEventListener('livewire:initialized', () => {
            $(".wrapper").hasClass("toggled") ?
                ($(".wrapper").removeClass("toggled"), $(".sidebar-wrapper").unbind("hover")) :
                ($(".wrapper").addClass("toggled"), $(".sidebar-wrapper").hover(function() {
                    $(".wrapper").addClass("sidebar-hovered")
                }, function() {
                    $(".wrapper").removeClass("sidebar-hovered")
                }));
        })
    </script>
    <!-- JavaScript for live search -->
    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('customerVoiceInput');
            const dropdown = document.getElementById('customerVoiceDropdown');
            const listItems = dropdown.querySelectorAll('.customer-voice-item');
            const emptyMessage = dropdown.querySelector('.no-results');

            function filterDropdown() {
                const filter = input.value.toLowerCase().trim();
                let visibleCount = 0;

                listItems.forEach(item => {
                    const text = item.textContent.toLowerCase();
                    const match = text.includes(filter);

                    item.style.display = match || filter === '' ? '' : 'none';
                    if (match || filter === '') visibleCount++;
                });

                // Show or hide "No results"
                if (visibleCount === 0 && emptyMessage) {
                    emptyMessage.style.display = '';
                } else if (emptyMessage) {
                    emptyMessage.style.display = 'none';
                }

                // Always show dropdown when input is focused
                dropdown.style.display = 'block';
            }

            input.addEventListener('input', filterDropdown);
            input.addEventListener('focus', filterDropdown);

            document.addEventListener('click', function(e) {
                if (!e.target.closest('.position-relative')) {
                    dropdown.style.display = 'none';
                }
            });
        });
    </script>
    <script>
        document.getElementById('toggleDetailsBtn').addEventListener('click', function() {
            const section = document.getElementById('detailsSection');
            const isVisible = section.style.display === 'block';

            section.style.display = isVisible ? 'none' : 'block';
            this.textContent = isVisible ? 'Show Details' : 'Hide Details';
        });
    </script>
@endsection
