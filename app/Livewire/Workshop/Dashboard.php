<?php

namespace App\Livewire\Workshop;

use App\Models\Appointment;
use App\Models\Customer;
use App\Models\JobCard;
use Livewire\Component;
use App\Models\WorkShopVendor;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Carbon\Carbon;

#[Layout('components.layouts.workshop-app')]
class Dashboard extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $employee = 0, $staff = 0;
    public $workshopId;
    public $daysLeft;
    public $message = '', $jobcardCount = 0, $customerCount = 0, $appointmentCount = 0;
    public function mount()
    {
        $user = Auth::guard('workshop')->user();
        $currentDate = Carbon::now('Asia/Kolkata');
        $subscriptionEndDate = Carbon::parse($user->subscription_end_date, 'Asia/Kolkata');
        if($user->is_trial === 1){
            $trialStartDate = Carbon::parse($user->trial_start_date, 'Asia/Kolkata');
            $trialEndDate = $trialStartDate->copy()->addDays((int) ($user->trial_days ?? 0));
            $subscriptionEndDate = $trialEndDate;
            // dd($subscriptionEndDate);
        }

        $this->daysLeft = (int) $currentDate->diffInDays($subscriptionEndDate, false);

        if ($this->daysLeft <= 7) {
            if (ceil($this->daysLeft) == 0) {
                $this->message = 'Your subscription plan expires today!';
            } elseif ($this->daysLeft < 0) {
                $this->message = 'Your subscription plan expired on ' . $subscriptionEndDate->format('d M Y') . '.';
            } else {
                $this->message = 'Your subscription plan will expire in ' . $this->daysLeft . ' day(s).';
            }
        }

        $staffQuery = WorkShopVendor::whereNot('user_type', 0)
            ->where('parent_id', Auth::guard('workshop')->user()->id);

        $this->staff = $staffQuery->count();

        $this->employee = $staffQuery->whereHas('role', function ($qry) {
            $qry->where('name', 'LIKE', '%Employee%');
        })->count();

        $this->jobcardCount = JobCard::where('user_id', $user->id)->count();
        $this->customerCount = Customer::where('user_id', $user->id)->count();
        $this->appointmentCount = Appointment::where('workshop_id', $user->id)->count();
    }

    public function render()
    {
        return view('livewire.workshop.dashboard');
    }
}
