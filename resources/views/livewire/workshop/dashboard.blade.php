<div class="carnate-workshop-dashboard">

    <style>
        .carnate-workshop-dashboard {
            --c-bg: #f7f8fa;
            --c-card: #ffffff;
            --c-text: #111827;
            --c-muted: #64748b;
            --c-border: #e2e8f0;
            --c-red: #e53935;
            --c-red-dark: #c62828;
            --c-red-soft: #fff5f5;
            --c-green: #16a34a;
            --c-green-soft: #f0fdf4;
            --c-blue: #2563eb;
            --c-blue-soft: #eff6ff;
            --c-amber: #d97706;
            --c-amber-soft: #fffbeb;

            background: var(--c-bg);
            color: var(--c-text);
            min-height: 100%;
        }

        /* =========================
           Header
        ========================== */

        .carnate-workshop-dashboard .dashboard-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 20px;
        }

        .carnate-workshop-dashboard .dashboard-title-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .carnate-workshop-dashboard .dashboard-title-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: var(--c-red-soft);
            color: var(--c-red);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 21px;
        }

        .carnate-workshop-dashboard .dashboard-title {
            margin: 0;
            font-size: 21px;
            font-weight: 700;
            color: var(--c-text);
        }

        .carnate-workshop-dashboard .dashboard-subtitle {
            margin: 3px 0 0;
            color: var(--c-muted);
            font-size: 13px;
        }

        /* =========================
           Subscription Alert
        ========================== */

        .carnate-workshop-dashboard .subscription-alert {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 15px;
            border-radius: 10px;
            border: 1px solid rgba(229, 57, 53, .2);
            background: var(--c-red-soft);
            color: var(--c-red);
            font-size: 13px;
            font-weight: 600;
            line-height: 1.4;
            animation: carnateSubscriptionPulse 2s linear infinite;
        }

        .carnate-workshop-dashboard .subscription-alert::before {
            content: "\e9c4";
            font-family: boxicons;
            font-size: 18px;
            flex: 0 0 auto;
        }

        .carnate-workshop-dashboard .subscription-alert.warning {
            background: var(--c-amber-soft);
            border-color: rgba(217, 119, 6, .2);
            color: var(--c-amber);
        }

        .carnate-workshop-dashboard .subscription-alert.danger {
            background: var(--c-red-soft);
            border-color: rgba(229, 57, 53, .25);
            color: var(--c-red);
        }

        .carnate-workshop-dashboard .subscription-alert.info {
            background: var(--c-blue-soft);
            border-color: rgba(37, 99, 235, .18);
            color: var(--c-blue);
        }

        @keyframes carnateSubscriptionPulse {
            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: .72;
            }
        }

        /* =========================
           Dashboard Stats
        ========================== */

        .carnate-workshop-dashboard .dashboard-stat {
            position: relative;
            height: 100%;
            min-height: 118px;
            background: var(--c-card);
            border: 1px solid var(--c-border);
            border-radius: 15px;
            padding: 20px;
            overflow: hidden;
            transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
        }

        .carnate-workshop-dashboard .dashboard-stat:hover {
            transform: translateY(-2px);
            border-color: #d8dee8;
            box-shadow: 0 8px 24px rgba(15, 23, 42, .07);
        }

        .carnate-workshop-dashboard .dashboard-stat::before {
            content: "";
            position: absolute;
            left: 0;
            top: 18px;
            bottom: 18px;
            width: 3px;
            border-radius: 0 5px 5px 0;
            background: var(--c-red);
        }

        .carnate-workshop-dashboard .dashboard-stat.staff::before {
            background: var(--c-blue);
        }

        .carnate-workshop-dashboard .dashboard-stat.customer::before {
            background: var(--c-green);
        }

        .carnate-workshop-dashboard .dashboard-stat.jobcard::before {
            background: var(--c-red);
        }

        .carnate-workshop-dashboard .dashboard-stat.appointment::before {
            background: var(--c-amber);
        }

        .carnate-workshop-dashboard .stat-content {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .carnate-workshop-dashboard .stat-label {
            margin: 0 0 7px;
            color: var(--c-muted);
            font-size: 12px;
            font-weight: 600;
        }

        .carnate-workshop-dashboard .stat-value {
            margin: 0;
            color: var(--c-text);
            font-size: 28px;
            line-height: 1;
            font-weight: 750;
            letter-spacing: -.5px;
        }

        .carnate-workshop-dashboard .stat-icon {
            width: 46px;
            height: 46px;
            flex: 0 0 46px;
            border-radius: 13px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            background: var(--c-red-soft);
            color: var(--c-red);
        }

        .carnate-workshop-dashboard .dashboard-stat.staff .stat-icon {
            background: var(--c-blue-soft);
            color: var(--c-blue);
        }

        .carnate-workshop-dashboard .dashboard-stat.customer .stat-icon {
            background: var(--c-green-soft);
            color: var(--c-green);
        }

        .carnate-workshop-dashboard .dashboard-stat.appointment .stat-icon {
            background: var(--c-amber-soft);
            color: var(--c-amber);
        }

        /* =========================
           Job Card Report Container
        ========================== */

        .carnate-workshop-dashboard .job-card-section {
            margin-top: 22px;
        }

        /* Keep existing Job Card Report UI functional.
           These styles only improve the surrounding presentation. */
        .carnate-workshop-dashboard .job-card-section > div {
            max-width: 100%;
        }

        /* =========================
           Responsive
        ========================== */

        @media (max-width: 991.98px) {
            .carnate-workshop-dashboard .dashboard-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .carnate-workshop-dashboard .subscription-wrapper {
                width: 100%;
            }

            .carnate-workshop-dashboard .subscription-alert {
                width: 100%;
            }
        }

        @media (max-width: 575.98px) {
            .carnate-workshop-dashboard {
                padding: 0;
            }

            .carnate-workshop-dashboard .dashboard-title {
                font-size: 18px;
            }

            .carnate-workshop-dashboard .dashboard-title-icon {
                width: 38px;
                height: 38px;
                border-radius: 10px;
            }

            .carnate-workshop-dashboard .dashboard-stat {
                min-height: 105px;
                padding: 16px;
            }

            .carnate-workshop-dashboard .stat-value {
                font-size: 24px;
            }

            .carnate-workshop-dashboard .stat-icon {
                width: 40px;
                height: 40px;
                flex-basis: 40px;
                font-size: 19px;
            }
        }
    </style>

    {{-- Dashboard Header --}}
    <div class="dashboard-header">

        <div class="dashboard-title-wrap">
            <div class="dashboard-title-icon">
                <i class="bx bx-grid-alt"></i>
            </div>

            <div>
                <h5 class="dashboard-title">Dashboard</h5>
                <p class="dashboard-subtitle">
                    Overview of your workshop activity
                </p>
            </div>
        </div>

        @if (Auth::guard('workshop')->user()->is_user == 0)
            @if ($message)
                <div class="subscription-wrapper">
                    <div
                        id="subscription-alert"
                        class="subscription-alert
                            @if ($daysLeft === 0)
                                danger
                            @elseif ($daysLeft <= 15)
                                warning
                            @else
                                info
                            @endif"
                    >
                        {{ $message }}
                    </div>
                </div>
            @endif
        @endif

    </div>

    {{-- Dashboard Statistics --}}
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-3">

        {{-- Staff --}}
        <div class="col">
            <div class="dashboard-stat staff">
                <div class="stat-content">

                    <div>
                        <p class="stat-label">Staff</p>
                        <h4 class="stat-value">
                            {{ $staff }}
                        </h4>
                    </div>

                    <div class="stat-icon">
                        <i class="bx bx-group"></i>
                    </div>

                </div>
            </div>
        </div>

        {{-- Customers --}}
        <div class="col">
            <div class="dashboard-stat customer">
                <div class="stat-content">

                    <div>
                        <p class="stat-label">Customers</p>
                        <h4 class="stat-value">
                            {{ $customerCount }}
                        </h4>
                    </div>

                    <div class="stat-icon">
                        <i class="bx bx-user"></i>
                    </div>

                </div>
            </div>
        </div>

        {{-- Job Cards --}}
        <div class="col">
            <div class="dashboard-stat jobcard">
                <div class="stat-content">

                    <div>
                        <p class="stat-label">Job Cards</p>
                        <h4 class="stat-value">
                            {{ $jobcardCount }}
                        </h4>
                    </div>

                    <div class="stat-icon">
                        <i class="bx bx-file"></i>
                    </div>

                </div>
            </div>
        </div>

        {{-- Appointments --}}
        <div class="col">
            <div class="dashboard-stat appointment">
                <div class="stat-content">

                    <div>
                        <p class="stat-label">Appointments</p>
                        <h4 class="stat-value">
                            {{ $appointmentCount }}
                        </h4>
                    </div>

                    <div class="stat-icon">
                        <i class="bx bx-calendar"></i>
                    </div>

                </div>
            </div>
        </div>

    </div>

    {{-- Existing Job Card Report --}}
    <div class="job-card-section">
        @livewire('workshop.job-card-report')
    </div>

</div>