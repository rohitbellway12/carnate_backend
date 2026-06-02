 <div>
    <style>
       
        #spare-table th,
        #spare-table .add-spare-btn,
        .green-variant {
            background-color: #2E7D32 !important;
            color: white !important;
        }

        #lubes-table th,
        #lubes-table .add-spare-btn,
        .blue-variant,
        .blue-variant i.fa {
            background-color: #1976D2 !important;
            color: white !important;
        }

        #tools-table th,
        #tools-table .add-spare-btn,
        .orange-variant,
        .orange-variant i.fa {
            background-color: #D84315 !important;
            color: white !important;
        }

        .btn-outline-secondary {
        color: #333333;
            }

        .grey-variant,
        .grey-variant i.fa {
            background-color: #424242 !important;
            color: white !important;
        }

        #accessory-table th,
        #accessory-table .add-spare-btn,
        .purple-variant,
        .purple-variant i.fa {
            background-color: #D84315 !important;
            color: white !important;
        }

        .green-text {
            color: #2E7D32 !important;
        }

        .blue-text {
            color: #1976D2 !important;
        }

        .orange-text {
            color: #D84315 !important;
        }

        .grey-text {
            color: #424242 !important;
        }

        .purple-text {
            color: #D84315 !important;
        }

        #labour-table th,
        #labour-table .add-spare-btn,
        .bg-yellow-orange {
            background: #A52A2A !important;
            color: #fff !important;
        }

        .table-view table th {
            text-wrap: nowrap !important;
        }
        th {
            font-weight: 300;
        }
        .m-0 {
            font-weight: 500; 
        }

       

    </style>
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
                   <?php //echo "<pre>";print_r($voice);die; ?>
                   <div class="mb-3 col-lg-12 dynamic-field">
                       <div class="row">
                           <div class="col-11">
                               <label for="validationCustom01" class="form-label">Customer Voice</label><br>
                               <input type="text" class="form-control" 
                                      placeholder="Customer Voice" 
                                      wire:model="customerVoices.{{ $index }}" >
                               @error("customerVoices.$index") 
                                   <span class="text-danger">{{ $message }}</span> 
                               @enderror
                           </div>
                           @if($index > 0)
                           <div class="col-1 mt-4">
                               <button type="button" 
                                       class="btn btn-danger btn-xs p-1 remove-field rounded text-white border-white mt-3" 
                                       wire:click="removeField({{ $index }})" 
                                       style="font-size: 12px; width: 19px; height: 24px; display: flex; align-items: center;">
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
     <form wire:submit.prevent="{{ $add ? 'customerVoice' : 'customerVoice' }}">
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

<div class="modal @if ($showAccessoriesVoice) show @endif" tabindex="-1"
style="opacity:1; background-color:#0606068c; display:@if ($showAccessoriesVoice) block @endif">
<div class="modal-dialog modal-lg">
   <div class="modal-content">
     <form wire:submit.prevent="{{ $addAccessoriesVoice ? 'accessoriesVoice' : 'accessoriesVoice' }}">
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
<div class="modal @if ($showPrint) show @endif" tabindex="-1"
style="opacity:1; background-color:#0606068c; display:@if ($showPrint) block @endif">
<div class="modal-dialog modal-md">
   <div class="modal-content">
     <form wire:submit.prevent="{{ $isPrint ? 'workVoice' : 'workVoice' }}">
           <div class="modal-header">
               <button type="button" class="btn-close" wire:click="$set('showPrint', false)"
                   data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body py-3">
            <div class="row g-3">
                <!-- Name -->
                <div class="col-md-12">
                    <div class="form-group">
                        <h5 class=" mb-4" style="font-weight: 300;" >Please select type<sup class="text-danger">*</sup></h5>
                      
                        <!-- Radio Buttons for selecting type -->
                        <div>
                            <label class="form-check-label">
                                <input type="radio" wire:model="type" value="mechanic" class="form-check-input">
                                Mechanic
                            </label>
                            <label class="form-check-label ml-3">
                                <input type="radio" wire:model="type" value="worksheet_estimate" class="form-check-input">
                                Worksheet Estimate
                            </label>
                        </div>
                    </div>
                    
                    @error('type')
                        <span class="text-danger error">{{ $message }}</span>
                    @enderror
                </div>
                
           </div>
        </div>
           <div class="modal-footer">
               <button type="button" class="btn btn-secondary" wire:click="$set('showPrint', false)"
                   data-bs-dismiss="modal">Cancel</button>
               <button type="submit" class="btn btn-primary">
                   {{ $isPrint ? 'Print' : 'Print' }}
                   <i class="spinner-border spinner-border-sm" wire:loading></i>
               </button>
           </div>
       </form>
   </div>
