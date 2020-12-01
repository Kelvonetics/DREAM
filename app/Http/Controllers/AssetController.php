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

class AssetController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }


    
    public function index()
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
        
        return view('asset.index')
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

    public function add()
    {
      //ASSET ADD AUTHORIZATION 
      $auth = Auth::user();  
      $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
      $AssetMa = $perm->AssetMa;
      if($AssetMa)
      {
        $assetmakes = DB::table('assetmake')->orderBy('Make', 'asc')->get();
        $assetmodels = DB::table('assetmodel')->orderBy('ModelName', 'asc')->get();
        $departments = DB::table('department')->orderBy('DeptName', 'asc')->get();
        $companylocations = DB::table('companylocation')->orderBy('LocationName', 'asc')->get();
        $fueltypes = DB::table('fueltype')->orderBy('FuelType', 'asc')->get();
        $assettypes = DB::table('assettype')->orderBy('AssetTypeName', 'asc')->get();
        $colors = DB::table('colors')->orderBy('Color', 'asc')->get();
  
        return view('asset.add')
        ->with('assetmake', $assetmakes)
        ->with('assetmodel', $assetmodels)
        ->with('department', $departments)
        ->with('companylocation', $companylocations)
        ->with('fueltype', $fueltypes)
        ->with('assettype', $assettypes)
        ->with('colors', $colors);
      }
      else {  return redirect()->back(); } 
    	
    }

    public function insert(Request $request)
    {
       $this->validate($request, 
        [
            'MakeId' => 'required',
            'ModelId' => 'required',
            'LicensePlate' => 'required',
            'VIN' => 'required',
            'DeptId' => 'required',
            'LocationId' => 'required',
            'EqpYear' => 'required',
            'FuelTypeId' => 'required',
            'AssetTypeId' => 'required',
            'Color' => 'required'
        ]);

       $MakeId = $request->input('MakeId');
       $ModelId = $request->input('ModelId');
       $LicensePlate = $request->input('LicensePlate');
       $VIN = $request->input('VIN');
       $DeptId = $request->input('DeptId');
       $LocationId = $request->input('LocationId');
       $EqpYear = $request->input('EqpYear');
       $FuelTypeId = $request->input('FuelTypeId');
       $AssetTypeId = $request->input('AssetTypeId');
       $Color = $request->input('Color');
       $CreatedBy = $request->input('CreatedBy');
       $Active = $request->input('Active');
       $created = date('Y-M-j');
       $modified = date('Y-M-j');

       $data = array('MakeId' =>$MakeId, 'ModelId' =>$ModelId, 'LicensePlate' =>$LicensePlate, 
       'VIN' =>$VIN, 'DeptId' =>$DeptId, 'LocationId' =>$LocationId, 'EqpYear' =>$EqpYear, 
       'FuelTypeId' =>$FuelTypeId, 'AssetTypeId' =>$AssetTypeId, 'Color' =>$Color, 
       'CreatedBy' =>$CreatedBy, 'Active' =>$Active, 'created' =>$created, 'modified' =>$modified);

       DB::table('asset')->insert($data);

      return redirect()->route('asset.index')->with('info', 'Asset Save Successfully');

    }

    public function view(Request $request, $id)
    {
      //ASSET ADD AUTHORIZATION 
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
        $serviceAppointment = DB::table('schedulemaintenance')->where('AssetId', '=', $id)->orderBy('SchMaintId', 'desc')->take(10)->get();  
        //$schmaintid = $schedulemaintenance->SchMaintId;
        $scmainthcount = DB::table('schedulemaintenance')->where('AssetId', '=', $id)->count(); 
        $schworkshop = DB::table('workshop')->orderBy('WorkShopName', 'desc')->first();
        $workshops = DB::table('workshop')->orderBy('WorkShopName', 'asc')->get();
  
  
        //ASSET PICTURE
        $assetphoto = DB::table('assetattachment')->where('AssetId', '=', $id)->where('Category', '=', 1)->orderBy('AssetAttachId', 'desc')->first();

        //$lastjob = DB::table('job')->where('AssetId', '=', $id)->orderBy('SchMaintId', 'desc')->take(10)->get();
        $lastfuel = DB::table('fuelpurchase')->where('AssetId', '=', $id)->orderBy('FuelId', 'desc')->take(10)->get(); 
          
        return view('asset.view')
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
        ->with('serviceAppointment', $serviceAppointment)
        ->with('scmainthcount', $scmainthcount)
        ->with('schworkshop', $schworkshop)
        ->with('workshops', $workshops)
  
        ->with('assetphoto', $assetphoto)  
        ->with('lastfuel', $lastfuel) 
        
        ->with('id', $id);
      }
      else {  return redirect()->back(); } 

    }

    public function edit($AssetId)
    {
        //ASSET EDIT AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $AssetMa = $perm->AssetMa;
        if($AssetMa)
        {
          $asset = Asset::find($AssetId);
          return view('edit', ['asset' => $asset]);
        }
        else {  return redirect()->back(); } 

    }


    public function update(Request $request, $AssetId)
    {
       $asset = Asset::find($AssetId);       
       /*$this->validate($request, 
       [
           'MakeId' => 'required',
           'ModelId' => 'required',
           'LicensePlate' => 'required',
           'VIN' => 'required',
           'DeptId' => 'required',
           'LocationId' => 'required',
           'EqpYear' => 'required',
           'FuelTypeId' => 'required',
           'AssetTypeId' => 'required',
           'Color' => 'required',
           'CreatedBy' => 'required',
           'Active' => 'required'
       ]);*/

       $data = array(
            'MakeId' => $request->input('MakeId'),
            'ModelId' => $request->input('ModelId'),
            'LicensePlate' => $request->input('LicensePlate'),
            'VIN' => $request->input('VIN'),
            'DeptId' => $request->input('DeptId'),
            'LocationId' => $request->input('LocationId'),
            'EqpYear' => $request->input('EqpYear'),
            'FuelTypeId' => $request->input('FuelTypeId'),
            'AssetTypeId' => $request->input('AssetTypeId'),
            'Color' => $request->input('Color'),
            'CreatedBy' => $request->input('CreatedBy'),
            'Active' => $request->input('Active'),
            //'GPSIMEI' => '',
            'created' => date('Y-M-j'),
            'modified' => date('Y-M-j')
        );

        Asset::where('AssetId', $AssetId)->update($data);
        return redirect()->route('asset.view', ['AssetId' => $AssetId])->with('info', 'Asset Details Updated Successfully');

    }

    
    //PURCHASE SUMMARY

    public function updateSummary(Request $request, $PurchaseId)
    {
       $assetpurchasesummary = Assetpurchasesummary::find($PurchaseId);       
       /*$this->validate($request, 
       [
           'AssetId' => 'required',
           'PurchaseDate' => 'required',
           'PurchasePrice' => 'required',
           'PurchaseOrder' => 'required',
           'AssetCondition' => 'required',
           'DealerId' => 'required',
           'PurchaseMilage' => 'required',
           'DomainId' => 'required',
           'CreatedBy' => 'required',
           'created' => 'required',
           'updated_at' => 'required'
       ]);*/

       $data = array(
            'AssetId' => $request->input('AssetId'),
            'PurchaseDate' => $request->input('PurchaseDate'),
            'PurchasePrice' => $request->input('PurchasePrice'),
            'PurchaseOrder' => $request->input('PurchaseOrder'),
            'AssetCondition' => $request->input('AssetCondition'),
            'DealerId' => $request->input('DealerId'),
            'PurchaseMileage' => $request->input('PurchaseMileage'),
            'DomainId' => $request->input('DomainId'),
            'CreatedBy' => $request->input('CreatedBy'),
            'created' => date('Y-M-j')
        );

        $AssetId = $request->input('AssetId');
        Assetpurchasesummary::where('PurchaseId', $PurchaseId)->update($data);
        return redirect()->route('asset.view', ['AssetId' => $AssetId])->with('info', 'Asset Purchase Summary Details Updated Successfully');

    }



    public function addSummary(Request $request, $AssetId)
    {
      /*$this->validate($request, 
      [
        'Make' => 'required',
        'Active' => 'required',
        'CreatedBy' => 'required',
        'created' => 'required'
      ]);*/

          $AssetId = $AssetId;
          $PurchaseDate = $request->input('PurchaseDate');
          $PurchasePrice = $request->input('PurchasePrice');
          $PurchaseOrder = $request->input('PurchaseOrder');
          $AssetCondition = $request->input('AssetCondition');
          $DealerId = $request->input('DealerId');
          $PurchaseMileage = $request->input('PurchaseMileage');
          $DomainId = $request->input('DomainId');
          $CreatedBy = $request->input('CreatedBy');
          $created = date('Y-M-j');
          $updated_at = date('Y-m-j');

          $data = array('AssetId' =>$AssetId, 'PurchaseDate' =>$PurchaseDate, 'PurchasePrice' =>$PurchasePrice, 'PurchaseOrder' =>$PurchaseOrder, 'AssetCondition' =>$AssetCondition, 'DealerId' =>$DealerId, 'PurchaseMileage' =>$PurchaseMileage, 'DomainId' =>$DomainId, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);          
   
          Assetpurchasesummary::insert($data);
   
         return redirect()->route('asset.view', ['AssetId' => $AssetId])->with('info', 'Asset Purchase Details Saved Successfully');
      
    }


    //ASSET EXPENSE

    public function addAssetExpense(Request $request)
    {
      $this->validate($request, 
      [
        'ExpenseType' => 'required',
        'Description' => 'required',
        'Amount' => 'required',
        'PaidDate' => 'required',
        'Supplier' => 'required',
        'AssetId' => 'required',        
        'name' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20048', 
        'CreatedBy' => 'required'
      ]);

          $ExpenseType = $request->input('ExpenseType');
          $Description = $request->input('Description');
          $Amount = $request->input('Amount');
          $PaidDate = $request->input('PaidDate');
          $Supplier = $request->input('Supplier');
          $AssetId = $request->input('AssetId');
          $name = $request->file('name');
          $CreatedBy = $request->input('CreatedBy');
          $created = date('Y-M-j');
          $updated_at = date('Y-m-j');
          
          $file = time().'.'.$name->getClientOriginalExtension();
          $input['name'] = time().'.'.$name->getClientOriginalExtension();
      
          $destinationPath = public_path('assets/img/expenses');
      
          $name->move($destinationPath, $input['name']);

          $data = array('ExpenseType' =>$ExpenseType, 'Description' =>$Description,'Amount' =>$Amount, 'PaidDate' =>$PaidDate, 'Supplier' =>$Supplier, 'AssetId' =>$AssetId, 'name' =>$file, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);
          
   
          AssetExpense::insert($data);
   
         return redirect()->route('asset.view', ['AssetId' => $AssetId])->with('info', 'Asset Expense Save Successfully');
      
          
      
      
          //$this->postImage->add($input);
    }

    public function addAssetExpenseFromIndex(Request $request)
    {
      $this->validate($request, 
      [
        'ExpenseType' => 'required',
        'Description' => 'required',
        'Amount' => 'required',
        'PaidDate' => 'required',
        'Supplier' => 'required',
        'AssetId' => 'required',        
        'name' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20048', 
        'CreatedBy' => 'required'
      ]);

          $ExpenseType = $request->input('ExpenseType');
          $Description = $request->input('Description');
          $Amount = $request->input('Amount');
          $PaidDate = $request->input('PaidDate');
          $Supplier = $request->input('Supplier');
          $AssetId = $request->input('AssetId');
          $name = $request->file('name');
          $CreatedBy = $request->input('CreatedBy');
          $created = date('Y-M-j');
          $updated_at = date('Y-m-j');
          
          $file = time().'.'.$name->getClientOriginalExtension();
          $input['name'] = time().'.'.$name->getClientOriginalExtension();
      
          $destinationPath = public_path('assets/img/expenses');
      
          $name->move($destinationPath, $input['name']);

          $data = array('ExpenseType' =>$ExpenseType, 'Description' =>$Description,'Amount' =>$Amount, 'PaidDate' =>$PaidDate, 'Supplier' =>$Supplier, 'AssetId' =>$AssetId, 'name' =>$file, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);
          
   
          AssetExpense::insert($data);
   
         return redirect()->route('asset.index')->with('info', 'Asset Expense Save Successfully');
      
          
      
      
          //$this->postImage->add($input);
    }
    


    public function uploadAssetFileFromIndex(Request $request)
    {
      $this->validate($request, 
     [      
        'name' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20048', 
        'AssetId' => 'required', 
        'Category' => 'required',
        'Description' => 'required', 
        'ExpirationDate' => 'required', 
        'CreatedBy' => 'required'
      ]);
         
          $name = $request->file('name');
          $AssetId = $request->input('AssetId');
          $Category = $request->input('Category');
          $Description = $request->input('Description');
          $ExpirationDate = $request->input('ExpirationDate');
          $FileSize = "12345";
          $CreatedBy = $request->input('CreatedBy');
          $created = date('Y-M-j');
          $updated_at = date('Y-m-j');
          
          $file = time().'.'.$name->getClientOriginalExtension();
          $FileType = $name->getClientOriginalExtension();
          //$FileSize = $name->getFileSize();
          
          $input['name'] = time().'.'.$name->getClientOriginalExtension();
      
          $destinationPath = public_path('assets/img/files');
          $name->move($destinationPath, $input['name']);

          $data = array('name' =>$file, 'AssetId' =>$AssetId, 'Category' =>$Category, 'Description' =>$Description, 'ExpirationDate' =>$ExpirationDate, 'FileType' =>$FileType, 'FileSize' =>$FileSize,  'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);
          
   
          Assetattachment::insert($data);
   
         return redirect()->route('asset.index')->with('info', 'Asset File Was Uploaded And Save Successfully');
      
    }

    public function uploadAssetFile(Request $request)
    {
        $this->validate($request, 
        [      
          'name' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20048', 
          'AssetId' => 'required', 
          'Category' => 'required',
          'Description' => 'required', 
          'ExpirationDate' => 'required', 
          'CreatedBy' => 'required'
        ]);
         
          $name = $request->file('name');
          $AssetId = $request->input('AssetId');
          $Category = $request->input('Category');
          $Description = $request->input('Description');
          $ExpirationDate = $request->input('ExpirationDate');
          $FileSize = "12345";
          //$FileType ="jpg";
          $CreatedBy = $request->input('CreatedBy');
          $created = date('Y-M-j');
          $updated_at = date('Y-m-j');
          
          $file = time().'.'.$name->getClientOriginalExtension();
          $FileType = $name->getClientOriginalExtension();
          //$FileSize = $name->getFileSize();
          
          $input['name'] = time().'.'.$name->getClientOriginalExtension();
      
          $destinationPath = public_path('assets/img/files');
          $name->move($destinationPath, $input['name']);

          $data = array('name' =>$file, 'AssetId' =>$AssetId, 'Category' =>$Category, 'Description' =>$Description, 'ExpirationDate' =>$ExpirationDate, 'FileType' =>$FileType, 'FileSize' =>$FileSize, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);
          
   
          Assetattachment::insert($data);
   
         return redirect()->route('asset.view', ['AssetId' => $AssetId])->with('info', 'Asset File Was Uploaded And Save Successfully');
      
    }

    //adding asset notes
    public function addNote(Request $request)
    {
       $this->validate($request, 
        [
            'Notes' => 'required',
            'Id' => 'required',
            'UserId' => 'required',
            'Hide' => 'required',
            'CreatedBy' => 'required'
        ]);

       $Notes = $request->input('Notes');
       $AssetId = $request->input('Id');
       $UserId = $request->input('UserId');
       $Hide = $request->input('Hide');
       $CreatedBy = $request->input('CreatedBy');
       $created = date('Y-M-j');
       $updated_at = date('Y-m-j');

       $data = array('Notes' =>$Notes, 'AssetId' =>$AssetId, 'UserId' =>$UserId, 'Hide' =>$Hide, 
       'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);

       DB::table('assetnotes')->insert($data);

      return redirect()->route('asset.view', ['AssetId' => $AssetId])->with('info', 'Asset Notes Save Successfully');

    }

    public function assignvehicle()
    {  
      //ASSIGN ASSET AUTHORIZATION 
      $auth = Auth::user();  
      $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
      $AssignVe = $perm->AssignVe;
      if($AssignVe)
      {
        return view('asset.assign-vehicle');
      }
      else {  return redirect()->back(); }       
        
    }

    public function availvehicles()
    {        
      //ASSIGN JOB AUTHORIZATION 
      $auth = Auth::user();  
      $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
      $AssignJo = $perm->AssignJo;
      if($AssignJo)
      {
        return view('asset.avail-vehicles');
      }
      else {  return redirect()->back(); } 
    }

    public function addAssignVehicle(Request $request)
    {
      $this->validate($request, 
      [
        'WorkOrderNumber' => 'required',
        'ServiceDate' => 'required',
        'ServiceCompletionDate' => 'required',
        'WorkOrderStatusId' => 'required',
        'AssetId' => 'required',
        'OdometerReading' => 'required',
        'MaintenanceType' => 'required',
        'WorkShopId' => 'required',
        'Comment' => 'required',
        'CreatedBy' => 'required'
      ]);
        
          //INSERT FOR WORKORDER TABLE
          $WorkOrderNumber = $request->input('WorkOrderNumber');
          $ServiceDate = $request->input('ServiceDate');
          $ServiceCompletionDate = $request->input('ServiceCompletionDate');
          $WorkOrderStatusId = $request->input('WorkOrderStatusId');
          $AssetId = $request->input('AssetId');
          $OdometerReading = $request->input('OdometerReading');
          $MaintenanceType = $request->input('MaintenanceType');
          $WorkShopId= $request->input('WorkShopId');
          $Comment = $request->input('Comment');
          $Active = '1';
          $CreatedBy = $request->input('CreatedBy');
          $created = date('Y-M-j');
          $updated_at = date('Y-m-j');

          $data = array('WorkOrderNumber' =>$WorkOrderNumber, 'ServiceDate' =>$ServiceDate, 'ServiceCompletionDate' =>$ServiceCompletionDate, 'WorkOrderStatusId' =>$WorkOrderStatusId,'AssetId' =>$AssetId, 'OdometerReading' =>$OdometerReading, 'MaintenanceType' =>$MaintenanceType,'WorkShopId' =>$WorkShopId, 'Comment' =>$Comment, 'Active' =>$Active, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);          
   
          Workorder::insert($data);
   
         return redirect()->route('asset.index')->with('info', 'New Workorder Created Successfully');
      
    }

    public function insertasset(Request $request)
    {
      $this->validate($request, 
      [
        'AssetId' => 'required',
        'UserId' => 'required',
        'DeptId' => 'required',
        'StartTime' => 'required',
        'EndTime' => 'required',
        'AvailFrom' => 'required',
        'AvailTo' => 'required',
        'CreatedBy' => 'required'
      ]);
        
          //INSERT FOR WORKORDER TABLE
          $AssetId = $request->input('AssetId');
          $UserId = $request->input('UserId');
          $DeptId = $request->input('DeptId');
          $StartTime = $request->input('StartTime');
          $EndTime = $request->input('EndTime');
          $AvailFrom = $request->input('AvailFrom');
          $AvailTo = $request->input('AvailTo');
          $CreatedBy = $request->input('CreatedBy');
          $created = date('Y-M-j');
          $updated_at = date('Y-m-j');

          $data = array('AssetId' =>$AssetId, 'UserId' =>$UserId, 'DeptId' =>$DeptId, 'StartTime' =>$StartTime, 'EndTime' =>$EndTime, 'AvailFrom' =>$AvailFrom, 'AvailTo' =>$AvailTo,  'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);          
   
          Assignasset::insert($data);
   
         return redirect()->route('asset.assignvehicle')->with('info', 'Vehicle Was Assigned Successfully');
      
    }

    public function logFuel()
    {
        return view('asset.log-fuel');
    }

    public function addFuel(Request $request)
    {
      $this->validate($request, 
      [
        'FuelPurchaseDate' => 'required',
        'FuelStation' => 'required',
        'EqpCurrMileage' => 'required',
        'NoLitres' => 'required',
        'FuelCost' => 'required',
        'FullTank' => 'required',
        'AssetId' => 'required',
        'UserId' => 'required',
        'Active' => 'required',
        'CreatedBy' => 'required'
      ]);

          //INSERT FOR FUEL LOG TABLE
          $FuelPurchaseDate = $request->input('FuelPurchaseDate');
          $FuelStation = $request->input('FuelStation');
          $EqpCurrMileage = $request->input('EqpCurrMileage');
          $NoLitres = $request->input('NoLitres');
          $FuelCost = $request->input('FuelCost');
          $FullTank = $request->input('FullTank');
          $AssetId = $request->input('AssetId');
          $UserId= $request->input('UserId');
          $Active = '1';
          $CreatedBy = $request->input('CreatedBy');
          $created = date('Y-M-j');
          $updated_at = date('Y-m-j');

          $data = array('FuelPurchaseDate' =>$FuelPurchaseDate, 'FuelStation' =>$FuelStation, 'EqpCurrMileage' =>$EqpCurrMileage, 'NoLitres' =>$NoLitres,'FuelCost' =>$FuelCost, 'FullTank' =>$FullTank, 'AssetId' =>$AssetId,'UserId' =>$UserId, 'Active' =>$Active, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);          
   
          Fuelpurchase::insert($data);
   
         return redirect()->route('asset.index')->with('info', 'Fuel Logged Successfully');
      
    }


    //UPLOAD ASSET PROFILE PHOTO
    public function uploadProfilePhoto(Request $request)
    { 
          $name = $request->file('name');     
          $AssetId = $request->input('Ass_Id');
          $Description = 'Asset Profile Photo';
          $ExpirationDate = '2020-01-01';
          $FileSize = "12345";
          $Category = '1';
          $CreatedBy = $request->input('CreatedBy');
          $created = date('Y-M-j');
          $updated_at = date('Y-m-j');
          
          $file = time().'.'.$name->getClientOriginalExtension();
          $FileType = $name->getClientOriginalExtension();
          $input['name'] = time().'.'.$name->getClientOriginalExtension();
      
          $destinationPath = public_path('assets/img/assets');
      
          $name->move($destinationPath, $input['name']);

          $data = array('name' =>$file, 'AssetId' =>$AssetId, 'Category' =>$Category, 'Description' =>$Description, 'ExpirationDate' =>$ExpirationDate, 'FileType' =>$FileType, 'FileSize' =>$FileSize,  'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);
          
   
          Assetattachment::insert($data);
          return redirect()->route('asset.view', ['AssetId' => $AssetId])->with('info', 'Asset Profile Photo Saved Successfully');
      
    }

    public function driver_resent_assets($id)
    {
      //ASSET INDEX AUTHORIZATION 
      $auth = Auth::user();  
      $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
      $AssetMa = $perm->AssetMa;
      if($AssetMa)
      {
        $asset = Asset::all();
        $workshop = Workshop::all();
        $user = Users::all();
        $photocategory = DB::table('photocategory')->orderBy('Category', 'asc')->get();
        
        
        $assetmakes = DB::table('assetmake')->orderBy('Make', 'asc')->get();
        $expensetypes = DB::table('expensetype')->get();
        //$resent_assets = DB::table('assignasset')->where('AssetId', '=', $AssetId)->get();
        $resent_assets = DB::table('assignasset')->where('UserId', '=', $id)->get();
        
        return view('asset.driver-resent-assets')
        ->with('assetmakes', $assetmakes)
        ->with('workshop', $workshop)
        ->with('user', $user)
        ->with('expensetypes', $expensetypes)
        ->with('photocategory', $photocategory)
        ->with('asset', $asset)
        ->with('resent_assets', $resent_assets);
      }
      else {  return redirect()->back(); } 
      
    }




}
