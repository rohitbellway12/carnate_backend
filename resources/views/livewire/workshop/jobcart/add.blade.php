 <div> 
 
    <div class="modal @if($showDentCar) show @endif" tabindex="-1" style="opacity: 1; background-color: #0606068c; display: @if($showDentCar) block @else none @endif;">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                {{-- <form wire:submit.prevent="{{ $showDentCar ? 'saveImage' : 'saveImage' }}"> --}}
                    <div class="modal-header">
                        <button type="button" class="btn-close" wire:click="closeModal" aria-label="Close"></button>
                    </div>
    
                    @if(!empty($jobCardsDentImage))
                        <img id="carImageTag" src="{{ asset('public/'.$jobCardsDentImage->Image->path) }}">
                        <div class="row">
                            <div class="col-6 mx-2">
                                <button id="deleteBtn" onclick="imageDelete(<?= $jobCardsDentImage->id ?>, <?= $jobCardsDentImage->Image->id ?>)" class="btn btn-danger mt-3 rounded text-white border-white" fdprocessedid="3j5af">
                                    Delete Image
                                </button>
                            </div>
                        </div>
                    @else
                        <div class="modal-body py-3">
                            <!-- Control Buttons -->
                            <div class="controls">
                                <button id="dentBtn" class="btn btn-warning active">Dent</button>
                                <button id="scratchBtn" class="btn btn-success">Scratch</button>
                                <button id="breakBtn" class="btn btn-danger">Break</button>
                                <button id="eraseBtn" class="btn btn-secondary">Erase</button>
                                <button id="clearBtn" class="btn btn-light">Clear All</button>
                                <button id="saveBtn" class="btn btn-primary mt-2">Save Image</button>
                            </div>
    
                            <!-- Car Image -->
                            <img id="carImageTag" src="{{ asset('assets/dentcar/car.png') }}" style="display:none;" alt="Car Image">
    
                            <!-- Canvas Container -->
                            <div class="canvas-container" style="position: relative;">
                                <!-- Background Canvas -->
                                <canvas id="backgroundCanvas"></canvas>
                                <!-- Overlay Canvas (For Drawing) -->
                                <canvas id="overlayCanvas" style="position: absolute; top: 0; left: 0;"></canvas>
                            </div>
                        </div>
                    @endif
            </div>
        </div>
    </div>
     <div class="modal @if ($showModal) show @endif" tabindex="-1"
         style="opacity:1; background-color:#0606068c; display:@if ($showModal) block @endif">
         <div class="modal-dialog modal-lg">
             <div class="modal-content">
                 <form wire:submit.prevent="{{ $add ? 'storeCustomer' : 'storeCustomer' }}">
                     <div class="modal-header">
                         <h4 class="modal-title">{{ $add ? 'Edit Staff' : 'Customer Details' }}</h4>
                         <button type="button" class="btn-close" wire:click="$set('showModal', false)"
                             data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body py-3">
                         @csrf

                         <div class="row g-3">
                             <!-- Name -->
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label class="form-label">First Name<sup class="text-danger">*</sup></label>
                                     <input type="text" wire:model="name" class="form-control"
                                         placeholder="Enter First Name">
                                 </div>
                                 @error('name')
                                     <span class="text-danger error">{{ $message }}</span>
                                 @enderror
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

                             <!-- Gender -->
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Gender<sup class="text-danger">*</sup></label>
                                    <div class="d-flex">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="gender-male" value="1" wire:model="gender">
                                            <label class="form-check-label" for="gender-male">Male</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="gender-female" value="2" wire:model="gender">
                                            <label class="form-check-label" for="gender-female">Female</label>
                                        </div>
                                    </div>
                                </div>
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
                                     <label class="form-label">Email<sup class="text-danger">*</sup></label>
                                     <input type="email" wire:model="email" class="form-control"
                                         placeholder="Enter Email">
                                 </div>
                                 @error('email')
                                     <span class="text-danger error">{{ $message }}</span>
                                 @enderror
                             </div>

                             <!-- Password -->
                             @if ($add == false)
                                 <div class="col-md-6">
                                     <div class="form-group">
                                         <label class="form-label">Password<sup class="text-danger">*</sup></label>
                                         <input type="password" wire:model="password" class="form-control"
                                             placeholder="Enter Password">
                                     </div>
                                     @error('password')
                                         <span class="text-danger error">{{ $message }}</span>
                                     @enderror
                                 </div>
                                 <div class="col-md-6">
                                     <div class="form-group">
                                         <label class="form-label">Confirm Password<sup
                                                 class="text-danger">*</sup></label>
                                         <input type="password" wire:model="confirmpassword" class="form-control"
                                             placeholder="Enter Confirm Password">
                                     </div>
                                     @error('password')
                                         <span class="text-danger error">{{ $message }}</span>
                                     @enderror
                                 </div>
                             @endif

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

                             <h4 class="modal-title">ADDRESS</h4>
                             <hr>
                             <!-- Country -->
                             <div class="@if ($add == true) col-md-6 @else col-md-6 @endif">
                                 <div class="form-group">
                                     <label class="form-label">Country<sup class="text-danger">*</sup></label>
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
                             <div class="@if ($add == true) col-md-6 @else col-md-6 @endif">
                                 <div class="form-group">
                                     <label class="form-label">State<sup class="text-danger">*</sup></label>
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
                             <div class="@if ($add == true) col-md-6 @else col-md-6 @endif">
                                 <div class="form-group">
                                     <label class="form-label">City<sup class="text-danger">*</sup></label>
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

                             <!-- Address -->
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label class="form-label">Address</label>
                                     <textarea wire:model="address" class="form-control" placeholder="Enter Address"></textarea>
                                 </div>
                                 @error('address')
                                     <span class="text-danger error">{{ $message }}</span>
                                 @enderror
                             </div>
                         </div>
                     </div>
          
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" wire:click="$set('showModal', false)"
                     data-bs-dismiss="modal">Cancel</button>
                 <button type="submit" class="btn btn-primary">
                     {{ $add ? 'Update' : 'Create' }}
                     <i class="spinner-border spinner-border-sm" wire:loading></i>
                 </button>
             </div>
             </form>
         </div>
     </div>
    </div>
    <div class="modal @if ($showCustomerVoice) show @endif" tabindex="-1"
    style="opacity:1; background-color:#0606068c; display:@if ($showCustomerVoice) block @endif">
   <div class="modal-dialog modal-lg">
       <div class="modal-content">
         <form wire:submit.prevent="{{ $add ? 'customerVoice' : 'customerVoice' }}">
               <div class="modal-header">
                   <h4 class="modal-title">{{ $addCustomerVoice ? 'Edit Staff' : 'Customer Voice' }}</h4>
                   <button type="button" class="btn-close" wire:click="$set('showCustomerVoice', false)"
                       data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body py-3">
                   <p class="btn btn-success rounded" wire:click="addField"> Add More</p>

                   @foreach($customerVoices as $index => $voice)
                       <div class="mb-3 col-lg-12 dynamic-field">
                           <div class="row">
                               <div class="col-11">
                                   <label for="validationCustom01" class="form-label">Customer Voice</label><br>
                                   <input type="text" class="form-control  @error("customerVoices.$index") is-invalid @enderror" 
                                          placeholder="Customer Voice" 
                                          wire:model="customerVoices.{{ $index }}">
                                   @error("customerVoices.$index") 
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
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-secondary" wire:click="$set('showCustomerVoice', false)"
                       data-bs-dismiss="modal">Cancel</button>
                   <button type="submit" class="btn btn-primary">
                       {{ $addCustomerVoice ? 'Save' : 'Save' }}
                       <i class="spinner-border spinner-border-sm" wire:loading></i>
                   </button>
               </div>
           </form>
       </div>
   </div>
