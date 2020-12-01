<?php

namespace App\Http\Controllers;  

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Input;
use App\Users;

 
class UserController extends Controller
{
    //LOGGED IN USER
    public function check_auth()
    {
        
    }

    public function index()
    {
        //USER INDEX AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $UserPr = $perm->UserPr;
        if($UserPr)
        {
            $users = DB::table('users')->get();
        
            return view('user.index')
            ->with('users', $users);
        }
        else {  return redirect()->back(); }        
    }


    public function add()
    {  
        //USER ADD AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $UserPr = $perm->UserPr;
        if($UserPr)
        {
            $departments = DB::table('department')->orderBy('DeptName', 'asc')->get();
            $companylocations = DB::table('companylocation')->orderBy('LocationName', 'asc')->get();
            $userpositions = DB::table('userposition')->orderBy('positionName', 'asc')->get();
            $roles = DB::table('role')->orderBy('roleName', 'asc')->get();
            $workshops = DB::table('workshop')->orderBy('WorkShopName', 'asc')->get();

            return view('user.add')
            ->with('departments', $departments)
            ->with('companylocations', $companylocations)
            ->with('userpositions', $userpositions)
            ->with('roles', $roles)
            ->with('workshops', $workshops);
        }
        else {  return redirect()->back(); }  
        
    }

    public function insert(Request $request)
    {
      /*$this->validate($request, 
      [
        'ExpenseType' => 'required',
        'Description' => 'required',
        'Amount' => 'required',
        'PaidDate' => 'required',
        'Supplier' => 'required',
        'AssetId' => 'required',        
        'name' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20048', 
        'CreatedBy' => 'required',
        'created' => 'required'
      ]);*/

          $FirstName = $request->input('FirstName');
          $LastName = $request->input('LastName');
          $email = $request->input('email');
          $password = bcrypt($request->input('password'));
          $Phone = $request->input('Phone');
          $Sex = $request->input('Sex');
          $RoleId = $request->input('RoleId');
          $DeptId = $request->input('DeptId');
          $PositionId = $request->input('PositionId');
          $LocationId = $request->input('LocationId');
          //IF THE NEW USER ROLE IS A VENDOR MECHANIC
          if($RoleId == '9'){ $WorkShopId = $request->input('WorkShopId'); } else { $WorkShopId = "0"; }
          $VIP = $request->input('VIP');
          $Active = $request->input('Active');
          $name = $request->file('name');
          $CreatedBy = $request->input('CreatedBy');
          $created_at = date('Y-m-j');
          $updated_at = date('Y-m-j');
          
          $file = time().'.'.$name->getClientOriginalExtension();
          $input['name'] = time().'.'.$name->getClientOriginalExtension();
      
          $destinationPath = public_path('assets/img/users');
      
          $name->move($destinationPath, $input['name']);

          $data = array('FirstName' =>$FirstName, 'LastName' =>$LastName,'email' =>$email, 'password' =>$password, 'Phone' =>$Phone, 'Sex' =>$Sex,'RoleId' =>$RoleId, 'DeptId' =>$DeptId, 'PositionId' =>$PositionId, 'LocationId' =>$LocationId, 'WorkShopId' =>$WorkShopId, 'VIP' =>$VIP, 'Active' =>$Active, 'UserPicture' =>$file, 'CreatedBy' =>$CreatedBy, 'created_at' =>$created_at, 'updated_at' =>$updated_at);          
   
          Users::insert($data);
   
         return redirect()->route('user.index')->with('info', 'New User Save Successfully');
      
    }

    public function view(Request $request, $id)
    {
      
    }

    public function edit($UserId)
    {
        //USER PROFILE AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $UserPr = $perm->UserPr;
        if($UserPr)
        {
            $users = Users::find($UserId); 

            $department = DB::table('department')->where('DeptId', '=', $users->DeptId)->first();
            $departments = DB::table('department')->orderBy('DeptName', 'asc')->get();
            $companylocation = DB::table('companylocation')->where('LocationId', '=', $users->LocationId)->first();
            $companylocations = DB::table('companylocation')->orderBy('LocationName', 'asc')->get();
            $userposition = DB::table('userposition')->where('PositionId', '=', $users->PositionId)->first();
            $userpositions = DB::table('userposition')->orderBy('PositionName', 'asc')->get();
            $role = DB::table('role')->where('RoleId', '=', $users->RoleId)->first();
            $roles = DB::table('role')->orderBy('RoleName', 'asc')->get();

            return view('user.edit')
            ->with('department', $department)
            ->with('departments', $departments)
            ->with('companylocation', $companylocation)
            ->with('companylocations', $companylocations)
            ->with('userposition', $userposition)
            ->with('userpositions', $userpositions)
            ->with('role', $role)
            ->with('roles', $roles)
            ->with('users', $users)
            ->with('id', $UserId);
        }
        else {  return redirect()->back(); } 
        
    }


    public function update(Request $request, $UserId)
    {
       $users = Users::find($UserId);       
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
            'FirstName' => $request->input('FirstName'),
            'LastName' => $request->input('LastName'),
            'email' => $request->input('email'),
            //'Password' => $request->input('Password'),
            'Phone' => $request->input('Phone'),
            'Sex' => $request->input('Sex'),
            'RoleId' => $request->input('RoleId'),
            'DeptId' => $request->input('DeptId'),
            'PositionId' => $request->input('PositionId'),
            'LocationId' => $request->input('LocationId'),            
            //'WorkShopId' => $request->input('WorkShopId'),
            'VIP' => $request->input('VIP'),
            'Active' => $request->input('Active'),
            'CreatedBy' => $request->input('CreatedBy')
        );

        Users::where('UserId', $UserId)->update($data);
        return redirect()->route('user.edit', ['UserId' => $UserId])->with('info', 'User Details Updated Successfully');

    }

    //UPLOAD USER PROFILE PHOTO
    public function uploadProfilePhoto(Request $request)
    { 
        $UserId = $request->input('UserId');
        $name = $request->file('name');          
        
        $file = time().'.'.$name->getClientOriginalExtension();
        $FileType = $name->getClientOriginalExtension();
        $input['name'] = time().'.'.$name->getClientOriginalExtension();
    
        $destinationPath = public_path('assets/img/users');
    
        $name->move($destinationPath, $input['name']);

        $data = array(
            'UserPicture' => $file,
            'updated_at' => date('Y-m-j')
        );
        

        Users::where('UserId', $UserId)->update($data);
        return redirect()->route('user.edit', ['UserId' => $UserId])->with('info', 'User Profile Photo Saved Successfully');
    
    }

}
