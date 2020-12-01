<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Input;
use App\Invcategory;
use Auth;

class InvcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    
    public function index()
    {
        //Inventory Category AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $SysteCo = $perm->SysteCo;
        if($SysteCo)
        {
            $invcategorys = Invcategory::all();
            
             return view('invcategory.index')->with('invcategorys', $invcategorys);
        }
        else {  return redirect()->back(); }
        
    }


    public function add()
    {               
        //Inventory Category AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $SysteCo = $perm->SysteCo;
        if($SysteCo)
        {
            return view('invcategory.add');
        }
        else {  return redirect()->back(); }
        
    }

    public function insert(Request $request)
    {
      /*$this->validate($request, 
      [
        'InvName' => 'required',
        'Active' => 'required',
        'CreatedBy' => 'required',
        'created' => 'required'
      ]);*/

          $InvName = $request->input('InvName');
          $Active = $request->input('Active');
          $CreatedBy = $request->input('CreatedBy');
          $created = date('Y-M-j');
          $updated_at = date('Y-m-j');

          $data = array('InvName' =>$InvName, 'Active' =>$Active, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 
          'updated_at' =>$updated_at);          
   
          Invcategory::insert($data);
   
         return redirect()->route('invcategory.index')->with('info', 'New Inventory Category Created Successfully');
      
    }


    public function edit($InvCatId)
    {
        //Inventory Category AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $SysteCo = $perm->SysteCo;
        if($SysteCo)
        {
            $invcategory = Invcategory::find($InvCatId);
            return view('invcategory.edit')
            ->with('invcategory', $invcategory);
        }
        else {  return redirect()->back(); }
        
    }

    public function update(Request $request, $InvCatId)
    {      
       /*$this->validate($request, 
       [
           'InvName' => 'required',
           'Active' => 'required',
           'CreatedBy' => 'required',
       ]);*/

       $data = array(
            'InvName' => $request->input('InvName'),
            'Active' => $request->input('Active'),
            'CreatedBy' => $request->input('CreatedBy'),
            'updated_at' => date('Y-m-j')
        );

        Invcategory::where('InvCatId', $InvCatId)->update($data);
        return redirect()->route('invcategory.edit', ['InvCatId' => $InvCatId])->with('info', 'Inventory Category Updated Successfully');

    }
}
