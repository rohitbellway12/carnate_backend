<?php

namespace App\Http\Controllers\JobCard;

use App\Http\Controllers\Controller;
use App\Models\{Admin, CounterCustomers, CounterSale, Customer, Image, JobCardExtraCharge, JobCardSparePart, JobCardImage, JobCardsInspection, Modification, NewJobCard, Setting, User, Vehicle, WorkShopVendor, Order};
use App\Mail\EstimateMail;
use App\Mail\InvoiceMail;
use App\Models\SparePartVendor;
use App\Models\JobCard;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\{Auth, DB, Mail};
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class JobCardController extends Controller
{
    protected $route;

    protected $single_heading;

    protected $notificationService;

    public function __construct()
    {
        $this->route = new \stdClass;
    }

    public function index()
    {
        $jobcardsCount = NewJobCard::where('user_id', Auth::id())->get();
        if (isset($_GET['type'])) {
            $type = $_GET['type'];

            if ($_GET['type'] == "") {
                $jobcards = NewJobCard::where('user_id', Auth::id())->orderBy('id', 'DESC')->get();
            } else {
                $jobcards = NewJobCard::where(['status' => $type, 'user_id' => Auth::id()])->orderBy('id', 'DESC')->get();
            }
        } else {
            $jobcards = NewJobCard::where('user_id', Auth::id())->orderBy('id', 'DESC')->get();
        }

        return view('new_jobcard.list', compact('jobcards', 'jobcardsCount'));
    }
    public function add()
    {
        $customers = User::where([['role', 'Customer'], ['soft_delete', 0]])->get();
        $supervisors = User::where([['role', 'supportstaff'], ['soft_delete', 0]])->get();
        $country = DB::table('tbl_countries')->get()->toArray();
        //vehicle add
        $vehical_type = DB::table('tbl_vehicle_types')->where('soft_delete', '=', 0)->get()->toArray();
        $vehical_brand = DB::table('tbl_vehicle_brands')->where('soft_delete', '=', 0)->get()->toArray();
        $fuel_type = DB::table('tbl_fuel_types')->where('soft_delete', '=', 0)->get()->toArray();
        $color = DB::table('tbl_colors')->where('soft_delete', '=', 0)->get()->toArray();
        $model_name = DB::table('tbl_model_names')->where('soft_delete', '=', 0)->get()->toArray();

        return view('new_jobcard.add', compact('country', 'vehical_type', 'vehical_brand', 'fuel_type', 'color', 'model_name', 'supervisors'));
    }




    public function addphoto(Request $request): View
    {
        $jobcard_number = $request->input('jobcard_number');
        $title = 'Add Photo';
        $jobcard_numbers = $jobcard_number;

        $jobCardImage = JobCardImage::where('job_card_number', $jobcard_number)->first();


        $files = Image::whereIn('id', explode(',', @$jobCardImage->image_id))->get();
        $view = view('new_jobcard.outlet_imagesmultiple', ['files' => $files, 'route' => $this->route])->render();



        return view('new_jobcard.addPhoto', compact('title', 'jobcard_numbers', 'view', 'jobCardImage'));
    }

    public function imageUpload(Request $request)
    {
        if (!$request->has('type') || !$request->hasFile('gumasta_images')) {
            return response()->json(['status' => 0, 'msg' => 'File type not allowed']);
        }

        $type = $request->type;
        $filePath = '/uploads/gumasta/';
        $files = $request->file('gumasta_images');
        $movedFiles = [];
        $fileIds = [];

        $destinationPath = public_path($filePath);

        // Move files and save their paths
        foreach ($files as $file) {
            $fileName = time() . rand(1, 2000) . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            $movedFiles[] = $fileName;
        }

        // Store file data in the database and collect IDs
        foreach ($movedFiles as $fileName) {
            $fileData = Image::create(['path' => $fileName]);
            $fileIds[] = $fileData->id;
        }

        // Handle existing image IDs if `main_id` is provided
        if ($request->main_id) {
            $jobCardImage = JobCardImage::find($request->main_id);
            $existingIds = $jobCardImage ? explode(',', $jobCardImage->image_id) : [];
            $fileIds = array_unique(array_merge($fileIds, $existingIds));

            // Update the JobCardImage with the new list of image IDs
            $jobCardImage->update(['image_id' => implode(',', $fileIds)]);
        }

        // Fetch all images for rendering
        $files = Image::whereIn('id', $fileIds)->get();
        $view = view('new_jobcard.outlet_imagesmultiple', ['files' => $files, 'route' => $this->route])->render();

        return response()->json([
            'status' => 1,
            'message' => 'Image uploaded successfully',
            'file_id' => implode(',', $fileIds),
            'file_path' => $view,
        ]);
    }

    public function multiimagedelete(Request $request)
    {

        $id = $request->id;
        $ids = explode(',', $request->ids);
        $ids = array_values(array_diff($ids, array($id)));

        return response()->json([
            'success' => 1,
            'message' => "Photos Deleted Successfully",
            'ids' => $ids
        ]);
    }



    public function saveimageform(Request $request)
    {
        // echo "<pre>";print_r($request->all());die;
        if ($request->main_id) {
            $jobCard = JobCardImage::find($request->main_id);
            $jobCard->image_id = $request->images_id;
            $jobCard->save();
        } else {
            $data = JobCardImage::create([
                'job_card_number' => $request->jobcard_numbers,
                'image_id' => $request->images_id,
            ]);
        }

        return response()->json([
            'success' => 1,
            'message' => "Photos Added Successfully",
            'imageId' => count(explode(',', $request->images_id)),
        ]);
    }

    public function accessories(Request $request): View
    {
        $jobcard_numbers = $request->input('jobcard_number');
        $title = 'Accessories';

        $jobCardsInspection = JobCardsInspection::where('jobcard_number', $jobcard_numbers)->where('is_customer_voice', 2)->get()->toArray();

        return view('new_jobcard.accessories', compact('title', 'jobcard_numbers', 'jobCardsInspection'));
    }



    public function addFieldAccessories(Request $request)
    {


        $newfield = '<div class="mb-3 col-lg-12 dynamic-field">
        <div class="row">
        <div class="col-11">
          <label for="validationCustom01" class="form-label">Accessories</label><br>
          <input type="text" class="form-control" name="accessories[]" placeholder="Enter Accessories">
        </div>
         <div class="col-1 mt-4 ">
         <button type="button" class="btn btn-danger btn-sm remove-field rounded text-white border-white" style="margin-top: 5px;" fdprocessedid="dak07"><i class="fa fa-trash" aria-hidden="true"></i></button>
        </div>
        </div>
        </div>';

        return response()->json([
            'success' => 1,
            'newfield' => $newfield
        ]);
    }



    public function saveAccessories(Request $request)
    {

        request()->validate([
            'accessories' => 'required',
        ]);

        JobCardsInspection::where('jobcard_number', $request->jobcard_numbers)->where('is_customer_voice', 2)->delete();

        foreach ($request->accessories as $accessories) {
            JobCardsInspection::create([
                'jobcard_number' => $request->jobcard_numbers,
                'customer_voice' => $accessories,
                'is_customer_voice' => 2,
            ]);
        }

        $accessaryCount = JobCardsInspection::where('jobcard_number', $request->jobcard_numbers)->where('is_customer_voice', 2)->count();


        return response()->json([
            'success' => 1,
            'message' => "Accessories Added Successfully",
            "accessaryCount" => $accessaryCount,
        ]);
    }

    public function getData(Request $request)
    {
        $query = $request->get('query');
        $page = $request->get('page', 1);
        $limit = 10; // Number of results per page
        // Fetch data based on the query
        $data = User::with('vehicles')->where('name', 'LIKE', '%' . $query . '%')
            ->orWhere('mobile_no', 'LIKE', '%' . $query . '%')
            ->orWhereHas('vehicles', function ($qry) use ($query) {
                $qry->where('number_plate', 'LIKE', '%' . $query . '%');
            })
            ->skip(($page - 1) * $limit)
            ->take($limit)
            ->get();
        // Format data for Select2
        $results = [];
        foreach ($data as $item) {
            $results[] = [
                'id' => $item->id, // The value of the option
                'text' => $item->name . ($item->mobile_no ? ' - ' . $item->mobile_no : '') . ($item->vehicles?->first()?->number_plate ? ' - ' . $item->vehicles->first()->number_plate : ''), // The text to display
            ];
        }
        // Check if there are more results for pagination
        $totalCount = User::where('name', 'LIKE', '%' . $query . '%')
            ->orWhere('mobile_no', 'LIKE', '%' . $query . '%')
            ->orWhereHas('vehicles', function ($qry) use ($query) {
                $qry->where('number_plate', 'LIKE', '%' . $query . '%');
            })->count();
        $more = ($page * $limit) < $totalCount;
        return response()->json([
            'results' => $results,
            'pagination' => ['more' => $more],
        ]);
    }

    public function getVehicle(Request $request)
    {
        $id = $request->customer_id;
        $vehicles = Vehicle::where('customer_id', $id)->get();
        // echo "<pre>";print_r($vehicles->toArray());die;
        if (count($vehicles) > 0) {
            $html = view('new_jobcard.component.vehicle-option', compact('vehicles'))->render();
            return response()->json(['status' => 1, 'html' => $html]);
        }
        return response()->json(['status' => 0, 'msg' => "Vehicle Not Found. Please Add Vehicle."]);
    }

    public function addCustomer(Request $request)
    {
        return response()->json(['status' => 0, 'msg' => "Vehicle Not Found. Please Add Vehicle."]);
    }




    public function viewPDF(Request $request)
    {


        $newjobcard = JobCard::where('id', $request->id)->first();
        $customers = User::where('id', $newjobcard->customer_id)->first();
        $vehicles = Vehicle::where('id', $newjobcard->vehicle_id)->first();
        $jobCardSpareParts = JobCardSparePart::where('jobcard_id', $request->id)->get();


        $title = 'View Invoice';
        $logo = (Auth::guard('workshop')->check() ? Auth::guard('workshop')->user() : null) ?? WorkShopVendor::find($newjobcard->user_id ?? 0) ?? Setting::first();
        return view('new_jobcard.invoice', compact('title', 'logo', 'customers', 'newjobcard', 'vehicles', 'jobCardSpareParts'));
    }


    // jobcard estimate manish
    public function downloadInvoice(Request $request)
    {

        //dd("jadu");
        $newjobcard = JobCard::with([
            'exitNote' => function ($query) {
                $query->select('note', 'job_card_id');
            }
        ])->where('id', $request->id)->first();
        $customer = $newjobcard->customer;
        $vehicles = Vehicle::select('number_plate', 'chassis_no', 'brand', 'variant', 'year', 'modification')->where('id', $newjobcard->vehicle_id)->first();
        $jobCardSpareParts = JobCardSparePart::with('productStock')->where('jobcard_id', $request->id)->get();
        $jobCardExtraCharges = JobCardExtraCharge::where('jobcard_id', $request->id)->get();
        // dd($newjobcard->shared_serial);
        $shared_serial = $newjobcard->shared_serial;
        //dd($shared_serial);
        $inspections = JobCardsInspection::select('customer_voice', 'is_customer_voice')->where('jobcard_number', $newjobcard->jobcard_number)->whereIn('is_customer_voice', [1, 0])->get();
        //dd($inspections);
        $jobCardCustomerVoice = $inspections->where('is_customer_voice', 1);
        $jobCardAccessories = $inspections->where('is_customer_voice', 0);
        $exitNote = $newjobcard->exitNote;

        $title = 'View Invoice';
        $logo = (Auth::guard('workshop')->check() ? Auth::guard('workshop')->user() : null) ?? WorkShopVendor::find($newjobcard->user_id ?? 0) ?? Setting::first();

        // Check vendor GST status and set PDF title accordingly - ONLY FOR COMPLETED JOB CARDS
        if ($newjobcard->status == 2) {
            $pdfTitle = ($logo && $logo->is_gst) ? 'TAX INVOICE' : 'CASH INVOICE';
        } elseif ($newjobcard->status == 1) {
            // For confirmed status, check if it's an estimate request
            $pdfTitle = 'Estimate'; // Show 'Estimate' for confirmed status
        } else {
            $pdfTitle = 'Mechanic Copy'; // Default for other statuses
        }

        $type = (int) $request->type;

        $data = compact('title', 'logo', 'customer', 'newjobcard', 'vehicles', 'jobCardSpareParts', 'jobCardExtraCharges', 'jobCardCustomerVoice', 'jobCardAccessories', 'type', 'pdfTitle', 'exitNote');
        // dd($data);
        // dump($data);

        $pdf = PDF::loadView('new_jobcard.pdf', $data)
            ->setPaper('a4', 'portrait');

        // if ($request->type) {
        //     return $pdf->stream('invoice_' . $newjobcard->jobcard_number . '.pdf');
        // }
        // // return "manish";
        // return $pdf->download('invoice_' . $newjobcard->jobcard_number . '.pdf');
        //dd($type);
        // Check if it's a print request
        $isPrint = $request->get('print', 0);

        if ($type) {
            // return $pdf->stream('invoice_' . $newjobcard->jobcard_number . '.pdf');
            return $pdf->stream('Estimate_' . $newjobcard->jobcard_number . '.pdf');
        }

        // Use stream for print, download for regular download
        if ($isPrint) {
            return $pdf->stream('invoice_' . $newjobcard->jobcard_number . '.pdf');
        }

        // return "manish";
        return $pdf->download('invoice_' . $newjobcard->jobcard_number . '.pdf');
    }


    public function addextrafields(Request $request)
    {

        $price = $request->price ?? 0;
        $title = $request->title ?? '';

        $employee = User::where(['role' => 'employee', 'soft_delete' => 0])->get();

        $html = view('new_jobcard.component.add-other-charges', compact('employee', 'price', 'title'))->render();

        return response()->json([
            'success' => 1,
            'newfield' => $html
        ]);
    }

    public function downloadMechanicSheet(Request $request)
    {

        $newjobcard = JobCard::where('id', $request->id)->first();
        $customers = Customer::where('id', $newjobcard->customer_id)->first();
        $vehicles = Vehicle::where('id', $newjobcard->vehicle_id)->first();
        $jobCardSpareParts = JobCardSparePart::with('productStock')->where('jobcard_id', $request->id)->get();
        $jobCardExtraCharges = JobCardExtraCharge::where('jobcard_id', $request->id)->get();
        $jobCardCustomerVoice = JobCardsInspection::where('jobcard_number', $newjobcard->jobcard_number)->where('is_customer_voice', 1)->get();
        $jobCardAccessories = JobCardsInspection::where('jobcard_number', $newjobcard->jobcard_number)->where('is_customer_voice', 0)->get();

        $title = 'View Invoice';
        $logo = (Auth::guard('workshop')->check() ? Auth::guard('workshop')->user() : null) ?? WorkShopVendor::find($newjobcard->user_id ?? 0) ?? Setting::first();

        // Check vendor GST status and set PDF title accordingly - ONLY FOR COMPLETED JOB CARDS
        if ($newjobcard->status == 2) {
            $pdfTitle = ($logo && $logo->is_gst) ? 'TAX INVOICE' : 'CASH INVOICE';
        } else {
            $pdfTitle = 'Mechanic Sheet'; // Default for non-completed job cards
        }

        $data = compact('title', 'logo', 'customers', 'newjobcard', 'vehicles', 'jobCardSpareParts', 'jobCardExtraCharges', 'jobCardCustomerVoice', 'jobCardAccessories', 'pdfTitle');

        $pdf = PDF::loadView('new_jobcard.pdf.mechanic_sheet', $data)
            ->setPaper('a4', 'portrait');

        if ($request->type) {
            return $pdf->stream('machanicSheet_' . $newjobcard->jobcard_number . '.pdf');
        }
        return $pdf->download('machanicSheet_' . $newjobcard->jobcard_number . '.pdf');
    }

    public function downloadEstimateInvoice(Request $request)
    {
        //  dd('dhfjkdhfjkd');
        $newjobcard = JobCard::where('id', $request->id)->first();
        $customer = Customer::where('id', $newjobcard->customer_id)->first();
        $vehicles = Vehicle::where('id', $newjobcard->vehicle_id)->first();
        $jobCardSpareParts = JobCardSparePart::where('jobcard_id', $request->id)->get();

        $jobCardExtraCharges = JobCardExtraCharge::where('jobcard_id', $request->id)->get();
        $inspections = JobCardsInspection::select('customer_voice', 'is_customer_voice')->where('jobcard_number', $newjobcard->jobcard_number)->whereIn('is_customer_voice', [1, 0])->get();
        $jobCardCustomerVoice = $inspections->where('is_customer_voice', 1);
        $jobCardAccessories = $inspections->where('is_customer_voice', 0);
        $exitNote = $newjobcard->exitNote;

        // echo "<pre>";print_r($jobCardSpareParts->toArray());die;
        $title = 'View Invoice';
        $logo = (Auth::guard('workshop')->check() ? Auth::guard('workshop')->user() : null) ?? WorkShopVendor::find($newjobcard->user_id ?? 0) ?? Setting::first();

        // Always show ESTIMATE for Estimate Worksheet
        $pdfTitle = 'ESTIMATE';

        $type = (int) $request->type;

        $data = compact('title', 'logo', 'customer', 'newjobcard', 'vehicles', 'jobCardSpareParts', 'jobCardExtraCharges', 'jobCardCustomerVoice', 'jobCardAccessories', 'pdfTitle', 'type', 'exitNote');

        $pdf = PDF::loadView('new_jobcard.pdf', $data)
            ->setPaper('a4', 'portrait');

        if ($request->type) {
            return $pdf->stream('estimate_invoice_' . $newjobcard->jobcard_number . '.pdf');
        }

        return $pdf->download('estimate_invoice_' . $newjobcard->jobcard_number . '.pdf');
    }




    public function downloadOpenInvoice(Request $request)
    {

        $newjobcard = JobCard::where('id', $request->id)->first();
        $customer = Customer::where('id', $newjobcard->customer_id)->first();
        $vehicles = Vehicle::where('id', $newjobcard->vehicle_id)->first();
        $jobCardSpareParts = JobCardSparePart::where('jobcard_id', $request->id)->get();

        $jobCardExtraCharges = JobCardExtraCharge::where('jobcard_id', $request->id)->get();
        $jobCardCustomerVoice = JobCardsInspection::where('jobcard_number', $newjobcard->jobcard_number)->where('is_customer_voice', 1)->get();
        $jobCardAccessories = JobCardsInspection::where('jobcard_number', $newjobcard->jobcard_number)->where('is_customer_voice', 2)->get();

        // echo "<pre>";print_r($jobCardSpareParts->toArray());die;
        $title = 'View Invoice';
        $logo = (Auth::guard('workshop')->check() ? Auth::guard('workshop')->user() : null) ?? WorkShopVendor::find($newjobcard->user_id ?? 0) ?? Setting::first();

        $data = compact('title', 'logo', 'customer', 'newjobcard', 'vehicles', 'jobCardSpareParts', 'jobCardExtraCharges', 'jobCardCustomerVoice', 'jobCardAccessories');

        $pdf = PDF::loadView('new_jobcard.pdf.invoice', $data)
            ->setPaper('a4', 'portrait');

        return $pdf->download('invoice' . $newjobcard->jobcard_number . '.pdf');
    }

    public function sendInvoiceMail($id)
    {

        $newjobcard = NewJobCard::with([
            'exitNote' => function ($query) {
                $query->select('note', 'new_job_card_id');
            }
        ])->where('id', $id)->first();

        if (!empty($newjobcard)) {
            if ($newjobcard->status == 2 || $newjobcard->status == 3) {

                $customer = $newjobcard->customer;
                $vehicles = Vehicle::select('number_plate', 'chassis_no', 'brand', 'variant', 'year', 'modification')->where('id', $newjobcard->vehicle_id)->first();
                $jobCardSpareParts = JobCardSparePart::where('jobcard_id', $id)->get();
                $jobCardExtraCharges = JobCardExtraCharge::where('jobcard_id', $id)->get();

                $inspections = JobCardsInspection::select('customer_voice', 'is_customer_voice')->where('jobcard_number', $newjobcard->jobcard_number)->whereIn('is_customer_voice', [1, 0])->get();
                $jobCardCustomerVoice = $inspections->where('is_customer_voice', 1);
                $jobCardAccessories = $inspections->where('is_customer_voice', 0);

                $exitNote = $newjobcard->exitNote;

                $title = 'View Invoice';
                $logo = (Auth::guard('workshop')->check() ? Auth::guard('workshop')->user() : null) ?? WorkShopVendor::find($newjobcard->user_id ?? 0) ?? Setting::first();

                $data = compact('title', 'logo', 'customer', 'newjobcard', 'vehicles', 'jobCardSpareParts', 'jobCardExtraCharges', 'jobCardCustomerVoice', 'jobCardAccessories', 'exitNote');

                Mail::to($customer->email)->send(new InvoiceMail($data));

                return response()->json(['status' => 1, 'msg' => "The invoice has been sent to the customer's mail successfully!"]);
            } else {

                $customer = User::where('id', $newjobcard->customer_id)->first();
                $vehicles = Vehicle::where('id', $newjobcard->vehicle_id)->first();
                $jobCardSpareParts = JobCardSparePart::where('jobcard_id', $id)->get();

                $jobCardExtraCharges = JobCardExtraCharge::where('jobcard_id', $id)->get();
                $jobCardCustomerVoice = JobCardsInspection::where('jobcard_number', $newjobcard->jobcard_number)->where('is_customer_voice', 1)->get();
                $jobCardAccessories = JobCardsInspection::where('jobcard_number', $newjobcard->jobcard_number)->where('is_customer_voice', 2)->get();

                $title = 'View Invoice';
                $logo = (Auth::guard('workshop')->check() ? Auth::guard('workshop')->user() : null) ?? WorkShopVendor::find($newjobcard->user_id ?? 0) ?? Setting::first();

                $data = compact('title', 'logo', 'customer', 'newjobcard', 'vehicles', 'jobCardSpareParts', 'jobCardExtraCharges', 'jobCardCustomerVoice', 'jobCardAccessories');

                Mail::to($customer->email)->send(new EstimateMail($data));

                return response()->json(['status' => 1, 'msg' => "The estimate has been sent to the customer's mail successfully!"]);
            }
        }
        return response()->json(['status' => 0, 'msg' => "Something wrong found! Please try again."]);
    }

    public function estimateConfirmReject(Request $request)
    {

        $status = $request->status;
        $id = base64_decode($request->id);
        $userId = base64_decode(base64_decode($request->userId));

        $newjobcard = JobCard::where(['id' => $id, 'status' => 0, 'customer_id' => $userId])->first();

        if ($newjobcard) {
            $user_id = $newjobcard->customer?->id;

            Auth::loginUsingId($user_id);

            $customer = $newjobcard->customer;
            $vehicles = $newjobcard->vehicle;
            $jobCardSpareParts = JobCardSparePart::where('jobcard_id', $id)->get();

            $jobCardExtraCharges = JobCardExtraCharge::where('jobcard_id', $id)->get();
            $jobCardCustomerVoice = JobCardsInspection::where('jobcard_number', $newjobcard->jobcard_number)->where('is_customer_voice', 1)->get();
            $jobCardAccessories = JobCardsInspection::where('jobcard_number', $newjobcard->jobcard_number)->where('is_customer_voice', 2)->get();

            $title = 'View Invoice';
            $logo = Setting::first();
            // echo "<pre>";print_r($jobCardSpareParts->toArray());die;

            $data = compact('title', 'logo', 'customer', 'newjobcard', 'vehicles', 'jobCardSpareParts', 'jobCardExtraCharges', 'jobCardCustomerVoice', 'jobCardAccessories', 'status');

            return view('new_jobcard.estimate.estimate-confirm-reject', $data);
        }

        return view('new_jobcard.estimate.thankyou');
    }

    public function changeStatus(Request $request)
    {

        $id = $request->id;
        $status = $request->status == 1 ? 1 : 0;
        $newjobcard = JobCard::where(['id' => $id, 'status' => 0, 'customer_id' => $request->customer_id])->first();
        if ($newjobcard) {
            $newjobcard->status = $status;
            $newjobcard->save();
            return response()->json(['status' => 1]);
        }

        return response()->json(['status' => 0, 'msg' => "Something went wrong. Please contact the administrator."]);
    }


    public function getCustomerVehicles(Request $request)
    {

        $search = $request->input('search');



        // $vehicles = Vehicle::query()
        //     ->where('customers.user_id', Auth::guard('workshop')->user()->id)
        //     ->join('customers', 'vehicles.customer_id', '=', 'customers.id')
        //     ->when($search, function ($query, $search) {
        //         $query->where(function ($query) use ($search) {
        //             $query->where('customers.name', 'like', "%{$search}%")
        //                 ->orWhere('customers.lastname', 'like', "%{$search}%")
        //                 ->orWhere('customers.mobile_no', 'like', "%{$search}%")
        //                 ->orWhere('vehicles.number_plate', 'like', "%{$search}%");
        //         });
        //     })
        //     ->select('vehicles.id', 'vehicles.number_plate', 'customers.name', 'customers.lastname', 'customers.mobile_no')
        //     ->paginate(10);

        $vehicles = Vehicle::query()
            ->where('customers.user_id', Auth::guard('workshop')->user()->id)
            ->join('customers', 'vehicles.customer_id', '=', 'customers.id')
            ->leftJoin('modifications', 'vehicles.modification_id', '=', 'modifications.id') // 👈 add this
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('customers.name', 'like', "%{$search}%")
                        ->orWhere('customers.lastname', 'like', "%{$search}%")
                        ->orWhere('customers.mobile_no', 'like', "%{$search}%")
                        ->orWhere('vehicles.number_plate', 'like', "%{$search}%");
                });
            })
            ->select(
                'vehicles.id',
                'vehicles.modification',
                'vehicles.brand',
                'vehicles.variant',
                'vehicles.number_plate',
                'customers.name',
                'customers.lastname',
                'customers.mobile_no',
                'modifications.title as modification_title'
            )
            ->paginate(10);



        $data = $vehicles->items();

        // Return the response
        return response()->json([
            'data' => $data,
            'next_page_url' => $vehicles->nextPageUrl(),
        ]);
    }




    public function getCustomerCounters(Request $request)
    {

        $search = $request->input('search');



        $vehicles = CounterCustomers::query()
            ->where('user_id', Auth::guard('sparepart')->user()->id)
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('mobile_no', 'like', "%{$search}%")
                        ->orWhere('number_plate', 'like', "%{$search}%");
                });
            })
            ->select('id', 'number_plate', 'name', 'mobile_no')
            ->paginate(10);



        $data = $vehicles->items();

        // Return the response
        return response()->json([
            'data' => $data,
            'next_page_url' => $vehicles->nextPageUrl(),
        ]);
    }


    public function getCustomerVoice(Request $request)
    {
        $search = $request->input('search');

        if (empty($search)) {
            $jobCardsInspection = '';
        } else {
            $jobCardsInspection = JobCardsInspection::where('is_customer_voice', 1)
                // ->where('user_id', Auth::guard('workshop')->user()->id)
                ->where('customer_voice', 'LIKE', "%{$search}%")
                ->selectRaw('MIN(id) as id, customer_voice')
                ->groupBy('customer_voice')
                ->paginate(10);
        }



        $data = $jobCardsInspection->items();

        // Return the response
        return response()->json([
            'data' => $data,
            'next_page_url' => $jobCardsInspection->nextPageUrl(),
        ]);
    }


    public function getCustomerAccessory(Request $request)
    {
        $search = $request->input('search');


        if (empty($search)) {
            $jobCardsInspection = '';
        } else {
            $jobCardsInspection = JobCardsInspection::where('is_customer_voice', 2)
                // ->where('user_id', Auth::guard('workshop')->user()->id)
                ->where('customer_voice', 'LIKE', "%{$search}%")
                ->selectRaw('MIN(id) as id, customer_voice')
                ->groupBy('customer_voice')
                ->paginate(10);
        }



        $data = $jobCardsInspection->items();

        // Return the response
        return response()->json([
            'data' => $data,
            'next_page_url' => $jobCardsInspection->nextPageUrl(),
        ]);
    }


    public function getCustomerVehicle(Request $request)
    {
        $search = trim($request->input('search'));

        $jobCardsInspection = Modification::whereStatus(1);

        $jobCardsInspection->where(function ($q) use ($search) {
            $q->where('title', 'like', '%' . $search . '%')
                ->orWhere('brand_name', 'like', '%' . $search . '%')
                ->orWhere('variant_name', 'like', '%' . $search . '%')
                ->orWhere('year', 'like', '%' . $search . '%');
        });
        $jobCardsInspection = $jobCardsInspection
            ->select(
                'id',
                DB::raw("CONCAT(brand_name, ' ', variant_name,' ',year,' ',title) as vehicle_details")
            )->get();

        $data = $jobCardsInspection;

        return response()->json([
            'data' => $data,
            'next_page_url' => null,
        ]);
    }

    public function getCustomerWorkNotes(Request $request)
    {
        $search = $request->input('search');


        if (empty($search)) {
            $jobCardsInspection = '';
        } else {
            $jobCardsInspection = JobCardsInspection::where('is_customer_voice', 0)
                // ->where('user_id', Auth::guard('workshop')->user()->id)
                ->where('customer_voice', 'LIKE', "%{$search}%")
                ->selectRaw('MIN(id) as id, customer_voice')
                ->groupBy('customer_voice')
                ->paginate(10);
        }



        $data = $jobCardsInspection->items();

        // Return the response
        return response()->json([
            'data' => $data,
            'next_page_url' => $jobCardsInspection->nextPageUrl(),
        ]);
    }


    public function getSpareVehicle(Request $request)
    {
        $search = $request->input('search');

        if (empty($search)) {
            $jobCardsInspection = null;
        } else {
            $jobCardsInspection = DB::table('model_names')
                ->join('vehicle_brands', 'model_names.brand_id', '=', 'vehicle_brands.id')
                ->join('vehicle_types', 'vehicle_brands.vehicle_type_id', '=', 'vehicle_types.id')
                ->when($search, function ($query, $search) {
                    $query->where(function ($query) use ($search) {
                        $query->where('vehicle_types.vehicle_type', 'like', "%{$search}%")
                            ->orWhere('vehicle_brands.vehicle_brand', 'like', "%{$search}%")
                            ->orWhere('model_names.model_name', 'like', "%{$search}%");
                    });
                })
                ->select(
                    'model_names.id', // Include the ID of the model_names table
                    DB::raw("CONCAT(vehicle_types.vehicle_type, '/', vehicle_brands.vehicle_brand, '/', model_names.model_name) as vehicle_details")
                )
                ->distinct() // Avoid duplicate entries
                ->paginate(10);
        }


        $data = $jobCardsInspection ? $jobCardsInspection->items() : [];

        // echo "<pre>"; print_r($data); die;

        // Return the response
        return response()->json([
            'data' => $data,
            'next_page_url' => $jobCardsInspection ? $jobCardsInspection->nextPageUrl() : null,
        ]);
    }


    public function getCounterSalesInvoicePDF($id, $type)
    {

        $countersales = CounterSale::with('Customer', 'counterSalesSpareParts')->find($id);

        // Fetch the SparePartVendor logo/info
        $logo = null;
        if ($countersales->sparepart_id) {
            $logo = SparePartVendor::with('profileImage')->find($countersales->sparepart_id);
        }

        $title = 'View Invoice';
        $data = compact('title', 'countersales', 'logo');

        $pdf = PDF::loadView('new_countersalses.countersalses_invoice', $data)
            ->setPaper('a4', 'portrait');

        // Replace "/" with "-" in filename to avoid error
        $safeFileName = str_replace('/', '-', $countersales->countersale_number);

        if ($type) {
            return $pdf->stream('invoice_' . $safeFileName . '.pdf');
        }
        return $pdf->download('invoice_' . $safeFileName . '.pdf');
    }

    public function getWorkshopkOrderInvoice($id, $view)
    {

        $id = decrypt($id);
        $view = decrypt($view);

        $order = Order::with(['orderItem.SpareParts.label', 'workShopVendor'])->find($id);

        // Find the vendor from the first order item if not directly on the order
        $vendor = null;
        if ($order->orderItem->first()) {
            $vendor = $order->orderItem->first()->SpareParts?->vendor;
        }

      
        if ($order && (empty($order->invoice_number) || !str_starts_with($order->invoice_number, 'CARNATE')) && $order->payment_status == 1 && $order->order_status != 2) {
            $carnateInvoice = function_exists('getWorkshopInvoiceNumber') ? getWorkshopInvoiceNumber($order) : null;
            if ($carnateInvoice && $carnateInvoice !== 'N/A') {
                $order->invoice_number = $carnateInvoice;
            }
        }

        $admin = Admin::select('id', 'name', 'email', 'lastname', 'mobile_no', 'gst_number', 'address')->find(1);
        //echo "<pre>"; print_r($order->toArray());
        // echo "<pre>"; print_r($admin->toArray());
        // die;
        $title = 'View Invoice';

        $data = compact('title', 'order', 'admin', 'vendor');
        $pdf = PDF::loadView('orders-pdf.workshop-pdf', $data)
            ->setPaper('a4', 'portrait');
        if ($view == 1) {
            return $pdf->stream('invoice_' . $order->workShopVendor->name . '.pdf');
        }
        return $pdf->download('invoice_' . $order->workShopVendor->name . '.pdf');
    }

    public function getSparePartOrderInvoice($id, $type, $orderId, $view)
    {

        $id = decrypt($id);
        $type = decrypt($type);
        $orderId = decrypt($orderId);
        $view = decrypt($view);

        $sparePart = SparePartVendor::find($id);

        $itemIds = explode('-', $type);

        $admin = Admin::select('id', 'name', 'email', 'lastname', 'mobile_no', 'gst_number', 'address')
            ->find(1);

        $order = Order::with([
            'orderItem' => function ($query) use ($itemIds) {
                $query->whereIn('id', $itemIds);
            },
            'workShopVendor'
        ])->find($orderId);

        
        $vendor = $sparePart;
        if ($order && $vendor && $order->payment_status == 1) {
            $companyCode = \App\Services\SharedSerialService::resolveCompanyCode($vendor);
            $seriesCode  = \App\Services\SharedSerialService::resolveSeriesCode();
            $serialService = new \App\Services\SharedSerialService();

            if (!empty($order->spare_invoice_number)) {
                // Re‑use already generated spare‑part invoice.
                $sparePartInvoiceNumber = $order->spare_invoice_number;
            } else {
                // Generate a new invoice number and persist it in the dedicated column.
                $sparePartInvoiceNumber = $serialService->claimNext($vendor->id, $companyCode, $seriesCode);
                $order->spare_invoice_number = $sparePartInvoiceNumber;
                $order->save();
            }
        }

        $title = 'View Invoice';
        $data = compact('title', 'order', 'admin', 'sparePart');

        $pdf = PDF::loadView('orders-pdf.sparePart-pdf', $data)
            ->setPaper('a4', 'portrait');
        if ($view == 1) {

            return $pdf->stream('invoice_' . $sparePart->name . '.pdf');
        }
        return $pdf->download('invoice_' . $sparePart->name . '.pdf');



    }


    public function getWorkshopeCounterSalesInvoicePDF($id, $type)
    {
        //    dd('manku');

        $countersales = CounterSale::with('Customer', 'counterSalesSpareParts')->find($id);

        // Fetch the WorkShopVendor logo/info
        $logo = null;
        if ($countersales->workshop_id) {
            $logo = WorkShopVendor::with('Image')->find($countersales->workshop_id);
        }

        $title = 'View Invoice';
        $data = compact('title', 'countersales', 'logo');

        $pdf = PDF::loadView('new_countersalses.workshop_countersalses_invoice', $data)
            ->setPaper('a4', 'portrait');

        // Replace "/" with "-" in filename to avoid error
        $safeFileName = str_replace('/', '-', $countersales->countersale_number);

        if ($type) {
            return $pdf->stream('invoice_' . $safeFileName . '.pdf');
        }
        return $pdf->download('invoice_' . $safeFileName . '.pdf');
    }

}