</div>
</div>

<div class="modal @if ($showDownload) show @endif" tabindex="-1"
style="opacity:1; background-color:#0606068c; display:@if ($showDownload) block @endif">
<div class="modal-dialog modal-md">
   <div class="modal-content">
     <form wire:submit.prevent="{{ $isDownload ? 'workVoice' : 'workVoice' }}">
        <div class="modal-header">
            <h4 class="modal-title">{{ $isDownload ? 'Download pdf' : 'Download pdf' }}</h4>
            <button type="button" class="btn-close" wire:click="$set('showDownload', false)"
                data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
           <div class="modal-body py-3">
            <div class="row g-3">
                <!-- Name -->
                <div class="col-md-12">
                    <div class="form-group">
                        <h5 class=" mb-4" style="font-weight: 300;" >Please select type<sup class="text-danger">*</sup></h5>
                      
                        <!-- Radio Buttons for selecting type -->
                        <div>
                            <label class="form-check-label">
                                <input type="radio" wire:model="type" value="mechanic" class="form-check-input">
                                Mechanic
                            </label>
                            <label class="form-check-label ml-3">
                                <input type="radio" wire:model="type" value="worksheet_estimate" class="form-check-input">
                                Worksheet Estimate
                            </label>
                        </div>
                    </div>
                    
                    @error('type')
                        <span class="text-danger error">{{ $message }}</span>
                    @enderror
                </div>
                
           </div>
        </div>
           <div class="modal-footer">
               <button type="button" class="btn btn-secondary" wire:click="$set('showDownload', false)"
                   data-bs-dismiss="modal">Cancel</button>
               <button type="submit" class="btn btn-primary">
                   {{ $isDownload ? 'Download' : 'Download' }}
                   <i class="spinner-border spinner-border-sm" wire:loading></i>
               </button>
           </div>
       </form>
   </div>
