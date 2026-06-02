<div>


    <div class="card">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div class="breadcrumb-title pe-2" style="border: none;">Update Profile</div>
            <div class="pe-3">
            </div>
        </div>
    </div>

    <div class="card radius-10 w-100 mt-2">
        <div class="card-body">
            <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">
                <div class="modal-body py-3">
                    @csrf
                    <div class="row g-3">
                        <!-- Company Name -->
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">
                                Company Name <sup class="text-danger">*</sup>
                            </label>
                            <input type="text" wire:model="name" name="first_name" id="first_name"
                                class="form-control" placeholder="Enter Company Name">
                            @if ($errors->has('name'))
                                <span class="text-danger error">
                                    {{ $errors->first('name') }}
                                </span>
                            @endif
                        </div>



                        <!-- Email -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Email<sup class="text-danger">*</sup></label>
                                <input type="email" wire:model="email" class="form-control" placeholder="Enter Email">
                            </div>
                            @error('email')
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

                        <!-- Birth Date -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Birth Date<sup class="text-danger">*</sup></label>
                                <input type="date" wire:model="birth_date" class="form-control">
                            </div>
                            @error('birth_date')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- GST Number -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">GST Number</label>
                                <input type="text" wire:model="gst_number" class="form-control"
                                    placeholder="Enter GST Number">
                            </div>
                            @error('gst_number')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Country -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Country<sup class="text-danger">*</sup></label>
                                <select class="form-select" wire:model="country_id"
                                    wire:change="stateData($event.target.value)">
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">State<sup class="text-danger">*</sup></label>
                                <select class="form-select" wire:model="state_id"
                                    wire:change="cityData($event.target.value)">
                                    <option value="">Select State</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('state_id')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- City -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">City<sup class="text-danger">*</sup></label>
                                <select class="form-select" wire:model="city_id">
                                    <option value="">Select City</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('city_id')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class=" col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="pincode">Pincode<span
                                        class="text-danger">*</span></label>
                                <input type="number" class="form-control" wire:model="pincode"
                                    placeholder="Pincode">
                            </div>
                            @error('pincode')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div class="col-md-12">
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
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        {{ $isEdit ? 'Update' : 'Create' }}
                        <i class="spinner-border spinner-border-sm" wire:loading></i>
                    </button>
                </div>
            </form>


        </div>
    </div>
</div>
