<div class="carnate-permissions-page">

    <style>
        .carnate-permissions-page {
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

        .carnate-permissions-page .page-card,
        .carnate-permissions-page .table-card {
            background: var(--carnate-card);
            border: 1px solid var(--carnate-border);
            border-radius: 16px;
            box-shadow: 0 4px 18px rgba(15, 23, 42, .04);
            overflow: hidden;
        }

        .carnate-permissions-page .page-header {
            padding: 20px 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .carnate-permissions-page .title-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .carnate-permissions-page .title-icon {
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

        .carnate-permissions-page .page-title {
            margin: 0;
            font-size: 20px;
            font-weight: 700;
            color: var(--carnate-text);
        }

        .carnate-permissions-page .page-subtitle {
            margin: 4px 0 0;
            color: var(--carnate-muted);
            font-size: 13px;
        }

        .carnate-permissions-page .add-btn {
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

        .carnate-permissions-page .add-btn:hover {
            background: var(--carnate-red-dark);
            color: #fff;
            transform: translateY(-1px);
        }

        .carnate-permissions-page .success-alert {
            margin-bottom: 16px;
            border: 1px solid #bbf7d0;
            background: #f0fdf4;
            color: #166534;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 13px;
        }

        .carnate-permissions-page .table-card {
            margin-top: 18px;
        }

        .carnate-permissions-page .table-heading {
            padding: 17px 20px;
            border-bottom: 1px solid var(--carnate-border);
        }

        .carnate-permissions-page .table-heading h5 {
            margin: 0;
            font-size: 15px;
            font-weight: 700;
        }

        .carnate-permissions-page .table-heading p {
            margin: 3px 0 0;
            color: var(--carnate-muted);
            font-size: 12px;
        }

        .carnate-permissions-page .table-responsive {
            overflow-x: auto;
        }

        .carnate-permissions-page table {
            min-width: 600px;
        }

        .carnate-permissions-page .table thead th {
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

        .carnate-permissions-page .table tbody td {
            padding: 14px 17px;
            border-color: #eef2f7;
            color: var(--carnate-text);
            font-size: 13px;
            vertical-align: middle;
        }

        .carnate-permissions-page .table tbody tr {
            transition: .15s ease;
        }

        .carnate-permissions-page .table tbody tr:hover {
            background: #fafafa;
        }

        .carnate-permissions-page .serial {
            color: #94a3b8;
            font-weight: 600;
        }

        .carnate-permissions-page .permission-name {
            display: inline-flex;
            align-items: center;
            min-height: 30px;
            padding: 5px 10px;
            border-radius: 7px;
            background: #f8fafc;
            border: 1px solid #e5eaf0;
            color: #334155;
            font-size: 12px;
            font-weight: 600;
        }

        .carnate-permissions-page .action-btn {
            width: 34px;
            height: 34px;
            border: 1px solid var(--carnate-border);
            border-radius: 9px;
            background: #fff;
            color: #64748b;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: .2s ease;
        }

        .carnate-permissions-page .action-btn:hover {
            color: #dc2626;
            background: #fef2f2;
            border-color: #fecaca;
        }

        .carnate-permissions-page .pagination-wrapper {
            padding: 14px 18px;
            border-top: 1px solid var(--carnate-border);
        }

        .carnate-permissions-page .pagination-wrapper nav {
            margin: 0;
        }

        .carnate-permissions-page .empty-state {
            padding: 50px 20px;
            text-align: center;
        }

        .carnate-permissions-page .empty-icon {
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

        .carnate-permissions-page .empty-title {
            margin: 0 0 4px;
            color: #475569;
            font-size: 14px;
            font-weight: 700;
        }

        .carnate-permissions-page .empty-text {
            margin: 0;
            color: #94a3b8;
            font-size: 12px;
        }

        /* Modal */
        .carnate-permissions-page .permission-modal {
            position: fixed;
            inset: 0;
            z-index: 1050;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: rgba(15, 23, 42, .48);
            backdrop-filter: blur(2px);
        }

        .carnate-permissions-page .modal-dialog-custom {
            width: 100%;
            max-width: 520px;
        }

        .carnate-permissions-page .modal-content-custom {
            background: #fff;
            border: 1px solid var(--carnate-border);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(15, 23, 42, .20);
        }

        .carnate-permissions-page .modal-header-custom {
            padding: 18px 20px;
            border-bottom: 1px solid var(--carnate-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .carnate-permissions-page .modal-title-wrap {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .carnate-permissions-page .modal-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: var(--carnate-red-soft);
            color: var(--carnate-red);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .carnate-permissions-page .modal-title {
            margin: 0;
            font-size: 16px;
            font-weight: 700;
            color: var(--carnate-text);
        }

        .carnate-permissions-page .modal-close {
            width: 34px;
            height: 34px;
            border: 0;
            border-radius: 8px;
            background: #f1f5f9;
            color: #64748b;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .carnate-permissions-page .modal-close:hover {
            background: var(--carnate-red-soft);
            color: var(--carnate-red);
        }

        .carnate-permissions-page .modal-body-custom {
            padding: 20px;
        }

        .carnate-permissions-page .form-label {
            color: #334155;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 7px;
        }

        .carnate-permissions-page .required {
            color: var(--carnate-red);
        }

        .carnate-permissions-page .form-control {
            min-height: 43px;
            border: 1px solid var(--carnate-border);
            border-radius: 9px;
            color: var(--carnate-text);
            font-size: 13px;
            box-shadow: none;
        }

        .carnate-permissions-page .form-control:focus {
            border-color: rgba(229, 57, 53, .45);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        .carnate-permissions-page .field-error {
            display: block;
            margin-top: 6px;
            color: #dc2626;
            font-size: 12px;
        }

        .carnate-permissions-page .modal-footer-custom {
            padding: 14px 20px;
            border-top: 1px solid var(--carnate-border);
            background: #fafbfc;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 9px;
        }

        .carnate-permissions-page .cancel-btn {
            min-height: 40px;
            padding: 0 15px;
            border: 1px solid var(--carnate-border);
            border-radius: 9px;
            background: #fff;
            color: #475569;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
        }

        .carnate-permissions-page .cancel-btn:hover {
            background: #f8fafc;
        }

        .carnate-permissions-page .submit-btn {
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
            cursor: pointer;
        }

        .carnate-permissions-page .submit-btn:hover {
            background: var(--carnate-red-dark);
        }

        .carnate-permissions-page .submit-btn .spinner-border {
            width: 15px;
            height: 15px;
            border-width: 2px;
        }

        @media (max-width: 767px) {
            .carnate-permissions-page {
                padding: 12px;
            }

            .carnate-permissions-page .page-header {
                padding: 16px;
                flex-direction: column;
                align-items: stretch;
            }

            .carnate-permissions-page .add-btn {
                width: 100%;
            }

            .carnate-permissions-page .permission-modal {
                padding: 12px;
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

    {{-- Add/Edit Modal --}}
    @if ($showModal)
        <div class="permission-modal">

            <div class="modal-dialog-custom">

                <div class="modal-content-custom">

                    <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">
                        @csrf

                        <div class="modal-header-custom">

                            <div class="modal-title-wrap">
                                <div class="modal-icon">
                                    <i class="bx bx-shield-quarter"></i>
                                </div>

                                <h4 class="modal-title">
                                    {{ $isEdit ? 'Edit Permission' : 'Create Permission' }}
                                </h4>
                            </div>

                            <button
                                type="button"
                                class="modal-close"
                                wire:click="$set('showModal', false)"
                                aria-label="Close"
                            >
                                <i class="bx bx-x"></i>
                            </button>

                        </div>

                        <div class="modal-body-custom">

                            <div class="row g-3">

                                <div class="col-md-12">

                                    <label class="form-label">
                                        Permission Name
                                        <sup class="required">*</sup>
                                    </label>

                                    <input
                                        type="text"
                                        wire:model="permissionName"
                                        class="form-control"
                                        placeholder="Enter permission name"
                                    >

                                    @error('permissionName')
                                        <span class="field-error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>

                            </div>

                        </div>

                        <div class="modal-footer-custom">

                            <button
                                type="button"
                                class="cancel-btn"
                                wire:click="$set('showModal', false)"
                            >
                                Cancel
                            </button>

                            <button type="submit" class="submit-btn">
                                <i class="bx bx-save"></i>

                                {{ $isEdit ? 'Update' : 'Create' }}

                                <i
                                    class="spinner-border spinner-border-sm"
                                    wire:loading
                                ></i>
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>
    @endif

    {{-- Page Header --}}
    <div class="page-card">

        <div class="page-header">

            <div class="title-wrap">

                <div class="title-icon">
                    <i class="bx bx-shield-quarter"></i>
                </div>

                <div>
                    <h4 class="page-title">Admin's Permissions</h4>
                    <p class="page-subtitle">
                        Manage permissions available to administrators.
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

    {{-- Permissions Table --}}
    <div class="table-card">

        <div class="table-heading">
            <h5>Permission List</h5>
            <p>View and manage configured admin permissions.</p>
        </div>

        @if (!empty($permissions) && $permissions->count())

            <div class="table-responsive">

                <table class="table align-middle mb-0">

                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($permissions as $index => $permission)

                            <tr>

                                <td class="serial">
                                    {{ $permissions->total() - ($permissions->firstItem() + $index) + 1 }}
                                </td>

                                <td>
                                    <span class="permission-name">
                                        <i class="bx bx-key me-1"></i>
                                        {{ $permission->name }}
                                    </span>
                                </td>

                                <td>

                                    <a
                                        href="javascript:;"
                                        wire:click="confirmDelete({{ $permission->id }})"
                                        class="action-btn"
                                        title="Delete"
                                    >
                                        <i class="bx bx-trash"></i>
                                    </a>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            <div class="pagination-wrapper">
                {{ $permissions->links() }}
            </div>

        @else

            <div class="empty-state">

                <div class="empty-icon">
                    <i class="bx bx-shield-quarter"></i>
                </div>

                <h5 class="empty-title">
                    No Admin Permissions Found
                </h5>

                <p class="empty-text">
                    Create a permission to start managing administrator access.
                </p>

            </div>

        @endif

    </div>

</div>

@section('footerscript')

    <script>
        document.addEventListener('livewire:init', function () {

            Livewire.hook('morphed', (message, component) => {

                $('.select2').select2().on('change', function(e) {
                    const selectedValues = $(this).val();
                    @this.set(e.target.dataset.property, selectedValues);
                });

            });

        });
    </script>

@endsection