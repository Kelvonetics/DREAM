<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Input;
use App\Assettype;
use Auth;

class AssettypeController extends Controller
{

    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        //ASSETTYPE AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $SysteCo = $perm->SysteCo;
        if($SysteCo)
        {
            $assettypes = Assettype::all();
            
                    return view('assettype.index')
                    ->with('assettypes', $assettypes);
        }
        else {  return redirect()->back(); }
        
    }

    public function add()
    {               
        //ASSETTYPE AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $SysteCo = $perm->SysteCo;
        if($SysteCo)
        {
            return view('assettype.add');
        }
        else {  return redirect()->back(); }
    }

    public function insert(Request $request)
    {
      /*$this->validate($request, 
      [
        'AssetTypeName' => 'required',
        'Active' => 'required',
        'CreatedBy' => 'required',
        'created' => 'required'
      ]);*/

          $AssetTypeName = $request->input('AssetTypeName');
          $Active = $request->input('Active');
          $CreatedBy = $request->input('CreatedBy');
          $created = date('Y-M-j');
          $updated_at = date('Y-m-j');

          $data = array('AssetTypeName' =>$AssetTypeName, 'Active' =>$Active, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 
          'updated_at' =>$updated_at);          
   
          Assettype::insert($data);
   
         return redirect()->route('assettype.index')->with('info', 'New Asset Type Created Successfully');
      
    }

    public function edit($AssetTypeId)
    {
        //ASSETTYPE AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $SysteCo = $perm->SysteCo;
        if($SysteCo)
        {
            $assettype = Assettype::find($AssetTypeId);
            return view('assettype.edit')
            ->with('assettype', $assettype);
        }
        else {  return redirect()->back(); }
        
    }

    public function update(Request $request, $AssetTypeId)
    {      
       /*$this->validate($request, 
       [
           'AssetTypeName' => 'required',
           'Active' => 'required',
           'CreatedBy' => 'required',
       ]);*/

       $data = array(
            'AssetTypeName' => $request->input('AssetTypeName'),
            'Active' => $request->input('Active'),
            'CreatedBy' => $request->input('CreatedBy'),
            'updated_at' => date('Y-m-j')
        );

        Assettype::where('AssetTypeId', $AssetTypeId)->update($data);
        return redirect()->route('assettype.edit', ['AssetTypeId' => $AssetTypeId])->with('info', 'Asset Type Updated Successfully');

    }
}
