<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Input;
use App\Assetmake;
use Auth;

class AssetmakeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        //ASSETMAKE AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $SysteCo = $perm->SysteCo;
        if($SysteCo)
        {
            $assetmakes = Assetmake::all();
            
            return view('assetmake.index')
            ->with('assetmakes', $assetmakes);
        }
        else {  return redirect()->back(); } 
        
    }

    public function add()
    {                
        //ASSETMAKE AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $SysteCo = $perm->SysteCo;
        if($SysteCo)
        {
            return view('assetmake.add');
        }
        else {  return redirect()->back(); } 
    }

    public function insert(Request $request)
    {
      /*$this->validate($request, 
      [
        'Make' => 'required',
        'Active' => 'required',
        'CreatedBy' => 'required',
        'created' => 'required'
      ]);*/

          $Make = $request->input('Make');
          $Active = $request->input('Active');
          $CreatedBy = $request->input('CreatedBy');
          $created = date('Y-M-j');
          $updated_at = date('Y-m-j');

          $data = array('Make' =>$Make, 'Active' =>$Active, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);          
   
          Assetmake::insert($data);
   
         return redirect()->route('assetmake.index')->with('info', 'New Asset Make Created Successfully');
      
    }

    public function edit($MakeId)
    {
        //ASSETMAKE AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $SysteCo = $perm->SysteCo;
        if($SysteCo)
        {
            $assetmake = Assetmake::find($MakeId);
            return view('assetmake.edit')
            ->with('assetmake', $assetmake);
        }
        else {  return redirect()->back(); } 
    }

    public function update(Request $request, $MakeId)
    {      
       /*$this->validate($request, 
       [
           'Make' => 'required',
           'Active' => 'required',
           'CreatedBy' => 'required',
       ]);*/

       $data = array(
            'Make' => $request->input('Make'),
            'Active' => $request->input('Active'),
            'CreatedBy' => $request->input('CreatedBy'),
            'updated_at' => date('Y-m-j')
        );

        Assetmake::where('MakeId', $MakeId)->update($data);
        return redirect()->route('assetmake.edit', ['MakeId' => $MakeId])->with('info', 'Asset Make Updated Successfully');

    }
}
