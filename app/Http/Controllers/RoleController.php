<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Input;
use App\Role;
use App\Permission;
use Auth;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        //Role AUTHORIZATION 
      $auth = Auth::user();  
      $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
      $SysteCo = $perm->SysteCo;
      if($SysteCo)
      {
        $roles = Role::all();
        
        return view('role.index')
        ->with('roles', $roles);
      }
      else {  return redirect()->back(); }
      
    }

    public function add()
    {                
        //Role AUTHORIZATION 
      $auth = Auth::user();  
      $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
      $SysteCo = $perm->SysteCo;
      if($SysteCo)
      {
        return view('role.add');
      }
      else {  return redirect()->back(); }
      
    }

    public function insert(Request $request)
    {
      $this->validate($request, 
      [
        'RoleName' => 'required',
        'Active' => 'required',
        'CreatedBy' => 'required'
      ]);

          $RoleName = $request->input('RoleName');
          $DomainId = '1';
          $Active = $request->input('Active');
          $CreatedBy = $request->input('CreatedBy');
          $created = date('Y-M-j');
          $updated_at = date('Y-m-j');

          $data = array('RoleName' =>$RoleName, 'Active' =>$Active, 'DomainId' =>$DomainId, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);          
   
          Role::insert($data);

          $RoleId = $request->input('RoleId');
          $UserAd = '0';
          $UserPr = '0';
          $DriverAd = '0';
          $DriverPr = '0';
          $AssetMa = '0';
          $VehiclePr = '0';
          $InventoryIt = '0';
          $WorkOr = '0';
          $ClientAd = '0';
          $ClientPr = '0';
          $ClientVe = '0';
          $ClientWo = '0';
          $JobMa = '0';
          $Job = '0';
          $WorkforceSc = '0';
          $AssignVe = '0';
          $AssignJo = '0';
          $Community = '0';
          $Report = '0';
          $SysteCo = '0';

          $CreatedBy = $request->input('CreatedBy');
          $created = date('Y-M-j');
          $updated_at = date('Y-m-j');

          $perm_data = array('RoleId' =>$RoleId, 'UserAd' =>$UserAd, 'UserPr' =>$UserPr, 'DriverAd' =>$DriverAd, 'DriverPr' =>$DriverPr, 
            'AssetMa' =>$AssetMa, 'VehiclePr' =>$VehiclePr, 'InventoryIt' =>$InventoryIt, 'WorkOr' =>$WorkOr, 'ClientAd' =>$ClientAd, 
            'ClientPr' =>$ClientPr, 'ClientVe' =>$ClientVe, 'ClientWo' =>$ClientWo, 'JobMa' =>$JobMa, 'Job' =>$Job, 'WorkforceSc' =>$WorkforceSc, 
            'AssignVe' =>$AssignVe, 'AssignJo' =>$AssignJo, 'Community' =>$Community, 'Report' =>$Report, 'SysteCo' =>$SysteCo,  
            'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);          
   
          DB::table('permission')->insert($perm_data);
   
         return redirect()->route('role.index')->with('info', 'Role Save Successfully');
      
    }

    public function permission($RoleId)
    {
        //Role AUTHORIZATION  NOTE REPORT WAS USE TO AUTHENTICATE ROLE PERMISSION - PLS CHANGE IN FUTURE
      $auth = Auth::user();  
      $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
      $Report = $perm->Report;
      if($Report)
      {
        $role = Role::find($RoleId);
        return view('role.permission')
        ->with('role', $role);
      }
      else {  return redirect()->back(); }
      
    }

    public function permission_update(Request $request, $RoleId)
    {      
       /*$this->validate($request, 
       [
           'RoleName' => 'RoleName',
           'CreatedBy' => 'required',
           'Active' => 'required'
       ]);*/

       $data = array(
            'RoleId' => $request->input('RoleId'),
            'UserAd' => $request->input('UserAd'),
            'UserPr' => $request->input('UserPr'),
            'DriverAd' => $request->input('DriverAd'),
            'AssetMa' => $request->input('AssetMa'),
            'VehiclePr' => $request->input('VehiclePr'),
            'InventoryIt' => $request->input('InventoryIt'),
            'WorkOr' => $request->input('WorkOr'),
            'ClientAd' => $request->input('ClientAd'),
            'ClientPr' => $request->input('ClientPr'),
            'ClientVe' => $request->input('ClientVe'),
            'ClientWo' => $request->input('ClientWo'),
            'JobMa' => $request->input('JobMa'),
            'Job' => $request->input('Job'),
            'WorkforceSc' => $request->input('WorkforceSc'),
            'AssignVe' => $request->input('AssignVe'),
            'AssignJo' => $request->input('AssignJo'),
            'Community' => $request->input('Community'),
            'Report' => $request->input('Report'),
            'SysteCo' => $request->input('SysteCo'),
            'CreatedBy' => $request->input('CreatedBy'),
            'updated_at' => date('Y-m-j')
        );

        Permission::where('RoleId', $RoleId)->update($data);
        return redirect()->route('role.index')->with('info', 'Role Permission Updated Successfully');

    }

    public function view(Request $request, $id)
    {
      
    }

    public function edit($RoleId)
    {
      //Role AUTHORIZATION 
      $auth = Auth::user();  
      $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
      $SysteCo = $perm->SysteCo;
      if($SysteCo)
      {
        $role = Role::find($RoleId);
        return view('role.edit')
        ->with('role', $role);
      }
      else {  return redirect()->back(); }
      
    }

    public function update(Request $request, $RoleId)
    {      
       /*$this->validate($request, 
       [
           'RoleName' => 'RoleName',
           'CreatedBy' => 'required',
           'Active' => 'required'
       ]);*/

       $data = array(
            'RoleName' => $request->input('RoleName'),
            'Active' => $request->input('Active'),
            'CreatedBy' => $request->input('CreatedBy')
        );

        Role::where('RoleId', $RoleId)->update($data);
        return redirect()->route('role.edit', ['RoleId' => $RoleId])->with('info', 'Role Updated Successfully');

    }

}
