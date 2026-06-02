<?php

use App\Models\JobCard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

function isAdminLoggedin()
{
	if (Auth::guard('admin')->check()) {
		return true;
	} else {
		return false;
	}
}
function isUserLoggedin()
{
	if (Auth::guard('web')->check()) {
		return true;
	} else {
		return false;
	}
}

function isWorkshopLoggedin()
{
	if (Auth::guard('workshop')->check()) {
		return true;
	} else {
		return false;
	}
}
function isSparepartLoggedin()
{
	if (Auth::guard('sparepart')->check()) {
		return true;
	} else {
		return false;
	}
}

function isVendorLoggedin()
{
	if (Auth::guard('workshop')->check() || Auth::guard('sparepart')->check()) {
		return true;
	} else {
		return false;
	}
}

if (!function_exists('generateHashJobCardNumber')) {
	function generateHashJobCardNumber($user)
	{
		$companyName = $user->branch_name ?? 'DEF';
		$companyId = $user->is_user == 0 ? $user->id : $user->parent_id;

		$prefix = strtoupper(substr($companyName, 0, 3));
		$now = now();

		$financialYearStart = $now->month >= 4
			? now()->startOfYear()->month(4)->startOfMonth()
			: now()->subYear()->startOfYear()->month(4)->startOfMonth();

		$financialYearEnd = $financialYearStart->copy()->addYear()->subDay();

		$latestJobCard = JobCard::where('user_id', $companyId)
			->whereBetween('created_at', [$financialYearStart, $financialYearEnd])
			->select('id','jobcard_number')
			->latest('id')
			->first();

// 		if ($latestJobCard) {
// 			$lastNumber = (int) substr($latestJobCard->jobcard_number, -4);
// 			$nextNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
// 		} else {
// 			$nextNumber = '0001';
// 		}

if ($latestJobCard) {
    $parts = explode('-', $latestJobCard->jobcard_number);
    $lastNumber = isset($parts[2]) ? (int) ltrim($parts[2], '0') : 0;
    $nextNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
} else {
    $nextNumber = '0001';
}


		$FYearStart = $financialYearStart->format('y');
		$FYearEnd = $financialYearEnd->format('y');

		$jobCardNumber = $prefix . '-' .$FYearStart.$FYearEnd.'-'. $nextNumber;
		return $jobCardNumber;
	}
}

// if (!function_exists('generateHashCounterSaleNumber')) {
// 	function generateHashCounterSaleNumber($userId)
// 	{
// 		$timestamp = microtime(true);
// 		$random = mt_rand();
if (!function_exists('generateHashCounterSaleNumber')) {
    function generateHashCounterSaleNumber($branchName, $code, $lastSerial = 0)
    {
        $prefix = strtoupper(substr(preg_replace('/\s+/', '', $branchName), 0, 3));
        $serial = str_pad($lastSerial + 1, 4, '0', STR_PAD_LEFT);
        return "{$prefix}-{$code}-{$serial}";
    }
}

// Separate function for Sparepart Counter Sale Number Generation
if (!function_exists('generateSparepartCounterSaleNumber')) {
    function generateSparepartCounterSaleNumber($userId)
    {
        $timestamp = microtime(true);
        $random = mt_rand();
        $hash = strtoupper(substr(sha1($userId . $timestamp . $random), 0, 10));
        return "CS-{$hash}";
    }
}



if (!function_exists('sparepartOrderReference')) {
	/**
	 * Spare part reports: show invoice number only (no workshop/customer names).
	 */
	function sparepartOrderReference($order): string
	{
		if (!$order) {
			return 'N/A';
		}

		if (!empty($order->invoice_number)) {
			return (string) $order->invoice_number;
		}

		return '#' . $order->id;
	}
}

if (!function_exists('getCommission')) {
	function getCommission($category, $amount = 0)
	{
		switch ($category) {
			case 1:
				$commision = 5;
				break;
			case 2:
				$commision = 10;
				break;
			case 3:
				$commision = 15;
				break;
			case 4:
				$commision = 20;
				break;
			default:
				$commision = 0;
				break;
		}
		return $commision;
	}
}
if (!function_exists('customErrorMsg')) {
	function customErrorMsg()
	{
		$messages = [
			'customerVoices.required' => 'The Customer Voices field is required.',
			'customerVoices.*.required' => 'The Customer Voice is required.',
			'customerVoices.*.string' => 'The Customer Voice must be a valid string.',
			'accessoriesVoices.required' => 'The Customer Voices field is required.',
			'accessoriesVoices.*.required' => 'The Customer Voice is required.',
			'accessoriesVoices.*.string' => 'The Customer Voice must be a valid string.',
			'workVoices.required' => 'The Customer Voices field is required.',
			'workVoices.*.required' => 'The Customer Voice is required.',
			'workVoices.*.string' => 'The Customer Voice must be a valid string.',
			'pdftype.required' => 'The Type field is required.',
			'viewtype.required' => 'The Type field is required.',
			'rows.*.category.required' => 'The Category field is required.',
			'rows.*.stock_item.required' => 'The Stock Item field is required.',
			'rows.*.price_stock.required' => 'The Stock Price field is required.',
			'rows.*.buy_price_stock.required' => 'The Buy Price field is required.',
			'rows.*.quantity_stock.required' => 'The Stock Quantity field is required.',
			'totalAmount.required' => 'The total amount field is required.',
			'totalAmount.min' => 'The total amount must be at least 1.',
			'final_amount.required' => 'The Final amount field is required.',
			'final_amount.min' => 'The Final amount must be at least 1.',
			'extraCharges.*.mechanic_id' => 'Please select a mechanic.',
			'image_id.required' => 'The Image is required.',
		];
		return $messages;
	}

}


// Get User FullName
if (!function_exists('getUserFullName')) {
	function getUserFullName($id)
	{
		$users = DB::table('users')->where('id', '=', $id)->first();
		if (!empty($users)) {
			$user_name = $users->name . " " . $users->lastname;
			return $user_name;
		}
	}
}

if (!function_exists('getAccessStatusUser')) {
	function getAccessStatusUser($menu_name, $id)
	{

		$user = DB::table('users')->where('id', '=', $id)->first();

		$userrole = $user->role;

		if ($userrole == 'admin') {
			return 'yes';
		} else {
			if ($userrole == 'Customer') {
				$acess = DB::table('tbl_accessrights')->where('menu_name', '=', $menu_name)->first();

				$customers = $acess->customers;

				if ($customers == 1) {
					return 'yes';
				} elseif ($customers == 0) {
					return 'no';
				}
			} elseif ($userrole == 'employee') {
				$acess = DB::table('tbl_accessrights')->where('menu_name', '=', $menu_name)->first();
				$employee = $acess->employee;
				if ($employee == 1) {
					return 'yes';
				} elseif ($employee == 0) {
					return 'no';
				}
			} elseif ($userrole == 'supportstaff') {
				$acess = DB::table('tbl_accessrights')->where('menu_name', '=', $menu_name)->first();
				$support_staff = $acess->support_staff;
				if ($support_staff == 1) {
					return 'yes';
				} elseif ($support_staff == 0) {
					return 'no';
				}
			} elseif ($userrole == 'accountant') {
				$acess = DB::table('tbl_accessrights')->where('menu_name', '=', $menu_name)->first();
				$accountant = $acess->accountant;
				if ($accountant == 1) {
					return 'yes';
				} elseif ($accountant == 0) {
					return 'no';
				}
			} elseif ($userrole == 'branch_admin') {
				$acess = DB::table('tbl_accessrights')->where('menu_name', '=', $menu_name)->first();
				$accountant = $acess->accountant;
				if ($accountant == 1) {
					return 'yes';
				} elseif ($accountant == 0) {
					return 'no';
				}
			}
		}
	}
}


// Get City Name In Customer,Employee,supplier module
if (!function_exists('getCityName')) {
	function getCityName($id)
	{
		$city = DB::table('cities')->where('id', '=', $id)->first();
		if (!empty($city)) {
			$city_name = $city->name;
			return $city_name;
		}
	}
}

// Get State Name In Customer,Employee,supplier module
if (!function_exists('getStateName')) {
	function getStateName($id)
	{
		$state = DB::table('states')->where('id', '=', $id)->first();
		if (!empty($state)) {
			$state_name = $state->name;
			return $state_name;
		}
	}
}

// Get Country Name In Customer,Employee,supplier module
if (!function_exists('getCountryName')) {
	function getCountryName($id)
	{
		$country = DB::table('countries')->where('id', '=', $id)->first();
		if (!empty($country)) {
			$country_name = $country->name;
			return $country_name;
		}
	}
}


// Get Vehicle Name value In Rto managament module
if (!function_exists('getVehicleName')) {
	function getVehicleName($id)
	{
		$vehicles = DB::table('vehicles')->where('id', '=', $id)->first();
		if (!empty($vehicles)) {
			// $vehicle_name = $vehicles->modelname;
			$vehicle_name = getVehicleBrand($vehicles->vehiclebrand_id) . ' ' . $vehicles->modelname . ' ' . $vehicles->modelyear;
			return $vehicle_name;
		}
	}
}

if (!function_exists('getVehicleNameFromInvoice')) {
	function getVehicleNameFromInvoice($id)
	{

		$tbl_services = DB::table('tbl_services')->where('id', '=', $id)->first();

		if (!empty($tbl_services)) {
			$vehicles = DB::table('vehicles')->where('id', '=', $tbl_services->vehicle_id)->first();
			if (!empty($vehicles)) {
				$vehicle_name = getVehicleBrand($vehicles->vehiclebrand_id) . ' ' . $vehicles->modelname . ' ' . $vehicles->modelyear;
				return $vehicle_name;
			}
		}
	}
}

//Get customer full name
if (!function_exists('getCustomerName')) {
	function getCustomerName($id)
	{
		$customer = DB::table('users')->where([['id', '=', $id], ['role', '=', 'Customer']])->first();
		if (!empty($customer)) {
			$customer_name = $customer->name;
			$customer_lname = $customer->lastname;
			return $customer_name . ' ' . $customer_lname;
		}
	}
}

//get Employee full name
if (!function_exists('getAssignedName')) {
	function getAssignedName($id)
	{
		$assigned = DB::table('users')->where([['id', '=', $id], ['role', '=', 'employee']])->first();
		if (!empty($assigned)) {
			$assi_name = $assigned->name;
			$assi_lname = $assigned->lastname;
			return $assi_name . ' ' . $assi_lname;
		}
	}
}

//Customer Address in View of Sales module
if (!function_exists('getCustomerAddress')) {
	function getCustomerAddress($id)
	{

		$customer = DB::table('users')->where([['id', '=', $id], ['role', '=', 'Customer']])->first();

		if (!empty($customer)) {
			$customer_address = $customer->address;

			return $customer_address;
		}
	}
}

