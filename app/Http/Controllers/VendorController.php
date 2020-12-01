<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Input;
use App\Vendor;
use App\Invcategory;
use Auth;

class VendorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    
    public function index()
    {
        //Vendor AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $SysteCo = $perm->SysteCo;
        if($SysteCo)
        {
            $vendors = Vendor::all();
            
            return view('vendor.index')
            ->with('vendors', $vendors);
        }
      else {  return redirect()->back(); }
      
    }


    public function add()
    {
        //Vendor AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $SysteCo = $perm->SysteCo;
        if($SysteCo)
        {
            $invcategorys = Invcategory::all();                
            return view('vendor.add')
            ->with('invcategorys', $invcategorys);
        }
      else {  return redirect()->back(); }
      
    }

    public function insert(Request $request)
    {
      /*$this->validate($request, 
      [
        'InvCatId' => 'required',
        'VendorName' => 'required',
        'Active' => 'required',
        'CreatedBy' => 'required',
        'created' => 'required'
      ]);*/

          $InvCatId = $request->input('InvCatId');
          $VendorName = $request->input('VendorName');
          $Active = $request->input('Active');
          $CreatedBy = $request->input('CreatedBy');
          $created = date('Y-M-j');
          $updated_at = date('Y-m-j');

          $data = array('InvCatId' =>$InvCatId, 'VendorName' =>$VendorName, 'Active' =>$Active, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 
          'updated_at' =>$updated_at);          
   
          Vendor::insert($data);
   
         return redirect()->route('vendor.index')->with('info', 'New Vendor Created Successfully');
      
    }


    public function edit($VendorId)
    {
        //Vendor AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $SysteCo = $perm->SysteCo;
        if($SysteCo)
        {
            $vendor = Vendor::find($VendorId);
            $invcategorys = Invcategory::all(); 
            return view('vendor.edit')
            ->with('vendor', $vendor)
            ->with('invcategorys', $invcategorys);
        }
      else {  return redirect()->back(); }
      
    }

    public function update(Request $request, $VendorId)
    {      
       /*$this->validate($request, 
       [
           'InvCatId' => 'required',
           'VendorName' => 'required',
           'Active' => 'required',
           'CreatedBy' => 'required',
       ]);*/

       $data = array(
            'InvCatId' => $request->input('InvCatId'),
            'VendorName' => $request->input('VendorName'),
            'Active' => $request->input('Active'),
            'CreatedBy' => $request->input('CreatedBy'),
            'updated_at' => date('Y-m-j')
        );

        Vendor::where('VendorId', $VendorId)->update($data);
        return redirect()->route('vendor.edit', ['VendorId' => $VendorId])->with('info', 'Vendor Updated Successfully');

    }
}
