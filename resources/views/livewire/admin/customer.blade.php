<div>
    <!-- Success Message -->
    @if (session()->has('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <div class="card">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div class="breadcrumb-title pe-2" style="border: none;"><i class="fas fa-handshake fs-5"></i> Customer</div>
            @if (@$admin->hasPermissionTo('customer-add'))
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
                <input type="text" class="form-control" placeholder="Search name ... " wire:model.live="searchfilter" fdprocessedid="blgf5">
            </div>
            <div class="col-9 text-right">
                <button type="button" class="mr-2 btn btn-info text-white rounded-0  float-end" wire:click="resetFilter" fdprocessedid="orntg">Clear</button>
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
                    <h4 class="modal-title">{{ $isEdit ? 'Edit Customer' : 'Customer Details' }}</h4>
                    <button type="button" class="btn-close" wire:click="colseModel"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-3">
                    @csrf

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
                                    <option value="ms">M.S.</option>
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
                                <label class="form-label">Last Name</label>
                                <input type="text" wire:model="lastname" class="form-control"
                                    placeholder="Enter Last Name">
                            </div>
                            @error('lastname')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                           <!-- Birth Date -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">GST Number</label>
                                <input type="text" wire:model="gst_no" class="form-control"  placeholder="Enter GST Number">
                            </div>
                            @error('gst_no')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Mobile Number -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Mobile Number<sup class="text-danger">*</sup></label>
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
                                <label class="form-label">Email</label>
                                <input type="email" wire:model="email" class="form-control"
                                    placeholder="Enter Email">
                            </div>
                            @error('email')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>


                        <!-- Birth Date -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Birth Date</label>
                                <input type="date" wire:model="birth_date" class="form-control">
                            </div>
                            @error('birth_date')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Country -->
                        <div class="@if ($isEdit == true) col-md-6 @else col-md-6 @endif">
                            <div class="form-group">
                                <label class="form-label">Country</label>
                                <select class="form-select" wire:change="stateData($event.target.value)"
                                    wire:model="country_id">
                                    <option value="">Select Country</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('country_id')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- State -->
                        <div class="@if ($isEdit == true) col-md-6 @else col-md-6 @endif">
                            <div class="form-group">
                                <label class="form-label">State</label>
                                <select class="form-select" wire:model="state_id"
                                    wire:change="cityData($event.target.value)">
                                    <option value="">Select State</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}" @selected($state_id == $state->id)>
                                            {{ $state->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('state_id')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- City -->
                        <div class="@if ($isEdit == true) col-md-6 @else col-md-6 @endif">
                            <div class="form-group">
                                <label class="form-label">City</label>
                                <select class="form-select" wire:model="city_id">
                                    <option value="">Select City</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}" @selected($city_id == $city->id)>
                                            {{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('city_id')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class=" col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="pincode">Pincode<span class="text-danger"></span></label>
                                <input type="number" class="form-control" wire:model="pincode" placeholder="Pincode">
                            </div>
                            @error('pincode')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Address -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Address<sup class="text-danger"></sup></label>
                                <textarea wire:model="address" class="form-control" placeholder="Enter Address"></textarea>
                            </div>
                            @error('address')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="colseModel"
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
                            <th>Mobile No.</th>
                            <th>Address</th>
                            @if (@$admin->hasPermissionTo('customer-edit') || @$admin->hasPermissionTo('customer-delete'))
                            <th>Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $index => $customer)
                        <tr>
                            <td>{{ $customers->total() - ($customers->firstItem() + $index) + 1 }}</td>
                            <td>{{ ($customer->name . ' ' . $customer->lastname)}}</td>
                            <td>{{ $customer->email ?? '-' }}</td>
                            <td>{{ $customer->mobile_no ?? '-' }}</td>
                            <td>{{ $customer->address ?? '-'  }}</td>
                            <td>
                                @if (@$admin->hasPermissionTo('customer-edit'))
                                <a wire:click="edit({{ $customer->id }})" class="btn btn-sm p-0"><i
                                        class="bx bxs-edit"></i> <span class="small"></span></a>
                            @endif
                            @if (@$admin->hasPermissionTo('customer-delete'))
                                <a wire:click="confirmDelete({{ $customer->id }})"
                                    class="btn btn-sm p-0"><i class="fadeIn animated bx bx-trash"></i> <span
                                        class="small"></span></a>
                            @endif
                            </td>
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
@endsection