//Customer city in View of Sales module
if (!function_exists('getCustomerCity')) {
	function getCustomerCity($id)
	{

		$customer = DB::table('users')->where([['id', '=', $id], ['role', '=', 'Customer']])->first();

		if (!empty($customer)) {
			$customer_city = getCityName($customer->city_id);

			return $customer_city;
		}
	}
}
//Customer state in View of Sales module
if (!function_exists('getCustomerState')) {
	function getCustomerState($id)
	{

		$customer = DB::table('users')->where([['id', '=', $id], ['role', '=', 'Customer']])->first();

		if (!empty($customer)) {
			$customer_state = getStateName($customer->state_id);

			return $customer_state;
		}
	}
}
//Customer state in View of Sales module
if (!function_exists('getCustomerCountry')) {
	function getCustomerCountry($id)
	{

		$customer = DB::table('users')->where([['id', '=', $id], ['role', '=', 'Customer']])->first();

		if (!empty($customer)) {
			$customer_country = getCountryName($customer->country_id);

			return $customer_country;
		}
	}
}

//Customer Mobile in View of Sales module
if (!function_exists('getCustomerMobile')) {
	function getCustomerMobile($id)
	{

		$customer = DB::table('users')->where([['id', '=', $id], ['role', '=', 'Customer']])->first();

		if (!empty($customer)) {
			$customer_mobile = $customer->mobile_no;

			return $customer_mobile;
		}
	}
}

//Customer Mobile in View of Sales module
if (!function_exists('getCustomerTaxid')) {
	function getCustomerTaxid($id)
	{

		$customer = DB::table('users')->where([['id', '=', $id], ['role', '=', 'Customer']])->first();

		if (!empty($customer)) {
			$customer_taxid = $customer->tax_id;

			return $customer_taxid;
		}
	}
}


//Customer Email in View of Sales module
if (!function_exists('getCustomerEmail')) {
	function getCustomerEmail($id)
	{

		$customer = DB::table('users')->where([['id', '=', $id], ['role', '=', 'Customer']])->first();

		if (!empty($customer)) {
			$customer_email = $customer->email;

			return $customer_email;
		}
	}
}
// Get VehicleType Name In Vehicle module
if (!function_exists('getVehicleType')) {
	function getVehicleType($id)
	{

		$vehical_type = DB::table('tbl_vehicle_types')->where('id', '=', $id)->first();

		if (!empty($vehical_type)) {
			$vehical_type_name = $vehical_type->vehicle_type;
			return $vehical_type_name;
		}
	}
}

//Vehicle Type in View of Sales module
if (!function_exists('getVehicleType')) {
	function getVehicleType($id)
	{

		$vehi_type = DB::table('tbl_vehicle_types')->where('id', '=', $id)->first();

		if (!empty($vehi_type)) {
			$vehi_type_name = $vehi_type->vehicle_type;

			return $vehi_type_name;
		}
	}
}


//Vehicle Color in View of Sales module
if (!function_exists('getVehicleColor')) {
	function getVehicleColor($id)
	{

		$color = DB::table('tbl_colors')->where('id', '=', $id)->first();

		if (!empty($color)) {
			$color_name = $color->color;

			return $color_name;
		}
	}
}


//Total Amount in View of Sales module
if (!function_exists('getTotalAmonut')) {
	function getTotalAmonut($tax, $name, $amount)
	{

		$tax = DB::table('tbl_sales_taxes')->where([['tax_name', '=', $name], ['tax', '=', $tax]])->first();
		$tax_rate = $tax->tax;
		$total_price = ($tax_rate * $amount) / 100;
		return $total_price;
	}
}


//Total Amount of rto  in View of Sales module
if (!function_exists('getTotalRto')) {
	function getTotalRto($id)
	{

		$rto = DB::table('tbl_rto_taxes')->where('vehicle_id', '=', $id)->first();
		$r_tax = $rto->registration_tax;
		$no_plate = $rto->number_plate_charge;
		$road_tax = $rto->muncipal_road_tax;

		$total_rto_charges = $r_tax + $no_plate + $road_tax;
		return $total_rto_charges;
	}
}


//Get Observation Type Name in Observation Point List Module
if (!function_exists('getObservationTypeName')) {
	function getObservationTypeName($id)
	{

		$o_type = DB::table('tbl_observation_types')->where('id', '=', $id)->first();

		if (!empty($o_type)) {
			$type_name = $o_type->type;


			return $type_name;
		}
	}
}

//Fuel type  in View of vehicle  module
if (!function_exists('getFuelType')) {
	function getFuelType($id)
	{

		$fueal_type = DB::table('tbl_fuel_types')->where('id', '=', $id)->first();

		if (!empty($fueal_type)) {
			$fuel_type_name = $fueal_type->fuel_type;

			return $fuel_type_name;
		}
	}
}

//Vehicle Brand  in View of vehicle module
if (!function_exists('getVehicleBrands')) {
	function getVehicleBrands($id)
	{

		$vehi_brand = DB::table('tbl_vehicle_brands')->where('id', '=', $id)->first();

		if (!empty($vehi_brand)) {
			$vehicalbrand = $vehi_brand->vehicle_brand;

			return $vehicalbrand;
		}
	}
}



//Get Color Name in View of vehicle module
if (!function_exists('getColorName')) {
	function getColorName($id)
	{

		$color = DB::table('tbl_colors')->where('id', '=', $id)->first();
		if (!empty($color)) {
			$color_name = $color->color;

			return $color_name;
		}
	}
}


//getcolourcode

if (!function_exists('getColourCode')) {
	function getColourCode($id)
	{
		$colourname = getColorName($id);
		switch ($colourname) {
			case "red":
				return "#ff0000";
				break;
			case "blue":
				return "#0000FF";
				break;
			case "green":
				echo "#008000";
				break;
			case "Black ":
				return "#000000";
				break;
			case "Brown ":
				return "#A52A2A";
				break;
			case "Grey ":
				echo "##808080";
				break;
			case "Pink ":
				return "##FFC0CB";
				break;
			case "Purple ":
				return "##800080";
				break;
			case "Yellow ":
				echo "###FFFF00";
				break;

			default:
				echo "#696969";
		}
	}
}

//Get Checked Value In Jobcard Detail
if (!function_exists('getCheckvalue')) {
	function getCheckvalue($services_id, $observation_points_id)
	{

		$getdata = DB::table('tbl_service_observation_points')->where([['services_id', '=', $services_id], ['observation_points_id', '=', $observation_points_id]])->count();
		if ($getdata > 0) {
			return 'checked';
		} else {
			return '';
		}
	}
}

//Get Checked Value In Jobcard Detail
if (!function_exists('getCheckReview')) {
	function getCheckReview($services_id, $observation_points_id)
	{

		$getdata = DB::table('tbl_service_observation_points')->where([['services_id', '=', $services_id], ['observation_points_id', '=', $observation_points_id]])->first();

		if (!empty($getdata)) {
			$review = $getdata->review;
			return $review;
		}
	}
}

// get vehicle first image
if (!function_exists('getVehicleImage')) {
	function getVehicleImage($id)
	{

		$vehicleimage = DB::table('tbl_vehicle_images')->where('vehicle_id', '=', $id)->first();
		if (!empty($vehicleimage)) {
			$vehiclefisrtimage = $vehicleimage->image;
			return $vehiclefisrtimage;
		} else {
			$vehiclefisrtimage = 'avtar.png';
			return $vehiclefisrtimage;
		}
	}
}


//Get AssigineTo  Value In Service(module) List  Detail
if (!function_exists('getAssignTo')) {
	function getAssignTo($id)
	{

		$AssignTo = DB::table('users')->where('id', '=', $id)->first();

		if (!empty($AssignTo)) {
			$AssignTo_name = $AssignTo->name . ' ' . $AssignTo->lastname;

			return $AssignTo_name;
		}
	}
}

//Set the logo of get pass invoice
if (!function_exists('getLogoInvoice')) {
	function getLogoInvoice()
	{

		$logo = DB::table('tbl_settings')->first();
		$logo_img = $logo->logo_image;

		return $logo_img;
	}
}

//Set the Coupan no in Service List
if (!function_exists('getAllCoupon')) {
	function getAllCoupon($cid, $vid)
	{

		$all_coupan = DB::table('tbl_services')->where([['customer_id', '=', $cid], ['vehicle_id', '=', $vid], ['job_no', 'like', 'C%']])->get()->toArray();

		return $all_coupan;
	}
}

//Set the Used Coupon no in Service List
if (!function_exists('getUsedCoupon')) {
	function getUsedCoupon($cid, $vid, $cupanno)
	{

		$used_coupon = DB::table('tbl_jobcard_details')->where([['customer_id', '=', $cid], ['vehicle_id', '=', $vid], ['coupan_no', '=', $cupanno]])->first();

		if (!empty($used_coupon)) {

			$done_status = $used_coupon->done_status;
			return $done_status;
		}
	}
}

// Get A Access Rights Setting  In User Side PAge for all Module
if (!function_exists('getAccessStatusUser')) {
	function getAccessStatusUser($menu_name, $id)
	{

		$user = DB::table('users')->where('id', '=', $id)->first();

		$userrole = $user->role;

		if ($userrole == 'admin') {
			return 'yes';
		} else {
			if ($userrole == 'Customer') {
				$acess = DB::table('tbl_accessrights')->where('menu_name', '=', $menu_name)->first();

				$customers = $acess->customers;

				if ($customers == 1) {
					return 'yes';
				} elseif ($customers == 0) {
					return 'no';
				}
			} elseif ($userrole == 'employee') {
				$acess = DB::table('tbl_accessrights')->where('menu_name', '=', $menu_name)->first();
				$employee = $acess->employee;
				if ($employee == 1) {
					return 'yes';
				} elseif ($employee == 0) {
					return 'no';
				}
			} elseif ($userrole == 'supportstaff') {
				$acess = DB::table('tbl_accessrights')->where('menu_name', '=', $menu_name)->first();
				$support_staff = $acess->support_staff;
				if ($support_staff == 1) {
					return 'yes';
				} elseif ($support_staff == 0) {
					return 'no';
				}
			} elseif ($userrole == 'accountant') {
				$acess = DB::table('tbl_accessrights')->where('menu_name', '=', $menu_name)->first();
				$accountant = $acess->accountant;
				if ($accountant == 1) {
					return 'yes';
				} elseif ($accountant == 0) {
					return 'no';
				}
			} elseif ($userrole == 'branch_admin') {
				$acess = DB::table('tbl_accessrights')->where('menu_name', '=', $menu_name)->first();
				$accountant = $acess->accountant;
				if ($accountant == 1) {
					return 'yes';
				} elseif ($accountant == 0) {
					return 'no';
				}
			}
		}
	}
}

// Get active Admin list in data list
if (!function_exists('getActiveAdmin')) {
	function getActiveAdmin($id)
	{
		$data = DB::table('users')->where('id', '=', $id)->first();

		if (!empty($data)) {
			$userrole = $data->role;
			if ($userrole == 'admin') {
				return "yes";
			} else {
				return "no";
			}
		}
	}
}

// Get active Customer list in data list
if (!function_exists('getActiveCustomer')) {
	function getActiveCustomer($id)
	{

		$data = DB::table('users')->where('id', '=', $id)->first();

		if (!empty($data)) {
			$userrole = $data->role;
			if ($userrole == 'admin' || $userrole == 'supportstaff' || $userrole == 'accountant') {

				return "yes";
			} else {
				return "no";
			}
		}
	}
}

// Get active Employee list in data list
if (!function_exists('getActiveEmployee')) {
	function getActiveEmployee($id)
	{

		$data = DB::table('users')->where('id', '=', $id)->first();

		if (!empty($data)) {
			$userrole = $data->role;
			if ($userrole == 'employee') {

				return "yes";
			} else {

				return "no";
			}
		}
	}
}

