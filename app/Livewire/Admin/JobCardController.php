<?php

namespace App\Livewire\Admin;

use App\Models\JobCard;
use App\Models\Customer;
use Livewire\Component;
use Livewire\WithPagination;

class JobCardController extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public  $mode,$searchfilter;
    public function render()
    {
        $qry = JobCard::with('user');
        if($this->searchfilter){
            $qry=$qry->where('jobcard_number', 'like', '%' . $this->searchfilter . '%')
            ->Orwhere('customer_name', 'like', '%' . $this->searchfilter . '%')
            ->Orwhere('vehical_number', 'like', '%' . $this->searchfilter . '%');
            
        }
        $qry = $qry->orderBy('created_at', 'desc');
         
                $qry->when(isset($this->mode), function ($query) {
        return $query->where('status', $this->mode);
    });
            
            $jobcards= $qry->paginate(10);
            

        $jobcardsCount = JobCard::select('id', 'status')->get(); 
           

        return view('livewire.admin.job_card', compact('jobcards', 'jobcardsCount'));
    }
    
    
    public function resetFilter(){
        $this->searchfilter ='';
    }
    
    public function updatedSearchfilter(){
        $this->resetPage();
    }
    
     public function updatedMode()
    {
      $this->resetPage();
    }
    
}
