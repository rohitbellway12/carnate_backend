<div>
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <style>
        .expensestable td {
            cursor: pointer;
        }
        .expensestable td:hover {
            color: #EA6B00;
        }
    </style>

    @if($showSupplierModal)
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5); z-index: 1055; position: fixed; top: 0; left: 0; width: 100%; height: 100%;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Add New Supplier</h5>
                    <button type="button" class="btn-close" wire:click="$set('showSupplierModal', false)"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label>First Name</label>
                        <input type="text" class="form-control" wire:model="newSupplier.name">
                        @error('newSupplier.name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>Last Name</label>
                        <input type="text" class="form-control" wire:model="newSupplier.lastname">
                        @error('newSupplier.lastname') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" wire:click="$set('showSupplierModal', false)">Cancel</button>
                    <button class="btn btn-primary" wire:click="saveSupplier">Save</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="modal @if ($showModal) show @endif" tabindex="-1"
        style="opacity:1; background-color:#0606068c; display:@if ($showModal) block @endif">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ $isEdit ? 'Edit Expenses' : 'Create Expenses' }}</h4>
                        <button type="button" class="btn-close" wire:click="$set('showModal', false)"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-3">
                        @csrf

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="row align-items-center">
                                        <div class="col-10 pe-0">
                                            <label class="form-label">Category<sup class="text-danger">*</sup></label>
                                            <select class="form-select" wire:model="category_id" required>
                                                <option value="" selected disabled>--Select Category--</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ @$category->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-2 mt-4">
                                            <button type="button" class="btn btn-outline-secondary text-light bg-primary fl margin-left-0" wire:click="addCategory">
                                                {{ trans('+') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                @error('category_id') <span class="text-danger error">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Name</label>
                                    <div class="d-flex align-items-center">
                                        <select class="form-select me-2" wire:model="supplier_id" style="width: 85%;">
                                            <option value="" selected disabled>-- select name --</option>
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">
                        {{ $supplier->business_first_name }}
                    </option>
                @endforeach
                                        </select>
                                        <button type="button" class="btn btn-sm btn-primary" wire:click="openSupplierModal" style="width: 50px; height: 36px; border: 1px solid black;">
                                            <i class="bx bx-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                @error('supplier_id') <span class="text-danger error">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Bill Number<sup class="text-danger">*</sup></label>
                                    <input type="text" wire:model="bill_number" class="form-control" placeholder="Enter Bill Number">
                                </div>
                                @error('bill_number') <span class="text-danger error">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Expense Date <sup class="text-danger">*</sup></label>
                                    <input type="date" wire:model="expense_date" class="form-control" placeholder="Enter Expense Date">
                                </div>
                                @error('expense_date') <span class="text-danger error">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Total Amount <sup class="text-danger">*</sup></label>
                                    <input type="text" wire:model.live="total_amount" class="form-control" placeholder="Enter Total Amount">
                                </div>
                                @error('total_amount') <span class="text-danger error">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Paid Amount</label>
                                    <input type="text" wire:model.live="paid_amount" class="form-control" placeholder="Enter Paid Amount">
                                </div>
                                @error('paid_amount') <span class="text-danger error">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Balance Amount</label>
                                    <input type="text" wire:model.live="balance_amount" class="form-control" placeholder="Enter Balance Amount" readonly style="background-color: #daeaf8 !important;">
                                </div>
                                @error('balance_amount') <span class="text-danger error">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Description</label>
                                    <textarea wire:model="description" class="form-control" placeholder="Enter Description"></textarea>
                                </div>
                                @error('description') <span class="text-danger error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="$set('showModal', false)"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            {{ $isEdit ? 'Update' : 'Create' }}
                            <i class="spinner-border spinner-border-sm" wire:loading></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal @if ($showCategoryModel) show @endif" tabindex="-1"
        style="opacity:1; background-color:#0606068c; display:@if ($showCategoryModel) block @endif">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form wire:submit.prevent="categoryLabelStore">
                    <div class="modal-header">
                        <h4 class="modal-title">Create Category</h4>
                        <button type="button" class="btn-close" wire:click="$set('showCategoryModel', false)"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-3">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Category Label</label>
                                    <input type="text" wire:model="category_label" class="form-control" placeholder="Enter Category Label">
                                </div>
                                @error('category_label') <span class="text-danger error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="$set('showCategoryModel', false)"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            {{ $isEdit ? 'Update' : 'Create' }}
                            <i class="spinner-border spinner-border-sm" wire:loading></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div class="breadcrumb-title pe-2" style="border: none;">Expenses</div>
            <div class="pe-3">
                @if ($user->hasPermissionTo('expenses-add'))
                <a href="javascript:;" wire:click="create" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i
                        class="bx bxs-plus-square"></i>Add</a>
                @endif
            </div>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-body">
            <div class="row">
                <div class="col-3">
                    <input type="text" class="form-control" placeholder="Search Expenses" wire:model.live="searchfilter">
                </div>
                <div class="col-9 text-right">
                    <button type="button" class="mr-2 btn btn-info text-white rounded-0 float-end" wire:click="resetFilter">Clear</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-4">
        @if (!empty($items) && $items->count())
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered data-table expensestable">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Supplier Name</th>
                            <th>Bill Number</th>
                            <th>Category</th>
                            <th>Total Amount ({{ getCurrencySymbols() }})</th>
                            <th>Balance Amount ({{ getCurrencySymbols() }})</th>
                            <th>Status</th>
                            <th>Date</th>
                            @if ($user->hasPermissionTo('expenses-edit') || $user->hasPermissionTo('expenses-delete'))
                            <th>Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $index => $item)
                            <tr>
                                <td>{{ $items->total() - ($items->firstItem() + $index) + 1 }}</td>
                                <td wire:click="edit({{ $item->id }})">{{ $item->sparePartSupplier?->business_first_name }}</td>
                                <td wire:click="edit({{ $item->id }})">{{ $item->bill_number }}</td>
                                <td wire:click="edit({{ $item->id }})">{{ $item->sparePartCategory?->title }}</td>
                                <td wire:click="edit({{ $item->id }})">{{ $item->total_amount }}</td>
                                <td wire:click="edit({{ $item->id }})">{{ $item->balance_amount }}</td>

                                @if ($item->total_amount == $item->paid_amount)
                                <td wire:click="edit({{ $item->id }})" style="color: rgb(0, 128, 0);">Full Paid
                                </td>
                                @elseif(empty($item->paid_amount))
                                    <td wire:click="edit({{ $item->id }})" style="color: rgb(255, 0, 0);">Unpaid
                                    </td>
                                @elseif($item->total_amount > $item->paid_amount)
                                    <td wire:click="edit({{ $item->id }})" style="color: rgb(255, 165, 0);">Partially paid
                                    </td>
                                @else
                                    <td>-</td>
                                @endif
                                <td wire:click="edit({{ $item->id }})">{{ date(getDateFormat(), strtotime($item->date)) }}</td>
                                @if ($user->hasPermissionTo('expenses-edit') || $user->hasPermissionTo('expenses-delete'))
                                <td>
                                    @if ($user->hasPermissionTo('expenses-edit'))
                                    <a wire:click="edit({{ $item->id }})" class="btn btn-sm p-0"><i
                                            class="bx bxs-edit"></i> <span class="small"></span></a>
                                    @endif
                                    @if ($user->hasPermissionTo('expenses-delete'))
                                    <a wire:click="confirmDelete({{ $item->id }})"
                                        class="btn btn-sm p-0"><i class="fadeIn animated bx bx-trash"></i> <span
                                            class="small"></span></a>
                                    @endif
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination-wrapper">
                    {{ $items->links() }}
                </div>
            </div>
        </div>
    @else
        <div class="my-2">
            <div class="alert alert-info">No Expenses Found!</div>
        </div>
    @endif
</div>

@section('footerscript')
    <script>
        document.addEventListener('livewire:init', function () {

            Livewire.hook('morphed', (message, component) => {
                $('.select2').select2().on('change', function (e) {
                    const selectedValues = $(this).val();
                    @this.set(e.target.dataset.property, selectedValues);
                });
            });

        });
    </script>
@endsection
