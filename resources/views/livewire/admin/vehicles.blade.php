<div>
    <!-- Success Message -->
    @if (session()->has('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <div class="card">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div class="breadcrumb-title pe-2" style="border: none;"><i class="fas fa-car fs-5"></i> Vehicles List</div>
            <div class="pe-3">
                <a href="javascript:;" wire:click="create" class="btn btn-primary radius-30 mt-2 mt-lg-0 d-none"><i
                        class="bx bxs-plus-square"></i>Add</a>
            </div>
        </div>
    </div>
    
    <div class="card mt-4">
        <div class="card-body">
            <div class="row">
            <div class="col-3">
                <input type="text" class="form-control" placeholder="Search"
                wire:model.live.debounce.500ms="search">
            </div>
            <div class="col-9 text-right">
                <button type="button" class="mr-2 btn btn-info text-white rounded-0  float-end" wire:click="resetFilter" fdprocessedid="orntg">Clear</button>
             </div>
            </div>
            
        </div>
    </div>
 
    <div class="card mt-4">
        @if (!empty($vehicles) && $vehicles->count())
        <div class="card-body ">
            <div class="table-responsive">
                <table class="table table-bordered data-table">
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
                            {{-- <th>Actions</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vehicles as $index => $vehicle)
                        <tr>
                            <td>{{ $vehicles->total() - ($vehicles->firstItem() + $index) + 1 }}</td>
                            <td>{{$vehicle->vehicleimage?->image ?? '-'}}</td>
                            <td>{{$vehicle->vehicletype?->vehicle_type}}</td>
                            <td>{{$vehicle->modelname}}</td>
                            <td>{{$vehicle->number_plate}}</td>
                            <td>{{ $vehicle->vehicleuser ? $vehicle->vehicleuser->name . ' ' . $vehicle->vehicleuser->lastname : '-'}}</td>                           
                             <td>
                                @if (!empty($vehicals->dom))
                                {{ date(getDateFormat(), strtotime($vehicals->dom)) }}
                                @else
                                {{ trans('-') }}
                                @endif
                             </td>
                            <td>{{ $vehicle->lastServiceDate ? $vehicle->lastServiceDate->format('Y-m-d') : '-' }} </td>
                            <td>{{ $vehicle->upcomingServiceDate ? $vehicle->upcomingServiceDate->format('Y-m-d') : '-' }} </td>
                            <td>{{$vehicle->engineno ? $vehicle->engineno : '-'}}</td>
                            {{-- <td>
                                <a wire:click="edit({{ $vehicle->id }})" class="btn btn-sm p-0"><i
                                        class="bx bxs-edit"></i> <span class="small"></span></a>
                                <a wire:click="confirmDelete({{ $vehicle->id }})"
                                    class="btn btn-sm p-0"><i class="fadeIn animated bx bx-trash"></i> <span
                                        class="small"></span></a>
                            </td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination-wrapper">
                    {{ $vehicles->links() }}
                </div>
            </div>
        </div>
        @else
        <div class="my-2">
            <div class="alert alert-info">No Vehicals found!</div>
        </div>
        @endif
    </div>

</div>
@section('footerscript')
@endsection