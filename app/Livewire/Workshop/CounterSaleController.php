<?php

namespace App\Livewire\Workshop;

use App\Models\{City, WorkShopVendor, Country, State, Branch , CounterCustomers, CounterSale,User, Vehicle};
use App\Models\Staff;
use Illuminate\Support\Facades\{Auth, DB};
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.workshop-app')]  

class CounterSaleController extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $isEdit = false, $showModal = false;
    public $name, $lastname, $email, $password, $mobile_no, $branch_name, $landline_no, $country_id, $state_id, $city_id, $address, $gender, $birth_date, $display_name, $branches,$jobId,$vehicledatacollection,$vehicles,$CountersaleId;
    public $staffId,$workshopId,$mode=4;
    public $states = [];
    public $cities = [];
    public $isAdd = false;
    public $customer_name,$user = '',$searchfilter;
    

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
      
        $this->user = Auth::guard('workshop')->user();
        $this->branches = Branch::get();
        
    } 
    public function render()
    { 
 
    
        $items = CounterSale::with('Customer')->where('type',1)->where('workshop_id',$this->user->id)->orderBy('created_at', 'desc');
        if($this->searchfilter){
            $items = $items->where(function ($query) {
                $query->where('countersale_number', 'like', '%' . $this->searchfilter . '%')
                ->OrwhereHas('Customer', function ($query) {
                    $query->where('name', 'like', '%' . $this->searchfilter . '%')
                    ->Orwhere('number_plate', 'like', '%' . $this->searchfilter . '%'); 
                });
            });
        }
             $items = $items->paginate(10);

        return view('livewire.workshop.countersale.countersale', compact('items'));
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
        $this->CountersaleId = $id;
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
         CounterSale::find($this->CountersaleId)->delete();
 
        $this->dispatch('swal:toast', ['type' => 'success', 'message' => 'Counter Sale deleted successfully!']);
    }
    

    private function resetForm()
    {
        $this->name = ''; 
        $this->gender = '';
        $this->email = '';
        $this->password = '';
        $this->mobile_no = '';
 
 
    }

    public function resetFilter(){
        $this->searchfilter ='';
    }
}
