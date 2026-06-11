<style>
    .alert {
        color: red;
        border: 1px solid red;
        background-color: white;
        padding: 10px;
        text-align: center;
        font-size: 16px;
        font-weight: bold;
        animation: blink 2s linear infinite;
        border-radius: 5px;
    }

    @keyframes blink {
        0% {
            opacity: 1;
        }

        50% {
            opacity: 0.1;
        }

        100% {
            opacity: 1;
        }
    }

    .label {
        margin-top: 15px;
    }
</style>
<div>
    <div class="row g-3 mb-3">
        <div class="col-lg-6 col-md-12">
            <h5> Dashboard</h5>
        </div>
        <div class="col-lg-6 col-md-12">
            @if (Auth::guard('workshop')->user()->is_user == 0)
                <div>
                    @if ($message)
                        <div id="subscription-alert"
                            class="alert @if ($daysLeft === 0) alert-danger @elseif ($daysLeft <= 15) alert-warning @else alert-info @endif">
                            {{ $message }}
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-3">
        <!--<div class="col">-->
        <!--    <div class="card radius-10 border-start border-0 border-4 border-success mb-0">-->
        <!--        <div class="card-body">-->
        <!--            <div class="d-flex align-items-center">-->
        <!--                <div>-->
        <!--                    <p class="mb-0 text-secondary">Employee</p>-->
        <!--                    <h4 class="my-1 text-success">{{ $employee }}</h4>-->
        <!--                </div>-->
        <!--                <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto">-->
        <!--                    <i class="bx bxs-bar-chart-alt-2"></i>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
        <div class="col">
            <div class="card radius-10 border-start border-0 border-4 border-info mb-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Staff</p>
                            <h4 class="my-1 text-info">{{ $staff }}</h4>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i
                                class="bx bxs-cart"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-start border-0 border-4 border-info mb-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Customer</p>
                            <h4 class="my-1 text-info">{{ $customerCount }}</h4>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i
                                class="bx bxs-cart"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-start border-0 border-4 border-info mb-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Job Card</p>
                            <h4 class="my-1 text-info">{{ $jobcardCount }}</h4>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i
                                class="bx bxs-cart"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-start border-0 border-4 border-warning mb-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Appointments</p>
                            <h4 class="my-1 text-warning">{{ $appointmentCount }}</h4>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-warning text-white ms-auto"><i
                                class="bx bxs-calendar"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @livewire('workshop.job-card-report')
</div>