// Get active Admin list in data list
if (!function_exists('getCustomersactive')) {
	function getCustomersactive($id)
	{

		$data = DB::table('users')->where('id', '=', $id)->first();

		if (!empty($data)) {
			$userrole = $data->role;
			if ($userrole == 'customer') {

				return "yes";
			} else {
				return "no";
			}
		}
	}
}

// Get active Admin list in data list
if (!function_exists('getBranchadminsactive')) {
	function getBranchadminsactive($id)
	{
		$data = DB::table('users')->where('id', '=', $id)->first();

		if (!empty($data)) {
			$userrole = $data->role;
			if ($userrole == 'branch_admin') {
				return "yes";
			} else {
				return "no";
			}
		}
	}
}

// Get active jobcard list in Customer data list
if (!function_exists('getCustomerJobcard')) {
	function getCustomerJobcard($id)
	{

		$service = DB::table('tbl_services')->where([['customer_id', '=', $id], ['job_no', 'like', 'J%']])->get()->toArray();

		if (!empty($service)) {
			return "yes";
		} else {

			return "no";
		}
	}
}


// Get Login Customer in Sales data list

if (!function_exists('getCustomerSales')) {
	function getCustomerSales($id)
	{

		$sales = DB::table('tbl_sales')->where('customer_id', '=', $id)->get()->toArray();

		if (!empty($sales)) {
			return "yes";
		} else {

			return "no";
		}
	}
}

// Get active Service list in Customer data list
if (!function_exists('getCustomerService')) {
	function getCustomerService($id)
	{

		$service = DB::table('tbl_services')->where([['customer_id', '=', $id], ['job_no', 'like', 'J%']])->get()->toArray();

		if (!empty($service)) {
			return "yes";
		} else {

			return "no";
		}
	}
}

// Get active Customer list in data list
if (!function_exists('getCustomerList')) {
	function getCustomerList($id)
	{

		$data = DB::table('users')->where('id', '=', $id)->first();

		if (!empty($data)) {
			$userrole = $data->role;
			if ($userrole == 'Customer') {
				$service = DB::table('tbl_services')->where([['customer_id', '=', $id], ['job_no', 'like', 'J%'], ['done_status', '=', 1]])->get()->toArray();
				if (!empty($service)) {
					return "yes";
				} else {

					return "no";
				}
			} else {
				return "no";
			}
		}
	}
}


// Count Number of service in dashboard
if (!function_exists('getNumberOfService')) {
	function getNumberOfService($id)
	{
		$y = date("Y");
		$m = date("m");

		$d = $id;

		$datess = "$y/$m/$d";

		$data = DB::table('tbl_services')->where('done_status', '!=', 2)->where('soft_delete', '=', 0)->whereDate('service_date', '=', $datess)->count();

		return $data;
	}
}



// Current  stock
if (!function_exists('getCurrentStock')) {
	function getCurrentStock($p_id)
	{
		$stockproduct = DB::table('tbl_service_pros')->where('product_id', '=', $p_id)->get()->toArray();
		$selltotal = 0;
		foreach ($stockproduct as $stockproducts) {
			$qty = $stockproducts->quantity;
			$selltotal += $qty;
		}

		$allstock = DB::table('tbl_purchase_history_records')->where('product_id', '=', $p_id)->get()->toArray();
		$alltotal = 0;
		foreach ($allstock as $allstocks) {
			$qtys = $allstocks->qty;
			$alltotal += $qtys;
		}

		$currentstock = $alltotal - $selltotal;
		return $currentstock;
	}
}

// Get logo system in app blade

if (!function_exists('getLogoSystem')) {
	function getLogoSystem()
	{

		$logo = DB::table('tbl_settings')->first();
		$logo_image = $logo->logo_image;
		return $logo_image;
	}
}

// Get  system name in app blade

if (!function_exists('getNameSystem')) {
	function getNameSystem()
	{

		$system_name = DB::table('tbl_settings')->first();
		$system_name = $system_name->system_name;
		return $system_name;
	}
}
// Get date format in all project
if (!function_exists('getDateFormat')) {
	function getDateFormat()
	{

		$dateformat = DB::table('tbl_settings')->first();

		if (!empty($dateformat)) {
			$dateformate = $dateformat->date_format;
			return $dateformate;
		}
	}
}


// Get date format in datepicker
if (!function_exists('getDatepicker')) {
	function getDatepicker()
	{
		$dateformat = DB::table('tbl_settings')->first();
		$dateformate = $dateformat->date_format;
		if (!empty($dateformate)) {
			if ($dateformate == 'm-d-Y') {
				$dateformats = "mm-dd-yyyy";
				return $dateformats;
			} elseif ($dateformate == 'Y-m-d') {
				$dateformats = "yyyy-mm-dd";
				return $dateformats;
			} elseif ($dateformate == 'd-m-Y') {
				$dateformats = "dd-mm-yyyy";
				return $dateformats;
			} elseif ($dateformate == 'M-d-Y') {
				$dateformats = "MM-dd-yyyy";
				return $dateformats;
			}
		}
	}
}

// Get date format in Datetimepicker
if (!function_exists('getDatetimepicker')) {
	function getDatetimepicker()
	{

		$dateformate = getDateFormat();

		if (!empty($dateformate)) {
			if ($dateformate == 'm-d-Y') {
				$dateformats = "mm-dd-yyyy hh:ii:ss";
				return $dateformats;
			} elseif ($dateformate == 'Y-m-d') {
				$dateformats = "yyyy-mm-dd  hh:ii:ss";
				return $dateformats;
			} elseif ($dateformate == 'd-m-Y') {
				$dateformats = "dd-mm-yyyy hh:ii:ss";
				return $dateformats;
			} elseif ($dateformate == 'M-d-Y') {
				$dateformats = "M-dd-yyyy hh:ii:ss";
				return $dateformats;
			}
		}
	}
}
// Get Day Name in View Of general_setting
if (!function_exists('getDayName')) {
	function getDayName($id)
	{

		switch ($id) {
			case "1":
				return "Monday";
				break;
			case "2":
				return "Tuesday";
				break;
			case "3":
				return "Wednesday";
				break;
			case "4":
				return "Thursday";
				break;
			case "5":
				return "Friday";
				break;
			case "6":
				return "Saturday";
				break;
			case "7":
				return "Sunday";
				break;


			default:
				echo "Sunday";
		}
	}
}

// Get from open hours time in View Of general_setting
if (!function_exists('getOpenHours')) {
	function getOpenHours($id)
	{
		$tbl_hours = DB::table('tbl_business_hours')->where('from', '=', $id)->first();
		$pm = $tbl_hours->from;
		if ($pm >= 12) {
			if ($pm == 12) {
				$pmfinal = $pm;
				$final = $pmfinal . '' . ":00 PM";
				return $final;
			} else {
				$pmfinal = $pm - 12;
				$final = $pmfinal . '' . ":00 PM";
				return $final;
			}
		} else {
			if ($pm == 0) {
				$pmfinal = $pm + 12;
				$final = $pmfinal . '' . ":00 AM";
				return $final;
			} else {
				$pmfinal = $pm;
				$final = $pmfinal . '' . ":00 AM";
				return $final;
			}
		}
	}
}

// Get close hours time in View Of general_setting
if (!function_exists('getCloseHours')) {
	function getCloseHours($id)
	{
		$tbl_hours = DB::table('tbl_business_hours')->where('to', '=', $id)->first();
		$am = $tbl_hours->to;
		if ($am >= 12) {
			if ($am == 12) {
				$pmfinal = $am;
				$final = $pmfinal . '' . ":00 PM";
				return $final;
			} else {
				$pmfinal = $am - 12;
				$final = $pmfinal . '' . ":00 PM";
				return $final;
			}
		} else {
			if ($am == 0) {
				$pmfinal = $am + 12;
				$final = $pmfinal . '' . ":00 AM";
				return $final;
			} else {
				$pmfinal = $am;
				$final = $pmfinal . '' . ":00 AM";
				return $final;
			}
		}
	}
}

//Get data  value in custom field
if (!function_exists('getCustomData')) {
	function getCustomData($tbl_custom, $userid)
	{
		$userdata = DB::table('users')->where('id', '=', $userid)->first();

		$jsonn = $userdata->custom_field;

		$jsonns = json_decode($jsonn);
		if (!empty($jsonns)) {
			foreach ($jsonns as $key => $value) {
				$ids = $value->id;
				$value1 = $value->value;

				if ($tbl_custom == $ids) {
					return $value1;
				}
			}
		}
	}
}

//Get data  value in custom field vehicle table
if (!function_exists('getCustomDataVehicle')) {
	function getCustomDataVehicle($tbl_custom, $userid)
	{
		$userdata = DB::table('vehicles')->where('id', '=', $userid)->first();

		$jsonn = $userdata->custom_field;

		$jsonns = json_decode($jsonn);
		if (!empty($jsonns)) {
			foreach ($jsonns as $key => $value) {
				$ids = $value->id;
				$value1 = $value->value;


				if ($tbl_custom == $ids) {
					return $value1;
				}
			}
		}
	}
}

// Get Vehicle type value In vehicle brand module
if (!function_exists('getVehicleBrand')) {
	function getVehicleBrand($id)
	{
		$vehiclebrand = DB::table('vehicle_brands')->where('id', '=', $id)->first();
		if (!empty($vehiclebrand)) {
			$vehicle_brand = $vehiclebrand->vehicle_brand;

			return $vehicle_brand;
		}
	}
}



//Get data  value in custom field from Service table
if (!function_exists('getCustomDataService')) {
	function getCustomDataService($tbl_custom, $userid)
	{
		$userdata = DB::table('tbl_services')->where('id', '=', $userid)->first();

		$jsonn = $userdata->custom_field;

		$jsonns = json_decode($jsonn);
		if (!empty($jsonns)) {
			foreach ($jsonns as $key => $value) {
				$ids = $value->id;
				$value1 = $value->value;

				if ($tbl_custom == $ids) {
					return $value1;
				}
			}
		}
	}
}


//Get data  value in custom field from Sales table
if (!function_exists('getCustomDataSales')) {
	function getCustomDataSales($tbl_custom, $userid)
	{
		$userdata = DB::table('tbl_sales')->where('id', '=', $userid)->first();

		$jsonn = $userdata->custom_field;

		$jsonns = json_decode($jsonn);
		if (!empty($jsonns)) {
			foreach ($jsonns as $key => $value) {
				$ids = $value->id;
				$value1 = $value->value;

				if ($tbl_custom == $ids) {
					return $value1;
				}
			}
		}
	}
}

//Get data  value in custom field from Salepart table
if (!function_exists('getCustomDataSalepart')) {
	function getCustomDataSalepart($tbl_custom, $userid)
	{
		$userdata = DB::table('tbl_sale_parts')->where('id', '=', $userid)->first();

		$jsonn = $userdata->custom_field;

		$jsonns = json_decode($jsonn);
		if (!empty($jsonns)) {
			foreach ($jsonns as $key => $value) {
				$ids = $value->id;
				$value1 = $value->value;

				if ($tbl_custom == $ids) {
					return $value1;
				}
			}
		}
	}
}