</div>

<div class="modal @if ($showPhoto) show @endif" tabindex="-1"
style="opacity:1; background-color:#0606068c; display:@if ($showPhoto) block @endif">
<div class="modal-dialog modal-lg">
   <div class="modal-content">
     <form wire:submit.prevent="{{ $add ? 'addphoto' : 'addphoto' }}">
           <div class="modal-header">
               <h4 class="modal-title">{{ $addphoto ? 'Add Photo' : 'Add Photo' }}</h4>
               <button type="button" class="btn-close" wire:click="$set('showPhoto', false)"
                   data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body py-3">
            <div class="mb-3">
                <label for="image" class="form-label">Car Images</label>
                <input type="file" id="images" class="form-control" wire:model="images" multiple>

                @error('image') 
                    <span class="text-danger">{{ $message }}</span> 
                @enderror
            </div>
           </div>
           <div class="modal-footer">
               <button type="button" class="btn btn-secondary" wire:click="$set('showPhoto', false)"
                   data-bs-dismiss="modal">Cancel</button>
               <button type="submit" class="btn btn-primary">
                   {{ $addphoto ? 'Save' : 'Save' }}
                   <i class="spinner-border spinner-border-sm" wire:loading></i>
               </button>
           </div>
       </form>
   </div>
</div>
</div>
<div>
    <!-- Modal -->
    <div class="modal @if ($showPhoto) show @endif" tabindex="-1"
        style="opacity:1; background-color:#0606068c; display:@if ($showPhoto) block @endif">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form wire:submit.prevent="addphoto">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">{{ $addphoto ? 'Add Photo' : 'Add Photo' }}</h4>
                        <button type="button" class="btn-close" wire:click="$set('showPhoto', false)"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body py-3">
                        <div class="mb-3">
                            <label for="images" class="form-label">Car Images</label>
                            <input type="file" id="images" class="form-control" wire:model="images" multiple>

                            <!-- Validation Error -->
                            @error('images.*') 
                                <span class="text-danger">{{ $message }}</span> 
                            @enderror
                        </div>

                        <!-- Preview Selected Images -->
                        @if ($images)
                            <div class="row">
                                @foreach ($images as $image)
                                    <div class="col-md-3 mb-3">
                                        <img src="{{ $image->temporaryUrl() }}" class="img-thumbnail" alt="Preview">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="$set('showPhoto', false)"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            {{ $addphoto ? 'Save' : 'Save' }}
                            <i class="spinner-border spinner-border-sm" wire:loading></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal @if ($showAccessoriesVoice) show @endif" tabindex="-1"
