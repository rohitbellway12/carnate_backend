<div>
    <div class="container">
        <form wire:submit="update">
            <div class="card">
                <div class="card-header">
                    <h4>Owner Details</h4>
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
                                <label class="form-label">Last Name<sup class="text-danger">*</sup></label>
                                <input type="text" wire:model="lastname" class="form-control"
                                    placeholder="Enter Last Name">
                            </div>
                            @error('lastname')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
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
                                <input type="number" wire:model="mobile_no" class="form-control"
                                    placeholder="Enter Mobile Number">
                            </div>
                            @error('mobile_no')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Birth Date -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Birth Date</label>
                                <input type="date" wire:model="birth_date" class="form-control">
                            </div>
                            @error('birth_date')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Landline Number -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Landline Number</label>
                                <input type="number" wire:model="landline_no" class="form-control"
                                    placeholder="Enter Landline Number">
                            </div>
                            @error('landline_no')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Company Details</h4>
                </div>
                <div class="card-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Company Name<sup class="text-danger">*</sup></label>
                                <input type="text" wire:model="company_name" class="form-control"
                                    placeholder="Enter Company Name">
                            </div>
                            @error('company_name')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Company Email<sup class="text-danger">*</sup></label>
                                <input type="email" wire:model="company_email" class="form-control"
                                    placeholder="Enter Company Email">
                            </div>
                            @error('company_email')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Company Number<sup class="text-danger">*</sup></label>
                                <input type="number" wire:model="company_number" class="form-control"
                                    placeholder="Enter Company Number">
                            </div>
                            @error('company_number')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                   
                        <!-- GST Registered Toggle -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Are you GST Registered?<sup class="text-danger">*</sup></label>
                                <select wire:model.live="is_gst" class="form-select">
                                    <option value="0">No (Cash Invoice)</option>
                                    <option value="1">Yes (Tax Invoice)</option>
                                </select>
                                <small class="text-muted">If 'Yes', Tax details and HSN will show on invoices.</small>
                            </div>
                            @error('is_gst')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>

                        @if ($is_gst == 1)
                            <!-- GST Number -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">GST Number</label>
                                    <input type="text" wire:model="gst_no" class="form-control"
                                        placeholder="Enter GST Number">
                                </div>
                                @error('gst_no')
                                    <span class="text-danger error">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                             <!-- Address -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Company Address<sup class="text-danger">*</sup></label>
                                <textarea wire:model="address" class="form-control" placeholder="Enter Company Address"></textarea>
                            </div>
                            @error('address')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row align-items-center">
                            <div class="col-10 mt-3">
                                <div class="form-group">
                                    <label class="form-label"> Company Logo Image<sup class="text-danger">*</sup></label>
                                    <input type="file" class="form-control" wire:model="image" />
                                </div>
                            </div>
                            <div class="col-2 mt-3">
                                @if (!empty($image))
                                    <img class="img-fluid mt-4 w-75" src="{{ asset($image?->file) }}">
                                @else
                                    @if ($isEdit)
                                        <img class="img-fluid mt-4 w-75" src="{{ asset($image?->file) }}">
                                    @endif
                                @endif
                            </div>
                            @error('image')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row align-items-center">
                            <div class="col-10 mt-3">
                                <div class="form-group">
                                    <label class="form-label"> Company Sign Image<sup class="text-danger">*</sup></label>
                                    <input type="file" class="form-control" wire:model="signImage" />
                                </div>
                            </div>
                            <div class="col-2 mt-3">
                                @if (!empty($signImage))
                                    <img class="img-fluid mt-4 w-75" src="{{ asset($signImage?->file) }}">
                                @else
                                    @if ($isEdit)
                                        <img class="img-fluid mt-4 w-75" src="{{ asset($signImage?->file) }}">
                                    @endif
                                @endif
                            </div>
                            @error('signImage')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Country -->
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label class="form-label">Country<sup class="text-danger">*</sup></label>
                                <select class="form-select" wire:change="stateData($event.target.value,true)"
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
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label class="form-label">State<sup class="text-danger">*</sup></label>
                                <select class="form-select" wire:model="state_id"
                                    wire:change="cityData($event.target.value,true)">
                                    <option value="">Select State</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}" @selected($state->id == $state_id)>
                                            {{ $state->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('state_id')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- City -->
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label class="form-label">City<sup class="text-danger">*</sup></label>
                                <select class="form-select" wire:model="city_id">
                                    <option value="">Select City</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}" @selected($city->id == $city_id)>
                                            {{ $city->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('city_id')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Pincode -->
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="pincode">Pincode<sup
                                        class="text-danger">*</sup></label>
                                <input type="number" name="pincode" id="pincode" wire:model="pincode"
                                    class="form-control" placeholder="Pincode">
                            </div>
                            @error('pincode')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-end">
                <button class="btn btn-primary" wire:loading.attr="disabled">Update<i
                        class="spinner-border spinner-border-sm" wire:loading></i></button>
            </div>
        </form>
    </div>
</div>
