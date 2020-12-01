<?php

namespace App\Http\Controllers; 

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Input;
use App\Workorder;
use App\Workorderitem;
use App\Workshop;
use App\Workshopemail;
use App\Asset;
use App\Inventoryitem;
use App\Assetavailability;
use App\Schedulemaintenance;
use Auth;
use Mail;
use App\Users;
use App\Mail\sendemail;

class WorkorderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    
    public function index()
    {
        //ASSET WORKORDER AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $AssetMa = $perm->AssetMa;
        if($AssetMa)
        {
            $workorders = Workorder::orderBy('WorkOrderNumber', 'desc')->get();
            $workshops = DB::table('workshop')->orderBy('WorkShopName', 'asc')->get();
            $wo_count = DB::table('workorder')->count(); 
            ++$wo_count;
            $assets = Asset::all();
    
            return view('workorder.index')
            ->with('workorders', $workorders)
            ->with('wo_count', $wo_count)
            ->with('assets', $assets)
            ->with('workshops', $workshops);
        }
        else {  return redirect()->back(); } 
        
    }


    public function add()
    { 
        //ASSET WORKORDER ADD AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $AssetMa = $perm->AssetMa;
        if($AssetMa)
        {
            $wo_count = DB::table('workorder')->count();       ++$wo_count;
            
            $maintenances = DB::table('maintenance')->orderBy('maintenancetype', 'asc')->get();
            $workorderstatus = DB::table('workorderstatus')->where('WorkOrderStatusId', '=', '1')->get();
            $workshops = DB::table('workshop')->orderBy('WorkShopName', 'asc')->get();
                            
            return view('workorder.add')
            ->with('wo_count', $wo_count)
            ->with('maintenances', $maintenances)
            ->with('workorderstatus', $workorderstatus)
            ->with('workshops', $workshops);
        }
        else {  return redirect()->back(); } 
        
    }

    public function insert(Request $request)
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
        'Active' => 'required',
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
          $Active = $request->input('Active');
          $CreatedBy = $request->input('CreatedBy');
          $created = date('Y-M-j');
          $updated_at = date('Y-m-j');

          $data = array('WorkOrderNumber' =>$WorkOrderNumber, 'ServiceDate' =>$ServiceDate, 'ServiceCompletionDate' =>$ServiceCompletionDate, 'WorkOrderStatusId' =>$WorkOrderStatusId,'AssetId' =>$AssetId, 'OdometerReading' =>$OdometerReading, 'MaintenanceType' =>$MaintenanceType,'WorkShopId' =>$WorkShopId, 'Comment' =>$Comment, 'Active' =>$Active, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);          
   
          Workorder::insert($data);


          //INSERT FOR WORKSHOPEMAIL TABLE
          $WorkShopId = $request->input('WorkShopId');
          $FleetManagerEmail = $request->input('FleetManagerEmail');
          $Email = $request->input('shopemail');
          $FromAddress = 'info@dream360.com';
          $Message = $request->input('Comment');
          $Status = 'Vendor Review';
          $State = '1';
          $RoleId = $request->input('RoleId');
          $WorkOrderNumber= $request->input('WorkOrderNumber');
          $WOId = $request->input('WOId');
          $CreatedBy = $request->input('CreatedBy');
          $created = date('Y-M-j');
          $updated_at = date('Y-m-j');

          $email_data = array('WorkShopId' =>$WorkShopId, 'FleetManagerEmail' =>$FleetManagerEmail, 'Email' =>$Email, 'FromAddress' =>$FromAddress, 'Message' =>$Message,'Status' =>$Status, 'State' =>$State, 'RoleId' =>$RoleId,'WorkOrderNumber' =>$WorkOrderNumber, 'WOId' =>$WOId, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);          
   
          Workshopemail::insert($email_data);
          




          //SENDING EMAIL NOTIFICATION TO MECHANIC WORKSHOP
          $FleetManagerEmail = $request->input('FleetManagerEmail');
          $notes = $request->input('Comment');
          $vehicle = Asset::find($AssetId);
          $shop_name = Workshop::find($WorkShopId);

          $data = array('name'=>    $shop_name->WorkShopName,
                        'title' =>  $vehicle->LicensePlate.' , Work Order Number : '.$WorkOrderNumber,
                        'body' =>   $notes .', New Workorder Added For Vehicle : '.$vehicle->LicensePlate
                       );

            Mail::send('mail', ["data" => $data], function($message) 
            {
                // = $request->input('shopemail');
                $message
                ->to(Input::get('shopemail'), 'Auto Mechanic')
                ->subject('Vehicle Service Details');

                $message->from(Input::get('FleetManagerEmail'), 'Fleet Manager');
            });





         //CHECKING IF THE PUT OUT OF SERVICE WAS CHECKED
            $Active = $request->input('Active');
            if($Active == '1')
            {
                //INSERT FOR RECORD FOR ASSETAVAILABILITY TABLE
                $AssetId = $request->input('AssetId');
                $StartDate = $request->input('ServiceDate');
                $EndDate = $request->input('ServiceCompletionDate');
                $VendorId = $request->input('WorkShopId');
                $WorkOrderId = $request->input('WorkOrderNumber');
                $Reason = $request->input('Comment');
                $Status = $request->input('Active');
                $CreatedBy = $request->input('CreatedBy');
                $created = date('Y-M-j');
                $updated_at = date('Y-m-j');

                $avail_data = array('AssetId' =>$AssetId, 'StartDate' =>$StartDate, 'EndDate' =>$EndDate, 'VendorId' =>$VendorId, 'WorkOrderId' =>$WorkOrderId, 'Reason' =>$Reason, 'Status' =>$Status, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);               
                Assetavailability::insert($avail_data);
                
                //UPDATING ASSET AVAILABILITY IN ASSET TABLE
                $asset_act_data = array(
                    'AssetId' => $request->input('AssetId'),
                    'Active' => '0',
                    'updated_at' => date('Y-m-j')
                );
                $AssetId = $request->input('AssetId');
                Asset::where('AssetId', $AssetId)->update($asset_act_data);
                
            }
            else {  }
            
            //CHECKING IF THE RESET REMINDER WAS CHECKED
            $ServRem = $request->input('ServiceReminder');   $SchMaintId = $request->input('SchMaintId');
            if($ServRem == '1' && $SchMaintId != ' ')
            {
                $sched_maint_data = array(
                    'SchMaintId' => $request->input('SchMaintId'),
                    'LastMaintDate' => $request->input('ServiceCompletionDate'),
                    'LastMaintMile' => $request->input('OdometerReading'),
                    'updated_at' => date('Y-m-j')
                );
                
                Schedulemaintenance::where('SchMaintId', $SchMaintId)->update($sched_maint_data);
            }
            elseif($ServRem == '1' && $SchMaintId == ' ') 
            { 
                //INSERT FOR RECORD FOR ASSETAVAILABILITY TABLE
               
            }


   
         return redirect()->route('workorder.index')->with('info', 'New Workorder Created Successfully');
      
    }

    public function insertworkorder(Request $request)
    {
      $this->validate($request, 
      [
        'WorkOrderNumber' => 'required',
        'ServiceDate' => 'required',
        'ServiceCompletionDate' => 'required',
        'AssetId' => 'required',
        'OdometerReading' => 'required',
        'MaintenanceType' => 'required',
        'WorkShopId' => 'required',
        'Comment' => 'required',
        'Active' => 'required',
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
          $Active = $request->input('Active');
          $CreatedBy = $request->input('CreatedBy');
          $created = date('Y-M-j');
          $updated_at = date('Y-m-j');

          $data = array('WorkOrderNumber' =>$WorkOrderNumber, 'ServiceDate' =>$ServiceDate, 'ServiceCompletionDate' =>$ServiceCompletionDate, 'WorkOrderStatusId' =>$WorkOrderStatusId,'AssetId' =>$AssetId, 'OdometerReading' =>$OdometerReading, 'MaintenanceType' =>$MaintenanceType,'WorkShopId' =>$WorkShopId, 'Comment' =>$Comment, 'Active' =>$Active, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);          
   
          Workorder::insert($data);


          //SENDING EMAIL NOTIFICATION TO MECHANIC WORKSHOP
          $shopemail = $request->input('shopemail');
          $message = $request->input('Comment').' Work Order Number : '.$request->input('WorkOrderNumber');


          //INSERT FOR WORKSHOPEMAIL TABLE
          $WorkShopId = $request->input('WorkShopId');
          $FleetManagerEmail = $request->input('FleetManagerEmail');
          $Email = $shopemail;
          $FromAddress = 'info@dream360.com';
          $Message = $message;
          $Status = 'Unread';
          $State = '1';
          $RoleId = $request->input('RoleId');
          $WorkOrderNumber= $request->input('WorkOrderNumber');
          $WOId = $request->input('WOId');
          $CreatedBy = $request->input('CreatedBy');
          $created = date('Y-M-j');
          $updated_at = date('Y-m-j');

          $email_data = array('WorkShopId' =>$WorkShopId, 'FleetManagerEmail' =>$FleetManagerEmail, 'Email' =>$Email, 'FromAddress' =>$FromAddress, 'Message' =>$Message,'Status' =>$Status, 'State' =>$State, 'RoleId' =>$RoleId,'WorkOrderNumber' =>$WorkOrderNumber, 'WOId' =>$WOId, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);          
   
          Workshopemail::insert($email_data);



         //CHECKING IF THE PUT OUT OF SERVICE WAS CHECKED
            $Active = $request->input('Active');
            if($Active == '1')
            {
                //INSERT FOR RECORD FOR ASSETAVAILABILITY TABLE
                $AssetId = $request->input('AssetId');
                $StartDate = $request->input('ServiceDate');
                $EndDate = $request->input('ServiceCompletionDate');
                $VendorId = $request->input('WorkShopId');
                $WorkOrderId = $request->input('WorkOrderNumber');
                $Reason = $request->input('Comment');
                $Status = $request->input('Active');
                $CreatedBy = $request->input('CreatedBy');
                $created = date('Y-M-j');
                $updated_at = date('Y-m-j');

                $avail_data = array('AssetId' =>$AssetId, 'StartDate' =>$StartDate, 'EndDate' =>$EndDate, 'VendorId' =>$VendorId, 'WorkOrderId' =>$WorkOrderId, 'Reason' =>$Reason, 'Status' =>$Status, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);               
                Assetavailability::insert($avail_data);
                
                //UPDATING ASSET AVAILABILITY IN ASSET TABLE
                $asset_act_data = array(
                    'AssetId' => $request->input('AssetId'),
                    'Active' => '0',
                    'updated_at' => date('Y-m-j')
                );
                $AssetId = $request->input('AssetId');
                Asset::where('AssetId', $AssetId)->update($asset_act_data);
                
            }
            else {  }
            
            //CHECKING IF THE RESET REMINDER WAS CHECKED
            $ServRem = $request->input('ServiceReminder');   $SchMaintId = $request->input('SchMaintId');
            if($ServRem == '1' && $SchMaintId != ' ')
            {
                $sched_maint_data = array(
                    'SchMaintId' => $request->input('SchMaintId'),
                    'LastMaintDate' => $request->input('ServiceCompletionDate'),
                    'LastMaintMile' => $request->input('OdometerReading'),
                    'updated_at' => date('Y-m-j')
                );
                
                Schedulemaintenance::where('SchMaintId', $SchMaintId)->update($sched_maint_data);
            }
            elseif($ServRem == '1' && $SchMaintId == ' ') 
            { 
                //INSERT FOR RECORD FOR ASSETAVAILABILITY TABLE
               
            }


   
         return redirect()->route('workorder.index')->with('info', 'New Workorder Created Successfully');
      
    }


    public function edit($WOId)
    {
        //ASSET WORKORDER EDIT AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $AssetMa = $perm->AssetMa;
        if($AssetMa)
        {
            $workorder = Workorder::find($WOId);
            $maintenances = DB::table('maintenance')->orderBy('MaintenanceType', 'asc')->get();
    
            return view('workorder.edit')
            ->with('maintenances', $maintenances)
            ->with('workorder', $workorder);
        }
        else {  return redirect()->back(); } 
        
    }

    public function approve_decline($WOId)
    {
        //ASSET WORKORDER APPROVE AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $AssetMa = $perm->AssetMa;
        if($AssetMa)
        {
            $workorder = Workorder::find($WOId);
            $maintenances = DB::table('maintenance')->orderBy('MaintenanceType', 'asc')->get();
    
            return view('workorder.approve_decline')
            ->with('maintenances', $maintenances)
            ->with('workorder', $workorder);
        }
        else {  return redirect()->back(); } 
        
    }

    public function approved($WOId)
    {
        //ASSET WORKORDER APPROVE DECLINE AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $AssetMa = $perm->AssetMa;
        if($AssetMa)
        {
            $workorder = Workorder::find($WOId);
            $maintenances = DB::table('maintenance')->orderBy('MaintenanceType', 'asc')->get();
    
            return view('workorder.approved')
            ->with('maintenances', $maintenances)
            ->with('workorder', $workorder);
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
          'WorkShopId' => 'required',
          'Comment' => 'required',
          'CreatedBy' => 'required'
        ]);

       $data = array(
            'WorkOrderNumber' => $request->input('WorkOrderNumber'),
            'ServiceDate' => $request->input('ServiceDate'),
            'ServiceCompletionDate' => $request->input('ServiceCompletionDate'),
            'ActualStartDate' => $request->input('ActualStartDate'),
            'ActualEndDate' => $request->input('ActualEndDate'),
            'WorkOrderStatusId' => $request->input('WorkOrderStatusId'),
            'AssetId' => $request->input('AssetId'),
            'OdometerReading' => $request->input('OdometerReading'),
            'MaintenanceType' => $request->input('MaintenanceType'),
            'WorkShopId' => $request->input('WorkShopId'),
            'Comment' => $request->input('Comment'),
            'CreatedBy' => $request->input('CreatedBy'),
            'updated_at' => date('Y-m-j')
        );
        Workorder::where('WOId', $WOId)->update($data);

            //for loop to update all existing part items in workorderitem table for the related workordernumber
            $count_p = $request->input('count_part');
            for($i = 1; $i <= $count_p; $i++)
            {
                //updating Part In Workorderitem Table
                $part_data = array(
                    'InvCatId' => $request->input('InvCatId'.$i.''),
                    'InvId' => $request->input('InvId'.$i.''),
                    'PartCost' => $request->input('PartCost'.$i.''),
                    'updated_at' => date('Y-m-j')
                );
                $p_woid = $request->input('WOId'.$i.'');
                Workorderitem::where('WOId', $p_woid)->update($part_data);

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
                    'updated_at' => date('Y-m-j')
                );
                $l_woid = $request->input('WOId'.$i.'');
                Workorderitem::where('WOId', $l_woid)->update($labour_data);           
            }




            //INSERT FOR NEW PART FOR WORKORDERITEM TABLE
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

                $new_part_data = array('WorkOrderNumber' =>$WorkOrderNumber, 'InvCatId' =>$InvCatId, 
                'InvId' =>$InvId, 'PartCost' =>$PartCost, 'TotalCost' =>$TotalCost, 'Type' =>$Type, 
                'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at); 
                
                Workorderitem::insert($new_part_data);
            }


            //INSERT FOR NEW LABOUR FOR WORKORDERITEM TABLE
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
                
                Workorderitem::insert($new_labour_data);
            }


            //UPDATING WORKSHOPEMAIL STATUS TO READ FOR VENDOR
            $RoleId = $request->input('RoleId');
            $shopemail_data = array(                
                'Status' => 'Pending Approval',
                'State' => '2',
                'RoleId' => $RoleId,
                'updated_at' => date('Y-m-j')
            );

            
            $ShopEmailId = $request->input('ShopEmailId');
            Workshopemail::where('ShopEmailId', $ShopEmailId)->update($shopemail_data);


            //SENDING EMAIL NOTIFICATION TO MECHANIC WORKSHOP
            $FleetManagerEmail = $request->input('FleetManagerEmail');
            $notes = $request->input('Comment');
            $AssetId = $request->input('AssetId');
            $WorkShopId = $request->input('WorkShopId');
            $vehicle = Asset::find($AssetId);
            $shop_name = Workshop::find($WorkShopId);

            $data = array('name'=>    $shop_name->WorkShopName,
                            'title' =>  $vehicle->LicensePlate.' , Work Order Number : '.$WorkOrderNumber,
                            'body' =>   $notes .', Workorder Parts And Labour Added For The Vehicle : '.$vehicle->LicensePlate
                        );

                Mail::send('mail', ["data" => $data], function($message) 
                {
                    // = $request->input('shopemail');
                    $message
                    ->to(Input::get('FleetManagerEmail'), 'Fleet Manager')
                    ->subject('Vehicle Parts Labour Details');

                    $message->from('info@autoworkshop.com', 'Auto Mechanic');
                });

        
        return redirect()->route('workorder.index')->with('info', ' Work Order Updated With '.$count_p_n .' New Part Item(s) And '.$count_l_n.' New Labour Item(s) Added For Work Order Number : '.$WorkOrderNumber);

    }

    public function approve(Request $request, $WOId)
    {      
        //UPDATING WORKSHOPEMAIL STATUS TO APPROVE FOR VENDOR
        $RoleId = $request->input('RoleId');
        $shopemail_data = array(                
            'Status' => 'Approved',
            'RoleId' => $RoleId,
            'State' => '3',
            'updated_at' => date('Y-m-j')
        );

        $Email = $request->input('shopemail');
        $FromAddress = 'info@dream360.com';
        $Notes = $request->input('Comment');
        $AssetId = $request->input('AssetId');
        $ShopMechId = $request->input('ShopMechId');
        $WorkOrderNumber = $request->input('WorkOrderNumber');
        Workshopemail::where('ShopEmailId', $ShopMechId)->update($shopemail_data);


        //SENDING APPROVED EMAIL NOTIFICATION TO MECHANIC WORKSHOP
        $shopemail = $request->input('shopemail');
        $notes = $request->input('Comment');
        $vehicle = Asset::find($AssetId);
        $shop_name = Workshop::find($WorkShopId);

        $data = array('name'=>    $shop_name->WorkShopName,
                      'title' =>  $vehicle->LicensePlate.' , Work Order Number : '.$WorkOrderNumber,
                      'body' =>   $notes .', Workorder Approved For Vehicle : '.$vehicle->LicensePlate
                     );

          Mail::send('mail', ["data" => $data], function($message) 
          {
              // = $request->input('shopemail');
              $message
              ->to(Input::get('shopemail'), 'Auto Mechanic')
              ->subject('Workorder Approval');

              $message->from(Input::get('FleetManagerEmail'), 'Fleet Manager');
          });


        return redirect()->route('workorder.index')->with('info', ' Work Order Approved.  Work Order Number :  '.$WorkOrderNumber);

    }

    public function decline(Request $request, $WOId)
    {      
        //UPDATING WORKSHOPEMAIL STATUS TO DECLINE FOR VENDOR
        $RoleId = $request->input('RoleId');
        $shopemail_data = array(                
            'Status' => 'Declined',
            'RoleId' => $RoleId,
            'State' => '3',
            'updated_at' => date('Y-m-j')
        );

        $Email = $request->input('shopemail');
        $FromAddress = 'info@dream360.com';
        $Notes = $request->input('Comment');
        $AssetId = $request->input('AssetId');
        $ShopEmailId = $request->input('ShopEmailId');
        $WorkOrderNumber = $request->input('WorkOrderNumber');
        Workshopemail::where('ShopEmailId', $ShopEmailId)->update($shopemail_data);


        //SENDING APPROVED EMAIL NOTIFICATION TO MECHANIC WORKSHOP
        $shopemail = $request->input('shopemail');
        $notes = $request->input('Comment');
        $WorkShopId = $request->input('WorkShopId');
        $vehicle = Asset::find($AssetId);
        $shop_name = Workshop::find($WorkShopId);

        $data = array('name'=>    $shop_name->WorkShopName,
                      'title' =>  $vehicle->LicensePlate.' , Work Order Number : '.$WorkOrderNumber,
                      'body' =>   $notes .', Workorder Declined For Vehicle : '.$vehicle->LicensePlate
                     );

          Mail::send('mail', ["data" => $data], function($message) 
          {
              // = $request->input('shopemail');
              $message
              ->to(Input::get('shopemail'), 'Auto Mechanic')
              ->subject('Workorder Approval');

              $message->from(Input::get('FleetManagerEmail'), 'Fleet Manager');
          });

        return redirect()->route('workorder.index')->with('info', ' Work Order Declined.  Work Order Number :  '.$WorkOrderNumber);

    }


    public function hope()
    {
        $user = Users::find(1);
        Mail::to($user->email)->send(new sendemail());
        return response()->json($user->FirstName.' '.$user->LastName.' '.$user->email);
    }

    public function b_email()
    {
        $data = array('name'=>"Kelvin O", 
                      'body' => 'New Workorder Created Successfully');
        Mail::send('mail', ["data1" => $data], function($message) 
        {
            $user = Users::find(1);
            $message->to($user->email, 'Dream360')->subject
              ('HTML Notification Testing Mail');
              $message->from('kelvonetics@gmail.com','Kelvin O');
        });
        echo "HTML Email Sent. Check your inbox.";
    }


   /* public function sendReminder()
    {
        //SENDING EMAIL NOTIFICATION TO MECHANIC WORKSHOP
        $Email = 'kelvin.o@rytegate.com';
        $shop_name = Workshop::find($WorkShopId);

        $data = array('name' => 'Vendor User',
                      'title' => 'Vehicle Service Reminder.',
                      'body' => 'Your Vehicle Is Due For Maintenance Today.'
                     );

          Mail::send('mail', ["data" => $data], function($message) 
          {
              // = $request->input('shopemail');
              $message
              ->to(Input::get('shopemail'), 'Auto Mechanic')
              ->subject('Vehicle Service Details');

              $message->from(Input::get('FleetManagerEmail'), 'Fleet Manager');
          });
    }*/
}

