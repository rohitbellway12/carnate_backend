<div>
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <style>
        .expensestable td{ 
            cursor: pointer;
        } 
        .expensestable td:hover {
            color: #EA6B00;
        }  
    </style>

    <!-- Add/Edit Modal -->
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
                            <!-- Category -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Category<sup class="text-danger">*</sup></label>
                                    <select class="form-select" wire:model="category_id" required>
                                        <option value="" selected disabled>--Select Category--</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <!-- Bill Number -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Bill Number<sup class="text-danger">*</sup></label>
                                    <input type="text" wire:model="bill_number" class="form-control" placeholder="Enter Bill Number">
                                    @error('bill_number') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <!-- Expense Date -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Expense Date<sup class="text-danger">*</sup></label>
                                    <input type="date" wire:model="expense_date" class="form-control">
                                    @error('expense_date') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <!-- Total Amount -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Total Amount<sup class="text-danger">*</sup></label>
                                    <input type="text" wire:model.live="total_amount" class="form-control" placeholder="Enter Total Amount">
                                    @error('total_amount') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <!-- Paid Amount -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Paid Amount</label>
                                    <input type="text" wire:model.live="paid_amount" class="form-control" placeholder="Enter Paid Amount">
                                    @error('paid_amount') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <!-- Balance Amount -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Balance Amount</label>
                                    <input type="text" wire:model.live="balance_amount" class="form-control bg-secondary" readonly>
                                    @error('balance_amount') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <!-- Description -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Description</label>
                                    <textarea wire:model="description" class="form-control" placeholder="Enter Description"></textarea>
                                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="$set('showModal', false)" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            {{ $isEdit ? 'Update' : 'Create' }}
                            <i class="spinner-border spinner-border-sm" wire:loading></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <button class="btn btn-success" wire:click="create">Add Expense</button>
        <input type="text" class="form-control w-25" placeholder="Search..." wire:model.debounce.500ms="searchfilter">
    </div>

    <table class="table table-bordered expensestable">
        <thead>
            <tr>
                <th>#</th>
                <th>Category</th>
                <th>Bill Number</th>
                <th>Date</th>
                <th>Total</th>
                <th>Paid</th>
                <th>Balance</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if($expenses && $expenses->count())
                @foreach($expenses as $index => $expense)
                    <tr>
                        <td>{{ $expenses->firstItem() + $index }}</td>
                        <td>{{ optional($expense->category)->title }}</td>
                        <td>{{ $expense->bill_number }}</td>
                        <td>{{ $expense->date }}</td>
                        <td>{{ $expense->total_amount }}</td>
                        <td>{{ $expense->paid_amount }}</td>
                        <td>{{ $expense->balance_amount }}</td>
                        <td>{{ $expense->description }}</td>
                        <td>
                            <button class="btn btn-sm btn-primary" wire:click="edit({{ $expense->id }})">Edit</button>
                            <button class="btn btn-sm btn-danger" wire:click="confirmDelete({{ $expense->id }})">Delete</button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr><td colspan="9" class="text-center">No expenses found.</td></tr>
            @endif
        </tbody>
    </table>
    {{ $expenses->links() }}
</div>
