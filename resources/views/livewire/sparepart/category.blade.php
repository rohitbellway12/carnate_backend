<div class="carnate-category-page">

    @if (session()->has('message'))
        <div class="carnate-alert">
            <i class="bx bx-check-circle"></i>
            <span>{{ session('message') }}</span>
        </div>
    @endif

    @php
        $sparePart = App\Models\SparePartVendor::where('id', Auth::guard('sparepart')->user()->id)->first();
        $totalCategories = $categories->total() ?? 0;
    @endphp


    {{-- =========================================================
        CREATE / EDIT MODAL
    ========================================================== --}}
    <div class="modal @if ($showModal) show @endif"
        tabindex="-1"
        style="opacity:1; background-color:#0606068c; display:@if ($showModal) block @endif">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content carnate-modal">

                <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">

                    {{-- Modal Header --}}
                    <div class="carnate-modal-header">

                        <div class="carnate-modal-title-wrap">

                            <div class="carnate-modal-icon">
                                <i class="bx {{ $isEdit ? 'bx-edit' : 'bx-plus' }}"></i>
                            </div>

                            <div>
                                <h5>
                                    {{ $isEdit ? 'Edit Category' : 'Create Category' }}
                                </h5>

                                <span>
                                    {{ $isEdit ? 'Update category details' : 'Add a new product category' }}
                                </span>
                            </div>

                        </div>

                        <button type="button"
                            class="carnate-modal-close"
                            wire:click="closeMdodel"
                            aria-label="Close">
                            <i class="bx bx-x"></i>
                        </button>

                    </div>


                    {{-- Modal Body --}}
                    <div class="carnate-modal-body">

                        <div class="carnate-form-group">

                            <label>
                                Category Name
                                <span>*</span>
                            </label>

                            <div class="carnate-input">

                                <i class="bx bx-category"></i>

                                <input type="text"
                                    wire:model="title"
                                    class="@error('title') is-invalid @enderror"
                                    placeholder="Enter category name">

                            </div>

                            @error('title')
                                <span class="carnate-error">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>


                        <div class="carnate-info">

                            <i class="bx bx-info-circle"></i>

                            <div>
                                <strong>Category information</strong>

                                <p>
                                    Parent categories appear in Parts, Accessory,
                                    Tools & Lubricant dropdowns.
                                </p>
                            </div>

                        </div>

                    </div>


                    {{-- Modal Footer --}}
                    <div class="carnate-modal-footer">

                        <button type="button"
                            class="carnate-btn carnate-btn-light"
                            wire:click="closeMdodel">
                            Cancel
                        </button>

                        <button type="submit"
                            class="carnate-btn carnate-btn-primary">

                            <i class="bx {{ $isEdit ? 'bx-save' : 'bx-plus' }}"></i>

                            {{ $isEdit ? 'Update' : 'Create' }}

                            <span class="spinner-border spinner-border-sm"
                                wire:loading
                                wire:target="{{ $isEdit ? 'update' : 'store' }}">
                            </span>

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}
    <div class="carnate-header">

        <div class="carnate-header-left">

            <div class="carnate-page-icon">
                <i class="bx bx-category-alt"></i>
            </div>

            <div>
                <h2>Product Categories</h2>

                <p>
                    Manage parent categories for inventory items
                </p>
            </div>

        </div>


        <div class="carnate-header-right">

            <div class="carnate-count">
                <strong>{{ $totalCategories }}</strong>
                Categories
            </div>

            @if (@$sparePart->hasPermissionTo('category-add'))

                <button type="button"
                    wire:click="create"
                    class="carnate-btn carnate-btn-primary carnate-mobile-add">

                    <i class="bx bx-plus"></i>
                    Add Category

                </button>

            @endif

        </div>

    </div>


    {{-- =========================================================
        MAIN CONTENT
    ========================================================== --}}
    <div class="carnate-layout">


        {{-- =====================================================
            CATEGORY LIST
        ====================================================== --}}
        <div class="carnate-list-section">


            {{-- Search --}}
            <div class="carnate-search-card">

                <div class="carnate-search">

                    <i class="bx bx-search"></i>

                    <input type="text"
                        placeholder="Search category by name..."
                        wire:model.live="searchfilter">

                </div>


                <button type="button"
                    class="carnate-btn carnate-btn-outline"
                    wire:click="resetFilter">

                    <i class="bx bx-refresh"></i>
                    Reset

                </button>

            </div>


            {{-- Category Table --}}
            <div class="carnate-card">

                <div class="carnate-card-header">

                    <div>

                        <h5>
                            <i class="bx bx-list-ul"></i>
                            Category List
                        </h5>

                        <p>
                            Available product categories
                        </p>

                    </div>

                    <span class="carnate-small-count">
                        {{ $totalCategories }} total
                    </span>

                </div>


                @if (!empty($categories) && $categories->count())

                    <div class="table-responsive">

                        <table class="carnate-table">

                            <thead>

                                <tr>

                                    <th class="number-column">
                                        #
                                    </th>

                                    <th>
                                        Category Name
                                    </th>

                                    <th class="action-column">
                                        Actions
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @foreach ($categories as $index => $category)

                                    <tr>

                                        <td class="number-cell">

                                            {{ $categories->total() - ($categories->firstItem() + $index) + 1 }}

                                        </td>


                                        <td>

                                            <div class="category-info">

                                                <div class="category-icon">
                                                    <i class="bx bx-folder"></i>
                                                </div>

                                                <div>

                                                    <div class="category-name">
                                                        {{ $category->title }}
                                                    </div>

                                                    <div class="category-subtitle">
                                                        Product category
                                                    </div>

                                                </div>

                                            </div>

                                        </td>


                                        <td class="action-cell">

                                            <div class="category-actions">

                                                <button type="button"
                                                    wire:click="edit({{ $category->id }})"
                                                    class="category-action edit"
                                                    title="Edit">

                                                    <i class="bx bx-edit"></i>

                                                </button>


                                                <button type="button"
                                                    wire:click="confirmDelete({{ $category->id }})"
                                                    class="category-action delete"
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


                    {{-- Pagination --}}
                    <div class="carnate-pagination">

                        {{ $categories->links() }}

                    </div>

                @else

                    {{-- Empty State --}}
                    <div class="carnate-empty">

                        <div class="carnate-empty-icon">
                            <i class="bx bx-category"></i>
                        </div>

                        <h5>
                            No categories found
                        </h5>

                        <p>

                            @if ($searchfilter)

                                Try a different search term or reset the filter.

                            @else

                                No product categories have been added yet.

                            @endif

                        </p>


                        @if ($searchfilter)

                            <button type="button"
                                class="carnate-btn carnate-btn-outline"
                                wire:click="resetFilter">

                                <i class="bx bx-refresh"></i>
                                Reset Search

                            </button>

                        @endif

                    </div>

                @endif

            </div>

        </div>


        {{-- =====================================================
            QUICK ADD
        ====================================================== --}}
        <div class="carnate-quick-add">

            <div class="carnate-card">

                <div class="carnate-card-header">

                    <div class="quick-add-title">

                        <div class="quick-add-icon">
                            <i class="bx bx-plus"></i>
                        </div>

                        <div>

                            <h5>
                                Quick Add Category
                            </h5>

                            <p>
                                Create a new category
                            </p>

                        </div>

                    </div>

                </div>


                <div class="carnate-quick-body">

                    <form wire:submit.prevent="store">

                        <div class="carnate-form-group">

                            <label>
                                Category Name
                                <span>*</span>
                            </label>

                            <div class="carnate-input">

                                <i class="bx bx-category"></i>

                                <input type="text"
                                    wire:model="title"
                                    class="@error('title') is-invalid @enderror"
                                    placeholder="Enter category name">

                            </div>

                            @error('title')
                                <span class="carnate-error">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>


                        <div class="carnate-tip">

                            <div class="carnate-tip-title">

                                <i class="bx bx-bulb"></i>

                                Tips

                            </div>

                            <ul>

                                <li>
                                    Use clear names like
                                    <strong>Body</strong> or
                                    <strong>Engine</strong>.
                                </li>

                                <li>
                                    API-synced categories load automatically.
                                </li>

                                <li>
                                    Add custom categories when required.
                                </li>

                            </ul>

                        </div>


                        @if (@$sparePart->hasPermissionTo('category-add'))

                            <button type="submit"
                                class="carnate-create-button">

                                <i class="bx bx-plus-circle"></i>

                                Create Category

                                <span class="spinner-border spinner-border-sm"
                                    wire:loading
                                    wire:target="store">
                                </span>

                            </button>

                        @endif

                    </form>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        STYLES
        IMPORTANT: STYLE IS INSIDE THE SINGLE LIVEWIRE ROOT
    ========================================================== --}}
    <style>

        .carnate-category-page {
            --c-bg: #f7f8fa;
            --c-white: #ffffff;
            --c-text: #111827;
            --c-muted: #64748b;
            --c-border: #e2e8f0;
            --c-red: #e53935;
            --c-red-dark: #cf302d;
            --c-red-soft: #fff5f5;
            --c-icon-bg: #f1f5f9;

            color: var(--c-text);
        }

        .carnate-category-page * {
            box-sizing: border-box;
        }

        /* =========================
           ALERT
        ========================== */

        .carnate-alert {
            display: flex;
            align-items: center;
            gap: 9px;
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #166534;
            border-radius: 10px;
            padding: 12px 15px;
            margin-bottom: 18px;
            font-size: 13px;
            font-weight: 600;
        }

        .carnate-alert i {
            font-size: 19px;
        }


        /* =========================
           PAGE HEADER
        ========================== */

        .carnate-header {
            background: var(--c-white);
            border: 1px solid var(--c-border);
            border-radius: 14px;
            padding: 18px 20px;
            min-height: 82px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(15, 23, 42, .03);
        }

        .carnate-header-left {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .carnate-page-icon {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: var(--c-red-soft);
            color: var(--c-red);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
        }

        .carnate-header h2 {
            margin: 0 0 3px;
            font-size: 21px;
            line-height: 1.2;
            font-weight: 750;
            color: var(--c-text);
        }

        .carnate-header p {
            margin: 0;
            color: var(--c-muted);
            font-size: 12px;
        }

        .carnate-header-right {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .carnate-count {
            padding: 8px 12px;
            border: 1px solid var(--c-border);
            border-radius: 8px;
            background: #f8fafc;
            color: var(--c-muted);
            font-size: 12px;
            white-space: nowrap;
        }

        .carnate-count strong {
            color: var(--c-text);
            margin-right: 3px;
        }


        /* =========================
           BUTTONS
        ========================== */

        .carnate-btn {
            min-height: 40px;
            padding: 9px 15px;
            border-radius: 8px;
            border: 1px solid transparent;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            font-size: 13px;
            font-weight: 650;
            transition: .18s ease;
            cursor: pointer;
        }

        .carnate-btn-primary {
            background: var(--c-red);
            border-color: var(--c-red);
            color: #fff;
            box-shadow: 0 4px 12px rgba(229, 57, 53, .15);
        }

        .carnate-btn-primary:hover {
            background: var(--c-red-dark);
            border-color: var(--c-red-dark);
            color: #fff;
            transform: translateY(-1px);
        }

        .carnate-btn-outline {
            background: #fff;
            border-color: var(--c-border);
            color: #475569;
        }

        .carnate-btn-outline:hover {
            background: #f8fafc;
            color: var(--c-text);
            border-color: #cbd5e1;
        }

        .carnate-btn-light {
            background: #f1f5f9;
            border-color: #f1f5f9;
            color: #475569;
        }

        .carnate-btn-light:hover {
            background: #e2e8f0;
        }


        /* =========================
           MAIN LAYOUT
        ========================== */

        .carnate-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 340px;
            gap: 20px;
            align-items: start;
        }


        /* =========================
           SEARCH
        ========================== */

        .carnate-search-card {
            background: #fff;
            border: 1px solid var(--c-border);
            border-radius: 12px;
            padding: 12px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 2px 8px rgba(15, 23, 42, .025);
        }

        .carnate-search {
            height: 41px;
            flex: 1;
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 0 12px;
            background: #f8fafc;
            border: 1px solid var(--c-border);
            border-radius: 8px;
            transition: .18s ease;
        }

        .carnate-search:focus-within {
            background: #fff;
            border-color: rgba(229, 57, 53, .4);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .06);
        }

        .carnate-search i {
            color: #94a3b8;
            font-size: 18px;
        }

        .carnate-search input {
            width: 100%;
            height: 100%;
            border: 0;
            outline: 0;
            background: transparent;
            box-shadow: none;
            color: var(--c-text);
            font-size: 13px;
        }

        .carnate-search input::placeholder {
            color: #94a3b8;
        }


        /* =========================
           CARD
        ========================== */

        .carnate-card {
            background: #fff;
            border: 1px solid var(--c-border);
            border-radius: 13px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(15, 23, 42, .025);
        }

        .carnate-card-header {
            min-height: 66px;
            padding: 13px 17px;
            border-bottom: 1px solid var(--c-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .carnate-card-header h5 {
            margin: 0 0 3px;
            color: var(--c-text);
            font-size: 14px;
            font-weight: 750;
        }

        .carnate-card-header h5 i {
            color: var(--c-red);
            margin-right: 5px;
        }

        .carnate-card-header p {
            margin: 0;
            color: var(--c-muted);
            font-size: 11px;
        }

        .carnate-small-count {
            padding: 6px 9px;
            background: #f8fafc;
            border: 1px solid var(--c-border);
            border-radius: 7px;
            color: var(--c-muted);
            font-size: 11px;
            white-space: nowrap;
        }


        /* =========================
           TABLE
        ========================== */

        .carnate-table {
            width: 100%;
            min-width: 550px;
            border-collapse: separate;
            border-spacing: 0;
        }

        .carnate-table thead th {
            background: #f8fafc;
            color: #64748b;
            border-bottom: 1px solid var(--c-border);
            padding: 11px 15px;
            font-size: 10px;
            font-weight: 750;
            letter-spacing: .5px;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .carnate-table tbody td {
            padding: 13px 15px;
            border-bottom: 1px solid #edf1f5;
            font-size: 13px;
            vertical-align: middle;
        }

        .carnate-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-table tbody tr:hover {
            background: #fafafa;
        }

        .number-column {
            width: 60px;
        }

        .number-cell {
            color: #94a3b8;
            font-size: 12px !important;
            font-weight: 650;
        }

        .action-column {
            width: 115px;
            text-align: right;
        }

        .action-cell {
            text-align: right;
        }


        /* =========================
           CATEGORY
        ========================== */

        .category-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .category-icon {
            width: 37px;
            height: 37px;
            border-radius: 9px;
            background: var(--c-icon-bg);
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
            flex-shrink: 0;
        }

        .category-name {
            color: #1e293b;
            font-size: 13px;
            font-weight: 700;
        }

        .category-subtitle {
            color: #94a3b8;
            font-size: 10px;
            margin-top: 2px;
        }

        .category-actions {
            display: flex;
            justify-content: flex-end;
            gap: 5px;
        }

        .category-action {
            width: 33px;
            height: 33px;
            border: 1px solid var(--c-border);
            border-radius: 8px;
            background: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            cursor: pointer;
            transition: .16s ease;
        }

        .category-action.edit {
            color: #64748b;
        }

        .category-action.edit:hover {
            color: var(--c-red);
            background: var(--c-red-soft);
            border-color: rgba(229, 57, 53, .25);
        }

        .category-action.delete {
            color: #94a3b8;
        }

        .category-action.delete:hover {
            color: #dc2626;
            background: #fef2f2;
            border-color: #fecaca;
        }


        /* =========================
           PAGINATION
        ========================== */

        .carnate-pagination {
            padding: 13px 16px;
            background: #fafbfc;
            border-top: 1px solid var(--c-border);
            overflow-x: auto;
        }


        /* =========================
           EMPTY STATE
        ========================== */

        .carnate-empty {
            padding: 60px 20px;
            text-align: center;
        }

        .carnate-empty-icon {
            width: 68px;
            height: 68px;
            margin: 0 auto 15px;
            border-radius: 16px;
            background: #f8fafc;
            border: 1px solid var(--c-border);
            color: #94a3b8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
        }

        .carnate-empty h5 {
            margin: 0 0 5px;
            color: #334155;
            font-size: 16px;
            font-weight: 750;
        }

        .carnate-empty p {
            margin: 0 auto 16px;
            max-width: 400px;
            color: var(--c-muted);
            font-size: 12px;
            line-height: 1.6;
        }


        /* =========================
           QUICK ADD
        ========================== */

        .carnate-quick-add {
            position: sticky;
            top: 18px;
        }

        .quick-add-title {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .quick-add-icon {
            width: 37px;
            height: 37px;
            border-radius: 9px;
            background: var(--c-red-soft);
            color: var(--c-red);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
        }

        .quick-add-title h5 {
            margin: 0 0 2px;
            font-size: 14px;
        }

        .quick-add-title p {
            margin: 0;
            color: var(--c-muted);
            font-size: 11px;
        }

        .carnate-quick-body {
            padding: 20px;
        }


        /* =========================
           FORM
        ========================== */

        .carnate-form-group {
            margin-bottom: 18px;
        }

        .carnate-form-group label {
            display: block;
            margin-bottom: 7px;
            color: #334155;
            font-size: 12px;
            font-weight: 700;
        }

        .carnate-form-group label span {
            color: var(--c-red);
        }

        .carnate-input {
            height: 43px;
            width: 100%;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 0 12px;
            border: 1px solid var(--c-border);
            border-radius: 8px;
            background: #fff;
            transition: .18s ease;
        }

        .carnate-input:focus-within {
            border-color: rgba(229, 57, 53, .4);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .06);
        }

        .carnate-input i {
            color: #94a3b8;
            font-size: 18px;
            flex-shrink: 0;
        }

        .carnate-input input {
            width: 100%;
            height: 100%;
            border: 0 !important;
            outline: 0 !important;
            box-shadow: none !important;
            background: transparent;
            color: var(--c-text);
            font-size: 13px;
        }

        .carnate-input input::placeholder {
            color: #94a3b8;
        }

        .carnate-error {
            display: block;
            margin-top: 6px;
            color: #dc2626;
            font-size: 11px;
            font-weight: 600;
        }


        /* =========================
           TIPS
        ========================== */

        .carnate-tip {
            padding: 13px;
            margin-bottom: 18px;
            background: #f8fafc;
            border: 1px solid #edf1f5;
            border-radius: 9px;
        }

        .carnate-tip-title {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 8px;
            color: #475569;
            font-size: 12px;
            font-weight: 750;
        }

        .carnate-tip-title i {
            color: #64748b;
            font-size: 17px;
        }

        .carnate-tip ul {
            margin: 0;
            padding-left: 17px;
        }

        .carnate-tip li {
            color: #64748b;
            font-size: 11px;
            line-height: 1.6;
            margin-bottom: 4px;
        }

        .carnate-tip li:last-child {
            margin-bottom: 0;
        }


        /* =========================
           CREATE BUTTON
        ========================== */

        .carnate-create-button {
            width: 100%;
            min-height: 43px;
            border: 0;
            border-radius: 8px;
            background: var(--c-red);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(229, 57, 53, .14);
            transition: .18s ease;
        }

        .carnate-create-button:hover {
            background: var(--c-red-dark);
            transform: translateY(-1px);
        }


        /* =========================
           MODAL
        ========================== */

        .carnate-modal {
            border: 0 !important;
            border-radius: 14px !important;
            overflow: hidden;
            box-shadow: 0 25px 70px rgba(15, 23, 42, .2);
        }

        .carnate-modal-header {
            padding: 17px 19px;
            background: #fff;
            border-bottom: 1px solid var(--c-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .carnate-modal-title-wrap {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .carnate-modal-icon {
            width: 39px;
            height: 39px;
            border-radius: 9px;
            background: var(--c-red-soft);
            color: var(--c-red);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
        }

        .carnate-modal-title-wrap h5 {
            margin: 0 0 2px;
            color: var(--c-text);
            font-size: 15px;
            font-weight: 750;
        }

        .carnate-modal-title-wrap span {
            color: var(--c-muted);
            font-size: 11px;
        }

        .carnate-modal-close {
            width: 33px;
            height: 33px;
            border: 1px solid var(--c-border);
            border-radius: 8px;
            background: #fff;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
            cursor: pointer;
        }

        .carnate-modal-close:hover {
            background: var(--c-red-soft);
            color: var(--c-red);
            border-color: rgba(229, 57, 53, .2);
        }

        .carnate-modal-body {
            padding: 21px 19px;
            background: #fff;
        }

        .carnate-info {
            display: flex;
            gap: 9px;
            padding: 12px;
            background: #f8fafc;
            border: 1px solid #edf1f5;
            border-radius: 9px;
        }

        .carnate-info > i {
            color: #64748b;
            font-size: 18px;
            flex-shrink: 0;
        }

        .carnate-info strong {
            display: block;
            color: #334155;
            font-size: 11px;
            margin-bottom: 2px;
        }

        .carnate-info p {
            margin: 0;
            color: var(--c-muted);
            font-size: 11px;
            line-height: 1.5;
        }

        .carnate-modal-footer {
            padding: 13px 19px;
            background: #fafbfc;
            border-top: 1px solid var(--c-border);
            display: flex;
            justify-content: flex-end;
            gap: 8px;
        }


        /* =========================
           RESPONSIVE
        ========================== */

        .carnate-mobile-add {
            display: none;
        }

        @media (max-width: 991px) {

            .carnate-layout {
                grid-template-columns: 1fr;
            }

            .carnate-quick-add {
                display: none;
            }

            .carnate-mobile-add {
                display: inline-flex;
            }

        }


        @media (max-width: 767px) {

            .carnate-header {
                flex-direction: column;
                align-items: flex-start;
                padding: 15px;
            }

            .carnate-header-right {
                width: 100%;
            }

            .carnate-count {
                flex: 1;
            }

            .carnate-mobile-add {
                flex: 1;
            }

            .carnate-search-card {
                flex-direction: column;
                align-items: stretch;
            }

            .carnate-search-card .carnate-btn {
                width: 100%;
            }

            .carnate-table {
                min-width: 540px;
            }

            .carnate-pagination {
                overflow-x: auto;
            }

            .carnate-modal {
                margin: 10px;
            }

        }


        @media (max-width: 480px) {

            .carnate-header h2 {
                font-size: 19px;
            }

            .carnate-page-icon {
                width: 42px;
                height: 42px;
                font-size: 22px;
            }

            .carnate-header-right {
                gap: 6px;
            }

            .carnate-count {
                font-size: 11px;
            }

        }

    </style>

</div>