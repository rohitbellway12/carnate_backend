<div>
    <div class="card">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div class="breadcrumb-title pe-2" style="border: none;">Subscription Plan</div>
        </div>
    </div>

    <div class="card radius-10 w-100 mt-2 subscriptionPlan">
        <div class="card-header d-flex justify-content-between align-items-center">
            @php
                $currentDate = date('Y-m-d');
                $isExpired = $user->subscription_end_date !== null && $user->subscription_end_date < $currentDate;
            @endphp
            @if ($isExpired && $latestPlan)
                <h5 class="mb-0">Expired plan :-
                    <span class="text-danger">{{ $latestPlan->plan_name }} - ₹{{ $latestPlan->amount }} - {{ $latestPlan->days }} Days</span>
                </h5>
                <button class="btn btn-warning btn-sm text-dark px-3" wire:click="createOrder({{ $latestPlan->id }})">
                    <i class="bx bx-refresh"></i> Renew Plan
                </button>
            @else
                <h5 class="mb-0">Current plan :-
                    {!! $user->is_subscribe
                        ? '<span class="text-success">'.implode(' - ', [\Carbon\Carbon::parse($user->subscription_start_date)->format('d M Y'), \Carbon\Carbon::parse($user->subscription_end_date)->format('d M Y')]).'</span>'
                        : '<span class="text-danger">There is no plan activated.</span>' !!}
                </h5>
            @endif
        </div>
        <div class="card-body">
            <div class="row g-3 justify-content-center">
                @foreach ($plans as $plan)
                    <div class="col-xl-3 col-md-4 col-sm-6">
                        <div class="pricing-card starter h-100">
                            <h2 class="plan-title">{{ $plan->plan_name }}</h2>
                            {{-- <div class="plan-price">₹{{ $plan->amount }}<span class="price-unit"> /@switch($plan->plan_type)@case(1)D @break @case(2)M @break @case(3)Y @break @endswitch</span></div> --}}
                            <div class="plan-price">₹{{ $plan->amount }}<span class="price-unit"> / {{ $plan->days }} Days</span></div>

                            <!-- Hidden input for amount -->
                            <input type="hidden" wire:model="amount" value="{{ $plan->amount }}">
                            <button class="btn-primary"
                                    wire:click="createOrder({{ $plan->id }})"
                                    data-order-id="{{ $orderId }}"
                                    data-amount="{{ $plan->amount }}">Purchase Plan</button>
                            <ul class="plan-features">
                                @foreach ($plan->planDescriptions as $description)
                                    <li>✔ {{ $description->description }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
document.addEventListener('razorpay-show', (event) => {
    // Access event data using event.detail

 amount = event.__livewire.params[0].amount;
 orderId = event.__livewire.params[0].orderId;
 planId = event.__livewire.params[0].planId;
 let key = "{{ config('services.razorpay.key') }}";

    var options = {
        "key": key,
        "amount": amount * 100, // Convert to paise
        "currency": "INR",
        "order_id": orderId,
        "name": "Test Payment",
        "description": "Payment for product/service",
        "image": "https://example.com/your-logo.png",
        "handler": function (response) {
            console.log(response)
           // Example data to send
            const paymentResponse = {
                razorpay_payment_id: response.razorpay_payment_id,
                razorpay_order_id: response.razorpay_order_id,
                amount: amount,
                planId: planId,
            };
        Livewire.dispatch('storePayment', { paymentResponse: paymentResponse });

        },
        "prefill": {
            "name": @json(Auth::guard('workshop')->user()->name),
            "email": @json(Auth::guard('workshop')->user()->email),
            "contact": @json(Auth::guard('workshop')->user()->mobile_no)
        },
        "theme": {
            "color": "#F37254"
        }
    };

    var rzp1 = new Razorpay(options);
    rzp1.open();
    event.preventDefault();
});

    // });
</script>
