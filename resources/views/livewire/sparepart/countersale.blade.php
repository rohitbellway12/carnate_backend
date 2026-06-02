 
<div>
    <style>
        .mode {
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            font-size: 14px;
        }

        .mode:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }
        .countersaletable td{ 
                cursor: pointer;
            } 
            .countersaletable td a:hover {
                color: #EA6B00;
            }   
            .countersaletable td a {
                color: #333;
            }
            
        .bg-danger {
            background: linear-gradient(135deg, #e63946, #ff6b6b);
        }

        .bg-primary {
            background: linear-gradient(135deg, #007bff, #409eff);
        }

        .bg-info {
            background: linear-gradient(135deg, #17a2b8, #67d1f3);
        }

        .bg-success {
            background: linear-gradient(135deg, #28a745, #72d572);
        }
 
        </style>
         @php
         $sparePart = App\Models\SparePartVendor::where('id', $sparePartId)->first();
     @endphp
    @if($isAdd == true)
    @livewire('Sparepart.ConterSaleAddController') 
    @else
    <div class="card">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div class="breadcrumb-title pe-2" style="border: none;">Counter Sale</div>
            <div class="row">
        @if (@$sparePart->hasPermissionTo('countersale-add'))
            <div class="pe-3"> 
                <a href="{{route('sparepart.countersaleadd')}}" class="btn btn-primary radius-30 mt-2 mt-lg-0">
                    <i class="bx bxs-plus-square"></i>Add
                </a> 
        </div>
        @endif
            </div>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-body">
            <div class="row">
            <div class="col-3">
                <input type="text" class="form-control" placeholder="Search ..." wire:model.live="searchfilter" fdprocessedid="blgf5">
            </div>
            <div class="col-9 text-right">
                <button type="button" class="mr-2 btn btn-info text-white rounded-0  float-end" wire:click="resetFilter" fdprocessedid="orntg">Clear</button>
             </div>
            </div>
            
        </div>
    </div>
    <div class="card mt-4">
        @if (!empty($items) && $items->count())
        <div class="card-body ">
            <div class="table-responsive">
                <table class="table table-bordered data-table countersaletable">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Entry Date</th>
                                <th>Counter Sale Number</th>
                                <th>Customer Name</th>
                                <th>Bill Amount</th>
                                <th>Total Paid</th>
                                <th>Balance</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $index => $countersale)
                                <tr>
                                    <td>{{ $items->total() - ($items->firstItem() + $index) + 1 }}</td>
                                    <td>
                                        <a href="{{ route('sparepart.countersaleedit', $countersale->id) }}">
                                            {{ \Carbon\Carbon::parse($countersale->created_at)->format('d-m-Y h:i A') ?? '-' }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('sparepart.countersaleedit', $countersale->id) }}" >
                                            {{ $countersale->countersale_number ?? '-' }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('sparepart.countersaleedit', $countersale->id) }}" >
                                            {{ $countersale->Customer->name ?? '-' }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('sparepart.countersaleedit', $countersale->id) }}" >
                                            {{ $countersale->subtotal ?? '-' }}
                                        </a>
                                    </td>
                                    <td>
                                        <a style="color: black;">
                                            {{ $countersale->partial_amount ?? '-' }}
                                        </a>
                                    </td>
                                    <td>
                                        <a style="color: black;">
                                            {{ $countersale->balance_amount ?? '-' }}
                                        </a>
                                    </td>
                                    <td> 
                                        {!! App\Models\CounterSale::$status[$countersale->status] ?? '<span class="badge bg-danger">Un-paid</span>' !!}
                                    </td>
                                    @if (@$sparePart->hasPermissionTo('countersale-edit') || @$sparePart->hasPermissionTo('countersale-delete'))
                                    <td>
                                        @if (@$sparePart->hasPermissionTo('countersale-edit'))
                                        <a href="{{ route('sparepart.countersaleedit', $countersale->id) }}" class="btn btn-sm p-0">
                                            <i class="bx bxs-edit"></i>
                                        </a>   
                                        @endif
                                        @if (@$sparePart->hasPermissionTo('countersale-delete'))
                                        <a wire:click="confirmDelete({{ $countersale->id }})" class="btn btn-sm p-0">
                                            <i class="fadeIn animated bx bx-trash"></i>
                                        </a>  
                                        @endif
                                    </td>
                                    @endif
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
                <div class="alert alert-info">No Counter Sale Found!</div>
            </div>
        @endif
    </div>
    @endif
</div>
@section('footerscript')
   
<script src="https://checkout.razorpay.com/v1/checkout.js"></script> 
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

function validateMaxQuantity(input) {
        // Get the max quantity value
        var maxQuantity = parseInt(input.getAttribute('max'));
        
        // If the current value exceeds max quantity, reset it to max
        if (parseInt(input.value) > maxQuantity) {
            input.value = maxQuantity;
        }
    }

 


    </script>
@endsection
