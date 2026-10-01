<div class="carnate-unit-page">

    @php
        $sparePart = App\Models\SparePartVendor::where('id', $sparepartId)->first();
    @endphp

    {{-- Success Message --}}
    @if (session()->has('message'))
        <div class="carnate-alert-success">
            <i class="bx bx-check-circle"></i>
            <span>{{ session('message') }}</span>
        </div>
    @endif

    {{-- Add / Edit Modal --}}
    <div class="carnate-modal @if ($showModal) is-visible @endif"
        style="display: @if ($showModal) flex @else none @endif;">

        <div class="carnate-modal-dialog">
            <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">

                <div class="carnate-modal-header">
                    <div>
                        <span class="carnate-modal-eyebrow">
                            Unit Management
                        </span>
                        <h4>{{ $isEdit ? 'Edit Unit' : 'Create Unit' }}</h4>
                    </div>

                    <button type="button"
                        class="carnate-modal-close"
                        wire:click="closeModal"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="bx bx-x"></i>
                    </button>
                </div>

                <div class="carnate-modal-body">
                    @csrf

                    <div class="carnate-form-group">
                        <label>
                            Title
                            <span>*</span>
                        </label>

                        <input type="text"
                            wire:model="title"
                            class="carnate-input"
                            placeholder="Enter unit title">

                        @error('title')
                            <span class="carnate-error">
                                <i class="bx bx-error-circle"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="carnate-modal-footer">
                    <button type="button"
                        class="carnate-btn carnate-btn-secondary"
                        wire:click="closeModal"
                        data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit" class="carnate-btn carnate-btn-primary">
                        <i class="bx bx-check"></i>
                        {{ $isEdit ? 'Update Unit' : 'Create Unit' }}
                        <span wire:loading class="carnate-spinner"></span>
                    </button>
                </div>

            </form>
        </div>
    </div>

    {{-- Page Header --}}
    <div class="carnate-page-header">
        <div>
            <span class="carnate-page-eyebrow">Master Data</span>
            <h1>Unit</h1>
            <p>Manage spare part measurement units.</p>
        </div>

        <div class="carnate-page-actions">
            @if (@$sparePart->hasPermissionTo('unit-add'))
                <button type="button"
                    wire:click="create"
                    class="carnate-btn carnate-btn-primary">
                    <i class="bx bx-plus"></i>
                    Add Unit
                </button>
            @endif
        </div>
    </div>

    {{-- Main Content --}}
    <div class="carnate-unit-grid">

        {{-- Unit List --}}
        <div class="carnate-card">

            <div class="carnate-card-header">
                <div>
                    <h3>Unit List</h3>
                    <p>View and manage available units.</p>
                </div>

                <div class="carnate-list-count">
                    {{ !empty($units) ? $units->total() : 0 }}
                    <span>Units</span>
                </div>
            </div>

            <div class="carnate-filter-bar">

                <div class="carnate-search-box">
                    <i class="bx bx-search"></i>
                    <input type="text"
                        placeholder="Search unit..."
                        wire:model.live="searchfilter">
                </div>

                <button type="button"
                    class="carnate-clear-btn"
                    wire:click="resetFilter">
                    <i class="bx bx-reset"></i>
                    Clear
                </button>

            </div>

            @if (!empty($units) && $units->count())

                <div class="carnate-table-wrap">
                    <table class="carnate-table">

                        <thead>
                            <tr>
                                <th class="carnate-col-number">S.No.</th>
                                <th>Title</th>
                                <th class="carnate-col-actions">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($units as $index => $unit)
                                <tr>

                                    <td>
                                        <span class="carnate-index">
                                            {{ $units->total() - ($units->firstItem() + $index) + 1 }}
                                        </span>
                                    </td>

                                    <td>
                                        <div class="carnate-unit-name">
                                            <span class="carnate-unit-icon">
                                                <i class="bx bx-ruler"></i>
                                            </span>

                                            <div>
                                                <strong>{{ $unit->title }}</strong>
                                                <small>Unit</small>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="carnate-actions">

                                            <button type="button"
                                                wire:click="edit({{ $unit->id }})"
                                                class="carnate-action-btn edit"
                                                title="Edit">
                                                <i class="bx bx-edit-alt"></i>
                                            </button>

                                            <button type="button"
                                                wire:click="confirmDelete({{ $unit->id }})"
                                                class="carnate-action-btn delete"
                                                title="Delete">
                                                <i class="bx bx-trash"></i>
                                            </button>

                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

                <div class="carnate-pagination">
                    {{ $units->links() }}
                </div>

            @else

                <div class="carnate-empty-state">
                    <div class="carnate-empty-icon">
                        <i class="bx bx-ruler"></i>
                    </div>

                    <h4>No Units Found</h4>
                    <p>There are no units matching your search.</p>

                    @if (@$sparePart->hasPermissionTo('unit-add'))
                        <button type="button"
                            wire:click="create"
                            class="carnate-btn carnate-btn-primary">
                            <i class="bx bx-plus"></i>
                            Create Unit
                        </button>
                    @endif
                </div>

            @endif

        </div>

        {{-- Desktop Create Unit --}}
        <div class="carnate-create-card">

            <div class="carnate-create-icon">
                <i class="bx bx-ruler"></i>
            </div>

            <div class="carnate-create-heading">
                <span>Quick Create</span>
                <h3>Create Unit</h3>
                <p>Add a new measurement unit for spare parts.</p>
            </div>

            <form wire:submit.prevent="store">

                @csrf

                <div class="carnate-form-group">
                    <label>
                        Title
                        <span>*</span>
                    </label>

                    <input type="text"
                        wire:model="title"
                        class="carnate-input"
                        placeholder="e.g. Piece, Set, Liter">

                    @error('title')
                        <span class="carnate-error">
                            <i class="bx bx-error-circle"></i>
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                @if (@$sparePart->hasPermissionTo('unit-add'))
                    <button type="submit"
                        class="carnate-btn carnate-btn-primary carnate-full-btn">
                        <i class="bx bx-plus"></i>
                        Create Unit
                        <span wire:loading class="carnate-spinner"></span>
                    </button>
                @endif

            </form>

        </div>

    </div>

