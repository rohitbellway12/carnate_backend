 
<div>
    <style>
        .mode {
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            font-size: 18px;
        }

        .mode:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }
        </style>
    @if($isAdd == true)
    @livewire('Workshop.JobCartAddController')
    @elseif($isEdit == true)
    @livewire('Workshop.JobCartEditController', ['id' => $jobId])
    @else
    <div class="card">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div class="breadcrumb-title pe-2" style="border: none;">Job Cart</div>
            <div class="row">
            <div class="pe-3">
                <a href="javascript:;" wire:click="create(1)" class="btn btn-primary radius-30 mt-2 mt-lg-0">
                    <i class="bx bxs-plus-square"></i>Add
                </a>
        </div>
    </div>
      
    </div>
    <div class="row p-3">
    <div class="col-lg-3 col-md-6 col-12 mb-3">
        <div class="card overflow-hidden" wire:click="$set('mode', 0)">
            <div class="card-body  mode bg-danger text-white d-flex justify-content-between">
                <span><b><i class="fa-solid fa-unlock"></i> Open</b></span>
                <span><b>( {{ count($jobcardsCount->where('status', 0)) }} )</b></span>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-12 mb-3">
        <div class="card overflow-hidden" wire:click="$set('mode', 1)">
            <div class="card-body mode bg-primary text-white d-flex justify-content-between">
                <span><b><i class="fa-solid fa-circle-check"></i> Confirmed</b></span>
                <span><b>( {{ count($jobcardsCount->where('status', 1)) }} )</b></span>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-12 mb-3">
        <div class="card overflow-hidden" wire:click="$set('mode', 2)">
            <div class="card-body mode bg-info text-white d-flex justify-content-between">
                <span><b><i class="fa-solid fa-arrows-rotate"></i> In-Progress</b></span>
                <span><b>( {{ count($jobcardsCount->where('status', 2)) }} )</b></span>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-12 mb-3">
        <div class="card overflow-hidden" wire:click="$set('mode', 3)">
            <div class="card-body mode bg-success text-white d-flex justify-content-between" style>
                <span ><b><i class="fa-solid fa-flag-checkered"></i> Completed</b></span>
                <span><b>( {{ count($jobcardsCount->where('status', 3)) }} )</b></span>
            </div>
        </div>
    </div>
    </div>
    <div class="card mt-4">
        @if (!empty($items) && $items->count())
        <div class="card-body ">
            <div class="table-responsive">
                <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Entry Date</th>
                                <th>Job-Card Number</th>
                                <th>Customer Name</th>
                                <th>Vehical Number</th> 
                                <th>Vehical</th> 
                                <th>Bill Amount</th>
                                <th>Advance</th>
                                <th>Balance</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $index => $jobcard)
                                <tr>
                                    <td>{{ $items->total() - ($items->firstItem() + $index) + 1 }}</td>
                                        <td><a>{{ \Carbon\Carbon::parse($jobcard->entry_date)->format('d-m-Y h:i A') ?? '-' }}</a>
                                        </td>
                                        <td><a>{{ $jobcard->jobcard_number ?? '-' }}</a>
                                        </td>
                                        <td><a>{{ $jobcard->customer_name ?? '-' }}</a>
                                        </td>
                                        <td><a>{{ $jobcard->vehical_number ?? '-' }}</a>
                                        </td>
                                        <td><a>{{ $jobcard->vehical ?? '-' }}</a>
                                        </td>
                                        <td><a>{{ $jobcard->amount ?? '-' }}</a>
                                        </td>
                                        <td><a class="{{ $jobcard->amount > $jobcard->advance ? '' : 'text-success' }}">{{ $jobcard->advance ?? '-' }}</a>
                                        </td>
                                        <td><a  class="{{ $jobcard->amount > $jobcard->advance ? 'text-danger' : 'text-success' }}">{{ $jobcard->balance_amount ?? '-' }}</a>
                                        </td>
                                        <td>
                                            @switch($jobcard->status)
                                                @case(1)
                                                    <span class="badge bg-primary">Confirmed</span>
                                                @break

                                                @case(2)
                                                    <span class="badge bg-info">In-Progress</span>
                                                @break
                                                @case(3)
                                                    <span class="badge bg-success">Completed</span>
                                                @break

                                                @default
                                                    <span class="badge bg-danger">Open</span>
                                            @endswitch
                                        </td>
                                    <td>
                                        <a wire:click="edit({{ $jobcard->id }})" class="btn btn-sm p-0"><i
                                                class="bx bxs-edit"></i> <span class="small"></span></a>
                                        <a wire:click="confirmDelete({{ $jobcard->id }})"
                                            class="btn btn-sm p-0"><i class="fadeIn animated bx bx-trash"></i> <span
                                                class="small"></span></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pagination-wrapper">
                        {{ $items->links() }} 
                    </div>
                </div>
            </div>
        @else
            <div class="my-2">
                <div class="alert alert-info">No Staff Found!</div>
            </div>
        @endif
    </div>

