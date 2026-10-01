<div class="carnate-vehicles-page">

    <style>
        .carnate-vehicles-page {
            --cv-card: #ffffff;
            --cv-text: #111827;
            --cv-muted: #64748b;
            --cv-border: #e2e8f0;
            --cv-red: #e53935;
            --cv-red-dark: #c92f2c;
            --cv-red-soft: #fff5f5;
        }

        .carnate-vehicles-page .cv-card {
            background: var(--cv-card);
            border: 1px solid var(--cv-border);
            border-radius: 16px;
            box-shadow: 0 4px 18px rgba(15, 23, 42, .04);
        }

        /* Header */
        .carnate-vehicles-page .cv-header {
            padding: 20px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .carnate-vehicles-page .cv-title-wrap {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .carnate-vehicles-page .cv-title-icon {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: var(--cv-red-soft);
            color: var(--cv-red);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 21px;
        }

        .carnate-vehicles-page .cv-title {
            margin: 0;
            color: var(--cv-text);
            font-size: 20px;
            line-height: 1.3;
            font-weight: 700;
        }

        .carnate-vehicles-page .cv-subtitle {
            margin: 4px 0 0;
            color: var(--cv-muted);
            font-size: 13px;
        }

        /* Search */
        .carnate-vehicles-page .cv-filter {
            margin-top: 16px;
            padding: 18px 20px;
        }

        .carnate-vehicles-page .cv-filter-row {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .carnate-vehicles-page .cv-search {
            max-width: 390px;
            flex: 1;
            position: relative;
        }

        .carnate-vehicles-page .cv-search i {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 18px;
            z-index: 2;
        }

        .carnate-vehicles-page .cv-search input {
            height: 44px;
            padding-left: 40px;
            border: 1px solid var(--cv-border);
            border-radius: 10px;
            color: var(--cv-text);
            font-size: 14px;
            box-shadow: none;
        }

        .carnate-vehicles-page .cv-search input:focus {
            border-color: rgba(229, 57, 53, .45);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, .08);
        }

        .carnate-vehicles-page .cv-clear {
            height: 44px;
            padding: 0 17px;
            border: 1px solid var(--cv-border);
            border-radius: 10px;
            background: #fff;
            color: var(--cv-muted);
            font-size: 14px;
            font-weight: 600;
            transition: .2s ease;
        }

        .carnate-vehicles-page .cv-clear:hover {
            background: #f8fafc;
            color: var(--cv-text);
        }

        /* Table */
        .carnate-vehicles-page .cv-table-card {
            margin-top: 16px;
            overflow: hidden;
        }

        .carnate-vehicles-page .cv-table-wrap {
            overflow-x: auto;
        }

        .carnate-vehicles-page .cv-table {
            width: 100%;
            min-width: 1250px;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .carnate-vehicles-page .cv-table thead th {
            padding: 15px 16px;
            background: #f8fafc;
            color: #64748b;
            border-bottom: 1px solid var(--cv-border);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .035em;
            white-space: nowrap;
            vertical-align: middle;
        }

        .carnate-vehicles-page .cv-table tbody td {
            padding: 14px 16px;
            border-bottom: 1px solid #edf1f5;
            color: #334155;
            font-size: 13px;
            vertical-align: middle;
            background: #fff;
        }

        .carnate-vehicles-page .cv-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .carnate-vehicles-page .cv-table tbody tr:hover td {
            background: #fafbfc;
        }

        .carnate-vehicles-page .cv-sno {
            color: #94a3b8 !important;
            font-weight: 600;
            width: 65px;
        }

        /* Vehicle image */
        .carnate-vehicles-page .cv-image {
            width: 52px;
            height: 42px;
            object-fit: cover;
            border-radius: 9px;
            border: 1px solid var(--cv-border);
            background: #f8fafc;
            display: block;
        }

        .carnate-vehicles-page .cv-no-image {
            width: 52px;
            height: 42px;
            border-radius: 9px;
            background: #f1f5f9;
            color: #94a3b8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
        }

        /* Type */
        .carnate-vehicles-page .cv-type {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 9px;
            border-radius: 7px;
            background: #f1f5f9;
            color: #475569;
            font-size: 12px;
            font-weight: 600;
        }

        .carnate-vehicles-page .cv-type i {
            font-size: 15px;
        }

        /* Model */
        .carnate-vehicles-page .cv-model {
            color: var(--cv-text);
            font-weight: 650;
        }

        /* Number plate */
        .carnate-vehicles-page .cv-plate {
            display: inline-flex;
            align-items: center;
            padding: 6px 10px;
            border-radius: 7px;
            background: #f8fafc;
            border: 1px solid var(--cv-border);
            color: var(--cv-text);
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        /* Customer */
        .carnate-vehicles-page .cv-customer {
            display: flex;
            align-items: center;
            gap: 9px;
            min-width: 150px;
        }

        .carnate-vehicles-page .cv-avatar {
            width: 34px;
            height: 34px;
            min-width: 34px;
            border-radius: 9px;
            background: var(--cv-red-soft);
            color: var(--cv-red);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 700;
        }

        .carnate-vehicles-page .cv-customer-name {
            color: var(--cv-text);
            font-weight: 600;
        }

        /* Dates */
        .carnate-vehicles-page .cv-date {
            color: #475569;
            white-space: nowrap;
        }

        .carnate-vehicles-page .cv-date-muted {
            color: #94a3b8;
        }

        /* Engine */
        .carnate-vehicles-page .cv-engine {
            color: #475569;
            font-family: monospace;
            font-size: 12px;
        }

        /* Pagination */
        .carnate-vehicles-page .cv-pagination {
            padding: 17px 20px;
            border-top: 1px solid var(--cv-border);
            background: #fff;
        }

        /* Empty */
        .carnate-vehicles-page .cv-empty {
            padding: 55px 20px;
            text-align: center;
        }

        .carnate-vehicles-page .cv-empty-icon {
            width: 58px;
            height: 58px;
            margin: 0 auto 13px;
            border-radius: 15px;
            background: #f1f5f9;
            color: #94a3b8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 25px;
        }

        .carnate-vehicles-page .cv-empty-title {
            color: var(--cv-text);
            font-size: 15px;
            font-weight: 700;
        }

        .carnate-vehicles-page .cv-empty-text {
            margin-top: 5px;
            color: var(--cv-muted);
            font-size: 13px;
        }

        @media (max-width: 767px) {
            .carnate-vehicles-page .cv-header {
                align-items: flex-start;
            }

            .carnate-vehicles-page .cv-filter-row {
                flex-direction: column;
                align-items: stretch;
            }

            .carnate-vehicles-page .cv-search {
                max-width: none;
            }

            .carnate-vehicles-page .cv-clear {
                width: 100%;
            }
        }
    </style>


    {{-- Success Message --}}
    @if (session()->has('message'))
        <div class="alert alert-success border-0 rounded-3 mb-3">
            <i class="bx bx-check-circle me-1"></i>
            {{ session('message') }}
        </div>
    @endif


    {{-- Page Header --}}
    <div class="cv-card cv-header">

        <div class="cv-title-wrap">

            <div class="cv-title-icon">
                <i class="fas fa-car"></i>
            </div>

            <div>
                <h1 class="cv-title">Vehicles List</h1>

                <p class="cv-subtitle">
                    View and manage registered vehicle information
                </p>
            </div>

        </div>

    </div>


    {{-- Search --}}
    <div class="cv-card cv-filter">

        <div class="cv-filter-row">

            <div class="cv-search">

                <i class="bx bx-search"></i>

                <input type="text"
                    class="form-control"
                    placeholder="Search vehicle..."
                    wire:model.live.debounce.500ms="search">

            </div>

            <button type="button"
                class="cv-clear"
                wire:click="resetFilter">

                <i class="bx bx-reset me-1"></i>
                Clear

            </button>

        </div>

    </div>


    {{-- Vehicles Table --}}
    <div class="cv-card cv-table-card">

        @if (!empty($vehicles) && $vehicles->count())

            <div class="cv-table-wrap">

                <table class="cv-table">

                    <thead>

                        <tr>
                            <th>S.No.</th>
                            <th>Image</th>
                            <th>Type</th>
                            <th>Model Name</th>
                            <th>Number Plate</th>
                            <th>Customer Name</th>
                            <th>Date of Manufacturing</th>
                            <th>Last Service Date</th>
                            <th>Upcoming Service Date</th>
                            <th>Engine No</th>
                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($vehicles as $index => $vehicle)

                            <tr>

                                {{-- S.No --}}
                                <td class="cv-sno">
                                    {{ $vehicles->total() - ($vehicles->firstItem() + $index) + 1 }}
                                </td>


                                {{-- Image --}}
                                <td>

                                    @if ($vehicle->vehicleimage?->image)

                                        <img src="{{ asset($vehicle->vehicleimage->image) }}"
                                            alt="Vehicle"
                                            class="cv-image">

                                    @else

                                        <div class="cv-no-image">
                                            <i class="bx bx-car"></i>
                                        </div>

                                    @endif

                                </td>


                                {{-- Type --}}
                                <td>

                                    <span class="cv-type">
                                        <i class="bx bx-car"></i>
                                        {{ $vehicle->vehicletype?->vehicle_type ?? '-' }}
                                    </span>

                                </td>


                                {{-- Model --}}
                                <td>

                                    <span class="cv-model">
                                        {{ $vehicle->modelname }}
                                    </span>

                                </td>


                                {{-- Number Plate --}}
                                <td>

                                    @if ($vehicle->number_plate)

                                        <span class="cv-plate">
                                            {{ $vehicle->number_plate }}
                                        </span>

                                    @else

                                        <span class="cv-date-muted">-</span>

                                    @endif

                                </td>


                                {{-- Customer --}}
                                <td>

                                    @if ($vehicle->vehicleuser)

                                        <div class="cv-customer">

                                            <div class="cv-avatar">

                                                {{ strtoupper(
                                                    substr($vehicle->vehicleuser->name ?? '', 0, 1) .
                                                    substr($vehicle->vehicleuser->lastname ?? '', 0, 1)
                                                ) }}

                                            </div>

                                            <span class="cv-customer-name">
                                                {{ $vehicle->vehicleuser->name . ' ' . $vehicle->vehicleuser->lastname }}
                                            </span>

                                        </div>

                                    @else

                                        <span class="cv-date-muted">-</span>

                                    @endif

                                </td>


                                {{-- Date of Manufacturing --}}
                                <td>

                                    @if (!empty($vehicle->dom))

                                        <span class="cv-date">
                                            {{ date(getDateFormat(), strtotime($vehicle->dom)) }}
                                        </span>

                                    @else

                                        <span class="cv-date-muted">-</span>

                                    @endif

                                </td>


                                {{-- Last Service --}}
                                <td>

                                    @if ($vehicle->lastServiceDate)

                                        <span class="cv-date">
                                            {{ $vehicle->lastServiceDate->format('Y-m-d') }}
                                        </span>

                                    @else

                                        <span class="cv-date-muted">-</span>

                                    @endif

                                </td>


                                {{-- Upcoming Service --}}
                                <td>

                                    @if ($vehicle->upcomingServiceDate)

                                        <span class="cv-date">
                                            {{ $vehicle->upcomingServiceDate->format('Y-m-d') }}
                                        </span>

                                    @else

                                        <span class="cv-date-muted">-</span>

                                    @endif

                                </td>


                                {{-- Engine --}}
                                <td>

                                    @if ($vehicle->engineno)

                                        <span class="cv-engine">
                                            {{ $vehicle->engineno }}
                                        </span>

                                    @else

                                        <span class="cv-date-muted">-</span>

                                    @endif

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            <div class="cv-pagination">
                {{ $vehicles->links() }}
            </div>

        @else

            <div class="cv-empty">

                <div class="cv-empty-icon">
                    <i class="bx bx-car"></i>
                </div>

                <div class="cv-empty-title">
                    No Vehicles found!
                </div>

                <div class="cv-empty-text">
                    Registered vehicles will appear here once available.
                </div>

            </div>

        @endif

    </div>

</div>


@section('footerscript')
@endsection