<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Input;
use App\Totaldistance;
use App\Asset;

class SettingController extends Controller
{
    public function index()
    {
      //SETTINGS INDEX AUTHORIZATION 
      $auth = Auth::user();  
      $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
      $AssetMa = $perm->AssetMa;
      if($AssetMa)
      {
        $stock = DB::table('itemstocksetting')->where('ItemStockSettingId', '=', 1)->first();
        $flow = DB::table('workflow')->where('WorkFlowName', '=', 'Work Order')->first();
        $flow_tot = DB::table('workflow')->where('WorkFlowName', '=', 'Work Order')->count();

        $flow_PA = DB::table('workflow')->where('WorkFlowName', '=', 'Pending And Approved')->first();
        $flow_PA_tot = DB::table('workflow')->where('WorkFlowName', '=', 'Pending And Approved')->count();

        $flow_DC = DB::table('workflow')->where('WorkFlowName', '=', 'Declined')->first();
        $flow_DC_tot = DB::table('workflow')->where('WorkFlowName', '=', 'Declined')->count();

        $Roles = DB::table('role')->get();

        return view('settings.index')
        ->with('stock', $stock)
        ->with('flow', $flow)
        ->with('flow_tot', $flow_tot)
        ->with('flow_PA', $flow_PA)
        ->with('flow_PA_tot', $flow_PA_tot)
        ->with('flow_DC', $flow_DC)
        ->with('flow_DC_tot', $flow_DC_tot);
      }
      else {  return redirect()->back(); } 
      
    }
    
    public function insert_stock(Request $request)
    {
        //$asset = Asset::find($AssetId);       
        $this->validate($request, 
        [
            'InStock' => 'required',
            'Limited' => 'required',
            'OutOfStock' => 'required'
        ]);
 
            $InStock = $request->input('InStock');
            $Limited = $request->input('Limited');
            $OutOfStock = $request->input('OutOfStock');
            $CreatedBy = $request->input('CreatedBy');
            $created = date('Y-M-j');
            $modified = date('Y-m-j');

         $data = array('MakeId' =>$MakeId, 'Limited' =>$Limited, 'OutOfStock' =>$OutOfStock,
         'CreatedBy' =>$CreatedBy, 'created' =>$created, 'modified' =>$modified);
  
         DB::table('itemstocksetting')->insert($data);
 
         return redirect()->route('settings.index')->with('info', 'Notification For Stock Item Added Successfully');
    }

    public function update_stock(Request $request, $Id)
    {
        //$asset = Asset::find($AssetId);       
        $this->validate($request, 
        [
            'InStock' => 'required',
            'Limited' => 'required',
            'OutOfStock' => 'required'
        ]);
 
        $data = array(
             'InStock' => $request->input('InStock'),
             'Limited' => $request->input('Limited'),
             'OutOfStock' => $request->input('OutOfStock'),
             'modified' => date('Y-m-j')
         );
 
         DB::table('itemstocksetting')->where('ItemStockSettingId', $Id)->update($data);
         return redirect()->route('settings.index')->with('info', 'Notification For Stock Item Updated Successfully');
    }

    public function insert_flow_WorkOrder(Request $request)
    {    
        $this->validate($request, 
        [
            'RoleId' => 'required',
            'WorkFlowName' => 'required'
        ]);
 
            $RoleId = $request->input('RoleId');
            $WorkFlowName = $request->input('WorkFlowName');
            $CreatedBy = $request->input('CreatedBy');
            $created = date('Y-M-j');
            $modified = date('Y-m-j');

         $data = array('RoleId' =>$RoleId, 'WorkFlowName' =>$WorkFlowName, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'modified' =>$modified);
  
         DB::table('itemstocksetting')->insert($data);
 
         return redirect()->route('settings.index')->with('info', 'Notification For Stock Item Added Successfully');
    }

    public function update_flow_WorkOrder(Request $request, $Id)
    {      
        $this->validate($request, 
        [
            'RoleId' => 'required'
        ]);
 
        $data = array(
             'RoleId' => $request->input('RoleId'),
             'modified' => date('Y-m-j')
         );
 
         DB::table('workflow')->where('WorkFlowId', $Id)->update($data);
         return redirect()->route('settings.index')->with('info', 'Workflow Settings Updated Successfully');
    }

