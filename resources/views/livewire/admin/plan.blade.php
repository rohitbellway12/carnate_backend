 
<div>
    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    @php
        $admin = App\Models\Admin::where('id', $adminId)->first();
    @endphp
    <!-- Add/Edit Modal -->

    <div class="modal @if ($showModal) show @endif" tabindex="-1"
        style="opacity:1; background-color:#0606068c; display:@if ($showModal) block @endif">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ $isEdit ? 'Edit Plan' : 'Create Plan' }}</h4>
                        <button type="button" class="btn-close" wire:click="resetModal"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-3">
                        @csrf
                     
                        <div class="row g-3">
                            <!-- Plan Name -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Plan Name<sup class="text-danger">*</sup></label>
                                    <input type="text" wire:model="plan_name" class="form-control" placeholder="Enter Plan Name">
                                </div>
                                @error('plan_name') <span class="text-danger error">{{ $message }}</span> @enderror
                            </div> 

                              <!-- Amount -->
                              <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Amount<sup class="text-danger">*</sup></label>
                                    <input type="number" wire:model="amount" class="form-control" placeholder="Enter Amount">
                                </div>
                                @error('amount') <span class="text-danger error">{{ $message }}</span> @enderror
                            </div> 
                        
                        
                            <!-- Validity -->
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Validity<sup class="text-danger">*</sup></label>
                                    <input type="date" wire:model="validity" class="form-control" placeholder="Enter Validity">
                                </div>
                                @error('validity') <span class="text-danger error">{{ $message }}</span> @enderror
                            </div> 
                        
                              <!-- Trial -->
                              <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Trial<sup class="text-danger">*</sup></label>
                                    <select class="form-select" wire:model="is_trial"> 
                                        <option value="">Select Trial</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div> 
                                 @error('is_trial') <span class="text-danger error">{{ $message }}</span> @enderror
                            </div> 
                                    
                            <!-- Status -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Status<sup class="text-danger">*</sup></label>
                                    <select class="form-select" wire:model="status"> 
                                        <option value="">Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div> 
                                 @error('status') <span class="text-danger error">{{ $message }}</span> @enderror
                            </div> 
                         
                                        
                            <!-- Plan Type -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Plan Type <sup class="text-danger">*</sup> </label>
                                    <select class="form-select" wire:model="plan_type"> 
                                        <option value="">Select Plan Type</option>
                                        <option value="1">Days</option>
                                        <option value="2">Monthly</option>
                                        <option value="3">Yearly</option>
                                    </select>
                                </div> 
                                @error('plan_type') <span class="text-danger error">{{ $message }}</span> @enderror
                            </div> 
                
                            <p class="btn btn-success rounded w-25" wire:click="addField"> Add More</p>

                            @foreach($planDescription as $index => $voice)
                                <div class="mb-3 col-lg-12 dynamic-field">
                                    <div class="row">
                                        <div class="col-11">
                                            <label for="validationCustom01" class="form-label">Plan Description<sup class="text-danger">*</sup></label><br>
                                            <input type="text" class="form-control" 
                                                   placeholder="Plan Description" 
                                                   wire:model="planDescription.{{ $index }}">
                                            @error("planDescription.$index") 
                                                <span class="text-danger">{{ $message }}</span> 
                                            @enderror
                                        </div>
                                        @if($index > 0)
                                        <div class="col-1 mt-4">
                                         <button type="button" 
                                                 class="btn btn-danger btn-xs p-1 remove-field rounded text-white border-white  mt-3" 
                                                 wire:click="removeField({{ $index }})" 
                                                 style="font-size: 12px; width: 19px; height: 24px; display: flex; align-items: center; ">
                                             <i class="fa fa-trash" aria-hidden="true" style="font-size: 10px;"></i>
                                         </button>
                                     </div>
                                        @endif
                                    </div>
                                </div>
                                @endforeach

                            <!-- Address -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Description<sup class="text-danger">*</sup> </label>
                                    <textarea wire:model="description" class="form-control" placeholder="Enter Description"></textarea>
                                </div>
                                @error('description') <span class="text-danger error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        
                       
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="resetModal"
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
            <div class="breadcrumb-title pe-2" style="border: none;"><i class="fas fa-file-contract fs-5"></i> Plan</div>
            @if (@$admin->hasPermissionTo('plan-add'))
            <div class="pe-3">
                <a href="javascript:;" wire:click="create" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i
                        class="bx bxs-plus-square"></i>Add</a>
            </div>
            @endif
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-body">
            <div class="row">
            <div class="col-3">
                <input type="text" class="form-control" placeholder="Search Name,Validity,Description" wire:model.live="searchfilter" fdprocessedid="blgf5">
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
                                <th>Plan Name</th>
                                <th>Validity</th>
                                <th>Amount</th>
                                <th>Description</th> 
                                <th>Is Trial</th> 
                                @if (@$admin->hasPermissionTo('plan-edit') || @$admin->hasPermissionTo('plan-delete'))
                                <th>Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $index => $item)
                                <tr>
                                    <td>{{ $items->total() - ($items->firstItem() + $index) + 1 }}</td>
                                    <td>{{ $item->plan_name }}</td>
                                    <td>{{ $item->validity }}</td>
                                    <td> {{ $item->amount }} </td>
                                    <td> {{ $item->description }} </td> 
                                    <td> {{ $item->is_trial ? 'Yes' : 'No' }} </td>
                                    @if (@$admin->hasPermissionTo('plan-add'))
                                    <td>
                                        @if (@$admin->hasPermissionTo('plan-edit') || @$admin->hasPermissionTo('plan-delete'))
                                        <a wire:click="edit({{ $item->id }})" class="btn btn-sm p-0"><i
                                                class="bx bxs-edit"></i> <span class="small"></span></a>
                                        @endif
                                         @if (@$admin->hasPermissionTo('plan-delete'))
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
                <div class="alert alert-info">No Plan found!</div>
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
