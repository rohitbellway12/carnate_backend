<div>
    <!-- Success Message -->
    @if (session()->has('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <div class="card">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div class="breadcrumb-title pe-2" style="border: none;">Colors</div>
            <div class="pe-3">
                {{-- <a href="javascript:;" wire:click="create" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i
                        class="bx bxs-plus-square"></i>Add</a> --}}
            </div>
        </div>
    </div>
    <div class="card mt-4">
        @if (!empty($vehiclecolors) && $vehiclecolors->count())
        <div class="card-body ">
            <div class="table-responsive">
                <table class="table table--bordered data-table">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Name</th>
                            <th>Color</th>
                            {{-- <th>Actions</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vehiclecolors as $index => $vehiclecolor)
                        <tr>
                            <td>{{ $vehiclecolors->total() - ($vehiclecolors->firstItem() + $index) + 1 }}</td>
                            <td>{{ $vehiclecolor->color }}</td>
                            <td>
                                <a href="javascript:void(0)">
                                    <div class="color_code" style="background-color:{{ $vehiclecolor->color_code }};">#fff94d</div>
                                </a>
                            </td>
                            {{-- <td>
                                <a wire:click="edit({{ $vehiclecolor->id }})" class="btn btn-sm p-0"><i
                                        class="bx bxs-edit"></i> <span class="small"></span></a>
                                <a wire:click="confirmDelete({{ $vehiclecolor->id }})"
                                    class="btn btn-sm p-0"><i class="fadeIn animated bx bx-trash"></i> <span
                                        class="small"></span></a>
                            </td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination-wrapper">
                    {{ $vehiclecolors->links() }}
                </div>
            </div>
        </div>
        @else
        <div class="my-2">
            <div class="alert alert-info">No Vehicle Colors found!</div>
        </div>
        @endif
    </div>

</div>
@section('footerscript')
@endsection