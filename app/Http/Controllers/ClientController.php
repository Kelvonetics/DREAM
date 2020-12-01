<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Input;
use App\Client;
use App\Clientasset;
use App\Clientworkorder;
use App\Clientworkorderitem;
use App\Invoice;
use Auth;

class ClientController extends Controller
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
        $ClientPr = $perm->ClientPr;
        if($ClientPr)
        {
            $clientassets = Clientasset::all();
            $clients = Client::all();
            $assetmakes = DB::table('assetmake')->get();
            $assettypes = DB::table('assettype')->get();
            $fueltypes = DB::table('fueltype')->get();
            $colors = DB::table('colors')->get();
    
            $tot_inv = Invoice::count();   ++$tot_inv;
    
            return view('client.index')
            ->with('clients', $clients)
            ->with('allClient', $clients)
            ->with('assetmakes', $assetmakes)
            ->with('assettypes', $assettypes)
            ->with('fueltypes', $fueltypes)
            ->with('colors', $colors)
            ->with('tot_inv', $tot_inv);
        }
        else {  return redirect()->back(); }
        
    }


    public function add()
    {                
        //Client Asset AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $ClientPr = $perm->ClientPr;
        if($ClientPr)
        {
            $clientassets = Clientasset::all();
            return view('client.add');
        }
        else {  return redirect()->back(); }
       
    }

    public function insert(Request $request)
    {
      $this->validate($request, 
      [
        'FirstName' => 'required',
        'LastName' => 'required',
        'Company' => 'required',
        'Email' => 'required',
        'Phone' => 'required',
        'Address' => 'required',        
        'CreatedBy' => 'required',
      ]);

      $FirstName = $request->input('FirstName');
      $LastName = $request->input('LastName');
      $Company = $request->input('Company');
      $Email = $request->input('Email');
      $Phone = $request->input('Phone');
      $Address = $request->input('Address');
      $Address_2 = $request->input('Address_2');
      $Country = $request->input('Country');
      $State = $request->input('State');
      $City = $request->input('City');
      //$name = $request->file('name');
      $CreatedBy = $request->input('CreatedBy');
      $created = date('Y-M-j');
      $updated_at = date('Y-m-j');
      
      /*$file = time().'.'.$name->getClientOriginalExtension();
      $input['name'] = time().'.'.$name->getClientOriginalExtension();
  
      $destinationPath = public_path('assets/img/clients');
  
      $name->move($destinationPath, $input['name']);*/

      $data = array('FirstName' =>$FirstName, 'LastName' =>$LastName, 'Company' =>$Company, 'Email' =>$Email, 'Phone' =>$Phone, 'Address' =>$Address,'Address_2' =>$Address_2, 'Country' =>$Country, 'State' =>$State, 'City' =>$City, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);          

      Client::insert($data);

     return redirect()->route('client.index')->with('info', 'New Client Save Successfully');
      
    }

    public function edit($ClientId)
    {
        //Client Asset AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $ClientPr = $perm->ClientPr;
        if($ClientPr)
        {
            $clientassets = Clientasset::all();
            $client = Client::find($ClientId);
            return view('client.edit')
            ->with('client', $client);
        }
        else {  return redirect()->back(); }
        
    }

    public function update(Request $request, $ClientId)
    {      
       $this->validate($request, 
       [
           'FirstName' => 'required',
           'LastName' => 'required',
           'Company' => 'required',
           'Email' => 'required',
           'Phone' => 'required',
           'Address' => 'required',
           'CreatedBy' => 'required',
       ]);

       $data = array(
            'FirstName' => $request->input('FirstName'),
            'LastName' => $request->input('LastName'),
            'Company' => $request->input('Company'),
            'Email' => $request->input('Email'),
            'Phone' => $request->input('Phone'),
            'Address' => $request->input('Address'),
            'Address_2' => $request->input('Address_2'),
            'State' => $request->input('State'),
            'City' => $request->input('City'),
            'CreatedBy' => $request->input('CreatedBy'),
            'updated_at' => date('Y-m-j')
        );

        Client::where('ClientId', $ClientId)->update($data);
        return redirect()->route('client.view', ['ClientId' => $ClientId])->with('info', 'Client Details Updated Successfully');

    }

    public function view(Request $request, $id)   
    {
        //Client AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $ClientPr = $perm->ClientPr;
        if($ClientPr)
        {
            //$clientassets = Clientasset::all();
            $id = $id;
            $client = Client::where('ClientId', '=', $id)->first();
            $clients = Client::all();
    
            $countrys = DB::table('country')->orderBy('CountryName', 'asc')->get();
        
            $clientassets = Clientasset::where('ClientId', '=', $id)->take(10)->get();
            $client_assets = Clientasset::where('ClientId', '=', $id)->first();
            $clientworkorders = Clientworkorder::where('ClientId', '=', $id)->take(10)->get();
            $invoices = Invoice::where('ClientId', '=', $id)->take(10)->get();
            $clientemails = DB::table('clientemail')->where('ClientId', '=', $id)->take(10)->get();

    
            $assetmakes = DB::table('assetmake')->get();
            $assettypes = DB::table('assettype')->get();
            $fueltypes = DB::table('fueltype')->get();
            $colors = DB::table('colors')->get();
            $tot_inv = Invoice::count();   ++$tot_inv;
    
            $retirereason  = DB::table('retirereason')->get();
            $jobs  = DB::table('job')->where('ClientId', '=', $id)->orderBy('JobId', 'desc')->take(10)->get();
            $clientInvoices  = DB::table('invoice')->where('ClientId', '=', $id)->orderBy('InvoiceId', 'desc')->take(10)->get();
    
            
            return view('client.view')
            ->with('client', $client)
            ->with('clients', $clients)
            ->with('allClient', $clients)
    
            ->with('country', $countrys)
            ->with('countrys', $countrys)
              
            ->with('clientassets', $clientassets)
            ->with('client_assets', $clientassets)
              
              ->with('clientworkorders', $clientworkorders)
            ->with('invoices', $invoices)
            ->with('clientemails', $clientemails)
            ->with('assetmakes', $assetmakes)
            ->with('assettypes', $assettypes)
            ->with('fueltypes', $fueltypes)
            ->with('colors', $colors)
            ->with('tot_inv', $tot_inv)
            ->with('retirereason', $retirereason)
            ->with('jobs', $jobs)
            ->with('clientInvoices', $clientInvoices)
    
              ->with('id', $id);
        }
        else {  return redirect()->back(); }
        
    }


    //adding client notes
    public function addNote(Request $request)
    {
       $this->validate($request, 
        [
            'ClientNotes' => 'required',
            'ClientId' => 'required',
            'Hide' => 'required',
            'CreatedBy' => 'required'
        ]);

       $ClientNotes = $request->input('ClientNotes');
       $ClientId = $request->input('ClientId');
       $Hide = $request->input('Hide');
       $CreatedBy = $request->input('CreatedBy');
       $created = date('Y-M-j');
       $updated_at = date('Y-m-j');

       $data = array('ClientNotes' =>$ClientNotes, 'ClientId' =>$ClientId, 'Hide' =>$Hide, 
       'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);

       DB::table('clientnotes')->insert($data);

      return redirect()->route('client.view', ['ClientId' => $ClientId])->with('info', 'Client Notes Save Successfully');

    }

    //Client Asset
    public function insertClientAssetFromIndex(Request $request)
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

      return redirect()->route('client.index')->with('info', 'Client Asset Save Successfully');
      
    }

    public function insertClientAssetFromView(Request $request)
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

      return redirect()->route('client.view', ['ClientId' => $ClientId])->with('info', 'Client Asset Save Successfully');
      
    }

    //Client Quote
    public function insertClientQuoteFromIndex(Request $request)
    {
        $this->validate($request, 
        [
          'ClientId' => 'required',
          'WorkOrderNumber' => 'required',
          'ServiceDate' => 'required',
          'ServiceCompletionDate' => 'required',
          'WorkOrderStatusId' => 'required',
          'AssetId' => 'required',
          'OdometerReading' => 'required',
          'MaintenanceType' => 'required',
          'Comment' => 'required',
          'CreatedBy' => 'required'
        ]);
          
            //INSERT FOR WORKORDER TABLE
            $ClientId = $request->input('ClientId');
            $WorkOrderNumber = $request->input('WorkOrderNumber');
            $ServiceDate = $request->input('ServiceDate');
            $ServiceCompletionDate = $request->input('ServiceCompletionDate');
            $WorkOrderStatusId = $request->input('WorkOrderStatusId');
            $AssetId = $request->input('AssetId');
            $OdometerReading = $request->input('OdometerReading');
            $MaintenanceType = $request->input('MaintenanceType');
            $Comment = $request->input('Comment');
            $Active = '0';
            $CreatedBy = $request->input('CreatedBy');
            $created = date('Y-M-j');
            $updated_at = date('Y-m-j');
  
            $data = array('ClientId' =>$ClientId, 'WorkOrderNumber' =>$WorkOrderNumber, 'ServiceDate' =>$ServiceDate, 'ServiceCompletionDate' =>$ServiceCompletionDate, 'WorkOrderStatusId' =>$WorkOrderStatusId,'AssetId' =>$AssetId, 'OdometerReading' =>$OdometerReading, 'MaintenanceType' =>$MaintenanceType, 'Comment' =>$Comment, 'Active' =>$Active, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);          
     
            clientworkorder::insert($data);
  
  
  
            // INSERT FOR NEW PART FOR CLIENT WORKORDERITEM TABLE
            $count = $request->input('count');
            for($i = 1; $i <= $count; $i++)
            {
                $WOId = $request->input('WOId');
                $WorkOrderNumber = $request->input('WorkOrderNumber');
                $InvCatId = $request->input('InvCatId'.$i.'');
                $InvId = $request->input('InvId'.$i.'');
                $PartCost = $request->input('PartCost'.$i.'');
                $TotalCost = $request->input('TotalCost');
                $Type = 'part';
                $CreatedBy = $request->input('CreatedBy');
                $created = date('Y-M-j');
                $updated_at = date('Y-m-j');
  
                $part_data = array('WorkOrderNumber' =>$WorkOrderNumber, 'InvCatId' =>$InvCatId, 'InvId' =>$InvId, 'PartCost' =>$PartCost, 'TotalCost' =>$TotalCost, 'Type' =>$Type, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at); 
                
                Clientworkorderitem::insert($part_data);
            }
  
            // INSERT FOR NEW LABOUR FOR CLIENT WORKORDERITEM TABLE
            $ct = $request->input('ct');
            for($j = 1; $j <= $ct; $j++)
            {
                $WOId = $request->input('WOId');
                $WorkOrderNumber = $request->input('WorkOrderNumber');
                $LabourId = $request->input('LabourId'.$j.'');
                $LabourCost = $request->input('LabourCost'.$j.'');
                $TotalCost = $request->input('TotalCost');
                $Type = 'Labour';
                $CreatedBy = $request->input('CreatedBy');
                $created = date('Y-M-j');
                $updated_at = date('Y-m-j');
  
                $labour_data = array('WorkOrderNumber' =>$WorkOrderNumber, 'LabourId' =>$LabourId, 'LabourCost' =>$LabourCost, 'TotalCost' =>$TotalCost, 'Type' =>$Type, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at); 
                
                Clientworkorderitem::insert($labour_data);
            }
  
  
            
  
           
                  
              //UPDATING CLIENT ASSET 
              $asset_act_data = array(
                  'AssetId' => $request->input('AssetId'),
                  'Active' => '0',
                  'updated_at' => date('Y-m-j')
              );

              $AssetId = $request->input('AssetId');
              Clientasset::where('AssetId', $AssetId)->update($asset_act_data);
            
           return redirect()->route('client.index')->with('info', 'New Client Quote Created Successfully');
        
   }

    
      public function insertClientQuoteFromView(Request $request)   
      {
        $this->validate($request, 
        [
        'ClientId' => 'required',
        'WorkOrderNumber' => 'required',
        'ServiceDate' => 'required',
        'ServiceCompletionDate' => 'required',
        'WorkOrderStatusId' => 'required',
        'AssetId' => 'required',
        'OdometerReading' => 'required',
        'MaintenanceType' => 'required',
        'Comment' => 'required',
        'CreatedBy' => 'required'
        ]);
        
            //INSERT FOR WORKORDER TABLE
            $ClientId = $request->input('ClientId');
            $WorkOrderNumber = $request->input('WorkOrderNumber');
            $ServiceDate = $request->input('ServiceDate');
            $ServiceCompletionDate = $request->input('ServiceCompletionDate');
            $WorkOrderStatusId = $request->input('WorkOrderStatusId');
            $AssetId = $request->input('AssetId');
            $OdometerReading = $request->input('OdometerReading');
            $MaintenanceType = $request->input('MaintenanceType');
            $Comment = $request->input('Comment');
            $Active = '0';
            $CreatedBy = $request->input('CreatedBy');
            $created = date('Y-M-j');
            $updated_at = date('Y-m-j');

            $data = array('ClientId' =>$ClientId, 'WorkOrderNumber' =>$WorkOrderNumber, 'ServiceDate' =>$ServiceDate, 'ServiceCompletionDate' =>$ServiceCompletionDate, 'WorkOrderStatusId' =>$WorkOrderStatusId,'AssetId' =>$AssetId, 'OdometerReading' =>$OdometerReading, 'MaintenanceType' =>$MaintenanceType, 'Comment' =>$Comment, 'Active' =>$Active, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);          
    
            clientworkorder::insert($data);



            // INSERT FOR NEW PART FOR CLIENT WORKORDERITEM TABLE
            $count = $request->input('count');
            for($i = 1; $i <= $count; $i++)
            {
                $WOId = $request->input('WOId');
                $WorkOrderNumber = $request->input('WorkOrderNumber');
                $InvCatId = $request->input('InvCatId'.$i.'');
                $InvId = $request->input('InvId'.$i.'');
                $PartCost = $request->input('PartCost'.$i.'');
                $TotalCost = $request->input('TotalCost');
                $Type = 'part';
                $CreatedBy = $request->input('CreatedBy');
                $created = date('Y-M-j');
                $updated_at = date('Y-m-j');

                $part_data = array('WorkOrderNumber' =>$WorkOrderNumber, 'InvCatId' =>$InvCatId, 'InvId' =>$InvId, 'PartCost' =>$PartCost, 'TotalCost' =>$TotalCost, 'Type' =>$Type, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at); 
                
                Clientworkorderitem::insert($part_data);
            }

            // INSERT FOR NEW LABOUR FOR CLIENT WORKORDERITEM TABLE
            $ct = $request->input('ct');
            for($j = 1; $j <= $ct; $j++)
            {
                $WOId = $request->input('WOId');
                $WorkOrderNumber = $request->input('WorkOrderNumber');
                $LabourId = $request->input('LabourId'.$j.'');
                $LabourCost = $request->input('LabourCost'.$j.'');
                $TotalCost = $request->input('TotalCost');
                $Type = 'Labour';
                $CreatedBy = $request->input('CreatedBy');
                $created = date('Y-M-j');
                $updated_at = date('Y-m-j');

                $labour_data = array('WorkOrderNumber' =>$WorkOrderNumber, 'LabourId' =>$LabourId, 'LabourCost' =>$LabourCost, 'TotalCost' =>$TotalCost, 'Type' =>$Type, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at); 
                
                Clientworkorderitem::insert($labour_data);
            }


            //SENDING EMAIL NOTIFICATION TO MECHANIC WORKSHOP  

            //INSERT FOR WORKSHOPEMAIL TABLE
            
        
                
            //UPDATING CLIENT ASSET 
            $asset_act_data = array(
                'AssetId' => $request->input('AssetId'),
                'Active' => '0',
                'updated_at' => date('Y-m-j')
            );
            $AssetId = $request->input('AssetId');
            Clientasset::where('AssetId', $AssetId)->update($asset_act_data);
            
            
            //CHECKING IF THE RESET REMINDER WAS CHECKED
            

    
        return redirect()->route('client.view', ['ClientId' => $ClientId])->with('info', 'New Client Quote Created Successfully');
        
      }


      //Client Invoice
     public function insertInvoiceFromIndex(Request $request)
     {
        $this->validate($request, 
        [
          'InvoiceNumber' => 'required',
          'ClientId' => 'required',
          'DueDate' => 'required',
          'Status' => 'required',
          'TotalDue' => 'required',
          'PaymentMethod' => 'required',
          'Notes' => 'required',
          'Tax' => 'required',
          'WorkOrderId' => 'required',
          'CreatedBy' => 'required'
        ]);
          
            //INSERT FOR INVOICE TABLE
            $InvoiceNumber = $request->input('InvoiceNumber');
            $ClientId = $request->input('ClientId');
            $CreatedDate = date('Y-M-j');
            $DueDate = $request->input('DueDate');
            $Status = $request->input('Status');
            $SubTotal = $request->input('SubTotal');
            $DatePaid = $request->input('DatePaid');
            $TotalDue = $request->input('TotalDue');
            $PaymentMethod = $request->input('PaymentMethod');
            $TotalCost= $request->input('Total_Cost');
            $Notes = $request->input('Notes');
            $Tax = $request->input('Tax');
            $WorkOrderId = $request->input('WorkOrderId');
            $CreatedBy = $request->input('CreatedBy');
            $created = date('Y-M-j');
            $updated_at = date('Y-m-j');
  
            $data = array('InvoiceNumber' =>$InvoiceNumber, 'ClientId' =>$ClientId, 'CreatedDate' =>$CreatedDate, 'DueDate' =>$DueDate, 'Status' =>$Status, 'SubTotal' =>$SubTotal, 'DatePaid' =>$DatePaid, 'TotalDue' =>$TotalDue, 'PaymentMethod' =>$PaymentMethod, 'TotalCost' =>$TotalCost, 'Notes' =>$Notes, 'Tax' =>$Tax, 'WorkOrderId' =>$WorkOrderId, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);          
     
            Invoice::insert($data);
  
  
  
           //inserting for Part Items
            $ct = $request->input('count');
            for($i = 1; $i <= $ct; $i++)
            {
                $InvoiceNumber = $request->input('InvoiceNumber');
                $ClientId = $request->input('ClientId');
                $Quantity = $request->input('Quantity'.$i.'');
                $Description = $request->input('Description'.$i.'');
                $Price = $request->input('Price'.$i.'');
                $Amount = $request->input('Amount'.$i.'');
                $CreatedBy = $request->input('CreatedBy');
                $created = date('Y-M-j');
                $updated_at = date('Y-m-j');
    
                $item_data = array('InvoiceNumber' =>$InvoiceNumber, 'ClientId' =>$ClientId, 'Quantity' =>$Quantity, 'Description' =>$Description, 'Price' =>$Price, 'Amount' =>$Amount, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);               
                DB::table('invoiceitem')->insert($item_data);
            }
     
           return redirect()->route('client.index')->with('info', 'New Client Invoice Created Successfully');
        
    }



    
      public function insertInvoiceFromView(Request $request)   
      {
        $this->validate($request, 
        [
            'InvoiceNumber' => 'required',
            'ClientId' => 'required',
            'DueDate' => 'required',
            'Status' => 'required',
            'TotalDue' => 'required',
            'PaymentMethod' => 'required',
            'Notes' => 'required',
            'Tax' => 'required',
            'WorkOrderId' => 'required',
            'CreatedBy' => 'required'
        ]);
          
            //INSERT FOR INVOICE TABLE
            $InvoiceNumber = $request->input('InvoiceNumber');
            $ClientId = $request->input('ClientId');
            $CreatedDate = date('Y-M-j');
            $DueDate = $request->input('DueDate');
            $Status = $request->input('Status');
            $SubTotal = $request->input('SubTotal');
            $DatePaid = $request->input('DatePaid');
            $TotalDue = $request->input('TotalDue');
            $PaymentMethod = $request->input('PaymentMethod');
            $TotalCost= $request->input('Total_Cost');
            $Notes = $request->input('Notes');
            $Tax = $request->input('Tax');
            $WorkOrderId = $request->input('WorkOrderId');
            $CreatedBy = $request->input('CreatedBy');
            $created = date('Y-M-j');
            $updated_at = date('Y-m-j');
  
            $data = array('InvoiceNumber' =>$InvoiceNumber, 'ClientId' =>$ClientId, 'CreatedDate' =>$CreatedDate, 'DueDate' =>$DueDate, 'Status' =>$Status, 'SubTotal' =>$SubTotal, 'DatePaid' =>$DatePaid, 'TotalDue' =>$TotalDue, 'PaymentMethod' =>$PaymentMethod, 'TotalCost' =>$TotalCost, 'Notes' =>$Notes, 'Tax' =>$Tax, 'WorkOrderId' =>$WorkOrderId, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);          
     
            Invoice::insert($data);
  
  
  
           //inserting for Part Items
            $ct = $request->input('ct');
            for($i = 1; $i <= $ct; $i++)
            {
                $InvoiceNumber = $request->input('InvoiceNumber');
                $ClientId = $request->input('ClientId');
                $Quantity = $request->input('Quantity');
                $Description = $request->input('Description');
                $Price = $request->input('Price');
                $Amount = $request->input('Amount');
                $CreatedBy = $request->input('CreatedBy');
                $created = date('Y-M-j');
                $updated_at = date('Y-m-j');
    
                $item_data = array('InvoiceNumber' =>$InvoiceNumber, 'ClientId' =>$ClientId, 'Quantity' =>$Quantity, 'Description' =>$Description, 'Price' =>$Price, 'Amount' =>$Amount, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);               
                DB::table('invoiceitem')->insert($item_data);
            }

    
        return redirect()->route('client.view', ['ClientId' => $ClientId])->with('info', 'New Client Invoice Created Successfully');
        
      }

      public function editactive(Request $request)
      {
        $data = array(
              'AssetId' => $request->input('AssetId'),
              'Active' => '1',
              'updated_at' => date('Y-m-j')
          );
  
          $ClientId = $request->input('ClientId');
          $AssetId = $request->input('AssetId');

          Clientasset::where('AssetId', $AssetId)->update($data);
          return redirect()->route('client.view', ['ClientId' => $ClientId])->with('info', 'Client Asset Was Put Back In Service Successfully');
  
      }

      public function editinactive(Request $request)
      {
        $data = array(
              'AssetId' => $request->input('AssetId'),
              'Active' => '0',
              'updated_at' => date('Y-m-j')
          );
  
          $ClientId = $request->input('ClientId');
          $AssetId = $request->input('AssetId');

          Clientasset::where('AssetId', $AssetId)->update($data);
          return redirect()->route('client.view', ['ClientId' => $ClientId])->with('info', 'Client Asset Was Put Out Of Service Successfully');
  
      }


      public function retireclientasset(Request $request)
      {
        $this->validate($request, 
        [
          'AssetId' => 'required',
          'ClientId' => 'required',
          'RetireDate' => 'required',
          'RetireMileage' => 'required',
          'DisposalMethod' => 'required',
          'RetireSalePrice' => 'required',
          'RetireReason' => 'required',
          'RetireComment' => 'required',       
          'CreatedBy' => 'required',
        ]);
  
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
  
        $data = array('AssetId' =>$AssetId, 'ClientId' =>$ClientId, 'RetireDate' =>$RetireDate, 'RetireMileage' =>$RetireMileage, 'DisposalMethod' =>$DisposalMethod, 'RetireSalePrice' =>$RetireSalePrice,'RetireReason' =>$RetireReason, 'RetireComment' =>$RetireComment, 'Status' =>$Status, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);          
  
        DB::table('clientassetretiredetail')->insert($data);


        //UPDATING CLIENTASSET STATUS TO OUT OF SERVICE
        $data_clientasset = array(
            'Active' => '0',
            'updated_at' => date('Y-m-j')
        );

        Clientasset::where('AssetId', $AssetId)->update($data_clientasset);
  
       return redirect()->route('client.view', ['ClientId' => $ClientId])->with('info', 'Client Asset Was Retired Permanently');
        
      }

      public function clientprofile(Request $request, $id)
      {  
        //Client Asset AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $ClientPr = $perm->ClientPr;
        if($ClientPr)
        {
            $clientassets = Clientasset::all();
            $client = Client::where('ClientId', '=', $id)->first();
            return view('client.clientprofile')
            ->with('client', $client);
        }
        else {  return redirect()->back(); }
        
      }


      public function updateClientProfile(Request $request, $ClientId)
      {   
         $name = $request->file('name');
         $data = array(
              'ClientPicture' => time().'.'.$name->getClientOriginalExtension(),
              'updated_at' => date('Y-m-j')
          );

          $ClientPicture = time().'.'.$name->getClientOriginalExtension();
          $input['name'] = time().'.'.$name->getClientOriginalExtension();
      
          $destinationPath = public_path('assets/img/clients');
      
          $name->move($destinationPath, $input['name']);
  
          Client::where('ClientId', $ClientId)->update($data);
          return redirect()->route('client.view', ['ClientId' => $ClientId])->with('info', 'Client Profile Updated Successfully');
  
      }
}