</div>
</div>
{{-- @include('livewire.workshop.jobcart.dent_car_modal') --}}
@include('livewire.workshop.jobcart.vehical_modal')
@include('livewire.workshop.jobcart.purchase_order')


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
                        <div class="breadcrumb-title pe-2 text-dark" style="border: none;">Edit Job-Card</div>
                    </a>
                </div>

                <!-- Job-Card Details -->
                <div class="ulprofile">
                    <div class="input-group mt-2">
                        <span class="input-group-text">Job-Card No.</span>
                        <input type="text" form="jobcard-form" id="jobcard_number" wire:model="jobcard_number"
                            class="form-control bg-light" value="{{ $jobcardData->jobcard_number }}" readonly
                            placeholder="Job-Card Number" aria-label="Job-Card Number">
                        <span class="input-group-text">Date</span>
                        <input type="date" class="form-control bg-light" value="{{ \Carbon\Carbon::parse($jobcardData->entry_date)->format('Y-m-d') }}" readonly placeholder="Date" aria-label="Date"> 
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
                            <option @if($customer->id == $jobcardData->customer_id) selected @endif value="{{ $customer->id }}">{{ $customer->name .' '. $customer->lastname }}</option> 
                            @endforeach
                        </select>

                         <button type="button" 
                         class="btn btn-outline-secondary text-light bg-primary fl margin-left-0" 
                         wire:click="addCustomer">
                         {{ trans('+') }}
                     </button>
                     
                     </div>
                     <label for="vehicle-id" class="form-label">Vehical Name</label>
                     <div class="input-group mb-3">
                         <select wire:model="vehicle_id" id="vehicle-id" class="form-control"
                             style="width: 75% !important;">
                             <option value="" selected >-- Select vehicle --
                             </option>
                             @foreach ($vehicles as $vehicle)
                             <option @if($vehicle->id == $jobcardData->vehicle_id) selected @endif value="{{ $vehicle->id }}">{{ $vehicle->modelname .'/'. $vehicle->brand->vehicle_brand .'/'. $vehicle->number_plate .'/'. $vehicle->id }}</option>
                         @endforeach
                         </select>
                         <button type="button" 
                         class="btn btn-outline-secondary text-light bg-primary fl margin-left-0" 
                         wire:click="addVehical">
                         {{ trans('+') }}
                     </button>
                       
                     </div>
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
                                <input type="number" wire:model="km_reading"  class="form-control"
                                    id="km_reading" value="{{ $jobcardData->km_runing }}" min="0">
                                <label for="km_reading">KM Reading</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <label for="fual level" class="form-label">Fual Level</label>
                            <input type="range" class="form-range" id="fual level"
                            wire:model="fual_level" min="0" max="100" value="">
                        </div>
                        <div class="col-4">
                            <div class="form-floating">
                                <select class="form-select" id="supervisor" wire:model="supervisor"
                                    aria-label="Floating label select example">
                                    
                                </select>
                                <label for="supervisor">Supervisor</label>
                            </div>
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
        <div class=" mt-4">
            <div class="card h-100">
                <div class="card-body ">
                    <!-- Top Cards -->
                    <div class="row mt-4" id="counters">
                        <div class="col-2">
                            <div class="card">
                                <div class="card-body p-0" id="labour-table-counter">
                                    <a href="javascript:void(0)"
                                        class="d-flex justify-content-between bg-yellow-orange px-1 py-2 rounded-top text-white"
                                        wire:click="toggleTable(1)">
                                        <p class="m-0"><b>Labour(<span class="tr-count">{{ count($extraCharges) }}</span>)</b></p>
                                        <p class="text-end m-0">
                                            <b class="">₹<span class="total-count">{{ array_sum(array_column($extraCharges, 'charge')) }}</span> </b>
                                            <small class="d-block ">₹<span
                                                class="discount-count">{{ array_sum(array_column($extraCharges, 'discount')) }}</span></small>
                                        </p> 
                                    </a>
                                   
                                    <div class="d-flex justify-content-between align-items-center p-1 ps-0 ">
                                        <div class="fs-5 bg-yellow-orange rounded mx-1 px-2"><i
                                                class="fa-solid fa-user text-white"></i></div>
                                        <div class="text-end">
                                            <p class="m-0 ">Total: ₹<span
                                                    class="final-total-count">{{ array_sum(array_column($extraCharges, 'charge')) }}</span></p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="card">
                                <div class="card-body p-0" id="spare-part-table-counter">
                                    <a href="javascript:void(0)"
                                        class="d-flex justify-content-between green-variant px-1 py-2 rounded-top text-white"
                                        wire:click="toggleTable(2)">
                                        <p class="m-0"><b>Spare(<span class="tr-count">{{ count($spareParts) }}</span>)</b></p>
                                        <p class="text-end m-0">
                                            <b class="">₹<span class="total-count">{{ array_sum(array_column($spareParts, 'total_amount')) }}</span></b>
                                            <small class="d-block ">₹<span
                                                    class="discount-count">{{ array_sum(array_column($spareParts, 'discount')) }}</span></small>
                                        </p>
                                    </a>
                                    <div class="d-flex justify-content-between align-items-center p-1 ps-0 ">
                                        <div class="fs-5 green-variant rounded mx-1 px-2"><i
                                                class="fa-solid fa-cogs text-white"></i></div>
                                        <div class="text-end">
                                            <p class="m-0 ">Total: ₹<span
                                                    class="final-total-count">{{ array_sum(array_column($spareParts, 'final_amount')) }}</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="card">
                                <div class="card-body p-0" id="lubes-table-counter">
                                    <a href="javascript:void(0)"
                                        class="d-flex justify-content-between blue-variant px-1 py-2 rounded-top text-white"
                                        wire:click="toggleTable(3)">
                                        <p class="m-0"><b>Lubes(<span class="tr-count">{{ count($lubes) }}</span>)</b></p>
                                        <p class="text-end m-0">
                                            <b class="">₹<span class="total-count">{{ array_sum(array_column($lubes, 'total_amount')) }}</span></b>
                                            <small class="d-block ">₹<span
                                                    class="discount-count">{{ array_sum(array_column($lubes, 'discount')) }}</span></small>
                                        </p>
                                    </a>
                                    <div class="d-flex justify-content-between align-items-center p-1 ps-0 ">
                                        <div class="fs-5 blue-variant rounded mx-1 px-2"><i
                                                class="fa-solid fa-oil-can text-white"></i></div>
                                        <div class="text-end">
                                            <p class="m-0 ">Total: ₹<span
                                                    class="final-total-count">{{ array_sum(array_column($lubes, 'final_amount')) }}</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <div class="col-2">
                            <div class="card">
                                <div class="card-body p-0" id="accessory-table-counter">
                                    <a href="javascript:void(0)"
                                        class="d-flex justify-content-between orange-variant px-1 py-2 rounded-top text-white"
                                        wire:click="toggleTable(5)">
                                        <p class="m-0"><b>Accessory(<span class="tr-count">{{ count($accessoriess) }}</span>)</b>
                                        </p>
                                        <p class="text-end m-0">
                                            <b class="">₹<span class="total-count">{{ array_sum(array_column($accessoriess, 'total_amount')) }}</span></b>
                                            <small class="d-block ">₹<span
                                                    class="discount-count">{{ array_sum(array_column($accessoriess, 'discount')) }}</span></small>
                                        </p>
                                    </a>
                                    <div class="d-flex justify-content-between align-items-center p-1 ps-0 ">
                                        <div class="fs-5 orange-variant rounded mx-1 px-2"><i
                                                class="fa-solid fa-toolbox text-white"></i></div>
                                        <div class="text-end">
                                            <p class="m-0 ">Total: ₹<span
                                                    class="final-total-count">{{ array_sum(array_column($accessoriess, 'final_amount')) }}</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="card">
                                <div class="card-body p-0" id="total-counter">
                                    <a href="javascript:void(0)"
                                        class="d-flex justify-content-between grey-variant px-1 py-2 rounded-top text-white">
                                        <p class="m-0"><b>Total(<span class="tr-count">{{ count($spareParts) + count($lubes) + count($accessoriess) + count($extraCharges) }}</span>)</b></p>
                                        <p class="text-end m-0">
                                            <b class="">₹<span class="total-count">{{ $totalAmount }}</span></b>
                                            <small class="d-block ">₹<span class="discount-count">
                                                {{ array_sum(array_column($spareParts, 'discount')) + array_sum(array_column($lubes, 'discount')) + array_sum(array_column($accessoriess, 'discount')) }}
                                            </span></small>
                                        </p>
                                    </a>
                                    <div class="d-flex justify-content-between align-items-center p-1 ps-0 ">
                                        <div class="fs-5 grey-variant rounded mx-1 px-2"><i
                                                class="fa-solid fa-calculator text-white"></i></div>
                                        <div class="text-end">
                                            <p class="m-0 ">Total: ₹<span class="final-total-count">{{ $final_amount }}</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="mt-4 table-view" id="tools-div" style="display: {{ $showTable == 1 ? 'block' : 'none' }}">
                    <table class="table table-bordered" id="labour-table">
                        <thead>
                            <th >Label</th>
                            <th>Amount</th>
                            <th>Mechanic</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($this->extraCharges as $index => $charge)
                                    <tr>
                                        <td>
                                            <input type="text" class="form-control" wire:model="extraCharges.{{ $index }}.label" placeholder="Enter Label Here">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" wire:model.lazy="extraCharges.{{ $index }}.charge" placeholder="Enter Charge Here">
                                        </td> 
                                        <td>
                                            <select wire:model="mechanic" class="form-select"
                                            style="max-width: 200px !important;">
                                            <option value="" selected disabled>-- Select Machanic
                                                --</option>
                                            @foreach ($mechanic as $item)
                                                <option value="{{ $item->id }}" >
                                                    {{ $item->display_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-danger rounded border-0 text-white" wire:click="removeRow('extraCharges', {{ $index }})">Remove</button>
                                        </td>
                                    </tr>
                                    @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td> 
                                    <div class="d-flex"> 
                                        <select class="form-control" id="spare-parts-dropdown" 
                                        wire:change="addExtraChargeRow($event.target.value)"
                                        style="min-width: 300px !important;"> 
                                            <option value="" selected disabled>-- Select Labour Charges --
                                            </option>
                                            @foreach ($labourCharges as $item)
                                                <option 
                                                    value="{{ $item['id'] }}" 
                                                    data-label-name="{{ $item['label_name'] }}" 
                                                    data-stock="{{ $item['stock'] }}" 
                                                    data-price="{{ $item['price'] }}"
                                                >
                                                    {{ $item['title'] }} 
                                                    <small class="text-danger">(Price - {{ $item['price'] }})</small>
                                                </option>
                                            @endforeach  
                                        </select>
                                        <button type="button" class="btn btn-outline-secondary add-spare-btn" wire:click="addExtraChargeRow">+</button>
                                    </div> 
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="mt-4 table-view" id="spare-table" style="display: {{ $showTable == 2 ? 'block' : 'none' }}">
                    <table class="table table-bordered" id="spare-part-table">
                        <thead>
                            <tr>
                                <th>Part Name</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Total Amount</th>
                                <th>Discount</th>
                                <th>Final Amount</th> 
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($spareParts as $index => $part)
                            <tr>
                                <td><input type="text" class="form-control" wire:model="spareParts.{{ $index }}.part_name" placeholder="Part Name"></td>
                                <td><input type="number" class="form-control" wire:model.lazy="spareParts.{{ $index }}.quantity"></td>
                                <td><input type="number" class="form-control" wire:model.lazy="spareParts.{{ $index }}.unit_price"></td>
                                <td><input type="text" class="form-control bg-light" wire:model="spareParts.{{ $index }}.total_amount" readonly></td>
                                <td><input type="number" class="form-control" wire:model.lazy="spareParts.{{ $index }}.discount"></td>
                                <td><input type="text" class="form-control bg-light" wire:model="spareParts.{{ $index }}.final_amount" readonly></td>
                                <td>
                                    <button class="btn btn-sm btn-danger rounded border-0 text-white" wire:click="removeRow('spareParts', {{ $index }})">
                                        Remove
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        
                        <tfoot>
                            <tr>
                                <td>
                                    <div class="d-flex">
                                        <select class="form-control" id="spare-parts-dropdown" 
                                        wire:change="addSparePartRow($event.target.value, $event.target.options[$event.target.selectedIndex].getAttribute('data-price'))"
                                        style="min-width: 300px !important;"> 
                                            <option value="" selected disabled>--Select Spare Part --</option>
                                            @foreach ($spare as $item)
                                                <option 
                                                    value="{{ $item['label_id'] }}" 
                                                    data-label-name="{{ $item['label_name'] }}" 
                                                    data-stock="{{ $item['stock'] }}" 
                                                    data-price="{{ $item['price'] }}"
                                                >
                                                    {{ $item['label_name'] }}
                                                    <small>(Current Qty. {{ $item['stock'] }})</small>, 
                                                    <small class="text-danger">(Price - {{ $item['price'] }})</small>
                                                </option>
                                            @endforeach  
                                        </select>
                                        <button type="button" class="btn btn-outline-secondary add-spare-btn ms-4" wire:click="addSparePartRows">+</button>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                

                <div class="mt-4 table-view" id="lubes-table" style="display: {{ $showTable == 3 ? 'block' : 'none' }}">
                    <table class="table table-bordered" id="lubes-table">
                        <thead>
                            <tr>
                                <th>Part Name</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Total Amount</th>
                                <th>Discount</th>
                                <th>Final Amount</th> 
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lubes as $index => $part)
                            <tr>
                                <td>
                                    <input type="text" class="form-control" wire:model="lubes.{{ $index }}.part_name" placeholder="Part Name">
                                </td>
                                <td>
                                    <input type="number" class="form-control" wire:model.lazy="lubes.{{ $index }}.quantity">
                                </td>
                                <td>
                                    <input type="number" class="form-control" wire:model.lazy="lubes.{{ $index }}.unit_price">
                                </td>
                                <td>
                                    <input type="text" class="form-control bg-light" wire:model="lubes.{{ $index }}.total_amount" readonly>
                                </td>
                                <td>
                                    <input type="number" class="form-control" wire:model.lazy="lubes.{{ $index }}.discount">
                                </td>
                                <td>
                                    <input type="text" class="form-control bg-light" wire:model="lubes.{{ $index }}.final_amount" readonly>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-danger" wire:click="removeRow('lubes', {{ $index }})">Remove</button>
                                </td>
                            </tr>
                            @endforeach
                          
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>
                                    <div class="d-flex">
                                        <select class="form-control" id="spare-parts-dropdown" 
                                        wire:change="addLubesRow($event.target.value, $event.target.options[$event.target.selectedIndex].getAttribute('data-price'))"
                                        style="min-width: 300px !important;">
                                    <option value="" selected disabled>--Select Lubes--</option>
                                    @foreach ($lube as $item)
                                    <option 
                                        value="{{ $item['label_id'] }}" 
                                        data-label-name="{{ $item['label_name'] }}" 
                                        data-stock="{{ $item['stock'] }}" 
                                        data-price="{{ $item['price'] }}"
                                    >
                                        {{ $item['label_name'] }}
                                        <small>(Current Qty. {{ $item['stock'] }})</small>, 
                                        <small class="text-danger">(Price - {{ $item['price'] }})</small>
                                    </option>
                                    @endforeach
                                </select>
                                
                                        <button type="button" class="btn btn-outline-secondary add-spare-btn ms-4" wire:click="addLubesRow">+</button>
                                    </div>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td> 
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
 
                <div class="mt-4  table-view" id="accessory-table" style="display: {{ $showTable == 5 ? 'block' : 'none' }}">
                    <table class="table table-bordered" id="accessory-table">
                        <thead>
                            <tr>
                                <th>Part Name</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Total Amount</th>
                                <th>Discount</th>
                                <th>Final Amount</th> 
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($accessoriess as $index => $part)  
                            <tr>
                                <td>
                                    <input type="text" class="form-control" wire:model="accessoriess.{{ $index }}.part_name" placeholder="Part Name">
                                </td>
                                <td>
                                    <input type="number" class="form-control" wire:model.lazy="accessoriess.{{ $index }}.quantity">
                                </td>
                                <td>
                                    <input type="number" class="form-control" wire:model.lazy="accessoriess.{{ $index }}.unit_price">
                                </td>
                                <td>
                                    <input type="text" class="form-control bg-light" wire:model="accessoriess.{{ $index }}.total_amount" readonly>
                                </td>
                                <td>
                                    <input type="number" class="form-control" wire:model.lazy="accessoriess.{{ $index }}.discount">
                                </td>
                                <td>
                                    <input type="text" class="form-control bg-light" wire:model="accessoriess.{{ $index }}.final_amount" readonly>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-danger" wire:click="removeRow('accessoriess', {{ $index }})">Remove</button>
                                </td>
                            </tr> 
                            @endforeach
                          
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>
                                    <div class="d-flex">

                                        <select class="form-control" id="spare-parts-dropdown" 
                                        wire:change="addAccessoriesRow($event.target.value, $event.target.options[$event.target.selectedIndex].getAttribute('data-price'))"
                                        style="min-width: 300px !important;">
                                    <option value="" selected disabled>--Select Accessory--</option>
                                    @foreach ($accessory as $item)
                                        <option 
                                            value="{{ $item['label_id'] }}" 
                                            data-label-name="{{ $item['label_name'] }}" 
                                            data-stock="{{ $item['stock'] }}" 
                                            data-price="{{ $item['price'] }}"
                                        >
                                            {{ $item['label_name'] }}
                                            <small>(Current Qty. {{ $item['stock'] }})</small>, 
                                            <small class="text-danger">(Price - {{ $item['price'] }})</small>
                                        </option>
                                        @endforeach
                                    </select>
 
                                        <button type="button" class="btn btn-outline-secondary add-spare-btn ms-4" wire:click="addAccessoriesRow">+</button>
                                    </div>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td> 
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
 
                <div class="row ">
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5>Job-Card Details</h5>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="cost-estimate" class="form-label">Cost
                                                Estimate</label>
                                            <input type="text" id="cost-estimate" wire:model="totalAmount" placeholder="Cost Estimate"
                                                class="form-control rounded">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="delivery_date" class="form-label">Delivery
                                                Date</label>
                                            <input type="date" id="delivery_date" wire:model="deliveryDate"
                                                placeholder="Delivery Date" class="form-control rounded">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="delivery_time" class="form-label">Delivery
                                                Time</label>
                                            <input type="time" id="delivery_time" wire:model="deliveryTime"
                                                placeholder="Delivery Time" class="form-control rounded">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card  h-100">
                            <div class="card-body ">
                                <h5>Billing Details</h5>
                                <div class="mb-3">
                                    <label for="total-amount" class="form-label">Total Amount</label>
                                    <input type="text" id="total-amount" wire:model="totalAmount"
                                    wire:model="totalAmount" placeholder="Total Amount"
                                        class="form-control w-50 bg-secondary text-white rounded" readonly>
                                    <input type="hidden" wire:model="total_amount" id="total-amount"
                                        value="0">
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="final-amount" class="form-label">Payable
                                                Amount</label>
                                            <input type="text" id="final-amount" 
                                            wire:model="final_amount" value="0"
                                                class="form-control bg-secondary text-white rounded"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="advance" class="form-label">Advance</label>
                                            <input type="text" id="advance" 
                                            wire:model.live="advance"  placeholder="Advance"
                                                class="form-control rounded" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="pending-amount" class="form-label">Pending
                                                Amount</label>
                                            <input type="text" id="pending-amount"
                                                wire:model="balance_amount" wire:model="balance_amount"
                                                value="0"
                                                class="form-control bg-secondary text-white rounded"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                </div>
            </div>
        </div>
     </div>

 </div>
 <div class="footer d-flex align-items-center p-3">
    <!-- SMS Alert Section -->
    <div class="col-auto">
        <a href="javascript:void(0);" class="btn btn-outline-secondary" wire:click="printPdf" style="font-weight: 300 !important; background-color:#ADB4BF ">
            <i class="fa fa-print" style="font-size: small;"></i>
        </a>
        <a href="javascript:void(0);" class="btn btn-outline-secondary" wire:click="downloadPdf" style="font-weight: 300 !important; background-color:#ADB4BF">
            <i class="fas fa-file-pdf" aria-hidden="true"></i>

        </a>
        <a href="javascript:void(0);" class="btn btn-outline-secondary" wire:click="sendMail" style="font-weight: 300 !important; background-color:#ADB4BF">
            <i class="fa fa-envelope " style="font-size: small;"></i>
        </a>
        <a href="javascript:void(0);" class="btn btn-outline-secondary" wire:click="sendWhatsApp" style="font-weight: 300 !important; background-color:#ADB4BF">
            <i class="fab fa-whatsapp" aria-hidden="true"></i>

        </a>
        
        
    </div>

    <!-- SMS Alert Toggle -->
    <div class="col-auto">
        <div class="form-check form-switch ms-4">
            <input wire:model="smsAlert" class="form-check-input fs-6" type="checkbox" role="switch" id="sms-alert">
            <label class="form-check-label fs-5" for="sms-alert">SMS Alert</label>
        </div>
    </div>

    <!-- Create Job-Card Button Section -->
    <div class="col-auto ms-auto">
        <button wire:click="deleteJobCard" class="btn btn-danger rounded border-0 text-white">Delete</button>
        <button wire:click="updateJobCard" class="btn btn-primary rounded border-0 text-white">Update Job-Card</button>
        <button wire:click="completeJobCard" class="btn btn-success rounded border-0 text-white">Complete Job-Card</button>
    </div>
</div>


<div class="modal @if($showDentCar) show @endif" tabindex="-1" style="opacity: 1; background-color: #0606068c; display: @if($showDentCar) block @else none @endif;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            {{-- <form wire:submit.prevent="{{ $showDentCar ? 'saveImage' : 'saveImage' }}"> --}}
                <div class="modal-header">
                    <button type="button" class="btn-close" wire:click="closeModal" aria-label="Close"></button>
                </div>

                @if(!empty($jobCardsDentImage))
                <img id="carImageTag" src="{{ asset($imagePath) }}" alt="Car Image" class="w-75"/>
                    <div class="row">
                        <div class="col-6 mx-2">
                            <button id="deleteBtn"  wire:click="confirmDelete({{ $jobCardsDentImage->id }})" class="btn btn-danger mt-3 rounded text-white border-white" fdprocessedid="3j5af">
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
 </div>
 @section('footerscript')
 <script>
 
 </script>
 @endsection