//Get data  value in custom field from Invoice table
if (!function_exists('getCustomDataInvoice')) {
	function getCustomDataInvoice($tbl_custom, $userid)
	{
		$userdata = DB::table('tbl_invoices')->where('id', '=', $userid)->first();

		$jsonn = $userdata->custom_field;

		$jsonns = json_decode($jsonn);
		if (!empty($jsonns)) {
			foreach ($jsonns as $key => $value) {
				$ids = $value->id;
				$value1 = $value->value;

				if ($tbl_custom == $ids) {
					return $value1;
				}
			}
		}
	}
}


//Get data  value in custom field from Product table
if (!function_exists('getCustomDataProduct')) {
	function getCustomDataProduct($tbl_custom, $userid)
	{
		$userdata = DB::table('tbl_products')->where('id', '=', $userid)->first();

		$jsonn = $userdata->custom_field;

		$jsonns = json_decode($jsonn);
		if (!empty($jsonns)) {
			foreach ($jsonns as $key => $value) {
				$ids = $value->id;
				$value1 = $value->value;

				if ($tbl_custom == $ids) {
					return $value1;
				}
			}
		}
	}
}


//Get data  value in custom field from Purchase table
if (!function_exists('getCustomDataPurchase')) {
	function getCustomDataPurchase($tbl_custom, $userid)
	{
		$userdata = DB::table('tbl_purchases')->where('id', '=', $userid)->first();

		$jsonn = $userdata->custom_field;

		$jsonns = json_decode($jsonn);
		if (!empty($jsonns)) {
			foreach ($jsonns as $key => $value) {
				$ids = $value->id;
				$value1 = $value->value;

				if ($tbl_custom == $ids) {
					return $value1;
				}
			}
		}
	}
}


//Get data  value in custom field from VehicleType table
if (!function_exists('getCustomDataVehicleType')) {
	function getCustomDataVehicleType($tbl_custom, $userid)
	{
		$userdata = DB::table('tbl_vehicle_types')->where('id', '=', $userid)->first();

		$jsonn = $userdata->custom_field;

		$jsonns = json_decode($jsonn);
		if (!empty($jsonns)) {
			foreach ($jsonns as $key => $value) {
				$ids = $value->id;
				$value1 = $value->value;

				if ($tbl_custom == $ids) {
					return $value1;
				}
			}
		}
	}
}


//Get data  value in custom field from VehicleBrand table
if (!function_exists('getCustomDataVehicleBrand')) {
	function getCustomDataVehicleBrand($tbl_custom, $userid)
	{
		$userdata = DB::table('tbl_vehicle_brands')->where('id', '=', $userid)->first();

		$jsonn = $userdata->custom_field;

		$jsonns = json_decode($jsonn);
		if (!empty($jsonns)) {
			foreach ($jsonns as $key => $value) {
				$ids = $value->id;
				$value1 = $value->value;

				if ($tbl_custom == $ids) {
					return $value1;
				}
			}
		}
	}
}


//Get data  value in custom field from Color table
if (!function_exists('getCustomDataColors')) {
	function getCustomDataColors($tbl_custom, $userid)
	{
		$userdata = DB::table('tbl_colors')->where('id', '=', $userid)->first();

		$jsonn = $userdata->custom_field;

		$jsonns = json_decode($jsonn);
		if (!empty($jsonns)) {
			foreach ($jsonns as $key => $value) {
				$ids = $value->id;
				$value1 = $value->value;

				if ($tbl_custom == $ids) {
					return $value1;
				}
			}
		}
	}
}


//Get data  value in custom field from Income table
if (!function_exists('getCustomDataIncome')) {
	function getCustomDataIncome($tbl_custom, $userid)
	{

		$userdata = DB::table('tbl_incomes')->where('id', '=', $userid)->first();

		$jsonn = $userdata->custom_field;

		$jsonns = json_decode($jsonn);
		if (!empty($jsonns)) {
			foreach ($jsonns as $key => $value) {
				$ids = $value->id;
				$value1 = $value->value;

				if ($tbl_custom == $ids) {
					return $value1;
				}
			}
		}
	}
}


//Get data  value in custom field from Expenses table
if (!function_exists('getCustomDataExpenses')) {
	function getCustomDataExpenses($tbl_custom, $userid)
	{
		$userdata = DB::table('tbl_expenses')->where('id', '=', $userid)->first();

		$jsonn = $userdata->custom_field;

		$jsonns = json_decode($jsonn);
		if (!empty($jsonns)) {
			foreach ($jsonns as $key => $value) {
				$ids = $value->id;
				$value1 = $value->value;

				if ($tbl_custom == $ids) {
					return $value1;
				}
			}
		}
	}
}


//Get data  value in custom field from Rto table
if (!function_exists('getCustomDataRto')) {
	function getCustomDataRto($tbl_custom, $userid)
	{
		$userdata = DB::table('tbl_rto_taxes')->where('id', '=', $userid)->first();

		$jsonn = $userdata->custom_field;

		$jsonns = json_decode($jsonn);
		if (!empty($jsonns)) {
			foreach ($jsonns as $key => $value) {
				$ids = $value->id;
				$value1 = $value->value;

				if ($tbl_custom == $ids) {
					return $value1;
				}
			}
		}
	}
}



// Get Currency symbols in all module
if (!function_exists('getCurrencySymbols')) {
	function getCurrencySymbols()
	{

		$setting = DB::table('tbl_settings')->first();
		$id = $setting->currancy;

		$currancy = DB::table('currencies')->where('id', '=', $id)->first();

		if (!empty($currancy)) {
			$symbol = currencyList($currancy->code);
			return html_entity_decode($symbol);
		}
	}
}

// Get Currency symbols in all module
if (!function_exists('getCurrencyCode')) {
	function getCurrencyCode()
	{

		$setting = DB::table('tbl_settings')->first();
		$id = $setting->currancy;

		$currancy = DB::table('currencies')->where('id', '=', $id)->first();

		if (!empty($currancy)) {
			// $symbol = currencyList($currancy->code);
			//  return html_entity_decode($symbol);
			return $currancy->code;
		}
	}
}


// //Get current stock in stock  module
// if (!function_exists('getStockCurrent')) {
// 	function getStockCurrent($id)
// 	{

// 		$product = DB::table('tbl_stock_records')->where('product_id', '=', $id)->first();
// 		$stock = $product->no_of_stoke;

// 		$cellstock = DB::table('tbl_service_pros')->where('product_id', '=', $id)->get()->toArray();
// 		$celltotal = 0;
// 		foreach ($cellstock as $cellstocks) {
// 			$cell_stock = $cellstocks->quantity;
// 			$celltotal += $cell_stock;
// 		}

// 		if (!empty($product)) {
// 			$finalstock = $stock - $celltotal;
// 			return $finalstock;
// 		}
// 	}
// }

// Get current stock in stock  module
if (!function_exists('getStockCurrent')) {
	function getStockCurrent($id)
	{

		$product_stock = DB::table('tbl_stock_records')->where('product_id', '=', $id)->first();
		$full_stock = $product_stock->no_of_stoke;

		$product_service_stocks = DB::table('tbl_service_pros')->where('product_id', '=', $id)->get()->toArray();

		$product_service_total = 0;
		foreach ($product_service_stocks as $product_service_stock) {
			$service_stock = $product_service_stock->quantity;
			$product_service_total += $service_stock;
		}

		$product_sale_stocks = DB::table('tbl_sale_parts')->where('product_id', '=', $id)->get()->toArray();

		$product_sale_total = 0;
		foreach ($product_sale_stocks as $product_sale_stock) {
			$sale_stock = $product_sale_stock->quantity;
			$product_sale_total += $sale_stock;
		}

		$total_full = $product_service_total + $product_sale_total;
		if (!empty($product_stock)) {
			$finalstock = $full_stock - $total_full;
			return $finalstock;
		}
	}
}

// Get  languagechange
if (!function_exists('getLanguageChange')) {
	function getLanguageChange()
	{

		$userid = Auth::User()->id;
		$data = DB::table('users')->where('id', '=', $userid)->first();
		$language = $data->language;

		if (!empty($language)) {
			if ($language == 'en') {
				$language = "English";
				return $language;
			} elseif ($language == 'de') {
				$language = "Spanish";
				return $language;
			} elseif ($language == 'gr') {
				$language = "Greek";
				return $language;
			} elseif ($language == 'ar') {
				$language = "Arabic";
				return $language;
			} elseif ($language == 'ger') {
				$language = "German";
				return $language;
			} elseif ($language == 'pt') {
				$language = "Portuguese";
				return $language;
			} elseif ($language == 'fr') {
				$language = "French";
				return $language;
			} elseif ($language == 'it') {
				$language = "Italian";
				return $language;
			} elseif ($language == 'sv') {
				$language = "Swedish";
				return $language;
			} elseif ($language == 'dt') {
				$language = "Dutch";
				return $language;
			} elseif ($language == 'hi') {
				$language = "Hindi";
				return $language;
			} elseif ($language == 'zhcn') {
				$language = "Chinese";
				return $language;
			} elseif ($language == 'id') {
				$language = "Indonesian";
				return $language;
			} elseif ($language == 'ca') {
				$language = "Catalan";
				return $language;
			} elseif ($language == 'cs') {
				$language = "Czech";
				return $language;
			} elseif ($language == 'da') {
				$language = "Danish";
				return $language;
			} elseif ($language == 'de') {
				$language = "Spanish";
				return $language;
			} elseif ($language == 'dt') {
				$language = "Dutch";
				return $language;
			} elseif ($language == 'et') {
				$language = "Estonian";
				return $language;
			} elseif ($language == 'fa') {
				$language = "Persian";
				return $language;
			} elseif ($language == 'fi') {
				$language = "Finnish";
				return $language;
			} elseif ($language == 'he') {
				$language = "Hebrew";
				return $language;
			} elseif ($language == 'ja') {
				$language = "Japanese";
				return $language;
			} elseif ($language == 'pl') {
				$language = "Polish";
				return $language;
			} elseif ($language == 'ro') {
				$language = "Romanian";
				return $language;
			} elseif ($language == 'ru') {
				$language = "Russian";
				return $language;
			} elseif ($language == 'th') {
				$language = "Thai";
				return $language;
			} elseif ($language == 'tr') {
				$language = "Turkish";
				return $language;
			} elseif ($language == 'vi') {
				$language = "Vietnamese";
				return $language;
			} elseif ($language == "hr") {
				$language = "Croatian";
				return $language;
			} elseif ($language == "hu") {
				$language = "Hungarian";
				return $language;
			} elseif ($language == "lt") {
				$language = "Lithuanian";
				return $language;
			} elseif ($language == "no") {
				$language = "Norwegian";
				return $language;
			} elseif ($language == "gu") {
				$language = "Gujarati";
				return $language;
			} else if ($language == "ta") {
				$language = "Tamil";
				return $language;
			} else if ($language == "ur") {
				$language = "Urdu";
				return $language;
			} else if ($language == 'sl') {
				$langauge = "Slovenian";
				return $langauge;
			} else if ($language == 'be') {
				$language = "Belarusian";
				return $language;
			} else if ($language == 'bg') {
				$langauge = "Bulgarian";
				return $langauge;
			} else if ($language == 'sq') {
				$language = "Albanian";
				return $language;
			} else if ($language == 'sr') {
				$language == 'Serbian';
				return $language;
			} else if ($language == 'sw') {
				$language = "Swahili";
				return $language;
			} else if ($language == "ga") {
				$language = "Irish";
				return $language;
			} else if ($language == 'is') {
				$language = "Icelandic";
				return $language;
			} else if ($language == 'gl') {
				$language = "Galician";
				return $language;
			} else if ($language == 'sk') {
				$language = "Slovak";
				return $language;
			} else if ($language == 'lv') {
				$language = "Latvian";
				return $language;
			} else if ($language == 'ko') {
				$language = "Korean";
				return $language;
			} else if ($language == "mk") {
				$language = "Macedonian";
				return $language;
			} else if ($language == 'ms') {
				$language = "Malay";
				return $language;
			} else if ($language == 'af') {
				$language = "Afrikaans";
				return $language;
			} else if ($language == 'fil') {
				$language = "Filipino";
				return $language;
			}
		}
	}
}