    public function insert_flow_PendingApproval(Request $request)
    {    
        $this->validate($request, 
        [
            'RoleId' => 'required',
            'WorkFlowName' => 'required'
        ]);
 
            $RoleId = $request->input('RoleId');
            $WorkFlowName = $request->input('WorkFlowName');
            $CreatedBy = $request->input('CreatedBy');
            $created = date('Y-M-j');
            $modified = date('Y-m-j');

         $data = array('RoleId' =>$RoleId, 'WorkFlowName' =>$WorkFlowName, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'modified' =>$modified);
  
         DB::table('itemstocksetting')->insert($data);
 
         return redirect()->route('settings.index')->with('info', 'Notification For Stock Item Added Successfully');
    }

    public function update_flow_PendingApproval(Request $request, $Id)
    {
        $this->validate($request, 
        [
            'RoleId' => 'required'
        ]);
 
        $data = array(
             'RoleId' => $request->input('RoleId'),
             'modified' => date('Y-m-j')
         );
 
         DB::table('workflow')->where('WorkFlowId', $Id)->update($data);
         return redirect()->route('settings.index')->with('info', 'Workflow Settings Updated Successfully');
    }

    public function insert_flow_Declined(Request $request)
    {    
        $this->validate($request, 
        [
            'RoleId' => 'required',
            'WorkFlowName' => 'required'
        ]);
 
            $RoleId = $request->input('RoleId');
            $WorkFlowName = $request->input('WorkFlowName');
            $CreatedBy = $request->input('CreatedBy');
            $created = date('Y-M-j');
            $modified = date('Y-m-j');

         $data = array('RoleId' =>$RoleId, 'WorkFlowName' =>$WorkFlowName, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'modified' =>$modified);
  
         DB::table('itemstocksetting')->insert($data);
 
         return redirect()->route('settings.index')->with('info', 'Notification For Stock Item Added Successfully');
    }

    public function update_flow_Declined(Request $request, $Id)
    {
        $this->validate($request, 
        [
            'RoleId' => 'required'
        ]);
 
        $data = array(
             'RoleId' => $request->input('RoleId'),
             'modified' => date('Y-m-j')
         );
 
         DB::table('workflow')->where('WorkFlowId', $Id)->update($data);
         return redirect()->route('settings.index')->with('info', 'Workflow Settings Updated Successfully');
    }

    public function insert_mailConfig(Request $request)
    {
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

    public function insert_sendmail(Request $request)
    {
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

    public function upload_totaldistance(Request $request)
    {   
        //get file
        $upload=$request->file('upload_file');
        $filePath=$upload->getRealPath();
        //open and read
        $file=fopen($filePath, 'r');

        $header=fgetcsv($file);

        //dd($header);
       $escapedHeader=[];
        //validate
        /*foreach ($header as $key => $value) 
        {
            $lheader = strtolower($value);
            $escapedItem = preg_replace('/[^a-z]/', '', $lheader);
            array_push($escapedHeader, $escapedItem);
        }*/

        //dd($escapedHeader);

        //looping through other columns
        while($columns = fgetcsv($file))
        {
            if($columns[0] == "")
            {
                continue;
            }
            //trim data
            foreach ($columns as $key => &$value) 
            {
                $value = preg_replace('/\D/','',$value);
            }

           $data = array_combine($header, $columns);

           // setting type
           foreach ($data as $key => &$value) 
           {
                $value = ($key == "assetid" || $key == "typeid")?(integer)$value: (integer)$value;
           }

           // Table update
           $assetid = $data['assetid'];
           $typeid = $data['typeid'];
           $vehicle = $data['vehicle'];
           $starttime = $data['starttime'];
           $stoptime = $data['stoptime'];
           $beginingmileage = $data['beginingmileage'];
           $endmileage = $data['endmileage'];
           $totaldistance = $data['totaldistance'];

           $tot_dist = Totaldistance::firstOrNew(['assetid' => $assetid,'typeid' => $typeid]);
           $tot_dist->vehicle = $vehicle;
           $tot_dist->starttime = $starttime;
           $tot_dist->stoptime = $stoptime;
           $tot_dist->beginingmileage = $beginingmileage;
           $tot_dist->endmileage = $endmileage;
           $tot_dist->totaldistance = $totaldistance;
           $tot_dist->save();

           return redirect()->route('settings.index')->with('info', 'Total Distance CSV File Uploaded Successfully');
        }
        
        
    }


    public function totaldistance(Request $request)
    {

      return view('settings.index');

    }
}
