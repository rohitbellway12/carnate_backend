<div>
    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    @php
    $admin = App\Models\Admin::where('id', $adminId)->first();
  @endphp

    <!-- Add/Edit Modal -->
    <div class="modal @if ($showModal) show @endif" tabindex="-1" style="opacity:1; background-color:#0606068c; display:@if ($showModal) block @endif">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ $isEdit ? 'Edit Model Year' : 'Create Model Year' }}</h4>
                        <button type="button" class="btn-close" wire:click="closeModel" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-3">
                        @csrf
                        <div class="row g-3">
                            <!-- Title -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Title<sup class="text-danger">*</sup></label>
                                    <input type="text" wire:model="title" class="form-control" placeholder="Enter Title">
                                </div>
                                @error('title') <span class="text-danger error">{{ $message }}</span> @enderror
                            </div>

                            <!-- Maker Type  -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label"> Maker Type <sup
                                            class="text-danger">*</sup></label>
                                        <select id="maker_type_id" class="form-select select2" wire:model="maker_type_id"  data-property="maker_type_id">
                                            <option value="">Select Maker Type</option>
                                            @foreach ($makertypes as $makertype)
                                            <option value="{{$makertype->id}}"> {{ $makertype->title }} </option>
                                            @endforeach
                                        </select>
                                </div>
                                @error('maker_type_id')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                            </div>

                            <!-- Maker -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label"> Maker <sup
                                            class="text-danger">*</sup></label>
                                        <select id="maker_id" class="form-select select2" wire:model="maker_id"  data-property="maker_id">
                                            <option value="">Select Maker</option>
                                            @foreach ($makers as $maker)
                                            <option value="{{$maker->id}}"> {{ $maker->title }} </option>
                                            @endforeach
                                        </select>
                                </div>
                                @error('maker_id')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                            </div>

                            <!-- Model  -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label"> Model <sup
                                            class="text-danger">*</sup></label>
                                        <select id="model_id" class="form-select select2" wire:model="model_id"  data-property="model_id">
                                            <option value="">Select Model</option>
                                            @foreach ($models as $model)
                                            <option value="{{$model->id}}"> {{ $model->title }} </option>
                                            @endforeach
                                        </select>
                                </div>
                                @error('model_id')
                                        <span class="text-danger error">{{ $message }}</span>
                                    @enderror
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
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModel" data-bs-dismiss="modal">Cancel</button>
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
            <div class="breadcrumb-title pe-2" style="border: none;"><i class="bx bx-user"></i> Model Year</div>
            <div class="col-xl-3  col-sm-12 ">
                <button type="button" class="mr-2 btn btn-info text-white rounded-0  float-end" wire:click="resetFilter">Clear</button>
            </div>
            @if (@$admin->hasPermissionTo('model-year-add')) 
            <div class="pe-3">
               <a href="javascript:;" wire:click="create" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i>Add</a>
            </div>
            @endif
        </div>
    </div>

    <div class="card">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Search" wire:model.live="search">
                </div>

                <div class="col">
                    <div class="form-group">
                        <select id="f_maker_type_id" class="form-select select2" wire:model.live="maker_type_id"  data-property="maker_type_id">
                            <option value="">Select Maker Type</option>
                            @foreach ($makertypes as $makertype)
                            <option value="{{$makertype->id}}"> {{ $makertype->title }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <select id="f_maker_id" class="form-select select2" wire:model.live="maker_id"  data-property="maker_id">
                            <option value="">Select Maker</option>
                            @foreach ($makers as $maker)
                            <option value="{{$maker->id}}"> {{ $maker->title }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <select id="f_model_id" class="form-select select2" wire:model.live="model_id"  data-property="model_id">
                            <option value="">Select Model</option>
                            @foreach ($models as $model)
                            <option value="{{$model->id}}"> {{ $model->title }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <select class="form-select" wire:model.live="status_filter">
                            <option value="">Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="card mt-4">
        @if ($items->count())
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Title</th>
                            <th>Maker Type</th>
                            <th>Maker </th>
                            <th>Model </th>
                            <th>Status</th>
                            @if (@$admin->hasPermissionTo('model-year-edit') || @$admin->hasPermissionTo('model-year-delete')) 
                            <th>Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $index => $item)
                            <tr>
                                <td>{{ $items->total() - ($items->firstItem() + $index) + 1 }}</td>
                                <td>{{ $item->title }}</td>
                                <td> {{ $item->makerType ? $item->makerType->title : 'NA' }} </td>
                                <td> {{ $item->maker ? $item->maker->title : 'NA' }} </td>
                                <td> {{ $item->model ? $item->model->title  : 'NA' }} </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" wire:change="toggleStatus({{ $item->id }}, {{ $item->status == 1 ? 0 : 1 }})" {{ $item->status == 1 ? 'checked' : '' }}>
                                    </div>
                                </td>
                                @if (@$admin->hasPermissionTo('model-year-edit') || @$admin->hasPermissionTo('model-year-delete')) 
                                <td>
                                    @if (@$admin->hasPermissionTo('model-year-edit')) 
                                    <a wire:click="edit({{ $item->id }})" class="btn btn-sm p-0"><i class="bx bxs-edit"></i></a>
                                    @endif
                                    @if (@$admin->hasPermissionTo('model-year-delete')) 
                                    <a wire:click="confirmDelete({{ $item->id }})" class="btn btn-sm p-0"><i class="fadeIn animated bx bx-trash"></i></a>
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
                <div class="alert alert-info">No Model Year found!</div>
            </div>
        @endif
    </div>
</div>

@section('footerscript')
{{-- <script>
    document.addEventListener('livewire:init', function () {
        Livewire.hook('morphed', (message, component) => {
            $('.select2').select2().on('change', function(e){
                const selectedValues = $(this).val();
                @this.set(e.target.dataset.property, selectedValues);
            });
        });
    });
</script> --}}
{{-- <script>
    document.addEventListener('livewire:init', () => {
        
        $('#maker_type_id').select2({placeholder: "Select Maker Type"}).on('change', function () {
            @this.set('maker_type_id', $(this).val());
        });

        $('#maker_id').select2({placeholder: "Select Maker"}).on('change', function () {
            @this.set('maker_id', $(this).val());
        });

        $('#model_id').select2({placeholder: "Select Model"}).on('change', function () {
            @this.set('model_id', $(this).val());
        });

        Livewire.hook('morphed', (message, component) => {
            $('#maker_type_id').select2({placeholder: "Select Maker Type"});
            $('#maker_id').select2({placeholder: "Select Maker"});
            $('#model_id').select2({placeholder: "Select Model"});
        });
    });
</script> --}}
<script>
    document.addEventListener('livewire:init', () => {
        
     
        $('#maker_type_id, #f_maker_type_id').select2({placeholder: "Select Maker Type"}).on('change', function () {

            let value = $(this).val();
            @this.set('maker_type_id', value); 
        });

        $('#maker_id, #f_maker_id').select2({laceholder: "Select Maker"}).on('change', function () {
            
            let value = $(this).val();
            @this.set('maker_id', value); 
        });

        $('#model_id, #f_model_id').select2({laceholder: "Select Model"}).on('change', function () {
            
            let value = $(this).val();
            @this.set('model_id', value); 
        });


        
        Livewire.hook('morphed', (message, component) => {
            
            $('#maker_type_id, #f_maker_type_id').select2({
                placeholder: "Select Maker Type"
            });

            $('#maker_id, #f_maker_id').select2({
                placeholder: "Select Maker"
            });

            $('#model_id, #f_model_id').select2({
                placeholder: "Select Model"
            });
        });
    });
</script>
@endsection
