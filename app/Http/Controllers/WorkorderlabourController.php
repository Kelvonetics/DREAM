<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Input;
use App\Workorderlabour;
use Auth;

class WorkorderlabourController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    
    public function index()
    {
        //Order Labour AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $SysteCo = $perm->SysteCo;
        if($SysteCo)
        {
            $workorderlabours = Workorderlabour::all();
            
            return view('workorderlabour.index')
            ->with('workorderlabours', $workorderlabours);
        }
        else {  return redirect()->back(); } 
        
    }


    public function add()
    {               
        //Order Labour Add AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $SysteCo = $perm->SysteCo;
        if($SysteCo)
        {
            return view('workorderlabour.add');
        }
        else {  return redirect()->back(); } 
        
    }

    public function insert(Request $request)
    {
      /*$this->validate($request, 
      [
        'LabourType' => 'required',
        'LabourDesc => 'required',
        'LabourCost' => 'required',
        'CreatedBy' => 'required',
        'created' => 'required'
      ]);*/

          $LabourType = $request->input('LabourType');
          $LabourDesc = $request->input('LabourDesc');
          $LabourCost = $request->input('LabourCost');
          $CreatedBy = $request->input('CreatedBy');
          $created = date('Y-M-j');
          $updated_at = date('Y-m-j');

          $data = array('LabourType' =>$LabourType, 'LabourDesc' =>$LabourDesc, 'LabourCost' =>$LabourCost, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 
          'updated_at' =>$updated_at);          
   
          Workorderlabour::insert($data);
   
         return redirect()->route('workorderlabour.index')->with('info', 'New Workorder Labour Created Successfully');
      
    }


    public function edit($LabourId)
    {
        //Order Labour EDIT AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $SysteCo = $perm->SysteCo;
        if($SysteCo)
        {
            $workorderlabour = Workorderlabour::find($LabourId);
            return view('workorderlabour.edit')
            ->with('workorderlabour', $workorderlabour);
        }
        else {  return redirect()->back(); } 
        
    }

    public function update(Request $request, $LabourId)
    {      
       /*$this->validate($request, 
       [
           'LabourType' => 'required',
           'LabourDesc' => 'required',
           'LabourCost' => 'required',
           'CreatedBy' => 'required',
       ]);*/

       $data = array(
            'LabourType' => $request->input('LabourType'),
            'LabourDesc' => $request->input('LabourDesc'),
            'LabourCost' => $request->input('LabourCost'),
            'CreatedBy' => $request->input('CreatedBy'),
            'updated_at' => date('Y-m-j')
        );

        Workorderlabour::where('LabourId', $LabourId)->update($data);
        return redirect()->route('workorderlabour.edit', ['LabourId' => $LabourId])->with('info', 'Workorder Labour Updated Successfully');

    }
}
