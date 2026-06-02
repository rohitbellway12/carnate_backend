<div>
    <div class="row mb-3">
        <div class="col-md-6">
            <h5>Appointments</h5>
        </div>
        <div class="col-md-6 text-end">
            <button wire:click="openModal" class="btn btn-primary">
                <i class="bx bx-plus"></i> Add Appointment
            </button>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-3">
                    <input type="text" wire:model.live="search" class="form-control" placeholder="Search...">
                </div>
                <div class="col-md-3">
                    <select wire:model.live="statusFilter" class="form-select">
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="in_progress">In Progress</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="date" wire:model.live="dateFilter" class="form-control">
                </div>
                <div class="col-md-3">
                    <button wire:click="resetFilters" class="btn btn-secondary">Reset</button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Phone</th>
                            <th>Vehicle</th>
                            <th>Date & Time</th>
                            <th>Issue</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($appointments as $appointment)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $appointment->customer_name }}</td>
                                <td>{{ $appointment->customer_phone }}</td>
                                <td>{{ $appointment->vehicle_number_plate ?? '-' }}</td>
                                <td>
                                    {{ $appointment->appointment_date->format('d-m-Y') }}<br>
                                    {{ $appointment->appointment_time->format('H:i') }}
                                </td>
                                <td>{{ Str::limit($appointment->issue_description, 30) ?? '-' }}</td>
                                <td>
                                    <span class="badge @if($appointment->status == 'pending') bg-warning @elseif($appointment->status == 'confirmed') bg-info @elseif($appointment->status == 'in_progress') bg-primary @elseif($appointment->status == 'completed') bg-success @else bg-danger @endif">
                                        {{ ucfirst(str_replace('_', ' ', $appointment->status)) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button wire:click="view({{ $appointment->id }})" class="btn btn-sm btn-primary" title="View Details">
                                            <i class="bx bx-show"></i>
                                        </button>
                                        <button wire:click="convertToJobCard({{ $appointment->id }})" class="btn btn-sm btn-success" title="Convert to Job Card">
                                            <i class="bx bxs-file-plus"></i>
                                        </button>
                                        <button wire:click="edit({{ $appointment->id }})" class="btn btn-sm btn-info">
                                            <i class="bx bx-edit"></i>
                                        </button>
                                        <button wire:click="delete({{ $appointment->id }})" class="btn btn-sm btn-danger">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No appointments found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $appointments->links() }}
        </div>
    </div>

    @if($showModal)
        <div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $isEdit ? 'Edit' : 'Add' }} Appointment</h5>
                        <button wire:click="closeModal" class="btn-close"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit="{{ $isEdit ? 'update' : 'store' }}">
                            <div class="mb-3">
                                <label class="form-label">Customer Name Or Vehicle</label>
                                <div class="input-group" wire:ignore>
                                    <select id="customer_name_select" class="form-select select2" data-property="customer_name">
                                        <option value="">--Select Customer--</option>
                                        @foreach($customers as $customer)
                                            @foreach($customer->vehicles as $vehicle)
                                                <option value="{{ $vehicle->id }}" {{ $vehicle->id == $vehicle_id ? 'selected' : '' }}>
                                                    {{ $customer->name }} {{ $customer->lastname ?? '' }}/{{ $customer->mobile_no }}/{{ $vehicle->brand }}/{{ $vehicle->variant }}/{{ $vehicle->number_plate }}
                                                </option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                    <button type="button" class="btn btn-outline-primary" wire:click="openCustomerModal">
                                        <i class="bx bx-plus"></i>
                                    </button>
                                </div>
                                @error('vehicle_id') <span class="text-danger small">{{ $message }}</span> @enderror
                                @error('customer_id') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            @if (!empty($customer_data))
                                <style>
                                    .info-table td { border-bottom: 1px solid #e0e0e0; padding: 6px 8px; vertical-align: top; }
                                </style>
                                <table class="table table-sm info-table" style="width: 100%;">
                                    <tbody>
                                        <tr>
                                            <td style="white-space: nowrap;"><b>Customer</b></td>
                                            <td style="width: 25%;">{{ $customer_data->cust_type == 1 ? 'M/S ' . ($customer_data->company_name ?? $customer_data->name) : trim(($customer_data->name ?? '') . ' ' . ($customer_data->lastname ?? '')) }}</td>
                                            <td style="white-space: nowrap;"><b>Vehicle Name</b></td>
                                            <td style="width: 25%;">{{ ($vehicle_data->brand ?? '') . '/' . ($vehicle_data->variant ?? '') . '/' . ($vehicle_data->modification ?? '') }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Mobile No.</b></td>
                                            <td>{{ $customer_data->mobile_no ?? '' }}</td>
                                            <td><b>Vehicle No.</b></td>
                                            <td>{{ $vehicle_data->number_plate ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Address</b></td>
                                            <td>{{ $customer_data->address ?? '' }}</td>
                                            <td><b>Chassis No.</b></td>
                                            <td>{{ $vehicle_data->chassis_no ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>GST</b></td>
                                            <td>{{ $customer_data->gst_number ?? '' }}</td>
                                            <td><b>Engine No</b></td>
                                            <td>{{ $vehicle_data->engineno ?? '' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            @endif
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Appointment Date *</label>
                                    <input type="date" wire:model="appointment_date" class="form-control @error('appointment_date') is-invalid @enderror">
                                    @error('appointment_date') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Appointment Time *</label>
                                    <input type="time" wire:model="appointment_time" class="form-control @error('appointment_time') is-invalid @enderror">
                                    @error('appointment_time') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Issue Description</label>
                                <textarea wire:model="issue_description" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Status *</label>
                                <select wire:model="status" class="form-select @error('status') is-invalid @enderror">
                                    <option value="pending">Pending</option>
                                    <option value="confirmed">Confirmed</option>
                                    <option value="in_progress">In Progress</option>
                                    <option value="completed">Completed</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                                @error('status') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Notes</label>
                                <textarea wire:model="notes" class="form-control" rows="2"></textarea>
                            </div>
                            <div class="text-end">
                                <button type="button" wire:click="closeModal" class="btn btn-secondary">Cancel</button>
                                <button type="submit" class="btn btn-primary">{{ $isEdit ? 'Update' : 'Save' }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Customer Modal (Same as Job Card) --}}
    @if($showCustomerModal)
        <div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5); z-index: 1060;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form wire:submit.prevent="storeCustomer">
                        <div class="modal-header">
                            <h5 class="modal-title">Customer Add</h5>
                            <button type="button" class="btn-close" wire:click="closeCustomerModal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body py-3">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" wire:model.live="cust_type" id="individual" value="0">
                                        <label class="form-check-label" for="individual">Individual</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" wire:model.live="cust_type" id="company" value="1">
                                        <label class="form-check-label" for="company">Company</label>
                                    </div>
                                </div>
                            </div>
                            @include('livewire.workshop.jobcard.includes.customer-add-form')
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" wire:click="closeCustomerModal">Cancel</button>
                            <button type="submit" class="btn btn-primary">
                                Create
                                <i class="spinner-border spinner-border-sm" wire:loading></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    @if($showViewModal && $selectedAppointment)
        <div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title text-white">Appointment Details - {{ $selectedAppointment->appointment_date->format('d M, Y') }}</h5>
                        <button wire:click="closeViewModal" class="btn-close btn-close-white"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            {{-- Customer Details --}}
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0"><i class="bx bx-user me-2"></i>Customer Information</h6>
                                    </div>
                                    <div class="card-body p-0">
                                        <table class="table table-sm mb-0">
                                            <tr>
                                                <th class="ps-3 py-2" style="width: 35%;">Name</th>
                                                <td class="py-2">
                                                    @if($selectedAppointment->customer)
                                                        {{ $selectedAppointment->customer->cust_type == 1 ? 'M/S ' . $selectedAppointment->customer->company_name : $selectedAppointment->customer->user_title . '. ' . $selectedAppointment->customer->name . ' ' . $selectedAppointment->customer->lastname }}
                                                    @else
                                                        {{ $customer_name }}
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="ps-3 py-2">Phone</th>
                                                <td class="py-2">{{ $customer_phone }}</td>
                                            </tr>
                                            <tr>
                                                <th class="ps-3 py-2">Email</th>
                                                <td class="py-2">{{ $selectedAppointment->customer->email ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="ps-3 py-2">GST No.</th>
                                                <td class="py-2">{{ $selectedAppointment->customer->gst_number ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="ps-3 py-2">Address</th>
                                                <td class="py-2">{{ $selectedAppointment->customer->address ?? '-' }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            {{-- Vehicle Details --}}
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0"><i class="bx bx-car me-2"></i>Vehicle Information</h6>
                                    </div>
                                    <div class="card-body p-0">
                                        <table class="table table-sm mb-0">
                                            <tr>
                                                <th class="ps-3 py-2" style="width: 35%;">Number Plate</th>
                                                <td class="py-2"><strong>{{ $vehicle_number_plate ?? '-' }}</strong></td>
                                            </tr>
                                            <tr>
                                                <th class="ps-3 py-2">Brand/Variant</th>
                                                <td class="py-2">
                                                    {{ $selectedAppointment->vehicle->brand ?? '-' }} / {{ $selectedAppointment->vehicle->variant ?? '-' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="ps-3 py-2">Model/Year</th>
                                                <td class="py-2">{{ $selectedAppointment->vehicle->modification ?? '-' }} ({{ $selectedAppointment->vehicle->year ?? '-' }})</td>
                                            </tr>
                                            <tr>
                                                <th class="ps-3 py-2">Chassis No.</th>
                                                <td class="py-2">{{ $selectedAppointment->vehicle->chassis_no ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="ps-3 py-2">Engine No.</th>
                                                <td class="py-2">{{ $selectedAppointment->vehicle->engineno ?? '-' }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            {{-- Driver & Insurance --}}
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0"><i class="bx bx-shield-quarter me-2"></i>Driver & Insurance</h6>
                                    </div>
                                    <div class="card-body p-0">
                                        <table class="table table-sm mb-0">
                                            <tr>
                                                <th class="ps-3 py-2" style="width: 35%;">Driver Name</th>
                                                <td class="py-2">{{ $selectedAppointment->vehicle->driver_name ?? '-' }} ({{ $selectedAppointment->vehicle->driver_number ?? '-' }})</td>
                                            </tr>
                                            <tr>
                                                <th class="ps-3 py-2">Insurance</th>
                                                <td class="py-2">{{ $selectedAppointment->vehicle->insurance_name ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="ps-3 py-2">Policy No.</th>
                                                <td class="py-2">{{ $selectedAppointment->vehicle->policy_number ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="ps-3 py-2">Policy Expiry</th>
                                                <td class="py-2">{{ $selectedAppointment->vehicle->policy_expiry_date ? \Carbon\Carbon::parse($selectedAppointment->vehicle->policy_expiry_date)->format('d-m-Y') : '-' }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            {{-- Appointment Info --}}
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0"><i class="bx bx-calendar-event me-2"></i>Appointment Details</h6>
                                    </div>
                                    <div class="card-body p-0">
                                        <table class="table table-sm mb-0">
                                            <tr>
                                                <th class="ps-3 py-2" style="width: 35%;">Date & Time</th>
                                                <td class="py-2">{{ \Carbon\Carbon::parse($appointment_date)->format('d-m-Y') }} at {{ \Carbon\Carbon::parse($appointment_time)->format('H:i') }}</td>
                                            </tr>
                                            <tr>
                                                <th class="ps-3 py-2">Status</th>
                                                <td class="py-2">
                                                    <select wire:change="updateStatus($event.target.value)" class="form-select form-select-sm d-inline-block w-auto">
                                                        <option value="pending" {{ $status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                        <option value="confirmed" {{ $status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                                        <option value="in_progress" {{ $status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                                        <option value="completed" {{ $status == 'completed' ? 'selected' : '' }}>Completed</option>
                                                        <option value="cancelled" {{ $status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="ps-3 py-2">Issue Description</th>
                                                <td class="py-2">{{ $issue_description ?? 'No description provided' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="ps-3 py-2">Notes</th>
                                                <td class="py-2">{{ $notes ?? '-' }}</td>
                                            </tr>
                                            @if($selectedAppointment->vehicle && ($selectedAppointment->vehicle->pickup_address || $selectedAppointment->vehicle->drop_address))
                                            <tr>
                                                <th class="ps-3 py-2">Pickup Address</th>
                                                <td class="py-2">{{ $selectedAppointment->vehicle->pickup_address ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="ps-3 py-2">Drop Address</th>
                                                <td class="py-2">{{ $selectedAppointment->vehicle->drop_address ?? '-' }}</td>
                                            </tr>
                                            @endif
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button wire:click="convertToJobCard({{ $appointmentId }})" class="btn btn-success">
                            <i class="bx bxs-file-plus"></i> Convert to Job Card
                        </button>
                        <button wire:click="closeViewModal" class="btn btn-secondary">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @script
    <script>
        $wire.on('reinitSelect2', () => {
            setTimeout(() => {
                initSelect2();
            }, 100);
        });

        function initSelect2() {
            $('#customer_name_select').select2({
                placeholder: "Select Customer or Vehicle",
                dropdownParent: $('#customer_name_select').parent(),
                ajax: {
                    url: '/workshop/customers',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term,
                            page: params.page || 1,
                        };
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;
                        const results = Array.isArray(data.data) ? data.data.map(item => ({
                            id: item.id,
                            text: `${item.name || ''} ${item.lastname || ''}/${item.mobile_no || ''}/${item.brand || ''} ${item.variant || ''}/${item.number_plate || ''}`,
                        })) : [];

                        return {
                            results: results,
                            pagination: {
                                more: data.next_page_url != null
                            }
                        };
                    },
                    cache: true,
                }
            }).on('select2:select', function(e) {
                let data = e.params.data.id;
                if (data) {
                    $wire.set('vehicle_id', data);
                    $wire.selectVehicleDetails(data);
                }
            });
        }

        initSelect2();
    </script>
    @endscript
</div>

</div>