style="opacity:1; background-color:#0606068c; display:@if ($showAccessoriesVoice) block @endif">
<div class="modal-dialog modal-lg">
   <div class="modal-content">
     <form wire:submit.prevent="{{ $add ? 'accessoriesVoice' : 'accessoriesVoice' }}">
           <div class="modal-header">
               <h4 class="modal-title">{{ $addAccessoriesVoice ? 'Accessories' : 'Accessories' }}</h4>
               <button type="button" class="btn-close" wire:click="$set('showAccessoriesVoice', false)"
                   data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body py-3">
               <p class="btn btn-success rounded" wire:click="addAccessorieField"> Add More</p>

               @foreach($accessoriesVoices as $index => $voice)
                   <div class="mb-3 col-lg-12 dynamic-field">
                       <div class="row">
                           <div class="col-11">
                               <label for="validationCustom01" class="form-label">Accessories</label><br>
                               <input type="text" class="form-control" 
                                      placeholder="Enter Accessories" 
                                      wire:model="accessoriesVoices.{{ $index }}">
                               @error("accessoriesVoices.$index") 
                                   <span class="text-danger">{{ $message }}</span> 
                               @enderror
                           </div>
                           @if($index > 0)
                           <div class="col-1 mt-4">
                            <button type="button" 
                                    class="btn btn-danger btn-xs p-1 remove-field rounded text-white border-white  mt-3" 
                                    wire:click="removeAccessorieField({{ $index }})" 
                                    style="font-size: 12px; width: 19px; height: 24px; display: flex; align-items: center; ">
                                <i class="fa fa-trash" aria-hidden="true" style="font-size: 10px;"></i>
                            </button>
                        </div>
                           @endif
                       </div>
                   </div>
               @endforeach
           </div>
           <div class="modal-footer">
               <button type="button" class="btn btn-secondary" wire:click="$set('showAccessoriesVoice', false)"
                   data-bs-dismiss="modal">Cancel</button>
               <button type="submit" class="btn btn-primary">
                   {{ $addAccessoriesVoice ? 'Save' : 'Save' }}
                   <i class="spinner-border spinner-border-sm" wire:loading></i>
               </button>
           </div>
       </form>
   </div>
</div>
</div>

