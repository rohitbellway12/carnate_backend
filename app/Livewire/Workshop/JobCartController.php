<?php

namespace App\Livewire\Workshop;

use App\Models\{City, WorkShopVendor, Country, State, Branch ,JobCard,User, Vehicle};
use App\Models\Staff;
use Illuminate\Support\Facades\{Auth, DB};
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.workshop-app')]  

class JobCardController extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $isEdit = false, $showModal = false;
    public $name, $lastname, $email, $password, $mobile_no, $branch_name, $landline_no, $country_id, $state_id, $city_id, $address, $gender, $birth_date, $display_name, $branches,$jobId,$vehicledatacollection,$vehicles;
    public $staffId,$workshopId,$mode=0;
    public $states = [];
    public $cities = [];
    public $isAdd = false;
    public $customer_name,$jobcardId,$user = '',$searchjobcart;
    




    protected $listeners = ['delete'];

    protected $rules = [
        'name' => 'required|string',
        'lastname' => 'required|string',
        'email' => 'required|email',
        'password' => 'nullable|min:6',
        'mobile_no' => 'required|digits:10',
        'branch_name' => 'required|string',
        'landline_no' => 'nullable|string',
        'country_id' => 'required|integer',
        'state_id' => 'required|integer',
        'city_id' => 'required|integer',
        'address' => 'required|string',
        'gender' => 'required',
    ];

    public function mount($isAdd=null)
    {
      
        $this->workshopId = Auth::guard('workshop')->user()->id;
        $this->user = WorkShopVendor::where('id', $this->workshopId)->first();
        $this->branches = Branch::get();
        
    } 
    public function render()
    {
        $user = WorkShopVendor::find($this->workshopId);
 
   
        if($this->mode == 4){
        $items = JobCard::where('user_id', $user->is_user == 0 ? $this->workshopId : $user->parent_id)->orderBy('created_at', 'desc');
        }elseif($this->mode == 5){
            $items = JobCard::where('user_id', $user->is_user == 0 ? $this->workshopId : $user->parent_id)->where('soft_delete',1)->orderBy('created_at', 'desc'); 
        }else{
            $items = JobCard::where('user_id', $user->is_user == 0 ? $this->workshopId : $user->parent_id)->where('status',$this->mode)->where('soft_delete',0)->orderBy('created_at', 'desc');
        }
        if($this->searchjobcart){
            $search = trim($this->searchjobcart);
            $items = $items->where(function ($query)use ($search) {
                $query->where('jobcard_number', 'like', '%' . $search . '%')
                ->orWhere('customer_name', 'like', '%' . $search . '%')
                ->orWhere('vehical_number', 'like', '%' . $search . '%')
                ->orWhereHas('customer',function($qry) use ($search){
                    $qry->where('company_name', 'like', '%' . $search . '%');
                });
            });
        }
        $items = $items->paginate(10);
            $jobcardsCount = JobCard::where('user_id', $user->is_user == 0 ? $this->workshopId : $user->parent_id)->get();
        
        return view('livewire.workshop.jobcard.index', compact('items','jobcardsCount'));
    }
    public function saveImage(){
        echo"hello1";die;
    }

    public function create()
    {
            $this->isAdd = true;
    }

    public function edit($id)
    {
        $this->jobId = $id;
            $this->isEdit = true;
    }
    
    public function confirmDelete($id)
    {
        $this->jobcardId = $id;
        $this->dispatch('swal:confirm', [
            'title' => 'Are you sure?',
            'text' => 'This action cannot be undone.',
            'icon' => 'warning',
            'showCancelButton' => true,
            'confirmButtonText' => 'Yes, delete it!',
            'cancelButtonText' => 'Cancel',
            'action' => 'delete',
        ]);
    }

    public function delete()
    {
        $jobcard = JobCard::find($this->jobcardId);
        $jobcard->soft_delete = 1;
        $jobcard->save();
        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Job-Card deleted successfully!']);
    }
    

    private function resetForm()
    {
        $this->name = '';
        $this->lastname = '';
        $this->gender = '';
        $this->email = '';
        $this->password = '';
        $this->mobile_no = '';
        $this->branch_name = '';
        $this->landline_no = '';
        $this->country_id = null;
        $this->state_id = null;
        $this->city_id = null;
        $this->address = '';
        $this->birth_date = '';
        $this->display_name = '';
        $this->staffId = null;
        $this->states = [];
        $this->cities = [];
    }
    
    public function resetFilter(){
        $this->searchjobcart ='';
        $this->mode = 4;
    }
    
}