// Get Payment Method  in all module

if (!function_exists('GetPaymentMethod')) {
	function GetPaymentMethod($id)
	{

		$tbl_payments = DB::table('tbl_payments')->where('id', '=', $id)->first();

		if (!empty($tbl_payments)) {
			$payment = $tbl_payments->payment;
			return $payment;
		} else {
			if ($id == '') {
				$payment = '';
				return $payment;
			} else {
				$payment = 'stripe';
				return $payment;
			}
		}
	}
}

// Get Unit  name in Stock module

if (!function_exists('getUnitMeasurement')) {
	function getUnitMeasurement($id)
	{

		$tbl_products = DB::table('tbl_products')->where('id', '=', $id)->get()->toArray();

		if (!empty($tbl_products)) {
			$unit = array();
			foreach ($tbl_products as $tbl_productss) {
				$unit[] = $tbl_productss->unit;
			}

			$tbl_product_units = DB::table('tbl_product_units')->where('id', '=', $unit)->first();
			if (!empty($tbl_product_units)) {
				$name = $tbl_product_units->name;

				return $name;
			} else {
				return '';
			}
		} else {
			return '';
		}
	}
}

// Get  purchase date
if (!function_exists('getPurchaseDate')) {
	function getPurchaseDate($id)
	{

		$tbl_purchases = DB::table('tbl_purchases')->where('id', '=', $id)->first();

		if (!empty($tbl_purchases)) {
			$date = $tbl_purchases->date;
			return $date;
		}
	}
}


// get user Language Code
if (!function_exists('getLangCode')) {
	function getLangCode()
	{
		$userlang = Auth::User()->language;
		return $userlang;
	}
}
if (!function_exists('getUserRole')) {
	function getUserRole()
	{
		$userRole = Auth::User()->role;
		return $userRole;
	}
}

//Get Latest  purchase date
if (!function_exists('getLatestPurchaseDate')) {
	function getLatestPurchaseDate($productId)
	{
		$productData = DB::table('tbl_products')->where('id', '=', $productId)->first();

		if (!empty($productData)) {
			$product_Id = $productData->id;

			$purchaseHistoryData = DB::table('tbl_purchase_history_records')->where('product_id', '=', $product_Id)->latest()->first();

			$tbl_purchases = DB::table('tbl_purchases')->where('id', '=', $purchaseHistoryData->purchase_id)->first();

			$purchaseNo = $tbl_purchases->date;
			return $purchaseNo;
		}

		/*$tbl_purchases = DB::table('tbl_purchases')->where('id','=',$id)->first();

									  if(!empty($tbl_purchases))
									  {
										  $date = $tbl_purchases->date;
										  return $date;
									  }*/
	}
}

// Get PurchaseSupplier
if (!function_exists('getPurchaseSupplier')) {
	function getPurchaseSupplier($id)
	{

		$tbl_purchases = DB::table('tbl_purchases')->where('id', '=', $id)->first();

		if (!empty($tbl_purchases)) {
			$supplier_id = $tbl_purchases->supplier_id;
			return $supplier_id;
		}
	}
}

// Get  purchase date
if (!function_exists('getPurchaseCode')) {
	function getPurchaseCode($id)
	{

		$tbl_purchases = DB::table('tbl_purchases')->where('id', '=', $id)->first();

		if (!empty($tbl_purchases)) {
			$purchase_no = $tbl_purchases->purchase_no;
			return $purchase_no;
		}
	}
}


// Get  purchase code latest
if (!function_exists('getLatestPurchaseCode')) {
	function getLatestPurchaseCode($productId)
	{
		$productData = DB::table('tbl_products')->where('id', '=', $productId)->first();

		if (!empty($productData)) {
			$product_Id = $productData->id;

			$purchaseHistoryData = DB::table('tbl_purchase_history_records')->where('product_id', '=', $product_Id)->latest()->first();

			$tbl_purchases = DB::table('tbl_purchases')->where('id', '=', $purchaseHistoryData->purchase_id)->first();

			$purchaseNo = $tbl_purchases->purchase_no;
			return $purchaseNo;
		}
	}
}
// Get  purchase date
if (!function_exists('getVehicleNumberPlate')) {
	function getVehicleNumberPlate($id)
	{

		$vehicles = DB::table('vehicles')->where('id', '=', $id)->first();

		if (!empty($vehicles)) {
			$numberPlate = $vehicles->number_plate;
			return $numberPlate;
		}
	}
}

// Get  purchase date
if (!function_exists('getVehicleNumberPlateFromService')) {
	function getVehicleNumberPlateFromService($id)
	{

		$tbl_services = DB::table('tbl_services')->where('id', '=', $id)->first();

		if (!empty($tbl_services)) {
			$vehicles = DB::table('vehicles')->where('id', '=', $tbl_services->vehicle_id)->first();
			if (!empty($vehicles)) {
				$numberPlate = $vehicles->number_plate;
				return $numberPlate;
			}
		}
	}
}