</div>
    @endif
</div>
@section('footerscript')
   
    <script> 
     
        document.addEventListener('livewire:init', function () { 

       
           
            Livewire.hook('morphed', (message, component) => { 
                $('.select2').select2().on('change', function(e){ 
                    const selectedValues = $(this).val();
                    @this.set(e.target.dataset.property,selectedValues);
              });
            });

            
        });
        document.addEventListener('show-dent-modal', () => {
  
   const modal = document.querySelector('.modal');
   const backgroundCanvas = document.getElementById('backgroundCanvas');
   const overlayCanvas = document.getElementById('overlayCanvas');
   const bgCtx = backgroundCanvas.getContext('2d');
   const overlayCtx = overlayCanvas.getContext('2d');
   const carImageTag = document.getElementById('carImageTag');
   const carImage = new Image();
   

   // Set the source dynamically using Laravel's `asset()` helper function
   carImage.src = "{{ asset('assets/dentcar/car.png') }}"; // This will insert the correct URL

   // When modal is triggered
   const showModalButton = document.getElementById('showModalButton'); // Assuming you have a button to show the modal
   if (showModalButton) {
       showModalButton.addEventListener('click', () => {
           modal.classList.add('show');
           modal.style.display = 'block'; // Make sure modal is visible
           carImageTag.style.display = 'block'; // Ensure the image is also visible
       });
   }

   // Image load event to ensure image is drawn when fully loaded
   carImage.onload = () => {
       const scaleFactor = 0.7; // Resize image to 70%
       const newWidth = carImage.width * scaleFactor;
       const newHeight = carImage.height * scaleFactor;

       // Set canvas dimensions
       backgroundCanvas.width = newWidth;
       backgroundCanvas.height = newHeight;
       overlayCanvas.width = newWidth;
       overlayCanvas.height = newHeight;

       // Draw the image on the background canvas
       bgCtx.drawImage(carImage, 0, 0, newWidth, newHeight);
   };

   // Drawing Logic
   let drawing = false;
   let mode = 'dent'; // Default mode

   const penSettings = {
       dent: { color: 'yellow', size: 5 },
       scratch: { color: 'green', size: 5 },
       break: { color: 'red', size: 5 },
       erase: { size: 15 } // Eraser size
   };

   // Mode Switching
   const buttons = document.querySelectorAll('.controls button');
   buttons.forEach(button => {
       button.addEventListener('click', () => {
           buttons.forEach(btn => btn.classList.remove('active'));
           button.classList.add('active');
           mode = button.id.replace('Btn', '');
       });
   });

   // Overlay Canvas Event Listeners
   overlayCanvas.addEventListener('mousedown', () => {
       drawing = true;
       overlayCtx.beginPath();
   });
   overlayCanvas.addEventListener('mouseup', () => {
       drawing = false;
       overlayCtx.beginPath();
   });
   overlayCanvas.addEventListener('mousemove', draw);

   function draw(event) {
       if (!drawing) return;

       const rect = overlayCanvas.getBoundingClientRect();
       const x = event.clientX - rect.left;
       const y = event.clientY - rect.top;

       overlayCtx.lineCap = 'round';

       if (mode === 'erase') {
           overlayCtx.globalCompositeOperation = 'destination-out';
           overlayCtx.lineWidth = penSettings.erase.size;
       } else {
           overlayCtx.globalCompositeOperation = 'source-over';
           overlayCtx.strokeStyle = penSettings[mode].color;
           overlayCtx.lineWidth = penSettings[mode].size;
       }

       overlayCtx.lineTo(x, y);
       overlayCtx.stroke();
       overlayCtx.beginPath();
       overlayCtx.moveTo(x, y);
   }

   // Clear Overlay Canvas
   document.getElementById('clearBtn').addEventListener('click', () => {
       overlayCtx.clearRect(0, 0, overlayCanvas.width, overlayCanvas.height);
   });
   let beta = 0;
  
   // Save Merged Image and Send to Laravel
   document.getElementById('saveBtn').addEventListener('click', () => {
    if (beta = 0) {
        beta = 1;
       if (!confirm("Are you sure you want to save the changes?")) return; 
    }
    //    ekk variable banano bata name rahe 1 ho jaye agar  
    

       const mergedCanvas = document.createElement('canvas');
       const mergedCtx = mergedCanvas.getContext('2d');

       mergedCanvas.width = backgroundCanvas.width;
       mergedCanvas.height = backgroundCanvas.height;

       mergedCtx.drawImage(backgroundCanvas, 0, 0);
       mergedCtx.drawImage(overlayCanvas, 0, 0);

       const mergedImageData = mergedCanvas.toDataURL('image/png');

       // Send the image data to Livewire
       Livewire.dispatch('saveImage', { mergedImageData: mergedImageData });

   });
});
      
    </script>
@endsection
