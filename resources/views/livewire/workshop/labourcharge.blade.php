
<div>
    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif



    <div class="modal @if ($showModal) show @endif" tabindex="-1"
        style="opacity:1; background-color:#0606068c; display:@if ($showModal) block @endif">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ $isEdit ? 'Edit Labour Charge' : 'Create Labour Charge' }}</h4>
                        <button type="button" class="btn-close" wire:click="$set('showModal', false)"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-3">
                        @csrf

                        <div class="row g-3">
                            <!-- Name -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Title<sup class="text-danger">*</sup></label>
                                    <input type="text" wire:model="title" class="form-control" placeholder="Enter Title">
                                </div>
                                @error('title') <span class="text-danger error">{{ $message }}</span> @enderror
                            </div>

                             {{-- Labour Type --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Labour Type<sup class="text-danger">*</sup></label>
                                <select wire:model.live="labour_type" class="form-select">
                                    <option value="">Select Labour Type</option>
                                    <option value="inhouse">Inhouse</option>
                                    <option value="outsource">Outsource</option>
                                </select>
                                @error('labour_type')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
     {{-- Outsource Price (conditionally shown) --}}
                        @if ($labour_type === 'outsource')
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Outsource Price<sup class="text-danger">*</sup></label>
                                    <input type="number" wire:model.live="outsource_price" class="form-control"
                                        placeholder="Enter Outsource Price" min="1" step="1">
                                </div>
                                @error('outsource_price')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                        {{-- Inhouse/Primary Price --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Selling Price<sup class="text-danger">*</sup></label>
                                <input type="number" wire:model.live="price" class="form-control"
                                    placeholder="Enter Price" min="1" step="1">
                            </div>
                            @error('price')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Tax Type</label>
                                    <select id="tax_type" class="form-select" wire:model.live="tax_type" id="tax_type">
                                        <option value="">Select Tax Type</option>
                                        <option value="include">Include All Taxes</option>
                                        <option value="exclude">Exclude All Taxes</option>
                                    </select>
                                    @error('tax_type')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                             <!-- Percentage Input Section (Shown based on selection) -->
                            @if ($tax_type == 'include' || $tax_type == 'exclude')
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">
                                            {{ $tax_type == 'include' ? 'Include Tax Percentage' : 'Exclude Tax Percentage' }}
                                        </label>
                                        <div class="input-group">
                                            <input type="number" wire:model.live="tax_percentage" class="form-control" placeholder="Enter Percentage" id="tax_percentage">
                                            <span class="input-group-text">%</span>
                                        </div>
                                        @error('tax_percentage')
                                            <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Total Price<sup class="text-danger">*</sup></label>
                                    <input type="text" wire:model="total_price" class="form-control" readonly>
                                </div>
                                @error('total_price') <span class="text-danger error">{{ $message }}</span> @enderror
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






    <div class="card">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div class="breadcrumb-title pe-2" style="border: none;">Labour Charge</div>
            {{-- @if ($user->hasPermissionTo('staff-add')) --}}
            <div class="pe-3">
                <a href="javascript:;" wire:click="create" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i
                        class="bx bxs-plus-square"></i>Add</a>
            </div>
            {{-- @endif --}}
        </div>
    </div>
        <div class="card mt-4">
        <div class="card-body">
            <div class="row">
            <div class="col-3">
                <input type="text" class="form-control" placeholder="Search title" wire:model.live="searchStaff" fdprocessedid="blgf5">
            </div>

            <div class="col-9 text-right">
                <button type="button" class="mr-2 btn btn-info text-white rounded-0  float-end" wire:click="resetFilter" fdprocessedid="orntg">Clear</button>
             </div>
            </div>

        </div>
    </div>
    <div class="card mt-4">
        @if (!empty($items) && $items->count())
        <div class="card-body ">
            <div class="table-responsive">
                <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Title</th>
                                <th>Labour Type</th>
                                <th>Selling Price</th>
                                <th>Outsource Price</th>
                                <th>Tax</th>
                                <th>Tax Type</th>
                                <th>Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $index => $item)
                                <tr>
                                    <td>{{ $items->total() - ($items->firstItem() + $index) + 1 }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ ucfirst($item->labour_type) }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->outsource_price ?? '-' }}</td>
                                    <td> {{ $item->gst }} </td>
                                    <td>{{ $item->gst_type  }}
                                    </td>
                                      <td>{{$item->total }}
                                    </td>
                                    <td>

                                        <a wire:click="edit({{ $item->id }})" class="btn btn-sm p-0"><i
                                                 class="bx bxs-edit"></i> <span class="small"></span></a>

                                        <a wire:click="confirmDelete({{ $item->id }})"
                                             class="btn btn-sm p-0"><i class="fadeIn animated bx bx-trash"></i> <span
                                                 class="small"></span></a>

                                    </td>
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
                <div class="alert alert-info">No Labour Charge Found!</div>
            </div>
        @endif
    </div>

</div>


@section('footerscript')

    <script>

        document.addEventListener('livewire:init', function () {

            Livewire.hook('morphed', (message, component) => {
                $('.select2').select2().on('change', function(e){
                    const selectedValues = $(this).val();
                    @this.set(e.target.dataset.property,selectedValues);
              });
            });


        });
    </script>
@endsection