<div class="modal @if ($showWorkNote) show @endif" tabindex="-1"
style="opacity:1; background-color:#0606068c; display:@if ($showWorkNote) block @endif">
<div class="modal-dialog modal-lg">
   <div class="modal-content">
     <form wire:submit.prevent="{{ $add ? 'workVoice' : 'workVoice' }}">
           <div class="modal-header">
               <h4 class="modal-title">{{ $addWorkNote ? 'Work Note' : 'Work Note' }}</h4>
               <button type="button" class="btn-close" wire:click="$set('showWorkNote', false)"
                   data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body py-3">
               <p class="btn btn-success rounded" wire:click="addWorkField"> Add More</p>

               @foreach($workVoices as $index => $voice)
                   <div class="mb-3 col-lg-12 dynamic-field">
                       <div class="row">
                           <div class="col-11">
                               <label for="validationCustom01" class="form-label">Work Note</label><br>
                               <input type="text" class="form-control" 
                                      placeholder="Work Note" 
                                      wire:model="workVoices.{{ $index }}">
                               @error("workVoices.$index") 
                                   <span class="text-danger">{{ $message }}</span> 
                               @enderror
                           </div>
                           @if($index > 0)
                           <div class="col-1 mt-4">
                            <button type="button" 
                                    class="btn btn-danger btn-xs p-1 remove-field rounded text-white border-white  mt-3" 
                                    wire:click="removeWorkField({{ $index }})" 
                                    style="font-size: 12px; width: 19px; height: 24px; display: flex; align-items: center; ">
                                <i class="fa fa-trash" aria-hidden="true" style="font-size: 10px;"></i>
                            </button>
                        </div>
                           @endif
                       </div>
                   </div>
               @endforeach
           </div>
           <div class="modal-footer">
               <button type="button" class="btn btn-secondary" wire:click="$set('showWorkNote', false)"
                   data-bs-dismiss="modal">Cancel</button>
               <button type="submit" class="btn btn-primary">
                   {{ $addWorkNote ? 'Save' : 'Save' }}
                   <i class="spinner-border spinner-border-sm" wire:loading></i>
               </button>
           </div>
       </form>
   </div>
