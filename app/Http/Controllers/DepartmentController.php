<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Input;
use App\Department;
use Auth;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    
    public function index()
    {
        //Department AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $SysteCo = $perm->SysteCo;
        if($SysteCo)
        {
            $departments = Department::all();
            
            return view('department.index')
            ->with('departments', $departments);
        }
        else {  return redirect()->back(); }
        
    }


    public function add()
    {                
        //Department AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $SysteCo = $perm->SysteCo;
        if($SysteCo)
        {
            return view('department.add');
        }
        else {  return redirect()->back(); }
        
    }

    public function insert(Request $request)
    {
      /*$this->validate($request, 
      [
        'DeptName' => 'required',
        'Active' => 'required',
        'CreatedBy' => 'required',
        'created' => 'required'
      ]);*/

          
          $DeptName = $request->input('DeptName');
          $Active = $request->input('Active');
          $CreatedBy = $request->input('CreatedBy');
          $created = date('Y-M-j');
          $updated_at = date('Y-m-j');

          $data = array('DeptName' =>$DeptName, 'Active' =>$Active, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);          
   
          Department::insert($data);
   
         return redirect()->route('department.index')->with('info', 'New Department Created Successfully');
      
    }


    public function edit($Deptid)
    {
        //Department AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $SysteCo = $perm->SysteCo;
        if($SysteCo)
        {
            $department = Department::find($Deptid);
            return view('department.edit')
            ->with('department', $department);
        }
        else {  return redirect()->back(); }
        
    }

    public function update(Request $request, $Deptid)
    {      
       /*$this->validate($request, 
       [
           'DeptName' => 'required',
           'Active' => 'required',
           'CreatedBy' => 'required',
       ]);*/

       $data = array(
            'DeptName' => $request->input('DeptName'),
            'Active' => $request->input('Active'),
            'CreatedBy' => $request->input('CreatedBy'),
            'updated_at' => date('Y-m-j')
        );

        Department::where('Deptid', $Deptid)->update($data);
        return redirect()->route('department.edit', ['Deptid' => $Deptid])->with('info', 'Department Updated Successfully');

    }
}
