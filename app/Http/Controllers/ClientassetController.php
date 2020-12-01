<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Input;
use App\Clientasset;
use App\Client;
use App\Assetmake;
use App\Assetmodel;
use Auth;

class ClientassetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    
    public function index()
    {
        //Client Asset AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $ClientVe = $perm->ClientVe;
        if($ClientVe)
        {
            $assetmakes = Assetmake::orderBy('Make', 'asc')->get();
            $clientassets = Clientasset::all();
            return view('clientasset.index')
            ->with('assetmakes', $assetmakes)
            ->with('clientassets', $clientassets);
        }
        else {  return redirect()->back(); }
        
            
    }

    public function add()
    {
    	//Client Asset AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $ClientVe = $perm->ClientVe;
        if($ClientVe)
        {
            $assetmakes = DB::table('assetmake')->orderBy('Make', 'asc')->get();
            $assetmodels = DB::table('assetmodel')->orderBy('ModelName', 'asc')->get();
            $fueltypes = DB::table('fueltype')->orderBy('FuelType', 'asc')->get();
            $assettypes = DB::table('assettype')->orderBy('AssetTypeName', 'asc')->get();
            $colors = DB::table('colors')->orderBy('Color', 'asc')->get();
            $clients = Client::all();
    
              return view('clientasset.add')
              ->with('assetmake', $assetmakes)
              ->with('assetmodel', $assetmodels)
              ->with('fueltype', $fueltypes)
              ->with('assettype', $assettypes)
              ->with('clients', $clients)
              ->with('colors', $colors);
        }
        else {  return redirect()->back(); }
        
    }

    public function insert(Request $request)
    {
       $this->validate($request, 
        [
            'ClientId' => 'required',
            'MakeId' => 'required',
            'ModelId' => 'required',
            'LicensePlate' => 'required',
            'VIN' => 'required',
            'EqpYear' => 'required',
            'FuelTypeId' => 'required',
            'AssetTypeId' => 'required',
            'Color' => 'required',
            'Active' => 'required'
        ]);

       $ClientId = $request->input('ClientId');
       $MakeId = $request->input('MakeId');
       $ModelId = $request->input('ModelId');
       $LicensePlate = $request->input('LicensePlate');
       $VIN = $request->input('VIN');
       $EqpYear = $request->input('EqpYear');
       $FuelTypeId = $request->input('FuelTypeId');
       $AssetTypeId = $request->input('AssetTypeId');
       $Color = $request->input('Color');
       $Active = $request->input('Active');
       $CreatedBy = $request->input('CreatedBy');
       $created = date('Y-M-j');
       $updated_at = date('Y-m-j');

       $data = array('ClientId' =>$ClientId, 'MakeId' =>$MakeId, 'ModelId' =>$ModelId, 'LicensePlate' =>$LicensePlate, 
       'VIN' =>$VIN, 'EqpYear' =>$EqpYear, 'FuelTypeId' =>$FuelTypeId, 'AssetTypeId' =>$AssetTypeId, 
       'Color' =>$Color, 'Active' =>$Active, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);

       Clientasset::insert($data);

      return redirect()->route('clientasset.index')->with('info', 'Client Asset Save Successfully');

    }

    
    public function edit($AssetId)
    {
        //Client Asset AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $ClientVe = $perm->ClientVe;
        if($ClientVe)
        {
            $clients = Client::all();
            $clientasset = Clientasset::find($AssetId);
            $assetmakes = DB::table('assetmake')->orderBy('Make', 'asc')->get();
            $assetmodels = DB::table('assetmodel')->orderBy('ModelName', 'asc')->get();
            $fueltypes = DB::table('fueltype')->orderBy('FuelType', 'asc')->get();
            $assettypes = DB::table('assettype')->orderBy('AssetTypeName', 'asc')->get();
            $colors = DB::table('colors')->orderBy('Color', 'asc')->get();
    
            return view('clientasset.edit', ['clientasset' => $clientasset])
            ->with('assetmake', $assetmakes)
            ->with('assetmodel', $assetmodels)
            ->with('fueltypes', $fueltypes)
            ->with('assettypes', $assettypes)
            ->with('clients', $clients)
            ->with('color', $colors);
        }
        else {  return redirect()->back(); }
        
    }


    public function update(Request $request, $AssetId)
    {
       $clientasset = Clientasset::find($AssetId);       
       $this->validate($request, 
       [
           'ClientId' => 'required',
           'MakeId' => 'required',
           'ModelId' => 'required',
           'LicensePlate' => 'required',
           'VIN' => 'required',
           'EqpYear' => 'required',
           'FuelTypeId' => 'required',
           'AssetTypeId' => 'required',
           'Color' => 'required'
       ]);

       $data = array(
            'ClientId' => $request->input('ClientId'),
            'MakeId' => $request->input('MakeId'),
            'ModelId' => $request->input('ModelId'),
            'LicensePlate' => $request->input('LicensePlate'),
            'VIN' => $request->input('VIN'),
            'EqpYear' => $request->input('EqpYear'),
            'FuelTypeId' => $request->input('FuelTypeId'),
            'AssetTypeId' => $request->input('AssetTypeId'),
            'Color' => $request->input('Color'),
            'CreatedBy' => $request->input('CreatedBy'),
            'Active' => $request->input('Active'),
            'updated_at' => date('Y-m-j')
        );

        Clientasset::where('AssetId', $AssetId)->update($data);
        return redirect()->route('clientasset.edit', ['AssetId' => $AssetId])->with('info', 'Client Asset Details Updated Successfully');

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
        $clientasset = DB::table('clientasset')->where('AssetId', '=', $id)->first();
        $clientassets = DB::table('clientasset')->orderBy('LicensePlate', 'asc')->get();
        $MakeId = $clientasset->MakeId;
  
        $assetmake = DB::table('assetmake')->where('MakeId', '=', $MakeId)->first();
        $assetmakes = DB::table('assetmake')->orderBy('Make', 'asc')->get();
  
        $assetmodel = DB::table('assetmodel')->where('ModelId', '=', $clientasset->ModelId)->first();
        $assetmodels = DB::table('assetmodel')->orderBy('ModelName', 'asc')->get();
  
        $assettype = DB::table('assettype')->where('AssetTypeId', '=', $clientasset->AssetTypeId)->first();
        $assettypes = DB::table('assettype')->orderBy('AssetTypeName', 'asc')->get();
  
        $fueltype = DB::table('fueltype')->where('FuelTypeId', '=', $clientasset->FuelTypeId)->first();
        $fueltypes = DB::table('fueltype')->orderBy('FuelType', 'asc')->get();
  
        $color = DB::table('colors')->where('Color', '=', $clientasset->Color)->first();
        $colors = DB::table('colors')->orderBy('Color', 'asc')->get();

  
        $assetpurchasesummary = DB::table('clientassetpurchasesummary')->where('AssetId', '=', $id)->first();
        $assetpurchasesummarys = DB::table('clientassetpurchasesummary')->where('AssetCondition', 'asc')->get();
        $purch = DB::table('clientassetpurchasesummary')->where('AssetId', '=', $clientasset->AssetId)->first();
  
        //$autodealer = DB::table('autodealer')->where('DealerId', '=', $assetpurchasesummary->DealerId)->first();
        $autodealers = DB::table('autodealer')->orderBy('DealerName', 'asc')->get();
  
        //ASSET CONDITION
        $assetconditions = DB::table('assetcondition')->orderBy('Condition', 'asc')->get();
  
        //ASSETS EXPENSES
        $assetexpense = DB::table('clientassetexpense')->where('AssetId', '=', $id)->orderBy('ExpenseId', 'desc')->take(10)->get();
        $assetexpenses = DB::table('expensetype')->orderBy('Type', 'asc')->get();
  
        //FILE UPLOADS
        $photocategory = DB::table('photocategory')->orderBy('Category', 'asc')->get();
        $clientassetattachment = DB::table('clientassetattachment')->where('AssetId', '=', $id)->orderBy('AssetAttachId', 'desc')->take(10)->get();
  
        
        @$clientassetavailability = DB::table('clientassetavailability')->where('AssetId', '=', $id)->first();
        @$assetavailid = $clientassetavailability->AssetAvailId;         $workshopid = @$clientassetavailability->VendorId;
        @$assetavailcount = DB::table('clientassetavailability')->where('AssetId', '=', $id)->count();
        //GETTING THE VENDOR ID FOR ASSETAVAILABILITY
        @$assetavailworkid = DB::table('workshop')->where('WorkShopId', '=', $workshopid)->first();
        @$workshop = DB::table('workshop')->orderBy('WorkShopName', 'asc')->get();
  
        //GETTING THE retire ID
        $assetretiredetail = DB::table('clientassetretiredetail')->where('AssetId', '=', $id)->first();
        //$retireid = $assetretiredetail->RetireId;
        $assetretirecount = DB::table('clientassetretiredetail')->where('AssetId', '=', $id)->count();
        //GETTING THE RETIRE REASON FOR ASSET RETIREMENT
        $assetretireid = DB::table('clientassetretiredetail')->where('AssetId', '=', $id)->first();
        $retirereason = DB::table('clientassetretiredetail')->distinct('RetireReason')->orderBy('RetireReason', 'asc')->get();
  
  
        //SERVICE REMINDER DETAILS 
        $schedulemaintenance = DB::table('clientschedulemaintenance')->where('AssetId', '=', $id)->orderBy('SchMaintId', 'desc')->first();  
        $scmainthcount = DB::table('clientschedulemaintenance')->where('AssetId', '=', $id)->count(); 
        $schworkshop = DB::table('workshop')->orderBy('WorkShopName', 'desc')->first();
        $workshops = DB::table('workshop')->orderBy('WorkShopName', 'asc')->get();
  
  
        //ASSET PICTURE
        $assetphoto = DB::table('clientassetattachment')->where('AssetId', '=', $id)->where('Category', '=', 1)->orderBy('AssetAttachId', 'desc')->first();


        $clientfuelpurchases = DB::table('clientfuelpurchase')->where('AssetId', '=', $id)->orderBy('FuelId', 'desc')->get();
        $jobs = DB::table('job')->orderBy('JobId', 'desc')->take(10)->get();
        $User = DB::table('users')->orderBy('FirstName', 'asc')->get();
        $asset = DB::table('clientasset')->where('AssetId', '=', $id)->first();
        $cliented = DB::table('clientasset')->where('AssetId', '=', $id)->first();
        $Clients = DB::table('client')->where('ClientId', '=', $id)->first();
          
        return view('clientasset.view')
        ->with('clientasset', $clientasset)
        ->with('clientassets', $clientassets)
  
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
  
        ->with('assetpurchasesummary', $assetpurchasesummary)
        ->with('assetpurchasesummarys', $assetpurchasesummarys)
        ->with('purch', $purch)
  
        ->with('assetconditions', $assetconditions)
        //->with('autodealer', $autodealer)
        ->with('autodealers', $autodealers)
  
        ->with('assetexpense', $assetexpense)
        ->with('assetexpenses', $assetexpenses)
  
        ->with('photocategory', $photocategory)
        ->with('clientassetattachment', $clientassetattachment)
  
        ->with('clientassetavailability', $clientassetavailability)
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
        ->with('clientfuelpurchases', $clientfuelpurchases) 
        ->with('jobs', $jobs) 
        ->with('User', $User) 
        ->with('asset', $asset) 
        ->with('cliented', $cliented) 
        ->with('Clients', $Clients) 
        
        ->with('id', $id);
      }
      else {  return redirect()->back(); } 

    }


    public function insertPurchaseSummary(Request $request)
    {
       $this->validate($request, 
        [
            'ClientId' => 'required',
            'AssetId' => 'required',
            'PurchaseDate' => 'required',
            'PurchasePrice' => 'required',
            'PurchaseOrder' => 'required',
            'AssetCondition' => 'required',
            'DealerId' => 'required',
            'PurchaseMileage' => 'required',
            'CreatedBy' => 'required'
        ]);

       $ClientId = $request->input('ClientId');
       $AssetId = $request->input('AssetId');
       $PurchaseDate = $request->input('PurchaseDate');
       $PurchasePrice = $request->input('PurchasePrice');
       $PurchaseOrder = $request->input('PurchaseOrder');
       $AssetCondition = $request->input('AssetCondition');
       $DealerId = $request->input('DealerId');
       $PurchaseMileage = $request->input('PurchaseMileage');
       $CreatedBy = $request->input('CreatedBy');
       $created = date('Y-M-j');
       $updated_at = date('Y-m-j');

       $data = array('ClientId' =>$ClientId, 'AssetId' =>$AssetId, 'PurchaseDate' =>$PurchaseDate, 'PurchasePrice' =>$PurchasePrice, 'PurchaseOrder' =>$PurchaseOrder, 'AssetCondition' =>$AssetCondition, 'DealerId' =>$DealerId, 'PurchaseMileage' =>$PurchaseMileage, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);

       DB::table('clientassetpurchasesummary')->insert($data);

      return redirect()->route('clientasset.view', ['AssetId' => $AssetId])->with('info', 'Client Asset Purchase Details Save Successfully');

    }

    public function updatePurchaseSummary(Request $request, $Id)
    {
       $AssetId = $request->input('AssetId');
       $clientasset = Clientasset::find($AssetId);       
       $this->validate($request, 
       [
           'ClientId' => 'required',
           'AssetId' => 'required',
           'PurchaseDate' => 'required',
           'PurchasePrice' => 'required',
           'PurchaseOrder' => 'required',
           'AssetCondition' => 'required',
           'DealerId' => 'required',
           'PurchaseMileage' => 'required',
           'CreatedBy' => 'required'
       ]);

       $data = array(
            'ClientId' => $request->input('ClientId'),
            'AssetId' => $request->input('AssetId'),
            'PurchaseDate' => $request->input('PurchaseDate'),
            'PurchasePrice' => $request->input('PurchasePrice'),
            'PurchaseOrder' => $request->input('PurchaseOrder'),
            'AssetCondition' => $request->input('AssetCondition'),
            'DealerId' => $request->input('DealerId'),
            'PurchaseMileage' => $request->input('PurchaseMileage'),
            'PurchaseMileage' => $request->input('PurchaseMileage'),
            'created' => date('Y-M-j'),
            'updated_at' => date('Y-m-j')
        );

        DB::table('clientassetpurchasesummary')->where('PurchaseId', $Id)->update($data);
        return redirect()->route('clientasset.view', ['AssetId' => $AssetId])->with('info', 'Client Asset Purchase Details Updated Successfully');

    }


    public function insertClientAssetExpense(Request $request)
    {
       $this->validate($request, 
        [
            'ClientId' => 'required',
            'AssetId' => 'required',
            'ExpenseType' => 'required',
            'Description' => 'required',
            'Amount' => 'required',
            'PaidDate' => 'required',
            'Supplier' => 'required',
            'name' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20048', 
            'CreatedBy' => 'required'
        ]);

       $ClientId = '5';
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

       $data = array('ClientId' =>$ClientId, 'ExpenseType' =>$ExpenseType, 'Description' =>$Description,'Amount' =>$Amount, 'PaidDate' =>$PaidDate, 'Supplier' =>$Supplier, 'AssetId' =>$AssetId, 'name' =>$file, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);

       DB::table('clientassetexpense')->insert($data);

    

      return redirect()->route('clientasset.view', ['AssetId' => $AssetId])->with('info', 'Client Asset Expense Details Save Successfully');

    }

    public function insertClientAssetFuel(Request $request)
    {
       $this->validate($request, 
        [
            'ClientId' => 'required',
            'AssetId' => 'required',
            'FuelPurchaseDate' => 'required',
            'FuelStation' => 'required',
            'EqpCurrMileage' => 'required',
            'NoLitres' => 'required',
            'FuelCost' => 'required',
            'FullTank' => 'required', 
            'UserId' => 'required',
            'CreatedBy' => 'required'
        ]);

       $ClientId = $request->input('ClientId');
       $AssetId = $request->input('AssetId');
       $FuelPurchaseDate = $request->input('FuelPurchaseDate');
       $FuelStation = $request->input('FuelStation');
       $EqpCurrMileage = $request->input('EqpCurrMileage');
       $NoLitres = $request->input('NoLitres');
       $FuelCost = $request->input('FuelCost');
       $FullTank = $request->input('FullTank');
       $UserId = $request->input('UserId');
       $CreatedBy = $request->input('CreatedBy');
       $created = date('Y-M-j');
       $updated_at = date('Y-m-j');

       $data = array('ClientId' =>$ClientId, 'AssetId' =>$AssetId, 'FuelPurchaseDate' =>$FuelPurchaseDate, 'FuelStation' =>$FuelStation, 'EqpCurrMileage' =>$EqpCurrMileage, 'NoLitres' =>$NoLitres, 'FuelCost' =>$FuelCost, 'FullTank' =>$FullTank, 'UserId' =>$UserId, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);

       DB::table('clientfuelpurchase')->insert($data);

      return redirect()->route('clientasset.view', ['AssetId' => $AssetId])->with('info', 'Client Asset Fuel Purchase Log Successfully');

    }

    public function uploadClientAssetFile(Request $request)
    {
        $this->validate($request, 
        [      
          'name' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20048', 
          'AssetId' => 'required', 
          'ClientId' => 'required', 
          'Category' => 'required',
          'Description' => 'required', 
          'ExpirationDate' => 'required', 
          'CreatedBy' => 'required'
        ]);
         
          $name = $request->file('name');
          $AssetId = $request->input('AssetId');
          $ClientId = $request->input('ClientId');
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

          $data = array('name' =>$file, 'AssetId' =>$AssetId, 'ClientId' =>$ClientId, 'Category' =>$Category, 'Description' =>$Description, 'ExpirationDate' =>$ExpirationDate, 'FileType' =>$FileType, 'FileSize' =>$FileSize, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);
          
   
          DB::table('clientassetattachment')->insert($data);
   
         return redirect()->route('clientasset.view', ['AssetId' => $AssetId])->with('info', 'Client Asset File Was Uploaded And Save Successfully');
      
    }



    //ASSET AVAILABILITY
    public function insertAvailability(Request $request)
    {
        $AssetId = $request->input('AssetId');
        $ClientId = $request->input('ClientId');
        $StartDate = $request->input('StartDate');
        $EndDate = $request->input('EndDate');
        $VendorId = $request->input('VendorId');
        $WorkOrderId = $request->input('WorkOrderId');
        $Reason = $request->input('Reason');
        $Status = '1';
        $CreatedBy = $request->input('CreatedBy');
        $created = date('Y-M-j');
        $updated_at = date('Y-m-j');

        $data = array('AssetId' =>$AssetId, 'ClientId' =>$ClientId, 'StartDate' =>$StartDate, 'EndDate' =>$EndDate, 'VendorId' =>$VendorId, 'WorkOrderId' =>$WorkOrderId, 'Reason' =>$Reason, 'Status' =>$Status,'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);          

        DB::table('clientassetavailability')->insert($data);

        return redirect()->route('clientasset.view', ['AssetId' => $AssetId])->with('info', 'Client Vehicle Was Put Out Of Service');
      
    }


    public function updateAvailability(Request $request, $AssetAvailId)
    {      
      $data = array(
            'AssetId' => $request->input('AssetId'),
            'ClientId' => $request->input('ClientId'),
            'StartDate' => $request->input('StartDate'),
            'EndDate' => $request->input('EndDate'),
            'VendorId' => $request->input('VendorId'),
            'WorkOrderId' => $request->input('WorkOrderId'),
            'Reason' => $request->input('Reason'),
            'Status' => '1',
            'updated_at' => date('Y-m-j')
        );

        $AssetId = $request->input('AssetId');
        DB::table('clientassetavailability')->where('AssetAvailId', '=', $AssetAvailId)->update($data);
        
        return redirect()->route('clientasset.view', ['AssetId' => $AssetId])->with('info', 'Client Vehicle Was Put Out Of Service');

    }

    public function putBackInService(Request $request, $AssetAvailId)
    {      
      $data = array(
            'EndDate' => $request->input('EndDate'),
            'Status' => '0',
            'updated_at' => date('Y-m-j')
        );

        $AssetId = $request->input('AssetId');
        DB::table('clientassetavailability')->where('AssetAvailId', '=', $AssetAvailId)->update($data);
        
        return redirect()->route('clientasset.view', ['AssetId' => $AssetId])->with('info', 'Client Vehicle  Put Back In Service');

    }



    //RETIRE ASSET
    public function retireClientAsset(Request $request, $id)
    {
          $AssetId = $request->input('AssetId');
          $ClientId = $request->input('ClientId');
          $RetireDate = $request->input('RetireDate');
          $RetireMileage = $request->input('RetireMileage');
          $DisposalMethod = $request->input('DisposalMethod');
          $RetireSalePrice = $request->input('RetireSalePrice');
          $RetireReason = $request->input('RetireReason');
          $RetireComment = $request->input('RetireComment');
          $Status = '1';
          $CreatedBy = $request->input('CreatedBy');
          $created = date('Y-M-j');
          $updated_at = date('Y-m-j');

          $data = array('AssetId' =>$AssetId, 'ClientId' =>$ClientId, 'RetireDate' =>$RetireDate, 'RetireMileage' =>$RetireMileage, 'DisposalMethod' =>$DisposalMethod, 'RetireSalePrice' =>$RetireSalePrice, 'RetireReason' =>$RetireReason, 'RetireComment' =>$RetireComment, 'Status' =>$Status, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);          
   
          DB::table('clientassetretiredetail')->insert($data);

          $data_asset = array(
            'Active' => '0',
            'updated_at' => date('Y-m-j')
        );

        DB::table('clientasset')->where('AssetId', '=', $id)->update($data_asset);
   
         return redirect()->route('clientasset.view', ['AssetId' => $AssetId])->with('info', 'Client Vehicle Has Been Retirement');
      
    }


    // ASSET SCHEDULED MAINTENANCE
    public function insertClientMaintnance(Request $request)
    {
          $AssetId = $request->input('AsId');
          $ClientId = $request->input('ClientId');
          $MileInterval = $request->input('MileInterval');
          $DateInterval = $request->input('DateInterval');
          $LastMaintMile = $request->input('LastMaintMile');
          $LastMaintDate = $request->input('LastMaintDate');
          $DateReminder = $request->input('DateReminder');
          $MileReminder = $request->input('MileReminder');
          $CurrentMile = $request->input('CurrentMile');
          $DueReminderDate = $request->input('DueReminderDate');
          $DueDate = $request->input('DueDate');
          $WorkshopId = $request->input('WorkshopId');
          $CreatedBy = $request->input('CreatedBy');
          $created = date('Y-M-j');
          $updated_at = date('Y-m-j');

          $data = array('AssetId' =>$AssetId, 'ClientId' =>$ClientId, 'MileInterval' =>$MileInterval, 'DateInterval' =>$DateInterval, 'LastMaintMile' =>$LastMaintMile, 'LastMaintDate' =>$LastMaintDate, 'DateReminder' =>$DateReminder, 'MileReminder' =>$MileReminder, 'CurrentMile' =>$CurrentMile, 'DueReminderDate' =>$DueReminderDate, 'DueDate' =>$DueDate, 'WorkshopId' =>$WorkshopId, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);          
   
          DB::table('clientschedulemaintenance')->insert($data);

          $data_asset = array(
            'Active' => '0',
            'updated_at' => date('Y-m-j')
        );

        DB::table('clientasset')->where('AssetId', '=', $AssetId)->update($data_asset);
   
         return redirect()->route('clientasset.view', ['AssetId' => $AssetId])->with('info', 'Client Vehicle Schedule Maintenance Was Updated Successfully');
      
    }

    public function updateClientMaintnance(Request $request, $SchMaintId)
    {      
      $data = array(
            'AssetId' => $request->input('AsId'),
            'ClientId' => $request->input('ClientId'),
            'DateInterval' => $request->input('DateInterval'),
            'LastMaintMile' => $request->input('LastMaintMile'),
            'LastMaintDate' => $request->input('LastMaintDate'),
            'DateReminder' => $request->input('DateReminder'),
            'MileReminder' => $request->input('MileReminder'),
            'CurrentMile' => $request->input('CurrentMile'),
            'DueReminderDate' => $request->input('DueReminderDate'),
            'DueDate' => $request->input('DueDate'),
            'WorkshopId' => $request->input('WorkshopId'),
            //'ClientEmail' => $request->input('ClientEmail'),
            'updated_at' => date('Y-m-j')
        );

        $AssetId = $request->input('AsId');
        DB::table('clientschedulemaintenance')->where('SchMaintId', '=', $SchMaintId)->update($data);
        
        return redirect()->route('clientasset.view', ['AssetId' => $AssetId])->with('info', 'Client Vehicle Schedule Maintenance Was Updated Successfully');

    }

    public function clientAssetProfile(Request $request, $id)
    {  
      //Client Asset AUTHORIZATION 
      $auth = Auth::user();  
      $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
      $ClientPr = $perm->ClientPr;
      if($ClientPr)
      {
          $clientassets = Clientasset::all();
          $clientasset = Clientasset::where('AssetId', '=', $id)->first();

          return view('clientasset.clientAssetProfile')
          ->with('id', $id)
          ->with('clientasset', $clientasset);
      }
      else {  return redirect()->back(); }
      
    }

    public function updateClientAssetProfile(Request $request, $AssetId)
    {   
        $name = $request->file('name');
        $AssetId = $request->input('AssetId');
        $ClientId = $request->input('ClientId');
        $Category = '1';
        $Description = 'Client Asset Profile Photo';
        $ExpirationDate = '2022-01-01';
        $FileSize = "12345";
        //$FileType ="jpg";
        $CreatedBy = $request->input('CreatedBy');
        $created = date('Y-M-j');
        $updated_at = date('Y-m-j');
        
        $file = time().'.'.$name->getClientOriginalExtension();
        $FileType = $name->getClientOriginalExtension();
        //$FileSize = $name->getFileSize();
        
        $input['name'] = time().'.'.$name->getClientOriginalExtension();
    
        $destinationPath = public_path('assets/img/assets');
        $name->move($destinationPath, $input['name']);

        $data = array('name' =>$file, 'AssetId' =>$AssetId, 'ClientId' =>$ClientId, 'Category' =>$Category, 'Description' =>$Description, 'ExpirationDate' =>$ExpirationDate, 'FileType' =>$FileType, 'FileSize' =>$FileSize, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);
        
 
        DB::table('clientassetattachment')->insert($data);

        return redirect()->route('clientasset.view', ['AssetId' => $AssetId])->with('info', 'Client Asset Profile Updated Successfully');

    }

    
}


