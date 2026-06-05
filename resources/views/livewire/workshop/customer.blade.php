<div>
    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <div class="card">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div class="breadcrumb-title pe-2" style="border: none;">Customers</div>
            <div class="pe-3">
                @if ($user->hasPermissionTo('customer-add'))
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
                    <input type="text" class="form-control" placeholder="Search Customer"
                        wire:model.live="searchCustomer" fdprocessedid="blgf5">
                </div>
                <div class="col-9 text-right">
                    <button type="button" class="mr-2 btn btn-info text-white rounded-0  float-end"
                        wire:click="resetFilter" fdprocessedid="orntg">Clear</button>
                </div>
            </div>

        </div>
    </div>
    <div class="modal @if ($showModal) show @endif" tabindex="-1"
        style="opacity:1; background-color:#0606068c; display:@if ($showModal) block @endif">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ $isEdit ? 'Edit Customer' : 'Create Customer' }}</h4>
                        <button type="button" class="btn-close" wire:click="$set('showModal', false)"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-3">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h4>PERSONAL DETAILS</h4>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <!-- Name -->
                                    <div class="col-md-6">
                                        <label for="first_name" class="form-label">
                                            First Name <sup class="text-danger">*</sup>
                                        </label>
                                        <div class="input-group">
                                            <select name="user_title" id="user_title" wire:model="user_title" class="form-select"
                                                style="max-width: 80px;">
                                                <option value="mr">Mr.</option>
                                                <option value="mrs">Mrs.</option>
                                                <option value="miss">Miss</option>
                                                <option value="ms">M/S</option>
                                            </select>
                                            <input type="text" wire:model="name" name="first_name" id="first_name"
                                                class="form-control" placeholder="Enter First Name">
                                        </div>
                                        @if ($errors->has('name') || $errors->has('user_title'))
                                            <span class="text-danger error">
                                                {{ $errors->first('name') ?? $errors->first('user_title') }}
                                            </span>
                                        @endif
                                    </div>
                                    <!-- Last Name -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Last Name<sup class="text-danger">*</sup></label>
                                            <input type="text" wire:model="lastname" class="form-control"
                                                placeholder="Enter Last Name">
                                        </div>
                                        @error('lastname')
                                            <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Mobile Number -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Mobile Number<sup
                                                    class="text-danger">*</sup></label>
                                            <input type="text" wire:model="mobile_no" class="form-control"
                                                placeholder="Enter Mobile Number">
                                        </div>
                                        @error('mobile_no')
                                            <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Email<sup class="text-danger"></sup></label>
                                            <input type="email" wire:model="email" class="form-control"
                                                placeholder="Enter Email">
                                        </div>
                                        @error('email')
                                            <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Birth Date<sup class="text-danger"></sup></label>
                                            <input type="date" wire:model="birth_date" class="form-control"
                                                max="{{ date('Y-m-d') }}">
                                        </div>
                                        @error('birth_date')
                                            <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">GST Number</label>
                                            <input type="text" wire:model="gst_no" class="form-control"
                                                placeholder="Enter GST Number">
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4>ADDRESS</h4>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label">Address<sup class="text-danger">*</sup></label>
                                            <textarea wire:model="address" class="form-control" placeholder="Enter Address"></textarea>
                                        </div>
                                        @error('address')
                                            <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                           <div class="card">
    <div class="card-header">
        <h5>Vehicle Details</h5>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-12">
                <label class="form-label">Vehicle Details<span class="text-danger">*</span></label>
                <div class="row g-2">
                    <div class="col-md-3">
                        <select wire:model.live="brand_name" class="form-select searchable-select" data-placeholder="Select Brand">
                            <option value="">Select Brand</option>
                            @foreach ($brands as $brand)
                                <option value="{{ json_encode($brand) }}">
                                    {{ is_array($brand) ? $brand['name'] : $brand->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select wire:model.live="variant_name" class="form-select searchable-select" data-placeholder="Select Model" @if(empty($variants)) disabled @endif>
                            <option value="">Select Model</option>
                            @foreach ($variants as $index => $variant)
                                <option value="{{ $index }}">
                                    {{ is_array($variant) ? $variant['name'] : $variant->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select wire:model.live="selected_year" class="form-select searchable-select" data-placeholder="Select Year" @if(empty($years)) disabled @endif>
                            <option value="">Select Year</option>
                            @foreach ($years as $year)
                                <option value="{{ is_array($year) ? $year['value'] : $year }}">
                                    {{ is_array($year) ? $year['label'] : $year }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select wire:model.live="search_vehicle" class="form-select searchable-select" data-placeholder="Select Modification" @if(empty($modifications)) disabled @endif>
                            <option value="">Select Modification</option>
                            @foreach ($modifications as $index => $mod)
                                <option value="{{ is_array($mod) ? $mod['id'] : $index }}">
                                    {{ is_array($mod) ? $mod['name'] . ' (' . $mod['yearFrom'] . '-' . $mod['yearTo'] . ')' . ($mod['fuelType'] ? ' - ' . $mod['fuelType'] : '') : $mod }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                @if (isset($selectedVehicleName) && $selectedVehicleName != '')
                    <p style="color: #0dcaf0;" class="mt-2 fw-bold"><i class="bx bx-check-circle"></i> Selected: {{ @$selectedVehicleName }}</p>
                @endif
            </div>
            <div class="col-12">
                @error('search_vehicle')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Number Plate<span class="text-danger">*</span></label>
                <input type="text" wire:model="numberPlate" class="form-control" id="numberPlate"
                    placeholder="Enter Number Plate"
                    oninput="this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '')">
                @error('numberPlate')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Chassis No<span class="text-danger">*</span></label>
                <input type="text" wire:model="chassisNo" class="form-control" placeholder="Enter Chassis No"
                    oninput="this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '')">
                @error('chassisNo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Date of Manufacturing</label>
                <input type="date" wire:model="dateOfManufacturing" class="form-control"
                    max="{{ \Carbon\Carbon::today()->toDateString() }}" onclick="this.showPicker()">
                @error('dateOfManufacturing')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Engine No</label>
                <input type="text" wire:model="engineNo" class="form-control" placeholder="Enter Engine No">
                @error('engineNo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!--Pick Address -->
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Pickup Address</label>
                    <textarea wire:model="pickup_address" class="form-control" placeholder="Enter Pickup Address"></textarea>
                </div>
                @error('pickup_address')
                    <span class="text-danger error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Drof Address -->
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label">Drop Address</label>
                    <textarea wire:model="drop_address" class="form-control" placeholder="Enter Drop Address"></textarea>
                </div>
                @error('drop_address')
                    <span class="text-danger error">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
</div>
<button type="button" class="btn btn-primary mb-3" id="toggleDetailsBtn">
    Show Details
</button>

<div id="detailsSection" style="display: none;">
    <div class="card">
        <div class="card-header">
            <h5>DRIVER DETAILS</h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Driver Name</label>
                    <input type="text" wire:model="driver_name" class="form-control" placeholder="Enter Driver Name">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Driver Number</label>
                    <input type="number" wire:model="driver_number" class="form-control" placeholder="Enter Driver Number">
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header">
            <h5>INSURANCE DETAILS</h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Policy Number</label>
                    <input type="text" wire:model="policy_number" class="form-control" placeholder="Enter Policy Number">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Insurance Name</label>
                    <input type="text" wire:model="insurance_name" class="form-control" placeholder="Enter Insurance Name">
                </div>
                <div class="col-md-6 mt-2">
                    <label class="form-label">Policy Expiry Date</label>
                    <input type="date" wire:model="policy_expiry_date" class="form-control">
                </div>
            </div>
        </div>
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
    <div class="card mt-4">
        @if (!empty($customers) && $customers->count())
            <div class="card-body ">
                <div class="table-responsive">
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                {{-- <th>Comapny Name</th> --}}
                                <th>Vehicle Name </th>
                                <th>Mobile No.</th>
                                <th>Address</th>
                                @if ($user->hasPermissionTo('customer-edit') || $user->hasPermissionTo('customer-delete'))
                                    <th>Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $index => $customer)
                      {{--     @php
                             dd($customer);
                             @endphp --}}
                                <tr>
                                    <td>{{ $customers->total() - ($customers->firstItem() + $index) + 1 }}</td>
                                    <td>{{ $customer->name . ' ' . $customer->lastname }}</td>
                                    <td>{{ $customer->email ?? '-' }}</td>
                                  {{--  <td>{{ $customer->company_name ?? '-' }}</td>  --}}

                                  <td>
    @forelse($customer->vehicles as $vehicle)
        <div>{{ $vehicle->brand }} {{ $vehicle->variant }} ({{ $vehicle->year }})</div>
    @empty
        -
    @endforelse
</td>

                                    <td>{{ $customer->mobile_no ?? '-' }}</td>
                                    <td>{{ $customer->address ?? '-' }}</td>
                                    @if ($user->hasPermissionTo('customer-edit') || $user->hasPermissionTo('customer-delete'))
                                        <td>
                                            @if ($user->hasPermissionTo('customer-edit'))
                                                <a wire:click="edit({{ $customer->id }})" class="btn btn-sm p-0"><i
                                                        class="bx bxs-edit"></i> <span class="small"></span></a>
                                            @endif
                                            @if ($user->hasPermissionTo('customer-delete'))
                                                <a wire:click="confirmDelete({{ $customer->id }})"
                                                    class="btn btn-sm p-0"><i class="fadeIn animated bx bx-trash"></i>
                                                    <span class="small"></span></a>
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pagination-wrapper">
                        {{ $customers->links() }}
                    </div>
                </div>
            </div>
        @else
            <div class="my-2">
                <div class="alert alert-info">No Customer found!</div>
            </div>
        @endif
    </div>

</div>
@section('footerscript')
    <script>
        document.addEventListener('livewire:init', () => {
            // Select2 logic removed for 4-dropdown system
        });
    </script>

<script>
    document.getElementById('toggleDetailsBtn').addEventListener('click', function () {
        const section = document.getElementById('detailsSection');
        const isVisible = section.style.display === 'block';

        section.style.display = isVisible ? 'none' : 'block';
        this.textContent = isVisible ? 'Show Details' : 'Hide Details';
    });
</script>
@endsection
