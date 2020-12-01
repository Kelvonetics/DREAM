<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Input;
use App\Inventoryitem;
use App\Invcategory;
use App\Vendor;
use Auth;

class InventoryitemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    
    public function index()
    {
        //Inventory Item AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $AssetMa = $perm->AssetMa;
        if($AssetMa)
        {
            $inventoryitems = DB::table('inventoryitem')->get();
            
            return view('inventoryItem.index')
            ->with('inventoryitems', $inventoryitems);
        }
        else {  return redirect()->back(); }
        
    }


    public function add()
    {        
        //Inventory Item AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $AssetMa = $perm->AssetMa;
        if($AssetMa)
        {
            $inventoryitems = Inventoryitem::orderBy('InvItemName', 'asc')->get();
            $invcategorys = DB::table('invcategory')->orderBy('InvName', 'asc')->get();
            
            return view('inventoryItem.add')
            ->with('inventoryitems', $inventoryitems)
            ->with('invcategorys', $invcategorys);
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
        'CreatedBy' => 'required'
      ]);*/

          $InvItemName = $request->input('InvItemName');
          $SerialNo = $request->input('SerialNo');
          $Cost = $request->input('Cost');
          $InvCatId = $request->input('InvCatId');
          $VendorId = $request->input('VendorId');
          $Quantity = $request->input('Quantity');
          $Active = $request->input('Active');
          $CreatedBy = $request->input('CreatedBy');
          $created = date('Y-M-j');
          $updated_at = date('Y-m-j');

          $data = array('InvItemName' =>$InvItemName, 'SerialNo' =>$SerialNo,'Cost' =>$Cost, 'InvCatId' =>$InvCatId, 'VendorId' =>$VendorId, 'Quantity' =>$Quantity, 'Active' =>$Active, 'CreatedBy' =>$CreatedBy, 'created' =>$created, 'updated_at' =>$updated_at);          
   
          Inventoryitem::insert($data);
   
         return redirect()->route('inventoryItem.index')->with('info', 'New Inventory Item Save Successfully');
      
    }

    public function view(Request $request, $id)
    {
      
    }

    public function edit($InvId)
    {
        //Inventory Item AUTHORIZATION 
        $auth = Auth::user();  
        $r_id = $auth->RoleId;  $perm = DB::table('permission')->where('RoleId', '=', $r_id)->first();
        $AssetMa = $perm->AssetMa;
        if($AssetMa)
        {
            $inventoryitem = Inventoryitem::find($InvId);
            
            $invcategorys = Invcategory::all();
            $vendors = Vendor::all();
    
            return view('inventoryItem.edit')
            ->with('invcategorys', $invcategorys)
            ->with('vendors', $vendors)
            ->with('inventoryitem', $inventoryitem);
        }
        else {  return redirect()->back(); }
        
    }

    public function update(Request $request, $InvId)
    {
       $inventoryitems = Inventoryitem::find($InvId);       
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
            'InvItemName' => $request->input('InvItemName'),
            'SerialNo' => $request->input('SerialNo'),
            'Cost' => $request->input('Cost'),
            'InvCatId' => $request->input('InvCatId'),
            'VendorId' => $request->input('VendorId'),
            'Quantity' => $request->input('Quantity'),
            'Active' => $request->input('Active'),
            'CreatedBy' => $request->input('CreatedBy')
        );

        Inventoryitem::where('InvId', $InvId)->update($data);
        return redirect()->route('inventoryItem.edit', ['InvId' => $InvId])->with('info', 'Inventory Item  Updated Successfully');

    }
}
