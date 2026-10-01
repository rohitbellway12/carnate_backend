<div class="carnate-plan-page">

    @php
        $admin = App\Models\Admin::where('id', $adminId)->first();
    @endphp

    <style>
        .carnate-plan-page {
            --cp-bg: #f7f8fa;
            --cp-card: #ffffff;
            --cp-text: #111827;
            --cp-muted: #64748b;
            --cp-border: #e2e8f0;
            --cp-red: #e53935;
            --cp-red-dark: #c92f2c;
            --cp-red-soft: #fff5f5;
            --cp-green: #16a34a;
            --cp-green-soft: #f0fdf4;
            --cp-amber: #d97706;
            --cp-amber-soft: #fffbeb;
        }

        .carnate-plan-page .cp-card {
            background: var(--cp-card);
            border: 1px solid var(--cp-border);
            border-radius: 16px;
            box-shadow: 0 4px 18px rgba(15, 23, 42, .04);
        }

        /* Header */
        .carnate-plan-page .cp-header {
            padding: 20px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .carnate-plan-page .cp-title-wrap {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .carnate-plan-page .cp-title-icon {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: var(--cp-red-soft);
            color: var(--cp-red);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 21px;
        }

        .carnate-plan-page .cp-title {
            margin: 0;
            color: var(--cp-text);
            font-size: 20px;
            line-height: 1.3;
            font-weight: 700;
        }

        .carnate-plan-page .cp-subtitle {
            margin: 4px 0 0;
            color: var(--cp-muted);
            font-size: 13px;
        }

        .carnate-plan-page .cp-primary-btn {
            min-height: 42px;
            padding: 0 18px;
            border: 0;
            border-radius: 10px;
            background: var(--cp-red);
            color: #fff !important;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: .2s ease;
        }

        .carnate-plan-page .cp-primary-btn:hover {
            background: var(--cp-red-dark);
            color: #fff !important;
            transform: translateY(-1px);
            box-shadow: 0 7px 16px rgba(229, 57, 53, .18);
        }

        /* Search */
        .carnate-plan-page .cp-filter {
            margin-top: 16px;
            padding: 18px 20px;
        }

        .carnate-plan-page .cp-filter-row {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .carnate-plan-page .cp-search {
            max-width: 420px;
            flex: 1;
            position: relative;
        }

        .carnate-plan-page .cp-search i {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 18px;
            z-index: 2;
        }

        .carnate-plan-page .cp-search input {
            height: 44px;
            padding-left: 40px;
            border: 1px solid var(--cp-border);
            border-radius: 10px;
            box-shadow: none;
            color: var(--cp-text);
            font-size: 14px;
        }

        .carnate-plan-page .cp-search input:focus {
            border-color: rgba(229, 57, 53, .45);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        .carnate-plan-page .cp-clear-btn {
            height: 44px;
            padding: 0 17px;
            border: 1px solid var(--cp-border);
            border-radius: 10px;
            background: #fff;
            color: var(--cp-muted);
            font-size: 14px;
            font-weight: 600;
            transition: .2s ease;
        }

        .carnate-plan-page .cp-clear-btn:hover {
            background: #f8fafc;
            color: var(--cp-text);
        }

        /* Table */
        .carnate-plan-page .cp-table-card {
            margin-top: 16px;
            overflow: hidden;
        }

        .carnate-plan-page .cp-table-wrap {
            overflow-x: auto;
        }

        .carnate-plan-page .cp-table {
            width: 100%;
            min-width: 950px;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .carnate-plan-page .cp-table thead th {
            padding: 15px 18px;
            background: #f8fafc;
            color: #64748b;
            border-bottom: 1px solid var(--cp-border);
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
            white-space: nowrap;
        }

        .carnate-plan-page .cp-table tbody td {
            padding: 15px 18px;
            border-bottom: 1px solid #edf1f5;
            color: #334155;
            font-size: 14px;
            vertical-align: middle;
            background: #fff;
        }

        .carnate-plan-page .cp-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-plan-page .cp-table tbody tr:hover td {
            background: #fafbfc;
        }

        .carnate-plan-page .cp-sno {
            width: 70px;
            color: #94a3b8 !important;
            font-weight: 600;
        }

        .carnate-plan-page .cp-plan {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .carnate-plan-page .cp-plan-icon {
            width: 38px;
            height: 38px;
            min-width: 38px;
            border-radius: 10px;
            background: var(--cp-red-soft);
            color: var(--cp-red);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .carnate-plan-page .cp-plan-name {
            font-weight: 650;
            color: var(--cp-text);
        }

        .carnate-plan-page .cp-days {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 9px;
            border-radius: 7px;
            background: #f1f5f9;
            color: #475569;
            font-size: 12px;
            font-weight: 600;
        }

        .carnate-plan-page .cp-amount {
            font-size: 14px;
            font-weight: 700;
            color: var(--cp-text);
            white-space: nowrap;
        }

        .carnate-plan-page .cp-description {
            max-width: 300px;
            color: var(--cp-muted);
            line-height: 1.5;
        }

        .carnate-plan-page .cp-actions {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .carnate-plan-page .cp-action {
            width: 34px;
            height: 34px;
            border: 1px solid var(--cp-border);
            border-radius: 9px;
            background: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: .2s ease;
        }

        .carnate-plan-page .cp-edit {
            color: #475569;
        }

        .carnate-plan-page .cp-edit:hover {
            color: var(--cp-red);
            border-color: rgba(229, 57, 53, .25);
            background: var(--cp-red-soft);
        }

        .carnate-plan-page .cp-delete {
            color: #64748b;
        }

        .carnate-plan-page .cp-delete:hover {
            color: #dc2626;
            border-color: #fecaca;
            background: #fef2f2;
        }

        .carnate-plan-page .cp-pagination {
            padding: 17px 20px;
            border-top: 1px solid var(--cp-border);
            background: #fff;
        }

        /* Modal */
        .carnate-plan-page .cp-modal-backdrop {
            position: fixed;
            inset: 0;
            z-index: 1055;
            padding: 20px;
            background: rgba(15, 23, 42, .55);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-y: auto;
        }

        .carnate-plan-page .cp-modal {
            width: 100%;
            max-width: 900px;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 24px 70px rgba(15, 23, 42, .20);
            overflow: hidden;
        }

        .carnate-plan-page .cp-modal-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--cp-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .carnate-plan-page .cp-modal-title-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .carnate-plan-page .cp-modal-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: var(--cp-red-soft);
            color: var(--cp-red);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
        }

        .carnate-plan-page .cp-modal-title {
            margin: 0;
            color: var(--cp-text);
            font-size: 18px;
            font-weight: 700;
        }

        .carnate-plan-page .cp-close {
            width: 36px;
            height: 36px;
            border: 0;
            border-radius: 9px;
            background: #f8fafc;
            color: #64748b;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .carnate-plan-page .cp-close:hover {
            background: #f1f5f9;
            color: var(--cp-text);
        }

        .carnate-plan-page .cp-modal-body {
            padding: 24px;
            max-height: calc(100vh - 190px);
            overflow-y: auto;
        }

        .carnate-plan-page .cp-section {
            padding: 17px;
            border: 1px solid var(--cp-border);
            border-radius: 13px;
            margin-bottom: 18px;
        }

        .carnate-plan-page .cp-section:last-child {
            margin-bottom: 0;
        }

        .carnate-plan-page .cp-section-title {
            margin: 0 0 15px;
            color: var(--cp-text);
            font-size: 13px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .carnate-plan-page .cp-section-title i {
            color: var(--cp-red);
            font-size: 17px;
        }

        .carnate-plan-page .form-label {
            margin-bottom: 7px;
            color: #334155;
            font-size: 13px;
            font-weight: 600;
        }

        .carnate-plan-page .form-control,
        .carnate-plan-page .form-select {
            min-height: 43px;
            border: 1px solid var(--cp-border);
            border-radius: 9px;
            color: var(--cp-text);
            box-shadow: none;
            font-size: 14px;
        }

        .carnate-plan-page textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        .carnate-plan-page .form-control:focus,
        .carnate-plan-page .form-select:focus {
            border-color: rgba(229, 57, 53, .45);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        .carnate-plan-page .cp-required {
            color: var(--cp-red);
        }

        .carnate-plan-page .cp-error {
            display: block;
            margin-top: 5px;
            color: #dc2626;
            font-size: 12px;
        }

        /* Feature builder */
        .carnate-plan-page .cp-feature-header {
            padding: 13px 15px;
            border-radius: 11px;
            background: #f8fafc;
            border: 1px solid var(--cp-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 14px;
        }

        .carnate-plan-page .cp-feature-title {
            display: flex;
            align-items: center;
            gap: 9px;
            color: var(--cp-text);
            font-size: 13px;
            font-weight: 700;
        }

        .carnate-plan-page .cp-feature-title i {
            color: var(--cp-red);
            font-size: 18px;
        }

        .carnate-plan-page .cp-add-feature {
            border: 1px solid rgba(229, 57, 53, .2);
            background: var(--cp-red-soft);
            color: var(--cp-red);
            padding: 7px 12px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .carnate-plan-page .cp-add-feature:hover {
            background: #ffe9e9;
        }

        .carnate-plan-page .cp-feature-row {
            display: flex;
            gap: 10px;
            align-items: flex-start;
            margin-bottom: 12px;
        }

        .carnate-plan-page .cp-feature-input {
            flex: 1;
        }

        .carnate-plan-page .cp-feature-number {
            width: 34px;
            height: 34px;
            min-width: 34px;
            margin-top: 5px;
            border-radius: 8px;
            background: #f1f5f9;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 700;
        }

        .carnate-plan-page .cp-remove-feature {
            width: 34px;
            height: 34px;
            min-width: 34px;
            margin-top: 5px;
            border: 1px solid #fecaca;
            border-radius: 8px;
            background: #fef2f2;
            color: #dc2626;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .carnate-plan-page .cp-remove-feature:hover {
            background: #fee2e2;
        }

        .carnate-plan-page .cp-modal-footer {
            padding: 17px 24px;
            border-top: 1px solid var(--cp-border);
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
        }

        .carnate-plan-page .cp-secondary-btn {
            min-height: 42px;
            padding: 0 17px;
            border: 1px solid var(--cp-border);
            border-radius: 9px;
            background: #fff;
            color: #475569;
            font-size: 14px;
            font-weight: 600;
        }

        .carnate-plan-page .cp-secondary-btn:hover {
            background: #f8fafc;
            color: var(--cp-text);
        }

        /* Empty */
        .carnate-plan-page .cp-empty {
            padding: 55px 20px;
            text-align: center;
        }

        .carnate-plan-page .cp-empty-icon {
            width: 58px;
            height: 58px;
            margin: 0 auto 13px;
            border-radius: 15px;
            background: #f1f5f9;
            color: #94a3b8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 25px;
        }

        .carnate-plan-page .cp-empty-title {
            color: var(--cp-text);
            font-size: 15px;
            font-weight: 700;
        }

        .carnate-plan-page .cp-empty-text {
            margin-top: 5px;
            color: var(--cp-muted);
            font-size: 13px;
        }

        @media (max-width: 767px) {
            .carnate-plan-page .cp-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .carnate-plan-page .cp-primary-btn {
                width: 100%;
            }

            .carnate-plan-page .cp-filter-row {
                flex-direction: column;
                align-items: stretch;
            }

            .carnate-plan-page .cp-search {
                max-width: none;
            }

            .carnate-plan-page .cp-clear-btn {
                width: 100%;
            }

            .carnate-plan-page .cp-modal-backdrop {
                padding: 10px;
                align-items: flex-start;
            }

            .carnate-plan-page .cp-modal-body {
                padding: 16px;
            }

            .carnate-plan-page .cp-feature-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .carnate-plan-page .cp-add-feature {
                width: 100%;
                justify-content: center;
            }
        }
    </style>

    {{-- Success Message --}}
    @if (session()->has('message'))
        <div class="alert alert-success border-0 rounded-3 mb-3">
            <i class="bx bx-check-circle me-1"></i>
            {{ session('message') }}
        </div>
    @endif

    {{-- Add / Edit Modal --}}
    @if ($showModal)
        <div class="cp-modal-backdrop">

            <div class="cp-modal">

                <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">

                    {{-- Modal Header --}}
                    <div class="cp-modal-header">

                        <div class="cp-modal-title-wrap">
                            <div class="cp-modal-icon">
                                <i class="bx bx-package"></i>
                            </div>

                            <h4 class="cp-modal-title">
                                {{ $isEdit ? 'Edit Plan' : 'Create Plan' }}
                            </h4>
                        </div>

                        <button type="button"
                            class="cp-close"
                            wire:click="resetModal"
                            aria-label="Close">
                            <i class="bx bx-x"></i>
                        </button>

                    </div>

                    {{-- Modal Body --}}
                    <div class="cp-modal-body">

                        @csrf

                        {{-- Basic Plan Information --}}
                        <div class="cp-section">

                            <div class="cp-section-title">
                                <i class="bx bx-detail"></i>
                                Plan Information
                            </div>

                            <div class="row g-3">

                                {{-- Plan Name --}}
                                <div class="col-md-6">

                                    <label class="form-label">
                                        Plan Name <span class="cp-required">*</span>
                                    </label>

                                    <input type="text"
                                        wire:model="plan_name"
                                        class="form-control"
                                        placeholder="Enter Plan Name">

                                    @error('plan_name')
                                        <span class="cp-error">{{ $message }}</span>
                                    @enderror

                                </div>

                                {{-- Amount --}}
                                <div class="col-md-6">

                                    <label class="form-label">
                                        Amount <span class="cp-required">*</span>
                                    </label>

                                    <input type="number"
                                        wire:model="amount"
                                        class="form-control"
                                        placeholder="Enter Amount">

                                    @error('amount')
                                        <span class="cp-error">{{ $message }}</span>
                                    @enderror

                                </div>

                                {{-- Days --}}
                                <div class="col-md-6">

                                    <label class="form-label">
                                        Days <span class="cp-required">*</span>
                                    </label>

                                    <input type="number"
                                        wire:model="days"
                                        class="form-control"
                                        placeholder="Enter Days">

                                    @error('days')
                                        <span class="cp-error">{{ $message }}</span>
                                    @enderror

                                </div>

                                {{-- Status --}}
                                <div class="col-md-6">

                                    <label class="form-label">
                                        Status <span class="cp-required">*</span>
                                    </label>

                                    <select class="form-select"
                                        wire:model="status">

                                        <option value="">Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>

                                    </select>

                                    @error('status')
                                        <span class="cp-error">{{ $message }}</span>
                                    @enderror

                                </div>

                            </div>

                        </div>

                        {{-- Plan Features --}}
                        <div class="cp-section">

                            <div class="cp-section-title">
                                <i class="bx bx-list-check"></i>
                                Plan Features
                            </div>

                            <div class="cp-feature-header">

                                <div class="cp-feature-title">
                                    <i class="bx bx-check-square"></i>
                                    Plan Description / Features
                                </div>

                                <button type="button"
                                    wire:click="addField"
                                    class="cp-add-feature">
                                    <i class="bx bx-plus"></i>
                                    Add More
                                </button>

                            </div>

                            @foreach($planDescription as $index => $voice)

                                <div class="cp-feature-row">

                                    <div class="cp-feature-number">
                                        {{ $index + 1 }}
                                    </div>

                                    <div class="cp-feature-input">

                                        <label class="form-label">
                                            Plan Description
                                            <span class="cp-required">*</span>
                                        </label>

                                        <input type="text"
                                            class="form-control"
                                            placeholder="Enter plan feature"
                                            wire:model="planDescription.{{ $index }}">

                                        @error("planDescription.$index")
                                            <span class="cp-error">{{ $message }}</span>
                                        @enderror

                                    </div>

                                    @if($index > 0)

                                        <button type="button"
                                            class="cp-remove-feature"
                                            wire:click="removeField({{ $index }})"
                                            title="Remove feature">
                                            <i class="bx bx-trash"></i>
                                        </button>

                                    @endif

                                </div>

                            @endforeach

                        </div>

                        {{-- Description --}}
                        <div class="cp-section">

                            <div class="cp-section-title">
                                <i class="bx bx-align-left"></i>
                                Plan Description
                            </div>

                            <label class="form-label">
                                Description <span class="cp-required">*</span>
                            </label>

                            <textarea wire:model="description"
                                class="form-control"
                                placeholder="Enter Description"></textarea>

                            @error('description')
                                <span class="cp-error">{{ $message }}</span>
                            @enderror

                        </div>

                    </div>

                    {{-- Footer --}}
                    <div class="cp-modal-footer">

                        <button type="button"
                            class="cp-secondary-btn"
                            wire:click="resetModal">
                            Cancel
                        </button>

                        <button type="submit"
                            class="cp-primary-btn">

                            {{ $isEdit ? 'Update' : 'Create' }}

                            <i class="spinner-border spinner-border-sm"
                                wire:loading></i>

                        </button>

                    </div>

                </form>

            </div>

        </div>
    @endif


    {{-- Page Header --}}
    <div class="cp-card cp-header">

        <div class="cp-title-wrap">

            <div class="cp-title-icon">
                <i class="bx bx-package"></i>
            </div>

            <div>
                <h1 class="cp-title">Plans</h1>

                <p class="cp-subtitle">
                    Manage subscription plans, pricing and features
                </p>
            </div>

        </div>

        @if (@$admin->hasPermissionTo('plan-add'))

            <button type="button"
                wire:click="create"
                class="cp-primary-btn">

                <i class="bx bx-plus"></i>
                Add Plan

            </button>

        @endif

    </div>


    {{-- Search --}}
    <div class="cp-card cp-filter">

        <div class="cp-filter-row">

            <div class="cp-search">

                <i class="bx bx-search"></i>

                <input type="text"
                    class="form-control"
                    placeholder="Search Name, Validity, Description"
                    wire:model.live="searchfilter">

            </div>

            <button type="button"
                class="cp-clear-btn"
                wire:click="resetFilter">

                <i class="bx bx-reset me-1"></i>
                Clear

            </button>

        </div>

    </div>


    {{-- Plans Table --}}
    <div class="cp-card cp-table-card">

        @if (!empty($items) && $items->count())

            <div class="cp-table-wrap">

                <table class="cp-table">

                    <thead>
                        <tr>

                            <th>S.No.</th>
                            <th>Plan Name</th>
                            <th>Days</th>
                            <th>Amount</th>
                            <th>Description</th>

                            @if (
                                @$admin->hasPermissionTo('plan-edit') ||
                                @$admin->hasPermissionTo('plan-delete')
                            )
                                <th>Actions</th>
                            @endif

                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($items as $index => $item)

                            <tr>

                                {{-- S.No --}}
                                <td class="cp-sno">
                                    {{ $items->total() - ($items->firstItem() + $index) + 1 }}
                                </td>

                                {{-- Plan --}}
                                <td>

                                    <div class="cp-plan">

                                        <div class="cp-plan-icon">
                                            <i class="bx bx-package"></i>
                                        </div>

                                        <div class="cp-plan-name">
                                            {{ $item->plan_name }}
                                        </div>

                                    </div>

                                </td>

                                {{-- Days --}}
                                <td>

                                    <span class="cp-days">
                                        <i class="bx bx-calendar"></i>
                                        {{ $item->days }} Days
                                    </span>

                                </td>

                                {{-- Amount --}}
                                <td>

                                    <span class="cp-amount">
                                        {{ $item->amount }}
                                    </span>

                                </td>

                                {{-- Description --}}
                                <td>

                                    <div class="cp-description">
                                        {{ $item->description }}
                                    </div>

                                </td>

                                {{-- Actions --}}
                                @if (
                                    @$admin->hasPermissionTo('plan-edit') ||
                                    @$admin->hasPermissionTo('plan-delete')
                                )

                                    <td>

                                        <div class="cp-actions">

                                            @if (@$admin->hasPermissionTo('plan-edit'))

                                                <a wire:click="edit({{ $item->id }})"
                                                    class="cp-action cp-edit"
                                                    title="Edit">

                                                    <i class="bx bx-edit-alt"></i>

                                                </a>

                                            @endif

                                            @if (@$admin->hasPermissionTo('plan-delete'))

                                                <a wire:click="confirmDelete({{ $item->id }})"
                                                    class="cp-action cp-delete"
                                                    title="Delete">

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

            <div class="cp-pagination">
                {{ $items->links() }}
            </div>

        @else

            <div class="cp-empty">

                <div class="cp-empty-icon">
                    <i class="bx bx-package"></i>
                </div>

                <div class="cp-empty-title">
                    No Plan found!
                </div>

                <div class="cp-empty-text">
                    Subscription plans will appear here once they are created.
                </div>

            </div>

        @endif

    </div>

</div>


@section('footerscript')

<script>
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
</script>

@endsection