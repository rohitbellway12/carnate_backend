<div>
    <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">
        @csrf
        <div class="card">
            <div class="card-header">
                <h4>Owner Details</h4>
            </div>
            <div class="card-body">
                <div class="row g-3">
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Email<sup class="text-danger">*</sup></label>
                            <input type="email" wire:model="email" class="form-control" placeholder="Enter Email">
                        </div>
                        @error('email')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Birth Date</label>
                            <input type="date" wire:model="birth_date" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Landline Number</label>
                            <input type="text" wire:model="landline_no" class="form-control"
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
                <div class="row  g-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Company Name<sup class="text-danger">*</sup></label>
                            <input type="text" class="form-control" wire:model="company_name"
                                placeholder="Company Name">
                        </div>
                        @error('company_name')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Company Email<sup class="text-danger">*</sup></label>
                            <input type="email" wire:model="branch_email" class="form-control"
                                placeholder="Enter Branch Email">
                        </div>
                        @error('branch_email')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Company Number<sup class="text-danger">*</sup></label>
                            <input type="text" wire:model="branch_number" class="form-control"
                                placeholder="Enter Branch Number">
                        </div>
                        @error('branch_number')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">GST Billing</label>
                            <select class="form-select" wire:model.live="is_gst">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                        @error('is_gst')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6" @if($is_gst == 0) style="display:none;" @endif>
                        <div class="form-group">
                            <label class="form-label">GST Number</label>
                            <div class="input-group">
                                <input type="text" wire:model="gst" placeholder="Enter GST" class="form-control">
                            </div>
                        </div>
                        @error('gst')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row align-items-center">
                        <div class="col-10 mt-3">
                            <div class="form-group">
                                <label class="form-label"> Company Logo Image <span class="text-danger">*</span></label>
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
                                <label class="form-label"> Company Sign Image<span class="text-danger">*</span></label>
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
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Tagline </label>
                            <input type="text" wire:model="tagline" placeholder="Enter Tagline"
                                class="form-control" value="">
                        </div>
                        @error('tagline')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">Company Address<span class="text-danger">*</span></label>
                            <textarea wire:model="address" class="form-control" placeholder="Enter Address"></textarea>
                        </div>
                        @error('address')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="@if ($isEdit == true) col-md-6 @else col-md-4 @endif">
                        <div class="form-group">
                            <label class="form-label">Country<span class="text-danger">*</span></label>
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
                    <div class="@if ($isEdit == true) col-md-6 @else col-md-4 @endif">
                        <div class="form-group">
                            <label class="form-label">State<span class="text-danger">*</span></label>
                            <select class="form-select select2" wire:model="state_id"
                                wire:change="cityData($event.target.value,true)">
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
                    <div class="@if ($isEdit == true) col-md-6 @else col-md-4 @endif">
                        <div class="form-group">
                            <label class="form-label">City<span class="text-danger">*</span></label>
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
                    <!-- Pincode -->
                    <div class=" col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="pincode">Pincode<sup class="text-danger">*</sup></label>
                            <input type="text" name="pincode" id="pincode" wire:model="pincode"
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
            <button type="submit" class="btn btn-primary">
                {{ $isEdit ? 'Update' : 'Create' }}
                <i class="spinner-border spinner-border-sm" wire:loading></i>
            </button>
        </div>
    </form>
</div>
