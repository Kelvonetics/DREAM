<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Input;
use App\Clientworkorder;
use App\Clientworkorderitem;
use App\Client;
use App\Clientasset;
use App\Inventoryitem;
use App\Invcategory;
use App\Workshop;
use Auth;

class ClientworkorderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
        //Client Quote AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $ClientWo = $perm->ClientWo;
        if($ClientWo)
        {
            $clientworkorders = DB::table('clientworkorder')->orderBy('WorkOrderNumber', 'desc')->get();
            
            return view('clientworkorder.index')
            ->with('clientworkorders', $clientworkorders);
        }
        else {  return redirect()->back(); }
        
    }


    public function add()
    {
        //Client Quote AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $ClientWo = $perm->ClientWo;
        if($ClientWo)
        {
            $clients = Client::all(); 
            $wo_count = DB::table('clientworkorder')->count(); 
            ++$wo_count;
    
            $maintenances = DB::table('maintenance')->orderBy('maintenancetype', 'asc')->get();
            $workorderstatus = DB::table('workorderstatus')->where('WorkOrderStatusId', '=', '1')->get();
                         
            return view('clientworkorder.add')
            ->with('clients', $clients)
            ->with('wo_count', $wo_count)
            ->with('maintenances', $maintenances)
            ->with('workorderstatus', $workorderstatus);
        }
        else {  return redirect()->back(); }
        
    }

    public function insert(Request $request)
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

              $part_data = array('WorkOrderNumber' =>$WorkOrderNumber, 'InvCatId' =>$InvCatId, 'InvId' =>$InvId,'PartCost' =>$PartCost, 'TotalCost' =>$TotalCost, 'Type' =>$Type, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at); 
              
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
          $shopemail = $request->input('shopemail');
          $message = $request->input('Comment').' Work Order Number : '.$request->input('WorkOrderNumber');


          //INSERT FOR WORKSHOPEMAIL TABLE
          $ClientId = $request->input('ClientId');
          $Email = $shopemail;
          $FromAddress = 'info@dream360.com';
          $Subject = 'New Client Quote Created';
          $Message = $message;
          $WorkOrderNumber= $request->input('WorkOrderNumber');
          $CreatedBy = $request->input('CreatedBy');
          $created = date('Y-M-j');
          $updated_at = date('Y-m-j');

          $email_data = array('ClientId' =>$ClientId, 'Email' =>$Email, 'FromAddress' =>$FromAddress, 'Subject' =>$Subject, 'Message' =>$Message, 'WorkOrderNumber' =>$WorkOrderNumber, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);          
   
          DB::table('clientemail')->insert($email_data);

         
                
            //UPDATING CLIENT ASSET 
            $asset_act_data = array(
                'AssetId' => $request->input('AssetId'),
                'Active' => '0',
                'updated_at' => date('Y-m-j')
            );
            $AssetId = $request->input('AssetId');
            Clientasset::where('AssetId', $AssetId)->update($asset_act_data);
          
            
            //CHECKING IF THE RESET REMINDER WAS CHECKED
            

   
         return redirect()->route('clientworkorder.index')->with('info', 'New Client Quote Created Successfully');
      
    }


    public function edit($WOId)
    {
        //Client Quote AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $ClientWo = $perm->ClientWo;
        if($ClientWo)
        {
            $clientworkorder = Clientworkorder::find($WOId);
            $maintenances = DB::table('maintenance')->orderBy('MaintenanceType', 'asc')->get();
            $workorderstatus = DB::table('workorderstatus')->get();
            $invcates = Invcategory::all();
    
            return view('clientworkorder.edit')
            ->with('maintenances', $maintenances)
            ->with('workorderstatus', $workorderstatus)
            ->with('clientworkorder', $clientworkorder)
            ->with('invcates', $invcates);
        }
        else {  return redirect()->back(); }
        
    }

    public function update(Request $request, $WOId)
    {      
        $this->validate($request, 
        [
          'WOId' => 'required',
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

       $data = array(
            'ClientId' => $request->input('ClientId'),
            'WorkOrderNumber' => $request->input('WorkOrderNumber'),
            'ServiceDate' => $request->input('ServiceDate'),
            'ServiceCompletionDate' => $request->input('ServiceCompletionDate'),
            'ActualStartDate' => $request->input('ActualStartDate'),
            'ActualEndDate' => $request->input('ActualEndDate'),
            'WorkOrderStatusId' => $request->input('WorkOrderStatusId'),
            'AssetId' => $request->input('AssetId'),
            'OdometerReading' => $request->input('OdometerReading'),
            'MaintenanceType' => $request->input('MaintenanceType'),
            'Comment' => $request->input('Comment'),
            'CreatedBy' => $request->input('CreatedBy'),
            'updated_at' => date('Y-m-j')
        );
        Clientworkorder::where('WOId', $WOId)->update($data);

            //for loop to update all existing part items in workorderitem table for the related workordernumber
            $count_p = $request->input('count_part');
            for($i = 1; $i <= $count_p; $i++)
            {
                //updating Part In Workorderitem Table
                $part_data = array(
                    'InvCatId' => $request->input('InvCatId'.$i.''),
                    'InvId' => $request->input('InvId'.$i.''),
                    'PartCost' => $request->input('PartCost'.$i.''),
                    'TotalCost' => $request->input('TotalCost'),
                    'updated_at' => date('Y-m-j')
                );
                $p_woid = $request->input('WOId'.$i.'');
                Clientworkorderitem::where('WOId', $p_woid)->update($part_data);

                //updating item quantity in inventoryitem table
                $invitem_data = array(
                    'Quantity' => $request->input('Quantity'),
                    'updated_at' => date('Y-m-j')
                );
                $PartInvId = $request->input('InvId'.$i.'');
                Inventoryitem::where('InvId', $PartInvId)->update($invitem_data);              
            }

            //for loop to update all existing labour items in workorderitem table for the related workordernumber
            $count_l = $request->input('count_lab');
            for($i = 1; $i <= $count_l; $i++)
            {
                //updating Labour In Workorderitem Table
                $labour_data = array(
                    'LabourId' => $request->input('LabourId'.$i.''),
                    'LabourCost' => $request->input('LabourCost'.$i.''),
                    'TotalCost' => $request->input('TotalCost'),
                    'updated_at' => date('Y-m-j')
                );
                $l_woid = $request->input('WOId'.$i.'');
                Clientworkorderitem::where('WOId', $l_woid)->update($labour_data);           
            }




            // INSERT FOR NEW PART FOR WORKORDERITEM TABLE
            $count_p_n = $request->input('count_part_new');
            //increamenting the count value
            $cp = $count_p; 
            $p_start = $cp + 1;		
            $p_stop = $cp + $count_p_n; 
            $in = $p_stop - $cp;
            for($m = $p_start; $m <= $p_stop; $m++)
            {
                $WOId = $request->input('WOId');
                $WorkOrderNumber = $request->input('WorkOrderNumber');
                $InvCatId = $request->input('InvCatId'.$m.'');
                $InvId = $request->input('InvId'.$m.'');
                $PartCost = $request->input('PartCost'.$m.'');
                $TotalCost = $request->input('TotalCost');
                $Type = 'part';
                $CreatedBy = $request->input('CreatedBy');
                $created = date('Y-M-j');
                $updated_at = date('Y-m-j');

                $new_part_data = array('WorkOrderNumber' =>$WorkOrderNumber, 'InvCatId' =>$InvCatId, 'InvId' =>$InvId, 
                'PartCost' =>$PartCost, 'TotalCost' =>$TotalCost, 'Type' =>$Type, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at); 
                
                Clientworkorderitem::insert($new_part_data);
            }

            // INSERT FOR NEW LABOUR FOR WORKORDERITEM TABLE
            $count_l = $request->input('count_lab');
            $count_l_n = $request->input('count_lab_new');
            //increamenting the count value
            $cl = $count_l; 
            $l_start = $cl + 1;		
            $l_stop = $cl + $count_l_n; 
            $inn = $l_stop - $cl;
            for($n = $l_start; $n <= $l_stop; $n++)
            {
                $WOId = $request->input('WOId');
                $WorkOrderNumber = $request->input('WorkOrderNumber');
                $LabourId = $request->input('LabourId'.$n.'');
                $LabourCost = $request->input('LabourCost'.$n.'');
                $TotalCost = $request->input('TotalCost');
                $Type = 'Labour';
                $CreatedBy = $request->input('CreatedBy');
                $created = date('Y-M-j');
                $updated_at = date('Y-m-j');

                $new_labour_data = array('WorkOrderNumber' =>$WorkOrderNumber, 'LabourId' =>$LabourId, 'LabourCost' =>$LabourCost, 'TotalCost' =>$TotalCost, 'Type' =>$Type, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at); 
                
                Clientworkorderitem::insert($new_labour_data);
            }


        
        return redirect()->route('clientworkorder.index')->with('info', ' Quote Updated With '.$count_p_n .' New Part Item(s) And '.$count_l_n.' New Labour Item(s) Added For Work Order Number : '.$WorkOrderNumber);

    }



}
