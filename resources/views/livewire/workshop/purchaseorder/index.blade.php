 <div>

     @if ($isAdd == true)
         @livewire('Workshop.PurchaseOrderAddController')
     @elseif($isView == true)
         <div class="card">
             <div class="card-body d-flex justify-content-between align-items-center">
                 <div class="nav toggle p-3">
                     <a href="{{ route('workshop.purchaseorder') }}" class="d-flex align-items-center">
                         <img src="{{ asset('supplier/Back Arrow.png') }}" class="back-arrow me-2">
                         <div class="breadcrumb-title pe-2 text-dark" style="border: none;">View Purchase Order</div>
                     </a>
                 </div>

             </div>
         </div>
         <div class="card mt-4">

             @if (!empty($order_items) && $order_items->count())
                 <div class="card-body ">
                     <div class="table-responsive">
                         <table class="table table-bordered data-table">
                             <thead>
                                 <tr>
                                     <th>Spare Part</th>
                                     <th>Category</th>
                                     <th>Rack No.</th>
                                     <th>Quantity</th>
                                     <th>Price</th>
                                     <th>Total Amount</th>
                                     <th>Action</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 @foreach ($order_items as $order_item)
                                     <tr>
                                         <td>
                                             {{ $order_item->SpareParts->name }}
                                         </td>
                                         <td>
                                             @switch($order_item->category)
                                                 @case(1)
                                                     Accessory
                                                 @break

                                                 @case(2)
                                                     Parts
                                                 @break

                                                 @case(3)
                                                     Tools
                                                 @break

                                                 @case(4)
                                                     Lubricants
                                                 @break

                                                 @default
                                             @endswitch
                                         </td>
                                         <td>{{ $order_item->SpareParts?->rack_no ?? 'Null' }}</td>
                                         <td>{{ $order_item->quantity }}</td>
                                         <td>{{ $order_item->price }}</td>
                                         <td>{{ $order_item->total_amount }}</td>
                                         <td>
                                             @if ($order_item->status == 0)
                                                 <p class="badge bg-secondary">Pending</p>
                                             @elseif($order_item->status == 1)
                                                 <p class="badge bg-success">Accepted</p>
                                             @elseif($order_item->status == 2)
                                                 <p class="badge bg-danger">Declined</p>
                                             @elseif($order_item->status == 3)
                                                 <p class="badge bg-warning">Partiall Pending</p>
                                             @elseif($order_item->status == 4)
                                                 <p class="badge bg-success">Partially Accepte</p>
                                             @endif
                                         </td>
                                     </tr>
                                 @endforeach
                             </tbody>
                         </table>
                     </div>
                 </div>
             @endif
         </div>
     @else
         <div class="card">
             <div class="card-body d-flex justify-content-between align-items-center">
                 <div class="breadcrumb-title pe-2" style="border: none;">Purchase Stock</div>
                 <div class="row">
                     <div class="pe-3">
                         {{-- @if ($user->hasPermissionTo('purchaseorder-add'))
                             <a href="javascript:;" wire:click="create(1)"
                                 class="btn btn-primary radius-30 mt-2 mt-lg-0">
                                 <i class="bx bxs-plus-square"></i>Add
                             </a>
                         @endif --}}
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
                                     <th>Order No.</th>
                                     <th>Order Date</th>
                                     <th>Total Amount</th>
                                     <th>Total Quantity</th>
                                     <th>Total Item</th>
                                     <th>Status</th>
                                     <th>Action</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 @foreach ($items as $index => $order)
                                     <tr>
                                         <td> {{ $order->id }} </td>
                                         <td>
                                             {{ \Carbon\Carbon::parse($order->order_date)->format('d-m-Y h:i A') ?? '-' }}

                                         </td>
                                         <td>{{ $order->total_amount }}
                                         </td>
                                         <td>{{ $order->total_quantity }}
                                         </td>
                                         <td>{{ $order->total_item }}
                                         </td>
                                         <td>
                                             @switch($order->status)
                                                 @case(1)
                                                     <p class="badge bg-success">Completed</p>
                                                 @break

                                                 @case(0)
                                                     <p class="badge bg-danger">Pending</p>
                                                 @break

                                                 @case(2)
                                                     <p class="badge bg-danger">Decline</p>
                                                 @break

                                                 @case(3)
                                                     <p class="badge bg-primary">Partial Pending</p>
                                                 @break

                                                 @case(4)
                                                     .
                                                     <p class="badge bg-primary">Partial Complete</p>
                                                 @break

                                                 @default
                                             @endswitch

                                         </td>
                                         <td>
                                             <a href="javascript:void(0);" class="btn btn-primary"
                                                 wire:click="viewItem({{ $order->id }})">View Item</a>
                                             {{-- @if ($order->payment_status == 0)
                                        <a href="javascript:void(0);" class="btn btn-primary" wire:click="createOrder({{ $order->id }},{{ $order->total_amount}})">Pay Now</a>
                                        @endif --}}
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
                     <div class="alert alert-info">No Purchase Order Found!</div>
                 </div>
             @endif
         </div>
     @endif
 </div>
 @section('footerscript')
     <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
     <script>
         function validateMaxQuantity(input) {
             // Get the max quantity value
             var maxQuantity = parseInt(input.getAttribute('max'));

             // If the current value exceeds max quantity, reset it to max
             if (parseInt(input.value) > maxQuantity) {
                 input.value = maxQuantity;
             }
         }


         document.addEventListener('razorpay-show', (event) => {
             // Access event data using event.detail

             amount = event.__livewire.params[0].amount;
             orderId = event.__livewire.params[0].orderId;
             order_id = event.__livewire.params[0].order_id;

             var options = {
                //  "key": "{{ env('RAZORPAY_KEY') }}",
                "key": "{{ config('services.razorpay.key') }}",
                 "amount": amount * 100, // Convert to paise
                 "currency": "INR",
                 "order_id": orderId,
                 "name": "Test Payment",
                 "description": "Payment for product/service",
                 "image": "https://example.com/your-logo.png",
                 "handler": function(response) {
                     console.log(response)
                     // Example data to send
                     const paymentResponse = {
                         razorpay_payment_id: response.razorpay_payment_id,
                         razorpay_order_id: response.razorpay_order_id,
                         amount: amount,
                         order_id: order_id,
                     };
                     Livewire.dispatch('storePayment', {
                         paymentResponse: paymentResponse
                     });

                 },
                 "prefill": {
                     "name": @json(Auth::guard('workshop')->user()->name),
                     "email": @json(Auth::guard('workshop')->user()->email),
                     "contact": @json(Auth::guard('workshop')->user()->mobile_no)
                 },
                 "theme": {
                     "color": "#009dec"
                 }
             };

             var rzp1 = new Razorpay(options);
             rzp1.open();
             event.preventDefault();
         });
     </script>
 @endsection
