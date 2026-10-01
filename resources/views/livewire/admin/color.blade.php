<div class="carnate-colors-page">

    <style>
        .carnate-colors-page {
            --carnate-bg: #f7f8fa;
            --carnate-card: #ffffff;
            --carnate-text: #111827;
            --carnate-muted: #64748b;
            --carnate-border: #e2e8f0;
            --carnate-red: #e53935;
            --carnate-red-dark: #c92f2c;
            --carnate-red-soft: #fff5f5;

            background: var(--carnate-bg);
            min-height: 100%;
            padding: 18px;
            color: var(--carnate-text);
        }

        .carnate-colors-page .page-card {
            background: var(--carnate-card);
            border: 1px solid var(--carnate-border);
            border-radius: 16px;
            box-shadow: 0 4px 18px rgba(15, 23, 42, .04);
            overflow: hidden;
        }

        .carnate-colors-page .page-header {
            padding: 20px 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .carnate-colors-page .title-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .carnate-colors-page .title-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: var(--carnate-red-soft);
            color: var(--carnate-red);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 21px;
        }

        .carnate-colors-page .page-title {
            margin: 0;
            font-size: 20px;
            font-weight: 700;
            color: var(--carnate-text);
        }

        .carnate-colors-page .page-subtitle {
            margin: 4px 0 0;
            color: var(--carnate-muted);
            font-size: 13px;
        }

        .carnate-colors-page .add-btn {
            min-height: 40px;
            padding: 0 16px;
            border: 0;
            border-radius: 9px;
            background: var(--carnate-red);
            color: #fff;
            font-size: 13px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            text-decoration: none;
            transition: .2s ease;
        }

        .carnate-colors-page .add-btn:hover {
            background: var(--carnate-red-dark);
            color: #fff;
            transform: translateY(-1px);
        }

        .carnate-colors-page .success-alert {
            margin-bottom: 16px;
            border: 1px solid #bbf7d0;
            background: #f0fdf4;
            color: #166534;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 13px;
        }

        .carnate-colors-page .table-card {
            margin-top: 18px;
            background: var(--carnate-card);
            border: 1px solid var(--carnate-border);
            border-radius: 16px;
            box-shadow: 0 4px 18px rgba(15, 23, 42, .04);
            overflow: hidden;
        }

        .carnate-colors-page .table-heading {
            padding: 17px 20px;
            border-bottom: 1px solid var(--carnate-border);
        }

        .carnate-colors-page .table-heading h5 {
            margin: 0;
            font-size: 15px;
            font-weight: 700;
            color: var(--carnate-text);
        }

        .carnate-colors-page .table-heading p {
            margin: 3px 0 0;
            color: var(--carnate-muted);
            font-size: 12px;
        }

        .carnate-colors-page .table-responsive {
            overflow-x: auto;
        }

        .carnate-colors-page table {
            min-width: 650px;
        }

        .carnate-colors-page .table thead th {
            background: #f8fafc;
            border-top: 0;
            border-bottom: 1px solid var(--carnate-border);
            color: #64748b;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .035em;
            padding: 13px 17px;
            white-space: nowrap;
        }

        .carnate-colors-page .table tbody td {
            padding: 14px 17px;
            border-color: #eef2f7;
            color: var(--carnate-text);
            font-size: 13px;
            vertical-align: middle;
        }

        .carnate-colors-page .table tbody tr {
            transition: .15s ease;
        }

        .carnate-colors-page .table tbody tr:hover {
            background: #fafafa;
        }

        .carnate-colors-page .serial {
            color: #94a3b8;
            font-weight: 600;
        }

        .carnate-colors-page .color-name {
            font-weight: 650;
            color: var(--carnate-text);
        }

        .carnate-colors-page .color-preview {
            display: inline-flex;
            align-items: center;
            gap: 9px;
        }

        .carnate-colors-page .color-dot {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            border: 1px solid #dbe2ea;
            background: #f1f5f9;
            display: inline-block;
            box-shadow: inset 0 0 0 1px rgba(255,255,255,.4);
        }

        .carnate-colors-page .color-value {
            color: #64748b;
            font-size: 12px;
            font-weight: 500;
        }

        .carnate-colors-page .actions {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 7px;
        }

        .carnate-colors-page .action-btn {
            width: 34px;
            height: 34px;
            border: 1px solid var(--carnate-border);
            border-radius: 9px;
            background: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: .2s ease;
        }

        .carnate-colors-page .edit-btn {
            color: #475569;
        }

        .carnate-colors-page .edit-btn:hover {
            color: var(--carnate-red);
            background: var(--carnate-red-soft);
            border-color: rgba(229,57,53,.18);
        }

        .carnate-colors-page .delete-btn {
            color: #64748b;
        }

        .carnate-colors-page .delete-btn:hover {
            color: #dc2626;
            background: #fef2f2;
            border-color: #fecaca;
        }

        .carnate-colors-page .pagination-wrapper {
            padding: 14px 18px;
            border-top: 1px solid var(--carnate-border);
        }

        .carnate-colors-page .pagination-wrapper nav {
            margin: 0;
        }

        .carnate-colors-page .empty-state {
            padding: 50px 20px;
            text-align: center;
        }

        .carnate-colors-page .empty-icon {
            width: 52px;
            height: 52px;
            margin: 0 auto 12px;
            border-radius: 13px;
            background: #f1f5f9;
            color: #94a3b8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .carnate-colors-page .empty-title {
            margin: 0 0 4px;
            color: #475569;
            font-size: 14px;
            font-weight: 700;
        }

        .carnate-colors-page .empty-text {
            margin: 0;
            color: #94a3b8;
            font-size: 12px;
        }

        @media (max-width: 767px) {
            .carnate-colors-page {
                padding: 12px;
            }

            .carnate-colors-page .page-header {
                padding: 16px;
                align-items: flex-start;
            }

            .carnate-colors-page .add-btn {
                width: 100%;
            }

            .carnate-colors-page .page-header {
                flex-direction: column;
            }
        }
    </style>

    {{-- Success Message --}}
    @if (session()->has('message'))
        <div class="success-alert">
            <i class="bx bx-check-circle me-1"></i>
            {{ session('message') }}
        </div>
    @endif

    {{-- Header --}}
    <div class="page-card">
        <div class="page-header">

            <div class="title-wrap">
                <div class="title-icon">
                    <i class="bx bx-palette"></i>
                </div>

                <div>
                    <h4 class="page-title">Colors</h4>
                    <p class="page-subtitle">
                        Manage the available colors in your system.
                    </p>
                </div>
            </div>

            <a
                href="javascript:;"
                wire:click="create"
                class="add-btn"
            >
                <i class="bx bx-plus"></i>
                Add
            </a>

        </div>
    </div>

    {{-- Colors Table --}}
    <div class="table-card">

        <div class="table-heading">
            <h5>Color List</h5>
            <p>View and manage all configured colors.</p>
        </div>

        @if (!empty($colors) && $colors->count())

            <div class="table-responsive">

                <table class="table align-middle mb-0">

                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Name</th>
                            <th>Color</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($colors as $index => $color)

                            <tr>

                                <td class="serial">
                                    {{ $colors->total() - ($colors->firstItem() + $index) + 1 }}
                                </td>

                                <td>
                                    <span class="color-name">
                                        {{ $color->color }}
                                    </span>
                                </td>

                                <td>
                                    <div class="color-preview">
                                        <span
                                            class="color-dot"
                                            style="background-color: {{ $color->color }};"
                                        ></span>

                                        <span class="color-value">
                                            {{ $color->color }}
                                        </span>
                                    </div>
                                </td>

                                <td>
                                    <div class="actions">

                                        <a
                                            href="javascript:;"
                                            wire:click="edit({{ $color->id }})"
                                            class="action-btn edit-btn"
                                            title="Edit"
                                        >
                                            <i class="bx bx-edit-alt"></i>
                                        </a>

                                        <a
                                            href="javascript:;"
                                            wire:click="confirmDelete({{ $color->id }})"
                                            class="action-btn delete-btn"
                                            title="Delete"
                                        >
                                            <i class="bx bx-trash"></i>
                                        </a>

                                    </div>
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            <div class="pagination-wrapper">
                {{ $colors->links() }}
            </div>

        @else

            <div class="empty-state">

                <div class="empty-icon">
                    <i class="bx bx-palette"></i>
                </div>

                <h5 class="empty-title">
                    No Colors Found
                </h5>

                <p class="empty-text">
                    Add a color to start building your color list.
                </p>

            </div>

        @endif

    </div>

</div>

@section('footerscript')
@endsection