</div>
</div>
@include('livewire.workshop.jobcart.vehical_modal')


 <div class="modal-body py-3">
    <div class="card h-100">
        <div class="card-body">
    <div class="page-title ">
        <div class="nav_menu">
            <nav class="d-flex align-items-center justify-content-between mb-3">
                <!-- Navigation Toggle and Back Link -->
                <div class="nav toggle">
                    <a href="{{ route('workshop.jobcart') }}" class="d-flex align-items-center">
                        <img src="{{ asset('supplier/Back Arrow.png') }}" class="back-arrow me-2">
                        <div class="breadcrumb-title pe-2 text-dark" style="border: none;">Add Job-Card</div>
                    </a>
                </div>

                <!-- Job-Card Details -->
                <div class="ulprofile">
                    <div class="input-group mt-2">
                        <span class="input-group-text">Job-Card No.</span>
                        <input type="text" form="jobcard-form" id="jobcard_number" name="jobcard_number"
                            class="form-control bg-light" value="{{ $jobcardNumbers }}" readonly
                            placeholder="Job-Card Number" aria-label="Job-Card Number">
                        <span class="input-group-text">Date</span>
                        <input type="date" class="form-control bg-light" value="{{ now()->format('Y-m-d') }}"
                            readonly placeholder="Date" aria-label="Date">
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
</div>
     @csrf
     <div class="row">
         <div class="col-6">
             <div class="card h-100">
                 <div class="card-body">
                     <h6 class="text-center m-0">
                         <b>Search or Create New User</b>
                     </h6>
                     <hr>
                     <label for="customer-dropdown" class="form-label">Customer Name</label>
                     <div class="input-group mb-3"> 
                             <select class="form-control"  style="width: 75%;" id="customer-dropdown"  wire:model="customer_name" wire:change="vehicleData($event.target.value)"> 
                             <option value="">--Select Customer--</option>
                             @foreach ($customers as $customer)
                             <option value="{{ $customer->id }}">{{ $customer->name .' '. $customer->lastname }}</option> 
                             @endforeach
                         </select>
                         <button type="button" 
                         class="btn btn-outline-secondary text-light bg-primary fl margin-left-0" 
                         wire:click="addCustomer">
                         {{ trans('+') }}
                     </button>
                     @error('customer_name')
                     <span class="text-danger error">{{ $message }}</span>
                    @enderror
                     </div>
                     <label for="vehicle-id" class="form-label">Vehical Name</label>
                     <div class="input-group mb-3">
                         <select  wire:model="vehicle_id" id="vehicle_id" class="form-control">
                             <option value="" selected >-- Select vehicle --
                             </option>
                             @foreach ($vehicles as $vehicle)
                                 <option value="{{ $vehicle->id }}">{{ $vehicle->modelname .'/'. $vehicle->brand->vehicle_brand .'/'. $vehicle->number_plate .'/'. $vehicle->id }}</option>
                             @endforeach
                         </select>
                         <button type="button" 
                         class="btn btn-outline-secondary text-light bg-primary fl margin-left-0" 
                         wire:click="addVehical">
                         {{ trans('+') }}
                     </button>
                  
                     </div>
                     @error('vehicle_id')
                     <span class="text-danger error">{{ $message }}</span>
                    @enderror
                 </div>
             </div>
         </div>
         <div class="col-6">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h6 class="m-0"><b>Job-Card Details</b></h6>
                        <button type="button" class="btn btn-sm btn-info">Last History</button>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-floating mb-3">
                                <input type="number" wire:model="km_reading" class="form-control"
                                    id="km_reading" value="0" min="0">
                                <label for="km_reading">KM Reading</label>
                            </div>
                            @error('km_reading')
                            <span class="text-danger error">{{ $message }}</span>
                           @enderror
                        </div>
                        <div class="col-4">
                            <label for="fual level" class="form-label">Fual Level</label>
                            <input type="range" class="form-range" id="fual level"
                            wire:model="fual_level" min="0" max="100">
                            @error('fual_level')
                            <span class="text-danger error">{{ $message }}</span>
                           @enderror
                        </div>
                        <div class="col-4">
                            <div class="form-floating">
                                <select class="form-select" id="supervisor" wire:model="supervisor"
                                    aria-label="Floating label select example"> 
                                </select> 
                                <label for="supervisor">Supervisor</label>
                            </div>
                            @error('supervisor')
                            <span class="text-danger error">{{ $message }}</span>
                           @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="javascript:void(0)"  wire:click="addVoice" 
                            class="text-center p-2 position-relative d-flex flex-column justify-content-between">
                            <img src="{{ asset('assets/jobcard_img/customer_voice2.jpg') }}"
                                alt="image" width="80">
                            <p class="my-2">Customer voice</p>
                            <p class="position-absolute list-count rounded-circle bg-primary text-white  customerVoiceCount"
                                style="width: 18px !important;height:18px !important;">
                              {{ $customerVoiceCount }}
                            </p>
                        </a>
                        <a href="javascript:void(0)" wire:click="showDent" 
                            class="text-center p-2 position-relative d-flex flex-column justify-content-between">
                            <img src="{{ asset('assets/jobcard_img/dent.jpg') }}"
                                alt="image" width="80">
                            <p class="my-2">Dent Marks</p>
                            <p class="position-absolute list-count rounded-circle bg-primary text-white"
                                style="width: 18px !important;height:18px !important;">
                              {{ $jobcarddentCount }}
                            </p>
                        </a>
                        <a href="javascript:void(0)" wire:click="addImage" 
                            class="text-center p-2 position-relative d-flex flex-column justify-content-between">
                            <img src="{{ asset('assets/jobcard_img/photo.jpg') }}"
                                alt="image" width="80">
                            <p class="my-2">Photos</p>
                            <p class="position-absolute list-count rounded-circle bg-primary text-white jobcardImage"
                                style="width: 18px !important;height:18px !important;">
                              {{ $photosCount }}
                            </p>
                        </a>
                        <a href="javascript:void(0)" wire:click="addAccessorie" 
                            class="text-center p-2 position-relative d-flex flex-column justify-content-between">
                            <img src="{{ asset('assets/jobcard_img/accessory.jpg') }}"
                                alt="image" width="80">
                            <p class="my-2">Accessories</p>
                            <p class="accessaryCount position-absolute list-count rounded-circle bg-primary text-white"
                                style="width: 18px !important;height:18px !important;">
                               {{ $accessariesCount }}
                            </p>
                        </a>
                        <a href="javascript:void(0)" wire:click="addWork" 
                            class="text-center p-2 position-relative d-flex flex-column justify-content-between">
                            <img src="{{ asset('assets/jobcard_img/work_note.jpg') }}"
                                alt="image" width="80">
                            <p class="my-2">Work Note</p>
                            <p class="workNoteCount position-absolute list-count rounded-circle bg-primary text-white worknotecount"
                                style="width: 18px !important;height:18px !important;">
                               {{ $workNoteCount }}
                            </p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
     </div>


 </div>
 <div class="footer align-items-center">
    <div class="row">
        <!-- SMS Alert Section -->
        <div class="col-auto">
            <div class="form-check form-switch">
                <input wire:model="smsAlert" class="form-check-input fs-6" type="checkbox" role="switch" id="sms-alert">
                <label class="form-check-label fs-5" for="sms-alert">SMS Alert</label>
            </div>
        </div>
        
        <!-- Create Job-Card Button Section -->
        <div class="col-auto ms-auto">
            <button wire:click="createJobCard" class="btn btn-primary rounded border-0 text-white">Create Job-Card</button>
        </div>
    </div>
</div>



 </div>


 @section('footerscript')
     <script>
         document.addEventListener('livewire:init', function() {

             Livewire.hook('morphed', (message, component) => {
                 $('.select2').select2().on('change', function(e) {
                     const selectedValues = $(this).val();
                     @this.set(e.target.dataset.property, selectedValues);
                 });
             });


         });
     </script>
 @endsection