// Get purchase vehicle details from sale id
if (!function_exists('getVehicleNumberPlateFromSale')) {
	function getVehicleNumberPlateFromSale($id)
	{

		$tbl_sales = DB::table('tbl_sales')->where('id', '=', $id)->first();

		if (!empty($tbl_sales)) {
			$vehicles = DB::table('vehicles')->where('id', '=', $tbl_sales->vehicle_id)->first();
			if (!empty($vehicles)) {
				$numberPlate = $vehicles->number_plate;
				return $numberPlate;
			}
		}
	}

	// Get Currency code
	if (!function_exists('getCurrencyCode')) {
		function getCurrencyCode()
		{
			$setting = DB::table('tbl_settings')->first();
			$id = $setting->currancy;

			$currancy = DB::table('currencies')->where('id', '=', $id)->first();

			if (!empty($currancy)) {
				$code = $currancy->code;
				return $code;
			}
		}
	}

	//Get Jobcard number with start Q
	if (!function_exists('getQuotationNumber')) {
		function getQuotationNumber($jobcard_no)
		{
			if (!empty($jobcard_no)) {
				$quotationNumber = 'Q' . substr($jobcard_no, 1);
				return $quotationNumber;
			}
		}
	}

	// Get price of Quotation
	if (!function_exists('getTotalPriceOfQuotation')) {
		function getTotalPriceOfQuotation($id)
		{
			$services = DB::table('tbl_services')->where('id', '=', $id)->first();
			$sum1 = 0;
			if (!empty($services)) {
				if ($services->charge != "") {
					$sum1 = $services->charge;
				}
			}

			$services_pros = DB::table('tbl_service_pros')->where('service_id', '=', $id)->get()->toArray();
			$sum2 = 0;
			if (!empty($services_pros)) {
				foreach ($services_pros as $value) {
					if ($value->total_price != "" && $value->chargeable != 0) {
						$sum2 += $value->total_price;
					}
				}
			}

			$sum3 = 0;
			if ($services->mot_status == 1) {
				$sum3 = $services->mot_charge;
			}

			// Calculate total amount without taxes
			$totalAmount = $sum1 + $sum2 + $sum3;
			$service_pro2 = DB::table('tbl_service_pros')->where('service_id', '=', $id)->where('type', '=', 1)->get()->toArray();
			foreach ($service_pro2 as $pro) {
				// Assuming totalPprice is a field in your database table
				$totalAmount += $pro->total_price;
			}

			// Check for washbay and add its price to the total
			$washbay = DB::table('washbays')->where('service_id', '=', $id)->first();
			$totalamountservice = $totalAmount;
			if (!empty($washbay->price)) {
				$total = $washbay->price;
				$totalamountservice = $totalAmount + $total;
			}

			// Calculate taxes
			$total_tax_percent = 0;
			if (!empty($services->tax_id)) {
				$tax_ids = explode(", ", $services->tax_id);

				for ($i = 0; $i < count($tax_ids); $i++) {
					if (!empty($tax_ids[$i])) {
						$current_id = $tax_ids[$i];
						$taxData = DB::table('tbl_account_tax_rates')->where("id", "=", $current_id)->first();
						$tax_percent = $taxData->tax;

						$total_tax_percent += $tax_percent;
					}
				}
			}

			if ($total_tax_percent != 0) {
				$totalTaxAmount = ($totalamountservice * $total_tax_percent) / 100;
				$totalamountservice += $totalTaxAmount;
			}

			return $totalamountservice;
		}
	}


	//Get Observation price fill or not inside table
	if (!function_exists('getObservationPriceFillOrNot')) {
		function getObservationPriceFillOrNot($jobNo)
		{
			$tbl_services = DB::table('tbl_services')->where('job_no', '=', $jobNo)->first();
			$getServiceId = $tbl_services->id;

			$tbl_service_pro_datas = DB::table('tbl_service_pros')->where('service_id', '=', $getServiceId)->get()->toArray();

			$response = false;

			if (!empty($tbl_service_pro_datas)) {
				foreach ($tbl_service_pro_datas as $tbl_service_pro_data) {
					if ($tbl_service_pro_data->total_price != null) {
						return $response = true;
					}
				}
			}
			return $response;
		}
	}


	//Get customer company name
	if (!function_exists('getCustomerCompanyName')) {
		function getCustomerCompanyName($id)
		{
			$customer = DB::table('users')->where([['id', '=', $id], ['role', '=', 'Customer']])->first();
			if (!empty($customer)) {
				return $customer->company_name;
			}
		}
	}


	//Get vehicle number plate
	if (!function_exists('getVehicleNumberPlate')) {
		function getVehicleNumberPlate($id)
		{
			$vehicle = DB::table('vehicles')->where('id', '=', $id)->first();
			if (!empty($vehicle)) {
				return $vehicle->number_plate;
			}
		}
	}


	//Get tax id from tax table
	if (!function_exists('getTaxPercentFromTaxTable')) {
		function getTaxPercentFromTaxTable($id)
		{
			$tax = DB::table('tbl_account_tax_rates')->where("id", "=", $id)->first();

			if (!empty($tax)) {
				return $tax->tax;
			}
		}
	}

	//Get tax name from tax table
	if (!function_exists('getTaxNameFromTaxTable')) {
		function getTaxNameFromTaxTable($id)
		{
			$tax = DB::table('tbl_account_tax_rates')->where("id", "=", $id)->first();

			if (!empty($tax)) {
				return $tax->taxname;
			}
		}
	}


	//Get tax percent and name from tax table
	if (!function_exists('getTaxNameAndPercentFromTaxTable')) {
		function getTaxNameAndPercentFromTaxTable($id)
		{
			$tax = DB::table('tbl_account_tax_rates')->where("id", "=", $id)->first();

			if (!empty($tax)) {
				return $tax->taxname . " " . $tax->tax;
			}
		}
	}

	//Get tax number from tax table
	if (!function_exists('getTaxNumberFromTaxTable')) {
		function getTaxNumberFromTaxTable($id)
		{
			$tax = DB::table('tbl_account_tax_rates')->where("id", "=", $id)->first();

			if (!empty($tax)) {
				return $tax->tax_number;
			}
		}
	}

	// Get User FullName
	if (!function_exists('getUserFullName')) {
		function getUserFullName($id)
		{
			$users = DB::table('users')->where('id', '=', $id)->first();
			if (!empty($users)) {
				$user_name = $users->name . " " . $users->lastname;
				return $user_name;
			}
		}
	}

	//Get getRadiolabelsList form add time for all modules
	if (!function_exists('getRadiolabelsList')) {
		function getRadiolabelsList($id)
		{
			$radioLabeltsData = DB::table('tbl_custom_fields')->where('id', '=', $id)->first();

			$radioLabelArray = array();
			if (!empty($radioLabeltsData)) {
				$radioLabelArray = json_decode($radioLabeltsData->radio_labels);
				return $radioLabelArray;
			}
		}
	}


	//Get getRadiolabelsListValue for form edit time for all users modules
	if (!function_exists('getRadioLabelValueForUpdate')) {
		function getRadioLabelValueForUpdate($userid, $customFiledTableId)
		{
			$userdata = DB::table('users')->where('id', '=', $userid)->first();
			$jsonn = $userdata->custom_field;

			$jsonns = json_decode($jsonn);
			if (!empty($jsonns)) {
				foreach ($jsonns as $key => $value) {
					$ids = $value->id;
					$value1 = $value->value;

					if ($ids == $customFiledTableId) {
						return $value1;
					}
				}
			}
		}
	}


	//Get getRadioSelectedValue for form view page for all modules
	if (!function_exists('getRadioSelectedValue')) {
		function getRadioSelectedValue($tbl_custom_field_id, $datavalue)
		{
			$radioLabeltsData = DB::table('tbl_custom_fields')->where('id', '=', $tbl_custom_field_id)->first();

			$radioLabelArray = "";
			if (!empty($radioLabeltsData)) {
				$radioLabelArray = json_decode($radioLabeltsData->radio_labels);

				foreach ($radioLabelArray as $key => $value) {
					if ($key == $datavalue) {
						return $value;
					}
				}
			}
		}
	}

	//Get getCheckboxlabelsList for all modules
	if (!function_exists('getCheckboxLabelsList')) {
		function getCheckboxLabelsList($id)
		{
			$checkboxLabeltsData = DB::table('tbl_custom_fields')->where('id', '=', $id)->first();

			$checkboxLabelArray = array();
			if (!empty($checkboxLabeltsData)) {
				$checkboxLabelArray = json_decode($checkboxLabeltsData->checkbox_labels);
				return $checkboxLabelArray;
			}
		}
	}

	//Get getCheckboxLabelValueForUpdate for edit time for user module
	if (!function_exists('getCheckboxLabelValueForUpdate')) {
		function getCheckboxLabelValueForUpdate($userid, $customFiledTableId)
		{
			$userdata = DB::table('users')->where('id', '=', $userid)->first();
			$jsonn = $userdata->custom_field;

			$jsonns = json_decode($jsonn);
			if (!empty($jsonns)) {
				foreach ($jsonns as $key => $value) {
					$ids = $value->id;
					$value1 = $value->value;

					if ($ids == $customFiledTableId) {
						//echo $value1;
						$add_one_in = explode(",", $value1);
						return $add_one_in;
					}
				}
			}
		}
	}

	//Get getCheckboxLabelValueForUpdate for edit time for user module
	if (!function_exists('getCheckboxVal')) {
		function getCheckboxVal($userid, $customFiledTableId, $val)
		{
			$userdata = DB::table('users')->where('id', '=', $userid)->first();
			$jsonn = $userdata->custom_field;

			$jsonns = json_decode($jsonn);
			if (!empty($jsonns)) {
				foreach ($jsonns as $key => $value) {
					$ids = $value->id;
					$value1 = $value->value;

					if ($ids == $customFiledTableId) {
						//echo $value1;
						$add_one_in = explode(",", $value1);
						if (!empty($add_one_in)) {
							foreach ($add_one_in as $key => $value) {
								if ($val == $value) {
									return $value;
								}
							}
						} else {
							return "";
						}
					}
				}
			}
		}
	}


	//Get getRadioLabelValueForUpdateForAllModules for form edit time for all modules
	if (!function_exists('getRadioLabelValueForUpdateForAllModules')) {
		function getRadioLabelValueForUpdateForAllModules($formName, $dataId, $customFiledTableId)
		{
			$customDdata = "";
			$jsonn = "";
			if ($formName == 'product') {
				$customDdata = DB::table('tbl_products')->where('id', '=', $dataId)->first();
				$jsonn = $customDdata->custom_field;
			} else if ($formName == 'purchase') {
				$customDdata = DB::table('tbl_purchases')->where('id', '=', $dataId)->first();
				$jsonn = $customDdata->custom_field;
			} else if ($formName == 'vehicle') {
				$customDdata = DB::table('vehicles')->where('id', '=', $dataId)->first();
				$jsonn = $customDdata->custom_field;
			} else if ($formName == 'vehicletype') {
				$customDdata = DB::table('tbl_vehicle_types')->where('id', '=', $dataId)->first();
				$jsonn = $customDdata->custom_field;
			} else if ($formName == 'vehiclebrand') {
				$customDdata = DB::table('tbl_vehicle_brands')->where('id', '=', $dataId)->first();
				$jsonn = $customDdata->custom_field;
			} else if ($formName == 'color') {
				$customDdata = DB::table('tbl_colors')->where('id', '=', $dataId)->first();
				$jsonn = $customDdata->custom_field;
			} else if ($formName == 'service') {
				$customDdata = DB::table('tbl_services')->where('id', '=', $dataId)->first();
				$jsonn = $customDdata->custom_field;
			} else if ($formName == 'invoice') {
				$customDdata = DB::table('tbl_invoices')->where('id', '=', $dataId)->first();
				$jsonn = $customDdata->custom_field;
			} else if ($formName == 'income') {
				$customDdata = DB::table('tbl_incomes')->where('id', '=', $dataId)->first();
				$jsonn = $customDdata->custom_field;
			} else if ($formName == 'expense') {
				$customDdata = DB::table('tbl_expenses')->where('id', '=', $dataId)->first();
				$jsonn = $customDdata->custom_field;
			} else if ($formName == 'sales') {
				$customDdata = DB::table('tbl_sales')->where('id', '=', $dataId)->first();
				$jsonn = $customDdata->custom_field;
			} else if ($formName == 'salepart') {
				$customDdata = DB::table('tbl_sale_parts')->where('id', '=', $dataId)->first();
				$jsonn = $customDdata->custom_field;
			} else if ($formName == 'rto') {
				$customDdata = DB::table('tbl_rto_taxes')->where('id', '=', $dataId)->first();
				$jsonn = $customDdata->custom_field;
			}

			$jsonns = json_decode($jsonn);
			if (!empty($jsonns)) {
				foreach ($jsonns as $key => $value) {
					$ids = $value->id;
					$value1 = $value->value;

					if ($ids == $customFiledTableId) {
						return $value1;
					}
				}
			}
		}
	}


	//Get getCheckboxLabelValueForUpdateForAllModules for edit time for user module
	if (!function_exists('getCheckboxLabelValueForUpdateForAllModules')) {
		function getCheckboxLabelValueForUpdateForAllModules($formName, $dataId, $customFiledTableId)
		{
			$customDdata = "";
			$jsonn = "";
			if ($formName == 'product') {
				$customDdata = DB::table('tbl_products')->where('id', '=', $dataId)->first();
				$jsonn = $customDdata->custom_field;
			} else if ($formName == 'purchase') {
				$customDdata = DB::table('tbl_purchases')->where('id', '=', $dataId)->first();
				$jsonn = $customDdata->custom_field;
			} else if ($formName == 'vehicle') {
				$customDdata = DB::table('vehicles')->where('id', '=', $dataId)->first();
				$jsonn = $customDdata->custom_field;
			} else if ($formName == 'vehicletype') {
				$customDdata = DB::table('tbl_vehicle_types')->where('id', '=', $dataId)->first();
				$jsonn = $customDdata->custom_field;
			} else if ($formName == 'vehiclebrand') {
				$customDdata = DB::table('tbl_vehicle_brands')->where('id', '=', $dataId)->first();
				$jsonn = $customDdata->custom_field;
			} else if ($formName == 'color') {
				$customDdata = DB::table('tbl_colors')->where('id', '=', $dataId)->first();
				$jsonn = $customDdata->custom_field;
			} else if ($formName == 'service') {
				$customDdata = DB::table('tbl_services')->where('id', '=', $dataId)->first();
				$jsonn = $customDdata->custom_field;
			} else if ($formName == 'invoice') {
				$customDdata = DB::table('tbl_invoices')->where('id', '=', $dataId)->first();
				$jsonn = $customDdata->custom_field;
			} else if ($formName == 'income') {
				$customDdata = DB::table('tbl_incomes')->where('id', '=', $dataId)->first();
				$jsonn = $customDdata->custom_field;
			} else if ($formName == 'expense') {
				$customDdata = DB::table('tbl_expenses')->where('id', '=', $dataId)->first();
				$jsonn = $customDdata->custom_field;
			} else if ($formName == 'sales') {
				$customDdata = DB::table('tbl_sales')->where('id', '=', $dataId)->first();
				$jsonn = $customDdata->custom_field;
			} else if ($formName == 'salepart') {
				$customDdata = DB::table('tbl_sale_parts')->where('id', '=', $dataId)->first();
				$jsonn = $customDdata->custom_field;
			} else if ($formName == 'rto') {
				$customDdata = DB::table('tbl_rto_taxes')->where('id', '=', $dataId)->first();
				$jsonn = $customDdata->custom_field;
			}

			$jsonns = json_decode($jsonn);
			if (!empty($jsonns)) {
				foreach ($jsonns as $key => $value) {
					$ids = $value->id;
					$value1 = $value->value;

					if ($ids == $customFiledTableId) {
						//echo $value1;
						$add_one_in = explode(",", $value1);
						return $add_one_in;
					}
				}
			}
		}
	}

	//Get getCheckboxValForAllModule for edit time for all module
	if (!function_exists('getCheckboxValForAllModule')) {
		function getCheckboxValForAllModule($formName, $dataId, $customFiledTableId, $val)
		{
			$customDdata = "";
			$jsonn = "";
			if ($formName == 'product') {
				$customDdata = DB::table('tbl_products')->where('id', '=', $dataId)->first();
				$jsonn = $customDdata->custom_field;
			} else if ($formName == 'purchase') {
				$customDdata = DB::table('tbl_purchases')->where('id', '=', $dataId)->first();
				$jsonn = $customDdata->custom_field;
			} else if ($formName == 'vehicle') {
				$customDdata = DB::table('vehicles')->where('id', '=', $dataId)->first();
				$jsonn = $customDdata->custom_field;
			} else if ($formName == 'vehicletype') {
				$customDdata = DB::table('tbl_vehicle_types')->where('id', '=', $dataId)->first();
				$jsonn = $customDdata->custom_field;
			} else if ($formName == 'vehiclebrand') {
				$customDdata = DB::table('tbl_vehicle_brands')->where('id', '=', $dataId)->first();
				$jsonn = $customDdata->custom_field;
			} else if ($formName == 'color') {
				$customDdata = DB::table('tbl_colors')->where('id', '=', $dataId)->first();
				$jsonn = $customDdata->custom_field;
			} else if ($formName == 'service') {
				$customDdata = DB::table('tbl_services')->where('id', '=', $dataId)->first();
				$jsonn = $customDdata->custom_field;
			} else if ($formName == 'invoice') {
				$customDdata = DB::table('tbl_invoices')->where('id', '=', $dataId)->first();
				$jsonn = $customDdata->custom_field;
			} else if ($formName == 'income') {
				$customDdata = DB::table('tbl_incomes')->where('id', '=', $dataId)->first();
				$jsonn = $customDdata->custom_field;
			} else if ($formName == 'expense') {
				$customDdata = DB::table('tbl_expenses')->where('id', '=', $dataId)->first();
				$jsonn = $customDdata->custom_field;
			} else if ($formName == 'sales') {
				$customDdata = DB::table('tbl_sales')->where('id', '=', $dataId)->first();
				$jsonn = $customDdata->custom_field;
			} else if ($formName == 'salepart') {
				$customDdata = DB::table('tbl_sale_parts')->where('id', '=', $dataId)->first();
				$jsonn = $customDdata->custom_field;
			} else if ($formName == 'rto') {
				$customDdata = DB::table('tbl_rto_taxes')->where('id', '=', $dataId)->first();
				$jsonn = $customDdata->custom_field;
			}

			$jsonns = json_decode($jsonn);
			if (!empty($jsonns)) {
				foreach ($jsonns as $key => $value) {
					$ids = $value->id;
					$value1 = $value->value;

					if ($ids == $customFiledTableId) {
						//echo $value1;
						$add_one_in = explode(",", $value1);
						if (!empty($add_one_in)) {
							foreach ($add_one_in as $key => $value) {
								if ($val == $value) {
									return $value;
								}
							}
						} else {
							return "";
						}
					}
				}
			}
		}
	}


	//Get getUnpaidInvoice invoice number from tbl_invoices
	if (!function_exists('getUnpaidInvoice')) {
		function getUnpaidInvoice($invoiceNumber)
		{
			$invoiceData = DB::table('tbl_invoices')->where('invoice_number', '=', $invoiceNumber)->first();

			if (!empty($invoiceData)) {
				if ($invoiceData->grand_total == $invoiceData->paid_amount || $invoiceData->grand_total == 0) {
					return false;
				} else {
					return true;
				}
			} else {
				return false;
			}
		}
	}


	function currencyList($key = null)
	{
		$currency_symbols = array(
			'AED' => '&#1583;.&#1573;', // ?
			'AFN' => '&#65;&#102;',
			'ALL' => '&#76;&#101;&#107;',
			'AMD' => '',
			'ANG' => '&#402;',
			'AOA' => '&#75;&#122;', // ?
			'ARS' => '&#36;',
			'AUD' => '&#36;',
			'AWG' => '&#402;',
			'AZN' => '&#1084;&#1072;&#1085;',
			'BAM' => '&#75;&#77;',
			'BBD' => '&#36;',
			'BDT' => '&#2547;', // ?
			'BGN' => '&#1083;&#1074;',
			'BHD' => '.&#1583;.&#1576;', // ?
			'BIF' => '&#70;&#66;&#117;', // ?
			'BMD' => '&#36;',
			'BND' => '&#36;',
			'BOB' => '&#36;&#98;',
			'BRL' => '&#82;&#36;',
			'BSD' => '&#36;',
			'BTN' => '&#78;&#117;&#46;', // ?
			'BWP' => '&#80;',
			'BYR' => '&#112;&#46;',
			'BZD' => '&#66;&#90;&#36;',
			'CAD' => '&#36;',
			'CDF' => '&#70;&#67;',
			'CHF' => '&#67;&#72;&#70;',
			'CLF' => '', // ?
			'CLP' => '&#36;',
			'CNY' => '&#165;',
			'COP' => '&#36;',
			'CRC' => '&#8353;',
			'CUP' => '&#8396;',
			'CVE' => '&#36;', // ?
			'CZK' => '&#75;&#269;',
			'DJF' => '&#70;&#100;&#106;', // ?
			'DKK' => '&#107;&#114;',
			'DOP' => '&#82;&#68;&#36;',
			'DZD' => '&#1583;&#1580;', // ?
			'EGP' => '&#163;',
			'ETB' => '&#66;&#114;',
			'EUR' => '&#8364;',
			'FJD' => '&#36;',
			'FKP' => '&#163;',
			'GBP' => '&#163;',
			'GEL' => '&#4314;', // ?
			'GHS' => '&#162;',
			'GIP' => '&#163;',
			'GMD' => '&#68;', // ?
			'GNF' => '&#70;&#71;', // ?
			'GTQ' => '&#81;',
			'GYD' => '&#36;',
			'HKD' => '&#36;',
			'HNL' => '&#76;',
			'HRK' => '&#107;&#110;',
			'HTG' => '&#71;', // ?
			'HUF' => '&#70;&#116;',
			'IDR' => '&#82;&#112;',
			'ILS' => '&#8362;',
			'INR' => '&#8377;',
			'IQD' => '&#1593;.&#1583;', // ?
			'IRR' => '&#65020;',
			'ISK' => '&#107;&#114;',
			'JEP' => '&#163;',
			'JMD' => '&#74;&#36;',
			'JOD' => '&#74;&#68;', // ?
			'JPY' => '&#165;',
			'KES' => '&#75;&#83;&#104;', // ?
			'KGS' => '&#1083;&#1074;',
			'KHR' => '&#6107;',
			'KMF' => '&#67;&#70;', // ?
			'KPW' => '&#8361;',
			'KRW' => '&#8361;',
			'KWD' => '&#1583;.&#1603;', // ?
			'KYD' => '&#36;',
			'KZT' => '&#1083;&#1074;',
			'LAK' => '&#8365;',
			'LBP' => '&#163;',
			'LKR' => '&#8360;',
			'LRD' => '&#36;',
			'LSL' => '&#76;', // ?
			'LTL' => '&#76;&#116;',
			'LVL' => '&#76;&#115;',
			'LYD' => '&#1604;.&#1583;', // ?
			'MAD' => '&#1583;.&#1605;.', //?
			'MDL' => '&#76;',
			'MGA' => '&#65;&#114;', // ?
			'MKD' => '&#1076;&#1077;&#1085;',
			'MMK' => '&#75;',
			'MNT' => '&#8366;',
			'MOP' => '&#77;&#79;&#80;&#36;', // ?
			'MRO' => '&#85;&#77;', // ?
			'MUR' => '&#8360;', // ?
			'MVR' => '.&#1923;', // ?
			'MWK' => '&#77;&#75;',
			'MXN' => '&#36;',
			'MYR' => '&#82;&#77;',
			'MZN' => '&#77;&#84;',
			'NAD' => '&#36;',
			'NGN' => '&#8358;',
			'NIO' => '&#67;&#36;',
			'NOK' => '&#107;&#114;',
			'NPR' => '&#8360;',
			'NZD' => '&#36;',
			'OMR' => '&#65020;',
			'PAB' => '&#66;&#47;&#46;',
			'PEN' => '&#83;&#47;&#46;',
			'PGK' => '&#75;', // ?
			'PHP' => '&#8369;',
			'PKR' => '&#8360;',
			'PLN' => '&#122;&#322;',
			'PYG' => '&#71;&#115;',
			'QAR' => '&#65020;',
			'RON' => '&#108;&#101;&#105;',
			'RSD' => '&#1044;&#1080;&#1085;&#46;',
			'RUB' => '&#1088;&#1091;&#1073;',
			'RWF' => '&#1585;.&#1587;',
			'SAR' => '&#65020;',
			'SBD' => '&#36;',
			'SCR' => '&#8360;',
			'SDG' => '&#163;', // ?
			'SEK' => '&#107;&#114;',
			'SGD' => '&#36;',
			'SHP' => '&#163;',
			'SLL' => '&#76;&#101;', // ?
			'SOS' => '&#83;',
			'SRD' => '&#36;',
			'STD' => '&#68;&#98;', // ?
			'SVC' => '&#36;',
			'SYP' => '&#163;',
			'SZL' => '&#76;', // ?
			'THB' => '&#3647;',
			'TJS' => '&#84;&#74;&#83;', // ? TJS (guess)
			'TMT' => '&#109;',
			'TND' => '&#1583;.&#1578;',
			'TOP' => '&#84;&#36;',
			'TRY' => '&#8356;', // New Turkey Lira (old symbol used)
			'TRL' => '&#163;',
			'TTD' => '&#36;',
			'TWD' => '&#78;&#84;&#36;',
			'TZS' => 'Sh',
			'UAH' => '&#8372;',
			'UGX' => '&#85;&#83;&#104;',
			'USD' => '&#36;',
			'UYU' => '&#36;&#85;',
			'UZS' => '&#1083;&#1074;',
			'VEF' => '&#66;&#115;',
			'VND' => '&#8363;',
			'VUV' => '&#86;&#84;',
			'WST' => '&#87;&#83;&#36;',
			'XAF' => '&#70;&#67;&#70;&#65;',
			'XCD' => '&#36;',
			'XDR' => '',
			'XOF' => '',
			'XPF' => '&#70;',
			'YER' => '&#65020;',
			'ZAR' => '&#82;',
			'ZMK' => '&#90;&#75;', // ?
			'ZWL' => '&#90;&#36;',
		);
		if ($key != null) {
			return $currency_symbols[$key];
		} else {
			return $currency_symbols;
		}
	}

	//get branch name from ID
	if (!function_exists('getBranchName')) {
		function getBranchName($id)
		{

			$branch = DB::table('branches')->where('id', '=', $id)->first();

			if (!empty($branch)) {
				$branch_name = $branch->branch_name;

				return $branch_name;
			}
		}
	}

	// Get curret sysyem local
	if (!function_exists('getCurrentLocal')) {
		function getCurrentLocal()
		{
			$userid = Auth::User()->id;
			$data = DB::table('users')->where('id', '=', $userid)->first();

			if (!empty($data)) {
				return $data->language;
			}
		}
	}

	//Get customer image
	if (!function_exists('getCustomerImage')) {
		function getCustomerImage($id)
		{
			$customer = DB::table('users')->where([['id', '=', $id]])->first();
			if (!empty($customer)) {
				$image = $customer->image;
				return $image;
			}
		}
	}

	// Get  purchase date
	if (!function_exists('getPurchaseProducts')) {
		function getPurchaseProducts($id)
		{
			$purchaseDetails = DB::table('tbl_purchase_history_records')->where('purchase_id', '=', $id)->get()->toArray();
			$products = [];

			foreach ($purchaseDetails as $purchaseDetail) {
				$product = getProduct($purchaseDetail->product_id);
				$products[] = $product;
			}
			$name = implode(", ", $products);

			return $name;
		}
	}

	// Get Vehicle type value In vehicle brand module
	if (!function_exists('getModel')) {
		function getModel($id)
		{
			$modelName = DB::table('tbl_model_names')->where('id', '=', $id)->first();
			if (!empty($modelName)) {
				$vehicle_model = $modelName->model_name;

				return $vehicle_model;
			}
		}
	}

	// Get Vehicle model id from name
	if (!function_exists('getModel_id')) {
		function getModel_id($name)
		{
			$model = DB::table('tbl_model_names')->where('model_name', '=', $name)->first();
			if (!empty($model)) {
				$model_id = $model->id;

				return $model_id;
			}
		}
	}

	// Get Manufacturer Name
	if (!function_exists('getManufacturer')) {
		function getManufacturer($id)
		{
			$name = DB::table('tbl_product_types')->where('id', '=', $id)->first();
			if (!empty($name)) {
				$name = $name->type;

				return $name;
			}
		}
	}

	// Get Mobile Number
	if (!function_exists('getMobile')) {
		function getMobile($id)
		{
			$user = DB::table('users')->where('id', '=', $id)->first();

			if (!empty($user)) {
				$mobile = $user->mobile_no;
				return $mobile;
			}
		}
	}

	// Get Frontend booking status
	if (!function_exists('getFrontendBooking')) {
		function getFrontendBooking()
		{
			try {
				$system = DB::table('tbl_settings')->first();
				$status = $system->frontend_service;
				return (int) $status;
			} catch (Exception $e) {
				return 0;
			}
		}
	}

	// Get Edit service
	if (!function_exists('getEditService')) {
		function getEditService()
		{
			$system = DB::table('tbl_settings')->first();
			$status = $system->edit_service;
			return (int) $status;
		}
	}

	// if (!function_exists('saveNotes')) {
	// 	function saveNotes(Model $model, array $notes)
	// 	{
	// 		if ($model->save()) {
	// 			if (!empty($notes)) {
	// 				foreach ($notes as $note) {
	// 					$noteData = [
	// 						'notes' => $note['note_text'] ?? null,
	// 						'internal' => isset($note['internal']) ? 1 : 0,
	// 						'shared_with_customer' => isset($note['shared']) ? 1 : 0,
	// 					];

	// 					// Check if note_id is provided
	// 					if (!empty($note['note_id'])) {
	// 						// Update existing note
	// 						$existingNote = $model->notes()->where('id', $note['note_id'])->first();
	// 						if ($existingNote) {
	// 							$existingNote->update($noteData);
	// 							if (isset($note['note_file'])) {
	// 								foreach ($note['note_file'] as $attachment) {

	// 									$storedPath = $attachment->store('notes'); // Save the file using the storage mechanism
	// 									$filename = basename($storedPath); // Extract the filename
	// 									$storedFilePath = storage_path('app/notes/' . $filename); // Get the full path of the stored file
	// 									$publicPath = public_path('notes/' . $filename); // Move the file to the public directory with the same name
	// 									copy($storedFilePath, $publicPath);

	// 									$note_attachments =  new note_attachments();
	// 									$note_attachments->note_id = $existingNote->id;
	// 									$note_attachments->entity_id = $model->id;
	// 									$note_attachments->attachment = $storedPath;
	// 									$note_attachments->save();
	// 								}
	// 							}
	// 						}
	// 					} else {
	// 						// Create new note
	// 						$noteData['create_by'] = Auth::User()->id;
	// 						$newNote = $model->notes()->create($noteData);
	// 						if (isset($note['note_file'])) {
	// 							foreach ($note['note_file'] as $attachment) {

	// 								$storedPath = $attachment->store('notes');
	// 								$filename = basename($storedPath);
	// 								$storedFilePath = storage_path('app/notes/' . $filename);
	// 								$publicPath = public_path('notes/' . $filename);
	// 								copy($storedFilePath, $publicPath);

	// 								$note_attachments =  new note_attachments();
	// 								$note_attachments->note_id = $newNote->id;
	// 								$note_attachments->entity_id = $model->id;
	// 								$note_attachments->attachment = $storedPath;
	// 								$note_attachments->save();
	// 							}
	// 						}
	// 					}
	// 				}
	// 			}
	// 		}
	// 	}
	// }

	if (!function_exists('saveNotes')) {
		function saveNotes(Model $model, array $notes, ?string $email = null)
		{
			$sharedNotes = [];
			$attachments = [];

			if ($model->save()) {
				if (!empty($notes)) {
					foreach ($notes as $note) {
						$noteData = [
							'notes' => $note['note_text'] ?? null,
							'internal' => isset($note['internal']) ? 1 : 0,
							'shared_with_customer' => isset($note['shared']) ? 1 : 0,
						];

						// Check if note_id is provided
						if (!empty($note['note_id'])) {
							// Update existing note
							$existingNote = $model->notes()->where('id', $note['note_id'])->first();
							if ($existingNote) {
								$existingNote->update($noteData);
								if (isset($note['note_file'])) {
									foreach ($note['note_file'] as $attachment) {
										$originalFilename = $attachment->getClientOriginalName();
										$storedPath = $attachment->storeAs('notes', $originalFilename); // Save the file using the original name
										$publicPath = public_path('notes/' . $originalFilename); // Move the file to the public directory with the same name
										copy(storage_path('app/' . $storedPath), $publicPath);

										$note_attachments = new note_attachments();
										$note_attachments->note_id = $existingNote->id;
										$note_attachments->entity_id = $model->id;
										$note_attachments->attachment = $storedPath;
										$note_attachments->save();

										$attachments[] = $publicPath; // Collect attachment paths
									}
								}

								$attachments = note_attachments::where('note_id', $existingNote->id)->get(); // Fetch attachments associated with the note
								$noteAttachments = []; // Initialize array to hold attachment paths for this note
								foreach ($attachments as $attachment) { // Loop through fetched attachments
									$noteAttachments[] = $attachment->attachment; // Add attachment path to the array
								}
								// Collect shared note data
								if ($noteData['shared_with_customer']) {
									$sharedNoteData = [
										'note' => $noteData,
										'attachments' => $noteAttachments
									];
									$sharedNotes[] = $sharedNoteData;
								}
							}
						} else {
							// Create new note
							$noteData['create_by'] = Auth::User()->id;
							$newNote = $model->notes()->create($noteData);
							if (isset($note['note_file'])) {
								foreach ($note['note_file'] as $attachment) {
									$originalFilename = $attachment->getClientOriginalName();
									$storedPath = $attachment->storeAs('notes', $originalFilename); // Save the file using the original name
									$publicPath = public_path('notes/' . $originalFilename); // Move the file to the public directory with the same name
									copy(storage_path('app/' . $storedPath), $publicPath);

									$note_attachments = new note_attachments();
									$note_attachments->note_id = $newNote->id;
									$note_attachments->entity_id = $model->id;
									$note_attachments->attachment = $storedPath;
									$note_attachments->save();

									$attachments[] = $publicPath; // Collect attachment paths
								}
							}

							$attachments = note_attachments::where('note_id', $newNote->id)->get();
							$noteAttachments = [];
							foreach ($attachments as $attachment) {
								$noteAttachments[] = $attachment->attachment;
							}
							// Collect shared note data
							if ($noteData['shared_with_customer']) {
								$sharedNoteData = [
									'note' => $noteData,
									'attachments' => $noteAttachments
								];
								$sharedNotes[] = $sharedNoteData;
							}
						}
					}

					// Send a single email with all shared notes
					if (!empty($sharedNotes) && $email)
						sendNotesEmail($sharedNotes, $model, $email);
				}
			}
		}
	}

	function sendNotesEmail($sharedNotes, $model, ?string $toEmail = null)
	{
		try {
			// dd($toEmail);
			if (!$toEmail) {
				return; // If email is not provided, do not send the email
			}

			$modelType = class_basename($model); // Get the short class name of the model
			$mail_sub = "New notes for $modelType";
			$emailformat = DB::table('tbl_mail_notifications')->first();
			$mail_send_from = $emailformat->send_from;

			$blade_view = View::make('mail.shared_notes', [
				'sharedNotes' => $sharedNotes,
			])->render();

			// Send email
			Mail::send([], [], function ($message) use ($toEmail, $mail_sub, $blade_view, $mail_send_from) {
				$message->to($toEmail)->subject($mail_sub);
				$message->from($mail_send_from);
				$message->html($blade_view, 'text/html');
			});

			// $actual_link = $_SERVER['HTTP_HOST'];
			// $startip = '0.0.0.0';
			// $endip = '255.255.255.255';

			// if (($actual_link == 'localhost' || $actual_link == 'localhost:8080') || ($actual_link >= $startip && $actual_link <= $endip)) {
			// 	// Local format email
			// 	Mail::send('mail.shared_notes', $data, function ($message) use ($data, $toEmail, $mail_sub) {
			// 		$message->from('noreply@yourdomain.com', 'noreply');
			// 		$message->to($toEmail)->subject($mail_sub);
			// 	});
			// } else {
			// 	// Live format email
			// 	$bodyContent = view('mail.shared_notes', $data)->render();
			// 	$headers = "Content-type: text/html; charset=iso-8859-1\r\n";
			// 	$headers .= 'From: noreply@yourdomain.com' . "\r\n";

			// 	mail($toEmail, $mail_sub, $bodyContent, $headers);
			// }

		} catch (\Exception $e) {
		}
	}
}


