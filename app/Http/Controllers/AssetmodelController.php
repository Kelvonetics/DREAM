<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Input;
use App\Assetmodel;
use App\Assetmake;
use Auth;

class AssetmodelController extends Controller
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
            $assetmodels = Assetmodel::all();
            
            return view('assetmodel.index')
            ->with('assetmodels', $assetmodels);
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
            $assetmakes = Assetmake::all();                
            return view('assetmodel.add')
            ->with('assetmakes', $assetmakes);
        }
        else {  return redirect()->back(); }
    }

    public function insert(Request $request)
    {
      /*$this->validate($request, 
      [
        'MakeId' => 'required',
        'ModelName' => 'required',
        'Active' => 'required',
        'CreatedBy' => 'required',
        'created' => 'required'
      ]);*/

          $MakeId = $request->input('MakeId');
          $ModelName = $request->input('ModelName');
          $Active = $request->input('Active');
          $CreatedBy = $request->input('CreatedBy');
          $created = date('Y-M-j');
          $updated_at = date('Y-m-j');

          $data = array('MakeId' =>$MakeId, 'ModelName' =>$ModelName, 'Active' =>$Active, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 
          'updated_at' =>$updated_at);          
   
          Assetmodel::insert($data);
   
         return redirect()->route('assetmodel.index')->with('info', 'New Asset Model Created Successfully');
      
    }


    public function edit($ModelId)
    {
        //ASSETMAKE AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $SysteCo = $perm->SysteCo;
        if($SysteCo)
        {
            $assetmodel = Assetmodel::find($ModelId);
            $assetmakes = Assetmake::all(); 
            return view('assetmodel.edit')
            ->with('assetmodel', $assetmodel)
            ->with('assetmakes', $assetmakes);
        }
        else {  return redirect()->back(); }
        
    }

    public function update(Request $request, $ModelId)
    {      
       /*$this->validate($request, 
       [
           'MakeId' => 'required',
           'ModelName' => 'required',
           'Active' => 'required',
           'CreatedBy' => 'required',
       ]);*/

       $data = array(
            'MakeId' => $request->input('MakeId'),
            'ModelName' => $request->input('ModelName'),
            'Active' => $request->input('Active'),
            'CreatedBy' => $request->input('CreatedBy'),
            'updated_at' => date('Y-m-j')
        );

        Assetmodel::where('ModelId', $ModelId)->update($data);
        return redirect()->route('assetmodel.edit', ['ModelId' => $ModelId])->with('info', 'Asset Model Updated Successfully');

    }
}
