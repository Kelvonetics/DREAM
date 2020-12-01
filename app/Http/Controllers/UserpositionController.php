<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Input;
use App\Userposition;
use Auth;

class UserpositionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    
    public function index()
    {
        //Position AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $SysteCo = $perm->SysteCo;
        if($SysteCo)
        {
            $userpositions = Userposition::all();
            
            return view('userposition.index')
            ->with('userpositions', $userpositions);
        }
      else {  return redirect()->back(); }
      
    }


    public function add()
    {                
        //Position AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $SysteCo = $perm->SysteCo;
        if($SysteCo)
        {
            return view('userposition.add');
        }
        else {  return redirect()->back(); }
      
    }

    public function insert(Request $request)
    {
      /*$this->validate($request, 
      [
        'ExpenseType' => 'required',
        'CreatedBy' => 'required',
        'created' => 'required'
      ]);*/

          $PositionName = $request->input('PositionName');
          $PositionDesc = $request->input('PositionDesc');
          $CreatedBy = $request->input('CreatedBy');
          $created = date('Y-M-j');
          $updated_at = date('Y-m-j');

          $data = array('PositionName' =>$PositionName, 'PositionDesc' =>$PositionDesc, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);          
   
          Userposition::insert($data);
   
         return redirect()->route('userposition.index')->with('info', 'User Position Save Successfully');
      
    }

    public function view(Request $request, $Positionid)
    {
      
    }

    public function edit($Positionid)
    {
        //Position AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $SysteCo = $perm->SysteCo;
        if($SysteCo)
        {
            $userposition = Userposition::find($Positionid);
            return view('userposition.edit')
            ->with('userposition', $userposition);
        }
      else {  return redirect()->back(); }
        
    }

    public function update(Request $request, $Positionid)
    {      
       /*$this->validate($request, 
       [
           'PositionName' => 'required',
           'PositionDesc' => 'required',
           'CreatedBy' => 'required',
       ]);*/

       $data = array(
            'PositionName' => $request->input('PositionName'),
            'PositionDesc' => $request->input('PositionDesc'),
            'CreatedBy' => $request->input('CreatedBy'),
            'updated_at' => date('Y-m-j')
        );

        Userposition::where('Positionid', $Positionid)->update($data);
        return redirect()->route('userposition.edit', ['Positionid' => $Positionid])->with('info', 'User Position Updated Successfully');

    }
}