</div>


@section('footerscript')
    <style>
        .carnate-unit-page {
            --carnate-red: #e53935;
            --carnate-red-soft: #fff5f5;
            --carnate-text: #111827;
            --carnate-muted: #64748b;
            --carnate-border: #e2e8f0;
            --carnate-bg: #f7f8fa;
            --carnate-white: #ffffff;
            --carnate-radius: 16px;

            padding: 24px;
            background: #f7f8fa;
            min-height: calc(100vh - 70px);
            color: var(--carnate-text);
        }

        .carnate-unit-page * {
            box-sizing: border-box;
        }

        /* Alert */
        .carnate-alert-success {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 13px 16px;
            margin-bottom: 20px;
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #15803d;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
        }

        .carnate-alert-success i {
            font-size: 20px;
        }

        /* Header */
        .carnate-page-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 24px;
        }

        .carnate-page-eyebrow {
            display: block;
            margin-bottom: 5px;
            color: var(--carnate-red);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: .12em;
            text-transform: uppercase;
        }

        .carnate-page-header h1 {
            margin: 0;
            font-size: 28px;
            line-height: 1.2;
            font-weight: 750;
            letter-spacing: -.03em;
            color: var(--carnate-text);
        }

        .carnate-page-header p {
            margin: 7px 0 0;
            color: var(--carnate-muted);
            font-size: 14px;
        }

        .carnate-page-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Grid */
        .carnate-unit-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.55fr) minmax(320px, .8fr);
            gap: 20px;
            align-items: start;
        }

        /* Cards */
        .carnate-card,
        .carnate-create-card {
            background: var(--carnate-white);
            border: 1px solid var(--carnate-border);
            border-radius: var(--carnate-radius);
            box-shadow: 0 4px 18px rgba(15, 23, 42, .035);
            overflow: hidden;
        }

        .carnate-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            padding: 20px 22px 16px;
        }

        .carnate-card-header h3,
        .carnate-create-heading h3 {
            margin: 0;
            color: var(--carnate-text);
            font-size: 18px;
            font-weight: 700;
        }

        .carnate-card-header p,
        .carnate-create-heading p {
            margin: 5px 0 0;
            color: var(--carnate-muted);
            font-size: 13px;
        }

        .carnate-list-count {
            min-width: 60px;
            padding: 7px 10px;
            border-radius: 9px;
            background: #f8fafc;
            border: 1px solid var(--carnate-border);
            color: var(--carnate-text);
            text-align: center;
            font-size: 13px;
            font-weight: 700;
        }

        .carnate-list-count span {
            display: block;
            color: var(--carnate-muted);
            font-size: 9px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .06em;
        }

        /* Filter */
        .carnate-filter-bar {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0 22px 18px;
            border-bottom: 1px solid var(--carnate-border);
        }

        .carnate-search-box {
            position: relative;
            flex: 1;
        }

        .carnate-search-box i {
            position: absolute;
            top: 50%;
            left: 13px;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 18px;
        }

        .carnate-search-box input {
            width: 100%;
            height: 42px;
            padding: 0 14px 0 39px;
            border: 1px solid var(--carnate-border);
            border-radius: 10px;
            outline: none;
            background: #fff;
            color: var(--carnate-text);
            font-size: 13px;
            transition: .2s ease;
        }

        .carnate-search-box input:focus,
        .carnate-input:focus {
            border-color: rgba(229, 57, 53, .45);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        .carnate-clear-btn {
            height: 42px;
            padding: 0 15px;
            border: 1px solid var(--carnate-border);
            border-radius: 10px;
            background: #fff;
            color: #475569;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: .2s ease;
        }

        .carnate-clear-btn i {
            margin-right: 4px;
        }

        .carnate-clear-btn:hover {
            border-color: #cbd5e1;
            background: #f8fafc;
        }

        /* Table */
        .carnate-table-wrap {
            overflow-x: auto;
        }

        .carnate-table {
            width: 100%;
            border-collapse: collapse;
        }

        .carnate-table thead th {
            padding: 13px 20px;
            background: #f8fafc;
            border-bottom: 1px solid var(--carnate-border);
            color: #64748b;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: .06em;
            text-align: left;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .carnate-table tbody td {
            padding: 15px 20px;
            border-bottom: 1px solid #edf1f5;
            color: var(--carnate-text);
            font-size: 13px;
            vertical-align: middle;
        }

        .carnate-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-table tbody tr {
            transition: background .15s ease;
        }

        .carnate-table tbody tr:hover {
            background: #fafbfc;
        }

        .carnate-col-number {
            width: 75px;
        }

        .carnate-col-actions {
            width: 100px;
            text-align: right !important;
        }

        .carnate-index {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            border-radius: 8px;
            background: #f1f5f9;
            color: #64748b;
            font-size: 11px;
            font-weight: 700;
        }

        .carnate-unit-name {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .carnate-unit-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            flex: 0 0 38px;
            border-radius: 10px;
            background: var(--carnate-red-soft);
            color: var(--carnate-red);
            font-size: 19px;
        }

        .carnate-unit-name strong {
            display: block;
            font-size: 13px;
            font-weight: 700;
        }

        .carnate-unit-name small {
            display: block;
            margin-top: 2px;
            color: #94a3b8;
            font-size: 11px;
        }

        /* Actions */
        .carnate-actions {
            display: flex;
            justify-content: flex-end;
            gap: 6px;
        }

        .carnate-action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            padding: 0;
            border: 1px solid var(--carnate-border);
            border-radius: 9px;
            background: #fff;
            color: #64748b;
            cursor: pointer;
            transition: .2s ease;
        }

        .carnate-action-btn i {
            font-size: 16px;
        }

        .carnate-action-btn.edit:hover {
            border-color: rgba(229, 57, 53, .2);
            background: var(--carnate-red-soft);
            color: var(--carnate-red);
        }

        .carnate-action-btn.delete:hover {
            border-color: #fecaca;
            background: #fef2f2;
            color: #dc2626;
        }

        /* Pagination */
        .carnate-pagination {
            padding: 16px 20px;
            border-top: 1px solid var(--carnate-border);
        }

        .carnate-pagination nav {
            margin: 0;
        }

        /* Create Card */
        .carnate-create-card {
            padding: 24px;
        }

        .carnate-create-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            margin-bottom: 16px;
            border-radius: 13px;
            background: var(--carnate-red-soft);
            color: var(--carnate-red);
            font-size: 24px;
        }

        .carnate-create-heading {
            margin-bottom: 24px;
        }

        .carnate-create-heading > span {
            display: block;
            margin-bottom: 4px;
            color: var(--carnate-red);
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .1em;
            text-transform: uppercase;
        }

        .carnate-form-group {
            margin-bottom: 18px;
        }

        .carnate-form-group label {
            display: block;
            margin-bottom: 7px;
            color: #334155;
            font-size: 13px;
            font-weight: 700;
        }

        .carnate-form-group label span {
            color: var(--carnate-red);
        }

        .carnate-input {
            width: 100%;
            min-height: 44px;
            padding: 10px 13px;
            border: 1px solid var(--carnate-border);
            border-radius: 10px;
            outline: none;
            background: #fff;
            color: var(--carnate-text);
            font-size: 13px;
            transition: .2s ease;
        }

        .carnate-input::placeholder {
            color: #94a3b8;
        }

        .carnate-error {
            display: flex;
            align-items: center;
            gap: 5px;
            margin-top: 6px;
            color: #dc2626;
            font-size: 12px;
        }

        .carnate-full-btn {
            width: 100%;
        }

        /* Buttons */
        .carnate-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            min-height: 42px;
            padding: 0 17px;
            border: 0;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s ease;
        }

        .carnate-btn-primary {
            background: var(--carnate-red);
            color: #fff;
            box-shadow: 0 5px 12px rgba(229, 57, 53, .14);
        }

        .carnate-btn-primary:hover {
            background: #d8322f;
            color: #fff;
            transform: translateY(-1px);
        }

        .carnate-btn-secondary {
            background: #f1f5f9;
            color: #475569;
        }

        .carnate-btn-secondary:hover {
            background: #e2e8f0;
        }

        .carnate-spinner {
            width: 14px;
            height: 14px;
            margin-left: 2px;
            border: 2px solid rgba(255, 255, 255, .45);
            border-top-color: #fff;
            border-radius: 50%;
            animation: carnateSpin .65s linear infinite;
        }

        @keyframes carnateSpin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Modal */
        .carnate-modal {
            position: fixed;
            inset: 0;
            z-index: 9999;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: rgba(15, 23, 42, .52);
            backdrop-filter: blur(3px);
        }

        .carnate-modal.is-visible {
            display: flex;
        }

        .carnate-modal-dialog {
            width: 100%;
            max-width: 560px;
            background: #fff;
            border: 1px solid var(--carnate-border);
            border-radius: 18px;
            box-shadow: 0 24px 70px rgba(15, 23, 42, .18);
            overflow: hidden;
            animation: carnateModalIn .18s ease-out;
        }

        @keyframes carnateModalIn {
            from {
                opacity: 0;
                transform: translateY(8px) scale(.985);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .carnate-modal-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 15px;
            padding: 20px 22px;
            border-bottom: 1px solid var(--carnate-border);
        }

        .carnate-modal-eyebrow {
            display: block;
            margin-bottom: 4px;
            color: var(--carnate-red);
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .1em;
            text-transform: uppercase;
        }

        .carnate-modal-header h4 {
            margin: 0;
            color: var(--carnate-text);
            font-size: 18px;
            font-weight: 750;
        }

        .carnate-modal-close {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            padding: 0;
            border: 0;
            border-radius: 9px;
            background: #f1f5f9;
            color: #64748b;
            cursor: pointer;
            transition: .2s ease;
        }

        .carnate-modal-close:hover {
            background: #fee2e2;
            color: var(--carnate-red);
        }

        .carnate-modal-close i {
            font-size: 20px;
        }

        .carnate-modal-body {
            padding: 22px;
        }

        .carnate-modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 9px;
            padding: 16px 22px;
            border-top: 1px solid var(--carnate-border);
            background: #fafbfc;
        }

        /* Empty */
        .carnate-empty-state {
            display: flex;
            align-items: center;
            flex-direction: column;
            padding: 55px 20px;
            text-align: center;
        }

        .carnate-empty-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            margin-bottom: 14px;
            border-radius: 16px;
            background: #f1f5f9;
            color: #94a3b8;
            font-size: 28px;
        }

        .carnate-empty-state h4 {
            margin: 0;
            color: var(--carnate-text);
            font-size: 16px;
            font-weight: 700;
        }

        .carnate-empty-state p {
            margin: 6px 0 18px;
            color: var(--carnate-muted);
            font-size: 13px;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .carnate-unit-grid {
                grid-template-columns: 1fr;
            }

            .carnate-create-card {
                display: none;
            }
        }

        @media (max-width: 767px) {
            .carnate-unit-page {
                padding: 16px;
            }

            .carnate-page-header {
                align-items: flex-start;
            }

            .carnate-page-header h1 {
                font-size: 23px;
            }

            .carnate-page-header p {
                font-size: 12px;
            }

            .carnate-page-actions {
                flex-shrink: 0;
            }

            .carnate-page-actions .carnate-btn {
                padding: 0 13px;
            }

            .carnate-card-header {
                padding: 17px;
            }

            .carnate-filter-bar {
                padding: 0 17px 15px;
            }

            .carnate-table thead th,
            .carnate-table tbody td {
                padding-left: 14px;
                padding-right: 14px;
            }

            .carnate-col-number {
                width: 60px;
            }

            .carnate-list-count {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .carnate-page-header {
                display: block;
            }

            .carnate-page-actions {
                margin-top: 15px;
            }

            .carnate-page-actions .carnate-btn {
                width: 100%;
            }

            .carnate-filter-bar {
                align-items: stretch;
                flex-direction: column;
            }

            .carnate-clear-btn {
                width: 100%;
            }

            .carnate-modal {
                padding: 12px;
            }

            .carnate-modal-header,
            .carnate-modal-body {
                padding: 17px;
            }

            .carnate-modal-footer {
                padding: 13px 17px;
            }

            .carnate-modal-footer .carnate-btn {
                flex: 1;
            }
        }
    </style>

    <script>
        document.addEventListener('livewire:init', function() {

            Livewire.hook('morphed', (message, component) => {
                $('.select2').select2().on('change', function(e) {
                    const selectedValues = $(this).val();
                    @this.set(e.target.dataset.property, selectedValues);
                });
            });

        });
    </script>
@endsection