if (!function_exists('uploadFile')) {
	function uploadFile($file, $path = '/uploads/file/')
	{
		if (!empty($file)) {
			$filename = time() . $file->getClientOriginalName();
			$file->move(public_path() . $path, $filename);
			return $filename;
		}

		return false;
	}
}


if (!function_exists('checkOrder')) {
	function checkOrder($userId)
	{
		// return App\Models\Order::where('is_check',0)->count();
		return App\Models\Order::where('workshop_id', $userId)->where('is_check', 0)->count();
	}
	// }
}

if (!function_exists('getAmountInWords')) {
    function getAmountInWords($number)
    {
        $no = floor($number);
        $point = round($number - $no, 2) * 100;
        $hundred = null;
        $digits_1 = strlen($no);
        $i = 0;
        $str = array();
        $words = array(
            '0' => '', '1' => 'One', '2' => 'Two',
            '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
            '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
            '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
            '13' => 'Thirteen', '14' => 'Fourteen',
            '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
            '18' => 'Eighteen', '19' => 'Nineteen', '20' => 'Twenty',
            '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
            '60' => 'Sixty', '70' => 'Seventy',
            '80' => 'Eighty', '90' => 'Ninety'
        );
        $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
        while ($i < $digits_1) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += ($divider == 10) ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str[] = ($number < 21) ? $words[$number] .
                    " " . $digits[$counter] . $plural . " " . $hundred
                    :
                    $words[floor($number / 10) * 10]
                    . " " . $words[$number % 10] . " "
                    . $digits[$counter] . $plural . " " . $hundred;
            } else $str[] = null;
        }
        $str = array_reverse($str);
        $result = implode('', $str);
        $points = '';
        if ($point) {
            $points = ($point < 21) ? 
                " and " . $words[$point] . " Paise" : 
                " and " . $words[floor($point / 10) * 10] . " " . $words[$point % 10] . " Paise";
        }
        return $result . $points;
    }
}
