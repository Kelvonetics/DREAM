<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Input;
use App\Asset;
use App\Assetpurchasesummary;
use App\AssetExpense;
use App\Assetattachment;
use App\Workshop;
use App\Workorder;
use App\Fuelpurchase;
use App\Users;
use App\Assignasset;
use Auth;
use Charts;
use App\Client;
use App\Clientasset;
use App\Job;


class ReportController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function vehicle()
     {
       //ASSET INDEX AUTHORIZATION 
       $auth = Auth::user();  
       $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
       $AssetMa = $perm->AssetMa;
       if($AssetMa)
       {
         $asset = Asset::all();
         $workshop = Workshop::all();
         $wo_count = DB::table('workorder')->count();     ++$wo_count;
         $user = Users::all();
         $photocategory = DB::table('photocategory')->orderBy('Category', 'asc')->get();
         
         
         $assetmakes = DB::table('assetmake')->orderBy('Make', 'asc')->get();
         $expensetypes = DB::table('expensetype')->get();
         
         return view('report.vehicle')
         ->with('assetmakes', $assetmakes)
         ->with('workshop', $workshop)
         ->with('wo_count', $wo_count)
         ->with('user', $user)
         ->with('expensetypes', $expensetypes)
         ->with('photocategory', $photocategory)
         ->with('asset', $asset);
       }
       else {  return redirect()->back(); } 
       
     }

    
     public function vehicle_report($id)
     {
      //ASSET REPORT AUTHORIZATION 
      $auth = Auth::user();  
      $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
      $AssetMa = $perm->AssetMa;
      if($AssetMa)
      {
        $id = $id;
        $asset = DB::table('asset')->where('AssetId', '=', $id)->first();
        $assets = DB::table('asset')->orderBy('LicensePlate', 'asc')->get();
        $MakeId = $asset->MakeId;
  
        $assetmake = DB::table('assetmake')->where('MakeId', '=', $MakeId)->first();
        $assetmakes = DB::table('assetmake')->orderBy('Make', 'asc')->get();
  
        $assetmodel = DB::table('assetmodel')->where('ModelId', '=', $asset->ModelId)->first();
        $assetmodels = DB::table('assetmodel')->orderBy('ModelName', 'asc')->get();
  
        $assettype = DB::table('assettype')->where('AssetTypeId', '=', $asset->AssetTypeId)->first();
        $assettypes = DB::table('assettype')->orderBy('AssetTypeName', 'asc')->get();
  
        $fueltype = DB::table('fueltype')->where('FuelTypeId', '=', $asset->FuelTypeId)->first();
        $fueltypes = DB::table('fueltype')->orderBy('FuelType', 'asc')->get();
  
        $color = DB::table('colors')->where('Color', '=', $asset->Color)->first();
        $colors = DB::table('colors')->orderBy('Color', 'asc')->get();
  
        $department = DB::table('department')->where('DeptId', '=', $asset->DeptId)->first();
        $departments = DB::table('department')->orderBy('DeptName', 'asc')->get();
  
        $location = DB::table('companylocation')->where('LocationId', '=', $asset->LocationId)->first();
        $locations = DB::table('companylocation')->orderBy('LocationName', 'asc')->get();
  
        $assetpurchasesummary = DB::table('assetpurchasesummary')->where('AssetId', '=', $id)->first();
        $assetpurchasesummarys = DB::table('assetpurchasesummary')->where('AssetCondition', 'asc')->get();
        $purchaseId= DB::table('assetpurchasesummary')->where('AssetId', '=', $asset->AssetId)->first();
  
        //$autodealer = DB::table('autodealer')->where('DealerId', '=', $assetpurchasesummary->DealerId)->first();
        $autodealers = DB::table('autodealer')->orderBy('DealerName', 'asc')->get();
  
        //ASSET CONDITION
        $assetconditions = DB::table('assetcondition')->orderBy('Condition', 'asc')->get();
  
        //ASSETS EXPENSES
        $assetexpense = DB::table('assetexpense')->where('AssetId', '=', $id)->orderBy('ExpenseId', 'desc')->take(10)->get();
        $assetexpenses = DB::table('expensetype')->orderBy('Type', 'asc')->get();
  
        //FILE UPLOADS
        $photocategory = DB::table('photocategory')->orderBy('Category', 'asc')->get();
        $assetattachment = DB::table('assetattachment')->where('AssetId', '=', $id)->orderBy('AssetAttachId', 'desc')->take(10)->get();
  
        
        @$assetavailability = DB::table('assetavailability')->where('AssetId', '=', $id)->first();
        @$assetavailid = $assetavailability->AssetAvailId;         $workshopid = @$assetavailability->VendorId;
        @$assetavailcount = DB::table('assetavailability')->where('AssetId', '=', $id)->count();
        //GETTING THE VENDOR ID FOR ASSETAVAILABILITY
        @$assetavailworkid = DB::table('workshop')->where('WorkShopId', '=', $workshopid)->first();
        @$workshop = DB::table('workshop')->orderBy('WorkShopName', 'asc')->get();
  
        //GETTING THE retire ID
        $assetretiredetail = DB::table('assetretiredetail')->where('AssetId', '=', $id)->first();
        //$retireid = $assetretiredetail->RetireId;
        $assetretirecount = DB::table('assetretiredetail')->where('AssetId', '=', $id)->count();
        //GETTING THE RETIRE REASON FOR ASSET RETIREMENT
        $assetretireid = DB::table('assetretiredetail')->where('AssetId', '=', $id)->first();
        $retirereason = DB::table('assetretiredetail')->distinct('RetireReason')->orderBy('RetireReason', 'asc')->get();
  
  
        //SERVICE REMINDER DETAILS 
        $schedulemaintenance = DB::table('schedulemaintenance')->where('AssetId', '=', $id)->orderBy('SchMaintId', 'desc')->first();  
        //$schmaintid = $schedulemaintenance->SchMaintId;
        $scmainthcount = DB::table('schedulemaintenance')->where('AssetId', '=', $id)->count(); 
        $schworkshop = DB::table('workshop')->orderBy('WorkShopName', 'desc')->first();
        $workshops = DB::table('workshop')->orderBy('WorkShopName', 'asc')->get();
  
  
        //ASSET PICTURE
        $assetphoto = DB::table('assetattachment')->where('AssetId', '=', $id)->where('Category', '=', 1)->orderBy('AssetAttachId', 'desc')->first();



        //FOR VEHICLE REPORTS 
        $data = DB::table('schedulemaintenance')->where('AssetId', '=', $id)->get(['AssetId', 'CurrentMile']);


        //VEHICLE SERVICE CHART
        $vehicle_service_chart = Charts::database(DB::table('schedulemaintenance')
        ->where('AssetId', '=', $id)->get(), 'pie', 'highcharts')
        ->title('Service')
        ->dimensions(800, 350)
        ->responsive(false)
        ->groupBy('MileReminder');

        //VEHICLE JOBS CHART
        $vehicle_job_chart = Charts::database(DB::table('job')->get(), 'bar', 'highcharts')
        ->title('Job')
        ->dimensions(800, 350)
        ->responsive(false)
        ->groupBy('Status');

        //VEHICLE FUEL CHART
        $vehicle_fuel_chart = Charts::database(DB::table('fuelpurchase')
        ->where('AssetId', '=', $id)->get(), 'line', 'highcharts')
        ->title('Fuel')
        ->dimensions(800, 350)
        ->responsive(false)
        ->groupBy('NoLitres');
 


          
        return view('report.vehicle-report')
        ->with('asset', $asset)
        ->with('assets', $assets)
  
        ->with('assetmake', $assetmake)
        ->with('assetmakes', $assetmakes)
  
        ->with('assetmodel', $assetmodel)
        ->with('assetmodels', $assetmodels)
  
        ->with('assettype', $assettype)
        ->with('assettypes', $assettypes)
  
        ->with('fueltype', $fueltype)
        ->with('fueltypes', $fueltypes)
  
        ->with('color', $color)
        ->with('colors', $colors)
  
        ->with('department', $department)
        ->with('departments', $departments)
  
        ->with('location', $location)
        ->with('locations', $locations)
  
        ->with('assetpurchasesummary', $assetpurchasesummary)
        ->with('assetpurchasesummarys', $assetpurchasesummarys)
        ->with('purch', $purchaseId)
  
        ->with('assetconditions', $assetconditions)
        //->with('autodealer', $autodealer)
        ->with('autodealers', $autodealers)
  
        ->with('assetexpense', $assetexpense)
        ->with('assetexpenses', $assetexpenses)
  
        ->with('photocategory', $photocategory)
        ->with('assetattachment', $assetattachment)
  
        ->with('assetavailability', $assetavailability)
        ->with('assetavailid', $assetavailid)
        ->with('assetavailcount', $assetavailcount)
        ->with('assetavailworkid', $assetavailworkid)
        ->with('workshop', $workshop)
  
        ->with('assetretiredetail', $assetretiredetail)
        ->with('assetretirecount', $assetretirecount)
        ->with('assetretireid', $assetretireid)
        ->with('retirereason', $retirereason)
  
        ->with('schedulemaintenance', $schedulemaintenance)
        ->with('scmainthcount', $scmainthcount)
        ->with('schworkshop', $schworkshop)
        ->with('workshops', $workshops)
  
        ->with('assetphoto', $assetphoto) 
        
        ->with('data', $data)  
        ->with('vehicle_service_chart', $vehicle_service_chart)
        ->with('vehicle_job_chart', $vehicle_job_chart)  
        ->with('vehicle_fuel_chart', $vehicle_fuel_chart)
        
        ->with('id', $id);
      }
      else {  return redirect()->back(); } 

     }


     public function job_report()
     {
      //ASSET REPORT AUTHORIZATION 
      $auth = Auth::user();  
      $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
      $AssetMa = $perm->AssetMa;
      if($AssetMa)
      {

        //CLIENT JOBS CHART
        $client_job_chart = Charts::database(DB::table('job')
        ->get(), 'pie', 'highcharts')
        ->title('Client Job')
        ->dimensions(800, 500)
        ->responsive(false)
        ->groupBy('ClientId');


        //TYPE JOBS CHART
        $job_type_chart = Charts::database(DB::table('job')
        ->get(), 'donut', 'highcharts')
        ->title('Job Status')
        ->dimensions(800, 500)
        ->responsive(false)
        ->groupBy('Type');
        
        
        //STATUS JOBS CHART
        $job_status_chart = Charts::database(DB::table('job')
        ->get(), 'bar', 'highcharts')
        ->title('Job Status')
        ->dimensions(800, 500)
        ->responsive(false)
        ->groupBy('Status');

        //CITY JOBS CHART
        $job_city_chart = Charts::database(DB::table('job')
        ->get(), 'line', 'highcharts')
        ->title('Job City')
        ->dimensions(800, 500)
        ->responsive(false)
        ->groupBy('City');

        //STATE JOBS CHART
        $job_state_chart = Charts::database(DB::table('job')
        ->get(), 'area', 'highcharts')
        ->title('Job State')
        ->dimensions(800, 500)
        ->responsive(false)
        ->groupBy('State');


          
        return view('report.job-report')
        ->with('client_job_chart', $client_job_chart)
        ->with('job_type_chart', $job_type_chart)
        ->with('job_status_chart', $job_status_chart)
        ->with('job_city_chart', $job_city_chart)
        ->with('job_state_chart', $job_state_chart);
      }
      else {  return redirect()->back(); } 

     }


     public function data()
     {
         return view('report.data');
     }


     public function report()
     {
        $chart = Charts::database(Clientasset::where('ClientId', '=', '7')->get(), 'pie', 'highcharts')
        ->title('Client Vehicle')
        ->dimensions(1000, 500)
        ->responsive(false)
        ->groupBy('FuelTypeId');
 
         return view('report.report', ['chart' => $chart]);
     }


     public function create()
     {
        
     }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function code()
    {
        return view('report.code');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
