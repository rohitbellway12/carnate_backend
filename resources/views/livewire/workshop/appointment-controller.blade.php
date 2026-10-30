<div class="carnate-appointments-page">

    <style>
        .carnate-appointments-page {
            --ca-bg: #f7f8fa;
            --ca-card: #ffffff;
            --ca-text: #111827;
            --ca-muted: #64748b;
            --ca-border: #e2e8f0;
            --ca-red: #e53935;
            --ca-red-soft: #fff5f5;
            --ca-green: #16a34a;
            --ca-blue: #2563eb;
            --ca-shadow: 0 4px 20px rgba(15, 23, 42, .05);
            color: var(--ca-text);
        }

        .carnate-appointments-page .ca-page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 22px;
        }

        .carnate-appointments-page .ca-page-title {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: -.3px;
        }

        .carnate-appointments-page .ca-page-subtitle {
            margin: 5px 0 0;
            color: var(--ca-muted);
            font-size: 13px;
        }

        .carnate-appointments-page .ca-card {
            background: var(--ca-card);
            border: 1px solid var(--ca-border);
            border-radius: 14px;
            box-shadow: var(--ca-shadow);
            overflow: hidden;
        }

        .carnate-appointments-page .ca-card-header {
            padding: 18px 20px;
            border-bottom: 1px solid var(--ca-border);
        }

        .carnate-appointments-page .ca-card-body {
            padding: 20px;
        }

        .carnate-appointments-page .ca-filter-row {
            display: grid;
            grid-template-columns: 1.4fr 1fr 1fr auto;
            gap: 12px;
            align-items: center;
        }

        .carnate-appointments-page .form-control,
        .carnate-appointments-page .form-select {
            min-height: 42px;
            border: 1px solid var(--ca-border);
            border-radius: 9px;
            color: var(--ca-text);
            box-shadow: none;
        }

        .carnate-appointments-page .form-control:focus,
        .carnate-appointments-page .form-select:focus {
            border-color: rgba(229, 57, 53, .55);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        .carnate-appointments-page .ca-btn {
            min-height: 40px;
            border-radius: 9px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 9px 15px;
            border: 1px solid transparent;
            transition: all .18s ease;
        }

        .carnate-appointments-page .ca-btn-primary {
            background: var(--ca-red);
            color: #fff;
        }

        .carnate-appointments-page .ca-btn-primary:hover {
            background: #c62828;
            color: #fff;
            transform: translateY(-1px);
        }

        .carnate-appointments-page .ca-btn-secondary {
            background: #fff;
            color: #475569;
            border-color: var(--ca-border);
        }

        .carnate-appointments-page .ca-btn-secondary:hover {
            background: #f8fafc;
            color: var(--ca-text);
        }

        .carnate-appointments-page .ca-btn-success {
            background: #16a34a;
            color: #fff;
        }

        .carnate-appointments-page .ca-btn-info {
            background: #eff6ff;
            color: #2563eb;
            border-color: #dbeafe;
        }

        .carnate-appointments-page .ca-btn-danger {
            background: #fff5f5;
            color: #dc2626;
            border-color: #fee2e2;
        }

        .carnate-appointments-page .ca-table-wrap {
            overflow-x: auto;
        }

        .carnate-appointments-page .ca-table {
            width: 100%;
            min-width: 1050px;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .carnate-appointments-page .ca-table thead th {
            background: #f8fafc;
            color: #475569;
            border-bottom: 1px solid var(--ca-border);
            padding: 13px 15px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
            white-space: nowrap;
        }

        .carnate-appointments-page .ca-table tbody td {
            padding: 14px 15px;
            border-bottom: 1px solid #eef2f7;
            color: #334155;
            vertical-align: middle;
            font-size: 13px;
        }

        .carnate-appointments-page .ca-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-appointments-page .ca-table tbody tr:hover {
            background: #fafbfc;
        }

        .carnate-appointments-page .ca-customer {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 170px;
        }

        .carnate-appointments-page .ca-avatar {
            width: 34px;
            height: 34px;
            flex: 0 0 34px;
            border-radius: 10px;
            background: var(--ca-red-soft);
            color: var(--ca-red);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        .carnate-appointments-page .ca-customer-name {
            font-weight: 600;
            color: var(--ca-text);
        }

        .carnate-appointments-page .ca-phone {
            color: var(--ca-muted);
            white-space: nowrap;
        }

        .carnate-appointments-page .ca-vehicle {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 9px;
            border-radius: 7px;
            background: #f8fafc;
            border: 1px solid #e8edf3;
            font-weight: 600;
            color: #334155;
        }

        .carnate-appointments-page .ca-datetime strong {
            display: block;
            color: var(--ca-text);
            font-weight: 600;
        }

        .carnate-appointments-page .ca-datetime span {
            color: var(--ca-muted);
            font-size: 12px;
        }

        .carnate-appointments-page .ca-issue {
            max-width: 230px;
            color: var(--ca-muted);
        }

        .carnate-appointments-page .ca-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .carnate-appointments-page .ca-status.pending {
            background: #fff7ed;
            color: #c2410c;
        }

        .carnate-appointments-page .ca-status.confirmed {
            background: #eff6ff;
            color: #2563eb;
        }

        .carnate-appointments-page .ca-status.in-progress {
            background: #f5f3ff;
            color: #7c3aed;
        }

        .carnate-appointments-page .ca-status.completed {
            background: #f0fdf4;
            color: #15803d;
        }

        .carnate-appointments-page .ca-status.cancelled {
            background: #fef2f2;
            color: #dc2626;
        }

        .carnate-appointments-page .ca-actions {
            display: flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }

        .carnate-appointments-page .ca-icon-btn {
            width: 34px;
            height: 34px;
            padding: 0;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--ca-border);
            background: #fff;
            transition: all .18s ease;
        }

        .carnate-appointments-page .ca-icon-btn:hover {
            transform: translateY(-1px);
        }

        .carnate-appointments-page .ca-icon-view {
            color: #475569;
        }

        .carnate-appointments-page .ca-icon-convert {
            color: #16a34a;
            background: #f0fdf4;
            border-color: #dcfce7;
        }

        .carnate-appointments-page .ca-icon-edit {
            color: #2563eb;
            background: #eff6ff;
            border-color: #dbeafe;
        }

        .carnate-appointments-page .ca-icon-delete {
            color: #dc2626;
            background: #fff5f5;
            border-color: #fee2e2;
        }

        .carnate-appointments-page .ca-empty {
            padding: 55px 20px !important;
            text-align: center;
            color: var(--ca-muted);
        }

        .carnate-appointments-page .ca-empty-icon {
            width: 52px;
            height: 52px;
            margin: 0 auto 12px;
            border-radius: 14px;
            background: #f1f5f9;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .carnate-appointments-page .ca-modal-backdrop {
            position: fixed;
            inset: 0;
            z-index: 1050;
            background: rgba(15, 23, 42, .52);
            backdrop-filter: blur(3px);
            overflow-y: auto;
            padding: 30px 15px;
        }

        .carnate-appointments-page .ca-modal-backdrop.ca-customer-modal {
            z-index: 1060;
        }

        .carnate-appointments-page .ca-modal-dialog {
            width: 100%;
            margin: 0 auto;
        }

        .carnate-appointments-page .ca-modal-lg {
            max-width: 900px;
        }

        .carnate-appointments-page .ca-modal-xl {
            max-width: 1180px;
        }

        .carnate-appointments-page .ca-modal-content {
            background: #fff;
            border-radius: 16px;
            border: 1px solid var(--ca-border);
            box-shadow: 0 25px 70px rgba(15, 23, 42, .18);
            overflow: hidden;
        }

        .carnate-appointments-page .ca-modal-header {
            padding: 18px 22px;
            border-bottom: 1px solid var(--ca-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .carnate-appointments-page .ca-modal-title {
            margin: 0;
            font-size: 18px;
            font-weight: 700;
            color: var(--ca-text);
        }

        .carnate-appointments-page .ca-modal-body {
            padding: 22px;
        }

        .carnate-appointments-page .ca-modal-footer {
            padding: 15px 22px;
            border-top: 1px solid var(--ca-border);
            display: flex;
            justify-content: flex-end;
            gap: 9px;
            background: #fafbfc;
        }

        .carnate-appointments-page .ca-section-title {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 0 0 14px;
            font-size: 14px;
            font-weight: 700;
            color: var(--ca-text);
        }

        .carnate-appointments-page .ca-section-title i {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            background: #f1f5f9;
            color: #475569;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        .carnate-appointments-page .ca-field-label {
            display: block;
            margin-bottom: 7px;
            font-size: 12px;
            font-weight: 700;
            color: #475569;
        }

        .carnate-appointments-page .ca-required {
            color: var(--ca-red);
        }

        .carnate-appointments-page .ca-info-card {
            border: 1px solid var(--ca-border);
            border-radius: 12px;
            overflow: hidden;
            height: 100%;
            background: #fff;
        }

        .carnate-appointments-page .ca-info-card-header {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 13px 15px;
            background: #f8fafc;
            border-bottom: 1px solid var(--ca-border);
        }

        .carnate-appointments-page .ca-info-card-header i {
            color: var(--ca-red);
            font-size: 18px;
        }

        .carnate-appointments-page .ca-info-card-header h6 {
            margin: 0;
            font-size: 13px;
            font-weight: 700;
            color: var(--ca-text);
        }

        .carnate-appointments-page .ca-info-table {
            width: 100%;
            margin: 0;
        }

        .carnate-appointments-page .ca-info-table th,
        .carnate-appointments-page .ca-info-table td {
            padding: 11px 14px;
            border-bottom: 1px solid #eef2f7;
            vertical-align: top;
            font-size: 12px;
        }

        .carnate-appointments-page .ca-info-table tr:last-child th,
        .carnate-appointments-page .ca-info-table tr:last-child td {
            border-bottom: 0;
        }

        .carnate-appointments-page .ca-info-table th {
            width: 35%;
            color: #64748b;
            font-weight: 600;
            white-space: nowrap;
        }

        .carnate-appointments-page .ca-info-table td {
            color: #334155;
            font-weight: 500;
        }

        .carnate-appointments-page .ca-selected-info {
            margin-top: 12px;
            border: 1px solid var(--ca-border);
            border-radius: 12px;
            overflow: hidden;
        }

        .carnate-appointments-page .ca-selected-info table td {
            padding: 9px 11px;
            border-bottom: 1px solid #eef2f7;
            vertical-align: top;
            font-size: 12px;
        }

        .carnate-appointments-page .ca-selected-info table tr:last-child td {
            border-bottom: 0;
        }

        .carnate-appointments-page .ca-selected-info-label {
            color: #64748b;
            font-weight: 700;
            white-space: nowrap;
        }

        .carnate-appointments-page .ca-selected-info-value {
            color: #334155;
        }

        .carnate-appointments-page .ca-detail-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .carnate-appointments-page .ca-detail-status .form-select {
            min-height: 36px;
            width: auto;
        }

        .carnate-appointments-page .ca-modal-close {
            width: 34px;
            height: 34px;
            padding: 0;
            border: 1px solid var(--ca-border);
            border-radius: 8px;
            background: #fff;
            color: #64748b;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .carnate-appointments-page .ca-modal-close:hover {
            color: var(--ca-red);
            border-color: #fecaca;
            background: var(--ca-red-soft);
        }

        .carnate-appointments-page .select2-container {
            width: 100% !important;
        }

        .carnate-appointments-page .select2-container--default .select2-selection--single {
            height: 42px;
            border: 1px solid var(--ca-border);
            border-radius: 9px;
        }

        .carnate-appointments-page .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 40px;
            padding-left: 12px;
            font-size: 13px;
            color: var(--ca-text);
        }

        .carnate-appointments-page .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 40px;
        }

        .carnate-appointments-page .ca-error {
            display: block;
            margin-top: 5px;
            color: #dc2626;
            font-size: 11px;
        }

        @media (max-width: 991px) {
            .carnate-appointments-page .ca-filter-row {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 767px) {
            .carnate-appointments-page .ca-page-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .carnate-appointments-page .ca-filter-row {
                grid-template-columns: 1fr;
            }

            .carnate-appointments-page .ca-card-body {
                padding: 14px;
            }

            .carnate-appointments-page .ca-modal-body {
                padding: 15px;
            }

            .carnate-appointments-page .ca-modal-backdrop {
                padding: 15px 10px;
            }
        }
    </style>

    {{-- Page Header --}}
    <div class="ca-page-header">
        <div>
            <h4 class="ca-page-title">Appointments</h4>
            <p class="ca-page-subtitle">Manage customer appointments and service scheduling.</p>
        </div>

        <button wire:click="openModal" class="ca-btn ca-btn-primary">
            <i class="bx bx-plus"></i>
            Add Appointment
        </button>
    </div>

    {{-- Appointment List --}}
    <div class="ca-card">
        <div class="ca-card-header">
            <div class="ca-filter-row">
                <input
                    type="text"
                    wire:model.live="search"
                    class="form-control"
                    placeholder="Search customer, phone or vehicle..."
                >

                <select wire:model.live="statusFilter" class="form-select">
                    <option value="">All Status</option>
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="in_progress">In Progress</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                </select>

                <input
                    type="date"
                    wire:model.live="dateFilter"
                    class="form-control"
                >

                <button wire:click="resetFilters" class="ca-btn ca-btn-secondary">
                    <i class="bx bx-reset"></i>
                    Reset
                </button>
            </div>
        </div>

        <div class="ca-table-wrap">
            <table class="ca-table">
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

                            <td>
                                <div class="ca-customer">
                                    <div class="ca-avatar">
                                        <i class="bx bx-user"></i>
                                    </div>
                                    <div class="ca-customer-name">
                                        {{ $appointment->customer_name }}
                                    </div>
                                </div>
                            </td>

                            <td>
                                <span class="ca-phone">
                                    <i class="bx bx-phone me-1"></i>
                                    {{ $appointment->customer_phone }}
                                </span>
                            </td>

                            <td>
                                <span class="ca-vehicle">
                                    <i class="bx bx-car"></i>
                                    {{ $appointment->vehicle_number_plate ?? '-' }}
                                </span>
                            </td>

                            <td>
                                <div class="ca-datetime">
                                    <strong>
                                        {{ $appointment->appointment_date->format('d-m-Y') }}
                                    </strong>
                                    <span>
                                        {{ $appointment->appointment_time->format('H:i') }}
                                    </span>
                                </div>
                            </td>

                            <td>
                                <div class="ca-issue">
                                    {{ Str::limit($appointment->issue_description, 30) ?? '-' }}
                                </div>
                            </td>

                            <td>
                                <span class="ca-status
                                    @if($appointment->status == 'pending') pending
                                    @elseif($appointment->status == 'confirmed') confirmed
                                    @elseif($appointment->status == 'in_progress') in-progress
                                    @elseif($appointment->status == 'completed') completed
                                    @else cancelled
                                    @endif">
                                    <i class="bx bx-circle" style="font-size:6px;"></i>
                                    {{ ucfirst(str_replace('_', ' ', $appointment->status)) }}
                                </span>
                            </td>

                            <td>
                                <div class="ca-actions">
                                    <button
                                        wire:click="view({{ $appointment->id }})"
                                        class="ca-icon-btn ca-icon-view"
                                        title="View Details">
                                        <i class="bx bx-show"></i>
                                    </button>

                                    <button
                                        wire:click="convertToJobCard({{ $appointment->id }})"
                                        class="ca-icon-btn ca-icon-convert"
                                        title="Convert to Job Card">
                                        <i class="bx bxs-file-plus"></i>
                                    </button>

                                    <button
                                        wire:click="edit({{ $appointment->id }})"
                                        class="ca-icon-btn ca-icon-edit"
                                        title="Edit">
                                        <i class="bx bx-edit"></i>
                                    </button>

                                    <button
                                        wire:click="delete({{ $appointment->id }})"
                                        class="ca-icon-btn ca-icon-delete"
                                        title="Delete">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="ca-empty">
                                <div class="ca-empty-icon">
                                    <i class="bx bx-calendar-x"></i>
                                </div>
                                <div class="fw-semibold">No appointments found</div>
                                <div class="small mt-1">Appointments matching your filters will appear here.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-3 py-3">
            {{ $appointments->links() }}
        </div>
    </div>

    {{-- Add / Edit Appointment Modal --}}
    @if($showModal)
        <div class="ca-modal-backdrop">
            <div class="ca-modal-dialog ca-modal-lg">
                <div class="ca-modal-content">

                    <div class="ca-modal-header">
                        <h5 class="ca-modal-title">
                            <i class="bx bx-calendar-plus me-2" style="color:#e53935;"></i>
                            {{ $isEdit ? 'Edit' : 'Add' }} Appointment
                        </h5>

                        <button
                            type="button"
                            wire:click="closeModal"
                            class="ca-modal-close">
                            <i class="bx bx-x"></i>
                        </button>
                    </div>

                    <div class="ca-modal-body">
                        <form wire:submit="{{ $isEdit ? 'update' : 'store' }}">

                            <div class="mb-4">
                                <label class="ca-field-label">
                                    Customer Name Or Vehicle
                                </label>

                                <div class="d-flex gap-2" wire:ignore>
                                    <div class="flex-grow-1">
                                        <select
                                            id="customer_name_select"
                                            class="form-select select2"
                                            data-property="customer_name">
                                            <option value="">--Select Customer--</option>

                                            @foreach($customers as $customer)
                                                @foreach($customer->vehicles as $vehicle)
                                                    <option
                                                        value="{{ $vehicle->id }}"
                                                        {{ $vehicle->id == $vehicle_id ? 'selected' : '' }}>
                                                        {{ $customer->name }}
                                                        {{ $customer->lastname ?? '' }}/
                                                        {{ $customer->mobile_no }}/
                                                        {{ $vehicle->brand }}/
                                                        {{ $vehicle->variant }}/
                                                        {{ $vehicle->number_plate }}
                                                    </option>
                                                @endforeach
                                            @endforeach
                                        </select>
                                    </div>

                                    <button
                                        type="button"
                                        class="ca-icon-btn ca-icon-view"
                                        style="width:42px;height:42px;"
                                        wire:click="openCustomerModal"
                                        title="Add Customer">
                                        <i class="bx bx-plus"></i>
                                    </button>
                                </div>

                                @error('vehicle_id')
                                    <span class="ca-error">{{ $message }}</span>
                                @enderror

                                @error('customer_id')
                                    <span class="ca-error">{{ $message }}</span>
                                @enderror
                            </div>

                            @if (!empty($customer_data))
                                <div class="ca-selected-info">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td class="ca-selected-info-label">Customer</td>
                                                <td class="ca-selected-info-value" style="width:25%;">
                                                    {{ $customer_data->cust_type == 1 ? 'M/S ' . ($customer_data->company_name ?? $customer_data->name) : trim(($customer_data->name ?? '') . ' ' . ($customer_data->lastname ?? '')) }}
                                                </td>

                                                <td class="ca-selected-info-label">Vehicle Name</td>
                                                <td class="ca-selected-info-value" style="width:25%;">
                                                    {{ ($vehicle_data->brand ?? '') . '/' . ($vehicle_data->variant ?? '') . '/' . ($vehicle_data->modification ?? '') }}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="ca-selected-info-label">Mobile No.</td>
                                                <td class="ca-selected-info-value">
                                                    {{ $customer_data->mobile_no ?? '' }}
                                                </td>

                                                <td class="ca-selected-info-label">Vehicle No.</td>
                                                <td class="ca-selected-info-value">
                                                    {{ $vehicle_data->number_plate ?? '' }}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="ca-selected-info-label">Address</td>
                                                <td class="ca-selected-info-value">
                                                    {{ $customer_data->address ?? '' }}
                                                </td>

                                                <td class="ca-selected-info-label">Chassis No.</td>
                                                <td class="ca-selected-info-value">
                                                    {{ $vehicle_data->chassis_no ?? '' }}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="ca-selected-info-label">GST</td>
                                                <td class="ca-selected-info-value">
                                                    {{ $customer_data->gst_number ?? '' }}
                                                </td>

                                                <td class="ca-selected-info-label">Engine No</td>
                                                <td class="ca-selected-info-value">
                                                    {{ $vehicle_data->engineno ?? '' }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endif

                            <div class="row mt-3">
                                <div class="col-md-6 mb-3">
                                    <label class="ca-field-label">
                                        Appointment Date <span class="ca-required">*</span>
                                    </label>

                                    <input
                                        type="date"
                                        wire:model="appointment_date"
                                        class="form-control @error('appointment_date') is-invalid @enderror">

                                    @error('appointment_date')
                                        <span class="ca-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="ca-field-label">
                                        Appointment Time <span class="ca-required">*</span>
                                    </label>

                                    <input
                                        type="time"
                                        wire:model="appointment_time"
                                        class="form-control @error('appointment_time') is-invalid @enderror">

                                    @error('appointment_time')
                                        <span class="ca-error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="ca-field-label">Issue Description</label>

                                <textarea
                                    wire:model="issue_description"
                                    class="form-control"
                                    rows="3"
                                    placeholder="Describe the customer issue..."></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="ca-field-label">
                                    Status <span class="ca-required">*</span>
                                </label>

                                <select
                                    wire:model="status"
                                    class="form-select @error('status') is-invalid @enderror">
                                    <option value="pending">Pending</option>
                                    <option value="confirmed">Confirmed</option>
                                    <option value="in_progress">In Progress</option>
                                    <option value="completed">Completed</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>

                                @error('status')
                                    <span class="ca-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="ca-field-label">Notes</label>

                                <textarea
                                    wire:model="notes"
                                    class="form-control"
                                    rows="2"
                                    placeholder="Add any additional notes..."></textarea>
                            </div>

                            <div class="ca-modal-footer px-0 pb-0 border-0 bg-white">
                                <button
                                    type="button"
                                    wire:click="closeModal"
                                    class="ca-btn ca-btn-secondary">
                                    Cancel
                                </button>

                                <button type="submit" class="ca-btn ca-btn-primary">
                                    <i class="bx bx-check"></i>
                                    {{ $isEdit ? 'Update' : 'Save' }}
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Customer Modal --}}
    @if($showCustomerModal)
        <div class="ca-modal-backdrop ca-customer-modal">
            <div class="ca-modal-dialog ca-modal-lg">
                <div class="ca-modal-content">

                    <form wire:submit.prevent="storeCustomer">

                        <div class="ca-modal-header">
                            <h5 class="ca-modal-title">
                                <i class="bx bx-user-plus me-2" style="color:#e53935;"></i>
                                Customer Add
                            </h5>

                            <button
                                type="button"
                                class="ca-modal-close"
                                wire:click="closeCustomerModal"
                                aria-label="Close">
                                <i class="bx bx-x"></i>
                            </button>
                        </div>

                        <div class="ca-modal-body">
                            @include('livewire.workshop.jobcard.includes.customer-add-form')

                        </div>

                        <div class="ca-modal-footer">
                            <button
                                type="button"
                                class="ca-btn ca-btn-secondary"
                                wire:click="closeCustomerModal">
                                Cancel
                            </button>

                            <button type="submit" class="ca-btn ca-btn-primary">
                                <i class="bx bx-check"></i>
                                Create
                                <i class="spinner-border spinner-border-sm" wire:loading></i>
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    @endif

    {{-- View Appointment Modal --}}
    @if($showViewModal && $selectedAppointment)
        <div class="ca-modal-backdrop">
            <div class="ca-modal-dialog ca-modal-xl">
                <div class="ca-modal-content">

                    <div class="ca-modal-header">
                        <h5 class="ca-modal-title">
                            <i class="bx bx-calendar-event me-2" style="color:#e53935;"></i>
                            Appointment Details -
                            {{ $selectedAppointment->appointment_date->format('d M, Y') }}
                        </h5>

                        <button
                            wire:click="closeViewModal"
                            class="ca-modal-close">
                            <i class="bx bx-x"></i>
                        </button>
                    </div>

                    <div class="ca-modal-body">
                        <div class="row g-3">

                            {{-- Customer Details --}}
                            <div class="col-md-6">
                                <div class="ca-info-card">
                                    <div class="ca-info-card-header">
                                        <i class="bx bx-user"></i>
                                        <h6>Customer Information</h6>
                                    </div>

                                    <table class="ca-info-table">
                                        <tbody>
                                            <tr>
                                                <th>Name</th>
                                                <td>
                                                    @if($selectedAppointment->customer)
                                                        {{ $selectedAppointment->customer->cust_type == 1 ? 'M/S ' . $selectedAppointment->customer->company_name : $selectedAppointment->customer->user_title . '. ' . $selectedAppointment->customer->name . ' ' . $selectedAppointment->customer->lastname }}
                                                    @else
                                                        {{ $customer_name }}
                                                    @endif
                                                </td>
                                            </tr>

                                            <tr>
                                                <th>Phone</th>
                                                <td>{{ $customer_phone }}</td>
                                            </tr>

                                            <tr>
                                                <th>Email</th>
                                                <td>{{ $selectedAppointment->customer->email ?? '-' }}</td>
                                            </tr>

                                            <tr>
                                                <th>GST No.</th>
                                                <td>{{ $selectedAppointment->customer->gst_number ?? '-' }}</td>
                                            </tr>

                                            <tr>
                                                <th>Address</th>
                                                <td>{{ $selectedAppointment->customer->address ?? '-' }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- Vehicle Details --}}
                            <div class="col-md-6">
                                <div class="ca-info-card">
                                    <div class="ca-info-card-header">
                                        <i class="bx bx-car"></i>
                                        <h6>Vehicle Information</h6>
                                    </div>

                                    <table class="ca-info-table">
                                        <tbody>
                                            <tr>
                                                <th>Number Plate</th>
                                                <td>
                                                    <strong>{{ $vehicle_number_plate ?? '-' }}</strong>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th>Brand/Variant</th>
                                                <td>
                                                    {{ $selectedAppointment->vehicle->brand ?? '-' }}
                                                    /
                                                    {{ $selectedAppointment->vehicle->variant ?? '-' }}
                                                </td>
                                            </tr>

                                            <tr>
                                                <th>Model/Year</th>
                                                <td>
                                                    {{ $selectedAppointment->vehicle->modification ?? '-' }}
                                                    ({{ $selectedAppointment->vehicle->year ?? '-' }})
                                                </td>
                                            </tr>

                                            <tr>
                                                <th>Chassis No.</th>
                                                <td>{{ $selectedAppointment->vehicle->chassis_no ?? '-' }}</td>
                                            </tr>

                                            <tr>
                                                <th>Engine No.</th>
                                                <td>{{ $selectedAppointment->vehicle->engineno ?? '-' }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- Driver & Insurance --}}
                            <div class="col-md-6">
                                <div class="ca-info-card">
                                    <div class="ca-info-card-header">
                                        <i class="bx bx-shield-quarter"></i>
                                        <h6>Driver & Insurance</h6>
                                    </div>

                                    <table class="ca-info-table">
                                        <tbody>
                                            <tr>
                                                <th>Driver Name</th>
                                                <td>
                                                    {{ $selectedAppointment->vehicle->driver_name ?? '-' }}
                                                    ({{ $selectedAppointment->vehicle->driver_number ?? '-' }})
                                                </td>
                                            </tr>

                                            <tr>
                                                <th>Insurance</th>
                                                <td>{{ $selectedAppointment->vehicle->insurance_name ?? '-' }}</td>
                                            </tr>

                                            <tr>
                                                <th>Policy No.</th>
                                                <td>{{ $selectedAppointment->vehicle->policy_number ?? '-' }}</td>
                                            </tr>

                                            <tr>
                                                <th>Policy Expiry</th>
                                                <td>
                                                    {{ $selectedAppointment->vehicle->policy_expiry_date
                                                        ? \Carbon\Carbon::parse($selectedAppointment->vehicle->policy_expiry_date)->format('d-m-Y')
                                                        : '-' }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- Appointment Info --}}
                            <div class="col-md-6">
                                <div class="ca-info-card">
                                    <div class="ca-info-card-header">
                                        <i class="bx bx-calendar-event"></i>
                                        <h6>Appointment Details</h6>
                                    </div>

                                    <table class="ca-info-table">
                                        <tbody>
                                            <tr>
                                                <th>Date & Time</th>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($appointment_date)->format('d-m-Y') }}
                                                    at
                                                    {{ \Carbon\Carbon::parse($appointment_time)->format('H:i') }}
                                                </td>
                                            </tr>

                                            <tr>
                                                <th>Status</th>
                                                <td>
                                                    <div class="ca-detail-status">
                                                        <select
                                                            wire:change="updateStatus($event.target.value)"
                                                            class="form-select form-select-sm">
                                                            <option value="pending" {{ $status == 'pending' ? 'selected' : '' }}>
                                                                Pending
                                                            </option>
                                                            <option value="confirmed" {{ $status == 'confirmed' ? 'selected' : '' }}>
                                                                Confirmed
                                                            </option>
                                                            <option value="in_progress" {{ $status == 'in_progress' ? 'selected' : '' }}>
                                                                In Progress
                                                            </option>
                                                            <option value="completed" {{ $status == 'completed' ? 'selected' : '' }}>
                                                                Completed
                                                            </option>
                                                            <option value="cancelled" {{ $status == 'cancelled' ? 'selected' : '' }}>
                                                                Cancelled
                                                            </option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th>Issue Description</th>
                                                <td>{{ $issue_description ?? 'No description provided' }}</td>
                                            </tr>

                                            <tr>
                                                <th>Notes</th>
                                                <td>{{ $notes ?? '-' }}</td>
                                            </tr>

                                            @if($selectedAppointment->vehicle && ($selectedAppointment->vehicle->pickup_address || $selectedAppointment->vehicle->drop_address))
                                                <tr>
                                                    <th>Pickup Address</th>
                                                    <td>{{ $selectedAppointment->vehicle->pickup_address ?? '-' }}</td>
                                                </tr>

                                                <tr>
                                                    <th>Drop Address</th>
                                                    <td>{{ $selectedAppointment->vehicle->drop_address ?? '-' }}</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="ca-modal-footer">
                        <button
                            wire:click="convertToJobCard({{ $appointmentId }})"
                            class="ca-btn ca-btn-success">
                            <i class="bx bxs-file-plus"></i>
                            Convert to Job Card
                        </button>

                        <button
                            wire:click="closeViewModal"
                            class="ca-btn ca-btn-secondary">
                            Close
                        </button>
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

                        const results = Array.isArray(data.data)
                            ? data.data.map(item => ({
                                id: item.id,
                                text: `${item.name || ''} ${item.lastname || ''}/${item.mobile_no || ''}/${item.brand || ''} ${item.variant || ''}/${item.number_plate || ''}`,
                            }))
                            : [];

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